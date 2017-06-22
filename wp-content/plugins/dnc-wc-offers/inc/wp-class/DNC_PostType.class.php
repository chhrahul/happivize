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
 * Base class for custom post types
 */
class DNC_PostType{
	private /* string */ $postType;
	
	protected function __construct( /* string */ $postType ){
		$this->postType = $postType;
	} // method DNC_PostType::__construct
	
	public function __get( $name ){
		if( isset( $this->$name ) )
			return $this->$name;
		
		if( WP_DEBUG )
			error_log( sprintf( '[%s] Access to non-existent property: %s', __CLASS__, $name ) );
		
		return null;
	} // method DNC_PostType::__get
	
	/**
	 * @param WP_Post|int|null $id
	 * @return DNC_Post|null
	 */
	public static function getPost( $id = null ){
		$instance = static::getInstance();
		
		return $instance->getPost0( $id );
	}
	
	public static function initialize(){
		return static::getInstance();
	} // method DNC_PostType::initialize
	
	public static function getInstance(){
		static $instances = array();
		
		$calledClass = get_called_class();
		
		if( !isset( $instances[ $calledClass ] ) ){
			$ret = new static();
			
			if( did_action( 'init' ) > 0 )
				$ret->actionRegister();
			else
				add_action( 'init', array( $ret, 'actionRegister' ) );
		}else
			$ret = $instances[ $calledClass ];
		
		return $ret;
	} // method DNC_PostType::getInstance
	
	public static function prepareContent( $content ){
		return MZ_Strings::mb_str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
	} // method DNC_PostType::prepareContent
	
	public static function prepareTitle( $title ){
		return apply_filters( 'the_title', $title );
	} // method DNC_PostType::prepareTitle
	
	/**
	 * Wrap the given post in some appropriate DNC_Post subclass
	 *
	 * @param WP_Post $post
	 * @return DNC_Post
	 */
	protected function wrapPost( WP_Post $post ){
		return new DNC_Post( $post );
	} // method DNC_PostType::wrapPost
	
	/* protected */ function actionRegister(){
		static $registered = false;
		
		$oldRegistered = $registered;
		$registered = true;
		
		return !$oldRegistered;
	} // method DNC_PostType::actionRegister
	
	private function getPost0( $id ){
		$post = get_post( $id );
		
		if( !( $post instanceof WP_Post ) )
			return null;
		
		if( $this->postType !== $post->post_type ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Post is not of type "%s": %s', __CLASS__, $this->postType, var_export( $id, true ) ) );
			
			return null;
		} // endif $this->postType !== $post->post_type
		
		return $this->wrapPost( $post );
	} // method DNC_PostType::getPost0
} // class DNC_PostType
