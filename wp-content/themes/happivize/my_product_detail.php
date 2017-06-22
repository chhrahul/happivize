<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 Template Name: Details
 */


get_header(); ?>
  

<?php 


 


$order_id = $_GET['id']; 
if(! empty( $order_id)){

$download = array();

$download[] = get_post_meta($order_id,'_downloadable' ,TRUE);
$download[] = get_post_meta($order_id,'private_session' ,TRUE);
$download[] = get_post_meta($order_id,'streaming' ,TRUE);
$download[] = get_post_meta($order_id,'phone' ,TRUE);
$download[] = get_post_meta($order_id,'Alternate' ,TRUE);
$download[] = get_post_meta($order_id,'Passcode' ,TRUE);
$download[] = get_post_meta($order_id,'timezone' ,TRUE);
$download[] = get_post_meta($order_id,'datetime' ,TRUE);
      
if( empty($download[0]) || $download[0] == "no"){
   echo "<h2>Proiduct Type</h2>";
}


if(! empty($download[0]) && $download[0] == "yes"){
    wc_get_template( 'myaccount/my-downloads.php' );
}

elseif(! empty($download[1])){ 

    echo "<strong><h2>Private Session:</strong></h2>".$download[1];
}
elseif(! empty($download[2])){ 
 
    echo "<strong>Phone:</strong>".$download[2];
    echo "<strong>Phone:</strong>".$download[3];
    echo "<strong>Phone:</strong>".$download[4];
    echo "<strong>Phone:</strong>".$download[4];
    echo "<strong>Phone:</strong>".$download[6];
    echo "<strong>Phone:</strong>".$download[7];

} 
else{
 echo "<h2> NO DATA TO DISPLAY </h2>";
    
}



}


?>

<?php get_footer(); ?>