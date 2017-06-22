<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); 

?>


<p class="myaccount_user">

<div class="nre"><a href="<?php echo  site_url().'/my-account/edit-address/billing/'?>"><button type="button" style="padding: 6px 12px!important;" id="nrew" class="btn btn-default"><i class="fa fa-edit"> &nbsp;</i>Billing Address</button></a><a href="<?php echo  site_url().'/my-account/edit-account/'?>"><button type="button" style="padding: 6px 12px!important; margin-left: 10px;" id="nrew" class="btn btn-default"><i class="fa fa-edit"> &nbsp;</i>Change Password</button></a></div>
	<?php
	/* printf(
		__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
		$current_user->display_name,
		wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);*/
	?>
</p>




<?php  wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php  wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php  wc_get_template( 'myaccount/my-address.php' ); ?>


<h2 style="display: block !important;">My Programs</h2>
 <table class="shop_table shop_table_responsive">
    <thead>
      <tr>
        <!--th>Image</th-->
        <th>Purchased On</th>
        <th>Order Id</th>
        <th>Product Name</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
    <?php

/* if ( !function_exists( 'woocommerce_customer_bought_product' ) ) { 
    require_once '/includes/wc-user-functions.php '; 
} else{

    die('dfgdf');
}*/


if( file_exists("wc-user-functions.php") && is_readable("dwc-user-functions.php") && include("wc-user-functions.php")) {
die('yes');
}


function new_data(){

global $wpdb;



 $user_id = get_current_user_id(); 

  $query = "select * from hp_posts post INNER JOIN hp_woocommerce_order_items orditm ON post.ID = orditm.order_id AND post.post_type = 'shop_order' INNER JOIN hp_postmeta postm ON postm.post_id = post.ID AND postm.meta_key = '_customer_user' AND postm.meta_value = '".$user_id."' group by orditm.order_id";  
$pageposts = $wpdb->get_results($query);
return $pageposts;
/*echo "<pre>"; 
print_r($pageposts);*/ 
}
 
         $user_id = get_current_user_id();
        $current_user= wp_get_current_user();
        $customer_email = $current_user->email;

        
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12
            );
        $loop = new WP_Query( $args );


        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post(); $_product = get_product( $loop->post->ID );

//echo $int = wc_get_customer_order_count( $user_id );
            //if (wc_customer_bought_product($customer_email, $user_id, $_product->id)){
           if(wc_get_customer_order_count( $user_id )){
           
                woocommerce_get_template_part( 'content', 'myproduct' );
            }
            endwhile;
        } else {
            echo __( 'No products found' );
        }
        wp_reset_postdata();
    ?> 
</tbody> 
  </table>
  <div id="tearev"></div>
  <?php  do_action( 'woocommerce_before_my_account' ); ?>

  <?php do_action( 'woocommerce_after_my_account' );  $_SESSION["k"] = 1; ?>

<?php if(is_page('7')){ ?>   
<style type="text/css">.my_account_memberships, .myaccount_address, .address {display:none;}  
#contributions-title{display: block !important;}
.woocommerce table.my_account_orders td, .woocommerce table.my_account_orders th{width:auto;} time{margin: 0 !important; } .woocommerce .star-rating{float: none !important;}
.woocommerce_account_subscriptions h2 {
    display: block;
}
h2.avail_downlaod {
    display: none;
}
</style> 
<?php } ?>