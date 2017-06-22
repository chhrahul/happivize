<?php
/**
 * class-affiliates-products-admin.php
 *
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is provided subject to the license granted.
 * Unauthorized use and distribution is prohibited.
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package affiliates-products
 * @since affiliates-products 1.0.0
 */

/**
 * Component controller.
 */
class Affiliates_Products_Components {

	private static $components = array();

	/**
	 * Loads components
	 */
	public static function init() {
		require_once( AFFILIATES_PRODUCTS_COMP_LIB . '/i-affiliates-products-component.php' );
		// scan comp folder
		$files = scandir( dirname( __FILE__ ) );
		foreach( $files as $file ) {
			if ( strrpos( $file, '.php' ) === strlen( $file ) - 4 ) {
				include_once( $file );
			}
		}
	}

	public static function register_component( $system, $name, $class, $file ) {
		self::$components[$system] = array(
			'name'  => $name,
			'class' => $class,
			'file'  => $file
		);
	}

	public static function get_components() {
		return self::$components;
	}
}
Affiliates_Products_Components::init();
