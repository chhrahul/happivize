<?php
if (!class_exists('PopupAllyProStyleSettings')) {
	class PopupAllyProStyleSettings {
		const SETTING_KEY_STYLE = '_popupally_pro_setting_style';
		const LITE_SETTING_KEY_STYLE = '_popupally_setting_style';
		const SETTING_KEY_NUM_STYLE_SAVED = '_popupally_pro_setting_num_style_saved';

		const SETTING_KEY_STYLE_DEFAULT_PREVIEW = '_popupally_pro_setting_style_default_preview';

		public static $config_style_settings = array('popup-selector', 'embedded-popup-selector', 'popup-class', 'cookie-name', 'close-trigger');

		private static $style_settings_template_replace = array('advanced', 'name', 'html', 'html-embedded', 'css', 'css-top-margin', 'popup-selector', 'popup-class',
			'close-trigger', 'cookie-name', 'sign-up-form-method', 'sign-up-form-action', 'signup-form', 'sign-up-form-valid',
			'information-destination-email-address', 'information-destination-email-subject', 'information-destination-email-thank-you-url',
			'information-destination-email-name-label', 'information-destination-email-lname-label', 'information-destination-email-email-label', 'selected-template');
		private static $style_settings_template_checked_replace = array('sign-up-form-name-is-required', 'sign-up-form-lname-is-required', 'sign-up-form-email-is-required',
																		'information-destination-email-name-is-required', 'information-destination-email-lname-is-required', 'information-destination-email-email-is-required');
		private static $style_setting_template_signup_html = array('form', 'name', 'lname', 'email');

		private static $default_style_settings = null;
		private static $default_popup_style_simple_settings = null;

		public static function do_activation_actions() {
			delete_transient(self::SETTING_KEY_STYLE);
			delete_transient(self::SETTING_KEY_NUM_STYLE_SAVED);
			delete_transient(self::SETTING_KEY_STYLE_DEFAULT_PREVIEW);
			delete_option(self::SETTING_KEY_STYLE_DEFAULT_PREVIEW);

			$lite_style = get_option(self::LITE_SETTING_KEY_STYLE);
			if (false === $lite_style) {
				$style = self::get_default_style_setting();
			} else {
				$style = array();
				foreach($lite_style as $id => $setting) {
					$style[$id] = wp_parse_args($setting, self::get_default_popup_style_setting($id));
					if (isset($setting['text-color'])) {
						$style[$id]['headline-color'] = $style[$id]['sales-text-color'] = $style[$id]['input-box-color'] = $style[$id]['privacy-text-color'] = $setting['text-color'];
					}
				}
				foreach (PopupAllyPro::$available_templates as $template) {
					$template->do_activation_actions($style, $lite_style);
				}
			}
			if (add_option(self::SETTING_KEY_STYLE, $style)) {
				set_transient(self::SETTING_KEY_STYLE, $style, PopupAllyPro::CACHE_PERIOD);
			}

			if (add_option(self::SETTING_KEY_NUM_STYLE_SAVED, 0)) {
				set_transient(self::SETTING_KEY_NUM_STYLE_SAVED, 0, PopupAllyPro::CACHE_PERIOD);
			}
		}
		public static function do_deactivation_actions() {
			delete_transient(self::SETTING_KEY_STYLE);
			delete_transient(self::SETTING_KEY_NUM_STYLE_SAVED);
			delete_transient(self::SETTING_KEY_STYLE_DEFAULT_PREVIEW);
			delete_option(self::SETTING_KEY_STYLE_DEFAULT_PREVIEW);
		}
		private static function get_default_style_setting() {
			if (self::$default_style_settings === null) {
				self::$default_style_settings = array(1 => self::get_initial_popup_style_setting(1));
			}
			return self::$default_style_settings;
		}
		public static function get_initial_popup_style_setting($id) {
			$default_style_settings = self::get_default_popup_style_setting($id);
			$template_uid = $default_style_settings['selected-template'];
			if (strpos($template_uid, 'fluid_') === 0) {
				$selected_template = PopupAllyPro::get_template($template_uid);
				$default_style_settings = wp_parse_args($default_style_settings, $selected_template->default_values);
			}
			return $default_style_settings;
		}
		private static function get_default_popup_style_setting($id = false) {
			if (self::$default_popup_style_simple_settings === null) {
				self::$default_popup_style_simple_settings = array('name' => 'Popup {{num}}',
					'advanced' => 'false',
					'signup-form' => '',
					'sign-up-form-method' => 'post',
					'sign-up-form-action' => '',
					'sign-up-form-valid' => 'false',
					'sign-up-form-name-field' => '',
					'sign-up-form-name-is-required' => 'false',
					'sign-up-form-lname-field' => '',
					'sign-up-form-lname-is-required' => 'false',
					'sign-up-form-email-field' => '',
					'sign-up-form-email-is-required' => 'false',
					'html' => '',
					'html-embedded' => '',
					'css' => '',
					'css-top-margin' => '',
					'selected-template' => 'fluid_zwgsqa',
					'popup-selector' => '#popup-box-pro-gfcr-{{num}}',
					'embedded-popup-selector' => '#popup-embedded-box-pro-gfcr-{{num}}',
					'popup-class' => 'popupally-pro-opened-pro-gfcr-{{num}}',
					'cookie-name' => 'popupally-cookie-{{num}}',
					'close-trigger' => '.popup-click-close-trigger-{{num}}',
					'is-open' => 'false',
					'select-information-destination' => 'form',
					'information-destination-email-address' => '',
					'information-destination-email-subject' => 'Information submitted through PopupAlly Pro!',
					'information-destination-email-thank-you-url' => '',
					'information-destination-email-name-label' => 'Name',
					'information-destination-email-name-is-required' => 'false',
					'information-destination-email-lname-label' => 'Last Name',
					'information-destination-email-lname-is-required' => 'false',
					'information-destination-email-email-label' => 'Email',
					'information-destination-email-email-is-required' => 'false',
					);
			}
			if (false === $id) {
				return self::$default_popup_style_simple_settings;
			}
			return PopupAllyProUtilites::customize_parameter_array(self::$default_popup_style_simple_settings, $id);
		}
		public static function merge_default_style_settings($id, $style) {
			if (isset($style['advanced']) && 'true' !== $style['advanced'] && isset($style['popup-selector'])) {
				unset($style['popup-selector']);
				unset($style['popup-class']);
				unset($style['close-trigger']);
				unset($style['cookie-name']);
			}
			if (!isset($style['sign-up-form-valid'])) {
				if (isset($style['hidden-form-fields-name']) || isset($style['other-form-fields-name'])) {
					$style['sign-up-form-valid'] = 'true';
				} else {
					$style['sign-up-form-valid'] = 'false';
				}
			}
			$template_obj = PopupAllyPro::get_template($style['selected-template']);
			if ($template_obj) {
				$style = $template_obj->make_backwards_compatible($style);
				$style = $template_obj->merge_default_values($style);
			}
			$style = wp_parse_args($style, self::get_default_popup_style_setting($id));
			return $style;
		}
		private static $cached_style_settings = null;
		public static function get_style_settings() {
			if (self::$cached_style_settings === null) {
				$style = get_transient(self::SETTING_KEY_STYLE);

				if (!is_array($style)) {
					$style = get_option(self::SETTING_KEY_STYLE, self::get_default_style_setting());

					set_transient(self::SETTING_KEY_STYLE, $style, PopupAllyPro::CACHE_PERIOD);
				}
				if (!is_array($style)) {
					$style = self::get_default_style_setting();
				}
				// update old setting to new ones
				foreach($style as $id => $setting) {
					if (is_int($id)) {
						$style[$id] = self::merge_default_style_settings($id, $setting);
					}
				}
				self::$cached_style_settings = $style;
			}
			return self::$cached_style_settings;
		}
		private static function generate_signup_html_individual_generated_field($id, $setting, $variable) {
			$generated_field = '';
			$id_prefix = $variable . '-' . $id . '-';
			if (isset($setting[$variable . '-name'])) {
				$prefix = '<input class="sign-up-form-generated-' . $id . '" type="hidden" name="[' . $id . '][';
				foreach($setting[$variable . '-name'] as $field_id => $name) {
					$generated_field .= $prefix . $variable . '-name][' . $field_id . ']" value="' . esc_textarea($name) . '" />';
					$generated_field .= $prefix . $variable . '-value][' . $field_id . ']" value="' . esc_textarea($setting[$variable . '-value'][$field_id]) . '" id="' . 
							esc_attr($id_prefix . $name) . '" />';
				}
			}
			return $generated_field;
		}
		private static function generate_signup_html_individual_generated_scripts($id, $setting, $variable) {
			$generated_field = '';
			if (isset($setting[$variable])) {
				$prefix = '<input class="sign-up-form-generated-' . $id . '" type="hidden" name="[' . $id . '][';
				foreach($setting[$variable] as $field_id => $name) {
					$generated_field .= $prefix . $variable . '][' . $field_id . ']" value="' . esc_attr($name) . '" />';
				}
			}
			return $generated_field;
		}
		private static function generate_signup_html_generated_field($id, $setting) {
			$generated_field = self::generate_signup_html_individual_generated_field($id, $setting, 'other-form-fields');
			$generated_field .= self::generate_signup_html_individual_generated_field($id, $setting, 'hidden-form-fields');
			$generated_field .= self::generate_signup_html_individual_generated_field($id, $setting, 'checkbox-form-fields');
			$generated_field .= self::generate_signup_html_individual_generated_field($id, $setting, 'dropdown-form-fields');
			$generated_field .= self::generate_signup_html_individual_generated_scripts($id, $setting, 'javascript-links');
			return $generated_field;
		}
		private static function generate_information_destination_selection($setting) {
			$selection_code = '<option value="form" ' . ($setting['select-information-destination'] === 'form' ? 'selected="selected"' : '') . '>Email System with Opt-in Form</option>';
			$selection_code .= '<option value="email" ' . ($setting['select-information-destination'] === 'email' ? 'selected="selected"' : '') . '>Send to email Address(es)</option>';
			return $selection_code;
		}
		private static function generate_signup_html_field_selection($setting, $selected_attr) {
			$selection_code = '<option value=""></option>';
			if (isset($setting['other-form-fields-name'])) {
				$selection_code = '<option value=""></option>';
				foreach($setting['other-form-fields-name'] as $field_id => $name) {
					$esc_name = esc_attr($name);
					$selection_code .= '<option value="' . $esc_name . '" '. ($setting[$selected_attr] == $name ? 'selected="selected"' : '') . '>' . $esc_name . '</option>';
				}
			}
			return $selection_code;
		}
		private static function generate_template_selection_code($templates, $selected) {
			$template_selection_code = '';
			foreach ($templates as $template_uid => $template_obj) {
				if ($template_uid === $selected) {
					$template_selection_code .= '<option value="' . $template_uid . '" selected="selected">' . esc_attr($template_obj->template_name) . '</option>';
				} else {
					$template_selection_code .= '<option value="' . $template_uid . '">' . esc_attr($template_obj->template_name) . '</option>';
				}
			}
			return $template_selection_code;
		}
		private static function generate_individual_style_wait() {
			$style_wait = self::get_style_template_wait();
			$style_wait = str_replace('{{plugin-uri}}', PopupAllyPro::$PLUGIN_URI, $style_wait);
			return $style_wait;
		}
		public static function generate_individual_style_customization($id, $setting) {
			$style_detail = self::get_style_template_customization();
			foreach(self::$style_settings_template_replace as $replace) {
				$style_detail = str_replace("{{{$replace}}}", esc_textarea($setting[$replace]), $style_detail);
			}
			foreach(self::$style_settings_template_checked_replace as $replace) {
				if ($setting[$replace] === 'true') {
					$style_detail = str_replace("{{{$replace}}}", 'checked="checked"', $style_detail);
				} else {
					$style_detail = str_replace("{{{$replace}}}", '', $style_detail);
				}
			}

			$generated_fields = self::generate_signup_html_generated_field($id, $setting);
			$style_detail = str_replace("{{generated_fields}}", $generated_fields, $style_detail);
			$style_detail = str_replace("{{form-valid-false-hide}}", empty($generated_fields) ? 'style="display:none"' : '', $style_detail);

			$style_detail = str_replace("{{signup_name_field_selection}}", self::generate_signup_html_field_selection($setting, 'sign-up-form-name-field'), $style_detail);
			$style_detail = str_replace("{{signup_lname_field_selection}}", self::generate_signup_html_field_selection($setting, 'sign-up-form-lname-field'), $style_detail);
			$style_detail = str_replace("{{signup_email_field_selection}}", self::generate_signup_html_field_selection($setting, 'sign-up-form-email-field'), $style_detail);

			$style_detail = str_replace('{{select-information-destination}}', self::generate_information_destination_selection($setting), $style_detail);
			$template_selection_code = '';
			$selected_template_main = $setting['selected-template'];
			$selected_template_obj = PopupAllyPro::get_template($setting['selected-template']);
			if ($selected_template_obj->is_fluid_template()) {
				$selected_template_main = 'iwjdhs';
				$style_detail = str_replace("{{hide-fluid-template-selection}}", '', $style_detail);
			} else {
				$style_detail = str_replace("{{hide-fluid-template-selection}}", 'style="display:none;"', $style_detail);
			}
			$template_selection_code = self::generate_template_selection_code(PopupAllyPro::$available_templates, $selected_template_main);
			$fluid_template_selection_code = self::generate_template_selection_code(PopupAllyProFluidTemplate::$available_fluid_templates, $setting['selected-template']);

			$template_customization_code = '<div class="template-customization-block template-customization-block-active" id="template-customization-block-' . $id . '-' . $selected_template_obj->uid . '">';
			$template_customization_code .= $selected_template_obj->show_style_settings($id, $setting);
			$template_customization_code .= '</div>';

			$style_detail = str_replace("{{template_selection}}", $template_selection_code, $style_detail);
			$style_detail = str_replace("{{fluid_template_selection}}", $fluid_template_selection_code, $style_detail);
			$style_detail = str_replace("{{template_customization}}", $template_customization_code, $style_detail);

			foreach(self::$style_setting_template_signup_html as $type) {
				if (false === $selected_template_obj->style_hide_signup_fields[$type]) {
					$style_detail = str_replace("{{signup-html-template-" . $type . "-initial-hide}}", '', $style_detail);
				} elseif (true === $selected_template_obj->style_hide_signup_fields[$type]) {
					$style_detail = str_replace("{{signup-html-template-" . $type . "-initial-hide}}", 'style="display:none;"', $style_detail);
				} elseif ('true' === $setting[$selected_template_obj->style_hide_signup_fields[$type]]) {
					$style_detail = str_replace("{{signup-html-template-" . $type . "-initial-hide}}", 'style="display:none;"', $style_detail);
				} else {
					$style_detail = str_replace("{{signup-html-template-" . $type . "-initial-hide}}", '', $style_detail);
				}
			}
			return $style_detail;
		}
		public static function generate_individual_style_code($id, $setting, $force_detail_generation = false) {
			$style_detail = self::get_style_template_base();

			$style_detail = str_replace("{{name}}", esc_html($setting['name']), $style_detail);
			if ('true' === $setting['is-open']) {
				$style_detail = str_replace("{{selected_item_checked}}", 'checked="checked"', $style_detail);
				$style_detail = str_replace("{{selected_item_opened}}", 'popupally-item-opened', $style_detail);
			} else {
				$style_detail = str_replace("{{selected_item_checked}}", '', $style_detail);
				$style_detail = str_replace("{{selected_item_opened}}", '', $style_detail);
			}
			if ($force_detail_generation || 'true' === $setting['is-open']) {
				$customization_details = self::generate_individual_style_customization($id, $setting);
				$style_detail = str_replace('{{style-details}}', $customization_details, $style_detail);
			} else {
				$style_wait = self::generate_individual_style_wait();
				$style_detail = str_replace('{{style-details}}', $style_wait, $style_detail);
			}

			$style_detail = str_replace("{{id}}", $id, $style_detail);
			$style_detail = PopupAllyProSettingShared::replace_all_toggle($style_detail, $setting);
			return $style_detail;
		}
		private static $cached_style_template_base = null;
		private static function get_style_template_base() {
			if (null === self::$cached_style_template_base) {
				self::$cached_style_template_base = file_get_contents(dirname(__FILE__) . '/setting-style-popup-template.php');
			}
			return self::$cached_style_template_base;
		}
		private static $cached_style_template_customization = null;
		private static function get_style_template_customization() {
			if (null === self::$cached_style_template_customization) {
				self::$cached_style_template_customization = file_get_contents(dirname(__FILE__) . '/setting-style-popup-details.php');
			}
			return self::$cached_style_template_customization;
		}
		private static $cached_style_template_wait = null;
		private static function get_style_template_wait() {
			if (null === self::$cached_style_template_wait) {
				self::$cached_style_template_wait = file_get_contents(dirname(__FILE__) . '/setting-style-popup-wait.php');
			}
			return self::$cached_style_template_wait;
		}
		public static function show_style_settings() {
			$style = self::get_style_settings();

			echo '<h3>Style Settings</h3>';

			foreach ($style as $id => $setting) {
				echo self::generate_individual_style_code($id, $setting);
			}
		}
		public static function load_delay_load_settings($input) {
			$result = array();
			$database_style_settings = self::get_style_settings();
			foreach ($input as $id => $setting) {
				if (is_int($id)) {
					if (isset($setting['not-loaded'])) {
						// keep the old database value if not loaded
						if (isset($database_style_settings[$id])) {
							$popup_name = $setting['name'];
							$setting = $database_style_settings[$id];
							$setting['name'] = $popup_name;
						}
					}
					$result[$id] = $setting;
				}
			}
			return $result;
		}
		public static function sanitize_style_settings($input) {
			$result = array();
			$database_style_settings = self::get_style_settings();
			foreach ($input as $id => $setting) {
				if (is_int($id)) {
					if (!isset($setting['not-loaded'])) {
						if ('true' !== $setting['advanced']) {
							// only sanitize the style settings for the selected template
							$selected_template_obj = PopupAllyPro::get_template($setting['selected-template']);
							$setting = $selected_template_obj->sanitize_style($setting, $id, true);
							if ($setting['sign-up-form-name-field'] === ':null:') {
								$setting['sign-up-form-name-field'] = '';
							}
							if ($setting['sign-up-form-lname-field'] === ':null:') {
								$setting['sign-up-form-lname-field'] = '';
							}
							if ($setting['sign-up-form-email-field'] === ':null:') {
								$setting['sign-up-form-email-field'] = '';
							}
							if (isset($setting['convert-advanced']) && 'true' === $setting['convert-advanced']) {
								$setting_for_code_generation = wp_parse_args($setting, PopupAllyProStyleSettings::get_default_popup_style_setting($id));
								$setting['html'] = PopupAllyProStyleCodeGeneration::generate_popup_html($id, $setting_for_code_generation, $input);
								$setting['html-embedded'] = PopupAllyProStyleCodeGeneration::generate_popup_html($id, $setting_for_code_generation, $input, 1);
								$setting['css'] = PopupAllyProStyleCodeGeneration::generate_popup_css($id, $setting_for_code_generation, $input);
								$setting['css-top-margin'] = PopupAllyProStyleCodeGeneration::generate_popup_css($id, $setting_for_code_generation, $input, 2);
								$setting['advanced'] = 'true';
							}
						}
					} else {
						// keep the old database value if not loaded
						if (isset($database_style_settings[$id])) {
							$popup_name = $setting['name'];
							$setting = $database_style_settings[$id];
							$setting['name'] = $popup_name;
						}
					}
					$result[$id] = $setting;
				}
			}
			self::increment_num_style_saved();
			update_option(self::SETTING_KEY_STYLE, $result);
			set_transient(self::SETTING_KEY_STYLE, $result, PopupAllyPro::CACHE_PERIOD);
			self::$cached_style_settings = null;	// reset the cached style settings so the database version is retrieve on next "get"
			return $result;
		}

		private static function increment_num_style_saved() {			
			$num_saved = self::get_num_style_saved_settings();
			$num_saved += 1;
			update_option(self::SETTING_KEY_NUM_STYLE_SAVED, $num_saved);
			set_transient(self::SETTING_KEY_NUM_STYLE_SAVED, $num_saved, PopupAllyPro::CACHE_PERIOD);
		}

		public static function get_num_style_saved_settings() {
			$num = get_transient(self::SETTING_KEY_NUM_STYLE_SAVED);

			if (false === $num) {
				$num = get_option(self::SETTING_KEY_NUM_STYLE_SAVED, 0);

				set_transient(self::SETTING_KEY_NUM_STYLE_SAVED, $num, PopupAllyPro::CACHE_PERIOD);
			}
			return $num;
		}

		/* used by external plugin to generate default code */
		public static function generate_default_preview_code() {
			$code = array('version' => PopupAllyPro::VERSION, 'html' => array(), 'css' => array());
			foreach (PopupAllyPro::$available_templates as $template_uid => $template_obj) {
				$code['html'][$template_uid] = $template_obj->generate_default_customization_html();
				$code['css'][$template_uid] = $template_obj->generate_default_preview_css();
			}
			foreach (PopupAllyProFluidTemplate::$available_fluid_templates as $template_uid => $template_obj) {
				$code['html'][$template_uid] = $template_obj->generate_default_customization_html();
				$code['css'][$template_uid] = $template_obj->generate_default_preview_css();
			}
			$code['fluid-element-customization'] = PopupAllyProStyleFluidElementCustomization::generate_default_element_customization_code();
			$code['fluid-element-preview'] = PopupAllyProStyleFluidElementCustomization::generate_default_element_preview_code();
			$code['fluid-css-desktop-customization'] = PopupAllyProStyleFluidCssCustomization::generate_default_css_customization_code(true);
			$code['fluid-css-responsive-customization'] = PopupAllyProStyleFluidCssCustomization::generate_default_css_customization_code(false);
			$code['fluid-responsive-header'] = PopupAllyProFluidTemplate::generate_default_responsive_header();
			$code['display-regex-filter-row'] = PopupAllyProDisplaySettings::generate_default_regex_filter_row();
			$code = PopupAllyProUtilites::remove_newline($code);
			return $code;
		}
	}
}