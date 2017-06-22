<?php
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
	
/**
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 *
 * UNAUTHORIZED USE AND DISTRIBUTION IS PROHIBITED.
 *
 * See COPYRIGHT.txt and LICENSE.txt
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * This header and all notices must be kept intact.
 */

	
 abstract class Affiliates_Affiliate implements I_Affiliates_Affiliate { public static function get_affiliate( $affiliate_id ) { global $affiliates_db; $affiliates_table = $affiliates_db->get_tablename( 'affiliates' ); $IXAP125 = $affiliates_db->get_objects( "SELECT * FROM $affiliates_table WHERE affiliate_id = %d", $affiliate_id ); if ( !empty( $IXAP125 ) ) { return $IXAP125[0]; } else { return null; } } public static function get_affiliate_user_id( $affiliate_id ) { global $affiliates_db; $affiliates_table = $affiliates_db->get_tablename( 'affiliates' ); $affiliates_users_table = $affiliates_db->get_tablename( 'affiliates_users' ); return $affiliates_db->get_value( "SELECT $affiliates_users_table.user_id FROM $affiliates_users_table LEFT JOIN $affiliates_table ON $affiliates_users_table.affiliate_id = $affiliates_table.affiliate_id WHERE $affiliates_users_table.affiliate_id = %d AND $affiliates_table.status ='active'", intval( $affiliate_id ) ); } public static function get_user_affiliate_id( $user_id = null ) { global $affiliates_db; $IXAP11 = false; if ( $user_id !== null ) { $affiliates_table = $affiliates_db->get_tablename( 'affiliates' ); $affiliates_users_table = $affiliates_db->get_tablename( 'affiliates_users' ); if ( $affiliate_id = $affiliates_db->get_value( "SELECT $affiliates_users_table.affiliate_id FROM $affiliates_users_table LEFT JOIN $affiliates_table ON $affiliates_users_table.affiliate_id = $affiliates_table.affiliate_id WHERE $affiliates_users_table.user_id = %d AND $affiliates_table.status ='active'", intval( $user_id ) ) ) { $IXAP11 = $affiliate_id; } } return $IXAP11; } public static function get_attribute( $affiliate_id, $key ) { global $affiliates_db; $value = null; if ( $key = Affiliates_Attributes::validate_key( $key ) ) { $affiliates_attributes_table = $affiliates_db->get_tablename( "affiliates_attributes" ); $value = $affiliates_db->get_value( "SELECT attr_value FROM $affiliates_attributes_table WHERE affiliate_id = %d AND attr_key = %s", intval( $affiliate_id ), $key ); } global $affiliates_attribute_filter; if ( !empty( $affiliates_attribute_filter ) && is_array( $affiliates_attribute_filter ) ) { foreach( $affiliates_attribute_filter as $IXAP126 ) { $value = call_user_func( $IXAP126, $value, $affiliate_id, $key ); } } return $value; } public static function register_attribute_filter( $IXAP126 ) { global $affiliates_attribute_filter; if ( empty( $affiliates_attribute_filter ) ) { $affiliates_attribute_filter = array(); } $affiliates_attribute_filter[] = $IXAP126; } } 