<?php
/*
 Plugin Name: PopupAlly Pro
 Plugin URI: http://ambitionally.com/popupally-pro/
 Description: Want even more freedom and customization for your popups? PopupAlly Pro adds two new ways to trigger a popup (scroll to open, and click trigger) and a myriad of style customizations (by popular demand, fonts are now customizable, too)! And for developers, you can enjoy absolute control over every aspect of the PopupAlly's appearance in the Advanced Editing Mode.
 Version: 2.1.9
 Author: AmbitionAlly
 Author URI: http://ambitionally.com/
 */

if (!class_exists('PopupAllyPro')) {
	class PopupAllyPro {
		/// CONSTANTS
		const VERSION = '2.1.9';

		const SETTING_KEY_ALL = '_popupally_pro_setting';
		const SETTING_KEY_ENABLED = '_popupally_pro_setting_enabled';
		const SETTING_KEY_CODE = '_popupally_pro_setting_code';
		const SETTING_KEY_COPY_DELETE = '_popupally_pro_setting_copy_delete';	# not used in database
		const SETTING_KEY_LICENSE = '_popupally_pro_setting_license';

		const HELP_URL = 'http://access.ambitionally.com/popupally-pro/video-tutorials/';

		const SCRIPT_FOLDER = 'popupally-pro-scripts';

		// CACHE
		const CACHE_PERIOD = 86400;

		const TEMPLATE_DIRECTORY = 'template';
		private static $template_folders = array('fluid', 'default', 'clean', 'full-width', 'choice', 'big-logo', 'free', 'point', 'ebook', 'video', 'image', 'three-choice');

		public static $PLUGIN_URI = '';
		public static $popupally_pro_enabled = false;
		public static $show_license_tab = true;
		public static $available_templates = array();

		private static $default_license_settings = null;

		// used for parameter parsing
		private static $config_display_settings = array('cookie-duration', 'priority', 'fade-in', 'select-signup-type-popup', 'select-popup-after-popup',
			'select-signup-type-embed', 'select-popup-after-embed', 'select-popup-embed-after-embed', 'select-existing-subscribers-embed',
			'disable-mobile', 'disable-desktop');
		private static $local_cached_to_show_results = false;

		public static function init() {
			self::$PLUGIN_URI = plugin_dir_url(__FILE__);
			self::check_license_status();
			self::initialize_defaults();
			self::add_actions();
			self::add_filters();
			self::load_templates();

			register_activation_hook(__FILE__, array(__CLASS__, 'do_activation_actions'));
			register_deactivation_hook(__FILE__, array(__CLASS__, 'do_deactivation_actions'));
		}
		public static function upgrade_database() {
			/* must be called first because the database version will be updated by the other initialize_defaults calls */
			if (!PopupAllyProSettingShared::is_database_up_to_date()) {
				/* delete unused options */
				delete_option(PopupAllyProStyleSettings::SETTING_KEY_STYLE_DEFAULT_PREVIEW);
				PopupAllyProTrackStatisticsSourceData::create_database_table();

				PopupAllyPro::generate_script_files();

				PopupAllyProSettingShared::update_database_version();

				PopupAllyProUpdater::clean_database();
			}
		}
		public static function initialize_defaults() {
			PopupAllyProStyleFluidUtilities::initialize_defaults();
			PopupAllyProTrackStatisticsSourceData::initialize_defaults();
			PopupAllyProSplitTest::initialize_defaults();
		}

		public static function do_activation_actions() {
			delete_transient(self::SETTING_KEY_ALL);
			delete_option(self::SETTING_KEY_ALL);
			delete_transient(self::SETTING_KEY_CODE);
			delete_option(self::SETTING_KEY_CODE);
			delete_transient(self::SETTING_KEY_LICENSE);
			delete_transient(self::SETTING_KEY_ENABLED);

			PopupAllyProUpdater::do_activation_actions();
			PopupAllyProDisplaySettings::do_activation_actions();
			PopupAllyProStyleSettings::do_activation_actions();
			PopupAllyProTrackStatisticsSourceData::do_activation_actions();
			PopupAllyProTrackStatistics::do_activation_actions();
			PopupAllyProSplitTest::do_activation_actions();
			PopupAllyProAdvancedSettings::do_activation_actions();
		}

		public static function do_deactivation_actions() {
			delete_transient(self::SETTING_KEY_ALL);
			delete_option(self::SETTING_KEY_ALL);
			delete_transient(self::SETTING_KEY_CODE);
			delete_option(self::SETTING_KEY_CODE);
			delete_transient(self::SETTING_KEY_LICENSE);
			delete_transient(self::SETTING_KEY_ENABLED);

			PopupAllyProUpdater::do_deactivation_actions();
			PopupAllyProDisplaySettings::do_deactivation_actions();
			PopupAllyProStyleSettings::do_deactivation_actions();
			PopupAllyProAdvancedSettings::do_deactivation_actions();
			PopupAllyProTrackStatistics::do_deactivation_actions();
			PopupAllyProSplitTest::do_deactivation_actions();
		}

		private static function add_actions() {
			add_action('plugins_loaded', array(__CLASS__, 'upgrade_database'));

			if (is_admin()) {
				add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_administrative_resources'));

				if (self::$popupally_pro_enabled) {
					add_action('add_meta_boxes', array(__CLASS__, 'add_meta_box'));
					add_action('admin_init', array(__CLASS__, 'process_export'));

					PopupAllyProStyleFluidCustomization::add_actions();
					add_action('wp_ajax_popupally_pro_generate_import_code', array(__CLASS__, 'generate_import_code_callback'));
					add_action('wp_ajax_popupally_pro_generate_detail_code', array(__CLASS__, 'generate_detail_code_callback'));
				}

				// add setting menu
				add_action('admin_menu', array(__CLASS__, 'add_menu_pages'));
				add_action('admin_init', array(__CLASS__, 'register_settings'));
			}

			if (self::$popupally_pro_enabled) {
				add_action('widgets_init', array(__CLASS__, 'register_widgets'));
				add_action('template_redirect', array(__CLASS__, 'process_post_actions'), 0);

				add_action('init', array(__CLASS__, 'add_shortcodes'));
				add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_resources'));
				add_action('wp_head', array(__CLASS__, 'add_popup_scripts'), 99);
				add_action('wp_footer', array(__CLASS__, 'add_popup_html'));
				add_action('template_redirect', array(__CLASS__, 'process_popupally_post_actions'), 10);

				PopupAllyProOneStepSubmit::add_actions();
				PopupAllyProTrackStatisticsSourceData::add_actions();
			}
		}

		private static function add_filters() {
			if (self::$popupally_pro_enabled) {
				add_filter('the_content', array(__CLASS__, 'add_form_to_content'));
			}
		}

		public static function register_settings() {
			register_setting('popupally_pro_settings', self::SETTING_KEY_ALL, array(__CLASS__, 'sanitize_settings'));
		}

		public static function enqueue_resources() {
			wp_enqueue_script('jquery');

			$display = PopupAllyProDisplaySettings::get_display_settings();
			$style = PopupAllyProStyleSettings::get_style_settings();
			$utm_mapping = array();
			foreach($display as $id => $setting) {
				$utm_mapping[$style[$id]['cookie-name']] = $setting['utm-source'];
			}
			wp_enqueue_script('popupally-pro-check-source', self::$PLUGIN_URI . 'resource/frontend/check-source.min.js', array('jquery'), self::VERSION);
			wp_localize_script('popupally-pro-check-source', 'popupally_pro_check_source_object', array('utm_mapping' => $utm_mapping));

			$to_show = self::get_popup_to_show();
			$active_split_test_settings = PopupAllyProSplitTest::get_active_split_test_settings();
			$num_saved = PopupAllyProStyleSettings::get_num_style_saved_settings();
			$advanced_setting = PopupAllyProAdvancedSettings::get_advanced_settings();

			$base_script_url = PopupAllyProUtilites::get_script_folder_url();
			$script_prefix = get_current_blog_id() . '-';
			
			$integration_activated = class_exists('ProgressAllySettingLicense') && ProgressAllySettingLicense::$progressally_enabled;
			$split_test_settings = empty($to_show) ? array() : PopupAllyProSplitTest::get_active_split_test_settings();
			if (!empty($to_show) || $integration_activated) {
				$admin_url = admin_url('admin-ajax.php');

				$popup_param = self::generate_popup_parameters($display, $style, $to_show);

				wp_enqueue_script('popupally-pro-code-script', $base_script_url . '/' . $script_prefix . 'popupally-pro-code.js', false, self::VERSION . '.' . $num_saved);
				wp_enqueue_script('popupally-pro-action-script', self::$PLUGIN_URI . 'resource/frontend/popup.min.js', array('jquery', 'popupally-pro-code-script'), self::VERSION);
				wp_localize_script( 'popupally-pro-action-script', 'popupally_pro_action_object',
					array('ajax_url' => $admin_url,
						'submit_nonce' => wp_create_nonce('popupally-pro-one-step-submit'),
						'val_nonce' => wp_create_nonce('popupally-pro-email'),
						'popup_param' => $popup_param,
						'split_test' => $split_test_settings,
						'disable_track' => $advanced_setting['disable-stats-tracking'],
						));

				wp_enqueue_style('popupally-pro-style', $base_script_url . '/' . $script_prefix . 'popupally-pro-style.css', false, self::VERSION . '.' . $num_saved);
				foreach($to_show as $id => $value){
					if (in_array('embedded', $value)) {
						if ('top-page' === $display[$id]['embedded-location'] || 'top-page-follow' === $display[$id]['embedded-location']) {
							if (!isset($active_split_test_settings['active'][$id])) {
								wp_enqueue_style('popupally-pro-style-top-margin-' . $id, $base_script_url . '/' . $script_prefix . 'popupally-pro-top-margin-'. $id . '.css', false, self::VERSION . '.' . $num_saved);
							}
						}
					}
				}
			}
			$ids = self::get_popup_thank_you_to_show();
			if (!empty($ids)){
				foreach($ids as $id) {
					wp_enqueue_script('popupally-pro-thank-you-script-' . $id, $base_script_url . '/' . $script_prefix . 'popupally-pro-thank-you-' . $id . '.js', false, self::VERSION . '.' . $num_saved);
				}
			}
		}

		public static function enqueue_administrative_resources($hook) {
			$admin_url = admin_url('admin-ajax.php');

			wp_enqueue_script('popupally-pro-admin-notice', self::$PLUGIN_URI . 'resource/backend/js/admin-notice.min.js', array('jquery'), self::VERSION);

			wp_localize_script('popupally-pro-admin-notice', 'popupally_pro_admin_notice_data_object',
				array('ajax_url' => $admin_url));

			if (strpos($hook, self::SETTING_KEY_ALL) !== false) {
				wp_enqueue_media();

				wp_enqueue_style('popupally-pro-backend', self::$PLUGIN_URI . 'resource/backend/popupally.css', false, self::VERSION);

				wp_enqueue_script('popupally-pro-backend-default-code', self::$PLUGIN_URI . 'resource/backend/js/popupally-default-code.js', false, self::VERSION);
				wp_enqueue_script('popupally-pro-backend', self::$PLUGIN_URI . 'resource/backend/js/popupally.min.js', array('jquery', 'popupally-pro-backend-default-code'), self::VERSION);
				wp_enqueue_script('popupally-pro-backend-color-picker', self::$PLUGIN_URI . 'resource/backend/jscolor/jscolor.js', array('jquery'), self::VERSION);

				wp_localize_script( 'popupally-pro-backend', 'popupally_pro_data_object',
					array('ajax_url' => $admin_url,
						'update_nonce' => wp_create_nonce('popupally-pro-update-nonce'),
						'plugin_url' => self::$PLUGIN_URI));
			}
		}

		// <editor-fold defaultstate="collapsed" desc="Templates">
		public static function add_template($template) {
			self::$available_templates[$template->uid] = $template;
		}

		public static function get_template($template_uid) {
			if (strpos($template_uid, 'fluid_') === 0) {
				if (isset(PopupAllyProFluidTemplate::$available_fluid_templates[$template_uid])) {
					return PopupAllyProFluidTemplate::$available_fluid_templates[$template_uid];
				}
			} elseif (isset(PopupAllyPro::$available_templates[$template_uid])) {
				return PopupAllyPro::$available_templates[$template_uid];
			}
			return PopupAllyPro::$available_templates['bxsjbi'];
		}
		private static function load_templates() {
			$root = dirname(__FILE__) . '/resource/' .self::TEMPLATE_DIRECTORY;
			foreach (self::$template_folders as $folder) {
				$file = $root . '/' . $folder . '/definition.php';
				include_once($file);
			}
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Shortcodes">
		public static function add_shortcodes() {
			PopupAllyProEmbedShortcode::add_shortcodes();
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Widgets">
		public static function register_widgets() {
			register_widget( 'popupally_pro_embedded_widget' );
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Embedded sign up forms">
		public static function add_form_to_content($content) {
			if (!is_singular()) {
				return $content;
			}
			$to_show = self::get_popup_to_show();
			if (!empty($to_show)) {
				$display = PopupAllyProDisplaySettings::get_display_settings();
				$code = self::get_popup_code();
				foreach($to_show as $id => $popup_types) {
					if (in_array('embedded', $popup_types)) {
						if ('post-start' === $display[$id]['embedded-location']) {
							$content = do_shortcode($code[$id]['embedded_html']) . $content;
						} elseif ('post-end' === $display[$id]['embedded-location']) {
							$content = $content . do_shortcode($code[$id]['embedded_html']);
						}
					}
				}
			}
			return $content;
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Page meta box">
		public static function add_meta_box($post_type) {
			$post_types = array('post', 'page');     //limit meta box to certain post types
			if ( in_array( $post_type, $post_types )) {
				add_meta_box(
					'popupally-pro-display-settings',
					 'PopupAlly Pro Display Settings',
					array( __CLASS__, 'show_post_display_meta_box_content' ),
					$post_type,
					'side',
					'high'
				);
			}
		}

		public static function show_post_display_meta_box_content($post) {
			$to_show = self::get_popup_to_show($post->ID);

			include (dirname(__FILE__) . '/resource/backend/post-display.php');
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Settings">
		public static function add_menu_pages() {
			// Add the top-level admin menu
			$capability = 'manage_options';
			$plugin_page = add_menu_page('PopupAlly Pro Settings', 'PopupAlly Pro', $capability, self::SETTING_KEY_ALL, array(__CLASS__, 'show_popupally_pro_settings'), self::$PLUGIN_URI . 'resource/backend/img/popupally-pro-icon.png');

			if (self::$popupally_pro_enabled) {
				add_action('admin_head-'.$plugin_page, array(__CLASS__, 'add_preview_popup_scripts'));
			}
		}

		public static function show_popupally_pro_settings() {
			if (!current_user_can('manage_options')) {
				wp_die('You do not have sufficient permissions to access this page.');
			}
			self::check_php_version('popupally_pro_settings');
			$setting = self::get_selected_settings();
			include (dirname(__FILE__) . '/resource/backend/setting-all.php');
		}
		public static function show_copy_delete_settings() {
			$style = PopupAllyProStyleSettings::get_style_settings();
			include (dirname(__FILE__) . '/resource/backend/setting-copy-delete.php');
		}

		public static function show_import_export_settings() {
			$style = PopupAllyProStyleSettings::get_style_settings();
			$nonce_download_url = add_query_arg(array('export-popupally-nonce' => wp_create_nonce("popupally-export")), admin_url('admin.php'));
			include (dirname(__FILE__) . '/resource/backend/setting-import-export.php');
		}

		public static function show_license_settings() {
			$license = self::get_license_settings();
			include (dirname(__FILE__) . '/resource/backend/setting-license.php');
		}

		public static function sanitize_settings($input) {
			if (self::$show_license_tab && !isset($input[self::SETTING_KEY_LICENSE])) {
				return $input;
			}
			if (self::$popupally_pro_enabled) {
				if (!isset($input[PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY])) {
					return input;
				}
				$display = PopupAllyProSettingShared::convert_setting_string_to_array($input[PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY]);
				$style = PopupAllyProSettingShared::convert_setting_string_to_array($input[PopupAllyProStyleSettings::SETTING_KEY_STYLE]);
				$copy_delete = PopupAllyProSettingShared::convert_setting_string_to_array($input[self::SETTING_KEY_COPY_DELETE]);
				$advanced = PopupAllyProSettingShared::convert_setting_string_to_array($input[PopupAllyProAdvancedSettings::SETTING_KEY_ADVANCED]);
				$stats_settings = PopupAllyProSettingShared::convert_setting_string_to_array($input[PopupAllyProTrackStatistics::SETTING_KEY_STATS]);
				$split_test_settings = PopupAllyProSettingShared::convert_setting_string_to_array($input[PopupAllyProSplitTest::SETTING_KEY_SPLIT_TEST]);
				$add = PopupAllyProSettingShared::convert_setting_string_to_array($input['add']);
				if (false === $display || false === $style || false === $copy_delete || false === $advanced || false === $add) {
					add_settings_error('popupally_pro_settings', 'settings_updated', 'Setting update failed due to missing settings.', 'error');
					return $input['selected'];
				}
				$display_length = self::get_setting_array_length($display);
				$style_length = self::get_setting_array_length($style);
				$copy_length = self::get_setting_array_length($copy_delete);
				if ($display_length !== $style_length || $style_length !== $copy_length){
					add_settings_error('popupally_pro_settings', 'settings_updated', 'Setting update failed due to mismatching settings.', 'error');
					return $input['selected'];
				}
			}
			if (self::$show_license_tab) {
				$license = PopupAllyProSettingShared::convert_setting_string_to_array($input[self::SETTING_KEY_LICENSE]);
				if (false === $license) {
					add_settings_error('popupally_pro_settings', 'settings_updated', 'Setting update failed!', 'error');
					return $input['selected'];
				}
			}

			if (self::$popupally_pro_enabled) {
				$display = PopupAllyProDisplaySettings::load_delay_load_settings($display);
				$style = PopupAllyProStyleSettings::load_delay_load_settings($style);

				$copy_delete_result = self::sanitize_copy_delete_settings($copy_delete, $add, $display, $style);
				$display = $copy_delete_result['display'];
				$style = $copy_delete_result['style'];

				$display = PopupAllyProDisplaySettings::sanitize_display_settings($display);
				$style = PopupAllyProStyleSettings::sanitize_style_settings($style);

				$advanced = PopupAllyProAdvancedSettings::sanitize_advanced_settings($advanced);
				PopupAllyProTrackStatistics::sanitize_stats_settings($stats_settings);
				PopupAllyProSplitTest::sanitize_split_test_settings($split_test_settings);

				PopupAllyPro::generate_script_files();

				PopupAllyProUtilites::clear_wp_cache();
				set_transient(self::SETTING_KEY_ALL, $input['selected'], self::CACHE_PERIOD);
			}
			if (self::$show_license_tab) {
				self::sanitize_license_settings($license, $input['selected']['selected-tab'] === 'license');
			}
			add_settings_error('popupally_pro_settings', 'settings_updated', 'Settings saved!', 'updated');
			return $input['selected'];
		}
		private static function get_setting_array_length($input){
			$length = 0;
			foreach ($input as $id => &$setting) {
				if (is_int($id)) {
					++$length;
				}
			}
			return $length;
		}
		private static function sanitize_copy_delete_settings($copy_delete, $add, $display, $style) {
			$max_id = max(array_keys($display));
			foreach ($copy_delete as $id => &$setting) {
				if (is_int($id)) {
					if (isset($setting['delete'])) {
						unset($display[$id]);
						unset($style[$id]);
						continue;
					}
					if (isset($setting['copy'])) {
						++$max_id;
						$display[$max_id] = $display[$id];
						$style[$max_id] = $style[$id];
						$style[$max_id]['name'] = $setting['copy-name'];
					}
				}
			}
			if (isset($add['add-new']) && $add['add-new'] === 'true' && isset($add['num-new'])) {
				$num = intval($add['num-new']);
				for ($i = 0; $i < $num; ++$i) {
					++$max_id;
					$display[$max_id] = PopupAllyProDisplaySettings::get_default_popup_display_setting($max_id);
					$style[$max_id] = PopupAllyProStyleSettings::get_initial_popup_style_setting($max_id);
				}
			}
			return array('display' => $display, 'style' => $style);
		}

		private static function sanitize_license_settings($input, $force = false) {
			$input['email'] = trim($input['email']);
			$input['serial'] = trim($input['serial']);
			if ($force || $input['old-email'] !== $input['email'] || $input['old-serial'] != $input['serial']) {
				$input['cname'] = '';
				if (class_exists('WpeCommon') && defined('PWP_NAME')) {
					$input['cname'] = PWP_NAME;
				}
				PopupAllyProUpdater::get_plugin_update(true, $input);
			}
			unset($input['old-email']);
			unset($input['old-serial']);
			update_option(self::SETTING_KEY_LICENSE, $input);
			set_transient(self::SETTING_KEY_LICENSE, $input, self::CACHE_PERIOD);
		}
		
		private static function generate_individual_popup_code($id, $style, $all_style, $full_generation = false) {
			$result = array();

			$advanced_settings = PopupAllyProAdvancedSettings::get_advanced_settings();
			if (isset($advanced_settings['use-important']) && $advanced_settings['use-important'] === 'true') {
				$use_important = ' !important';
			} else {
				$use_important = '';
			}
			$result['html'] =PopupAllyProStyleCodeGeneration::generate_popup_html($id, $style, $all_style, 0);
			$result['embedded_html'] = PopupAllyProStyleCodeGeneration::generate_popup_html($id, $style, $all_style, 1);
			$result['top_margin_css'] = str_replace('{{use-important}}', $use_important, PopupAllyProStyleCodeGeneration::generate_popup_css($id, $style, $all_style, 2));

			if ($full_generation) {
				$result['css'] = str_replace('{{use-important}}', $use_important, PopupAllyProStyleCodeGeneration::generate_popup_css($id, $style, $all_style, 0));
				$result['thank_you'] = self::generate_thank_you_js($style);
			}
			return $result;
		}

		public static function generate_popup_code($full_generation = false) {
			$style = PopupAllyProStyleSettings::get_style_settings();

			$code = array('version' => self::VERSION);
			foreach($style as $id => $style_settings) {
				$code[$id] = self::generate_individual_popup_code($id, $style_settings, $style, $full_generation);
			}
			return $code;
		}

		public static function generate_script_files() {
			$code = self::get_popup_code(true);
			foreach($code as $id => $content) {
				if (is_int($id)) {
					$code[$id]['html'] = do_shortcode($content['html']);
					$code[$id]['embedded_html'] = do_shortcode($content['embedded_html']);
				}
			}
			if (!function_exists('request_filesystem_credentials')) {
				require_once (ABSPATH . '/wp-admin/includes/file.php');
			}
			if (false === ($creds = request_filesystem_credentials('admin.php', '', false, false, null))) {
				add_settings_error('popupally_pro_settings', 'script-file', 'File permission error: cannot write styling file. Please make sure you have write permission to the WordPress install (or add FTP information to wp-config.php).', 'error');
				return true;
			}
			if (!WP_Filesystem($creds)) {
				add_settings_error('popupally_pro_settings', 'script-file-init', 'File permission error: file writing initialization failed. Please make sure you have write permission to the WordPress install (or add FTP information to wp-config.php).', 'error');
				return true;
			}
			global $wp_filesystem;
			$target_dir = PopupAllyProUtilites::get_script_folder_dir();

			if(!$wp_filesystem->is_dir($target_dir)) {
				$wp_filesystem->mkdir($target_dir);
			}
			$css = '';
			$prefix = get_current_blog_id() . '-';
			$html_code = 'var duwhs_popupallypro_html_code_sjhw = ' . PopupAllyProSettingShared::dump_variable_to_javascript_array($code);
			$wp_filesystem->put_contents($target_dir . $prefix . 'popupally-pro-code.js', $html_code, FS_CHMOD_FILE);

			foreach($code as $id => $values){
				if (is_array($values)) {	// do not process the 'version' key
					$css .= $values['css'];
					$wp_filesystem->put_contents($target_dir . $prefix . 'popupally-pro-top-margin-' . $id . '.css', $values['top_margin_css'], FS_CHMOD_FILE);

					$thank_you = 'var exdate = new Date();exdate.setFullYear(exdate.getFullYear() + 10);' . $values['thank_you'];
					$wp_filesystem->put_contents($target_dir . $prefix . 'popupally-pro-thank-you-' . $id . '.js', $thank_you, FS_CHMOD_FILE);
				}
			}
			$wp_filesystem->put_contents($target_dir . $prefix . 'popupally-pro-style.css', $css, FS_CHMOD_FILE);
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Front end">
		public static function add_popup_scripts() {
			$to_show = self::get_popup_to_show();
			if (!empty($to_show)) {
				$code = self::get_popup_code();
				$display = PopupAllyProDisplaySettings::get_display_settings();
				$active_split_test_settings = PopupAllyProSplitTest::get_active_split_test_settings();
				foreach($to_show as $id => $value){
					if (in_array('embedded', $value)) {
						if ('top-page' === $display[$id]['embedded-location'] || 'top-page-follow' === $display[$id]['embedded-location']) {
							if (isset($active_split_test_settings['active'][$id])) {
								echo '<style type="text/css" id="popupallypro-css-top-margin-' . $id . '">';
								echo $code[$id]['top_margin_css'];
								echo '</style>';
							}
						}
					}
				}
			}
		}
		public static function add_preview_popup_scripts() {
			$style_settings = PopupAllyProStyleSettings::get_style_settings();
			echo '<style id="preview-css-fluid-global" type="text/css">';
			include (dirname(__FILE__) . '/resource/backend/style/fluid/style-fluid-preview-global-element-defaults.css');
			echo '</style>';
			foreach($style_settings as $id => $style) {
				echo '<style id="popupally-preview-css-' . $id . '" type="text/css">';
				$template_uid = $style['selected-template'];
				$template_obj = self::get_template($template_uid);
				if ($template_obj) {
					echo PopupAllyProStyleCodeGeneration::generate_popup_css($id, $style, $style_settings, 1, $template_obj);
				}
				echo '</style>';
			}
		}
		public static function generate_popup_parameters($display, $style, $to_show) {
			$params = array();
			$active_split_test_settings = PopupAllyProSplitTest::get_active_split_test_settings();
			foreach ($display as $id => $display_settings) {
				$to_show_settings = false;
				$split_test_id = $id;
				if (isset($to_show[$id])) {
					$to_show_settings = $to_show[$id];
				}
				if (isset($active_split_test_settings['active'][$id])) {
					$split_test_id = 't' . $active_split_test_settings['active'][$id]['test_id'];
				}
				$params[$id] = self::generate_individual_popup_parameters($id, $display_settings, $style[$id], $to_show_settings);
				$params[$id]['test'] = $split_test_id;
			}
			return $params;
		}
		private static function generate_individual_popup_parameters($id, $display, $style, $popup_types = false) {
			$param = array('id' => $id);
			if (false !== $popup_types) {
				foreach($popup_types as $type) {
					switch($type) {
						case 'timed':
							$param['timed-popup-delay'] = $display['timed-popup-delay'];
							break;
						case 'exit-intent':
							$param['enable-exit-intent-popup'] = $display['enable-exit-intent-popup'];
							break;
						case 'scroll':
							$param['enable-scroll-popup'] = $display['scroll'];
							$param['scroll-percent'] = $display['scroll-percent'];
							$param['scroll-trigger'] = $display['scroll-trigger'];
							break;
						case 'click':
							$param['open-trigger'] = $display['open-trigger'];
							break;
					}
				}
			}
			$param = PopupAllyProUtilites::extract_array_values($display, self::$config_display_settings, $param);
			$param = PopupAllyProUtilites::extract_array_values($style, PopupAllyProStyleSettings::$config_style_settings, $param);
			return $param;
		}
		public static function add_popup_html() {
			$to_show = self::get_popup_to_show();
			if (!empty($to_show)) {
				$display = PopupAllyProDisplaySettings::get_display_settings();
				$code = self::get_popup_code();
				foreach($to_show as $id => $popup_types) {
					if (in_array('embedded', $popup_types)) {
						if ('page-end' === $display[$id]['embedded-location']) {
							echo do_shortcode($code[$id]['embedded_html']);
						} elseif ('top-page' === $display[$id]['embedded-location']) {
							$temp = str_replace('class-placeholder-jehjsq', 'popupally-pro-top-page-jehjsq', $code[$id]['embedded_html']);
							$temp = str_replace('role-placeholder-kjdshe', 'role="navigation"', $temp);
							echo do_shortcode($temp);
						} elseif ('top-page-follow' === $display[$id]['embedded-location']) {
							$temp = str_replace('class-placeholder-jehjsq', 'popupally-pro-top-page-follow-jehjsq', $code[$id]['embedded_html']);
							$temp = str_replace('role-placeholder-kjdshe', 'role="navigation"', $temp);
							echo do_shortcode($temp);
						} elseif ('page-end-follow' === $display[$id]['embedded-location']) {
							$temp = str_replace('class-placeholder-jehjsq', 'popupally-pro-end-page-follow-jehjsq', $code[$id]['embedded_html']);
							echo do_shortcode($temp);
						}
					}
				}

				$dependencies = self::get_popup_dependencies($to_show, $display);
				foreach($dependencies as $id) {
					if (isset($display[$id])) {
						echo do_shortcode($code[$id]['html']);
					}
				}
			}
		}

		private static function generate_thank_you_js($style) {
			return 'document.cookie = "' . $style['cookie-name'] . '=disable; path=/; expires="+ exdate.toGMTString();';
		}

		public static function get_popup_thank_you_to_show($post_id = false) {
			if ($post_id === false) {
				global $wp_query;
				if (isset($wp_query) && isset($wp_query->post)) {
					$post_id = $wp_query->post->ID;
				} else {
					return array();
				}
			}
			$cookies = array();
			$display = PopupAllyProDisplaySettings::get_display_settings();
			foreach ($display as $id => $settings) {
				if ((isset($settings['timed']) && 'true' === $settings['timed']) ||
						(isset($settings['enable-exit-intent-popup']) && 'true' === $settings['enable-exit-intent-popup']) ||
						(isset($settings['scroll']) && 'true' === $settings['scroll']) ||
						(isset($settings['click']) && 'true' === $settings['click'])) {
					if (isset($settings['thank-you'][$post_id])) {
						$cookies []= $id;
					}
				}
			}
			return $cookies;
		}

		private static function get_post_categories($post_id) {
			$post_categories = wp_get_post_categories($post_id);
			$categories = array();
			foreach($post_categories as $c){
				$cat = get_category($c);
				$categories[$cat->cat_ID] = $cat->slug;
			}
			return $categories;
		}
		private static function check_post_selection($current_page_attribute, $selection) {
			$post_id = $current_page_attribute['post_id'];
			$is_front_page = $current_page_attribute['is_front_page'];
			$is_blog_index = $current_page_attribute['is_blog_index'];
			$is_404 = $current_page_attribute['is_404'];
			$category_id = $current_page_attribute['category_id'];
			$post_type = $current_page_attribute['post_type'];
			$categories = $current_page_attribute['categories'];

			if ('page' === $post_type && isset($selection['all-pages'])) {
				return true;
			}
			if ('post' === $post_type && isset($selection['all-posts'])) {
				return true;
			}
			if (false !== $post_id) {
				if (isset($selection['all-'.$post_type])) {
					return true;
				}
				if (isset($selection[$post_id])) {
					return true;
				}
				foreach($categories as $id => $slug) {
					if (isset($selection['category-post-' . $id])) {
						return true;
					}
				}
			} elseif ($is_front_page && isset($selection['front-page'])) {
				return true;
			} elseif ($is_blog_index && isset($selection['blog-index'])) {
				return true;
			} elseif ($is_404 && isset($selection['404-page'])) {
				return true;
			} elseif ($category_id >= 0 && isset($selection['category-' . $category_id])) {
				return true;
			}
			return false;
		}
		private static function get_popup_dependencies($to_show, $display_settings) {
			$style = PopupAllyProStyleSettings::get_style_settings();
			$active_split_test_settings = PopupAllyProSplitTest::get_active_split_test_settings();
			$dependencies = array();
			foreach($to_show as $id => $popup_types) {
				$dependencies = self::get_popup_dependency($display_settings, $style, $dependencies, $id, $active_split_test_settings);
			}
			return $dependencies;
		}
		private static function get_popup_dependency($display_settings, $style, $dependencies, $to_include, $active_split_test_settings) {
			if (isset($display_settings[$to_include]) && isset($style[$to_include])) {
				if (!in_array($to_include, $dependencies)) {
					$dependencies []= $to_include;
					$template_obj = self::get_template($style[$to_include]['selected-template']);
					if ($template_obj) {
						$dependency = $template_obj->get_popup_dependency($display_settings[$to_include], $style[$to_include]);
						if (false !== $dependency) {
							foreach($dependency as $id) {
								$dependencies = self::get_popup_dependency($display_settings, $style, $dependencies, $id, $active_split_test_settings);
							}
						}
					}
					if (isset($active_split_test_settings['active'][$to_include])) {
						foreach ($active_split_test_settings['active'][$to_include]['weights'] as $variate_popup_id => $weights) {
							$dependencies = self::get_popup_dependency($display_settings, $style, $dependencies, $variate_popup_id, $active_split_test_settings);
						}
					}
				}
			}
			return $dependencies;
		}
		private static function generate_current_page_attribute($post_id, $retrieve_default) {
			$result = array('is_front_page' => false, 'is_blog_index' => false, 'is_404' => false, 'category_id' => -1, 'categories' => array(), 'post_type' => '', 'post_id' => $post_id);
			if (is_front_page()) {
				$result['is_front_page'] = true;
				$result['post_type'] = 'page';
			} elseif ($post_id === false) {
				global $wp_query;
				if (!isset($wp_query)) {
					if ($retrieve_default) {
						self::$local_cached_to_show_results = array();
					}
					return false;
				}
				if ($wp_query->is_posts_page) {
					$result['is_blog_index'] = true;
					$result['post_type'] = 'page';
				} elseif ($wp_query->is_category) {
					$result['category_id'] = $wp_query->queried_object_id;
					$result['post_type'] = 'page';
				} elseif ($wp_query->is_404) {
					$result['is_404'] = true;
					$result['post_type'] = 'page';
				} elseif (isset($wp_query->post)) {
					$result['post_id'] = $post_id = $wp_query->post->ID;
					$result['post_type'] = $wp_query->post->post_type;
					$result['categories'] = self::get_post_categories($post_id);
				} else {
					if ($retrieve_default) {
						self::$local_cached_to_show_results = array();
					}
					return false;
				}
			} else {
				$post = get_post($post_id);
				if (null === $post) {
					if ($retrieve_default) {
						self::$local_cached_to_show_results = array();
					}
					return false;
				}
				$result['post_type'] = $post->post_type;
				$result['categories'] = self::get_post_categories($post_id);
			}
			return $result;
		}
		public static function get_popup_to_show($post_id = false) {
			$retrieve_default = false === $post_id;
			if ($retrieve_default && false !== self::$local_cached_to_show_results) {
				return self::$local_cached_to_show_results;
			}

			$current_page_attribute = self::generate_current_page_attribute($post_id, $retrieve_default);
			if (!$current_page_attribute) {
				return array();
			}
			$post_id = $current_page_attribute['post_id'];

			$result = array();
			$display = PopupAllyProDisplaySettings::get_display_settings();
			$active_split_test_settings = PopupAllyProSplitTest::get_active_split_test_settings();
			foreach ($display as $id => $settings) {
				if (isset($active_split_test_settings['variates'][$id])) {
					continue;
				}
				if (false !== $post_id && isset($settings['thank-you'][$post_id])) {
					continue;
				}
				$to_show = false;
				if ($retrieve_default && 'true' === $settings['display-regex-filter-checked']) {
					foreach ($settings['display-regex-filter'] as $row_id => $regex) {
						if (!empty($regex)) {
							if (preg_match($regex, $_SERVER['REQUEST_URI'])) {
								$to_show = true;
								break;
							}
						}
					}
				} else {
					if (isset($settings['show-all']) && 'true' === $settings['show-all']) {	// exclude path
						$to_show = !self::check_post_selection($current_page_attribute, $settings['exclude']);
					} else {	// include path
						$to_show = self::check_post_selection($current_page_attribute, $settings['include']);
					}
				}
				if (!$to_show) {
					continue;
				}
				$row = array();
				if ('true' === $settings['click']) {
					$row []= 'click';
				}
				if ('true' === $settings['timed'] && $settings['timed-popup-delay'] >= 0) {
					$row []= 'timed';
				}
				if ('true' === $settings['enable-exit-intent-popup']) {
					$row []= 'exit-intent';
				}
				if ('true' === $settings['scroll']) {
					$row []= 'scroll';
				}
				if ('true' === $settings['enable-embedded']) {
					$row []= 'embedded';
				}
				if (!empty($row)) {
					$result[$id] = $row;
				}
			}
			if ($retrieve_default) {
				self::$local_cached_to_show_results = $result;
			}
			return $result;
		}
		public static function process_popupally_post_actions() {
			PopupAllyProSendEmailOperation::process_send_email_event();
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Export and import">
		public static function process_export() {
			if (isset($_REQUEST['id']) && isset($_REQUEST['export-popupally-nonce']) && wp_verify_nonce($_REQUEST['export-popupally-nonce'], "popupally-export")) {
				$id = intval($_REQUEST['id']);
				set_time_limit(0);
				$display = PopupAllyProDisplaySettings::get_display_settings();
				$style = PopupAllyProStyleSettings::get_style_settings();
				$filename = "$id - " . $style[$id]['name'] . ".popupally";

				header('Content-Type: text/csv');
				header(sprintf('Content-Disposition: attachment; filename="%s"', $filename));

				$result = array('display' => $display[$id], 'style' => $style[$id]);
				echo json_encode(self::replace_json_safe_string($result));
				exit;
			}
			PopupAllyProTrackStatisticsSourceData::process_export();
			PopupAllyProSplitTest::process_export();
		}
		public static function process_post_actions() {
			PopupAllyProUpdater::process_retrieve_data();
		}
		public static function generate_import_code_callback() {
			$nonce = $_POST['nonce'];

			if (!wp_verify_nonce( $nonce, 'popupally-pro-update-nonce')) {
				echo json_encode(array('error' => 'Setting page is outdated/not valid'));
			}
			try{
				$setting_string = $_POST['setting'];
				$setting_string = urldecode($setting_string);
				$setting_string = str_replace("\\'", "'", $setting_string);

				$result = json_decode($setting_string, true);
				if (json_last_error()) {
					throw new Exception("Invalid .popupally file. Please make sure the file was not modified after exporting from PopupAlly Pro.");
				}
				$id = $_POST['id'];
				$display = PopupAllyProDisplaySettings::merge_default_display_settings($id, $result['display'], $result['style']);
				$style = PopupAllyProStyleSettings::merge_default_style_settings($id, $result['style']);

				$display['is-open'] = 'false';
				$style['is-open'] = 'false';

				$display_code = PopupAllyProDisplaySettings::generate_individual_display_code($id, $display, $style, true);

				$style_code = PopupAllyProStyleSettings::generate_individual_style_code($id, $style, true);

				$css_code = '<style id="popupally-preview-css-' . $id . '" type="text/css">' .
						PopupAllyProStyleCodeGeneration::generate_popup_css($id, $style, array($id => $style), 1) . '</style>';
				echo json_encode(array('display' => $display_code, 'style' => $style_code, 'css' => $css_code));
			} catch (Exception $e) {
				echo json_encode(array('error' => $e->getMessage()));
			}
			die();
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Generate Display and Style details on open">
		public static function generate_detail_code_callback() {
			$nonce = $_POST['nonce'];

			if (!wp_verify_nonce( $nonce, 'popupally-pro-update-nonce')) {
				echo json_encode(array('error' => 'Setting page is outdated/not valid'));
			}
			try{
				$id = $_POST['id'];

				$style_settings = PopupAllyProStyleSettings::get_style_settings();
				if (!isset($style_settings[$id])) {
					throw new Exception('Popup #' . $id . ' no longer exists.');
				}
				$style_settings[$id]['is-open'] = 'true';
				$style_code = PopupAllyProStyleSettings::generate_individual_style_customization($id, $style_settings[$id]);
				$style_code = str_replace("{{id}}", $id, $style_code);
				$style_code = PopupAllyProSettingShared::replace_all_toggle($style_code, $style_settings[$id]);

				$display_settings = PopupAllyProDisplaySettings::get_display_settings();
				if (!isset($display_settings[$id])) {
					throw new Exception('Popup #' . $id . ' no longer exists.');
				}
				$display_settings[$id]['is-open'] = 'true';
				$display_code = PopupAllyProDisplaySettings::generate_individual_display_details($id, $display_settings[$id], $style_settings[$id]);
				$display_code = str_replace("{{id}}", $id, $display_code);
				$display_code = PopupAllyProSettingShared::replace_all_toggle($display_code, $display_settings[$id]);

				echo json_encode(array('display' => $display_code, 'style' => $style_code));
			} catch (Exception $e) {
				echo json_encode(array('error' => $e->getMessage()));
			}
			die();
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="License checking">
		private static function check_license_status() {
			$enabled = self::get_enable_setting();
			if (!is_array($enabled)) {
				PopupAllyProUpdater::get_plugin_update(true);
				$enabled = self::get_enable_setting();
			}
			if (!is_array($enabled)) {
				self::$popupally_pro_enabled = false;
			} else {
				self::$popupally_pro_enabled = $enabled['enabled'];
			}
			
			$license = self::get_license_settings();
			if (self::$popupally_pro_enabled && empty($license['serial'])) {
				self::$show_license_tab = false;	// hosting site
			} else {
				self::$show_license_tab = true;
			}
		}

		private static function get_enable_setting() {
			$enabled = get_transient(self::SETTING_KEY_ENABLED);

			if (!is_array($enabled)) {
				$enabled = get_option(self::SETTING_KEY_ENABLED, false);

				set_transient(self::SETTING_KEY_ENABLED, $enabled, self::CACHE_PERIOD);
			}
			return $enabled;
		}

		public static function set_enable_setting($is_enabled = false) {
			$enabled = array('enabled' => $is_enabled);
			update_option(self::SETTING_KEY_ENABLED, $enabled);
			set_transient(self::SETTING_KEY_ENABLED, $enabled, self::CACHE_PERIOD);
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Utlities">
		private static function replace_json_safe_string($param) {
			foreach ($param as $key => $value) {
				if (is_string($value)) {
					$value = str_replace('&quot;', '"', $value);
					$value = str_replace('&#039;', "'", $value);
					$value = str_replace('&lt;', '<', $value);
					$value = str_replace('&gt;', '>', $value);
					$value = str_replace('&amp;', '&', $value);
					$param[$key] = $value;
				}
			}
			return $param;
		}

		public static function get_license_settings() {
			$license = get_transient(self::SETTING_KEY_LICENSE);

			if (!is_array($license)) {
				$license = get_option(self::SETTING_KEY_LICENSE, self::get_default_license_setting());

				set_transient(self::SETTING_KEY_LICENSE, $license, self::CACHE_PERIOD);
			}
			$license = wp_parse_args($license, self::get_default_license_setting());
			$license['email'] = trim($license['email']);
			$license['serial'] = trim($license['serial']);
			return $license;
		}

		public static function get_selected_settings() {
			$selected = get_transient(self::SETTING_KEY_ALL);

			if (!is_array($selected)) {
				$selected = get_option(self::SETTING_KEY_ALL, array('selected-tab' => 'display'));

				set_transient(self::SETTING_KEY_ALL, $selected, self::CACHE_PERIOD);
			}
			if (!is_array($selected) || empty($selected['selected-tab'])) {
				$selected = array('selected-tab' => 'display');
			}
			if (!self::$show_license_tab && $selected['selected-tab'] === 'license') {
				$selected['selected-tab'] = 'display';
			}
			return $selected;
		}

		public static function get_popup_code($full_regeneration = false) {
			if ($full_regeneration) {
				$code = self::generate_popup_code($full_regeneration);
				update_option(self::SETTING_KEY_CODE, $code);
				set_transient(self::SETTING_KEY_CODE, $code, self::CACHE_PERIOD);
				return $code;
			}
			$code = get_transient(self::SETTING_KEY_CODE);

			if (!is_array($code) || !isset($code['version']) || $code['version'] !== self::VERSION) {
				$code = get_option(self::SETTING_KEY_CODE, 0);
				if (!is_array($code) || !isset($code['version']) || $code['version'] !== self::VERSION) {
					$code = self::generate_popup_code();
					update_option(self::SETTING_KEY_CODE, $code);
				}
				set_transient(self::SETTING_KEY_CODE, $code, PopupAllyPro::CACHE_PERIOD);
			}
			return $code;
		}

		private static function get_default_license_setting() {
			if (self::$default_license_settings === null) {
				self::$default_license_settings = array('email' => '', 'serial' => '');
			}
			return self::$default_license_settings;
		}

		private static function check_php_version($setting = false) {
			if (!defined('PHP_VERSION_ID')) {
				$version = explode('.', PHP_VERSION);
				define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
			}
			if (PHP_VERSION_ID < 50300) {
				$message = 'The server is currently running PHP Version ' . PHP_VERSION . '. PopupAlly Pro needs at least PHP 5.3 to function properly. Please ask your host to upgrade.';
				if (false !== $setting) {
					add_settings_error($setting, 'php_version_error', $message, 'error');
				} else {
					return $message;
				}
			}
			return false;
		}
		// </editor-fold>
	}
	require_once(plugin_dir_path(__FILE__) . '/resource/popup-ally-pro-template.php');
	require_once('resource/backend/setting-shared.php');
	require_once('resource/popupally-pro-widgets.php');
	require_once('resource/utility-functions.php');
	require_once('resource/backend/style/fluid/style-fluid-utilities.php');
	require_once('resource/backend/style/fluid/style-fluid-customization.php');
	require_once('resource/backend/style/fluid/css-customization/style-fluid-css-customzation.php');
	require_once('resource/backend/style/fluid/element-customization/style-fluid-element-customization.php');
	require_once('resource/backend/display/setting-display.php');
	require_once('resource/backend/style/setting-style.php');
	require_once('resource/backend/style/setting-style-code-generation.php');
	require_once('resource/backend/advanced-settings/setting-advanced.php');
	require_once('resource/backend/send-email/send-email-operation.php');
	require_once('resource/backend/operation/one-step-submit.php');
	require_once('resource/backend/stats/track-statistics.php');
	require_once('resource/backend/stats/track-statistics-source-data.php');
	require_once('resource/backend/split/split-test.php');
	require_once('resource/frontend/shortcode/embed-shortcode.php');
	require_once('resource/popupally-pro-utilities.php');
	require_once('popupally-pro-api.php');
	require_once('updater.php');
	PopupAllyPro::init();
}
