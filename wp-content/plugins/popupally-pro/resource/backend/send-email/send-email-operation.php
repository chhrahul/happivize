<?php
class PopupAllyProSendEmailOperation {
	const SEND_EMAIL_POPUP_ARG = 'popupally-pid';
	const SEND_EMAIL_NONCE = 'popupally-nonce';
	const SEND_EMAIL_SUBMIT_NONCE = 'submit-nonce';
	public static function process_send_email_event() {
		if (isset($_POST[self::SEND_EMAIL_POPUP_ARG]) && isset($_POST[self::SEND_EMAIL_NONCE]) && isset($_POST[self::SEND_EMAIL_SUBMIT_NONCE])) {
			/*if (!wp_verify_nonce($_POST[self::SEND_EMAIL_SUBMIT_NONCE], 'popupally-pro-one-step-submit')) {
				die();
			}*/
			$data = array();
			foreach ($_POST as $key => $value) {
				$data[$key] = stripslashes($value);
			}
			$thank_you_url = self::send_email($data);
			if ($thank_you_url) {
				wp_redirect($thank_you_url);
			}
			die();
		}
	}
	public static function send_email($data) {
		$id = $data[self::SEND_EMAIL_POPUP_ARG];
		/*if (!wp_verify_nonce($data[self::SEND_EMAIL_NONCE], 'popupally-pro-email')) {
			die();
		}*/
		$style = PopupAllyProStyleSettings::get_style_settings();
		if (!isset($style[$id])) {
			return false;
		}
		if ($style[$id]['select-information-destination'] !== 'email') {
			return false;
		}
		$subject = $style[$id]['information-destination-email-subject'];
		$address = $style[$id]['information-destination-email-address'];
		$thank_you_url = $style[$id]['information-destination-email-thank-you-url'];
		$content = '';
		foreach ($data as $key => $value) {
			if ($key !== self::SEND_EMAIL_POPUP_ARG && $key !== self::SEND_EMAIL_NONCE && $key !== self::SEND_EMAIL_SUBMIT_NONCE) {
				$content .= $key . ': ' . $value . "\n";
			}
		}
		wp_mail($address, $subject, $content);
		return $thank_you_url;
	}
}