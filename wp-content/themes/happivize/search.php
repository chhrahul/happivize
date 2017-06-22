<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 
?>
<style type="text/css">.woof_remove_ppi{display: none; !important;}</style>
<!--script>
function removesearch(val){
	jQuery("#removeVal").val(val);
	var myform = document.getElementById("searchFrm");
    var fd = new FormData(myform);
	
    jQuery.ajax({
        url: "<?php echo get_site_url(); ?>/removesearch.php",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (dataofconfirm) {
			window.location="<?php echo get_site_url(); ?>?s="+dataofconfirm;
        }
    });
}
</script-->
	 <div id="posts">
              <div class="container">

			<?php if ( have_posts() ) : ?>
			
			<!--div class="search_result_for">
			<?php
			if(isset($_GET['s']) && $_GET['s']!=""){	
				$searchText = urldecode($_GET['s']);
				$expText = explode(',',$searchText);
			}
			$cnt = count($expText);
			
		?>
		<form name="searchFrm" id="searchFrm" action="" method="POST">
			<?php
			echo "<lable>Search result for:</lable>";
			for($x =0; $x<$cnt;$x++){
			?>
				<p class="tag">
				<span class="tag_txt"><?php echo stripslashes($expText[$x]); ?></span>
				<input type="hidden" name="srchText[]" id="srchText<?php echo $x; ?>" value="<?php echo stripslashes($expText[$x]); ?>">				
				<span id="close" class='close' onclick="removesearch(<?php echo $x; ?>)">✕</span></p>
			<?php
			}
			?>
			<div class="clear"><a href="<?php echo site_url(); ?>">clear all</a></div>
			<input type="hidden" name="removeVal" id="removeVal" value="">
		</form>

</div-->
<div class="row clearfix">				
			<!-- .page-header -->
<aside class="col-md-3 srdata">
                         <?php echo do_shortcode('[woof sid="auto_shortcode" autohide=0]'); ?>
                         	
<?php //get_sidebar('nice-bar'); ?>  
 </aside> 
 <article class="col-md-9">
<?php echo do_shortcode('[woof_products is_ajax="1"]' ); ?>
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
			/*the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );*/

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?> 
		</article>
      </div> 
</div>
  </div>
<?php get_footer(); ?>