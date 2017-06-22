<?php
// Creating the widget 
class popupally_pro_embedded_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'popupally_pro_embedded_widget', 
			'PopupAlly Pro Embedded Signup Form',
			array('description' => 'Embedded Signup Form') 
		);
	}

	public function widget($args, $instance) {
		$id = $instance['popup-id'];
		$to_show = PopupAllyPro::get_popup_to_show();
		if (isset($to_show[$id])) {
			$display = PopupAllyProDisplaySettings::get_display_settings();
			if (in_array('embedded', $to_show[$id]) && $display[$id]['embedded-location'] === 'widget') {
				$code = PopupAllyPro::get_popup_code();
				if (isset($code[$id])) {
					echo do_shortcode($code[$id]['embedded_html']);
				}
			}
		}
	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'popup-id' ] ) ) {
			$id = $instance[ 'popup-id' ];
		}
		else {
			$id = 0;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'popup-id' ); ?>"><?php _e( 'Popup #:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'popup-id' ); ?>" name="<?php echo $this->get_field_name( 'popup-id' ); ?>" type="text" value="<?php echo $id; ?>" />
		</p>
		<?php 
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['popup-id'] = intval($new_instance['popup-id']);
		return $instance;
	}
}
