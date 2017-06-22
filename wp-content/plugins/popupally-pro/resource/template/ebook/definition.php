<?php
if (!class_exists('PopupAllyProEbookTemplate')) {
	class PopupAllyProEbookTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'khwybd';
			$this->template_name = 'Get Ebook!';
			$this->template_order = 8;

			$this->backend_php = dirname(__FILE__) . '/backend/ebook-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'khwybd-hide-name-field', 'lname'=>'khwybd-hide-lname-field', 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/ebook-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/ebook-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/ebook-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/ebook-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/ebook-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/ebook-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/ebook-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/ebook-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('khwybd-name-placeholder', 'khwybd-lname-placeholder', 'khwybd-email-placeholder', 'khwybd-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'khwybd-sign-up-form-name-field',
				'khwybd-sign-up-form-lname-field', 'sign-up-form-email-field', 'khwybd-name-input-type', 'khwybd-lname-input-type', 'khwybd-overlay-close-trigger');
			$this->no_escape_html_mapping = array('khwybd-headline', 'khwybd-textbox-1', 'khwybd-textbox-2', 'khwybd-preview-hide-name', 'khwybd-preview-hide-lname',
				'sign-up-form-name-frontend-required', 'sign-up-form-lname-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'khwybd-background-color' => '#fefefe',
				'khwybd-background-image-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/two-options-bg.png',
				'khwybd-background-image' => 'none',
				'khwybd-background-image-size' => 'cover',
				'khwybd-width' => '650',
				'khwybd-height' => '450',
				'khwybd-headline' => 'Get 10 Proven Ways to Increase Your Traffic, Subscribers, and Sales',
				'khwybd-headline-font' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'khwybd-headline-color' => "#6d6e71",
				'khwybd-headline-font-size' => "32",
				'khwybd-headline-font-weight' => "700",
				'khwybd-headline-line-height' => "37",
				'khwybd-headline-width' => "390",
				'khwybd-headline-height' => "200",
				'khwybd-headline-align' => "left",
				'khwybd-headline-top' => '50',
				'khwybd-headline-left' => '235',
				'khwybd-textbox-1' => 'Just enter your name and email below...',
				'khwybd-textbox-1-font' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'khwybd-textbox-1-color' => "#6d6e71",
				'khwybd-textbox-1-font-size' => "22",
				'khwybd-textbox-1-font-weight' => "700",
				'khwybd-textbox-1-line-height' => "32",
				'khwybd-textbox-1-width' => "360",
				'khwybd-textbox-1-height' => "80",
				'khwybd-textbox-1-align' => "left",
				'khwybd-textbox-1-top' => '170',
				'khwybd-textbox-1-left' => '235',
				'khwybd-textbox-2' => '',
				'khwybd-textbox-2-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'khwybd-textbox-2-color' => "#111111",
				'khwybd-textbox-2-font-size' => "24",
				'khwybd-textbox-2-font-weight' => "700",
				'khwybd-textbox-2-line-height' => "32",
				'khwybd-textbox-2-width' => "0",
				'khwybd-textbox-2-height' => "0",
				'khwybd-textbox-2-align' => "left",
				'khwybd-textbox-2-top' => '0',
				'khwybd-textbox-2-left' => '0',
				'khwybd-image-1' => 'none',
				'khwybd-image-1-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/cover-10-proven.png',
				'khwybd-image-1-width' => '199',
				'khwybd-image-1-height' => '263',
				'khwybd-image-1-top' => '40',
				'khwybd-image-1-left' => '30',
				'khwybd-image-2' => 'none',
				'khwybd-image-2-url' => '',
				'khwybd-image-2-width' => '0',
				'khwybd-image-2-height' => '0',
				'khwybd-image-2-top' => '0',
				'khwybd-image-2-left' => '0',
				'khwybd-name-placeholder' => 'First name',
				'khwybd-name-field-top' => '240',
				'khwybd-name-field-left' => '235',
				'khwybd-name-field-font' => 'Arial, Helvetica, sans-serif',
				'khwybd-name-field-color' => "#444444",
				'khwybd-name-field-background-color' => "#f6f6f6",
				'khwybd-name-field-font-size' => "20",
				'khwybd-name-field-line-height' => "20",
				'khwybd-name-field-font-weight' => "400",
				'khwybd-name-field-padding-top' => '10',
				'khwybd-name-field-padding-bottom' => '10',
				'khwybd-name-field-padding-left' => '10',
				'khwybd-name-field-padding-right' => '10',
				'khwybd-name-field-width' => '325px',
				'khwybd-name-field-align' => "left",
				'khwybd-name-field-border-radius' => '3',
				'khwybd-lname-placeholder' => 'Last name',
				'khwybd-lname-field-top' => '190',
				'khwybd-lname-field-left' => '110',
				'khwybd-lname-field-font' => 'Arial, Helvetica, sans-serif',
				'khwybd-lname-field-color' => "#444444",
				'khwybd-lname-field-background-color' => "#f6f6f6",
				'khwybd-lname-field-font-size' => "20",
				'khwybd-lname-field-line-height' => "20",
				'khwybd-lname-field-font-weight' => "400",
				'khwybd-lname-field-padding-top' => '10',
				'khwybd-lname-field-padding-bottom' => '10',
				'khwybd-lname-field-padding-left' => '10',
				'khwybd-lname-field-padding-right' => '10',
				'khwybd-lname-field-width' => '450px',
				'khwybd-lname-field-align' => "left",
				'khwybd-lname-field-border-radius' => '3',
				'khwybd-email-placeholder' => 'Email',
				'khwybd-email-field-top' => '290',
				'khwybd-email-field-left' => '235',
				'khwybd-email-field-font' => 'Arial, Helvetica, sans-serif',
				'khwybd-email-field-color' => "#444444",
				'khwybd-email-field-background-color' => "#f6f6f6",
				'khwybd-email-field-font-size' => "20",
				'khwybd-email-field-line-height' => "20",
				'khwybd-email-field-font-weight' => "400",
				'khwybd-email-field-padding-top' => '10',
				'khwybd-email-field-padding-bottom' => '10',
				'khwybd-email-field-padding-left' => '10',
				'khwybd-email-field-padding-right' => '10',
				'khwybd-email-field-width' => '325px',
				'khwybd-email-field-align' => "left",
				'khwybd-email-field-border-radius' => '3',
				'khwybd-subscribe-button-text' => 'Get Free Instant Access',
				'khwybd-subscribe-button-color' => '#00a5b3',
				'khwybd-subscribe-button-text-font' => 'Verdana, Geneva, sans-serif',
				'khwybd-subscribe-button-text-color' => "#ffffff",
				'khwybd-subscribe-button-text-font-size' => "24",
				'khwybd-subscribe-button-text-font-weight' => "200",
				'khwybd-subscribe-button-text-line-height' => "20",
				'khwybd-subscribe-button-text-align' => "center",
				'khwybd-subscribe-button-text-padding-top' => '20',
				'khwybd-subscribe-button-text-padding-bottom' => '20',
				'khwybd-subscribe-button-text-width' => '450px',
				'khwybd-subscribe-button-text-border-radius' => '3',
				'khwybd-subscribe-button-top' => '340',
				'khwybd-subscribe-button-left' => '110',
				'khwybd-overlay-color' => "#505050",
				'khwybd-overlay-opacity' => '0.5',
				'khwybd-overlay-color-rgba' => '80,80,80,0.5',
				'khwybd-hide-overlay' => 'false',
				'khwybd-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'khwybd-content-box-position' => 'absolute',
				'khwybd-disable-overlay-close' => 'false',
				'khwybd-show-embedded-border' => "false",
				'khwybd-embedded-border-css' => "",
				'khwybd-hide-name-field' => "false",
				'khwybd-hide-lname-field' => "true",
				'khwybd-popup-location' => 'center',
				'khwybd-popup-vertical-selection' => 'top',
				'khwybd-popup-horizontal-selection' => 'left',
				'khwybd-popup-top' => '40%',
				'khwybd-popup-left' => '50%',
				'khwybd-popup-bottom' => '40%',
				'khwybd-popup-right' => '50%',

				'khwybd-width-960' => '500',
				'khwybd-height-960' => '346',
				'khwybd-headline-960-top' => '30',
				'khwybd-headline-960-left' => '180',
				'khwybd-headline-960-width' => "300",
				'khwybd-headline-960-height' => "80",
				'khwybd-headline-960-font-size' => '24',
				'khwybd-headline-960-line-height' => '24',
				'khwybd-textbox-1-960-top' => '120',
				'khwybd-textbox-1-960-left' => '180',
				'khwybd-textbox-1-960-width' => "300",
				'khwybd-textbox-1-960-height' => "80",
				'khwybd-textbox-1-960-font-size' => '16',
				'khwybd-textbox-1-960-line-height' => '20',
				'khwybd-textbox-2-960-top' => '0',
				'khwybd-textbox-2-960-left' => '0',
				'khwybd-textbox-2-960-width' => "0",
				'khwybd-textbox-2-960-height' => "0",
				'khwybd-textbox-2-960-font-size' => '24',
				'khwybd-textbox-2-960-line-height' => '24',
				'khwybd-image-1-960-width' => '153',
				'khwybd-image-1-960-height' => '202',
				'khwybd-image-1-960-top' => '30',
				'khwybd-image-1-960-left' => '20',
				'khwybd-image-2-960-width' => '0',
				'khwybd-image-2-960-height' => '0',
				'khwybd-image-2-960-top' => '0',
				'khwybd-image-2-960-left' => '0',
				'khwybd-name-field-960-top' => '170',
				'khwybd-name-field-960-left' => '180',
				'khwybd-name-field-960-font-size' => '16',
				'khwybd-name-field-960-line-height' => '16',
				'khwybd-name-field-960-padding-top' => '10',
				'khwybd-name-field-960-padding-bottom' => '10',
				'khwybd-name-field-960-padding-left' => '10',
				'khwybd-name-field-960-padding-right' => '10',
				'khwybd-name-field-960-width' => '270px',
				'khwybd-name-field-960-border-radius' => '3',
				'khwybd-lname-field-960-top' => '145',
				'khwybd-lname-field-960-left' => '120',
				'khwybd-lname-field-960-font-size' => '16',
				'khwybd-lname-field-960-line-height' => '16',
				'khwybd-lname-field-960-padding-top' => '10',
				'khwybd-lname-field-960-padding-bottom' => '10',
				'khwybd-lname-field-960-padding-left' => '10',
				'khwybd-lname-field-960-padding-right' => '10',
				'khwybd-lname-field-960-width' => '340px',
				'khwybd-lname-field-960-border-radius' => '3',
				'khwybd-email-field-960-top' => '220',
				'khwybd-email-field-960-left' => '180',
				'khwybd-email-field-960-font-size' => '16',
				'khwybd-email-field-960-line-height' => '16',
				'khwybd-email-field-960-padding-top' => '10',
				'khwybd-email-field-960-padding-bottom' => '10',
				'khwybd-email-field-960-padding-left' => '10',
				'khwybd-email-field-960-padding-right' => '10',
				'khwybd-email-field-960-width' => '270px',
				'khwybd-email-field-960-border-radius' => '3',
				'khwybd-subscribe-button-960-top' => '270',
				'khwybd-subscribe-button-960-left' => '120',
				'khwybd-subscribe-button-text-960-font-size' => '16',
				'khwybd-subscribe-button-text-960-line-height' => '16',
				'khwybd-subscribe-button-text-960-padding-top' => '15',
				'khwybd-subscribe-button-text-960-padding-bottom' => '15',
				'khwybd-subscribe-button-text-960-width' => '330px',
				'khwybd-subscribe-button-text-960-border-radius' => '3',
				'khwybd-popup-960-top' => '50%',
				'khwybd-popup-960-left' => '50%',
				'khwybd-popup-960-bottom' => '50%',
				'khwybd-popup-960-right' => '50%',

				'khwybd-width-640' => '300',
				'khwybd-height-640' => '208',
				'khwybd-headline-640-top' => '20',
				'khwybd-headline-640-left' => '120',
				'khwybd-headline-640-width' => "170",
				'khwybd-headline-640-height' => "60",
				'khwybd-headline-640-font-size' => '14',
				'khwybd-headline-640-line-height' => '18',
				'khwybd-textbox-1-640-top' => '75',
				'khwybd-textbox-1-640-left' => '120',
				'khwybd-textbox-1-640-width' => "170",
				'khwybd-textbox-1-640-height' => "40",
				'khwybd-textbox-1-640-font-size' => '10',
				'khwybd-textbox-1-640-line-height' => '12',
				'khwybd-textbox-2-640-top' => '0',
				'khwybd-textbox-2-640-left' => '0',
				'khwybd-textbox-2-640-width' => "0",
				'khwybd-textbox-2-640-height' => "0",
				'khwybd-textbox-2-640-font-size' => '12',
				'khwybd-textbox-2-640-line-height' => '16',
				'khwybd-image-1-640-width' => '100',
				'khwybd-image-1-640-height' => '133',
				'khwybd-image-1-640-top' => '20',
				'khwybd-image-1-640-left' => '20',
				'khwybd-image-2-640-width' => '0',
				'khwybd-image-2-640-height' => '0',
				'khwybd-image-2-640-top' => '0',
				'khwybd-image-2-640-left' => '0',
				'khwybd-name-field-640-top' => '110',
				'khwybd-name-field-640-left' => '120',
				'khwybd-name-field-640-font-size' => '12',
				'khwybd-name-field-640-line-height' => '12',
				'khwybd-name-field-640-padding-top' => '5',
				'khwybd-name-field-640-padding-bottom' => '5',
				'khwybd-name-field-640-padding-left' => '8',
				'khwybd-name-field-640-padding-right' => '8',
				'khwybd-name-field-640-width' => '160px',
				'khwybd-name-field-640-border-radius' => '3',
				'khwybd-lname-field-640-top' => '115',
				'khwybd-lname-field-640-left' => '85',
				'khwybd-lname-field-640-font-size' => '12',
				'khwybd-lname-field-640-line-height' => '12',
				'khwybd-lname-field-640-padding-top' => '9',
				'khwybd-lname-field-640-padding-bottom' => '9',
				'khwybd-lname-field-640-padding-left' => '10',
				'khwybd-lname-field-640-padding-right' => '10',
				'khwybd-lname-field-640-width' => '285px',
				'khwybd-lname-field-640-border-radius' => '3',
				'khwybd-email-field-640-top' => '137',
				'khwybd-email-field-640-left' => '120',
				'khwybd-email-field-640-font-size' => '12',
				'khwybd-email-field-640-line-height' => '12',
				'khwybd-email-field-640-padding-top' => '5',
				'khwybd-email-field-640-padding-bottom' => '5',
				'khwybd-email-field-640-padding-left' => '8',
				'khwybd-email-field-640-padding-right' => '8',
				'khwybd-email-field-640-width' => '160px',
				'khwybd-email-field-640-border-radius' => '3',
				'khwybd-subscribe-button-640-top' => '165',
				'khwybd-subscribe-button-640-left' => '95',
				'khwybd-subscribe-button-text-640-font-size' => '12',
				'khwybd-subscribe-button-text-640-line-height' => '12',
				'khwybd-subscribe-button-text-640-padding-top' => '8',
				'khwybd-subscribe-button-text-640-padding-bottom' => '8',
				'khwybd-subscribe-button-text-640-width' => '185px',
				'khwybd-subscribe-button-text-640-border-radius' => '3',
				'khwybd-popup-640-top' => '50%',
				'khwybd-popup-640-left' => '50%',
				'khwybd-popup-640-bottom' => '50%',
				'khwybd-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'khwybd-headline' => array(0, '.khwybd-preview-headline', '#khwybd-preview-headline'),
				'khwybd-textbox-1' => array(0, '.khwybd-preview-textbox-1', '#khwybd-preview-textbox-1'),
				'khwybd-textbox-2' => array(0, '.khwybd-preview-textbox-2', '#khwybd-preview-textbox-2'),
				'khwybd-name-field' => array(1, '.khwybd-preview-name', '#khwybd-preview-name'),
				'khwybd-lname-field' => array(1, '.khwybd-preview-lname', '#khwybd-preview-lname'),
				'khwybd-email-field' => array(1, '.khwybd-preview-email', '#khwybd-preview-email'),
				'khwybd-subscribe-button-text' => array(2, '.khwybd-subscribe-button', '#khwybd-subscribe-button'),
				'khwybd-headline-960' => array(3, '#khwybd-preview-headline-960'),
				'khwybd-textbox-1-960' => array(3, '#khwybd-preview-textbox-1-960'),
				'khwybd-textbox-2-960' => array(3, '#khwybd-preview-textbox-2-960'),
				'khwybd-name-field-960' => array(4, '#khwybd-preview-name-960'),
				'khwybd-lname-field-960' => array(4, '#khwybd-preview-lname-960'),
				'khwybd-email-field-960' => array(4, '#khwybd-preview-email-960'),
				'khwybd-subscribe-button-text-960' => array(5, '#khwybd-subscribe-button-960'),
				'khwybd-headline-640' => array(3, '#khwybd-preview-headline-640'),
				'khwybd-textbox-1-640' => array(3, '#khwybd-preview-textbox-1-640'),
				'khwybd-textbox-2-640' => array(3, '#khwybd-preview-textbox-2-640'),
				'khwybd-name-field-640' => array(4, '#khwybd-preview-name-640'),
				'khwybd-lname-field-640' => array(4, '#khwybd-preview-lname-640'),
				'khwybd-email-field-640' => array(4, '#khwybd-preview-email-640'),
				'khwybd-subscribe-button-text-640' => array(5, '#khwybd-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'khwybd-hide-name-field',
				'khwybd-hide-lname-field',
				'khwybd-hide-overlay',
				'khwybd-disable-overlay-close',
				'khwybd-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['khwybd-text-color'])) {
					$new_style[$id]['khwybd-headline-color'] = $setting['khwybd-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			if ($is_active && !isset($setting['khwybd-hide-lname-field'])) {
				$setting['khwybd-hide-lname-field'] = 'false';
			}

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['khwybd-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'khwybd-background-image-url');
			$style['khwybd-image-1'] = PopupAllyProTemplate::image_url_code_generation($style, 'khwybd-image-1-url');
			$style['khwybd-image-2'] = PopupAllyProTemplate::image_url_code_generation($style, 'khwybd-image-2-url');

			// disable background close trigger
			if ('true' === $style['khwybd-disable-overlay-close']) {
				$style['khwybd-overlay-close-trigger'] = '';
			} else {
				$style['khwybd-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['khwybd-show-embedded-border']) {
				$style['khwybd-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['khwybd-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'khwybd-hide-name-field', 'khwybd-name-input-type', 'khwybd-preview-hide-name', 'khwybd-sign-up-form-name-field', 'sign-up-form-name-field');
			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'khwybd-hide-lname-field', 'khwybd-lname-input-type', 'khwybd-preview-hide-lname', 'khwybd-sign-up-form-lname-field', 'sign-up-form-lname-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'khwybd-hide-overlay', 'khwybd-background-overlay-css', 'khwybd-content-box-position');

			$style['khwybd-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['khwybd-overlay-color'], $style['khwybd-overlay-opacity']);
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

			$html = str_replace("{{khwybd-background-image-size}}", PopupAllyProTemplate::generate_background_size_selection_code($setting, 'khwybd-background-image-size'), $html);

			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{khwybd-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'khwybd-popup-location'), $html);
			$html = str_replace("{{khwybd-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'khwybd-popup-vertical-selection'), $html);
			$html = str_replace("{{khwybd-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'khwybd-popup-horizontal-selection'), $html);
			return $html;
		}

		public function make_backwards_compatible($style) {
			if (!isset($style['khwybd-background-image-size'])) {
				$style['khwybd-background-image-size'] = 'contain';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['khwybd-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['khwybd-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['khwybd-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['khwybd-popup-location'] === 'other') {
				return $style['khwybd-popup-vertical-selection'] . ':' . $style['khwybd-popup' . $size_postfix. '-' . $style['khwybd-popup-vertical-selection']] . ';' .
						$style['khwybd-popup-horizontal-selection'] . ':' . $style['khwybd-popup' . $size_postfix. '-' . $style['khwybd-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['khwybd-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProEbookTemplate());
}
