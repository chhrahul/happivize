<h3>License Settings</h3>
<input type="hidden" class="full-width" name="old-email" value="<?php echo esc_attr($license['email']); ?>"/>
<input type="hidden" class="full-width" name="old-serial" value="<?php echo esc_attr($license['serial']); ?>"/>
<div class="popupally-setting-section">
	<div class="popupally-setting-configure-block">
		<div class="popupally-setting-section-header"><label for="email-input">Registered Email</label></div>
		<div class="popupally-setting-license-input">
			<input id="email-input" type="text" class="full-width" name="email" value="<?php echo esc_attr($license['email']); ?>"/>
		</div>
	</div>
	<div class="popupally-setting-configure-block">
		<div class="popupally-setting-section-header"><label for="serial-input">Serial Key</label></div>
		<div class="popupally-setting-license-input">
			<input id="serial-input" type="text" class="full-width" name="serial" value="<?php echo esc_attr($license['serial']); ?>"/>
		</div>
	</div>
</div>