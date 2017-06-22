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
 * Core library.  Provides functions for:
 * String manipulation
 */

final class MZ_Strings{
	const UNMAPPED_ACTION_DEFAULT = 'untouched';
	
	const UNMAPPED_ACTION_THROW = 'throw';
	const UNMAPPED_ACTION_EMPTY = 'empty';
	const UNMAPPED_ACTION_UNTOUCHED = 'untouched';

	public static function sprintfNamed( $format, array $mapping, $unmappedAction = null ){
		return mb_ereg_replace_callback( '(?<!\%)\%\{([^:}]+)(?:\:([^}]+))?\}', array(
			new _MZ_Strings_SprintfNamedAction( $mapping, $unmappedAction ),
			'call',
		), $format );
	} // method MZ_Strings::sprintfNamed
	
	public static function printfNamed( $format, array $mapping, $unmappedAction = null ){
		echo self::sprintfNamed( $format, $mapping, $unmappedAction );
	} // method MZ_Strings::printfNamed
	
	static function output_encoding(){
		$encoding = mb_http_output();
		return ( $encoding === 'pass' ) ? mb_internal_encoding() : $encoding;
	} // method MZ_Assure::output_encoding
	
	static function byte_len( $str ){
		return mb_strlen( $str, '8bit' );
	} // method MZ_Strings::byte_len

	static function byte_substr( $str, $start, $length = null ){
		$str = strval( $str );
		$real_length = self::byte_len( $str );
		$start = intval( $start );
		
		if( $start >= $real_length )
			return '';
		
		if( $start < 0 )
			$start = max( 0, $start + $real_length );
		
		// $start now in [0, $real_length)
		if( !is_int( $length ) )
			$until = $real_length;
		else if( $length < 0 )
			$until = $real_length + $length;
		else
			$until = $start + $length;
		
		if( $until <= $start )
			return '';
		
		$length = $until - $start;
		
		// $length now in ($start, $real_length - $start]
		return mb_substr( $str, $start, $length, '8bit' );
	} // method MZ_Strings::byte_substr
	
	private static $encodings = null;
	
	static function mb_is_valid_encoding( $encoding, $default = false ){
		if( self::$encodings === null ){
			$encodings = mb_list_encodings();
			self::$encodings = array_combine( array_map( 'mb_strtolower', $encodings ), $encodings );
		} // endif self::$encodings === null
		return MZ_Arrays::isget( mb_strtolower( $encoding ), self::$encodings, $default );
	} // method MZ_Strings::mb_is_valid_encoding
	
	static function mb_assure_encoding( $encoding ){
		return self::mb_is_valid_encoding( $encoding, mb_internal_encoding() );
	} // method MZ_Strings::mb_assure_encoding
	
	static function mb_explode( $delim, $subject, $limit = null, $encoding = null ){
		$delim = strval( $delim );
		if( empty( $delim ) )
			return false;
		$subject = strval( $subject );
		$encoding = self::mb_assure_encoding( $encoding );
		$count = mb_substr_count( $subject, $delim, $encoding ) + 1;
		if( is_int( $limit ) ){
			if( $limit < 0 )
				$limit += $count;
			else if( $limit === 0 )
				$limit = 1;
			$limit = min( $limit, $count );
		}else
			$limit = $count;
		if( $limit <= 0 )
			$ret = array();
		else if( $limit === 1 )
			$ret = array( $subject );
		else{
			$ret = array();
			$delim_length = mb_strlen( $delim, $encoding );
			$off = 0;
			$len = mb_strlen( $subject, $encoding );
			for( ; $limit > 1; --$limit ){
				$end = mb_strpos( $subject, $delim, $off, $encoding );
				assert( '$end !== false' );
				$ret[] = mb_substr( $subject, $off, $end - $off, $encoding );
				$off = $end + $delim_length;
			} // for $limit > 1
			$ret[] = mb_substr( $subject, $off, $len - $off, $encoding );
		} // endif $limit > 1
		return $ret;
	} // method MZ_Strings::mb_explode
	
	static function mb_str_replace( $search, $replace, $subject, $encoding = null, &$count = null ){
		$search_and_replace = self::mb_str_replace_prepare0( $search, $replace );
		$encoding = self::mb_assure_encoding( $encoding );
		$count = 0;
		if( is_array( $subject ) ){
			foreach( $subject as &$item )
				$item = self::mb_str_replace_do0( $search_and_replace, $item, $encoding, $count );
			return $subject;
		} // is_array( $subject )
		return self::mb_str_replace_do0( $search_and_replace, $subject, $encoding, $count );
	} // method MZ_Strings::mb_str_replace
	
	private static function mb_str_replace_prepare0( $search, $replace ){
		$search = is_array( $search ) ? array_values( array_map( 'strval', $search ) ) : array( strval( $search ) );
		$search_count = count( $search );
		$replace = is_array( $replace ) ? array_values( array_map( 'strval', $replace ) ) : array_fill( 0, $search_count, strval( $replace ) );
		$replace_count = count( $replace );
		$diff = $search_count - $replace_count;
		if( $diff > 0 )
			$replace = array_merge( $replace, array_fill( $replace_count, $diff, '' ) );
		$ret = array();
		foreach( $search as $key => $s )
			$ret[] = array( $s, $replace[ $key ] );
		return $ret;
	} // method MZ_Strings::mb_str_replace_prepare0
	
	private static function mb_str_replace_do0( array $search_and_replace, $subject, $encoding, &$count ){
		foreach( $search_and_replace as $tmp ){
			list( $search, $replace ) = $tmp;
			$subject = self::mb_str_replace_do1( $search, $replace, $subject, $encoding, $count );
		} // foreach $tmp
		return $subject;
	} // method MZ_Strings::mb_str_replace_do0
	
	private static function mb_str_replace_do1( $search, $replace, $subject, $encoding, &$count ){
		$search_length = mb_strlen( $search, $encoding );
		$offset = 0;
		$ret = '';
		while( ( $end = mb_strpos( $subject, $search, $offset, $encoding ) ) !== false ){
			$ret .= mb_substr( $subject, $offset, $end - $offset, $encoding ) . $replace;
			$offset = $end + $search_length;
		} // while $end !== false
		return $ret . mb_substr( $subject, $offset, mb_strlen( $subject, $encoding ), $encoding );
	} // method MZ_Strings::mb_str_replace_do1
	
	static function mb_begins_with( $test, $prefix, $encoding = null ){
		$encoding = self::mb_assure_encoding( $encoding );
		foreach( array( 'test', 'prefix' ) as $param ){
			$$param = strval( $$param );
			${ $param . '_length' } = mb_strlen( $$param, $encoding );
		} // foreach $param
		return ( $prefix_length <= $test_length ) && ( mb_substr( $test, 0, $prefix_length, $encoding ) === $prefix );
	} // method MZ_Strings::mb_begins_with
	
	static function mb_ends_with( $test, $suffix, $encoding = null ){
		$encoding = self::mb_assure_encoding( $encoding );
		foreach( array( 'test', 'suffix' ) as $param ){
			$$param = strval( $$param );
			${ $param . '_length' } = mb_strlen( $$param, $encoding );
		} // foreach $param
		return ( $suffix_length <= $test_length ) && ( mb_substr( $test, ( $test_length - $suffix_length ), $suffix_length, $encoding ) === $suffix );
	} // method MZ_Strings::mb_ends_with
	
	static function mb_assure_begins_with( $test, $prefix, $encoding = null ){
		return self::mb_begins_with( $test, $prefix, $encoding ) ? $test : ( $prefix . $test );
	} // method MZ_Strings::mb_assure_begins_with
	
	static function mb_assure_ends_with( $test, $suffix, $encoding = null ){
		return self::mb_ends_with( $test, $suffix, $encoding ) ? $test : ( $test . $suffix );
	} // method MZ_Strings::mb_assure_ends_with
	
	public static function mb_assure_not_begins_with( $test, $prefix, $encoding = null ){
		$encoding = self::mb_assure_encoding( $encoding );
		
		return self::mb_begins_with( $test, $prefix, $encoding ) ? mb_substr( $test, mb_strlen( $prefix, $encoding ) ) : $test;
	} // method MZ_Strings::mb_assure_not_begins_with
	
	public static function mb_assure_not_ends_with( $test, $suffix, $encoding = null ){
		$encoding = self::mb_assure_encoding( $encoding );
		
		return self::mb_ends_with( $test, $suffix, $encoding ) ? mb_substr( $test, 0, -mb_strlen( $suffix, $encoding ) ) : $test;
	} // method MZ_Strings::mb_assure_not_ends_with
	
	static function mb_trim( $arg ){
		return mb_ereg_replace( '^\s|\s$', '', $arg );
	} // method MZ_Strings::mb_trim
	
	static function normalize_token( $arg, $case_normalize = null ){
		$ret = self::mb_trim( strval( $arg ) );
		if( is_callable( $case_normalize ) )
			$ret = call_user_func( $case_normalize, $ret );
		return $ret;
	} // method MZ_Strings::normalize_token
	
	static function normalize_token_lower( $arg ){
		return self::normalize_token( $arg, 'mb_strtolower' );
	} // method MZ_Strings::normalize_token_lower
	
	static function normalize_token_upper( $arg ){
		return self::normalize_token( $arg, 'mb_strtoupper' );
	} // method MZ_Strings::normalize_token_upper
	
	/**
	 * @param string $arg
	 * @return string|false
	 */
	public static function slugify( $arg ){
		$arg = strval( $arg );
		$arg = iconv( mb_internal_encoding(), 'ASCII//TRANSLIT', $arg );
		if( false === $arg ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, '[%s] Could not transliterate: %s', __METHOD__, $arg );
			return false;
		} // endif false === $arg
		
		// Convert back to internal encoding to avoid needing to change regex encoding
		$arg = iconv( 'ASCII', mb_internal_encoding(), $arg );
		
		// Trim out all "invalid" characters
		$arg = mb_ereg_replace( '[^0-9a-zA-Z_]+', '-', $arg );
		
		// Strip extra dashes, underscores
		$arg = mb_ereg_replace( '([_\-])\1+', '\1', $arg );
		
		// Strip leading and trailing dashes (will only be singles at this point)
		$arg = mb_ereg_replace( '^-|-$', '', $arg );
		
		return mb_strtolower( $arg );
	} // method MZ_Strings::slugify
	
	/**
	 * @internal
	 */
	/* package-private */ static function initialize(){
		static $initialized = false;
		if( !$initialized ){
			$initialized = true;
			
			if( !function_exists( 'mb_ereg_replace_callback' ) )
				class_exists( 'MZ_Compat' );
			
			// Determine what encoding we should set
			$encoding = false;
			if( defined( 'DEFAULT_ENCODING' ) )
				$encoding = self::mb_is_valid_encoding( DEFAULT_ENCODING );
			if( false === $encoding )
				$encoding = self::mb_is_valid_encoding( ini_get( 'default_charset' ) );
			if( false === $encoding )
				$encoding = 'UTF-8';
			assert( 'self::mb_is_valid_encoding( $encoding )' );
			
			// Set that encoding everywhere we can
			MZ_Constants::ensure( 'DEFAULT_ENCODING', $encoding );
			ini_set( 'default_charset', $encoding );
			if( !mb_internal_encoding( DEFAULT_ENCODING ) )
				MZ_Debug::log( 'Unable to set internal encoding: %s', DEFAULT_ENCODING );
			if( !mb_regex_encoding( DEFAULT_ENCODING ) )
				MZ_Debug::log( 'Unable to set regex encoding: %s', DEFAULT_ENCODING );
			if( !mb_http_output( DEFAULT_ENCODING ) )
				MZ_Debug::log( 'Unable to set output encoding: %s', DEFAULT_ENCODING );
		} // endif !$initialized
	} // method MZ_Strings::initialize
	
	/**
	 * Converts $arg to a camelCaseFormat
	 *
	 * All non-alnum characters are coalesced and considered as word breaks.  For each remaining "word" in $arg after the first, capitalize the first alnum of that word.  Remove any word breaks.  Optionally init-cap the first word
	 *
	 * @param string $arg The string to convert
	 * @param bool $initCap Whether the first word should be init-cap'd (<code>true</code>) or lowercase (<code>false</code>).  Default <code>false</code>
	 * @return string
	 */
	public static function mb_camel_case( $arg, $initCap = false ){
		$ret = mb_ereg_replace( '[^a-zA-Z0-9]+', ' ', $arg );
		$ret = mb_convert_case( $ret, MB_CASE_TITLE );
		$ret = mb_ereg_replace( ' ', '', $ret );
		
		// Init-cap if requested
		if( !$initCap )
			$ret = mb_strtolower( mb_substr( $ret, 0, 1 ) ) . mb_substr( $ret, 1 );
		
		return $ret;
	} // method MZ_Strings::mb_camel_case
	
	/**
	 * General wrapper for htmlspecialchars such that $double_encode is always <code>false</code>
	 *
	 * @param string $string The string to encode
	 * @param int $quotingRules Despite the name, accepts the same flags as htmlspecialchars
	 * @param string|null $encoding The character encoding to use.  Will default to mb_internal_encoding()
	 * @return string|null The escaped version of the string, or <code>null</code> on failure
	 * @uses htmlspecialchars()
	 * @uses MZ_Strings::mb_assure_encoding()
	 */
	public static function escHTML( $string, $quotingRules = ENT_COMPAT, $encoding = null ){
		$ret = htmlspecialchars( $string, $quotingRules, self::mb_assure_encoding( $encoding ), false );
		if( !is_string( $ret ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, '[%s] Not a string: %s', __METHOD__, var_export( $string, true ) );
			MZ_Debug::log_bt_if( MZ_Debug::LEVEL_DEBUG, false );
		} // endif !is_string( $ret )
		
		return $ret;
	} // method MZ_Strings::escHTML
	
	/**
	 * Escapes $string such that it is safe for use as HTML text
	 *
	 * @param string $string The string to escape
	 * @param string|null $encoding The character encoding to use.  Will default to mb_internal_encoding()
	 * @return string|null The escaped version of the string, or <code>null</code> on failure
	 * @uses MZ_Strings::escHTML()
	 */
	public static function escHTMLText( $string, $encoding = null ){
		return self::escHTML( $string, ENT_NOQUOTES, $encoding );
	} // method MZ_Strings::escHTMLText
	
	/**
	 * Escapes $string such that it is safe for use in HTML attribute values
	 *
	 * @param string $string The string to escape
	 * @param string|null $encoding The character encoding to use.  Will default to mb_internal_encoding()
	 * @return string|null The escaped version of the string, or <code>null</code> on failure
	 * @uses MZ_Strings::escHTML()
	 */
	public static function escHTMLAttribute( $string, $encoding = null ){
		return self::escHTML( $string, ENT_QUOTES, $encoding );
	} // method MZ_Strings::escHTMLAttribute
	
	/**
	 * Converts $arg to string, without triggering the usual 'Array-to-String conversion' and 'Object-to-String' warnings
	 *
	 * @param mixed $arg The argument to convert
	 * @return string
	 */
	public static function toStringQuiet( $arg ){
		if( is_object( $arg ) ){
			if( method_exists( $arg, '__toString' ) )
				return $arg->__toString();
			
			return get_class( $arg );
		} // endif is_object( $arg )
		
		if( is_array( $arg ) )
			return 'Array';
		
		return (string)$arg;
	} // method MZ_Strings::toStringQuiet
	
	/**
	 * Basis for proeprty name normalization
	 *
	 * @param string $arg Property name to normalize
	 */
	public static function normalizePropertyName( $arg ){
		$tmp = MZ_Strings::mb_camel_case( MZ_Strings::toStringQuiet( $arg ) );
		
		return ( '' === $tmp ) ? '_' : $tmp;
	} // method MZ_Strings::normalizePropertyName
	
	/**
	 * Generates a normalized property's getter method name
	 *
	 * @param string $arg Normalized property name
	 */
	public static function propertyNameGetter( $arg ){
		if( '' === $arg )
			return 'get_';
		
		return 'get' . mb_strtoupper( mb_substr( $arg, 0, 1 ) ) . mb_substr( $arg, 1 );
	} // method MZ_Strings::propertyNameGetter
	
	/**
	 * Generates a normalized property's setter method name
	 *
	 * @param string $arg Normalized property name
	 */
	public static function propertyNameSetter( $arg ){
		if( '' === $arg )
			return 'set_';
		
		return 'set' . mb_strtoupper( mb_substr( $arg, 0, 1 ) ) . mb_substr( $arg, 1 );
	} // method MZ_Strings::propertyNameSetter
} // class MZ_Strings

MZ_Strings::initialize();

MZ_Assure::library_only( __FILE__ );
