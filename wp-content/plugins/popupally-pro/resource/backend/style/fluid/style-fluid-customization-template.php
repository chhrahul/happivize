<div id="popupally-style-responsive-{{id}}-{{uid}}-{{responsive-id}}" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-{{uid}}="{{responsive-id}}" {{show-customization-block}}>
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" id="popupally-style-responsive-preview-section-{{id}}-{{uid}}-{{responsive-id}}" margin-before="#customization-section-{{id}}-{{uid}}-{{responsive-id}}" style="background-color:{{preview-window-background-color}};">
		<div class="popupally-setting-section-preview-configuration">
			<span class="popupally-setting-section-preview-no-step-aside">
				<input type="checkbox" {{checked-preview-no-step-aside}} id="popupally-style-responsive-preview-no-step-aside-{{id}}-{{uid}}-{{responsive-id}}" popupally-remove-step-aside="#popupally-style-responsive-preview-section-{{id}}-{{uid}}-{{responsive-id}}" value="true" />
				<label for="popupally-style-responsive-preview-no-step-aside-{{id}}-{{uid}}-{{responsive-id}}">Do not move to the right</label>
			</span>
			<span class="popupally-setting-section-preview-color">
				<label>|Preview background color</label>
				<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][preview-window-background-color]" type="text" value="{{preview-window-background-color}}" preview-update-target-css="#popupally-style-responsive-preview-section-{{id}}-{{uid}}-{{responsive-id}}" preview-update-target-css-property="background-color">
			</span>
		</div>
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code}}</div>
	</div>
	<div class="popupally-setting-section customization-section-{{id}}-{{uid}}" id="customization-section-{{id}}-{{uid}}-{{responsive-id}}" responsive-id="{{responsive-id}}">
		<div class="popupally-customization-div {{accordion-open-class}}" id="popup-fluid-popup-customization-{{id}}-{{uid}}-{{responsive-id}}">
			<div class="popupally-header popupally-fluid-position-icon" toggle-target="#popup-fluid-popup-customization-toggle-{{id}}-{{uid}}-{{responsive-id}}">
				<div class="view-toggle-block">
					<input name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][checked-popup-customization-opened]" {{checked-popup-customization-opened}} type="checkbox" value="true"
						   toggle-group="style-popup-customization-{{id}}-{{uid}}-{{responsive-id}}" toggle-class="popupally-item-opened"
						   toggle-element="#popup-fluid-popup-customization-{{id}}-{{uid}}-{{responsive-id}}" min-height="40"
						   popupally-change-source="popup-fluid-popup-customization-toggle-{{id}}-{{uid}}-{{responsive-id}}" id="popup-fluid-popup-customization-toggle-{{id}}-{{uid}}-{{responsive-id}}">
					<label hide-toggle="checked-popup-customization-opened" data-dependency="popup-fluid-popup-customization-toggle-{{id}}-{{uid}}-{{responsive-id}}" data-dependency-value="false">&#x25BC;</label>
					<label hide-toggle="checked-popup-customization-opened" data-dependency="popup-fluid-popup-customization-toggle-{{id}}-{{uid}}-{{responsive-id}}" data-dependency-value="true">&#x25B2;</label>
				</div>
				<div class="popupally-name-display-block">
					<div class="popupally-name-label">Popup options (Location, Size, etc)</div>
				</div>
			</div>
			<div class="popup-fluid-element-customization-block" hide-toggle="checked-popup-customization-opened" data-dependency="popup-fluid-popup-customization-toggle-{{id}}-{{uid}}-{{responsive-id}}" data-dependency-value="true">
				<div class="popupally-configure-element">
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Popup Location</div>
						<div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr>
										<td style="width:40%;">
											<select inherit-css-source="{{id}}-{{uid}}-popup-location" popupally-change-source="{{uid}}-location-selection-{{id}}" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][select-popup-location]">
											{{select-popup-location}}
											</select>
										</td>
										<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div hide-toggle="select-popup-location" data-dependency="{{uid}}-location-selection-{{id}}" data-dependency-value="other">
						<div class="popupally-setting-section-sub-header">Vertical Position</div>
						<div>
							<div>
								Define vertical position by distance to the
								<select popupally-change-source="{{uid}}-location-vertical-selection-{{id}}" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][select-popup-vertical-selection]">
									{{select-popup-vertical-selection}}
								</select>
								of the page.
							</div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr hide-toggle="select-popup-vertical-selection" data-dependency="{{uid}}-location-vertical-selection-{{id}}" data-dependency-value="top">
										<td style="width:20%;">
											Distance to the top of the page
										</td>
										<td style="width:30%;">
											<input style="margin-left:10px;" size="8" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][popup-top]" type="text" value="{{popup-top}}">
										</td>
										<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
									</tr>
									<tr hide-toggle="select-popup-vertical-selection" data-dependency="{{uid}}-location-vertical-selection-{{id}}" data-dependency-value="bottom">
										<td style="width:20%;">
											Distance to the bottom of the page
										</td>
										<td style="width:30%;">
											<input style="margin-left:10px;" size="8" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][popup-bottom]" type="text" value="{{popup-bottom}}">
										</td>
										<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="popupally-setting-configure-block" hide-toggle="checked-full-width" data-dependency="checked-full-width-{{id}}-{{uid}}-{{responsive-id}}" data-dependency-value="false">
							<div class="popupally-setting-section-sub-header">Horizontal Position</div>
							<div>
								<div>
									Define horizontal position by distance to the
									<select popupally-change-source="{{uid}}-location-horizontal-selection-{{id}}" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][select-popup-horizontal-selection]">
										{{select-popup-horizontal-selection}}
									</select>
									of the page.
								</div>
								<table class="popupally-setting-configure-table">
									<tbody>
										<tr hide-toggle="select-popup-horizontal-selection" data-dependency="{{uid}}-location-horizontal-selection-{{id}}" data-dependency-value="left">
											<td style="width:20%;">
												Distance to the left of the page
											</td>
											<td style="width:30%;">
												<input style="margin-left:10px;" size="8" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][popup-left]" type="text" value="{{popup-left}}">
											</td>
											<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
										</tr>
										<tr hide-toggle="select-popup-horizontal-selection" data-dependency="{{uid}}-location-horizontal-selection-{{id}}" data-dependency-value="right">
											<td style="width:20%;">
												Distance to the right of the page
											</td>
											<td style="width:30%;">
												<input style="margin-left:10px;" size="8" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][popup-right]" type="text" value="{{popup-right}}">
											</td>
											<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="popupally-configure-element">
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Background color</div>
						<div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr>
										<td style="width:40%;">
											<div><input inherit-css-source="{{id}}-{{uid}}-background-color" size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][background-color]" type="text" value="{{background-color}}" preview-update-target-css="#popup-box-preview-{{id}}-{{uid}}-{{responsive-id}}" preview-update-target-css-property="background-color"></div>
										</td>
										<td><div class="popupally-inline-help-text">To have a transparent popup, leave this field blank.</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Background Image</div>
						<input inherit-css-source="{{id}}-{{uid}}-background-image" class="full-width" id="image-input-background-image-{{id}}-{{uid}}-{{responsive-id}}" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][background-image-url]" type="text" value="{{background-image-url}}" preview-update-target-css-background-img="#popup-box-preview-{{id}}-{{uid}}-{{responsive-id}}" />
						<div upload-image="#image-input-background-image-{{id}}-{{uid}}-{{responsive-id}}">Upload Image</div>
					</div>
				</div>

				<div class="popupally-configure-element">
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Outer Border/Shadow</div>
						<div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr>
										<td style="width:40%;">
											<div>
												<select inherit-css-source="{{id}}-{{uid}}-border-box-shadow" popupally-change-source='border-box-shadow-{{id}}-{{uid}}-{{responsive-id}}' name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][select-border-box-shadow]" class="full-width" preview-update-target-css="#popup-box-preview-{{id}}-{{uid}}-{{responsive-id}}" preview-update-target-css-property="box-shadow">
													{{select-border-box-shadow}}
												</select>
												<input inherit-css-source="{{id}}-{{uid}}-border-box-shadow" {{select-border-box-shadow-other-hide}} hide-toggle data-dependency="border-box-shadow-{{id}}-{{uid}}-{{responsive-id}}" data-dependency-value="other" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][select-border-box-shadow-other]" class="full-width" value="{{select-border-box-shadow-other}}" preview-update-target-css="#popup-box-preview-{{id}}-{{uid}}-{{responsive-id}}" preview-update-target-css-property="box-shadow">
											</div>
										</td>
										<td><div class="popupally-inline-help-text">The dark border around the popup is defined as a box shadow.</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="popupally-configure-element">
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Popup Box Size</div>
						<div>
							<span class="two-by-two-input">
								Width
								<input size="4" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][width]" type="text" auto-adjust-width-source="{{id}}-{{uid}}" responsive-id="{{responsive-id}}" value="{{width}}" preview-update-target-css="#popup-box-preview-{{id}}-{{uid}}-{{responsive-id}}" preview-update-target-css-property-px="width">px
							</span>
							<span class="two-by-two-input">
								Height
								<input size="4" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][height]" type="text" auto-adjust-height-source="{{id}}-{{uid}}" responsive-id="{{responsive-id}}" value="{{height}}" preview-update-target-css="#popup-box-preview-{{id}}-{{uid}}-{{responsive-id}}" preview-update-target-css-property-px="height">px
							</span>
						</div>
					</div>
				</div>
				<div class="popupally-configure-element">
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Full-width and centered</div>
						<div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr>
										<td style="width:30%;">
											<div>
												<input inherit-css-source="{{id}}-{{uid}}-full-width" type="checkbox" name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][checked-full-width]" value="true" {{checked-full-width}} id="checked-full-width-{{id}}-{{uid}}-{{responsive-id}}" popupally-change-source="checked-full-width-{{id}}-{{uid}}-{{responsive-id}}">
												<label for="checked-full-width-{{id}}-{{uid}}-{{responsive-id}}">Enable full-width</label>
											</div>
										</td>
										<td><div class="popupally-inline-help-text">Ideally used for top of page or bottom of page embedded optin. When enabled, the optin will stretch to fit the entire width of the parent container. The content box (size defined in "Popup Box Size") will be centered.</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{elements}}
	</div>
</div>