<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 
?>

<?php    if( has_post_thumbnail() ) { ?> 
<div id="post-<?php the_ID(); ?>" class="post-row clearfix">
    
 

	<div class="post-thumbnail col-md-4 col-sm-4"><?php the_post_thumbnail(); ?></div>

	<div class="more post-data col-md-8 col-sm-8">
	<?php

	 the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
     the_excerpt ();
	?>

	</div>

	</div>
	<?php }  ?>
<!-- #post-## -->
