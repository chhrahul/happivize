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
 * Displays the "meat" (sans header & footer) of a dnc-wc-offer single post
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
	$offer = DNC_PostType_Offer::getPost();
	$postType = DNC_PostType_Offer::POST_TYPE;
?>
<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	/**
	 * Deactivated at the request of the client
	 */
	if( false ){
		foreach( DNC_Plugin_Offers::lookupResource( 'images/banner-top.png', false ) as $banner ){ // Will iterate at most once
			$url = DNC_Plugin_Offers::resourceToVersionedURL( $banner );
?>
	<header class="<?php echo $postType; ?>-banner" role="banner">
		<h1 class="sr-only">Happivize</h1>
		<img alt="" src="<?php echo esc_attr( $url ); ?>" class="<?php echo $postType; ?>-banner-img" />
	</header> <!-- .<?php echo $postType; ?>-banner -->
<?php
		} // foreach $banner
	} // endif false
?>
	<div id="<?php echo $postType; ?>-intro" class="<?php echo $postType; ?>-intro <?php echo $postType; ?>-content">
<?php
	the_content();
?>
	</div> <!-- #<?php echo $postType; ?>-intro -->
<?php
	if( !post_password_required( $offer->post ) ){
		$packages = array_values( $offer->packages );
		
		if( !empty( $packages ) ){
?>
	<div id="<?php echo $postType; ?>-packages" class="<?php echo $postType; ?>-packages">
<?php
			$counter = new DNC_Emit_Counter( $packages, get_the_title( $offer->post ) );
			
			foreach( $packages as $package )
				$package->emit( $counter );
?>
	</div> <!-- #<?php echo $postType; ?>-packages -->
<?php
		} // endif !empty( $packages )
		
		$outroContent = $offer->outroContent;
		
		if( '' !== $outroContent ){
?>
	<div id="<?php echo $postType; ?>-outro" class="<?php echo $postType; ?>-outro <?php echo $postType; ?>-content">
<?php
		echo DNC_PostType::prepareContent( $outroContent );
?>
	</div> <!-- #<?php echo $postType; ?>-outro -->
<?php
		} // endif '' !== $outroContent
	
		foreach( DNC_Plugin_Offers::lookupResource( 'images/badge.png', false ) as $icon )
			$guaranteeIconURL = DNC_Plugin_Offers::resourceToVersionedURL( $icon );
?>
	<div id="<?php echo $postType; ?>-finalize" class="<?php echo $postType; ?>-finalize <?php echo $postType; ?>-content">
		<footer class="<?php echo $postType; ?>-guarantee-row row">
			<div class="col-sm-8">
				<h2 class="<?php echo $postType; ?>-guarantee-heading"><?php _e( '100% Risk-Free &mdash;<br class="hidden-xs" /> You Have Nothing to Lose!', 'dnc-wc-offers' ); ?></h2>
			</div>
			<div class="col-sm-4"><img alt="" src="<?php echo esc_attr( $guaranteeIconURL ); ?>" class="<?php echo $postType; ?>-guarantee-icon" /></div>
		</footer> <!-- <?php echo $postType; ?>-guarantee-row -->
<?php
		if( !empty( $packages ) ){
?>
		<div class="<?php echo $postType; ?>-purchase-widgets">
<?php
			$counter->reset();
			
			foreach( $packages as $package )
				$package->emitPurchaseWidget( $counter );
?>
		</div> <!-- .<?php echo $postType; ?>-purchase-widgets -->
<?php
		} // endif !empty( $packages )
?>
	</div> <!-- #<?php echo $postType; ?>-finalize -->
<?php
	} // endif !post_password_required( $offer->post )
?>
</article> <!-- #<?php the_ID(); ?> -->
