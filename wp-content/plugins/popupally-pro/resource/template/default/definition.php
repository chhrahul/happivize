<?php
if (!class_exists('PopupAllyProDefaultTemplate')) {
	class PopupAllyProDefaultTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'bxsjbi';
			$this->template_name = 'Tried-and-true';
			$this->template_order = 0;

			$this->backend_php = dirname(__FILE__) . '/backend/default-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'hide-name-field', 'lname'=>true, 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/default-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/default-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/default-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/default-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/default-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/default-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/default-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/default-pro-popup-top-margin.css',
			);

			$this->frontend_css = dirname(__FILE__) . '/frontend/default-pro-popup.css';
			$this->frontend_php = dirname(__FILE__) . '/frontend/default-pro-popup.php';
			$this->frontend_embedded_php = dirname(__FILE__) . '/frontend/default-pro-embedded.php';

			$this->html_mapping = array('image-url',
				'subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'bxsjbi-sign-up-form-name-field',
				'sign-up-form-email-field', 'name-placeholder', 'email-placeholder', 'overlay-close-trigger', 'name-input-type');
			$this->no_escape_html_mapping = array('headline', 'sales-text', 'privacy-text', 'bxsjbi-preview-hide-name', 'sign-up-form-name-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'headline' => "Enter your name and email and get the weekly newsletter... it's FREE!",
				'headline-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'headline-color' => "#444444",
				'headline-font-size' => "28",
				'headline-font-weight' => "700",
				'headline-line-height' => "30",
				'headline-align' => "center",
				'sales-text' => 'Introduce yourself and your program',
				'sales-text-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'sales-text-color' => "#444444",
				'sales-text-font-size' => "24",
				'sales-text-font-weight' => "400",
				'sales-text-line-height' => "28",
				'sales-text-align' => "left",
				'logo-row-margin-top' => "20",
				'logo-row-margin-bottom' => "20",
				'name-placeholder' => 'Enter your first name here',
				'email-placeholder' => 'Enter a valid email here',
				'input-box-font' => 'Arial, Helvetica, sans-serif',
				'input-box-color' => "#444444",
				'input-box-background-color' => "#f6f6f6",
				'input-box-font-size' => "16",
				'input-box-line-height' => "21",
				'input-box-font-weight' => "400",
				'input-box-padding-top' => '15',
				'input-box-padding-bottom' => '15',
				'input-box-padding-left' => '12',
				'input-box-padding-right' => '12',
				'input-box-width' => '100%',
				'input-box-align' => "left",
				'input-box-border-radius' => "3",
				'hide-name-field' => "false",
				'subscribe-button-text' => 'Subscribe',
				'subscribe-button-text-font' => 'Arial, Helvetica, sans-serif',
				'subscribe-button-text-color' => "#ffffff",
				'subscribe-button-text-font-size' => "22",
				'subscribe-button-text-font-weight' => "700",
				'subscribe-button-text-line-height' => "27",
				'subscribe-button-text-align' => "center",
				'subscribe-button-text-padding-top' => '15',
				'subscribe-button-text-padding-bottom' => '15',
				'subscribe-button-text-width' => '100%',
				'subscribe-button-text-border-radius' => "3",
				'subscribe-button-margin-top' => "10",
				'subscribe-button-margin-bottom' => "10",
				'privacy-text' => 'Your information will *never* be shared or sold to a 3rd party.',
				'privacy-text-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'privacy-text-color' => "#444444",
				'privacy-text-font-size' => "14",
				'privacy-text-font-weight' => "400",
				'privacy-text-line-height' => "14",
				'privacy-text-align' => "center",
				'privacy-text-margin-top' => "10",
				'privacy-text-margin-bottom' => "10",
				'overlay-color' => "#505050",
				'overlay-opacity' => '0.5',
				'overlay-color-rgba' => '80,80,80,0.5',
				'bxsjbi-hide-overlay' => 'false',
				'bxsjbi-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'bxsjbi-content-box-position' => 'absolute',
				'disable-overlay-close' => "false",
				'bxsjbi-show-embedded-border' => "false",
				'bxsjbi-embedded-border-css' => "",
				'background-color' => '#fefefe',
				'subscribe-button-color' => '#00c98d',
				'bxsjbi-headline-hide-toggle' => 'false',
				'bxsjbi-logo-row-hide-toggle' => 'false',
				'bxsjbi-logo-img-hide-toggle' => 'false',
				'bxsjbi-privacy-hide-toggle' => 'false',
				'image-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/pink-tools.png',
				'bxsjbi-popup-location' => 'center',
				'bxsjbi-popup-vertical-selection' => 'top',
				'bxsjbi-popup-horizontal-selection' => 'left',
				'bxsjbi-popup-top' => '20%',
				'bxsjbi-popup-left' => '50%',
				'bxsjbi-popup-bottom' => '20%',
				'bxsjbi-popup-right' => '50%',

				'bxsjbi-popup-960-top' => '20%',
				'bxsjbi-popup-960-left' => '50%',
				'bxsjbi-popup-960-bottom' => '20%',
				'bxsjbi-popup-960-right' => '50%',
				'headline-960-font-size' => '24',
				'headline-960-line-height' => '26',
				'sales-text-960-font-size' => '20',
				'sales-text-960-line-height' => '22',
				'privacy-text-960-font-size' => '10',
				'privacy-text-960-line-height' => '10',
				'input-box-960-font-size' => "12",
				'input-box-960-line-height' => "18",
				'input-box-960-padding-top' => '10',
				'input-box-960-padding-bottom' => '10',
				'input-box-960-padding-left' => '10',
				'input-box-960-padding-right' => '10',
				'input-box-960-width' => '100%',
				'input-box-960-border-radius' => "3",
				'subscribe-button-text-960-font-size' => "18",
				'subscribe-button-text-960-line-height' => "24",
				'subscribe-button-text-960-padding-top' => '10',
				'subscribe-button-text-960-padding-bottom' => '10',
				'subscribe-button-text-960-width' => '100%',
				'subscribe-button-text-960-border-radius' => "3",

				'bxsjbi-popup-640-top' => '20%',
				'bxsjbi-popup-640-left' => '50%',
				'bxsjbi-popup-640-bottom' => '20%',
				'bxsjbi-popup-640-right' => '50%',
				'headline-640-font-size' => '18',
				'headline-640-line-height' => '20',
				'sales-text-640-font-size' => '12',
				'sales-text-640-line-height' => '14',
				'privacy-text-640-font-size' => '8',
				'privacy-text-640-line-height' => '8',
				'input-box-640-font-size' => "10",
				'input-box-640-line-height' => "14",
				'input-box-640-padding-top' => '10',
				'input-box-640-padding-bottom' => '10',
				'input-box-640-padding-left' => '6',
				'input-box-640-padding-right' => '6',
				'input-box-640-width' => '100%',
				'input-box-640-border-radius' => "3",
				'subscribe-button-text-640-font-size' => "16",
				'subscribe-button-text-640-line-height' => "20",
				'subscribe-button-text-640-padding-top' => '8',
				'subscribe-button-text-640-padding-bottom' => '8',
				'subscribe-button-text-640-width' => '100%',
				'subscribe-button-text-640-border-radius' => "3",
			);
			$this->style_template_advanced_customization = array(
				'headline' => array(0, '.preview-headline', '#preview-headline'),
				'sales-text' => array(0, '.preview-sales-text', '#preview-sales-text'),
				'privacy-text' => array(0, '.privacy-text', '#privacy-text'),
				'input-box' => array(1, '.preview-input', '.preview-input-desktop'),
				'subscribe-button-text' => array(2, '.subscribe-button', '#subscribe-button'),
				'headline-960' => array(3, '#preview-headline-960'),
				'sales-text-960' => array(3, '#preview-sales-text-960'),
				'privacy-text-960' => array(3, '#privacy-text-960'),
				'input-box-960' => array(4, '.preview-input-960'),
				'subscribe-button-text-960' => array(5, '#subscribe-button-960'),
				'headline-640' => array(3, '#preview-headline-640'),
				'sales-text-640' => array(3, '#preview-sales-text-640'),
				'privacy-text-640' => array(3, '#privacy-text-640'),
				'input-box-640' => array(4, '.preview-input-640'),
				'subscribe-button-text-640' => array(5, '#subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'hide-name-field',
				'bxsjbi-hide-overlay',
				'disable-overlay-close',
				'bxsjbi-show-embedded-border',
				'bxsjbi-headline-hide-toggle',
				'bxsjbi-logo-row-hide-toggle',
				'bxsjbi-logo-img-hide-toggle',
				'bxsjbi-privacy-hide-toggle',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['text-color'])) {
					$new_style[$id]['headline-color'] = $new_style[$id]['sales-text-color'] = $new_style[$id]['input-box-color'] = $new_style[$id]['privacy-text-color'] = $setting['text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);
			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			// disable background close trigger
			if ('true' === $style['disable-overlay-close']) {
				$style['overlay-close-trigger'] = '';
			} else {
				$style['overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['bxsjbi-show-embedded-border']) {
				$style['bxsjbi-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['bxsjbi-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'hide-name-field', 'name-input-type', 'bxsjbi-preview-hide-name', 'bxsjbi-sign-up-form-name-field', 'sign-up-form-name-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'bxsjbi-hide-overlay', 'bxsjbi-background-overlay-css', 'bxsjbi-content-box-position');
			$style['overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['overlay-color'], $style['overlay-opacity']);
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
			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{bxsjbi-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'bxsjbi-popup-location'), $html);
			$html = str_replace("{{bxsjbi-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'bxsjbi-popup-vertical-selection'), $html);
			$html = str_replace("{{bxsjbi-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'bxsjbi-popup-horizontal-selection'), $html);
			return $html;
		}

		public function make_backwards_compatible($style) {
			if (isset($style['display-headline'])) {
				$style['bxsjbi-headline-hide-toggle'] = $style['display-headline'] === 'block' ? 'false' : 'true';
			}
			if (isset($style['display-logo-row'])) {
				$style['bxsjbi-logo-row-hide-toggle'] = $style['display-logo-row'] === 'block' ? 'false' : 'true';
			}
			if (isset($style['display-logo-img'])) {
				$style['bxsjbi-logo-img-hide-toggle'] = $style['display-logo-img'] === 'block' ? 'false' : 'true';
			}
			if (isset($style['display-privacy'])) {
				$style['bxsjbi-privacy-hide-toggle'] = $style['display-privacy'] === 'block' ? 'false' : 'true';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['bxsjbi-popup-location'] === 'center') {
				if ($size_postfix === '-960') {
					return 'top:20%;left:50%;margin-left:-240px;';
				} elseif ($size_postfix === '-640') {
					return 'top:20%;left:50%;margin-left:-150px;';
				} else {
					return 'top:20%;left:50%;margin-left:-325px;';
				}
			} elseif ($style['bxsjbi-popup-location'] === 'other') {
				return $style['bxsjbi-popup-vertical-selection'] . ':' . $style['bxsjbi-popup' . $size_postfix. '-' . $style['bxsjbi-popup-vertical-selection']] . ';' .
						$style['bxsjbi-popup-horizontal-selection'] . ':' . $style['bxsjbi-popup' . $size_postfix. '-' . $style['bxsjbi-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['bxsjbi-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProDefaultTemplate());
}