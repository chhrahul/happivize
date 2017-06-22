<?php
/*
Copyright (c) 2016 Martovianus Zolus

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
 * The MZ Autoloader
 * @author Martovianus Zolus <root@zolusc.com>
 * @copyright 2016 Martovianus Zolus
 * @license MIT
 * @version 3.0.0
 * @package MZ
 */

if( class_exists( 'MZ_Autoloader' ) )
	return;

/**
 * The autoloader library class
 */
class MZ_Autoloader{
	const PATTERN_EXTENSION = '^[a-zA-Z0-9\-_\.]*\.[a-zA-Z0-9\-_]+$';
	const PATTERN_CLASSNAME = '^(?:(?:\\[a-zA-Z0-9_]+)+|[a-zA-Z0-9_]+)$';
	const PATTERN_NAMESPACE = '^[a-zA-Z0-9_]+$';
	const FORMAT_PATTERN_FILENAME = '^[a-zA-Z0-9_]+\Q%s\E$';
	const DEFAULT_EXTENSION = '.class.php';
	
	/**
	 * A list of all registered loaders, in the order they were defined (while honoring the <code>prepend-loader</code> parameter)
	 * 
	 * @internal
	 * @var MZ_Autoloader[]
	 */
	private static /* array:MZ_Autoloader */ $loaders = array();

	/**
	 * The directory in which this loader will look for class files
	 *
	 * @internal
	 * @var string Must be an absolute directory pathname
	 */
	private /* string:dir */ $dir;
	
	/**
	 * The extension recognized for class files
	 *
	 * @internal
	 * @var string Must be a valid path basename
	 */
	private /* string:extension */ $extension;
	
	/**
	 * Whether to include subdirectories when looking for class files during a call to MZ_Autoloader::loadAll().
	 *
	 * @internal
	 * @see MZ_Autoloader::loadAll()
	 * @var bool
	 */
	private /* bool */ $includeSubdirs;
	
	/**
	 * Constructs the core loader object
	 *
	 * @see MZ_Autoloader::loadAll()
	 * @param string $dir The absolute directory pathname that forms the root of the search path for this loader
	 * @param string|null $extension The basename extension of the class files path
	 * @param bool $includeSubdirs Whether to look in sub-directories when attempting to perform MZ_Autoloader::loadAll()
	 * @throws InvalidArgumentException if extension is not valid
	 */
	private function __construct( $dir, $extension = null, $includeSubdirs = false ){
		// Validate given directory
		$real_dir = @realpath( $dir );
		if( ( false === $real_dir ) || !@is_dir( $real_dir ) )
			throw new InvalidArgumentException( sprintf( '[%s] Not a valid directory: %s', __METHOD__, $dir ) );
		
		$this->dir = $real_dir . DIRECTORY_SEPARATOR;
		
		// Validate given extension
		$extension = ( null === $extension ) ? self::DEFAULT_EXTENSION : strval( $extension );
		if( !self::isExtension( $extension ) )
			throw new InvalidArgumentException( sprintf( '[%s] Not a valid extension: %s', __METHOD__, $extension ) );
		
		$this->extension = $extension;
		$this->includeSubdirs = (bool)$includeSubdirs;
	} // method MZ_Autoloader::__construct
	
	/**
	 * Fetches the absolute directory pathname that this loader uses to locate class files
	 *
	 * @return string An absolute directory pathname
	 */
	public function getDirectory(){
		return $this->dir;
	} // method MZ_Autoloader::getDirectory
	
	/**
	 * Fetches the pathname extension that this loader uses to locate class files
	 * 
	 * @return string A pathname extension
	 */
	public function getExtension(){
		return $this->extension;
	} // method MZ_Autoloader::getExtension
	
	/**
	 * Fetches whether MZ_Autoloader::loadAll() will look in sub-directories when attempting to load all class files
	 *
	 * @return bool
	 */
	public function includesSubdirectories(){
		return $this->includeSubdirs;
	} // method MZ_Autoloader::includesSubdirectories
	
	/**
	 * Validator used when checking pathname extensions
	 *
	 * @param string $arg Pathname extension to validate
	 * @return bool
	 */
	public static function isExtension( $arg ){
		return mb_ereg_match( self::PATTERN_EXTENSION, $arg );
	} // method MZ_Autoloader::isExtension
	
	/**
	 * The hook into the autoloader subsystem that attempts to locate & load the given classname
	 * 
	 * @internal
	 * @param string $classname The classname to resolve into a class file
	 * @return bool <code>true</code> if we were able to successfully locate & load the classfile for the given classname
	 */
	/* package-private */ function autoload( $classname ){
		// Validate classname
		if( !mb_ereg_match( self::PATTERN_CLASSNAME, $classname ) ){
			error_log( sprintf( '[%s] Invalid classname: %s', __METHOD__, $classname ) );
			
			return false;
		} // endif !mb_ereg_match( self::PATTERN_CLASSNAME, $classname )
		
		// Eliminate leading backslash
		if( mb_substr( $classname, 0, 1 ) === '\\' )
			$classname = mb_substr( $classname, 1 );
		
		$path = $this->dir . mb_ereg_replace( '\\\\', DIRECTORY_SEPARATOR, $classname ) . $this->extension;
		if( !is_file( $path ) )
			return false;
		
		require_once $path;
		
		return true;
	} // method MZ_Autoloader::autoload
	
	/**
	 * Attempts to load all locatable class files for this loader (best-effort).
	 *
	 * @return void
	 */
	public function loadAll(){
		if( $this->includeSubdirs )
			self::loadAll0( $this->dir, $this->extension );
		else
			self::loadFiles0( $this->dir, $this->extension );
	} // method MZ_Autoloader::loadAll
	
	/**
	 * Registers an autoloader
	 *
	 * If the autoloader cannot be generated, attempts to load <em>all</em> relevant class files (based on $extension).
	 *
	 * Recognized properties ($arg):
	 * * extension => the pathname extension to use when locating class files (default: ".class.php")
	 * * include-subdirectories => whether to search in sub-directories when performing MZ_Autoloader::loadAll() (default: false)
	 * * prepend-loader => whether this loader should come ahead of all current loaders (default: false)
	 *
	 * @api
	 * @see MZ_Autoloader::registerPattern
	 * @param string $dir the absolute directory pathname of where to look for class files
	 * @param array $args the properties of this loader
	 * @return bool <code>true</code> if the autoloader was registered successfully, or was able to fallback successfully
	 */
	public static function createAutoloader( $dir, array $args = array() ){
		$args = array_merge( array(
			'extension' => null,
			'include-subdirectories' => false,
			'prepend-loader' => false,
		), $args );
		
		$autoloader = new MZ_Autoloader( $dir, $args[ 'extension' ], (bool)$args[ 'include-subdirectories' ] );
		
		$prepend = (bool)$args[ 'prepend-loader' ];
		if( $prepend )
			array_unshift( self::$loaders, $autoloader );
		else
			self::$loaders[] = $autoloader;
		
		if( function_exists( 'spl_autoload_register' ) && spl_autoload_register( array( $autoloader, 'autoload' ), false, $prepend ) )
			return true;
		
		return $autoloader->loadAll(); // best-effort
	} // method MZ_Autoloader::createAutoloader
	
	/**
	 * A compatibility shim for client code expecting the v2 loader format
	 *
	 * @deprecated
	 * @api
	 * @see MZ_Autoloader::createAutoloader()
	 * @param string $dir the absolute directory pathname of where to look for class files
	 * @param string|null $extension the pathname extension to use when locating class files (default: ".class.php")
	 * @param bool $include_subdirs whether to search in sub-directories when performing MZ_Autoloader::loadAll() (default: true)
	 */
	public static function create_autoloader( $dir, $extension = null, $include_subdirs = true ){
		return self::createAutoloader( $dir, array(
			'extension' => $extension,
			'include-subdirectories' => $include_subdirs,
		) );
	} // method MZ_Autoloader::create_autoloader
	
	/**
	 * Load a classname or array of classnames
	 *
	 * @param string|string[] $classname the string or array-of-strings to attempt to load
	 * @return bool|bool[] the result of whether the any given class could be located & loaded
	 */
	public static function load( $classname ){
		return is_array( $classname ) ? array_map( ( __CLASS__ . '::load0' ), $classname ) : self::load0( $classname );
	} // method MZ_Autoloader::load
	
	/**
	 * A shim for scandir, to provide additional logging
	 *
	 * @internal
	 * @return void
	 */
	private static function scandir0( $dir ){
		$basenames = @scandir( $this->dir );
		if( false === $basenames )
			error_log( sprintf( '[%s] Could not scan directory: %s', __METHOD__, $this->dir ) );
		
		return $basenames;
	} // method MZ_Autoloader::scandir0
	
	/**
	 * Load all class files contained within the given directory and if able, log all directories that this directory contained
	 * 
	 * @internal
	 * @return bool
	 */
	private static function loadFiles0( $dir, $extension, array &$dirs = null ){
		assert( 'DIRECTORY_SEPARATOR === mb_substr( $dir, -1 )' );
		assert( 'is_dir( $dir )' );
		assert( 'self::isExtension( $extension )' );
		
		$basenames = self::scandir0( $dir );
		if( false === $basenames )
			return false;
		
		$pattern = sprintf( self::FORMAT_PATTERN_FILENAME, $extension );
		foreach( $basenames as $basename ){
			if( mb_ereg_match( $pattern, $basename ) )
				require_once $dir . $basename;
			else if( ( null !== $dirs ) && mb_ereg_match( self::PATTERN_NAMESPACE, $basename ) )
				$dirs[] = $dir . $basename;
		} // foreach $basename
		
		return true;
	} // method MZ_Autoloader::loadFiles0
	
	/**
	 * Load all class files in the given directory, and its sub-directories
	 *
	 * @internal
	 * @return bool
	 */
	private static function loadAll0( $dir, $extension ){
		$seen = array();
		$dirs = array( $dir );
		$success = false;
		while( null !== ( $dir = array_shift( $dirs ) ) ){ // Intentional assign
			$real_dir = @realpath( $dir );
			if( false === $real_dir ){
				error_log( sprintf( '[%s::loadAll] Could not process directory: %s', __CLASS__, $dir ) );
				
				continue;
			} // endif false === $real_dir
			
			if( isset( $seen[ $real_dir ] ) )
				continue;
			
			$seen[ $real_dir ] = $real_dir; // Hey, saves me storing a trailing DIRCTORY_SEPARATOR
			$real_dir .= DIRECTORY_SEPARATOR;
			
			$success |= self::loadFiles0( $real_dir, $extension, $dirs );
		} // while null !== $dir
		
		return $success;
	} // method MZ_Autoloader::loadAll0
	
	/**
	 * Runs the autoloaders for a given classname
	 * 
	 * @return bool
	 */
	private static function load0( $classname ){
		if( function_exists( 'spl_autoload_call' ) ){
			spl_autoload_call( $classname );
			
			return class_exists( $classname );
		} // endif function_exists( 'spl_autoload_call' )
		
		foreach( self::$loaders as $loader ){
			if( !$loader->autoload( $classname ) )
				continue;
			
			if( class_exists( $classname ) )
				return true;
		} // foreach $loader
		
		trigger_error( sprintf( '[%s] Could not load class: %s', __METHOD__, $classname ), E_USER_ERROR );
		
		return false;
	} // method MZ_Autoloader::load0
} // class MZ_Autoloader
