<?php
if (!class_exists('PopupAllyProStyleFluidCustomization')) {
	class PopupAllyProStyleFluidCustomization {
		private static $cached_customization_section_template = null;
		private static $cached_customization_section_responsive_template = null;
		private static $cached_preview_template = null;

		private static $cached_frontend_template = null;
		private static $cached_frontend_embedded_template = null;
		private static $cached_frontend_css = null;

		public static function add_actions() {
			add_action( 'wp_ajax_popupally_pro_generate_fluid_customization_code', array(__CLASS__, 'generate_responsive_customization_code_callback'));
		}

		public static function generate_responsive_customization_code_callback() {
			$nonce = $_POST['nonce'];

			if (!wp_verify_nonce( $nonce, 'popupally-pro-update-nonce')) {
				echo json_encode(array('error' => 'Setting page is outdated/not valid'));
			}
			try{
				$setting_string = $_POST['setting'];
				$setting_string = urldecode($setting_string);
				$setting_string = str_replace("\\'", "'", $setting_string);
				$style = PopupAllyProSettingShared::convert_setting_string_to_array($setting_string);
				$id = $_POST['id'];
				$template_id = $_POST['uid'];
				$responsive_id = max(array_keys($style[$id][$template_id]['responsive']));
				$new_responsive_id = $_POST['new_rid'];

				$elements_setting = $style[$id][$template_id]['elements'];
				$elements_setting = self::sanitize_element_style($elements_setting);

				if (!isset($style[$id][$template_id]['element-order']) ||
					!is_array($style[$id][$template_id]['element-order']) ||
					count($style[$id][$template_id]['element-order']) < count($elements_setting)) {
					$style[$id][$template_id]['element-order'] = array_keys($elements_setting);
				}
				$responsive_config = $style[$id][$template_id]['responsive'][$responsive_id];
				$responsive_config = self::sanitize_responsive_style($elements_setting, $responsive_config);

				$code = self::generate_customization_section($id, $template_id, $new_responsive_id, -1, $style[$id][$template_id]['element-order'], $elements_setting, $responsive_config, $responsive_config, false);
				echo json_encode(array('html' => $code));
			} catch (Exception $e) {
				echo json_encode(array('error' => $e->getMessage()));
			}
			die();
		}

		private static function generate_individual_form_field_selection_template_code($root_style_settings, $variable_name) {
			$form_field_code = '<option value=""></option>';
			if ($root_style_settings && isset($root_style_settings[$variable_name])) {
				foreach($root_style_settings[$variable_name] as $field_id => $name) {
					$esc_name = esc_attr($name);
					$form_field_code .= '<option s--' . $name . '--d value="' . $esc_name . '">' . $esc_name . '</option>';
				}
			}
			return $form_field_code;
		}
		private static function generate_form_field_selection_template_code($root_style_settings) {
			$option_code = array();
			$option_code['form-select-single-field'] = $option_code['form-select-multi-field'] = self::generate_individual_form_field_selection_template_code($root_style_settings, 'other-form-fields-name');
			$option_code['form-select-checkbox-field'] = self::generate_individual_form_field_selection_template_code($root_style_settings, 'checkbox-form-fields-name');
			$option_code['form-select-dropdown-field'] = self::generate_individual_form_field_selection_template_code($root_style_settings, 'dropdown-form-fields-name');
			return $option_code;
		}
		public static function generate_customization_section($id, $template_id, $responsive_id, $selected_responsive_id, $element_order, $elements, $responsive_config,
				$desktop_responsive_config, $root_style_settings) {
			if ($responsive_id === 0) {
				if (self::$cached_customization_section_template === null) {
					self::$cached_customization_section_template = file_get_contents(dirname(__FILE__) . '/style-fluid-customization-template.php');
				}
				$template = self::$cached_customization_section_template;
			} else {
				if (self::$cached_customization_section_responsive_template === null) {
					self::$cached_customization_section_responsive_template = file_get_contents(dirname(__FILE__) . '/style-fluid-customization-responsive-template.php');
				}
				$template = self::$cached_customization_section_responsive_template;
			}
			$responsive_config = wp_parse_args($responsive_config, PopupAllyProFluidTemplate::$default_responsive_style_settings);
			$responsive_config['background-image'] = PopupAllyProTemplate::image_url_code_generation($responsive_config, 'background-image-url');
			$element_code = '';
			$form_field_code = self::generate_form_field_selection_template_code($root_style_settings);
			$auto_adjust = $responsive_config['checked-auto-adjust'] === 'true';
			foreach ($element_order as $element_id) {
				if (isset($elements[$element_id])) {
					$config = $elements[$element_id];
					$responsive_element = isset($responsive_config['elements'][$element_id]) ? $responsive_config['elements'][$element_id] : array('css' => array());
					$desktop_responsive_element = isset($desktop_responsive_config['elements'][$element_id]) ? $desktop_responsive_config['elements'][$element_id] : array('css' => array());
					$element_code .= PopupAllyProStyleFluidElementCustomization::generate_element_customiation_section($config['type'], $id, $template_id, $responsive_id,
							$element_id, $config, $responsive_element, $desktop_responsive_element, $responsive_id === 0, $auto_adjust, $form_field_code, $root_style_settings);
				}
			}
			$preview_code = self::generate_preview_code($id, $template_id, $responsive_id, $element_order, $elements, $responsive_config, $root_style_settings);

			if (isset($responsive_config['checked-popup-customization-opened']) && 'true' === $responsive_config['checked-popup-customization-opened']) {
				$template = str_replace('{{accordion-open-class}}', 'popupally-item-opened', $template);
			} else {
				$template = str_replace('{{accordion-open-class}}', '', $template);
			}
			$template = str_replace('{{elements}}', $element_code, $template);
			$template = str_replace('{{preview-code}}', $preview_code, $template);
			$template = str_replace('{{id}}', $id, $template);
			$template = str_replace('{{uid}}', $template_id, $template);
			$template = str_replace('{{responsive-id}}', $responsive_id, $template);
			$template = str_replace('{{preview-step-aside}}', $responsive_config['checked-preview-no-step-aside'] === 'true' ? '' : 'step-aside"', $template);
			$template = str_replace('{{show-customization-block}}', $responsive_id === $selected_responsive_id ? '' : 'style="display:none;"', $template);
			$template = PopupAllyProSettingShared::replace_all_toggle($template, $responsive_config);
			$template = PopupAllyProStyleFluidUtilities::replace_preview_values($template, $responsive_config);
			return $template;
		}
		public static function generate_preview_code($id, $template_id, $responsive_id, $element_order, $elements, $responsive_config, $root_style_settings) {
			if (self::$cached_preview_template === null) {
				self::$cached_preview_template = file_get_contents(dirname(__FILE__) . '/style-fluid-preview-template.php');
			}
			$template = str_replace('{{id}}', $id, self::$cached_preview_template);
			$template = str_replace('{{uid}}', $template_id, $template);
			$template = str_replace('{{responsive-id}}', $responsive_id, $template);
			$element_code = '';
			foreach ($element_order as $element_id) {
				if (isset($elements[$element_id])) {
					$config = $elements[$element_id];
					$responsive_element = isset($responsive_config['elements'][$element_id]) ? $responsive_config['elements'][$element_id] : array('css' => array());
					$element_code .= PopupAllyProStyleFluidElementCustomization::generate_element_preview($config['type'], $id, $template_id, $element_id, $responsive_id, $config, $responsive_element, $root_style_settings);
				}
			}
			foreach($responsive_config as $key => $value) {
				if (!is_array($value)) {
					$template = str_replace("{{{$key}}}", esc_attr($value), $template);
				}
			}
			$template = str_replace('{{elements}}', $element_code, $template);
			return $template;
		}
		/* $mode: 0 - normal; 1 - embedded */
		public static function generate_frontend_html_code($id, $template_id, $element_order, $elements, $mode, $all_style) {
			if (0 === $mode) {
				if (self::$cached_frontend_template === null) {
					self::$cached_frontend_template = file_get_contents(dirname(__FILE__) . '/style-fluid-frontend-template.php');
				}
				$template = self::$cached_frontend_template;
			} else {
				if (self::$cached_frontend_embedded_template === null) {
					self::$cached_frontend_embedded_template = file_get_contents(dirname(__FILE__) . '/style-fluid-frontend-embedded-template.php');
				}
				$template = self::$cached_frontend_embedded_template;
			}
			$element_code = '';
			$used_input_fields = array();
			foreach ($element_order as $element_id) {
				if (isset($elements[$element_id])) {
					$config = $elements[$element_id];
					$element_code .= PopupAllyProStyleFluidElementCustomization::generate_element_frontend($id, $template_id, $element_id, $config, $all_style);
					if ($config['type'] === 'input') {
						$field_name = PopupAllyProStyleFluidElementCustomization::generate_input_field_name($all_style[$id], $config);
						if (!empty($field_name)) {
							$used_input_fields[$field_name] = true;
						}
					}
				}
			}
			$template = str_replace('{{elements}}', $element_code, $template);
			$template = str_replace('{{id}}', $id, $template);
			$template = str_replace('{{uid}}', $template_id, $template);

			$this_popup_style_settings = $all_style[$id];
			if ($this_popup_style_settings['select-information-destination'] === 'form') {
				// generate hidden fields
				$hidden_fields = '';
				if (isset($this_popup_style_settings['hidden-form-fields-name'])) {
					foreach ($this_popup_style_settings['hidden-form-fields-name'] as $field_id => $name) {
						$hidden_fields .= '<input type="hidden" name="' . $name . '" value="' . esc_attr($this_popup_style_settings['hidden-form-fields-value'][$field_id]) . '"/>';
					}
				}
				if (isset($this_popup_style_settings['other-form-fields-name'])) {
					foreach ($this_popup_style_settings['other-form-fields-name'] as $field_id => $name) {
						if (isset($used_input_fields[$name])) {
							continue;
						}
						$hidden_fields .= '<input type="hidden" name="' . $name . '" value="' . esc_attr($this_popup_style_settings['other-form-fields-value'][$field_id]) . '"/>';
					}
				}
				$template = str_replace('{{hidden-fields}}', $hidden_fields, $template);
			} else {
				$this_popup_style_settings['sign-up-form-method'] = 'post';
				$this_popup_style_settings['sign-up-form-action'] = 'popupally-pro-send-email';
				$hidden_fields = '<input type="hidden" name="' . PopupAllyProSendEmailOperation::SEND_EMAIL_POPUP_ARG . '" value="' . $id . '" />';
				$hidden_fields .= '<input type="hidden" name="' . PopupAllyProSendEmailOperation::SEND_EMAIL_NONCE . '" value="{{validation-nonce}}" />';
				$template = str_replace('{{hidden-fields}}', $hidden_fields, $template);
			}
			$fancy_submit_attribute = '';

			$advanced_setting = PopupAllyProAdvancedSettings::get_advanced_settings();
			if (isset($advanced_setting['anti-spam']) && $advanced_setting['anti-spam'] === 'true') {
				$template = str_replace('{{sign-up-form-action}}', '', $template);
				$fancy_submit_attribute .= PopupAllyProUtilites::generate_anti_spam_attribute($this_popup_style_settings['sign-up-form-action']);
			} else {
				$template = str_replace('{{sign-up-form-action}}', esc_attr($this_popup_style_settings['sign-up-form-action']), $template);
			}

			$template = str_replace('{{sign-up-form-method}}', esc_attr($this_popup_style_settings['sign-up-form-method']), $template);

			$template = str_replace('{{fancy-submit}}', $fancy_submit_attribute, $template);

			if (isset($this_popup_style_settings['javascript-links'])) {
				if (isset($advanced_setting['include-javascript']) && $advanced_setting['include-javascript'] === 'true') {
					foreach ($this_popup_style_settings['javascript-links'] as $link) {
						$template .= '<script type="text/javascript" src="' . esc_attr($link). '"></script>';
					}
				}
			}
			return $template;
		}
		private static function generate_full_width_attribute($responsive_config) {
			if ($responsive_config['checked-full-width'] === 'true') {
				return '100%';
			}
			return $responsive_config['width'] . 'px';
		}
		private static function generate_full_width_left_attribute($responsive_config) {
			if ($responsive_config['checked-full-width'] === 'true') {
				return 'left:0{{use-important}};';
			}
			return '';
		}
		private static function generate_position_code($responsive_config) {
			if ($responsive_config['select-popup-location'] === 'center') {
				if ($responsive_config['checked-full-width'] === 'true') {
					return 'top:50%;left:0;margin-top:-' . (intval($responsive_config['height']) / 2) .
							'px;margin-left:0;';
				} else {
					return 'top:50%;left:50%;margin-top:-' . (intval($responsive_config['height']) / 2) .
							'px;margin-left:-' . (intval($responsive_config['width']) / 2) . 'px;';
				}
			} elseif ($responsive_config['select-popup-location'] === 'other') {
				if ($responsive_config['checked-full-width'] === 'true') {
					return $responsive_config['select-popup-vertical-selection'] . ':' . $responsive_config['popup-' . $responsive_config['select-popup-vertical-selection']] . ';' .
							'left:0;';
				} else {
					return $responsive_config['select-popup-vertical-selection'] . ':' . $responsive_config['popup-' . $responsive_config['select-popup-vertical-selection']] . ';' .
							$responsive_config['select-popup-horizontal-selection'] . ':' . $responsive_config['popup-' . $responsive_config['select-popup-horizontal-selection']] . ';';
				}
			}
			return PopupAllyProTemplate::$popup_location_css_template[$responsive_config['select-popup-location']];
		}
		public static function generate_css_code($id, $template_id, $responsive_id, $elements, $responsive_config, $is_preview) {
			$use_important = false;
			if ($is_preview) {
				$template = '';
			} else {
				if (self::$cached_frontend_css === null) {
					self::$cached_frontend_css = file_get_contents(dirname(__FILE__) . '/style-fluid-frontend-css.css');
				}
				$template = self::$cached_frontend_css;
			}
			foreach ($elements as $element_id => $element) {
				$responsive_element = isset($responsive_config['elements'][$element_id]) ? $responsive_config['elements'][$element_id] : array('css' => array());
				$template .= PopupAllyProStyleFluidElementCustomization::generate_element_css($element_id, $element, $responsive_element, $is_preview);
			}
			$responsive_config['background-image'] = PopupAllyProTemplate::image_url_code_generation($responsive_config, 'background-image-url');
			foreach($responsive_config as $key => $value) {
				if (!is_array($value)) {
					if ($key === 'background-color' && empty($value)) {
						$value = 'transparent';
					}
					$template = str_replace("{{{$key}}}", esc_attr($value), $template);
				}
			}

			$template = str_replace('{{full-width}}', self::generate_full_width_attribute($responsive_config), $template);
			$template = str_replace('{{full-width-left}}', self::generate_full_width_left_attribute($responsive_config), $template);
			$template = str_replace('{{position-code}}', self::generate_position_code($responsive_config), $template);
			$template = str_replace('{{id}}', $id, $template);
			$template = str_replace('{{uid}}', $template_id, $template);
			$template = str_replace('{{responsive-id}}', $responsive_id, $template);
			return $template;
		}
		public static function sanitize_responsive_style($elements, $responsive_config) {
			foreach (PopupAllyProFluidTemplate::$default_responsive_style_checkbox_true_default_value as $option) {
				if (!isset($responsive_config[$option])) {
					$responsive_config[$option] = 'false';
				}
			}
			if ($responsive_config['select-border-box-shadow'] === 'other') {
				$responsive_config['select-border-box-shadow'] = $responsive_config['select-border-box-shadow-other'];
			}
			unset($responsive_config['select-border-box-shadow-other']);
			foreach ($elements as $element_id => $element) {
				if (isset($responsive_config['elements'][$element_id])) {
					$responsive_config['elements'][$element_id] = PopupAllyProStyleFluidElementCustomization::sanitize_responsive_style($responsive_config['elements'][$element_id]);
				}
			}
			return $responsive_config;
		}
		public static function sanitize_element_style($element_settings) {
			foreach ($element_settings as $element_id => $element) {
				$element_settings[$element_id] = PopupAllyProStyleFluidElementCustomization::sanitize_element_style($element);
			}
			return $element_settings;
		}
		public static function get_popup_dependency($element_settings, $dependencies) {
			foreach ($element_settings as $element) {
				$dependencies = PopupAllyProStyleFluidElementCustomization::get_popup_dependency($element, $dependencies);
			}
			return $dependencies;
		}
	}
}