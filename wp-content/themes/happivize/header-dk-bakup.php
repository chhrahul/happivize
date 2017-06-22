<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	 <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.min.css">
	 <script src="<?php bloginfo('template_url')?>/js/jquery.js"></script>
	<script src="<?php bloginfo('template_url')?>/js/script.js"></script>	
	<?php wp_head(); ?>
	
</head>
<div class="loader_overlay"><img src="<?php bloginfo('template_url') ?>/images/ajax-loader.gif" alt="loader" class="loader_img" /></div>
      <div id="wraper">
          <header>
                <div class="header_top">
                    <div class="container">
                        <div class="my_account_menu clearfix">                     
							
							<?php// echo do_shortcode('[lsphe-header]' ); ?>
	<?php global $woocommerce;						
	if (class_exists('Woocommerce')) {?>															
<?php 								
$logout_url='';
$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );						
if ( $myaccount_page_id ) {		  
	$logout_url = wp_logout_url('/');							 							  
	if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' )								
		$logout_url = str_replace( 'http:', 'https:', $logout_url );
	}								
?>													      
<?php if (is_user_logged_in()){   global $current_user; get_currentuserinfo();									
	 }?>                                 
	<?php if ( is_user_logged_in() ): ?>	
        <ul class="sub_woo_menu logged_in">	
            <li><?php echo('Hi, ' . $current_user->user_login); ?></li>
        <!--<li><a href="<?php echo home_url(); ?>/my-account"><?php // _e('My Account','mjsimple');?></a></li>
            <li><a href="<?php //echo home_url(); ?>/wishlist"><?php // _e('Wishlist','mjsimple');?></a> -->	
            <li><a href="<?php echo wp_logout_url( get_permalink() );  ?>">Sign out</a></li>
	</ul>
	<?php else:?>	
        <ul class="sub_woo_menu logged_out">                   
            <li class="reg"><a href="<?php echo site_url(); ?>/register"><?php _e('Register','mjsimple');?></a></li>
			<li class="login_li"><a href="<?php echo home_url(); ?>/login"><?php _e('Login','mjsimple');?></a></li>
        </ul>    
	<?php endif;?>																	
	<?php }?>
                            
                            <?php 		
								 $args = array(		
								 'menu'		  => 'woomenu' ,
								 'menu_class'  => 'myaccount_nav',	
								 'container'     => ''		
								 );		
							wp_nav_menu($args); ?>	
                        </div>
                        <div class="row clearfix">
                            <a href="<?php echo get_site_url(); ?>" class="logo col-sm-5">
                                <img src="<?php bloginfo('template_url')?>/images/happivize-logo.png" alt="happivize" />
                            </a>
                            <img src="<?php bloginfo('template_url')?>/images/menu_ico.png" class="menu_ico" alt="menu" />
                            <div class="col-md-4 col-sm-4 col-xs-6 search_sec">
                                <div class="search_block">
                                    <label>Uplevel your Happiness Here</label>
                                    <div class="input_box"> 
					<form method="grt" id="searchform" action="<?php bloginfo('url'); ?>/">
                                            <input type="text" value="<?php// the_search_query(); ?>" name="s" id="s" / placeholder="Search here" />
                                            <input type="submit" id="searchsubmit" value="Search" />
					</form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <div class="email_us">
                                    <label>Please Email Us:</label>
                                    <a class="emil_val" href="mailto:info@happivize.com">info@happivize.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_bottom">
                    <div class="container">
							<?php 		
								 $args = array(		
								 'menu'		  => 'primary' ,
								 'menu_class'  => 'nav navbar-nav',	
								 'container'     => ''		
								 );		
							wp_nav_menu($args);							
							
							$current_user = wp_get_current_user();
							$email = $current_user->email;
							if ( woocommerce_customer_bought_product( $email, $current_user->ID, 140)) {
								?>
								<!--button type="button" class="btn header_btn"><?php echo "Subscription: FREE Member"; ?></button-->
								<?php
							}
							else
							{
							
							if ( !current_user_can( 'administrator' ) ) {
							?>
								
								<button type="button" class="btn header_btn" data-toggle="modal" data-target="#myModal"><?php the_field('join_the_happiness_club'); ?></button>
							
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
    
						<!-- Modal content-->
					    <div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
								<h2 class="general_title">Join The HAPPIVIZE Club For New Videos, Discounts and More!</h2>
								<h3 class="text-center">Enter Your Email Below To Join The Club!</h3>
                                    <div class="SUBSCRIBE"> <?php echo do_shortcode('[woocommerce_checkout]'); ?></div>
								</div>
									
						</div>
							  
						</div>
				</div>
                        <?php
							}
							}
							?>
						
                    </div>
                </div>
          </header>
	
	<?php 
	$email = $_POST["user_email"];
	 if( email_exists( $email )) {
  ?> <script>alert("email alreadty exsist");</script>
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
        'role' => get_option('default_role') // Use default role or another role, e.g. 'editor'
    );
    $user_id = wp_insert_user( $user_data );

   }
?>	
<body <?php body_class(); ?>>