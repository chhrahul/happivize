<?php
if (!class_exists('PopupAllyProThreeChoiceTemplate')) {
	class PopupAllyProThreeChoiceTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'iejsye';
			$this->template_name = 'Three Musketeers';
			$this->template_order = 11;

			$this->backend_php = dirname(__FILE__) . '/backend/three-choice-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>true, 'name'=>true, 'lname'=>true, 'email'=>true);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/three-choice-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/three-choice-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/three-choice-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/three-choice-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/three-choice-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/three-choice-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/three-choice-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/three-choice-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('iejsye-overlay-close-trigger');
			$this->no_escape_html_mapping = array('iejsye-headline', 'iejsye-textbox-1', 'iejsye-textbox-2', 'iejsye-choice-1-text', 'iejsye-choice-2-text', 'iejsye-choice-3-text',
				'iejsye-choice-1-click-target', 'iejsye-choice-2-click-target', 'iejsye-choice-3-click-target');
			$this->default_values = array(
				'iejsye-background-color' => '#fefefe',
				'iejsye-background-image-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/3muskateers-bg.png',
				'iejsye-background-image' => 'none',
				'iejsye-background-image-size' => 'cover',
				'iejsye-width' => '600',
				'iejsye-height' => '400',
				'iejsye-headline' => 'Who is your favorite Musketeer?',
				'iejsye-headline-font' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'iejsye-headline-color' => "#6d6e71",
				'iejsye-headline-font-size' => "32",
				'iejsye-headline-font-weight' => "700",
				'iejsye-headline-line-height' => "32",
				'iejsye-headline-width' => "400",
				'iejsye-headline-height' => "80",
				'iejsye-headline-align' => "left",
				'iejsye-headline-top' => '30',
				'iejsye-headline-left' => '40',
				'iejsye-textbox-1' => 'Find out what it means about you on the next page!',
				'iejsye-textbox-1-font' => 'Arial, Helvetica, sans-serif',
				'iejsye-textbox-1-color' => "#949494",
				'iejsye-textbox-1-font-size' => "20",
				'iejsye-textbox-1-font-weight' => "700",
				'iejsye-textbox-1-line-height' => "32",
				'iejsye-textbox-1-width' => "500",
				'iejsye-textbox-1-height' => "40",
				'iejsye-textbox-1-align' => "left",
				'iejsye-textbox-1-top' => '345',
				'iejsye-textbox-1-left' => '40',
				'iejsye-textbox-2' => '',
				'iejsye-textbox-2-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'iejsye-textbox-2-color' => "#111111",
				'iejsye-textbox-2-font-size' => "24",
				'iejsye-textbox-2-font-weight' => "700",
				'iejsye-textbox-2-line-height' => "32",
				'iejsye-textbox-2-width' => "0",
				'iejsye-textbox-2-height' => "0",
				'iejsye-textbox-2-align' => "left",
				'iejsye-textbox-2-top' => '0',
				'iejsye-textbox-2-left' => '0',
				'iejsye-image-1' => 'none',
				'iejsye-image-1-url' => '',
				'iejsye-image-1-width' => '0',
				'iejsye-image-1-height' => '0',
				'iejsye-image-1-top' => '0',
				'iejsye-image-1-left' => '0',
				'iejsye-image-2' => 'none',
				'iejsye-image-2-url' => '',
				'iejsye-image-2-width' => '0',
				'iejsye-image-2-height' => '0',
				'iejsye-image-2-top' => '0',
				'iejsye-image-2-left' => '0',
				'iejsye-choice-1-text' => 'Athos',
				'iejsye-choice-1-target-type' => 'url',
				'iejsye-choice-1-url' => '',
				'iejsye-choice-1-popup-id' => '',
				'iejsye-choice-1-background-color' => "#74D3FC",
				'iejsye-choice-1-background-image-url' => '',
				'iejsye-choice-1-background-image' => 'none',
				'iejsye-choice-1-font' => 'Arial, Helvetica, sans-serif',
				'iejsye-choice-1-color' => "#ffffff",
				'iejsye-choice-1-font-size' => "38",
				'iejsye-choice-1-font-weight' => "400",
				'iejsye-choice-1-line-height' => "38",
				'iejsye-choice-1-width' => "200",
				'iejsye-choice-1-height' => "60",
				'iejsye-choice-1-top' => "100",
				'iejsye-choice-1-left' => "320",
				'iejsye-choice-1-align' => "center",
				'iejsye-choice-2-text' => 'Porthos',
				'iejsye-choice-2-target-type' => 'url',
				'iejsye-choice-2-url' => '',
				'iejsye-choice-2-popup-id' => '',
				'iejsye-choice-2-background-color' => "#FC893C",
				'iejsye-choice-2-background-image-url' => '',
				'iejsye-choice-2-background-image' => 'none',
				'iejsye-choice-2-font' => 'Arial, Helvetica, sans-serif',
				'iejsye-choice-2-color' => "#ffffff",
				'iejsye-choice-2-font-size' => "38",
				'iejsye-choice-2-font-weight' => "400",
				'iejsye-choice-2-line-height' => "38",
				'iejsye-choice-2-width' => "200",
				'iejsye-choice-2-height' => "60",
				'iejsye-choice-2-top' => "180",
				'iejsye-choice-2-left' => "320",
				'iejsye-choice-2-align' => "center",
				'iejsye-choice-3-text' => 'Aramis',
				'iejsye-choice-3-target-type' => 'url',
				'iejsye-choice-3-url' => '',
				'iejsye-choice-3-popup-id' => '',
				'iejsye-choice-3-background-color' => "#659C95",
				'iejsye-choice-3-background-image-url' => '',
				'iejsye-choice-3-background-image' => 'none',
				'iejsye-choice-3-font' => 'Arial, Helvetica, sans-serif',
				'iejsye-choice-3-color' => "#ffffff",
				'iejsye-choice-3-font-size' => "38",
				'iejsye-choice-3-font-weight' => "400",
				'iejsye-choice-3-line-height' => "38",
				'iejsye-choice-3-width' => "200",
				'iejsye-choice-3-height' => "60",
				'iejsye-choice-3-top' => "260",
				'iejsye-choice-3-left' => "320",
				'iejsye-choice-3-align' => "center",
				'iejsye-overlay-color' => "#505050",
				'iejsye-overlay-opacity' => '0.5',
				'iejsye-overlay-color-rgba' => '80,80,80,0.5',
				'iejsye-hide-overlay' => 'false',
				'iejsye-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'iejsye-content-box-position' => 'absolute',
				'iejsye-disable-overlay-close' => 'false',
				'iejsye-show-embedded-border' => "false",
				'iejsye-embedded-border-css' => "",
				'iejsye-popup-location' => 'center',
				'iejsye-popup-vertical-selection' => 'top',
				'iejsye-popup-horizontal-selection' => 'left',
				'iejsye-popup-top' => '40%',
				'iejsye-popup-left' => '50%',
				'iejsye-popup-bottom' => '40%',
				'iejsye-popup-right' => '50%',

				'iejsye-width-960' => '500',
				'iejsye-height-960' => '300',
				'iejsye-headline-960-top' => '20',
				'iejsye-headline-960-left' => '40',
				'iejsye-headline-960-width' => "350",
				'iejsye-headline-960-height' => "80",
				'iejsye-headline-960-font-size' => '24',
				'iejsye-headline-960-line-height' => '24',
				'iejsye-textbox-1-960-top' => '260',
				'iejsye-textbox-1-960-left' => '40',
				'iejsye-textbox-1-960-width' => "400",
				'iejsye-textbox-1-960-height' => "40",
				'iejsye-textbox-1-960-font-size' => '16',
				'iejsye-textbox-1-960-line-height' => '16',
				'iejsye-textbox-2-960-top' => '0',
				'iejsye-textbox-2-960-left' => '0',
				'iejsye-textbox-2-960-width' => "0",
				'iejsye-textbox-2-960-height' => "0",
				'iejsye-textbox-2-960-font-size' => '24',
				'iejsye-textbox-2-960-line-height' => '24',
				'iejsye-image-1-960-width' => '0',
				'iejsye-image-1-960-height' => '0',
				'iejsye-image-1-960-top' => '0',
				'iejsye-image-1-960-left' => '0',
				'iejsye-image-2-960-width' => '0',
				'iejsye-image-2-960-height' => '0',
				'iejsye-image-2-960-top' => '0',
				'iejsye-image-2-960-left' => '0',
				'iejsye-choice-1-960-font-size' => "32",
				'iejsye-choice-1-960-line-height' => "32",
				'iejsye-choice-1-960-width' => "150",
				'iejsye-choice-1-960-height' => "40",
				'iejsye-choice-1-960-top' => "80",
				'iejsye-choice-1-960-left' => "280",
				'iejsye-choice-2-960-font-size' => "32",
				'iejsye-choice-2-960-line-height' => "32",
				'iejsye-choice-2-960-width' => "150",
				'iejsye-choice-2-960-height' => "40",
				'iejsye-choice-2-960-top' => "130",
				'iejsye-choice-2-960-left' => "280",
				'iejsye-choice-3-960-font-size' => "32",
				'iejsye-choice-3-960-line-height' => "32",
				'iejsye-choice-3-960-width' => "150",
				'iejsye-choice-3-960-height' => "40",
				'iejsye-choice-3-960-top' => "180",
				'iejsye-choice-3-960-left' => "280",
				'iejsye-popup-960-top' => '50%',
				'iejsye-popup-960-left' => '50%',
				'iejsye-popup-960-bottom' => '50%',
				'iejsye-popup-960-right' => '50%',

				'iejsye-width-640' => '300',
				'iejsye-height-640' => '187',
				'iejsye-headline-640-top' => '10',
				'iejsye-headline-640-left' => '30',
				'iejsye-headline-640-width' => "260",
				'iejsye-headline-640-height' => "40",
				'iejsye-headline-640-font-size' => '20',
				'iejsye-headline-640-line-height' => '20',
				'iejsye-textbox-1-640-top' => '170',
				'iejsye-textbox-1-640-left' => '25',
				'iejsye-textbox-1-640-width' => "270",
				'iejsye-textbox-1-640-height' => "15",
				'iejsye-textbox-1-640-font-size' => '10',
				'iejsye-textbox-1-640-line-height' => '10',
				'iejsye-textbox-2-640-top' => '0',
				'iejsye-textbox-2-640-left' => '0',
				'iejsye-textbox-2-640-width' => "0",
				'iejsye-textbox-2-640-height' => "0",
				'iejsye-textbox-2-640-font-size' => '24',
				'iejsye-textbox-2-640-line-height' => '24',
				'iejsye-image-1-640-width' => '0',
				'iejsye-image-1-640-height' => '0',
				'iejsye-image-1-640-top' => '0',
				'iejsye-image-1-640-left' => '0',
				'iejsye-image-2-640-width' => '0',
				'iejsye-image-2-640-height' => '0',
				'iejsye-image-2-640-top' => '0',
				'iejsye-image-2-640-left' => '0',
				'iejsye-choice-1-640-font-size' => "22",
				'iejsye-choice-1-640-line-height' => "22",
				'iejsye-choice-1-640-width' => "120",
				'iejsye-choice-1-640-height' => "30",
				'iejsye-choice-1-640-top' => "50",
				'iejsye-choice-1-640-left' => "150",
				'iejsye-choice-2-640-font-size' => "22",
				'iejsye-choice-2-640-line-height' => "22",
				'iejsye-choice-2-640-width' => "120",
				'iejsye-choice-2-640-height' => "30",
				'iejsye-choice-2-640-top' => "90",
				'iejsye-choice-2-640-left' => "150",
				'iejsye-choice-3-640-font-size' => "22",
				'iejsye-choice-3-640-line-height' => "22",
				'iejsye-choice-3-640-width' => "120",
				'iejsye-choice-3-640-height' => "30",
				'iejsye-choice-3-640-top' => "130",
				'iejsye-choice-3-640-left' => "150",
				'iejsye-popup-640-top' => '50%',
				'iejsye-popup-640-left' => '50%',
				'iejsye-popup-640-bottom' => '50%',
				'iejsye-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'iejsye-headline' => array(0, '.iejsye-preview-headline', '#iejsye-preview-headline'),
				'iejsye-textbox-1' => array(0, '.iejsye-preview-textbox-1', '#iejsye-preview-textbox-1'),
				'iejsye-textbox-2' => array(0, '.iejsye-preview-textbox-2', '#iejsye-preview-textbox-2'),
				'iejsye-choice-1' => array(0, '.iejsye-preview-choice-1-text', '#iejsye-preview-choice-1-text'),
				'iejsye-choice-2' => array(0, '.iejsye-preview-choice-2-text', '#iejsye-preview-choice-2-text'),
				'iejsye-choice-3' => array(0, '.iejsye-preview-choice-3-text', '#iejsye-preview-choice-3-text'),
				'iejsye-headline-960' => array(3, '#iejsye-preview-headline-960'),
				'iejsye-textbox-1-960' => array(3, '#iejsye-preview-textbox-1-960'),
				'iejsye-textbox-2-960' => array(3, '#iejsye-preview-textbox-2-960'),
				'iejsye-choice-1-960' => array(3, '#iejsye-preview-choice-1-text-960'),
				'iejsye-choice-2-960' => array(3, '#iejsye-preview-choice-2-text-960'),
				'iejsye-choice-3-960' => array(3, '#iejsye-preview-choice-3-text-960'),
				'iejsye-headline-640' => array(3, '#iejsye-preview-headline-640'),
				'iejsye-textbox-1-640' => array(3, '#iejsye-preview-textbox-1-640'),
				'iejsye-textbox-2-640' => array(3, '#iejsye-preview-textbox-2-640'),
				'iejsye-choice-1-640' => array(3, '#iejsye-preview-choice-1-text-640'),
				'iejsye-choice-2-640' => array(3, '#iejsye-preview-choice-2-text-640'),
				'iejsye-choice-3-640' => array(3, '#iejsye-preview-choice-3-text-640'),
			);
			$this->style_template_checked_replace = array(
				'iejsye-hide-overlay',
				'iejsye-disable-overlay-close',
				'iejsye-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['iejsye-text-color'])) {
					$new_style[$id]['iejsye-headline-color'] = $setting['iejsye-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['iejsye-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'iejsye-background-image-url');
			$style['iejsye-image-1'] = PopupAllyProTemplate::image_url_code_generation($style, 'iejsye-image-1-url');
			$style['iejsye-image-2'] = PopupAllyProTemplate::image_url_code_generation($style, 'iejsye-image-2-url');
			$style['iejsye-choice-1-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'iejsye-choice-1-background-image-url');
			$style['iejsye-choice-2-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'iejsye-choice-2-background-image-url');
			$style['iejsye-choice-3-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'iejsye-choice-3-background-image-url');

			// disable background close trigger
			if ('true' === $style['iejsye-disable-overlay-close']) {
				$style['iejsye-overlay-close-trigger'] = '';
			} else {
				$style['iejsye-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['iejsye-show-embedded-border']) {
				$style['iejsye-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['iejsye-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'iejsye-hide-overlay', 'iejsye-background-overlay-css', 'iejsye-content-box-position');
			$style['iejsye-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['iejsye-overlay-color'], $style['iejsye-overlay-opacity']);

			if ($all_style) {
				$style['iejsye-choice-1-click-target'] = PopupAllyProTemplate::generate_click_target_attribute($style, $all_style, 'iejsye-choice-1');
				$style['iejsye-choice-2-click-target'] = PopupAllyProTemplate::generate_click_target_attribute($style, $all_style, 'iejsye-choice-2');
				$style['iejsye-choice-3-click-target'] = PopupAllyProTemplate::generate_click_target_attribute($style, $all_style, 'iejsye-choice-3');
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

			$html = str_replace("{{iejsye-background-image-size}}", PopupAllyProTemplate::generate_background_size_selection_code($setting, 'iejsye-background-image-size'), $html);

			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{iejsye-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'iejsye-popup-location'), $html);
			$html = str_replace("{{iejsye-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'iejsye-popup-vertical-selection'), $html);
			$html = str_replace("{{iejsye-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'iejsye-popup-horizontal-selection'), $html);
			return $html;
		}

		public function get_popup_dependency($display, $style) {
			$dependencies = parent::get_popup_dependency($display, $style);
			if ('popup' === $style['iejsye-choice-1-target-type']) {
				$dependencies []= $style['iejsye-choice-1-popup-id'];
			}
			if ('popup' === $style['iejsye-choice-2-target-type']) {
				$dependencies []= $style['iejsye-choice-2-popup-id'];
			}
			if ('popup' === $style['iejsye-choice-3-target-type']) {
				$dependencies []= $style['iejsye-choice-3-popup-id'];
			}
			return $dependencies;
		}

		public function make_backwards_compatible($style) {
			if (!isset($style['iejsye-background-image-size'])) {
				$style['iejsye-background-image-size'] = 'contain';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['iejsye-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['iejsye-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['iejsye-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['iejsye-popup-location'] === 'other') {
				return $style['iejsye-popup-vertical-selection'] . ':' . $style['iejsye-popup' . $size_postfix. '-' . $style['iejsye-popup-vertical-selection']] . ';' .
						$style['iejsye-popup-horizontal-selection'] . ':' . $style['iejsye-popup' . $size_postfix. '-' . $style['iejsye-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['iejsye-popup-location']];
		}
		public function get_action_target_options($style_setting) {
			return array('Choice 1 clicked' => array('Choice 1 clicked', 'Choice 1 clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', 'Choice 1 clicked')),
				'Choice 2 clicked' => array('Choice 2 clicked', 'Choice 2 clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', 'Choice 2 clicked')),
				'Choice 3 clicked' => array('Choice 3 clicked', 'Choice 3 clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', 'Choice 3 clicked')));
		}
	}
	PopupAllyPro::add_template(new PopupAllyProThreeChoiceTemplate());
}
