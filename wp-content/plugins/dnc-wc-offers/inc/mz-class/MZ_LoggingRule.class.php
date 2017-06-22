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

final class MZ_LoggingRule {
	private $message_type;
	private $destination;
	private $extra_headers;
	private $backtrace_options;
	private $backtrace_limit;

	private static $default = null;
	
	static function get_default(){
		if( is_null( self::$default ) )
			self::$default = new MZ_LoggingRule();
		return self::$default;
	} // method MZ_LoggingRule::get_default
	
	private static $filters = array(
		'message_type' => array( 'is_int', 0 ),
		'destination' => array( 'is_string', '' ),
		'extra_headers' => array( 'is_string', '' ),
		'backtrace_options' => array( 'is_int', 1 ),
		'backtrace_limit' => array( 'is_int', 0 ),
	);
	
	function __construct( $message_type = 0, $destination = '', $extra_headers = '', $backtrace_options = null, $backtrace_limit = 0 ){
		$args = is_array( $message_type ) ? $message_type : func_get_args();
		foreach( self::$filters as $prop => $tmp ){
			list( $pred, $default ) = $tmp;
			$value = MZ_Arrays::isget( $prop, $args, $default );
			$this->$prop = call_user_func( $pred, $value ) ? $value : $default;
		} // foreach $prop => $tmp
	} // method MZ_LoggingRule::__construct
	
	function get_message_type(){
		return $this->message_type;
	} // method MZ_LoggingRule::get_message_type
	
	function get_destination(){
		return $this->destination;
	} // method MZ_LoggingRule::get_destination
	
	function get_extra_headers(){
		return $this->extra_headers;
	} // method MZ_LoggingRule::get_extra_headers
	
	function get_backtrace_options(){
		return $this->backtrace_options;
	} // method MZ_LoggingRule::get_backtrace_options
	
	function get_backtrace_limit(){
		return $this->backtrace_limit;
	} // method MZ_LoggingRule::get_backtrace_limit
} // class MZ_LoggingRule

MZ_Assure::library_only( __FILE__ );
