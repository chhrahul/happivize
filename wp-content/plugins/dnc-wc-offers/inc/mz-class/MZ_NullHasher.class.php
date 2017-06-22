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

class MZ_NullHasher extends MZ_Hasher{
	public function partial_reset(){}
	
	public function partial_finish( $raw_output = false ){
		return '';
	} // method MZ_NullHasher::partial_finish
	
	public function partial_update_string( $data ){
		return true;
	} // method MZ_NullHasher::partial_update_string
	
	public function partial_update_file( $file, $context = null ){
		return true;
	} // method MZ_NullHasher::partial_update_file
	
	public function partial_update_stream( $stream, $length = -1 ){
		return true;
	} // method MZ_NullHasher::partial_update_stream
	
	public function hash_width( $raw_output = false ){
		return 0;
	} // method MZ_NullHasher::hash_width
	
	public function hash_string( $data, $raw_output = false ){
		return true;
	} // method MZ_NullHasher::hash_string
	
	public function hash_file( $file, $context = null, $raw_output = false ){
		return true;
	} // method MZ_NullHasher::hash_file
	
	public function hash_stream( $stream, $length = -1, $raw_output = false ){
		return true;
	} // method MZ_NullHasher::hash_stream
} // class MZ_NullHasher

MZ_Assure::library_only( __FILE__ );
