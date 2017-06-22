<?php
if (!class_exists('PopupAllyProEmbedShortcode')) {
	class PopupAllyProEmbedShortcode {
		public static function add_shortcodes() {
			add_shortcode('embed_popupally_pro', array(__CLASS__, 'shortcode_embed_popupally_pro'));
		}
		private static $shortcode_ordinal = 0;
		public static function shortcode_embed_popupally_pro($atts, $content = null) {
			extract( shortcode_atts( array(
				'popup_id' => '0',
			), $atts ) );
			$to_show = PopupAllyPro::get_popup_to_show();
			if (isset($to_show[$popup_id])) {
				$display = PopupAllyProDisplaySettings::get_display_settings();
				if (in_array('embedded', $to_show[$popup_id]) && $display[$popup_id]['embedded-location'] === 'shortcode') {
					$code = PopupAllyPro::get_popup_code();
					if (isset($code[$popup_id])) {
						$embed_code = $code[$popup_id]['embedded_html'];
						$embed_code = do_shortcode($embed_code);
						if ($display[$popup_id]['select-signup-type-embed'] === 'embed-code') {
							self::$shortcode_ordinal += 1;
							$variable_name = 'pap_custom_code_' . self::$shortcode_ordinal . PopupAllyProUtilites::generate_random_string(4);
							$embed_code = str_replace('role-placeholder-kjdshe', 'popupally-pro-custom-code="' . $variable_name . '"', $embed_code);

							if (empty($content)) {
								$content = '';
							}
							if (strpos($content, '<br />') === 0) {
								$content = substr($content, strlen('<br />'));
							}
							if (strrpos($content, '<br />') === (strlen($content) - strlen('<br />') - 1)) {
								$content = substr($content, 0, strrpos($content, '<br />'));
							}
							$content = do_shortcode($content);
							$js_code = '<script type="text/javascript">' . $variable_name . '=' . PopupAllyProSettingShared::dump_variable_to_javascript_array($content) . ';</script>';
							$embed_code .= $js_code;
						}
						return $embed_code;
					}
				}
			}
			return false;
		}
	}
}