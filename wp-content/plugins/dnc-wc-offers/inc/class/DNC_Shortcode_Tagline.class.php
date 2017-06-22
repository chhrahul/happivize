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
 * An alias for [offer_heading type="tagline"]
 *
 * @see DNC_Shortcode_Heading
 */
class DNC_Shortcode_Tagline extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_tagline';
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$atts = shortcode_atts( array(
			'tag' => '',
		), $atts, $name );
		
		$atts[ 'type' ] = 'tagline';
		$delegate = DNC_Shortcode_Heading::getInstance();
		
		return $delegate->hook( $atts, $content, DNC_Shortcode_Heading::CANONICAL_NAME );
	} // method DNC_Shortcode_Tagline::hook
} // class DNC_Shortcode_Tagline
