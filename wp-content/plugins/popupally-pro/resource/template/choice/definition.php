<?php
if (!class_exists('PopupAllyProChoiceTemplate')) {
	class PopupAllyProChoiceTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'oeudhw';
			$this->template_name = 'Simple Choice';
			$this->template_order = 3;

			$this->backend_php = dirname(__FILE__) . '/backend/choice-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>true, 'name'=>true, 'lname'=>true, 'email'=>true);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/choice-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/choice-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/choice-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/choice-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/choice-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/choice-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/choice-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/choice-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('oeudhw-overlay-close-trigger');
			$this->no_escape_html_mapping = array('oeudhw-headline', 'oeudhw-left-choice-text', 'oeudhw-right-choice-text', 'oeudhw-left-click-target', 'oeudhw-right-click-target');
			$this->default_values = array(
				'oeudhw-background-color' => '#ffffff',
				'oeudhw-image-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/two-options-bg.png',
				'oeudhw-background-image' => 'none',
				'oeudhw-background-image-size' => 'cover',
				'oeudhw-width' => '650',
				'oeudhw-height' => '450',
				'oeudhw-headline' => 'Could You Use More Traffic, <br/>Subscribers, and Sales in Your<br/>Online Business?',
				'oeudhw-headline-font' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'oeudhw-headline-color' => "#6d6e71",
				'oeudhw-headline-font-size' => "36",
				'oeudhw-headline-font-weight' => "400",
				'oeudhw-headline-line-height' => "40",
				'oeudhw-headline-margin-top' => "80",
				'oeudhw-headline-margin-bottom' => "0",
				'oeudhw-headline-align' => "center",
				'oeudhw-left-choice-text' => 'Yes!',
				'oeudhw-left-choice-target-type' => 'url',
				'oeudhw-left-choice-url' => '',
				'oeudhw-left-choice-popup-id' => '',
				'oeudhw-left-choice-background-color' => "#FCC302",
				'oeudhw-left-choice-background-image-url' => '',
				'oeudhw-left-choice-background-image' => 'none',
				'oeudhw-left-choice-font' => 'Arial, Helvetica, sans-serif',
				'oeudhw-left-choice-color' => "#ffffff",
				'oeudhw-left-choice-font-size' => "38",
				'oeudhw-left-choice-font-weight' => "400",
				'oeudhw-left-choice-line-height' => "38",
				'oeudhw-left-choice-width' => "229",
				'oeudhw-left-choice-height' => "113",
				'oeudhw-left-choice-margin-top' => "60",
				'oeudhw-left-choice-margin-bottom' => "20",
				'oeudhw-left-choice-align' => "center",
				'oeudhw-right-choice-text' => '',
				'oeudhw-right-choice-target-type' => 'url',
				'oeudhw-right-choice-url' => '',
				'oeudhw-right-choice-popup-id' => '',
				'oeudhw-right-choice-background-color' => "#D9D9DA",
				'oeudhw-right-choice-background-image-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/no-thanks.png',
				'oeudhw-right-choice-background-image' => 'none',
				'oeudhw-right-choice-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'oeudhw-right-choice-color' => "#ffffff",
				'oeudhw-right-choice-font-size' => "38",
				'oeudhw-right-choice-font-weight' => "400",
				'oeudhw-right-choice-line-height' => "38",
				'oeudhw-right-choice-width' => "229",
				'oeudhw-right-choice-height' => "113",
				'oeudhw-right-choice-margin-top' => "60",
				'oeudhw-right-choice-margin-bottom' => "20",
				'oeudhw-right-choice-align' => "center",
				'oeudhw-overlay-color' => "#505050",
				'oeudhw-overlay-opacity' => '0.5',
				'oeudhw-overlay-color-rgba' => '80,80,80,0.5',
				'oeudhw-hide-overlay' => 'false',
				'oeudhw-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'oeudhw-content-box-position' => 'absolute',
				'oeudhw-disable-overlay-close' => 'false',
				'oeudhw-show-embedded-border' => "false",
				'oeudhw-embedded-border-css' => "",
				'oeudhw-popup-location' => 'center',
				'oeudhw-popup-vertical-selection' => 'top',
				'oeudhw-popup-horizontal-selection' => 'left',
				'oeudhw-popup-top' => '40%',
				'oeudhw-popup-left' => '50%',
				'oeudhw-popup-bottom' => '40%',
				'oeudhw-popup-right' => '50%',

				'oeudhw-width-960' => '500',
				'oeudhw-height-960' => '346',
				'oeudhw-headline-960-font-size' => "28",
				'oeudhw-headline-960-line-height' => "32",
				'oeudhw-headline-960-margin-top' => "60",
				'oeudhw-headline-960-margin-bottom' => "0",
				'oeudhw-left-choice-960-font-size' => "32",
				'oeudhw-left-choice-960-line-height' => "32",
				'oeudhw-left-choice-960-width' => "176",
				'oeudhw-left-choice-960-height' => "87",
				'oeudhw-left-choice-960-margin-top' => "46",
				'oeudhw-left-choice-960-margin-bottom' => "20",
				'oeudhw-right-choice-960-font-size' => "32",
				'oeudhw-right-choice-960-line-height' => "32",
				'oeudhw-right-choice-960-width' => "176",
				'oeudhw-right-choice-960-height' => "87",
				'oeudhw-right-choice-960-margin-top' => "46",
				'oeudhw-right-choice-960-margin-bottom' => "20",
				'oeudhw-popup-960-top' => '50%',
				'oeudhw-popup-960-left' => '50%',
				'oeudhw-popup-960-bottom' => '50%',
				'oeudhw-popup-960-right' => '50%',

				'oeudhw-width-640' => '300',
				'oeudhw-height-640' => '208',
				'oeudhw-headline-640-font-size' => "18",
				'oeudhw-headline-640-line-height' => "20",
				'oeudhw-headline-640-margin-top' => "30",
				'oeudhw-headline-640-margin-bottom' => "0",
				'oeudhw-left-choice-640-font-size' => "28",
				'oeudhw-left-choice-640-line-height' => "28",
				'oeudhw-left-choice-640-width' => "120",
				'oeudhw-left-choice-640-height' => "60",
				'oeudhw-left-choice-640-margin-top' => "28",
				'oeudhw-left-choice-640-margin-bottom' => "20",
				'oeudhw-right-choice-640-font-size' => "28",
				'oeudhw-right-choice-640-line-height' => "28",
				'oeudhw-right-choice-640-width' => "120",
				'oeudhw-right-choice-640-height' => "60",
				'oeudhw-right-choice-640-margin-top' => "28",
				'oeudhw-right-choice-640-margin-bottom' => "20",
				'oeudhw-popup-640-top' => '50%',
				'oeudhw-popup-640-left' => '50%',
				'oeudhw-popup-640-bottom' => '50%',
				'oeudhw-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'oeudhw-headline' => array(0, '.oeudhw-preview-headline', '#oeudhw-preview-headline'),
				'oeudhw-left-choice' => array(0, '.oeudhw-preview-left-choice-text', '#oeudhw-preview-left-choice-text'),
				'oeudhw-right-choice' => array(0, '.oeudhw-preview-right-choice-text', '#oeudhw-preview-right-choice-text'),
				'oeudhw-headline-960' => array(3, '.oeudhw-preview-headline-960'),
				'oeudhw-left-choice-960' => array(3, '#oeudhw-preview-left-choice-960-text'),
				'oeudhw-right-choice-960' => array(3, '#oeudhw-preview-right-choice-960-text'),
				'oeudhw-headline-640' => array(3, '.oeudhw-preview-headline-640'),
				'oeudhw-left-choice-640' => array(3, '#oeudhw-preview-left-choice-640-text'),
				'oeudhw-right-choice-640' => array(3, '#oeudhw-preview-right-choice-640-text'),
			);
			$this->style_template_checked_replace = array(
				'oeudhw-hide-overlay',
				'oeudhw-disable-overlay-close',
				'oeudhw-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['oeudhw-text-color'])) {
					$new_style[$id]['oeudhw-headline-color'] = $setting['oeudhw-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['oeudhw-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'oeudhw-image-url');
			$style['oeudhw-left-choice-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'oeudhw-left-choice-background-image-url');
			$style['oeudhw-right-choice-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'oeudhw-right-choice-background-image-url');

			// disable background close trigger
			if ('true' === $style['oeudhw-disable-overlay-close']) {
				$style['oeudhw-overlay-close-trigger'] = '';
			} else {
				$style['oeudhw-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['oeudhw-show-embedded-border']) {
				$style['oeudhw-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['oeudhw-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'oeudhw-hide-overlay', 'oeudhw-background-overlay-css', 'oeudhw-content-box-position');

			$style['oeudhw-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['oeudhw-overlay-color'], $style['oeudhw-overlay-opacity']);

			if ($all_style) {
				$style['oeudhw-left-click-target'] = PopupAllyProTemplate::generate_click_target_attribute($style, $all_style, 'oeudhw-left-choice');
				$style['oeudhw-right-click-target'] = PopupAllyProTemplate::generate_click_target_attribute($style, $all_style, 'oeudhw-right-choice');
			}
			return $style;
		}
		public function show_style_settings($id, $setting) {
			$preview_code = PopupAllyProStyleCodeGeneration::generate_popup_html($id, $setting, false, 2, $this);
			$html = $this->get_style_setting_template();

			foreach($this->style_template_advanced_customization as $name => $tuple) {
				$advanced_edit = PopupAllyProTemplate::generate_advanced_customization_code($setting, $name, $tuple);

				$html = str_replace("{{{$name}-advanced}}", $advanced_edit, $html);
			}

			for ($i=2;$i<=4;++$i) {
				$html = str_replace("{{preview-code-$i}}", $preview_code[$i], $html);
			}

			// the order is important, as style_template_checked_replace is a subset of default_values
			foreach($this->style_template_checked_replace as $param) {
				$html = str_replace("{{{$param}}}", 'true' === $setting[$param] ? 'checked="checked"' : '', $html);
			}

			$html = str_replace("{{oeudhw-background-image-size}}", PopupAllyProTemplate::generate_background_size_selection_code($setting, 'oeudhw-background-image-size'), $html);

			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{oeudhw-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'oeudhw-popup-location'), $html);
			$html = str_replace("{{oeudhw-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'oeudhw-popup-vertical-selection'), $html);
			$html = str_replace("{{oeudhw-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'oeudhw-popup-horizontal-selection'), $html);
			return $html;
		}

		public function get_popup_dependency($display, $style) {
			$dependencies = parent::get_popup_dependency($display, $style);
			if ('popup' === $style['oeudhw-left-choice-target-type']) {
				$dependencies []= $style['oeudhw-left-choice-popup-id'];
			}
			if ('popup' === $style['oeudhw-right-choice-target-type'] && !in_array($style['oeudhw-right-choice-popup-id'], $dependencies)) {
				$dependencies []= $style['oeudhw-right-choice-popup-id'];
			}
			return $dependencies;
		}

		public function make_backwards_compatible($style) {
			if (!isset($style['oeudhw-background-image-size'])) {
				$style['oeudhw-background-image-size'] = 'contain';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['oeudhw-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['oeudhw-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['oeudhw-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['oeudhw-popup-location'] === 'other') {
				return $style['oeudhw-popup-vertical-selection'] . ':' . $style['oeudhw-popup' . $size_postfix. '-' . $style['oeudhw-popup-vertical-selection']] . ';' .
						$style['oeudhw-popup-horizontal-selection'] . ':' . $style['oeudhw-popup' . $size_postfix. '-' . $style['oeudhw-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['oeudhw-popup-location']];
		}
		public function get_action_target_options($style_setting) {
			return array('Left Choice clicked' => array('Left Choice clicked', 'Left Choice clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', 'Left Choice clicked')),
				'Right Choice clicked' => array('Right Choice clicked', 'Right Choice clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', 'Right Choice clicked')));
		}
	}
	PopupAllyPro::add_template(new PopupAllyProChoiceTemplate());
}
