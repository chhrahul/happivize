<?php

/*
Copyright (c) 2015 Martovianus Zolus

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
 * General Templating Library
 *
 * @deprecated
 */

final class MZ_Template{
	private static /* MZ_Template? */ $current_template = null;
	private static /* array( MZ_Template ) */ $current_template_stack = null;
	private static /* array( array( string, bool, int? ) ) */ $headers = array();
	
	private /* string: directory path */ $source_dir;
	private /* string: file extension */ $source_extension;
	private /* array( string => callable ) */ $filters = array();
	
	public function __construct( $dir, $ext = null ){
		$tmp = MZ_Files::resolve_path( $dir );
		if( !( is_dir( $tmp ) || @mkdir( $tmp, 0644, true ) ) )
			throw new InvalidArgumentException( sprintf( 'Invalid template directory: %s', var_export( $dir, true ) ) );
		$this->source_dir = MZ_Strings::mb_assure_ends_with( $tmp, DIRECTORY_SEPARATOR );
		if( !is_string( $ext ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Invalid template file extension: %s', var_export( $ext, true ) );
			$ext = self::get_default_extension0();
		} // endif !is_string( $ext )
		$this->source_extension = $ext;
	} // method MZ_Template::__construct
	
	public static function get_default(){
		static $ret = null;
		
		if( null === $ret )
			$ret = new MZ_Template( MZ_Constants::ensure( 'DEFAULT_TEMPLATE_DIR', dirname( dirname( __FILE__ ) ) . '/htt/' ), self::get_default_extension0() );
		
		return $ret;
	} // method MZ_Template::get_default
	
	public static function get_current(){
		if( null === self::$current_template )
			self::$current_template = self::get_default();
		
		return self::$current_template;
	} // method MZ_Template::get_current
	
	public static function set_current( MZ_Template $template ){
		self::$current_template = $template;
	} // method MZ_Template::set_current
	
	public static function push_current( MZ_Template $template ){
		if( null === self::$current_template_stack )
			self::$current_template_stack = array();
		
		self::$current_template_stack[] = self::get_current();
		self::set_current( $template );
	} // method MZ_Template::push_current
	
	public static function pop_current(){
		if( null === self::$current_template_stack )
			throw new PreconditionException();
		
		self::set_current( array_pop( self::$current_template_stack ) );
		
		if( empty( self::$current_template_stack ) )
			self::$current_template_stack = null;
	} // method MZ_Template::pop_current
	
	public static function header( $string, $replace = true, $response_code = null ){
		$args = func_get_args();
		if( !is_int( $args[ 2 ] ) )
			$args = array_slice( $args, 0, 2 );
		if( ob_get_level() > 0 )
			self::$headers[] = $args;
		else
			self::header0( $args );
	} // method MZ_Template::header
	
	public static function emit_headers(){
		if( ob_get_level() === 0 )
			return false;
		array_map( 'MZ_Template::header0', self::$headers );
		self::drop_headers();
	} // method MZ_Template::emit_headers
	
	public static function drop_headers(){
		self::$headers = array();
	} // method MZ_Template::drop_headers
	
	public static function get_headers(){
		return self::$headers;
	} // method MZ_Template::get_headers
	
	public static function attach_filter( $filter_name, $callback ){
		$filter_name = strval( $filter_name );
		if( !is_callable( $callback ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, 'Invalid callback on filter: %s; %s', $filter_name, var_export( $callback, true ) );
			return false;
		} // endif !is_callable( $callback )
		$template = self::get_current();
		if( empty( $template->filters[ $filter_name ] ) )
			$template->filters[ $filter_name ] = array();
		$template->filters[ $filter_name ][] = $callback;
		return true;
	} // method MZ_Template::attach_filter
	
	public static function detach_filter( $filter_name, $callback ){
		$filter_name = strval( $filter_name );
		if( is_callback( $callback ) ){
			$template = self::get_current();
			$filters = MZ_Arrays::isget( $filter_name, $template->filters, array() );
			if( !empty( $filters ) ){
				$changed = false;
				foreach( $filters as $key => $filter ){
					if( $filter === $callback ){
						unset( $filters[ $key ] );
						$changed = true;
					} // endif $filter === $callback
				} // foreach $key => $filter
				if( $changed ){
					if( empty( $filters ) )
						unset( $template->$filters[ $filter_name ] );
					else
						$template->$filters[ $filter_name ] = $filters;
					return true;
				} // endif $changed;
				MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Callback not found for filter: %s; %s', $filter_name, var_export( $callback, true ) );
			}else
				MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Unregistered callback on filter: %s; %s', $filter_name, var_export( $callback, true ) );
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, 'Invalid callback on filter: %s; %s', $filter_name, var_export( $callback, true ) );
		return false;
	} // method MZ_Template::detach_filter
	
	public static function apply_filter( $filter_name, $value ){
		$args = func_get_args();
		$filter_name = strval( array_shift( $filter_name ) );
		foreach( MZ_Arrays::isget( $filter_name, self::get_current()->filters, array() ) as $filter )
			$args[ 0 ] = call_user_func_array( $filter, $args );
		return $args[ 0 ];
	} // method MZ_Template::apply_filter
	
	public static function has_htt( $slug ){
		if( empty( $slug ) )
			return false;
		if( is_array( $slug ) )
			return array_map( 'MZ_Template::has_htt', $slug );
		return is_string( $slug ) && self::get_current()->has_htt0( $slug );
	} // method MZ_Template::has_htt
	
	public static function load_htt( $slug, array $context = array() ){
		if( !empty( $slug ) ){
			if( is_array( $slug ) ){
				$ret = array();
				foreach( $slug as $key => $value )
					$ret[ $key ] = self::load_htt( $value, $context );
				return $ret;
			} // endif is_array( $slug )
			if( is_string( $slug ) )
				return self::get_current()->load_htt0( $slug, $context );
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, 'Invalid template slug: %s', $slug );
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Empty template slug: %s', print_r( $context, true ) );
	} // method MZ_Template::load_htt
	
	public static function load_file( $path, array $_context = array() ){
		if( !file_exists( $path ) )
			return false;
		
		self::load_htt_delegate0( $path, $_context );
		
		return true;
	} // method MZ_Template::load_file

	public static function cache_response( $cache_filename, $source_modified, $rebuild_callback, $cache_cleanup_filter, $cache_header = null ){
		$tmp = mb_ereg_replace( '[\\\\/]+', '', $cache_filename );
		if( empty( $tmp ) ){
			MZ_Debug::log( 'Invalid cache filename: %s', var_export( $cache_filename, true ) );
			return false;
		} // endif empty( $tmp )
		$cache_filename = $tmp;
		
		foreach( array(
			'rebuild_callback',
			'cache_cleanup_filter',
		) as $arg )
			if( !is_callable( $$arg ) ){
				MZ_Debug::log( 'Invalid $%s: %s', $arg, var_export( $$arg, true ) );
				return false;
			} // endif !is_callable( $$arg )

		$source_modified = max( $source_modified, mtime( __FILE__ ) );
		MZ_Debug::log_if( MZ_Debug::LEVEL_EXCESSIVE, 'Ultimate modified time: %s', date( 'c', $source_modified ) );
		
		// Check against cache by time
		header( ( empty( $cache_header ) || !is_string( $cache_header ) ) ? 'Cache-Control: public, max-age=0, must-revalidate' : $cache_header );
		if( is_int( $source_modified ) ){
			header( sprintf( 'Last-Modified: %s GMT', gmdate( 'D, d M Y H:i:s', $source_modified ) ) );
			if( http_match_modified( $source_modified ) )
				die_code( 304 );
			MZ_Debug::log_if( MZ_Debug::LEVEL_EXCESSIVE, 'Modified stamp not satisfied: %s', $cache_filename );
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, 'Non-integer source modified: %s', var_export( $source_modified, true ) );

		// Rebuild if necessary, and return data
		$template = self::get_current();
		$cache_path = $template->find_cache_file0( $cache_filename );
		if( self::should_rebuild0( mtime( $cache_path ), $source_modified ) ){
			$template->cleanup_cache0( $cache_filename, $cache_cleanup_filter );
			if( !$template->rebuild_cache0( $cache_path, $rebuild_callback ) ){
				call_user_func( $rebuild_callback );
				die();
			}else
				MZ_Debug::log_if( MZ_Debug::LEVEL_EXCESSIVE, 'Cache rebuild successful: %s', $cache_path );
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_EXCESSIVE, 'Cache up-to-date: %s', $cache_path );
		include $cache_path;
		die();
	} // method MZ_Template::cache_response

	private function rebuild_cache0( $cache_path, $rebuild_callback ){
		if( ob_start() ){
			$filters = $this->filters;
			$headers = $this->headers;
			call_user_func( $rebuild_callback );
			$text = ob_get_clean();
			$new_headers = $this->get_headers();
			$this->headers = $headers;
			$this->filters = $filters;
			unset( $headers, $filters );
			if( $text !== false ){
				if( !empty( $new_headers ) ){
					$headers_text = "<?php\n";
					foreach( $new_headers as $header )
						$headers_text .= sprintf( "header( '%s', %s );\n", addslashes( $header[ 0 ] ), implode( ', ', array_slice( $header, 1 ) ) );
					$headers_text .= "\n?>";
					$text = $headers_text . $text;
				}else
					MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Cache rebuild specified no headers: %s', $cache_path );
				if( file_put_contents( $cache_path, $text, LOCK_EX ) !== false )
					return true;
				MZ_Debug::log( 'Unable to save response: %s', $cache_path );
			}else
				MZ_Debug::log( 'ob_get_clean() returned false: %s', $cache_path );
		}else
			MZ_Debug::log( 'ob_start() refused: %s', $cache_path );
		return false;
	} // method TemplateUtil::rebuild_cache0

	private function get_cache_dir0(){
		if( $this->cache_dir === null ){
			$cache_dir = $this->get_source_dir() . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
			if( !( is_dir( $cache_dir ) || @mkdir( $cache_dir, 0644, true ) ) ){
				MZ_Debug::log( 'Could not create template cache directory: %s', $cache_dir );
				return false;
			} // endif !( is_dir( $cache_dir ) || @mkdir( $cache_dir, 0644, true ) )
			$this->cache_dir = $cache_dir;
		} // endif $this->cache_dir === null
		return $this->cache_dir;
	} // method MZ_Template::get_cache_dir0
	
	private function find_cache_file0( $filename ){
		return $this->get_cache_dir0() . $filename;
	} // method MZ_Template::find_cache_file0

	private function cleanup_cache0( $skip, $filter ){
		$dir = $this->get_cache_dir0();
		$files = @scandir( $dir );
		if( is_array( $files ) )
			foreach( $files as $filename )
				if( call_user_func( $filter, $filename ) && ( $filename !== $skip ) )
					unlink( $dir . $filename );
	} // method MZ_Template::cleanup_cache0
	
	private function has_htt0( $slug ){
		return file_exists( $this->map_slug_to_file0( $slug ) );
	} // method MZ_Template::has_htt0
	
	private function load_htt0( $slug, array $_context ){
		if( self::load_file( $this->map_slug_to_file0( $slug ), $_context ) )
			return true;
		
		MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Template slug does not map to real file: %s => %s', $slug, $file );
		return false;
	} // method MZ_Template::load_htt0
	
	private function map_slug_to_file0( $slug ){
		return $this->source_dir . mb_ereg_replace( '^[\\\\/]+|\.$', '', $slug ) . $this->source_extension;
	} // method MZ_Template::map_slug_to_file0
	
	private static function should_rebuild0( $cache_modified, $source_modified ){
		return ( $cache_modified === false ) || ( $source_modified === false ) || ( $cache_modified < $source_modified );
	} // method MZ_Template::should_rebuild0
	
	private static function load_htt_delegate0( $_path, array $_context ){
		extract( $_context, EXTR_SKIP );
		include $_path;
	} // method MZ_Template::load_htt_delegate0

	private static function header0( array $args ){
		call_user_func_array( 'header', $args );
	} // methog TemplateUtil::header0
	
	private static function get_default_extension0(){
		return MZ_Constants::ensure( 'DEFAULT_TEMPLATE_EXTENSION', '.htt' );
	} // method MZ_Template::get_default_extension0
} // class MZ_Template

MZ_Assure::library_only( __FILE__ );