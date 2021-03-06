<?php

/**

 * Twenty Sixteen functions and definitions

 *

 * Set up the theme and provides some helper functions, which are used in the

 * theme as custom template tags. Others are attached to action and filter

 * hooks in WordPress to change core functionality.

 *

 * When using a child theme you can override certain functions (those wrapped

 * in a function_exists() call) by defining them first in your child theme's

 * functions.php file. The child theme's functions.php file is included before

 * the parent theme's file, so the child theme functions would be used.

 *

 * @link https://codex.wordpress.org/Theme_Development

 * @link https://codex.wordpress.org/Child_Themes

 *

 * Functions that are not pluggable (not wrapped in function_exists()) are

 * instead attached to a filter or action hook.

 *

 * For more information on hooks, actions, and filters,

 * {@link https://codex.wordpress.org/Plugin_API}



 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */

/**

 * Twenty Sixteen only works in WordPress 4.4 or later.

 */



if (version_compare($GLOBALS['wp_version'], '4.4-alpha', '<'))

	{

	require get_template_directory() . '/inc/back-compat.php';



	}



if (!function_exists('twentysixteen_setup')):

	/**

	 * Sets up theme defaults and registers support for various WordPress features.

	 *

	 * Note that this function is hooked into the after_setup_theme hook, which

	 * runs before the init hook. The init hook is too late for some features, such

	 * as indicating support for post thumbnails.

	 *

	 * Create your own twentysixteen_setup() function to override in a child theme.

	 *

	 * @since Twenty Sixteen 1.0

	 */

	add_filter('loop_shop_per_page', create_function('$cols', 'return 12;') , 20); 

	function twentysixteen_setup()

		{

		/*

		* Make theme available for translation.

		* Translations can be filed in the /languages/ directory.

		* If you're building a theme based on Twenty Sixteen, use a find and replace

		* to change 'twentysixteen' to the name of your theme in all the template files

		*/

		load_theme_textdomain('twentysixteen', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');

		/*

		* Let WordPress manage the document title.

		* By adding theme support, we declare that this theme does not use a

		* hard-coded <title> tag in the document head, and expect WordPress to

		* provide it for us.

		*/

		add_theme_support('title-tag');

		/*

		* Enable support for custom logo.

		*

		*  @since Twenty Sixteen 1.2

		*/

		add_theme_support('custom-logo', array(

			'height' => 240,

			'width' => 240,

			'flex-height' => true,

		));

		/*

		* Enable support for Post Thumbnails on posts and pages.

		*

		* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

		*/

		add_theme_support('post-thumbnails');

		set_post_thumbnail_size(1200, 9999);

		register_nav_menus(array(

			'primary' => __('Primary Menu', 'twentysixteen') ,

			'social' => __('Social Links Menu', 'twentysixteen') ,

		));

		/*

		* Switch default core markup for search form, comment form, and comments

		* to output valid HTML5.

		*/

		add_theme_support('html5', array(

			'search-form',

			'comment-form',

			'comment-list',

			'gallery',

			'caption',

		));

		/*

		* Enable support for Post Formats.

		*

		* See: https://codex.wordpress.org/Post_Formats

		*/

		add_theme_support('post-formats', array(

			'aside',

			'image',

			'video',

			'quote',

			'link',

			'gallery',

			'status',

			'audio',

			'chat',

		));

		/*

		* This theme styles the visual editor to resemble the theme style,

		* specifically font, colors, icons, and column width.

		*/

		add_editor_style(array(

			'css/editor-style.css',

			twentysixteen_fonts_url()

		));

		add_theme_support('customize-selective-refresh-widgets');

		}



endif;

add_action('after_setup_theme', 'twentysixteen_setup');

/**

 * Sets the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 *

 * @since Twenty Sixteen 1.0

 */



function twentysixteen_content_width()

	{

	$GLOBALS['content_width'] = apply_filters('twentysixteen_content_width', 840);

	}



add_action('after_setup_theme', 'twentysixteen_content_width', 0);

/**

 * Registers a widget area.

 *

 * @link https://developer.wordpress.org/reference/functions/register_sidebar/

 *

 * @since Twenty Sixteen 1.0

 */



function twentysixteen_widgets_init()

	{

	register_sidebar(array(

		'name' => __('footer1', 'twentysixteen') ,

		'id' => 'sidebar-1',

		'description' => __('Add widgets here to appear in your sidebar.', 'twentysixteen') ,

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget' => '</section>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	));

	register_sidebar(array(

		'name' => __('footer2', 'twentysixteen') ,

		'id' => 'sidebar-2',

		'description' => __('Appears at the bottom of the content on posts and pages.', 'twentysixteen') ,

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget' => '</section>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	));

	register_sidebar(array(

		'name' => __('Content Bottom 2', 'twentysixteen') ,

		'id' => 'sidebar-3',

		'description' => __('Appears at the bottom of the content on posts and pages.', 'twentysixteen') ,

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget' => '</section>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	));

	}



add_action('widgets_init', 'twentysixteen_widgets_init');



if (!function_exists('twentysixteen_fonts_url')):

	/**

	 * Register Google fonts for Twenty Sixteen.

	 *

	 * Create your own twentysixteen_fonts_url() function to override in a child theme.

	 *

	 * @since Twenty Sixteen 1.0

	 *

	 * @return string Google fonts URL for the theme.

	 */

	function twentysixteen_fonts_url()

		{

		$fonts_url = '';

		$fonts = array();

		$subsets = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

		if ('off' !== _x('on', 'Merriweather font: on or off', 'twentysixteen'))

			{

			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';

			}



		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */

		if ('off' !== _x('on', 'Montserrat font: on or off', 'twentysixteen'))

			{

			$fonts[] = 'Montserrat:400,700';

			}



		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */

		if ('off' !== _x('on', 'Inconsolata font: on or off', 'twentysixteen'))

			{

			$fonts[] = 'Inconsolata:400';

			}



		if ($fonts)

			{

			$fonts_url = add_query_arg(array(

				'family' => urlencode(implode('|', $fonts)) ,

				'subset' => urlencode($subsets) ,

			) , 'https://fonts.googleapis.com/css');

			}



		return $fonts_url;

		}



endif;

/**

 * Handles JavaScript detection.

 *

 * Adds a `js` class to the root `<html>` element when JavaScript is detected.

 *

 * @since Twenty Sixteen 1.0

 */



function twentysixteen_javascript_detection()

	{

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}



add_action('wp_head', 'twentysixteen_javascript_detection', 0);

/**

 * Enqueues scripts and styles.

 *

 * @since Twenty Sixteen 1.0

 */



function twentysixteen_scripts()

	{

	wp_enqueue_style('twentysixteen-fonts', twentysixteen_fonts_url() , array() , null);

	wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array() , '3.4.1');

	wp_enqueue_style('twentysixteen-style', get_stylesheet_uri());

	wp_enqueue_style('twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array(

		'twentysixteen-style'

	) , '20160412');

	wp_style_add_data('twentysixteen-ie', 'conditional', 'lt IE 10');

	wp_enqueue_style('twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array(

		'twentysixteen-style'

	) , '20160412');

	wp_style_add_data('twentysixteen-ie8', 'conditional', 'lt IE 9');

	wp_enqueue_style('twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array(

		'twentysixteen-style'

	) , '20160412');

	wp_style_add_data('twentysixteen-ie7', 'conditional', 'lt IE 8');

	wp_enqueue_script('twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array() , '3.7.3');

	wp_script_add_data('twentysixteen-html5', 'conditional', 'lt IE 9');

	/* wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true ); */

	if (is_singular() && comments_open() && get_option('thread_comments'))

		{

		wp_enqueue_script('comment-reply');

		}



	if (is_singular() && wp_attachment_is_image())

		{

		wp_enqueue_script('twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array(

			'jquery'

		) , '20160412');

		}



	/* wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160412', true ); */

	wp_localize_script('twentysixteen-script', 'screenReaderText', array(

		'expand' => __('expand child menu', 'twentysixteen') ,

		'collapse' => __('collapse child menu', 'twentysixteen') ,

	));

	}



add_action('wp_enqueue_scripts', 'twentysixteen_scripts');

/**

 * Adds custom classes to the array of body classes.

 *

 * @since Twenty Sixteen 1.0

 *

 * @param array $classes Classes for the body element.

 * @return array (Maybe) filtered body classes.

 */



function twentysixteen_body_classes($classes)

	{

	if (get_background_image())

		{

		$classes[] = 'custom-background-image';

		}



	if (is_multi_author())

		{

		$classes[] = 'group-blog';

		}



	if (!is_active_sidebar('sidebar-1'))

		{

		$classes[] = 'no-sidebar';

		}



	if (!is_singular())

		{

		$classes[] = 'hfeed';

		}



	return $classes;

	}



add_filter('body_class', 'twentysixteen_body_classes');

/**

 * Converts a HEX value to RGB.

 *

 * @since Twenty Sixteen 1.0

 *

 * @param string $color The original color, in 3- or 6-digit hexadecimal form.

 * @return array Array containing RGB (red, green, and blue) values for the given

 *               HEX code, empty array otherwise.

 */



function twentysixteen_hex2rgb($color)

	{

	$color = trim($color, '#');

	if (strlen($color) === 3)

		{

		$r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));

		$g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));

		$b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));

		}

	  else

	if (strlen($color) === 6)

		{

		$r = hexdec(substr($color, 0, 2));

		$g = hexdec(substr($color, 2, 2));

		$b = hexdec(substr($color, 4, 2));

		}

	  else

		{

		return array();

		}



	return array(

		'red' => $r,

		'green' => $g,

		'blue' => $b

	);

	}



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Add custom image sizes attribute to enhance responsive image functionality

 * for content images

 *

 * @since Twenty Sixteen 1.0

 *

 * @param string $sizes A source size value for use in a 'sizes' attribute.

 * @param array  $size  Image size. Accepts an array of width and height

 *                      values in pixels (in that order).

 * @return string A source size value for use in a content image 'sizes' attribute.

 */



function twentysixteen_content_image_sizes_attr($sizes, $size)

	{

	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ('page' === get_post_type())

		{

		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';

		}

	  else

		{

		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';

		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';

		}



	return $sizes;

	}



add_filter('wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2);

/**

 * Add custom image sizes attribute to enhance responsive image functionality

 * for post thumbnails

 *

 * @since Twenty Sixteen 1.0

 *

 * @param array $attr Attributes for the image markup.

 * @param int   $attachment Image attachment ID.

 * @param array $size Registered image size or flat array of height and width dimensions.

 * @return string A source size value for use in a post thumbnail 'sizes' attribute.

 */



function twentysixteen_post_thumbnail_sizes_attr($attr, $attachment, $size)

	{

	if ('post-thumbnail' === $size)

		{

		is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';

		!is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';

		}



	return $attr;

	}



add_filter('wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3);

/**

 * Modifies tag cloud widget arguments to have all tags in the widget same font size.

 *

 * @since Twenty Sixteen 1.1

 *

 * @param array $args Arguments for tag cloud widget.

 * @return array A new modified arguments.

 */



function twentysixteen_widget_tag_cloud_args($args)

	{

	$args['largest'] = 1;

	$args['smallest'] = 1;

	$args['unit'] = 'em';

	return $args;

	}



add_filter('widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args');



function wpdocs_excerpt_more($more)

	{

	return '<br /><a class="general_btn" href="' . get_permalink() . '">Learn More</a>';

	}



add_filter('excerpt_more', 'wpdocs_excerpt_more');

/**DK code start here**/



function sv_wc_memberships_my_memberships_shortcode()

	{

	ob_start();

?>

		<div class="woocommerce">


		<?php

	wc_memberships()->frontend->my_account_memberships();

?>
		</div>

		<?php

	echo ob_get_clean();

	}



add_shortcode('wcm_my_memberships', 'sv_wc_memberships_my_memberships_shortcode');

/**DK code end here**/



/**Pagination code start here**/

// numbered pagination



function pagination($pages = '', $range = 4)

	{

	$showitems = ($range * 2) + 1;

	global $paged;

	if (empty($paged)) $paged = 1;

	if ($pages == '')

		{

		global $wp_query;

		$pages = $wp_query->max_num_pages;

		if (!$pages)

			{

			$pages = 1;

			}

		}



	if (1 != $pages)

		{

		echo "<div class=\"pagination\"><span>Page " . $paged . " of " . $pages . "</span>";

		if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";

		if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";

		for ($i = 1; $i <= $pages; $i++)

			{

			if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems))

				{

				echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";

				}

			}



		if ($paged < $pages && $showitems < $pages) echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";

		if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";

		echo "</div>\n";

		}

	}



/**Pagination code end here**/



// Custom Post types for Testimonial



add_action('init', 'testimonial_slider');



function testimonial_slider()

	{

	$feature_args = array(

		'labels' => array(

			'name' => __('Testimonial ') ,

			'singular_name' => __('Testimonial ') ,

			'add_new' => __('Add New Testimonial ') ,

			'add_new_item' => __('Add New Testimonial ') ,

			'edit_item' => __('Edit Testimonial ') ,

			'new_item' => __('Add New Testimonial ') ,

			'view_item' => __('View Testimonial ') ,

			'search_items' => __('Search Testimonial ') ,

			'not_found' => __('No Testimonial  found') ,

			'not_found_in_trash' => __('No Testimonial  found in trash')

		) ,

		'public' => true,

		'show_ui' => true,

		'menu_position' => 6,

		'supports' => array(

			'title',

			'editor',

			'thumbnail'

		)

	);

	register_post_type('testimonial', $feature_args);

	}



/* Single Products Page Speakers Name after Title */
add_action('woocommerce_single_product_summary', 'woocommerce_template_top_category_desc', 5);


function woocommerce_template_top_category_desc()

	{

	//the_field('byline');
		$key_1_values = get_post_meta( get_the_ID(), 'Product-template' );  
		$template_vl = $key_1_values[0]; 

		if($template_vl == "Template3"){
			?>
			<div class="spekrs_bioname">
			<?php
				if(!empty(get_post_meta(get_the_ID(), 'speakers_bio_name', true))){
					echo "with ".$key_1_values = get_post_meta( get_the_ID() , "speakers_bio_name", true);
				}
			?>
			</div>		
			<?php
		}
		else{
		?>
			<div class="spekrs_bioname">
			<?php echo get_post_meta(get_the_ID(), "speakers_bio_name", true); ?>
			</div>		
			<?php
		}
	}

/* End of Single Products Page Speakers Name after Title */


// Add Custom Footer Menu Space in theme



function register_my_menu()

	{

	register_nav_menu('footer-menu', __('Footer Menu'));

	}



add_action('init', 'register_my_menu');



// Commission page



function ricky_enqueue_styles()

	{

	if (is_page('1042'))

		{

		wp_register_style('datepicker', get_template_directory_uri() . '/css/datepicker.css');

		wp_enqueue_style('datepicker');

		wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css');

		wp_enqueue_style('normalize');

		wp_register_style('myledger', get_template_directory_uri() . '/css/myledger.css');

		wp_enqueue_style('myledger');

		wp_register_style('forcom', get_template_directory_uri() . '/css/forcom.css');

		wp_enqueue_style('forcom');

		wp_enqueue_script('base', 'https://code.jquery.com/jquery-1.12.4.js', array() , null, true);

		wp_enqueue_script('baseui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array() , null, true);

		}

	}



add_action('wp_print_styles', 'ricky_enqueue_styles');



function ricky_enqueue_stylesho()

	{

	if (is_page('3472'))

		{

		wp_register_style('homestyle', get_template_directory_uri() . '/css/stylemain.css');

		wp_enqueue_style('homestyle');

		wp_register_style('homestylede', get_template_directory_uri() . '/css/defaultmain.css');

		wp_enqueue_style('homestylede');

		wp_register_style('homestylinner', get_template_directory_uri() . '/css/interstyle.css');

		wp_enqueue_style('homestylinner');

		}

	}



add_action('wp_print_styles', 'ricky_enqueue_stylesho');



function ricky_enqueue_styles2()

	{

	if (is_page('971') || is_page('1078'))

		{

		wp_register_style('datepicker', get_template_directory_uri() . '/css/datepicker.css');

		wp_enqueue_style('datepicker');

		wp_register_style('myledger', get_template_directory_uri() . '/css/myledger.css');

		wp_enqueue_style('myledger');

		wp_enqueue_script('base', 'https://code.jquery.com/jquery-1.12.4.js', array() , null, true);

		wp_enqueue_script('baseui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array() , null, true);

		}

	}



add_action('wp_print_styles', 'ricky_enqueue_styles2');



function my_deregister_javascript()

	{

	if (is_page('1042'))

		{

		wp_deregister_script('datepicker');

		}

	}



add_action('wp_print_scripts', 'my_deregister_javascript', 100);



function my_deregister_style()

	{

	if (is_page('971'))

		{

		wp_deregister_style('forcom');

		}

	}



add_action('wp_print_styles', 'my_deregister_style', 100);

add_action('woocommerce_subscription_status_active', 'add_refferal_post');



function add_refferal_post()

	{

	global $wpdb;

	$select = "select * from hp_temp";

	$data = $wpdb->get_row($select);

	$sql = "insert into hp_aff_referrals (ref_post_id) values ('" . $data->page_id . "')";

	$wpdb->query($sql);



	// print_r($data); die;



	}



//add_action('add_meta_boxes', 'add_woo_metaboxelink');



function add_woo_metaboxelink()

{

add_meta_box('wpt_woo_product_link', 'Private Session For Single Pay', 'wpt_woo_product_link', 'product', 'normal', 'high');



}







//add_action('add_meta_boxes', 'add_woo_metaboxelink_second');



function add_woo_metaboxelink_second()

	{

	add_meta_box('wpt_woo_private_session_sub', 'Private Session For Subscription Payment', 'wpt_woo_private_session_sub', 'product', 'normal', 'high');

	wp_enqueue_script('jquery-min_custom', get_template_directory_uri() . '/js/jquery.custom.js');

	}





function wpt_woo_private_session_sub(){

	global $post;

	?>



	<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">



	  <tbody>

	    <tr>

	    

	     <td><input type="text" class="locationGeocode" name="_woo_product_link[private_session_sub]" value="<?php

		echo get_post_meta($post->ID, 'private_session_sub', true); ?>"></td>

	   </tr>

	  </tbody>



	</table>

 

	<?php

	}




function wpt_woo_product_link()

	{

	global $post;

?>



<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">



  <tbody>     <tr>

   <!--  <th><label></label></th> -->

     <td><input type="text" class="locationGeocode" name="_woo_product_link[private_session]" value="<?php

	echo get_post_meta($post->ID, 'private_session', true); ?>"></td>

   </tr>

  </tbody>



</table>



<?php

	}



add_action('save_post', 'wpt_save_woo_meta_private_session', 1, 2);



function wpt_save_woo_meta_private_session($post_id, $post)

	{

	if ($post->post_type == 'product')

		{

		$events_meta_customdata = $_POST['_woo_product_link'];

		foreach($events_meta_customdata as $key => $value)

			{

			if (get_post_meta($post_id, $key, FALSE))

				{

				update_post_meta($post_id, $key, $value);

				}

			  else

				{

				add_post_meta($post_id, $key, $value);

				}

			}

		}

	}



// Instructions



//add_action('add_meta_boxes', 'add_woo_metaboxeinst');



function add_woo_metaboxeinst()

	{

	add_meta_box('wpt_woo_product_inst', 'Product Instruction For Single Pay', 'wpt_woo_product_inst', 'product', 'normal', 'high');

	}



function wpt_woo_product_inst()

	{

	global $post;

?>



<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">



  <tbody     <tr>

     <th><label></label></th>

     <td><textarea rows="4" cols="100" class="locationGeocode" name="_woo_product_inst[product_Instruction]" value=""><?php

	echo get_post_meta($post->ID, 'product_Instruction', true); ?></textarea></td>



    </tr>

  </tbody>



</table>



<?php

	}



add_action('save_post', 'wpt_save_woo_meta_pinstruction', 1, 2);



function wpt_save_woo_meta_pinstruction($post_id, $post)

	{

	if ($post->post_type == 'product')

		{
        $sname = $_POST['speakers_bio_name'];
      	if (get_post_meta($post_id, 'speakers_bio_name', FALSE))

				{

				update_post_meta($post_id, 'speakers_bio_name', $sname);

				}

			  else

				{

				add_post_meta($post_id, 'speakers_bio_name', $sname);

				}
      
		  $events_meta_customdata = $_POST['_woo_product_inst'];

		foreach($events_meta_customdata as $key => $value)

			{

			if (get_post_meta($post_id, $key, FALSE))

				{

				update_post_meta($post_id, $key, $value);

				}

			  else

				{

				add_post_meta($post_id, $key, $value);

				}

			}

		}

	}



// Instruction 2



//add_action('add_meta_boxes', 'add_woo_metaboxeinst2');



function add_woo_metaboxeinst2()

	{

	add_meta_box('wpt_woo_product_inst2', 'Product Instruction For Subscription Payment ', 'wpt_woo_product_inst2', 'product', 'normal', 'high');

	}



function wpt_woo_product_inst2()

	{

	global $post;

?>



<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">



  <tbody     <tr>

     <th><label></label></th>

     <td><textarea rows="4" cols="100" class="locationGeocode" name="_woo_product_inst[product_Instruction2]" value=""><?php

	echo get_post_meta($post->ID, 'product_Instruction2', true); ?></textarea></td>



    </tr>

  </tbody>



</table>



<?php

}



add_action('save_post', 'wpt_save_woo_meta_pinstruction2', 1, 2);



function wpt_save_woo_meta_pinstruction2($post_id, $post)

	{

	if ($post->post_type == 'product')

		{

		$events_meta_customdata = $_POST['_woo_product_inst2'];

		foreach($events_meta_customdata as $key => $value)

			{

			if (get_post_meta($post_id, $key, FALSE))

				{

				update_post_meta($post_id, $key, $value);

				}

			  else

				{

				add_post_meta($post_id, $key, $value);

				}

			}

		}

	}



/* Admin side Template Settings */

add_action('add_meta_boxes', 'add_new_product_info');


function add_new_product_info()
{

	add_meta_box('wpt_woo_template_settings', 'Product Details', 'wpt_woo_template_settings', 'product', 'normal', 'high');

}


function wpt_woo_template_settings(){

	include_once('woocommerce/admin_template_settings.php');

    global $post;


    ?>

    <div id="woocommerce-product-data-new" class="postbox ">

		<div class="panel-wrap product_data">


				<ul class="product_data_tabs wc-tabs" style="">

					<li class="general_options bullet_points general_tab hide_if_grouped active">

						<a href="#bullets_descriptionlist">Bullet Points</a>

					</li>

					<li class="attribute_options attribute_tab" style="display: block;">

							<a href="#deliverables_pif_data">Deliverables PIF</a>

					</li>

					<li class="advanced_options advanced_tab" style="display: block;">

							<a href="#deliverables_sub_data">Deliverables Sub</a>

					</li>         


					<li class="advanced_options advanced_tab" style="display: block;">

							<a href="#bio_data">Bio</a>

					</li>

     		     	<li class="attribute_options attribute_tab" style="display: block;">

							<a href="#testimonial_data">Testimonials</a>

					</li>
					<li class="linked_product_options offers_sub_data_tab" style="display: none;">

							<a href="#offers_sub_data">Special offer</a>

					</li>
					

				</ul>

				<div id="bullets_descriptionlist" class="panel wc-metaboxes-wrapper" style="display: none;"><!-- Bullets Point tab -->

					<div id="variable_product_options_inner">			

						<div class="content center_wrap">

								<h4 style="margin-top: 4px;font-weight:bold;">Bullets Points</h4>

								<ul class="bullet_lists_wrap">

									<li class="bullets_points">

										<label>Point 1</label>

										<input type="text" value="<?php	echo get_post_meta($post->ID, 'bullet_description1', true); ?>" cols="50" name="_woo_product_inst[bullet_description1]">

									</li>

									<li class="bullets_points">

										<label>Point 2</label>

										<input type="text" value="<?php	echo get_post_meta($post->ID, 'bullet_description2', true); ?>" cols="50" name="_woo_product_inst[bullet_description2]">

									</li>

									<li class="bullets_points">

										<label>Point 3</label>

										<input type="text" value="<?php	echo get_post_meta($post->ID, 'bullet_description3', true); ?>" cols="50" name="_woo_product_inst[bullet_description3]">

									</li>

									<li class="bullets_points">

										<label>Point 4</label>

										<input type="text" value="<?php	echo get_post_meta($post->ID, 'bullet_description4', true); ?>" cols="50" name="_woo_product_inst[bullet_description4]">

									</li>

									<li class="bullets_points">

										<label>Point 5</label>

										<input type="text" value="<?php	echo get_post_meta($post->ID, 'bullet_description5', true); ?>" cols="50" name="_woo_product_inst[bullet_description5]">

									</li>

								</ul>

						</div>

					</div>

				</div><!-- Emd of Bullets Points Tab -->

				<div id="deliverables_pif_data" class="panel wc-metaboxes-wrapper" style="display: none;"><!-- Deliverable PIF -->

					<div id="variable_product_options_inner">			

						<div class="content center_wrap">

							<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">

						  <tbody>

							  <tr>

							      <td colspan="2" style="font-weight:bold;">Product Instructions For Single Pay</td>

							  </tr>

						       <tr>

							     <th><label></label></th>

							     <td><textarea rows="6" cols="80" class="locationGeocode" name="_woo_product_inst[product_Instruction]" value=""><?php

								echo get_post_meta($post->ID, 'product_Instruction', true); ?></textarea></td>

							    </tr>
				    

						    	<tr height="15"></tr>

							    <tr>

							      <td colspan="2" style="font-weight:bold;">Private Session For Single Pay</td>

							 	 </tr>

						    
						    <tr> <th><label></label></th>

						    <td><input type="text" class="locationGeocode" name="_woo_product_link[private_session]" value="<?php

							echo get_post_meta($post->ID, 'private_session', true); ?>"></td></tr>

						  </tbody>

						</table>

					<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">

					  <tbody>

					  	<tr height="15"></tr>

					    <tr>

					      <td colspan="2" style="font-weight:bold;">Group Call For Single Pay</td>

					  	</tr>

					   <tr>

					     	<th><label>Date time:</label></th>

						    <td>

							   <input value="<?php echo get_post_meta($post->ID, 'datetime', true); ?>" name="_woo_product[datetime]" data-format="MM/dd/yyyy HH:mm:ss PP" id="datetimepicker" type="text"/>

							</td>					 

					    </tr>

					   <tr>

					    <th>Phone # 1</th>

					      <td><input type="text" class="locationGeocode" name="_woo_product[phone]" value="<?php

						echo get_post_meta($post->ID, 'phone', true); ?>"></td>



					      <th><label>Alternate # :</label></th>

					     <td><input type="text" class="locationGeocode" name="_woo_product[Alternate]" value="<?php

						echo get_post_meta($post->ID, 'Alternate', true); ?>" ></td>

					    </tr>

					    <tr>

					      <th><label>Passcode:</label></th>

					      <td><input type="text" class="locationGeocode" name="_woo_product[Passcode]" value="<?php

						echo get_post_meta($post->ID, 'Passcode', true); ?>"></td>

					      <th><label>Streaming Link :</label></th>

					     <td><input type="text" class="locationGeocode" name="_woo_product[streaming]" value="<?php

						echo get_post_meta($post->ID, 'streaming', true); ?>"></td>

					    </tr>

					 </tbody>

					</table>

					<script type="text/javascript">

						jQuery.datetimepicker.setLocale('en');

						jQuery('#datetimepicker').datetimepicker({

						dayOfWeekStart : 1,

						lang:'en'

						});

					</script>

					</div>

					</div>

				</div><!-- End of Deliverable PIF -->

				<div id="deliverables_sub_data" class="panel wc-metaboxes-wrapper" style="display: none;"><!-- Deliverable Sub Tab -->

					<div id="variable_product_options_inner">			

						<div class="content center_wrap">

						<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">

						  <tbody>

						    <tr>

						      <td colspan="2" style="font-weight:bold;">Product Instructions For Subscription Payment</td>

						    </tr>     
						    <tr>

						     <th><label></label></th>

						     <td><textarea rows="6" cols="80" class="locationGeocode" name="_woo_product_inst[product_Instruction2]" value=""><?php

							echo get_post_meta($post->ID, 'product_Instruction2', true); ?></textarea></td>

						    </tr>						    

						    <tr height="15"></tr>

						    <tr>

						      <td colspan="2" style="font-weight:bold;">Private Session For Subscription Payment</td>

						    </tr>
						    

						    <tr> <th><label></label></th>

						    <td><input type="text" class="locationGeocode" name="_woo_product_link[private_session_sub]" value="<?php echo get_post_meta($post->ID, 'private_session_sub', true); ?>"></td>

						    </tr>
			    
						  </tbody>

						</table>

						</div>

					</div>

				</div><!-- End of Deliverable PIF -->


				<div id="bio_data" class="panel wc-metaboxes-wrapper" style="display: none;"><!-- Bio Tab -->

					<div id="variable_product_options_inner">
			

						<div class="content center_wrap">

						<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">

						  	<tbody>

						    <tr>

						      <td colspan="2" style="font-weight:bold;">Speakers Name</td>

						 	</tr>

						  	<tr height="5"></tr>
						   	<tr>						     

						    	<td><input type="text" cols="80" class="locationGeocode" id="speaker_bioname" onfocusout="myFunction()" name="speakers_bio_name" value="<?php echo get_post_meta($post->ID, 'speakers_bio_name', true); ?>">						    	

						    </tr>
						    <tr height="15"></tr>
						    <tr>

						      <td colspan="2" style="font-weight:bold;">Speakers Bio</td>

						  	</tr>

						  	<tr height="5"></tr>

						    <tr>						     

						    	<td><textarea rows="4" cols="80" class="locationGeocode" name="_woo_product_inst[speakers_pbio]" value=""><?php echo get_post_meta($post->ID, 'speakers_pbio', true); ?></textarea></td>

						    </tr>

						    <tr height="15"></tr>
						    <tr>

						     	<td colspan="2" style="font-weight:bold;">Speakers Bio Image</td>

						 	 </tr>

						  	<tr height="5"></tr>

						    <tr>
					     

						    <td>
						   
						      <?php
					
								if(!empty(get_post_meta($post->ID, 'speakers_image', true)))
    							{
								?>							
					               
					                <input class="header_logo_url" type="text" name="_woo_product_inst[speakers_image]" size="60" value="<?php echo get_post_meta($post->ID, 'speakers_image', true); ?>">
					                <a href="#" class="header_logo_upload button button-primary">Upload</a>
					                <a href="#" class="header_logo_remove button button-primary">Remove</a><br/>
					                 <img class="header_logo" src="<?php echo get_post_meta($post->ID, 'speakers_image', true) ?>" height="100" width="100"/>
					            <?php
					            }
					            else{
				            	?>
				            		 <input class="header_logo_url" type="text" name="_woo_product_inst[speakers_image]" size="60" value="<?php echo get_option('header_logo'); ?>">
					                	<a href="#" class="header_logo_upload button button-primary">Upload</a><br/><br/>
					                 <img class="header_logo" src="<?php echo get_option('header_logo'); ?>" height="100" width="100"/>
				            	<?php
					            }
					            ?>

								<script type="text/javascript">
								    jQuery(document).ready(function($) {
								        $('.header_logo_upload').click(function(e) {
								            e.preventDefault();

								            var custom_uploader = wp.media({
								                title: 'Custom Image',
								                button: {
								                    text: 'Upload Image'
								                },
								                multiple: false  // Set this to true to allow multiple files to be selected
								            })
								            .on('select', function() {
								                var attachment = custom_uploader.state().get('selection').first().toJSON();
								                $('.header_logo').attr('src', attachment.url);
								                $('.header_logo_url').val(attachment.url);

								            })
								            .open();
								        });

								        $('.header_logo_remove').click(function(e){
								        	e.preventDefault();
								        	$('.header_logo').attr('src',"");
								            $('.header_logo_url').val("");
								        });

								    });
								</script>

						    </td>

						    </tr>

						  </tbody>
						</table>

						</div>
					</div>
				</div><!-- End of Bio Tab -->


		<div id="testimonial_data" class="panel wc-metaboxes-wrapper" style="display: none;"><!-- Testimonials Tab -->

		<div id="variable_product_options_inner">

			<div class="content center_wrap">

				<table class="testimonial_set" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">

 					<tbody>  

					    <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 1</td>					    

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_1]" value=""><?php	echo get_post_meta($post->ID, 'testimonial_1', true); ?></textarea></td>

					    </tr>  

					    <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 2</td> 					    

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_2]" value=""><?php echo get_post_meta($post->ID, 'testimonial_2', true); ?></textarea></td>

					    </tr>

					    <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 3</td>					   

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_3]" value=""><?php echo get_post_meta($post->ID, 'testimonial_3', true); ?></textarea></td>

					    </tr>

					    <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 4</td> 

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_4]" value=""><?php	echo get_post_meta($post->ID, 'testimonial_4', true); ?></textarea></td>

					    </tr>

					    <?php

					    if(!empty(get_post_meta($post->ID, 'testimonial_5', true)))
					    {				        

					    ?>

					    <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 5</td>

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_5]" value=""><?php echo get_post_meta($post->ID, 'testimonial_5', true); ?></textarea></td>

					   		</tr>
					    
					    <?php

					    }
					    ?>   

    

						    <?php

						if(!empty(get_post_meta($post->ID, 'testimonial_6', true)))
						{
						?>

						<tr>
							<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 6</td> 

							<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_6]" value=""><?php	echo get_post_meta($post->ID, 'testimonial_6', true); ?></textarea></td>

						</tr>

						<?php

						}
						?>

    

						<?php

						if(!empty(get_post_meta($post->ID, 'testimonial_7', true)))
						{

						?>

						<tr>

							<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 7</td> 

							<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_7]" value=""><?php	echo get_post_meta($post->ID, 'testimonial_7', true); ?></textarea></td>

						</tr>

						<?php					 

						}
						?>
    
					    <?php

					    if(!empty(get_post_meta($post->ID, 'testimonial_8', true)))
					    {
					   ?>

					        <tr>

					      		<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 8</td> 

					     		<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_8]" value=""><?php	echo get_post_meta($post->ID, 'testimonial_8', true); ?></textarea></td>

					   		</tr>

					    <?php

					    }
					    ?>
   
					    <?php

					     if(!empty(get_post_meta($post->ID, 'testimonial_9', true)))
					     {
					     ?>
					     	<tr>

							    <td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 9</td> 

							    <td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_9]" value=""><?php echo get_post_meta($post->ID, 'testimonial_9', true); ?></textarea></td>

					    	</tr>

					    <?php

					    }
					    ?>
   
				    <?php

				     if(!empty(get_post_meta($post->ID, 'testimonial_10', true)))

				     {

				        ?>

				        <tr>

				      <td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 10</td> 

				    

				     <td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_10]" value=""><?php

					echo get_post_meta($post->ID, 'testimonial_10', true); ?></textarea></td>

				    </tr>

				        <?php
				         
				     }

				    ?>
				    
				     <?php

				     if(!empty(get_post_meta($post->ID, 'testimonial_11', true)))

				     {

				        ?>

				        <tr>

					      <td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 11</td> 

					    

					     <td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_11]" value=""><?php

						echo get_post_meta($post->ID, 'testimonial_11', true); ?></textarea></td>



					    </tr>

				    <?php
				    }

				    ?>

				    

				     <?php

				     if(!empty(get_post_meta($post->ID, 'testimonial_12', true)))
				     {

				        ?>

				        <tr>

						    <td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 12</td> 					    

						    <td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_12]" value=""><?php

							echo get_post_meta($post->ID, 'testimonial_12', true); ?></textarea></td>

					    </tr>

				        <?php				         

				     }

				    ?>

				    

				     <?php

				     if(!empty(get_post_meta($post->ID, 'testimonial_13', true)))

				     {				        

				        ?>

				        <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 13</td> 

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_13]" value=""><?php

						echo get_post_meta($post->ID, 'testimonial_13', true); ?></textarea></td>

					    </tr>

				        <?php				         

				     }

				    ?>

				     <?php

				     if(!empty(get_post_meta($post->ID, 'testimonial_14', true)))
				     {				        

				        ?>

				        <tr>

					    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 14</td> 					    

					    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_14]" value=""><?php

						echo get_post_meta($post->ID, 'testimonial_14', true); ?></textarea></td>

					    </tr>

				    <?php			         

				    }

				    ?>

				    

				     <?php

				     if(!empty(get_post_meta($post->ID, 'testimonial_15', true)))
				     {		        

				    ?>

				   <tr>

				    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 15</td>				    

				    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_15]" value=""><?php

					echo get_post_meta($post->ID, 'testimonial_15', true); ?></textarea></td>

				    </tr>

				   <?php

				    }

				    ?>

				    <?php

				    if(!empty(get_post_meta($post->ID, 'testimonial_16', true)))
				    {
				    ?>

				    <tr>

					    <td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 16</td> 					    

					    <td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_16]" value=""><?php

						echo get_post_meta($post->ID, 'testimonial_16', true); ?></textarea></td>

				    </tr>

				    <?php
				    }
				    ?>

				    <?php

				    if(!empty(get_post_meta($post->ID, 'testimonial_17', true)))
				    {
				    ?>

				    <tr>

					    <td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 17</td> 					    

					    <td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_17]" value=""><?php

						echo get_post_meta($post->ID, 'testimonial_17', true); ?></textarea></td>

				    </tr>
					<?php		         

				    }

				    ?>				    

				    <?php

				    if(!empty(get_post_meta($post->ID, 'testimonial_18', true)))
				    {
        			?>

				    <tr>

				    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 18</td>				    

				    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_18]" value=""><?php

					echo get_post_meta($post->ID, 'testimonial_18', true); ?></textarea></td>

				    </tr>
					<?php   
				    }

				    ?>

				    

				    <?php

				    if(!empty(get_post_meta($post->ID, 'testimonial_19', true)))
				    { 

			        ?>
					<tr>

				      	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 19</td> 

				    

				     	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_19]" value=""><?php

					echo get_post_meta($post->ID, 'testimonial_19', true); ?></textarea></td>
				    </tr>

				   	<?php	         

				    }

				    ?>

				    

				    <?php
				    if(!empty(get_post_meta($post->ID, 'testimonial_20', true)))
				    {				        

				    ?>
				    <tr>

				    	<td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial 20</td> 				    

				    	<td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_20]" value=""><?php

					echo get_post_meta($post->ID, 'testimonial_20', true); ?></textarea></td>

				    </tr>
				    <?php		         

				    }

				    ?>			    

				  </tbody>

				</table>

				<div class="Button_end">

					 <a href="javascript:void(0)" class="button button-primary" id="addMore_row">Add More</a>

				 	<a href="javascript:void(0)" class="button " id="removwMore_row" style="display: none;">Remove</a>	

				</div>

				<script type="text/javascript">


					jQuery("#addMore_row").click(function(event){				

						var counters = jQuery('.testimonial_set tr').length;

						counter = ++counters;

				        event.preventDefault();

				        var newRow = jQuery('<tr><td colspan="3" style="font-weight:bold;font-size: 12px;">Testimonial ' + counter + '</td><td><textarea rows="4" cols="83" class="locationGeocode" name="_woo_product_inst[testimonial_'+ counter +']" value=""></textarea></td></tr>');

				            counter++;

				        jQuery('table.testimonial_set').append(newRow);	 

				        jQuery("#removwMore_row").css('display','block');

					});  

			        jQuery(document).ready(function($)
			        {

			             lastval = jQuery('.testimonial_set tr').length;

			             if(lastval > 4)

			             {

			                jQuery("#removwMore_row").css('display','block');

			             }

			             gettemplate_tylez = jQuery("#template_tylez option:selected").text();
			             if(gettemplate_tylez == "Template3" || gettemplate_tylez == "Template2"){
			             	jQuery("#woocommerce-product-data-new .offers_sub_data_tab").show();
      					    }
      					    else{
      					    	jQuery("#woocommerce-product-data-new .offers_sub_data_tab").hide();
      					    }

			        });


					jQuery("#removwMore_row").click(function(){

			        	jQuery('.testimonial_set tr').last().remove();

						setTimeout(function(){ 

							lastval = jQuery('.testimonial_set tr').length;				

							if(lastval == 4){

								jQuery("#removwMore_row").css('display','none');

							}

						}, 100);						

			        });



				</script>

				</div>

			</div>

		</div><!-- End of testimonials Tab -->

		<div id="offers_sub_data" class="panel wc-metaboxes-wrapper" style="display: none;"><!-- Offers Tab -->
			<div class="content center_wrap">
				<label><b>Select an Offer</b></label><br/><br/>

				<?php
					global $wpdb;

						$result = $wpdb->get_results ( "
						    SELECT * 
						    FROM  $wpdb->posts
						    WHERE post_type = 'dnc-wc-offer'
						    ORDER BY post_title ASC
						" );
						?><select name="productz_offer" id="productz_offer">
		                  <option value="" >-- Select Special Offer --</option>	
		                 <?php
						foreach ( $result as $offer )
						{
							global $post;
							if(!empty(get_post_meta($post->ID, '_productz_offer', true)))	
							{
								echo $offer_prctzId = get_post_meta($post->ID, '_productz_offer', true);
								if($offer->ID == $offer_prctzId){ ?>
									<option value="<?php echo $offer->ID; ?>" selected="selected" ><?php echo $offer->post_title ?></option>		
								<?php
								}
								else{
								?>
									<option value="<?php echo $offer->ID; ?>" ><?php echo $offer->post_title ?></option>	
								<?php
								}
								?>								   
							   			  
							<?php
							}
							else{ ?>
								<option value="<?php echo $offer->ID; ?>" ><?php echo $offer->post_title ?></option>	
							<?php
							}
						}
						?> </select> <?php
				?>

			</div>
			
		</div><!-- End of Offers Tab -->

		</div><!-- End of Panel Box -->

	</div><!-- End Of woocommerce Tba Box -->
<?php
}



// Group Call

//add_action('add_meta_boxes', 'add_woo_metaboxesab');

function add_woo_metaboxesab()
	{

	add_meta_box('wpt_woo_product', 'Group call', 'wpt_woo_product', 'product', 'normal', 'high');

	}

function wpt_woo_product()

	{

	global $post;

	/*$timezones = array(

		'AC' => 'America/Rio_branco',

		'AL' => 'America/Maceio',

		'AP' => 'America/Belem',

		'AM' => 'America/Manaus',

		'BA' => 'America/Bahia',

		'CE' => 'America/Fortaleza',

		'DF' => 'America/Sao_Paulo',

		'ES' => 'America/Sao_Paulo',

		'GO' => 'America/Sao_Paulo',

		'MA' => 'America/Fortaleza',

		'MT' => 'America/Cuiaba',

		'MS' => 'America/Campo_Grande',

		'MG' => 'America/Sao_Paulo',

		'PR' => 'America/Sao_Paulo',

		'PB' => 'America/Fortaleza',

		'PA' => 'America/Belem',

		'PE' => 'America/Recife',

		'PI' => 'America/Fortaleza',

		'RJ' => 'America/Sao_Paulo',

		'RN' => 'America/Fortaleza',

		'RS' => 'America/Sao_Paulo',

		'RO' => 'America/Porto_Velho',

		'RR' => 'America/Boa_Vista',

		'SC' => 'America/Sao_Paulo',

		'SE' => 'America/Maceio',

		'SP' => 'America/Sao_Paulo',

		'TO' => 'America/Araguaia',

	);  */

?>



<table class="" cellpadding="2" cellspacing="2" style="width:100%; text-align:left;">

  <tbody>

   <tr>

     <th><label>Date time:</label></th>

      <td>

   <input value="<?php

	echo get_post_meta($post->ID, 'datetime', true); ?>" name="_woo_product[datetime]" data-format="MM/dd/yyyy HH:mm:ss PP" id="datetimepicker" type="text"></input>

  </td>

    </tr>

   <tr>



      <th>Phone # 1</th>



      <td><input type="text" class="locationGeocode" name="_woo_product[phone]" value="<?php

	echo get_post_meta($post->ID, 'phone', true); ?>"></td>



      <th><label>Alternate # :</label></th>

     <td><input type="text" class="locationGeocode" name="_woo_product[Alternate]" value="<?php

	echo get_post_meta($post->ID, 'Alternate', true); ?>" ></td>

    </tr>

    <tr>

      <th><label>Passcode:</label></th>



      <td><input type="text" class="locationGeocode" name="_woo_product[Passcode]" value="<?php

	echo get_post_meta($post->ID, 'Passcode', true); ?>"></td>



      <th><label>Streaming Link :</label></th>

     <td><input type="text" class="locationGeocode" name="_woo_product[streaming]" value="<?php

	echo get_post_meta($post->ID, 'streaming', true); ?>"></td>



    </tr>



 </tbody>



</table>



<script>





jQuery.datetimepicker.setLocale('en');





jQuery('#datetimepicker').datetimepicker({



dayOfWeekStart : 1,



lang:'en'



});



</script>





<?php

	}



add_action('save_post', 'wpt_save_woo_meta', 1, 2);



function wpt_save_woo_meta($post_id, $post)

	{

	if ($post->post_type == 'product')

		{

		$events_meta_customdata = $_POST['_woo_product'];

		foreach($events_meta_customdata as $key => $value)

			{

			if (get_post_meta($post_id, $key, FALSE))

				{

				update_post_meta($post_id, $key, $value);

				}

			  else

				{

				add_post_meta($post_id, $key, $value);

				}

			}



		}

	}



function my_enqueue_scrpt()

	{

	wp_enqueue_style('bootstrap_date_css', get_template_directory_uri() . '/css/jquery.datetimepicker.css');

	wp_enqueue_script('jquery-min_date', get_template_directory_uri() . '/js/jquery.datetimepicker.full.js');

	}



add_action('admin_enqueue_scripts', 'my_enqueue_scrpt');

add_filter('wp_revisions_to_keep', 'filter_function_name', 10, 2);



function filter_function_name($num, $post)

	{

	if ('dnc-wc-offer' == $post->post_type)

		{

		$num = 5;

		}



	return $num;

	}



add_action('init', 'wpdocs_custom_init');

/**

 * Add excerpt support to pages

 */



function wpdocs_custom_init()

	{

	add_post_type_support('dnc-wc-offer', 'editor');

	}



/**@ Remove in all product type except grouped products*/

add_action( 'woocommerce_single_product_summary', 'get_product_type',  5 );
function get_product_type() {
   global $post;
    if( function_exists('get_product') ){
        $product = get_product( $post->ID );
        if( $product->is_type( 'grouped' ) ){
        	//echo "group";
		}
		else{
			add_filter('woocommerce_is_sold_individually', 'baztro_remove_all_quantity_fields', 10, 2);
		}
    }
}

function baztro_remove_all_quantity_fields($return, $product)

{
return true;
}

/**@ Remove in all product type*/



add_action('add_meta_boxes', 'cd_meta_box_add');



function cd_meta_box_add()

	{

	add_meta_box('my-meta-box-id', 'Page Sub Title', 'cd_meta_box_cb', 'Page', 'normal', 'high');

	}



function cd_meta_box_cb($post)

	{



	// $post is already set, and contains an object: the WordPress post



	global $post;

	$values = get_post_custom($post->ID);

	$text = isset($values['my_meta_box_text']) ? $values['my_meta_box_text'] : '';

	$text2 = isset($values['my_meta_box_text2']) ? $values['my_meta_box_text2'] : '';



	// print_r($text[0]);



	$selected = isset($values['my_meta_box_select']) ? esc_attr($values['my_meta_box_select']) : '';

	$check = isset($values['my_meta_box_check']) ? esc_attr($values['my_meta_box_check']) : '';



	// We'll use this nonce field later on when saving.



	wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');

?>



    <p>



        <label for="my_meta_box_text">Text Label</label>



        <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php

	echo $text[0]; ?>" />



 <input type="text" name="my_meta_box_text2" id="my_meta_box_text2" value="<?php

	echo $text2[0]; ?>" />



    </p>



       <?php

	}



add_action('save_post', 'cd_meta_box_save');



function cd_meta_box_save($post_id)

	{



	// Bail if we're doing an auto save



	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;



	// if our nonce isn't there, or we can't verify it, bail



	if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce')) return;



	// if our current user can't edit this post, bail



	if (!current_user_can('edit_post')) return;



	// now we can actually save the data



	$allowed = array(

		'a' => array( // on allow a tags

			'href' => array() // and those anchors can only have href attribute

		)

	);



	// Make sure your data is set before trying to save it



	if (isset($_POST['my_meta_box_text'])) update_post_meta($post_id, 'my_meta_box_text', wp_kses($_POST['my_meta_box_text'], $allowed));

	if (isset($_POST['my_meta_box_text2'])) update_post_meta($post_id, 'my_meta_box_text2', wp_kses($_POST['my_meta_box_text2'], $allowed));



	// This is purely my personal preference for saving check-boxes



	$chk = isset($_POST['my_meta_box_check']) && $_POST['my_meta_box_select'] ? 'on' : 'off';

	update_post_meta($post_id, 'my_meta_box_check', $chk);

	}



// jass



function add_custom_meta_boxd()

	{

	add_meta_box("demo-meta-box", "Feature Image Name", "custom_meta_box_markupd", "page", "side", "high", null);

	}



add_action("add_meta_boxes", "add_custom_meta_boxd");



function custom_meta_box_markupd($object)

	{

	wp_nonce_field(basename(__FILE__) , "meta-box-nonce");

?>

 <div>

 <label for="meta-box-text">Text</label>

 <input name="meta-box-text" type="text" value="<?php

	echo get_post_meta($object->ID, "meta-box-text", true); ?>">

 </div>

    <?php

	}



function save_custom_meta_boxd($post_id, $post, $update)

	{

	if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__))) return $post_id;

	if (!current_user_can("edit_post", $post_id)) return $post_id;

	if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) return $post_id;

	$slug = "page";

	if ($slug != $post->post_type) return $post_id;

	$meta_box_text_value = "";

	$meta_box_dropdown_value = "";

	$meta_box_checkbox_value = "";

	if (isset($_POST["meta-box-text"]))

		{

		$meta_box_text_value = $_POST["meta-box-text"];

		}



	update_post_meta($post_id, "meta-box-text", $meta_box_text_value);

	if (isset($_POST["meta-box-dropdown"]))

		{

		$meta_box_dropdown_value = $_POST["meta-box-dropdown"];

		}



	update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);

	if (isset($_POST["meta-box-checkbox"]))

		{

		$meta_box_checkbox_value = $_POST["meta-box-checkbox"];

		}



	update_post_meta($post_id, "meta-box-checkbox", $meta_box_checkbox_value);

	}



add_action("save_post", "save_custom_meta_boxd", 10, 3);



function current_customer_month_count($user_id = null)

	{

	if (empty($user_id))

		{

		$user_id = get_current_user_id();

		}



	// Date calculations to limit the query



	$today_year = date('Y');

	$today_month = date('m');

	$day = date('d');

	if ($today_month == '01')

		{

		$month = '12';

		$year = $today_year - 1;

		}

	  else

		{

		$month = $today_month - 1;

		$month = sprintf("%02d", $month);

		$year = $today_year - 1;

		}



	// ORDERS FOR LAST 30 DAYS (Time calculations)



	$now = strtotime('now');



	// Set the gap time (here 30 days)



	$gap_days = 30;

	$gap_days_in_seconds = 60 * 60 * 24 * $gap_days;

	$gap_time = $now - $gap_days_in_seconds;



	// The query arguments



	$args = array(



		// WC orders post type



		'post_type' => 'shop_order',



		// Only orders with status "completed" (others common status: 'wc-on-hold' or 'wc-processing')



		'post_status' => 'wc-completed',



		// all posts



		'numberposts' => - 1,



		// for current user id



		'meta_key' => '_customer_user',

		'meta_value' => $user_id,

		'date_query' => array(



			// orders published on last 30 days



			'relation' => 'OR',

			array(

				'year' => $today_year,

				'month' => $today_month,

			) ,

			array(

				'year' => $year,

				'month' => $month,

			) ,

		) ,

	);



	// Get all customer orders



	$customer_orders = get_posts($args);

	$count = 0;

	if (!empty($customer_orders))

		{

		$customer_orders_date = array();



		// Going through each current customer orders



		foreach($customer_orders as $customer_order)

			{



			// Conveting order dates in seconds



			$customer_order_date = strtotime($customer_order->post_date);



			// Only past 30 days orders



			if ($customer_order_date > $gap_time)

				{

				$customer_order_date;

				$order = new WC_Order($customer_order->ID);

				$order_items = $order->get_items();



				// Going through each current customer items in the order



				foreach($order_items as $order_item)

					{

					$count++;

					}

				}

			}



		return $count;

		}

	}



// hide coupon field on checkout page



function hide_coupon_field_on_checkout($enabled)

	{

	if (is_checkout())

		{

		$enabled = false;

		}



	return $enabled;

	}



add_filter('woocommerce_coupons_enabled', 'hide_coupon_field_on_checkout');



function eg_remove_my_subscriptions_button( $actions, $subscription ) {

	foreach ( $actions as $action_key => $action ) {

		switch ( $action_key ) {

			case 'change_payment_method':	// Hide "Change Payment Method" button?

//			case 'change_address':		// Hide "Change Address" button?

//			case 'switch':			// Hide "Switch Subscription" button?

//			case 'resubscribe':		// Hide "Resubscribe" button from an expired or cancelled subscription?

//			case 'pay':			// Hide "Pay" button on subscriptions that are "on-hold" as they require payment?

//			case 'reactivate':		// Hide "Reactive" button on subscriptions that are "on-hold"?

			case 'cancel':			// Hide "Cancel" button on subscriptions that are "active" or "on-hold"?

			case 'suspend':			// Hide "Cancel" button on subscriptions that are "active" or "on-hold"?

				unset( $actions[ $action_key ] );

				break;

			default: 

				error_log( '-- $action = ' . print_r( $action, true ) );

				break;

		}

	}

	return $actions;

}

//add_filter( 'wcs_view_subscription_actions', 'eg_remove_my_subscriptions_button', 100, 2 );




/* Completed email for Virtual and Downloadable Product */
add_filter( 'woocommerce_payment_complete_order_status', 'virtual_order_payment_complete_order_status_vir', 10, 2 );

 

function virtual_order_payment_complete_order_status_vir( $order_status, $order_id ) {

  $order = new WC_Order( $order_id );

 

  if ( 'processing' == $order_status &&

       ( 'on-hold' == $order->status || 'pending' == $order->status || 'failed' == $order->status ) ) {

 

    $virtual_order = null;

 

    if ( count( $order->get_items() ) > 0 ) {

 

      foreach( $order->get_items() as $item ) {

 

        if ( 'line_item' == $item['type'] ) {

 

          $_product = $order->get_product_from_item( $item );

 

          if ( ! $_product->is_downloadable() ) {

            // once we've found one non-virtual product we know we're done, break out of the loop

            $virtual_order = false;

            break;

          } else {

            $virtual_order = true;

          }

        }

      }

    }

 

    // virtual order, mark as completed

    if ( $virtual_order ) {

      return 'completed';

    }

  }

 

  // non-virtual order, return original status

  return $order_status;

}



add_filter( 'woocommerce_payment_complete_order_status', 'virtual_order_payment_complete_order_status', 10, 2 );

 

function virtual_order_payment_complete_order_status( $order_status, $order_id ) {

  $order = new WC_Order( $order_id );

 

  if ( 'processing' == $order_status &&

       ( 'on-hold' == $order->status || 'pending' == $order->status || 'failed' == $order->status ) ) {

 

    $virtual_order = null;

 

    if ( count( $order->get_items() ) > 0 ) {

 

      foreach( $order->get_items() as $item ) {

 

        if ( 'line_item' == $item['type'] ) {

 

          $_product = $order->get_product_from_item( $item );

 

          if ( ! $_product->is_virtual() ) {

            // once we've found one non-virtual product we know we're done, break out of the loop

            $virtual_order = false;

            break;

          } else {

            $virtual_order = true;

          }

        }

      }

    }

 

    // virtual order, mark as completed

    if ( $virtual_order ) {

      return 'completed';

    }

  }

 

  // non-virtual order, return original status

  return $order_status;

}
/* End of Completed email for Virtual and Downloadable Product */




/* On Product page button text will be ADD TO CART */

add_filter( 'add_to_cart_text', 'woo_custom_single_add_to_cart_text' );

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );

  

function woo_custom_single_add_to_cart_text() {

  

    return __( 'ADD TO CART', 'woocommerce' );

  

}





/**

 * Redirect users after add to cart.

 */

function my_custom_add_to_cart_redirect( $url ) {

	$url = site_url()."/cart/";

	return $url;

}

add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );







/* UK States List */

function  wc_uk_counties_add_counties( $states ) {

    $states['GB'] = array(

	                    'AV' => 'Avon',

	                    'BE' => 'Bedfordshire',

	                    'BK' => 'Berkshire',

	                    'BU' => 'Buckinghamshire',

	                    'CA' => 'Cambridgeshire',

	                    'CH' => 'Cheshire',

	                    'CL' => 'Cleveland',

	                    'CO' => 'Cornwall',

	                    'CD' => 'County Durham',

	                    'CU' => 'Cumbria',

	                    'DE' => 'Derbyshire',

	                    'DV' => 'Devon',

	                    'DO' => 'Dorset',

	                    'ES' => 'East Sussex',

	                    'EX' => 'Essex',

	                    'GL' => 'Gloucestershire',

	                    'HA' => 'Hampshire',

	                    'HE' => 'Herefordshire',

	                    'HT' => 'Hertfordshire',

	                    'IW' => 'Isle of Wight',

	                    'KE' => 'Kent',

	                    'LA' => 'Lancashire',

	                    'LE' => 'Leicestershire',

	                    'LI' => 'Lincolnshire',

	                    'LO' => 'London',

	                    'ME' => 'Merseyside',

	                    'MI' => 'Middlesex',

	                    'NO' => 'Norfolk',

	                    'NH' => 'North Humberside',

	                    'NY' => 'North Yorkshire',

	                    'NS' => 'Northamptonshire',

	                    'NL' => 'Northumberland',

	                    'NT' => 'Nottinghamshire',

	                    'OX' => 'Oxfordshire',

	                    'SH' => 'Shropshire',

	                    'SO' => 'Somerset',

	                    'SM' => 'South Humberside',

	                    'SY' => 'South Yorkshire',

	                    'SF' => 'Staffordshire',

	                    'SU' => 'Suffolk',

	                    'SR' => 'Surrey',

	                    'TW' => 'Tyne and Wear',

	                    'WA' => 'Warwickshire',

	                    'WM' => 'West Midlands',

	                    'WS' => 'West Sussex',

	                    'WY' => 'West Yorkshire',

	                    'WI' => 'Wiltshire',

	                    'WO' => 'Worcestershire',

	                    'ANT' => 'Co. Antrim',

                        'ARM' => 'Co. Armagh',

                        'DOW' => 'Co. Down',

                        'FER' => 'Co. Fermanagh',

                        'LDY' => 'Co. Londonderry',

                        'TYR' => 'Co. Tyrone'

	                   );

    return $states;

}

add_filter( 'woocommerce_states', 'wc_uk_counties_add_counties' );




/* Templates Dropdown In admin*/
function add_custom_meta_boxdj()

{

    add_meta_box("demo-meta-box", "Template", "custom_meta_box_markupdd", "product", "side", "high", null);

}



add_action("add_meta_boxes", "add_custom_meta_boxdj");



function custom_meta_box_markupdd($object)

{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    global $post;
    $meta_element_class = get_post_meta($post->ID, 'Product-template', true);

    ?>

        <div>

            <label for="meta-box-text">Select Template</label>

             <select name="template_svv" id="template_tylez" required>

                <option value="Template1" <?php selected( $meta_element_class, 'Template1' ); ?>>Template1</option>

                <option value="Template2" <?php selected( $meta_element_class, 'Template2' ); ?>>Template2</option>

                <option value="Template3" <?php selected( $meta_element_class, 'Template3' ); ?>>Template3</option>

             </select> 

        </div>

    <?php  

}


function so_save_metaboxtemplate(){ 
    global $post;

    if(isset($_POST["template_svv"])){
    
        $meta_element_class = $_POST['template_svv'];       

        update_post_meta($post->ID, 'Product-template', $meta_element_class);
        
    }

    if(isset($_POST["productz_offer"])){
            
        $meta_productz_offer = $_POST['productz_offer'];       

        update_post_meta($post->ID, '_productz_offer', $meta_productz_offer);
    }
}
add_action('save_post', 'so_save_metaboxtemplate');

/* End of Templates Dropdown In admin*/


/* Speakers Name after Title in Shop page Products*/
function wpse116660_wc_add_2nd_title() {

    ?>

    <div class="2nd-tile">
    	<p style="color: #444;font-size: 16px;">
        	<?php
        	echo get_post_meta(get_the_ID(), "speakers_bio_name", true); ?>
		</p>
    </div>

    <?php

}

add_action( 'woocommerce_after_shop_loop_item_title', 'wpse116660_wc_add_2nd_title', 6 );

/* End of Speakers Name after Title in Shop page Products*/




/* Description Tab Priority*/

add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );

function woo_reorder_tabs( $tabs ) {

	$postid = get_the_ID();

    $key_1_values = get_post_meta( $postid, 'Product-template' );   

	$template_vl = $key_1_values[0];

	if(!($template_vl == "Template3")){

		$tabs['offer-description']['priority'] = 5;			// Reviews first
	}

	return $tabs;

}

/* End of Description Tab Priority*/

/* Product Tabs */

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );

function woo_new_product_tab($tabs)

	{

	// Adds the new tab
	$postid = get_the_ID();

    $key_1_values = get_post_meta( $postid, 'Product-template' );   

	$template_vl = $key_1_values[0];

	if(!($template_vl == "Template3")){

		$tabs['contents_tab'] = array(

			'title' => __('Contents', 'woocommerce') ,

			'priority' => 49,

			'callback' => 'woo_new_product_tab_content_set'

		);

		$tabs['testimonials_tab'] = array(

			'title' => __('Testimonials', 'woocommerce') ,

			'priority' => 50,

			'callback' => 'woo_new_product_tab_content'

		);
    
    $tabs['specialoffer_description'] = array(

			'title' => __('Special Offer', 'woocommerce') ,

			'priority' => 51,

			'callback' => 'woo_new_product_tab_specialoffer_description'

		);

		$tabs['abouts_tab'] = array(

			'title' => __('About', 'woocommerce') ,

			'priority' => 52,

			'callback' => 'woo_new_product_tab_content_about'

		);
	}  
	else{
		$tabs['listen_tab'] = array(

			'title' => __('Listen', 'woocommerce') ,

			'priority' => 22,

			'callback' => 'woo_new_product_tab_listen_set'

		);
		$tabs['abouts_tab'] = array(

			'title' => __('About', 'woocommerce') ,

			'priority' => 33,

			'callback' => 'woo_new_product_tab_content_about'

		);

		$tabs['specialoffer_description'] = array(

			'title' => __('Special Offer', 'woocommerce') ,

			'priority' => 44,

			'callback' => 'woo_new_product_tab_specialoffer_description'

		);

		$tabs['testimonials_tab'] = array(

			'title' => __('Testimonials', 'woocommerce') ,

			'priority' => 55,

			'callback' => 'woo_new_product_tab_content'

		);
		$tabs['purchasereviews_tab'] = array(

			'title' => __('Purchase Interview', 'woocommerce') ,

			'priority' => 77,

			'callback' => 'woo_new_product_tab_purchasereview'

		);
		
	}

	return $tabs;

}


function woo_new_product_tab_content_set(){
	$productID = $_SESSION['pro_id'];
	$the_post = get_post($productID);
	$key_1_values = get_post_meta( $productID, 'Product-template' );  
	$template_vl = $key_1_values[0]; 

	if($template_vl == "Template2"){
		$alfa = apply_filters( 'woocommerce_short_description', $the_post->post_excerpt );

		$newcontent = preg_replace("/<p[^>]*?>/", "<li><p>", $alfa);
		$breaks = array("<br />","<br>","<br/>");  
	    $newcontent = str_ireplace($breaks, "</p></li><li><p>", $newcontent);  
	    $newcontent = str_replace("</p>", "</p></li>", $newcontent);	   
	    echo "<div class='mycontentdata'><ul class='mycstm_contnt'>".$newcontent."</div>";

	    ?>
	    <style type="text/css"> 
	   		 ul.mycstm_contnt li p{
			     font-size: 20px !important;
			     width: 100%;
   				 word-wrap: break-word;
			}	
	    	ul.mycstm_contnt {
			    font-size: 20px;
			    padding-left: 3%;
			    overflow: hidden;
			}
	    	ul.mycstm_contnt li {
			    list-style: inherit;
			    position: relative;			   
			    list-style-type: disc;
			    font-size: 20px;
			}
	    	.mycstm_contnt div {
			    font-size: 20px !important;
			    margin-top: 18px !important;
			}
	    	
	    </style>
    <?php
	}
	else{
		echo $the_excerpt = $the_post->post_excerpt;
	} 

}

function woo_new_product_tab_content()

	{

	// The new tab content

	include_once('template-parts/product_tab_testimonial.php');	   

	}


function woo_new_product_tab_content_about(){
	$productID = $_SESSION['pro_id'];
	?>
	<div class="Speakers_bio">
		
			<?php 
			if(!empty(get_post_meta($productID, 'speakers_image', true)))
			{
			?>
		        <div class="Speakers_image">
		        <img class="header_logo" src="<?php echo get_post_meta($productID, 'speakers_image', true) ?>" height="200" width="200"/>
		        </div>
		    <?php
	    	}
			?>
		<?php
			if(!empty(get_post_meta($productID, 'speakers_bio_name', true)) || !empty(get_post_meta($productID, 'speakers_pbio', true))){
		?>
		<div class="speakers_biotext">
			<input type="hidden" class="speaker_bionametext" value="<?php echo get_post_meta( $productID , "speakers_bio_name", true);?>">
			<h4>
				<?php 
					echo get_post_meta( $productID , "speakers_bio_name", true);
				?>
			</h4>
			<p>
				<?php 
					echo get_post_meta( $productID , "speakers_pbio", true);
				?>
			</p>
		</div>
		<?php
		}
		?>
	</div>
	<style type="text/css">
		.Speakers_bio { width: 100%; overflow: hidden; padding: 1%;border-radius: 7px;}
		.Speakers_bio .Speakers_image {width: 20%;float: left;}
		.Speakers_image .header_logo {border-radius: 5px;box-shadow: 0px 0px 7px;}
		.speakers_biotext {float: left;width: 75%;margin-left: 1%;}
		.speakers_biotext  p {font-family: "source_sans_proregular";color: #000 !important;font-style: italic;}
		.Speakers_bio .speakers_biotext h3,.Speakers_bio .speakers_biotext h4,.Speakers_bio .speakers_biotext h5  {color: hsl(345, 100%, 60%);font-size: 25px;}
		@media only screen and (min-width: 320px) and (max-width: 780px) { 
			.Speakers_bio .Speakers_image {
			    width: 40%;
			    text-align: center;
			    margin: 0 auto;
			    float: none;
			}
			.speakers_biotext {
			    float: left;
			    width: 100%;
			    margin-left: 1%;
			}
			.entry-summary.temp ul.wcsatt-options-product{ }
			.entry-summary.temp ul.wcsatt-options-product .subscription-option {
			    float: left;
			    width: 100%;
			    text-align: left;
			    margin: 0%;
			}
		} 
	</style>
	<?php
	
}

function woo_new_product_tab_listen_set(){
	//echo "Listen tab";
	$productID = get_the_ID();
	?>
	<div class="listen_mainfirst">
		<div class="listen_title" style="color:hsl(345, 100%, 60%) !important;">
		<?php if(!empty(get_the_title($productID))) { ?>
			<h1 style="margin-bottom: 10px;" itemprop="name" class="product_title entry-title"><?php echo get_the_title($productID); ?></h1>
		<?php } ?>
		</div>	
		<div class="spekrs_bioname" style="font-size: 16px;">
			<?php 
			if(!empty(get_post_meta($productID, 'speakers_bio_name', true))){
				echo "with ".$key_1_values = get_post_meta( $productID , "speakers_bio_name", true);
			}
			?>
		</div>
		<div class="listen_mp3audio">
			<br>
			<?php
			$fileData = get_post_meta($productID,'_downloadable_files',true);
			$x = 1;
			if(!empty($fileData)){
				echo '<b>Listen to the interview:</b><br>';
			}

			foreach($fileData  as $key=>$prometa){
				$audio_name = $prometa['name'];
				$audio_url = $prometa['file'];
				?>	
				<div class="audio_mp3listen" style="margin-top: 6px;margin-bottom: 5px;">
				<div class="audio_file" style="display: inline;">
				<audio controls="" style=" width: 100%;" loop="loop"><source src="<?php echo $audio_url; ?>" type="audio/ogg"></source><source src="<?php echo $audio_url; ?>" type="audio/mpeg"></source>Your browser does not support the audio element.</audio>
				</div></div>		
				<br>
				<?php
				$x++;
			}
			?>
			</div>	
		<div itemprop="description" class="description_custom" style="margin-top: 2%;margin-bottom: 2%;">
			
		<?php
		
		$bullet_startimg = get_home_url()."/wp-content/uploads/2017/05/star.png";
		if(!empty(get_post_meta($productID, 'bullet_description1', true))) 
		{?>
			<div class="bullets_set">
					<div class="bullet_img">

						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description1', true);
						    ?>
					  	</p>
					</div>						
				  						
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description2', true))) 
		{?>
			<div class="bullets_set">							
				 	<div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description2', true);
						    ?>
					  	</p>
					</div>							
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description3', true))) 
		{?>
			<div class="bullets_set">						
				<div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description3', true);
						    ?>
					  	</p>
					</div>						
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description4', true))) 
		{?>
			<div class="bullets_set">						
				 <div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description4', true);
						    ?>
					  	</p>
					</div>							
			</div>
		<?php
		} 
		if(!empty(get_post_meta($productID, 'bullet_description5', true))) 
		{?>
			<div class="bullets_set">							
				 <div class="bullet_img">
						<img src="<?php echo $bullet_startimg ?>">
					</div>
					<div class="content_bullets">
						<p><?php
					    	 echo get_post_meta($productID, 'bullet_description5', true);
						    ?>
					  	</p>
					</div>						
			</div>
		<?php
		} 
		?>
		</div>
		<div id="tst_relpro">
			<?php	
			$related = get_post_meta($productID, '_wcrp_related_ids', true);    

		    if($related){
		    	$implode = implode(",",$related);
		   		$querystr = 'select * from hp_posts where ID IN('.$implode.')';
		   		global $wpdb;
			    $page_posts = $wpdb->get_results($querystr, OBJECT);

				$count = count($page_posts);
			
				if($count > 0)
				{
				?>
				<br /> 

				<div id="relpro">
					<div class="tutle_simple_text">
						<b>Related Products:</b>
					</div>
				 	<ul id="assoc_pro" style="font-size: 16px;width: 100%;padding: 0% 0;">
					<?php 
					
				       foreach($page_posts as $row)
				       { 
				    ?> 
						<li><a href="<?php echo get_permalink($row->ID); ?>"> <?php echo $row->post_title; ?></a></li> 

					<?php 
					    }
					?>
					</ul>
				  </div>
					<!-- .summary --> 

					<?php
			    //echo $product->id;
				}

		   }
		   ?>
		</div>		
	</div>
	<div id="listen_tab_reviews">
			<div id="reviews">
				
			</div>
			<script type="text/javascript">
				$("document").ready(function(){
					$("#reviews").contents().appendTo('#listen_tab_reviews #reviews');
					 $('#review_rating_field > label').text('Score :');
				    if ($("#listen_tab_reviews .product-rating").length > 0) {
				        //alert("Hello");
				        setTimeout(function(){
							$("#listen_tab_reviews .product-rating").siblings(".nre").hide();
						}, 500);				        
				    }
				    $("#listen_tab_reviews .product-rating").siblings("#review_form_wrapper").find('#review_rating_field > label').text('Rating :');

				});
			</script>
		</div>
	<style type="text/css">
		.listen_mainfirst {
		    padding-left: 40px;
		    padding-right: 40px;
		}

		.description_custom .bullets_set {
		    width: 65%;
		    overflow: hidden;
		    margin: 0px 0 3px;
		}
		.description_custom .bullets_set  .bullet_img {
		    float: left;
		    overflow: hidden;
		    margin-right: 8px;
		    width: 4.5%;
		}
		.description_custom .bullets_set .bullet_img img {
		    width: 30px;
		    height: 30px;
		}
		.description_custom .bullets_set .content_bullets p{
			margin: 0px 0px 0px 0px;
		}
		.description_custom .bullets_set .content_bullets {
		    float: left;
		    width: 90%;
		}
		#listen_tab_reviews #reviews .nre {
		    text-align: left;
		}
		.listen_mainfirst b {
		    font-size: 15px;
		}

	</style>

<?php
}

function woo_new_product_tab_specialoffer_description(){
	global $post;        
	if(!empty(get_post_meta($post->ID, '_productz_offer', true)))	
	{
		$offer_prctzId = get_post_meta($post->ID, '_productz_offer', true);  
		?>
		<!-- <div id="tab-specialofferzz"></div> -->
		<script type="text/javascript">
			jQuery(document).ready(function($){
				var simple = '<?php echo get_post_permalink($offer_prctzId); ?>'; 

	          					//alert(simple);

	          		$('#tab-specialoffer_description').html('<iframe scrolling="no" style="border:none;height:20800px;"  id="iframeIDz" src= "'+simple+'" width="100%"></iframe>');
               // $('#tab-specialoffer_description').html('<iframe scrolling="no" style="border:none;"  id="iframeIDz" src= "'+simple+'" width="100%" onload="resizeIframe(this)"></iframe>');
	        });
		</script>

		  
	<?php
	}
}

function woo_new_product_tab_purchasereview(){
	//echo "Purchase Interview";
		$productID = get_the_ID();
		global $product;
	?>
		<div class="purchase_portion" style="width: 100%;overflow: hidden;">
			<div class="product-image third_temp">
	  		 	<?php
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
			<div class="summary entry-summary third_temp">
				<div class="listen_title" style="color:hsl(345, 100%, 60%) !important;">
				<?php if(!empty(get_the_title($productID))) { ?>
					
					<h1 style="margin-bottom: 10px;" itemprop="name" class="product_title entry-title"><?php echo get_the_title($productID); ?></h1>
				<?php } ?>
				</div>	
				<div class="spekrs_bioname" style="font-size: 16px;">
					<?php					
					if(!empty(get_post_meta($productID, 'speakers_bio_name', true))){
						echo "with ".$key_1_values = get_post_meta( $productID , "speakers_bio_name", true);
					}
					?>
				</div>
				<div id="tst_relpro">
					<?php	
					$related = get_post_meta($productID, '_wcrp_related_ids', true);    

				    if($related){
				    	$implode = implode(",",$related);
				   		$querystr = 'select * from hp_posts where ID IN('.$implode.')';
				   		global $wpdb;
					    $page_posts = $wpdb->get_results($querystr, OBJECT);

						$count = count($page_posts);
					
						if($count > 0)
						{
						?>
						<br /> 

						<div id="relpro">
							<style type="text/css">
								.summary.third_temp > div:nth-child(3) b:after {
								    content: ":";
								    position: absolute;
								    left: 0;
								     background: transparent;
								    width: 100%;
								}
							</style>
							<div class="tutle_simple_text">
								<b>Related Products:</b>
							</div>
						 	<ul id="assoc_pro" style="font-size: 16px;width: 100%;padding: 0% 0;">
							<?php 
							
						       foreach($page_posts as $row)
						       { 
						    ?> 
								<li><a href="<?php echo get_permalink($row->ID); ?>"> <?php echo $row->post_title; ?></a></li> 

							<?php 
							    }
							?>
							</ul>
						  </div>
							<!-- .summary --> 

							<?php
					    //echo $product->id;
						}

				   }
				   ?>
				</div>
				<?php
				global $post;
			    if( function_exists('get_product') ){
			        $product = get_product( $productID );
			        if( $product->is_type( 'grouped' ) ){
			        	//echo "group";
					}
					else{
						?>
						<div class="add_cart_purchasebtn">
							<form class="cart" method="post" enctype="multipart/form-data">		 	
								<p class="price"><?php echo $product->get_price_html(); ?></p>
								<div id="subcontent_listen"></div>
								<div style="clear:both"></div>
								<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
								<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
								<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
							 	
							 	<input type="hidden" name="add-to-cart" value="<?php echo $productID; ?>">

							 	<button style="margin-top: 0% !important;padding: 1.2% 7% !important;" type="submit" class="single_add_to_cart_button button alt">ADD TO CART</button>
							</form>
							<script type="text/javascript">
								$(document).ready(function(){
									if($(".wcsatt-options-wrapper").length > 0){								
										$(".wcsatt-options-wrapper").contents().appendTo('#subcontent_listen');
									}							
								});
							</script>
						</div>
						<?php
					}
			    }
				?>
				

			</div>

		</div>		
		
	<?php
}

/* End of Product Tabs */


/* Star at Shop products Page */
add_action('woocommerce_after_shop_loop_item', 'my_print_stars' );


function my_print_stars(){

    global $wpdb;

    global $post;

    $count = $wpdb->get_var("

    SELECT COUNT(meta_value) FROM $wpdb->commentmeta

    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID

    WHERE meta_key = 'rating'

    AND comment_post_ID = $post->ID

    AND comment_approved = '1'

    AND meta_value > 0

");



$rating = $wpdb->get_var("

    SELECT SUM(meta_value) FROM $wpdb->commentmeta

    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID

    WHERE meta_key = 'rating'

    AND comment_post_ID = $post->ID

    AND comment_approved = '1'

");



	if ( $count >= 0 ) {

    $average = number_format($rating / $count);

    echo '<div class="starwrappernew" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

    ?>

    <div class="star-rating" title="<?php echo esc_html( $average ); ?> stars out of 5">

			<span style="width:<?php echo esc_attr( ( $average / 5 ) * 100 ); ?>%;">
								<?php printf( __( '<strong itemprop="ratingValue">%d</strong> out of 5', 'woocommerce-product-reviews-pro' ), esc_attr( $average ) ) ; ?>
			</span>

	</div>

	<?php



    echo '</div>';

    }
}

/* End of Star at Shop products Page */


/* By default virtual and downloadable checkbox to be selected in admin */ 
function cs_by_default_checked_options( $product_type_options ) {
    $product_type_options['virtual']['default'] = 'yes';
    $product_type_options['downloadable']['default'] = 'yes';

    return $product_type_options;
}

add_filter( 'product_type_options', 'cs_by_default_checked_options' );
/* End of by default virtual and downloadable checkbox to be selected in admin */


// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );





/*Order Columns */

/*add_filter( 'manage_edit-shop_order_columns', 'show_product_order',15 );
function show_product_order($columns){	
   //add column
   return $columns; 
}


add_action( 'manage_shop_order_posts_custom_column' , 'snv_custom_shop_order_column', 10, 2 );
function snv_custom_shop_order_column( $column ) {
 global $post, $woocommerce, $the_order;

    switch ( $column ) {

        case 'shipping_address' :
          $terms = $the_order->get_items();

          if ( is_array( $terms ) ) {
                foreach($terms as $term)
		        {
		       		 echo $term['name'];

		        }
              } else {
                _e( 'Unable get the products', 'woocommerce' );
        }
        break;
       

    }
}*/


// Move TinyMCE Editor to the bottom
add_action( 'add_meta_boxes', 'action_add_meta_boxes', 0 );
function action_add_meta_boxes() {
global $_wp_post_type_features;
if (isset($_wp_post_type_features['product']['editor']) && $_wp_post_type_features['product']['editor']) {
    unset($_wp_post_type_features['product']['editor']);
    add_meta_box(
        'topcontent_sectionatbottom',
        __('Top Section At Bottom'),
        'inner_custom_box',
        'product', 'normal', 'low'
    );
  }
add_action( 'admin_head', 'action_admin_head'); //white background
}
function action_admin_head() {
?>
<style type="text/css">
   #topcontent_sectionatbottom h2.hndle.ui-sortable-handle {
	    visibility: hidden;
	}
</style>
<?php
}
function inner_custom_box( $post ) {
  echo '<div class="wp-editor-wrap">';
  wp_editor($post->post_content, 'content', array('dfw' => true, 'textarea_rows' => 15, 'tabindex' => 1) );
  echo '</div>';
}
//End of  Move TinyMCE Editor to the bottom


//remove additonal info tab from products
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
 
function woo_remove_product_tabs( $tabs ) {
    global $product;
	
	if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
        unset( $tabs['additional_information'] );   
    }
    return $tabs;
}

/*add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
function woo_rename_tab($tabs) {
$tabs['reviews_tab']['title'] = 'Reviews';
return $tabs;
}
*/  

/* Remove parent name and arrow from group product child title */
function gfl_product_title($title, $product) {

   return $product->post->post_title;;

}

add_filter('woocommerce_product_title', 'gfl_product_title', 10, 2);
/* End of Remove parent name and arrow from group product child title */

add_action( 'woocommerce_email_after_order_table', 'custom_checkout_field_display_admin_order_meta', 10, 1 );

/**
 * Add used coupons to the order edit page
 *
*/
function custom_checkout_field_display_admin_order_meta($order){

    if( $order->get_used_coupons() ) {
    
    	$coupons_count = count( $order->get_used_coupons() );    
       
        ?> 
        <p style="margin: 16px 0 16px;font-size: 16px;color: #505050;margin-bottom: -16px !important;"><strong>Coupon used:</strong>        
        <?php
        $i = 1;
        
        foreach( $order->get_used_coupons() as $coupon) {
	        echo $coupon;
	        if( $i < $coupons_count )
	        	echo ', ';
	        $i++;
        }
        
        echo '</p>';
    }

}

/* Allow single quantity of product in cart */
add_filter ( 'woocommerce_before_cart' , 'allow_single_quantity_in_cart' );
function allow_single_quantity_in_cart() {
        global $woocommerce;

        $cart_contents  =  $woocommerce->cart->get_cart();
        $keys           =  array_keys ( $cart_contents );

        foreach ( $keys as $key ) {
                $woocommerce->cart->set_quantity ( $key, 1, true );
        }
}

/* Admin Dashboard menu Changes */
function add_admin_bar_more_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	
	$site_url = site_url();
	// Add sub menu link "View All Posts"
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id'     => 'order_details',
		'title' => __( 'Orders'),
		'href' => __('"'.$site_url.'"/wp-admin/edit.php?post_type=shop_order'),
	));

	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id'     => 'products_details',
		'title' => __( 'Products'),
		'href' => __('"'.$site_url.'"/wp-admin/edit.php?post_type=product'),
	));

	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id'     => 'offers_details',
		'title' => __( 'Offers'),
		'href' => __('"'.$site_url.'"/wp-admin/edit.php?post_type=dnc-wc-offer'),
	));

	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id'     => 'pages_details',
		'title' => __( 'Pages'),
		'href' => __('"'.$site_url.'"/wp-admin/edit.php?post_type=page'),
	));

}
add_action('admin_bar_menu', 'add_admin_bar_more_link',25);

function remove_admin_bar_links() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
	return;

	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('widgets');
	$wp_admin_bar->remove_menu('menus');
	$wp_admin_bar->remove_menu('simple-history-view-history');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


add_filter( 'woocommerce_checkout_fields' , 'custom_override_state_required' );
function custom_override_state_required( $address_fields ) {
  $wc = WC();
  $country = $wc->customer->get_country();
  if( !(($country == 'US') || ($country == 'CA') || ($country == 'AU')) ){
  	unset($fields['billing']['billing_state']);
     $address_fields['state']['required'] = false;
     ?>
     <script type="text/javascript">     	
     	jQuery("#s2id_billing_state").css('display','none');
     	jQuery("#billing_state_field").css('display','none');     	
     </script>
     <?php
  }
  return $address_fields;
}

?>