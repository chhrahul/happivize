<?php
/**
 * Additional Customer Details
 *
 * This is extra customer data which can be filtered by plugins. It outputs below the order item table.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
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

?>
<p style="color: #505050 !important; margin-bottom: 2% !important;font-weight: bold;font-size: 18px; "><?php _e( 'Billing Information:', 'woocommerce' ); ?></p>
     <p class="text" style="margin:0px !important;color: #000 !important;font-family: arial,sans-serif !important; font-size: 13px;">
     <?php foreach ( $fields as $field ) : ?>
       <?php //echo wp_kses_post( $field['label'] ); ?><?php echo wp_kses_post( $field['value'] ); ?><br />
    <?php endforeach; ?>
    </p>

