<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;



// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

?>

<tr>
<?php
 $lk = $_SESSION["k"]++;
 if($lk ==  1){
 	$hj = new_data();
 }
  
/*echo "<pre>";
print_r($hj);*/   

foreach ($hj as $key => $value) {

 $nekl[] = $value -> ID;	
 $nekl[] = $value -> order_item_name;
 $nekl[] = $value -> post_date;

}
//echo "<pre>";
$abc = array_chunk($nekl,3);
//print_r($abc);

foreach($abc as $ab){ 
$pname = array();
  $order_id = $ab[0];
  $order_item_name = $ab[1];
  $order_date = $ab[2];
   $query = "select * from hp_posts post INNER JOIN hp_woocommerce_order_items orditm ON post.ID = orditm.order_id AND post.post_type = 'shop_order' INNER JOIN hp_postmeta postm ON postm.post_id = post.ID AND postm.meta_key = '_customer_user' AND postm.meta_value = 199 and orditm.order_id = '".$order_id."' and orditm.order_item_name != '".$order_item_name."' group by orditm.order_id";
  $pageposts = $wpdb->get_results($query);
  //echo count($pageposts).'<br />';
  
  if(count($pageposts) > 0)
  {//echo '<pre>';print_r($pageposts);
    foreach($pageposts as $pagepost)
    {
      // echo $pname += $pagepost->order_item_name.','; 
      //echo $pagepost->order_item_name.'hi<br />';
      $pname[] = $pagepost->order_item_name; 
    }
    $pname = implode(",",$pname);  
  }
  if(!empty($pname))
  {
     $product_name = $order_item_name .', '.$pname;
  }
  else
  {
     $product_name = $order_item_name;
  }
   

  $orderkk = new WC_Order( $order_id );
  $order_status = $orderkk->get_status();
  if ($order_status == 'completed' || $order_status == 'processing')  {

  	echo '<tr><td>'.date("M d , Y", strtotime($order_date)).'</td><td>#'.$order_id.'</td><td>'.$product_name.'</td><td><a href="'.site_url().'/my-account/view-order/'.$order_id.'">Access program</a></td></tr>';

  }
  
  //echo $order_id.'<br />';
  //echo $order_item_name.'<br />';
  //echo '<br />';
 } 
/* $kj =  $_SESSION["k"]++ ;
 $dtt = uer_orid();
 $nekl = array_reverse($dtt);
 echo $nekl[$kj];

 $ourl = site_url()."/my-account/view-order/".$nekl[$kj];*/

 ?>
  

        <!--td class="membership-product-image"> <a href='<?php //echo $ourl; ?>'>
        <?php  //if ( has_post_thumbnail(get_the_ID()  )){ echo get_the_post_thumbnail( $post_id, array( 45, 45) ); } else { echo " <img src='https://happivize.com/wp-content/plugins/woocommerce/assets/images/placeholder.png' alt='Placeholder' class='woocommerce-placeholder wp-post-image' height='45' width='45'>"; } ?><a/></td>
        <td class="membership-product-title"><a href="<?php //echo $ourl ;?>"><?php //echo get_the_title(); ?></a></td>
        <td class="membership-product-title"><?php //echo _cmk_check_ordered_product( get_the_ID() ); ?></td-->
      </tr>
<!--li <?php post_class( $classes ); ?>>

	<?php
 /*   echo "</br>";
	echo "<a href='".site_url()."/my-product-details?id=".get_the_ID()."'>".get_the_title()."<a/>";
	echo "</br>";
	echo "<a href='".site_url()."/my-product-details?id=".get_the_ID()."'>".get_the_post_thumbnail( $post_id, 'thumbnail' )."<a/>";
	echo "</br>";
    echo _cmk_check_ordered_product( get_the_ID() );*/

	/**
	 * woocommerce_before_shop_loop_item hook. 
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	//do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.

	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>

</li-->