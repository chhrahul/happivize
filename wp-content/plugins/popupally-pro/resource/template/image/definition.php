<?php
if (!class_exists('PopupAllyProImageTemplate')) {
	class PopupAllyProImageTemplate extends PopupAllyProTemplate {
		const IMAGE_LINK_TYPE_TEMPLATE = '<option value="none" s--none--d>None</option><option value="same" s--same--d>Open link in the same tab</option><option value="new" s--new--d>Open link in a new tab</option>';
		public function __construct() {
			parent::__construct();
			$this->uid = 'lquydg';
			$this->template_name = 'Just Image';
			$this->template_order = 10;

			$this->backend_php = dirname(__FILE__) . '/backend/image-pro-preview.php';
			$this->style_hide_signup_fields = array('form'=>true, 'name'=>true, 'lname'=>true, 'email'=>true);

			// 0: front end html, 1: front end embedded, 2: backend preview
			$this->popup_html_template_files = array(
				0 => dirname(__FILE__) . '/frontend/image-pro-popup.php',
				1 => dirname(__FILE__) . '/frontend/image-pro-embedded.php',
				2 => dirname(__FILE__) . '/backend/image-pro-preview-template.php',
				3 => dirname(__FILE__) . '/backend/image-pro-960-preview-template.php',
				4 => dirname(__FILE__) . '/backend/image-pro-640-preview-template.php',
			);
			// 0: front end; 1: backend, 2: front end top margin
			$this->popup_css_template_files = array(
				0 => dirname(__FILE__) . '/frontend/image-pro-popup.css',
				1 => dirname(__FILE__) . '/backend/image-pro-preview-popup.css',
				2 => dirname(__FILE__) . '/frontend/image-pro-popup-top-margin.css',
			);

			$this->html_mapping = array('lquydg-overlay-close-trigger');
			$this->no_escape_html_mapping = array('lquydg-image-link-html');
			$this->default_values = array(
				'lquydg-background-color' => '#45ae7a',
				'lquydg-background-image-url' => '',
				'lquydg-background-image' => 'none',
				'lquydg-width' => '840',
				'lquydg-height' => '540',
				'lquydg-image-1' => 'none',
				'lquydg-image-1-url' => PopupAllyPro::$PLUGIN_URI . 'resource/img/screenshot.png',
				'lquydg-image-1-width' => '800',
				'lquydg-image-1-height' => '500',
				'lquydg-image-1-margin-top' => '20',
				'lquydg-image-1-margin-bottom' => '20',
				'lquydg-image-link-type' => 'none',
				'lquydg-image-link-url' => '',
				'lquydg-image-link-html' => '',
				'lquydg-overlay-color' => "#505050",
				'lquydg-overlay-opacity' => '0.5',
				'lquydg-overlay-color-rgba' => '80,80,80,0.5',
				'lquydg-hide-overlay' => 'false',
				'lquydg-background-overlay-css' => PopupAllyProTemplate::POPUP_BACKGROUND_CSS,
				'lquydg-content-box-position' => 'absolute',
				'lquydg-disable-overlay-close' => 'false',
				'lquydg-show-embedded-border' => "false",
				'lquydg-embedded-border-css' => "",
				'lquydg-popup-location' => 'center',
				'lquydg-popup-vertical-selection' => 'top',
				'lquydg-popup-horizontal-selection' => 'left',
				'lquydg-popup-top' => '50%',
				'lquydg-popup-left' => '50%',
				'lquydg-popup-bottom' => '50%',
				'lquydg-popup-right' => '50%',

				'lquydg-width-960' => '640',
				'lquydg-height-960' => '415',
				'lquydg-image-1-960-width' => '600',
				'lquydg-image-1-960-height' => '375',
				'lquydg-image-1-960-margin-top' => '20',
				'lquydg-image-1-960-margin-bottom' => '20',
				'lquydg-popup-960-top' => '50%',
				'lquydg-popup-960-left' => '50%',
				'lquydg-popup-960-bottom' => '50%',
				'lquydg-popup-960-right' => '50%',

				'lquydg-width-640' => '300',
				'lquydg-height-640' => '193',
				'lquydg-image-1-640-width' => '280',
				'lquydg-image-1-640-height' => '175',
				'lquydg-image-1-640-margin-top' => '10',
				'lquydg-image-1-640-margin-bottom' => '10',
				'lquydg-popup-640-top' => '50%',
				'lquydg-popup-640-left' => '50%',
				'lquydg-popup-640-bottom' => '50%',
				'lquydg-popup-640-right' => '50%',
			);
			$this->style_template_advanced_customization = array(
			);
			$this->style_template_checked_replace = array(
				'lquydg-hide-overlay',
				'lquydg-disable-overlay-close',
				'lquydg-show-embedded-border',
			);
		}

		public function do_activation_actions(&$new_style, &$lite_style) {
		}

		public function sanitize_style($setting, $id, $is_active = false) {
			$setting = parent::sanitize_style($setting, $id, $is_active);

			return $setting;
		}

		public function prepare_for_code_generation($id, $style, $all_style) {
			$style = parent::prepare_for_code_generation($id, $style, $all_style);
			$style['lquydg-background-image'] = PopupAllyProTemplate::image_url_code_generation($style, 'lquydg-background-image-url');
			$style['lquydg-image-1'] = PopupAllyProTemplate::image_url_code_generation($style, 'lquydg-image-1-url');

			// disable background close trigger
			if ('true' === $style['lquydg-disable-overlay-close']) {
				$style['lquydg-overlay-close-trigger'] = '';
			} else {
				$style['lquydg-overlay-close-trigger'] = ' popup-click-close-trigger-' . $id;
			}
			if ('true' === $style['lquydg-show-embedded-border']) {
				$style['lquydg-embedded-border-css'] = PopupAllyProTemplate::POPUP_BOX_EMBEDDED_SHADOW_CSS;
			} else {
				$style['lquydg-embedded-border-css'] = '';
			}
			
			$style['used-sign-up-form-fields'] = array();

			if ('same' === $style['lquydg-image-link-type']) {
				$style['lquydg-image-link-html'] = '<div class="lquydg-image-link" svvuyx-redirect-url="' . esc_attr($style['lquydg-image-link-url']) . '" svvuyx-redirect-action="same" ijdh-popupally-pro-track-cnewh="Image"></div>';
			} elseif ('new' === $style['lquydg-image-link-type']) {
				$style['lquydg-image-link-html'] = '<div class="lquydg-image-link" svvuyx-redirect-url="' . esc_attr($style['lquydg-image-link-url']) . '" svvuyx-redirect-action="new" ijdh-popupally-pro-track-cnewh="Image"></div>';
			} else {
				$style['lquydg-image-link-html'] = '';
			}
			$style = PopupAllyProTemplate::process_hide_background_overlay($style, 'lquydg-hide-overlay', 'lquydg-background-overlay-css', 'lquydg-content-box-position');
			$style['lquydg-overlay-color-rgba'] = PopupAllyProTemplate::hex_to_rgb($style['lquydg-overlay-color'], $style['lquydg-overlay-opacity']);
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

			$link_type_selection = self::IMAGE_LINK_TYPE_TEMPLATE;
			$link_type_selection = str_replace('s--'.$setting['lquydg-image-link-type'].'--d', 'selected="selected"', $link_type_selection);
			$link_type_selection = preg_replace('/s--.*?--d/', '', $link_type_selection);
			$html = str_replace('{{lquydg-image-link-type-selection}}', $link_type_selection, $html);

			// the order is important, as style_template_checked_replace is a subset of default_values
			foreach($this->style_template_checked_replace as $param) {
				$html = str_replace("{{{$param}}}", 'true' === $setting[$param] ? 'checked="checked"' : '', $html);
			}
			foreach($this->default_values as $param  => $default_value) {
				$html = str_replace("{{{$param}}}", PopupAllyProUtilites::escape_html_string_literal($setting[$param]), $html);
			}
			$html = str_replace("{{lquydg-location-selection}}", PopupAllyProTemplate::generate_popup_location_selection($setting, 'lquydg-popup-location'), $html);
			$html = str_replace("{{lquydg-location-vertical-selection}}", PopupAllyProTemplate::generate_vertical_selection_code($setting, 'lquydg-popup-vertical-selection'), $html);
			$html = str_replace("{{lquydg-location-horizontal-selection}}", PopupAllyProTemplate::generate_horizontal_selection_code($setting, 'lquydg-popup-horizontal-selection'), $html);
			return $html;
		}
		/* $size_postfix: '' - normal display; '-960' - 960px width; '-640' - 640px width */
		public function generate_position_code($style, $size_postfix) {
			if ($style['lquydg-popup-location'] === 'center') {
				return 'top:50%;left:50%;margin-top:-' . (intval($style['lquydg-height' . $size_postfix]) / 2) .
						'px;margin-left:-' . (intval($style['lquydg-width' . $size_postfix]) / 2) . 'px;';
			} elseif ($style['lquydg-popup-location'] === 'other') {
				return $style['lquydg-popup-vertical-selection'] . ':' . $style['lquydg-popup' . $size_postfix. '-' . $style['lquydg-popup-vertical-selection']] . ';' .
						$style['lquydg-popup-horizontal-selection'] . ':' . $style['lquydg-popup' . $size_postfix. '-' . $style['lquydg-popup-horizontal-selection']] . ';';
				
			}
			return PopupAllyProTemplate::$popup_location_css_template[$style['lquydg-popup-location']];
		}
		public function get_action_target_options($style) {
			if ('same' === $style['lquydg-image-link-type'] || 'new' === $style['lquydg-image-link-type']) {
				return array('Image clicked' => array('Image clicked', 'Image clicked', array('PopupAllyProTrackStatistics', 'calculate_percentage'), array('view', 'Image clicked')));
			}
			return array();
		}
	}
	PopupAllyPro::add_template(new PopupAllyProImageTemplate());
}
