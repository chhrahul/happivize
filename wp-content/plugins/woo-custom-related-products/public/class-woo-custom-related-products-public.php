<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Custom_Related_Products
 * @subpackage Woo_Custom_Related_Products/public
 * @author     WPCodelibrary <support@wpcodelibrary.com>
 */
class Woo_Custom_Related_Products_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-custom-related-products-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-custom-related-products-public.js', array( 'jquery' ), $this->version, false );

	}
		
		public function wcrp_filter_related_products($args) {
            global $post;
            $related = get_post_meta($post->ID, '_wcrp_related_ids', true);
            if (isset($related) && !empty($related)) { // remove category based filtering
                $args['post__in'] = $related;
            } elseif (get_option('wcrp_empty_behavior') == 'none') { // don't show any products
                $args['post__in'] = array(0);
            }

            return $args;
        }

	
	public function wcrp_paypal_bn_code_filter($paypal_args) {
			$paypal_args['bn'] = 'WPCodelibrary_SP_EC_PRO';
			return $paypal_args;
		}

}
