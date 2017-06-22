<?php
if (!class_exists('PopupAllyProOneStepSubmit')) {
	class PopupAllyProOneStepSubmit {
		public static function add_actions() {
			add_action('wp_ajax_popupallypro_submit_form', array(__CLASS__, 'submit_form_callback'));
			add_action('wp_ajax_nopriv_popupallypro_submit_form', array(__CLASS__, 'submit_form_callback'));
		}
		private static function proper_parse_str($str) {
			$arr = array();

			# split on outer delimiter
			$pairs = explode('&', $str);

			# loop through each pair
			foreach ($pairs as $i) {
				# split into name and value
				list($name,$value) = explode('=', $i, 2);

				$name = urldecode($name);
				$value = urldecode($value);
				if(isset($arr[$name])) {
					if(is_array($arr[$name])) {
						$arr[$name][] = $value;
					} else {
						$arr[$name] = array($arr[$name], $value);
					}
				} else {
					$arr[$name] = $value;
				}
			}
			return $arr;
		}

		public static function submit_form_callback() {
			if (isset($_POST['target']) && isset($_POST['ufndh_data_icnw']) && isset($_POST['submit_nonce'])) {
				/*if (!wp_verify_nonce($_POST['submit_nonce'], 'popupally-pro-one-step-submit')) {
					die();
				}*/
				$action = $_POST['target'];
				$data = $_POST['ufndh_data_icnw'];
				$method = 'POST';
				if (isset($_POST['method'])) {
					$method = strtoupper($_POST['method']);
				}
				$data = stripslashes($data);
				$data = urldecode($data);
				$data_array = self::proper_parse_str($data);
				if ($action === 'popupally-pro-send-email') {
					PopupAllyProSendEmailOperation::send_email($data_array);
				} else {
					$action = urldecode($action);
					if (strpos($action, '//') === 0) {
						$action = 'http:' . $action;
					}
					$response = wp_remote_post($action, array(
						'method' => $method,
						'timeout' => 45,
						'redirection' => 5,
						'httpversion' => '1.0',
						'blocking' => true,
						'headers' => array(),
						'body' => $data_array,
						));
					echo serialize($response);
				}
			}
			die();
		}
	}
}

