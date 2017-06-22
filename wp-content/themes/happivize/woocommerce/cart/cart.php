<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' );


$id=2700; 
$post = get_post($id); 
$content1 = apply_filters('the_content', $post->post_content); 



$id=680; 
$post = get_post($id); 
$content = apply_filters('the_content', $post->post_content); 


 ?>

<div class="container">
  <div class="row">
    <div class="col-sm-3">

 
<div class="list-group" id="lef_men">
  <!-- <a href="<?php //echo site_url(); ?>"><button type="button" class="list-group-item">Home </button></a>
  <a href="<?php //echo get_post_permalink('20'); ?>"><button type="button" class="list-group-item">About</button></a>
  <a href="<?php //echo get_post_permalink('22'); ?>"><button type="button" class="list-group-item">Contact</button></a> -->
  <a href="<?php echo site_url()."/privacy-policy/" ?>"><button type="button" class="list-group-item">Privacy Policy</button></a>
  <button id="popup_refund1" type="button" class="list-group-item">Terms</button>
  <button style=" margin-top: 1px;" id="popup_refund" type="button" class="list-group-item">Refund Policy</button>

</div>
</div>
<div id="popup_container" class="modal-box" style="display: none">
  <header> <a class="js-modal-close close" style="position: relative;  top: 11px;color: #000000 !important;opacity: 1;">×</a>
    <h3><?php echo get_the_title(2700); ?></h3>
  </header>
  <div class="modal-body">
    <p><?php echo $content1; ?></p>
  </div>
  <footer> <a class="btn btn-small js-modal-close" style="background-color: grey !important; color:#fff;">Close</a> </footer>
</div>

<div id="popup_container" class="modal-box1" style="display: none">
  <header> <a class="js-modal-close1 close" style="position: relative;  top: 11px;color: #000000 !important;opacity: 1;" >×</a>
    <h3><?php echo get_the_title(680); ?></h3>
  </header>
  <div class="modal-body" style=" height: 300px; overflow-x: hidden; overflow-y: scroll;">
    <p><?php echo $content; ?></p>
  </div>
  <footer> <a class="btn btn-small js-modal-close1" style="background-color: grey !important; color:#fff;">Close</a> </footer>
</div>

<div class="main-list">
        <div class="menuslist">  

         <ul id="menu-cart_menu" class="nav navbar-nav"><li id="menu-item-1791" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1791"><a href="#"><img  style="width: 10px;
margin-right: 5px;" src="https://happivize.com/wp-content/uploads/2017/02/locked_1-300x300.png">SECURE CHECKOUT</a></li>
<li id="menu-item-1792" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1792"><a href="#"><span style="padding:2px;">1</span> SHOPPING CART</a></li>
<li id="menu-item-1793" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1793"><a href="#"><span style="padding:2px;">2</span> BILLING INFO</a></li>
<li id="menu-item-1794" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1794">
<a href="#" ><span style="padding:2px;">3 </span>COMPLETE</a></li>
</ul>

<div class="border-row" style="
overflow: hidden;
float: left;
width: 73.6%;"> 
	 
	<div style="border: 3px solid black;
overflow: hidden;
float: left;
width: 50%;">
	</div>


<div style="border: 3px solid gray;
overflow: hidden;
float: left;
width: 50%;">
</div>

</div>
</div>
</div>

<div class="col-sm-9" id="bfr_frm">
<a style="float:right;margin-right: 5px;" href="<?php echo esc_url( wc_get_checkout_url() );?>" class="checkout-button button alt top_checkout_btn wc-forward">
	<?php esc_html_e( 'Checkout Now', 'woocommerce' ); ?>
</a>
<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table shop_table_responsive cart" cellspacing="0">
	<thead>
		<tr>
			<!--th class="product-remove">&nbsp;</th-->
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<!--td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td-->

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
							}
						?>
					</td>

					<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
						<?php
							if ( ! $_product->is_visible() ) {								
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
							} else {								
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
							echo '<br/>' . $_product->post->post_excerpt; 
						?>
					</td>

					<td class="product-price" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
					<div><span class="qnttuty" style="margin-top: 0.3px;">	<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								/*$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => '1',
									'min_value'   => '1'
								), $_product, false );*/
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
						</span>
						<span>
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
						</span></div>
					</td>

					<td class="product-subtotal" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions" style="padding-right: 6px !important;">

				<?php if ( wc_coupons_enabled() ) { ?>
					<div class="coupon">

						<?php
				            global $woocommerce;
				          if (!empty($woocommerce->cart->applied_coupons))
				          { 
				          /*  $code = $woocommerce->cart->applied_coupons[0]; 
				            echo '<div style="text-align:left;"> Coupon: <span style="font-weight:bold;margin-right:6%;">'.$code.'</span>';
				            echo '<p>'. wc_cart_totals_coupon_html( $code ).'</p></div>';*/
				          
				          } else{
				           ?>
							<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />

							<?php 
				           
				            }  
						 //do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>

				<input type="submit" class="button custom_update" style="    padding: 1.4% 8.7% !important;margin-right: -2px;" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>
 
</form> 
</div>
</div>  
</div>
<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

</div>
<?php 
$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
 
 echo '<div class="woocommerce_cont">';
 echo ' <a style="padding:0 !important; background: none; color: #ff3366 !important;font-size: 17px;" href="'.$shop_page_url.'" class="button">Continue Shopping →</a>';
 echo '</div>'; ?>
<?php do_action( 'woocommerce_after_cart' ); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {

	$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
            $('.modal-box').hide();
            $('.modal-box1').hide();
        }
    });

  $(document).on('click touch', function(event) {
  if (!$(event.target).parents().addBack().is('#popup_refund')) {
    $('.modal-box').hide();
  }
});
  $(document).on('click touch', function(event) {
  if (!$(event.target).parents().addBack().is('#popup_refund1')) {
    $('.modal-box1').hide();
  }
});


    $("#popup_refund").click(function(){
         // show Modal
         $('.modal-box').show();
    });
    $(".js-modal-close").click(function(){
         // hide Modal
         $('.modal-box').hide();
       
    });


    $("#popup_refund1").click(function(){
         // show Modal
         $('.modal-box1').show();
    });
        $(".js-modal-close1").click(function(){
         // hide Modal
         $('.modal-box1').hide();
    });
 
    //hide it when clicking anywhere else except the popup and the trigger

});
</script>
<?php $postid = get_the_ID(); ?>
<style type="text/css">
.coupon input.button {
    background-color: #a2a2a2 !important;
   padding: 2.4% 8.5% !important;
   line-height: 1.2 !important;
}
checkout-button{
	width: 98% !important;
}
a.woocommerce-remove-coupon {
    color: #337ab7 !important;
}
#bfr_frm a.top_checkout_btn {
    font-size: 1em !important;
    padding:1.4% 7.2% !important;
    margin-bottom: 4% !important;
}
.cart_item .product-quantity a.remove {
    line-height: 0.95;
}
ul.wcsatt-options.overrides_exist li input[type="radio"] {
    height: 23px;
    float: left;
    margin-right: 3px;
    margin-top: -1px;
}
</style>