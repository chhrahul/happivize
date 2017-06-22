<?php
/**
 * Template Name: carol page template

 * @since Twenty Twelve 1.0
 */
 
 get_header();
 ?>
          <!--start extra weight-->
            <div class="extra_weight">
             	<div class="container">
                	<h2 class="general_title"><?php the_field('extra_weight_title'); ?></h2>
                     <div class="row section1">
                     	<div class="col-sm-8">
                        	<?php  the_field('extra_weight_description'); ?>
                        </div>
                        <div class="col-sm-4">
                        	<h3><?php the_field('get_all_5_programs');  ?></h3>
                           <?php the_field('get_all_5_programs_description'); ?>
<?php  the_field('get_started_button'); ?>
                        </div>
                     </div><!--end section1-->
                  
                  <div class="row section2">
                     	<div class="col-md-4">
						     <?php $image3 = get_field('feel_safe_image');?>
                        	<img src="<?php echo $image3; ?>" alt="carol-feel-safe" class="img-responsive" />
                        </div>
                        <div class="col-md-8">
                        	<?php the_field('feel_safe_description'); ?>
                        </div>
                     </div><!--end section2-->
                  <div class="section3">
                  		<div class="title_for_res">Feel safe and lose weight technique <b class="nav_arow">&#9660;</b></div>
                   		<?php the_field('feel_safe_title'); ?>
                        
                        <div class="tab-content">
                          <div id="feelSafe" class="tab-pane fade">
                            <div class="row">
                             	<div class="col-sm-9">
                            	<?php the_field('feel_safe_description_2'); ?>
                             </div>
                                 <div class="col-sm-3">
								   <?php $feelsafe = get_field('feel_safe_image_2');?>
                                 	<img src="<?php echo $feelsafe;  ?>" />
                                 </div>
                             </div>
                          </div>
                          
                          <div id="stressRelief" class="tab-pane fade in active">
                             <div class="row">
                             	<div class="col-sm-9">
                            	<?php the_field('stress_relief_description');  ?>
                             </div>
                                 <div class="col-sm-3">
								  <?php $stressrelief = get_field('stress_relief_image');?>
                                 	<img src="<?php echo $stressrelief; ?>" />
                                 </div>
                             </div> 
                          </div>
                          
                          <div id="EFT" class="tab-pane fade">
                            <div class="row">
                             	<div class="col-sm-9">
                                 <?php the_field('clearing_craving_description');  ?>
                             </div>
                                 <div class="col-sm-3">
								     <?php $clearing= get_field('clearing_craving_image');?>
                                 	<img src="<?php echo $clearing; ?>" />
                                 </div>
                             </div>
                          </div>
                          
                          <div id="enough" class="tab-pane fade">
                           <div class="row">
                             	<div class="col-sm-9">
                            	<?php the_field('enough_already_description'); ?>
                             </div>
                                 <div class="col-sm-3">
								 <?php $enough= get_field('enough_image');?>
                                 	<img src="<?php echo $enough;  ?>" />
                                 </div>
                             </div>
                          </div>
                          
                          <div id="vibration" class="tab-pane fade">
                           <div class="row">
                             	<div class="col-sm-9">
                            	<?php the_field('the_vibration_description'); ?>
                             </div>
                                 <div class="col-sm-3">
								  <?php $vibration= get_field('the_vibration_image');?>
                                 	<img src="<?php echo $vibration;  ?>" />
                                 </div>
                             </div>
                          </div>
                        </div>
                  </div>
                
                </div>
            </div>
          <!--end extra weight-->  
          <!--start testimonials-->
          <div class="testimonials">
          		<div class="container">
                	<h2 class="general_title"><?php the_field('testimonial_title');  ?></h2>
                    	<div class="carousel slide" data-ride="carousel" id="myCarousel">
                        	<div class="carousel-inner" role="listbox">
									<?php 
								   $the_query = new WP_Query(array(
									'post_type' => 'testimonial',
								    'posts_per_page' => 1 ,
									'orderby' => 'ID',
	                               'order'   => 'ASC'
									)); 
								   while ( $the_query->have_posts() ) : 
								   $the_query->the_post();
								  ?>
                            	<div class="item active">
                                	 <?php the_content(); ?>
                                     <div class="test_img">
									  <?php the_post_thumbnail();?>
                                     </div>
                                     <div class="test_client">
                                     	<h5><?php the_field('client_name'); ?></h5>
                                        <span><?php the_field('location'); ?></span>
                                     </div>
                                </div>
								<?php 
								   endwhile; 
								   wp_reset_postdata();
								  ?>
								  <?php 
								   $the_query = new WP_Query(array(
									'post_type' => 'testimonial',
									'posts_per_page' => 5, 
									'offset' => 1 ,
									'orderby' => 'ID',
	                               'order'   => 'ASC'
									)); 
								   while ( $the_query->have_posts() ) : 
								   $the_query->the_post();
								  ?>
                             <div class="item">
                                	 <?php the_content(); ?>
                                     <div class="test_img">
									  <?php the_post_thumbnail();?>
                                     </div>
                                     <div class="test_client">
                                     	<h5><?php the_field('client_name'); ?></h5>
                                        <span><?php the_field('location'); ?></span>
                                     </div>
                                </div>
								<?php 
							   endwhile; 
							   wp_reset_postdata();
							  ?>
                              
                            </div><!--end inner carousel-->
                            <ol class="carousel-indicators">
                            	<li class="active" data-target="#myCarousel" data-slide-to="0"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                        </div><!--end carousel-->
               </div>
          </div><!--end testimonials-->      
         
         
				
<?php get_footer(); ?>
