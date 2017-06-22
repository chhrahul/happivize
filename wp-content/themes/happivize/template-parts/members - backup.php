<?php
/**
 * Template Name: Members Backup

 * @since Twenty Twelve 1.0
 */
 
 get_header();
 ?>
  <section id="servay_block">
              <div class="container">
                  <div class="row clearfix"> 
                      <div class="col-md-4 col-sm-4">
                          <h2 class="side_title"><?php the_field('welcome_to_happivize!'); ?></h2>
                          <p class="side_desc"><?php the_field('we_have_a_lot'); ?></p>
                      </div>
                      <div class="col-md-8 col-sm-8">
                          <form id="form_name" name="form_name" action="http://webdemor.info/wp/happivize/search-result/" method="POST"> 
		<?php
		if( have_rows('qa') ):
			while ( have_rows('qa') ) : the_row();
		?>
				<fieldset class="first_que">
						<h3 class="question_title"><?php the_sub_field('questions');?>  </h3> 
								<ul class="ans_list">
									<?php if( have_rows('answers') ):
									while ( have_rows('answers') ) : the_row();?>
										<li><input type="checkbox" id="search" name="survey[]" value="<?php the_sub_field('ans');?>" /><label class="ans_label"> <?php the_sub_field('ans');?></label></li>
										<?php
										endwhile;
									endif;
									?>
								</ul>
						<?php
			endwhile;
		endif;
		?>
				<input type="submit" name="" value="Submit" class="next" />                                  
                </fieldset>

                              <fieldset class="text-center second_que">
                                   <h3 class="question_title"><?php the_field('how_"woo-woo"_are_you'); ?></h3>
                                   <div class="muti_select_row">
                                        <div class="check_box_left">
                                            <input type="checkbox" name="survey[]" value="Hard-core Science Only" />
                                            <div class="check"></div>
                                        </div>
                                        <div class="check_text left"><?php the_field('hard-core'); ?> </div>
                                        <div class="check_box_center">
                                            <input type="checkbox" name="survey[]" value="I'm open" />
                                            <div class="check"></div>
                                        </div>
                                        <div class="check_text center"><?php the_field('im_open'); ?></div>
                                        <div class="check_box_right">
                                            <input type="checkbox" name="survey[]" value="I'm super woo-woo" />
                                            <div class="check"></div>
                                        </div>
                                        <div class="check_text right"><?php the_field('im_super'); ?></div>
                                   </div>
                                   <input type="submit" name="Submit" value="Submit" class="submit last_submit"  />
                              </fieldset>
                          </form>    
						   <div class="alert_message"><?php the_field('please_select_one_from_above'); ?></div>
                          <div class="clearfix">
                            <div class="time_line"><div class="time_line_lavel _AM_"></div></div><div class="done_txt"><span class="progress_bar">0%</span> <?php the_field('done_with_the_survey'); ?></div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
 <?php get_footer(); ?>