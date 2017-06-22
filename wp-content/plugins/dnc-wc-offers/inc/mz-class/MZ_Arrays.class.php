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

final class MZ_Arrays{
	/**
	 * Checkers
	 */
	
	static function has( $key, $array ){
		return is_array( $array ) && ( isset( $array[ $key ] ) || array_key_exists( $key, $array ) );
	} // method MZ_Arrays::has
	
	static function ishas( $key, $array ){
		return is_array( $array ) && isset( $array[ $key ] );
	} // method MZ_Arrays::has_ishas
	
	/**
	 * Safe Getters
	 */
	
	static function get( $key, $array, $default ){
		return self::has( $key, $array ) ? $array[ $key ] : $default;
	} // method MZ_Arrays::get
	
	static function get_cb( $key, $array, $callback ){
		return self::has( $key, $array ) ? $array[ $key ] : self::do_callback0( $key, $array, $callback );
	} // method MZ_Arrays::get_cb
	
	static function isget( $key, $array, $default ){
		return self::ishas( $key, $array ) ? $array[ $key ] : $default;
	} // method MZ_Arrays::isget
	
	static function isget_cb( $key, $array, $callback ){
		return self::ishas( $key, $array ) ? $array[ $key ] : self::do_callback0( $key, $array, $callback );
	} // method MZ_Arrays::isget_cb
	
	/**
	 * Ensurers
	 */
	 
	static function ensure( $key, $array, $default ){
		if( self::has( $key, $array ) )
			return $array[ $key ];
		$array[ $key ] = $default;
		return $default;
	} // method MZ_Arrays::ensure
	
	static function ensure_cb( $key, $array, $callback ){
		if( self::has( $key, $array ) )
			return $array[ $key ];
		$value = self::do_callback0( $key, $array, $callback );
		$array[ $key ] = $value;
		return $value;
	} // method MZ_Arrays::ensure_cb
	
	static function isensure( $key, $array, $default ){
		if( self::ishas( $key, $array ) )
			return $array[ $key ];
		$array[ $key ] = $default;
		return $default;
	} // method MZ_Arrays::isensure
	
	static function isensure_cb( $key, $array, $callback ){
		if( self::ishas( $key, $array ) )
			return $array[ $key ];
		$value = self::do_callback0( $key, $array, $callback );
		$array[ $key ] = $value;
		return $value;
	} // method MZ_Arrays::isensure_cb
	
	/**
	 * Type-assurance method
	 */
	
	static function make( $array, array $default = array() ){
		if( is_array( $array ) )
			return $array;
		return empty( $array ) ? $default : array( $array );
	} // method MZ_Arrays::make

	/**
	 * Like array_merge(), appends numeric-indexed keys.
	 * Unlike array_merge(), recursively (via merge_ex) appends string-indexed keys (instead of overwrite)
	 */
	static function merge_ex(){
		$args = func_get_args();
		$ret = array_shift( $args );
		foreach( $args as $arg ){
			if( is_array( $arg ) ){
				foreach( $array as $key => $value ){
					if( is_numeric( $key ) )
						$ret[] = $value;
					else
						$ret[ $key ] = isset( $ret[ $key ] ) ? self::merge_ex( $ret[ $key ], $value ) : $value;
				} // foreach $key => $value
			}else
				$ret[] = $arg;
		} // foreach $array
		return $ret;
	} // method MZ_Arrays::merge_ex
	
	/**
	 * Reduces an array to its unique values, without reordering them. Does not preserve keys. O(n^2)
	 */
	static function ordered_unique( array $array, $strict = false ){
		$unique = array();
		foreach( $array as $item )
			if( !in_array( $item, $unique, $strict ) )
				$unique[] = $item;
		return $unique;
	} // method MZ_Arrays::ordered_unique
	
	/**
	 * Reduces an array of strings to its unique values, without reordering them. Preserved keys. ~O( log( n ) )
	 */
	static function ordered_unique_strings( array $array ){
		return array_flip( array_flip( $array ) );
	} // method MZ_Arrays::ordered_unique_strings
	
	/**
	 * Converts the structure if $files from being {name => key => ( index => )? value} to { name => index => key => value }.
	 * Intended for use on $_FILES
	 */
	static function normalize_files( array &$files ){
		foreach( $files as &$component )
			self::normalize_files_component( $component );
	} // method MZ_Arrays::normalize_files
	
	/**
	 * Converts the structure of $component from { key => ( index => )? value to { index => key => value }
	 */
	static function normalize_files_component( array &$component ){
		static $fields = array(
			'name' => '',
			'type' => '',
			'tmp_name' => '',
			'error' => '4',
			'size' => '0',
		);
		$count_per = -1;
		foreach( $fields as $field => $default ){
			if( isset( $component[ $field ] ) ){
				$tmp = (array)$component[ $field ];
				$count_per = max( $count_per, count( $tmp ) );
				$$field = array_map( 'strval', $tmp );
			} // endif isset( $component[ $field ] )
		} // foreach $field => $default
		if( $count_per < 0 ) // None of the fields were set, so just return
			return;
		foreach( $fields as $field => $default )
			$$field = array_pad( ( isset( $$field ) ? (array)$$field : array() ), $count_per, $default );
		
		// Every field is now an equal-length array-of-string
		
		$tmp = array_fill( 0, $count_per, array() );
		foreach( $fields as $field => $default )
			foreach( $$field as $index => $value )
				$tmp[ $index ][ $field ] = $value;
		$component = $tmp;
	} // method MZ_Arrays::normalize_files_component
	
	private static function do_callback0( $key, $array, $callback ){
		return call_user_func( MZ_Callables::make_debug( MZ_Debug::LEVEL_LOGIC_ERROR, $callback ), $key, $array );
	} // method MZ_Arrays::do_callback0
	
	static function array_column( array $array, $column_key, $index_key = null ){
		$array = array_filter( 'is_array', $array );
		
		$ret = array();
		
		if( null === $index_key ){
			foreach( $array as $item )
				if( isset( $item[ $column_key ] ) )
					$ret[] = $item[ $column_key ];
		}else{
			foreach( $array as $item )
				if( isset( $item[ $column_key ] ) && isset( $item[ $index_key ] ) )
					$ret[ $item[ $index_key ] ] = $item[ $column_key ];
		} // endif null !== $index_key
		
		return $ret;
	} // method MZ_Arrays::array_column
	
	public static function remove( array $a, $b ){
		$args = func_get_args();
		
		foreach( array_slice( $args, 1 ) as $arg ){
			$key = array_search( $arg, $a, true );
			if( is_string( $key ) || is_int( $key ) )
				unset( $a[ $key ] );
		} // foreach $arg
		
		return $a;
	} // method MZ_Arrays::remove
	
	public static function append( $a, $b ){
		$args = func_get_args();
		
		return self::concat0( $args, false );
	} // method MZ_Arrays::append
	
	public static function prepend( $a, $b ){
		$args = func_get_args();
		
		return self::concat0( $args, true );
	} // method MZ_Arrays::prepend
	
	/**
	 * Select only the keys given by <code>$keys</code> from <code>$_context</code> for the return value.
	 *
	 * <code>$keys</code> may either be a string => mixed, or int => string.  In the former case, the value is used as the default value in the event that key is not contained in $_context.  In the latter, value is used as key and the default is null
	 */
	public static function selectForExtract( array $_context, array $keys ){
		$ret = array();
		
		foreach( $keys as $key => $value ){
			if( is_int( $key ) ){
				$key = (string)$value;
				$value = null;
			} // endif is_int( $key )
			
			$ret[ $key ] = self::isget( $key, $_context, $value );
		} // foreach $key => $value
		
		return $ret;
	} // method MZ_Arrays::selectForExtract
	
	/**
	 * Non-destructively shuffle an array, maintaining key associations
	 *
	 * @param array $array The array to shuffle
	 * @return array|false Returns <code>false</code> should the underlying shuffle fail
	 * @uses MZ_Arrays::shuffle()
	 */
	public static function shuffleAssoc( array $array ){
		return MZ_Arrays::shuffle( $array, true );
	} // method MZ_Arrays::shuffleAssoc
	
	/**
	 * Non-destructively shuffle an array, discarding key associations
	 *
	 * @param array $array The array to shuffle
	 * @return array|false Returns <code>false</code> should the underlying shuffle fail
	 * @uses MZ_Arrays::shuffle()
	 */
	public static function shuffleValues( array $array ){
		return self::shuffle( $array, false );
	} // method MZ_Arrays::shuffleValues
	
	/**
	 * Non-destructively shuffle an array, optionally maintaining key associations
	 *
	 * Based on http://php.net/manual/en/function.shuffle.php#94697
	 *
	 * @param array $array The array to shuffle
	 * @param bool $maintainAssociation Whether to maintain key association
	 * @return array|false Returns <code>false</code> should the underlying shuffle fail
	 * @uses array_keys()
	 * @uses shuffle()
	 */
	public static function shuffle( array $array, $maintainAssociation ){
		$keys = array_keys( $array );
		if( !shuffle( $keys ) )
			return false;
		
		$ret = array();
		foreach( $keys as $key )
			$ret[ $key ] = $array[ $key ];
		
		return $ret;
	} // method MZ_Arrays::shuffle
	
	private static function concat0( array $args, $reverse ){
		if( $reverse )
			$args = array_reverse( $args );
		
		foreach( $args as &$arg )
			if( !is_array( $arg ) )
				$arg = array( $arg );
		
		return call_user_func_array( 'array_merge', $args );
	} // method MZ_Arrays::concat0
} // class MZ_Arrays

MZ_Assure::library_only( __FILE__ );