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

abstract class MZ_Hasher{
	public abstract function partial_reset();
	public abstract function partial_finish( $raw_output = false );
	public abstract function partial_update_string( $data );
	
	public function partial_update_file( $file, $context = null ){
		$data = @file_get_contents( $file, false, $context );
		if( $data !== false )
			return $this->partial_update_string( $data );
		MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_ERROR, 'Could not read file for hashing: %s', $file );
		return false;
	} // method MZ_Hasher::partial_update_file
	
	public function partial_update_stream( $stream, $length = -1 ){
		$data = stream_get_contents( $stream, $length );
		if( $data !== false )
			return $this->partial_update_string( $data );
		MZ_Debug::log_if( MZ_Debug::LEVEL_FILE_WARN, 'Could not read stream for hasing: %s', $stream );
		return false;
	} // method MZ_Hasher::partial_update_stream
	
	public function hash_width( $raw_output = false ){
		return MZ_Strings::byte_len( $this->hash_string( '' ), $raw_output );
	} // method MZ_Hasher::hash_width
	
	public function hash_string( $data, $raw_output = false ){
		$tmp = clone $this;
		$tmp->partial_reset(); // jic
		return $tmp->partial_update_string( $data ) ? $tmp->partial_finish( $raw_output ) : false;
	} // method MZ_Hasher::hash_string
	
	public function hash_file( $file, $context = null, $raw_output = false ){
		$tmp = clone $this;
		$tmp->partial_reset(); // jic
		return $tmp->partial_update_file( $file, $context ) ? $tmp->partial_finish( $raw_output ) : false;
	} // method MZ_Hasher::hash_file
	
	public function hash_stream( $stream, $length = -1, $raw_output = false ){
		$tmp = clone $this;
		$tmp->partial_reset(); // jic
		return $tmp->partial_update_stream( $stream, $length ) ? $tmp->partial_finish( $raw_output ) : false;
	} // method MZ_Hasher::hash_stream
} // class MZ_Hasher

MZ_Assure::library_only( __FILE__ );