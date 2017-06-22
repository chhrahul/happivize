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
 * Sets up a small callout element
 *
 * Usage: [offer_callout option=""][/offer_callout]
 */
class DNC_Shortcode_Callout extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_callout';
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$atts = shortcode_atts( array(
			'option' => '',
		), $atts, $name );
		
		$option = MZ_Strings::normalize_token_lower( $atts[ 'option' ] );
		$content = MZ_Strings::mb_trim( do_shortcode( $content ) );
		$prefix = 'dnc-wc-offer-callout';
		
		if( '' === $option )
			$option = 'simple';
		
		return ( '' === $content ) ? '' : sprintf( '<figure class="%1$s %1$s-%2$s"><div class="%1$s-basin"><div class="%1$s-floater"><div class="%1$s-content">%3$s</div></div></div></figure>', $prefix, $option, $content );
	} // method DNC_Shortcode_Callout::hook
} // class DNC_Shortcode_Callout
