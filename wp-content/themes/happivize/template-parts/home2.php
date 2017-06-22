<?php







/**







 * Template Name: Speaker Page - Recorded















 * @since Twenty Twelve 1.0







 */







 







 get_header();







 ?>


<?php //echo "<img style='display:block;margin:auto;' src='https://happivize.com/wp-content/uploads/2017/03/banner-top.png'"; ?>




<section id="gallery_section">







                <div class="container">







                      <div class="row clearfix">







   <?php


$currentid=get_the_ID();



$my_postid = $currentid;//This is page id or post id..



$content_post = get_post($my_postid);


$content = $content_post->post_content;


$content = apply_filters('the_content', $content);

$content = str_replace(']]>', ']]&gt;', $content);

$image = wp_get_attachment_image_src( get_post_thumbnail_id( $my_postid ), 'single-post-thumbnail' ); 

$metaname = get_post_meta(get_the_ID(), 'my_meta_box_text', true);

$metanamefea = get_post_meta(get_the_ID(), 'meta-box-text', true);

$metanamefea2 = get_post_meta(get_the_ID(), 'my_meta_box_text2', true);


//$meta;



//echo ; 


?>

<div class="one-column column cols" id="le_body_row_1_col_1" style="margin-bottom: 94px;"><div class="element-container cf" data-style="" id="le_body_row_1_col_1_el_1"><div class="element"> <h2 style="font-size:24px;font-family:&quot;Trebuchet MS&quot;, Tahoma, sans-serif;font-style:normal;font-weight:normal;color:#d11b68;text-align:center;margin-bottom:50px;">Enjoy this interview about....<?php // echo get_the_title();?></h2> </div></div><div class="element-container cf" data-style="" id="le_body_row_1_col_1_el_2"><div class="element"> <h2 style="font-family:&quot;Trebuchet MS&quot;, Tahoma, sans-serif;font-style:normal;font-weight:normal;color:#f26724;text-align:center;margin-bottom:20px;font-size: 34px;"><?php echo $metaname; ?>

</h2>



 </div></div>

<div class="pge-subtitle">

<h2 style="text-align: center;font-size:22px; color: #696969;font-family:"Source Sans Pro", sans-serif;font-style:normal;font-weight:normal;color:#696969;text-align:center;line-height:33px;margin-bottom:10px;">with <?php echo $metanamefea; ?></h2>

</div>

</div>















<div class="sustom-home2">















  <div class="leftcontant">







<?php







 echo "<img src='".$image[0]."'>";















?>























<div class="element" style="width: 100%;"> <h2 style="color:#f26724;text-align:center; font-weight: 700;font-size: 23px;"><?php echo $metanamefea; ?></h2> </div>















  </div>















  <div class="right-contant">







    <?php echo $content; ?>







  </div>























</div>







<?php echo do_shortcode('[RICH_REVIEWS_FORM]'); ?>

<?php if(is_page('2412') || is_page('2478') ){ ?>
<?php echo do_shortcode('[RICH_REVIEWS_SHOW  num="all" category="page" id="2478"]'); ?> 
<div class="load_div_more"><h1 class="btn-default" id="loadmore">Load More..</h1></div>
<?php }

if(is_page('17339') || is_page('17204')){
	echo do_shortcode('[RICH_REVIEWS_SHOW  num="all" category="page" id="17339"]'); ?>
<div class="load_div_more"><h1 class="btn-default" id="loadmore">Load More..</h1></div>
<?php
}
 ?>









                          </div>







                          <div class="col-sm-6">







                              <h3><?php the_field('ready_for_your'); ?></h3>







                              <?php the_field('ready_for_your_content'); ?>







                          </div>







                      </div>







                </div>







 







                </div>







          </section>























          <div class="join_sec _REDBG_">







                <div class="container">







                    <div class="join_data">







                        <h1><?php echo "Uplevel your Happiness Here"; ?></h1>







                        <div class="sub_sent"><?php echo "Join the Happiness Club for free access to energy healing, discounts, and more







"; ?></div>







                    </div>







                      <button type="button" class="btn general_btn" data-toggle="modal" data-target="#myModal"><?php echo "Join the Happiness Club"; ?></button>







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







                  <div class="subscriber_input text-center">







                    <input type="email" placeholder="Best Email Address Here" />







                  </div>







                  <div class="subscriber_btn text-center">







                  <input type="submit" value="Subscribe" />







                  </div>







                </div>







                  







            </div>







                







            </div>







        </div>







                </div>







          </div>




<!-- <footer style="margin: 0;padding: 20px 15px;background-color: #ff7932;color: white;font-size: 0.88888889rem;font-weight: 400;"  role="contentarea">
    <p style="text-align: center;margin:0;color: white;font-size: 16px !important;font-weight: 400">©2016–2017 Happivize.  All rights reserved.</p>
</footer> -->

 



 







<?php get_footer(); ?>







<script type="text/javascript">







$(document).ready(function(){



setTimeout(function(){



  //alert("Hp!");



  $(".audio_file").css("display", "inline"); 



}, 2000);



 



}); 



 







 



</script>







<style type="text/css">




.leftcontant { margin-right: 56px !important;margin-bottom:0px !important;}
 .right-contant .custombutton-home {left:367px !important;}
 
 @media only screen and  (max-width:767px){



  .sustom-home2{border:0px solid red;width: 96%;}



  #btn_1_5f9854409f256923a292e40f61a597d7{  font-size: 17px;
    padding: 20px 15px;}



  .leftcontant{width: 100%; margin-bottom: 0px;}

  .right-contant .custombutton-home {left:167px !important;}

}

</style>







