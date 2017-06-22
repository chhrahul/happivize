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

	
 global $IXAP210; $IXAP210 = null; function fake_bcadd( $IXAP211, $IXAP212, $scale = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP211 ) + doubleval( $IXAP212 ) ), $scale ); } function fake_bccomp( $IXAP211, $IXAP212, $scale = null ) { $IXAP213 = doubleval( fake_bcmath_scale( $IXAP211, $scale ) ); $IXAP214 = doubleval( fake_bcmath_scale( $IXAP212, $scale ) ); $IXAP215 = 0; if ( $IXAP213 < $IXAP214 ) { $IXAP215 = -1; } else if ( $IXAP213 > $IXAP214 ) { $IXAP215 = 1; } return $IXAP215; } function fake_bcdiv( $IXAP211, $IXAP212, $scale = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP211 ) / doubleval( $IXAP212 ) ), $scale ); } function fake_bcmod( $IXAP211, $IXAP216 ) { return ( string ) ( intval( $IXAP211 ) % intval( $IXAP216 ) ); } function fake_bcmul( $IXAP211, $IXAP212, $scale = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP211 ) * doubleval( $IXAP212 ) ), $scale ); } function fake_bcpow( $IXAP211, $IXAP212, $scale = null ) { return fake_bcmath_scale( ( string ) ( pow( doubleval( $IXAP211 ), doubleval( $IXAP212 ) ) ), $scale ); } function fake_bcpowmod( $IXAP211 , $IXAP212 , $IXAP216, $scale = null ) { if ( $IXAP216 == 0 ) { $IXAP90 = null; } else { $IXAP90 = fake_bcmath_scale( ( string ) ( pow( doubleval( $IXAP211 ), doubleval( $IXAP212 ) ) % intval( $IXAP216 ) ), $scale ); } return $IXAP90; } function fake_bcscale( $scale ) { global $IXAP210; $s = intval( $scale ); if ( $s >= 0 ) { $IXAP210 = $s; return true; } else { return false; } } function fake_bcsqrt( $IXAP217, $scale = null ) { return fake_bcmath_scale( ( string ) sqrt( doubleval( $IXAP217 ) ), $scale ); } function fake_bcsub( $IXAP211, $IXAP212, $scale = null ) { return fake_bcmath_scale( ( string ) ( doubleval( $IXAP211 ) - doubleval( $IXAP212 ) ), $scale ); } function fake_bcmath_scale( $value, $scale = null ) { global $IXAP210; $s = null; if ( $scale !== null ) { $s = intval( $scale ); } else if ( $IXAP210 !== null ) { $s = intval( $IXAP210 ); } if ( $s !== null ) { return ( string ) round( doubleval( $value ), $s ); } else { return $value; } } if ( !function_exists( 'bcadd' ) ) { function bcadd( $IXAP211, $IXAP212, $scale = null ) { return fake_bcadd( $IXAP211, $IXAP212, $scale ); } function bccomp( $IXAP211, $IXAP212, $scale = null ) { return fake_bccomp( $IXAP211, $IXAP212, $scale ); } function bcdiv( $IXAP211, $IXAP212, $scale = null ) { return fake_bcdiv($IXAP211, $IXAP212, $scale ); } function bcmod( $IXAP211, $IXAP216 ) { return fake_bcmod( $IXAP211, $IXAP216 ); } function bcmul( $IXAP211, $IXAP212, $scale = null ) { return fake_bcmul( $IXAP211, $IXAP212, $scale ); } function bcpow( $IXAP211, $IXAP212, $scale = null ) { return fake_bcpow($IXAP211, $IXAP212, $scale ); } function bcpowmod( $IXAP211 , $IXAP212 , $IXAP216, $scale = null ) { return fake_bcpowmod($IXAP211, $IXAP212, $IXAP216, $scale ); } function bcscale( $scale ) { return fake_bcscale( $scale ); } function bcsqrt( $IXAP217, $scale = null ) { return fake_bcsqrt( $IXAP217, $scale ); } function bcsub( $IXAP211, $IXAP212, $scale = null ) { return fake_bcsub( $IXAP211, $IXAP212, $scale ); } } 