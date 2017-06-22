<?php
/**
 * class-affiliates-products.php
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
 * Boot.
 */
class Affiliates_Products {

	private static $admin_messages = array();

	/**
	 * Put hooks in place and activate.
	 */
	public static function init() {
		register_activation_hook( AFFILIATES_PRODUCTS_FILE, array( __CLASS__, 'activate' ) );
		register_deactivation_hook( AFFILIATES_PRODUCTS_FILE, array( __CLASS__, 'deactivate' ) );
// 		register_uninstall_hook( AFFILIATES_PRODUCTS_FILE, array( __CLASS__, 'uninstall' ) );
		add_action( 'admin_notices', array( __CLASS__, 'admin_notices' ) );
		if ( self::check_dependencies() ) {
			require_once( AFFILIATES_PRODUCTS_COMP_LIB . '/class-affiliates-products-components.php');
			if ( is_admin() ) {
				require_once( AFFILIATES_PRODUCTS_ADMIN_LIB . '/class-affiliates-products-admin.php');
			}
		}
	}

	/**
	 * Activate plugin.
	 * 
	 * @param boolean $network_wide
	 */
	public static function activate( $network_wide = false ) {
	}

	/**
	 * Deactivate plugin.
	 * 
	 * @param boolean $network_wide
	 */
	public static function deactivate( $network_wide = false ) {
	}

	/**
	 * Uninstall plugin.
	 */
	public static function uninstall() {
		delete_option( 'affiliates_products' );
	}

	/**
	 * Prints admin notices.
	 */
	public static function admin_notices() {
		if ( !empty( self::$admin_messages ) ) {
			foreach ( self::$admin_messages as $msg ) {
				echo $msg;
			}
		}
	}

	/**
	 * Check plugin dependencies and nag if they are not met.
	 * @param boolean $disable disable the plugin if true, defaults to false
	 */
	public static function check_dependencies( $disable = false ) {
		$result = true;
		$active_plugins = get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			$active_sitewide_plugins = get_site_option( 'active_sitewide_plugins', array() );
			$active_sitewide_plugins = array_keys( $active_sitewide_plugins );
			$active_plugins = array_merge( $active_plugins, $active_sitewide_plugins );
		}
		$affiliates_is_active =
			in_array( 'affiliates/affiliates.php', $active_plugins ) ||
			in_array( 'affiliates-pro/affiliates-pro.php', $active_plugins ) ||
			in_array( 'affiliates-enterprise/affiliates-enterprise.php', $active_plugins );
		if ( !$affiliates_is_active ) {
			self::$admin_messages[] = "<div class='error'>" . __( '<em>Affiliates Products</em> needs the <a href="http://www.itthinx.com/plugins/affiliates/" target="_blank">Affiliates</a>, <a href="http://www.itthinx.com/plugins/affiliates-pro/" target="_blank">Affiliates Pro</a> or <a href="http://www.itthinx.com/plugins/affiliates-enterprise/" target="_blank">Affiliates Enterprise</a> plugin. Please install and activate it.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . "</div>";
		}
		if ( !$affiliates_is_active ) {
			if ( $disable ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				deactivate_plugins( array( __FILE__ ) );
			}
			$result = false;
		}
		return $result;
	}
}
Affiliates_Products::init();
