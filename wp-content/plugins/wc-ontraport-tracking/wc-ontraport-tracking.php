<?php
/*
Plugin Name: WC Ontraport Tracking
Plugin URI: http://premiumwebservices.co.uk
Description: This plugin will add Ontraport Sales Tracking to WooCommerce
Version: 1.0.3
Author: Richard Bonk
Author URI: http://premiumwebservices.co.uk
*/

$api_url = 'http://premiumwebservices.co.uk/updates/update.php';
$plugin_slug = basename(dirname(__FILE__));

add_action( 'woocommerce_settings_start', 'ontraport_tracking_settings' );
function ontraport_tracking_settings() {
    global $woocommerce_settings;

    $woocommerce_settings['ontraport'] = array(
        array( 'type' => 'title', 'title' => __( 'Ontraport Tracking', 'woocommerce' ), 'desc' => '', 'id' => 'ontraport-options' ),

        array(
            'title'    => __( 'Ontraport Pixel Server', 'woocommerce' ),
            'desc'     => __( 'This is YOUR subdomain or the domain of your promo tool (e.g. pavelstepka.ontraport.net )', 'woocommerce' ),
            'id'       => 'ontraport_program',
            'type'     => 'text',
            'default'  => get_option('ontraport_program') ? get_option('ontraport_program') : ''
        ),

        array( 'type' => 'sectionend', 'id' => 'ontraport-options' ),
    );
}

add_filter( 'woocommerce_settings_tabs_array', 'ontraport_tracking_settings_tab', 50 );
function ontraport_tracking_settings_tab( $tabs ) {
    $tabs['ontraport'] = esc_html__( 'Ontraport', 'woocommerce' );
    return $tabs;
}

add_action( 'woocommerce_settings_tabs_ontraport', 'ontraport_tracking_settings_page' );
function ontraport_tracking_settings_page() {
    global $woocommerce_settings, $current_tab;
    woocommerce_admin_fields( $woocommerce_settings[$current_tab] );
}

add_action('woocommerce_update_options_ontraport', 'ontraport_tracking_save_settings');
function ontraport_tracking_save_settings() {
    global $woocommerce_settings, $current_tab;
    woocommerce_update_options( $woocommerce_settings[$current_tab] );
}


function ontraport_tracking_code($order_id) {
	global $woocommerce;
	$order = new WC_Order( $order_id );
	$ontraportcode = '<!-- Begin Ontraport Pixel Tracking -->';
	$ontraportcode .= '<IMG SRC="https://'.get_option('ontraport_program').'/p?order_id=';
	$ontraportcode .= str_replace("#","",urlencode( $order->get_order_number() ));
	$ontraportcode .= '&E-Mail=';
	$ontraportcode .= urlencode($order->billing_email);
	$ontraportcode .= '&First_Name=';
	$ontraportcode .= urlencode($order->billing_first_name);
	$ontraportcode .= '&Last_Name=';
	$ontraportcode .= urlencode($order->billing_last_name);
	if ( sizeof( $order->get_items() )>0 ) {
		$i = 1;
		foreach ( $order->get_items() as $item ) {
			$ontraportcode .= '&item_id_'.$i.'=';
			$ontraportcode .= get_post_meta($item['product_id'], '_sku', true);
			$ontraportcode .= '&item_external_id_'.$i.'=';
			$ontraportcode .= urlencode($item['name']);
			$ontraportcode .= '&item_qty_'.$i.'=';
			$ontraportcode .= $item['qty'];
			$ontraportcode .= '&item_price_'.$i.'=';
			$ontraportcode .= $item['line_subtotal']/$item['qty'];
			$i++;
		}
	}
	$ontraportcode .= '&Address=';
	$ontraportcode .= urlencode($order->billing_address_1);
	$ontraportcode .= '&Address_2=';
	$ontraportcode .= urlencode($order->billing_address_2);
	$ontraportcode .= '&City=';
	$ontraportcode .= urlencode($order->billing_city);
	$ontraportcode .= '&State=';
	$ontraportcode .= urlencode($order->billing_state);
	$ontraportcode .= '&Zip_Code=';
	$ontraportcode .= urlencode($order->billing_postcode);
	$ontraportcode .= '&Country=';
	$ontraportcode .= urlencode($order->billing_country);
	$ontraportcode .= '&shipping_amt=';
	$ontraportcode .= urlencode($order->order_shipping);
	$ontraportcode .= '&tax=';
	$ontraportcode .= urlencode(wc_round_tax_total( $order->get_cart_tax() + $order->get_shipping_tax() ));
	$ontraportcode .='" WIDTH="1" HEIGHT="1"/>
	<!-- End Ontraport Pixel Tracking -->';
	echo $ontraportcode;
}

add_action( 'woocommerce_thankyou', 'ontraport_tracking_code' );

if(!function_exists('check_for_plugin_update')) {
	function check_for_plugin_update($checked_data) {
		global $api_url, $plugin_slug;
		if (empty($checked_data->checked))
			return $checked_data;
		$request_args = array(
			'slug' => $plugin_slug,
			'version' => $checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php'],
		);
		$request_string = prepare_request('basic_check', $request_args);
		// Start checking for an update
		$raw_response = wp_remote_post($api_url, $request_string);
		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
			$response = unserialize($raw_response['body']);
		if (is_object($response) && !empty($response)) // Feed the update data into WP updater
			$checked_data->response[$plugin_slug .'/'. $plugin_slug .'.php'] = $response;
		return $checked_data;
	}
}

if(!function_exists('my_plugin_api_call')) {	
	function my_plugin_api_call($def, $action, $args) {
		global $plugin_slug, $api_url;
		if ($args->slug != $plugin_slug)
			return false;
		// Get the current version
		$plugin_info = get_site_transient('update_plugins');
		$current_version = $plugin_info->checked[$plugin_slug .'/'. $plugin_slug .'.php'];
		$args->version = $current_version;
		$request_string = prepare_request($action, $args);
		$request = wp_remote_post($api_url, $request_string);
		if (is_wp_error($request)) {
			$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
		} else {
			$res = unserialize($request['body']);
			
			if ($res === false)
				$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
		}
		return $res;
	}
}

if(!function_exists('prepare_request')) {
	function prepare_request($action, $args) {
		global $wp_version;
		return array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);	
	}
}
// Take over the Plugin info screen
add_filter('plugins_api', 'my_plugin_api_call', 10, 3);
// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'check_for_plugin_update');
?>