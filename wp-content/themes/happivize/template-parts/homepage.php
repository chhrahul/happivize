<?php
/**
 * Template Name: Home

 * @since Twenty Twelve 1.0
 */
 
 get_header();
 ?>
 <style type="text/css">
.join_sec .general_btns {
    font-size: 24px;
    margin: 18px 0;
}
.general_btn{
	padding: 6px 12px !important;
}
.general_btns {
    background-color: #ff3366;
    border-radius: 25px;
    color: #ffffff;
    display: inline-block;
    font-size: 24px;
    font-weight: 600;
    padding: 10px 62px 10px;
    text-transform: capitalize;
    margin-top: 12px;
}
</style>
<section id="gallery_section">
                <div class="container">
                      <div class="row clearfix">
                          <div class="col-sm-6 text-center">
                              <div class="gallery_main">
                                <div class="back_img">
                                    <img src="<?php bloginfo('template_url') ?>/images/Layer-11.jpg" alt=""/>
                                </div>
                                <div class="back_img2">
                                    <img src="<?php bloginfo('template_url') ?>/images/Layer-11.jpg" alt=""/>
                                </div>
                                <div id="gallery">
								<div>
								<a href="#1">
                                <?php if( have_rows('gallery') ): ?>


	<?php while( have_rows('gallery') ): the_row(); 

		// vars
		$image = get_sub_field('image1');
		?>

			<?php if( $image ): ?>
				<a href="#">
			<?php endif; ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />

	<?php endwhile; ?>

<?php endif; ?>
</a>
						</div>
                                </div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <h3><?php the_field('ready_for_your'); ?></h3>
                              <?php the_field('ready_for_your_content'); ?>
                          </div>
                      </div>
                </div>
                <div class="container">
                    <div class="row clearfix watch_our_story">
                        <h2 class="general_title"><?php the_field('watch_our_story'); ?></h2>
                            <div class="col-sm-6">
                                <?php the_field('watch_our_story_video1'); ?>
                            </div>
                            <div class="col-sm-6">
                                <?php the_field('watch_our_story_video_2'); ?>
                            </div>
                        </div>
                    </div>
                </div>
          </section>
          <div class="join_sec">
                <div class="container">
                    <div class="join_data">
                        <h1><?php the_field('uplevel_your_happiness_here_two'); ?></h1>
                        <div class="sub_sent"><?php the_field('uplevel_sub_two'); ?></div>
                    </div>
				   	
					<!--button type="button" class="btn general_btn" data-toggle="modal" data-target="#myModal"><?php //the_field('join_the_happiness_club'); ?></button-->
          <div class="col-sm-7"> 
            <div class="col-sm-5"> </div>
            <div class="col-sm-6">
            <a href="https://happivize.com/product/self-love-you-deserve-the-best-interview/" class="general_btns" style="font-size: 27px;float:none !important;margin-left: 9%;">Start Here</a> 
            </div>
            
            </div>
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
          <section id="testimonials">
              <div class="container">
                  <h2 class="general_title"><?php the_field('what_people_are_saying_about_us'); ?></h2>
                  <div class="row clearfix">
                      <div class="test_sec">
                          <div class="col-sm-6">
                              <div class="test_block">
                                  <?php $testi_img1 = get_field('testi_img1') ?><img src="<?php echo $testi_img1['url']; ?>"  alt=""/>
                                  <p class="desc"><?php the_field('testi1_content'); ?></p>
                                  <div class="cleint_name"><?php the_field('c1_name'); ?></div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="test_block">
                                  <?php $testi_img2 = get_field('testi_img2') ?><img src="<?php echo $testi_img2['url']; ?>" alt=""/>
                                  <p class="desc"><?php the_field('testi2_content'); ?></p>
                                  <div class="cleint_name"><?php the_field('c2_name'); ?></div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="test_block">
                                  <?php $testi_img3 = get_field('testi_img3') ?><img src="<?php echo $testi_img3['url']; ?>"  alt=""/>
                                  <p class="desc"><?php the_field('testi3_content'); ?></p>
                                  <div class="cleint_name"><?php the_field('c3_name'); ?></div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="test_block">
                                 <?php $testi_img4 = get_field('testi_img4') ?><img src="<?php echo $testi_img4['url']; ?>"  alt=""/>
                                  <p class="desc"><?php the_field('testi4_content'); ?></p>
                                  <div class="cleint_name"><?php the_field('c4_name'); ?></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          <div class="join_sec _REDBG_">
                <div class="container">
                    <div class="join_data">
                        <h1><?php the_field('uplevel_your_happiness_here'); ?></h1>
                        <div class="sub_sent"><?php the_field('uplevel_sub'); ?></div>
                    </div>
                    	<button type="button" class="btn general_btn" data-toggle="modal" data-target="#myModal"><?php the_field('join_the_happiness_club'); ?></button>
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
<?php get_footer(); ?>


