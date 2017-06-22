<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-tozpom-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-tozpom" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-tozpom-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-tozpom" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-tozpom-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-tozpom" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-tozpom="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="tozpom" level="0" margin-before="#tozpom-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="tozpom" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="tozpom" signup-form-hide="lname" value="true"/>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="tozpom" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="tozpom-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="tozpom-location-selection-{{id}}" name="[{{id}}][tozpom-popup-location]">
									{{tozpom-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="tozpom-popup-location" data-dependency="tozpom-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="tozpom-location-vertical-selection-{{id}}" name="[{{id}}][tozpom-popup-vertical-selection]">
							{{tozpom-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="tozpom-popup-vertical-selection" data-dependency="tozpom-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-top]" type="text" value="{{tozpom-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="tozpom-popup-vertical-selection" data-dependency="tozpom-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-bottom]" type="text" value="{{tozpom-popup-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="tozpom-popup-location" data-dependency="tozpom-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<div>
						Define horizontal position by distance to the
						<select popupally-change-source="tozpom-location-horizontal-selection-{{id}}" name="[{{id}}][tozpom-popup-horizontal-selection]">
							{{tozpom-location-horizontal-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="tozpom-popup-horizontal-selection" data-dependency="tozpom-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-left]" type="text" value="{{tozpom-popup-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="tozpom-popup-horizontal-selection" data-dependency="tozpom-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-right]" type="text" value="{{tozpom-popup-right}}">
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
									<div><input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][tozpom-background-color]" type="text" value="{{tozpom-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-tozpom-{{id}}" preview-update-target-css-property="background-color" data-default-color="#FFFFFF"></div>
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
									<input class="full-width" type="text" id="tozpom-background-img-url-{{id}}" name="[{{id}}][tozpom-background-image-url]" value="{{tozpom-background-image-url}}" preview-update-target-css-background-img=".popupally-pro-outer-preview-tozpom-{{id}}" />
									<div upload-image="#tozpom-background-img-url-{{id}}">Upload Image</div>
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
						<input size="4" name="[{{id}}][tozpom-width]" type="text" value="{{tozpom-width}}" preview-update-target-css="#tozpom-popup-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][tozpom-height]" type="text" value="{{tozpom-height}}" preview-update-target-css="#tozpom-popup-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-headline-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide Headline</div>
				<div>
					<input popupally-change-source="tozpom-headline-hide-toggle-{{id}}" id="tozpom-headline-hide-toggle-{{id}}" name="[{{id}}][tozpom-headline-hide-toggle]" {{tozpom-headline-hide-toggle}} type="checkbox" value="true"
						   preview-update-target-hide-checked=".tozpom-preview-headline-{{id}}">
					<label for="tozpom-headline-hide-toggle-{{id}}">Yes</label>
				</div>
			</div>
			<div hide-toggle="tozpom-headline-hide-toggle" data-dependency="tozpom-headline-hide-toggle-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Headline (HTML code allowed)</div>
					<div>
						<textarea rows="3" class="full-width" name="[{{id}}][tozpom-headline]" html-error-check="#tozpom-headline-error-{{id}}" preview-update-target=".tozpom-preview-headline-{{id}}">{{tozpom-headline}}</textarea>
						<small class="sign-up-error" id="tozpom-headline-error-{{id}}" popup-id="{{id}}" html-code-source="Headline"></small>
					</div>
				</div>

				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Headline Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the headline"></div></div></div>
					<div>
						<span class="two-by-two-input">
							<label>Top</label>
							<input size="6" name="[{{id}}][tozpom-headline-margin-top]" type="text" value="{{tozpom-headline-margin-top}}" preview-update-target-css="#tozpom-preview-headline-{{id}}" preview-update-target-css-property-px="margin-top">
						</span>
						<span class="two-by-two-input">
							<label>Bottom</label>
							<input size="6" name="[{{id}}][tozpom-headline-margin-bottom]" type="text" value="{{tozpom-headline-margin-bottom}}" preview-update-target-css="#tozpom-preview-headline-{{id}}" preview-update-target-css-property-px="margin-bottom">
						</span>
					</div>
				</div>

				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Headline Style</div>
					{{tozpom-headline-advanced}}
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-logo-img-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="tozpom-logo-img-url-{{id}}" preview-update-target-css-background-img=".tozpom-preview-img-{{id}}" image-dimension-attribute="tozpom-logo-img-{{id}}" name="[{{id}}][tozpom-logo-img-url]" value="{{tozpom-logo-img-url}}" />
									<div upload-image="#tozpom-logo-img-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show an image with the popup.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the logo image"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-logo-img-margin-top]" type="text" value="{{tozpom-logo-img-margin-top}}" preview-update-target-css="#tozpom-preview-img-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-logo-img-margin-bottom]" type="text" value="{{tozpom-logo-img-margin-bottom}}" preview-update-target-css="#tozpom-preview-img-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="tozpom-logo-img-{{id}}-width" name="[{{id}}][tozpom-logo-img-width]" type="text" value="{{tozpom-logo-img-width}}" preview-update-target-css="#tozpom-preview-img-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="tozpom-logo-img-{{id}}-height" name="[{{id}}][tozpom-logo-img-height]" type="text" value="{{tozpom-logo-img-height}}" preview-update-target-css="#tozpom-preview-img-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-input-name-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide Name Input Field</div>
				<div>
					<input popupally-change-source="tozpom-hide-name-field-{{id}}" id="tozpom-hide-name-field-{{id}}" name="[{{id}}][tozpom-hide-name-field]" {{tozpom-hide-name-field}} signup-form-hide="name" popup-id="{{id}}" template-id="tozpom" type="checkbox" value="true" preview-update-target-hide-checked=".tozpom-preview-name-{{id}}">
					<label for="tozpom-hide-name-field-{{id}}">Yes</label>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="tozpom-hide-name-field" data-dependency="tozpom-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Name Input Placeholder</div>
				<div>
					<input class="full-width" name="[{{id}}][tozpom-name-placeholder]" type="text" value="{{tozpom-name-placeholder}}" preview-update-target-placeholder=".tozpom-preview-name-{{id}}">
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="tozpom-hide-name-field" data-dependency="tozpom-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Name Input Box Style</div>
				{{tozpom-name-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-input-email-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Placeholder</div>
				<div>
					<input class="full-width" name="[{{id}}][tozpom-email-placeholder]" type="text" value="{{tozpom-email-placeholder}}" preview-update-target-placeholder=".tozpom-preview-email-{{id}}">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing between the name and email input boxes"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-email-margin-top]" type="text" value="{{tozpom-email-margin-top}}" preview-update-target-css="#tozpom-preview-email-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Box Style</div>
				{{tozpom-email-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-subscribe-button-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text</div>
				<div>
					<input class="full-width" name="[{{id}}][tozpom-subscribe-button-text]" type="text" value="{{tozpom-subscribe-button-text}}" preview-update-target-value=".tozpom-preview-subscribe-button-{{id}}">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{tozpom-subscribe-button-text-advanced}}
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][tozpom-subscribe-button-color]" type="text" value="{{tozpom-subscribe-button-color}}" preview-update-target-css=".tozpom-preview-subscribe-button-{{id}}" preview-update-target-css-property="background-color" data-default-color="#00c98d">
				</div>
			</div>

			<div class="popupally-setting-section-sub-header">
				<div class="popupally-setting-section-sub-header">Subscribe Button Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the subscribe button"></div></div></div>
				<div>
					<span class="two-by-two-input">
					<label>Top</label>
					<input size="6" name="[{{id}}][tozpom-subscribe-button-margin-top]" type="text" value="{{tozpom-subscribe-button-margin-top}}" preview-update-target-css="#tozpom-preview-subscribe-button-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-subscribe-button-margin-bottom]" type="text" value="{{tozpom-subscribe-button-margin-bottom}}" preview-update-target-css="#tozpom-preview-subscribe-button-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-privacy-text-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide Privacy Text</div>
				<div>
					<input popupally-change-source="tozpom-privacy-hide-toggle-{{id}}" id="tozpom-privacy-hide-toggle-{{id}}" name="[{{id}}][tozpom-privacy-hide-toggle]" {{tozpom-privacy-hide-toggle}} type="checkbox" value="true"
						   preview-update-target-hide-checked=".tozpom-preview-privacy-text-{{id}}">
					<label for="tozpom-privacy-hide-toggle-{{id}}">Yes</label>
				</div>
			</div>
			<div hide-toggle="tozpom-privacy-hide-toggle" data-dependency="tozpom-privacy-hide-toggle-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Privacy Text (HTML code allowed)</div>
					<div>
						<textarea rows="3" class="full-width" name="[{{id}}][tozpom-privacy-text]" html-error-check="#tozpom-privacy-text-error-{{id}}" preview-update-target=".tozpom-preview-privacy-text-{{id}}">{{tozpom-privacy-text}}</textarea>
						<small class="sign-up-error" id="tozpom-privacy-text-error-{{id}}" popup-id="{{id}}" html-code-source="Privacy Text"></small>
					</div>
				</div>

				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Privacy Text Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the privacy text"></div></div></div>
					<div>
						<span class="two-by-two-input">
							<label>Top</label>
							<input size="6" name="[{{id}}][tozpom-privacy-text-margin-top]" type="text" value="{{tozpom-privacy-text-margin-top}}" preview-update-target-css="#tozpom-preview-privacy-text-{{id}}" preview-update-target-css-property-px="margin-top">px
						</span>
						<span class="two-by-two-input">
							<label>Bottom</label>
							<input size="6" name="[{{id}}][tozpom-privacy-text-margin-bottom]" type="text" value="{{tozpom-privacy-text-margin-bottom}}" preview-update-target-css="#tozpom-preview-privacy-text-{{id}}" preview-update-target-css-property-px="margin-bottom">px
						</span>
					</div>
				</div>

				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Privacy Text Style</div>
					{{tozpom-privacy-text-advanced}}
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
										<input popupally-change-source="tozpom-hide-overlay-{{id}}" id="tozpom-hide-overlay-{{id}}" name="[{{id}}][tozpom-hide-overlay]" {{tozpom-hide-overlay}} type="checkbox" value="true">
										<label for="tozpom-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="tozpom-hide-overlay" data-dependency="tozpom-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][tozpom-overlay-color]" type="text" value="{{tozpom-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][tozpom-overlay-opacity]" type="text" value="{{tozpom-overlay-opacity}}">
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
											<input id="tozpom-disable-overlay-close-{{id}}" name="[{{id}}][tozpom-disable-overlay-close]" {{tozpom-disable-overlay-close}} type="checkbox" value="true">
											<label for="tozpom-disable-overlay-close-{{id}}">Yes</label>
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
										<input id="tozpom-show-embedded-border-{{id}}" name="[{{id}}][tozpom-show-embedded-border]" {{tozpom-show-embedded-border}} type="checkbox" value="true">
										<label for="tozpom-show-embedded-border-{{id}}">Yes</label>
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
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-tozpom="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="tozpom" level="1" margin-before="#tozpom-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="tozpom-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="tozpom-popup-location" data-dependency="tozpom-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="tozpom-popup-vertical-selection" data-dependency="tozpom-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-960-top]" type="text" value="{{tozpom-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="tozpom-popup-vertical-selection" data-dependency="tozpom-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-960-bottom]" type="text" value="{{tozpom-popup-960-bottom}}">
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
							<tr hide-toggle="tozpom-popup-horizontal-selection" data-dependency="tozpom-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-960-left]" type="text" value="{{tozpom-popup-960-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="tozpom-popup-horizontal-selection" data-dependency="tozpom-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-960-right]" type="text" value="{{tozpom-popup-960-right}}">
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
						<input size="4" name="[{{id}}][tozpom-width-960]" type="text" value="{{tozpom-width-960}}" preview-update-target-css="#tozpom-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][tozpom-height-960]" type="text" value="{{tozpom-height-960}}" preview-update-target-css="#tozpom-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-headline-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{tozpom-headline-960-advanced}}
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the headline"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-headline-960-margin-top]" type="text" value="{{tozpom-headline-960-margin-top}}" preview-update-target-css="#tozpom-preview-headline-960-{{id}}" preview-update-target-css-property-px="margin-top">
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-headline-960-margin-bottom]" type="text" value="{{tozpom-headline-960-margin-bottom}}" preview-update-target-css="#tozpom-preview-headline-960-{{id}}" preview-update-target-css-property-px="margin-bottom">
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-logo-img-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][tozpom-logo-img-960-width]" type="text" value="{{tozpom-logo-img-960-width}}" preview-update-target-css="#tozpom-preview-img-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][tozpom-logo-img-960-height]" type="text" value="{{tozpom-logo-img-960-height}}" preview-update-target-css="#tozpom-preview-img-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the logo image"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-logo-img-960-margin-top]" type="text" value="{{tozpom-logo-img-960-margin-top}}" preview-update-target-css="#tozpom-preview-img-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-logo-img-960-margin-bottom]" type="text" value="{{tozpom-logo-img-960-margin-bottom}}" preview-update-target-css="#tozpom-preview-img-960-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-input-name-960-{{id}}" hide-toggle="tozpom-hide-name-field" data-dependency="tozpom-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Name Input Style</div>
				{{tozpom-name-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-input-email-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing between the name and email input boxes"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-email-960-margin-top]" type="text" value="{{tozpom-email-960-margin-top}}" preview-update-target-css="#tozpom-preview-email-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{tozpom-email-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-subscribe-button-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{tozpom-subscribe-button-text-960-advanced}}
			</div>

			<div class="popupally-setting-section-sub-header">
				<div class="popupally-setting-section-sub-header">Subscribe Button Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the subscribe button"></div></div></div>
				<div>
					<span class="two-by-two-input">
					<label>Top</label>
					<input size="6" name="[{{id}}][tozpom-subscribe-button-960-margin-top]" type="text" value="{{tozpom-subscribe-button-960-margin-top}}" preview-update-target-css="#tozpom-preview-subscribe-button-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-subscribe-button-960-margin-bottom]" type="text" value="{{tozpom-subscribe-button-960-margin-bottom}}" preview-update-target-css="#tozpom-preview-subscribe-button-960-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-privacy-text-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Privacy Text Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the privacy text"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-privacy-text-960-margin-top]" type="text" value="{{tozpom-privacy-text-960-margin-top}}" preview-update-target-css="#tozpom-preview-privacy-text-960-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-privacy-text-960-margin-bottom]" type="text" value="{{tozpom-privacy-text-960-margin-bottom}}" preview-update-target-css="#tozpom-preview-privacy-text-960-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Privacy Text Style</div>
				{{tozpom-privacy-text-960-advanced}}
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-tozpom="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="tozpom" level="1" margin-before="#tozpom-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="tozpom-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="tozpom-popup-location" data-dependency="tozpom-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="tozpom-popup-vertical-selection" data-dependency="tozpom-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-640-top]" type="text" value="{{tozpom-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="tozpom-popup-vertical-selection" data-dependency="tozpom-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-640-bottom]" type="text" value="{{tozpom-popup-640-bottom}}">
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
							<tr hide-toggle="tozpom-popup-horizontal-selection" data-dependency="tozpom-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-640-left]" type="text" value="{{tozpom-popup-640-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="tozpom-popup-horizontal-selection" data-dependency="tozpom-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][tozpom-popup-640-right]" type="text" value="{{tozpom-popup-640-right}}">
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
						<input size="4" name="[{{id}}][tozpom-width-640]" type="text" value="{{tozpom-width-640}}" preview-update-target-css="#tozpom-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][tozpom-height-640]" type="text" value="{{tozpom-height-640}}" preview-update-target-css="#tozpom-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-headline-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{tozpom-headline-640-advanced}}
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the headline"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-headline-640-margin-top]" type="text" value="{{tozpom-headline-640-margin-top}}" preview-update-target-css="#tozpom-preview-headline-640-{{id}}" preview-update-target-css-property-px="margin-top">
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-headline-640-margin-bottom]" type="text" value="{{tozpom-headline-640-margin-bottom}}" preview-update-target-css="#tozpom-preview-headline-640-{{id}}" preview-update-target-css-property-px="margin-bottom">
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-logo-img-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][tozpom-logo-img-640-width]" type="text" value="{{tozpom-logo-img-640-width}}" preview-update-target-css="#tozpom-preview-img-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][tozpom-logo-img-640-height]" type="text" value="{{tozpom-logo-img-640-height}}" preview-update-target-css="#tozpom-preview-img-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Logo Image Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the logo image"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-logo-img-640-margin-top]" type="text" value="{{tozpom-logo-img-640-margin-top}}" preview-update-target-css="#tozpom-preview-img-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-logo-img-640-margin-bottom]" type="text" value="{{tozpom-logo-img-640-margin-bottom}}" preview-update-target-css="#tozpom-preview-img-640-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-input-name-640-{{id}}" hide-toggle="tozpom-hide-name-field" data-dependency="tozpom-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Name Input Style</div>
				{{tozpom-name-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-input-email-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing between the name and email imput boxes"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-email-640-margin-top]" type="text" value="{{tozpom-email-640-margin-top}}" preview-update-target-css="#tozpom-preview-email-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{tozpom-email-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-subscribe-button-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{tozpom-subscribe-button-text-640-advanced}}
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the subscribe button"></div></div></div>
				<div>
					<span class="two-by-two-input">
					<label>Top</label>
					<input size="6" name="[{{id}}][tozpom-subscribe-button-640-margin-top]" type="text" value="{{tozpom-subscribe-button-640-margin-top}}" preview-update-target-css="#tozpom-preview-subscribe-button-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-subscribe-button-640-margin-bottom]" type="text" value="{{tozpom-subscribe-button-640-margin-bottom}}" preview-update-target-css="#tozpom-preview-subscribe-button-640-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="tozpom-privacy-text-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Privacy Text Margin<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing above and below the privacy text"></div></div></div>
				<div>
					<span class="two-by-two-input">
						<label>Top</label>
						<input size="6" name="[{{id}}][tozpom-privacy-text-640-margin-top]" type="text" value="{{tozpom-privacy-text-640-margin-top}}" preview-update-target-css="#tozpom-preview-privacy-text-640-{{id}}" preview-update-target-css-property-px="margin-top">px
					</span>
					<span class="two-by-two-input">
						<label>Bottom</label>
						<input size="6" name="[{{id}}][tozpom-privacy-text-640-margin-bottom]" type="text" value="{{tozpom-privacy-text-640-margin-bottom}}" preview-update-target-css="#tozpom-preview-privacy-text-640-{{id}}" preview-update-target-css-property-px="margin-bottom">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Privacy Text Style</div>
				{{tozpom-privacy-text-640-advanced}}
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>