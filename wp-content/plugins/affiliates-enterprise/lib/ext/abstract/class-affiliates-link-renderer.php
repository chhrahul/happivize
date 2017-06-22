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

	
 abstract class Affiliates_Link_Renderer implements I_Affiliates_Link_Renderer { protected static $IXAP171 = array( 'render' => self::IXAP172, 'content' => null, 'type' => self::TYPE_AUTO, 'url' => null, 'a_class' => null, 'a_id' => null, 'a_style' => null, 'a_title' => null, 'a_name' => null, 'a_rel' => null, 'a_rev' => null, 'a_target' => null, 'a_type' => null, 'img_alt' => null, 'img_class' => null, 'img_height' => null, 'img_id' => null, 'img_name' => null, 'img_src' => null, 'img_title' => null, 'img_width' => null, 'attachment_id' => null, 'size' => 'full' ); public static function render_affiliate_link( $IXAP24 = array(), $IXAP32 = null, $implementation = array() ) { $IXAP34 = ''; $IXAP30 = call_user_func( array( $implementation['Affiliates_Url_Renderer'], 'render_affiliate_url'), $IXAP24 ); if ( empty( $IXAP32 ) ) { if ( !empty( $IXAP24['content'] ) ) { $IXAP32 = $IXAP24['content']; } else { $IXAP32 = $IXAP30; } } $IXAP173 = array(); $img_options = array(); foreach ( $IXAP24 as $key => $value ) { if ( strpos($key, "a_") === 0 ) { if ( $value !== null ) { $IXAP173[substr( $key, 2 )] = $value; } } else if ( strpos($key, "img_") === 0 ) { if ( $value !== null ) { switch ( $key ) { case 'img_height' : if ( preg_match( "/(\d+)(px|\%)?/", $value, $IXAP125 ) ) { $img_height = intval( $IXAP125[1] ); if ( isset( $IXAP125[2] ) ) { $img_height_units = $IXAP125[2] == "px" ? "px" : "%"; } else { $img_height_units = ""; } $img_options['height'] = $img_height . $img_height_units; } break; case 'img_width' : if ( preg_match( "/(\d+)(px|\%)?/", $value, $IXAP125 ) ) { $img_width = intval( $IXAP125[1] ); if ( isset( $IXAP125[2] ) ) { $img_width_units = $IXAP125[2] == "px" ? "px" : "%"; } else { $img_width_units = ""; } $img_options['width'] = $img_width . $img_width_units; } break; default : $img_options[substr( $key, 4 )] = $value; } } } } if ( !empty( $img_height ) && !empty( $img_width ) ) { $img_size = array( $img_width, $img_height ); } else if ( isset( $IXAP24['size'] ) ) { if ( in_array( $IXAP24['size'], $implementation['image_sizes'] ) ) { $img_size = $IXAP24['size']; } else { $img_size = self::$IXAP171['size']; } } $IXAP34 = '<a href="' . $IXAP30 . '"'; foreach( $IXAP173 as $key => $value ) { $IXAP34 .= ' ' . $key . '="' . call_user_func( $implementation['esc_attr'], $value ) . '"'; } $IXAP34 .= '>'; if ( isset( $IXAP24['attachment_id'] ) ) { $IXAP34 .= call_user_func( $implementation['image_retriever'], $IXAP24['attachment_id'], $img_size, false, $img_options ); } else if ( isset( $IXAP24['img_src'] ) ) { $IXAP34 .= "<img "; foreach ( $img_options as $key => $value ) { $IXAP34 .= " $key=" . '"' . call_user_func( $implementation['esc_attr'], $value ) . '"'; } $IXAP34 .= ' />'; } else if ( isset( $IXAP24['content'] ) ) { $IXAP34 .= $IXAP24['content']; } else { $IXAP34 .= $IXAP32; } $IXAP34 .= '</a>'; if ( isset( $IXAP24['render'] ) && ( $IXAP24['render'] == self::IXAP174 ) ) { $IXAP34 = htmlentities( $IXAP34, ENT_COMPAT, get_bloginfo( 'charset' ) ); } return $IXAP34; } }