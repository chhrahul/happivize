<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

$user_email = $user_login;
$user       = get_user_by('login', $user_login);

if ( $user ) {
    $user_email = $user->user_email;
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p>You can login to your account to access all your programs and also securely store your payment methods to make it easier in the future.</p>

<p>Here is your login information:</p>

<p><?php printf( __( "<span style='display:none;'>Thanks for creating an account on %s.</span> Username: <strong>%s</strong>", 'woocommerce' ), esc_html( $blogname ), esc_html( $user_email ) ); ?></p>


<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

	<p><?php printf( __( "Password:  <strong>%s</strong>", 'woocommerce' ), esc_html( $user_pass ) ); ?></p>

<?php endif; ?>

<p>You can access your account area to view your orders and change your password here: <a style="color: #15c;" href="https://happivize.com/my-account/">My Account</a></p>

<p>For customer support, please reply to this email or contact <a style="color: #15c;" href="mailto:support@happivize.com">support@happivize.com</a></p>

