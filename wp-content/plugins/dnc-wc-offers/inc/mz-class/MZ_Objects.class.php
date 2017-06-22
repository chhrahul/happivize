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

final class MZ_Objects{
	/**
	 * Checkers
	 */
	 
	static function has( $prop, $obj ){
		return is_object( $obj ) && ( isset( $obj->$prop ) || property_exists( $obj, $prop ) );
	} // method MZ_Objects::has
	
	static function ishas( $prop, $obj ){
		return is_object( $obj ) && isset( $obj->$prop );
	} // method MZ_Objects::ishas
	
	/**
	 * Safe Getters
	 */
	
	static function get( $prop, $obj, $default ){
		return self::has( $prop, $obj ) ? $obj->$prop : $default;
	} // method MZ_Objects::get
	
	static function get_cb( $prop, $obj, $callback ){
		return self::has( $prop, $obj ) ? $obj->$prop : self::do_callback0( $prop, $obj, $callback );
	} // method MZ_Objects::get_cb
	
	static function isget( $prop, $obj, $default ){
		return self::ishas( $prop, $obj ) ? $obj->$prop : $default;
	} // method MZObjects::isget
	
	static function isget_cb( $prop, $obj, $callback ){
		return self::ishas( $prop, $obj ) ? $obj->$prop : self::do_callback0( $prop, $obj, $callback );
	} // method MZ_Objects::isget_cb
	
	/**
	 * Ensurers
	 */
	 
	static function ensure( $prop, $obj, $default ){
		if( self::has( $prop, $obj ) )
			return $obj->$prop;
		$obj->$prop = $default;
		return $default;
	} // method MZ_Objects::ensure
	
	static function ensure_cb( $prop, $obj, $callback ){
		if( self::has( $prop, $obj ) )
			return $obj->$prop;
		$value = self::do_callback0( $prop, $obj, $callback );
		$obj->$prop = $value;
		return $value;
	} // method MZ_Objects::ensure_cb
	
	static function isensure( $prop, $obj, $default ){
		if( self::ishas( $prop, $obj ) )
			return $obj->$prop;
		$obj->$prop = $default;
		return $default;
	} // method MZ_Objects::isensure
	
	static function isensure_cb( $prop, $obj, $callback ){
		if( self::ishas( $prop, $obj ) )
			return $obj->$prop;
		$value = self::do_callback0( $prop, $obj, $callback );
		$obj->$prop = $value;
		return $value;
	} // method MZ_Objects::isensure_cb
	
	static function get_reflection_class( $class ){
		static $classes = array();
		if( is_object( $class ) )
			$class = get_class( $class );
		else if( !is_string( $class ) )
			$class = '';
		
		if( !isset( $classes[ $class ] ) )
			$classes[ $class ] = new ReflectionClass( $class );
		return $classes[ $class ];
	} // method MZ_Objects::get_reflection_class
	
	static function find_caller( $where_mask = null, $where_goal = null ){
		if( !is_int( $where_mask ) )
			$where_mask = 0;
		if( !is_int( $where_goal ) )
			$where_goal = $where_mask;
		
		$allow_functions = ( ( ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_STATIC | ReflectionMethod::IS_FINAL ) & $where_mask ) === $where_goal;
		
		$backtrace = debug_backtrace( false );
		$length = count( $backtrace );
		for( $i = 1; $i < $length; ++$i ){
			$layer = $backtrace[ $i ];
			assert( 'isset( $layer[ \'function\' ] )' );
			$function = $layer[ 'function' ];
			if( isset( $layer[ 'class' ] ) ){
				$classname = $layer[ 'class' ];
				$class = self::get_reflection_class( $classname );
				assert( '$class->hasMethod( $function )' );
				$func = $class->getMethod( $function );
				assert( 'isset( $layer[ \'type\' ] )' );
				if( ( $func->getModifiers() & $where_mask ) === $where_goal )
					return $classname . $layer[ 'type' ] . $function;
			}else if( $allow_functions && function_exists( $function ) )
				return $function;
		} // for $i < $length
		return '<Unknown>';
	} // method MZ_Objects::find_caller
	
	static function find_public_caller(){
		return self::find_caller( ReflectionMethod::IS_PUBLIC );
	} // method MZ_Objects::find_public_caller
	
	static function get_reflection_function( $callable ){
		if( is_string( $callable ) ){
			if( false === mb_strpos( $callable, '::' ) )
				return new ReflectionMethod( $callable );
			$callable = MZ_Strings::mb_explode( '::', $callable, 2 );
		} // endif is_string( $callable )
		
		if( is_array( $callable ) ){
			$callable = array_values( $callable );
			$class = self::get_reflection_class( $callable[ 0 ] );
			return $class->getMethod( $callable[ 1 ] );
		} // endif is_array( $callable )
		
		// We've done what patch-ups we can
		return new ReflectionMethod( $callable );
	} // method MZ_Objects::get_reflection_function
	
	private static function do_callback0( $key, $array, $callback ){
		return call_user_func( MZ_Callables::make_debug( MZ_Debug::LEVEL_LOGIC_ERROR, $callback ), $key, $array );
	} // method MZ_Objects::do_callback0
} // class MZ_Objects

MZ_Assure::library_only( __FILE__ );
