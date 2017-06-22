<?php
if (!class_exists('PopupAllyProStyleFluidElementCustomization')) {
	class PopupAllyProStyleFluidElementCustomization {
		private static $cached_element_customization_templates = array();
		private static $element_customization_templates = array('text' => 'style-fluid-customization-text-template.php',
			'input' => 'style-fluid-customization-input-template.php',
			'submit' => 'style-fluid-customization-submit-template.php');
		private static $element_css_customization_options = array('text' => array(
				'Dimension' => false, 'width' => 'Width', 'height' => 'Height',
				'Location' => false, 'top' => 'Vertical Offset', 'left' => 'Horizontal Offset',
				'Background' => false, 'background-color' => 'Background Color', 'background-image' => 'Background Image', 'background-size' => 'Background Size',
				'Text Styling' => false, 'color' => 'Text Color', 'font-family' => 'Font', 'font-size' => 'Font Size', 'font-style' => 'Font Style', 'font-weight' => 'Font Weight', 'text-align' => 'Text Alignment', 'line-height' => 'Line Height', 'text-decoration' => 'Text Decoration', 'white-space' => 'Line Wrap',
				'Padding' => false, 'padding-top' => 'Padding - Top', 'padding-right' => 'Padding - Right', 'padding-bottom' => 'Padding - Bottom', 'padding-left' => 'Padding - Left',
				'Border' => false, 'border-width' => 'Border Width', 'border-style' => 'Border Style', 'border-color' => 'Border Color', 'border-radius' => 'Border Radius (rounded corner)',
				'Advanced' => false, 'z-index' => 'Z-Index (layer order)', 'display' => 'Visibility', 'opacity' => 'Opacity / Transparency',
				'Cursor Hover State' => false, 'hover--color' => 'Text Color on Cursor Hover', 'hover--opacity' => 'Opacity on Cursor Hover', 'hover--background-color' => 'Background Color on Cursor Hover', 'hover--background-image' => 'Background Image on Cursor Hover', 'hover--background-size' => 'Background Size on Cursor Hover',
			),
			'input' => array(
				'Dimension' => false, 'width' => 'Width', 'height' => 'Height',
				'Location' => false, 'top' => 'Vertical Offset', 'left' => 'Horizontal Offset',
				'Background' => false, 'background-color' => 'Background Color', 'background-image' => 'Background Image', 'background-size' => 'Background Size',
				'Text Styling' => false, 'color' => 'Input Color', 'placeholder-color' => 'Placeholder Color', 'font-family' => 'Font', 'font-size' => 'Font Size', 'font-style' => 'Font Style', 'font-weight' => 'Font Weight', 'text-align' => 'Text Alignment', 'line-height' => 'Line Height', 'text-decoration' => 'Text Decoration', 'white-space' => 'Whitespace / Line Break',
				'Padding' => false, 'padding-top' => 'Padding - Top', 'padding-right' => 'Padding - Right', 'padding-bottom' => 'Padding - Bottom', 'padding-left' => 'Padding - Left',
				'Border' => false, 'border-width' => 'Border Width', 'border-style' => 'Border Style', 'border-color' => 'Border Color', 'border-radius' => 'Border Radius (rounded corner)',
				'Advanced' => false, 'z-index' => 'Z-Index (layer order)', 'display' => 'Visibility', 'opacity' => 'Opacity / Transparency'
			),
			'submit' => array(
				'Dimension' => false, 'width' => 'Width', 'height' => 'Height',
				'Location' => false, 'top' => 'Vertical Offset', 'left' => 'Horizontal Offset',
				'Background' => false, 'background-color' => 'Background Color', 'background-image' => 'Background Image', 'background-size' => 'Background Size',
				'Text Styling' => false, 'color' => 'Text Color', 'font-family' => 'Font', 'font-size' => 'Font Size', 'font-style' => 'Font Style', 'font-weight' => 'Font Weight', 'text-align' => 'Text Alignment', 'line-height' => 'Line Height', 'text-decoration' => 'Text Decoration', 'white-space' => 'Whitespace / Line Break',
				'Padding' => false, 'padding-top' => 'Padding - Top', 'padding-right' => 'Padding - Right', 'padding-bottom' => 'Padding - Bottom', 'padding-left' => 'Padding - Left',
				'Border' => false, 'border-width' => 'Border Width', 'border-style' => 'Border Style', 'border-color' => 'Border Color', 'border-radius' => 'Border Radius (rounded corner)',
				'Advanced' => false, 'z-index' => 'Z-Index (layer order)', 'display' => 'Visibility', 'opacity' => 'Opacity / Transparency',
				'Cursor Hover State' => false, 'hover--color' => 'Text Color on Cursor Hover', 'hover--opacity' => 'Opacity on Cursor Hover', 'hover--background-color' => 'Background Color on Cursor Hover', 'hover--background-image' => 'Background Image on Cursor Hover', 'hover--background-size' => 'Background Size on Cursor Hover'
			),
			);
		public static $default_main_element_values = array('text' => array('type' => 'text', 'title' => 'Element {{element-id}} (Text)', 'text' => '',
				'select-click-action' => 'none', 'click-link' => '', 'click-new-link' => '', 'click-popup-id' => ''),
			'input' => array('type' => 'input', 'title' => 'Element {{element-id}} (Input)', 'placeholder' => 'Input', 'multi-placeholder' => 'Input',
				'select-input-type' => 'single', 'checked-is-email' => 'false', 'form-select-single-field' => '', 'checked-single-required' => 'false', 'single-field-label' => 'Input',
				'form-select-multi-field' => '', 'checked-multi-required' => 'false', 'multi-field-label' => 'Input',
				'form-select-dropdown-field' => '', 'checked-dropdown-required' => 'false',  'dropdown-field-label' => 'Input', 'dropdown-options' => '',
				'form-select-checkbox-field' => '', 'select-checkbox-default-value' => 'unchecked', 'checkbox-field-label' => 'Input',),
			'submit' => array('type' => 'submit', 'title' => 'Element {{element-id}} (Submit Button)', 'text' => 'Subscribe'));
		private static $default_responsive_element_values = array(
			'text' => array('css' => array('width' => '100px', 'height' => 'auto', 'left' => '10px', 'top' => '10px'), 'inherit' => array(), 'checked-customization-opened' => 'false'),
			'input' => array('css' => array('width' => '100px', 'height' => 'auto', 'left' => '10px', 'top' => '10px',
				'background-color' => '#FFFFFF', 'padding-left' => '10'),
				'inherit' => array('background-color' => 'true'), 'checked-customization-opened' => 'false'),
			'submit' => array('css' => array('width' => '100px', 'height' => 'auto', 'left' => '10px', 'top' => '10px',
				'background-color' => '#FCC302', 'color' => '#FFFFFF', 'text-align' => 'center'),
				'inherit' => array('background-color' => 'true', 'color' => 'true', 'text-align' => 'true'), 'checked-customization-opened' => 'false'));

		private static $cached_element_preview_templates = array();
		private static $element_preview_templates = array('text' => 'style-fluid-preview-text-template.php',
			'input' => 'style-fluid-preview-input-template.php',
			'submit' => 'style-fluid-preview-submit-template.php',
			'single' => 'style-fluid-preview-input-template.php',
			'multi' => 'style-fluid-preview-textarea-template.php',
			'checkbox' => 'style-fluid-preview-checkbox-template.php',
			'dropdown' => 'style-fluid-preview-dropdown-template.php');

		private static $cached_element_frontend_templates = array();
		private static $element_frontend_templates = array('text' => 'style-fluid-frontend-text-template.php',
			'input' => 'style-fluid-frontend-input-template.php',
			'submit' => 'style-fluid-frontend-submit-template.php',
			'single' => 'style-fluid-frontend-input-template.php',
			'multi' => 'style-fluid-frontend-textarea-template.php',
			'checkbox' => 'style-fluid-frontend-checkbox-template.php',
			'dropdown' => 'style-fluid-frontend-dropdown-template.php');

		private static $cached_element_customization_responsive_templates = array();
		private static $element_customization_responsive_templates = array('text' => 'style-fluid-customization-text-responsive-template.php',
			'input' => 'style-fluid-customization-input-responsive-template.php',
			'submit' => 'style-fluid-customization-submit-responsive-template.php');

		private static $cached_placeholder_color_css_templates = null;

		private static function get_element_customization_template($type, $is_desktop) {
			if ($is_desktop) {
				if (!isset(self::$cached_element_customization_templates[$type])) {
					$template = file_get_contents(dirname(__FILE__) . '/'  . self::$element_customization_templates[$type]);
					$options = '';
					foreach (self::$element_css_customization_options[$type] as $css => $label) {
						if ($label === false) {
							$options .= '<option disabled="disabled">' . esc_html($css) . '</option>';
						} else {
							$options .= '<option value="' . $css . '">&nbsp;&nbsp;&nbsp;&nbsp;' . esc_html($label) . '</option>';
						}
					}
					self::$cached_element_customization_templates[$type] = str_replace('{{css-options}}', $options, $template);
				}
				return self::$cached_element_customization_templates[$type];
			}
			if (!isset(self::$cached_element_customization_responsive_templates[$type])) {
				self::$cached_element_customization_responsive_templates[$type] = file_get_contents(dirname(__FILE__) . '/'  . self::$element_customization_responsive_templates[$type]);
			}
			return self::$cached_element_customization_responsive_templates[$type];
		}
		public static function generate_default_element_customization_code() {
			$default_code = array();
			foreach (self::$default_main_element_values as $type => $values) {
				$default_code[$type] = self::generate_element_customiation_section($type, '--id--', '--uid--', '--rid--', '--eid--',
											$values, self::$default_responsive_element_values[$type], self::$default_responsive_element_values[$type], true);
				$default_code[$type] = $default_code[$type];

				$default_code['responsive-' . $type] = self::generate_element_customiation_section($type, '--id--', '--uid--', '--rid--', '--eid--',
															$values, self::$default_responsive_element_values[$type], self::$default_responsive_element_values[$type], false);
				$default_code['responsive-' . $type] = $default_code['responsive-' . $type];
			}
			return $default_code;
		}
		public static function generate_default_element_preview_code() {
			$default_code = array();
			foreach (self::$default_main_element_values as $type => $values) {
				$default_code[$type] = self::generate_element_preview($type, '--id--', '--uid--', '--eid--', '--rid--', $values,
						self::$default_responsive_element_values[$type]);
				$default_code[$type] = $default_code[$type];
			}
			return $default_code;
		}
		public static function generate_element_customiation_section($type, $id, $template_id, $responsive_id, $element_id, $element_settings,
				$responsive_config, $desktop_responsive_element, $is_desktop, $auto_adjust = false, $form_field_code = false, $root_style_settings = false) {
			$code = self::get_element_customization_template($type, $is_desktop);
			if ($type === 'input' && $is_desktop) {
				if ($root_style_settings && isset($root_style_settings['sign-up-form-valid']) && $root_style_settings['sign-up-form-valid'] === 'true') {
					$code = str_replace('{{valid-form-field-show}}', '', $code);
					$code = str_replace('{{valid-form-field-hide}}', 'style="display:none;"', $code);
				} else {
					$code = str_replace('{{valid-form-field-show}}', 'style="display:none;"', $code);
					$code = str_replace('{{valid-form-field-hide}}', '', $code);
				}
				if ($root_style_settings && isset($root_style_settings['select-information-destination']) && $root_style_settings['select-information-destination'] === 'email') {
					$code = str_replace('{{information-destination-form-show}}', 'style="display:none;"', $code);
					$code = str_replace('{{information-destination-form-hide}}', '', $code);
				} else {
					$code = str_replace('{{information-destination-form-show}}', '', $code);
					$code = str_replace('{{information-destination-form-hide}}', 'style="display:none;"', $code);
				}
			}
			$css_code = '';
			$base_variable = '[' . $id . '][' . $template_id . '][responsive][' . $responsive_id . '][elements][' . $element_id . ']';
			$identifier = $id . '-' . $template_id . '-' . $element_id;
			$preview_element = $identifier . '-' . $responsive_id;
			if (empty($responsive_config['css'])) {
				$code = str_replace('{{max-css}}', '0', $code);
			} else {
				$code = str_replace('{{max-css}}', max(array_keys($responsive_config['css'])), $code);
			}
			foreach (self::$element_css_customization_options[$type] as $css => $label) {
				if ($label !== false && isset($responsive_config['css'][$css])) {
					$inherit = false;
					if (isset($responsive_config['inherit'][$css]) && $responsive_config['inherit'][$css] === 'true') {
						$inherit = true;
						$value = $desktop_responsive_element['css'][$css];
					} else {
						$value = $responsive_config['css'][$css];
					}
					$css_code .= PopupAllyProStyleFluidCssCustomization::generate_css_customization($is_desktop, $css, $value, $inherit, $label,
							$base_variable, $preview_element, $identifier, $auto_adjust);
				}
			}
			$code = PopupAllyProSettingShared::replace_all_toggle($code, $element_settings);
			$code = PopupAllyProStyleFluidUtilities::replace_preview_values($code, $element_settings, $form_field_code);
			$code = str_replace('{{css-customizations}}', $css_code, $code);
			$code = str_replace('{{id}}', $id, $code);
			$code = str_replace('{{uid}}', $template_id, $code);
			$code = str_replace('{{element-id}}', $element_id, $code);
			$code = str_replace('{{responsive-id}}', $responsive_id, $code);
			$code = str_replace('{{preview-element}}', $id . '-' . $template_id . '-' . $element_id, $code);

			if (isset($responsive_config['checked-customization-opened']) && 'true' === $responsive_config['checked-customization-opened']) {
				$code = str_replace('{{checked-customization-opened}}', 'checked="checked"', $code);
				$code = str_replace('{{checked-customization-opened-false-show}}', 'style="display:none;"', $code);
				$code = str_replace('{{checked-customization-opened-true-show}}', '', $code);
				$code = str_replace('{{accordion-open-class}}', 'popupally-item-opened', $code);
			} else {
				$code = str_replace('{{checked-customization-opened}}', '', $code);
				$code = str_replace('{{checked-customization-opened-false-show}}', '', $code);
				$code = str_replace('{{checked-customization-opened-true-show}}', 'style="display:none;"', $code);
				$code = str_replace('{{accordion-open-class}}', '', $code);
			}
			return $code;
		}
		private static function generate_dropdown_options_from_string($str) {
			$values = explode(',', $str);
			$result = '';
			foreach ($values as $val) {
				$result .= '<option value="' . esc_attr($val) . '">' . esc_html($val) . '</option>';
			}
			return $result;
		}
		public static function generate_element_preview($type, $id, $template_id, $element_id, $responsive_id, $element_settings, $responsive_element, $root_style_settings = false) {
			if ($type === 'input') {
				$type = $element_settings['select-input-type'];
			}
			if (!isset(self::$cached_element_preview_templates[$type])) {
				self::$cached_element_preview_templates[$type] = file_get_contents(dirname(__FILE__) . '/'  . self::$element_preview_templates[$type]);
			}
			$code = self::$cached_element_preview_templates[$type];

			if ($type === 'dropdown') {
				$dropdown_selection = '';
				if ($root_style_settings) {
					if ($root_style_settings['select-information-destination'] === 'form') {
						if (isset($root_style_settings['dropdown-form-fields-name'])) {
							foreach ($root_style_settings['dropdown-form-fields-name'] as $key => $field_name) {
								if ($field_name === $element_settings['form-select-dropdown-field']) {
									$dropdown_selection = $root_style_settings['dropdown-form-fields-value'][$key];
								}
							}
						}
					} else {
						$dropdown_selection = self::generate_dropdown_options_from_string($element_settings['dropdown-options']);
					}
				}
				$code = str_replace('{{dropdown-selection-options}}', $dropdown_selection, $code);
			} elseif ($type === 'checkbox') {
				if ($element_settings['select-checkbox-default-value'] === 'checked') {
					$code = str_replace('{{default-checked}}', 'checked="checked"', $code);
				} else {
					$code = str_replace('{{default-checked}}', '', $code);
				}
			} elseif ($type === 'text') {
				if (PopupAllyProSettingShared::has_matching_tags($element_settings['text'])) {
					$text_code = $element_settings['text'];
				} else {
					$text_code = 'Mismatch tag in HTML string. Please fix.';
				}
				if ($element_settings['select-click-action'] === 'link') {
					$text_code = '<a style="display:block;position:absolute;width:100%;height:100%;color:inherit;font-family:inherit;font-weight:inherit;text-decoration:inherit;line-height:inherit;" class="popupally-pro-hoverable-element" href="' . esc_attr($element_settings['click-link']) . '">' . $text_code . '</a>';
				} elseif ($element_settings['select-click-action'] === 'new-link') {
					$text_code = '<a target="_blank" style="display:block;position:absolute;width:100%;height:100%;color:inherit;font-family:inherit;font-weight:inherit;text-decoration:inherit;line-height:inherit;" class="popupally-pro-hoverable-element" href="' . esc_attr($element_settings['click-new-link']) . '">' . $text_code . '</a>';
				}
				$code = str_replace('{{text}}', $text_code, $code);
			}
			if (isset($element_settings['checked-is-email']) && $element_settings['checked-is-email'] === 'true') {
				$code = str_replace('{{input-type}}', 'email', $code);
			} else {
				$code = str_replace('{{input-type}}', 'text', $code);
			}
			foreach ($element_settings as $attr => $value) {
				if (!is_array($value)) {
					$code = str_replace('{{' . $attr. '}}', esc_attr($value), $code);
				}
			}
			$css_code = '';
			if (!empty($responsive_element['css'])) {
				foreach ($responsive_element['css'] as $css => $value) {
					if (strpos($css, 'hover--') === false) {
						$css_code .= PopupAllyProStyleFluidCssCustomization::generate_css_clause($css, $value);
					}
				}
			}
			$code = str_replace('{{element-css}}', esc_attr($css_code), $code);
			$code = str_replace('{{id}}', $id, $code);
			$code = str_replace('{{uid}}', $template_id, $code);
			$code = str_replace('{{element-id}}', $element_id, $code);
			$code = str_replace('{{responsive-id}}', $responsive_id, $code);
			return $code;
		}
		private static function generate_text_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles) {
			if (!isset(self::$cached_element_frontend_templates['text'])) {
				self::$cached_element_frontend_templates['text'] = file_get_contents(dirname(__FILE__) . '/'  . self::$element_frontend_templates['text']);
			}
			$code = self::$cached_element_frontend_templates['text'];
			$text_code = $element_settings['text'];
			$popup_link_code = '';
			$track_code = '';
			if ($element_settings['select-click-action'] === 'link') {
				$popup_link_code = 'svvuyx-redirect-url="' . esc_attr($element_settings['click-link']) . '" svvuyx-redirect-action="same"';
				$track_code = 'ijdh-popupally-pro-track-cnewh="' . esc_attr($element_settings['title']) . '"';
			} elseif ($element_settings['select-click-action'] === 'new-link') {
				$popup_link_code = 'svvuyx-redirect-url="' . esc_attr($element_settings['click-new-link']) . '" svvuyx-redirect-action="new"';
				$track_code = 'ijdh-popupally-pro-track-cnewh="' . esc_attr($element_settings['title']) . '"';
			} elseif ($element_settings['select-click-action'] === 'popup') {
				if (isset($all_styles[$element_settings['click-popup-id']])) {
					$popup_link_code = 'svvuyx-redirect-popup="' . $element_settings['click-popup-id'] . '"';
				} else {
					$popup_link_code = 'svvuyx-redirect-popup=""';
				}
				$track_code = 'ijdh-popupally-pro-track-cnewh="' . esc_attr($element_settings['title']) . '"';
			}
			$code = str_replace('{{text}}', $text_code, $code);
			$code = str_replace('{{popup-link-code}}', $popup_link_code, $code);
			$code = str_replace('{{track-code}}', $track_code, $code);
			return $code;
		}
		public static function generate_input_field_name($style_settings, $element_settings) {
			$type = $element_settings['select-input-type'];
			if ($type === 'single') {
				if ($style_settings['select-information-destination'] === 'form') {
					$field_name = $element_settings['form-select-single-field'];
				} else {
					$field_name = $element_settings['single-field-label'];
				}
			} elseif ($type === 'multi') {
				if ($style_settings['select-information-destination'] === 'form') {
					$field_name = $element_settings['form-select-multi-field'];
				} else {
					$field_name = $element_settings['multi-field-label'];
				}
			} elseif ($type === 'dropdown') {
				if ($style_settings['select-information-destination'] === 'form') {
					$field_name = $element_settings['form-select-dropdown-field'];
				} else {
					$field_name = $element_settings['dropdown-field-label'];
				}
			} elseif ($type === 'checkbox') {
				if ($style_settings['select-information-destination'] === 'form') {
					$field_name = $element_settings['form-select-checkbox-field'];
				} else {
					$field_name = $element_settings['checkbox-field-label'];
				}
			}
			return $field_name;
		}
		public static function generate_checkbox_input_field_value($style_settings, $selected_field_name) {
			$field_value = '';
			if ($style_settings['select-information-destination'] === 'form') {
				if (isset($style_settings['checkbox-form-fields-name'])) {
					foreach ($style_settings['checkbox-form-fields-name'] as $field_id => $field_name) {
						if ($selected_field_name === $field_name) {
							$field_value = $style_settings['checkbox-form-fields-value'][$field_id];
						}
					}
				}
			} else {
				$field_value = 'Checked';
			}
			return $field_value;
		}
		private static function generate_input_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles) {
			$type = $element_settings['select-input-type'];
			if (!isset(self::$cached_element_frontend_templates[$type])) {
				self::$cached_element_frontend_templates[$type] = file_get_contents(dirname(__FILE__) . '/'  . self::$element_frontend_templates[$type]);
			}
			$code = self::$cached_element_frontend_templates[$type];
			foreach ($element_settings as $attr => $value) {
				if (!is_array($value)) {
					$code = str_replace('{{' . $attr. '}}', esc_attr($value), $code);
				}
			}
			$field_name = self::generate_input_field_name($all_styles[$id], $element_settings);
			if ($type === 'dropdown') {
				$dropdown_selection = '';
				if ($all_styles) {
					if ($all_styles[$id]['select-information-destination'] === 'form') {
						if (isset($all_styles[$id]['dropdown-form-fields-name'])) {
							foreach ($all_styles[$id]['dropdown-form-fields-name'] as $key => $field_option) {
								if ($field_option === $element_settings['form-select-dropdown-field']) {
									$dropdown_selection = $all_styles[$id]['dropdown-form-fields-value'][$key];
								}
							}
						}
					} else {
						$dropdown_selection = self::generate_dropdown_options_from_string($element_settings['dropdown-options']);
					}
				}
				$code = str_replace('{{dropdown-selection-options}}', $dropdown_selection, $code);
			} elseif ($type === 'checkbox') {
				if ($element_settings['select-checkbox-default-value'] === 'checked') {
					$code = str_replace('{{default-checked}}', 'checked="checked"', $code);
				} else {
					$code = str_replace('{{default-checked}}', '', $code);
				}
				$field_value = self::generate_checkbox_input_field_value($all_styles[$id], $field_name);
				$code = str_replace('{{checkbox-value}}', $field_value, $code);
			}
			if (isset($element_settings['checked-is-email']) && $element_settings['checked-is-email'] === 'true') {
				$code = str_replace('{{input-type}}', 'email', $code);
			} else {
				$code = str_replace('{{input-type}}', 'text', $code);
			}
			$code = str_replace('{{form-field}}', esc_attr($field_name), $code);
			if (isset($element_settings['checked-' . $type . '-required']) && 'true' === $element_settings['checked-' . $type . '-required']) {
				$code = str_replace('{{is-required}}', 'required="required"', $code);
			} else {
				$code = str_replace('{{is-required}}', '', $code);
			}
			return $code;
		}
		private static function generate_submit_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles) {
			if (!isset(self::$cached_element_frontend_templates['submit'])) {
				self::$cached_element_frontend_templates['submit'] = file_get_contents(dirname(__FILE__) . '/'  . self::$element_frontend_templates['submit']);
			}
			$code = self::$cached_element_frontend_templates['submit'];
			foreach ($element_settings as $attr => $value) {
				if (!is_array($value)) {
					$code = str_replace('{{' . $attr. '}}', esc_attr($value), $code);
				}
			}
			return $code;
		}
		public static function generate_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles) {
			$type = $element_settings['type'];
			if ($type === 'text') {
				$code = self::generate_text_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles);
			} elseif ($type === 'input') {
				$code = self::generate_input_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles);
			} elseif ($type === 'submit') {
				$code = self::generate_submit_element_frontend($id, $template_id, $element_id, $element_settings, $all_styles);
			}
			$code = str_replace('{{id}}', $id, $code);
			$code = str_replace('{{uid}}', $template_id, $code);
			$code = str_replace('{{element-id}}', $element_id, $code);
			return $code;
		}
		private static function generate_placeholder_color_css($element_id, $color, $use_important = false) {
			if (self::$cached_placeholder_color_css_templates === null) {
				self::$cached_placeholder_color_css_templates = file_get_contents(dirname(__FILE__) . '/style-fluid-placeholder-color-css.css');
			}
			$code = self::$cached_placeholder_color_css_templates;
			$modifier = '';
			if ($use_important) {
				$modifier = '{{use-important}}';
			}
			$code = str_replace('{{element-id}}', $element_id, $code);
			$code = str_replace('{{placeholder-color}}', $color . $modifier, $code);
			return $code;
		}
		public static function generate_element_css($element_id, $element, $responsive_element, $is_preview) {
			$regular_css_code = '';
			$hover_css_code = '';
			foreach ($responsive_element['css'] as $css => $value) {
				if (strpos($css, 'hover--') === 0) {
					$hover_css_code .= PopupAllyProStyleFluidCssCustomization::generate_css_clause($css, $value, true);
				} else {
					$regular_css_code .= PopupAllyProStyleFluidCssCustomization::generate_css_clause($css, $value, true);
				}
			}
			if ($is_preview) {
				$code = '';
				if (!empty($hover_css_code)) {
					$hover_css_code = str_replace('{{use-important}}', ' !important', $hover_css_code);
					$code .= '#popupally-preview-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}:hover{' .
						$hover_css_code . '}';
				}
			} else {
				$code = '#popup-box-pro-gfcr-{{id}} #popupally-fluid-{{id}}-{{uid}}-{{element-id}},#popup-embedded-box-pro-gfcr-{{id}} #popupally-fluid-{{id}}-{{uid}}-{{element-id}}{display:block;position:absolute;' .
					$regular_css_code . '}';
				if (!empty($hover_css_code)) {
					$code .= '#popup-box-pro-gfcr-{{id}} #popupally-fluid-{{id}}-{{uid}}-{{element-id}}:hover,#popup-embedded-box-pro-gfcr-{{id}} #popupally-fluid-{{id}}-{{uid}}-{{element-id}}:hover{' .
					$hover_css_code . '}';
				}
			}
			if ($element['type'] === 'input') {
				$color = PopupAllyProStyleFluidCssCustomization::$css_customization_config['placeholder-color'][1];
				if (isset($responsive_element['css']['placeholder-color'])) {
					$color = $responsive_element['css']['placeholder-color'];
				}
				if ($is_preview) {
					$code .= self::generate_placeholder_color_css('#popupally-preview-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}', $color);
				} else {
					$code .= self::generate_placeholder_color_css('#popup-box-pro-gfcr-{{id}} #popupally-fluid-{{id}}-{{uid}}-{{element-id}}', $color, true);
					$code .= self::generate_placeholder_color_css('#popup-embedded-box-pro-gfcr-{{id}} #popupally-fluid-{{id}}-{{uid}}-{{element-id}}', $color, true);
				}
			}
			$code = str_replace('{{element-id}}', $element_id, $code);
			return $code;
		}
		public static function sanitize_responsive_style($responsive_config) {
			if (!isset($responsive_config['css'])) {
				$responsive_config['css'] = array();
			} else {
				$to_remove = array();
				foreach ($responsive_config['css'] as $css_key => $value) {
					if (isset(PopupAllyProStyleFluidCssCustomization::$css_customization_config[$css_key])) {
						$type = PopupAllyProStyleFluidCssCustomization::$css_customization_config[$css_key][0];
						if ($type === 'style-fluid-css-preview-selection-other.php') {
							if ($value === 'other') {
								$responsive_config['css'][$css_key] = $responsive_config['css'][$css_key . '-other'];
							}
							$to_remove []= $css_key . '-other';
						} elseif ($type === 'style-fluid-css-preview-px-or-percentage.php') {
							$value = strtolower(trim($value));
							if (substr($value, -1) !== '%' && substr($value, -2) !== 'px') {
								$responsive_config['css'][$css_key] = $value . 'px';
							}
						} elseif ($type === 'style-fluid-css-preview-auto-px-or-percentage.php') {
							$value = strtolower(trim($value));
							if ($value !== 'auto' && substr($value, -1) !== '%' && substr($value, -2) !== 'px') {
								$responsive_config['css'][$css_key] = $value . 'px';
							}
						}
					}
				}
				foreach ($to_remove as $key) {
					unset($responsive_config['css'][$key]);
				}
			}
			return $responsive_config;
		}
		public static function sanitize_element_style($element_settings) {
			if ($element_settings['type'] === 'input') {
				if ($element_settings['form-select-single-field'] === ':null:') {
					$element_settings['form-select-single-field'] = '';
				}
				if ($element_settings['form-select-multi-field'] === ':null:') {
					$element_settings['form-select-multi-field'] = '';
				}
				if ($element_settings['form-select-dropdown-field'] === ':null:') {
					$element_settings['form-select-dropdown-field'] = '';
				}
				if ($element_settings['form-select-checkbox-field'] === ':null:') {
					$element_settings['form-select-checkbox-field'] = '';
				}
			}
			return $element_settings;
		}
		public static function get_popup_dependency($element_settings, $dependencies) {
			if ($element_settings['type'] === 'text') {
				if ($element_settings['select-click-action'] === 'popup') {
					$dependencies []= $element_settings['click-popup-id'];
				}
			}
			return $dependencies;
		}
		public static function get_action_target_option($element_settings) {
			if ($element_settings['type'] === 'submit') {
				return PopupAllyProTrackStatistics::$STATS_CATEGORIES['conversion'];
			} elseif ($element_settings['type'] === 'text') {
				if ($element_settings['select-click-action'] === 'link' || $element_settings['select-click-action'] === 'new-link' || $element_settings['select-click-action'] === 'popup') {
					return array($element_settings['title'] . ' clicked', $element_settings['title'] . ' clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', $element_settings['title'] . ' clicked'));
				}
			}
			return false;
		}
	}
}