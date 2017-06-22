<?php
if (!class_exists('PopupAllyProTrackStatisticsSourceData')) {
	class PopupAllyProTrackStatisticsSourceData {
		const SETTING_KEY_DATA = '_popupally_pro_setting_aggregate_stats';
		private static $default_saved_stats_data = array('cutoff' => 0, 'data' => array(), 'split-test' => array());

		private static $cached_aggregated_source_data = null;

		public static function do_activation_actions() {
			try{
				self::create_database_table();
			} catch (Exception $e) {
			}
		}

		public static function initialize_defaults() {
			global $wpdb;
			$wpdb->popupallypro_stats_log = $wpdb->prefix . 'popupallypro_stats_log';
		}

		public static function create_database_table() {
			if (!function_exists('dbDelta')) {
				require_once (ABSPATH . '/wp-admin/includes/upgrade.php');
			}

			global $charset_collate, $wpdb;
			$queries = array();

			$queries[] = "CREATE TABLE $wpdb->popupallypro_stats_log (
			  log_id bigint(20) unsigned NOT NULL auto_increment,
			  date bigint(20) NOT NULL default '0',
			  popup_id varchar(100) NOT NULL default '',
			  type varchar(100) NOT NULL default '',
			  action varchar(100) NOT NULL default '',
			  split_id varchar(100) NOT NULL default '',
			  is_mobile varchar(10) NOT NULL default '',
			  PRIMARY KEY  (log_id),
			  KEY date (date),
			  KEY popup_id (popup_id),
			  KEY type (type),
			  KEY action (action),
			  KEY split_id (split_id),
			  KEY is_mobile (is_mobile)
			) $charset_collate;";

			dbDelta($queries);
		}
		public static function add_actions() {
			add_action('wp_ajax_popupallypro_track_stats', array(__CLASS__, 'track_statistics_callback'));
			add_action('wp_ajax_nopriv_popupallypro_track_stats', array(__CLASS__, 'track_statistics_callback'));

			add_action('popupally_pro_aggregate_stats', array(__CLASS__, 'aggregate_raw_data_to_database'));
			if (!wp_next_scheduled('popupally_pro_aggregate_stats')) {
				wp_schedule_event(current_time('timestamp'), 'daily', 'popupally_pro_aggregate_stats');
			}
		}
		public static function track_statistics_callback() {
			if (isset($_POST['data']) && isset($_POST['submit_nonce']) && !empty($_POST['data'])) {
				if (!wp_verify_nonce($_POST['submit_nonce'], 'popupally-pro-one-step-submit')) {
					die();
				}
				$to_add = explode('==>', $_POST['data']);
				$time = PopupAllyProSettingShared::get_today_in_days();
				foreach ($to_add as $index) {
					$parts = explode('||', $index); // $id, $type, $action, $split_id
					if (count($parts) > 4) {
						$action = $parts[2];
						$action = urldecode($action);
						self::add_raw_entry($time, $parts[0], $parts[1], $action, $parts[3], $parts[4]);
					}
				}
			}
		}
		private static function add_raw_entry($date, $id, $type, $action, $split_id, $is_mobile) {
			global $wpdb;
			$query = "INSERT INTO {$wpdb->popupallypro_stats_log} (date, popup_id, type, action, split_id, is_mobile) VALUES ($date, '$id', '$type', '$action', '$split_id', '$is_mobile')";
			$wpdb->query($query);
		}
		public static function generate_data_key($popup_id, $trigger_type, $recorded_action, $is_mobile) {
			if ($is_mobile === '1') {
				$is_mobile = 'mobile';
			} else {
				$is_mobile = 'desktop';
			}
			return "$popup_id||$trigger_type||$recorded_action||$is_mobile";
		}
		public static function convert_data_key_to_array($key) {
			return explode('||', $key);
		}
		private static function aggregate_raw_stats() {
			global $wpdb;

			$query = "SELECT COUNT(log_id) as count, date, popup_id, type, action, split_id, is_mobile FROM {$wpdb->popupallypro_stats_log} GROUP BY date, popup_id, type, action, split_id, is_mobile";

			$rows = $wpdb->get_results($query, ARRAY_A);
			$result = array();
			$split_test_result = array();
			foreach ($rows as $row) {
				$date = $row['date'];
				$popup_id = $row['popup_id'];
				$type = $row['type'];
				$action = $row['action'];
				$is_mobile = $row['is_mobile'];
				if (!isset($result[$date])) {
					$result[$date] = array();
				}
				$key = self::generate_data_key($popup_id, $type, $action, $is_mobile);

				if (isset($result[$date][$key])) {
					$result[$date][$key] += $row['count'];
				} else {
					$result[$date][$key] = $row['count'];
				}
				/* aggregate split test results */
				$split_id = $row['split_id'];
				if (strpos($split_id, 't') === 0) {
					if (!isset($split_test_result[$split_id])) {
						$split_test_result[$split_id] = array();
					}
					if (!isset($split_test_result[$split_id][$date])) {
						$split_test_result[$split_id][$date] = array();
					}

					if (isset($split_test_result[$split_id][$date][$key])) {
						$split_test_result[$split_id][$date][$key] += $row['count'];
					} else {
						$split_test_result[$split_id][$date][$key] = $row['count'];
					}
				}
			}
			return array('data' => $result, 'split-test' => $split_test_result);
		}
		public static function aggregate_raw_data_to_database() {
			$today = PopupAllyProSettingShared::get_today_in_days();
			$data = self::aggregate_source_data(true);

			global $wpdb;
			$query = "DELETE FROM {$wpdb->popupallypro_stats_log} WHERE date < $today";
			$wpdb->query($query);

			$data['cutoff'] = $today - 1;

			delete_option(self::SETTING_KEY_DATA);
			add_option(self::SETTING_KEY_DATA, $data, '', 'no');
			set_transient(self::SETTING_KEY_DATA, $data, PopupAllyPro::CACHE_PERIOD);
		}
		private static function merge_saved_and_realtime_data($database_data, $realtime_data, $cutoff_date) {
			foreach ($realtime_data as $day => $day_data) {
				if (isset($database_data[$day])) {
					if ($day > $cutoff_date) {
						$database_data[$day] = $day_data;
					} else {
						$database_day_data = &$database_data[$day];
						foreach ($day_data as $key => $value) {
							if (isset($database_day_data[$key])) {
								$database_day_data[$key] += $value;
							} else {
								$database_day_data[$key] = $value;
							}
						}
					}
				} else {
					$database_data[$day] = $day_data;
				}
			}
			return $database_data;
		}
		public static function aggregate_source_data($send_date = false) {
			if (self::$cached_aggregated_source_data === null) {
				$saved_data = self::get_stats_data();
				$raw_data = self::aggregate_raw_stats();
				$cutoff_date = $saved_data['cutoff'];
				$base_statistics = self::merge_saved_and_realtime_data($saved_data['data'], $raw_data['data'], $cutoff_date);

				$realtime_split_test_data = $raw_data['split-test'];
				$saved_split_test_data = $saved_data['split-test'];
				foreach ($realtime_split_test_data as $test_id => $test_data) {
					if (isset($saved_split_test_data[$test_id])) {
						$saved_split_test_data[$test_id] = self::merge_saved_and_realtime_data($saved_split_test_data[$test_id], $test_data, $cutoff_date);
					} else {
						$saved_split_test_data[$test_id] = $test_data;
					}
				}
				self::$cached_aggregated_source_data = array('cutoff' => $cutoff_date, 'data' => $base_statistics, 'split-test' => $saved_split_test_data);
			}

			if ($send_date) {
				return self::$cached_aggregated_source_data;
			} else {
				return self::$cached_aggregated_source_data['data'];
			}
		}
		public static function get_data_to_send() {
			$data = self::aggregate_source_data(true);
			$result = array();
			$cutoff = $data['cutoff'];
			for ($day = 0; $day < 7; ++$day) {
				if (isset($data['data'][$cutoff-$day])) {
					$result[$cutoff-$day] = $data['data'][$cutoff-$day];
				}
			}
			return $result;
		}
		public static function get_stats_data() {
			$data = get_transient(self::SETTING_KEY_DATA);

			if (!is_array($data)) {
				$data = get_option(self::SETTING_KEY_DATA, self::$default_saved_stats_data);

				set_transient(self::SETTING_KEY_DATA, $data, PopupAllyPro::CACHE_PERIOD);
			}
			if (!is_array($data)) {
				$data = self::$default_saved_stats_data;
			}
			$data = wp_parse_args($data, self::$default_saved_stats_data);

			return $data;
		}
		public static function process_export() {
			if (isset($_REQUEST['category']) && isset($_REQUEST['filter']) && isset($_REQUEST['id']) && isset($_REQUEST['export-stats-nonce']) && wp_verify_nonce($_REQUEST['export-stats-nonce'], "popupally-stats-export")) {
				$popup_id = intval($_REQUEST['id']);
				$category = $_REQUEST['category'];
				$filter = $_REQUEST['filter'];
				set_time_limit(0);
				$data = self::aggregate_source_data();
				$total_by_type = PopupAllyProTrackStatistics::aggregate_raw_data($data);

				if (isset(PopupAllyProTrackStatistics::$STATS_CATEGORIES[$category])) {
					$filename = "PopupAlly Stats - $popup_id - " . PopupAllyProTrackStatistics::$STATS_CATEGORIES[$category][1] . ".csv";
				} else {
					$filename = "PopupAlly Stats - $popup_id - $category.csv";
				}

				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="' . $filename . '"');

				if (!isset(PopupAllyProTrackStatistics::$STATS_CATEGORIES[$category])) {
					$configuration = array($category, $category, array('PopupAllyProTrackStatistics', 'calculate_simple_data'), $category);
				} else {
					$configuration = PopupAllyProTrackStatistics::$STATS_CATEGORIES[$category];
				}
				if (empty($data)) {
					echo "No data recorded.\n";
					exit;
				}
				$evaluator = $configuration[2];
				$evaluator_arguments = $configuration[3];
				$all_days = array_keys($data);
				$min_day = min($all_days);
				$max_day = max($all_days);
				$row_string = '';

				for ($i = $max_day; $i >= $min_day; --$i) {
					$row_string .= ',' . PopupAllyProSettingShared::convert_days_to_date_string($i, 'n/j/Y');
				}
				echo $row_string . "\n";
				foreach (PopupAllyProTrackStatistics::$TYPE_MAPPING as $type => $type_string) {
					$mobile_key = PopupAllyProTrackStatisticsSourceData::generate_data_key($popup_id, $type, 'view', '1');
					$desktop_key = PopupAllyProTrackStatisticsSourceData::generate_data_key($popup_id, $type, 'view', '0');
					if (isset($total_by_type[$mobile_key]) || isset($total_by_type[$desktop_key])) {
						$row_string = $type_string;
						for ($day = $max_day; $day >= $min_day; --$day) {
							if (isset($data[$day])) {
								$row_string .= ',' . call_user_func($evaluator, $evaluator_arguments, $data[$day], $popup_id, $type, $filter);
							} else {
								$row_string .= ',-';
							}
						}
						echo $row_string . "\n";
					}
				}
				
				exit;
			}
		}
	}
}