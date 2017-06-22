<?php
/**
 * class-affiliates-gravity-forms-handler.php
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
 * Form handler.
 */
class Affiliates_Gravity_Forms_Handler {

	/**
	 * Initialization action on WordPress init.
	 */
	public static function init() {
		add_action( 'init', array(__CLASS__, 'wp_init' ) );
	}

	/**
	 * Form action and others.
	 */
	public static function wp_init() {

		// Affiliate account registration.
		// do_action('gform_user_registered', $user_id, $config, $lead, $user_data['password']);
		add_action( 'gform_user_registered', array( __CLASS__, 'gform_user_registered' ), 10, 4 );

		// Records form submission referrals.
		add_action( 'gform_after_submission', array( __CLASS__, 'gform_after_submission' ), 10, 2 );

		// PayPal Payments Standard - referral status update
		// do_action("gform_post_payment_status", $config, $entry, $status,  $transaction_id, $subscriber_id, $amount, $pending_reason, $reason);
		add_action( 'gform_post_payment_status', array( __CLASS__, 'gform_post_payment_status' ), 10, 8 );

		// PayPal Pro - referral status update
		// do_action("gform_paypalpro_post_ipn", $_POST, $entry, $config, $cancel);
		add_action( 'gform_paypalpro_post_ipn', array( __CLASS__, 'gform_paypalpro_post_ipn' ), 10, 4 );

		// PayPal Payments Pro - /
		// @todo later - The current Gravity Forms PayPal Payments Pro Add-On
		// Version 1.0 does not provide any hooks that can be used to update
		// the referral status.

		// Authorize.net - referral status update
		// Not used as the gateway reponse is obtained before the form submission
		// and the referral is not created at that time yet. Handled by checking
		// the payment_status in the $entry. 
		// do_action("gform_authorizenet_post_capture", $result["is_success"], $form_data["amount"], $entry, $form, $config, $response);
		//add_action( 'gform_authorizenet_post_capture', array( __CLASS__, 'gform_authorizenet_post_capture' ), 10, 6 );

		// do_action( 'gform_post_payment_completed', $entry, $action );
		add_action( 'gform_post_payment_completed', array( __CLASS__, 'gform_post_payment_completed' ), 10, 2 );

		// do_action( 'gform_post_payment_refunded', $entry, $action );
		add_action( 'gform_post_payment_refunded', array( __CLASS__, 'gform_post_payment_refunded' ), 10, 2 );
	}

	/**
	 * Affiliate account creation.
	 * 
	 * @param int $user_id
	 * @param array $config
	 * @param array $lead
	 * @param string $password
	 */
	public static function gform_user_registered( $user_id, $config, $lead, $password ) {

		if ( isset( $lead['form_id'] ) && ( $form = RGFormsModel::get_form_meta( $lead['form_id'] ) ) ) {

			$affiliates_register = isset( $form['affiliates']['register'] ) ? $form['affiliates']['register'] : false;
			if ( !$affiliates_register ) {
				return;
			}

			if ( $user = get_user_by( 'id', $user_id ) ) {

				$first_name   = $user->first_name;
				$last_name    = $user->last_name;
				$user_login   = $user->user_login;
				$email        = $user->user_email;
				$url          = $user->user_url;

				if ( empty( $first_name ) ) {
					$first_name = $user_login;
				}

				$userdata = array(
					'first_name' => $first_name,
					'last_name'  => $last_name,
					'user_login' => $user_login,
					'user_email' => $email,
					'user_url'   => $url
				);

				Affiliates_Registration::store_affiliate( $user_id, $userdata );
			}
		}
	}

	/**
	 * PayPal Payments Standard referral status update.
	 * @param array $config
	 * @param array $entry
	 * @param string $status
	 * @param string $transaction_id
	 * @param string $subscriber_id
	 * @param string $amount
	 * @param strintg $pending_reason
	 * @param string $reason
	 */
	public static function gform_post_payment_status( $config, $entry, $status, $transaction_id, $subscriber_id, $amount, $pending_reason, $reason ) {

		global $wpdb;

		if ( isset( $entry['id'] ) && isset( $entry['payment_status'] ) ) {
			switch( $entry['payment_status'] ) {
				case 'Approved' :
				case 'Paid' :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
					break;
				case 'Pending' :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_PENDING;
					break;
				default :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_REJECTED;
			}

			$referrals_table = _affiliates_get_tablename( 'referrals' );
			if ( $referrals = $wpdb->get_results( $wpdb->prepare(
				"SELECT DISTINCT referral_id FROM $referrals_table WHERE reference = %s AND status != %s AND status != %s",
				$entry['id'],
				$new_referral_status,
				AFFILIATES_REFERRAL_STATUS_CLOSED
			) ) ) {
				foreach( $referrals as $referral ) {
					affiliates_update_referral(
						$referral->referral_id,
						array( 'status' => $new_referral_status )
					);
				}
			}
		}
	}

	/**
	 * Handle completed payment.
	 * 
	 * @param array $entry
	 * @param array $action
	 */
	public static function gform_post_payment_completed( $entry, $action ) {

		global $wpdb;

		if ( isset( $entry['id'] ) ) {
			$new_referral_status = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
			$referrals_table = _affiliates_get_tablename( 'referrals' );
			if ( $referrals = $wpdb->get_results( $wpdb->prepare(
					"SELECT DISTINCT referral_id FROM $referrals_table WHERE reference = %s AND status != %s AND status != %s",
					$entry['id'],
					$new_referral_status,
					AFFILIATES_REFERRAL_STATUS_CLOSED
			) ) ) {
				foreach( $referrals as $referral ) {
					affiliates_update_referral(
						$referral->referral_id,
						array( 'status' => $new_referral_status )
					);
				}
			}
		}
	}

	/**
	 * Handle refunded payment.
	 * 
	 * @param array $entry
	 * @param array $action
	 */
	public static function gform_post_payment_refunded( $entry, $action ) {

		global $wpdb;

		if ( isset( $entry['id'] ) ) {
			$new_referral_status = AFFILIATES_REFERRAL_STATUS_REJECTED;
			$referrals_table = _affiliates_get_tablename( 'referrals' );
			if ( $referrals = $wpdb->get_results( $wpdb->prepare(
					"SELECT DISTINCT referral_id FROM $referrals_table WHERE reference = %s AND status != %s AND status != %s",
					$entry['id'],
					$new_referral_status,
					AFFILIATES_REFERRAL_STATUS_CLOSED
			) ) ) {
				foreach( $referrals as $referral ) {
					affiliates_update_referral(
						$referral->referral_id,
						array( 'status' => $new_referral_status )
					);
				}
			}
		}
	}

	/**
	 * PayPal Pro referral status update.
	 * 
	 * @param array $post
	 * @param array $entry
	 * @param array $config
	 * @param boolean $cancel
	 */
	public static function gform_paypalpro_post_ipn( $post, $entry, $config, $cancel ) {

		global $wpdb;

		if ( isset( $entry['id'] ) && isset( $entry['payment_status'] ) ) {
			switch( $entry['payment_status'] ) {
				case 'Approved' :
				case 'Paid' :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
					break;
				case 'Pending' :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_PENDING;
					break;
				default :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_REJECTED;
			}

			$referrals_table = _affiliates_get_tablename( 'referrals' );
			if ( $referrals = $wpdb->get_results( $wpdb->prepare(
				"SELECT DISTINCT referral_id FROM $referrals_table WHERE reference = %s AND status != %s AND status != %s",
				$entry['id'],
				$new_referral_status,
				AFFILIATES_REFERRAL_STATUS_CLOSED
			) ) ) {
				foreach( $referrals as $referral ) {
					affiliates_update_referral(
						$referral->referral_id,
						array( 'status' => $new_referral_status )
					);
				}
			}
		}
	}

	/**
	 * Currently not used - see note on hook (which is disabled).
	 * 
	 * @param boolean $is_success
	 * @param string $amount
	 * @param array $entry
	 * @param array $form
	 * @param array $config
	 * @param string $response
	 */
	public static function gform_authorizenet_post_capture( $is_success, $amount, $entry, $form, $config, $response ) {

		global $wpdb;

		if ( isset( $entry['id'] ) && isset( $entry['payment_status'] ) ) {
			switch( $entry['payment_status'] ) {
				case 'Approved' :
				case 'Paid' :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
					break;
				case 'Pending' :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_PENDING;
					break;
				default :
					$new_referral_status = AFFILIATES_REFERRAL_STATUS_REJECTED;
			}

			$referrals_table = _affiliates_get_tablename( 'referrals' );
			if ( $referrals = $wpdb->get_results( $wpdb->prepare(
				"SELECT DISTINCT referral_id FROM $referrals_table WHERE reference = %s AND status != %s AND status != %s",
				$entry['id'],
				$new_referral_status,
				AFFILIATES_REFERRAL_STATUS_CLOSED
			) ) ) {
				foreach( $referrals as $referral ) {
					affiliates_update_referral(
						$referral->referral_id,
						array( 'status' => $new_referral_status )
					);
				}
			}
		}
	}

	/**
	 * Record a referral for a form submission.
	 * 
	 * Invoked at the end of the form submission process, after form
	 * validation, notification and entry creation.
	 * 
	 * @param array $entry
	 * @param array $form
	 */
	public static function gform_after_submission( $entry, $form ) {

		$affiliates_enabled = isset( $form['affiliates']['enabled'] ) ? $form['affiliates']['enabled'] : false;
		if ( !$affiliates_enabled ) {
			return;
		}

		$post_id = get_the_ID();
		$description = !empty( $form['title'] ) ? $form['title'] : 'Gravity Forms';
		$data = array(
			'entry_id' => array(
				'title'  => __( 'Entry ID', AFF_GF_PLUGIN_DOMAIN ),
				'domain' => AFF_GF_PLUGIN_DOMAIN,
				'value'  => $entry['id']
			),
			'form_id' => array(
				'title'  => __( 'Form ID', AFF_GF_PLUGIN_DOMAIN ),
				'domain' => AFF_GF_PLUGIN_DOMAIN,
				'value'  => $entry['form_id']
			),
			'entry' => array(
				'title' => __( 'Entry', AFF_GF_PLUGIN_DOMAIN ),
				'domain' => AFF_GF_PLUGIN_DOMAIN,
				'value' => sprintf(
					'<a href="%s">%s</a>',
					esc_url(
						sprintf(
							admin_url( 'admin.php?page=gf_entries&view=entry&id=%d&lid=%d' ),
							intval( $entry['form_id'] ),
							intval( $entry['id'] )
						)
					),
					__( 'View', AFF_GF_PLUGIN_DOMAIN )
				)
			)
		);

		// collect values by field ID, used below to store as data
		$values = array();
		foreach( $entry as $index => $value ) {
			if ( is_numeric( $index ) ) {
				$field_id = intval( $index );
				if ( !empty( $value ) ) {
					$values[$field_id][] = $value;
				} else {
					// add empty values once so it can be accessed as token with empty value
					if ( !isset( $values[$field_id] ) ) {
						$values[$field_id][] = '';
					}
				}
			}
		}

		// used to correlate values and fields by index to store in data
		$fields_by_id = array();
		if ( isset( $form['fields'] ) ) {
			foreach ( $form['fields'] as $index => $field ) {
				$fields_by_id[$field['id']] = $field;
			}
		}

		// Store entry data indexed by field ID and collected values, notification tokens
		// can be used indicating the field ID. For example, field with ID 1's values can
		// be included by using the token: [1]
		foreach( $values as $index => $the_values ) {
			$label = '';
			if (
				isset( $fields_by_id[$index] ) &&
				isset( $fields_by_id[$index]['label'] )
			) {
				$label = $fields_by_id[$index]['label'];
			}
			$value_string = wp_strip_all_tags( implode( ',', $the_values ) );
			$data[$index] = array(
				'title'  => $index . ' (' . $label . ')',
				'domain' => AFF_GF_PLUGIN_DOMAIN,
				'value'  => $value_string
			);
		}

		// Amount evaluation in order of precedence:
		// 1. Check if an amount has been set explicitly for the form.
		// 2. Check if the form has the payment_amount set (normally not).
		// 3. Get the order total for the form and entry.
		$amount = null;
		if ( !empty( $form['affiliates']['amount'] ) ) {
			$amount = $form['affiliates']['amount'];
		} else {
			if ( isset( $entry['payment_amount'] ) && ( $entry['payment_amount'] !== null ) ) {
				$amount = $entry['payment_amount'];
			} else {
				$amount = GFCommon::get_order_total( $form, $entry );
				// subtract shipping
				$products = GFCommon::get_product_fields( $form, $entry, false );
				if ( !empty( $products ) ) {
					if ( isset( $products["shipping"] ) && isset( $products["shipping"]["price"] ) ) {
						$amount -= floatval( $products["shipping"]["price"] );
					}
					// allow to filter amount
					$amount = floatval( apply_filters( 'affiliates_gravity_forms_products_amount', $amount, $products, $entry ) );
				}
				if ( $amount < 0 ) {
					$amount = 0;
				}
			}
		}

		// Taxes aren't handled specifically in Gravity Forms:
		// "If you would like to implement tax you can do so by using the Product Field configured as a Calculation field type. Then configure the formula for the calculation to calculate the appropriate tax.
		// You would do this by adding up the value of all of the Pricing Fields that exist on your form and then multiply them by the appropriate tax rate.
		// If tax should only be applied in certain situations, you can then use conditional logic to show or hide that field based on the conditions that must exist in order for the tax to be applied."
		// from https://www.gravityhelp.com/documentation/article/gravity-forms-pricing-adding-tax/

		if ( isset( $entry['payment_amount'] ) && ( $entry['payment_amount'] !== null ) ) {
			$amount = $entry['payment_amount'];
		} else if ( isset( $form['affiliates']['amount'] ) ) {
			$amount = $form['affiliates']['amount'];
		}
		$rate        = isset( $form['affiliates']['rate'] ) ? $form['affiliates']['rate'] : null;
		$currency    = isset( $entry['currency'] ) ? $entry['currency'] : null;
		$reference   = isset( $entry['id'] ) ? $entry['id'] : null;

		// allow to filter amount, the third parameter is added in case if useful later on
		$amount = floatval( apply_filters( 'affiliates_gravity_forms_amount', $amount, $entry, array() ) );
		if ( ( $amount !== null ) && ( $rate !== null ) ) {
			$amount = bcmul( $amount, $rate, AFFILIATES_REFERRAL_AMOUNT_DECIMALS );
		}

		// For payment gateway implementations (like GF's Authorize.net), where
		// the payment has already been processed before we get here, determine
		// the referral status. 
		$referral_status = null;
		if ( isset( $entry['payment_status'] ) && ( $entry['payment_status'] !== null ) ) {
			$referral_status = self::get_referral_status_by_payment_status( $entry );
		}

		if ( class_exists( 'Affiliates_Referral_WordPress' ) ) {
			$base_amount = null;
			$is_base_amount = isset( $form['affiliates']['is_base_amount'] ) ? $form['affiliates']['is_base_amount'] : false;
			if ( $is_base_amount ) {
				$base_amount = $amount;
				$amount = null;
			}
			$r = new Affiliates_Referral_WordPress();
			$affiliate_id = $r->evaluate(
				$post_id,
				$description,
				$data,
				$base_amount,
				$amount,
				$currency,
				$referral_status,
				Affiliates_Gravity_Forms::REFERRAL_TYPE,
				$reference
			);
		} else {
			$affiliate_id = affiliates_suggest_referral(
				$post_id,
				$description,
				$data,
				$amount,
				$currency,
				$referral_status,
				Affiliates_Gravity_Forms::REFERRAL_TYPE,
				$reference
			);
		}
	}

	/**
	 * Helper sort fields by id.
	 * 
	 * @param array $f1
	 * @param array $f2
	 * @return int
	 */
	public static function sort_fields( $f1, $f2 ) {
		$i1 = isset( $f1['id'] ) ? intval( $f1['id'] ) : 0;
		$i2 = isset( $f2['id'] ) ? intval( $f2['id'] ) : 0;
		return $i1 - $i2;
	}

	/**
	 * Returns the corresponding referral status for an entry's payment status.
	 * If the payment status is set, the referral status is determined as
	 * accepted for approved payments, pending for pending payments
	 * and as rejected in any other case.
	 * If the payment status is not set, i.e. when
	 * $entry['payment_status'] === null, null is returned.
	 * 
	 * @param array $entry
	 * @return string referral status
	 */
	private static function get_referral_status_by_payment_status( $entry ) {
		$status = null;
		if ( isset( $entry['id'] ) && isset( $entry['payment_status'] ) && ( $entry['payment_status'] !== null ) ) {
			switch( $entry['payment_status'] ) {
				case 'Approved' :
				case 'Paid' :
					$status = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
					break;
				case 'Pending' :
					$status = AFFILIATES_REFERRAL_STATUS_PENDING;
					break;
				default :
					$status = AFFILIATES_REFERRAL_STATUS_REJECTED;
			}
		}
		return $status;
	}

}
Affiliates_Gravity_Forms_Handler::init();
