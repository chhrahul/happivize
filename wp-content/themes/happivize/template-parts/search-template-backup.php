<?php
/**
 * Template Name: search backup 

 * @since Twenty Twelve 1.0
 */
 
 get_header();
 
 ?>
	 <div id="posts">
              <div class="container">
		<?php if ( have_posts() ) : ?>
 <div class="search_result_for"> 
 

<?php

foreach($_POST['survey'] as $srchres){
	$srchText[] =   $srchres;
}
$srchText = implode(',',$srchText);
?>
<form action="<?php echo get_site_url(); ?>" id="srchform" name="srchform" method="get">
<input type="hidden" placeholder="Search here" id="s" name="s" value="<?php echo stripslashes($srchText); ?>" >
</form>
<?php

if($srchText != ""){
	?>
	<script>document.srchform.submit();</script>
	<?php
}

?>

</div>
		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				?><article class="col-md-10"><?php get_template_part( 'template-parts/content', 'search' );?></div><?php

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			 get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		 </div >
      </div > 
  </div >

<?php get_footer(); ?>
