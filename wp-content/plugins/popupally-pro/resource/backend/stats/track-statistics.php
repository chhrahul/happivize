<?php
if (!class_exists('PopupAllyProTrackStatistics')) {
	class PopupAllyProTrackStatistics {
		const DAYS_TO_SHOW = 7;
		const SETTING_KEY_STATS = '_popupally_pro_setting_stats';
		public static $TYPE_MAPPING = array(0 => 'Time-delay', 1 => 'Exit-intent', 2 => 'Scroll trigger', 3 => 'Click trigger', 'embed' => 'Embedded', 4 => 'Other triggers');
		public static $STATS_CATEGORIES = array(
												'conversion' => array('conversion', 'Conversion Rate', array(__CLASS__, 'calculate_percentage'), array('view', 'submit')),
												'view' => array('view', '# of Views', array(__CLASS__, 'calculate_simple_data'), 'view'),
												'submit' => array('submit', '# of Opt-ins', array(__CLASS__, 'calculate_simple_data'), 'submit'),
											);
		public static $STATS_FILTER = array(
												'all' => array('all', 'All visits'),
												'desktop' => array('desktop', 'Desktop only'),
												'mobile' => array('mobile', 'Mobile only'),
											);
		private static $default_stats_settings = array('select-stats-category' => 'submit', 'select-stats-filter' => 'all');
		private static $default_per_popup_stats_settings = array('is-open' => 'false');

		private static $style_settings_template_replace = array('name');

		public static function do_activation_actions() {
			delete_transient(self::SETTING_KEY_STATS);
		}

		public static function do_deactivation_actions() {
			delete_transient(self::SETTING_KEY_STATS);
		}

		public static function show_statistics() {
			$data = PopupAllyProTrackStatisticsSourceData::aggregate_source_data();
			$total_by_type = self::aggregate_raw_data($data);

			$result = self::aggregate_raw_data_by_action($total_by_type);
			$total_by_action = $result['total'];
			$actions = $result['actions'];

			$style_settings = PopupAllyProStyleSettings::get_style_settings();
			$stats_settings = self::get_stats_settings();
			$display_code = file_get_contents(dirname(__FILE__) . '/statistics-display.php');
			$individual_template = file_get_contents(dirname(__FILE__) . '/statistics-display-template.php');

			$today = PopupAllyProSettingShared::get_today_in_days();
			$date_mapping = array($today => 'Today');
			for ($i = 1; $i <= self::DAYS_TO_SHOW; ++$i) {
				$date_mapping[$today - $i] = PopupAllyProSettingShared::convert_days_to_date_string($today - $i);
			}

			$export_nonce = wp_create_nonce("popupally-stats-export");

			$display_code = str_replace("{{select-stats-category}}",
					PopupAllyProSettingShared::generate_selection_options($actions, $stats_settings['select-stats-category']), $display_code);
			$display_code = str_replace("{{select-stats-filter}}",
					PopupAllyProSettingShared::generate_selection_options(self::$STATS_FILTER, $stats_settings['select-stats-filter']), $display_code);
			foreach ($style_settings as $id => $setting) {
				if (isset($stats_settings[$id])) {
					$stats_setting = $stats_settings[$id];
				} else {
					$stats_setting = self::$default_per_popup_stats_settings;
				}
				$display_code .= self::generate_individual_popup_statistics($id, $setting, $stats_setting, $data, $total_by_type, $total_by_action, $actions, $individual_template, $date_mapping, $export_nonce);
			}
			$display_code = PopupAllyProSettingShared::replace_all_toggle($display_code, $stats_settings);
			echo $display_code;
		}
		public static function calculate_simple_data($value_arg, $source_data, $popup_id, $trigger_type, $filter_key) {
			$value = 0;
			if ($filter_key !== 'mobile') {
				$desktop_key = PopupAllyProTrackStatisticsSourceData::generate_data_key($popup_id, $trigger_type, $value_arg, '0');
				$value += isset($source_data[$desktop_key]) ? $source_data[$desktop_key] : 0;
			}
			if ($filter_key !== 'desktop') {
				$mobile_key = PopupAllyProTrackStatisticsSourceData::generate_data_key($popup_id, $trigger_type, $value_arg, '1');
				$value += isset($source_data[$mobile_key]) ? $source_data[$mobile_key] : 0;
			}
			return $value;
		}
		public static function calculate_percentage($args, $source_data, $popup_id, $trigger_type, $filter_key) {
			$denominator_arg = $args[0];
			$numerator_arg = $args[1];
			$denominator = self::calculate_simple_data($denominator_arg, $source_data, $popup_id, $trigger_type, $filter_key);
			$numerator = self::calculate_simple_data($numerator_arg, $source_data, $popup_id, $trigger_type, $filter_key);
			if ($denominator > 0) {
				return round($numerator / $denominator * 100) . '%';
			}
			return '-';
		}
		public static function generate_stats_table_block($popup_id, $stats_data, $total_by_type, $date_mapping, $filter_key, $configuration) {
			$category_value = $configuration[0];
			$evaluator = $configuration[2];
			$evaluator_arguments = $configuration[3];
			$detailed_stats = '<table class="popupally-stats-table"><tbody><tr class="popupally-stats-header-row"><th></th>';
			foreach ($date_mapping as $date_string) {
				$detailed_stats .= '<th>' . esc_attr($date_string) . '</th>';
			}
			$detailed_stats .= '<th>All time</th></tr>';
			foreach (self::$TYPE_MAPPING as $type => $type_string) {
				$mobile_key = PopupAllyProTrackStatisticsSourceData::generate_data_key($popup_id, $type, 'view', '1');
				$desktop_key = PopupAllyProTrackStatisticsSourceData::generate_data_key($popup_id, $type, 'view', '0');
				if (isset($total_by_type[$mobile_key]) || isset($total_by_type[$desktop_key])) {
					$detailed_stats .= '<tr><th scope="row" class="popupally-stats-header-column">' . esc_attr($type_string) . '</th>';
					foreach ($date_mapping as $day => $date_string) {
						if (isset($stats_data[$day])) {
							$detailed_stats .= '<td>' . call_user_func($evaluator, $evaluator_arguments, $stats_data[$day], $popup_id, $type, $filter_key) . '</td>';
						} else {
							$detailed_stats .= '<td>-</td>';
						}
					}
					$detailed_stats .= '<td>' . call_user_func($evaluator, $evaluator_arguments, $total_by_type, $popup_id, $type, $filter_key) . '</td>';
					$detailed_stats .= '</tr>';
				}
			}
			$detailed_stats .= '</tbody></table>';
			return $detailed_stats;
		}
		public static function aggregate_raw_data($raw_data) {
			$total_by_type = array();
			foreach ($raw_data as $day => $day_data) {
				foreach ($day_data as $key => $value) {
					if (isset($total_by_type[$key])) {
						$total_by_type[$key] += $value;
					} else {
						$total_by_type[$key] = $value;
					}
				}
			}
			return $total_by_type;
		}
		public static function aggregate_raw_data_by_action($total_by_type) {
			$total_by_action = array();
			$actions = array();
			foreach (self::$STATS_CATEGORIES as $configuration_key => $configuration) {
				$actions[$configuration_key] = $configuration;
			}
			foreach ($total_by_type as $key => $value) {
				$key_array = PopupAllyProTrackStatisticsSourceData::convert_data_key_to_array($key);
				$new_key = $key_array[0] . '||' . $key_array[2];
				if (isset($total_by_action[$new_key])) {
					$total_by_action[$new_key] += $value;
				} else {
					if (!isset($actions[$key_array[2]])) {
						$actions[$key_array[2]] = array($key_array[2], $key_array[2], array(__CLASS__, 'calculate_simple_data'), $key_array[2]);
					}
					$total_by_action[$new_key] = $value;
				}
			}
			return array('total' => $total_by_action, 'actions' => $actions);
		}
		private static function generate_individual_popup_statistics($id, $style, $stats_setting, $stats_data, $total_by_type, $total_by_action, $actions, $template, $date_mapping, $export_nonce) {
			foreach(self::$style_settings_template_replace as $replace) {
				$template = str_replace("{{{$replace}}}", esc_attr($style[$replace]), $template);
			}
			$template = str_replace("{{selected_item_opened}}", $stats_setting['is-open'] === 'true'?'popupally-item-opened':'', $template);
			$template = str_replace("{{selected_item_checked}}", $stats_setting['is-open'] === 'true'?'checked="checked"':'', $template);

			$detailed_stats = '';
			foreach (self::$STATS_FILTER as $filter_key => $filter_label) {
				$detailed_stats .= '<div hide-toggle="select-stats-filter" data-dependency="select-stats-filter" data-dependency-value="' . $filter_key . '">';
				foreach ($actions as $configuration) {
					$category_value = $configuration[0];
					$detailed_stats .= '<div hide-toggle="select-stats-category" data-dependency="select-stats-category" data-dependency-value="' . esc_attr($category_value) . '">';
					$detailed_stats .= self::generate_stats_table_block($id, $stats_data, $total_by_type, $date_mapping, $filter_key, $configuration);

					$nonce_download_url = add_query_arg(array('export-stats-nonce' => $export_nonce,
															'id' => $id,
															'category' => $category_value,
															'filter' => $filter_key,
														), admin_url('admin.php'));
					$detailed_stats .= '<a href="' . esc_url($nonce_download_url) . '" target="_blank">Download data as a CSV file</a></div>';
				}
				$detailed_stats .= '</div>';
			}

			$template = str_replace("{{detailed-stats}}", $detailed_stats, $template);
			$total_submit = isset($total_by_action[$id . '||submit']) ? $total_by_action[$id . '||submit'] : 0;
			$total_view = isset($total_by_action[$id . '||view']) ? $total_by_action[$id . '||view'] : 0;
			$template = str_replace("{{overall-percentage}}", $total_view > 0 ? round($total_submit / $total_view * 100) . '%' : '-', $template);

			$template = str_replace("{{id}}", $id, $template);
			return $template;
		}
		public static function sanitize_stats_settings($input) {
			$input = PopupAllyProSettingShared::safe_merge_default_values($input, self::$default_stats_settings);
			update_option(self::SETTING_KEY_STATS, $input);
			set_transient(self::SETTING_KEY_STATS, $input, PopupAllyPro::CACHE_PERIOD);
			return $input;
		}
		public static function get_stats_settings() {
			$stats_settings = get_transient(self::SETTING_KEY_STATS);

			if (!is_array($stats_settings)) {
				$stats_settings = get_option(self::SETTING_KEY_STATS, self::$default_stats_settings);

				set_transient(self::SETTING_KEY_STATS, $stats_settings, PopupAllyPro::CACHE_PERIOD);
			}
			if (!is_array($stats_settings)) {
				$stats_settings = self::$default_stats_settings;
			}
			$stats_settings = PopupAllyProSettingShared::safe_merge_default_values($stats_settings, self::$default_stats_settings);
			foreach($stats_settings as $id => $setting) {
				if (is_int($id)) {
					$stats_settings[$id] = wp_parse_args($setting, self::$default_per_popup_stats_settings);
				}
			}

			return $stats_settings;
		}
	}
}