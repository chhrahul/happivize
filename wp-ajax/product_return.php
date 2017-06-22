<?php
include('../wp-config.php');
global $wpdb;
$orderid = $_POST['orderid'];
$product_id = $_POST['product_id'];
$user_id = $_POST['user_id'];
$prod_status = $_POST['prostatus'];
$tableName = $wpdb->prefix."downloadstatus";

/*
$pf = new WC_Product_Factory();  
$product = $pf->get_product($product_id);
*/

$_product = wc_get_product( $product_id );
$productName = $_product->get_title();
$regularPrice = $_product->get_regular_price();
$salePrice = $_product->get_sale_price();
$actualPrice = $_product->get_price();
$downloads = $_product->get_files();

foreach($downloads as $download){
	$fileName = $download['name'];
	$file = $download['file'];
}

$toadmin = get_option('admin_email');
$user_info = get_userdata($user_id);
/* $first_name = $user_info->first_name;
$last_name = $user_info->last_name;
$fullname = ucfirst($first_name).' '.ucfirst($last_name); */
$tocustomer = $user_info->user_email;
$username = $user_info->user_login;

$length = 7;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
	$randomString .= $characters[rand(0, $charactersLength - 1)];
}
$downloadCode = md5($randomString);

$confirmlink = get_site_url().'/my-account?downloadcode='.$downloadCode;

$headers = array('Content-Type: text/html; charset=UTF-8');

if($prod_status == "returnproduct"){
	$proStatus = 'R';
	$subject = 'Return product';
	$subAdmin = 'Happivize: '.$username.' want to return '.$productName.' product';
	$bodyAdmin .= '<p>Hello Admin,</p>';
	$bodyAdmin .= '<table border="1" cellpadding="1" cellspacing="1" width="100%">
		<tr><td colspan="3"><b>Customer Details</b></td></tr>
		<tr>
			<td>Email Address</td>
			<td>Username</td>
			<td></td>
		</tr>
		<tr>
			<td>'.$tocustomer.'</td>
			<td>'.$username.'</td>
			<td></td>
		</tr>
		<tr><td colspan="2"><b>Product Details</b></td></tr>
		<tr>
			<td>Order no</td>
			<td>Product Name</td>
			<td>Product Price</td>
		</tr>
		<tr>
			<td>'.$orderid.'</td>
			<td>'.$productName.' - '.$fileName.'</td>
			<td>'.$actualPrice.'$</td>
		</tr>
	</table>';
	$bodyAdmin .= '<p><br><br>Thanks,<br><b>Happivize</b></p>';
	
	$subCustomer = 'Happivize: '.$username.' want to return '.$productName.' product';
	$bodyCustomer .= '<p>Hello '.$username.',</p>';
	$bodyCustomer .= '<table border="1" cellpadding="1" cellspacing="1" width="100%">
		<tr><td colspan="3"><b>Your Details</b></td></tr>
		<tr>
			<td>Your Email Address</td>
			<td>Your Username</td>
			<td></td>
		</tr>
		<tr>
			<td>'.$tocustomer.'</td>
			<td>'.$username.'</td>
			<td></td>
		</tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr><td colspan="3"><b>Product Details</b></td></tr>
		<tr>
			<td>Order no</td>
			<td>Product Name</td>
			<td>Product Price</td>
		</tr>
		<tr>
			<td>'.$orderid.'</td>
			<td>'.$productName.' - '.$fileName.'</td>
			<td>'.$actualPrice.'$</td>
		</tr>
	</table>'; 
	$bodyCustomer .= '<br><br><b>Your '.$productName.' product return is under process.</b><br>';
	$bodyCustomer .= '<p><br><br>Thanks,<br><b>Happivize</b></p>';
}
if($prod_status == "quickbuy"){
	$proStatus = 'B';
	$subAdmin = 'Happivize: '.$username.' want to keep '.$productName.' product';
	$bodyAdmin .= '<p>Hello Admin,</p>';
	$bodyAdmin .= '<table border="1" cellpadding="1" cellspacing="1" width="100%">
		<tr><td colspan="3"><b>Customer Details</b></td></tr>
		<tr>
			<td>Email Address</td>
			<td>Username</td>
			<td></td>
		</tr>
		<tr>
			<td>'.$tocustomer.'</td>
			<td>'.$username.'</td>
			<td></td>
		</tr>
		<tr><td colspan="2"><b>Product Details</b></td></tr>
		<tr>
			<td>Order no</td>
			<td>Product Name</td>
			<td>Product Price</td>
		</tr>
		<tr>
			<td>'.$orderid.'</td>
			<td>'.$productName.' - '.$fileName.'</td>
			<td>'.$actualPrice.'$</td>
		</tr>
	</table>';
	$bodyAdmin .= '<p><br><br>Thanks,<br><b>Happivize</b></p>';
	
	$subCustomer = 'Happivize: '.$username.' want to keep '.$productName.' product';
	$bodyCustomer .= '<p>Hello '.$username.',</p>';
	$bodyCustomer .= '<table border="1" cellpadding="1" cellspacing="1" width="100%">
		<tr><td colspan="3"><b>Your Details</b></td></tr>
		<tr>
			<td>Your Email Address</td>
			<td>Your Username</td>
			<td></td>
		</tr>
		<tr>
			<td>'.$tocustomer.'</td>
			<td>'.$username.'</td>
			<td></td>
		</tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr><td colspan="3"><b>Product Details</b></td></tr>
		<tr>
			<td>Order no</td>
			<td>Product Name</td>
			<td>Product Price</td>
		</tr>
		<tr>
			<td>'.$orderid.'</td>
			<td>'.$productName.' - '.$fileName.'</td>
			<td>'.$actualPrice.'$</td>
		</tr>
	</table>'; 
	$bodyCustomer .= '<br><br><a href="'.$confirmlink.'">Confirmation link</a><br>';
	$bodyCustomer .= '<br><b>You can download '.$productName.' product from my account page.</b><br>';
	$bodyCustomer .= '<p><br><br>Thanks,<br><b>Happivize</b></p>';
}

	$wpdb->insert( 
		$tableName, 
		array( 
			'orderid' => $orderid, 
			'product_id' => $product_id,
			'user_id' => $user_id,
			'prod_status' => $proStatus,
			'download_code' => $downloadCode
		),
		array( 
			'%d',
			'%d',
			'%d',
			'%s',
			'%s'
		) 
	);
	wp_mail( $toadmin, $subAdmin, $bodyAdmin, $headers );
	wp_mail( $tocustomer, $subCustomer, $bodyCustomer, $headers );
if($proStatus == 'R'){echo "R";}
if($proStatus == 'B'){echo "B";}
?>