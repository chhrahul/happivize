<?php
/*
Copyright (c) 2016 Designs and Codes

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
 * Base type for pseudo-extending WP_Post to better integrate CPT metas
 */
class DNC_Post{
	private /* WP_Post */ $post;
	
	protected function __construct( WP_Post $post ){
		$this->post = $post;
	} // method DNC_Post::__construct
	
	public function __isset( $name ){
		if( property_exists( $this, $name ) )
			return !is_null( $this->get0( $name ) );
		
		return isset( $this->post->$name );
	} // method DNC_Post::__isset
	
	public function __get( $name ){
		if( property_exists( $this, $name ) )
			return $this->get0( $name );
		
		$post = $this->post;
		
		if( property_exists( $post, $name ) )
			return $post->$name;
		
		if( WP_DEBUG )
			error_log( sprintf( '[%s] Property does not exist: %s', __CLASS__, $name ) );
		
		return null;
	} // method DNC_Post::__get
	
	public function __set( $name, $value ){
		if( property_exists( $this, $name ) ){
			$methodName = MZ_Strings::propertyNameSetter( $name );
			
			if( method_exists( $this, $methodName ) )
				$this->$methodName( $value );
			else
				$this->$name = $value;
			
			return;
		} // endif property_exists( $this, $name )
		
		$post = $this->post;
		
		if( property_exists( $post, $name ) ){
			$post->$name = $value;
			
			return;
		} // endif property_exists( $post, $name )
		
		if( WP_DEBUG )
			error_log( sprintf( '[%s] Property does not exist: %s', __CLASS__, $name ) );
		
		return;
	} // method DNC_Post::__set
	
	public function setPost( WP_Post $post ){
		throw new Exception( sprintf( '[%s] Unsupported Operation', __METHOD__ ) );
	} // method DNC_Post::setPost
	
	protected function normalizeProperty( $name ){
		return MZ_Strings::mb_camel_case( $name );
	} // method DNC_Post::normalizeProperty
	
	protected function getMetaKeyForProperty( $name ){
		return $this->post_type . '-' . $name;
	} // method DNC_Post::getMetaKeyForProperty( $name );
	
	private function get0( $name ){
		$methodName = MZ_Strings::propertyNameGetter( $name );
		
		return method_exists( $this, $methodName ) ? $this->$methodName() : $this->$name;
	} // method DNC_Post::get0
} // class DNC_Post
