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
 * Provides compatibility shims for different versions of PHP and other miscellaneous helpers.
 */

final class MZ_Compat{
	/**
	 * Compatibility-related functions
	 */
	
	private static $regex_sequence = 0;
	
	public static function mb_ereg_replace_callback( $pattern, $callback, $string, $option = 'msr' ){
		if( function_exists( 'mb_ereg_replace_callback' ) )
			return mb_ereg_replace_callback( $pattern, $callback, $string, $option );
		return self::mb_ereg_replace_callback0( $pattern, $callback, $string, $option );
	} // method MZ_Compat::mb_ereg_replace_callback
	
	/* package-private */ static function mb_ereg_replace_callback0( $pattern, $callback, $string, $option = 'msr' ){
		if( !is_string( $string ) )
			throw new InvalidArgumentException( sprintf( '[%s] Invalid subject: %s', __METHOD__, var_export( $subject, true ) ) );
		if( !is_callable( $callback ) )
			throw new InvalidArgumentException( sprintf( '[%s] Invalid callback: %s', __METHOD__, var_export( $callback, true ) ) );
		if( !is_string( $option ) )
			$option = 'msr';
		
		if( !is_int( $seq = self::regex_init0( $string, $pattern, $option, 0 ) ) ) // Intentional assign
			return false;
		
		if( !is_array( $pos = mb_ereg_search_pos() ) ) // Intentional assign
			return $string;
		
		$cur_offset = 0;
		$ret = '';
		do{
			list( $new_offset, $length ) = $pos;
			$ret .= MZ_Strings::byte_substr( $string, $cur_offset, ( $new_offset - $cur_offset ) ) . call_user_func( $callback, mb_ereg_search_getregs() );
			$cur_offset = $new_offset + $length;
			
			if( self::$regex_sequence !== $seq )
				if( !is_int( $seq = self::regex_init0( $string, $pattern, $option, $cur_offset ) ) ) // Intentional assign
					return false;
		}while( is_array( $pos = mb_ereg_search_pos() ) ); // Intentional assign
		
		return $ret . MZ_Strings::byte_substr( $string, $cur_offset );
	} // method MZ_Compat::mb_ereg_replace_callback0
	
	private static function regex_init0( $string, $pattern, $option, $pos ){
		assert( 'is_string( $string )' );
		assert( 'is_string( $pattern )' );
		assert( 'is_string( $option )' );
		assert( 'is_int( $pos )' );
		
		$ret = ++self::$regex_sequence; // Destroy outer nestings' hopes, even if mb_ereg_search_init fails, as it may muck up its own internal state
		
		if( mb_ereg_search_init( $string, $pattern, $option ) && mb_ereg_search_setpos( $pos ) )
			return $ret;
		
		$args = func_get_args();
		MZ_Debug::log( 'Could not initialize regex: %s', print_r( $args, true ) );
		return false;
	} // method MZ_Compat::regex_init0
	
	public static function http_match_etag( $etag, $for_range = false ){
		if( function_exists( 'http_match_etag' ) )
			return http_match_etag( $etag, $for_range );
		return self::http_match_etag0( $etag, $for_range );
	} // method MZ_Compat::http_match_etag
	
	/**
	 * Of note: Does not honor the $for_range parameter
	 */
	/* package-private */ static function http_match_etag0( $etag, $for_range = false ){
		static $etag_pattern = '^(?:W/)?"([^"]*?)(?:-gzip)?"$';
		
		$regs = array();
		if( mb_ereg( $etag_pattern, MZ_Arrays::isget( 'HTTP_IF_NONE_MATCH', $_SERVER, '' ), $regs ) )
			return $regs[ 1 ] === $etag;
		
		MZ_Debug::log_if( MZ_Debug::LEVEL_VERBOSE, 'Could not find etag: %s', $raw_etag );
		
		return false;
	} // method MZ_Compat::http_match_etag0
	
	public static function http_match_modified( $etag, $for_range = false ){
		if( function_exists( 'http_match_modified' ) )
			return http_match_modified( $etag, $for_range );
		return self::http_match_modified0( $etag, $for_range );
	} // method MZ_Compat::http_match_modified
	
	/**
	 * Of note: Does not honor the $for_range parameter
	 */
	/* package-private */ static function http_match_modified0( $timestamp = null, $for_range = false ){
		return @strtotime( MZ_Arrays::isget( 'HTTP_IF_MODIFIED_SINCE', $_SERVER, '' ) ) >= ( is_int( $timestamp ) ? $timestamp : time() );
	} // method MZ_Compat::http_match_modified0
	
	public static function get_max_upload_size( $etag, $for_range = false ){
		if( function_exists( 'get_max_upload_size' ) )
			return get_max_upload_size( $etag, $for_range );
		return self::get_max_upload_size0( $etag, $for_range );
	} // method MZ_Compat::get_max_upload_size

	/**
	 * Modified from http://stackoverflow.com/a/22500394
	 */
	/* package-private */ static function get_max_upload_size0(){
		return min( MZ_Numbers::php_size_to_number( ini_get( 'post_max_size' ) ), MZ_Numbers::php_size_to_number( ini_get( 'upload_max_filesize' ) ) );
	} // method MZ_Compat::get_max_upload_size0
	
	/* package-private */ static function boolval( $arg ){
		return (bool)$arg;
	} // method MZ_Compat::boolval
	
	public static function __callStatic( $name, array $args ){
		if( function_exists( $name ) )
			return call_user_func_array( $name, $args );
		
		if( method_exists( __CLASS__, ( $name . '0' ) ) )
			return call_user_func_array( sprintf( '%s::%s0', __CLASS__, $name ), $args );
		
		MZ_Debug::log( '[%s] No such function: %s', __CLASS__, $name );
		return false;
	} // method MZ_Compat::__callStatic
} // class MZ_Compat

// Compatibility shims
if( !function_exists( 'mb_ereg_replace_callback' ) ){
	function mb_ereg_replace_callback( $pattern, $callback, $string, $option = 'msr' ){
		return MZ_Compat::mb_ereg_replace_callback0( $pattern, $callback, $string, $option );
	} // function mb_ereg_replace_callback
} // endif !function_exists( 'mb_ereg_replace_callback' )

if( !function_exists( 'http_match_etag' ) ){
	function http_match_etag( $etag, $for_range = false ){
		return MZ_Compat::http_match_etag0( $etag, $for_range );
	} // function http_match_etag
} // endif !function_exists( 'http_match_etag' )

if( !function_exists( 'http_match_modified' ) ){
	function http_match_modified( $timestamp = null, $for_range = false ){
		return MZ_Compat::http_match_modified0( $timestamp, $for_range );
	} // function http_match_modified
} // endif !function_exists( 'http_match_modified' )

if( !function_exists( 'array_column' ) ){
	function array_column( array $array, $column_key, $index_key = null ){
		return MZ_Arrays::array_column0( $array, $column_key, $index_key );
	} // function array_column
} // endif !function_exists( 'array_column' )

if( !function_exists( 'boolval' ) ){
	function boolval( $arg ){
		return MZ_Compat::boolval0( $arg );
	} // function boolval
} // endif !function_exists( 'boolval' )

if( !defined( '__DIR__' ) )
	define( '__DIR__', dirname( __FILE__ ) );

@ini_set( 'zlib.output_compression', MZ_Constants::ensure( 'OUTPUT_COMPRESSION', 8192 ) );

MZ_Assure::library_only( __FILE__ );
