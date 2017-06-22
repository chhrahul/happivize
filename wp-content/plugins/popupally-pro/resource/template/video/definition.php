<?php
if (!class_exists('PopupAllyProVideoTemplate')) {
	class PopupAllyProVideoTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'zewges';
			$this->template_name = 'Great Video';
			$this->template_order = 9;

			$this->backend_php = dirname(__FILE__) . '/backend/video-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'zewges-hide-name-field', 'lname'=>'zewges-hide-lname-field', 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/video-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/video-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/video-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/video-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/video-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/video-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/video-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/video-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('zewges-name-placeholder', 'zewges-lname-placeholder', 'zewges-email-placeholder', 'zewges-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'zewges-sign-up-form-name-field',
				'zewges-sign-up-form-lname-field', 'sign-up-form-email-field', 'zewges-name-input-type', 'zewges-lname-input-type', 'zewges-overlay-close-trigger');
			$this->no_escape_html_mapping = array('zewges-headline', 'zewges-video-1-iframe-code', 'zewges-textbox-1', 'zewges-textbox-2', 'zewges-preview-hide-name', 'zewges-preview-hide-lname',
				'sign-up-form-name-frontend-required', 'sign-up-form-lname-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'zewges-background-color' => '#E5525E',
				'zewges-background-image-url' => '',
				'zewges-background-image' => 'none',
				'zewges-background-image-size' => 'cover',
				'zewges-width' => '600',
				'zewges-height' => '430',
				'zewges-headline' => '',
				'zewges-headline-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'zewges-headline-color' => "#111111",
				'zewges-headline-font-size' => "28",
				'zewges-headline-font-weight' => "700",
				'zewges-headline-line-height' => "30",
				'zewges-headline-width' => "0",
				'zewges-headline-height' => "0",
				'zewges-headline-align' => "center",
				'zewges-headline-top' => '0',
				'zewges-headline-left' => '0',
				'zewges-textbox-1' => "",
				'zewges-textbox-1-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'zewges-textbox-1-color' => "#111111",
				'zewges-textbox-1-font-size' => "17",
				'zewges-textbox-1-font-weight' => "700",
				'zewges-textbox-1-line-height' => "20",
				'zewges-textbox-1-width' => "0",
				'zewges-textbox-1-height' => "0",
				'zewges-textbox-1-align' => "center",
				'zewges-textbox-1-top' => '0',
				'zewges-textbox-1-left' => '0',
				'zewges-textbox-2' => '',
				'zewges-textbox-2-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'zewges-textbox-2-color' => "#111111",
				'zewges-textbox-2-font-size' => "24",
				'zewges-textbox-2-font-weight' => "700",
				'zewges-textbox-2-line-height' => "32",
				'zewges-textbox-2-width' => "0",
				'zewges-textbox-2-height' => "0",
				'zewges-textbox-2-align' => "left",
				'zewges-textbox-2-top' => '0',
				'zewges-textbox-2-left' => '0',
				'zewges-image-1' => 'none',
				'zewges-image-1-url' => '',
				'zewges-image-1-width' => '0',
				'zewges-image-1-height' => '0',
				'zewges-image-1-top' => '0',
				'zewges-image-1-left' => '0',
				'zewges-video-1' => 'none',
				'zewges-video-1-iframe-code' => '<div style="background-color:#000000;width:100%;height:100%;color:#ffffff;display:block;"><br/><br/><br/><br/><br/><br/><br/>Video code goes here</div>',
				'zewges-video-1-width' => '600',
				'zewges-video-1-height' => '370',
				'zewges-video-1-top' => '0',
				'zewges-video-1-left' => '0',
				'zewges-name-placeholder' => 'Your name',
				'zewges-name-field-top' => '380',
				'zewges-name-field-left' => '30',
				'zewges-name-field-font' => 'Arial, Helvetica, sans-serif',
				'zewges-name-field-color' => "#444444",
				'zewges-name-field-background-color' => "#f6f6f6",
				'zewges-name-field-font-size' => "18",
				'zewges-name-field-line-height' => "16",
				'zewges-name-field-font-weight' => "400",
				'zewges-name-field-padding-top' => '10',
				'zewges-name-field-padding-bottom' => '5',
				'zewges-name-field-padding-left' => '10',
				'zewges-name-field-padding-right' => '10',
				'zewges-name-field-width' => '170px',
				'zewges-name-field-align' => "left",
				'zewges-name-field-border-radius' => "3",
				'zewges-lname-placeholder' => 'Last name',
				'zewges-lname-field-top' => '190',
				'zewges-lname-field-left' => '110',
				'zewges-lname-field-font' => 'Arial, Helvetica, sans-serif',
				'zewges-lname-field-color' => "#444444",
				'zewges-lname-field-background-color' => "#f6f6f6",
				'zewges-lname-field-font-size' => "20",
				'zewges-lname-field-line-height' => "20",
				'zewges-lname-field-font-weight' => "400",
				'zewges-lname-field-padding-top' => '10',
				'zewges-lname-field-padding-bottom' => '10',
				'zewges-lname-field-padding-left' => '10',
				'zewges-lname-field-padding-right' => '10',
				'zewges-lname-field-width' => '450px',
				'zewges-lname-field-border-radius' => "3",
				'zewges-lname-field-align' => "left",
				'zewges-email-placeholder' => 'Email',
				'zewges-email-field-top' => '380',
				'zewges-email-field-left' => '210',
				'zewges-email-field-font' => 'Arial, Helvetica, sans-serif',
				'zewges-email-field-color' => "#444444",
				'zewges-email-field-background-color' => "#f6f6f6",
				'zewges-email-field-font-size' => "18",
				'zewges-email-field-line-height' => "16",
				'zewges-email-field-font-weight' => "400",
				'zewges-email-field-padding-top' => '10',
				'zewges-email-field-padding-bottom' => '5',
				'zewges-email-field-padding-left' => '10',
				'zewges-email-field-padding-right' => '10',
				'zewges-email-field-width' => '160px',
				'zewges-email-field-align' => "left",
				'zewges-email-field-border-radius' => "3",
				'zewges-subscribe-button-text' => 'Get The Scoop',
				'zewges-subscribe-button-color' => '#00c98d',
				'zewges-subscribe-button-text-font' => 'Arial, Helvetica, sans-serif',
				'zewges-subscribe-button-text-color' => "#ffffff",
				'zewges-subscribe-button-text-font-size' => "20",
				'zewges-subscribe-button-text-font-weight' => "400",
				'zewges-subscribe-button-text-line-height' => "16",
				'zewges-subscribe-button-text-align' => "center",
				'zewges-subscribe-button-text-padding-top' => '10',
				'zewges-subscribe-button-text-padding-bottom' => '8',
				'zewges-subscribe-button-text-width' => '180px',
				'zewges-subscribe-button-text-border-radius' => "3",
				'zewges-subscribe-button-top' => '380',
				'zewges-subscribe-button-left' => '380',
				'zewges-overlay-color' => "#505050",
				'zewges-overlay-opacity' => '0.5',
				'zewges-overlay-color-rgba' => '80,80,80,0.5',
				'zewges-hide-overlay' => 'false',
				'zewges-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'zewges-content-box-position' => 'absolute',
				'zewges-disable-overlay-close' => 'false',
				'zewges-show-embedded-border' => "false",
				'zewges-embedded-border-css' => "",
				'zewges-hide-name-field' => "false",
				'zewges-hide-lname-field' => "true",
				'zewges-popup-location' => 'center',
				'zewges-popup-vertical-selection' => 'top',
				'zewges-popup-horizontal-selection' => 'left',
				'zewges-popup-top' => '40%',
				'zewges-popup-left' => '50%',
				'zewges-popup-bottom' => '40%',
				'zewges-popup-right' => '50%',

				'zewges-width-960' => '500',
				'zewges-height-960' => '358',
				'zewges-headline-960-top' => '0',
				'zewges-headline-960-left' => '0',
				'zewges-headline-960-width' => "0",
				'zewges-headline-960-height' => "0",
				'zewges-headline-960-font-size' => '24',
				'zewges-headline-960-line-height' => '24',
				'zewges-textbox-1-960-top' => '0',
				'zewges-textbox-1-960-left' => '0',
				'zewges-textbox-1-960-width' => "0",
				'zewges-textbox-1-960-height' => "0",
				'zewges-textbox-1-960-font-size' => '14',
				'zewges-textbox-1-960-line-height' => '18',
				'zewges-textbox-2-960-top' => '0',
				'zewges-textbox-2-960-left' => '0',
				'zewges-textbox-2-960-width' => "0",
				'zewges-textbox-2-960-height' => "0",
				'zewges-textbox-2-960-font-size' => '14',
				'zewges-textbox-2-960-line-height' => '18',
				'zewges-image-1-960-width' => '0',
				'zewges-image-1-960-height' => '0',
				'zewges-image-1-960-top' => '0',
				'zewges-image-1-960-left' => '0',
				'zewges-video-1-960-width' => '500',
				'zewges-video-1-960-height' => '308',
				'zewges-video-1-960-top' => '0',
				'zewges-video-1-960-left' => '0',
				'zewges-name-field-960-top' => '315',
				'zewges-name-field-960-left' => '20',
				'zewges-name-field-960-font-size' => '14',
				'zewges-name-field-960-line-height' => '14',
				'zewges-name-field-960-padding-top' => '10',
				'zewges-name-field-960-padding-bottom' => '10',
				'zewges-name-field-960-padding-left' => '10',
				'zewges-name-field-960-padding-right' => '10',
				'zewges-name-field-960-width' => '133px',
				'zewges-name-field-960-border-radius' => "3",
				'zewges-lname-field-960-top' => '145',
				'zewges-lname-field-960-left' => '120',
				'zewges-lname-field-960-font-size' => '16',
				'zewges-lname-field-960-line-height' => '16',
				'zewges-lname-field-960-padding-top' => '10',
				'zewges-lname-field-960-padding-bottom' => '10',
				'zewges-lname-field-960-padding-left' => '10',
				'zewges-lname-field-960-padding-right' => '10',
				'zewges-lname-field-960-width' => '340px',
				'zewges-lname-field-960-border-radius' => "3",
				'zewges-email-field-960-top' => '315',
				'zewges-email-field-960-left' => '170',
				'zewges-email-field-960-font-size' => '14',
				'zewges-email-field-960-line-height' => '14',
				'zewges-email-field-960-padding-top' => '10',
				'zewges-email-field-960-padding-bottom' => '10',
				'zewges-email-field-960-padding-left' => '10',
				'zewges-email-field-960-padding-right' => '10',
				'zewges-email-field-960-width' => '133px',
				'zewges-email-field-960-border-radius' => "3",
				'zewges-subscribe-button-960-top' => '315',
				'zewges-subscribe-button-960-left' => '320',
				'zewges-subscribe-button-text-960-font-size' => '14',
				'zewges-subscribe-button-text-960-line-height' => '14',
				'zewges-subscribe-button-text-960-padding-top' => '10',
				'zewges-subscribe-button-text-960-padding-bottom' => '10',
				'zewges-subscribe-button-text-960-width' => '150px',
				'zewges-subscribe-button-text-960-border-radius' => "3",
				'zewges-popup-960-top' => '50%',
				'zewges-popup-960-left' => '50%',
				'zewges-popup-960-bottom' => '50%',
				'zewges-popup-960-right' => '50%',

				'zewges-width-640' => '300',
				'zewges-height-640' => '217',
				'zewges-headline-640-top' => '0',
				'zewges-headline-640-left' => '0',
				'zewges-headline-640-width' => "0",
				'zewges-headline-640-height' => "0",
				'zewges-headline-640-font-size' => '18',
				'zewges-headline-640-line-height' => '24',
				'zewges-textbox-1-640-top' => '0',
				'zewges-textbox-1-640-left' => '0',
				'zewges-textbox-1-640-width' => "0",
				'zewges-textbox-1-640-height' => "0",
				'zewges-textbox-1-640-font-size' => '12',
				'zewges-textbox-1-640-line-height' => '16',
				'zewges-textbox-2-640-top' => '0',
				'zewges-textbox-2-640-left' => '0',
				'zewges-textbox-2-640-width' => "0",
				'zewges-textbox-2-640-height' => "0",
				'zewges-textbox-2-640-font-size' => '12',
				'zewges-textbox-2-640-line-height' => '16',
				'zewges-image-1-640-width' => '0',
				'zewges-image-1-640-height' => '0',
				'zewges-image-1-640-top' => '0',
				'zewges-image-1-640-left' => '0',
				'zewges-video-1-640-width' => '300',
				'zewges-video-1-640-height' => '185',
				'zewges-video-1-640-top' => '0',
				'zewges-video-1-640-left' => '0',
				'zewges-name-field-640-top' => '190',
				'zewges-name-field-640-left' => '5',
				'zewges-name-field-640-font-size' => '10',
				'zewges-name-field-640-line-height' => '10',
				'zewges-name-field-640-padding-top' => '5',
				'zewges-name-field-640-padding-bottom' => '5',
				'zewges-name-field-640-padding-left' => '6',
				'zewges-name-field-640-padding-right' => '6',
				'zewges-name-field-640-width' => '100px',
				'zewges-name-field-640-border-radius' => "3",
				'zewges-lname-field-640-top' => '115',
				'zewges-lname-field-640-left' => '85',
				'zewges-lname-field-640-font-size' => '12',
				'zewges-lname-field-640-line-height' => '12',
				'zewges-lname-field-640-padding-top' => '9',
				'zewges-lname-field-640-padding-bottom' => '9',
				'zewges-lname-field-640-padding-left' => '10',
				'zewges-lname-field-640-padding-right' => '10',
				'zewges-lname-field-640-width' => '285px',
				'zewges-lname-field-640-border-radius' => "3",
				'zewges-email-field-640-top' => '190',
				'zewges-email-field-640-left' => '107',
				'zewges-email-field-640-font-size' => '10',
				'zewges-email-field-640-line-height' => '10',
				'zewges-email-field-640-padding-top' => '5',
				'zewges-email-field-640-padding-bottom' => '5',
				'zewges-email-field-640-padding-left' => '6',
				'zewges-email-field-640-padding-right' => '6',
				'zewges-email-field-640-width' => '100px',
				'zewges-email-field-640-border-radius' => "3",
				'zewges-subscribe-button-640-top' => '190',
				'zewges-subscribe-button-640-left' => '212',
				'zewges-subscribe-button-text-640-font-size' => '10',
				'zewges-subscribe-button-text-640-line-height' => '10',
				'zewges-subscribe-button-text-640-padding-top' => '5',
				'zewges-subscribe-button-text-640-padding-bottom' => '5',
				'zewges-subscribe-button-text-640-width' => '80px',
				'zewges-subscribe-button-text-640-border-radius' => "3",
				'zewges-popup-640-top' => '50%',
				'zewges-popup-640-left' => '50%',
				'zewges-popup-640-bottom' => '50%',
				'zewges-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'zewges-headline' => array(0, '.zewges-preview-headline', '#zewges-preview-headline'),
				'zewges-textbox-1' => array(0, '.zewges-preview-textbox-1', '#zewges-preview-textbox-1'),
				'zewges-textbox-2' => array(0, '.zewges-preview-textbox-2', '#zewges-preview-textbox-2'),
				'zewges-name-field' => array(1, '.zewges-preview-name', '#zewges-preview-name'),
				'zewges-lname-field' => array(1, '.zewges-preview-lname', '#zewges-preview-lname'),
				'zewges-email-field' => array(1, '.zewges-preview-email', '#zewges-preview-email'),
				'zewges-subscribe-button-text' => array(2, '.zewges-subscribe-button', '#zewges-subscribe-button'),
				'zewges-headline-960' => array(3, '#zewges-preview-headline-960'),
				'zewges-textbox-1-960' => array(3, '#zewges-preview-textbox-1-960'),
				'zewges-textbox-2-960' => array(3, '#zewges-preview-textbox-2-960'),
				'zewges-name-field-960' => array(4, '#zewges-preview-name-960'),
				'zewges-lname-field-960' => array(4, '#zewges-preview-lname-960'),
				'zewges-email-field-960' => array(4, '#zewges-preview-email-960'),
				'zewges-subscribe-button-text-960' => array(5, '#zewges-subscribe-button-960'),
				'zewges-headline-640' => array(3, '#zewges-preview-headline-640'),
				'zewges-textbox-1-640' => array(3, '#zewges-preview-textbox-1-640'),
				'zewges-textbox-2-640' => array(3, '#zewges-preview-textbox-2-640'),
				'zewges-name-field-640' => array(4, '#zewges-preview-name-640'),
				'zewges-lname-field-640' => array(4, '#zewges-preview-lname-640'),
				'zewges-email-field-640' => array(4, '#zewges-preview-email-640'),
				'zewges-subscribe-button-text-640' => array(5, '#zewges-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'zewges-hide-name-field',
				'zewges-hide-lname-field',
				'zewges-hide-overlay',
				'zewges-disable-overlay-close',
				'zewges-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['zewges-text-color'])) {
					$new_style[$id]['zewges-headline-color'] = $setting['zewges-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			if ($is_active && !isset($setting['zewges-hide-lname-field'])) {
				$setting['zewges-hide-lname-field'] = 'false';
			}
			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['zewges-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'zewges-background-image-url');
			$style['zewges-image-1'] = PopupAllyProTemplate::image_url_code_generation($style, 'zewges-image-1-url');

			// disable background close trigger
			if ('true' === $style['zewges-disable-overlay-close']) {
				$style['zewges-overlay-close-trigger'] = '';
			} else {
				$style['zewges-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['zewges-show-embedded-border']) {
				$style['zewges-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['zewges-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'zewges-hide-name-field', 'zewges-name-input-type', 'zewges-preview-hide-name', 'zewges-sign-up-form-name-field', 'sign-up-form-name-field');
			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'zewges-hide-lname-field', 'zewges-lname-input-type', 'zewges-preview-hide-lname', 'zewges-sign-up-form-lname-field', 'sign-up-form-lname-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'zewges-hide-overlay', 'zewges-background-overlay-css', 'zewges-content-box-position');
			$style['zewges-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['zewges-overlay-color'], $style['zewges-overlay-opacity']);
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

			$html = str_replace("{{zewges-background-image-size}}", PopupAllyProTemplate::generate_background_size_selection_code($setting, 'zewges-background-image-size'), $html);

			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{zewges-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'zewges-popup-location'), $html);
			$html = str_replace("{{zewges-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'zewges-popup-vertical-selection'), $html);
			$html = str_replace("{{zewges-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'zewges-popup-horizontal-selection'), $html);
			return $html;
		}

		public function make_backwards_compatible($style) {
			if (!isset($style['zewges-background-image-size'])) {
				$style['zewges-background-image-size'] = 'contain';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['zewges-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['zewges-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['zewges-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['zewges-popup-location'] === 'other') {
				return $style['zewges-popup-vertical-selection'] . ':' . $style['zewges-popup' . $size_postfix. '-' . $style['zewges-popup-vertical-selection']] . ';' .
						$style['zewges-popup-horizontal-selection'] . ':' . $style['zewges-popup' . $size_postfix. '-' . $style['zewges-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['zewges-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProVideoTemplate());
}
