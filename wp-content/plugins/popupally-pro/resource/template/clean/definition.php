<?php
if (!class_exists('PopupAllyProCleanTemplate')) {
	class PopupAllyProCleanTemplate extends PopupAllyProTemplate {
		public function __construct() {
			parent::__construct();
			$this->uid = 'plsbvs';
			$this->template_name = 'Express yourself';
			$this->template_order = 1;

			$this->backend_php = dirname(__FILE__) . '/backend/clean-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>false, 'name'=>'plsbvs-hide-name-field', 'lname'=>true, 'email'=>false);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/clean-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/clean-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/clean-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/clean-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/clean-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/clean-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/clean-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/clean-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('plsbvs-name-placeholder', 'plsbvs-email-placeholder', 'plsbvs-subscribe-button-text', 'sign-up-form-method', 'sign-up-form-action', 'plsbvs-sign-up-form-name-field',
				'sign-up-form-email-field', 'plsbvs-name-input-type', 'plsbvs-overlay-close-trigger');
			$this->no_escape_html_mapping = array('plsbvs-headline', 'plsbvs-preview-hide-name', 'sign-up-form-name-frontend-required', 'sign-up-form-email-frontend-required');
			$this->default_values = array(
				'plsbvs-background-color' => '#d3d3d3',
				'plsbvs-image-url' => '',
				'plsbvs-background-image' => 'none',
				'plsbvs-width' => '940',
				'plsbvs-height' => '60',
				'plsbvs-headline' => 'Get free weekly updates:',
				'plsbvs-headline-font' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'plsbvs-headline-color' => "#111111",
				'plsbvs-headline-font-size' => "20",
				'plsbvs-headline-font-weight' => "700",
				'plsbvs-headline-line-height' => "24",
				'plsbvs-headline-align' => "center",
				'plsbvs-headline-top' => '15',
				'plsbvs-headline-left' => '60',
				'plsbvs-name-placeholder' => 'Name',
				'plsbvs-name-field-top' => '15',
				'plsbvs-name-field-left' => '90',
				'plsbvs-name-field-font' => 'Arial, Helvetica, sans-serif',
				'plsbvs-name-field-color' => "#444444",
				'plsbvs-name-field-background-color' => "#f6f6f6",
				'plsbvs-name-field-font-size' => "16",
				'plsbvs-name-field-line-height' => "16",
				'plsbvs-name-field-font-weight' => "400",
				'plsbvs-name-field-padding-top' => '5',
				'plsbvs-name-field-padding-bottom' => '5',
				'plsbvs-name-field-padding-left' => '4',
				'plsbvs-name-field-padding-right' => '4',
				'plsbvs-name-field-width' => '200px',
				'plsbvs-name-field-align' => "left",
				'plsbvs-name-field-border-radius' => "3",
				'plsbvs-email-placeholder' => 'Email',
				'plsbvs-email-field-top' => '15',
				'plsbvs-email-field-left' => '100',
				'plsbvs-email-field-font' => 'Arial, Helvetica, sans-serif',
				'plsbvs-email-field-color' => "#444444",
				'plsbvs-email-field-background-color' => "#f6f6f6",
				'plsbvs-email-field-font-size' => "16",
				'plsbvs-email-field-line-height' => "16",
				'plsbvs-email-field-font-weight' => "400",
				'plsbvs-email-field-padding-top' => '5',
				'plsbvs-email-field-padding-bottom' => '5',
				'plsbvs-email-field-padding-left' => '4',
				'plsbvs-email-field-padding-right' => '4',
				'plsbvs-email-field-width' => '200px',
				'plsbvs-email-field-align' => "left",
				'plsbvs-email-field-border-radius' => "3",
				'plsbvs-subscribe-button-text' => 'Sign up!',
				'plsbvs-subscribe-button-color' => '#00c98d',
				'plsbvs-subscribe-button-text-font' => 'Arial, Helvetica, sans-serif',
				'plsbvs-subscribe-button-text-color' => "#ffffff",
				'plsbvs-subscribe-button-text-font-size' => "16",
				'plsbvs-subscribe-button-text-font-weight' => "400",
				'plsbvs-subscribe-button-text-line-height' => "16",
				'plsbvs-subscribe-button-text-align' => "center",
				'plsbvs-subscribe-button-text-padding-top' => '6',
				'plsbvs-subscribe-button-text-padding-bottom' => '6',
				'plsbvs-subscribe-button-text-width' => '100px',
				'plsbvs-subscribe-button-text-border-radius' => "3",
				'plsbvs-subscribe-button-top' => '15',
				'plsbvs-subscribe-button-left' => '110',
				'plsbvs-overlay-color' => "#505050",
				'plsbvs-overlay-opacity' => '0.5',
				'plsbvs-overlay-color-rgba' => '80,80,80,0.5',
				'plsbvs-hide-overlay' => 'false',
				'plsbvs-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'plsbvs-content-box-position' => 'absolute',
				'plsbvs-disable-overlay-close' => 'false',
				'plsbvs-show-embedded-border' => "false",
				'plsbvs-embedded-border-css' => "",
				'plsbvs-hide-name-field' => "false",
				'plsbvs-popup-location' => 'center',
				'plsbvs-popup-vertical-selection' => 'top',
				'plsbvs-popup-horizontal-selection' => 'left',
				'plsbvs-popup-top' => '40%',
				'plsbvs-popup-left' => '50%',
				'plsbvs-popup-bottom' => '40%',
				'plsbvs-popup-right' => '50%',

				'plsbvs-width-960' => '600',
				'plsbvs-height-960' => '60',
				'plsbvs-headline-960-top' => '15',
				'plsbvs-headline-960-left' => '10',
				'plsbvs-headline-960-font-size' => '16',
				'plsbvs-headline-960-line-height' => '20',
				'plsbvs-name-field-960-top' => '15',
				'plsbvs-name-field-960-left' => '15',
				'plsbvs-name-field-960-font-size' => '14',
				'plsbvs-name-field-960-line-height' => '14',
				'plsbvs-name-field-960-padding-top' => '5',
				'plsbvs-name-field-960-padding-bottom' => '5',
				'plsbvs-name-field-960-padding-left' => '4',
				'plsbvs-name-field-960-padding-right' => '4',
				'plsbvs-name-field-960-width' => '150px',
				'plsbvs-name-field-960-border-radius' => "3",
				'plsbvs-email-field-960-top' => '15',
				'plsbvs-email-field-960-left' => '20',
				'plsbvs-email-field-960-font-size' => '14',
				'plsbvs-email-field-960-line-height' => '14',
				'plsbvs-email-field-960-padding-top' => '5',
				'plsbvs-email-field-960-padding-bottom' => '5',
				'plsbvs-email-field-960-padding-left' => '4',
				'plsbvs-email-field-960-padding-right' => '4',
				'plsbvs-email-field-960-width' => '150px',
				'plsbvs-email-field-960-border-radius' => "3",
				'plsbvs-subscribe-button-960-top' => '15',
				'plsbvs-subscribe-button-960-left' => '25',
				'plsbvs-subscribe-button-text-960-font-size' => '16',
				'plsbvs-subscribe-button-text-960-line-height' => '16',
				'plsbvs-subscribe-button-text-960-padding-top' => '6',
				'plsbvs-subscribe-button-text-960-padding-bottom' => '6',
				'plsbvs-subscribe-button-text-960-width' => '80px',
				'plsbvs-subscribe-button-text-960-border-radius' => "3",
				'plsbvs-popup-960-top' => '50%',
				'plsbvs-popup-960-left' => '50%',
				'plsbvs-popup-960-bottom' => '50%',
				'plsbvs-popup-960-right' => '50%',

				'plsbvs-width-640' => '300',
				'plsbvs-height-640' => '50',
				'plsbvs-headline-640-top' => '5',
				'plsbvs-headline-640-left' => '10',
				'plsbvs-headline-640-font-size' => '14',
				'plsbvs-headline-640-line-height' => '16',
				'plsbvs-name-field-640-top' => '8',
				'plsbvs-name-field-640-left' => '10',
				'plsbvs-name-field-640-font-size' => '10',
				'plsbvs-name-field-640-line-height' => '10',
				'plsbvs-name-field-640-padding-top' => '3',
				'plsbvs-name-field-640-padding-bottom' => '3',
				'plsbvs-name-field-640-padding-left' => '4',
				'plsbvs-name-field-640-padding-right' => '4',
				'plsbvs-name-field-640-width' => '100px',
				'plsbvs-name-field-640-border-radius' => "3",
				'plsbvs-email-field-640-top' => '8',
				'plsbvs-email-field-640-left' => '15',
				'plsbvs-email-field-640-font-size' => '10',
				'plsbvs-email-field-640-line-height' => '10',
				'plsbvs-email-field-640-padding-top' => '3',
				'plsbvs-email-field-640-padding-bottom' => '3',
				'plsbvs-email-field-640-padding-left' => '4',
				'plsbvs-email-field-640-padding-right' => '4',
				'plsbvs-email-field-640-width' => '100px',
				'plsbvs-email-field-640-border-radius' => "3",
				'plsbvs-subscribe-button-640-top' => '8',
				'plsbvs-subscribe-button-640-left' => '20',
				'plsbvs-subscribe-button-text-640-font-size' => '10',
				'plsbvs-subscribe-button-text-640-line-height' => '10',
				'plsbvs-subscribe-button-text-640-padding-top' => '3',
				'plsbvs-subscribe-button-text-640-padding-bottom' => '3',
				'plsbvs-subscribe-button-text-640-width' => '70px',
				'plsbvs-subscribe-button-text-640-border-radius' => "3",
				'plsbvs-popup-640-top' => '50%',
				'plsbvs-popup-640-left' => '50%',
				'plsbvs-popup-640-bottom' => '50%',
				'plsbvs-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
				'plsbvs-headline' => array(0, '.plsbvs-preview-headline', '#plsbvs-preview-headline'),
				'plsbvs-name-field' => array(1, '.plsbvs-preview-name', '#plsbvs-preview-name'),
				'plsbvs-email-field' => array(1, '.plsbvs-preview-email', '#plsbvs-preview-email'),
				'plsbvs-subscribe-button-text' => array(2, '.plsbvs-subscribe-button', '#plsbvs-subscribe-button'),
				'plsbvs-headline-960' => array(3, '.plsbvs-preview-headline-960'),
				'plsbvs-name-field-960' => array(4, '.plsbvs-preview-name-960'),
				'plsbvs-email-field-960' => array(4, '.plsbvs-preview-email-960'),
				'plsbvs-subscribe-button-text-960' => array(5, '.plsbvs-subscribe-button-960'),
				'plsbvs-headline-640' => array(3, '.plsbvs-preview-headline-640'),
				'plsbvs-name-field-640' => array(4, '.plsbvs-preview-name-640'),
				'plsbvs-email-field-640' => array(4, '.plsbvs-preview-email-640'),
				'plsbvs-subscribe-button-text-640' => array(5, '.plsbvs-subscribe-button-640'),
			);
			$this->style_template_checked_replace = array(
				'plsbvs-hide-name-field',
				'plsbvs-hide-overlay',
				'plsbvs-disable-overlay-close',
				'plsbvs-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
			foreach($lite_style as $id => $setting) {
				if (isset($setting['plsbvs-text-color'])) {
					$new_style[$id]['plsbvs-headline-color'] = $setting['plsbvs-text-color'];
				}
			}
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active = false);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['plsbvs-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'plsbvs-image-url');

			// disable background close trigger
			if ('true' === $style['plsbvs-disable-overlay-close']) {
				$style['plsbvs-overlay-close-trigger'] = '';
			} else {
				$style['plsbvs-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['plsbvs-show-embedded-border']) {
				$style['plsbvs-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['plsbvs-embedded-border-css'] = '';
			}

			$style['used-sign-up-form-fields'] = array();
			if (!empty($style['sign-up-form-email-field'])) {
				$style['used-sign-up-form-fields'] []= $style['sign-up-form-email-field'];
			}

			$style = PopupAllyProTemplate::process_field_hidden_status($style, 'plsbvs-hide-name-field', 'plsbvs-name-input-type', 'plsbvs-preview-hide-name', 'plsbvs-sign-up-form-name-field', 'sign-up-form-name-field');

			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'plsbvs-hide-overlay', 'plsbvs-background-overlay-css', 'plsbvs-content-box-position');

			$style['plsbvs-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['plsbvs-overlay-color'], $style['plsbvs-overlay-opacity']);
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
			$html = str_replace("{{plsbvs-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'plsbvs-popup-location'), $html);
			$html = str_replace("{{plsbvs-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'plsbvs-popup-vertical-selection'), $html);
			$html = str_replace("{{plsbvs-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'plsbvs-popup-horizontal-selection'), $html);
			return $html;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['plsbvs-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['plsbvs-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['plsbvs-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['plsbvs-popup-location'] === 'other') {
				return $style['plsbvs-popup-vertical-selection'] . ':' . $style['plsbvs-popup' . $size_postfix. '-' . $style['plsbvs-popup-vertical-selection']] . ';' .
						$style['plsbvs-popup-horizontal-selection'] . ':' . $style['plsbvs-popup' . $size_postfix. '-' . $style['plsbvs-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['plsbvs-popup-location']];
		}
	}
	PopupAllyPro::add_template(new PopupAllyProCleanTemplate());
}
