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
 * Script access checking,
 * Callable manipulation,
 * Debug/logging,
 * Constant manipulation,
 * Array manipulation,
 * Number manipulation.
 */

final class MZ_Numbers{
	const BC_ZERO = '0';
	const BC_ONE = '1';
	
	/**
	 * Modified from http://stackoverflow.com/a/22500394
	 */
	static function php_size_to_number( $arg ){
		if( is_numeric( $arg ) )
			return $arg;
		$value = mb_substr( $arg, 0, -1 );
		$count = (int)array_search( mb_strtoupper( mb_substr( $arg, -1 ) ), array( '', 'K', 'M', 'G', 'T', 'P' ) );
		while( $count-- > 0 )
			$value *= 1024;
		return $value;
	} // method MZ_Numbers::php_size_to_number

	static function length_modulo( $arg, $length ){
		if( !is_int( $length ) || ( $length <= 0 ) ){
			MZ_Debug::log_if( MZ_Debug::LEVEL_LOGIC_ERROR, 'Invalid modulo: %s', $length );
			return false;
		} // endif !is_int( $length ) || ( $length <= 0 )
		$ret = $arg % $length;
		if( $arg < 0 )
			$ret += $length;
		return $ret;
	} // method MZ_Numbers::length_modulo
	
	/**
	 * Converts the given string to a valid bc-number string.  Behaves much like intval().
	 */
	static function bcval( $arg, $scale = 0 ){
		return bcadd( $arg, self::BC_ZERO, $scale );
	} // method MZ_Numbers::bcval
	
	static function bcmax( $a, $b, $scale = 0 ){
		return ( bccomp( $a, $b, $scale ) > 0 ) ? $a : $b;
	} // method MZ_Numbers::bcmax
	
	static function bcmin( $a, $b, $scale = 0 ){
		return ( bccomp( $a, $b, $scale ) < 0 ) ? $a : $b;
	} // method MZ_Numbers::bcmin
	
	/**
	 * @credit http://stackoverflow.com/a/20460461
	 */
	static function signum( $arg ){
		return ( $arg > 0 ) - ( $arg < 0 );
	} // method MZ_Numbers::signum
	
	/**
	 * 2-arg generalization of signum()
	 * Although in MZ_Numbers, this will work with any 2 values for which there is a well-defined less-than operator in PHP
	 */
	static function compare( $a, $b ){
		return ( $a > $b ) - ( $a < $b );
	} // method MZ_Numbers::compare
	
	/**
	 * Casts a value to an int, without generating a warning if $arg is an array-or-object
	 * @param $arg Value to cast-to-int
	 * @param $default Value to return of $arg can't cast-to-int.  Defaults to 0, not type-checked.
	 */
	static function toIntQuiet( $arg, $default = 0 ){
		return is_numeric( $arg ) ? (int)$arg : $default;
	} // method MZ_Numbers::toIntQuiet
	
	public static function add(){
		$args = func_get_args();
		
		return array_sum( $args );
	} // method MZ_Numbers::add
	
	public static function mul(){
		$args = func_get_args();
		$ret = 1;
		
		foreach( $args as $arg )
			$ret *= $arg;
		
		return $ret;
	} // method MZ_Numbers::mul
	
	public static function absint( $arg ){
		return abs( intval( $arg ) );
	} // method MZ_Numbers::absint
} // class MZ_Numbers

MZ_Assure::library_only( __FILE__ );
