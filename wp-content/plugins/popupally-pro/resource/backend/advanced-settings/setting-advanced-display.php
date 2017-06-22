<h3>Advanced Settings</h3>
<input type="hidden" name="no-inline" value="<?php echo $advanced['no-inline']; ?>"/>
<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Max number of pages to load</div>
	<div class="popupally-setting-section-help-text">-1 to show all. Displaying too many pages could prevent the PopupAlly Pro Settings from loading due to time out.</div>
	<div class="popupally-setting-configure-block">
		Load <input id="max-page" type="text" name="max-page" value="<?php echo $advanced['max-page']; ?>"/> Pages
	</div>
</div>
<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Max number of posts to load</div>
	<div class="popupally-setting-section-help-text">-1 to show all. Displaying too many posts could prevent the PopupAlly Pro Settings from loading due to time out.</div>
	<div class="popupally-setting-configure-block">
		Load <input id="max-post" type="text" name="max-post" value="<?php echo $advanced['max-post']; ?>"/> Posts
	</div>
</div>
<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Anti-spam signup protection</div>
	<div class="popupally-setting-section-help-text">enable this option will make your popup/embedded opt-in &quot;invisible&quot; to bots, but regular visitors will not be affected at all.</div>
	<div class="popupally-setting-configure-block">
		<input id="anti-spam" type="checkbox" name="anti-spam" <?php checked($advanced['anti-spam'], 'true'); ?> value="true"/>
		<label for="anti-spam">Enable anti-spam signup protection</label>
	</div>
</div>
<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Add &quot;!important&quot; modifier to popup styling</div>
	<div class="popupally-setting-section-help-text">enable this option will add &quot;!important&quot; modifier to popup styling. <strong>Caution</strong>: this should only be used as a last resort when the theme CSS also uses the &quot;!important&quot; modifier which cannot be changed.</div>
	<div class="popupally-setting-configure-block">
		<input id="use-important" type="checkbox" name="use-important" <?php checked($advanced['use-important'], 'true'); ?> value="true"/>
		<label for="use-important">Add &quot;!important&quot; modifier</label>
	</div>
</div>
<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Include Javascript from sign-up HTML</div>
	<div class="popupally-setting-section-help-text">warning: including the Javascript might interfere with normal PopupAlly Pro operation and negatively impact the site performance. Only enable this option if absolutely necessary (usually to record affiliate information).</div>
	<div class="popupally-setting-configure-block">
		<input id="include-javascript" type="checkbox" name="include-javascript" <?php checked($advanced['include-javascript'], 'true'); ?> value="true"/>
		<label for="include-javascript">Include Javascripts</label>
	</div>
</div>
<div class="popupally-setting-section">
	<div class="popupally-setting-section-header">Disable Statistics Tracking</div>
	<div class="popupally-setting-section-help-text">warning: PopupAlly Pro will not track display and opt-in statistics if the statistics tracking function is disabled.</div>
	<div class="popupally-setting-configure-block">
		<input id="disable-stats-tracking" type="checkbox" name="disable-stats-tracking" <?php checked($advanced['disable-stats-tracking'], 'true'); ?> value="true"/>
		<label for="disable-stats-tracking">Disable</label>
	</div>
</div>