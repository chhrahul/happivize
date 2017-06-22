<?php
/**
 * affiliates-products.php
 *
 * Copyright (c) 2012-2014 "kento" Karim Rahimpur www.itthinx.com
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
 *
 * Plugin Name: Affiliates Products
 * Plugin URI: http://www.itthinx.com/plugins/affiliates-products
 * Description: <a href="http://www.itthinx.com/plugins/affiliates-products/">Affiliates Products</a> allows to pay commissions to affiliates on product sales.
 * Version: 1.5.1
 * Author: itthinx
 * Author URI: http://www.itthinx.com
 */

define( 'AFFILIATES_PRODUCTS_VERSION', '1.5.1' );

if ( !function_exists( 'itthinx_plugins' ) ) {
	require_once 'itthinx/itthinx.php';
}
itthinx_plugins( __FILE__ );

define( 'AFFILIATES_PRODUCTS_FILE', __FILE__ );
define( 'AFFILIATES_PRODUCTS_PLUGIN_DOMAIN', 'affiliates' );
define( 'AFFILIATES_PRODUCTS_PLUGIN_URL', plugin_dir_url( AFFILIATES_PRODUCTS_FILE ) );

if ( !defined( 'AFFILIATES_PRODUCTS_CORE_DIR' ) ) {
	define( 'AFFILIATES_PRODUCTS_CORE_DIR', WP_PLUGIN_DIR . '/affiliates-products' );
}
if ( !defined( 'AFFILIATES_PRODUCTS_CORE_LIB' ) ) {
	define( 'AFFILIATES_PRODUCTS_CORE_LIB', AFFILIATES_PRODUCTS_CORE_DIR . '/lib/core' );
}
if ( !defined( 'AFFILIATES_PRODUCTS_ADMIN_LIB' ) ) {
	define( 'AFFILIATES_PRODUCTS_ADMIN_LIB', AFFILIATES_PRODUCTS_CORE_DIR . '/lib/admin' );
}
if ( !defined( 'AFFILIATES_PRODUCTS_COMP_LIB' ) ) {
	define( 'AFFILIATES_PRODUCTS_COMP_LIB', AFFILIATES_PRODUCTS_CORE_DIR . '/lib/comp' );
}
require_once( AFFILIATES_PRODUCTS_CORE_LIB . '/class-affiliates-products.php');
