<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-cjthhv-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-cjthhv" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-cjthhv-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-cjthhv" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-cjthhv-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-cjthhv" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-cjthhv="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="cjthhv" level="0" margin-before="#cjthhv-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="cjthhv" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="cjthhv" signup-form-hide="lname" value="true"/>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="cjthhv" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="cjthhv-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="cjthhv-location-selection-{{id}}" name="[{{id}}][cjthhv-popup-location]">
									{{cjthhv-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="cjthhv-popup-location" data-dependency="cjthhv-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="cjthhv-location-vertical-selection-{{id}}" name="[{{id}}][cjthhv-popup-vertical-selection]">
							{{cjthhv-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="cjthhv-popup-vertical-selection" data-dependency="cjthhv-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][cjthhv-popup-top]" type="text" value="{{cjthhv-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="cjthhv-popup-vertical-selection" data-dependency="cjthhv-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][cjthhv-popup-bottom]" type="text" value="{{cjthhv-popup-bottom}}">
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
									<div><input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][cjthhv-background-color]" type="text" value="{{cjthhv-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-background-cjthhv-{{id}}" preview-update-target-css-property="background-color" data-default-color="#e34a63"></div>
								</td>
								<td><div class="popupally-inline-help-text">To have a transparent popup, leave this field blank.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Content Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="cjthhv-image-url-{{id}}" name="[{{id}}][cjthhv-image-url]" value="{{cjthhv-image-url}}" preview-update-target-css-background-img="#cjthhv-popup-box-preview-{{id}}" />
									<div upload-image="#cjthhv-image-url-{{id}}">Upload Image</div>
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
				<div class="popupally-setting-section-sub-header">Content Box Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][cjthhv-width]" type="text" value="{{cjthhv-width}}" preview-update-target-css="#cjthhv-popup-content-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][cjthhv-height]" type="text" value="{{cjthhv-height}}" preview-update-target-css="#cjthhv-popup-content-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-headline-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][cjthhv-headline]" html-error-check="#cjthhv-headline-error-{{id}}" preview-update-target=".cjthhv-preview-headline-{{id}}">{{cjthhv-headline}}</textarea>
					<small class="sign-up-error" id="cjthhv-headline-error-{{id}}" popup-id="{{id}}" html-code-source="Headline"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][cjthhv-headline-top]" type="text" value="{{cjthhv-headline-top}}" preview-update-target-css="#cjthhv-preview-headline-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][cjthhv-headline-left]" type="text" value="{{cjthhv-headline-left}}" preview-update-target-css="#cjthhv-preview-headline-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{cjthhv-headline-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-name-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide Name Input Field</div>
				<div>
					<input popupally-change-source="cjthhv-hide-name-field-{{id}}" id="cjthhv-hide-name-field-{{id}}" name="[{{id}}][cjthhv-hide-name-field]" {{cjthhv-hide-name-field}} signup-form-hide="name" popup-id="{{id}}" template-id="cjthhv" type="checkbox" value="true" preview-update-target-hide-checked=".cjthhv-preview-name-{{id}}">
					<label for="cjthhv-hide-name-field-{{id}}">Yes</label>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="cjthhv-hide-name-field" data-dependency="cjthhv-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Name Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][cjthhv-name-placeholder]" type="text" value="{{cjthhv-name-placeholder}}" preview-update-target-placeholder=".cjthhv-preview-name-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][cjthhv-name-field-top]" type="text" value="{{cjthhv-name-field-top}}" preview-update-target-css="#cjthhv-preview-name-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][cjthhv-name-field-left]" type="text" value="{{cjthhv-name-field-left}}" preview-update-target-css="#cjthhv-preview-name-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="cjthhv-hide-name-field" data-dependency="cjthhv-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Name Input Style</div>
				{{cjthhv-name-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-email-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][cjthhv-email-placeholder]" type="text" value="{{cjthhv-email-placeholder}}" preview-update-target-placeholder=".cjthhv-preview-email-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][cjthhv-email-field-top]" type="text" value="{{cjthhv-email-field-top}}" preview-update-target-css="#cjthhv-preview-email-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][cjthhv-email-field-left]" type="text" value="{{cjthhv-email-field-left}}" preview-update-target-css="#cjthhv-preview-email-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{cjthhv-email-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-subscribe-button-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text</div>
				<div>
					<input size="20" name="[{{id}}][cjthhv-subscribe-button-text]" type="text" value="{{cjthhv-subscribe-button-text}}" preview-update-target-value=".cjthhv-subscribe-button-{{id}}">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Top
							<input size="4" name="[{{id}}][cjthhv-subscribe-button-top]" type="text" value="{{cjthhv-subscribe-button-top}}" preview-update-target-css="#cjthhv-subscribe-button-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Left
							<input size="4" name="[{{id}}][cjthhv-subscribe-button-left]" type="text" value="{{cjthhv-subscribe-button-left}}" preview-update-target-css="#cjthhv-subscribe-button-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][cjthhv-subscribe-button-color]" type="text" value="{{cjthhv-subscribe-button-color}}" preview-update-target-css=".cjthhv-subscribe-button-{{id}}" preview-update-target-css-property="background-color" data-default-color="#81d742">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{cjthhv-subscribe-button-text-advanced}}
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
										<input popupally-change-source="cjthhv-hide-overlay-{{id}}" id="cjthhv-hide-overlay-{{id}}" name="[{{id}}][cjthhv-hide-overlay]" {{cjthhv-hide-overlay}} type="checkbox" value="true">
										<label for="cjthhv-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="cjthhv-hide-overlay" data-dependency="cjthhv-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][cjthhv-overlay-color]" type="text" value="{{cjthhv-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][cjthhv-overlay-opacity]" type="text" value="{{cjthhv-overlay-opacity}}">
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
											<input id="cjthhv-disable-overlay-close-{{id}}" name="[{{id}}][cjthhv-disable-overlay-close]" {{cjthhv-disable-overlay-close}} type="checkbox" value="true">
											<label for="cjthhv-disable-overlay-close-{{id}}">Yes</label>
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
										<input id="cjthhv-show-embedded-border-{{id}}" name="[{{id}}][cjthhv-show-embedded-border]" {{cjthhv-show-embedded-border}} type="checkbox" value="true">
										<label for="cjthhv-show-embedded-border-{{id}}">Yes</label>
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
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-cjthhv="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="cjthhv" level="1" margin-before="#cjthhv-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="cjthhv-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="cjthhv-popup-location" data-dependency="cjthhv-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="cjthhv-popup-vertical-selection" data-dependency="cjthhv-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][cjthhv-popup-960-top]" type="text" value="{{cjthhv-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="cjthhv-popup-vertical-selection" data-dependency="cjthhv-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][cjthhv-popup-960-bottom]" type="text" value="{{cjthhv-popup-960-bottom}}">
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
						<input size="4" name="[{{id}}][cjthhv-width-960]" type="text" value="{{cjthhv-width-960}}" preview-update-target-css="#cjthhv-popup-content-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][cjthhv-height-960]" type="text" value="{{cjthhv-height-960}}" preview-update-target-css="#cjthhv-popup-content-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-headline-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][cjthhv-headline-960-top]" type="text" value="{{cjthhv-headline-960-top}}" preview-update-target-css="#cjthhv-preview-headline-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][cjthhv-headline-960-left]" type="text" value="{{cjthhv-headline-960-left}}" preview-update-target-css="#cjthhv-preview-headline-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{cjthhv-headline-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-name-input-960-{{id}}" hide-toggle="cjthhv-hide-name-field" data-dependency="cjthhv-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][cjthhv-name-field-960-top]" type="text" value="{{cjthhv-name-field-960-top}}" preview-update-target-css="#cjthhv-preview-name-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][cjthhv-name-field-960-left]" type="text" value="{{cjthhv-name-field-960-left}}" preview-update-target-css="#cjthhv-preview-name-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Name Input Style</div>
				{{cjthhv-name-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-email-input-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][cjthhv-email-field-960-top]" type="text" value="{{cjthhv-email-field-960-top}}" preview-update-target-css="#cjthhv-preview-email-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][cjthhv-email-field-960-left]" type="text" value="{{cjthhv-email-field-960-left}}" preview-update-target-css="#cjthhv-preview-email-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{cjthhv-email-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-subscribe-button-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Top
							<input size="4" name="[{{id}}][cjthhv-subscribe-button-960-top]" type="text" value="{{cjthhv-subscribe-button-960-top}}" preview-update-target-css="#cjthhv-subscribe-button-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Left
							<input size="4" name="[{{id}}][cjthhv-subscribe-button-960-left]" type="text" value="{{cjthhv-subscribe-button-960-left}}" preview-update-target-css="#cjthhv-subscribe-button-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{cjthhv-subscribe-button-text-960-advanced}}
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-cjthhv="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="cjthhv" level="1" margin-before="#cjthhv-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="cjthhv-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="cjthhv-popup-location" data-dependency="cjthhv-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="cjthhv-popup-vertical-selection" data-dependency="cjthhv-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][cjthhv-popup-640-top]" type="text" value="{{cjthhv-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="cjthhv-popup-vertical-selection" data-dependency="cjthhv-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][cjthhv-popup-640-bottom]" type="text" value="{{cjthhv-popup-640-bottom}}">
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
						<input size="4" name="[{{id}}][cjthhv-width-640]" type="text" value="{{cjthhv-width-640}}" preview-update-target-css="#cjthhv-popup-content-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][cjthhv-height-640]" type="text" value="{{cjthhv-height-640}}" preview-update-target-css="#cjthhv-popup-content-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-headline-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][cjthhv-headline-640-top]" type="text" value="{{cjthhv-headline-640-top}}" preview-update-target-css="#cjthhv-preview-headline-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][cjthhv-headline-640-left]" type="text" value="{{cjthhv-headline-640-left}}" preview-update-target-css="#cjthhv-preview-headline-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{cjthhv-headline-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-name-input-640-{{id}}" hide-toggle="cjthhv-hide-name-field" data-dependency="cjthhv-hide-name-field-{{id}}" data-dependency-value="false"">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][cjthhv-name-field-640-top]" type="text" value="{{cjthhv-name-field-640-top}}" preview-update-target-css="#cjthhv-preview-name-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][cjthhv-name-field-640-left]" type="text" value="{{cjthhv-name-field-640-left}}" preview-update-target-css="#cjthhv-preview-name-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Name Input Style</div>
				{{cjthhv-name-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-email-input-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][cjthhv-email-field-640-top]" type="text" value="{{cjthhv-email-field-640-top}}" preview-update-target-css="#cjthhv-preview-email-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][cjthhv-email-field-640-left]" type="text" value="{{cjthhv-email-field-640-left}}" preview-update-target-css="#cjthhv-preview-email-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{cjthhv-email-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="cjthhv-config-subscribe-button-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Top
							<input size="4" name="[{{id}}][cjthhv-subscribe-button-640-top]" type="text" value="{{cjthhv-subscribe-button-640-top}}" preview-update-target-css="#cjthhv-subscribe-button-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Left
							<input size="4" name="[{{id}}][cjthhv-subscribe-button-640-left]" type="text" value="{{cjthhv-subscribe-button-640-left}}" preview-update-target-css="#cjthhv-subscribe-button-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{cjthhv-subscribe-button-text-640-advanced}}
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>