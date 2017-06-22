<?php
/**
 * class-affiliates-gravity-forms-form-settings.php
 * 
 * Copyright (c) 2014 - 2015 www.itthinx.com
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
 * @author itthinx
 * @package affiliates-gravityforms
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Affiliates form settings.
 */
class Affiliates_Gravity_Forms_Form_Settings {

	const NONCE = 'affiliates-form-settings-nonce';
	const SAVE  = 'affiliates-form-settings-save';

	private static $amount_decimals = 2;
	private static $rate_decimals = 4;

	/**
	 * Initialization action on WordPress init.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'wp_init' ) );
	}

	/**
	 * Adds the Affilites settings section.
	 */
	public static function wp_init() {
		if ( current_user_can( AFFILIATES_ADMINISTER_OPTIONS ) ) {
			add_filter( 'gform_form_settings_menu', array( __CLASS__, 'gform_form_settings_menu' ) );
			add_action( 'gform_form_settings_page_affiliates', array( __CLASS__, 'gform_form_settings_page_affiliates' ) );
			self::$amount_decimals = intval( apply_filters( 'affiliates_gravityforms_form_amount_decimals', self::$amount_decimals ) );
			self::$rate_decimals = intval( apply_filters( 'affiliates_gravityforms_form_rate_decimals', self::$rate_decimals ) );
		}
	}

	/**
	 * Adds the Affiliates section to the Form Settings.
	 * 
	 * @param array $menu_items
	 * @return array of menu items
	 */
	public static function gform_form_settings_menu( $menu_items ) {
		$menu_items[] = array(
			'name' => 'affiliates',
			'label' => __( 'Affiliates', AFF_GF_PLUGIN_DOMAIN )
		);
		return $menu_items;
	}

	/**
	 * Renders the Affiliates section.
	 */
	public static function gform_form_settings_page_affiliates() {

		$form_id = isset( $_GET['id'] ) ? $_GET['id'] : null;
		if ( $form = RGFormsModel::get_form_meta( $form_id ) ) {

			GFFormSettings::page_header();

			$output = '';

			if ( isset( $_POST['affiliates-save'] ) ) {
				if ( wp_verify_nonce( $_POST[self::NONCE], self::SAVE ) ) {

					$form['affiliates']['register'] = !empty( $_POST['affiliates-register'] );

					$form['affiliates']['enabled'] = !empty( $_POST['affiliates-enabled'] );

					if ( !empty( $_POST['affiliates-amount'] ) ) {
						$form['affiliates']['amount'] = bcadd( $_POST['affiliates-amount'], '0', self::$amount_decimals );
					} else {
						unset( $form['affiliates']['amount'] );
					}

					if ( !empty( $_POST['affiliates-rate'] ) ) {
						$form['affiliates']['rate'] = bcadd( $_POST['affiliates-rate'], '0', self::$rate_decimals );
					} else {
						unset( $form['affiliates']['rate'] );
					}

					$form['affiliates']['is_base_amount'] = !empty( $_POST['affiliates-is-base-amount'] );

					if ( RGFormsModel::update_form_meta( $form_id, $form ) ) {
						$output .= '<div class="updated below-h2"><p><strong>' . __( 'The settings have been saved.', AFF_GF_PLUGIN_DOMAIN ) . '</strong></p></div>';
					}

				}
			}

			$affiliates_register = isset( $form['affiliates']['register'] ) ? $form['affiliates']['register'] : false;
			$affiliates_enabled = isset( $form['affiliates']['enabled'] ) ? $form['affiliates']['enabled'] : false;
			$affiliates_amount  = isset( $form['affiliates']['amount'] ) ? $form['affiliates']['amount'] : '';
			$affiliates_rate    = isset( $form['affiliates']['rate'] ) ? $form['affiliates']['rate'] : '';
			$affiliates_is_base_amount = isset( $form['affiliates']['is_base_amount'] ) ? $form['affiliates']['is_base_amount'] : false;

			$output .= '<div class="affiliates-form-settings">';

			$output .= '<form method="post">';
			$output .= '<div>';

			$output .= '<h3>';
			$output .= __( 'Affiliate Registration', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h3>';

			$output .= '<h4>';
			$output .= __( 'Register an Affiliate Account', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h4>';
			$output .= '<p>';
			$output .= __( 'Create an affiliate account for new users who register through this form?', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';
			$output .= '<label>';
			$output .= sprintf( '<input type="checkbox" name="affiliates-register" %s />', $affiliates_register ? ' checked="checked" ' : '' );
			$output .= ' ';
			$output .= __( 'Enabled', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</label>';
			$output .= '<p>';
			$output .= __( 'If enabled, an affiliate account will be created for new users registered with this form.', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= __( 'This <strong>requires</strong> the <em>Gravity Forms User Registration Add-On</em> and the form to be enabled for user registration, otherwise it will have no effect.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';

			$output .= '<br/>';

			$output .= '<h3>';
			$output .= __( 'Referral Settings', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h3>';

			$output .= '<h4>';
			$output .= __( 'Enable', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h4>';
			$output .= '<p>';
			$output .= __( 'Enable the Affiliates integration for this form?', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';
			$output .= '<label>';
			$output .= sprintf( '<input type="checkbox" name="affiliates-enabled" %s />', $affiliates_enabled ? ' checked="checked" ' : '' );
			$output .= ' ';
			$output .= __( 'Enabled', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</label>';
			$output .= '</p>';
			$output .= __( 'If enabled, referrals are recorded for form submissions that have been referred by an affiliate.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';

			$output .= '<h4>';
			$output .= __( 'Referral Amount', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h4>';

			$output .= '<label>';
			$output .= __( 'Amount', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= sprintf( '<input type="text" name="affiliates-amount" value="%s" />', esc_attr( $affiliates_amount ) );
			$output .= '</label>';

			$output .= '<p>';
			$output .= __( 'The referral amount is granted to the referring affiliate on each form submission.', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= __( 'Indicating an amount here is <strong>optional</strong>, as the referral amount that is credited depends on the following rules, listed in order of precedence:', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';

			$output .= '<ol>';
			$output .= '<li>';
			$output .= __( 'If an amount is set here, it will be used as the referral amount.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</li>';
			$output .= '<li>';
			$output .= __( 'If the amount is left empty and a payment amount can be obtained for the submitted form, the form\'s payment amount will be used.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</li>';
			$output .= '<li>';
			$output .= __( 'If the amount is left empty and the order total can be obtained for the submitted form, the order total will be used.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</li>';
			$output .= '</ol>';

			$output .= '<h4>';
			$output .= __( 'Referral Rate', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h4>';
			$output .= '<p>';
			$output .= __( 'The referral rate for this form.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';
			$output .= '<label>';
			$output .= __( 'Rate', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= sprintf( '<input type="text" name="affiliates-rate" value="%s" />', esc_attr( $affiliates_rate ) );
			$output .= '</label>';
			$output .= '<p>';
			$output .= __( 'If a rate is provided here, the referral amount is obtained by multiplying the amount (or the form\'s payment or order amount) by this rate.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';
			$output .= '<p>';
			$output .= __( 'For example, to grant a <strong>10%</strong> commission, indicate <strong>0.1</strong>.', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= __( 'This setting should be left empty, if the full amount should be granted as the referral amount.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';

			$output .= '<h4>';
			$output .= __( 'Referral Base Amount', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</h4>';
			$output .= '<p>';
			$output .= __( 'Use the amount or payment amount as the base amount for referral calculation?', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';
			$output .= '<label>';
			$output .= sprintf( '<input type="checkbox" name="affiliates-is-base-amount" %s />', $affiliates_is_base_amount ? ' checked="checked" ' : '' );
			$output .= ' ';
			$output .= __( 'Base Amount', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</label>';
			$output .= '<p>';
			$output .= __( 'Enable this option only if the normal referral calculation routines should be applied, instead of using the rate indicated here.', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= __( 'Note that if a rate is indicated, it will also affect the base amount.', AFF_GF_PLUGIN_DOMAIN );
			$output .= ' ';
			$output .= __( 'This setting is only effective with <em>Affiliates Pro</em> and <em>Affiliates Enterprise</em>.', AFF_GF_PLUGIN_DOMAIN );
			$output .= '</p>';

			$output .= wp_nonce_field( self::SAVE, self::NONCE, true, false );

			$output .= sprintf( '<input class="button-primary gfbutton" type="submit" name="affiliates-save" value="%s" />', __( 'Save', AFF_GF_PLUGIN_DOMAIN ) );

			$output .= '</div>';
			$output .= '</form>';

			$output .= '</div>'; // .affiliates-form-settings

			echo $output;

			GFFormSettings::page_footer();

		}
	}

}
Affiliates_Gravity_Forms_Form_Settings::init();
