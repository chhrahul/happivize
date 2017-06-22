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
 * A shortcode for testimonials
 *
 * <p>Usage: [offer_testimonial cite=""][/offer_testimonial]</p>
 */
class DNC_Shortcode_Testimonial extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_testimonial';
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$atts = shortcode_atts( array(
			'cite' => '',
		), $atts, $name );
		
		$content = MZ_Strings::mb_trim( do_shortcode( $content ) );
		
		return ( '' === $content ) ? '' : sprintf( '<figure class="dnc-wc-offer-testimonial"><blockquote class="dnc-wc-offer-testimonial-quote">%s</blockquote><figcaption class="dnc-wc-offer-cite">%s</figcaption></figure>', $content, MZ_Strings::mb_trim( $atts[ 'cite' ] ) );
	} // method DNC_Shortcode_Testimonial::hook
} // class DNC_Shortcode_Testimonial
