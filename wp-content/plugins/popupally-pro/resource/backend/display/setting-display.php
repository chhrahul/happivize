<?php
if (!class_exists('PopupAllyProDisplaySettings')) {
	class PopupAllyProDisplaySettings {
		const LITE_SETTING_KEY_DISPLAY = '_popupally_setting_general';
		const SETTING_KEY_DISPLAY = '_popupally_pro_setting_general';

		private static $default_popup_display_settings = null;
		private static $default_display_settings = null;

		private static $display_setting_template_replace = array('timed-popup-delay', 'scroll-percent', 'scroll-trigger', 'priority', 'open-trigger', 'cookie-duration', 'utm-source', 'fade-in');
		private static $display_setting_template_regular_selection_replace = array('embedded-location', 'select-signup-type-popup', 'select-signup-type-embed', 'select-existing-subscribers-embed', 'select-click-type');
		private static $display_setting_template_popup_selection_replace = array('select-popup-after-popup', 'select-popup-after-embed', 'select-popup-embed-after-embed');
		private static $display_setting_template_checked_replace = array('timed', 'enable-exit-intent-popup', 'scroll', 'click', 'enable-embedded', 'show-all', 'disable-mobile', 'disable-desktop', 'display-regex-filter-checked');
		private static $display_setting_template_embedded_locations = array('none', 'top-page', 'top-page-follow', 'post-start', 'post-end', 'page-end', 'page-end-follow', 'shortcode', 'widget');

		public static function do_activation_actions() {
			delete_transient(self::SETTING_KEY_DISPLAY);

			$display = get_option(self::LITE_SETTING_KEY_DISPLAY);
			if (false === $display) {
				$display = self::get_default_display_setting();
			} else {
				foreach($display as $id => $setting) {
					$display[$id] = wp_parse_args($setting, self::get_default_popup_display_setting($id));
				}
			}
			if (add_option(self::SETTING_KEY_DISPLAY, $display)) {
				set_transient(self::SETTING_KEY_DISPLAY, $display, PopupAllyPro::CACHE_PERIOD);
			}
		}
		public static function do_deactivation_actions() {
			delete_transient(self::SETTING_KEY_DISPLAY);
		}
		public static function show_display_settings() {
			$display = self::get_display_settings();
			$style = PopupAllyProStyleSettings::get_style_settings();

			echo '<h3>Display Settings</h3>';

			foreach ($style as $id => $style_setting) {
				$setting = $display[$id];
				$display_detail = self::generate_individual_display_code($id, $setting, $style_setting);
				echo $display_detail;
			}
		}
		private static $cached_display_settings = null;
		public static function get_display_settings() {
			if (self::$cached_display_settings === null) {
				$display = get_transient(self::SETTING_KEY_DISPLAY);

				if (!is_array($display)) {
					$display = get_option(self::SETTING_KEY_DISPLAY, self::get_default_display_setting());

					set_transient(self::SETTING_KEY_DISPLAY, $display, PopupAllyPro::CACHE_PERIOD);
				}
				if (!is_array($display)) {
					$display = self::get_default_display_setting();
				}
				$style_settings = PopupAllyProStyleSettings::get_style_settings();
				foreach($display as $id => $setting) {
					if (is_int($id)) {
						$display[$id] = self::merge_default_display_settings($id, $setting, $style_settings[$id]);
					}
				}
				self::$cached_display_settings = $display;
			}
			return self::$cached_display_settings;
		}
		private static function get_default_display_setting() {
			if (self::$default_display_settings === null) {
				self::$default_display_settings = array(1 => self::get_default_popup_display_setting(1));
			}
			return self::$default_display_settings;
		}

		public static function get_default_popup_display_setting($id = false) {
			if (self::$default_popup_display_settings === null) {
				self::$default_popup_display_settings = array('timed' => 'false',
					'timed-popup-delay' => -1,
					'enable-exit-intent-popup' => 'false',
					'scroll' => 'false',
					'scroll-percent' => -1,
					'scroll-trigger' => '',
					'click' => 'false',
					'fade-in' => '0',
					'enable-embedded' => 'false',
					'embedded-location' => 'none',
					'select-click-type' => 'link',
					'open-trigger' => '.popup-click-open-trigger-{{num}}, .popup-click-open-trigger-{{num}} *',
					'priority' => 0,
					'show-all' => 'false',
					'include' => array(),
					'exclude' => array(),
					'cookie-duration' => 14,
					'thank-you' => array(),
					'disable-mobile' => 'false',
					'disable-desktop' => 'false',
					'utm-source' => '',
					'is-open' => 'false',
					'display-regex-filter-checked' => 'false',
					'display-regex-filter' => array(),
					'select-signup-type-popup' => 'thank-you',
					'select-popup-after-popup' => '0',
					'select-signup-type-embed' => 'thank-you',
					'select-popup-after-embed' => '0',
					'select-popup-embed-after-embed' => '0',
					'select-existing-subscribers-embed' => 'always',
				);
			}
			if (false === $id) {
				return self::$default_popup_display_settings;
			}
			return PopupAllyProUtilites::customize_parameter_array(self::$default_popup_display_settings, $id);
		}

		public static function merge_default_display_settings($id, $display, $style) {
			if (!isset($display['select-click-type'])) {
				$display['select-click-type'] = 'advanced';
			}
			$display = wp_parse_args($display, self::get_default_popup_display_setting($id));

			// ensure backwards compatibility by converting all arrays to new ones
			$display['include'] = self::convert_array_list($display['include']);
			$display['exclude'] = self::convert_array_list($display['exclude']);
			$display['thank-you'] = self::convert_array_list($display['thank-you']);
			if (isset($style['checked-one-step-optin']) && $style['checked-one-step-optin'] === 'true' && isset($style['one-step-optin-popup'])) {
				$display['select-signup-type-popup'] = $display['select-signup-type-embed'] = 'popup';
				$display['select-popup-after-popup'] = $display['select-popup-after-embed'] = $style['one-step-optin-popup'];
			}
			return $display;
		}
		public static function load_delay_load_settings($input) {
			$result = array();
			$database_display_settings = self::get_display_settings();
			foreach ($input as $id => $setting) {
				if (is_int($id)) {
					if (isset($setting['not-loaded'])) {
						// keep the old database value if not loaded
						if (isset($database_display_settings[$id])) {
							$setting = $database_display_settings[$id];
						}
					}
					$result[$id] = $setting;
				}
			}
			return $result;
		}
		public static function sanitize_display_settings($input) {
			$result = array();
			foreach ($input as $id => $setting) {
				if (is_int($id)) {
					$setting = wp_parse_args($setting, self::get_default_popup_display_setting($id));
					$setting['timed-popup-delay'] = intval($setting['timed-popup-delay']);
					$setting['scroll-percent'] = intval($setting['scroll-percent']);
					$setting['priority'] = intval($setting['priority']);
					$setting['cookie-duration'] = intval($setting['cookie-duration']);

					$parts = explode(',', $setting['utm-source']);
					$parts = array_map('trim', $parts);
					$setting['utm-source'] = implode(',', $parts);

					if (!isset($setting['select-click-type'])) {
						$setting['select-click-type'] = 'advanced';
					}
					if ('link' === $setting['select-click-type']) {
						$setting['open-trigger'] = '[href$="popup-click-open-trigger-' . $id . '"], [href$="popup-click-open-trigger-' . $id . '"] *, [href$="popup-click-open-trigger-' . $id . '/"], [href$="popup-click-open-trigger-' . $id . '/"] *';
					} elseif ('class' === $setting['select-click-type']) {
						$setting['open-trigger'] = '.popup-click-open-trigger-' . $id . ', .popup-click-open-trigger-' . $id . ' *';
					}
					$result[$id] = $setting;
				}
			}
			update_option(self::SETTING_KEY_DISPLAY, $result);
			set_transient(self::SETTING_KEY_DISPLAY, $result, PopupAllyPro::CACHE_PERIOD);
			self::$cached_display_settings = null;	// reset the cached display settings so the database version is retrieve on next "get"
			return $result;
		}
		// <editor-fold defaultstate="collapsed" desc="Template loading">
		private static $cached_display_template_base = null;
		private static function get_display_template_base() {
			if (null === self::$cached_display_template_base) {
				self::$cached_display_template_base = file_get_contents(dirname(__FILE__) . '/setting-display-popup-template.php');
			}
			return self::$cached_display_template_base;
		}
		private static $cached_display_template_wait = null;
		private static function get_display_template_wait() {
			if (null === self::$cached_display_template_wait) {
				self::$cached_display_template_wait = file_get_contents(dirname(__FILE__) . '/setting-display-template-wait.php');
			}
			return self::$cached_display_template_wait;
		}
		private static $cached_display_template_detail_arguments = null;
		public static function get_display_template_detail_arguments() {
			if (null === self::$cached_display_template_detail_arguments) {
				$advanced = PopupAllyProAdvancedSettings::get_advanced_settings();
				$result = array();
				$result['disable'] = file_get_contents(dirname(__FILE__) . '/../../frontend/disable.php');
				$result['page_template'] = $page_template = self::generate_page_template($advanced);
				$result['display_selection_template'] = self::generate_page_post_selection_template($advanced, $page_template);
				$result['display_detail_template'] = file_get_contents(dirname(__FILE__) . '/setting-display-template-details.php');
				$result['host_url'] = esc_attr(get_bloginfo('url'));

				$style_settings = PopupAllyProStyleSettings::get_style_settings();
				$popup_selection_code = '<option s--select-0--d value="0">None</option>';
				foreach ($style_settings as $popup_id => $style_setting) {
					$popup_selection_code .= '<option s--select-' . $popup_id . '--d value="' . $popup_id . '">' . esc_html($popup_id . '. ' . $style_setting['name']) . '</option>';
				}
				$result['popup_selection'] = $popup_selection_code;
				self::$cached_display_template_detail_arguments = $result;
			}
			return self::$cached_display_template_detail_arguments;
		}
		// </editor-fold>

		// <editor-fold defaultstate="collapsed" desc="Page checkbox selection generation">
		/* generate separately because it is also used for Thank You page selection */
		private static function generate_page_template($advanced) {
			if ($advanced['max-page'] < 0) {
				$pages = PopupAllyProSettingShared::get_all_hierarchical_posts('page');
			} else {
				$pages = PopupAllyProSettingShared::get_all_hierarchical_posts('page', $advanced['max-page']);
			}
			return self::generate_page_checkbox_template($pages);
		}
		private static function generate_page_post_selection_template($advanced, $page_template) {
			$categories = get_categories(array('hide_empty' => false));
			$category_template = self::generate_category_template($categories);

			$custom_page_types = get_post_types(array('public' => 'true', 'hierarchical' => true, '_builtin' => false), 'object');
			$custom_page_template = '';
				
			foreach($custom_page_types as $custom_page_type) {
				if ($advanced['max-page'] < 0) {
					$custom_pages = PopupAllyProSettingShared::get_all_hierarchical_posts($custom_page_type->name);
				} else {
					$custom_pages = PopupAllyProSettingShared::get_all_hierarchical_posts($custom_page_type->name, $advanced['max-page']);
				}
				$custom_page_template .= '<div class="selection-tree-container">';
				if (!empty($custom_pages)) {
					$custom_page_template .= '<input type="checkbox" value="closed" class="checkbox-parent-expand" id="expand-{{selection-type}}-{{id}}-all-' . $custom_page_type->name .
					'" /><label for="expand-{{selection-type}}-{{id}}-all-' . $custom_page_type->name .'"></label>';
				}
				$custom_page_template .= '<input type="checkbox" c--all-'. $custom_page_type->name. '--d class="{{selection-type}}-page-{{id}}" id="{{selection-type}}-all-' . $custom_page_type->name . '-{{id}}' .
						'" value="true" name="[{{id}}][{{selection-type}}][all-' . $custom_page_type->name . ']"><label for="{{selection-type}}' .
						'-all-' . $custom_page_type->name . '-{{id}}">All ' . esc_attr($custom_page_type->label) . '</label>';
				$custom_page_template .= '<ul>';
				$custom_page_template .= self::generate_page_checkbox_template($custom_pages);
				$custom_page_template .= '</ul></div>';
			}

			$page_selection_template = file_get_contents(dirname(__FILE__) . '/setting-display-page-selection-template.php');
			$page_selection_template = str_replace('{{page-selection}}', $page_template, $page_selection_template);

			$page_category_selection = str_replace('{{type}}', 'page', $category_template);
			$page_category_selection = str_replace('{{is-post}}', '', $page_category_selection);
			$page_selection_template = str_replace('{{category-page-selection}}', $page_category_selection, $page_selection_template);

			$page_selection_template = str_replace('{{custom-page-selection}}', $custom_page_template, $page_selection_template);

			/* generate post code */
			$posts = PopupAllyProSettingShared::get_all_posts('post', false, $advanced['max-post']);
			$post_template = self::generate_post_checkbox_template($posts);

			$custom_post_types = get_post_types(array('public' => 'true', 'hierarchical' => false, '_builtin' => false), 'object');
			$custom_post_template = '';
			$custom_posts = array();
			foreach($custom_post_types as $custom_post_type) {
				$custom_posts = PopupAllyProSettingShared::get_all_posts($custom_post_type->name, false, $advanced['max-post']);
				$custom_post_template .= '<div class="selection-tree-container">';
				if (!empty($custom_posts)) {
					$custom_post_template .= '<input type="checkbox" value="closed" class="checkbox-parent-expand" id="expand-{{selection-type}}-{{id}}-all-' . $custom_post_type->name .
					'" /><label for="expand-{{selection-type}}-{{id}}-all-' . $custom_post_type->name .'"></label>';
				}
				$custom_post_template .= '<input type="checkbox" c--all-' . $custom_post_type->name . '--d class="{{selection-type}}-post-{{id}}" id="{{selection-type}}' .
						'-all-' . $custom_post_type->name . '-{{id}}" value="true" name="[{{id}}][{{selection-type}}][all-' . $custom_post_type->name . ']' .
						'"><label for="{{selection-type}}-all-' . $custom_post_type->name . '-{{id}}">All ' . esc_attr($custom_post_type->label) . '</label>';
				$custom_post_template .= '<ul>';
				$custom_post_template .= self::generate_post_checkbox_template($custom_posts);
				$custom_post_template .= '</ul></div>';
			}
			$post_selection_template = file_get_contents(dirname(__FILE__) . '/setting-display-post-selection-template.php');
			$post_selection_template = str_replace('{{post-selection}}', $post_template, $post_selection_template);

			$post_category_selection = str_replace('{{type}}', 'post', $category_template);
			$post_category_selection = str_replace('{{is-post}}', 'post-', $post_category_selection);
			$post_selection_template = str_replace('{{category-post-selection}}', $post_category_selection, $post_selection_template);

			$post_selection_template = str_replace('{{custom-post-selection}}', $custom_post_template, $post_selection_template);
			return '<td>' . $page_selection_template . '</td><td>' . $post_selection_template . '</td>';
		}
		// </editor-fold>

		private static function customize_selection_template($template, $selection_type, $setting) {
			$template = str_replace('{{selection-type}}', $selection_type, $template);
			foreach($setting as $selected => $value){
				$template = str_replace('c--' . $selected . '--d', 'checked="checked"', $template);
			}
			return $template;
		}
		private static function generate_individual_display_wait() {
			$display_wait = self::get_display_template_wait();
			$display_wait = str_replace('{{plugin-uri}}', PopupAllyPro::$PLUGIN_URI, $display_wait);
			return $display_wait;
		}
		public static function generate_individual_display_details($id, $display, $style) {
			$templates = self::get_display_template_detail_arguments();
			$disable = $templates['disable'];
			$page_template = $templates['page_template'];
			$display_selection_template = $templates['display_selection_template'];
			$display_detail_template = $templates['display_detail_template'];
			$host_url = $templates['host_url'];

			$display_detail = $display_detail_template;
			foreach(self::$display_setting_template_replace as $replace) {
				$display_detail = str_replace("{{{$replace}}}", esc_attr($display[$replace]), $display_detail);
			}
			foreach(self::$display_setting_template_checked_replace as $replace) {
				if ($display[$replace] === 'true') {
					$display_detail = str_replace("{{{$replace}}}", 'checked="checked"', $display_detail);
				} else {
					$display_detail = str_replace("{{{$replace}}}", '', $display_detail);
				}
			}
			foreach(self::$display_setting_template_regular_selection_replace as $replace) {
				$display_detail = str_replace('s--' . $replace . '--' . $display[$replace]. '--d', 'selected="selected"', $display_detail);
			}
			foreach(self::$display_setting_template_popup_selection_replace as $replace) {
				$popup_selection = $templates['popup_selection'];
				$popup_selection = str_replace('s--select-' . $display[$replace]. '--d', 'selected="selected"', $popup_selection);
				$display_detail = str_replace("{{{$replace}}}", $popup_selection, $display_detail);
			}
			$display_detail = str_replace("{{selected_item_checked}}", $display['is-open'] === 'true'?'checked="checked"':'', $display_detail);
			$display_detail = str_replace("{{name}}", $style['name'], $display_detail);
			$display_detail = str_replace("{{cookie-js}}", esc_attr(str_replace('##cookie_name##', $style['cookie-name'], $disable)), $display_detail);
			$display_detail = str_replace("{{show-thank-you}}", empty($display['thank-you']) ? '' : 'checked="checked"', $display_detail);
			$display_detail = str_replace("{{show-thank-you-hide}}", empty($display['thank-you']) ? 'style="display:none;"' : '', $display_detail);
			$display_detail = str_replace("{{host-url}}", $host_url, $display_detail);

			$has_display_option_selected = 'true' === $display['timed'] || 'true' === $display['enable-exit-intent-popup'] || 'true' === $display['scroll'] ||
					'true' === $display['click'] || 'true' === $display['enable-embedded'];
			if ($has_display_option_selected) {
				$display_detail = str_replace("{{display-page-selection}}", '', $display_detail);
			} else {
				$display_detail = str_replace("{{display-page-selection}}", 'style="display:none;"', $display_detail);
			}

			$display_detail = str_replace("{{thank-you-page-selection}}", self::customize_selection_template($page_template, 'thank-you', $display['thank-you']), $display_detail);

			$display_detail = str_replace('{{include-selection}}', self::customize_selection_template($display_selection_template, 'include', $display['include']), $display_detail);
			$display_detail = str_replace('{{exclude-selection}}', self::customize_selection_template($display_selection_template, 'exclude', $display['exclude']), $display_detail);

			$display_detail = preg_replace('/c--.*?--d/', '', $display_detail);
			$display_detail = preg_replace('/s--.*?--d/', '', $display_detail);

			foreach(self::$display_setting_template_embedded_locations as $location) {
				$display_detail = str_replace("{{embedded-location-" . $location . "}}", ($display['embedded-location'] == $location ? 'selected="selected"' : ''), $display_detail);
			}
			$regex_filter = '';
			$max_regex_id = 0;
			foreach($display['display-regex-filter'] as $row_id => $regex) {
				$regex_filter .= self::generate_regex_filter_row($row_id, $regex);
				$max_regex_id = max($max_regex_id, intval($row_id));
			}
			$display_detail = str_replace("{{regex-filters}}", $regex_filter, $display_detail);
			$display_detail = str_replace("{{display-regex-filter-count}}", $max_regex_id, $display_detail);
			return $display_detail;
		}
		public static function generate_individual_display_code($id, $display, $style, $force_detail_generation = false) {
			$display_detail = self::get_display_template_base();

			$display_detail = str_replace("{{name}}", esc_html($style['name']), $display_detail);
			if ('true' === $display['is-open']) {
				$display_detail = str_replace("{{selected_item_checked}}", 'checked="checked"', $display_detail);
				$display_detail = str_replace("{{selected_item_opened}}", 'popupally-item-opened', $display_detail);
			} else {
				$display_detail = str_replace("{{selected_item_checked}}", '', $display_detail);
				$display_detail = str_replace("{{selected_item_opened}}", '', $display_detail);
			}
			if ($force_detail_generation || 'true' === $display['is-open']) {
				$customization_details = self::generate_individual_display_details($id, $display, $style);
				$display_detail = str_replace('{{display-details}}', $customization_details, $display_detail);
			} else {
				$display_wait = self::generate_individual_display_wait();
				$display_detail = str_replace('{{display-details}}', $display_wait, $display_detail);
			}

			$display_detail = str_replace("{{id}}", $id, $display_detail);
			$display_detail = PopupAllyProSettingShared::replace_all_toggle($display_detail, $display);
			return $display_detail;
		}
		private static function generate_post_checkbox_template($posts) {
			$post_template = '';
			if ($posts) {
				foreach ($posts as $post) {
					$post_template .= '<li><input class="{{selection-type}}-page-checkbox {{selection-type}}-post-{{id}}" c--' . $post->ID . '--d id="{{selection-type}}-{{id}}-' . $post->ID .
							'" type="checkbox" value="true" name="[{{id}}][{{selection-type}}][' . $post->ID . ']"><label for="{{selection-type}}-{{id}}-' . $post->ID . '">' .
							esc_attr($post->post_title) . ' (' . $post->ID . ')</label></li>';
				}
			}
			return $post_template;
		}
		private static function generate_category_template($categories) {
			$category_selection = '';
			foreach ($categories as $category) {
				$category_selection .= '<li><input class="{{selection-type}}-page-checkbox {{selection-type}}-{{type}}-{{id}}" c--category-{{is-post}}' . $category->cat_ID . '--d id="{{selection-type}}-{{id}}-category-{{is-post}}' . $category->cat_ID .
						'" type="checkbox" value="true" name="[{{id}}][{{selection-type}}][category-{{is-post}}' . $category->cat_ID .
						']"><label for="{{selection-type}}-{{id}}-category-{{is-post}}' . $category->cat_ID . '">' . esc_attr($category->name) . '</label></li>';
			}
			return $category_selection;
		}
		private static function generate_page_checkbox_template($pages) {
			$depth = array();
			$page_template = '';
			if ($pages) {
				for ($i = 0; $i < count($pages); ++$i) {
					$page = $pages[$i];
					if (0 == $page->post_parent) {
						if (count($depth) > 0) {
							$page_template .= str_repeat('</ul></li>', count($depth));
							$depth = array();
						}
					} elseif (end($depth) === $page->post_parent) {
					} elseif (in_array($page->post_parent, $depth)) {
						while(end($depth) !== $page->post_parent) {
							array_pop($depth);
							$page_template .= '</ul></li>';
						}
					} else {
						$depth []= $page->post_parent;
						$page_template .= '<ul>';
					}
					$has_child_code = '';
					if ($i + 1 < count($pages)) {
						if ($pages[$i+1]->post_parent === $page->ID) {
							$has_child_code = '<input type="checkbox" value="closed" class="checkbox-parent-expand" id="expand-{{selection-type}}-{{id}}-' . $page->ID .
							'" /><label for="expand-{{selection-type}}-{{id}}-' . $page->ID .'"></label>';
						}
					}
					$page_template .= '<li>' . $has_child_code .
						'<input class="{{selection-type}}-page-checkbox {{selection-type}}-page-{{id}}" c--' . $page->ID . '--d id="{{selection-type}}-{{id}}-' . $page->ID .
							'" type="checkbox" value="true" name="[{{id}}][{{selection-type}}][' . $page->ID . ']"><label for="{{selection-type}}-{{id}}-' . $page->ID . '">' .
							esc_attr($page->post_title) . ' (' . $page->ID . ')</label>';
				}
			}

			if (count($depth) > 0) {
				while(count($depth) > 0) {
					array_pop($depth);
					$page_template .= '</ul></li>';
				}
			} else {
				$page_template .= '</li>';
			}
			return $page_template;
		}
		private static function convert_array_list($list) {
			if (!is_array($list)) {
				return array();
			}
			if (empty($list) || reset($list) === 'true') {
				return $list;
			}
			$result = array();
			foreach($list as $id) {
				$result[$id] = 'true';
			}
			return $result;
		}
		private static $cached_regex_template = null;
		private static function generate_regex_filter_row($row_id, $regex) {
			if (self::$cached_regex_template === null) {
				self::$cached_regex_template = file_get_contents(dirname(__FILE__) . '/setting-display-regex-filter-template.php');
			}
			$code = str_replace('{{row-id}}', $row_id, self::$cached_regex_template);
			$code = str_replace('{{regex}}', esc_html($regex), $code);
			return $code;
		}
		public static function generate_default_regex_filter_row() {
			$code = self::generate_regex_filter_row('--rid--', '/.*/');
			$code = str_replace('{{id}}', '--id--', $code);
			return $code;
		}
	}
}