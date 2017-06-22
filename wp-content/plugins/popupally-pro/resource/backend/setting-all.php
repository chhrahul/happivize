<div class="wrap">
<h2 style="display:none;"><?php _e('PopupAlly Pro Settings'); ?></h2>
<?php settings_errors('popupally_pro_settings'); ?>
<div id="popupally-import-wait-overlay">
	<img src="<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/wait.gif" alt="Importing" width="128" height="128" />
</div>
<div id="popupally-loading-overlay">
	<div>
		<img src="<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/wait.gif" alt="Importing" width="128" height="128" />
		<span>Initializing Polite Opt-In Sequence...</span>
	</div>
</div>
<table class="popupally-setting-container">
	<tbody>
		<tr>
			<td class="popupally-setting-left-col"/>
			<td class="popupally-setting-title-cell popupally-setting-right-col">
				<div style="display:inline-block;">
					<div class="popupally-setting-title">PopupAlly Pro</div>

					<div class="popupally-setting-section-help-text"><div class="popupally-info-icon"></div>Need extra help? View our documentation and tutorials <a class="underline" target="_blank" href="<?php echo PopupAllyPro::HELP_URL; ?>">here</a>!</div>
				</div>
				<form class="popupally-pro-option-submit-form" enctype="multipart/form-data" method="post" action="options.php">
					<?php settings_fields( 'popupally_pro_settings' ); ?>
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[selected][selected-tab]" id="selected-tab" class="selected-tab popupally-update-follow-scroll" value="<?php echo $setting['selected-tab']; ?>" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY; ?>]" class="<?php echo PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProStyleSettings::SETTING_KEY_STYLE; ?>]" class="<?php echo PopupAllyProStyleSettings::SETTING_KEY_STYLE; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProTrackStatistics::SETTING_KEY_STATS; ?>]" class="<?php echo PopupAllyProTrackStatistics::SETTING_KEY_STATS; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProSplitTest::SETTING_KEY_SPLIT_TEST; ?>]" class="<?php echo PopupAllyProSplitTest::SETTING_KEY_SPLIT_TEST; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyPro::SETTING_KEY_COPY_DELETE; ?>]" class="<?php echo PopupAllyPro::SETTING_KEY_COPY_DELETE; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProAdvancedSettings::SETTING_KEY_ADVANCED; ?>]" class="<?php echo PopupAllyProAdvancedSettings::SETTING_KEY_ADVANCED; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyPro::SETTING_KEY_LICENSE; ?>]" class="<?php echo PopupAllyPro::SETTING_KEY_LICENSE; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[add]" class="add_new" value="" />
					<input class="popupally-setting-submit-button" type="submit" value="Save Changes" />
				</form>
			</td>
		</tr>
		<tr>
			<?php if (PopupAllyPro::$popupally_pro_enabled) { ?>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='display'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="display" tab-group="popup-pro-tab-group-1" target="display" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/display-icon.png');" class="popupally-pro-tab-label">
					Display Settings
				</div>
			</td>
			<?php } else { ?>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col popupally-pro-setting-tab-active" click-target=".selected-tab" click-value="license" tab-group="popup-pro-tab-group-1" target="license" active-class="popupally-pro-setting-tab-active">
				<div style="background-image:url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/license-icon.png');" class="popupally-pro-tab-label">
					License
				</div>
			</td>
			<?php } ?>
			<?php if (PopupAllyPro::$popupally_pro_enabled) { ?>
			<td rowspan="<?php echo PopupAllyPro::$show_license_tab ? "10":"9" ?>" class="popupally-setting-content-cell popupally-setting-right-col">
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='display'?'block':'none'; ?>;" popup-pro-tab-group-1="display">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY; ?>">
					<?php PopupAllyProDisplaySettings::show_display_settings(); ?>
					</div>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='style'?'block':'none'; ?>;" popup-pro-tab-group-1="style">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyProStyleSettings::SETTING_KEY_STYLE; ?>">
					<?php PopupAllyProStyleSettings::show_style_settings(); ?>
					</div>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='stats'?'block':'none'; ?>;" popup-pro-tab-group-1="stats">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyProTrackStatistics::SETTING_KEY_STATS; ?>">
					<?php PopupAllyProTrackStatistics::show_statistics(); ?>
					</div>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='split'?'block':'none'; ?>;" popup-pro-tab-group-1="split">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyProSplitTest::SETTING_KEY_SPLIT_TEST; ?>">
					<?php PopupAllyProSplitTest::show_split_test_settings(); ?>
					</div>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='copy'?'block':'none'; ?>;" popup-pro-tab-group-1="copy">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyPro::SETTING_KEY_COPY_DELETE; ?>">
					<?php PopupAllyPro::show_copy_delete_settings(); ?>
					</div>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='advanced'?'block':'none'; ?>;" popup-pro-tab-group-1="advanced">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyProAdvancedSettings::SETTING_KEY_ADVANCED; ?>">
					<?php PopupAllyProAdvancedSettings::show_advanced_settings(); ?>
					</div>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='import'?'block':'none'; ?>;" popup-pro-tab-group-1="import">
					<?php PopupAllyPro::show_import_export_settings(); ?>
				</div>
				<div class="popupally-setting-content-container" style="display:<?php echo $setting['selected-tab']==='toolkit'?'block':'none'; ?>;" popup-pro-tab-group-1="toolkit">
					<?php include dirname(__FILE__) . '/setting-toolkit.php'; ?>
				</div>
			<?php } else { ?>
			<td rowspan="2" class="popupally-setting-content-cell popupally-setting-right-col">
			<?php } ?>
			<?php if (PopupAllyPro::$show_license_tab) { ?>
				<div class="popupally-setting-content-container" style="display:<?php echo ($setting['selected-tab']==='license' || !PopupAllyPro::$popupally_pro_enabled)?'block':'none'; ?>;" popup-pro-tab-group-1="license">
					<div class="popupally-pro-option-setting-form" serialize-target="<?php echo PopupAllyPro::SETTING_KEY_LICENSE; ?>">
					<?php PopupAllyPro::show_license_settings(); ?>
					</div>
				</div>
			<?php } ?>
			</td>
		</tr>
		<?php if (PopupAllyPro::$popupally_pro_enabled) { ?>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='style'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="style" tab-group="popup-pro-tab-group-1" target="style" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/style-icon.png');" class="popupally-pro-tab-label">
					Style Settings
				</div>
			</td>
		</tr>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='stats'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="stats" tab-group="popup-pro-tab-group-1" target="stats" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/stats-icon.png');" class="popupally-pro-tab-label">
					Statistics
				</div>
			</td>
		</tr>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='split'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="split" tab-group="popup-pro-tab-group-1" target="split" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/split-test-icon.png');" class="popupally-pro-tab-label">
					Split Test
				</div>
			</td>
		</tr>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='copy'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="copy" tab-group="popup-pro-tab-group-1" target="copy" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/copy-icon.png');" class="popupally-pro-tab-label">
					Copy/Delete Popup
				</div>
			</td>
		</tr>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='advanced'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="advanced" tab-group="popup-pro-tab-group-1" target="advanced" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/advanced-icon.png');" class="popupally-pro-tab-label">
					Advanced Settings
				</div>
			</td>
		</tr>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='import'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="import" tab-group="popup-pro-tab-group-1" target="import" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>/resource/backend/img/import-icon.png');" class="popupally-pro-tab-label">
					Import/Export
				</div>
			</td>
		</tr>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='toolkit'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="toolkit" tab-group="popup-pro-tab-group-1" target="toolkit" active-class="popupally-pro-setting-tab-active">
				<div style="background-image: url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/toolbox-icon.png');" class="popupally-pro-tab-label">
					Toolkit
				</div>
			</td>
		</tr>
		<?php if (PopupAllyPro::$show_license_tab) { ?>
		<tr>
			<td class="popupally-setting-left-col popupally-setting-tab-label-col <?php echo $setting['selected-tab']==='license'?'popupally-pro-setting-tab-active':''; ?>" click-target=".selected-tab" click-value="license" tab-group="popup-pro-tab-group-1" target="license" active-class="popupally-pro-setting-tab-active">
				<div style="background-image:url('<?php echo PopupAllyPro::$PLUGIN_URI; ?>resource/backend/img/license-icon.png');" class="popupally-pro-tab-label">
					License
				</div>
			</td>
		</tr>
		<?php } ?>
		<?php } ?>
		<tr class="popupally-setting-filler-row">
			<td class="popupally-setting-left-col"><br/></td>
		</tr>
		<tr class="popupally-setting-last-row">
			<td class="popupally-setting-left-col" />
			<td class="popupally-setting-right-col">
				<?php if (PopupAllyPro::$popupally_pro_enabled) { ?>
				<h3 style="margin-top:20px;">Add more popups</h3>
				<div class="popupally-pro-option-setting-form" serialize-target="add_new">
					<input type="checkbox" popupally-change-source="add-new" id="add-new" name="add-new" value="true"/>
					<label for="add-new">Add <input type="text" readonly readonly-toggle data-dependency="add-new" data-dependency-value="true"name="num-new" size="2" value="1"/> more popup(s)</label>
				</div>
				<?php } ?>
				<form class="popupally-pro-option-submit-form" enctype="multipart/form-data" method="post" action="options.php">
					<?php settings_fields( 'popupally_pro_settings' ); ?>
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[selected][selected-tab]" class="selected-tab" value="<?php echo $setting['selected-tab']; ?>" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY; ?>]" class="<?php echo PopupAllyProDisplaySettings::SETTING_KEY_DISPLAY; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProStyleSettings::SETTING_KEY_STYLE; ?>]" class="<?php echo PopupAllyProStyleSettings::SETTING_KEY_STYLE; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProTrackStatistics::SETTING_KEY_STATS; ?>]" class="<?php echo PopupAllyProTrackStatistics::SETTING_KEY_STATS; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProSplitTest::SETTING_KEY_SPLIT_TEST; ?>]" class="<?php echo PopupAllyProSplitTest::SETTING_KEY_SPLIT_TEST; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyPro::SETTING_KEY_COPY_DELETE; ?>]" class="<?php echo PopupAllyPro::SETTING_KEY_COPY_DELETE; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyProAdvancedSettings::SETTING_KEY_ADVANCED; ?>]" class="<?php echo PopupAllyProAdvancedSettings::SETTING_KEY_ADVANCED; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[<?php echo PopupAllyPro::SETTING_KEY_LICENSE; ?>]" class="<?php echo PopupAllyPro::SETTING_KEY_LICENSE; ?>" value="" />
					<input type="hidden" name="<?php echo PopupAllyPro::SETTING_KEY_ALL; ?>[add]" class="add_new" value="" />
					<input class="popupally-setting-submit-button" type="submit" value="Save Changes" />
				</form>
			</td>
		</tr>
	</tbody>
</table>
</div>
