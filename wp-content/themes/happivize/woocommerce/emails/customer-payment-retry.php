<?php
/**
 * Customer payment retry email
 *
 * @author	Prospress
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
<p style="text-align:center;margin-bottom:3% !important;font-size:17px;font-weight:bold;color:#000;">
	<?php
	// translators: %1$s: name of the blog, %2$s: lowercase human time diff in the form returned by wcs_get_human_time_diff(), e.g. 'in 12 hours'
	echo wp_kses( sprintf( _x( '(We will retry %2$s)', 'In customer renewal invoice email', 'woocommerce-subscriptions' ), esc_html( get_bloginfo( 'name' ) ), strtolower( wcs_get_human_time_diff( $retry->get_time() ) ) ), array( 'a' => array( 'href' => true ) ) );
	?>
</p>
<p>
	<?php
	// translators: %1$s: name of the blog, %2$s: lowercase human time diff in the form returned by wcs_get_human_time_diff(), e.g. 'in 12 hours'
	echo wp_kses( sprintf( _x( 'Hey, so for some reason your next payment didnt go through. Maybe a lost or expired card? If you could update your card by clicking below, that would be great!', 'In customer renewal invoice email', 'woocommerce-subscriptions' ), esc_html( get_bloginfo( 'name' ) ), strtolower( wcs_get_human_time_diff( $retry->get_time() ) ) ), array( 'a' => array( 'href' => true ) ) );
	?>
</p>
<style type="text/css"> .ii a[href] , #testpara a {color: #fff !important; text-decoration: none !important; padding: 1.4% 5.5% !important;background: #ff3366;border-radius: 2px; } </style>
<p style="text-align: center;margin-bottom: 9% !important; margin-top: 6% !important;" id="testpara">
	<?php
	// translators: %1$s %2$s: link markup to checkout payment url, note: no full stop due to url at the end
	echo wp_kses( sprintf( _x( '%1$sUpdate Payment Method %2$s', 'In customer renewal invoice email', 'woocommerce-subscriptions' ), '<a style="color:#fff !important; text-decoration: none !important; padding: 1.4% 5.5% !important;background: #ff3366;border-radius: 2px;" href="' . esc_url( $order->get_checkout_payment_url() ) . '">', '</a>' ), array( 'a' => array( 'href' => true ) ) );
	?>
</p>

<?php do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_footer', $email );
