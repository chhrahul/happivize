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
 * Provides file-manipulation helpers
 */

final class MZ_Files{
	private static function log0( $level, $format ){
		$args = func_get_args();
		MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_WARN, $args );
	} // method MZ_Files::log0
	
	static function file_get_contents_sh( $filename, $use_include_path = null, $context = null, $offset = -1, $maxlen = null ){
		$ret = false;
		$h = @fopen( $filename, 'rb' );
		if( false !== $h ){
			if( flock( $h, LOCK_SH ) ){
				$args = func_get_args(); // Can't call inline until PHP 5.3+
				$ret = @call_user_func_array( 'file_get_contents', $args );
				flock( $h, LOCK_UN );
			}else
				self::log0( 'Could not lock file: %s', $filename );
			fclose( $h );
		}else
			self::log0( 'Could not open file for reading: "%s"', $filename );
		return $ret;
	} // method MZ_Files::file_get_contents_sh
	
	static function fwrite_true( $fp, $string, $length = null ){
		if( !is_resource( $fp ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, '[%s] Invalid file handle: %s', __METHOD__, var_export( $fp, true ) );
			return false;
		} // endif !is_resource( $fp )
		
		if( !is_int( $length ) )
			$length = MZ_Strings::byte_len( $string );
		
		$idx = 0;
		if( $idx < $length ){
			do{
				$tmp = fwrite( $fp, MZ_Strings::byte_substr( $string, $idx, $length ), $length );
				if( false === $tmp )
					break;
				$idx += $tmp;
				$length -= $tmp;
			}while( 0 < $length );
		} // endif $idx < $length
		
		return $idx;
	} // method MZ_Files::fwrite_true
	
	static function fread_true( $fp, $length ){
		if( !is_resource( $fp ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, '[%s] Invalid file handle: %s', __METHOD__, var_export( $fp, true ) );
			return false;
		} // endif !is_resource( $fp )
		
		if( feof( $fp ) )
			return false;
		
		$ret = '';
		if( 0 < $length ){
			do{
				$new = fread( $fp, $length );
				if( false === $new )
					break;
				$length -= MZ_Strings::byte_len( $new );
				$ret .= $new;
			}while( ( 0 < $length ) && !feof( $fp ) );
		} // endif 0 < $length
		
		return $ret;
	} // method MZ_Files::fread_true
	
	/**
	 * Returns the extension for a path
	 */
	static function extension( $arg ){
		return pathinfo( $arg, PATHINFO_EXTENSION );
	} // method MZ_Files::extension

	/**
	 * Returns the filename for a path&mdash; basename - extension - any trailing .
	 */
	static function filename( $arg ){
		$info = pathinfo( $arg );
		if( isset( $info[ 'filename' ] ) )
			return $info[ 'filename' ];
		if( isset( $info[ 'extension' ] ) )
			return mb_substr( $info[ 'basename' ], 0, -( mb_strlen( $info[ 'extension' ] ) + 1 ) );
		return $info[ 'basename' ];
	} // method MZ_Files::filename
	
	/**
	 * Returns the last-modified time for the given filepath or file-handle
	 *
	 * @param string|resource
	 * @return int|false
	 */
	static function mtime( $file ){
		if( is_string( $file ) )
			$stat = file_exists( $file ) ? @stat( $file ) : false;
		else
			$stat = is_resource( $file ) ? @fstat( $file ) : false;
		
		return MZ_Arrays::isget( 'mtime', $stat, false );
	} // method MZ_Files::mtime
	
	static function get_file_length( $file ){
		if( is_string( $file ) )
			return @is_file( $file ) ? @filesize( $file ) : false;
		$pos = ftell( $file );
		if( false !== $pos ){
			if( 0 === fseek( $file, 0, SEEK_END ) ){
				if( false !== ( $len = ftell( $file ) ) ){ // Intentional assign
					if( 0 === fseek( $file, $pos, SEEK_SET ) )
						return $len;
					MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not reset file pointer: %s', $file );
				}else
					MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not fetch file length: %s', $file );
			}else
				MZ_Deubg::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not seek file pointer: %s', $file );
		}else
			MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not save file pointer: %s', $file );
		return false;
	} // method MZ_Files::get_file_length

	/**
	 * Determine the most recent modified time within the directory, for the given filters
	 *
	 * @param string $dir
	 * @param callable $file_filter
	 * @param callable $dir_filter
	 * @return int|false
	 */
	public static function get_modified_stamp( $dir, $file_filter = 'MZ_Files::filter_file_all', $dir_filter = 'MZ_Files::filter_dir_all' ){
		$file_filter = MZ_Callables::make( $file_filter, 'MZ_Files::filter_file_all' );
		$dir_filter = MZ_Callables::make( $file_filter, 'MZ_Files::filter_dir_all' );
		$modified = self::mtime( $dir ); // In PHP 5.2.9, a DirectoryIterator points to its first file upon construction, not itself.
		$dir = new DirectoryIterator( $dir );
		
		foreach( $dir as $test ){
			if( $test->isDot() )
				continue;
			
			if( call_user_func( ( $test->isDir() ? $dir_filter : $file_filter ), $test ) ){
				$test_modified = $test->isDir() ? get_modified_stamp( $test->getPathname(), $file_filter, $dir_filter ) : $test->getMTime();
				
				if( ( $test_modified !== false ) && ( ( $modified === false ) || ( $test_modified > $modified ) ) )
					$modified = $test_modified;
			}else
				MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Failed filter: %s', $test->getFilename() );
		} // foreach $test
		
		return $modified;
	} // method MZ_Files::get_modified_stamp
	
	static function filter_file_all( DirectoryIterator $arg ){
		return true;
	} // method MZ_Files::filter_file_all
	
	static function filter_file_none( DirectorIterator $arg ){
		return false;
	} // method MZ_Files::filter_file_none
	
	static function filter_dir_all( DirectoryIterator $arg ){
		return true;
	} // method MZ_Files::filter_dir_all
	
	static function filter_dir_none( DirectorIterator $arg ){
		return false;
	} // method MZ_Files::filter_dir_none
	
	private static function normalizeDirectorySeparator0( $separator ){
		return self::normalizeSeparator0( $separator, DIRECTORY_SEPARATOR );
	} // method MZ_Files::normalizeDirectorySeparator0
	
	private static function normalizePathSeparator0( $separator ){
		return self::normalizeSeparator0( $separator, PATH_SEPARATOR );
	} // method MZ_Files::normalizePathSeparator0
	
	private static function isValidSeparator0( $separator ){
		return is_string( $separator ) && ( '' !== $separator );
	} // method MZ_Files::isValidSeparator0
	
	private static function normalizeSeparator0( $separator, $default ){
		if( self::isValidSeparator0( $separator ) )
			return $separator;
		
		assert( 'MZ_Files::isValidSeparator0( $default )' );
		return $default;
	} // method MZ_Files::normalizeSeparator0
	
	public static function normalize_path( $path, $separator = null, $wantLeadingSeparator = null ){
		$separator = self::normalizeDirectorySeparator0( $separator );
		
		$path = mb_ereg_replace( '[\\\\/]', $separator, $path, 'msr' );
		if( null === $wantLeadingSeparator )
			return $path;
		
		return call_user_func( ( $wantLeadingSeparator ? 'MZ_Strings::mb_assure_begins_with' : 'MZ_Strings::mb_assure_not_begins_with' ), $path, $separator );
	} // method MZ_Files::normalize_path
	
	/**
	 * Normalizes a directory path to use the given separator, and whether it should end in a separator (or not).
	 * Note: No validation is performed as to the existence or correctness of the given path.  Will happily accept a file path, or a path containing invalid characters
	 * Note: Relative directories are left as relative directories
	 * 
	 * @uses MZ_Files::normalize_path
	 * @param $path The directory path.  No validation is performed.
	 * @param $separator The separator to use between path components. Optional. Defaults to the platform separator (DIRECTORY_SEPARATOR).
	 * @param $wantTrailingSeparator Whether the returned path <i>must</i> or <i>must not</i> end with $separator. Optional. Defaults to <code>true</code> (returned path <i>must</i> end with $separator).
	 */
	public static function normalizeDirectory( $path, $separator = null, $wantTrailingSeparator = true ){
		$separator = self::normalizeDirectorySeparator0( $separator );
		
		return call_user_func( ( $wantTrailingSeparator ? 'MZ_Strings::mb_assure_ends_with' : 'MZ_Strings::mb_assure_not_ends_with' ), self::normalize_path( $path, $separator ), $separator );
	} // method MZ_Files::normalizeDirectory
	
	static function is_posix(){
		return DIRECTORY_SEPARATOR === '/';
	} // method MZ_Files::is_posix
	
	/**
	 * @return true if $path begins with /
	 */
	static function is_posix_path( $path ){
		return MZ_Strings::mb_begins_with( $path, '/' );
	} // method MZ_Files::is_posix_path

	/**
	 * @return true if $path matches pattern: [a-zA-Z]:[\\\\/]
	 */
	static function is_windows_local_path( $path ){
		return mb_ereg( '^[a-zA-Z]:[\\\\/]', $path );
	} // method MZ_Files::is_windows_local_path
	
	/**
	 * @return true if is_unc_path( $path ) or is_windows_local_path( $path )
	 */
	static function is_windows_path( $path ){
		return self::is_unc_path( $path ) || self::is_windows_local_path( $path );
	} // method MZ_Files::is_windows_path
	
	/**
	 * @return true if $path begins with \\
	 */
	const PATTERN_UNC_ROOT = '^[\\\\/]{2}[^\\/;]+[\\\\/]';
	static function is_unc_path( $path ){
		return mb_ereg_match( self::PATTERN_UNC_ROOT, $path );
	} // method MZ_Files::is_unc_path
	
	const PATTERN_UNC_LONG_ROOT = '^[\\\\/]{2}\?[\\\\/](?:[a-zA-Z]:|[uU][nN][cC][\\\\/][^\\/;]+)[\\\\/]';
	static function is_unc_long_path( $path ){
		return mb_ereg_match( self::PATTERN_UNC_LONG_ROOT, $path );
	} // method MZ_Files::is_unc_long_path
	
	static function is_absolute_path( $path ){
		return self::is_posix_path( $path ) || self::is_windows_path( $path );
	} // method MZ_Files::is_absolute_path

	static function split_path( $path ){
		$root = self::get_root( $path );
		return ( $root === false ) ? false : array( $root, mb_substr( $path, mb_strlen( $root ) ) );
	} // method MZ_Files::split_path

	/**
	 * @return the component of the path that follows the root of the given *absolute* path.  Returns false if the path is not absolute.
	 */
	static function get_components( $path ){
		return MZ_Arrays::is_get( 1, self::split_path( $path ), false );
	} // method MZ_Files::get_components
	
	/**
	 * @return the root component of the given *absolute* path.  Returns false if the path is not absolute.
	 */
	static function get_root( $path ){
		if( self::is_posix_path( $path ) )
			return '/';
		if( self::is_unc_long_path( $path ) ){
			$regs = array();
			return mb_ereg( self::PATTERN_UNC_LONG_ROOT, $path, $regs ) ? $regs[ 0 ] : false;
		} // endif self::is_unc_long_path
		if( self::is_unc_path( $path ) ){
			$regs = array();
			return mb_ereg( self::PATTERN_UNC_ROOT, $path, $regs ) ? $regs[ 0 ] : false;
		} // endif self::is_unc_path
		if( self::is_windows_local_path( $path ) )
			return mb_substr( $path, 0, 3 );
		MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Invalid absolute path: %s', $path );
		return false;
	} // method MZ_Files::get_root
	
	static function canonicalize_path( $path ){
		$path = self::normalize_path( $path );
		if( self::is_absolute_path( $path ) )
			list( $root, $branches ) = self::split_path( $path );
		else{
			$root = '';
			$branches = $path;
		} // endif !self::is_absolute_path( $path )
		
		$components = array();
		foreach( MZ_Strings::mb_explode( DIRECTORY_SEPARATOR, $branches ) as $component ){
			if( empty( $component ) || ( '.' === $component ) )
				continue;
			
			if( '..' === $component ){
				if( empty( $components ) ){
					MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, '[%s] Invalid path: %s', __METHOD__, $path );
					return false;
				} // endif empty( $components );
				
				array_pop( $components );
			}else
				$components[] = $component;
		} // foreach $component
		
		$ret = $root . implode( DIRECTORY_SEPARATOR, $components );
		if( empty( $root ) || ( reset( $components ) !== '..' ) )
			return $ret;
		MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_WARN, 'Invalid absolute path: %s', $ret );
		return false;
	} // method MZ_Files::canonicalize_path
	
	private static function resolve_path0( $path, $base_dir ){
		assert( 'MZ_Files::is_absolute_path( $base_dir )' );
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Directory base for resolve: %s', $base_dir );
		
		$path = self::normalize_path( $path );
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Path needing resolve: %s', $path );
		$path = self::canonicalize_path( self::is_absolute_path( $path ) ? $path : ( $base_dir . $path ) );
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE_EXCESSIVE, 'Test canonical path: %s', $path );
		if( MZ_Strings::mb_begins_with( $path, $base_dir ) )
			return $path;
		MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_WARN, 'Path not within base: %s %s %s', $path, PATH_SEPARATOR, $base_dir );
		return false;
	} // method MZ_Files::resolve_path0
	
	private static function prep_path_base0( $arg ){
		return self::is_absolute_path( $arg ) ? $arg : self::resolve_path( $arg );
	} // method MZ_Files::prep_path_base0
	
	static function get_doc_root(){
		static $doc_root = null;
		if( null === $doc_root ){
			$tmp = self::normalize_path( MZ_Arrays::isget( 'DOCUMENT_ROOT', $_SERVER, '' ) );
			assert( 'MZ_Files::is_absolute_path( $tmp )' );
			$doc_root = $tmp;
		} // endif null === $doc_root
		return $doc_root;
	} // method MZ_Files::get_doc_root
	
	static function slash_path( $path ){
		return MZ_Strings::mb_assure_ends_with( $path, DIRECTORY_SEPARATOR );
	} // method MZ_Files::slash_path
	
	static function resolve_paths( $path, $choose, $bases = null ){
		$bases = array_map( 'strval', (array)$bases );
		$bases = array_filter( $bases );
		$bases = array_map( ( __CLASS__ . '::prep_path_base0' ), $bases );
		$bases = MZ_Arrays::ordered_unique( array_filter( $bases ) );
		if( empty( $bases ) )
			$bases = array( self::get_doc_root() );
		else
			assert( 'count( $bases ) === count( array_filter( $bases, \'MZ_Files::is_absolute_path\' ) )' );
		$bases = array_map( ( __CLASS__ . '::slash_path' ), $bases );
		
		$paths = array();
		foreach( $bases as $base ){
			$tmp = self::resolve_path0( $path, $base );
			if( false !== $tmp )
				$paths[] = $tmp;
		} // foreach $base
		$choose = intval( $choose );
		if( 0 === $choose )
			return $paths;
		return ( 0 < $choose ) ? array_slice( $paths, 0, $choose ) : array_slice( $paths, $choose );
	} // method MZ_Files::resolve_paths
	
	static function resolve_path( $path, $bases = null, $choose = 1 ){
		$ret = self::resolve_paths( $path, $choose, $bases );
		return reset( $ret );
	} // method MZ_Files::resolve_path
	
	static function equals( $a, $b ){
		$ah = @fopen( $a, 'rb' );
		$bh = @fopen( $b, 'rb' );
		
		if( ( false === $ah ) || ( false === $bh ) )
			return $ah === $bh;
		
		$result = true;
		if( self::get_file_length( $ah ) === self::get_file_length( $bh ) ){
			while( !feof( $ah ) ){
				$ta = self::fread_true( $ah, 4096 );
				$tb = self::fread_true( $bh, 4096 );
				if( $ta !== $tb ){
					$result = false;
					break;
				} // endif $ta !== $tb
			} // while !feof( $ah )
		}else
			$result = false;
		
		fclose( $ah ); // best-effort
		fclose( $bh ); // best-effort
		return $result;
	} // method MZ_Files::equals
} // class MZ_Files

MZ_Assure::library_only( __FILE__ );
