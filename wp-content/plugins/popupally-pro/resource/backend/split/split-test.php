<?php
if (!class_exists('PopupAllyProSplitTest')) {
	class PopupAllyProSplitTest {
		const SETTING_KEY_SPLIT_TEST = '_popupally_pro_setting_split_test';
		const SETTING_KEY_SPLIT_TEST_ACTIVE = '_popupally_pro_setting_split_test_active';
		private static $default_row_settings = array(0 => 'control', 1 => 'Control', 'popup-id' => '', 'weight' => '100', 'target' => 'conversion', );
		private static $default_split_test_settings = null;
		private static $default_settings = null;
		private static $split_test_settings_template_replace = array('name');

		public static function do_activation_actions() {
			delete_transient(self::SETTING_KEY_SPLIT_TEST);
			delete_transient(self::SETTING_KEY_SPLIT_TEST_ACTIVE);
		}

		public static function do_deactivation_actions() {
			delete_transient(self::SETTING_KEY_SPLIT_TEST);
			delete_transient(self::SETTING_KEY_SPLIT_TEST_ACTIVE);
		}
		public static function initialize_defaults() {
			self::$default_split_test_settings = array('name' => 'Split Test {{id}}', 'is-open' => 'false', 'select-state' => 'stopped',
				'variate' => array(0 => self::$default_row_settings), 'select-design-to-show' => 'control',
				'select-category-to-show' => 'conversion', 'select-filter-to-show' => 'all');
			self::$default_settings = array('max-test' => 0, 'tests' => array());
		}
		public static function show_split_test_settings() {
			$split_test_settings = self::get_split_test_settings();
			$style_settings = PopupAllyProStyleSettings::get_style_settings();
			$display_code = file_get_contents(dirname(__FILE__) . '/split-test-display.php');
			$individual_test_template = file_get_contents(dirname(__FILE__) . '/split-test-display-template.php');
			$individual_test_row_template = file_get_contents(dirname(__FILE__) . '/split-test-display-row-template.php');
			$individual_test_overall_result_row_template = file_get_contents(dirname(__FILE__) . '/split-test-display-overall-result-row-template.php');

			$stats_data = PopupAllyProTrackStatisticsSourceData::aggregate_source_data(true);
			$split_test_stats = $stats_data['split-test'];

			$today = PopupAllyProSettingShared::get_today_in_days();
			$date_mapping = array($today => 'Today');
			for ($i = 1; $i <= PopupAllyProTrackStatistics::DAYS_TO_SHOW; ++$i) {
				$date_mapping[$today - $i] = PopupAllyProSettingShared::convert_days_to_date_string($today - $i);
			}

			$export_nonce = wp_create_nonce("popupally-split-test-export");

			$test_code = '';
			$max_id = $split_test_settings['max-test'];
			foreach ($split_test_settings['tests'] as $id => $setting) {
				$stats_index = 't' . $id;
				if (!isset($split_test_stats[$stats_index])) {
					$split_test_stats[$stats_index] = array();
				}
				$test_code .= self::generate_individual_split_test($id, $style_settings, $setting, $individual_test_template,
						$individual_test_row_template, $individual_test_overall_result_row_template,
						$split_test_stats[$stats_index], $date_mapping, $export_nonce);
				$max_id = max($id, $max_id);
			}
			$display_code = str_replace('{{test-code}}', $test_code, $display_code);
			$display_code = str_replace('{{max-test}}', $max_id, $display_code);
			$display_code = str_replace('{{test-template}}', self::generate_individual_split_test('--id--', $style_settings,
					self::$default_split_test_settings, $individual_test_template, $individual_test_row_template,
					$individual_test_overall_result_row_template, array(), $date_mapping, $export_nonce), $display_code);
			
			$row_template = self::generate_individual_row('--row-id--', $style_settings, self::$default_row_settings, $individual_test_row_template);
			$row_template = str_replace('{{id}}', '--id--', $row_template);
			$display_code = str_replace('{{row-template}}', $row_template, $display_code);
			echo $display_code;
		}
		private static function generate_individual_split_test($id, $style_settings, $split_test_setting, $template,
				$row_template, $overall_result_row_template, $split_test_stats, $date_mapping, $export_nonce) {
			foreach(self::$split_test_settings_template_replace as $replace) {
				$template = str_replace("{{{$replace}}}", esc_attr($split_test_setting[$replace]), $template);
			}
			$template = str_replace("{{selected_item_opened}}", $split_test_setting['is-open'] === 'true'?'popupally-item-opened':'', $template);
			$template = str_replace("{{selected_item_checked}}", $split_test_setting['is-open'] === 'true'?'checked="checked"':'', $template);

			if ($split_test_setting['select-state'] === 'running') {
				$template = str_replace("{{select-state-running-selected}}", 'selected="selected"', $template);
				$template = str_replace("{{select-state-stopped-selected}}", '', $template);
				$template = str_replace("{{test-state}}", '<label class="popupally-split-test-running">Running</label>', $template);
			} else {
				$template = str_replace("{{select-state-stopped-selected}}", 'selected="selected"', $template);
				$template = str_replace("{{select-state-running-selected}}", '', $template);
				$template = str_replace("{{test-state}}", '<label class="popupally-split-test-stopped">Not Running</label>', $template);
			}

			$total_by_type = PopupAllyProTrackStatistics::aggregate_raw_data($split_test_stats);
			$total_by_action = PopupAllyProTrackStatistics::aggregate_raw_data_by_action($total_by_type);

			$max_id = 0;
			$row_code = '';
			$overall_result_code = '';
			$detailed_stats = '';
			foreach ($split_test_setting['variate'] as $row_id => $row_settings) {
				$row_code .= self::generate_individual_row($row_id, $style_settings, $row_settings, $row_template);
				$overall_result_code .= self::generate_individual_overall_result_row($row_id, $style_settings,
						$row_settings, $overall_result_row_template, $split_test_stats, $total_by_type, $total_by_action['total']);
				$max_id = max($row_id, $max_id);
				$popup_id = $row_settings['popup-id'];

				$detailed_stats .= '<div hide-toggle="select-design-to-show" data-dependency="split-test-{{id}}-select-design-to-show" data-dependency-value="' . esc_attr($row_settings[0]) . '">';
				foreach (PopupAllyProTrackStatistics::$STATS_FILTER as $filter_key => $filter_label) {
					$detailed_stats .= '<div hide-toggle="select-filter-to-show" data-dependency="split-test-{{id}}-select-filter-to-show" data-dependency-value="' . $filter_key . '">';
					foreach ($total_by_action['actions'] as $configuration) {
						$category_value = $configuration[0];
						$detailed_stats .= '<div hide-toggle="select-category-to-show" data-dependency="split-test-{{id}}-select-category-to-show" data-dependency-value="' . esc_attr($category_value) . '">';

						$detailed_stats .= PopupAllyProTrackStatistics::generate_stats_table_block($popup_id, $split_test_stats,
								$total_by_type, $date_mapping, $filter_key, $configuration, $export_nonce);
						$nonce_download_url = add_query_arg(array('export-split-test-nonce' => $export_nonce,
																'test-id' => $id,
																'popup-id' => $popup_id,
																'category' => $category_value,
																'filter' => $filter_key,
															), admin_url('admin.php'));
						$detailed_stats .= '<a href="' . esc_url($nonce_download_url) . '" target="_blank">Download data as a CSV file</a></div>';
					}
					$detailed_stats .= '</div>';
				}
				$detailed_stats .= '</div>';
			}

			$template = str_replace("{{detailed-stats}}", $detailed_stats, $template);
			
			$template = str_replace("{{detailed-split-test}}", $row_code, $template);
			$template = str_replace("{{overall-result}}", $overall_result_code, $template);
			if (empty($split_test_stats)) {
				$template = str_replace('{{results-not-available-show}}', '', $template);
				$template = str_replace('{{results-available-show}}', 'style="display:none;"', $template);
			} else {
				$template = str_replace('{{results-available-show}}', '', $template);
				$template = str_replace('{{results-not-available-show}}', 'style="display:none;"', $template);
			}
			$template = str_replace("{{max-variate}}", $max_id, $template);

			
			$template = str_replace("{{select-design-to-show}}",
					PopupAllyProSettingShared::generate_selection_options($split_test_setting['variate'],
							$split_test_setting['select-design-to-show']), $template);
			$template = str_replace("{{select-category-to-show}}",
					PopupAllyProSettingShared::generate_selection_options($total_by_action['actions'],
							$split_test_setting['select-category-to-show']), $template);
			$template = str_replace("{{select-filter-to-show}}",
					PopupAllyProSettingShared::generate_selection_options(PopupAllyProTrackStatistics::$STATS_FILTER,
							$split_test_setting['select-filter-to-show']), $template);

			$template = PopupAllyProSettingShared::replace_all_toggle($template, $split_test_setting);
			$template = str_replace("{{id}}", $id, $template);
			return $template;
		}
		private static function generate_popup_selection($style_settings, $selected_value) {
			$code = '';
			foreach ($style_settings as $popup_id => $style_setting) {
				$code .= '<option value="' . esc_attr($popup_id) . '" ' . selected($selected_value, $popup_id, false) . '>' . esc_attr($popup_id . '. ' . $style_setting['name']) . '</option>';
			}
			return $code;
		}
		private static function generate_individual_row($row_id, $style_settings, $row_settings, $row_template) {
			if ($row_id === 0) {
				$name = 'Control';
				$variable = 'control';
				$delete_code = '';
			} else {
				$name = 'Variate ' . $row_id;
				$variable = 'variate-' . $row_id;
				$delete_code = '<div class="popupally-fluid-css-delete" popupally-delete-split-test-row="#popupally-split-test-row-{{id}}-{{row-id}}" popupally-delete-warning="Deleting this variate will remove the test data and it cannot be undone. Continue?">x</div>';
			}
			$row_template = str_replace('{{delete-code}}', $delete_code, $row_template);
			$row_template = str_replace('{{name}}', $name, $row_template);
			$row_template = str_replace('{{popup-selection}}', self::generate_popup_selection($style_settings, $row_settings['popup-id']), $row_template);
			$row_template = str_replace('{{weight}}', $row_settings['weight'], $row_template);
			$row_template = str_replace("{{row-id}}", $row_id, $row_template);
			return $row_template;
		}
		private static function generate_target_action_selection($target_action_options, $selected_value) {
			$code = '';
			foreach ($target_action_options as $key => $option) {
				$code .= '<option value="' . esc_attr($key) . '" ' . selected($selected_value, $key, false) . '>' . esc_html($option[1]) . '</option>';
			}
			return $code;
		}
		private static function generate_result_rates($target_action_options, $selected_value, $total_by_action, $popup_id) {
			$code = '';
			if (!empty($target_action_options)) {
				if (!isset($target_action_options[$selected_value])) {
					$keys = array_keys($target_action_options);
					$selected_value = $keys[0];
				}
			}
			$total_view = isset($total_by_action[$popup_id . '||view']) ? $total_by_action[$popup_id . '||view'] : 0;
			foreach ($target_action_options as $key => $option) {
				$visibility_code = 'style="display:none;"';
				if ($selected_value === $key) {
					$visibility_code = '';
				}
				if ($total_view > 0) {
					if ($key === 'conversion') {
						$stats_key = 'submit';
					} else {
						$stats_key = $key;
					}
					$total_action = isset($total_by_action[$popup_id . '||' . $stats_key]) ? $total_by_action[$popup_id . '||' . $stats_key] : 0;
					$rate = round($total_action / $total_view * 100) . '%';
				} else {
					$rate = '-';
				}
				$code .= '<span hide-toggle data-dependency="popupally-split-test-{{id}}-{{row-id}}-target" data-dependency-value="' . esc_attr($key) .
						'" ' . $visibility_code . '>' . $rate . '</span>';
			}
			return $code;
		}
		private static function generate_individual_overall_result_row($row_id, $style_settings, $row_settings, $row_template, $split_test_stats, $total_by_type, $total_by_action) {
			if ($row_id === 0) {
				$name = 'Control';
			} else {
				$name = 'Variate ' . $row_id;
			}
			$popup_id = $row_settings['popup-id'];
			if (!isset($style_settings[$popup_id])) {
				$name .=  ' - Popup removed';
				$row_template = str_replace('{{name}}', esc_html($name), $row_template);
				$row_template = str_replace('{{num-views}}', '', $row_template);
				$row_template = str_replace('{{target-selection}}', '', $row_template);
				$row_template = str_replace('{{result-rates}}', '', $row_template);
				$row_template = str_replace("{{row-id}}", $row_id, $row_template);
			} else {
				$style_setting = $style_settings[$popup_id];
				$row_template = str_replace('{{name}}', esc_html($name), $row_template);
				$row_template = str_replace('{{num-views}}', isset($total_by_action[$popup_id . '||view']) ? $total_by_action[$popup_id . '||view'] : 0, $row_template);

				$selected_template_obj = PopupAllyPro::get_template($style_setting['selected-template']);
				$target_action_options = $selected_template_obj->get_action_target_options($style_setting);
				$row_template = str_replace('{{target-selection}}',
						self::generate_target_action_selection($target_action_options, $row_settings['target']),
						$row_template);
				$row_template = str_replace('{{result-rates}}', self::generate_result_rates($target_action_options,
						$row_settings['target'], $total_by_action, $popup_id), $row_template);
				$row_template = str_replace("{{row-id}}", $row_id, $row_template);
			}
			return $row_template;
		}
		private static function sanitize_settings($split_test_settings) {
			$split_test_settings = wp_parse_args($split_test_settings, self::$default_settings);
			$filtered_settings = array();
			foreach($split_test_settings['tests'] as $id => $setting) {
				if (is_int($id)) {
					foreach ($setting['variate'] as $row_id => $variate) {
						$setting['variate'][$row_id] = wp_parse_args($variate, self::$default_row_settings);
						if ($row_id === 0) {
							$setting['variate'][$row_id][0] = 'control';
							$setting['variate'][$row_id][1] = 'Control';
						} else {
							$setting['variate'][$row_id][0] = 'variate-' . $row_id;
							$setting['variate'][$row_id][1] = 'Variate ' . $row_id;
						}
						$setting['variate'][$row_id]['weight'] = max(0, intval($variate['weight']));
					}
					$filtered_settings[$id] = wp_parse_args($setting, self::$default_split_test_settings);
				}
			}
			$split_test_settings['tests'] = $filtered_settings;

			return $split_test_settings;
		}
		private static function verify_split_test_settings($input) {
			$control_popups = array();
			foreach($input['tests'] as $test_id => $split_test) {
				if (is_int($test_id)) {
					if ($split_test['select-state'] === 'running') {
						$used_popups = array();
						$total_weight = 0;
						foreach ($split_test['variate'] as $ordinal => $row_setting) {
							if ($ordinal === 0) {
								if (isset($control_popups[$row_setting['popup-id']])) {
									$input['tests'][$test_id]['select-state'] = 'stopped';
									add_settings_error('popupally_pro_settings', 'split-test-state-' . $test_id, 'Split test ' . $test_id .
											' error: the control popup cannot be the same as another active split test. The split test is stopped.', 'error');
									break;
								}
								$control_popups[$row_setting['popup-id']] = $test_id;
							}
							if (isset($used_popups[$row_setting['popup-id']])) {
								$input['tests'][$test_id]['select-state'] = 'stopped';
								add_settings_error('popupally_pro_settings', 'split-test-state-' . $test_id, 'Split test ' . $test_id .
										' error: duplicate popup is used as the control/variate. The split test is stopped.', 'error');
								break;
							}
							$used_popups[$row_setting['popup-id']] = $ordinal;
							$total_weight += $row_setting['weight'];
						}
					}
					if ($input['tests'][$test_id]['select-state'] === 'running') {
						if ($total_weight !== 100) {
							if ($total_weight <= 0) {
								$average = floor(100 / count($split_test['variate']));
								foreach ($split_test['variate'] as $ordinal => $row_setting) {
									if ($ordinal > 0) {
										$input['tests'][$test_id]['variate'][$ordinal]['weight'] = $average;
									}
								}
								$input['tests'][$test_id]['variate'][0]['weight'] = 100 - $average * (count($split_test['variate']) - 1);
							} else {
								$leftover = 100;
								foreach ($split_test['variate'] as $ordinal => $row_setting) {
									if ($ordinal > 0) {
										$normalized_weight = floor($row_setting['weight'] / $total_weight * 100);
										$input['tests'][$test_id]['variate'][$ordinal]['weight'] = $normalized_weight;
										$leftover -= $normalized_weight;
									}
								}
								$input['tests'][$test_id]['variate'][0]['weight'] = $leftover;
							}
							add_settings_error('popupally_pro_settings', 'split-test-weight-' . $test_id, 'Split test ' . $test_id .
									' error: the weights do not add up to 100. The weights have been normalized to sum to 100.', 'error');
						}
					}
				}
			}
			return $input;
		}
		public static function sanitize_split_test_settings($input) {
			$input = self::sanitize_settings($input);
			$input = self::verify_split_test_settings($input);
			update_option(self::SETTING_KEY_SPLIT_TEST, $input);
			set_transient(self::SETTING_KEY_SPLIT_TEST, $input, PopupAllyPro::CACHE_PERIOD);

			$active_settings = self::generate_active_split_test_settings($input);
			update_option(self::SETTING_KEY_SPLIT_TEST_ACTIVE, $active_settings);
			set_transient(self::SETTING_KEY_SPLIT_TEST_ACTIVE, $active_settings, PopupAllyPro::CACHE_PERIOD);
			return $input;
		}
		public static function get_split_test_settings() {
			$split_test_settings = get_transient(self::SETTING_KEY_SPLIT_TEST);

			if (!is_array($split_test_settings)) {
				$split_test_settings = get_option(self::SETTING_KEY_SPLIT_TEST, self::$default_settings);

				set_transient(self::SETTING_KEY_SPLIT_TEST, $split_test_settings, PopupAllyPro::CACHE_PERIOD);
			}
			return self::sanitize_settings($split_test_settings);
		}
		public static function get_active_split_test_settings() {
			$active_settings = get_transient(self::SETTING_KEY_SPLIT_TEST_ACTIVE);

			if (!is_array($active_settings)) {
				$active_settings = get_option(self::SETTING_KEY_SPLIT_TEST_ACTIVE, false);

				if (!is_array($active_settings)) {
					$active_settings = self::generate_active_split_test_settings(self::get_split_test_settings());
					update_option(self::SETTING_KEY_SPLIT_TEST_ACTIVE, $active_settings);
				}
				set_transient(self::SETTING_KEY_SPLIT_TEST_ACTIVE, $active_settings, PopupAllyPro::CACHE_PERIOD);
			}
			return $active_settings;
		}
		private static function generate_active_split_test_settings($split_test_settings) {
			$active = array();
			$variates = array();
			foreach ($split_test_settings['tests'] as $test_id => $split_test) {
				if ($split_test['select-state'] === 'running') {
					if (isset($split_test['variate'][0])) {
						$control_popup_id = $split_test['variate'][0]['popup-id'];
						if (!isset($active[$control_popup_id])) {
							$active[$control_popup_id] = array('test_id' => $test_id, 'weights' => array());
							foreach ($split_test['variate'] as $ordinal => $row_setting) {
								$active[$control_popup_id]['weights'][$row_setting['popup-id']] = $row_setting['weight'];
								if ($ordinal > 0) {
									$variates[$row_setting['popup-id']] = $test_id;
								}
							}
						}
					}
				}
			}
			$result = array('active' => $active, 'variates' => $variates);
			return $result;
		}
		public static function process_export() {
			if (isset($_REQUEST['test-id']) && isset($_REQUEST['category']) && isset($_REQUEST['filter']) && isset($_REQUEST['popup-id']) && isset($_REQUEST['export-split-test-nonce']) && wp_verify_nonce($_REQUEST['export-split-test-nonce'], "popupally-split-test-export")) {
				$test_id = intval($_REQUEST['test-id']);
				$popup_id = intval($_REQUEST['popup-id']);
				$category = $_REQUEST['category'];
				$filter = $_REQUEST['filter'];
				set_time_limit(0);
				$raw_data = PopupAllyProTrackStatisticsSourceData::aggregate_source_data(true);
				$split_test_data = $raw_data['split-test'];
				if (!isset($split_test_data['t' . $test_id])) {
					$data = array();
				} else {
					$data = $split_test_data['t' . $test_id];
				}
				$total_by_type = PopupAllyProTrackStatistics::aggregate_raw_data($data);

				if (isset(PopupAllyProTrackStatistics::$STATS_CATEGORIES[$category])) {
					$filename = "PopupAlly Split Test $test_id Stats - Popup $popup_id - " . PopupAllyProTrackStatistics::$STATS_CATEGORIES[$category][1] . ".csv";
				} else {
					$filename = "PopupAlly Split Test $test_id Stats - Popup $popup_id - $category.csv";
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