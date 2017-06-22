<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	$key_1_value = get_post_meta( get_the_ID(), 'Product-template',  true );
		// Check if the custom field has a value.
		if (  $key_1_value == 'Template2') { ?>
			<div class="product-image temp">
		  		 	<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
			</div>
			<div class="summary entry-summary temp">

				<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
			 <?php 
			global $product, $woocommerce_loop;

			 	if ( empty( $product ) || ! $product->exists() ) {
				return;
			}

			//$related = $product->get_related( $posts_per_page );   

			$_SESSION['pro_id'] = $product->id;
			$related = get_post_meta($post->ID, '_wcrp_related_ids', true);    

		    if($related){
		    	$implode = implode(",",$related);
		   		$querystr = 'select * from hp_posts where ID IN('.$implode.')';
			    $page_posts = $wpdb->get_results($querystr, OBJECT);

				$count = count($page_posts);
			
				if($count > 0)
				{


				?>
				<br /> 

				<div id="relpro">
					<div class="tutle_simple_text">
						<b>Related Packages:</b>
					</div>
				 	<ul id="assoc_pro" style="font-size: 16px;width: 100%;padding: 0% 0;">
					<?php 
					
				       foreach($page_posts as $row)
				       { 
				    ?> 
						<li><a href="<?php echo get_permalink($row->ID); ?>"> <?php echo $row->post_title; ?></a></li> 

					<?php 
					    }
					?>
					</ul>
				  </div>
					<!-- .summary --> 

					<?php
			    //echo $product->id;
				}

		   }

			echo '</div>';
				/**
				 * woocommerce_after_single_product_summary hook.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
			?> 

			<meta itemprop="url" content="<?php the_permalink(); ?>" />

		</div>


	<?php
}
else{

	?>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
		<?php 
		global $product, $woocommerce_loop;

		 	if ( empty( $product ) || ! $product->exists() ) {
			return;
		}

		//$related = $product->get_related( $posts_per_page );   

		/*$related = get_post_meta($post->ID, '_wcrp_related_ids', true);
		
		$count = count($related);

		$args = apply_filters( 'woocommerce_related_products_args', array(
			'post_type'            => 'product',
			'ignore_sticky_posts'  => 1,
			'no_found_rows'        => 1,
			'posts_per_page'       => $posts_per_page, 
			'orderby'              => $orderby,	
			'post__not_in'         => array( $product->id )
		) );*/

		$_SESSION['pro_id'] = $product->id;
		$related = get_post_meta($post->ID, '_wcrp_related_ids', true); 	

		if($related){

		 		$implode = implode(",",$related);
		 	    $querystr = 'select * from hp_posts where ID IN('.$implode.')';
			    $page_posts = $wpdb->get_results($querystr, OBJECT);

			    $count = count($page_posts);

				
				if($count > 0)
				{
				$products = new WP_Query( $args );

				?>
				</br> 

				<div id="relpro">
					<div class="tutle_simple_text">
						<b>Related Packages:</b>
					</div>
				 	<ul id="assoc_pro" style="font-size: 16px;width: 100%;padding: 0% 0;">				 
					   <?php 
					
				       foreach($page_posts as $row)
				       { 
				       ?> 
							  
							<li><a href="<?php echo get_permalink($row->ID); ?>"> <?php echo $row->post_title; ?></a></li> 

							<?php //endwhile;
				        }
						?>
					</ul>
				</div>
					<!-- .summary --> 

					<?php
				}
		 }
	    

		echo '</div>';
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?> 

		<meta itemprop="url" content="<?php the_permalink(); ?>" />

	</div><!-- #product-<?php the_ID(); ?> -->

	<?php do_action( 'woocommerce_after_single_product' ); ?>

<?php
}
?>

<style type="text/css">
.summary > div:nth-child(3) {
    padding-top: 3%;      
}
.summary > div:nth-child(3) br {   
    display: none;  
}
.summary .tutle_simple_text{
	 padding-bottom: 1%;   
}
.summary > div:nth-child(3) b {
    position: relative;
}
.summary > div:nth-child(3) b:after {
    content: "Includes:";
    position: absolute;
    left: 0;
    background: #fff;
    width: 100%;
}
.summary.entry-summary.temp .related_set_audio {
   display: none !important;
}
.summary.entry-summary.temp p.price{
    display: block;
}
#product-2507 .summary.entry-summary.temp p.price{
    display: inline !important;
}
entry-summary.temp p.stock.out-of-stock {
    color: #17de85 !important;
}
.summary.entry-summary.temp #assoc_pro li a{
    color: #337ab7 !important;
}
.summary.entry-summary li {
    list-style: none;
}
</style>

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		getvall = $("form.cart ul.wcsatt-options-product").length;
		if(getvall >=1){
			$(".summary.entry-summary.temp p.price").css("display","none");
			$(".summary.entry-summary p.price").css("display","none");
		}
		else{
			$(".summary.entry-summary.temp p.price").css("display","block");
			$(".summary.entry-summary p.price").css("display","block");
		}
	});
</script>