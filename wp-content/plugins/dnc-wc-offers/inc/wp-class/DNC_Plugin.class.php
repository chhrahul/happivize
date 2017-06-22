<?php
/*
Copyright (c) 2016 Designs and Codes

Permission is hereby granted, free of charge, to any person obtaining a copy 
of this software and associated documentation files (the "Software"), to deal 
in the Software without restriction, including without limitation the rights 
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
copies of the Software, and to permit persons to whom the Software is 
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in 
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
SOFTWARE.
*/

/**
 * Base type to simplify plugin development
 */
abstract class DNC_Plugin{
	private static /* array( string => DNC_Plugin ) */ $instances = array();
	
	private /* string */ $pluginDirectory;
	private /* string */ $pluginURL;
	
	protected function __construct( $pluginFilePath ){
		$this->pluginDirectory = plugin_dir_path( $pluginFilePath );
		$this->pluginURL = plugin_dir_url( $pluginFilePath );
		
		// Setup our core actions/filters
		add_action( 'init', array( $this, 'actionInit' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'actionEnqueueScripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'actionAdminEnqueueScripts' ) );
		
		register_activation_hook( $pluginFilePath, array( $this, 'actionPluginActivation' ) );
		register_deactivation_hook( $pluginFilePath, array( $this, 'actionPluginDeactivation' ) );
	} // method DNC_Plugin::__construct
	
	public function __get( $name ){
		if( isset( $this->$name ) )
			return $this->$name;
		
		if( WP_DEBUG )
			error_log( sprintf( '[%s] Access to non-existent property: %s', __CLASS__, $name ) );
		
		return null;
	} // method DNC_Plugin::__get
	
	public static function register( $pluginFilePath ){
		static $instances = array();
		
		$pluginInstanceName = get_called_class() . PATH_SEPARATOR . $pluginFilePath;
		if( !isset( $instances[ $pluginInstanceName ] ) ){
			$ret = new static( $pluginFilePath );
			
			$class = get_called_class();
			if( !isset( self::$instances[ $class ] ) )
				self::$instances[ $class ] = $ret;
			
			$instances[ $pluginInstanceName ] = $ret;
		}else
			$ret = $instances[ $pluginInstanceName ];
		
		return $ret;
	} // method DNC_Plugin::register
	
	public function actionInit(){}
	
	public function actionEnqueueScripts(){}
	
	public function actionAdminEnqueueScripts(){}
	
	public function actionPluginActivation(){}
	
	public function actionPluginDeactivation(){}
	
	public function actionPluginUninstall(){
		return defined( 'WP_UNINSTALL_PLUGIN' );
	} // method DNC_Plugin::actionPluginUninstall
	
	public static function getInstance(){
		$class = get_called_class();
		
		return isset( self::$instances[ $class ] ) ? self::$instances[ $class ] : null;
	} // method DNC_Plugin::getInstance
	
	/**
	 * Looks up the available urls for a resource, ordered by importance
	 *
	 * @param string $resourcePath The relative path to the resource
	 * @param bool $inclusive Whether to return multiple resources (<tt>true</tt>) or stop after first-found (<tt>false</tt>)
	 * @return array The information about the found resource(s)
	 */
	public static function lookupResource( $resourcePath, $inclusive ){
		$ret = array();
		$instance = static::getInstance();
		
		foreach( array(
			get_stylesheet_directory() => get_stylesheet_directory_uri(),
			get_template_directory() => get_template_directory_uri(),
			$instance->pluginDirectory => $instance->pluginURL,
		) as $dir => $url ){
			$path = trailingslashit( $dir ) . $resourcePath;
			$mtime = MZ_Files::mtime( $path );
			
			if( false === $mtime )
				continue; // No resource found -- continue to next iteration of loop
			
			$ret[] = array(
				'path' => $path,
				'url' => ( trailingslashit( $url ) . $resourcePath ),
				'mtime' => $mtime,
			);
			
			if( !$inclusive )
				break; // Caller only wants one result at most -- break out of loop
		} // foreach $dir => $url
		
		return $ret;
	} // method DNC_Plugin::lookupResource
	
	public static function resourceToVersionedURL( array $resource ){
		$url = MZ_Arrays::isget( 'url', $resource, null );
		
		if( empty( $url ) )
			return '';
		
		$mtime = MZ_Arrays::isget( 'mtime', $resource, null );
		
		if( null === $mtime )
			return $url;
		
		return $url . '?' . http_build_query( array(
			'version' => $mtime,
		) );
	} // method DNC_Plugin::resourceToVersionedURL
	
	/**
	 * General implementation for the {$X}_template family of filters.  Requires some preconditions to be met.  Namely, the caller must verify that the context is appropriate for calling this method (the proper post type and all that)
	 *
	 * @param string $templatePath The path chosen by the caller for what it considers the "best" file to fulfill this template
	 * @param string $generalType The general "type" of this template: archive, single, etc.
	 * @param string $specificType The more specific "type" that this plugin wants to provide its own default template for (post type)
	 * @return string The resultant template file
	 */
	/* protected */ static function filterTemplate( $templatePath, $generalType, $specificType ){
		/*
		 * In the event that our caller provides any of:
		 * * Found the type template (${generalType}.php)
		 * * Found the general template (index.php)
		 * * Found nothing
		 * We'll proceed to substitute our own template.  If none of those conditions are met, we'll return right here
		 */
		if( !in_array( $templatePath, array(
			'',
			locate_template( sprintf( '%s.php', $generalType ) ),
			locate_template( 'index.php' ),
		) ) )
			return $templatePath;
		
		$instance = static::getInstance();
		$ret = sprintf( '%s%s-%s.php', $instance->pluginDirectory, $generalType, $specificType );
		
		if( !file_exists( $ret ) ) // Paranoia check
			return $templatePath;
		
		return $ret;
	} // method DNC_Plugin::filterTemplate
	
	/**
	 * General implementation for the locate_template filter.  Simply, adds our plugin's directory to the list of available locations
	 *
	 * @param string[] $locations The known list of locations
	 * @return string[] The new list of locations
	 */
	/* protected */ function filterLocateTemplate( array $locations ){
		$locations[] = $this->pluginDirectory;
		
		return $locations;
	} // method DNC_Plugin_Offers::filterLocateTemplate
} // class DNC_Plugin
