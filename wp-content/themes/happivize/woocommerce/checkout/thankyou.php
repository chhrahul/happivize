<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

		<p class="woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>
		<?php //echo "hello"; ?>
		<!-- <p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p> -->

		<!-- <ul class="woocommerce-thankyou-order-details order_details">
			<li class="order">
				<?php _e( 'Order Number:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				<?php _e( 'Date:', 'woocommerce' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php _e( 'Total:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment Method:', 'woocommerce' ); ?>
				<strong><?php echo $order->payment_method_title; ?></strong>
			</li>
			<?php endif; ?>
		</ul> -->
		<div style="width:60%; margin: auto; background-color: #fff; ">
		<header class="entry-header" id="after_revievedorder" style="margin-bottom: 7%;">
		<h1 class="entry-title" style="display: block;">Thank you</h1>	</header>
		<div id="thhank_you_date" style="width: 100%;text-align: center;"><a href="https://happivize.com/"><img style="margin: auto; display: inherit; width: 60%;" src="<?php echo get_template_directory_uri();?>/images/happivize-logo.png"></a></div>
		<h1 style="text-align:center!important; margin-top: 4% !important; margin-bottom:50px !important; color:#000!important; font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif; font-size:30px; font-weight:300; line-height:150%; margin:0">
		<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you for your order', 'woocommerce' ), $order ); ?>  :)  </h1>

		<p style="margin: 0 0 10px;"> <?php echo "We will also send you a receipt to the email below."; ?></p>

		<p style="margin-bottom:50px !important;margin: 0 0 10px; "> <?php echo "Please visit your".'<a style="padding:0 5px; color:#15c;" href="https://happivize.com/my-account/">My Account</a>'."page to access your product"; ?></p>



		<table class="shop_table order_details" style="margin-bottom: 50px;background-color: transparent !important;width: 100% !important;padding: 0px; ">
		    <thead>
		        <tr>
		            <th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
		            <th class="product-name"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
		            <th class="product-total"><?php _e( 'Price', 'woocommerce' ); ?></th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        if ( sizeof( $order->get_items() ) > 0 ) {

		            foreach( $order->get_items() as $item ) {
		                $_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
		                $item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );

		                ?>
		                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
		                    <td class="product-name">
		                        <?php
		                            if ( $_product && ! $_product->is_visible() )
		                                echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
		                            else
		                                echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
		                                echo '<br/>' . $_product->post->post_excerpt; 
		                                // echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );

		                          

		                            $item_meta->display();

		                            if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

		                                $download_files = $order->get_item_downloads( $item );
		                                $i              = 0;
		                                $links          = array();

		                                foreach ( $download_files as $download_id => $file ) {
		                                    $i++;

		                                    $links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
		                                }

		                                echo '<br/>' . implode( '<br/>', $links );
		                            }
		                        ?>
		                    </td>
		                    <td class="product-qunt">
		                        <?php   echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item ); ?>
		                    </td>
		                    <td class="product-total">
		                        <?php echo $order->get_formatted_line_subtotal( $item ); ?>
		                    </td>
		                </tr>
		                <?php

		                if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
		                    ?>
		                    <tr class="product-purchase-note">
		                        <td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
		                    </tr>
		                    <?php
		                }
		            }
		        }

		        do_action( 'woocommerce_order_items_table', $order );
		        ?>
		    </tbody>
		       <tfoot>
		    <?php 

		$output_mthd = "";
		$payment_method = get_post_meta( $order->id, '_payment_method', true );
		if($payment_method == "authorize_net_cim_credit_card"){
		    $output_mthd_digits = get_post_meta( $order->id, '_wc_authorize_net_cim_credit_card_account_four', true );
		    $output_mthd = "Card ending in - ".$output_mthd_digits;
		}
		elseif($payment_method == "paypal"){
		    $output_mthd = "PayPal";
		}

		       if ( $totals = $order->get_order_item_totals() ) {
		                 $countval = count($totals);
		                 if($countval === 3){
		                  $i = 0; 
		                  foreach ( $totals as $total ) {         
		                    $i++;
		                    ?>
		                    <tr>
		                      <th class="td" scope="row" colspan="2" style="text-align:left; "><?php echo $total['label']; ?></th>
		                      <td class="td" style="text-align:left; width:33%;"><?php 
		                      	if ( $i === 2 ) {
		                      		if($total['label'] == "Discount:"){
		                      			echo $total['value']; 
		                      		}
		                      		else{
		                      			echo $output_mthd;
		                      		}		                      		
		                      	}else{ echo $total['value']; }?></td>
		                    </tr>
		                    <?php                  
		                  } 
		                }
		                elseif($countval === 4){
		                  $i = 0; 
		                  foreach ( $totals as $total ) {
		                   $label_val =  $total['label'];
		                    $i++;
		                    ?>
		                    <tr>
		                      <th class="td" scope="row" colspan="2" style="text-align:left; "><?php echo $total['label']; ?></th>
		                      <td class="td" style="text-align:left; width:33%;">
		                      <?php
		                        if ( $i === 2 ) { echo $total['value']; 
		                        }
		                        elseif ( $i === 3 ) { echo $output_mthd; 
		                        }
		                        else{ echo $total['value']; }
		                        ?>              
		                      </td>
		                    </tr>
		                    <?php
		                 }
		                }
		            
		              }
		    ?>
		    </tfoot>
		</table>

			<?php
			 if( $order->get_used_coupons() ) {
	    
			    	$coupons_count = count( $order->get_used_coupons() );
			        ?>
			        <p style="margin-left: 0px;margin-top: 3%;margin-bottom: 3%;font-size: 16px;"><strong>Coupon used:</strong>
			        <?php
			        $i = 1;
			        
			        foreach( $order->get_used_coupons() as $coupon) {
				        echo $coupon;
				        if( $i < $coupons_count )
				        	echo ', ';
				        $i++;
			        }
			        
			        echo '</p>';
			    }
			?>

		    <p class="order" style="margin-bottom: 0 !important; color: #000 !important;    font-family: arial,sans-serif !important;font-size: 13px;margin: 0 0 10px;">
		        <?php _e( 'Order ID#:', 'woocommerce' ); ?>
		      <span style=" margin-left: 8px;"> <?php echo $order->get_order_number(); ?></span>
		    </p>
		    <p class="date" style=" color: #000 !important;margin: 0 0 10px;    font-family: arial,sans-serif !important; font-size: 13px;">
		        <?php _e( 'Order Date:', 'woocommerce' ); ?>
		        <?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>
		    </p>
		   
		<dl class="customer_details">
		<?php
		  //  if ( $order->billing_email ) echo '<dt>' . __( 'Email:', 'woocommerce' ) . '</dt><dd>' . $order->billing_email . '</dd>';
		  //  if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'woocommerce' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

		    // Additional customer details hook
		   // do_action( 'woocommerce_order_details_after_customer_details', $order );
		?>
		</dl>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

		<div class="col2-set addresses">

		    <div class="col-1">

		<?php endif; ?>

		        <header class="title">
		            <p style=" color: #000 !important;margin: 0 0 10px; font-family: arial,sans-serif !important; font-size: 13px;"><?php _e( 'Billing Information:', 'woocommerce' ); ?></p>
		        </header>
		        <p style="margin-bottom: 0 !important;margin: 0 0 10px;color: #000 !important;margin: 0 0 10px; font-family: arial,sans-serif !important; font-size: 13px;">
		            <?php
		                if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
		            ?>
		        </p>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

		    </div><!-- /.col-1 -->

		    <div class="col-2">

		        <header class="title">
		            <p><?php _e( 'Shipping Address', 'woocommerce' ); ?></p>
		        </header>
		        <address>
		            <?php
		                 if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();

		            ?>
		        </address>

		    </div><!-- /.col-2 -->

		</div><!-- /.col2-set -->
		 
		<?php endif; ?>
		<?php if ( $order->billing_email ) echo '<p style="margin-bottom: 0 !important;font-family: arial,sans-serif !important; color: #000 !important;font-size: 13px;margin: 0 0 10px;">' . __( '', 'woocommerce' ).$order->billing_email . '</p>';
		      if ( $order->billing_phone ) echo '<p style="font-family: arial,sans-serif !important;color: #000 !important; font-size: 13px;margin: 0 0 10px;">' . __( '', 'woocommerce' ). $order->billing_phone . '</p>'; 
		     do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
		<div class="clear"></div>

		<p style="margin-top: 5% !important;margin: 0 0 10px;"><a href="https://happivize.com/refund-policy" target="_blank" style="color:#15c; margin-bottom:30px!important; font-weight:normal; text-decoration:underline">Refund Policy</a></p>
		<p style="margin-bottom: 70px !important;margin: 0 0 10px; "><span style="color: #000 !important;font-family: arial,sans-serif !important; font-size: 13px; ">For customer service, please contact:</span> <a href="mailto:support@happivize.com" target="_blank" style="color:#15c; font-weight:normal; text-decoration:underline">support@happivize.com</a></p>


		</div>
		<div class="clear"></div>

	<?php endif; ?>

	<?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>

<style type="text/css">
	.add_data_text,.orders_details, .woocommerce > p, .add_data_downldz {
   		display: none;
	}
</style>