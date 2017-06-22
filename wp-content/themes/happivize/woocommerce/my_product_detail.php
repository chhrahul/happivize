<?php 

echo $_GET['id'];

global $wpdb;

echo $query = "SELECT wp_woocommerce_order_itemmeta.*, wp_woocommerce_order_items.* FROM wp_woocommerce_order_items JOIN wp_woocommerce_order_itemmeta ON 'wp_woocommerce_order_itemmeta.order_item_id = wp_woocommerce_order_items.order_item_id' WHERE order_id = '".$_GET['id']."' ORDER BY wp_woocommerce_order_itemmeta.meta_key";


?>