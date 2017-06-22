<?php
/**
 * Template Name: search

 * @since Twenty Twelve 1.0
 */
 
 get_header();
 ?>

<script>
	$(document).ready(function(e){
		var search_value = $('.search_result_for span').text();
		$('.search_block input[type="text"]').val(search_value);
		if($('.search_block input[type="text"]').val() != ""){
			$('.search_block input[type="submit"]').trigger('click')
                        $('.search_block input[type="submit"]').on('click', function(event){
                         //   alert(0);
                            e.preventDefault(); 
                            $(this).submit();
                        });
		};
	})
</script>
	 <div id="posts">
              <div class="container">
		<?php if ( have_posts() ) : ?>
 <div class="search_result_for">
 <?php
if(isset($_POST['Submit'])){
if(!empty($_POST['survey'])) {
$checked_count = count($_POST['survey']);
echo "<label>Search Result For:</label>";
foreach($_POST['survey'] as $selected) {
echo "<div class='tag'>".$selected ." <span class='close'>✕</span></div>";
}
}
}
?>
<div class="clear">clear all</div>
</div>
		
		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

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
