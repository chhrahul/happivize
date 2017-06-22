<?php
if (!class_exists('PopupAllyProBigLogoTemplate')) {
	class PopupAllyProBigLogoTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'tozpom';
			$this->template_name = 'Edge to Edge';
			$this->template_order = 4;

			$this->backend_php = dirname(__FILE__) . '/backend/big-logo-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'tozpom-hide-name-field', 'lname'=>true, 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/big-logo-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/big-logo-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/big-logo-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/big-logo-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/big-logo-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/big-logo-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/big-logo-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/big-logo-pro-popup-top-margin.css',
			);

			$this->frontend_css = dirname(__FILE__) . '/frontend/big-logo-pro-popup.css';
			$this->frontend_php = dirname(__FILE__) . '/frontend/big-logo-pro-popup.php';
			$this->frontend_embedded_php = dirname(__FILE__) . '/frontend/big-logo-pro-embedded.php';

			$this->html_mapping = array(
				'tozpom-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'tozpom-sign-up-form-name-field',
				'sign-up-form-email-field', 'tozpom-name-placeholder', 'tozpom-email-placeholder', 'tozpom-overlay-close-trigger', 'tozpom-name-input-type');
			$this->no_escape_html_mapping = array('tozpom-headline', 'tozpom-privacy-text', 'tozpom-preview-hide-name', 'sign-up-form-name-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'tozpom-background-color' => '#fefefe',
				'tozpom-background-image-url' => '',
				'tozpom-background-image' => 'none',
				'tozpom-width' => '650',
				'tozpom-height' => '430',
				'tozpom-headline' => "Enter your name and email and get the weekly newsletter... it's FREE!",
				'tozpom-headline-margin-top' => "0",
				'tozpom-headline-margin-bottom' => "0",
				'tozpom-headline-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'tozpom-headline-color' => "#444444",
				'tozpom-headline-font-size' => "28",
				'tozpom-headline-font-weight' => "700",
				'tozpom-headline-line-height' => "30",
				'tozpom-headline-align' => "center",
				'tozpom-logo-img-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/pink-tools.png',
				'tozpom-logo-img' => 'none',
				'tozpom-logo-img-width' => "650",
				'tozpom-logo-img-height' => "100",
				'tozpom-logo-img-margin-top' => "20",
				'tozpom-logo-img-margin-bottom' => "20",
				'tozpom-name-placeholder' => 'Enter your first name here',
				'tozpom-name-font' => 'Arial, Helvetica, sans-serif',
				'tozpom-name-color' => "#444444",
				'tozpom-name-background-color' => "#f6f6f6",
				'tozpom-name-font-size' => "16",
				'tozpom-name-line-height' => "21",
				'tozpom-name-font-weight' => "400",
				'tozpom-name-padding-top' => '15',
				'tozpom-name-padding-bottom' => '15',
				'tozpom-name-padding-left' => '12',
				'tozpom-name-padding-right' => '12',
				'tozpom-name-width' => '100%',
				'tozpom-name-align' => "left",
				'tozpom-name-border-radius' => "3",
				'tozpom-hide-name-field' => "false",
				'tozpom-email-placeholder' => 'Enter a valid email here',
				'tozpom-email-font' => 'Arial, Helvetica, sans-serif',
				'tozpom-email-color' => "#444444",
				'tozpom-email-background-color' => "#f6f6f6",
				'tozpom-email-font-size' => "16",
				'tozpom-email-line-height' => "21",
				'tozpom-email-font-weight' => "400",
				'tozpom-email-padding-top' => '15',
				'tozpom-email-padding-bottom' => '15',
				'tozpom-email-padding-left' => '12',
				'tozpom-email-padding-right' => '12',
				'tozpom-email-width' => '100%',
				'tozpom-email-align' => "left",
				'tozpom-email-border-radius' => "3",
				'tozpom-email-margin-top' => "10",
				'tozpom-subscribe-button-text' => 'Subscribe',
				'tozpom-subscribe-button-text-font' => 'Arial, Helvetica, sans-serif',
				'tozpom-subscribe-button-text-color' => "#ffffff",
				'tozpom-subscribe-button-text-font-size' => "22",
				'tozpom-subscribe-button-text-font-weight' => "700",
				'tozpom-subscribe-button-text-line-height' => "27",
				'tozpom-subscribe-button-text-align' => "center",
				'tozpom-subscribe-button-text-padding-top' => '15',
				'tozpom-subscribe-button-text-padding-bottom' => '15',
				'tozpom-subscribe-button-text-width' => '100%',
				'tozpom-subscribe-button-text-border-radius' => "3",
				'tozpom-subscribe-button-color' => '#00c98d',
				'tozpom-subscribe-button-margin-top' => "10",
				'tozpom-subscribe-button-margin-bottom' => "10",
				'tozpom-privacy-text' => 'Your information will *never* be shared or sold to a 3rd party.',
				'tozpom-privacy-text-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'tozpom-privacy-text-color' => "#444444",
				'tozpom-privacy-text-font-size' => "14",
				'tozpom-privacy-text-font-weight' => "400",
				'tozpom-privacy-text-line-height' => "14",
				'tozpom-privacy-text-align' => "center",
				'tozpom-privacy-text-margin-top' => "10",
				'tozpom-privacy-text-margin-bottom' => "10",
				'tozpom-overlay-color' => "#505050",
				'tozpom-overlay-opacity' => '0.5',
				'tozpom-overlay-color-rgba' => '80,80,80,0.5',
				'tozpom-hide-overlay' => 'false',
				'tozpom-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'tozpom-content-box-position' => 'absolute',
				'tozpom-disable-overlay-close' => "false",
				'tozpom-show-embedded-border' => "false",
				'tozpom-embedded-border-css' => "",
				'tozpom-headline-hide-toggle' => 'false',
				'tozpom-privacy-hide-toggle' => 'false',
				'tozpom-popup-location' => 'center',
				'tozpom-popup-vertical-selection' => 'top',
				'tozpom-popup-horizontal-selection' => 'left',
				'tozpom-popup-top' => '40%',
				'tozpom-popup-left' => '50%',
				'tozpom-popup-bottom' => '40%',
				'tozpom-popup-right' => '50%',

				'tozpom-width-960' => '500',
				'tozpom-height-960' => '340',
				'tozpom-headline-960-margin-top' => "0",
				'tozpom-headline-960-margin-bottom' => "0",
				'tozpom-headline-960-font-size' => "24",
				'tozpom-headline-960-line-height' => "28",
				'tozpom-logo-img-960-width' => "500",
				'tozpom-logo-img-960-height' => "80",
				'tozpom-logo-img-960-margin-top' => "15",
				'tozpom-logo-img-960-margin-bottom' => "15",
				'tozpom-name-960-font-size' => "14",
				'tozpom-name-960-line-height' => "18",
				'tozpom-name-960-padding-top' => '10',
				'tozpom-name-960-padding-bottom' => '10',
				'tozpom-name-960-padding-left' => '10',
				'tozpom-name-960-padding-right' => '10',
				'tozpom-name-960-width' => '100%',
				'tozpom-name-960-border-radius' => "3",
				'tozpom-email-960-font-size' => "14",
				'tozpom-email-960-line-height' => "18",
				'tozpom-email-960-padding-top' => '10',
				'tozpom-email-960-padding-bottom' => '10',
				'tozpom-email-960-padding-left' => '10',
				'tozpom-email-960-padding-right' => '10',
				'tozpom-email-960-width' => '100%',
				'tozpom-email-960-border-radius' => "3",
				'tozpom-email-960-margin-top' => "10",
				'tozpom-subscribe-button-text-960-font-size' => "18",
				'tozpom-subscribe-button-text-960-line-height' => "18",
				'tozpom-subscribe-button-text-960-padding-top' => '12',
				'tozpom-subscribe-button-text-960-padding-bottom' => '12',
				'tozpom-subscribe-button-text-960-width' => '100%',
				'tozpom-subscribe-button-text-960-border-radius' => "3",
				'tozpom-subscribe-button-960-margin-top' => "10",
				'tozpom-subscribe-button-960-margin-bottom' => "10",
				'tozpom-privacy-text-960-font-size' => "12",
				'tozpom-privacy-text-960-line-height' => "12",
				'tozpom-privacy-text-960-margin-top' => "0",
				'tozpom-privacy-text-960-margin-bottom' => "0",
				'tozpom-popup-960-top' => '50%',
				'tozpom-popup-960-left' => '50%',
				'tozpom-popup-960-bottom' => '50%',
				'tozpom-popup-960-right' => '50%',

				'tozpom-width-640' => '300',
				'tozpom-height-640' => '260',
				'tozpom-headline-640-margin-top' => "0",
				'tozpom-headline-640-margin-bottom' => "0",
				'tozpom-headline-640-font-size' => "18",
				'tozpom-headline-640-line-height' => "20",
				'tozpom-logo-img-640-width' => "300",
				'tozpom-logo-img-640-height' => "60",
				'tozpom-logo-img-640-margin-top' => "10",
				'tozpom-logo-img-640-margin-bottom' => "10",
				'tozpom-name-640-font-size' => "12",
				'tozpom-name-640-line-height' => "14",
				'tozpom-name-640-padding-top' => '8',
				'tozpom-name-640-padding-bottom' => '8',
				'tozpom-name-640-padding-left' => '8',
				'tozpom-name-640-padding-right' => '8',
				'tozpom-name-640-width' => '100%',
				'tozpom-name-640-border-radius' => "3",
				'tozpom-email-640-font-size' => "12",
				'tozpom-email-640-line-height' => "14",
				'tozpom-email-640-padding-top' => '8',
				'tozpom-email-640-padding-bottom' => '8',
				'tozpom-email-640-padding-left' => '8',
				'tozpom-email-640-padding-right' => '8',
				'tozpom-email-640-width' => '100%',
				'tozpom-email-640-border-radius' => "3",
				'tozpom-email-640-margin-top' => "8",
				'tozpom-subscribe-button-text-640-font-size' => "14",
				'tozpom-subscribe-button-text-640-line-height' => "14",
				'tozpom-subscribe-button-text-640-padding-top' => '10',
				'tozpom-subscribe-button-text-640-padding-bottom' => '10',
				'tozpom-subscribe-button-text-640-width' => '100%',
				'tozpom-subscribe-button-text-640-border-radius' => "3",
				'tozpom-subscribe-button-640-margin-top' => "10",
				'tozpom-subscribe-button-640-margin-bottom' => "5",
				'tozpom-privacy-text-640-font-size' => "10",
				'tozpom-privacy-text-640-line-height' => "10",
				'tozpom-privacy-text-640-margin-top' => "0",
				'tozpom-privacy-text-640-margin-bottom' => "0",
				'tozpom-popup-640-top' => '50%',
				'tozpom-popup-640-left' => '50%',
				'tozpom-popup-640-bottom' => '50%',
				'tozpom-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'tozpom-headline' => array(0, '.tozpom-preview-headline', '#tozpom-preview-headline'),
				'tozpom-privacy-text' => array(0, '.tozpom-preview-privacy-text', '#tozpom-preview-privacy-text'),
				'tozpom-name' => array(1, '.tozpom-preview-name', '#tozpom-preview-name'),
				'tozpom-email' => array(1, '.tozpom-preview-email', '#tozpom-preview-email'),
				'tozpom-subscribe-button-text' => array(2, '.tozpom-preview-subscribe-button', '#tozpom-preview-subscribe-button'),
				'tozpom-headline-960' => array(3, '#tozpom-preview-headline-960'),
				'tozpom-privacy-text-960' => array(3, '#tozpom-preview-privacy-text-960'),
				'tozpom-name-960' => array(4, '#tozpom-preview-name-960'),
				'tozpom-email-960' => array(4, '#tozpom-preview-email-960'),
				'tozpom-subscribe-button-text-960' => array(5, '#tozpom-preview-subscribe-button-960'),
				'tozpom-headline-640' => array(3, '#tozpom-preview-headline-640'),
				'tozpom-privacy-text-640' => array(3, '#tozpom-preview-privacy-text-640'),
				'tozpom-name-640' => array(4, '#tozpom-preview-name-640'),
				'tozpom-email-640' => array(4, '#tozpom-preview-email-640'),
				'tozpom-subscribe-button-text-640' => array(5, '#tozpom-preview-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'tozpom-hide-name-field',
				'tozpom-hide-overlay',
				'tozpom-disable-overlay-close',
				'tozpom-show-embedded-border',
				'tozpom-headline-hide-toggle',
				'tozpom-privacy-hide-toggle',
			);
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['tozpom-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'tozpom-background-image-url');
			$style['tozpom-logo-img'] = PopupAllyProTemplate::image_url_code_generation($style, 'tozpom-logo-img-url');

			// disable background close trigger
			if ('true' === $style['tozpom-disable-overlay-close']) {
				$style['tozpom-overlay-close-trigger'] = '';
			} else {
				$style['tozpom-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}

			if ('true' === $style['tozpom-show-embedded-border']) {
				$style['tozpom-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['tozpom-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'tozpom-hide-name-field', 'tozpom-name-input-type', 'tozpom-preview-hide-name', 'tozpom-sign-up-form-name-field', 'sign-up-form-name-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'tozpom-hide-overlay', 'tozpom-background-overlay-css', 'tozpom-content-box-position');
			$style['tozpom-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['tozpom-overlay-color'], $style['tozpom-overlay-opacity']);
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
			$html = str_replace("{{tozpom-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'tozpom-popup-location'), $html);
			$html = str_replace("{{tozpom-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'tozpom-popup-vertical-selection'), $html);
			$html = str_replace("{{tozpom-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'tozpom-popup-horizontal-selection'), $html);
			return $html;
		}

		public function make_backwards_compatible($style) {
			if (isset($style['tozpom-display-headline'])) {
				$style['tozpom-headline-hide-toggle'] = $style['tozpom-display-headline'] === 'block' ? 'false' : 'true';
			}
			if (isset($style['tozpom-display-privacy'])) {
				$style['tozpom-privacy-hide-toggle'] = $style['tozpom-display-privacy'] === 'block' ? 'false' : 'true';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['tozpom-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['tozpom-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['tozpom-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['tozpom-popup-location'] === 'other') {
				return $style['tozpom-popup-vertical-selection'] . ':' . $style['tozpom-popup' . $size_postfix. '-' . $style['tozpom-popup-vertical-selection']] . ';' .
						$style['tozpom-popup-horizontal-selection'] . ':' . $style['tozpom-popup' . $size_postfix. '-' . $style['tozpom-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['tozpom-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProBigLogoTemplate());
}