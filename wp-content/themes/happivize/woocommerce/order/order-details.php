<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

$order_status = $order->get_status();
if ($order_status == 'completed' || $order_status == 'processing')  {

/*$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();*/
?>
<style type="text/css">
	.order-info{display: none !important;}
	h2{margin-top: 6%;}
</style>
<!--h2><?php _e( 'Order Details', 'woocommerce' ); ?></h2-->
<!--table class="shop_table order_details">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody-->
  <div class="add_data_text">
		<?php $ordl = array();
			foreach( $order->get_items() as $item_id => $item ) { 

               
			$ordl[] = 	$item['product_id'];
			//echo $item['product_id'];
				$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
				$purchase_note = get_post_meta( $product->id, '_purchase_note', true );

				wc_get_template( 'order/order-details-item.php', array(
					'order'					=> $order,
					'item_id'				=> $item_id,
					'item'					=> $item,
					'show_purchase_note'	=> $show_purchase_note,
					'purchase_note'			=> $purchase_note,
					'product'				=> $product,
				) );
			}
		?>
		<?php do_action( 'woocommerce_order_items_table', $order ); ?>
      </div>
	<!--/tbody>
	<tfoot-->
		<?php
			/*foreach ( $order->get_order_item_totals() as $key => $total ) {
				?>
				<!--tr-->
					<!--th scope="row"--><?php // echo $total['label']; ?><!--/th-->
					<!--td--><?php // echo $total['value']; ?><!--/td-->
				</tr>
				<?php
			}*/
		?>
	<!--/tfoot-->
<!--/table-->

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php if ( $show_customer_details ) : ?>
	<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
<?php endif; ?>





<?php 

/*$payment_method = get_post_meta( $order_id, '_payment_method', true );
if($payment_method == "authorize_net_cim_credit_card"){
    $output_mthd_digits = get_post_meta( $order_id, '_wc_authorize_net_cim_credit_card_account_four', true );
    $output_mthd = "Card ending in - ".$output_mthd_digits;
}
elseif($payment_method == "paypal"){
    $output_mthd = "Paypal";
}

echo $output_mthd;*/

count($ordl);

for($k = 0; $k <= count($ordl); $k++){


$download['downloadable']       =      get_post_meta($ordl[$k],'_downloadable' ,TRUE);
$download['private_session']    =      get_post_meta($ordl[$k],'private_session' ,TRUE);
$download['private_session2']   =      get_post_meta($ordl[$k],'private_session_sub' ,TRUE);
$download['instruction']        =      get_post_meta($ordl[$k],'product_Instruction' ,TRUE);
$download['streaming']          =      get_post_meta($ordl[$k],'streaming' ,TRUE); 
$download['phone']              =      get_post_meta($ordl[$k],'phone' ,TRUE);
$download['Alternate']          =      get_post_meta($ordl[$k],'Alternate' ,TRUE);
$download['Passcode']           =      get_post_meta($ordl[$k],'Passcode' ,TRUE);
//$download['timezone'] =        get_post_meta($ordl[1],'timezone' ,TRUE); 
$download['datetime']           =      get_post_meta($ordl[$k],'datetime' ,TRUE);
$download['instructionfull']    =      get_post_meta($ordl[$k],'product_Instruction2' ,TRUE);

/*$_product = wc_get_product($ordl[$k]); 
 $u = $_product->get_regular_price();*/
  
  

  global $wpdb;

  $qry = "select meta_value from hp_postmeta where post_id = '".$ordl[$k]."' and meta_key = '_regular_price'";
  $kl = $wpdb->get_row($qry); 

  $qry1 = "select meta_value from hp_postmeta where post_id = '".$order_id."' and meta_key = '_order_total'";
  $k2 = $wpdb->get_row($qry1);

  /* Product Subscription Price */
  $myvalues = get_post_meta($ordl[$k],'_wcsatt_schemes',true);
    if($myvalues){ 

    foreach ($myvalues as $myvalue) { 
      $products_subs_price = $myvalue['subscription_regular_price'];
      $products_regular_price = $kl->meta_value;
      if($products_subs_price){
        /* Ordered Items Price */
          global $woocommerce;
          $order = wc_get_order($order_id);

          $items = $order->get_items();    
          foreach ( $items as $item_id => $item_data ) {
              $item_total = $order->get_item_meta($item_id, '_line_subtotal', true);                         
              if($item_total == $products_regular_price){ 
                if(!empty($download['downloadable']) && $download['downloadable'] == "yes" || !empty($download['instruction'] ) || !empty($download['instructionfull'] ) || !empty($download['private_session'] ) || !empty($download['private_session2'] ) ) {
                    wc_get_template( 'myaccount/my-downloads.php' );
                    $prdct_name = $item_data['name'];
                    echo "<div class='orders_details'>";
                    if(!empty($download['instruction'] )){
                        echo "<h2>Product Instruction<span style='font-size: 12px;'> (".$prdct_name.")</span></h2>";
                        echo "<p>".$download['instruction']."</p>";
                    }
                    if(!empty($download['private_session'] )){
                        echo "<h2>Private Session Product<span style='font-size: 12px;'> (".$prdct_name.")</span></h2>";
                        echo "<p>".$download['private_session']."</p>";
                    }  
                    echo "</div>";
                }
              }
              elseif($item_total == $products_subs_price){               
               
                if(!empty($download['downloadable']) && $download['downloadable'] == "yes" || !empty($download['instruction'] ) || !empty($download['instructionfull'] ) || !empty($download['private_session'] ) || !empty($download['private_session2'] ) ) {
                    wc_get_template( 'myaccount/my-downloads.php' );
                    $prdct_name = $item_data['name'];
                    echo "<div class='orders_details'>";
                   if(!empty($download['instructionfull'] )){
                      echo "<h2>Product Instruction<span style='font-size: 12px;'> (".$prdct_name.")</span></h2>";
                      echo "<p>".$download['instructionfull']."</p>";
                  }
                  if(!empty($download['private_session2'] )){
                      echo "<h2>Private Session Product<span style='font-size: 12px;'> (".$prdct_name.")</span></h2>";
                      echo "<p>".$download['private_session2']."</p>";
                  }
                    echo "</div>";
                }
              }
              else{
                  //echo "<h2> NO DATA TO DISPLAY </h2>";
              }
          }
        }
      }
  }
  else{
      if(!empty($download['downloadable']) && $download['downloadable'] == "yes" || !empty($download['instruction'] ) || !empty($download['instructionfull'] ) || !empty($download['private_session'] ) || !empty($download['private_session2'] ) ) {
          wc_get_template( 'myaccount/my-downloads.php' );
          $_getproduct = wc_get_product($ordl[$k]); 
          $prdc_name1 = $_getproduct->get_title();
          echo "<div class='orders_details'>";
          if(!empty($download['instruction'] )){
              echo "<h2>Product Instruction<span style='font-size: 12px;'> (".$prdc_name1.")</span></h2>";
              echo "<p>".$download['instruction']."</p>";
          }
          if(!empty($download['private_session'] )){
              echo "<h2>Private Session Product<span style='font-size: 12px;'> (".$prdc_name1.")</span></h2>";
              echo "<p>".$download['private_session']."</p>";
          }  
          echo "</div>";
      }
  }
    

  

  
  //print_r($download);  

/*  if($kl->meta_value > $k2->meta_value)
  {
  	$cond = "";
  }
  elseif($kl->meta_value == $k2->meta_value){
    $cond = "no";
  }
  else{
  $cond = "no";

  }*/

  

  //print_r($download);
  /*if(!empty($download['downloadable']) && $download['downloadable'] == "yes" || !empty($download['instruction'] ) || !empty($download['instructionfull'] ) || !empty($download['private_session'] ) || !empty($download['private_session2'] ) ) {
      wc_get_template( 'myaccount/my-downloads.php' );

      echo "<div class='orders_details'>";
      if(!empty($cond ))
      {
          if(!empty($download['instruction'] )){
              echo "<h2>Product Instruction</h2>";
              echo "<p>".$download['instruction']."</p>";
          }
          if(!empty($download['private_session'] )){
              echo "<h2>Private Session Product</h2>";
              echo "<p>".$download['private_session']."</p>";
          }
      }
      else{
          if(!empty($download['instructionfull'] )){
              echo "<h2>Product Instruction</h2>";
              echo "<p>".$download['instructionfull']."</p>";
          }
          if(!empty($download['private_session2'] )){
              echo "<h2>Private Session Product</h2>";
              echo "<p>".$download['private_session2']."</p>";
          }
      }
      echo "</div>";
  }
  elseif(!empty($download['instructionfull'])){
      echo "<h2>Product Instruction</h2>";
      echo $download['instructionfull'];

  }
  elseif(!empty($download['private_session']) || !empty($download['instruction'] )){ 
  	 echo "<h2>Private Session Product</h2>"; ?>
  <!-- <table class="table table-bordered">
      <thead>
        <tr>
          <th>Private Session</th>
           </tr>
      </thead> -->
      <tbody>
         <tr>
    <?php    echo $download['private_session']; ?>
   <!--  </tr>
      </tbody>
    </table> -->
  <?php }
  elseif(!empty($download['streaming'])){
  echo "<h2>Your Group Call</h2>";  ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Streaming Link</th>
          <th>Dial-in #</th>    
          <th>Alternate #</th>
          <th>Passcode</th>
        
          

        </tr>
      </thead>
      <tbody>
         <tr>
         <?php 
         $ph = $download['phone'];
         $alp = $download['Alternate'];

       $ph1 = "(".substr($ph, 0, 3).") ".substr($ph, 3, 3)."-".substr($ph,6);
       $alp1 = "(".substr($alp, 0, 3).") ".substr($alp, 3, 3)."-".substr($alp,6);
          echo "<td>".date("M d , Y", strtotime($download['datetime']))."</td>";
          echo "<td>".date("H:i:s", strtotime($download['datetime']))."</td>";
          echo "<td><a href='".$download['streaming']."'>".$download['streaming']."</a></td>";
          echo "<td>".$ph1."</td>";
          echo "<td>".$alp1."</td>"; 
          echo "<td>".$download['Passcode']."</td>";
        
        
         
          ?>
       
     </tr>
      </tbody>
    </table>



  <?php 

    if(!empty($download['instruction'] )){
        echo "<h2>Product Instruction</h2>";
        echo $download['instruction'];
    }


  } 

  else{
   // echo "<h2> NO DATA TO DISPLAY </h2>";
      
  }*/
}

}
else{
  echo "<h2>Nothing to Show for Current Order</h2>";
}
 

?>


<style type="text/css">
.orders_details h2 {
    margin: 5% 0 1%;
}
.orders_details p {
    font-size: 14px !important;
}
  .order-info{display: none !important;}
  h2{margin-top: 6%;}
.add_data_downldz{display: none;}

</style>

<script type="text/javascript">
  $("document").ready(function(){
   var count  =  $(".add_data_downldz").length;
   if(count == 1){
      $(".add_data_downldz").show();
   }
   if(count >= 2){    
      $(".add_data_downldz").first().show();
      
   }
   
  });
</script>