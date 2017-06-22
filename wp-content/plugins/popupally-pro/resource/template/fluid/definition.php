<?php
if (!class_exists('PopupAllyProFluidTemplate')) {
	class PopupAllyProFluidTemplate extends PopupAllyProTemplate {
		private static $fluid_template_files = array('before-you-go-design-1.php', 'before-you-go-design-2.php',
			'circular-dark.php',
			'special-offers-design-1-dark.php', 'special-offers-design-2-light.php',
			'contact-form-transparent.php', 'contact-form-solid.php',
			'freedom-guide-design-2.php', 'freedom-guide-design-1.php',
			'sidebar-sidekick.php',
			'full-width-optin.php', 'full-width-click-open.php',
			'blank.php');
		public static $available_fluid_templates = array();

		private static $cached_preview_template = null;

		public static $default_responsive_style_checkbox_true_default_value = array('checked-auto-adjust', 'checked-popup-location-inherit', 'checked-background-color-inherit',
			'checked-background-image-inherit', 'checked-border-box-shadow-inherit', 'checked-full-width-inherit');
		public static $default_responsive_style_settings = array(
			'checked-popup-customization-opened' => 'false',
			'checked-preview-no-step-aside' => 'false',
			'preview-window-background-color' => '#ffffff',
			'responsive-breakpoint' => '1024',
			'select-border-box-shadow' => '0 5px 10px rgba(0,0,0,0.5)',
			'checked-border-box-shadow-inherit' => 'true',
			'background-color' => '#fefefe',
			'checked-background-color-inherit' => 'true',
			'background-image-url' => '',
			'checked-background-image-inherit' => 'true',
			'checked-full-width' => 'false',
			'checked-full-width-inherit' => 'true',
			'label' => 'Mobile {{responsive-id}}',
			'width' => '600',
			'height' => '400',
			'select-popup-location' => 'center',
			'checked-popup-location-inherit' => 'true',
			'select-popup-vertical-selection' => 'top',
			'select-popup-horizontal-selection' => 'left',
			'popup-top' => '50%',
			'popup-left' => '50%',
			'popup-bottom' => '50%',
			'popup-right' => '50%',
			'checked-auto-adjust' => 'true',
			'elements' => array());
		protected static $default_base_style_settings = array(
			'checked-customization-opened' => 'false',
			'checked-hide-overlay' => 'false',
			'overlay-color' => "#505050",
			'overlay-opacity' => '0.5',
			'overlay-color-rgba' => '80,80,80,0.5',
			'checked-disable-overlay-close' => 'false',
			'selected-responsive' => '0',
			'elements' => array(), 'responsive' => array(), 'element-order' => array());

		private static $cached_responsive_header_template = null;

		public static function init() {
			self::$default_base_style_settings['responsive'][0] = self::$default_responsive_style_settings;
			self::$default_base_style_settings['responsive'][0]['label'] = 'Desktop';

			/* load the fluid templates */
			$root = dirname(__FILE__) . '/designs/';
			foreach (self::$fluid_template_files as $template) {
				$file = $root . $template;
				include_once($file);
			}
		}
		public function __construct() {
			parent::__construct();
			$this->uid = 'iwjdhs';
			$this->template_name = 'Fluid Templates';

			$this->backend_php = dirname(__FILE__) . '/backend/fluid-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>true, 'lname'=>true, 'email'=>true);

			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/fluid-pro-popup.css',
				1 => false,
				2 => false,
			);

			$this->default_values = array($this->uid => self::$default_base_style_settings);
		}
		public function is_fluid_template() {
			return true;
		}
		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);
			$setting = self::merge_default_values($setting);
			$template_settings = $setting[$this->uid];

			if (isset($template_settings['responsive']['--rid--'])) {
				unset($template_settings['responsive']['--rid--']);
			}
			foreach ($template_settings['responsive'] as $responsive_id => $responsive_config) {
				$template_settings['responsive'][$responsive_id] = PopupAllyProStyleFluidCustomization::sanitize_responsive_style($template_settings['elements'], $responsive_config);
			}
			$template_settings['elements'] = PopupAllyProStyleFluidCustomization::sanitize_element_style($template_settings['elements']);
			$setting[$this->uid] = $template_settings;
			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$template_settings = $style[$this->uid];

			// disable background close trigger
			if ('true' === $template_settings['checked-disable-overlay-close']) {
				$template_settings['overlay-close-trigger'] = '';
			} else {
				$template_settings['overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}

			$style['used-sign-up-form-fields'] = array();

			$template_settings = PopupAllyProTemplate::process_hide_background_overlay($template_settings, 'checked-hide-overlay', 'background-overlay-css', 'content-box-position');

			$template_settings['overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($template_settings['overlay-color'], $template_settings['overlay-opacity']);
			$style[$this->uid] = $template_settings;
			return $style;
		}
		public function generate_popup_html($id, $setting, $all_style, $mode = 0) {
			$setting = $this->prepare_for_code_generation($id, $setting, $all_style);
			if (2 == $mode) {
				return $this->generate_preview_popup_html($id, $setting);
			}
			$template_settings = $setting[$this->uid];
			$html = PopupAllyProStyleFluidCustomization::generate_frontend_html_code($id, $this->uid, $template_settings['element-order'], $template_settings['elements'], $mode, $all_style);
			$html = str_replace('{{overlay-close-trigger}}', 'true' === $template_settings['checked-disable-overlay-close'] ? '' : 'popup-click-close-trigger-' . $id, $html);
			return $html;
		}
		public function generate_preview_popup_html($id, $setting) {
			return '';
		}
		/* mode: 0 - normal css, 1 - preview css, 2 - top margin */
		public function generate_popup_css($id, $setting, $all_style, $mode) {
			$setting = $this->prepare_for_code_generation($id, $setting, $all_style);

			$template_settings = $setting[$this->uid];
			$template = $this->get_popup_css_template($mode);
			foreach($template_settings as $key => $value) {
				if (!is_array($value)) {
					$template = str_replace("{{{$key}}}", esc_attr($value), $template);
				}
			}
			$element_code = '';
			if ($mode === 2) {
				foreach ($template_settings['responsive'] as $responsive_id => $responsive_config) {
					if ($responsive_id !== 0) {
						$element_code .= '@media (max-width:' . $responsive_config['responsive-breakpoint'] . 'px) {';
					}
					$element_code .= 'html{margin-top:' . $responsive_config['height'] . 'px !important;}* html body{margin-top:' . $responsive_config['height'] . 'px !important;}';
					if ($responsive_id !== 0) {
						$element_code .= '}';
					}
				}
			} else {
				$is_preview = $mode === 1;
				foreach ($template_settings['responsive'] as $responsive_id => $responsive_config) {
					if (!$is_preview && $responsive_id !== 0) {
						$element_code .= '@media (max-width:' . $responsive_config['responsive-breakpoint'] . 'px) {';
					}
					$element_code .= PopupAllyProStyleFluidCustomization::generate_css_code($id, $this->uid, $responsive_id, $template_settings['elements'], $responsive_config, $is_preview);
					if (!$is_preview && $responsive_id !== 0) {
						$element_code .= '}';
					}
				}
			}
			$template .= $element_code;
			$template = str_replace('{{id}}', $id, $template);
			$template = str_replace('{{uid}}', $this->uid, $template);
			$uri = parse_url(PopupAllyPro::$PLUGIN_URI, PHP_URL_PATH);
			$template = str_replace('{{plugin_uri}}', $uri, $template);
			return $template;
		}
		public function merge_default_values($style) {
			if (!isset($style[$this->uid])) {
				$style[$this->uid] = self::$default_base_style_settings;
			} else {
				$style[$this->uid] = wp_parse_args($style[$this->uid], self::$default_base_style_settings);
				foreach ($style[$this->uid]['elements'] as $id => $element) {
					$style[$this->uid]['elements'][$id] = wp_parse_args($element, PopupAllyProStyleFluidElementCustomization::$default_main_element_values[$element['type']]);
				}
				if (!isset($style[$this->uid]['element-order']) ||
					!is_array($style[$this->uid]['element-order']) ||
					count($style[$this->uid]['element-order']) < count($style[$this->uid]['elements'])) {
					$style[$this->uid]['element-order'] = array_keys($style[$this->uid]['elements']);
				}
				foreach ($style[$this->uid]['responsive'] as $id => $responsive_config) {
					foreach (self::$default_responsive_style_checkbox_true_default_value as $option) {
						if (!isset($responsive_config[$option])) {
							$responsive_config[$option] = 'false';
						}
					}
					$style[$this->uid]['responsive'][$id] = wp_parse_args($responsive_config, self::$default_responsive_style_settings);
				}
			}
			return $style;
		}
		private static function generate_responsive_header($id, $uid, $responsive_config, $responsive_id, $selected) {
			if (self::$cached_responsive_header_template === null) {
				self::$cached_responsive_header_template = file_get_contents(dirname(__FILE__) . '/backend/fluid-pro-preview-responsive-tab-header-template.php');
			}
			$code = str_replace('{{label}}', esc_attr($responsive_config['label']), self::$cached_responsive_header_template);
			if ($responsive_id === $selected) {
				$code = str_replace('{{is-active}}', 'popupally-style-responsive-tab-active', $code);
			} else {
				$code = str_replace('{{is-active}}', '', $code);
			}
			$code = str_replace('{{id}}', $id, $code);
			$code = str_replace('{{uid}}', $uid, $code);
			$code = str_replace('{{responsive-id}}', $responsive_id, $code);
			return $code;
		}
		public static function generate_default_responsive_header() {
			return self::generate_responsive_header('--id--', '--uid--', self::$default_responsive_style_settings, '--rid--', false);
		}
		public function show_style_settings($id, $setting) {
			if (self::$cached_preview_template === null) {
				self::$cached_preview_template = file_get_contents(dirname(__FILE__) . '/backend/fluid-pro-preview.php');
			}
			$template_settings = $setting[$this->uid];

			$tab_header_code = '';
			$customization_code = '';
			$selected = intval($template_settings['selected-responsive']);
			foreach ($template_settings['responsive'] as $responsive_id => $responsive_config) {
				$tab_header_code .= self::generate_responsive_header($id, $this->uid, $responsive_config, $responsive_id, $selected);
				$customization_code .= PopupAllyProStyleFluidCustomization::generate_customization_section($id, $this->uid, $responsive_id, $selected, $template_settings['element-order'], $template_settings['elements'],
						$responsive_config, $template_settings['responsive'][0], $setting);
			}
			$html = str_replace('{{customization-section}}', $customization_code, self::$cached_preview_template);
			if (isset($template_settings['checked-customization-opened']) && 'true' === $template_settings['checked-customization-opened']) {
				$html = str_replace('{{accordion-open-class}}', 'popupally-item-opened', $html);
			} else {
				$html = str_replace('{{accordion-open-class}}', '', $html);
			}
			$html = str_replace('{{responsive-header}}', $tab_header_code, $html);
			$html = str_replace('{{responsive-tab-num}}', count($template_settings['responsive']) + 1, $html);
			$html = str_replace('{{max-responsive}}', max(array_keys($template_settings['responsive'])), $html);
			$html = str_replace('{{uid}}', $this->uid, $html);
			if (empty($template_settings['elements'])) {
				$html = str_replace('{{max-element}}', '0', $html);
			} else {
				$html = str_replace('{{max-element}}', max(array_keys($template_settings['elements'])), $html);
			}
			$html = PopupAllyProStyleFluidUtilities::replace_preview_values($html, $template_settings);

			$html = PopupAllyProSettingShared::replace_all_toggle($html, $template_settings);
			return $html;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['vtgjid-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['vtgjid-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['vtgjid-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['vtgjid-popup-location'] === 'other') {
				return $style['vtgjid-popup-vertical-selection'] . ':' . $style['vtgjid-popup' . $size_postfix. '-' . $style['vtgjid-popup-vertical-selection']] . ';' .
						$style['vtgjid-popup-horizontal-selection'] . ':' . $style['vtgjid-popup' . $size_postfix. '-' . $style['vtgjid-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['vtgjid-popup-location']];
		}
		public function get_popup_dependency($display, $style) {
			$dependencies = parent::get_popup_dependency($display, $style);

			$template_settings = $style[$this->uid];
			$dependencies = PopupAllyProStyleFluidCustomization::get_popup_dependency($template_settings['elements'], $dependencies);
			return $dependencies;
		}
		public static function add_template($template) {
			self::$available_fluid_templates[$template->uid] = $template;
		}
		public function get_action_target_options($style_setting) {
			$options = array();
			if (isset($style_setting[$this->uid]) && isset($style_setting[$this->uid]['elements'])) {
				foreach ($style_setting[$this->uid]['elements'] as $element_id => $element_config) {
					$action_item = PopupAllyProStyleFluidElementCustomization::get_action_target_option($element_config);
					if ($action_item) {
						$options[$action_item[0]] = $action_item;
					}
				}
			}
			return $options;
		}
	}
	PopupAllyProFluidTemplate::init();
	PopupAllyPro::add_template(new PopupAllyProFluidTemplate());
}
