<?php

if (!class_exists('PopupAllyProAPI')) {
	class PopupAllyProAPI {
		public static function get_popup_list() {
			$result = array();
			
			$all_settings = PopupAllyProStyleSettings::get_style_settings();
			foreach ($all_settings as $id => $setting) {
				$result[$id] = $setting['name'];
			}
			return $result;
		}
		
		public static function get_popup_code($popup_id) {
			$embed_code = '';
			$code = PopupAllyPro::get_popup_code();
			if (isset($code[$popup_id])) {
				$embed_code = $code[$popup_id]['embedded_html'];
				$embed_code = do_shortcode($embed_code);
			}
			return $embed_code;
		}
	}
}

