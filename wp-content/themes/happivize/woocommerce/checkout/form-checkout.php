<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>
<!--div class="main-list">
        <div class="menuslist">

         <ul id="menu-cart_menu" class="nav navbar-nav"><li id="menu-item-1791" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1791"><a href="#" style="border-right: 1px solid #dddddd;"><img  style="width: 10px;
margin-right: 5px;" src="https://happivize.com/wp-content/uploads/2017/02/locked_1-300x300.png">SECURE CHECKOUT</a></li>
<li id="menu-item-1792" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1792"><a href="#" style="border-right: 1px solid #dddddd;">SHOPPING CART 1</a></li>
<li id="menu-item-1793" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1793"><a href="#" style="border-right: 1px solid #dddddd;">2 SHIPPING INFO</a></li>
<li id="menu-item-1794" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1794">
<a href="#" >3 COMPLETE</a></li>
</ul>

<div class="border-row" style="
overflow: hidden;
float: left;
width: 75.6%;margin-bottom: 13px;">
	

	<div style="border: 3px solid black;
overflow: hidden;
float: left;
width: 47%;">
	</div>


<div style="border: 3px solid gray;
overflow: hidden;
float: left;
width: 53%;">
</div>

</div>
</div>
</div-->

<!--div class="main-list1" style="display:none;">
        <div class="menuslist">

         <ul id="menu-cart_menu" class="nav navbar-nav"><li id="menu-item-1791" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1791"><a href="#" style="border-right: 1px solid #dddddd;"><img  style="width: 10px;
margin-right: 5px;" src="https://happivize.com/wp-content/uploads/2017/02/locked_1-300x300.png">SECURE CHECKOUT</a></li>
<li id="menu-item-1792" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1792"><a href="#" style="border-right: 1px solid #dddddd;">SHOPPING CART 1</a></li>
<li id="menu-item-1793" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1793"><a href="#" style="border-right: 1px solid #dddddd;">2 SHOPPING INFO</a></li>
<li id="menu-item-1794" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1794">
<a href="#" >3 COMPLETE</a></li>
</ul>

<div class="border-row" style="
overflow: hidden;
float: left;
width: 73.6%;margin-bottom: 13px;">
	

	<div style="border: 3px solid black;
overflow: hidden;
float: left;
width: 47%;">
	</div>


<div style="border: 3px solid black;
overflow: hidden;
float: left;
width: 53%;">
</div>

</div>
</div>
</div-->
<?php
$id=680; 
$post = get_post($id); 
$content = apply_filters('the_content', $post->post_content); 
?>


<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div id="billiadd" class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				
				<div class="checkbox-custom"><span class="left-span"><input id="chkboxvalreq" type="checkbox" name="terms" value="" required></span>

<label class="right-label">I accept the <b class="link-terms-condition" id="popup_refund3" style="color:blue;">terms & conditions</b></label>
<p id="ki">Proceed to Checkout</p>

				</div>
			
				<div class="scannerdata"></div>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
            
			<div class="col-2" id="billiadd2">  
			<div class="right_section_billiadd2">
			<!--h3 id="or"> Order Review </h3-->   
				<?php wc_get_template( 'checkout/review-order.php', array( 'checkout' => $this ) ); ?>
					<?php //do_action( 'woocommerce_checkout_shipping' ); ?>
			</div> 
			</div>
		
	</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

	

</form>
<div id="popup_container" class="modal-box3" style="display: none">
  <header> <a class="js-modal-close close"style="position: relative; top: 11px; color: #000000 !important; opacity: 1;">×</a>
    <h3><?php echo get_the_title(680); ?></h3>
  </header>
  <div class="modal-body"style=" height: 300px; overflow-x: hidden; overflow-y: scroll;">
    <p><?php echo $content; ?></p>
  </div>
  <footer> <a class="btn btn-small js-modal-close" style="background-color: grey !important; color:#fff;">Close</a> </footer>
</div>
<?php  do_action( 'woocommerce_after_checkout_form', $checkout ); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {


$(document).keyup(function(e) { 
        if (e.keyCode == 27) { // esc keycode
            $('.modal-box3').hide();
       
        }
    });
$(document).on('click touch', function(event) {
  if (!$(event.target).parents().addBack().is('#popup_refund3')) {
    $('.modal-box3').hide();
  }
});

    $("#popup_refund3").click(function(){
         // show Modal


         $('.modal-box3').show();
    });
    $(".js-modal-close").click(function(){
         // show Modal
         $('.modal-box3').hide();
    });

      });


</script>

<style type="text/css">
#popup_container > footer {
    display: block !important;
}

p {
    margin: 0 0 10px !important;
}

</style>
