<?php
/**
 * class-affiliates-notifications-extended.php
 *
 * Copyright 2012 "kento" Karim Rahimpur - www.itthinx.com
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
 * @author Karim Rahimpur
 * @package affiliates-pro
 * @since affiliates-pro 2.16.0
 */

/**
 * Notifications
 */
class Affiliates_Notifications_Extended extends Affiliates_Notifications {

	const NONCE = 'aff-admin-menu';
	const SETTINGS = 'aff-settings';

	const REGISTRATION_SUBJECT                = 'registration_subject';
	const REGISTRATION_MESSAGE                = 'registration_message';
	const REGISTRATION_PENDING_SUBJECT                = 'registration_pending_subject';
	const REGISTRATION_PENDING_MESSAGE                = 'registration_pending_message';
	const ADMIN_REGISTRATION_ENABLED          = 'aff_notify_admin';
	const ADMIN_REGISTRATION_ENABLED_DEFAULT  = true;
	const ADMIN_REGISTRATION_SUBJECT          = 'admin_registration_subject';
	const ADMIN_REGISTRATION_MESSAGE          = 'admin_registration_message';
	const ADMIN_REGISTRATION_PENDING_SUBJECT  = 'admin_registration_pending_subject';
	const ADMIN_REGISTRATION_PENDING_MESSAGE  = 'admin_registration_pending_message';

	const AFFILIATE_PENDING_TO_ACTIVE_SUBJECT                = 'affiliate_pending_to_active_subject';
	const AFFILIATE_PENDING_TO_ACTIVE_MESSAGE                = 'affiliate_pending_to_active_message';

	const NOTIFY_ADMIN           = 'notify_admin';
	const NOTIFY_ADMIN_EMAIL     = 'notify_admin_email';
	const NOTIFY_ADMIN_STATUS    = 'notify_admin_status';
	const ADMIN_SUBJECT          = 'admin_subject';
	const ADMIN_MESSAGE          = 'admin_message';
	const ADMIN_DEFAULT_SUBJECT  = 'Referral';
	const ADMIN_DEFAULT_MESSAGE  = 'A referral has been credited to the affiliate [affiliate_name] (ID [affiliate_id]) on <a href="[site_url]">[site_title]</a>.<br/>';

	const NOTIFY_AFFILIATE        = 'notify_affiliate';
	const NOTIFY_AFFILIATE_STATUS = 'notify_affiliate_status';
	const SUBJECT          = 'subject';
	const MESSAGE          = 'message';
	const DEFAULT_SUBJECT  = 'Referral';
	const DEFAULT_MESSAGE  =
'Hi [affiliate_name],<br/>
A referral has been credited to you on <a href="[site_url]">[site_title]</a>.<br/>
<br/>
Greetings,<br/>
[site_title]<br/>
[site_url]<br/>';

	/**
	 * Overrides parent's singleton constructor.
	 */
	protected function __construct() {
		parent::__construct();
		self::init();
	}

	/**
	 * Returns the name of the related admin class - overrides the method in the base class.
	 * @return string
	 */
	public function get_admin_class() {
		return 'Affiliates_Admin_Notifications_Extended';
	}

	/**
	 * Adds hooks and actions for notifications.
	 */
	public static function init() {
		parent::init();
		// referral notifications, notify the affiliate and/or administrator of a referral ?
		$notifications    = get_option( 'affiliates_notifications', array() );
		$notify_admin     = isset( $notifications[self::NOTIFY_ADMIN] ) ? $notifications[self::NOTIFY_ADMIN] : false;
		$notify_affiliate = isset( $notifications[self::NOTIFY_AFFILIATE] ) ? $notifications[self::NOTIFY_AFFILIATE] : false;
		if ( $notify_admin || $notify_affiliate ) {
			add_action( 'affiliates_referral', array( self::get_instance(), 'affiliates_referral' ) );
			add_action( 'affiliates_updated_referral', array( self::get_instance(), 'affiliates_updated_referral' ), 10, 4 );
		}
	}

	/**
	 * Registers the affiliates-admin-notifications css style.
	 */
	public static function admin_init() {
		wp_register_style( 'affiliates-pro-admin-notifications', AFFILIATES_PRO_PLUGIN_URL . 'css/affiliates_admin_notifications.css' );
	}

	/**
	 * Changes the admin registration email subject.
	 *
	 * @param string $subject
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_new_affiliate_registration_subject( $subject, $params ) {
		$notifications = get_option( 'affiliates_notifications', array() );
		$status = get_option( 'aff_status', null );
		switch( $status ) {
			case 'pending' :
				$registration_subject = isset( $notifications[self::ADMIN_REGISTRATION_PENDING_SUBJECT] ) ? $notifications[self::ADMIN_REGISTRATION_PENDING_SUBJECT] : self::get_default( self::DEFAULT_ADMIN_REGISTRATION_PENDING_SUBJECT );
				break;
			case 'active' :
			default :
				$registration_subject = isset( $notifications[self::ADMIN_REGISTRATION_SUBJECT] ) ? $notifications[self::ADMIN_REGISTRATION_SUBJECT] : self::get_default( self::DEFAULT_ADMIN_REGISTRATION_ACTIVE_SUBJECT );
		}
		$tokens  = self::get_registration_tokens( $params );
		$subject = self::substitute_tokens( stripslashes( $registration_subject ), $tokens );
		return $subject;
	}

	/**
	 * Changes the admin registration email message.
	 *
	 * @param string $message
	 * @param array $params
	 * @return string
	 */
	public static function  affiliates_new_affiliate_registration_message( $message, $params ) {
		$notifications = get_option( 'affiliates_notifications', array() );
		$status = get_option( 'aff_status', null );
		switch( $status ) {
			case 'pending' :
				$registration_message = isset( $notifications[self::ADMIN_REGISTRATION_PENDING_MESSAGE] ) ? $notifications[self::ADMIN_REGISTRATION_PENDING_MESSAGE] : self::get_default( self::DEFAULT_ADMIN_REGISTRATION_PENDING_MESSAGE );
				break;
			case 'active' :
			default :
				$registration_message = isset( $notifications[self::ADMIN_REGISTRATION_MESSAGE] ) ? $notifications[self::ADMIN_REGISTRATION_MESSAGE] : self::get_default( self::DEFAULT_ADMIN_REGISTRATION_ACTIVE_MESSAGE );
		}
		$tokens  = self::get_registration_tokens( $params );
		$message = self::substitute_tokens( stripslashes( $registration_message ), $tokens );
		return $message;
	}

	/**
	 * Additional mail headers for wp_mail() - used to set the type to HTML.
	 *
	 * @param string $headers
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_new_affiliate_registration_headers( $headers = '', $params = array() ) {
		$headers .= 'Content-type: text/html; charset="' . get_option( 'blog_charset' ) . '"' . "\r\n";
		return $headers;
	}

	/**
	 * Changes the affiliate registration email subject.
	 * 
	 * @param string $subject
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_new_affiliate_user_registration_subject( $subject, $params ) {
		$notifications = get_option( 'affiliates_notifications', array() );
		$status = get_option( 'aff_status', null );
		switch ( $status ) {
			case 'pending' :
				$registration_subject = isset( $notifications[self::REGISTRATION_PENDING_SUBJECT] ) ? $notifications[self::REGISTRATION_PENDING_SUBJECT] : self::get_default( self::DEFAULT_REGISTRATION_PENDING_SUBJECT );
				break;
			case 'active':
			default:
				$registration_subject = isset( $notifications[self::REGISTRATION_SUBJECT] ) ? $notifications[self::REGISTRATION_SUBJECT] : self::get_default( self::DEFAULT_REGISTRATION_ACTIVE_SUBJECT );
				break;
		}
		$tokens  = self::get_registration_tokens( $params );
		$subject = self::substitute_tokens( stripslashes( $registration_subject ), $tokens );
		return $subject;
	}

	/**
	 * Changes the affiliate registration email message.
	 * 
	 * @param string $message
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_new_affiliate_user_registration_message( $message, $params ) {
		$notifications = get_option( 'affiliates_notifications', array() );
		$status = get_option( 'aff_status', null );
		switch ( $status ) {
			case 'pending' :
				$registration_message = isset( $notifications[self::REGISTRATION_PENDING_MESSAGE] ) ? $notifications[self::REGISTRATION_PENDING_MESSAGE] : self::get_default( self::DEFAULT_REGISTRATION_PENDING_MESSAGE );
				break;
			case 'active':
			default:
				$registration_message = isset( $notifications[self::REGISTRATION_MESSAGE] ) ? $notifications[self::REGISTRATION_MESSAGE] : self::get_default( self::DEFAULT_REGISTRATION_ACTIVE_MESSAGE );
				break;
		}
		$tokens  = self::get_registration_tokens( $params );
		$message = self::substitute_tokens( stripslashes( $registration_message ), $tokens );
		return $message;
	}

	/**
	 * Additional mail headers for wp_mail() - used to set the type to HTML.
	 * 
	 * @param string $headers
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_new_affiliate_user_registration_headers( $headers = '', $params = array() ) {
		$headers .= 'Content-type: text/html; charset="' . get_option( 'blog_charset' ) . '"' . "\r\n";
		return $headers;
	}

	/**
	 * Determines the affiliate status changed email subject.
	 *
	 * @param string $subject
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_updated_affiliate_status_subject( $subject, $params, $old_status, $new_status ) {
		$notifications = get_option( 'affiliates_notifications', array() );
		$status_subject = '';
		switch ( $old_status ) {
			case 'pending' :
				switch ( $new_status ) {
					case 'active' :
						$status_subject = isset( $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] ) ? $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] : self::get_default( self::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_SUBJECT );
						break;
				}
				break;
		}
		$tokens = self::get_registration_tokens( $params );
		$subject = self::substitute_tokens( stripslashes( $status_subject ), $tokens );
		return $subject;
	}

	/**
	 * Determines the affiliate status changed email message.
	 *
	 * @param string $message
	 * @param array $params
	 * @return string
	 */
	public static function  affiliates_updated_affiliate_status_message( $message, $params, $old_status, $new_status ) {
		$notifications = get_option( 'affiliates_notifications', array() );
		$status_message = '';
		switch ( $old_status ) {
			case 'pending' :
				switch ( $new_status ) {
					case 'active' :
						$status_message = isset( $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] ) ? $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] : self::get_default( self::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_MESSAGE );
						break;
				}
				break;
		}
		$tokens = self::get_registration_tokens( $params );
		$message = self::substitute_tokens( stripslashes( $status_message ), $tokens );
		return $message;
	}

	/**
	 * Additional mail headers for wp_mail() - used to set the type to HTML.
	 *
	 * @param string $headers
	 * @param array $params
	 * @return string
	 */
	public static function affiliates_updated_affiliate_status_headers( $headers = '', $params = array(), $old_status = '', $new_status = '' ) {
		$headers .= 'Content-type: text/html; charset="' . get_option( 'blog_charset' ) . '"' . "\r\n";
		return $headers;
	}

	/**
	 * Builds an array of tokens adn values based on the parameters provided.
	 * 
	 * These tokens are added automatically:
	 * - site_title
	 * - site_url
	 * 
	 * token-string tuples are extracted from $params and included automatically.
	 * 
	 * Note that at this stage the affiliate entry has not yet been created
	 * and we can not use affiliates_get_user_affiliate() to obtain the
	 * affiliate details like ID or status.
	 *  
	 * This method is used internally to obtain the tokens for substitution
	 * in the affiliate user registration email subject and message.
	 * 
	 * @param array $params
	 * @return array
	 */
	private static function get_registration_tokens( $params ) {
		$tokens = array();
		foreach( $params as $key => $value ) {
			if ( is_string( $value ) ) {
				$tokens[$key] = $value;
			}
		}
		$tokens['site_title'] = wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES );
		$tokens['site_url']   = get_bloginfo( 'url' );
		if ( isset( $params['user_id'] ) ) {
			$user_id = intval( $params['user_id'] );
			if ( ( $user = get_user_by( 'id', $user_id ) ) ) {
				require_once AFFILIATES_CORE_LIB . '/class-affiliates-settings.php';
				require_once AFFILIATES_CORE_LIB . '/class-affiliates-settings-registration.php';
				$registration_fields = Affiliates_Settings_Registration::get_fields();
				// unset( $registration_fields['password'] );
				if ( !empty( $registration_fields ) ) {
					foreach( $registration_fields as $name => $field ) {
						if ( $field['enabled'] ) {
							$type = isset( $field['type'] ) ? $field['type'] : 'text';
							switch( $name ) {
								case 'user_login' :
									$value = $user->user_login;
									break;
								case 'user_email' :
									$value = $user->user_email;
									break;
								case 'user_url' :
									$value = $user->user_url;
									break;
								case 'password' :
									$value = '';
									break;
								default :
									$value = get_user_meta( $user_id, $name , true );
							}
							if ( !isset( $tokens[$name] ) ) {
								$tokens[$name]  = esc_attr( stripslashes( $value ) );
							}
						}
					}
				}
			}
		}
		$tokens = apply_filters(
			'affiliates_registration_tokens',
			$tokens
		);
		return $tokens;
	}

	/**
	 * Substitutes tokens found in subject $s.
	 * 
	 * @param string $s
	 * @param array $tokens
	 * @return string
	 */
	private static function substitute_tokens( $s, $tokens ) {
		foreach ( $tokens as $key => $value ) {
			if ( key_exists( $key, $tokens ) ) {
				$substitute = $tokens[$key];
				$s = str_replace( "[" . $key . "]", $substitute, $s );
			}
		}
		return $s;
	}

	/**
	 * Hooked after a referral has been recorded.
	 * @param int $referral_id
	 */
	public static function affiliates_referral( $referral_id ) {
		global $affiliates_db;

		$referrals_table = $affiliates_db->get_tablename( 'referrals' );
		if ( $referrals = $affiliates_db->get_objects( "SELECT * FROM $referrals_table WHERE referral_id = %d", intval( $referral_id ) ) ) {
			if ( isset( $referrals[0] ) ) {
				$referral = $referrals[0];

				if ( $affiliate = affiliates_get_affiliate( $referral->affiliate_id ) ) {

					$notifications      = get_option( 'affiliates_notifications', array() );
					$notify_admin       = isset( $notifications[self::NOTIFY_ADMIN] ) ? $notifications[self::NOTIFY_ADMIN] : false;
					$notify_admin_email = isset( $notifications[self::NOTIFY_ADMIN_EMAIL] ) ? $notifications[self::NOTIFY_ADMIN_EMAIL] : '';
					$notify_affiliate   = isset( $notifications[self::NOTIFY_AFFILIATE] ) ? $notifications[self::NOTIFY_AFFILIATE] : false;

					if ( $notify_admin || $notify_affiliate ) {

						require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/includes/class-affiliates-mail.php' );
						$mail          = new Affiliates_Mail();
						$mail->mailer  = 'wp_mail';
						$mail->charset = get_option( 'blog_charset' );

						// for basic token substitution
						$site_title = wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES );
						$site_url   = get_bloginfo( 'url' );
						$tokens = apply_filters( 'affiliates_notifications_tokens', array(
							'site_title'      => $site_title,
							'site_url'        => $site_url,
							'affiliate_name'  => wp_filter_nohtml_kses( $affiliate['name'] ),
							'affiliate_id'    => $affiliate['affiliate_id'],
							'affiliate_email' => $affiliate['email'],
							'referral_status' => $referral->status,
							'referral_id'     => $referral->referral_id,
							'referral_amount' => $referral->amount,
							'referral_currency_id' => $referral->currency_id,
							'referral_type'        => $referral->type,
							'referral_reference'   => $referral->reference
						) );
						// data tokens
						$data_tokens = array();
						$data        = array();
						if ( !empty( $referral->data ) ) {
							$data = unserialize( $referral->data );
							if ( $data && is_array( $data ) ) {
								$data_tokens = array_keys( $data );
							}
						}
						$data_tokens = apply_filters( 'affiliates_notifications_data_tokens', $data_tokens, $tokens );
						$data        = apply_filters( 'affiliates_notifications_data', $data, $data_tokens, $tokens );

						if ( $notify_admin ) {
							$admin_email = empty( $notify_admin_email ) ? get_bloginfo( 'admin_email' ) : $notify_admin_email;
							if ( !empty( $admin_email ) ) {
								$notify_admin_status = isset( $notifications[self::NOTIFY_ADMIN_STATUS] ) ? $notifications[self::NOTIFY_ADMIN_STATUS] : array( AFFILIATES_REFERRAL_STATUS_ACCEPTED );
								if ( in_array( $referral->status, $notify_admin_status ) ) {
									$admin_subject = isset( $notifications[self::ADMIN_SUBJECT] ) ? $notifications[self::ADMIN_SUBJECT] : self::ADMIN_DEFAULT_SUBJECT;
									$admin_message = isset( $notifications[self::ADMIN_MESSAGE] ) ? $notifications[self::ADMIN_MESSAGE] : self::ADMIN_DEFAULT_MESSAGE;
									$mail->mail( $admin_email, stripslashes( wp_filter_nohtml_kses( $admin_subject ) ), stripslashes( wp_filter_post_kses( $admin_message ) ), $tokens, $data_tokens, $data );
								}
							}
						}

						if ( $notify_affiliate ) {
							if ( !empty( $affiliate['email'] ) ) {
								$notify_affiliate_status = isset( $notifications[self::NOTIFY_AFFILIATE_STATUS] ) ? $notifications[self::NOTIFY_AFFILIATE_STATUS] : array( AFFILIATES_REFERRAL_STATUS_ACCEPTED );
								if ( in_array( $referral->status, $notify_affiliate_status ) ) {
									$subject = isset( $notifications[self::SUBJECT] ) ? $notifications[self::SUBJECT] : self::DEFAULT_SUBJECT;
									$message = isset( $notifications[self::MESSAGE] ) ? $notifications[self::MESSAGE] : self::DEFAULT_MESSAGE;
									$mail->mail( $affiliate['email'], stripslashes( wp_filter_nohtml_kses( $subject ) ), stripslashes( wp_filter_post_kses( $message ) ), $tokens, $data_tokens, $data );
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Hooked on referral update.
	 * 
	 * @param int $referral_id
	 * @param array $keys attribute keys
	 * @param array $values (new) attribute values
	 * @param array $old_values (old) attribute values
	 */
	public static function affiliates_updated_referral( $referral_id, $keys, $values, $old_values ) {
		$n = count( $keys );
		for( $i = 0; $i < $n; $i++ ) {
			if ( $keys[$i] == 'status' ) {
				$new_status = $values[$i];
				$old_status = $old_values[$i];
				// only when it was pending and now accepted, otherwise it should have already been notified on creation
				if ( ( $new_status == AFFILIATES_REFERRAL_STATUS_ACCEPTED ) && ( $old_status == AFFILIATES_REFERRAL_STATUS_PENDING ) ) {
					self::affiliates_referral( $referral_id );
				}
			}
		}
	}

	/**
	 * Notify the affiliate of his status changed.
	 * Notification is sent when the status change:
	 * - From pending to accepted
	 *
	 * @param int $affiliate_id
	 * @param string $old_status
	 * @param string $new_status
	 */
	public static function affiliates_updated_affiliate_status( $affiliate_id, $old_status, $new_status ) {
		if ( ( $old_status == 'pending' ) && ( $new_status == 'active' ) ) {
			$user_id = affiliates_get_affiliate_user ( $affiliate_id );
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
			if ( $user = get_userdata( $user_id ) ) {
				if ( get_option( 'aff_notify_affiliate_user', 'yes' ) != 'no' ) {
					$subject = isset( $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] ) ? $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] : self::get_default( self::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_SUBJECT );
					$message  = isset( $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] ) ? $notifications[self::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] : self::get_default( self::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_MESSAGE );
					$params = array(
							'user_id'  => $user_id,
							'user'     => $user,
							'username' => $user->user_login,
							'site_login_url' => wp_login_url(),
							'blogname'       => $blogname
					);

					@wp_mail(
						$user->user_email,
						apply_filters( 'affiliates_updated_affiliate_status_subject', sprintf( __( '[%s] Affiliate program', 'affiliates' ), $blogname ), $params, $old_status, $new_status ),
						apply_filters( 'affiliates_updated_affiliate_status_message', $message, $params, $old_status, $new_status ),
						apply_filters( 'affiliates_updated_affiliate_status_headers', '', $params, $old_status, $new_status )
					);
				}
			}
		}
	}

}
