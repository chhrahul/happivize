<?php
if (!class_exists('PopupAllyProTemplate')) {
	class PopupAllyProTemplate {
		const POPUP_BOX_SHADOW_CSS = '-webkit-box-shadow: 0 10px 25px rgba(0,0,0,0.5);-moz-box-shadow: 0 10px 25px rgba(0,0,0,0.5);box-shadow: 0 10px 25px rgba(0,0,0,0.5);';
		const POPUP_BOX_EMBEDDED_SHADOW_CSS = '-webkit-box-shadow: 0 10px 25px rgba(0,0,0,0.5);-moz-box-shadow: 0 10px 25px rgba(0,0,0,0.5);box-shadow: 0 10px 25px rgba(0,0,0,0.5);-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;';
		const POPUP_BACKGROUND_CSS = 'width:100%;height:100%;overflow:hidden;position:fixed;bottom:0;right:0;';
		const POPUP_LOCATION_SELECTION_TEMPLATE = '<option s--center--d value="center">Center</option><option s--top-left--d value="top-left">Top Left</option><option s--top-right--d value="top-right">Top Right</option><option s--bottom-left--d value="bottom-left">Bottom Left</option><option s--bottom-right--d value="bottom-right">Bottom Right</option><option s--other--d value="other">Other</option>';

		public static $popup_location_css_template = array('top-left' => 'top:0;left:0;bottom:initial;right:initial;margin-top:0;margin-left:0;', 'top-right' => 'top:0;right:0;bottom:initial;left:initial;margin-top:0;margin-left:0;', 'bottom-left' => 'bottom:0;left:0;top:initial;right:initial;margin-top:0;margin-left:0;', 'bottom-right' => 'bottom:0;right:0;top:initial;left:initial;margin-top:0;margin-left:0;');

		public $uid = null;
		public $template_name = null;
		public $template_order = 0;

		public $frontend_css = null;

		public $style_hide_signup_fields = array('form'=>false, 'name'=>false, 'lname'=>true, 'email'=>false);

		// 0 - normal popup, 1 - embedded, 2 - preview
		protected $popup_html_template_files = null;
		private $popup_html_template = array();

		protected $popup_css_template_files = null;
		private $popup_css_template = array();
		
		public $backend_php = null;
		public $frontend_php = null;
		public $frontend_embedded_php = null;

		private $style_setting_template = null;

		protected $style_template_advanced_customization = array();

		// 0: text, 1: input, 2: submit, 3: responsive text, 4: responsive input, 5: responsive submit
		private static $style_advanced_customization_php = array(
			0 => 'setting-style-text-customization.php',
			1 => 'setting-style-input-customization.php',
			2 => 'setting-style-submit-customization.php',
			3 => 'setting-style-text-responsive-customization.php',
			4 => 'setting-style-input-responsive-customization.php',
			5 => 'setting-style-submit-responsive-customization.php',
			);
		private static $style_advanced_customization_template = array();

		public $html_mapping = null;
		public $no_escape_html_mapping = null;
		public $default_values = null;
	
		public static function initialize(){
			$base_path = dirname(__FILE__) . '/template/';
			foreach(self::$style_advanced_customization_php as $id=>$file) {
				self::$style_advanced_customization_php[$id] = $base_path . $file;
				self::$style_advanced_customization_template[$id] = null;
			}
		}

		protected function __construct() {
		}

		public function is_fluid_template() {
			return false;
		}
		public function sanitize_style($input, $id, $is_active = false) {
			foreach($this->style_template_advanced_customization as $name => $tuple) {
				if (isset($input[$name . '-font']) && $input[$name . '-font'] === 'other' && isset($input[$name . '-font-other'])) {	// for manually entered font
					$input[$name . '-font'] = $input[$name . '-font-other'];
				}
			}
			if ($is_active) {
				$input['popup-selector'] = '#popup-box-pro-gfcr-' . $id;
				$input['popup-class'] = 'popupally-pro-opened-pro-gfcr-' . $id;
				$input['cookie-name'] = 'popupally-cookie-' . $id;
				$input['close-trigger'] = '.popup-click-close-trigger-' . $id;
			}
			return $input;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			if (isset($style['select-information-destination']) && $style['select-information-destination'] === 'email') {
				$style['sign-up-form-method'] = 'post';
				$style['sign-up-form-action'] = 'popupally-pro-send-email';
				$style['sign-up-form-name-field'] = $style['information-destination-email-name-label'];
				$style['sign-up-form-lname-field'] = $style['information-destination-email-lname-label'];
				$style['sign-up-form-email-field'] = $style['information-destination-email-email-label'];
				$style['sign-up-form-name-is-required'] = $style['information-destination-email-name-is-required'];
				$style['sign-up-form-lname-is-required'] = $style['information-destination-email-lname-is-required'];
				$style['sign-up-form-email-is-required'] = $style['information-destination-email-email-is-required'];
			}
			$style = $this->process_field_required_status($style);
			$style['fancy-submit'] = '';

			$advanced_setting = PopupAllyProAdvancedSettings::get_advanced_settings();
			if (isset($advanced_setting['anti-spam']) && $advanced_setting['anti-spam'] === 'true') {
				if (isset($style['sign-up-form-action'])) {
					$style['fancy-submit'] .= PopupAllyProUtilites::generate_anti_spam_attribute($style['sign-up-form-action']);
				}
				$style['sign-up-form-action'] = '';
			}
			return $style;
		}
		public function generate_preview_popup_html($id, $setting) {
			$generated_templates = array();
			for ($i=2;$i<=4;++$i) {
				$template = $this->get_popup_html_template($i);
				$generated_templates[$i] = $this->generate_popup_html_from_template($id, $setting, $template, true);
			}
			return $generated_templates;
		}
		protected function generate_popup_html_from_template($id, $setting, $template, $is_preview = false) {
			$template = str_replace('{{num}}', $id, $template);

			$template = str_replace('{{fancy-submit}}', $setting['fancy-submit'], $template);

			foreach ($this->html_mapping as $replace) {
				if (isset($setting[$replace])) {
					$template = str_replace('{{' . $replace . '}}', esc_attr($setting[$replace]), $template);
				} else {
					$template = str_replace('{{' . $replace . '}}', '', $template);
				}
			}
			foreach ($this->no_escape_html_mapping as $replace) {
				if (isset($setting[$replace])) {
					if ($is_preview && !PopupAllyProSettingShared::has_matching_tags($setting[$replace])) {
						$template = str_replace('{{' . $replace . '}}', 'Mismatch tag in HTML string. Please fix.', $template);
					} else {
						$template = str_replace('{{' . $replace . '}}', $setting[$replace], $template);
					}
				} else {
					$template = str_replace('{{' . $replace . '}}', '', $template);
				}
			}
			// generate hidden fields
			$hidden_fields = '';

			if (isset($setting['select-information-destination']) && $setting['select-information-destination'] === 'email') {
				$hidden_fields = '<input type="hidden" name="' . PopupAllyProSendEmailOperation::SEND_EMAIL_POPUP_ARG . '" value="' . $id . '" />';
				$hidden_fields .= '<input type="hidden" name="' . PopupAllyProSendEmailOperation::SEND_EMAIL_NONCE . '" value="{{validation-nonce}}" />';
			} else {
				if (isset($setting['hidden-form-fields-name'])) {
					foreach ($setting['hidden-form-fields-name'] as $field_id => $name) {
						$hidden_fields .= '<input type="hidden" name="' . $name . '" value="' . esc_attr($setting['hidden-form-fields-value'][$field_id]) . '"/>';
					}
				}
				if (isset($setting['other-form-fields-name'])) {
					foreach ($setting['other-form-fields-name'] as $field_id => $name) {
						if (isset($setting['used-sign-up-form-fields']) && is_array($setting['used-sign-up-form-fields'])) {
							if (in_array($name, $setting['used-sign-up-form-fields'])) {
								continue;
							}
						}
						$hidden_fields .= '<input type="hidden" name="' . $name . '" value="' . esc_attr($setting['other-form-fields-value'][$field_id]) . '"/>';
					}
				}
			}
			$template = str_replace('{{hidden-fields}}', $hidden_fields, $template);

			// insert original Javascript from the opt-in code
			if (!$is_preview && isset($setting['javascript-links'])) {
				$advanced_settings = PopupAllyProAdvancedSettings::get_advanced_settings();
				if (isset($advanced_settings['include-javascript']) && $advanced_settings['include-javascript'] === 'true') {
					foreach ($setting['javascript-links'] as $link) {
						$template .= '<script type="text/javascript" src="' . esc_attr($link). '"></script>';
					}
				}
			}
			return $template;
		}
		public function generate_popup_html($id, $setting, $all_style, $mode = 0) {
			$setting = $this->prepare_for_code_generation($id, $setting, $all_style);
			if (2 == $mode) {
				return $this->generate_preview_popup_html($id, $setting);
			}
			$template = $this->get_popup_html_template($mode);
			return $this->generate_popup_html_from_template($id, $setting, $template);
		}
		/* mode: 0 - normal css, 1 - preview css, 2 - top margin */
		public function generate_popup_css($id, $setting, $all_style, $mode) {
			$setting = $this->prepare_for_code_generation($id, $setting, $all_style);
			$template = $this->get_popup_css_template($mode);
			$template = str_replace('{{num}}', $id, $template);

			$show_popup_box_shadow = true;
			foreach ($this->default_values as $replace => $default_value) {
				$value = $setting[$replace];
				if ('-color' === substr($replace, -6)) { // ends with -color
					if ('' === $setting[$replace]) {
						$value = 'transparent';
						if ('background-color' === substr($replace, -16)) { // ends with -background-color
							$show_popup_box_shadow = false;
						}
					} else {
						if ('#' !== $setting[$replace][0]) {
							$value = '#' + $value;
						}
						$value = $value . '000000';
						$value = substr($value, 0, 7);
					}
				} elseif ('-hide-toggle' === substr($replace, -12)) { // ends with -hide-toggle
					$value = $value === 'true' ? 'none' : 'block';
						
				}
				$template = str_replace('{{' . $replace . '}}', $value, $template);
			}

			if ($mode === 0) {
				if ($show_popup_box_shadow) {
					$template = str_replace('{{POPUP_BOX_SHADOW_CSS}}', self::POPUP_BOX_SHADOW_CSS, $template);
				} else {
					$template = str_replace('{{POPUP_BOX_SHADOW_CSS}}', '', $template);
				}
				$uri = parse_url(PopupAllyPro::$PLUGIN_URI, PHP_URL_PATH);
				$template = str_replace('{{plugin_uri}}', $uri, $template);

				$template = str_replace('{{position-code}}', $this->generate_position_code($setting, ''), $template);
				$template = str_replace('{{position-960-code}}', $this->generate_position_code($setting, '-960'), $template);
				$template = str_replace('{{position-640-code}}', $this->generate_position_code($setting, '-640'), $template);
			}
			return $template;
		}

		protected function get_style_setting_template() {
			if (null === $this->style_setting_template) {
				$this->style_setting_template = file_get_contents($this->backend_php);
			}
			return $this->style_setting_template;
		}

		private static function get_style_advanced_customization_template($template_id) {
			if (null === self::$style_advanced_customization_template[$template_id]) {
				self::$style_advanced_customization_template[$template_id] = file_get_contents(self::$style_advanced_customization_php[$template_id]);
			}
			return self::$style_advanced_customization_template[$template_id];
		}
		// 0: text, 1: input, 2: submit, 3: responsive text, 4: responsive input, 5: responsive submit
		protected static function generate_advanced_customization_code($setting, $name, $template_definition) {
			$template_id = $template_definition[0];
			$target = $target_specific = $template_definition[1];
			if (count($template_definition) > 2) {
				$target_specific = $template_definition[2];
			}
			$advanced_edit = self::get_style_advanced_customization_template($template_id);

			if ($template_id < 3) {
				$advanced_edit = PopupAllyProSettingShared::customize_advanced_edit_option($setting, $name, $advanced_edit);
			}
			$advanced_edit = str_replace("{{element_name}}", $name, $advanced_edit);
			$advanced_edit = str_replace("{{preview_element_name}}", $target, $advanced_edit);
			$advanced_edit = str_replace("{{preview_element_name_specific}}", $target_specific, $advanced_edit);
			return $advanced_edit;
		}

		public function show_style_settings($id, $setting) {
			return '';
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
		}

		public function get_popup_html_template($template_id = 0) {
			if (!isset($this->popup_html_template[$template_id])) {
				$this->popup_html_template[$template_id] = file_get_contents($this->popup_html_template_files[$template_id]);
			}
			return $this->popup_html_template[$template_id];
		}

		public function get_popup_css_template($template_id) {
			if (!isset($this->popup_css_template[$template_id])) {
				if ($this->popup_css_template_files[$template_id]) {
					$this->popup_css_template[$template_id] = file_get_contents($this->popup_css_template_files[$template_id]);
				} else {
					$this->popup_css_template[$template_id] = '';
				}
			}
			return $this->popup_css_template[$template_id];
		}

		public function get_popup_dependency($display, $style) {
			$dependencies = array();
			if (isset($display['select-signup-type-popup']) && $display['select-signup-type-popup'] === 'popup') {
				$dependencies []= $display['select-popup-after-popup'];
			}
			if (isset($display['select-signup-type-embed']) && $display['select-signup-type-embed'] === 'popup') {
				$dependencies []= $display['select-popup-after-embed'];
			}
			return array_unique($dependencies);
		}

		public function make_backwards_compatible($style) {
			return $style;
		}
		public function merge_default_values($style) {
			$style = wp_parse_args($style, $this->default_values);
			return $style;
		}
		public function generate_position_code($style, $mode) {
			return '';
		}
		public function generate_default_customization_html() {
			$style_html = '<div class="template-customization-block" id="template-customization-block---id---' . $this->uid . '">' .
						$this->show_style_settings('--id--', $this->default_values) . '</div>';
			$style_html = str_replace('{{id}}', '--id--', $style_html);
			$style_html = PopupAllyProSettingShared::replace_all_toggle($style_html, $this->default_values);
			return $style_html;
		}
		public function generate_default_preview_css() {
			$setting = $this->merge_default_values($this->default_values);
			return PopupAllyProStyleCodeGeneration::generate_popup_css('--id--', $setting, false, 1, $this);
		}
		public function get_action_target_options($style_setting) {
			return array('conversion' => PopupAllyProTrackStatistics::$STATS_CATEGORIES['conversion']);
		}
		// <editor-fold defaultstate="collapsed" desc="Utility functions">
		public static function hex_to_rgb($hex, $alpha) {
			$hex = str_replace('#', '', $hex);
			$max = strlen($hex) - 1;
			$result = intval(substr($hex, 0, 2), 16) . ', ';
			$result .= intval(substr($hex, min(2, $max), 2), 16) . ', ';
			$result .= intval(substr($hex, min(4, $max), 2), 16) . ', ' . $alpha;
			return $result;
		}

		public static function image_url_code_generation(&$style, $source_param) {
			if (isset($style[$source_param]) && $style[$source_param]) {
				return 'url(' . $style[$source_param] . ')';
			}
			return 'none';
		}
		protected static function process_field_hidden_status($style, $hide_toggle, $html_input_type, $backend_hide_style, $field_name, $source_name){
			if ('true' === $style[$hide_toggle]) {
				$style[$html_input_type] = 'hidden';
				$style[$backend_hide_style] = 'style="display:none;"';
				$style[$field_name] = '';
			} else {
				$style[$html_input_type] = 'text';
				$style[$backend_hide_style] = '';
				$style[$field_name] = empty($style[$source_name]) ? '' : $style[$source_name];
				$style['used-sign-up-form-fields'] []= empty($style[$source_name]) ? '' : $style[$source_name];
			}
			return $style;
		}
		private function process_individual_field_required_status($style, $type){
			$base_name = 'sign-up-form-' . $type;
			$field_hide_status = $this->style_hide_signup_fields[$type];
			/* never make hidden fields required */
			if ($field_hide_status && isset($style[$field_hide_status]) && $style[$field_hide_status] === 'true') {
				$style[$base_name . '-frontend-required'] = '';
			} else {
				if (isset($style[$base_name . '-is-required']) && 'true' === $style[$base_name . '-is-required']) {
					$style[$base_name . '-frontend-required'] = 'required="required"';
				} else {
					$style[$base_name . '-frontend-required'] = '';
				}
			}
			return $style;
		}
		private function process_field_required_status($style){
			$style = $this->process_individual_field_required_status($style, 'name');
			$style = $this->process_individual_field_required_status($style, 'lname');
			$style = $this->process_individual_field_required_status($style, 'email');
			return $style;
		}
		protected static function process_hide_background_overlay($style, $hide_setting_arg, $background_overlay_css_arg, $content_position_arg) {
			if (isset($style[$hide_setting_arg]) && 'true' === $style[$hide_setting_arg]) {
				$style[$background_overlay_css_arg] = '';
				$style[$content_position_arg] = 'fixed';
			} else {
				$style[$background_overlay_css_arg] = self::POPUP_BACKGROUND_CSS;
				$style[$content_position_arg] = 'absolute';
			}
			return $style;
		}
		protected static function generate_popup_location_selection($style, $location_arg) {
			$template = self::POPUP_LOCATION_SELECTION_TEMPLATE;
			$template = str_replace('s--' . $style[$location_arg] . '--d', 'selected="selected"', self::POPUP_LOCATION_SELECTION_TEMPLATE);
			$template = preg_replace('/s--.*?--d/', '', $template);
			return $template;
		}
		protected function generate_vertical_selection_code($style, $select_arg) {
			if ($style[$select_arg] === 'bottom') {
				return '<option value="top">Top</option><option selected="selected" value="bottom">Bottom</option>';
			}
			return '<option selected="selected" value="top">Top</option><option value="bottom">Bottom</option>';
		}
		protected function generate_horizontal_selection_code($style, $select_arg) {
			if ($style[$select_arg] === 'right') {
				return '<option value="left">Left</option><option selected="selected" value="right">Right</option>';
			}
			return '<option selected="selected" value="left">Left</option><option value="right">Right</option>';
		}
		protected function generate_click_target_attribute($style, $all_style, $prefix) {
			if ($style[$prefix . '-target-type'] === 'popup') {
				$popup_id = $style[$prefix . '-popup-id'];
				if (isset($all_style[$popup_id])) {
					return 'svvuyx-redirect-popup="' . $popup_id . '"';
				}
				return 'svvuyx-redirect-popup=""';
			} else {
				return 'svvuyx-redirect-url="' . esc_attr($style[$prefix . '-url']) . '"';
			}
		}
		protected function generate_background_size_selection_code($style, $select_arg) {
			if ($style[$select_arg] === 'cover') {
				return '<option selected="selected" value="cover">the entire popup is covered (part of the image might be cut-off)</option><option value="contain">the entire image is shown (part of the popup might be blank)</option>';
			}
			return '<option value="cover">the entire popup is covered (part of the image might be cut-off)</option><option selected="selected" value="contain">the entire image is shown (part of the popup might be blank)</option>';;
		}
		// </editor-fold>
	}
	PopupAllyProTemplate::initialize();
}