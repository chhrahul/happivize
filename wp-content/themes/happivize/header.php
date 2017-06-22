<?php

/*

* The template for displaying the header

* Displays all of the head element and everything up until the "site-content" div.

* @package WordPress

* @subpackage Twenty_Sixteen

* @since Twenty Sixteen 1.0

*/


// $_REQUEST['a_redirect_to'];
if($_REQUEST['a_redirect_to']=="https://happivize.com/checkout/")
{
  if ( is_user_logged_in() ) {
   header('Location: https://happivize.com/checkout/');
 }
}
if($_REQUEST['a_redirect_to']=="http://happivize.com/my-account/")
{ //echo "hello";
  if ( is_user_logged_in() ) {
   header('Location: https://happivize.com/my-account/');
 }
}
/*else
{ if ( is_user_logged_in() ) { header('Location: https://happivize.com/my-account/');}
}*/

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

   <head>

      <meta charset="<?php bloginfo( 'charset' ); ?>">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="profile" href="http://gmpg.org/xfn/11">

      <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>	

      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      <link rel="icon" href="<?php echo site_url(); ?>/favicon.ico" />  

      <?php endif; ?>	

      <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

      <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <script src="<?php bloginfo('template_url')?>/js/jquery.js"></script>	<script src="<?php bloginfo('template_url')?>/js/script.js"></script>



      <!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">









	<?php

	wp_head(); 



   /*  $p_id = get_the_ID();

     $got_id = $_GET['affiliate'];

     if(! empty($p_id ) && ! empty($got_id )){

      

      global $wpdb;

      

     $select = "TRUNCATE table hp_temp";

     $wpdb->query($select );

 



     $sql = "insert into hp_temp (aff_id , page_id ) values ('". $got_id."','".$p_id."')"; 

     $wpdb->query($sql);

 

   

     }	 

   $select = "select * from hp_temp";

     $data = $wpdb->get_row($select);

     

     $sql = "insert into hp_aff_referrals (ref_post_id) values ('". $data->page_id."')"; 

     $wpdb->query($sql);*/



	if ( is_user_logged_in() )		

	{

	?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <script>
        $( document ).ready(function() {

      			 $(".general_btn").click(function(event){

      				event.preventDefault();

      				alert("You are already  Subscribe");			 

      			 });
         }); 

      </script> 

      <!--style>#myModal, .modal-backdrop{display:none!important;} .modal-open{overflow:visible!important;}

      </style-->

	<?php 

	}

	?> 
<script>
    $( document ).ready(function() {  

      $('#user_login').val("<?php echo $_REQUEST['ml']?>");

    });

</script> 


    
   </head>

   <div class="loader_overlay"><img src="<?php bloginfo('template_url') ?>/images/ajax-loader.gif" alt="loader" class="loader_img" /></div>

   <div id="wraper">

   <header class="main_header">

      <div class="header_top">

         <div class="container">

            <div class="my_account_menu clearfix">

               

			   <?php

			   global $woocommerce;

			   

				if ( is_user_logged_in() ){

				?>										

               <ul class="myaccount_nav">

                  <li><img src="<?php echo get_template_directory_uri(); ?>/images/usr.png" alt="" /><a href="<?php echo get_site_url(); ?>/my-account">My Account</a></li>

                   <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
                        $count = WC()->cart->cart_contents_count;
                        ?><li><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php 
                        if ( $count > 0 ) {
                            ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/cart.png" alt="" /> Cart <span class="cart-contents-count">(<?php echo esc_html( $count ); ?>)</span>
                            <?php
                        } else { ?>
                         <img src="<?php echo get_template_directory_uri(); ?>/images/cart.png" alt="" /> Cart
                       <?php  }   ?></a></li>
                     
                    <?php } ?>

                  <li><img src="<?php echo get_template_directory_uri(); ?>/images/login.png" alt="" /><a href="<?php echo wp_logout_url( get_permalink() );  ?>">Log out</a></li>
  
               </ul>

               <?php

			   }

			   else

			   {

				?>										

               <ul class="myaccount_nav">

                    
                  <li><img src="<?php echo get_template_directory_uri(); ?>/images/usr.png" alt="" /><a href="<?php echo get_site_url(); ?>/register">Register</a></li>

                    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
                        $count = WC()->cart->cart_contents_count;
                        ?><li><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php 
                        if ( $count > 0 ) {
                            ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/cart.png" alt="" /> Cart <span class="cart-contents-count">(<?php echo esc_html( $count ); ?>)</span>
                            <?php
                        } else { ?>
                         <img src="<?php echo get_template_directory_uri(); ?>/images/cart.png" alt="" /> Cart
                       <?php  }   ?></a></li>
                     
                    <?php } ?>

                  <li><img src="<?php echo get_template_directory_uri(); ?>/images/login.png" alt="" /><a href="<?php echo get_site_url(); ?>/login/?a_redirect_to=http://happivize.com/my-account/">Log in</a></li>

                  

               </ul>

               <?php

			   }

			   ?>                        

            </div>

            <div class="row clearfix">

               <a href="<?php echo get_site_url(); ?>" class="logo col-sm-5"><img src="<?php bloginfo('template_url')?>/images/happivize-logo.png" alt="happivize" /></a>

			   <img src="<?php bloginfo('template_url')?>/images/menu_ico.png" class="menu_ico" alt="menu" />

			   <div class="col-md-4 col-sm-4 col-xs-6 search_sec">

                  <div class="search_block">

                     <label>Uplevel your Happiness Here</label>									

                     <div class="input_box">

                        <!--form method="get" id="searchform" action="<?php bloginfo('url'); ?> /">

						<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search here">

						<input type="submit" id="searchsubmit" value="Search" />

						</form-->

                         <?php get_search_form(); ?>



                     </div>

                  </div>

               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                <p></p>
               </div>

               <div class="col-md-3 col-sm-3 col-xs-6">

                  <div class="email_us" id="email_tphEd" style="margin-top: 5px;">

				 <!--  <label>Please Email Us:</label>

				  <a class="emil_val" href="mailto:info@happivize.com">info@happivize.com</a>	 -->
           <label>Call or Text us: +1 (614) 656-4344 </label>
         <label>Email us: <a href="mailto:info@happivize.com">info@happivize.com</a></label>

				  </div>

               </div>

            </div>

         </div>

      </div>



      <div class="header_bottom">

         <div class="container">

            <?php

			$args = array(

				'menu'		  => 'primary',

				'menu_class'  => 'nav navbar-nav',

				'container'     => ''

			);

			wp_nav_menu($args);

	/*		$current_user = wp_get_current_user();

			$email = $current_user->email;

			if ( woocommerce_customer_bought_product( $email, $current_user->ID, 140))

			{

			

			}

			else

			{
*/
				 //if ( !current_user_can( 'administrator' ) ){

				?> 

				<button type="button" class="btn header_btn" data-toggle="modal" data-target="#myModal">

				<?php echo "Join the Happiness Club"; ?></button>

				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Content Bottom 2') ) : //else : ?>

				<?php endif; ?>            

				<?php

				//}

		//	}

			?>					

         </div>

      </div>



       

   </header>

   <div class="entry-content" id="logo_header_content">
      <div class="logo_section">
         <a href="<?php echo site_url(); ?>"> <?php echo do_shortcode('[image id="3806" align="none" size="medium" /]') ?>  </a>
      </div>
   </div>


   <?php

   if(isset($_POST['woocommerce_checkout_place_order']) && $_POST['woocommerce_checkout_place_order'] == "Subscribe"){

   $email = $_POST["user_email"];

   if( email_exists( $email ))	{

	?>

	<script>alert("email alreadty exsist");</script>

	<?php

	}	

	else

	{		

	  global $wpdb;		

	  $nice_name = explode('@',$email);		

	  $niceName = $nice_name[0];

	  $tablename = $wpdb->prefix."users";	

	  $user_data = array(

		  'ID' => '',

		  'user_pass' => wp_generate_password(),

		  'user_login' => $niceName,

		  'user_nicename' => $niceName,

		  'user_url' => '',

		  'user_email' => $email,

		  'display_name' => $niceName,

		  'nickname' => $niceName,

		  'first_name' => $niceName,

		  'user_registered' => date('Y-m-d h:m:i'),

		  'role' => get_option('default_role')

	  );	

	  $user_id = wp_insert_user( $user_data );

	}

   }

	?>

   <body <?php body_class(); ?>>
    <script>
        /*  Google analytics Script */

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-96347402-1', 'auto');
        ga('send', 'pageview');

        /*  Google analytics Script */
    </script>


   <style>





 .main-list .menuslist ul, .main-list1 .menuslist ul



 {



 	 background-color: #f8f8f8  !important;

 }

 .main-list .menuslist a ,.main-list1 .menuslist a{

    color: #FF3366 !important;



   

padding: 9px 6px 5px 5px !important;

}

 .main-list .menuslist li {

padding: 7px 26px 6px 8px;



}



.main-list1 .menuslist li{

padding: 7px 20px 6px 8px;



}

#post-7 .form-row-first {
    margin: 0;
}
#post-7 .form-row-last {
    margin: 0;
}

#post-7 .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] {

  position: relative !important;
}
#post-7 .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea {
  border: medium none;
  border-radius: 4px;
  box-shadow: 0 0 0 1px #d9d9d9 !important;
  padding: 14px !important;
}
  .page.page-id-6.woocommerce-order-pay #wraper header.main_header {
    display: none !important;
}

   </style>

<?php
/*session_start();
echo $_SESSION["favcolor"]=$_SERVER['HTTP_REFERER'];
    if ( is_user_logged_in() ){

      if($_SESSION["favcolor"]=="https://happivize.com/email-subscriber/")
      {
header('Location: http://www.example.com/');
      }
    } */

 ?>
