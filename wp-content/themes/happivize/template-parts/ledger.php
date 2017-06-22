<?php
/**
 * Template Name: Ledge New Window

 * @since Twenty Twelve 1.0
 */
 
 ?>

<head>
  <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/datepicker.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/normalize.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/myledger.css"> 
 
</head>
<body style="font-family: lato !important;">

 <div class="container myledger_content">
<?php

// TO SHOW THE PAGE CONTENTS
    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
        <div class="col-lg-12 entry-content-page">
            <?php //the_content(); ?> <!-- Page Content -->
        </div><!-- .entry-content-page -->

    <?php
    endwhile; //resetting the page loop
    wp_reset_query(); //resetting the page query
    ?>
    <div class="col-lg-12">
        <table width="100%" cellpadding="0" cellspacing="0">           
            <tbody>
                <tr>
                    <td valign="top" align="center">
                    <?php
                    $current_user = wp_get_current_user();
                    $first_name  = $current_user->user_firstname;
                    $last_name = $current_user->user_lastname;                 
                    ?>


                    <h1 style="page-break-before: always;font-size: 26px;margin: 3% 0;">Referral Partner Ledger for "<?php echo $first_name; echo " "; echo $last_name;?>"</h1>  
                    </td>
                </tr>
                <tr>
                    <td>                


                    <?php echo do_shortcode( '[affiliates_affiliate_stats]' ); ?>
                    <div class="affiliates_total_earning">
                    <?php echo do_shortcode( '[affiliates_earnings]' ); ?>
                    </div>
                    
                    <?php //echo do_shortcode( '[affiliates_referrals for="month"]' ); ?>

                    <!--h3>Total No of Referrals:</h3--> <?php //echo do_shortcode( '[affiliates_referrals]' ); ?>

                    <!--h4>Number of sales referred</h4-->
                    <!--ul>
                    <li>Accepted referrals pending payment: <?php //echo do_shortcode( '[affiliates_referrals status="accepted"]' ); ?></li>
                    <li>Referrals paid:  <?php //echo do_shortcode( '[affiliates_referrals status="closed"]' ); ?></li>
                    <li>Referrals Pending:  <?php //echo do_shortcode( '[affiliates_referrals status="pending"]' ); ?></li>
                    </ul-->

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>

<footer>
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "https://happivize.com/wp-content/uploads/2017/01/calendaronly.gif",
      buttonImageOnly: true,
      dateFormat: 'dd-mm-yy'
    });
    $("#datefield_until").datepicker({ 
      showOn: "button",
      buttonImage: "https://happivize.com/wp-content/uploads/2017/01/calendaronly.gif",
      buttonImageOnly: true,
      dateFormat: 'dd-mm-yy' });
  } );

  </script>
</head>
</footer>