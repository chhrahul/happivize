<?php

/*  Copyright 2014 Kevy

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
/*
  Plugin Name: Kevy eCommerce Analytics
  Plugin URI: http://www.kevy.com
  Description: Kevy is an Email Marketing Automation platform built uniquely for online retailers. We help you increase conversions, transactions and loyalty through creating personalized experiences for every shopper.
  Author: Kevy
  Author URI: http://www.kevy.com
  Version: 0.0.1
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

// Add the integration to WooCommerce
function wc_kevy_ecommerce_analytics_add_integration($integrations) {
  global $woocommerce;

  if (is_object($woocommerce)) {
    include_once( 'includes/class-wc-kevy-ecommerce-analytics-integration.php' );
    $integrations[] = 'WC_Kevy_Ecommerce_Analytics';
  }
  return $integrations;
}

add_filter('woocommerce_integrations', 'wc_kevy_ecommerce_analytics_add_integration', 10);

//plugin action links on plugin page
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'kevy_plugin_action_links');

function kevy_plugin_action_links($links) {
  global $woocommerce;
  if (version_compare($woocommerce->version, "2.1", ">=")) {
    $setting_url = 'admin.php?page=wc-settings&tab=integration';
  } else {
    $setting_url = 'admin.php?page=woocommerce_settings&tab=integration';
  }
  $links[] = '<a href="' . get_admin_url(null, $setting_url) . '">Settings</a>';
  $links[] = '<a href="https://kevy.com" target="_blank">FAQ</a>';
  return $links;
}

?>
