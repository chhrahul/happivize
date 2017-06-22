<?php
if (!class_exists('PopupAllyProFreeTemplate')) {
	class PopupAllyProFreeTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'vtgjid';
			$this->template_name = 'Limitless';
			$this->template_order = 6;

			$this->backend_php = dirname(__FILE__) . '/backend/free-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'vtgjid-hide-name-field', 'lname'=>'vtgjid-hide-lname-field', 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/free-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/free-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/free-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/free-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/free-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/free-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/free-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/free-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('vtgjid-name-placeholder', 'vtgjid-lname-placeholder', 'vtgjid-email-placeholder', 'vtgjid-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'vtgjid-sign-up-form-name-field',
				'vtgjid-sign-up-form-lname-field', 'sign-up-form-email-field', 'vtgjid-name-input-type', 'vtgjid-lname-input-type', 'vtgjid-overlay-close-trigger');
			$this->no_escape_html_mapping = array('vtgjid-headline', 'vtgjid-textbox-1', 'vtgjid-textbox-2', 'vtgjid-preview-hide-name', 'vtgjid-preview-hide-lname',
				'sign-up-form-name-frontend-required', 'sign-up-form-lname-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'vtgjid-background-color' => '#fefefe',
				'vtgjid-background-image-url' => '',
				'vtgjid-background-image' => 'none',
				'vtgjid-background-image-size' => 'cover',
				'vtgjid-width' => '600',
				'vtgjid-height' => '400',
				'vtgjid-headline' => 'Get Our 10 Recommended Tools To Make Your Online Business Profitable Today',
				'vtgjid-headline-font' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'vtgjid-headline-color' => "#6d6e71",
				'vtgjid-headline-font-size' => "32",
				'vtgjid-headline-font-weight' => "700",
				'vtgjid-headline-line-height' => "32",
				'vtgjid-headline-width' => "480",
				'vtgjid-headline-height' => "100",
				'vtgjid-headline-align' => "left",
				'vtgjid-headline-top' => '30',
				'vtgjid-headline-left' => '110',
				'vtgjid-textbox-1' => '',
				'vtgjid-textbox-1-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'vtgjid-textbox-1-color' => "#111111",
				'vtgjid-textbox-1-font-size' => "24",
				'vtgjid-textbox-1-font-weight' => "700",
				'vtgjid-textbox-1-line-height' => "32",
				'vtgjid-textbox-1-width' => "0",
				'vtgjid-textbox-1-height' => "0",
				'vtgjid-textbox-1-align' => "left",
				'vtgjid-textbox-1-top' => '0',
				'vtgjid-textbox-1-left' => '0',
				'vtgjid-textbox-2' => '',
				'vtgjid-textbox-2-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'vtgjid-textbox-2-color' => "#111111",
				'vtgjid-textbox-2-font-size' => "24",
				'vtgjid-textbox-2-font-weight' => "700",
				'vtgjid-textbox-2-line-height' => "32",
				'vtgjid-textbox-2-width' => "0",
				'vtgjid-textbox-2-height' => "0",
				'vtgjid-textbox-2-align' => "left",
				'vtgjid-textbox-2-top' => '0',
				'vtgjid-textbox-2-left' => '0',
				'vtgjid-image-1' => 'none',
				'vtgjid-image-1-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/pink-tools.png',
				'vtgjid-image-1-width' => '141',
				'vtgjid-image-1-height' => '141',
				'vtgjid-image-1-top' => '-40',
				'vtgjid-image-1-left' => '-50',
				'vtgjid-image-2' => 'none',
				'vtgjid-image-2-url' => '',
				'vtgjid-image-2-width' => '0',
				'vtgjid-image-2-height' => '0',
				'vtgjid-image-2-top' => '0',
				'vtgjid-image-2-left' => '0',
				'vtgjid-name-placeholder' => 'First name',
				'vtgjid-name-field-top' => '140',
				'vtgjid-name-field-left' => '110',
				'vtgjid-name-field-font' => 'Arial, Helvetica, sans-serif',
				'vtgjid-name-field-color' => "#444444",
				'vtgjid-name-field-background-color' => "#f6f6f6",
				'vtgjid-name-field-font-size' => "20",
				'vtgjid-name-field-line-height' => "20",
				'vtgjid-name-field-font-weight' => "400",
				'vtgjid-name-field-padding-top' => '10',
				'vtgjid-name-field-padding-bottom' => '10',
				'vtgjid-name-field-padding-left' => '10',
				'vtgjid-name-field-padding-right' => '10',
				'vtgjid-name-field-width' => '450px',
				'vtgjid-name-field-align' => "left",
				'vtgjid-name-field-border-radius' => '3',
				'vtgjid-lname-placeholder' => 'Last name',
				'vtgjid-lname-field-top' => '190',
				'vtgjid-lname-field-left' => '110',
				'vtgjid-lname-field-font' => 'Arial, Helvetica, sans-serif',
				'vtgjid-lname-field-color' => "#444444",
				'vtgjid-lname-field-background-color' => "#f6f6f6",
				'vtgjid-lname-field-font-size' => "20",
				'vtgjid-lname-field-line-height' => "20",
				'vtgjid-lname-field-font-weight' => "400",
				'vtgjid-lname-field-padding-top' => '10',
				'vtgjid-lname-field-padding-bottom' => '10',
				'vtgjid-lname-field-padding-left' => '10',
				'vtgjid-lname-field-padding-right' => '10',
				'vtgjid-lname-field-width' => '450px',
				'vtgjid-lname-field-align' => "left",
				'vtgjid-lname-field-border-radius' => '3',
				'vtgjid-email-placeholder' => 'Email',
				'vtgjid-email-field-top' => '240',
				'vtgjid-email-field-left' => '110',
				'vtgjid-email-field-font' => 'Arial, Helvetica, sans-serif',
				'vtgjid-email-field-color' => "#444444",
				'vtgjid-email-field-background-color' => "#f6f6f6",
				'vtgjid-email-field-font-size' => "20",
				'vtgjid-email-field-line-height' => "20",
				'vtgjid-email-field-font-weight' => "400",
				'vtgjid-email-field-padding-top' => '10',
				'vtgjid-email-field-padding-bottom' => '10',
				'vtgjid-email-field-padding-left' => '10',
				'vtgjid-email-field-padding-right' => '10',
				'vtgjid-email-field-width' => '450px',
				'vtgjid-email-field-align' => "left",
				'vtgjid-email-field-border-radius' => '3',
				'vtgjid-subscribe-button-text' => 'Get Free Instant Access',
				'vtgjid-subscribe-button-color' => '#00a5b3',
				'vtgjid-subscribe-button-text-font' => 'Verdana, Geneva, sans-serif',
				'vtgjid-subscribe-button-text-color' => "#ffffff",
				'vtgjid-subscribe-button-text-font-size' => "24",
				'vtgjid-subscribe-button-text-font-weight' => "200",
				'vtgjid-subscribe-button-text-line-height' => "20",
				'vtgjid-subscribe-button-text-align' => "center",
				'vtgjid-subscribe-button-text-padding-top' => '20',
				'vtgjid-subscribe-button-text-padding-bottom' => '20',
				'vtgjid-subscribe-button-text-width' => '450px',
				'vtgjid-subscribe-button-text-border-radius' => '3',
				'vtgjid-subscribe-button-top' => '300',
				'vtgjid-subscribe-button-left' => '110',
				'vtgjid-overlay-color' => "#505050",
				'vtgjid-overlay-opacity' => '0.5',
				'vtgjid-overlay-color-rgba' => '80,80,80,0.5',
				'vtgjid-hide-overlay' => 'false',
				'vtgjid-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'vtgjid-content-box-position' => 'absolute',
				'vtgjid-disable-overlay-close' => 'false',
				'vtgjid-show-embedded-border' => "false",
				'vtgjid-embedded-border-css' => "",
				'vtgjid-hide-name-field' => "false",
				'vtgjid-hide-lname-field' => "false",
				'vtgjid-popup-location' => 'center',
				'vtgjid-popup-vertical-selection' => 'top',
				'vtgjid-popup-horizontal-selection' => 'left',
				'vtgjid-popup-top' => '40%',
				'vtgjid-popup-left' => '50%',
				'vtgjid-popup-bottom' => '40%',
				'vtgjid-popup-right' => '50%',

				'vtgjid-width-960' => '500',
				'vtgjid-height-960' => '300',
				'vtgjid-headline-960-top' => '20',
				'vtgjid-headline-960-left' => '120',
				'vtgjid-headline-960-width' => "350",
				'vtgjid-headline-960-height' => "80",
				'vtgjid-headline-960-font-size' => '24',
				'vtgjid-headline-960-line-height' => '24',
				'vtgjid-textbox-1-960-top' => '0',
				'vtgjid-textbox-1-960-left' => '0',
				'vtgjid-textbox-1-960-width' => "0",
				'vtgjid-textbox-1-960-height' => "0",
				'vtgjid-textbox-1-960-font-size' => '18',
				'vtgjid-textbox-1-960-line-height' => '20',
				'vtgjid-textbox-2-960-top' => '0',
				'vtgjid-textbox-2-960-left' => '0',
				'vtgjid-textbox-2-960-width' => "0",
				'vtgjid-textbox-2-960-height' => "0",
				'vtgjid-textbox-2-960-font-size' => '18',
				'vtgjid-textbox-2-960-line-height' => '20',
				'vtgjid-image-1-960-width' => '141',
				'vtgjid-image-1-960-height' => '141',
				'vtgjid-image-1-960-top' => '-40',
				'vtgjid-image-1-960-left' => '-40',
				'vtgjid-image-2-960-width' => '0',
				'vtgjid-image-2-960-height' => '0',
				'vtgjid-image-2-960-top' => '0',
				'vtgjid-image-2-960-left' => '0',
				'vtgjid-name-field-960-top' => '100',
				'vtgjid-name-field-960-left' => '120',
				'vtgjid-name-field-960-font-size' => '16',
				'vtgjid-name-field-960-line-height' => '16',
				'vtgjid-name-field-960-padding-top' => '10',
				'vtgjid-name-field-960-padding-bottom' => '10',
				'vtgjid-name-field-960-padding-left' => '10',
				'vtgjid-name-field-960-padding-right' => '10',
				'vtgjid-name-field-960-width' => '340px',
				'vtgjid-name-field-960-border-radius' => '3',
				'vtgjid-lname-field-960-top' => '145',
				'vtgjid-lname-field-960-left' => '120',
				'vtgjid-lname-field-960-font-size' => '16',
				'vtgjid-lname-field-960-line-height' => '16',
				'vtgjid-lname-field-960-padding-top' => '10',
				'vtgjid-lname-field-960-padding-bottom' => '10',
				'vtgjid-lname-field-960-padding-left' => '10',
				'vtgjid-lname-field-960-padding-right' => '10',
				'vtgjid-lname-field-960-width' => '340px',
				'vtgjid-lname-field-960-border-radius' => '3',
				'vtgjid-email-field-960-top' => '190',
				'vtgjid-email-field-960-left' => '120',
				'vtgjid-email-field-960-font-size' => '16',
				'vtgjid-email-field-960-line-height' => '16',
				'vtgjid-email-field-960-padding-top' => '10',
				'vtgjid-email-field-960-padding-bottom' => '10',
				'vtgjid-email-field-960-padding-left' => '10',
				'vtgjid-email-field-960-padding-right' => '10',
				'vtgjid-email-field-960-width' => '340px',
				'vtgjid-email-field-960-border-radius' => '3',
				'vtgjid-subscribe-button-960-top' => '240',
				'vtgjid-subscribe-button-960-left' => '120',
				'vtgjid-subscribe-button-text-960-font-size' => '16',
				'vtgjid-subscribe-button-text-960-line-height' => '16',
				'vtgjid-subscribe-button-text-960-padding-top' => '10',
				'vtgjid-subscribe-button-text-960-padding-bottom' => '10',
				'vtgjid-subscribe-button-text-960-width' => '340px',
				'vtgjid-subscribe-button-text-960-border-radius' => '3',
				'vtgjid-popup-960-top' => '50%',
				'vtgjid-popup-960-left' => '50%',
				'vtgjid-popup-960-bottom' => '50%',
				'vtgjid-popup-960-right' => '50%',

				'vtgjid-width-640' => '300',
				'vtgjid-height-640' => '235',
				'vtgjid-headline-640-top' => '10',
				'vtgjid-headline-640-left' => '50',
				'vtgjid-headline-640-width' => "240",
				'vtgjid-headline-640-height' => "60",
				'vtgjid-headline-640-font-size' => '16',
				'vtgjid-headline-640-line-height' => '18',
				'vtgjid-textbox-1-640-top' => '0',
				'vtgjid-textbox-1-640-left' => '0',
				'vtgjid-textbox-1-640-width' => "0",
				'vtgjid-textbox-1-640-height' => "0",
				'vtgjid-textbox-1-640-font-size' => '14',
				'vtgjid-textbox-1-640-line-height' => '16',
				'vtgjid-textbox-2-640-top' => '0',
				'vtgjid-textbox-2-640-left' => '0',
				'vtgjid-textbox-2-640-width' => "0",
				'vtgjid-textbox-2-640-height' => "0",
				'vtgjid-textbox-2-640-font-size' => '14',
				'vtgjid-textbox-2-640-line-height' => '16',
				'vtgjid-image-1-640-width' => '80',
				'vtgjid-image-1-640-height' => '80',
				'vtgjid-image-1-640-top' => '-30',
				'vtgjid-image-1-640-left' => '-30',
				'vtgjid-image-2-640-width' => '0',
				'vtgjid-image-2-640-height' => '0',
				'vtgjid-image-2-640-top' => '0',
				'vtgjid-image-2-640-left' => '0',
				'vtgjid-name-field-640-top' => '80',
				'vtgjid-name-field-640-left' => '50',
				'vtgjid-name-field-640-font-size' => '12',
				'vtgjid-name-field-640-line-height' => '12',
				'vtgjid-name-field-640-padding-top' => '9',
				'vtgjid-name-field-640-padding-bottom' => '9',
				'vtgjid-name-field-640-padding-left' => '10',
				'vtgjid-name-field-640-padding-right' => '10',
				'vtgjid-name-field-640-width' => '230px',
				'vtgjid-name-field-640-border-radius' => '3',
				'vtgjid-lname-field-640-top' => '115',
				'vtgjid-lname-field-640-left' => '50',
				'vtgjid-lname-field-640-font-size' => '12',
				'vtgjid-lname-field-640-line-height' => '12',
				'vtgjid-lname-field-640-padding-top' => '9',
				'vtgjid-lname-field-640-padding-bottom' => '9',
				'vtgjid-lname-field-640-padding-left' => '10',
				'vtgjid-lname-field-640-padding-right' => '10',
				'vtgjid-lname-field-640-width' => '230px',
				'vtgjid-lname-field-640-border-radius' => '3',
				'vtgjid-email-field-640-top' => '150',
				'vtgjid-email-field-640-left' => '50',
				'vtgjid-email-field-640-font-size' => '12',
				'vtgjid-email-field-640-line-height' => '12',
				'vtgjid-email-field-640-padding-top' => '9',
				'vtgjid-email-field-640-padding-bottom' => '9',
				'vtgjid-email-field-640-padding-left' => '10',
				'vtgjid-email-field-640-padding-right' => '10',
				'vtgjid-email-field-640-width' => '230px',
				'vtgjid-email-field-640-border-radius' => '3',
				'vtgjid-subscribe-button-640-top' => '190',
				'vtgjid-subscribe-button-640-left' => '50',
				'vtgjid-subscribe-button-text-640-font-size' => '12',
				'vtgjid-subscribe-button-text-640-line-height' => '12',
				'vtgjid-subscribe-button-text-640-padding-top' => '10',
				'vtgjid-subscribe-button-text-640-padding-bottom' => '10',
				'vtgjid-subscribe-button-text-640-width' => '230px',
				'vtgjid-subscribe-button-text-640-border-radius' => '3',
				'vtgjid-popup-640-top' => '50%',
				'vtgjid-popup-640-left' => '50%',
				'vtgjid-popup-640-bottom' => '50%',
				'vtgjid-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'vtgjid-headline' => array(0, '.vtgjid-preview-headline', '#vtgjid-preview-headline'),
				'vtgjid-textbox-1' => array(0, '.vtgjid-preview-textbox-1', '#vtgjid-preview-textbox-1'),
				'vtgjid-textbox-2' => array(0, '.vtgjid-preview-textbox-2', '#vtgjid-preview-textbox-2'),
				'vtgjid-name-field' => array(1, '.vtgjid-preview-name', '#vtgjid-preview-name'),
				'vtgjid-lname-field' => array(1, '.vtgjid-preview-lname', '#vtgjid-preview-lname'),
				'vtgjid-email-field' => array(1, '.vtgjid-preview-email', '#vtgjid-preview-email'),
				'vtgjid-subscribe-button-text' => array(2, '.vtgjid-subscribe-button', '#vtgjid-subscribe-button'),
				'vtgjid-headline-960' => array(3, '#vtgjid-preview-headline-960'),
				'vtgjid-textbox-1-960' => array(3, '#vtgjid-preview-textbox-1-960'),
				'vtgjid-textbox-2-960' => array(3, '#vtgjid-preview-textbox-2-960'),
				'vtgjid-name-field-960' => array(4, '#vtgjid-preview-name-960'),
				'vtgjid-lname-field-960' => array(4, '#vtgjid-preview-lname-960'),
				'vtgjid-email-field-960' => array(4, '#vtgjid-preview-email-960'),
				'vtgjid-subscribe-button-text-960' => array(5, '#vtgjid-subscribe-button-960'),
				'vtgjid-headline-640' => array(3, '#vtgjid-preview-headline-640'),
				'vtgjid-textbox-1-640' => array(3, '#vtgjid-preview-textbox-1-640'),
				'vtgjid-textbox-2-640' => array(3, '#vtgjid-preview-textbox-2-640'),
				'vtgjid-name-field-640' => array(4, '#vtgjid-preview-name-640'),
				'vtgjid-lname-field-640' => array(4, '#vtgjid-preview-lname-640'),
				'vtgjid-email-field-640' => array(4, '#vtgjid-preview-email-640'),
				'vtgjid-subscribe-button-text-640' => array(5, '#vtgjid-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'vtgjid-hide-name-field',
				'vtgjid-hide-lname-field',
				'vtgjid-hide-overlay',
				'vtgjid-disable-overlay-close',
				'vtgjid-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['vtgjid-text-color'])) {
					$new_style[$id]['vtgjid-headline-color'] = $setting['vtgjid-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['vtgjid-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'vtgjid-background-image-url');
			$style['vtgjid-image-1'] = PopupAllyProTemplate::image_url_code_generation($style, 'vtgjid-image-1-url');
			$style['vtgjid-image-2'] = PopupAllyProTemplate::image_url_code_generation($style, 'vtgjid-image-2-url');

			// disable background close trigger
			if ('true' === $style['vtgjid-disable-overlay-close']) {
				$style['vtgjid-overlay-close-trigger'] = '';
			} else {
				$style['vtgjid-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['vtgjid-show-embedded-border']) {
				$style['vtgjid-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['vtgjid-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'vtgjid-hide-name-field', 'vtgjid-name-input-type', 'vtgjid-preview-hide-name', 'vtgjid-sign-up-form-name-field', 'sign-up-form-name-field');
			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'vtgjid-hide-lname-field', 'vtgjid-lname-input-type', 'vtgjid-preview-hide-lname', 'vtgjid-sign-up-form-lname-field', 'sign-up-form-lname-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'vtgjid-hide-overlay', 'vtgjid-background-overlay-css', 'vtgjid-content-box-position');

			$style['vtgjid-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['vtgjid-overlay-color'], $style['vtgjid-overlay-opacity']);
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

			$html = str_replace("{{vtgjid-background-image-size}}", PopupAllyProTemplate::generate_background_size_selection_code($setting, 'vtgjid-background-image-size'), $html);

			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{vtgjid-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'vtgjid-popup-location'), $html);
			$html = str_replace("{{vtgjid-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'vtgjid-popup-vertical-selection'), $html);
			$html = str_replace("{{vtgjid-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'vtgjid-popup-horizontal-selection'), $html);

			return $html;
		}

		public function make_backwards_compatible($style) {
			if (!isset($style['vtgjid-background-image-size'])) {
				$style['vtgjid-background-image-size'] = 'contain';
			}
			return $style;
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
	}
	PopupAllyPro::add_template(new PopupAllyProFreeTemplate());
}
