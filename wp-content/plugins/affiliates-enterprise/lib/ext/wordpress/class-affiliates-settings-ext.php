<?php
 if ( !defined( 'ABSPATH' ) ) { exit; } class Affiliates_Settings_Ext { public static function init() { add_filter( 'affiliates_setup_buttons', array( __CLASS__, 'affiliates_setup_buttons' ) ); } public static function affiliates_setup_buttons( $IXAP328 ) { $IXAP328['commissions'] = sprintf ( '<a href="%s" class="button-primary">%s</a>', add_query_arg( 'section', 'commissions', admin_url( 'admin.php?page=affiliates-admin-settings' ) ), __( 'Set up Commissions', AFFILIATES_PLUGIN_DOMAIN ) ); $IXAP328['banners'] = sprintf ( '<a href="%s" class="button-primary">%s</a>', add_query_arg( 'section', 'banners', admin_url( 'edit.php??post_type=affiliates_banner' ) ), __( 'Upload Banners', AFFILIATES_PLUGIN_DOMAIN ) ); $IXAP328['notifications'] = sprintf ( '<a href="%s" class="button-primary">%s</a>', add_query_arg( 'section', 'notifications', admin_url( 'admin.php?page=affiliates-admin-notifications' ) ), __( 'Enable Notifications', AFFILIATES_PLUGIN_DOMAIN ) ); return $IXAP328; } } Affiliates_Settings_Ext::init(); 