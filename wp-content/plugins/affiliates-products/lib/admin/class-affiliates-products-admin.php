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
 * Admin section.
 */
class Affiliates_Products_Admin {

	const NONCE = 'affiliates-products-admin-nonce';

	/**
	 * Admin setup.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
	}

	/**
	 * Adds the admin section.
	 */
	public static function admin_menu() {

		$pages = array();

		// main
		$page = add_menu_page(
			__( 'Affiliates Products', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
			__( 'Affiliates Products', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ),
			AFFILIATES_ADMINISTER_OPTIONS,
			'affiliates-products',
			array( __CLASS__, 'affiliates_products' ),
			AFFILIATES_PRODUCTS_PLUGIN_URL . '/images/affiliates-products.png'
		);
		$pages[] = $page;

		add_action( 'admin_print_styles-' . $page, 'affiliates_admin_print_styles' );
		add_action( 'admin_print_scripts-' . $page, 'affiliates_admin_print_scripts' );

		add_action( 'admin_print_styles-' . $page, array( __CLASS__, 'admin_print_styles' ) );
		add_action( 'admin_print_scripts-' . $page, array( __CLASS__, 'admin_print_scripts' ) );

	}


	/**
	 * Admin CSS.
	 */
	public static function admin_init() {
		wp_register_style( 'affiliates_products_admin', AFFILIATES_PRODUCTS_PLUGIN_URL . 'css/affiliates_products_admin.css', array(), AFFILIATES_PRODUCTS_VERSION );
	}

	/**
	 * Admin styles.
	 */
	public static function admin_print_styles() {
		wp_enqueue_style( 'affiliates_products_admin' );
	}

	/**
	 * Loads scripts.
	 */
	public static function admin_print_scripts() {
// 		wp_enqueue_script( 'affiliates_products_admin', GROUPS_SUBSCRIPTIONS_PLUGIN_URL . 'js/affiliates_products_admin.js', array(), AFFILIATES_PRODUCTS_VERSION );
	}

	/**
	 * Renders the admin section.
	 */
	public static function affiliates_products() {

		if ( !current_user_can( AFFILIATES_ADMINISTER_OPTIONS ) ) {
			wp_die( __( 'Access denied.', AFFILIATES_ADMINISTER_OPTIONS ) );
		}

		$options = get_option( 'affiliates_products', null );
		if ( $options === null ) {
			if ( add_option( 'affiliates_products', array(), null, 'no' ) ) {
				$options = get_option( 'affiliates_products' );
			}
		}


		echo '<div class="affiliates-products">';

		echo '<h2>' . __( 'Affiliates Products', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</h2>';

		echo '<p class="description">' . __( '<a href="http://www.itthinx.com/plugins/affiliates-products/">Affiliates Products</a> allows to pay commissions to affiliates on product sales.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</p>';

		//
		// Components
		//

		echo '<h3>' . __( 'Components', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</h3>';

		$components = Affiliates_Products_Components::get_components();

		echo '<div class="manage">';
		if ( count( $components ) > 0 ) {
			echo '<ul>';
			foreach( $components as $component ) {
				echo '<li>' . $component['name'] . '</li>';
			}
			echo '</ul>';
		} else {
			echo '<p>' . __( 'There are no components available.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</p>';
		}
		echo '</div>';

		//
		// General Settings
		//

		$options = get_option( 'affiliates_products', array() );
		if ( isset( $_POST['submit'] ) ) {
			if ( wp_verify_nonce( $_POST[self::NONCE], 'set' ) ) {
				$options['auto_assign_to_author'] = isset( $_POST['auto_assign_to_author'] );
				$default_rate = 0;
				if ( isset( $_POST['default_rate'] ) ) {
					$default_rate = bcadd( '0', $_POST['default_rate'], Affiliates_Products_Base::DECIMALS );
					if ( bccomp( $default_rate, '1', Affiliates_Products_Base::DECIMALS ) > 0 ) {
						$default_rate = '1.00';
					}
					if ( bccomp( $default_rate, '0', Affiliates_Products_Base::DECIMALS ) <= 0 ) {
						$default_rate = '0';
					}
				} 
				$options['default_rate'] = $default_rate;
				update_option( 'affiliates_products', $options );
			}
		}
		$auto_assign_to_author = isset( $options['auto_assign_to_author'] ) ? $options['auto_assign_to_author'] : false;
		$default_rate          = isset( $options['default_rate'] ) ? $options['default_rate'] : 0;

		echo
			'<form action="" name="options" method="post">' .
			'<div>';

		echo '<h3>' . __( 'Settings', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</h3>';

		echo
			'<p>' .
			'<label>' .
			'<input type="checkbox" name="auto_assign_to_author" ' . ( $auto_assign_to_author ? ' checked="checked" ' : '' ) . ' />' .
			' ' . __( 'Automatically assign new products to their author.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) .
			'</label>' .
			'</p>';

		echo
			'<p>' .
			'<label>' .
			'<input type="text" name="default_rate" value="' . esc_attr( $default_rate ) . '" />' .
			' ' . __( 'Default rate, if a default rate other than 0 is set, it will automatically be assigned to new products. Example: Use <em>0.2</em> for a 20% default commission rate.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) .
			'</label>' .
			'</p>';


		echo
			'<p>' .
			wp_nonce_field( 'set', self::NONCE, true, false ) .
			'<input class="button" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '"/>' .
			'</p>';

		echo
			'</div>' .
			'</form>';

		echo '<p class="description">' . __( 'Your e-commerce system must be activated for its supporting component to be enabled. Once it is activated, you can set commission rates by product and relate products to affiliates who will be granted with the appropriate commission when their products are sold.', AFFILIATES_PRODUCTS_PLUGIN_DOMAIN ) . '</p>'; 

		echo '</div>'; // .affiliates-products
	}
}
Affiliates_Products_Admin::init();
