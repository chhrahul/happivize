<?php
class PopupAllyProSettingShared {
	const SETTING_KEY_DATABASE_VERSION = '_popupally_pro_database_version';
	const SECOND_IN_A_DAY = 86400;
	public static $available_fonts = array(
		'Georgia, serif' => 'Georgia, serif',
		'"Palatino Linotype", "Book Antiqua", Palatino, serif' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
		'"Times New Roman", Times, serif' => '"Times New Roman", Times, serif',
		'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
		'"Arial Black", Gadget, sans-serif' => '"Arial Black", Gadget, sans-serif',
		'"Comic Sans MS", cursive, sans-serif' => '"Comic Sans MS", cursive, sans-serif',
		'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
		'"Trebuchet MS", Helvetica, sans-serif' => '"Trebuchet MS", Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif',
		'"Courier New", Courier, monospace' => '"Courier New", Courier, monospace',
		'"Lucida Console", Monaco, monospace' => '"Lucida Console", Monaco, monospace',
	);
	public static $available_font_weights = array('100' => '100', '200' => '200', '300' => '300', '400' => 'Normal', '500' => '500', '600' => '600', '700' => 'Bold', '800' => '800', '900' => '900');
	public static $available_alignments = array('left' => 'Left', 'center' => 'Center', 'right' => 'Right');
	public static $available_border_style = array('none' => 'None', 'dotted' => 'Dotted', 'dashed' => 'Dashed', 'solid' => 'Solid', 'double' => 'Double-line', 'groove' => '3D grooved', 'ridge' => '3D ridged', 'inset' => '3D inset', 'outset' => '3D outset');
	public static $available_box_shadows = array('0 5px 10px rgba(0,0,0,0.5)' => 'Default', 'none' => 'None');
	public static $available_font_style = array('normal' => 'Normal', 'italic' => 'Italic', 'oblique' => 'Oblique');
	public static $available_text_decoration = array('none' => 'None', 'underline' => 'Underline', 'overline' => 'Overline', 'line-through' => 'Line-Through');
	public static $available_white_space_style = array('normal' => 'Wrap text / merge multiple whitespaces', 'nowrap' => 'Do not wrap text / merge multiple whitespaces', 'pre-line' => 'Wrap text with line break / merge multiple whitespaces', 'pre-wrap' => 'Wrap text with line break / preserve mutliple whitespace', 'pre' => 'Do not wrap text except on line break / preserve mutliple whitespace');
	public static $available_background_size = array('auto' => 'Auto', 'cover' => 'Cover', 'contain' => 'Contain');

	private static function evaluate_toggle_variable($match_value, $variable_path, $settings) {
		$variable_path = str_replace('[', ',', $variable_path);
		$variable_path = str_replace(']', '', $variable_path);
		$args = explode(',', $variable_path);
		foreach($args as $arg) {
			if ($arg) {
				if (isset($settings[$arg])) {
					$settings = $settings[$arg];
				} else {
					return false;
				}
			}
		}
		if (esc_attr($settings) === $match_value) {
			return true;
		}
		return false;
	}

	private static function process_toggle_matches($code, $settings, $matches, $true_replace, $false_replace) {
		if (!empty($matches)) {
			$length = count($matches[1]);
			$already_replaced = array();
			for ($i=0;$i<$length;++$i){
				$to_replace = $matches[0][$i];
				if (!isset($already_replaced[$to_replace])) {
					$is_match = self::evaluate_toggle_variable($matches[4][$i], $matches[2][$i], $settings);
					if ($is_match) {
						$new_value = str_replace($matches[1][$i], $true_replace, $to_replace);
					} else {
						$new_value = str_replace($matches[1][$i], $false_replace, $to_replace);
					}

					$code = str_replace($to_replace, $new_value , $code);
					$already_replaced[$to_replace] = true;
				}
			}
		}
		return $code;
	}
	private static function replace_specific_toggle($code, $settings, $toggle_name, $true_replace, $false_replace) {
		$matches = array();
		$true_replace = $toggle_name . $true_replace;
		$false_replace = $toggle_name . $false_replace;
		preg_match_all('/(' . $toggle_name . '="(.*?)")(.*?)data-dependency-value="(.*?)"/', $code, $matches);
		$code = self::process_toggle_matches($code, $settings, $matches, $true_replace, $false_replace);

		preg_match_all('/(' . $toggle_name . '="(.*?)")(.*?)data-dependency-value-not="(.*?)"/', $code, $matches);
		$code = self::process_toggle_matches($code, $settings, $matches, $false_replace, $true_replace);
		return $code;
	}

	public static function replace_all_toggle($code, $settings) {
		$code = self::replace_specific_toggle($code, $settings, 'hide-toggle', '', ' style="display:none;"');
		$code = self::replace_specific_toggle($code, $settings, 'readonly-toggle', '', ' readonly="readonly"');

		return $code;
	}
	private static function generate_dropdown_selection_template($list, $variable_postfix, $css_property) {
		$template = '<select name="[{{id}}][{{element_name}}' . $variable_postfix . ']" popupally-change-source="{{element_name}}' . $variable_postfix . '-font-selection-{{id}}" preview-update-target-css="{{preview_element_name}}-{{id}}" preview-update-target-css-property="' . $css_property . '">';

		foreach($list as $value => $display) {
			$template .= '<option value="' . esc_attr($value). '" s--' . $value . '--d>' . esc_html($display) . '</option>';
		}
		if ('font-family' === $css_property){
			$template .= '<option value="other" s--other--d>Other</option>';
			$template .= '</select>';
			$template .= '<input name="[{{id}}][{{element_name}}' . $variable_postfix . '-other]" {{hide-other}} class="full-width" value="{{font-value}}" hide-toggle data-dependency="{{element_name}}' . $variable_postfix . '-font-selection-{{id}}" data-dependency-value="other" preview-update-target-css="{{preview_element_name}}-{{id}}" preview-update-target-css-property="' . $css_property . '"/>';
		} else {
			$template .= '</select>';
		}
		return $template;
	}

	private static $available_fonts_template = null;
	private static $available_font_weights_template = null;
	private static $available_alignments_template = null;

	public static function customize_advanced_edit_option($setting, $name, $base_template) {
		if (null === self::$available_fonts_template) {
			self::$available_fonts_template = self::generate_dropdown_selection_template(self::$available_fonts, '-font', 'font-family');
			self::$available_font_weights_template = self::generate_dropdown_selection_template(self::$available_font_weights, '-font-weight', 'font-weight');
			self::$available_alignments_template = self::generate_dropdown_selection_template(self::$available_alignments, '-align', 'text-align');
		}
		$select_name = $name . "-font";
		if (in_array($setting[$select_name], self::$available_fonts)) {
			$fonts_template = str_replace('s--' . $setting[$select_name] . '--d', 'selected="selected"', self::$available_fonts_template);
			$fonts_template = str_replace('{{hide-other}}', 'style="display:none;"', $fonts_template);
		} else {
			$fonts_template = str_replace('s--other--d', 'selected="selected"', self::$available_fonts_template);
			$fonts_template = str_replace('{{hide-other}}', '', $fonts_template);
		}
		$fonts_template = str_replace('{{font-value}}', $setting[$select_name], $fonts_template);
		$base_template = str_replace('{{font}}', $fonts_template, $base_template);

		$select_name = $name . "-font-weight";
		$font_weight_template = str_replace('s--' . $setting[$select_name] . '--d', 'selected="selected"', self::$available_font_weights_template);
		$base_template = str_replace("{{font-weight}}", $font_weight_template, $base_template);

		$select_name = $name . "-align";
		$font_weight_template = str_replace('s--' . $setting[$select_name] . '--d', 'selected="selected"', self::$available_alignments_template);
		$base_template = str_replace("{{align}}", $font_weight_template, $base_template);

		$base_template = preg_replace('/s--.*?--d/', '', $base_template);
		return $base_template;
	}

	private static function json_name_string_to_keys($name) {
		$a = array();
		$start = strpos($name, '[');
		$end = 0;
		while($start !== false) {
			$start += 1;
			$end = strpos($name, ']', $start);
			if ($end === false) {
				$end = $start;
				break;
			}
			$a []= substr($name, $start, $end - $start);
			$start = strpos($name, '[', $end);
		}
		if ($end < strlen($name)-1) {
			$a []= substr($name, $end);
		}
		return $a;
	}
	public static function convert_setting_string_to_array($str) {
		$raw_array = json_decode($str, true);
		$a = array();
		if (!is_array($raw_array)) {
			return false;
		}
		foreach ($raw_array as $tuple) {
			$keys = self::json_name_string_to_keys($tuple['name']);
			$v = & $a;
			for($i = 0; $i < count($keys) - 1; ++$i) {
				if (!array_key_exists($keys[$i], $v)) {
					$v[$keys[$i]] = array();
				}
				$v = & $v[$keys[$i]];
			}
			$v[end($keys)] = $tuple['value'];
		}
		return $a;
	}
	public static function get_today_in_days() {
		return intval(time() / self::SECOND_IN_A_DAY);
	}
	public static function convert_days_to_date_string($day, $format = 'M j') {
		return date($format, $day * self::SECOND_IN_A_DAY);
	}
	private static $void_html_elements = array("area","base","br","col","command","embed","hr","img","input","link","meta","param","source");
	private static function replace_void_tags($str) {
		foreach(self::$void_html_elements as $tag) {
			$str = preg_replace('/<\s*' . $tag . '(|\s+.*?)>/i', '', $str);
		}
		return $str;
	}
	public static function has_matching_tags($str) {
		if (false === strpos($str, '<')) {
			return true;
		}
		$str = '<div>'.$str.'</div>';
		$str = self::replace_void_tags($str);

		libxml_use_internal_errors(true);
		libxml_clear_errors();
		$xml = simplexml_load_string($str);
		$errors = libxml_get_errors();
		foreach($errors as $err) {
			if ($err->code === 77 || $err->code === 73) {	// mismatching tags || incomplete tag constructor, such as "<br"
				return false;
			}
		}
		return true;
	}
	public static function generate_selection_options($options, $selected_option) {
		$code = '';
		foreach ($options as $option) {
			$code .= '<option value="' . esc_attr($option[0]) . '" ' . selected($selected_option, $option[0], false) . '>' . esc_attr($option[1]) . '</option>';
		}
		return $code;
	}
	public static function dump_variable_to_javascript_array($input) {
		if (is_array($input)) {
			$code = '{';
			foreach ($input as $key => $value) {
				if ($key !== 'css') {
					$code .= '"' . $key . '":' . self::dump_variable_to_javascript_array($value) . ',';
				}
			}
			$code .= '}';
			return $code;
		} else {
			$input = str_replace('"', '\"', $input);
			$input = str_replace("\n", "\\n", $input);
			$input = str_replace("\r", "\\r", $input);
			return '"' . $input . '"';
		}
	}
	public static function is_database_up_to_date() {
		$version = get_transient(self::SETTING_KEY_DATABASE_VERSION);

		if (!$version) {
			$version = get_option(self::SETTING_KEY_DATABASE_VERSION, false);
		}
		return $version === PopupAllyPro::VERSION;
	}
	public static function update_database_version() {
		set_transient(self::SETTING_KEY_DATABASE_VERSION, PopupAllyPro::VERSION, PopupAllyPro::CACHE_PERIOD);
		update_option(self::SETTING_KEY_DATABASE_VERSION, PopupAllyPro::VERSION);
	}
	// replaces wp_parse_args(), which messes up integer indices
	public static function safe_merge_default_values($real_values, $default_values) {
		if (!is_array($real_values)) {
			$real_values = array();
		}
		if (is_array($default_values)) {
			foreach ($default_values as $key => $value) {
				if (!isset($real_values[$key])) {
					$real_values[$key] = $value;
				}
			}
		}
		return $real_values;
	}
	public static function get_all_posts($type, $offset = false, $num_to_fetch = false) {
		$filter = '';
		if ($offset) {
			$filter .= ' OFFSET ' . $offset;
		}
		if ($num_to_fetch > 0) {
			$filter .= ' LIMIT ' . $num_to_fetch;
		}

		global $wpdb;
		$posts = $wpdb->get_results("SELECT ID, post_date, post_title, post_parent FROM $wpdb->posts WHERE post_status IN ('publish','future','draft') AND post_type = '$type' ORDER BY post_title $filter", OBJECT_K);
		return $posts;
	}
	private static function append_child_posts($all_posts, $children_mapping, $post_id, &$results) {
		if (isset($children_mapping[$post_id])) {
			foreach ($children_mapping[$post_id] as $child_id) {
				$results []= $all_posts[$child_id];
				self::append_child_posts($all_posts, $children_mapping, $child_id, $results);
			}
		}
	}
	public static function get_all_hierarchical_posts($type, $num_to_fetch = false) {
		$all_posts = self::get_all_posts($type);
		$top_level_posts = array();
		$children_mapping = array();
		foreach ($all_posts as $post_id => $post) {
			if ($post->post_parent > 0) {
				if (!isset($children_mapping[$post->post_parent])) {
					$children_mapping[$post->post_parent] = array();
				}
				$children_mapping[$post->post_parent] []= $post_id;
			} else {
				$top_level_posts [] = $post_id;
			}
		}
		$results = array();

		foreach ($top_level_posts as $post_id) {
			$results []= $all_posts[$post_id];
			self::append_child_posts($all_posts, $children_mapping, $post_id, $results);
			if ($num_to_fetch && count($results) > $num_to_fetch) {
				break;
			}
		}
		return $results;
	}
}