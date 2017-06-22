<?php
/*
Copyright (c) 2017 Designs and Codes

Permission is hereby granted, free of charge, to any person obtaining a copy 
of this software and associated documentation files (the "Software"), to deal 
in the Software without restriction, including without limitation the rights 
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
copies of the Software, and to permit persons to whom the Software is 
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in 
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
SOFTWARE.
*/

/**
 * Sets up a section within the post/page
 *
 * Usage: [offer_section width="" background="" color=""][/offer_section]
 */
class DNC_Shortcode_Section extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_section';
	const PATTERN_COLOR = '^#?[0-9a-fA-F]{3}(?:[0-9a-fA-F]{3})?$|^rgba?\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*\)$'; // Hex | RGBA
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$atts = array_map( 'MZ_Strings::mb_trim', shortcode_atts( array(
			'width' => '',
			'background' => '',
			'color' => '',
		), $atts, $name ) );
		
		$content = MZ_Strings::mb_trim( do_shortcode( $content ) );
		
		if( '' === $content )
			return '';
		
		$class = 'dnc-wc-offer-section';
		$style = array();
		
		if( empty( $atts[ 'width' ] ) )
			$atts[ 'width' ] = 'narrow';
		
		if( 'full' !== $atts[ 'width' ] ){
			$atts[ 'width' ] = absint( $atts[ 'width' ] );
			
			if( 0 < $atts[ 'width' ] ){
				$style[] = sprintf( 'max-width: %dpx', $atts[ 'width' ] );
			}else
				$class .= ' dnc-wc-offer-section-narrow';
		}else
			$class .= ' dnc-wc-offer-section-full';
		
		foreach( array(
			'background' => 'background-color: %s',
			'color' => 'color: %s',
		) as $key => $format )
			if( mb_ereg_match( self::PATTERN_COLOR, $atts[ $key ] ) )
				$style[] = sprintf( $format, $atts[ $key ] );
		
		$style = implode( '; ', $style );
		
		return ( '' === $content ) ? '' : sprintf( '<div class="%s" style="%s">%s</div>', $class, $style, $content );
	} // method DNC_Shortcode_Section::hook
} // class DNC_Shortcode_Section
