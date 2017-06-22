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

	
abstract class Affiliates_Attributes implements I_Affiliates_Attributes { protected static $IXAP127; const IXAP128 = 'paypal_email'; const REFERRAL_AMOUNT = 'referral.amount'; const REFERRAL_AMOUNT_METHOD = 'referral.amount.method'; const REFERRAL_RATE = 'referral.rate'; const IXAP129 = 'coupons'; const IXAP130 = 'cookie.timeout.days'; public static function init() { self::$IXAP127 = array( self::IXAP128 => 'PayPal Email', self::REFERRAL_AMOUNT => 'Referral Amount', self::REFERRAL_AMOUNT_METHOD => 'Referral Amount Method', self::REFERRAL_RATE => 'Referral Rate', self::IXAP129 => 'Coupons', self::IXAP130 => 'Cookie Expiration' ); } public static function set_keys($IXAP127) { self::$IXAP127 = $IXAP127; } public static function get_keys() { return self::$IXAP127; } public static function validate_key( $key ) { if ( key_exists( $key, self::$IXAP127 ) ) { return $key; } else { return false; } } public static function validate_value( $key, $value ) { $IXAP131 = new Affiliates_Validator(); $IXAP11 = false; switch ( $key ) { case self::IXAP128 : $IXAP11 = $IXAP131->validate_email( $value ); break; case self::REFERRAL_AMOUNT : case self::REFERRAL_RATE : $IXAP11 = $IXAP131->validate_amount( $value ); break; case self::REFERRAL_AMOUNT_METHOD : $IXAP11 = Affiliates_Referral::is_referral_amount_method( $value ); break; case self::IXAP129 : $value = trim( $value ); $IXAP132 = explode( ",", $value ); $values = array(); foreach( $IXAP132 as $IXAP133 ) { $IXAP133 = trim( $IXAP133 ); if ( !empty( $IXAP133 ) && !in_array( $IXAP133, $values ) ) { $values[] = $IXAP133; } } $value = implode( ",", $values ); if ( !empty( $value ) ) { $IXAP11 = $value; } break; case self::IXAP130 : $value = intval( trim( $value ) ); if ( $value < 0 ) { $value = 0; } $IXAP11 = $value; break; } return $IXAP11; } } Affiliates_Attributes::init(); 