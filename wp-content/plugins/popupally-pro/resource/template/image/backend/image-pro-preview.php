<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-lquydg-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-lquydg" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-lquydg-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-lquydg" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-lquydg-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-lquydg" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-lquydg="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="lquydg" level="0" margin-before="#lquydg-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="lquydg" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="lquydg" signup-form-hide="name" value="true"/>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="lquydg" signup-form-hide="lname" value="true"/>
	<input style="display:none;" type="checkbox" checked="checked" popup-id="{{id}}" template-id="lquydg" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="lquydg-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="lquydg-location-selection-{{id}}" name="[{{id}}][lquydg-popup-location]">
									{{lquydg-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="lquydg-popup-location" data-dependency="lquydg-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="lquydg-location-vertical-selection-{{id}}" name="[{{id}}][lquydg-popup-vertical-selection]">
							{{lquydg-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="lquydg-popup-vertical-selection" data-dependency="lquydg-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-top]" type="text" value="{{lquydg-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="lquydg-popup-vertical-selection" data-dependency="lquydg-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-bottom]" type="text" value="{{lquydg-popup-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="lquydg-popup-location" data-dependency="lquydg-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<div>
						Define horizontal position by distance to the
						<select popupally-change-source="lquydg-location-horizontal-selection-{{id}}" name="[{{id}}][lquydg-popup-horizontal-selection]">
							{{lquydg-location-horizontal-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="lquydg-popup-horizontal-selection" data-dependency="lquydg-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-left]" type="text" value="{{lquydg-popup-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="lquydg-popup-horizontal-selection" data-dependency="lquydg-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-right]" type="text" value="{{lquydg-popup-right}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
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
									<div><input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][lquydg-background-color]" type="text" value="{{lquydg-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-background-lquydg-{{id}}" preview-update-target-css-property="background-color" data-default-color="#fefefe"></div>
								</td>
								<td><div class="popupally-inline-help-text">To have a transparent popup, leave this field blank.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="lquydg-background-image-url-{{id}}" name="[{{id}}][lquydg-background-image-url]" value="{{lquydg-background-image-url}}" preview-update-target-css-background-img=".popupally-pro-outer-preview-background-lquydg-{{id}}" />
									<div upload-image="#lquydg-background-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show an image with the popup.</div></td>
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
						<input size="4" name="[{{id}}][lquydg-width]" type="text" value="{{lquydg-width}}" preview-update-target-css="#lquydg-popup-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][lquydg-height]" type="text" value="{{lquydg-height}}" preview-update-target-css="#lquydg-popup-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="lquydg-config-image-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="lquydg-image-1-url-{{id}}" name="[{{id}}][lquydg-image-1-url]" value="{{lquydg-image-1-url}}" preview-update-target-css-background-img=".lquydg-preview-image-1-{{id}}" image-dimension-attribute="lquydg-image-1-{{id}}"/>
									<div upload-image="#lquydg-image-1-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to use an image.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the image"></div></div></div>
				<div>
					<span class="two-by-two-input">
						Top
						<input size="4" name="[{{id}}][lquydg-image-1-margin-top]" type="text" value="{{lquydg-image-1-margin-top}}" preview-update-target-css="#lquydg-preview-image-1-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						Bottom
						<input size="4" name="[{{id}}][lquydg-image-1-margin-bottom]" type="text" value="{{lquydg-image-1-margin-bottom}}" preview-update-target-css="#lquydg-preview-image-1-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="lquydg-image-1-{{id}}-width" name="[{{id}}][lquydg-image-1-width]" type="text" value="{{lquydg-image-1-width}}" preview-update-target-css="#lquydg-preview-image-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="lquydg-image-1-{{id}}-height" name="[{{id}}][lquydg-image-1-height]" type="text" value="{{lquydg-image-1-height}}" preview-update-target-css="#lquydg-preview-image-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Redirect to a URL when clicking on the image</div>
				<div>
					<label for="lquydg-image-link-type-{{id}}">Link Type</label>
					<select popupally-change-source="lquydg-image-link-type-{{id}}" id="lquydg-image-link-type-{{id}}" name="[{{id}}][lquydg-image-link-type]">
						{{lquydg-image-link-type-selection}}
					</select>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="lquydg-image-link-type" data-dependency="lquydg-image-link-type-{{id}}" data-dependency-value-not="none">
				<div class="popupally-setting-section-sub-header">URL to redirect to</div>
				<div>
					<input class="full-width" type="text" name="[{{id}}][lquydg-image-link-url]" value="{{lquydg-image-link-url}}" />
				</div>
			</div>
		</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Do not show background overlay</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<div>
										<input popupally-change-source="lquydg-hide-overlay-{{id}}" id="lquydg-hide-overlay-{{id}}" name="[{{id}}][lquydg-hide-overlay]" {{lquydg-hide-overlay}} type="checkbox" value="true">
										<label for="lquydg-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="lquydg-hide-overlay" data-dependency="lquydg-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][lquydg-overlay-color]" type="text" value="{{lquydg-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][lquydg-overlay-opacity]" type="text" value="{{lquydg-overlay-opacity}}">
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
									<td style="width:40%;">
										<div>
											<input id="lquydg-disable-overlay-close-{{id}}" name="[{{id}}][lquydg-disable-overlay-close]" {{lquydg-disable-overlay-close}} type="checkbox" value="true">
											<label for="lquydg-disable-overlay-close-{{id}}">Yes</label>
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

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Show box shadow for embedded popup</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<div>
										<input id="lquydg-show-embedded-border-{{id}}" name="[{{id}}][lquydg-show-embedded-border]" {{lquydg-show-embedded-border}} type="checkbox" value="true">
										<label for="lquydg-show-embedded-border-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, the box shadow (dark border) around the popup is not shown when the embedded display option is use. Check this option to show the dark border for embedded opt-in.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-lquydg="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="lquydg" level="1" margin-before="#lquydg-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="lquydg-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="lquydg-popup-location" data-dependency="lquydg-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="lquydg-popup-vertical-selection" data-dependency="lquydg-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-960-top]" type="text" value="{{lquydg-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="lquydg-popup-vertical-selection" data-dependency="lquydg-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-960-bottom]" type="text" value="{{lquydg-popup-960-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="lquydg-popup-horizontal-selection" data-dependency="lquydg-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-960-left]" type="text" value="{{lquydg-popup-960-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="lquydg-popup-horizontal-selection" data-dependency="lquydg-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-960-right]" type="text" value="{{lquydg-popup-960-right}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
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
						<input size="4" name="[{{id}}][lquydg-width-960]" type="text" value="{{lquydg-width-960}}" preview-update-target-css="#lquydg-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][lquydg-height-960]" type="text" value="{{lquydg-height-960}}" preview-update-target-css="#lquydg-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="lquydg-config-image-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the image"></div></div></div>
				<div>
					<span class="two-by-two-input">
						Top
						<input size="4" name="[{{id}}][lquydg-image-1-960-margin-top]" type="text" value="{{lquydg-image-1-960-margin-top}}" preview-update-target-css="#lquydg-preview-image-1-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						Bottom
						<input size="4" name="[{{id}}][lquydg-image-1-960-margin-bottom]" type="text" value="{{lquydg-image-1-960-margin-bottom}}" preview-update-target-css="#lquydg-preview-image-1-960-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][lquydg-image-1-960-width]" type="text" value="{{lquydg-image-1-960-width}}" preview-update-target-css="#lquydg-preview-image-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][lquydg-image-1-960-height]" type="text" value="{{lquydg-image-1-960-height}}" preview-update-target-css="#lquydg-preview-image-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-lquydg="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="lquydg" level="1" margin-before="#lquydg-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="lquydg-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="lquydg-popup-location" data-dependency="lquydg-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="lquydg-popup-vertical-selection" data-dependency="lquydg-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-640-top]" type="text" value="{{lquydg-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="lquydg-popup-vertical-selection" data-dependency="lquydg-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-640-bottom]" type="text" value="{{lquydg-popup-640-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="lquydg-popup-horizontal-selection" data-dependency="lquydg-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-640-left]" type="text" value="{{lquydg-popup-640-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="lquydg-popup-horizontal-selection" data-dependency="lquydg-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][lquydg-popup-640-right]" type="text" value="{{lquydg-popup-640-right}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
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
						<input size="4" name="[{{id}}][lquydg-width-640]" type="text" value="{{lquydg-width-640}}" preview-update-target-css="#lquydg-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][lquydg-height-640]" type="text" value="{{lquydg-height-640}}" preview-update-target-css="#lquydg-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="lquydg-config-image-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the image"></div></div></div>
				<div>
					<span class="two-by-two-input">
						Top
						<input size="4" name="[{{id}}][lquydg-image-1-640-margin-top]" type="text" value="{{lquydg-image-1-640-margin-top}}" preview-update-target-css="#lquydg-preview-image-1-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						Bottom
						<input size="4" name="[{{id}}][lquydg-image-1-640-margin-bottom]" type="text" value="{{lquydg-image-1-640-margin-bottom}}" preview-update-target-css="#lquydg-preview-image-1-640-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][lquydg-image-1-640-width]" type="text" value="{{lquydg-image-1-640-width}}" preview-update-target-css="#lquydg-preview-image-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][lquydg-image-1-640-height]" type="text" value="{{lquydg-image-1-640-height}}" preview-update-target-css="#lquydg-preview-image-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>