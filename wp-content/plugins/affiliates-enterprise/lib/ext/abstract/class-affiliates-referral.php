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

	
abstract class Affiliates_Referral implements I_Affiliates_Referral { const IXAP121 = 'aff_def_ref_calc_key'; const IXAP122 = 'aff_def_ref_calc_value'; private $referral = null; private static $referral_amount_methods = array(); public static function init() { self::register_referral_amount_method( array( __CLASS__, 'example_referral_amount_method' ) ); } public static function example_referral_amount_method( $affiliate_id = null, $IXAP175 = null ) { $IXAP11 = "0"; if ( isset( $IXAP175['base_amount'] ) ) { $IXAP11 = bcmul( "0.1", $IXAP175['base_amount'] ); } return $IXAP11; } public static function register_referral_amount_method( $IXAP176 ) { $IXAP11 = false; if ( is_string( $IXAP176 ) ) { $IXAP176 = explode( "::", $IXAP176 ); if ( count( $IXAP176 ) == 1 ) { $IXAP176 = $IXAP176[0]; } } if ( in_array( $IXAP176, self::$referral_amount_methods ) ) { $IXAP11 = true; } else if ( ( ( is_array( $IXAP176 ) && ( count( $IXAP176 ) == 2 ) && method_exists( $IXAP176[0], $IXAP176[1] ) ) ) || ( is_string( $IXAP176 ) && function_exists( $IXAP176 ) ) ) { $amount = bcadd( "0", call_user_func( $IXAP176, null, null ) ); if ( $amount !== false ) { self::$referral_amount_methods[] = $IXAP176; $IXAP11 = true; } } return $IXAP11; } public static function get_referral_amount_methods() { return self::$referral_amount_methods; } public static function is_referral_amount_method( $IXAP176 ) { return self::get_referral_amount_method( $IXAP176 ); } public static function get_referral_amount_method( $IXAP176 ) { $IXAP177 = @unserialize( $IXAP176 ); if ( $IXAP177 !== false ) { $IXAP176 = $IXAP177; } if ( is_string( $IXAP176 ) ) { $IXAP176 = explode( "::", $IXAP176 ); if ( count( $IXAP176 ) == 1 ) { $IXAP176 = $IXAP176[0]; } } if ( in_array( $IXAP176, self::$referral_amount_methods ) ) { return $IXAP176; } else { return false; } } } Affiliates_Referral::init(); 