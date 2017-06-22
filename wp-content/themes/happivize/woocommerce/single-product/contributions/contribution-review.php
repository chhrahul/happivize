<?php
/**
 * WooCommerce Product Reviews Pro
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Product Reviews Pro to newer
 * versions in the future. If you wish to customize WooCommerce Product Reviews Pro for your
 * needs please refer to http://docs.woothemes.com/document/woocommerce-product-reviews-pro/ for more information.
 *
 * @package   WC-Product-Reviews-Pro/Templates
 * @author    SkyVerge
 * @copyright Copyright (c) 2015-2016, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * Display Review contributions
 *
 * @type \WP_Comment $comment
 * @type \WC_Contribution $contribution
 * 
 * @since 1.2.0
 * @version 1.2.0
 */

$title          = $contribution->get_title();
$rating         = $contribution->get_rating();
$rating_enabled = $rating && 'yes' === get_option( 'woocommerce_enable_review_rating' );

?>

<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php // Display the karma markup.
		wc_product_reviews_pro_contribution_karma( $contribution ); ?>

		<div class="comment-text">

			<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', get_comment_author() ); ?>

            <?php // Display the meta markup.
			wc_product_reviews_pro_contribution_meta( $contribution ); ?> 
			
			<?php if ( $title || $rating_enabled ) : ?>

				<h3 class="contribution-title review-title">

					<?php if ( $rating_enabled ) : ?>

						<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo esc_attr( sprintf( __( 'Rated %d out of 5', 'woocommerce-product-reviews-pro' ), $rating ) ); ?>">
							<span style="width:<?php echo esc_attr( ( $rating / 5 ) * 100 ); ?>%;">
								<?php printf( __( '<strong itemprop="ratingValue">%d</strong> out of 5', 'woocommerce-product-reviews-pro' ), esc_attr( $rating ) ) ; ?>
							</span>
						</span>

					<?php endif; ?>

					<!-- <?php if ( $title ) : ?>

						<span itemprop="name"><?php echo esc_html( $title ); ?></span>

					<?php endif; ?> -->

				</h3>

                   <?php if ( $title ) : ?>

						<span class= "rtit" itemprop="name"><?php echo esc_html( $title ); ?></span>

					<?php endif; ?> 

 
			<?php endif; ?>

			

			<?php wc_product_reviews_pro_review_qualifiers( $contribution ); ?>

			<div itemprop="reviewBody" class="description"><?php comment_text(); ?></div>

			<?php // Display the attachments.
			wc_product_reviews_pro_contribution_attachments( $contribution ); ?>

			<?php // Display the actions markup.
			wc_product_reviews_pro_contribution_actions( $contribution ); ?>

			<div class="comment_boxzz">				
				<a href="javascript:void(0)" class="testsss" id="btnclcikget_<?php comment_ID(); ?>">Comment</a>
				<input type="hidden" id="btnclcikget_id_<?php comment_ID(); ?>" value="<?php comment_ID(); ?>"></input>
			</div>

			<?php wc_product_reviews_pro_contribution_flag_form( $comment ); ?>

		</div>
	</div>


<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#review_form_wrapper form.form-contribution #author_field #author").attr("placeholder","Name");
	$(".commentlist li.review form.form-contribution #contribution_comment_comment").attr("placeholder","Write your comment...");
	$(".commentlist li.review form.form-contribution #author_field #author").attr("placeholder","Name");
	$(".commentlist li.review form.form-contribution #email_field #email").attr("placeholder","E-mail");
	$(".commentlist li.review form.form-contribution button#btnbtmchild").text("Submit Comment");

  	$(".testsss").unbind().click(function(){
	    //alert($(this).attr("id")); 
	    $(this).toggleClass("active");
	    $(this).parent().parent().parent().siblings(".children").slideToggle("slow");	    
	    $(this).parent().parent().parent().siblings("form.form-contribution").slideToggle("slow");
	});
  
});

</script>

<style type="text/css">
  .commentlist li.review  .contribution-flag-form{
    display: none;
  }
  .commentlist li.review .children{
    display: none;
  }
  .commentlist li.review form.form-contribution{
    display: none;
  }
  .commentlist li.review .comment_boxzz {
	    margin-top: -4.5%;
    	margin-bottom: 1%;
        margin-left: 6.9%;
	}
	 .commentlist li.review .comment_boxzz a{
	    color:#498CBC !important;
	}
	 .commentlist li.review .comment_boxzz a:hover{
		text-decoration: underline;
	    cursor: pointer;
	    color: #c45500 !important;		
	}	
	 .commentlist li.review .comment_boxzz a.active{
		text-decoration: underline;
	    cursor: pointer;
	    color: #c45500 !important;		
	}	
	.commentlist li.review form.form-contribution button {
	    background: #17de85 !important;
	    padding: 1% 5.5% !important;
	    margin-top: 0px !important;
	    margin-bottom: 3%;
	}
	.commentlist li.review .contribution_comment .comment-text {
		width: 86%;
		margin-left: 11% !important;
	}
	
	.commentlist li.review li.contribution_comment{
		padding-top: 0px !important;
		margin-bottom: 0px !important;
	}
	.single-product .commentlist li.review .form-contribution_comment{
	    margin: 10px 0 0 11% !important;  
	}
	
	@media only screen and (max-width: 600px) and (min-width: 320px) {
		.single-product #contributions-list ol.commentlist {
		    margin-left: 0px;
		    padding-left: 0px;
		}
		.commentlist li.review .comment_boxzz {
		    margin-top: 1.5%;
		    margin-bottom: 2%;
		    margin-left: 0%;
		    float: left;
		}
	}
	@media only screen and (max-width: 640px){
		#contributions-list-title {
		    font-size: 20px;
		    font-weight: bold;
		}	
	}
	@media only screen and (max-width: 780px) and (min-width: 320px) and (orientation: landscape)  {
		.single-product #contributions-list ol.commentlist {
		    margin-left: 0px;
		    padding-left: 0px;
		}
		.commentlist li.review .comment_boxzz {
		    margin-top: 1.5%;
		    margin-bottom: 2%;
		    margin-left: 0%;
		    float: left;
		}
	}
	@media only screen and (max-width: 780px) and (orientation: landscape){
		#contributions-list-title {
		    font-size: 20px;
		    font-weight: bold;
		}	
	}
	
</style>