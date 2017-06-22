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
 * Emits the information widget for the offer's speaker
 *
 * Usage: [offer_speaker /]
 */
class DNC_Shortcode_Speaker extends DNC_Shortcode{
	const CANONICAL_NAME = 'offer_speaker';
	
	public function hook( $atts = '', $content = '', $name = '' ){
		$prefix = 'dnc-wc-offer-speaker';
		$offer = DNC_PostType_Offer::getPost();
		
		if( !( $offer instanceof DNC_Post ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Unable to fetch offer information', __METHOD__ ) );
			
			return '';
		} // endif !( $offer instanceof DNC_Post )
		
		if( !ob_start() ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Unable to start output buffer', __METHOD__ ) );
			
			return '';
		} // endif !ob_start()
		
		$mugshot = $offer->speakerMugshot;
		$mugshot = ( 0 === $mugshot ) ? '' : wp_get_attachment_image_src( $mugshot, 'full' );
		$mugshot = is_array( $mugshot ) ? $mugshot[ 0 ] : '';
		$name = $offer->speakerName;
		
		if( ( '' === $mugshot ) && ( '' === $name ) ){
			if( WP_DEBUG )
				error_log( sprintf( '[%s] Insufficient speaker information: %s', __METHOD__, $offer->ID ) );
			
			return '';
		} // endif ( '' === $mugshot ) && ( '' === $name )
		
		$title = $offer->speakerTitle;
		$bio = $offer->speakerBio;
?>
<aside class="<?php echo $prefix; ?> row">
	<div class="col-sm-4">
<?php
	if( !( '' === $mugshot ) ){
?>
		<p class="<?php echo $prefix; ?>-mugshot"><img alt="" src="<?php echo $mugshot; ?>" class="<?php echo $prefix; ?>-mugshot-img" /></p>
<?php
	} // endif !( '' === $mugshot )
	
	if( !( '' === $name ) ){
?>
		<p class="<?php echo $prefix; ?>-name"><?php echo $name; ?></p>
<?php
	} // endif !( '' === $name )
	
	if( !( '' === $title ) ){
?>
		<p class="<?php echo $prefix; ?>-title"><?php echo $title; ?></p>
<?php
	} // endif !( '' === $title )
?>
	</div>
	<div class="<?php echo $prefix; ?>-bio col-sm-8"><?php echo $bio; ?></div>
</aside> <!-- .<?php echo $prefix; ?> -->
<?php
		return ob_get_clean();
	} // method DNC_Shortcode_Speaker::hook
} // class DNC_Shortcode_Speaker
