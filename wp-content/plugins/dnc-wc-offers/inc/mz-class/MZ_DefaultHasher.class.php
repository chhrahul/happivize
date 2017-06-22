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
 * Provides a consistent interface for separating hash algo params from hash accumulation.
 */

class MZ_DefaultHasher extends MZ_Hasher{
	private /* array */ $args;
	private /* resource */ $hash = null;
	
	/**
	 * Same params as hash_init
	 */
	public function __construct( $algo, $options = 0, $key = null ){
		$this->args = func_get_args(); // Defer construction of hash resource until needed
	} // method MZ_DefaultHasher::__construct
	
	public function partial_reset(){
		if( !is_null( $this->hash ) ){
			hash_final( $this->hash );
			$this->hash = null;
		} // endif !is_null( $this->hash )
	} // method MZ_DefaultHasher::partial_reset
	
	public function partial_finish( $raw_output = false ){
		$ret = hash_final( $this->ensure0(), $raw_output );
		$this->hash = null;
		return $ret;
	} // method MZ_DefaultHasher::partial_finish
	
	public function partial_update_string( $data ){
		return hash_update( $this->ensure0(), $data );
	} // method MZ_DefaultHasher::partial_update_string
	
	public function partial_update_file( $file, $context = null ){
		return hash_update_file( $this->ensure0(), $file, $context );
	} // method MZ_DefaultHasher::partial_update_file
	
	public function partial_update_stream( $stream, $length = -1 ){
		return hash_update_stream( $this->ensure0(), $stream, $length ) !== false;
	} // method MZ_DefaultHasher::partial_update_stream
	
	private function ensure0(){
		if( is_null( $this->hash ) )
			$this->hash = call_user_func_array( 'hash_init', $this->args );
		return $this->hash;
	} // method MZ_DefaultHasher::ensure0
} // class MZ_DefaultHasher

MZ_Assure::library_only( __FILE__ );