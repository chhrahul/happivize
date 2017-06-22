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
 * Implements the [offer_banner id=""][/offer_banner] shortcode
 *
 */
class DNC_Shortcode_Banner extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_banner';
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$atts = shortcode_atts( array(
			'id' => '',
		), $atts, $name );
		
		if( !empty( $atts[ 'id' ] ) ){
			$image = DNC_Shortcode_Image::getInstance();
			$image = $image->hook( $atts, '', DNC_Shortcode_Image::CANONICAL_NAME );
		} // endif !empty( $atts[ 'id' ] )
		
		$postType = DNC_PostType_Offer::POST_TYPE;
		
		if( empty( $image ) ){
			foreach( DNC_Plugin_Offers::lookupResource( 'images/banner-top.png', false ) as $banner ){ // Will iterate at most once
				$image = DNC_Plugin_Offers::resourceToVersionedURL( $banner );
				$image = sprintf( '<img alt="" src="%s" class="%s-banner-img" />', esc_attr( $image ), $postType );
			} // foreach $banner
		} // endif empty( $image )
		
		if( empty( $image ) )
			$image = '';
		
		if( empty( $content ) )
			$content = __( 'Content', 'dnc-wc-offers' );
		
		return sprintf( <<<'EOL'
<header class="%1$s-banner" role="banner">
	<h1 class="sr-only">%2$s</h1>
	%3$s
</header> <!-- .%1$s-banner -->
EOL
, $postType, do_shortcode( $content ), $image );
	} // method DNC_Shortcode_Banner::hook
} // class DNC_Shortcode_Banner
