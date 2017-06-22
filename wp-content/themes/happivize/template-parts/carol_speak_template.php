<?php
/**
 * Template Name: carol speak page template

 * @since Twenty Twelve 1.0
 */
 
 get_header();
 ?>

         
  <!--start feel_safe-->
          <div class="feel_safe">
                <div class="container">
          <h2 class="general_title"><?php the_field('feel_safe_enough_title'); ?></h2>
           <?php the_field('feel_safe_enough_menu'); ?>
                  
          		<div class="carol_speak" id="CarolSpeak">
                	
                           <h3 class="carol-center"><?php the_field('carol_title');  ?></h3>
                            
                            <div class="carol_tab clearfix">
                            	<div class="carol_img">
								<?php $carol= get_field('carol_image');  ?>
								<img src="<?php echo $carol;  ?>" alt="carol-look" /></div>
                            	<div class="carol_content">
								<?php the_field('carol_description');  ?>
                                <h4><?php the_field('carol_look_link'); ?></h4>
                                 <?php the_field('carol_button'); ?>
                                </div>
                            </div>
                </div>
                <!--end carol_speak-->
                
                
                <div class="weight_loss" id="WeightLost">
                 	<h3 class="carol-center"><?php the_field('eft_weight_title'); ?></h3>
                    <div class="weight_list">
                    <?php the_field('eft_description');  ?>                    
                    </div>
                </div><!--end weight_loss-->
                <div class="share_your" id="share">
                   <h3 class="carol-center"><?php the_field('share_your_title');  ?></h3>
                  <?php  the_field('share_description'); ?>
                   <div class="share_post">
                   
                   </div>
                </div><!--end share_your-->
          </div>
          </div>
    <!--start feel_safe-->        
         
         
				
<?php get_footer(); ?>
