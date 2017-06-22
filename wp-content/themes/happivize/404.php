<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="container">
			
			<main id="main" class="site-main" role="main">

				<section class="error-404 not-found">
					<header class="page-header entry-header">						
						<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content" style="text-align: center;">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
				
			</main><!-- .site-main -->
		</div>
		<div class="container bottom_contentss">
			<div class="row clearfix">
	            <div class="col-sm-1">
	            </div>
	            <div class="col-sm-5">
	            	<?php get_sidebar( 'content-bottom' ); ?>
	            </div> 
	            <div class="col-sm-5">
	            	<?php get_sidebar(); ?>
	            </div>
	            <div class="col-sm-1">
	            </div>
        	</div>
			
			
		</div>
		
	</div><!-- .content-area -->


<?php get_footer(); ?>