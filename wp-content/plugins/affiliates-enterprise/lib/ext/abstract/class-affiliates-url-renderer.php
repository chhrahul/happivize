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

	
 abstract class Affiliates_Url_Renderer implements I_Affiliates_Url_Renderer { protected static $IXAP5 = 'affiliates'; protected static $IXAP6 = 'cmid'; protected static $IXAP29 = null; protected static $IXAP192 = array( 'type' => self::TYPE_AUTO, 'url' => null ); static function render_affiliate_url( $IXAP24 = array(), $implementation = array() ) { $IXAP34 = ''; if ( $affiliate_id = call_user_func( array( $implementation['Affiliates_Affiliate'], 'get_user_affiliate_id' ) ) ) { $IXAP193 = call_user_func( self::$IXAP29, $affiliate_id ); } else { $IXAP193 = 'affiliate-id'; } if ( !isset( $IXAP24['type'] ) ) { $IXAP24['type'] = self::TYPE_AUTO; } if ( isset( $IXAP24['url'] ) ) { $IXAP8 = $IXAP24['url']; } else { $IXAP8 = ''; } switch ( $IXAP24['type'] ) { case self::TYPE_APPEND : $IXAP34 = self::get_affiliate_url( $IXAP8, $affiliate_id ); break; case self::TYPE_PARAMETER : $IXAP34 = self::get_affiliate_url( $IXAP8, $affiliate_id ); break; case self::TYPE_PRETTY : $IXAP34 = $IXAP8 . '/' . self::$IXAP5 . '/' . $IXAP193; break; case self::TYPE_AUTO : default : if ( isset( $IXAP24['use_parameter'] ) && $IXAP24['use_parameter'] ) { $IXAP34 = $IXAP8 . '/' . self::$IXAP5 . '/' . $IXAP193; } else { $IXAP34 = self::get_affiliate_url( $IXAP8, $affiliate_id ); } break; } return $IXAP34; } public static function compose_url( $IXAP52 ) { $scheme = isset( $IXAP52['scheme'] ) ? $IXAP52['scheme'] . '://' : ''; $IXAP0 = isset( $IXAP52['host'] ) ? $IXAP52['host'] : ''; $IXAP194 = isset( $IXAP52['port'] ) ? ':' . $IXAP52['port'] : ''; $user = isset( $IXAP52['user'] ) ? $IXAP52['user'] : ''; $IXAP195 = isset( $IXAP52['pass'] ) ? ':' . $IXAP52['pass'] : ''; $IXAP195 = ( !empty( $user ) || !empty( $IXAP195 ) ) ? "$IXAP195@" : ''; $IXAP196 = isset( $IXAP52['path'] ) ? $IXAP52['path'] : ''; $IXAP3 = isset( $IXAP52['query'] ) ? '?' . $IXAP52['query'] : ''; $IXAP197 = isset( $IXAP52['fragment'] ) ? '#' . $IXAP52['fragment'] : ''; return "$scheme$user$IXAP195$IXAP0$IXAP194$IXAP196$IXAP3$IXAP197"; } public static function get_affiliate_url( $IXAP30, $affiliate_id, $IXAP12 = null, $params = array() ) { $IXAP5 = self::$IXAP5; $IXAP6 = self::$IXAP6; $IXAP29 = self::$IXAP29; $scheme = parse_url( $IXAP30, PHP_URL_SCHEME ); if ( empty( $scheme ) ) { $prefix = ''; if ( strpos( $IXAP30, 'http://' ) !== 0 && strpos( $IXAP30, 'https://' ) !== 0 ) { $prefix = !empty( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) != 'off' ? 'https:' : 'http:'; if ( strpos( $IXAP30, '//' ) !== 0 ) { $prefix .= '//'; } } $IXAP30 = $prefix . $IXAP30; } $IXAP52 = parse_url( $IXAP30 ); if ( strpos( isset( $IXAP52['query'] ) ? $IXAP52['query'] : '', "$IXAP5=" ) === false ) { $IXAP3 = ''; if ( !empty( $IXAP52['query'] ) ) { $IXAP3 = $IXAP52['query'] . '&'; } $IXAP193 = $affiliate_id; if ( !empty( $IXAP29 ) ) { $IXAP193 = call_user_func( $IXAP29, $affiliate_id ); } $IXAP3 .= sprintf( '%s=%s', $IXAP5, $IXAP193 ); if ( empty( $IXAP52['path'] ) ) { $IXAP52['path'] = '/'; } if ( !empty( $IXAP12 ) ) { $IXAP3 .= '&'; $IXAP3 .= sprintf( '%s=%s', $IXAP6, $IXAP12 ); } $IXAP52['query'] = $IXAP3; } return self::compose_url( $IXAP52 ); } } 