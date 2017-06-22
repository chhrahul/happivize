<?php
if (!class_exists('PopupAllyProStyleFluidCssCustomization')) {
	class PopupAllyProStyleFluidCssCustomization {
		/* 0: template file
		 * 1: default value,
		 * 2: front-end code generation type. 0 - normal, 1 - image (url), 2 - px, 3 - color (transparent for empty)
		 * 3: customization code generation type. 0 - simple value, 1 - font weight selection, 2 - text-align selection, 3 - font selection, 4 - display block/none selection
		 *** 5 - border style, 6 - font style, 7 - text decoration, 8 - white space, 9 - background size
		 * 4: auto-adjust. 0 - none, 1 - width, 2 - height
		 */
		public static $css_customization_config = array('color' => array('style-fluid-css-preview-color.php', '#000000', 3, 0, 0),
			'background-color' => array('style-fluid-css-preview-color.php', '', 3, 0, 0),
			'background-image' => array('style-fluid-css-preview-image.php', '', 1, 0, 0),
			'background-size' => array('style-fluid-css-preview-selection-other.php', 'auto', 0, 9, 0),
			'width' => array('style-fluid-css-preview-px-or-percentage.php', '100px', 0, 0, 1),
			'height' => array('style-fluid-css-preview-auto-px-or-percentage.php', '100px', 0, 0, 2),
			'top' => array('style-fluid-css-preview-px-or-percentage.php', '0px', 0, 0, 2),
			'left' => array('style-fluid-css-preview-px-or-percentage.php', '0px', 0, 0, 1),
			'font-family' => array('style-fluid-css-preview-selection-other.php', 'Georgia, serif', 0, 3, 0),
			'font-size' => array('style-fluid-css-preview-px.php', '14', 2, 0, 0),
			'font-weight' => array('style-fluid-css-preview-selection.php', '400', 0, 1, 0),
			'text-align' => array('style-fluid-css-preview-selection.php', 'left', 0, 2, 0),
			'line-height' => array('style-fluid-css-preview-px.php', '20', 2, 0, 2),
			'padding-top' => array('style-fluid-css-preview-px.php', '0', 2, 0, 2),
			'padding-right' => array('style-fluid-css-preview-px.php', '0', 2, 0, 1),
			'padding-bottom' => array('style-fluid-css-preview-px.php', '0', 2, 0, 2),
			'padding-left' => array('style-fluid-css-preview-px.php', '0', 2, 0, 1),
			'z-index' => array('style-fluid-css-preview-text.php', '0', 0, 0, 0),
			'display' => array('style-fluid-css-preview-selection.php', '0', 0, 4, 0),
			'border-width' => array('style-fluid-css-preview-px.php', '0', 2, 0, 0),
			'border-style' => array('style-fluid-css-preview-selection-other.php', 'none', 0, 5, 0),
			'border-color' => array('style-fluid-css-preview-color.php', '', 0, 0, 0),
			'border-radius' => array('style-fluid-css-preview-px.php', '0', 2, 0, 0),
			'placeholder-color' => array('style-fluid-css-preview-placeholder-color.php', '#e4e4e4', 0, 0, 0),
			'opacity' => array('style-fluid-css-preview-text.php', '1', 0, 0, 0),
			'font-style' => array('style-fluid-css-preview-selection.php', 'normal', 0, 6, 0),
			'text-decoration' => array('style-fluid-css-preview-selection.php', 'normal', 0, 7, 0),
			'white-space' => array('style-fluid-css-preview-selection.php', 'normal', 0, 8, 0),
			'hover--color' => array('style-fluid-css-preview-color.php', '#000000', 3, 0, 0),
			'hover--opacity' => array('style-fluid-css-preview-text.php', '0.5', 0, 0, 0),
			'hover--background-color' => array('style-fluid-css-preview-color.php', '', 3, 0, 0),
			'hover--background-image' => array('style-fluid-css-preview-image-hover.php', '', 1, 0, 0),
			'hover--background-size' => array('style-fluid-css-preview-selection-other.php', 'auto', 0, 9, 0),
			);
		private static $cached_css_customization_raw_template = array();
		private static $cached_css_customization_template = array();
		public static function generate_selection_list($options) {
			$code = '';
			foreach ($options as $key => $value) {
				$code .= '<option s--' . $key . '--d value="' . esc_attr($key) . '">' . esc_html($value) . '</opion>';
			}
			return $code;
		}
		private static function get_css_customization_raw_template($template) {
			if (!isset(self::$cached_css_customization_raw_template[$template])) {
				self::$cached_css_customization_raw_template[$template] = file_get_contents(dirname(__FILE__) . '/'  . $template);
			}
			return self::$cached_css_customization_raw_template[$template];
		}
		private static function get_css_customization_template($template, $mode) {
			if (!isset(self::$cached_css_customization_template[$template . $mode])) {
				$code = self::get_css_customization_raw_template($template);
				if ($mode > 0) {
					$option_code = '';
					switch ($mode) {
						case 1:
							$option_code = self::generate_selection_list(PopupAllyProSettingShared::$available_font_weights);
							break;
						case 2:
							$option_code = self::generate_selection_list(PopupAllyProSettingShared::$available_alignments);
							break;
						case 3:
							$options = PopupAllyProSettingShared::$available_fonts;
							$options['other'] = 'Other';
							$option_code = self::generate_selection_list($options);
							break;
						case 4:
							$options = array('block' => 'Show', 'none' => 'Hide');
							$option_code = self::generate_selection_list($options);
							break;
						case 5:
							$options = PopupAllyProSettingShared::$available_border_style;
							$options['other'] = 'Other';
							$option_code = self::generate_selection_list($options);
							break;
						case 6:
							$option_code = self::generate_selection_list(PopupAllyProSettingShared::$available_font_style);
							break;
						case 7:
							$option_code = self::generate_selection_list(PopupAllyProSettingShared::$available_text_decoration);
							break;
						case 8:
							$option_code = self::generate_selection_list(PopupAllyProSettingShared::$available_white_space_style);
							break;
						case 9:
							$options = PopupAllyProSettingShared::$available_background_size;
							$options['other'] = 'Other';
							$option_code = self::generate_selection_list($options);
							break;
					}
					$code = str_replace('{{options}}', $option_code, $code);
				}
				self::$cached_css_customization_template[$template . $mode] = $code;
			}
			return self::$cached_css_customization_template[$template . $mode];
		}
		public static function generate_default_css_customization_code($is_desktop = false) {
			$default_code = array();
			$base_variable = '[--id--][--uid--][responsive][--rid--][elements][--eid--]';
			$identifier = '--id-----uid-----eid--';
			$preview_element = '--id-----uid-----eid-----rid--';
			foreach (self::$css_customization_config as $type => $config) {
				$code = self::generate_css_customization($is_desktop, $type, $config[1], true, '--label--', $base_variable, $preview_element, $identifier);
				$code = str_replace('{{id}}', '--id--', $code);
				$code = str_replace('{{element-id}}', '--eid--', $code);
				$code = str_replace('{{uid}}', '--uid--', $code);
				$code = str_replace('{{responsive-id}}', '--rid--', $code);
				$default_code[$type] = $code;
			}
			return $default_code;
		}
		public static function generate_css_customization($is_desktop, $css_tag, $value, $is_inherit, $label, $base_variable, $preview_element, $identifier, $auto_adjust = false) {
			$css_config = self::$css_customization_config[$css_tag];
			$code = self::get_css_customization_template($css_config[0], $css_config[3]);
			$code = str_replace('{{label}}', $label, $code);
			$code = str_replace('{{value}}', esc_attr($value), $code);
			if ($css_config[3] === 3) {
				if (isset(PopupAllyProSettingShared::$available_fonts[$value])) {
					$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
					$code = str_replace('{{show-other}}', 'style="display:none;"', $code);
				} else {
					$code = str_replace('s--other--d', 'selected="selected"', $code);
					$code = str_replace('{{show-other}}', '', $code);
				}
			} elseif ($css_config[3] === 5) {
				if (isset(PopupAllyProSettingShared::$available_border_style[$value])) {
					$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
					$code = str_replace('{{show-other}}', 'style="display:none;"', $code);
				} else {
					$code = str_replace('s--other--d', 'selected="selected"', $code);
					$code = str_replace('{{show-other}}', '', $code);
				}
			} elseif ($css_config[3] === 9) {
				if (isset(PopupAllyProSettingShared::$available_background_size[$value])) {
					$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
					$code = str_replace('{{show-other}}', 'style="display:none;"', $code);
				} else {
					$code = str_replace('s--other--d', 'selected="selected"', $code);
					$code = str_replace('{{show-other}}', '', $code);
				}
			} elseif ($css_config[3] !== 0) {
				$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
			}
			$auto_adjust_code = '';
			$start_inherit_code = '';
			$end_inherit_code = '';
			if ($is_desktop) {
				if ($css_config[4] === 0) {
					$auto_adjust_code = 'inherit-css-source="' . $identifier . '-' . $css_tag . '"';
				} elseif ($css_config[4] === 1) {
					$auto_adjust_code = 'auto-adjust-width="{{id}}-{{uid}}" auto-adjust-type="' . $css_tag . '" element-id="{{element-id}}" responsive-id="{{responsive-id}}"';
				} elseif ($css_config[4] === 2) {
					$auto_adjust_code = 'auto-adjust-height="{{id}}-{{uid}}" auto-adjust-type="' . $css_tag . '" element-id="{{element-id}}" responsive-id="{{responsive-id}}"';
				}
			} else {
				if ($css_config[4] === 0) {
					if ($is_inherit) {
						$start_inherit_code = '<div style="display:none;"';
						$end_inherit_code = '</div><div><input checked="checked" ';
					} else {
						$start_inherit_code = '<div';
						$end_inherit_code = '</div><div><input';
					}
					$auto_adjust_code = 'inherit-css-target="' . $identifier . '-' . $css_tag . '" element-id="{{element-id}}" responsive-id="{{responsive-id}}"';
					$start_inherit_code .= ' hide-toggle data-dependency="inherit-' . $preview_element . '-' . $css_tag .'" data-dependency-value="false">';
					$end_inherit_code .= ' type="checkbox" name="' . $base_variable . '[inherit][' . $css_tag . ']" ' .
							'inherit-css-switch="' . $identifier . '-' . $css_tag . '" responsive-id="{{responsive-id}}" ' .
							'id="inherit-' . $preview_element . '-' . $css_tag .'" popupally-change-source="inherit-' . $preview_element . '-' . $css_tag .'" value="true" />' .
							'<label for="inherit-' . $preview_element . '-' . $css_tag .'">Inherit from desktop view</label></div>';
				} else {
					if ($css_config[4] === 1) {
						$auto_adjust_code = 'auto-adjust-width="{{id}}-{{uid}}" auto-adjust-type="' . $css_tag . '" element-id="{{element-id}}" responsive-id="{{responsive-id}}"';
					} elseif ($css_config[4] === 2) {
						$auto_adjust_code = 'auto-adjust-height="{{id}}-{{uid}}" auto-adjust-type="' . $css_tag . '" element-id="{{element-id}}" responsive-id="{{responsive-id}}"';
					}
					$auto_adjust_code .= ' readonly-toggle data-dependency="auto-adjust-enabled-{{id}}-{{uid}}-{{responsive-id}}" data-dependency-value="false"';
					if ($auto_adjust) {
						$auto_adjust_code .= ' readonly="readonly"';
					}
				}
			}
			$code = str_replace('{{start-inherit-code}}', $start_inherit_code, $code);
			$code = str_replace('{{end-inherit-code}}', $end_inherit_code, $code);
			$code = str_replace('{{auto-adjust}}', $auto_adjust_code, $code);
			$code = str_replace('{{base-setting-name}}', $base_variable, $code);
			$code = str_replace('{{variable-name}}', $css_tag, $code);
			$code = str_replace('{{preview-element}}', $preview_element, $code);
			$code = str_replace('{{identifier}}', $identifier, $code);
			return $code;
		}
		public static function generate_css_clause($css_tag, $value, $use_important = false) {
			if ($css_tag === 'placeholder-color') {
				return '';
			}
			$clause = str_replace('hover--', '', $css_tag) . ':';
			if (self::$css_customization_config[$css_tag][2] === 1) {
				if (empty($value)) {
					$clause .= 'none';
				} else {
					$clause .= 'url(' . $value . ')';
				}
			} elseif (self::$css_customization_config[$css_tag][2] === 2) {
				$clause .= $value . 'px';
			} elseif (self::$css_customization_config[$css_tag][2] === 3) {
				if (empty($value)) {
					$clause .= 'transparent';
				} else {
					$clause .=  $value;
				}
			} else {
				$clause .=  $value;
			}
			if ($use_important) {
				$clause .= '{{use-important}}';
			}
			return $clause . ';';
		}
	}
}