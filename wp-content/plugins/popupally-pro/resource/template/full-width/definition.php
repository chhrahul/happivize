<?php
if (!class_exists('PopupAllyProFullWidthTemplate')) {
	class PopupAllyProFullWidthTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'cjthhv';
			$this->template_name = 'Full Width';
			$this->template_order = 2;

			$this->backend_php = dirname(__FILE__) . '/backend/full-width-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'cjthhv-hide-name-field', 'lname'=>true, 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/full-width-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/full-width-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/full-width-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/full-width-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/full-width-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/full-width-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/full-width-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/full-width-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('cjthhv-name-placeholder', 'cjthhv-email-placeholder', 'cjthhv-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'cjthhv-sign-up-form-name-field',
				'sign-up-form-email-field', 'cjthhv-name-input-type', 'cjthhv-overlay-close-trigger');
			$this->no_escape_html_mapping = array('cjthhv-headline', 'cjthhv-preview-hide-name', 'sign-up-form-name-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'cjthhv-background-color' => '#e34a63',
				'cjthhv-image-url' => '',
				'cjthhv-background-image' => 'none',
				'cjthhv-width' => '940',
				'cjthhv-height' => '37',
				'cjthhv-headline' => 'Send me the FREE eBook',
				'cjthhv-headline-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'cjthhv-headline-color' => "#111111",
				'cjthhv-headline-font-size' => "20",
				'cjthhv-headline-font-weight' => "700",
				'cjthhv-headline-line-height' => "24",
				'cjthhv-headline-align' => "center",
				'cjthhv-headline-top' => '5',
				'cjthhv-headline-left' => '60',
				'cjthhv-name-placeholder' => 'Name',
				'cjthhv-name-field-top' => '5',
				'cjthhv-name-field-left' => '90',
				'cjthhv-name-field-font' => 'Arial, Helvetica, sans-serif',
				'cjthhv-name-field-color' => "#444444",
				'cjthhv-name-field-background-color' => "#f6f6f6",
				'cjthhv-name-field-font-size' => "16",
				'cjthhv-name-field-line-height' => "16",
				'cjthhv-name-field-font-weight' => "400",
				'cjthhv-name-field-padding-top' => '5',
				'cjthhv-name-field-padding-bottom' => '4',
				'cjthhv-name-field-padding-left' => '4',
				'cjthhv-name-field-padding-right' => '4',
				'cjthhv-name-field-width' => '200px',
				'cjthhv-name-field-align' => "left",
				'cjthhv-name-field-border-radius' => "3",
				'cjthhv-email-placeholder' => 'Email',
				'cjthhv-email-field-top' => '5',
				'cjthhv-email-field-left' => '95',
				'cjthhv-email-field-font' => 'Arial, Helvetica, sans-serif',
				'cjthhv-email-field-color' => "#444444",
				'cjthhv-email-field-background-color' => "#f6f6f6",
				'cjthhv-email-field-font-size' => "16",
				'cjthhv-email-field-line-height' => "16",
				'cjthhv-email-field-font-weight' => "400",
				'cjthhv-email-field-padding-top' => '5',
				'cjthhv-email-field-padding-bottom' => '4',
				'cjthhv-email-field-padding-left' => '4',
				'cjthhv-email-field-padding-right' => '4',
				'cjthhv-email-field-width' => '200px',
				'cjthhv-email-field-align' => "left",
				'cjthhv-email-field-border-radius' => "3",
				'cjthhv-subscribe-button-text' => 'Sign up!',
				'cjthhv-subscribe-button-color' => '#81d742',
				'cjthhv-subscribe-button-text-font' => 'Arial, Helvetica, sans-serif',
				'cjthhv-subscribe-button-text-color' => "#ffffff",
				'cjthhv-subscribe-button-text-font-size' => "16",
				'cjthhv-subscribe-button-text-font-weight' => "700",
				'cjthhv-subscribe-button-text-line-height' => "16",
				'cjthhv-subscribe-button-text-align' => "center",
				'cjthhv-subscribe-button-text-padding-top' => '5',
				'cjthhv-subscribe-button-text-padding-bottom' => '5',
				'cjthhv-subscribe-button-text-width' => '100px',
				'cjthhv-subscribe-button-text-border-radius' => "3",
				'cjthhv-subscribe-button-top' => '5',
				'cjthhv-subscribe-button-left' => '100',
				'cjthhv-overlay-color' => "#505050",
				'cjthhv-overlay-opacity' => '0.5',
				'cjthhv-overlay-color-rgba' => '80,80,80,0.5',
				'cjthhv-hide-overlay' => 'false',
				'cjthhv-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'cjthhv-content-box-position' => 'absolute',
				'cjthhv-disable-overlay-close' => 'false',
				'cjthhv-show-embedded-border' => "false",
				'cjthhv-embedded-border-css' => "",
				'cjthhv-hide-name-field' => "false",
				'cjthhv-popup-location' => 'center',
				'cjthhv-popup-vertical-selection' => 'top',
				'cjthhv-popup-top' => '40%',
				'cjthhv-popup-bottom' => '40%',

				'cjthhv-width-960' => '600',
				'cjthhv-height-960' => '40',
				'cjthhv-headline-960-top' => '6',
				'cjthhv-headline-960-left' => '10',
				'cjthhv-headline-960-font-size' => '16',
				'cjthhv-headline-960-line-height' => '20',
				'cjthhv-name-field-960-top' => '8',
				'cjthhv-name-field-960-left' => '15',
				'cjthhv-name-field-960-font-size' => '14',
				'cjthhv-name-field-960-line-height' => '14',
				'cjthhv-name-field-960-padding-top' => '5',
				'cjthhv-name-field-960-padding-bottom' => '2',
				'cjthhv-name-field-960-padding-left' => '4',
				'cjthhv-name-field-960-padding-right' => '4',
				'cjthhv-name-field-960-width' => '150px',
				'cjthhv-name-field-960-border-radius' => "3",
				'cjthhv-email-field-960-top' => '8',
				'cjthhv-email-field-960-left' => '20',
				'cjthhv-email-field-960-font-size' => '14',
				'cjthhv-email-field-960-line-height' => '14',
				'cjthhv-email-field-960-padding-top' => '5',
				'cjthhv-email-field-960-padding-bottom' => '2',
				'cjthhv-email-field-960-padding-left' => '4',
				'cjthhv-email-field-960-padding-right' => '4',
				'cjthhv-email-field-960-width' => '150px',
				'cjthhv-email-field-960-border-radius' => "3",
				'cjthhv-subscribe-button-960-top' => '7',
				'cjthhv-subscribe-button-960-left' => '25',
				'cjthhv-subscribe-button-text-960-font-size' => '16',
				'cjthhv-subscribe-button-text-960-line-height' => '16',
				'cjthhv-subscribe-button-text-960-padding-top' => '3',
				'cjthhv-subscribe-button-text-960-padding-bottom' => '3',
				'cjthhv-subscribe-button-text-960-width' => '80px',
				'cjthhv-subscribe-button-text-960-border-radius' => "3",
				'cjthhv-popup-960-top' => '50%',
				'cjthhv-popup-960-bottom' => '50%',

				'cjthhv-width-640' => '300',
				'cjthhv-height-640' => '50',
				'cjthhv-headline-640-top' => '5',
				'cjthhv-headline-640-left' => '10',
				'cjthhv-headline-640-font-size' => '14',
				'cjthhv-headline-640-line-height' => '16',
				'cjthhv-name-field-640-top' => '8',
				'cjthhv-name-field-640-left' => '10',
				'cjthhv-name-field-640-font-size' => '10',
				'cjthhv-name-field-640-line-height' => '10',
				'cjthhv-name-field-640-padding-top' => '3',
				'cjthhv-name-field-640-padding-bottom' => '3',
				'cjthhv-name-field-640-padding-left' => '4',
				'cjthhv-name-field-640-padding-right' => '4',
				'cjthhv-name-field-640-width' => '100px',
				'cjthhv-name-field-640-border-radius' => "3",
				'cjthhv-email-field-640-top' => '8',
				'cjthhv-email-field-640-left' => '15',
				'cjthhv-email-field-640-font-size' => '10',
				'cjthhv-email-field-640-line-height' => '10',
				'cjthhv-email-field-640-padding-top' => '3',
				'cjthhv-email-field-640-padding-bottom' => '3',
				'cjthhv-email-field-640-padding-left' => '4',
				'cjthhv-email-field-640-padding-right' => '4',
				'cjthhv-email-field-640-width' => '100px',
				'cjthhv-email-field-640-border-radius' => "3",
				'cjthhv-subscribe-button-640-top' => '8',
				'cjthhv-subscribe-button-640-left' => '20',
				'cjthhv-subscribe-button-text-640-font-size' => '10',
				'cjthhv-subscribe-button-text-640-line-height' => '10',
				'cjthhv-subscribe-button-text-640-padding-top' => '3',
				'cjthhv-subscribe-button-text-640-padding-bottom' => '3',
				'cjthhv-subscribe-button-text-640-width' => '70px',
				'cjthhv-subscribe-button-text-640-border-radius' => "3",
				'cjthhv-popup-640-top' => '50%',
				'cjthhv-popup-640-bottom' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'cjthhv-headline' => array(0, '.cjthhv-preview-headline', '#cjthhv-preview-headline'),
				'cjthhv-name-field' => array(1, '.cjthhv-preview-name', '#cjthhv-preview-name'),
				'cjthhv-email-field' => array(1, '.cjthhv-preview-email', '#cjthhv-preview-email'),
				'cjthhv-subscribe-button-text' => array(2, '.cjthhv-subscribe-button', '#cjthhv-subscribe-button'),
				'cjthhv-headline-960' => array(3, '.cjthhv-preview-headline-960'),
				'cjthhv-name-field-960' => array(4, '.cjthhv-preview-name-960'),
				'cjthhv-email-field-960' => array(4, '.cjthhv-preview-email-960'),
				'cjthhv-subscribe-button-text-960' => array(5, '.cjthhv-subscribe-button-960'),
				'cjthhv-headline-640' => array(3, '.cjthhv-preview-headline-640'),
				'cjthhv-name-field-640' => array(4, '.cjthhv-preview-name-640'),
				'cjthhv-email-field-640' => array(4, '.cjthhv-preview-email-640'),
				'cjthhv-subscribe-button-text-640' => array(5, '.cjthhv-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'cjthhv-hide-name-field',
				'cjthhv-hide-overlay',
				'cjthhv-disable-overlay-close',
				'cjthhv-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['cjthhv-text-color'])) {
					$new_style[$id]['cjthhv-headline-color'] = $setting['cjthhv-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['cjthhv-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'cjthhv-image-url');

			// disable background close trigger
			if ('true' === $style['cjthhv-disable-overlay-close']) {
				$style['cjthhv-overlay-close-trigger'] = '';
			} else {
				$style['cjthhv-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['cjthhv-show-embedded-border']) {
				$style['cjthhv-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['cjthhv-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'cjthhv-hide-name-field', 'cjthhv-name-input-type', 'cjthhv-preview-hide-name', 'cjthhv-sign-up-form-name-field', 'sign-up-form-name-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'cjthhv-hide-overlay', 'cjthhv-background-overlay-css', 'cjthhv-content-box-position');

			$style['cjthhv-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['cjthhv-overlay-color'], $style['cjthhv-overlay-opacity']);
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
			$html = str_replace("{{cjthhv-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'cjthhv-popup-location'), $html);
			$html = str_replace("{{cjthhv-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'cjthhv-popup-vertical-selection'), $html);
			return $html;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['cjthhv-popup-location'] === 'center') {
				return 'top:50%;margin-top:-' . (intval($style['cjthhv-height' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['cjthhv-popup-location'] === 'other') {
				return $style['cjthhv-popup-vertical-selection'] . ':' . $style['cjthhv-popup' . $size_postfix. '-' . $style['cjthhv-popup-vertical-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['cjthhv-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProFullWidthTemplate());
}
