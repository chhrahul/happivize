<?php
if (!class_exists('PopupAllyProPointTemplate')) {
	class PopupAllyProPointTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'rwnkmg';
			$this->template_name = 'Look Here!';
			$this->template_order = 7;

			$this->backend_php = dirname(__FILE__) . '/backend/point-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'rwnkmg-hide-name-field', 'lname'=>'rwnkmg-hide-lname-field', 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/point-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/point-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/point-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/point-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/point-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/point-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/point-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/point-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('rwnkmg-name-placeholder', 'rwnkmg-lname-placeholder', 'rwnkmg-email-placeholder', 'rwnkmg-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'rwnkmg-sign-up-form-name-field',
				'rwnkmg-sign-up-form-lname-field', 'sign-up-form-email-field', 'rwnkmg-name-input-type', 'rwnkmg-lname-input-type', 'rwnkmg-overlay-close-trigger');
			$this->no_escape_html_mapping = array('rwnkmg-headline', 'rwnkmg-textbox-1', 'rwnkmg-textbox-2', 'rwnkmg-preview-hide-name', 'rwnkmg-preview-hide-lname',
				'sign-up-form-name-frontend-required', 'sign-up-form-lname-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'rwnkmg-background-color' => '#fefefe',
				'rwnkmg-background-image-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/point-bg.png',
				'rwnkmg-background-image' => 'none',
				'rwnkmg-background-image-size' => 'cover',
				'rwnkmg-width' => '600',
				'rwnkmg-height' => '340',
				'rwnkmg-headline' => 'Want The Latest Scoop In Digital Strategy Straight From The Co-Founder of AmbitionAlly?',
				'rwnkmg-headline-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'rwnkmg-headline-color' => "#111111",
				'rwnkmg-headline-font-size' => "28",
				'rwnkmg-headline-font-weight' => "700",
				'rwnkmg-headline-line-height' => "30",
				'rwnkmg-headline-width' => "390",
				'rwnkmg-headline-height' => "140",
				'rwnkmg-headline-align' => "center",
				'rwnkmg-headline-top' => '20',
				'rwnkmg-headline-left' => '170',
				'rwnkmg-textbox-1' => "Get it delivered straight to your inbox every week... it's free!",
				'rwnkmg-textbox-1-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'rwnkmg-textbox-1-color' => "#111111",
				'rwnkmg-textbox-1-font-size' => "17",
				'rwnkmg-textbox-1-font-weight' => "700",
				'rwnkmg-textbox-1-line-height' => "20",
				'rwnkmg-textbox-1-width' => "280",
				'rwnkmg-textbox-1-height' => "50",
				'rwnkmg-textbox-1-align' => "center",
				'rwnkmg-textbox-1-top' => '220',
				'rwnkmg-textbox-1-left' => '300',
				'rwnkmg-textbox-2' => '',
				'rwnkmg-textbox-2-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'rwnkmg-textbox-2-color' => "#111111",
				'rwnkmg-textbox-2-font-size' => "24",
				'rwnkmg-textbox-2-font-weight' => "700",
				'rwnkmg-textbox-2-line-height' => "32",
				'rwnkmg-textbox-2-width' => "0",
				'rwnkmg-textbox-2-height' => "0",
				'rwnkmg-textbox-2-align' => "left",
				'rwnkmg-textbox-2-top' => '0',
				'rwnkmg-textbox-2-left' => '0',
				'rwnkmg-image-1' => 'none',
				'rwnkmg-image-1-url' => '',
				'rwnkmg-image-1-width' => '0',
				'rwnkmg-image-1-height' => '0',
				'rwnkmg-image-1-top' => '0',
				'rwnkmg-image-1-left' => '0',
				'rwnkmg-image-2' => 'none',
				'rwnkmg-image-2-url' => '',
				'rwnkmg-image-2-width' => '0',
				'rwnkmg-image-2-height' => '0',
				'rwnkmg-image-2-top' => '0',
				'rwnkmg-image-2-left' => '0',
				'rwnkmg-name-placeholder' => 'Your name',
				'rwnkmg-name-field-top' => '290',
				'rwnkmg-name-field-left' => '30',
				'rwnkmg-name-field-font' => 'Arial, Helvetica, sans-serif',
				'rwnkmg-name-field-color' => "#444444",
				'rwnkmg-name-field-background-color' => "#f6f6f6",
				'rwnkmg-name-field-font-size' => "18",
				'rwnkmg-name-field-line-height' => "16",
				'rwnkmg-name-field-font-weight' => "400",
				'rwnkmg-name-field-padding-top' => '10',
				'rwnkmg-name-field-padding-bottom' => '5',
				'rwnkmg-name-field-padding-left' => '10',
				'rwnkmg-name-field-padding-right' => '10',
				'rwnkmg-name-field-width' => '170px',
				'rwnkmg-name-field-align' => "left",
				'rwnkmg-name-field-border-radius' => "3",
				'rwnkmg-lname-placeholder' => 'Last name',
				'rwnkmg-lname-field-top' => '190',
				'rwnkmg-lname-field-left' => '110',
				'rwnkmg-lname-field-font' => 'Arial, Helvetica, sans-serif',
				'rwnkmg-lname-field-color' => "#444444",
				'rwnkmg-lname-field-background-color' => "#f6f6f6",
				'rwnkmg-lname-field-font-size' => "20",
				'rwnkmg-lname-field-line-height' => "20",
				'rwnkmg-lname-field-font-weight' => "400",
				'rwnkmg-lname-field-padding-top' => '10',
				'rwnkmg-lname-field-padding-bottom' => '10',
				'rwnkmg-lname-field-padding-left' => '10',
				'rwnkmg-lname-field-padding-right' => '10',
				'rwnkmg-lname-field-width' => '450px',
				'rwnkmg-lname-field-border-radius' => "3",
				'rwnkmg-lname-field-align' => "left",
				'rwnkmg-email-placeholder' => 'Email',
				'rwnkmg-email-field-top' => '290',
				'rwnkmg-email-field-left' => '210',
				'rwnkmg-email-field-font' => 'Arial, Helvetica, sans-serif',
				'rwnkmg-email-field-color' => "#444444",
				'rwnkmg-email-field-background-color' => "#f6f6f6",
				'rwnkmg-email-field-font-size' => "18",
				'rwnkmg-email-field-line-height' => "16",
				'rwnkmg-email-field-font-weight' => "400",
				'rwnkmg-email-field-padding-top' => '10',
				'rwnkmg-email-field-padding-bottom' => '5',
				'rwnkmg-email-field-padding-left' => '10',
				'rwnkmg-email-field-padding-right' => '10',
				'rwnkmg-email-field-width' => '160px',
				'rwnkmg-email-field-align' => "left",
				'rwnkmg-email-field-border-radius' => "3",
				'rwnkmg-subscribe-button-text' => 'Get The Scoop',
				'rwnkmg-subscribe-button-color' => '#00c98d',
				'rwnkmg-subscribe-button-text-font' => 'Arial, Helvetica, sans-serif',
				'rwnkmg-subscribe-button-text-color' => "#ffffff",
				'rwnkmg-subscribe-button-text-font-size' => "20",
				'rwnkmg-subscribe-button-text-font-weight' => "400",
				'rwnkmg-subscribe-button-text-line-height' => "16",
				'rwnkmg-subscribe-button-text-align' => "center",
				'rwnkmg-subscribe-button-text-padding-top' => '10',
				'rwnkmg-subscribe-button-text-padding-bottom' => '8',
				'rwnkmg-subscribe-button-text-width' => '180px',
				'rwnkmg-subscribe-button-text-border-radius' => "3",
				'rwnkmg-subscribe-button-top' => '290',
				'rwnkmg-subscribe-button-left' => '380',
				'rwnkmg-overlay-color' => "#505050",
				'rwnkmg-overlay-opacity' => '0.5',
				'rwnkmg-overlay-color-rgba' => '80,80,80,0.5',
				'rwnkmg-hide-overlay' => 'false',
				'rwnkmg-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'rwnkmg-content-box-position' => 'absolute',
				'rwnkmg-disable-overlay-close' => 'false',
				'rwnkmg-show-embedded-border' => "false",
				'rwnkmg-embedded-border-css' => "",
				'rwnkmg-hide-name-field' => "false",
				'rwnkmg-hide-lname-field' => "true",
				'rwnkmg-popup-location' => 'center',
				'rwnkmg-popup-vertical-selection' => 'top',
				'rwnkmg-popup-horizontal-selection' => 'left',
				'rwnkmg-popup-top' => '40%',
				'rwnkmg-popup-left' => '50%',
				'rwnkmg-popup-bottom' => '40%',
				'rwnkmg-popup-right' => '50%',

				'rwnkmg-width-960' => '499',
				'rwnkmg-height-960' => '283',
				'rwnkmg-headline-960-top' => '10',
				'rwnkmg-headline-960-left' => '140',
				'rwnkmg-headline-960-width' => "350",
				'rwnkmg-headline-960-height' => "100",
				'rwnkmg-headline-960-font-size' => '24',
				'rwnkmg-headline-960-line-height' => '24',
				'rwnkmg-textbox-1-960-top' => '180',
				'rwnkmg-textbox-1-960-left' => '240',
				'rwnkmg-textbox-1-960-width' => "240",
				'rwnkmg-textbox-1-960-height' => "50",
				'rwnkmg-textbox-1-960-font-size' => '14',
				'rwnkmg-textbox-1-960-line-height' => '18',
				'rwnkmg-textbox-2-960-top' => '0',
				'rwnkmg-textbox-2-960-left' => '0',
				'rwnkmg-textbox-2-960-width' => "0",
				'rwnkmg-textbox-2-960-height' => "0",
				'rwnkmg-textbox-2-960-font-size' => '14',
				'rwnkmg-textbox-2-960-line-height' => '18',
				'rwnkmg-image-1-960-width' => '0',
				'rwnkmg-image-1-960-height' => '0',
				'rwnkmg-image-1-960-top' => '0',
				'rwnkmg-image-1-960-left' => '0',
				'rwnkmg-image-2-960-width' => '0',
				'rwnkmg-image-2-960-height' => '0',
				'rwnkmg-image-2-960-top' => '0',
				'rwnkmg-image-2-960-left' => '0',
				'rwnkmg-name-field-960-top' => '240',
				'rwnkmg-name-field-960-left' => '20',
				'rwnkmg-name-field-960-font-size' => '14',
				'rwnkmg-name-field-960-line-height' => '14',
				'rwnkmg-name-field-960-padding-top' => '10',
				'rwnkmg-name-field-960-padding-bottom' => '10',
				'rwnkmg-name-field-960-padding-left' => '10',
				'rwnkmg-name-field-960-padding-right' => '10',
				'rwnkmg-name-field-960-width' => '133px',
				'rwnkmg-name-field-960-border-radius' => "3",
				'rwnkmg-lname-field-960-top' => '145',
				'rwnkmg-lname-field-960-left' => '120',
				'rwnkmg-lname-field-960-font-size' => '16',
				'rwnkmg-lname-field-960-line-height' => '16',
				'rwnkmg-lname-field-960-padding-top' => '10',
				'rwnkmg-lname-field-960-padding-bottom' => '10',
				'rwnkmg-lname-field-960-padding-left' => '10',
				'rwnkmg-lname-field-960-padding-right' => '10',
				'rwnkmg-lname-field-960-width' => '340px',
				'rwnkmg-lname-field-960-border-radius' => "3",
				'rwnkmg-email-field-960-top' => '240',
				'rwnkmg-email-field-960-left' => '170',
				'rwnkmg-email-field-960-font-size' => '14',
				'rwnkmg-email-field-960-line-height' => '14',
				'rwnkmg-email-field-960-padding-top' => '10',
				'rwnkmg-email-field-960-padding-bottom' => '10',
				'rwnkmg-email-field-960-padding-left' => '10',
				'rwnkmg-email-field-960-padding-right' => '10',
				'rwnkmg-email-field-960-width' => '133px',
				'rwnkmg-email-field-960-border-radius' => "3",
				'rwnkmg-subscribe-button-960-top' => '240',
				'rwnkmg-subscribe-button-960-left' => '320',
				'rwnkmg-subscribe-button-text-960-font-size' => '14',
				'rwnkmg-subscribe-button-text-960-line-height' => '14',
				'rwnkmg-subscribe-button-text-960-padding-top' => '10',
				'rwnkmg-subscribe-button-text-960-padding-bottom' => '10',
				'rwnkmg-subscribe-button-text-960-width' => '150px',
				'rwnkmg-subscribe-button-text-960-border-radius' => "3",
				'rwnkmg-popup-960-top' => '50%',
				'rwnkmg-popup-960-left' => '50%',
				'rwnkmg-popup-960-bottom' => '50%',
				'rwnkmg-popup-960-right' => '50%',

				'rwnkmg-width-640' => '300',
				'rwnkmg-height-640' => '170',
				'rwnkmg-headline-640-top' => '5',
				'rwnkmg-headline-640-left' => '80',
				'rwnkmg-headline-640-width' => "220",
				'rwnkmg-headline-640-height' => "60",
				'rwnkmg-headline-640-font-size' => '14',
				'rwnkmg-headline-640-line-height' => '18',
				'rwnkmg-textbox-1-640-top' => '70',
				'rwnkmg-textbox-1-640-left' => '150',
				'rwnkmg-textbox-1-640-width' => "150",
				'rwnkmg-textbox-1-640-height' => "50",
				'rwnkmg-textbox-1-640-font-size' => '12',
				'rwnkmg-textbox-1-640-line-height' => '16',
				'rwnkmg-textbox-2-640-top' => '0',
				'rwnkmg-textbox-2-640-left' => '0',
				'rwnkmg-textbox-2-640-width' => "0",
				'rwnkmg-textbox-2-640-height' => "0",
				'rwnkmg-textbox-2-640-font-size' => '12',
				'rwnkmg-textbox-2-640-line-height' => '16',
				'rwnkmg-image-1-640-width' => '0',
				'rwnkmg-image-1-640-height' => '0',
				'rwnkmg-image-1-640-top' => '0',
				'rwnkmg-image-1-640-left' => '0',
				'rwnkmg-image-2-640-width' => '0',
				'rwnkmg-image-2-640-height' => '0',
				'rwnkmg-image-2-640-top' => '0',
				'rwnkmg-image-2-640-left' => '0',
				'rwnkmg-name-field-640-top' => '144',
				'rwnkmg-name-field-640-left' => '10',
				'rwnkmg-name-field-640-font-size' => '10',
				'rwnkmg-name-field-640-line-height' => '10',
				'rwnkmg-name-field-640-padding-top' => '5',
				'rwnkmg-name-field-640-padding-bottom' => '5',
				'rwnkmg-name-field-640-padding-left' => '6',
				'rwnkmg-name-field-640-padding-right' => '6',
				'rwnkmg-name-field-640-width' => '100px',
				'rwnkmg-name-field-640-border-radius' => "3",
				'rwnkmg-lname-field-640-top' => '115',
				'rwnkmg-lname-field-640-left' => '85',
				'rwnkmg-lname-field-640-font-size' => '12',
				'rwnkmg-lname-field-640-line-height' => '12',
				'rwnkmg-lname-field-640-padding-top' => '9',
				'rwnkmg-lname-field-640-padding-bottom' => '9',
				'rwnkmg-lname-field-640-padding-left' => '10',
				'rwnkmg-lname-field-640-padding-right' => '10',
				'rwnkmg-lname-field-640-width' => '285px',
				'rwnkmg-lname-field-640-border-radius' => "3",
				'rwnkmg-email-field-640-top' => '144',
				'rwnkmg-email-field-640-left' => '112',
				'rwnkmg-email-field-640-font-size' => '10',
				'rwnkmg-email-field-640-line-height' => '10',
				'rwnkmg-email-field-640-padding-top' => '5',
				'rwnkmg-email-field-640-padding-bottom' => '5',
				'rwnkmg-email-field-640-padding-left' => '6',
				'rwnkmg-email-field-640-padding-right' => '6',
				'rwnkmg-email-field-640-width' => '100px',
				'rwnkmg-email-field-640-border-radius' => "3",
				'rwnkmg-subscribe-button-640-top' => '144',
				'rwnkmg-subscribe-button-640-left' => '215',
				'rwnkmg-subscribe-button-text-640-font-size' => '10',
				'rwnkmg-subscribe-button-text-640-line-height' => '10',
				'rwnkmg-subscribe-button-text-640-padding-top' => '5',
				'rwnkmg-subscribe-button-text-640-padding-bottom' => '5',
				'rwnkmg-subscribe-button-text-640-width' => '80px',
				'rwnkmg-subscribe-button-text-640-border-radius' => "3",
				'rwnkmg-popup-640-top' => '50%',
				'rwnkmg-popup-640-left' => '50%',
				'rwnkmg-popup-640-bottom' => '50%',
				'rwnkmg-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'rwnkmg-headline' => array(0, '.rwnkmg-preview-headline', '#rwnkmg-preview-headline'),
				'rwnkmg-textbox-1' => array(0, '.rwnkmg-preview-textbox-1', '#rwnkmg-preview-textbox-1'),
				'rwnkmg-textbox-2' => array(0, '.rwnkmg-preview-textbox-2', '#rwnkmg-preview-textbox-2'),
				'rwnkmg-name-field' => array(1, '.rwnkmg-preview-name', '#rwnkmg-preview-name'),
				'rwnkmg-lname-field' => array(1, '.rwnkmg-preview-lname', '#rwnkmg-preview-lname'),
				'rwnkmg-email-field' => array(1, '.rwnkmg-preview-email', '#rwnkmg-preview-email'),
				'rwnkmg-subscribe-button-text' => array(2, '.rwnkmg-subscribe-button', '#rwnkmg-subscribe-button'),
				'rwnkmg-headline-960' => array(3, '#rwnkmg-preview-headline-960'),
				'rwnkmg-textbox-1-960' => array(3, '#rwnkmg-preview-textbox-1-960'),
				'rwnkmg-textbox-2-960' => array(3, '#rwnkmg-preview-textbox-2-960'),
				'rwnkmg-name-field-960' => array(4, '#rwnkmg-preview-name-960'),
				'rwnkmg-lname-field-960' => array(4, '#rwnkmg-preview-lname-960'),
				'rwnkmg-email-field-960' => array(4, '#rwnkmg-preview-email-960'),
				'rwnkmg-subscribe-button-text-960' => array(5, '#rwnkmg-subscribe-button-960'),
				'rwnkmg-headline-640' => array(3, '#rwnkmg-preview-headline-640'),
				'rwnkmg-textbox-1-640' => array(3, '#rwnkmg-preview-textbox-1-640'),
				'rwnkmg-textbox-2-640' => array(3, '#rwnkmg-preview-textbox-2-640'),
				'rwnkmg-name-field-640' => array(4, '#rwnkmg-preview-name-640'),
				'rwnkmg-lname-field-640' => array(4, '#rwnkmg-preview-lname-640'),
				'rwnkmg-email-field-640' => array(4, '#rwnkmg-preview-email-640'),
				'rwnkmg-subscribe-button-text-640' => array(5, '#rwnkmg-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'rwnkmg-hide-name-field',
				'rwnkmg-hide-lname-field',
				'rwnkmg-hide-overlay',
				'rwnkmg-disable-overlay-close',
				'rwnkmg-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['rwnkmg-text-color'])) {
					$new_style[$id]['rwnkmg-headline-color'] = $setting['rwnkmg-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			if ($is_active && !isset($setting['rwnkmg-hide-lname-field'])) {
				$setting['rwnkmg-hide-lname-field'] = 'false';
			}
			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['rwnkmg-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'rwnkmg-background-image-url');
			$style['rwnkmg-image-1'] = PopupAllyProTemplate::image_url_code_generation($style, 'rwnkmg-image-1-url');
			$style['rwnkmg-image-2'] = PopupAllyProTemplate::image_url_code_generation($style, 'rwnkmg-image-2-url');

			// disable background close trigger
			if ('true' === $style['rwnkmg-disable-overlay-close']) {
				$style['rwnkmg-overlay-close-trigger'] = '';
			} else {
				$style['rwnkmg-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['rwnkmg-show-embedded-border']) {
				$style['rwnkmg-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['rwnkmg-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'rwnkmg-hide-name-field', 'rwnkmg-name-input-type', 'rwnkmg-preview-hide-name', 'rwnkmg-sign-up-form-name-field', 'sign-up-form-name-field');
			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'rwnkmg-hide-lname-field', 'rwnkmg-lname-input-type', 'rwnkmg-preview-hide-lname', 'rwnkmg-sign-up-form-lname-field', 'sign-up-form-lname-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'rwnkmg-hide-overlay', 'rwnkmg-background-overlay-css', 'rwnkmg-content-box-position');
			$style['rwnkmg-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['rwnkmg-overlay-color'], $style['rwnkmg-overlay-opacity']);
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

			$html = str_replace("{{rwnkmg-background-image-size}}", PopupAllyProTemplate::generate_background_size_selection_code($setting, 'rwnkmg-background-image-size'), $html);

			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{rwnkmg-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'rwnkmg-popup-location'), $html);
			$html = str_replace("{{rwnkmg-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'rwnkmg-popup-vertical-selection'), $html);
			$html = str_replace("{{rwnkmg-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'rwnkmg-popup-horizontal-selection'), $html);
			return $html;
		}

		public function make_backwards_compatible($style) {
			if (!isset($style['rwnkmg-background-image-size'])) {
				$style['rwnkmg-background-image-size'] = 'contain';
			}
			return $style;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['rwnkmg-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['rwnkmg-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['rwnkmg-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['rwnkmg-popup-location'] === 'other') {
				return $style['rwnkmg-popup-vertical-selection'] . ':' . $style['rwnkmg-popup' . $size_postfix. '-' . $style['rwnkmg-popup-vertical-selection']] . ';' .
						$style['rwnkmg-popup-horizontal-selection'] . ':' . $style['rwnkmg-popup' . $size_postfix. '-' . $style['rwnkmg-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['rwnkmg-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProPointTemplate());
}
