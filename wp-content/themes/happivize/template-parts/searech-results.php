<?php
/**
 * Template Name: Search Results
 * @since Twenty Twelve 1.0
 */ 
 get_header(); 
 $survey = $_POST['survey'];
 $catIds = array();
 ?>
<script>
function removesearch(val){
	jQuery("#removeVal").val(val);
	var myform = document.getElementById("searchFrm");
    var fd = new FormData(myform);
	
    jQuery.ajax({
        url: "<?php echo get_site_url(); ?>/getsearch.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (results) {
			$("#mysearch").html(results);
        }
    });
	
	jQuery.ajax({
        url: "<?php echo get_site_url(); ?>/removesearch.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
			$("#searchFor").html(dataofconfirm);
        }
    });
}
</script>
<div id="posts">
	<div class="container">
	<div class="search_result_for">
	<form name="searchFrm" id="searchFrm" action="" method="POST">
		<label>Search result for:</label>
		<div id="searchFor">
			<?php
			foreach($survey as $catId){
			$catIds[] = $catId;
			?>
				<p class="tag">
				<span class="tag_txt"><?php echo get_cat_name($catId); ?></span>
				<input type="hidden" name="survey[]" id="survey<?php echo $catId; ?>" value="<?php echo $catId; ?>">
				<span id="close" class='close' onclick="removesearch(<?php echo $catId; ?>)">✕</span></p>
			<?php
			}			
			?>
		</div>
			<div class="clear"><a href="<?php echo get_site_url(); ?>/?s=">clear all</a></div>
			<input type="hidden" name="removeVal" id="removeVal" value="">
	</form>
	<?php $catIn = implode(',',$catIds); ?>
	</div>
		<div class="row clearfix">
			<aside class="col-md-2">
			<!--h4 class="sidebar_title">Topic</h4>
				<ul>
					<li><a href="#">Abundance</a></li>
					<li><a href="#">Health</a></li>
					<li><a href="#">Relationship</a></li>
					<li><a href="#">Weight & Body</a></li>
					<li><a href="#">Self-Love</a></li>
				</ul-->
				<?php echo do_shortcode('[woof]'); ?>
			</aside>
			<!-- Code start here -->	
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
				'posts_per_page' => -1, 
				'post_type' => 'post',
				'orderby' => 'title',
				'order'   => 'DESC',
				/* 'paged' => $paged, */
				'post_status'      => 'publish',
				'cat'         => $catIn
			);
			$custom_query = new WP_Query( $args );
			?>
			<article class="col-md-10">
				<div id="mysearch">
					<?php
					while($custom_query->have_posts()) :
					$custom_query->the_post();
					?>
					<div class="post-row clearfix">
						<div class="post-thumbnail col-md-4 col-sm-4"><?php the_post_thumbnail(); ?></div>
						<div class="post-data col-md-8 col-sm-8">
							<h2 class="post-title"><?php the_title(); ?></h2>
							<?php the_excerpt (); ?>						
						</div>
					</div>
					<?php endwhile; ?>
				</div>				
			</article>			
			<?php if (function_exists("pagination")) { /* pagination($custom_query->max_num_pages); */ } ?>
		</div> 
	</div>
</div>
<?php get_footer(); ?>