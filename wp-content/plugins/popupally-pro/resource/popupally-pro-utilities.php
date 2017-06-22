<?php
if (!class_exists('PopupAllyProUtilites')) {
	class PopupAllyProUtilites {
		public static function customize_parameter_array($source, $num) {
			$result = array();
			foreach ($source as $tag => $value) {
				$result[$tag] = str_replace('{{num}}', $num, $value);
			}
			return $result;
		}

		public static function remove_newline($str) {
			if (is_array($str)) {
				foreach($str as $key => $value) {
					$str[$key] = self::remove_newline($value);
				}
				return $str;
			}
			$str = preg_replace("/>[\r|\n|\s]*</", '><', $str);
			return $str;
		}
		public static function remove_css_newline($str) {
			if (is_array($str)) {
				foreach($str as $key => $value) {
					$str[$key] = self::remove_newline($value);
				}
				return $str;
			}
			$str = str_replace("\r", '', $str);
			$str = str_replace("\n", '', $str);
			return $str;
		}

		public static function generate_anti_spam_attribute($form_action) {
			$len = strlen($form_action);
			$first = $second = '';
			for ($i = 0; $i < $len; $i += 2) {
				$first .= $form_action[$i];
				if ($i + 1 < $len) {
					$second .= $form_action[$i + 1];
				}
			}
			return 'sejds-popupally-pro-anti-spam-uengs="' . esc_attr($first) . '" qweokgj-popupally-pro-anti-spam-mwhgser="' . esc_attr($second) . '" ';
		}

		public static function escape_html_string_literal($str) {
			$str = str_replace('&', '&amp;', $str);
			$str = str_replace('<', '&lt;', $str);
			$str = str_replace('>', '&gt;', $str);
			$str = str_replace("'", '&apos;', $str);
			$str = str_replace('"', '&quot;', $str);
			return $str;
		}
		public static function extract_array_values($source, $tags, $target) {
			foreach ($tags as $tag) {
				if (isset($source[$tag])) {
					$target[$tag] = $source[$tag];
				} else {
					$target[$tag] = '';
				}
			}
			return $target;
		}
		public static function generate_random_string($len) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randstring = '';
			for ($i = 0; $i < $len; $i++) {
				$randstring .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $randstring;
		}
		public static function clear_wp_cache() {
			// clear WPEngine cache
			if (class_exists('WpeCommon')) {
				if (method_exists('WpeCommon', 'purge_memcached')) { 
					WpeCommon::purge_memcached();
				}
				if (method_exists('WpeCommon', 'clear_maxcdn_cache')) { 
					WpeCommon::clear_maxcdn_cache();
				}
				if (method_exists('WpeCommon', 'purge_varnish_cache')) { 
					WpeCommon::purge_varnish_cache();
				}
			}
			// clear W3 Total Cache cache
			if ( function_exists( 'w3tc_flush_all' ) ) {
				w3tc_flush_all(); 
			}
			// clear WP Super Cache
			if ( function_exists( 'wp_cache_clean_cache' ) ) {
				global $file_prefix;
				wp_cache_clean_cache($file_prefix);
			}
		}
		public static function get_script_folder_dir() {
			global $wp_filesystem;
			$dir = trailingslashit($wp_filesystem->wp_content_dir());
			$dir = trailingslashit($dir . PopupAllyPro::SCRIPT_FOLDER);
			return $dir;
		}
		public static function get_script_folder_url() {
			$url = content_url(PopupAllyPro::SCRIPT_FOLDER);
			return $url;
		}
	}
}