<?php
if (!class_exists('PopupAllyProStyleFluidUtilities')) {
	class PopupAllyProStyleFluidUtilities {
		private static $selection_template = array(
			'select-popup-location' => PopupAllyProTemplate::POPUP_LOCATION_SELECTION_TEMPLATE,
			'select-popup-vertical-selection' => '<option s--top--d value="top">Top</option><option s--bottom--d value="bottom">Bottom</option>',
			'select-popup-horizontal-selection' => '<option s--left--d value="left">Left</option><option s--right--d value="right">Right</option>',
			'select-click-action' => '<option s--none--d value="none">No action</option><option s--link--d value="link">Go to another page</option><option s--new-link--d value="new-link">Open a page in a new window</option><option s--popup--d value="popup">Open another popup</option>',
			'select-input-type' => '<option s--single--d value="single">Single-line input</option><option s--multi--d value="multi">Multiple-line input</option><option s--dropdown--d value="dropdown">Dropdown selection</option><option s--checkbox--d value="checkbox">Checkbox</option>',
			'select-checkbox-default-value' => '<option s--unchecked--d value="unchecked">Unchecked</option><option s--checked--d value="checked">Checked</option>',
			);
		public static function initialize_defaults() {
			$options = PopupAllyProSettingShared::$available_box_shadows;
			$options['other'] = 'Other';
			self::$selection_template['select-border-box-shadow'] = PopupAllyProStyleFluidCssCustomization::generate_selection_list($options);
		}
		public static function replace_preview_values($html, $config, $form_field_selection_template = false) {
			foreach($config as $key => $value) {
				if (strpos($key, 'checked-') === 0) {
					$html = str_replace("{{{$key}}}", 'true' === $value ? 'checked="checked"' : '', $html);
				} elseif (strpos($key, 'select-border-box-shadow') === 0) {
					$code = self::$selection_template[$key];
					if (isset(PopupAllyProSettingShared::$available_box_shadows[$value])) {
						$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
						$html = str_replace("{{{$key}-other-hide}}", 'style="display:none;"', $html);
					} else {
						$code = str_replace('s--other--d', 'selected="selected"', $code);
						$html = str_replace("{{{$key}-other-hide}}", '', $html);
					}
					$html = str_replace("{{{$key}}}", $code, $html);
					$html = str_replace("{{{$key}-other}}", esc_attr($value), $html);
				} elseif (strpos($key, 'select-') === 0) {
					$code = self::$selection_template[$key];
					$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
					$html = str_replace("{{{$key}}}", $code, $html);
				} elseif (strpos($key, 'form-select-') === 0) {
					if ($form_field_selection_template) {
						$code = $form_field_selection_template[$key];
						$code = str_replace('s--' . $value . '--d', 'selected="selected"', $code);
					} else {
						$code = '';
					}
					$html = str_replace("{{{$key}}}", $code, $html);
				} elseif (!is_array($value)) {
					$html = str_replace("{{{$key}}}", PopupAllyProUtilites::escape_html_string_literal($value), $html);
				}
			}
			return preg_replace('/s--.*?--d/', '', $html);
		}
	}
}