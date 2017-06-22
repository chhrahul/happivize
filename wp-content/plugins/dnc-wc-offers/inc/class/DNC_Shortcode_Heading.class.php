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
 * A heading shortcode
 *
 * Usage: [offer_heading tag="" type=""][/offer_heading]
 */
class DNC_Shortcode_Heading extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_heading';
	
	private static /* string[] */ $fValidTags = array(
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'p',
		'div',
	);
	
	private static /* string[] */ $fValidTypes = array(
		'plain' => 'h2',
		'tagline' => 'h1',
		'heading' => 'h3',
		'subheading' => 'h4',
	);
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$atts = shortcode_atts( array(
			'tag' => '',
			'type' => '',
		), $atts, $name );
		
		$tag = MZ_Strings::normalize_token_lower( $atts[ 'tag' ] );
		$type = MZ_Strings::normalize_token_lower( $atts[ 'type' ] );
		$content = MZ_Strings::mb_trim( do_shortcode( $content ) );
		
		if( !isset( self::$fValidTypes[ $type ] ) ){
			reset( self::$fValidTypes );
			$type = key( self::$fValidTypes );
		} // endif !isset( self::$fValidTypes[ $type ] )
		
		if( !in_array( $tag, self::$fValidTags ) )
			$tag = self::$fValidTypes[ $type ];
		
		return ( '' === $content ) ? '' : sprintf( '<%1$s class="dnc-wc-offer-heading-%2$s">%3$s</%1$s>', $tag, esc_attr( $type ), $content );
	} // method DNC_Shortcode_Heading::hook
} // class DNC_Shortcode_Heading
