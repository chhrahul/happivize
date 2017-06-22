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
 * Extends return functionality to support non-null, non-false "failure" return values
 */
class MZ_Maybe {
	private /* any */ $inner;
	
	private static function getAbsent0(){
		static $absent = null;
		if( null === $absent )
			$absent = new stdClass();
		return $absent;
	} // method MZ_Maybe::getAbsent0
	
	protected function __construct( $inner ){
		$this->inner = $inner;
	} // method MZ_Maybe::__construct
	
	public function hasValue(){
		return self::getAbsent0() !== $this->inner;
	} // method MZ_Maybe::hasValue
	
	public function getValue( $default ){
		$absent = self::getAbsent0();
		assert( '$default !== $absent' );
		$inner = $this->inner;
		return ( $inner === $absent ) ? $default : $inner;
	} // method MZ_Maybe::getValue
	
	public function ifValue( $consumer ){
		if( !is_callable( $consumer ) )
			throw new InvalidArgumentException( sprintf( '[%s] Not callable: %s', __METHOD__, var_export( $consumer, true ) ) );
		$inner = $this->inner;
		if( self::getAbsent0() !== $inner )
			call_user_func( $consumer, $inner );
	} // method MZ_Maybe::ifValue
	
	public static function of( $value ){
		assert( 'self::getAbsent0() !== $value' );
		return new MZ_Maybe( $value );
	} // method MZ_Maybe::of
	
	public static function none(){
		static $none = null;
		if( null === $none )
			$none = new MZ_Maybe( self::getAbsent0() );
		return $none;
	} // method MZ_Maybe::none
} // class MZ_Maybe