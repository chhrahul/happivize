<?php
/**
 * Customer renewal invoice email
 *
 * @author	Brent Shepherd
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 1.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php if ( 'pending' == $order->get_status() ) : ?>
	<style type="text/css"> .ii a[href] , #testpara a {color: #fff !important; text-decoration: none !important;     padding: 1.4% 5.5% !important;background: #ff3366;border-radius: 2px; } </style>
	<p>Hey, so for some reason your next payment didnt go through. Maybe a lost or expired card?  If you could update your card by clicking below, that would be great!		
	</p>
	<p style="text-align: center;margin-bottom: 9% !important; margin-top: 6% !important;" id="testpara">
		<?php
		// translators: %1$s: name of the blog, %2$s: link to checkout payment url, note: no full stop due to url at the end
		echo wp_kses( sprintf( _x( '%2$s', 'In customer renewal invoice email', 'woocommerce-subscriptions' ), esc_html( get_bloginfo( 'name' ) ), '<a style="color:#fff !important; text-decoration: none !important; padding: 1.4% 5.5% !important;background: #ff3366;border-radius: 2px;" href="' . esc_url( $order->get_checkout_payment_url() ) . '">' . esc_html__( 'Update Payment Method', 'woocommerce-subscriptions' ) . '</a>' ), array( 'a' => array( 'href' => true ) ) );
		?>
	</p>
<?php elseif ( 'failed' == $order->get_status() ) : ?>
	<style type="text/css"> .ii a[href] , #testpara a {color: #fff !important; text-decoration: none !important;     padding: 1.4% 5.5% !important;background: #ff3366;border-radius: 2px; } </style>
	<p>The automatic payment to renew your subscription has been failed. To reactivate the subscription, please login and pay for the renewal from your account page.	
	</p>
	<p style="text-align: center;margin-bottom: 9% !important; margin-top: 6% !important;" id="testpara">
		<?php
		// translators: %1$s: name of the blog, %2$s: link to checkout payment url, note: no full stop due to url at the end
		echo wp_kses( sprintf( _x( '%2$s', 'In customer renewal invoice email', 'woocommerce-subscriptions' ), esc_html( get_bloginfo( 'name' ) ), '<a href="' . esc_url( $order->get_checkout_payment_url() ) . '">' . esc_html__( 'Update Payment Method', 'woocommerce-subscriptions' ) . '</a>' ), array( 'a' => array( 'href' => true ) ) ); ?></p>
<?php endif; ?>

<?php do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
