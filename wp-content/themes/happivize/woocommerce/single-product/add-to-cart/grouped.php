<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

$parent_product_post = $post;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" method="post" enctype='multipart/form-data'>
	<?php
		if( class_exists( 'WC_Subscriptions_Product' ) && WC_Subscriptions_Product::is_subscription( $product ) ) {
		    echo '<p class="price"></p>';
		} else { ?>
		    <p class="price"><?php echo $product->get_price_html(); ?></p>
		<?php }
	?>
	<table cellspacing="0" class="group_table" style="margin-top: 3%;">
		<p class="choose_prodct" style="font-size: 22px;color: #000">Product Options:</p>
		<tbody>
			<?php
				foreach ( $grouped_products as $product_id ) :
					if ( ! $product = wc_get_product( $product_id ) ) {
						continue;
					}

					if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $product->is_in_stock() ) {
						continue;
					}

					$post    = $product->post;
					setup_postdata( $post );
					?>
					<tr>
						<td>
							<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
								<?php woocommerce_template_loop_add_to_cart(); ?>
							<?php else : ?>
								<?php if ( $product->is_in_stock() ) { ?>
									 <input type="checkbox" id="test" class='childCheck' value="<?php echo $product_id ?>"/>
								 <?php }
								 else{
								 	?>
								 	 <input type="checkbox" disabled="disabled"/>
								 	<?php
								 	} 
								 ?>
								<?php
									$quantites_required = true;
									woocommerce_quantity_input( array(
										'input_name'  => 'quantity[' . $product_id . ']',
										'input_value' => ( isset( $_POST['quantity'][$product_id] ) ? wc_stock_amount( $_POST['quantity'][$product_id] ) : 0 ),
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', 1, $product )
									) );
								?>
							<?php endif; ?>
						</td>

						<td class="label">
							<label for="product-<?php echo $product_id; ?>" style= "font-size: 14px;">
								<?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '">' . esc_html( get_the_title() ) . '</a>' : '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '">' . esc_html( get_the_title() ) . '</a>'; ?>
							</label>
						</td>

						<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

						<td class="price">
							<?php
								if ( $product->is_in_stock() ) {
								echo $product->get_price_html();

									if ( $availability = $product->get_availability() ) {
										$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
										echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
									}
								}
								else{
									echo "<p class='stock out-of-stock'>Sold Out</p>";
								}
							?>
						</td>
					</tr>
					<?php
				endforeach;

				// Reset to parent grouped product
				$post    = $parent_product_post;
				$product = wc_get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<style type="text/css">
	.group-blog .group_table .quantity{
		display: none;
	}
	.group_table .price .small, small {
    	font-size: 100%;
	}
	.group_table tr .label a {
	    white-space: pre-line;
	    width: 400px !important;
	    float: left;
	    text-align: left;
	    font-weight: 500;
	    font-size: 21px;
	    line-height: 26px;
	}
	.group-blog .price p.stock.out-of-stock {
	    width: 100px !important;
	    margin-top: 0px;
	    margin-bottom: 2%;
	    text-align: left;
	    background: transparent !important;
	    padding: 0 !important;
	    color: hsl(345, 100%, 60%) !important;
	}
	.choose_prodct{
	    font-size: 22px;
	    color: #000;  
	    padding-bottom: 0px;
	    float: left;
	    width: 100%;
	    margin-top: 0px;
	    overflow: hidden;
	}
	.single .price .amount {
	    font-size: 21px;
	}
	.single td.price p {
	    font-size: 21px;
	}
	.single .cart .group_table td.label {
	    width: 70%;
	}
	.single .cart .group_table td.price p {
	    font-size: 21px !important;
	    width: 100% !important;
	}
	.single .cart .group_table td.price {
	    width: 40% !important;
	}
</style>
<script type="text/javascript">
	$('table tr td').on('click','.childCheck',function() {
	  if ($(this).is(':checked')) {	   
	   $(this).siblings(".quantity").find('.input-text').val("1");
	    
	  }
	  else{
	  	$(this).siblings(".quantity").find('.input-text').val("0");
	  }
	  
	});
</script>
