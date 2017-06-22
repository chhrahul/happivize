<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$template_type = get_post_meta($product->id,'Product-template',true);
if(!($template_type == "Template3")){
?>
	<div>
	<br>
	<?php

	$fileData = get_post_meta($product->id,'_downloadable_files',true);
	$x = 1;
	if(!empty($fileData)){
		//echo '<b>Related audio</b><br><br>';
	}

	/*foreach($fileData  as $key=>$prometa){
		$audio_name = $prometa['name'];
		$audio_url = $prometa['file'];
		?>
		<!--div class="tlClogo_<?php echo $x; ?>">
			<audio controls="controls"><source src="<?php echo $audio_url; ?>" type="audio/mpeg"></audio>
		</div>
		<script>$('.tlClogo_<?php echo $x; ?>').bind('contextmenu', function(e) {return false;});</script-->
		<object type="application/x-shockwave-flash" data="<?php echo get_site_url(); ?>/fplayer/template_mini/player_mp3_mini.swf" width="200" height="20">
		<param name="movie" value="<?php echo get_site_url(); ?>/fplayer/template_mini/player_mp3_mini.swf" />
		<param name="bgcolor" value="#000000" />
		<param name="FlashVars" value="mp3=<?php echo $audio_url; ?>" />
		</object>
		<br><br>
		<?php
		$x++;
	}*/
	?>
	</div>
	<?php
}
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php //echo $product->get_price_html(); ?></p>
	<div style="clear:both"></div>
	<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
