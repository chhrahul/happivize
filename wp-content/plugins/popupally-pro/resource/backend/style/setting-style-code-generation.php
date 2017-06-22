<?php
if (!class_exists('PopupAllyProStyleCodeGeneration')) {
	class PopupAllyProStyleCodeGeneration {
		// 0 - normal popup, 1 - embedded, 2 - preview
		public static function generate_popup_html($id, $setting, $all_style, $mode = 0, $template_obj = null) {
			if (null === $template_obj && 'true' === $setting['advanced']) {
				if (2 === $mode){
					return '';
				} elseif (1 === $mode){
					return PopupAllyProUtilites::remove_newline($setting['html-embedded']);
				} else {
					return PopupAllyProUtilites::remove_newline($setting['html']);
				}
			}
			if (null === $template_obj) {
				$template_obj = PopupAllyPro::get_template($setting['selected-template']);
				if (!$template_obj) {
					return '';
				}
			}

			return PopupAllyProUtilites::remove_newline($template_obj->generate_popup_html($id, $setting, $all_style, $mode));
		}

		// 0 - normal popup, 1 - preview, 2 - top margin
		public static function generate_popup_css($id, $setting, $all_style, $mode = 0, $template_obj = null) {
			if (isset($setting['advanced']) && 'true' === $setting['advanced']) {
				if ($mode === 2) {
					return $setting['css-top-margin'];
				}
				return $setting['css'];
			}

			if (null === $template_obj) {
				$template_obj = PopupAllyPro::get_template($setting['selected-template']);
				if (!$template_obj) {
					return '';
				}
			}
			return PopupAllyProUtilites::remove_css_newline($template_obj->generate_popup_css($id, $setting, $all_style, $mode));
		}
	}
}