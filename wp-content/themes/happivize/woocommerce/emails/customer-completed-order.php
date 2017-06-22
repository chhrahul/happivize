<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php printf( __( "Hi there. Your recent order on %s has been completed. Your order details are shown below for your reference:", 'woocommerce' ), get_option( 'blogname' ) ); ?></p>

<?php

global $wpdb;

$ordl = array();

$orderi = new WC_Order( $order->id );
$items = $orderi->get_items();
foreach ( $items as $item ) {
 
 array_push($ordl,$item['product_id']);
 
}
$order_status = $orderi->get_status();

for($k = 0; $k < count($ordl); $k++){
   	$download['instruction']        =      get_post_meta($ordl[$k],'product_Instruction' ,TRUE);
   	$download['instructionfull']    =      get_post_meta($ordl[$k],'product_Instruction2' ,TRUE);
 
   	global $wpdb;

	$qry = "select meta_value from hp_postmeta where post_id = '".$ordl[$k]."' and meta_key = '_regular_price'";
	$kl = $wpdb->get_row($qry);

  	$qry1 = "select meta_value from hp_postmeta where post_id = '".$order->id."' and meta_key = '_order_total'";
  	$k2 = $wpdb->get_row($qry1);
	
	$myvalues = get_post_meta($ordl[$k],'_wcsatt_schemes',true);
	if($myvalues){ 
		foreach ($myvalues as $myvalue) { 
			$products_subs_price = $myvalue['subscription_regular_price'];
			$products_regular_price = $kl->meta_value;
			if($products_subs_price){
				$order = wc_get_order( $order->id );

				$items_list = $order->get_items();    
				foreach ( $items_list as $item_id => $item_data ) {
					$item_total = $order->get_item_meta($item_id, '_line_subtotal', true);             
					if($item_total == $products_regular_price){ 
						$prdct_name = $item_data['name']; 
						if(!empty($download['instruction'] )){

							echo "<h2>Product Instruction<span style='font-size: 12px;'> (".$prdct_name.")</span></h2>";
							echo "<p>".$download['instruction']."</p>";
						}
					}
					elseif($item_total == $products_subs_price){
						$prdct_name = $item_data['name'];             
						if(!empty($download['instructionfull'] )){
							echo "<h2>Product Instruction<span style='font-size: 12px;'> (".$prdct_name.")</span></h2>";
							echo "<p>".$download['instructionfull']."</p>";
						}
					}
				}
			}
		}
	}
	else{
        if(!empty($download['instruction'] )){
            echo "<h2>Product Instruction</h2>";
            echo "<p>".$download['instruction']."</p>";
        }	        
	}
}

/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
