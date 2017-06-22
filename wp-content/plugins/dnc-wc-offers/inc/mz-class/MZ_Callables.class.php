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

final class MZ_Callables{
	/**
	 * Type-assurance method
	 */
	
	static function make( $callable, $default = 'MZ_Callables::func_lambda' ){
		if( is_callable( $callable ) )
			return $callable;
		return self::make( $default, 'MZ_Callables::func_lambda' );
	} // method MZ_Callables::make
	
	static function make_debug( $level, $callable, $default = 'MZ_Callables::func_lambda' ){
		if( is_callable( $callable ) )
			return $callable;
		MZ_Debug::log_if( $level, 'Not a callback: %s', print_r( $callback ) );
		return self::make_debug( MZ_Debug::LEVEL_VERBOSE, $default, 'MZ_Callables::func_lambda' );
	} // method MZ_Callables::make_log
	
	static function func_lambda(){
		// Does nothing
	} // method MZ_Callables::func_lambda
	
	static function filter_passthru( $arg ){
		return $arg;
	} // method MZ_Callables::filter_passthru
} // class MZ_Callables

MZ_Assure::library_only( __FILE__ );
