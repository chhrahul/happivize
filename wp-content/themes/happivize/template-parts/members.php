<?php
/**
* Template Name: Members
* @since Twenty Twelve 1.0
*/
get_header();
?>
	<section id="servay_block">
		<div class="container">
			<div class="row clearfix"> 
				<div class="col-md-4 col-sm-4">
					<h2 class="side_title">Welcome to Happivize!</h2>
					<p class="side_desc">We have a lot of great free support for you, let's figure out where you want to start by answering two short questions:</p>
				</div>
				<div class="col-md-8 col-sm-8">
					<form id="form_name" name="form_name" action="<?php echo get_permalink(93); ?>" method="POST"> 
						<fieldset class="first_que">
						<h3 class="question_title">What areas of your life can you use support?<br />(yes, you can choose more than one) </h3> 
							<ul class="ans_list">
							<!-- Get category list code start here -->
							<?php
							$allCat = get_categories( array('hide_empty'=> 0,'orderby'=>'name','order'=>'ASC','exclude'=>array(1,20,21,22)) );
							foreach( $allCat as $category ) {
								$catId 		=	$category->term_id;
								$catName 	=	$category->name;
							?>
							<!-- Get category list code end here -->
								<li><input type="checkbox" id="search" name="survey[]" value="<?php echo $catId; ?>" /><label class="ans_label"><?php echo $catName; ?></label></li>
							<?php
							}
							?>
							</ul>					
							<input type="submit" name="txtStep1" id="txtStep1" value="Submit" class="next" />                                  
						</fieldset>

						<fieldset class="text-center second_que">
							<h3 class="question_title">How "woo-woo" are you?</h3>
								<div class="muti_select_row">
									<div class="check_box_left">
										<input type="checkbox" class="onecheck" id="woo" name="survey[]" value="20" />
										<div class="check"></div>
									</div>
									<div class="check_text left">Hard-core<br>Science Only</div>
									<div class="check_box_center">
										<input type="checkbox" class="onecheck" id="hard" name="survey[]" value="21" checked />
										<div class="check"></div>
									</div>
									<div class="check_text center">I'm open</div>
									<div class="check_box_right">
										<input type="checkbox" class="onecheck" id="open" name="survey[]" value="22"  />
										<div class="check"></div>
									</div>
									<div class="check_text right">I'm super<br/> woo-woo</div>
								</div>
								<input type="submit" name="Submit" value="Submit" class="submit last_submit"  />
						</fieldset>
					</form>    
					<div class="alert_message">Please select one from above</div>
					<div class="clearfix">
						<div class="time_line"><div class="time_line_lavel _AM_"></div></div><div class="done_txt"><span class="progress_bar">0%</span> Done with the survey</div>
					</div>
				</div>
			</div>
		</div>
	</section>
 <?php get_footer(); ?>