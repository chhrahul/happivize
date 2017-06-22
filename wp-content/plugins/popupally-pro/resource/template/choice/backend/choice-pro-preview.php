<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-oeudhw-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-oeudhw" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-oeudhw-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-oeudhw" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-oeudhw-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-oeudhw" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-oeudhw="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="oeudhw" level="0" margin-before="#oeudhw-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="oeudhw" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="oeudhw" signup-form-hide="name" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="oeudhw" signup-form-hide="lname" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="oeudhw" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="oeudhw-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="oeudhw-location-selection-{{id}}" name="[{{id}}][oeudhw-popup-location]">
									{{oeudhw-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="oeudhw-popup-location" data-dependency="oeudhw-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="oeudhw-location-vertical-selection-{{id}}" name="[{{id}}][oeudhw-popup-vertical-selection]">
							{{oeudhw-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="oeudhw-popup-vertical-selection" data-dependency="oeudhw-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-top]" type="text" value="{{oeudhw-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="oeudhw-popup-vertical-selection" data-dependency="oeudhw-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-bottom]" type="text" value="{{oeudhw-popup-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="oeudhw-popup-location" data-dependency="oeudhw-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<div>
						Define horizontal position by distance to the
						<select popupally-change-source="oeudhw-location-horizontal-selection-{{id}}" name="[{{id}}][oeudhw-popup-horizontal-selection]">
							{{oeudhw-location-horizontal-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="oeudhw-popup-horizontal-selection" data-dependency="oeudhw-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-left]" type="text" value="{{oeudhw-popup-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="oeudhw-popup-horizontal-selection" data-dependency="oeudhw-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-right]" type="text" value="{{oeudhw-popup-right}}">
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
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][oeudhw-background-color]" type="text" value="{{oeudhw-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-background-oeudhw-{{id}}" preview-update-target-css-property="background-color" data-default-color="#e34a63">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Content Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="oeudhw-background-image-url-{{id}}" name="[{{id}}][oeudhw-image-url]" value="{{oeudhw-image-url}}" preview-update-target-css-background-img=".popupally-pro-outer-preview-background-oeudhw-{{id}}" />
									<div upload-image="#oeudhw-background-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show an image with the popup.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Resize the Background Image so that...</div>
				<div>
					<select name="[{{id}}][oeudhw-background-image-size]" preview-update-target-css=".popupally-pro-outer-preview-background-oeudhw-{{id}}" preview-update-target-css-property="background-size">
						{{oeudhw-background-image-size}}
					</select>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Box Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][oeudhw-width]" type="text" value="{{oeudhw-width}}" preview-update-target-css="#oeudhw-popup-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][oeudhw-height]" type="text" value="{{oeudhw-height}}" preview-update-target-css="#oeudhw-popup-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-headline-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][oeudhw-headline]" html-error-check="#oeudhw-headline-error-{{id}}" preview-update-target=".oeudhw-preview-headline-{{id}}">{{oeudhw-headline}}</textarea>
					<small class="sign-up-error" id="oeudhw-headline-error-{{id}}" popup-id="{{id}}" html-code-source="Headline"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the headline"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-headline-margin-top]" type="text" value="{{oeudhw-headline-margin-top}}" preview-update-target-css="#oeudhw-preview-headline-{{id}}" preview-update-target-css-property-px="margin-top">
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-headline-margin-bottom]" type="text" value="{{oeudhw-headline-margin-bottom}}" preview-update-target-css="#oeudhw-preview-headline-{{id}}" preview-update-target-css-property-px="margin-bottom">
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{oeudhw-headline-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-left-choice-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Text (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][oeudhw-left-choice-text]" html-error-check="#oeudhw-left-choice-text-error-{{id}}" preview-update-target=".oeudhw-preview-left-choice-text-{{id}}">{{oeudhw-left-choice-text}}</textarea>
					<small class="sign-up-error" id="oeudhw-left-choice-text-error-{{id}}" popup-id="{{id}}" html-code-source="Left Choice Box Text"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][oeudhw-left-choice-width]" type="text" value="{{oeudhw-left-choice-width}}" preview-update-target-css="#oeudhw-preview-left-choice-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][oeudhw-left-choice-height]" type="text" value="{{oeudhw-left-choice-height}}" preview-update-target-css="#oeudhw-preview-left-choice-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<input type="hidden" name="[{{id}}][oeudhw-left-choice-target-type]" id="oeudhw-left-choice-target-type-{{id}}" popupally-change-source="oeudhw-left-choice-target-type-{{id}}" value="{{oeudhw-left-choice-target-type}}" />
				<div class="popupally-setting-section-sub-header">Left Choice Destination</div>
				<div hide-toggle="oeudhw-left-choice-target-type" data-dependency="oeudhw-left-choice-target-type-{{id}}" data-dependency-value="popup"><small><a click-value="url" click-target="#oeudhw-left-choice-target-type-{{id}}" href="#">Go to a URL instead</a></small></div>
				<div hide-toggle="oeudhw-left-choice-target-type" data-dependency="oeudhw-left-choice-target-type-{{id}}" data-dependency-value="url"><small><a click-value="popup" click-target="#oeudhw-left-choice-target-type-{{id}}" href="#">Show another popup instead</a></small></div>
				<div hide-toggle="oeudhw-left-choice-target-type" data-dependency="oeudhw-left-choice-target-type-{{id}}" data-dependency-value="popup">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									Popup id
								</td>
								<td style="width:20%;">
									<div><input size="4" name="[{{id}}][oeudhw-left-choice-popup-id]" type="text" value="{{oeudhw-left-choice-popup-id}}"></div>
								</td>
								<td><div class="popupally-inline-help-text">The popup id is the number before the popup name on the header. Set to an invalid popup id or -1 to close the popup when clicked.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div hide-toggle="oeudhw-left-choice-target-type" data-dependency="oeudhw-left-choice-target-type-{{id}}" data-dependency-value="url">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									URL
								</td>
								<td style="width:80%;">
									<input class="full-width" size="20" name="[{{id}}][oeudhw-left-choice-url]" type="text" value="{{oeudhw-left-choice-url}}">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Background Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][oeudhw-left-choice-background-color]" type="text" value="{{oeudhw-left-choice-background-color}}" preview-update-target-css=".oeudhw-preview-left-choice-{{id}}" preview-update-target-css-property="background-color" data-default-color="#f6d31d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="oeudhw-left-image-url-{{id}}" name="[{{id}}][oeudhw-left-choice-background-image-url]" value="{{oeudhw-left-choice-background-image-url}}" preview-update-target-css-background-img=".oeudhw-preview-left-choice-{{id}}" />
									<div upload-image="#oeudhw-left-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show a background image for the left choice.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the left choice"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-left-choice-margin-top]" type="text" value="{{oeudhw-left-choice-margin-top}}" preview-update-target-css="#oeudhw-preview-left-choice-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-left-choice-margin-bottom]" type="text" value="{{oeudhw-left-choice-margin-bottom}}" preview-update-target-css="#oeudhw-preview-left-choice-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Text Style</div>
				{{oeudhw-left-choice-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-right-choice-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Text (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][oeudhw-right-choice-text]" html-error-check="#oeudhw-right-choice-text-error-{{id}}" preview-update-target=".oeudhw-preview-right-choice-text-{{id}}">{{oeudhw-right-choice-text}}</textarea>
					<small class="sign-up-error" id="oeudhw-right-choice-text-error-{{id}}" popup-id="{{id}}" html-code-source="Right Choice Box Text"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][oeudhw-right-choice-width]" type="text" value="{{oeudhw-right-choice-width}}" preview-update-target-css="#oeudhw-preview-right-choice-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][oeudhw-right-choice-height]" type="text" value="{{oeudhw-right-choice-height}}" preview-update-target-css="#oeudhw-preview-right-choice-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<input type="hidden" name="[{{id}}][oeudhw-right-choice-target-type]" id="oeudhw-right-choice-target-type-{{id}}" popupally-change-source="oeudhw-right-choice-target-type-{{id}}" value="{{oeudhw-right-choice-target-type}}" />
				<div class="popupally-setting-section-sub-header">Right Choice Destination</div>
				<div hide-toggle="oeudhw-right-choice-target-type" data-dependency="oeudhw-right-choice-target-type-{{id}}" data-dependency-value="popup"><small><a click-value="url" click-target="#oeudhw-right-choice-target-type-{{id}}" href="#">Go to a URL instead</a></small></div>
				<div hide-toggle="oeudhw-right-choice-target-type" data-dependency="oeudhw-right-choice-target-type-{{id}}" data-dependency-value="url"><small><a click-value="popup" click-target="#oeudhw-right-choice-target-type-{{id}}" href="#">Show another popup instead</a></small></div>
				<div hide-toggle="oeudhw-right-choice-target-type" data-dependency="oeudhw-right-choice-target-type-{{id}}" data-dependency-value="popup">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									Popup id
								</td>
								<td style="width:20%;">
									<div><input size="4" name="[{{id}}][oeudhw-right-choice-popup-id]" type="text" value="{{oeudhw-right-choice-popup-id}}"></div>
								</td>
								<td><div class="popupally-inline-help-text">The popup id is the number before the popup name on the header. Set to an invalid popup id or -1 to close the popup when clicked.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div hide-toggle="oeudhw-right-choice-target-type" data-dependency="oeudhw-right-choice-target-type-{{id}}" data-dependency-value="url">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									URL
								</td>
								<td style="width:80%;">
									<input class="full-width" size="20" name="[{{id}}][oeudhw-right-choice-url]" type="text" value="{{oeudhw-right-choice-url}}">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Background Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][oeudhw-right-choice-background-color]" type="text" value="{{oeudhw-right-choice-background-color}}" preview-update-target-css=".oeudhw-preview-right-choice-{{id}}" preview-update-target-css-property="background-color" data-default-color="#f6d31d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" id="oeudhw-right-image-url-{{id}}" type="text" name="[{{id}}][oeudhw-right-choice-background-image-url]" value="{{oeudhw-right-choice-background-image-url}}" preview-update-target-css-background-img=".oeudhw-preview-right-choice-{{id}}" />
									<div upload-image="#oeudhw-right-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show a background image for the right choice.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the right choice"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-right-choice-margin-top]" type="text" value="{{oeudhw-right-choice-margin-top}}" preview-update-target-css="#oeudhw-preview-right-choice-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-right-choice-margin-bottom]" type="text" value="{{oeudhw-right-choice-margin-bottom}}" preview-update-target-css="#oeudhw-preview-right-choice-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Text Style</div>
				{{oeudhw-right-choice-advanced}}
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
										<input popupally-change-source="oeudhw-hide-overlay-{{id}}" id="oeudhw-hide-overlay-{{id}}" name="[{{id}}][oeudhw-hide-overlay]" {{oeudhw-hide-overlay}} type="checkbox" value="true">
										<label for="oeudhw-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="oeudhw-hide-overlay" data-dependency="oeudhw-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][oeudhw-overlay-color]" type="text" value="{{oeudhw-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][oeudhw-overlay-opacity]" type="text" value="{{oeudhw-overlay-opacity}}">
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
											<input id="oeudhw-disable-overlay-close-{{id}}" name="[{{id}}][oeudhw-disable-overlay-close]" {{oeudhw-disable-overlay-close}} type="checkbox" value="true">
											<label for="oeudhw-disable-overlay-close-{{id}}">Yes</label>
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
										<input id="oeudhw-show-embedded-border-{{id}}" name="[{{id}}][oeudhw-show-embedded-border]" {{oeudhw-show-embedded-border}} type="checkbox" value="true">
										<label for="oeudhw-show-embedded-border-{{id}}">Yes</label>
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
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-oeudhw="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="oeudhw" level="1" margin-before="#oeudhw-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="oeudhw-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="oeudhw-popup-location" data-dependency="oeudhw-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="oeudhw-popup-vertical-selection" data-dependency="oeudhw-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-960-top]" type="text" value="{{oeudhw-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="oeudhw-popup-vertical-selection" data-dependency="oeudhw-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-960-bottom]" type="text" value="{{oeudhw-popup-960-bottom}}">
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
							<tr hide-toggle="oeudhw-popup-horizontal-selection" data-dependency="oeudhw-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-960-left]" type="text" value="{{oeudhw-popup-960-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="oeudhw-popup-horizontal-selection" data-dependency="oeudhw-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-960-right]" type="text" value="{{oeudhw-popup-960-right}}">
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
						<input size="4" name="[{{id}}][oeudhw-width-960]" type="text" value="{{oeudhw-width-960}}" preview-update-target-css="#oeudhw-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][oeudhw-height-960]" type="text" value="{{oeudhw-height-960}}" preview-update-target-css="#oeudhw-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-headline-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the headline"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-headline-960-margin-top]" type="text" value="{{oeudhw-headline-960-margin-top}}" preview-update-target-css="#oeudhw-preview-headline-960-{{id}}" preview-update-target-css-property-px="margin-top">
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-headline-960-margin-bottom]" type="text" value="{{oeudhw-headline-960-margin-bottom}}" preview-update-target-css="#oeudhw-preview-headline-960-{{id}}" preview-update-target-css-property-px="margin-bottom">
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{oeudhw-headline-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-left-choice-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][oeudhw-left-choice-960-width]" type="text" value="{{oeudhw-left-choice-960-width}}" preview-update-target-css="#oeudhw-preview-left-choice-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][oeudhw-left-choice-960-height]" type="text" value="{{oeudhw-left-choice-960-height}}" preview-update-target-css="#oeudhw-preview-left-choice-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the left choice"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-left-choice-960-margin-top]" type="text" value="{{oeudhw-left-choice-960-margin-top}}" preview-update-target-css="#oeudhw-preview-left-choice-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-left-choice-960-margin-bottom]" type="text" value="{{oeudhw-left-choice-960-margin-bottom}}" preview-update-target-css="#oeudhw-preview-left-choice-960-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Text Style</div>
				{{oeudhw-left-choice-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-right-choice-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][oeudhw-right-choice-960-width]" type="text" value="{{oeudhw-right-choice-960-width}}" preview-update-target-css="#oeudhw-preview-right-choice-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][oeudhw-right-choice-960-height]" type="text" value="{{oeudhw-right-choice-960-height}}" preview-update-target-css="#oeudhw-preview-right-choice-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the right choice"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-right-choice-960-margin-top]" type="text" value="{{oeudhw-right-choice-960-margin-top}}" preview-update-target-css="#oeudhw-preview-right-choice-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-right-choice-960-margin-bottom]" type="text" value="{{oeudhw-right-choice-960-margin-bottom}}" preview-update-target-css="#oeudhw-preview-right-choice-960-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Text Style</div>
				{{oeudhw-right-choice-960-advanced}}
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-oeudhw="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="oeudhw" level="1" margin-before="#oeudhw-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="oeudhw-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="oeudhw-popup-location" data-dependency="oeudhw-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="oeudhw-popup-vertical-selection" data-dependency="oeudhw-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-640-top]" type="text" value="{{oeudhw-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="oeudhw-popup-vertical-selection" data-dependency="oeudhw-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-640-bottom]" type="text" value="{{oeudhw-popup-640-bottom}}">
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
							<tr hide-toggle="oeudhw-popup-horizontal-selection" data-dependency="oeudhw-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-640-left]" type="text" value="{{oeudhw-popup-640-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="oeudhw-popup-horizontal-selection" data-dependency="oeudhw-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][oeudhw-popup-640-right]" type="text" value="{{oeudhw-popup-640-right}}">
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
						<input size="4" name="[{{id}}][oeudhw-width-640]" type="text" value="{{oeudhw-width-640}}" preview-update-target-css="#oeudhw-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][oeudhw-height-640]" type="text" value="{{oeudhw-height-640}}" preview-update-target-css="#oeudhw-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-headline-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the headline"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-headline-640-margin-top]" type="text" value="{{oeudhw-headline-640-margin-top}}" preview-update-target-css="#oeudhw-preview-headline-640-{{id}}" preview-update-target-css-property-px="margin-top">
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-headline-640-margin-bottom]" type="text" value="{{oeudhw-headline-640-margin-bottom}}" preview-update-target-css="#oeudhw-preview-headline-640-{{id}}" preview-update-target-css-property-px="margin-bottom">
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{oeudhw-headline-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-left-choice-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][oeudhw-left-choice-640-width]" type="text" value="{{oeudhw-left-choice-640-width}}" preview-update-target-css="#oeudhw-preview-left-choice-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][oeudhw-left-choice-640-height]" type="text" value="{{oeudhw-left-choice-640-height}}" preview-update-target-css="#oeudhw-preview-left-choice-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the left choice"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-left-choice-640-margin-top]" type="text" value="{{oeudhw-left-choice-640-margin-top}}" preview-update-target-css="#oeudhw-preview-left-choice-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-left-choice-640-margin-bottom]" type="text" value="{{oeudhw-left-choice-640-margin-bottom}}" preview-update-target-css="#oeudhw-preview-left-choice-640-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Left Choice Box Text Style</div>
				{{oeudhw-left-choice-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="oeudhw-right-choice-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][oeudhw-right-choice-640-width]" type="text" value="{{oeudhw-right-choice-640-width}}" preview-update-target-css="#oeudhw-preview-right-choice-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][oeudhw-right-choice-640-height]" type="text" value="{{oeudhw-right-choice-640-height}}" preview-update-target-css="#oeudhw-preview-right-choice-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the right choice"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][oeudhw-right-choice-640-margin-top]" type="text" value="{{oeudhw-right-choice-640-margin-top}}" preview-update-target-css="#oeudhw-preview-right-choice-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][oeudhw-right-choice-640-margin-bottom]" type="text" value="{{oeudhw-right-choice-640-margin-bottom}}" preview-update-target-css="#oeudhw-preview-right-choice-640-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Right Choice Box Text Style</div>
				{{oeudhw-right-choice-640-advanced}}
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>