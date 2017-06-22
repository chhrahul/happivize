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

	
class Affiliates_Validator implements I_Affiliates_Validator { public static function validate_amount( $amount ) { $IXAP11 = null; if ( preg_match( "/([0-9,]+)?(\.[0-9]+)?/", $amount, $IXAP125 ) ) { if ( isset( $IXAP125[1] ) ) { $n = str_replace(",", "", $IXAP125[1] ); } else { $n = "0"; } if ( isset( $IXAP125[2] ) ) { $IXAP162 = substr( $IXAP125[2], 1, AFFILIATES_REFERRAL_AMOUNT_DECIMALS ); } else { $IXAP162 = "0"; } if ( isset( $IXAP125[0] ) && sizeof( $IXAP125 > 1 ) && ( isset( $IXAP125[1] ) || isset( $IXAP125[2] ) ) ) { $IXAP11 = $n . "." . $IXAP162; } } return $IXAP11; } public static function validate_email( $IXAP184 ) { $IXAP11 = false; $IXAP198 = filter_var( $IXAP184, FILTER_VALIDATE_EMAIL ); if ( ( $IXAP198 !== false ) && ( $IXAP198 === $IXAP184 ) ) { $IXAP11 = $IXAP198; } return $IXAP11; } } 