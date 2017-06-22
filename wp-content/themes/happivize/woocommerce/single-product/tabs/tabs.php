<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */


global $product;

$current_product = $product->id;

if ( ! comments_open() ) {
	return;
}

$contribution_types = wc_product_reviews_pro()->get_enabled_contribution_types();
$ratings            = array( 5, 4, 3, 2, 1 );
$total_rating_count = $product->get_rating_count();
?>
<div id="reviews">
<?php // Product ratings ?>
	<?php if ( 'yes' === get_option( 'woocommerce_enable_review_rating' ) && $product->get_rating_count() ) : ?>

		<div class="product-rating">
			<div class="product-rating-summary">
				<!--h3><?php /* translators: Placeholders: %s - average rating stars count, %d - 5 stars total (e.g "4.2 out of 5 stars") */
					printf( __( '%s out of %d stars', 'woocommerce-product-reviews-pro' ), (float) $product->get_average_rating(), 5 ); ?></h3-->
                 <p> <span class="rating-star"></span><span class="rating-star"></span><span class="rating-star"></span><span class="rating-star"></span><span class="rating-star"></span><span class="kul">
				<?php $reviews_count = wc_product_reviews_pro_get_comments_number( $product->id, 'review' ); ?>
				<?php printf( _nx( '%d review', '%d reviews', $reviews_count, 'noun', 'woocommerce-product-reviews-pro' ), $reviews_count ); ?></span></p>
			</div>
			<div class="product-rating-details">
				<table>

					<?php $k = 5; foreach ( $ratings as $rating ) : ?>
                     
						<?php

							$count      = $product->get_rating_count( $rating );
							$percentage = $count / $total_rating_count * 100;

							$url    = remove_query_arg( 'comment_filter', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
							$filter = "comment_type=review&rating={$rating}";
							$url    = add_query_arg( 'comments_filter', urlencode( $filter ), $url );

						?>
						<tr>
							<td class="rating-number">
								<a href="<?php echo esc_url( $url ); ?>#comments"><?php echo $rating;    $k--; for($j = $k; $j >= 0; $j--) {?> <span class="rating-star"></span><?php } ?></a>
							</td>

							<td class="rating-count">
								<a href="<?php echo esc_url( $url ); ?>#comments"><?php echo "(".$count.")"; ?></a>
							</td> 

							<td class="rating-graph">
								<a href="<?php echo esc_url( $url ); ?>#comments" class="bar" style="width: <?php echo $percentage; ?>%;" title="<?php printf( '%s%%', $percentage ); ?>"></a>
							</td>
							
						</tr>

					<?php endforeach; ?>

				</table>
			</div>
			<div class="opreview">
			<button type="button" id="rew" class="btn btn-default"><i class="fa fa-edit"> &nbsp;</i>write a review</button><br>
            <p></p>
            <button id="askq" type="button" class="btn btn-default"><i class="fa fa-comments">&nbsp;</i>ask a question</button>
			<!--button >Write Review</button-->
			<!--button >Ask Question</button-->

			</div>
		</div>

	<?php endif; ?>

	<div class="contribution-type-selector">
		<?php $key = 0; ?>
		<?php foreach ( $contribution_types as $type ) : ?>

			<?php if ( 'contribution_comment' !== $type ) : $key++; ?>

				<?php $contribution_type = wc_product_reviews_pro_get_contribution_type( $type ); ?>
				<!--a href="#share-<?php echo esc_attr( $type ); ?>" class="js-switch-contribution-type <?php if ( $key === 1 ) : ?>active<?php endif; ?>"><?php echo $contribution_type->get_call_to_action(); ?></a-->

			<?php endif; ?>

		<?php endforeach; ?>
	</div>

	<?php $key = 0; ?>
	<?php foreach ( $contribution_types as $type ) : ?>

		<?php if ( 'contribution_comment' !== $type ) : $key++; ?>

			<div id="<?php echo esc_attr( $type ); ?>_form_wrapper" class="contribution-form-wrapper <?php if ( $key === 1 ) : ?>active<?php endif; ?>">
				<?php wc_get_template( 'single-product/form-contribution.php', array( 'type' => $type ) ); ?>
			</div>

		<?php endif; ?>

	<?php endforeach; ?>

	<?php if ( ! is_user_logged_in() && get_option('comment_registration') ) : ?>

		<noscript>
			<style type="text/css">#reviews .contribution-form-wrapper { display: none; }</style>
			<p class="must-log-in"><?php printf( __( 'You must be <a href="%s">logged in</a> to join the discussion.', 'woocommerce-product-reviews-pro' ), esc_url( add_query_arg( 'redirect_to', urlencode( get_permalink( get_the_ID() ) ), wc_get_page_permalink( 'myaccount' ) . '#tab-reviews' ) ) ); ?></p>
		</noscript>

	<?php endif; ?>

	</div>
<?php
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php  //echo "<pre>";
              //print_r($tabs) ;  ?>
		<?php foreach ( $tabs as $key => $tab ) : ?>

           <?php

           
             global $wpdb;
                  
                     $productID = $_SESSION['pro_id'];
               // echo    'pro-> '.$productID; 

                  // $post->ID = 1290;

           $query ="SELECT offer_post_id FROM `hp_offer_data` where package_id = '".$productID."'";
           $npid = $wpdb->get_row($query);
           
         //$ur =  the_permalink($npid->offer_post_id);
          
          // echo do_shortcode('[iframe src="'.the_permalink($npid->offer_post_id).'" width="100%" height="500"]');

           //echo '<iframe src= "'.get_post_permalink($npid->offer_post_id).'"></iframe>';
           //echo do_shortcode('[iframe src="http://www.youtube.com/embed/4qsGTXLnmKs" width="100%" height="500"]');  
           
           
  
           if(! empty($npid)){
             
              ?>
              	<script>
              			jQuery(document).ready(function($){
    
              					var simple = '<?php echo get_post_permalink($npid->offer_post_id); ?>'; 
    
              					//alert(simple);
    
              					$('#tab-offer-description').html('<iframe scrolling="no" style="border:none;"  id="iframeID" src= "'+simple+'" width="100%" onload="resizeIframe(this)" ></iframe>');
              			});
              	</script>
              <?php 
          }
          else{
           $meta_post_tmpz = get_post_meta( $product->id, 'Product-template' );
           $meta_offr_val = get_post_meta($product->id, '_productz_offer', true);
           $meta_post_tmpz_vl = $meta_post_tmpz[0];
            if(($meta_post_tmpz_vl == "Template2") ){
              if($meta_offr_val != ""){                
                 ?>
                	<script>
                			jQuery(document).ready(function($){
      
                					var simple = '<?php echo get_post_permalink($meta_offr_val); ?>'; 
      
                					//alert(simple);
      
                					$('#tab-offer-description').html('<iframe scrolling="no" style="border:none;"  id="iframeID" src= "'+simple+'" width="100%" onload="resizeIframe(this)" ></iframe>');
                			});
                	</script>
                <?php
              }                
            } 
          }
         /* $postu   = get_post($gg);
         echo  $output =  apply_filters( 'the_content', $postu->post_content );*/

             $query1 ="SELECT * FROM `hp_postmeta` WHERE `post_id` = '".$npid->offer_post_id."' AND meta_key = 'dnc-wc-offer-packages'";
               $da = $wpdb->get_row($query1);
 
              $mydata  = unserialize($da->meta_value); 

       

             /* 
              foreach($mydata as $val)
              {
                 
       
               $packageId = $val->product; 
              
               if($packageId == $productID)
               
               {
                 
           
               $loo = count($val->items);
             for($l = 0; $l <= $loo ; $l++){
             echo  $val->items[$l]->title;
             echo $val->items[$l]->format; 
             echo $val->items[$l]->value; 
             echo $val->items[$l]->content;
             echo $val->items[$l]->bonus;
             echo $val->items[$l]->dividerType;
             echo "</br>";
             };

         */
            /* foreach($val->items as $newarr); 

             {
        
               echo $newarr->title;

             }
*/

            

           
            //  }

               
           // }

            


                  ?>

			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>




<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
