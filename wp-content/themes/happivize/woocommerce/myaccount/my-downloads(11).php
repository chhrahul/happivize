<?php

/**

 * My Orders

 *

 * Shows recent orders on the account page.

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-downloads.php.

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



if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>



	<?php do_action( 'woocommerce_before_available_downloads' ); ?>


<div class="add_data_downldz">
	<h2 class="avail_downlaod"><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available Downloads', 'woocommerce' ) ); ?></h2>

<div class="digi_downloads">
	<table class="shop_table shop_table_responsive my_account_orders my_account_memberships my_ordrs">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Audio</th>
                <th>Return/Keep</th>
                <th>Download</th>                
            </tr>
        </thead>
		<?php
		foreach ( $downloads as $download ) : ?>
			<tbody>
            <tr>
			<?php
				$order_id = $download['order_id'];
				$order = new WC_Order($order_id);
				$orderDate = $order->order_date;
				$product_id = $download['product_id'];
				$user_id = get_current_user_id();
				$now = time();
				$order_date = strtotime($orderDate);
				$datediff = $now - $order_date;
				$orderDays =  floor($datediff/(60*60*24));	
				$download_name = $download['download_name'];

				do_action( 'woocommerce_available_download_start', $download );
			?>
			<?php
			global $wpdb;
			$prsql = 'SELECT prod_status,download_code,email_confirm FROM '.$wpdb->prefix.'downloadstatus WHERE product_id = "'.$product_id.'" AND user_id = "'.$user_id.'" AND email_confirm = 0';
			$orderFlag = $wpdb->get_row($prsql,OBJECT);
			$proFlag = $orderFlag->prod_status;
			$downloadCode = $orderFlag->download_code;
			$email_confirm = $orderFlag->email_confirm;
			
			if($_GET['downloadcode']!=""){
				if($downloadCode == $_GET['downloadcode']){
					$wpdb->update( 
						$wpdb->prefix.'downloadstatus',
						array(
							'email_confirm' => 1 
						),
						array( 'user_id' => $user_id, 'product_id' => $product_id), 
						array(
							'%d'
						),
						array( '%d','%d' )
					);				
				}
				?>
				<script>
				window.location="<?php echo get_site_url(); ?>/my-account/";
				</script>
				<?php
			}
			
			$prsql = 'SELECT email_confirm FROM '.$wpdb->prefix.'downloadstatus WHERE product_id = "'.$product_id.'" AND user_id = "'.$user_id.'"';
			$orderFlag = $wpdb->get_row($prsql,OBJECT);
			$emailConfirm = $orderFlag->email_confirm;
			?>
				<td data-title="No."><?php echo $order_id; ?></td>
				<td data-title="Title"><?php echo $download_name; ?></td>
                <td data-title="Audio">
				<?php				
				if ( is_numeric( $download['downloads_remaining'] ) )
					echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );
					
					$fileName = $download['file']['file'];
					?>
						<!--a href="<?php echo $fileName; ?>" title="<?php echo $download['download_name']; ?>"><?php echo $download['download_name']; ?></a-->
						<!--div class="tlClogo"><audio controls="controls"><source src="<?php echo $fileName; ?>" type="audio/mpeg"></audio></div>
						<script>$('.tlClogo').bind('contextmenu', function(e) {return false;});</script-->
						
<object type="application/x-shockwave-flash" data="<?php echo get_site_url(); ?>/fplayer/template_mini/player_mp3_mini.swf" width="200" height="20">
<param name="movie" value="<?php echo get_site_url(); ?>/fplayer/template_mini/player_mp3_mini.swf" />
<param name="bgcolor" value="#000000" />
<param name="FlashVars" value="mp3=<?php echo $fileName; ?>" />
</object>
				</td>
				<td data-title="Return/Keep">
				<?php				
				if ( is_numeric( $download['downloads_remaining'] ) )
					echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );				

					if($orderDays >= 30){
						echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );
					}
					else
					{
						$fileName = $download['file']['file'];
						
						$return_prod = "returnproduct";
						$buy_prod = "quickbuy";
						$onReturnClick = 'return productreturnreq('.$order_id.','.$product_id.','.$user_id.',"'.$return_prod.'","'.$fileName.'")';
						$onBuyClick = 'return productreturnreq('.$order_id.','.$product_id.','.$user_id.',"'.$buy_prod.'","'.$fileName.'")';
						echo '<div id="lockicon">';
						if($proFlag == "R"){
							echo "<font color='red'>Your product return is under process.</font>";
						}
						else if($proFlag == "B" && $email_confirm == 0){
							echo "<font color='red'>You can download this audio after confirm your link which is sent into your email.</font>";
						}
						else if($emailConfirm == 1){
							echo "<font color='red'>Now you can download this audio.</font>";
						}
						else
						{
							echo " <input type='button' name='txtNonRefund' id='txtNonRefund' value='Return this product?' onclick='".$onReturnClick."'>";
							echo " <input type='button' name='txtNoReturn' id='txtNoReturn' value='I want to Keep this product' onclick='".$onBuyClick."'>";
						}
						echo '</div>';
					}
					?>
					</td>
					<td data-title="Download">
					<?php
					echo "<div id='downloadicons'>";
					$downloadCancelIcon = get_template_directory_uri().'/images/download_cancel.png';
					$downloadIcon = get_template_directory_uri().'/images/download-icon.png';
					if($emailConfirm == 1){
						$fileName = $download['file']['file'];
						echo "<font color='red'><a href='".$fileName."' download><img src='".$downloadIcon."' title='download' alt='download'></a></font>";
					}
					else if($proFlag == "R"){
						$fileName = $download['file']['file'];
						echo "<font color='red'><img src='".$downloadCancelIcon."' title='download' alt='download'></font>";
					}
					else
					{
						echo "<font color='red'><img src='".$downloadCancelIcon."' title='download' alt='download'></font>";
					}
					echo "</div>";
					?>
					</td>
					</tr>
					</tbody>
					<?php				
				do_action( 'woocommerce_available_download_end', $download );
				?>
			</li>

		<?php endforeach; ?>
	</table>
	</div>
	</div>
	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php endif; ?>

<script>
function productreturnreq(orderno,productid,userId,product_status,fileName){
	if(product_status == "returnproduct"){
		var res = confirm("Are you sure want to return this product?");
	}
	else
	{
		var res = confirm("Are you sure want to quick buy this product?");
	}	
	if(res){
		$.ajax({
			type: 'POST',
			url: '<?php echo get_site_url(); ?>/wp-ajax/product_return.php',
			data: {orderid:orderno, product_id: productid,user_id: userId,prostatus: product_status },
			success: function(response) {
				if(response == "R"){
					$("#lockicon").html("<font color='red'>Your product return is under process.</font><br>");
				}
				if(response == "B"){
					$("#lockicon").html("<font color='red'>You can download this audio after confirm your link which is sent into your email.</font>");
					/* $("#downloadicons").html("<a href='"+fileName+"' download>Download</a>"); */
				}
			}
		});
		return true;
	}
	else
	{
		return false;
	}
}
</script>