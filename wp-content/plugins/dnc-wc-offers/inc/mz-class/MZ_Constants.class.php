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

final class MZ_Constants{
	/**
	 * Getters
	 */
	 
	static function get( $name, $default ){
		return defined( $name ) ? constant( $name ) : $default;
	} // method MZ_Constants::get
	
	static function get_cb( $name, $callback ){
		return defined( $name ) ? constant( $name ) : self::do_callback0( $name, $callback );
	} // method MZ_Constants::get_cb
	
	/**
	 * Ensurers
	 */
	
	static function ensure( $name, $value ){
		if( defined( $name ) )
			return constant( $name );
		define( $name, $value );
		return $value;
	} // method MZ_Constants::ensure
	
	static function ensure_cb( $name, $callback ){
		if( defined( $name ) )
			return constant( $name );
		$value = self::do_callback0( $name, $callback );
		define( $name, $value );
		return $value;
	} // method MZ_Constants::ensure_cb
	
	private static function do_callback0( $name, $callback ){
		self::load_libraries();
		return call_user_func( MZ_Callables::make_debug( MZ_Debug::LEVEL_LOGIC_WARN, $callback ), $name );
	} // method MZ_Constants::do_callback0
} // class MZ_Constants

MZ_Assure::library_only( __FILE__ );
