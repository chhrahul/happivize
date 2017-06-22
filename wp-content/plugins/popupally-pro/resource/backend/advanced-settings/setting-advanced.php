<?php
if (!class_exists('PopupAllyProAdvancedSettings')) {
	class PopupAllyProAdvancedSettings {
		const LITE_SETTING_KEY_ADVANCED = '_popupally_setting_advanced';
		const SETTING_KEY_ADVANCED = '_popupally_pro_setting_advanced';

		private static $default_advanced_settings = array('no-inline' => 'false', 'max-page' => '100', 'max-post' => '100', 'anti-spam' => 'true', 'use-important' => 'true',
			'disable-stats-tracking' => 'false', 'include-javascript' => 'false');

		public static function do_activation_actions() {
			delete_transient(self::SETTING_KEY_ADVANCED);

			$advanced = get_option(self::LITE_SETTING_KEY_ADVANCED);
			if (false === $advanced) {
				$advanced = self::get_advanced_settings();
			}
			// always reset the max number of page/post to 100, or the settings page might not load due to time out
			$advanced['max-page'] = '100';
			$advanced['max-post'] = '100';
			update_option(self::SETTING_KEY_ADVANCED, $advanced);
			set_transient(self::SETTING_KEY_ADVANCED, $advanced, PopupAllyPro::CACHE_PERIOD);
		}

		public static function do_deactivation_actions() {
			delete_transient(self::SETTING_KEY_ADVANCED);
		}

		public static function show_advanced_settings() {
			$advanced = PopupAllyProAdvancedSettings::get_advanced_settings();
			include (dirname(__FILE__) . '/setting-advanced-display.php');
		}

		public static function sanitize_advanced_settings($input) {
			if (!isset($input['anti-spam'])) {
				$input['anti-spam'] = 'false';
			}
			if (!isset($input['use-important'])) {
				$input['use-important'] = 'false';
			}
			$input = wp_parse_args($input, self::$default_advanced_settings);
			update_option(self::SETTING_KEY_ADVANCED, $input);
			set_transient(self::SETTING_KEY_ADVANCED, $input, PopupAllyPro::CACHE_PERIOD);
			return $input;
		}

		public static function get_advanced_settings() {
			$advanced = get_transient(self::SETTING_KEY_ADVANCED);

			if (!is_array($advanced)) {
				$advanced = get_option(self::SETTING_KEY_ADVANCED, self::$default_advanced_settings);

				set_transient(self::SETTING_KEY_ADVANCED, $advanced, PopupAllyPro::CACHE_PERIOD);
			}
			$advanced = wp_parse_args($advanced, self::$default_advanced_settings);
			return $advanced;
		}
	}
}