<?php
include('wp-config.php');
global $wpdb;
if(isset($_POST['survey']) && $_POST['survey']!=""){
	$countArray = count($_POST['survey']);
	for($a = 0; $a<$countArray; $a++)
	{
		if($_POST['survey'][$a] != $_POST['removeVal']){
			$srch[] = $_POST['survey'][$a];
		}
	}
	$catIn = implode(',',$srch);
}

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