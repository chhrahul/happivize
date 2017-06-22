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
 * Debug/logging,
 */

final class MZ_Debug{
	const LEVEL_OFF = 0;
	const LEVEL_CRITICAL = 0;
	const LEVEL_SECURITY = 1;
	const LEVEL_LOGIC_ERROR = 10;
	const LEVEL_FILE_ERROR = 20;
	const LEVEL_LOGIC_WARN = 60;
	const LEVEL_FILE_WARN = 70;
	const LEVEL_DEBUG = 75;
	const LEVEL_VERBOSE = 100;
	const LEVEL_DEBUG_VERBOSE = 100;
	const LEVEL_EXCESSIVE = 200;
	const LEVEL_VERBOSE_EXCESSIVE = 200;
	
	private static $level = 0;
	private static $level_stack = null;
	
	/**
	 * Timestamp of when a timed debug log entry was made
	 */
	private static $lastTime = null;
	
	static function is_debug(){
		return self::$level >= self::LEVEL_DEBUG;
	} // method MZ_Debug::is_debug
	
	static function get_level(){
		return self::$level;
	} // method MZ_Debug::get_level
	
	static function set_level( $level ){
		if( !is_int( $level ) || ( $level < 0 ) ){
			self::log_if( self::LEVEL_LOGIC_ERROR, 'Illegal debug level: %s', $level );
			return false;
		} // endif !is_int( $level )
		
		self::$level = $level;
		return true;
	} // method MZ_Debug::set_level
	
	static function push_level( $level ){
		$old_level = self::$level;
		if( !self::set_level( $level ) )
			return false;
		
		if( !is_array( self::$level_stack ) )
			self::$level_stack = array();
		self::$level_stack[] = $old_level;
		return true;
	} // method MZ_Debug::push_level
	
	static function pop_level(){
		if( !is_array( self::$level_stack ) )
			throw new PreconditionException();
		
		self::$level = array_pop( self::$level_stack );
		if( empty( self::$level_stack ) )
			self::$level_stack = null;
	} // method MZ_Debug::pop_level
	
	static function do_debug( $level, $callback ){
		if( !self::check_callback0( $callback ) )
			return false;
		if( !self::push_level( $level ) )
			return false;
		
		try{
			$args = func_get_args(); // Call inline requires PHP 5.3+
			$ret = call_user_func_array( $callback, array_slice( $args, 2 ) );
		}catch( Exception $e ){ // try/finally requires PHP 5.5+
			self::pop_level();
			throw $e;
		}
		self::pop_level();
		return $ret;
	} // method MZ_Debug::do_debug
	
	static function do_if( $required_level, $callback ){
		if( !self::check_callback0( $callback ) )
			return false;
		assert( 'is_int( $required_level )' );
		assert( 'is_bool( $backtrace )' );
		
		if( self::$level >= $required_level )
			call_user_func( $callback );
	} // method MZ_Debug::do_if
	
	private static function check_callback0( $callback ){
		if( is_callable( $callback ) )
			return true;
		self::log_if( self::LEVEL_LOGIC_ERROR, 'Invalid callback: %s', $callback );
		return false;
	} // method MZ_Debug::check_callback0
	
	static function debug_message( $required_level, $real_message, $fake_message = '' ){
		assert( 'is_int( $required_level )' );
		return ( self::$level >= $required_level ) ? $real_message : $fake_message;
	} // method MZ_Debug::debug_message
	
	private static $logging_rule = null;
	private static $logging_rule_stack = null;
	
	static function get_logging_rule(){
		return is_null( self::$logging_rule ) ? MZ_LoggingRule::get_default() : self::$logging_rule;
	} // method MZ_Debug::get_logging_rule
	
	static function set_logging_rule( MZ_LoggingRule $rule ){
		self::$logging_rule = $rule;
		return true;
	} // method MZ_Debug::set_logging_rule
	
	static function push_logging_rule( MZ_LoggingRule $rule ){
		$old_rule = self::get_logging_rule();
		if( !set_logging_rule( $rule ) )
			return false;
		
		if( !is_array( self::$logging_rule_stack ) )
			self::$logging_rule_stack = array();
		self::$logging_rule_stack[] = $old_rule;
		return true;
	} // method MZ_Debug::push_logging_rule
	
	static function pop_logging_rule(){
		if( !is_array( self::$logging_rule_stack ) )
			throw new PreconditionException();
		
		self::$logging_rule = array_pop( self::$logging_rule_stack );
		if( empty( self::$logging_rule_stack ) )
			self::$logging_rule_stack = null;
	} // method MZ_Debug::pop_logging_rule
	
	static function do_logging( MZ_LoggingRule $rule, $callback ){
		if( !self::check_callback0( $callback ) )
			return false;
		if( !self::push_logging_rule( $rule ) )
			return false;
		
		try{
			$args = func_get_args(); // Call inline requires PHP 5.3+
			$ret = call_user_func_array( $callback, array_slice( $args, 2 ) );
		}catch( Exception $e ){ // try/finally requires PHP 5.5+
			self::pop_logging_rule();
			throw $e;
		}
		self::pop_logging_rule();
		return $ret;
	} // method MZ_Debug::do_logging
	
	static function log( $format ){
		$args = func_get_args();
		$args = array_slice( $args, 1 );
		return self::vlog( $format, $args );
	} // method MZ_Debug::log
	
	static function log_bt( $format ){
		$args = func_get_args();
		$args = array_slice( $args, 1 );
		return self::vlog_bt( $format, $args );
	} // method MZ_Debug::log_bt
	
	static function log_timed( $format ){
		$args = func_get_args();
		
		return self::vlog_timed( $format, array_slice( $args, 1 ) );
	} // method MZ_Debug::log_timed
	
	static function log_if( $required_level, $format ){
		$args = func_get_args();
		$args = array_slice( $args, 2 );
		return self::vlog_if( $required_level, $format, $args );
	} // method MZ_Debug::log_if
	
	static function log_bt_if( $required_level, $format ){
		$args = func_get_args();
		$args = array_slice( $args, 2 );
		return self::vlog_bt_if( $required_level, $format, $args );
	} // method MZ_Debug::log_bt_if
	
	public static function log_timed_if( $required_level, $format ){
		$args = func_get_args();
		
		return self::vlog_timed_if( $required_level, $format, array_slice( $args, 2 ) );
	} // method MZ_Debug::log_timed_if
	
	static function log_switch( array $format_map ){
		$args = func_get_args();
		$args = array_slice( $args, 1 );
		return self::vlog_switch( $format_map, $args );
	} // method MZ_Debug::log_switch
	
	static function log_switch_bt( array $format_map ){
		$args = func_get_args();
		$args = array_slice( $args, 1 );
		return self::vlog_bt_switch( $format_map, $args );
	} // method MZ_Debug::log_switch_bt
	
	public static function log_switch_timed( array $formatMap ){
		$args = func_get_args();
		
		return self::vlog_timed_switch( $formatMap, array_slice( $args, 1 ) );
	} // method MZ_Debug::log_switch_timed
	
	static function vlog( $format, array $format_args = array() ){
		return self::vlog_if( self::LEVEL_OFF, $format, $format_args );
	} // method MZ_Debug::vlog
	
	static function vlog_bt( $format, array $format_args = array() ){
		return self::vlog_bt_if( self::LEVEL_OFF, $format, $format_args );
	} // method MZ_Debug::vlog_bt
	
	public static function vlog_timed( $format, array $formatArgs = array() ){
		return self::vlog_timed_if( self::LEVEL_OFF, $format, $formatArgs );
	} // method MZ_Debug::vlog_timed
	
	static function vlog_if( $required_level, $format, array $format_args = array() ){
		return self::vlog_switch( array( $required_level => $format ), $format_args );
	} // method MZ_Debug::vlog_if
	
	static function vlog_bt_if( $required_level, $format, array $format_args = array() ){
		return self::vlog_bt_switch( array( $required_level => $format ), $format_args );
	} // method MZ_Debug::vlog_bt_if
	
	public static function vlog_timed_if( $requiredLevel, $format, array $formatArgs = array() ){
		return self::vlog_timed_switch( array( $requiredLevel => $format ), $formatArgs );
	} // method MZ_Debug::vlog_timed_if
	
	static function vlog_switch( array $format_map, array $format_args = array() ){
		return self::do_log0( false, false, $format_map, $format_args );
	} // method MZ_Debug::vlog_switch
	
	static function vlog_bt_switch( array $format_map, array $format_args = array() ){
		return self::do_log0( false, true, $format_map, $format_args );
	} // method MZ_Debug::vlog_bt_switch
	
	static function vlog_timed_switch( array $formatMap, array $formatArgs = array() ){
		return self::do_log0( true, false, $formatMap, $formatArgs );
	} // method MZ_Debug::vlog_timed_switch
	
	private static function do_log0( $timed, $backtrace, array $formatMap, array $formatArgs ){
		if( empty( $formatMap ) )
			return false;
		
		$currentLevel = self::$level;
		$logArgs = self::prepare_log_args0();
		$found = false;
		
		foreach( $formatMap as $level => $format ){
			if( intval( $level ) > $currentLevel )
				continue;
			
			$found = true;
			
			if( !is_string( $format ) )
				continue;
			
			if( $timed ){
				$timed = false;
				$then = self::$lastTime;
				$now = microtime( true );
				
				if( null === $then )
					$then = $now;
				
				self::$lastTime = $now;
				
				$format = implode( ' ', array_filter( array(
					$format,
					sprintf( '[Since last: %f]', ( $now - $then ) ),
				) ) ); 
			} // endif $timed
			
			$tmp = vsprintf( $format, $formatArgs );
			
			if( empty( $tmp ) ){
				$tmp = sprintf( '[%s] Mismatch in params given vs params expected', __CLASS__ );
				$backtrace = true;
			} // endif empty( $tmp )
			
			$logArgs[ 0 ] = $tmp;
			call_user_func_array( 'error_log', $logArgs );
		} // foreach $level => $format
		
		if( !$found )
			return false;
		
		self::maybe_backtrace0( (bool)$backtrace );
		
		return true;
	} // method MZ_Debug::do_log0
	
	private static function prepare_log_args0(){
		static $rule_methods = array(
			'get_message_type',
			'get_destination',
			'get_extra_headers',
		);
		
		$rule = self::get_logging_rule();
		$ret = array( '' );
		foreach( $rule_methods as $rule_method )
			$log_args[] = $rule->$rule_method();
		return $ret;
	} // method MZ_Debug::prepare_log_args0
	
	private static function maybe_backtrace0( $backtrace ){
		if( $backtrace ){
			$rule = self::get_logging_rule();
			
			$backtrace = debug_backtrace( $rule->get_backtrace_options() );
			foreach( $backtrace as $index => $level ){
				if( !isset( $level[ 'class' ] ) || ( __CLASS__ !== $level[ 'class' ] ) )
					break;
				
				unset( $backtrace[ $index ] );
			} // foreach $index => $level
			
			$limit = $rule->get_backtrace_limit();
			if( $limit > 0 )
				$backtrace = array_slice( $backtrace, 0, $limit );
			
			error_log( print_r( $backtrace, true ), $rule->get_message_type(), $rule->get_destination(), $rule->get_extra_headers() );
		} // endif $backtrace
	} // method MZ_Debug::maybe_backtrace0
	
	/**
	 * @Deprecated
	 */
	static function is_debug_verbose(){
		return self::$level >= self::LEVEL_VERBOSE;
	} // method MZ_Debug::is_debug_verbose
} // class MZ_Debug

if( defined( 'DEBUG' ) )
	MZ_Debug::set_level( defined( 'DEBUG_VERBOSE' ) ? MZ_Debug::LEVEL_VERBOSE : MZ_Debug::LEVEL_DEBUG );

MZ_Assure::library_only( __FILE__ );
