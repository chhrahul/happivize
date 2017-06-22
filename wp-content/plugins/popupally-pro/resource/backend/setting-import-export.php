<h3>Import and Export Your Popup Settings</h3>

<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Import</div>
	<div class="popupally-setting-section-help-text">import a .popupally that you have previously saved here (CAUTION: the existing values will be overwritten)</div>
	<div class="popupally-setting-configure-block">
		<div><input id="popupally-import-file" type="file"></div>
	</div>
	<div class="popupally-setting-configure-block">
		<div>Choose the Popup You Would Like to Import Into</div>
		<select id="popupally-import-selection">
			<?php foreach($style as $id => $value) { ?>
			<option value="<?php echo $id; ?>"><?php echo $id; ?>. <?php echo esc_attr($value['name']); ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="popupally-setting-configure-block">
		<div><button id="import-button" style="display:none;" class="popupally-setting-button" import-selection="#popupally-import-selection" title="Import display settings from a .popupally file. The existing values will be overwritten">Import</button></div>
	</div>
</div>

<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Export</div>
	<div class="popupally-setting-section-help-text">export a .popupally file here (the saved values are export, NOT the currently modified values)</div>
	<div class="popupally-setting-configure-block">
		<div>Choose the Popup You Would Like to Export</div>
		<select id="popupally-export-selection">
			<?php foreach($style as $id => $value) { ?>
			<option value="<?php echo $id; ?>"><?php echo $id; ?>. <?php echo esc_attr($value['name']); ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="popupally-setting-configure-block">
		<div>
			<button class="popupally-setting-button" export-link="<?php echo esc_url($nonce_download_url); ?>" export-selection="#popupally-export-selection" title="Export the display settings (the saved, not the currently showing) values to a .popupally file">Export</button>
		</div>
	</div>
</div>