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

<?php
/* echo "<pre>";
print_r($downloads);
echo "</pre>"; */
?>
	<?php do_action( 'woocommerce_before_available_downloads' ); ?>

	<h2><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available Downloads', 'woocommerce' ) ); ?></h2>

	<ul class="digital-downloads">
		<?php foreach ( $downloads as $download ) : ?>
			<li>
			
				<?php
				$order_id = $download['order_id'];
				$order = new WC_Order($order_id);
				$orderDate = $order->order_date;
				$product_id = $download['product_id']
				$user_id = get_current_user_id();
				$now = time();
				$order_date = strtotime($orderDate);
				$datediff = $now - $order_date;
				$orderDays =  floor($datediff/(60*60*24));	

				do_action( 'woocommerce_available_download_start', $download );

				if ( is_numeric( $download['downloads_remaining'] ) )
					echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );					

				if($orderDays >= 30){
					echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );
				}
				else
				{
					$fileName = $download['file']['file'];
					?>
					<a href="<?php echo $fileName; ?>" title="<?php echo $download['download_name']; ?>"><?php echo $download['download_name']; ?></a>
						<div class="tlClogo"><audio controls="controls"><source src="<?php echo $fileName; ?>" type="audio/mpeg"></audio></div>
						<script>$('.tlClogo').bind('contextmenu', function(e) {return false;});</script>
					<?php
					echo " <input type='button' name='txtNonRefund' id='txtNonRefund' value='Return this product?' onclick='return productreturnreq(".$product_id.",".$user_id.")'>";
					echo " <input type='button' name='txtNoReturn' id='txtNoReturn' value='I want to Keep this product' onclick='return productnotreturnreq(".$product_id.",".$user_id.")'>";
				}
				do_action( 'woocommerce_available_download_end', $download );
				?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php endif; ?>

<script>
function productreturnreq(val,userId){
	var res = confirm("Are you sure want to return this product?");
	if(res){
		alert(val + " = email send code here with ajax file.");
		/* $.ajax({
			type: 'POST',
			url: 'wp-ajax/product_return.php',
			data: { product_id: val,user_id: userId },
			success: function(response) {
				$("#lockicon-"+lessonId).html(response);
			}
		}); */
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function productnotreturnreq(val){
	var res = confirm("Are you sure you want to keep this product?");
	if(res){
		alert(val + " = email send code here with ajax file.");
		return true;
	}
	else
	{
		return false;
	}
}
</script>
