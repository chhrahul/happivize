<?php
/**
 * class-affiliates-admin-notifications-extended.php
 *
 * Copyright (c) 2016 "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package affiliates-pro
 * @since affiliates-pro 2.16.0
 */

/**
 * Extended administrative section for notifications.
 *
 */
class Affiliates_Admin_Notifications_Extended {

	const NONCE = 'aff-admin-menu';
	const SETTINGS = 'aff-settings';

	/**
	 * Renders the administrative section for our extended notifications.
	 */
	public static function view() {

		if ( !current_user_can( AFFILIATES_ADMINISTER_OPTIONS ) ) {
			wp_die( __( 'Access denied.', AFFILIATES_PRO_PLUGIN_DOMAIN ) );
		}

		wp_enqueue_style( 'affiliates-pro-admin-notifications' );

		$notifications_sections = apply_filters(
				'affiliates_notifications_sections',
				array(
						'affiliates'      => array (
								'label' => __( 'Affiliates', 'affiliates' ),
								'subsections' => array (
										'registration' => __( 'Registration', 'affiliates' ),
										'referrals' => __( 'Referrals', 'affiliates' )
								)
						),
						'administrator'      => array (
								'label' => __( 'Administrator', 'affiliates' ),
								'subsections' => array (
										'registration' => __( 'Registration', 'affiliates' ),
										'referrals' => __( 'Referrals', 'affiliates' )
								)
						)
				)
		);

		// Section
		$section = isset( $_REQUEST['section'] ) ? $_REQUEST['section'] : null;

		if ( !key_exists( $section, $notifications_sections ) ) {
			$section = 'affiliates';
		}
		$section_title = $notifications_sections[$section]['label'];

		echo
		'<h1>' .
		__( 'Notifications', 'affiliates' ) .
		'</h1>';

		$section_links = '';
		foreach( $notifications_sections as $sec => $sec_data ) {
			$section_links .= sprintf(
					'<a class="section-link nav-tab %s" href="%s">%s</a>',
					$section == $sec ? 'active nav-tab-active' : '',
					esc_url( add_query_arg( 'section', $sec, admin_url( 'admin.php?page=affiliates-admin-notifications' ) ) ),
					$sec_data['label']
					);
		}
		echo '<div class="section-links nav-tab-wrapper">';
		echo $section_links;
		echo '</div>';

		include_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/includes/class-affiliates-notifications-extended.php' );

		switch ( $section ) {
			case 'administrator' :
				self::affiliates_notifications_administrator_section();
				break;
			case 'affiliates' :
			default :
				self::affiliates_notifications_affiliates_section();
				break;
		}
		affiliates_footer();
	}

	/**
	 * Display the Notifications: Administrator tab.
	 */
	protected static function affiliates_notifications_administrator_section() {
		$notifications = get_option( 'affiliates_notifications', null );
		if ( $notifications === null ) {
			add_option( 'affiliates_notifications', array(), null, 'no' );
		}
		if ( isset( $_POST['submit'] ) ) {
			if ( wp_verify_nonce( $_POST[self::NONCE], self::SETTINGS ) ) {
			// admin registration subject - Pending
				if ( !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_PENDING_SUBJECT );
				}
				// admin registration message - Pending
				if ( !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE] = $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_PENDING_MESSAGE );
				}

				// admin registration subject - Active
				if ( !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_ACTIVE_SUBJECT );
				}
				// admin registration message - Active
				if ( !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE] = $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_ACTIVE_MESSAGE );
				}

				$notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN] = !empty( $_POST[Affiliates_Notifications_Extended::NOTIFY_ADMIN] );

				// admin email
				if ( !empty( $_POST[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL] ) ) {
					if ( $notify_admin_email = filter_var( $_POST[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL], FILTER_VALIDATE_EMAIL ) ) {
						$notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL] = $notify_admin_email;
					} else {
						$notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL] = '';
					}
				} else {
					$notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL] = '';
				}

				$notify_admin_status = array();
				if ( !empty( $_POST['notify_admin_status_accepted'] ) ) {
					$notify_admin_status[] = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
				}
				if ( !empty( $_POST['notify_admin_status_pending'] ) ) {
					$notify_admin_status[] = AFFILIATES_REFERRAL_STATUS_PENDING;
				}
				$notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_STATUS] = $notify_admin_status;

				// admin subject active
				if ( !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::ADMIN_SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::ADMIN_SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::ADMIN_SUBJECT] = Affiliates_Notifications_Extended::ADMIN_DEFAULT_SUBJECT;
				}
				// admin message active
				if ( !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::ADMIN_MESSAGE] = $_POST[Affiliates_Notifications_Extended::ADMIN_MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::ADMIN_MESSAGE] = Affiliates_Notifications_Extended::ADMIN_DEFAULT_MESSAGE;
				}

				// admin registration enabled
				$notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED] = !empty( $_POST[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED] );
				update_option( 'affiliates_notifications', $notifications );
			}
		}

		$registration_enabled = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED] : Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED_DEFAULT;

		$admin_registration_subject = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_ACTIVE_SUBJECT );
		$admin_registration_message = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_ACTIVE_MESSAGE );

		$admin_registration_pending_subject = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_PENDING_SUBJECT );
		$admin_registration_pending_message = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_ADMIN_REGISTRATION_PENDING_MESSAGE );

		$notify_admin       = isset( $notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN] ) && $notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN];
		$notify_admin_email = isset( $notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL] ) ? $notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL] : '';
		$notify_admin_status = isset( $notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_STATUS] ) ? $notifications[Affiliates_Notifications_Extended::NOTIFY_ADMIN_STATUS] : array( AFFILIATES_REFERRAL_STATUS_ACCEPTED );
		$admin_subject      = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_SUBJECT] : Affiliates_Notifications_Extended::ADMIN_DEFAULT_SUBJECT;
		$admin_message      = isset( $notifications[Affiliates_Notifications_Extended::ADMIN_MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::ADMIN_MESSAGE] : Affiliates_Notifications_Extended::ADMIN_DEFAULT_MESSAGE;

		echo '<form action="" name="notifications" method="post">';

		echo '<div class="notifications">';

		echo '<div class="manage">';

		echo
		'<h1>' .
		__( 'Registration', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</h1>';

		echo
		'<div>' .

		// registration notifications sent to the administrator

		'<p>' .
		'<label>' .
		'<input type="checkbox" name="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED . '" id="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_ENABLED . '" ' . ( $registration_enabled ? ' checked="checked" ' : '' ) . '/>' .
		__( 'Enable registration notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		'</p>' .
		'<p class="description">' .
		__( 'Notify the administrator about new affiliate accounts.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>' .

		'<h2>' . __( 'Administrator Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h2>' .

		'<p>' .
		__( 'These templates are used to notify the site administrator of new affiliates.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>' .

		'<h3>' . __( 'Pending', 'affiliates' ) . '</h3>' .

		'<p>' . __( 'This notification is sent to the administrator if a new affiliate application is pending approval.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .

		'<p>' .
		'<label>' .
		__( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT . '" name="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $admin_registration_pending_subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<textarea class="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE . '" id="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE . '" name="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_PENDING_MESSAGE . '" rows="10">' . htmlentities( stripslashes( $admin_registration_pending_message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this administrator notification is <strong>HTML</strong>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</span>' .
		'</p>' .

		'<h3>' . __( 'Active', 'affiliates' ) . '</h3>' .

		'<p>' . __( 'This notification is sent to the administrator if an affiliate has been approved automatically.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .

		'<p>' .
		'<label>' .
		__( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT . '" name="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $admin_registration_subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<textarea class="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE . '" id="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE . '" name="' . Affiliates_Notifications_Extended::ADMIN_REGISTRATION_MESSAGE . '" rows="10">' . htmlentities( stripslashes( $admin_registration_message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this administrator notification is <strong>HTML</strong>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</span>' .
		'</p>' .

		wp_nonce_field( self::SETTINGS, self::NONCE, true, false ) .
		'<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' .
		'</p>' .

		'</div>' .

		'</div>'; // .manage

		echo '</div>'; // .notifications

		// Referrals subsection

		echo '<div class="notifications">';

		echo '<div class="manage">';

		echo
		'<h1>' .
		__( 'Referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</h1>';

		echo
		'<p>' .
		__( 'Notifications for the site administrator can be enabled here. If the integration used provides its own notification settings, enable these through the integration&rsquo;s settings or here. Do not enable them both, as that could cause duplicate notifications to be sent.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>';

		echo
		'<div>' .

		'<h2>' .
		__( 'Referral Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</h2>' .

		'<p>' .
		'<label>' .
		'<input type="checkbox" name="' . Affiliates_Notifications_Extended::NOTIFY_ADMIN . '" id="' . Affiliates_Notifications_Extended::NOTIFY_ADMIN . '" ' . ( $notify_admin ? ' checked="checked" ' : '' ) . '/>' .
		__( 'Notify the site administrator', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		'</p>' .
		'<p class="description">' .
		__( 'Notifications will be sent to the email address specified in <em>Settings > General</em>, or if indicated, to the email address specified here.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>' .

		'<p>' .
		'<label>' .
		__( 'Administrator Email Address', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		sprintf( '<input class="%s" name="%s" type="text" value="%s" placeholder="%s"/>', esc_attr( Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL ), esc_attr( Affiliates_Notifications_Extended::NOTIFY_ADMIN_EMAIL ), esc_attr( $notify_admin_email ), get_bloginfo( 'admin_email' ) ) .
		'</label>' .
		'</p>' .

		'<p>' .
		__( 'Notify when a referral is: ', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<label>' .
		sprintf( '<input type="checkbox" name="notify_admin_status_accepted" %s />', in_array( AFFILIATES_REFERRAL_STATUS_ACCEPTED, $notify_admin_status ) ? ' checked="checked" ' : '' ) .
		__( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		' ' .
		'<label>' .
		sprintf( '<input type="checkbox" name="notify_admin_status_pending" %s />', in_array( AFFILIATES_REFERRAL_STATUS_PENDING, $notify_admin_status ) ? ' checked="checked" ' : '' ) .
		__( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		'</p>' .
		'<ul class="description">' .
		'<li>' . __( 'Notifications on referral status updates are only sent when the status changes from <em>pending</em> to <em>accepted</em>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li>' . __( 'More than one notification may be sent if multiple statuses are enabled.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li>' . __( 'Notifications on referral status updates may not be supported by all integrations.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'</ul>' .

		'<p>' .
		'<label>' .
		__( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::ADMIN_SUBJECT . '" name="' . Affiliates_Notifications_Extended::ADMIN_SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $admin_subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<textarea class="message" id="' . Affiliates_Notifications_Extended::ADMIN_MESSAGE . '" name="' . Affiliates_Notifications_Extended::ADMIN_MESSAGE . '" rows="10">' . htmlentities( stripslashes( $admin_message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this administrator notification is <strong>HTML</strong>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</span>' .
		'</p>' .

		'<p>' .
		wp_nonce_field( self::SETTINGS, self::NONCE, true, false ) .
		'<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' .
		'</p>' .

		'</div>' .

		'</div>'; // .manage

		echo '</div>'; // .notifications

		echo '</form>';
	}

	/**
	 * Display the Notifications: Affiliates tab.
	 */
	protected static function affiliates_notifications_affiliates_section() {
		$notifications = get_option( 'affiliates_notifications', null );
		if ( $notifications === null ) {
			add_option('affiliates_notifications', array(), null, 'no' );
		}

		if ( isset( $_POST['submit'] ) ) {
			if ( wp_verify_nonce( $_POST[self::NONCE], self::SETTINGS ) ) {

				$notifications[Affiliates_Notifications_Extended::REGISTRATION_ENABLED] = !empty( $_POST[Affiliates_Notifications_Extended::REGISTRATION_ENABLED] );

				// Affiliate Active - registration subject must not be empty
				if ( !empty( $_POST[Affiliates_Notifications_Extended::REGISTRATION_SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::REGISTRATION_SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_SUBJECT] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_ACTIVE_SUBJECT );
				}
				// Affiliate Active - registration message must not be empty
				if ( !empty( $_POST[Affiliates_Notifications_Extended::REGISTRATION_MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_MESSAGE] = $_POST[Affiliates_Notifications_Extended::REGISTRATION_MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_MESSAGE] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_ACTIVE_MESSAGE );
				}

				// Affiliate Pending - registration subject must not be empty
				if ( !empty( $_POST[Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_PENDING_SUBJECT );
				}
				// Affiliate Pending - registration message must not be empty
				if ( !empty( $_POST[Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE] = $_POST[Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_PENDING_MESSAGE );
				}

				// The Affiliate has been activated - pending to active
				if ( !empty( $_POST[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_SUBJECT );
				}
				// The Affiliate has been activated - pending to active
				if ( !empty( $_POST[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] = $_POST[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] = Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_MESSAGE );
				}

				$notifications[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE] = !empty( $_POST[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE] );

				$notify_affiliate_status = array();
				if ( !empty( $_POST['notify_affiliate_status_accepted'] ) ) {
					$notify_affiliate_status[] = AFFILIATES_REFERRAL_STATUS_ACCEPTED;
				}
				if ( !empty( $_POST['notify_affiliate_status_pending'] ) ) {
					$notify_affiliate_status[] = AFFILIATES_REFERRAL_STATUS_PENDING;
				}
				$notifications[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE_STATUS] = $notify_affiliate_status;

				// subject must not be empty
				if ( !empty( $_POST[Affiliates_Notifications_Extended::SUBJECT] ) ) {
					$notifications[Affiliates_Notifications_Extended::SUBJECT] = wp_filter_nohtml_kses( $_POST[Affiliates_Notifications_Extended::SUBJECT] );
				} else {
					$notifications[Affiliates_Notifications_Extended::SUBJECT] = Affiliates_Notifications_Extended::DEFAULT_SUBJECT;
				}
				// message must not be empty
				if ( !empty( $_POST[Affiliates_Notifications_Extended::MESSAGE] ) ) {
					$notifications[Affiliates_Notifications_Extended::MESSAGE] = $_POST[Affiliates_Notifications_Extended::MESSAGE];
				} else {
					$notifications[Affiliates_Notifications_Extended::MESSAGE] = Affiliates_Notifications_Extended::DEFAULT_MESSAGE;
				}

				update_option( 'affiliates_notifications', $notifications );
			}
		}

		$registration_enabled = isset( $notifications[Affiliates_Notifications_Extended::REGISTRATION_ENABLED] ) ? $notifications[Affiliates_Notifications_Extended::REGISTRATION_ENABLED] : Affiliates_Notifications_Extended::REGISTRATION_ENABLED_DEFAULT;
		$registration_subject = isset( $notifications[Affiliates_Notifications_Extended::REGISTRATION_SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::REGISTRATION_SUBJECT] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_ACTIVE_SUBJECT );
		$registration_message = isset( $notifications[Affiliates_Notifications_Extended::REGISTRATION_MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::REGISTRATION_MESSAGE] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_ACTIVE_MESSAGE );

		$registration_pending_subject = isset( $notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_PENDING_SUBJECT );
		$registration_pending_message = isset( $notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_REGISTRATION_PENDING_MESSAGE );

		$affiliate_pending_to_active_subject = isset( $notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_SUBJECT );
		$affiliate_pending_to_active_message = isset( $notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE] : Affiliates_Notifications_Extended::get_default( Affiliates_Notifications_Extended::DEFAULT_AFFILIATE_PENDING_TO_ACTIVE_MESSAGE );

		$notify_affiliate   = isset( $notifications[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE] ) && $notifications[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE];
		$notify_affiliate_status = isset( $notifications[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE_STATUS] ) ? $notifications[Affiliates_Notifications_Extended::NOTIFY_AFFILIATE_STATUS] : array( AFFILIATES_REFERRAL_STATUS_ACCEPTED );
		$subject            = isset( $notifications[Affiliates_Notifications_Extended::SUBJECT] ) ? $notifications[Affiliates_Notifications_Extended::SUBJECT] : Affiliates_Notifications_Extended::DEFAULT_SUBJECT;
		$message            = isset( $notifications[Affiliates_Notifications_Extended::MESSAGE] ) ? $notifications[Affiliates_Notifications_Extended::MESSAGE] : Affiliates_Notifications_Extended::DEFAULT_MESSAGE;

		echo '<form action="" name="notifications" method="post">';

		echo '<div class="notifications">';

		echo '<div class="manage">';

		echo
		'<h1>' .
		__( 'Registration', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</h1>';

		echo
		'<div>' .

		// Affiliate registration notifications

		'<p>' .
		'<label>' .
		'<input type="checkbox" name="' . Affiliates_Notifications_Extended::REGISTRATION_ENABLED . '" id="' . Affiliates_Notifications_Extended::REGISTRATION_ENABLED . '" ' . ( $registration_enabled ? ' checked="checked" ' : '' ) . '/>' .
		__( 'Enable registration emails', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		'</p>' .
		'<p class="description">' .
		__( 'Send new affiliates an email when their user account is created.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		' ' .
		__( 'This should normally be enabled, so that new affiliates receive their username and password to be able to log in and access their account.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>' .

		'<h2>' . __( 'Affiliate Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h2>' .

		'<p>' .
		__( 'These templates are used to notify affiliates.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>' .

		// Pending

		'<h3>' . __( 'Pending', 'affiliates' ) . '</h3>' .

		'<p>' . __( 'This notification is sent to new affiliates if their application is pending approval.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .

		'<p>' .
		'<label>' .
		__( 'Subject', 'affiliates' ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT . '" name="' . Affiliates_Notifications_Extended::REGISTRATION_PENDING_SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $registration_pending_subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', 'affiliates' ) .
		'<br/>' .
		'<textarea class="' . Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE . '" id="' . Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE . '" name="' . Affiliates_Notifications_Extended::REGISTRATION_PENDING_MESSAGE . '" rows="10">' . htmlentities( stripslashes( $registration_pending_message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this affiliate notification is <strong>HTML</strong>.', 'affiliates' ) .
		'</span>' .
		'</p>' .

		// Active

		'<h3>' . __( 'Active', 'affiliates' ) . '</h3>' .

		'<p>' . __( 'This notification is sent to new affiliates if they are approved automatically.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .

		'<p>' .
		'<label>' .
		__( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::REGISTRATION_SUBJECT . '" name="' . Affiliates_Notifications_Extended::REGISTRATION_SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $registration_subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<textarea class="' . Affiliates_Notifications_Extended::REGISTRATION_MESSAGE . '" id="' . Affiliates_Notifications_Extended::REGISTRATION_MESSAGE . '" name="' . Affiliates_Notifications_Extended::REGISTRATION_MESSAGE . '" rows="10">' . htmlentities( stripslashes( $registration_message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this affiliate notification is <strong>HTML</strong>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</span>' .
		'</p>' .

		// Status updated from Pending to Active

		'<h3>' . __( 'Status changed from Pending to Active', 'affiliates' ) . '</h3>' .

		'<p>' . __( 'This notification is sent to affiliates once they are approved.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .

		'<p>' .
		'<label>' .
		__( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT . '" name="' . Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $affiliate_pending_to_active_subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<textarea class="' . Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE . '" id="' . Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE . '" name="' . Affiliates_Notifications_Extended::AFFILIATE_PENDING_TO_ACTIVE_MESSAGE . '" rows="10">' . htmlentities( stripslashes( $affiliate_pending_to_active_message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this affiliate notification is <strong>HTML</strong>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</span>' .
		'</p>' .

		'<p>' .
		wp_nonce_field( self::SETTINGS, self::NONCE, true, false ) .
		'<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' .
		'</p>' .

		'</div>' .

		'</div>'; // .manage

		echo '</div>'; // .notifications

		echo '<div class="notifications">';

		echo '<div class="manage">';

		echo
		'<h1>' .
		__( 'Referrals', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</h1>';

		echo
		'<p>' .
		__( 'Notifications for the affiliates can be enabled here. If the integration used provides its own notification settings, enable these through the integration&rsquo;s settings or here. Do not enable them both, as that could cause duplicate notifications to be sent.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>';

		echo
		'<div>' .

		'<h2>' .
		__( 'Referral Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</h2>' .

		'<p>' .
		'<label>' .
		'<input type="checkbox" name="' . Affiliates_Notifications_Extended::NOTIFY_AFFILIATE . '" id="' . Affiliates_Notifications_Extended::NOTIFY_AFFILIATE . '" ' . ( $notify_affiliate ? ' checked="checked" ' : '' ) . '/>' .
		__( 'Notify the affiliates', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		'</p>' .
		'<p class="description">' .
		__( 'Notifications will be sent to affiliates when credited with a referral.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</p>' .

		'<p>' .
		__( 'Notify when a referral is: ', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<label>' .
		sprintf( '<input type="checkbox" name="notify_affiliate_status_accepted" %s />', in_array( AFFILIATES_REFERRAL_STATUS_ACCEPTED, $notify_affiliate_status ) ? ' checked="checked" ' : '' ) .
		__( 'Accepted', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		' ' .
		'<label>' .
		sprintf( '<input type="checkbox" name="notify_affiliate_status_pending" %s />', in_array( AFFILIATES_REFERRAL_STATUS_PENDING, $notify_affiliate_status ) ? ' checked="checked" ' : '' ) .
		__( 'Pending', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</label>' .
		'</p>' .
		'<ul class="description">' .
		'<li>' . __( 'Notifications on referral status updates are only sent when the status changes from <em>pending</em> to <em>accepted</em>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li>' . __( 'More than one notification may be sent if multiple statuses are enabled.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li>' . __( 'Notifications on referral status updates may not be supported by all integrations.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'</ul>' .

		'<p>' .
		'<label>' .
		__( 'Subject', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<input class="' . Affiliates_Notifications_Extended::SUBJECT . '" name="' . Affiliates_Notifications_Extended::SUBJECT . '" type="text" value="' . esc_attr( stripslashes( $subject ) ) . '" />' .
		'</label>' .
		'</p>' .

		'<p>' .
		'<label> ' .
		__( 'Message', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<br/>' .
		'<textarea class="' . Affiliates_Notifications_Extended::MESSAGE . '" id="' . Affiliates_Notifications_Extended::MESSAGE . '" name="' . Affiliates_Notifications_Extended::MESSAGE . '" rows="10">' . htmlentities( stripslashes( $message ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</textarea>' .
		'</label>' .
		'<br/>' .
		'<span class="description">' .
		__( 'The format for this affiliate notification is <strong>HTML</strong>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'</span>' .
		'</p>' .

		'<p>' .
		wp_nonce_field( self::SETTINGS, self::NONCE, true, false ) .
		'<input class="button button-primary" type="submit" name="submit" value="' . __( 'Save', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '"/>' .
		'</p>' .

		'</div>' .

		'</div>'; // .manage

		echo '</div>'; // .notifications

		echo '</form>';

	}

	/**
	 * Adds help tabs.
	 */
	public static function load_page() {
		$screen = get_current_screen();
		if ( isset( $screen->id ) ) {
			switch ( $screen->id ) {
				case 'affiliates_page_affiliates-admin-notifications' :
					$screen->add_help_tab( array(
					'id' => 'affiliates-admin-notifications-affiliate-registration',
					'title' => __( 'Affiliate Registration', AFFILIATES_PRO_PLUGIN_DOMAIN )	,
					'content' => self::get_notifications_help_affiliate_registration()
					) );
					$screen->add_help_tab( array(
							'id' => 'affiliates-admin-notifications-referral-notifications',
							'title' => __( 'Referral Notifications', AFFILIATES_PRO_PLUGIN_DOMAIN )	,
							'content' => self::get_notifications_help_referral_notifications()
					) );
					break;
			}
		}
	}

	/**
	 * Affiliate registration help tab content.
	 * @return string
	 */
	private static function get_notifications_help_affiliate_registration() {
		return
		'<div class="manage">' .
		'<h2>' . __( 'Affiliates Registration', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h2>' .

		'<h3>' . __( 'Message format and tokens', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' .

		'<p class="description">' . __( 'The message format is HTML and line breaks must be indicated by <code>&lt;br/&gt;</code>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<p class="description">' . __( 'These default tokens can be used in the subjects and the messages:', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<ul>' .
		'<li><code>[site_title]</code> : '. wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES ) . '</li>' .
		'<li><code>[site_url]</code> : '. htmlentities( get_bloginfo( 'url' ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</li>' .
		'<li><code>[site_login_url]</code> : '. htmlentities( wp_login_url(), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</li>' .
		'<li><code>[username]</code> : ' . __( 'The username for the new affiliate user account.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[password]</code> : '. __( 'The password for the new affiliate user account.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[user_id]</code> : '. __( 'The ID of the new affiliate user account. This is the user ID, not the affiliate ID.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[blogname]</code> : '. __( 'Same as [site_title].', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'</ul>' .
		'</p>' .

		'<h3>' . __( 'Default subject and message', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h4>' .

		'<p class="description">' . __( 'Subject:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .
		'<pre>' . htmlentities( stripslashes( Affiliates_Notifications::get_default( Affiliates_Notifications::DEFAULT_REGISTRATION_ACTIVE_SUBJECT ) ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' .
		'<p class="description">' . __( 'Message:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .
		'<pre>' . htmlentities( stripslashes( Affiliates_Notifications::get_default( Affiliates_Notifications::DEFAULT_REGISTRATION_ACTIVE_MESSAGE ) ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' .
		'</div>' . // .manage
		Affiliates_Admin_Menu_WordPress::get_help_tab_footer();
	}

	/**
	 * Referral notification help tab content.
	 * @return string
	 */
	private static function get_notifications_help_referral_notifications() {
		return
		'<div class="manage">' .

		'<h3>' . __( 'Message format and tokens', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h3>' .

		'<p class="description">' . __( 'The message format is HTML and line breaks must be indicated by <code>&lt;br/&gt;</code>.', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<p class="description">' . __( 'These default tokens can be used in the subjects and the messages:', AFFILIATES_PRO_PLUGIN_DOMAIN ) .
		'<ul>' .
		'<li><code>[site_title]</code> : '. wp_specialchars_decode( get_bloginfo( 'blogname' ), ENT_QUOTES ) . '</li>' .
		'<li><code>[site_url]</code> : '. htmlentities( get_bloginfo( 'url' ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</li>' .
		'<li><code>[affiliate_id]</code> : ' . __( 'The referring affiliate&rsquo;s ID', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[affiliate_email]</code> : '. __( 'The referring affiliate&rsquo;s email address', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[affiliate_name]</code> : '. __( 'The referring affiliate&rsquo;s name', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[referral_status]</code> : '. __( 'The current referral status', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[referral_amount]</code> : '. __( 'The referral amount', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[referral_currency_id]</code> : '. __( 'The referral currency ID', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[referral_type]</code> : '. __( 'The referral type (an internal reference)', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'<li><code>[referral_reference]</code> : '. __( 'The referral reference (an internal reference normally related to the originating transaction)', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</li>' .
		'</ul>' .
		'</p>' .
		'<p class="description">' . __( 'Integration-specific data tokens can also be used in the subject and message.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .

		'<h4>' . __( 'Default subjects and messages', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</h4>' .

		'<p class="description">' . __( 'Administrator subject:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .
		'<pre>' . htmlentities( Affiliates_Notifications_Extended::ADMIN_DEFAULT_SUBJECT, ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' .
		'<p class="description">' . __( 'Administrator message:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .
		'<pre>' . htmlentities( stripslashes( Affiliates_Notifications_Extended::ADMIN_DEFAULT_MESSAGE ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' .

		'<p class="description">' . __( 'Affiliate subject:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .
		'<pre>' . htmlentities( Affiliates_Notifications_Extended::DEFAULT_SUBJECT, ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' .
		'<p class="description">' . __( 'Affiliate message:', AFFILIATES_PRO_PLUGIN_DOMAIN ) . '</p>' .
		'<pre>' . htmlentities( stripslashes( Affiliates_Notifications_Extended::DEFAULT_MESSAGE ), ENT_COMPAT, get_bloginfo( 'charset' ) ) . '</pre>' .
		'</div>' . // .manage
		Affiliates_Admin_Menu_WordPress::get_help_tab_footer();
	}

}
