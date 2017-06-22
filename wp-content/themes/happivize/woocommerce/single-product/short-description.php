<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
		$productID = $post->ID;
		$key_1_value = get_post_meta( $productID, 'Product-template',  true );
		if ($key_1_value == 'Template2') {
			//echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
		?>
		<div itemprop="description" class="description_custom">
		
		<?php
		
		$bullet_startimg = get_home_url()."/wp-content/uploads/2017/05/star.png";
		if(!empty(get_post_meta($productID, 'bullet_description1', true))) 
		{?>
			<div class="bullets_set">
					<div class="bullet_img">

						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description1', true);
						    ?>
					  	</p>
					</div>						
				  						
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description2', true))) 
		{?>
			<div class="bullets_set">							
				 	<div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description2', true);
						    ?>
					  	</p>
					</div>							
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description3', true))) 
		{?>
			<div class="bullets_set">						
				<div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description3', true);
						    ?>
					  	</p>
					</div>						
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description4', true))) 
		{?>
			<div class="bullets_set">						
				 <div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description4', true);
						    ?>
					  	</p>
					</div>							
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description5', true))) 
		{?>
			<div class="bullets_set">							
				 <div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description5', true);
						    ?>
					  	</p>
					</div>						
			</div>
		<?php
		} 
		?>
	</div>
	<style type="text/css">
		.description_custom .bullets_set {
		    width: 100%;
		    overflow: hidden;
		    margin: 0px 0 3px;
		}
		.description_custom .bullets_set  .bullet_img {
		    float: left;
		    overflow: hidden;
		    margin-right: 8px;
		    width: 4.5%;
		}
		.description_custom .bullets_set .bullet_img img {
		    width: 30px;
		    height: 30px;
		}
		.description_custom .bullets_set .content_bullets p{
			margin: 0px 0px 0px 0px;
		}
		.description_custom .bullets_set .content_bullets {
		    float: left;
		    width: 90%;
		}
	</style>
	<?php	
	}
	elseif($key_1_value == 'Template3'){

	}
	else{
		//echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	}
	return;
}

?>
<div itemprop="description" class="description_set">
	<?php
		$productID = $post->ID;
		$key_1_value = get_post_meta( $productID, 'Product-template',  true );
		if ($key_1_value == 'Template2') {			
		?>
		<div itemprop="description" class="description_custom">
		
		<?php
		
		$bullet_startimg = get_home_url()."/wp-content/uploads/2017/05/star.png";
		if(!empty(get_post_meta($productID, 'bullet_description1', true))) 
		{?>
			<div class="bullets_set">
					<div class="bullet_img">

						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description1', true);
						    ?>
					  	</p>
					</div>						
				  						
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description2', true))) 
		{?>
			<div class="bullets_set">							
				 	<div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description2', true);
						    ?>
					  	</p>
					</div>							
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description3', true))) 
		{?>
			<div class="bullets_set">						
				<div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description3', true);
						    ?>
					  	</p>
					</div>						
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description4', true))) 
		{?>
			<div class="bullets_set">						
				 <div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description4', true);
						    ?>
					  	</p>
					</div>							
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description5', true))) 
		{?>
			<div class="bullets_set">							
				 <div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description5', true);
						    ?>
					  	</p>
					</div>						
			</div>
		<?php
		} 
		?>
	</div>
	<style type="text/css">
		.description_custom .bullets_set {
		    width: 100%;
		    overflow: hidden;
		    margin: 0px 0 3px;
		}
		.description_custom .bullets_set  .bullet_img {
		    float: left;
		    overflow: hidden;
		    margin-right: 8px;
		    width: 4.5%;
		}
		.description_custom .bullets_set .bullet_img img {
		    width: 30px;
		    height: 30px;
		}
		.description_custom .bullets_set .content_bullets p{
			margin: 0px 0px 0px 0px;
		}
		.description_custom .bullets_set .content_bullets {
		    float: left;
		    width: 90%;
		}
	</style>
	<?php	
	}
	elseif($key_1_value == 'Template3'){

	}
	else{
		echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	}
 	?>
</div>



