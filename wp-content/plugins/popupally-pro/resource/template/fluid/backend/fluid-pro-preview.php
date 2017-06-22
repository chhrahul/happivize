<div>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="{{uid}}" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="{{uid}}" signup-form-hide="name" value="true"/>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="{{uid}}" signup-form-hide="lname" value="true"/>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="{{uid}}" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section">
		<div class="popupally-customization-div {{accordion-open-class}}" id="popup-fluid-customization-{{id}}-{{uid}}">
			<div class="popupally-header popupally-fluid-bg-opacity-icon" toggle-target="#popup-fluid-customization-toggle-{{id}}-{{uid}}">
				<div class="view-toggle-block">
					<input name="[{{id}}][{{uid}}][checked-customization-opened]" {{checked-customization-opened}} type="checkbox" value="true"
						   toggle-group="style-popup-{{id}}-{{uid}}" toggle-class="popupally-item-opened"
						   toggle-element="#popup-fluid-customization-{{id}}-{{uid}}" min-height="40"
						   popupally-change-source="popup-fluid-customization-toggle-{{id}}-{{uid}}" id="popup-fluid-customization-toggle-{{id}}-{{uid}}">
					<label hide-toggle="checked-customization-opened" data-dependency="popup-fluid-customization-toggle-{{id}}-{{uid}}" data-dependency-value="false">&#x25BC;</label>
					<label hide-toggle="checked-customization-opened" data-dependency="popup-fluid-customization-toggle-{{id}}-{{uid}}" data-dependency-value="true">&#x25B2;</label>
				</div>
				<div class="popupally-name-display-block">
					<div class="popupally-name-label">Popup background overlay options</div>
				</div>
			</div>

			<div class="popup-fluid-element-customization-block" hide-toggle="checked-customization-opened" data-dependency="popup-fluid-customization-toggle-{{id}}-{{uid}}" data-dependency-value="true">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Do not show background overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:80px;">
										<div>
											<input popupally-change-source="{{uid}}-hide-overlay-{{id}}" id="{{uid}}-hide-overlay-{{id}}" name="[{{id}}][{{uid}}][checked-hide-overlay]" {{checked-hide-overlay}} type="checkbox" value="true">
											<label for="{{uid}}-hide-overlay-{{id}}">Yes</label>
										</div>
									</td>
									<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div hide-toggle="checked-hide-overlay" data-dependency="{{uid}}-hide-overlay-{{id}}" data-dependency-value="false">
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
						<div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr>
										<td style="width:60%;">
											<div>
												Color
												<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][{{uid}}][overlay-color]" type="text" value="{{overlay-color}}" data-default-color="#505050">
												Opacity
												<input size="4" name="[{{id}}][{{uid}}][overlay-opacity]" type="text" value="{{overlay-opacity}}">
											</div>
										</td>
										<td><div class="popupally-inline-help-text">Screen Background is the translucent layer that hide the main page content. Opacity: 0 = completely transparent, 1 = completely opaque</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="popupally-setting-configure-block">
						<div class="popupally-setting-section-sub-header">Ignore clicks on Screen Background</div>
						<div>
							<table class="popupally-setting-configure-table">
								<tbody>
									<tr>
										<td style="width:80px;">
											<div>
												<input id="{{uid}}-disable-overlay-close-{{id}}" name="[{{id}}][{{uid}}][checked-disable-overlay-close]" {{checked-disable-overlay-close}} type="checkbox" value="true">
												<label for="{{uid}}-disable-overlay-close-{{id}}">Yes</label>
											</div>
										</td>
										<td><div class="popupally-inline-help-text">By default, clicking on the black background closes the popup. Check this option and the popup window can only be closed by the 'x' mark or pressing the Esc key</div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="popupally-setting-section">
		<div class="popupally-setting-section-header">Customization elements</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Add new element</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select id="popupally-style-add-element-{{id}}-{{uid}}">
										<option value="text">Content box</option>
										<option value="input">Input field</option>
										<option value="submit">Submit button</option>
									</select>
									<input type="hidden" id="popupally-max-element-{{id}}-{{uid}}" value="{{max-element}}" />
								</td>
								<td><div class="popupally-setting-small-button popupally-customization-element-add-button" popup-id="{{id}}" template-id="{{uid}}">Add Element</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="[{{id}}][{{uid}}][selected-responsive]" id="popupally-style-selected-responsive-{{id}}-{{uid}}" value="{{selected-responsive}}" />
	<table class="popupally-style-responsive-container">
		<tbody>
			<tr class="popupally-style-responsive-top-row">
				{{responsive-header}}
				<td class="popupally-style-responsive-tab-label-filler-col" id="popupally-responsive-customization-filler-header-{{id}}-{{uid}}">
					<input type="hidden" id="popupally-max-responsive-{{id}}-{{uid}}" value="{{max-responsive}}" />
					<div class="popupally-setting-button popupally-customization-responsive-add-button" popup-id="{{id}}" template-id="{{uid}}">+</div>
				</td>
			</tr>
			<tr>
				<td colspan="{{responsive-tab-num}}" class="popupally-style-responsive-content-cell" id="popupally-responsive-customization-{{id}}-{{uid}}">
					{{customization-section}}
				</td>
			</tr>
		</tbody>
	</table>
</div>