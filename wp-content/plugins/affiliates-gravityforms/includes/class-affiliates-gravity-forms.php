<?php
/**
 * class-affiliates-gravity-forms.php
 * 
 * Copyright (c) 2014 - 2015 www.itthinx.com
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
 * @author itthinx
 * @package affiliates-gravityforms
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin main class.
 */
class Affiliates_Gravity_Forms {

	const PLUGIN_OPTIONS    = 'affiliates_gravityforms';
	const NONCE             = 'aff_gf_nonce';
	const SET_ADMIN_OPTIONS = 'set_admin_options';
	const REFERRAL_TYPE     = 'gform';

	private static $admin_messages = array();

	/**
	 * Activation handler.
	 */
	public static function activate() {
		$options = get_option( self::PLUGIN_OPTIONS , null );
		if ( $options === null ) {
			$options = array();
			// add the options and there's no need to autoload these
			add_option( self::PLUGIN_OPTIONS, $options, null, 'no' );
		}
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
	 * Initializes the integration if dependencies are verified.
	 */
	public static function init() {
		add_action( 'admin_notices', array( __CLASS__, 'admin_notices' ) );
		add_action( 'init', array( __CLASS__, 'wp_init' ) );
		if ( self::check_dependencies() ) {
			register_activation_hook( __FILE__, array( __CLASS__, 'activate' ) );
			include_once 'class-affiliates-gravity-forms-handler.php';
			if ( is_admin() ) {
				include_once 'class-affiliates-gravity-forms-form-settings.php';
			}
		}
	}

	/**
	 * Loads translations.
	 */
	public static function wp_init() {
		load_plugin_textdomain( AFF_GF_PLUGIN_DOMAIN, null, 'affiliates-gravityforms/languages' );
	}

	/**
	 * Check dependencies and print notices if they are not met.
	 * @return true if ok, false if plugins are missing
	 */
	public static function check_dependencies() {

		$result = true;

		$active_plugins = get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			$active_sitewide_plugins = get_site_option( 'active_sitewide_plugins', array() );
			$active_sitewide_plugins = array_keys( $active_sitewide_plugins );
			$active_plugins = array_merge( $active_plugins, $active_sitewide_plugins );
		}

		// required plugins
		$affiliates_is_active =
			in_array( 'affiliates/affiliates.php', $active_plugins ) ||
			in_array( 'affiliates-pro/affiliates-pro.php', $active_plugins ) ||
			in_array( 'affiliates-enterprise/affiliates-enterprise.php', $active_plugins );
		if ( !$affiliates_is_active ) {
			self::$admin_messages[] =
				"<div class='error'>" .
				__( 'The <strong>Affiliates Gravity Forms Integration</strong> plugin requires an appropriate Affiliates plugin: <a href="http://www.itthinx.com/plugins/affiliates" target="_blank">Affiliates</a>, <a href="http://www.itthinx.com/plugins/affiliates-pro" target="_blank">Affiliates Pro</a> or <a href="http://www.itthinx.com/plugins/affiliates-enterprise" target="_blank">Affiliates Enterprise</a>.', AFF_GF_PLUGIN_DOMAIN ) .
				"</div>";
		}

// 		$gf_is_active = in_array( 'gravityforms/gravityforms.php', $active_plugins );
// 		if ( !$gf_is_active ) {
// 			self::$admin_messages[] =
// 				"<div class='error'>" .
// 				__( 'The <strong>Affiliates Gravity Forms Integration</strong> plugin requires <a href="http://www.gravityforms.com" target="_blank">Gravity Forms</a>.', AFF_GF_PLUGIN_DOMAIN ) .
// 				"</div>";
// 		}
// 		if ( !$affiliates_is_active || !$gf_is_active ) {
// 			$result = false;
// 		}

		if ( !$affiliates_is_active ) {
			$result = false;
		}

		return $result;
	}
}
Affiliates_Gravity_Forms::init();
