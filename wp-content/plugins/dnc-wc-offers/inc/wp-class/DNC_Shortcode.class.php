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
 * A base class to make implementation of shortcodes more consistent
 *
 * In addition to the obvious contractual requirements below, subclasses MUST provide a constant <tt>CANONICAL_NAME</tt> that will be used during registration.
 */
abstract class DNC_Shortcode{
	private static /* array( string => DNC_Shortcode ) */ $shortcodes = array();
	
	protected function __construct(){}
	
	/**
	 * Registers this shortcode under its preferred CANONICAL NAME
	 *
	 * @return DNC_Shortcode|false
	 */
	public static function register(){
		$constantName = sprintf( '%s::CANONICAL_NAME', get_called_class() );
		
		if( !defined( $constantName ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Undefined constant: %s', __CLASS__, $constantName ) );
			
			return false;
		} // !defined( $constantName )
		
		return static::alias( constant( $constantName ) );
	} // method DNC_Shortcode::register
	
	/**
	 * Registers this shortcode under the given name
	 *
	 * @param string $name A valid shortcode name
	 * @return DNC_Shortcode
	 */
	public static function alias( $name ){
		if( !isset( $shortcodes[ $name ] ) ){
			$instance = new static;
			add_shortcode( $name, array( $instance, 'hook' ) );
			$shortcodes[ $name ] = $instance;
		} // endif !isset( $shortcodes[ $name ] )
		
		return $shortcodes[ $name ];
	} // method DNC_Shortcode::alias
	
	/**
	 * Returns the registered instance of this shortcode, registering it if necessary
	 *
	 * Will fail if called directly on DNC_Shortcode &mdash; instead, call using a subclass' static context
	 *
	 * @return DNC_Shortcode|false
	 */
	public static function getInstance(){
		return static::register();
	} // method DNC_Shortcode::getInstance
	
	/**
	 * Performs the necessary processing of the shortcode proper
	 *
	 * @param string|array $atts
	 * @param string $content
	 * @param string $name
	 * @return string
	 */
	public abstract function hook( $atts, $content = '', $name = '' );
} // class DNC_Shortcode
