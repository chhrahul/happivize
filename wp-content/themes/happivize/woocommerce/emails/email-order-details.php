<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
<?php
global $wpdb;

$ordl = array();

 $orderi = new WC_Order( $order->id );
$items = $orderi->get_items();
foreach ( $items as $item ) {
 
 array_push($ordl,$item['product_id']);
 
}

$output_mthd = "";
$payment_method = get_post_meta( $order->id, '_payment_method', true );
if($payment_method == "authorize_net_cim_credit_card"){
    $output_mthd_digits = get_post_meta( $order->id, '_wc_authorize_net_cim_credit_card_account_four', true );
    $output_mthd = "Card ending in - ".$output_mthd_digits;
}
elseif($payment_method == "paypal"){
    $output_mthd = "PayPal";
}

?>
<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="0">
	<thead>
		<tr>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="td" scope="col" style="text-align:left;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( array(
			'show_sku'      => $sent_to_admin,
			'show_image'    => false,
			'image_size'    => array( 32, 32 ),
			'plain_text'    => $plain_text,
			'sent_to_admin' => $sent_to_admin
		) ); ?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
		     $countval = count($totals);
		        if($countval === 3){
		          $i = 0; 
		          foreach ( $totals as $total ) {         
		            $i++;
		            ?>
		            <tr>
		              <th class="td" scope="row" colspan="2" style="text-align:left; "><?php echo $total['label']; ?></th>
		              <td class="td" style="text-align:left; width:33%;"><?php if ( $i === 2 ) { 
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

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<p style="margin:40px auto 0 !important; font-family: arial,sans-serif !important; font-size: 13px; color: #000 !important;"><?php printf( __( '<span style="margin-right: 8px;">Order ID#:</span> %s', 'woocommerce'), $order->get_order_number() ); ?></p>
<p style="color: #000 !important;font-family: arial,sans-serif !important; font-size: 13px;"><?php printf( 'Order Date: <time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?></p>