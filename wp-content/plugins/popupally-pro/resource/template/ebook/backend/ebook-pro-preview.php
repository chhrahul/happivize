<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-khwybd-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-khwybd" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-khwybd-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-khwybd" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-khwybd-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-khwybd" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-khwybd="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="khwybd" level="0" margin-before="#khwybd-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="khwybd" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="khwybd" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="khwybd-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="khwybd-location-selection-{{id}}" name="[{{id}}][khwybd-popup-location]">
									{{khwybd-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="khwybd-popup-location" data-dependency="khwybd-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="khwybd-location-vertical-selection-{{id}}" name="[{{id}}][khwybd-popup-vertical-selection]">
							{{khwybd-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="khwybd-popup-vertical-selection" data-dependency="khwybd-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-top]" type="text" value="{{khwybd-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="khwybd-popup-vertical-selection" data-dependency="khwybd-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-bottom]" type="text" value="{{khwybd-popup-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="khwybd-popup-location" data-dependency="khwybd-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<div>
						Define horizontal position by distance to the
						<select popupally-change-source="khwybd-location-horizontal-selection-{{id}}" name="[{{id}}][khwybd-popup-horizontal-selection]">
							{{khwybd-location-horizontal-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="khwybd-popup-horizontal-selection" data-dependency="khwybd-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-left]" type="text" value="{{khwybd-popup-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="khwybd-popup-horizontal-selection" data-dependency="khwybd-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-right]" type="text" value="{{khwybd-popup-right}}">
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
									<div><input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][khwybd-background-color]" type="text" value="{{khwybd-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-background-khwybd-{{id}}" preview-update-target-css-property="background-color" data-default-color="#fefefe"></div>
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
									<input class="full-width" type="text" id="khwybd-background-image-url-{{id}}" name="[{{id}}][khwybd-background-image-url]" value="{{khwybd-background-image-url}}" preview-update-target-css-background-img=".popupally-pro-outer-preview-background-khwybd-{{id}}" />
									<div upload-image="#khwybd-background-image-url-{{id}}">Upload Image</div>
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
					<select name="[{{id}}][khwybd-background-image-size]" preview-update-target-css=".popupally-pro-outer-preview-background-khwybd-{{id}}" preview-update-target-css-property="background-size">
						{{khwybd-background-image-size}}
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
						<input size="4" name="[{{id}}][khwybd-width]" type="text" value="{{khwybd-width}}" preview-update-target-css="#khwybd-popup-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-height]" type="text" value="{{khwybd-height}}" preview-update-target-css="#khwybd-popup-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-image-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="khwybd-image-1-url-{{id}}" name="[{{id}}][khwybd-image-1-url]" value="{{khwybd-image-1-url}}" preview-update-target-css-background-img=".khwybd-preview-image-1-{{id}}" image-dimension-attribute="khwybd-image-1-{{id}}"/>
									<div upload-image="#khwybd-image-1-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to use Image 1.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-image-1-top]" type="text" value="{{khwybd-image-1-top}}" preview-update-target-css="#khwybd-preview-image-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-image-1-left]" type="text" value="{{khwybd-image-1-left}}" preview-update-target-css="#khwybd-preview-image-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="khwybd-image-1-{{id}}-width" name="[{{id}}][khwybd-image-1-width]" type="text" value="{{khwybd-image-1-width}}" preview-update-target-css="#khwybd-preview-image-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="khwybd-image-1-{{id}}-height" name="[{{id}}][khwybd-image-1-height]" type="text" value="{{khwybd-image-1-height}}" preview-update-target-css="#khwybd-preview-image-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-image-2-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="khwybd-image-2-url-{{id}}" name="[{{id}}][khwybd-image-2-url]" value="{{khwybd-image-2-url}}" preview-update-target-css-background-img=".khwybd-preview-image-2-{{id}}" image-dimension-attribute="khwybd-image-2-{{id}}" />
									<div upload-image="#khwybd-image-2-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to use Image 2.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-image-2-top]" type="text" value="{{khwybd-image-2-top}}" preview-update-target-css="#khwybd-preview-image-2-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-image-2-left]" type="text" value="{{khwybd-image-2-left}}" preview-update-target-css="#khwybd-preview-image-2-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="khwybd-image-2-{{id}}-width" name="[{{id}}][khwybd-image-2-width]" type="text" value="{{khwybd-image-2-width}}" preview-update-target-css="#khwybd-preview-image-2-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="khwybd-image-2-{{id}}-height" name="[{{id}}][khwybd-image-2-height]" type="text" value="{{khwybd-image-2-height}}" preview-update-target-css="#khwybd-preview-image-2-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-headline-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][khwybd-headline]" html-error-check="#khwybd-headline-error-{{id}}" preview-update-target=".khwybd-preview-headline-{{id}}">{{khwybd-headline}}</textarea>
					<small class="sign-up-error" id="khwybd-headline-error-{{id}}" popup-id="{{id}}" html-code-source="Headline"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-headline-top]" type="text" value="{{khwybd-headline-top}}" preview-update-target-css="#khwybd-preview-headline-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-headline-left]" type="text" value="{{khwybd-headline-left}}" preview-update-target-css="#khwybd-preview-headline-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-headline-width]" type="text" value="{{khwybd-headline-width}}" preview-update-target-css="#khwybd-preview-headline-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-headline-height]" type="text" value="{{khwybd-headline-height}}" preview-update-target-css="#khwybd-preview-headline-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{khwybd-headline-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-textbox-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][khwybd-textbox-1]" html-error-check="#khwybd-textbox-1-error-{{id}}" preview-update-target=".khwybd-preview-textbox-1-{{id}}">{{khwybd-textbox-1}}</textarea>
					<small class="sign-up-error" id="khwybd-textbox-1-error-{{id}}" popup-id="{{id}}" html-code-source="Text Box 1"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-textbox-1-top]" type="text" value="{{khwybd-textbox-1-top}}" preview-update-target-css="#khwybd-preview-textbox-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-textbox-1-left]" type="text" value="{{khwybd-textbox-1-left}}" preview-update-target-css="#khwybd-preview-textbox-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-textbox-1-width]" type="text" value="{{khwybd-textbox-1-width}}" preview-update-target-css="#khwybd-preview-textbox-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-textbox-1-height]" type="text" value="{{khwybd-textbox-1-height}}" preview-update-target-css="#khwybd-preview-textbox-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{khwybd-textbox-1-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-textbox-2-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][khwybd-textbox-2]" html-error-check="#khwybd-textbox-2-error-{{id}}" preview-update-target=".khwybd-preview-textbox-2-{{id}}">{{khwybd-textbox-2}}</textarea>
					<small class="sign-up-error" id="khwybd-textbox-2-error-{{id}}" popup-id="{{id}}" html-code-source="Text Box 2"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-textbox-2-top]" type="text" value="{{khwybd-textbox-2-top}}" preview-update-target-css="#khwybd-preview-textbox-2-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-textbox-2-left]" type="text" value="{{khwybd-textbox-2-left}}" preview-update-target-css="#khwybd-preview-textbox-2-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-textbox-2-width]" type="text" value="{{khwybd-textbox-2-width}}" preview-update-target-css="#khwybd-preview-textbox-2-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-textbox-2-height]" type="text" value="{{khwybd-textbox-2-height}}" preview-update-target-css="#khwybd-preview-textbox-2-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{khwybd-textbox-2-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-name-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide First Name Input Field</div>
				<div>
					<input popupally-change-source="khwybd-hide-name-field-{{id}}" id="khwybd-hide-name-field-{{id}}" name="[{{id}}][khwybd-hide-name-field]" {{khwybd-hide-name-field}} signup-form-hide="name" popup-id="{{id}}" template-id="khwybd" type="checkbox" value="true" preview-update-target-hide-checked=".khwybd-preview-name-{{id}}">
					<label for="khwybd-hide-name-field-{{id}}">Yes</label>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="khwybd-hide-name-field" data-dependency="khwybd-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">First Name Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][khwybd-name-placeholder]" type="text" value="{{khwybd-name-placeholder}}" preview-update-target-placeholder=".khwybd-preview-name-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-name-field-top]" type="text" value="{{khwybd-name-field-top}}" preview-update-target-css="#khwybd-preview-name-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-name-field-left]" type="text" value="{{khwybd-name-field-left}}" preview-update-target-css="#khwybd-preview-name-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="khwybd-hide-name-field" data-dependency="khwybd-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">First Name Input Style</div>
				{{khwybd-name-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-lname-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide Last Name Input Field</div>
				<div>
					<input popupally-change-source="khwybd-hide-lname-field-{{id}}" id="khwybd-hide-lname-field-{{id}}" name="[{{id}}][khwybd-hide-lname-field]" {{khwybd-hide-lname-field}} signup-form-hide="lname" popup-id="{{id}}" template-id="khwybd" type="checkbox" value="true" preview-update-target-hide-checked=".khwybd-preview-lname-{{id}}">
					<label for="khwybd-hide-lname-field-{{id}}">Yes</label>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="khwybd-hide-lname-field" data-dependency="khwybd-hide-lname-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Last Name Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][khwybd-lname-placeholder]" type="text" value="{{khwybd-lname-placeholder}}" preview-update-target-placeholder=".khwybd-preview-lname-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-lname-field-top]" type="text" value="{{khwybd-lname-field-top}}" preview-update-target-css="#khwybd-preview-lname-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-lname-field-left]" type="text" value="{{khwybd-lname-field-left}}" preview-update-target-css="#khwybd-preview-lname-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="khwybd-hide-lname-field" data-dependency="khwybd-hide-lname-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Last Name Input Style</div>
				{{khwybd-lname-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-email-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][khwybd-email-placeholder]" type="text" value="{{khwybd-email-placeholder}}" preview-update-target-placeholder=".khwybd-preview-email-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-email-field-top]" type="text" value="{{khwybd-email-field-top}}" preview-update-target-css="#khwybd-preview-email-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-email-field-left]" type="text" value="{{khwybd-email-field-left}}" preview-update-target-css="#khwybd-preview-email-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{khwybd-email-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-subscribe-button-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text</div>
				<div>
					<input size="20" name="[{{id}}][khwybd-subscribe-button-text]" type="text" value="{{khwybd-subscribe-button-text}}" preview-update-target-value=".khwybd-subscribe-button-{{id}}">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical Offset
							<input size="4" name="[{{id}}][khwybd-subscribe-button-top]" type="text" value="{{khwybd-subscribe-button-top}}" preview-update-target-css="#khwybd-subscribe-button-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Horizontal Offset
							<input size="4" name="[{{id}}][khwybd-subscribe-button-left]" type="text" value="{{khwybd-subscribe-button-left}}" preview-update-target-css="#khwybd-subscribe-button-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][khwybd-subscribe-button-color]" type="text" value="{{khwybd-subscribe-button-color}}" preview-update-target-css=".khwybd-subscribe-button-{{id}}" preview-update-target-css-property="background-color" data-default-color="#00c98d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{khwybd-subscribe-button-text-advanced}}
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
										<input popupally-change-source="khwybd-hide-overlay-{{id}}" id="khwybd-hide-overlay-{{id}}" name="[{{id}}][khwybd-hide-overlay]" {{khwybd-hide-overlay}} type="checkbox" value="true">
										<label for="khwybd-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="khwybd-hide-overlay" data-dependency="khwybd-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][khwybd-overlay-color]" type="text" value="{{khwybd-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][khwybd-overlay-opacity]" type="text" value="{{khwybd-overlay-opacity}}">
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
											<input id="khwybd-disable-overlay-close-{{id}}" name="[{{id}}][khwybd-disable-overlay-close]" {{khwybd-disable-overlay-close}} type="checkbox" value="true">
											<label for="khwybd-disable-overlay-close-{{id}}">Yes</label>
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
										<input id="khwybd-show-embedded-border-{{id}}" name="[{{id}}][khwybd-show-embedded-border]" {{khwybd-show-embedded-border}} type="checkbox" value="true">
										<label for="khwybd-show-embedded-border-{{id}}">Yes</label>
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
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-khwybd="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="khwybd" level="1" margin-before="#khwybd-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="khwybd-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="khwybd-popup-location" data-dependency="khwybd-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="khwybd-popup-vertical-selection" data-dependency="khwybd-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-960-top]" type="text" value="{{khwybd-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="khwybd-popup-vertical-selection" data-dependency="khwybd-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-960-bottom]" type="text" value="{{khwybd-popup-960-bottom}}">
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
							<tr hide-toggle="khwybd-popup-horizontal-selection" data-dependency="khwybd-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-960-left]" type="text" value="{{khwybd-popup-960-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="khwybd-popup-horizontal-selection" data-dependency="khwybd-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-960-right]" type="text" value="{{khwybd-popup-960-right}}">
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
						<input size="4" name="[{{id}}][khwybd-width-960]" type="text" value="{{khwybd-width-960}}" preview-update-target-css="#khwybd-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-height-960]" type="text" value="{{khwybd-height-960}}" preview-update-target-css="#khwybd-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-image-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-image-1-960-top]" type="text" value="{{khwybd-image-1-960-top}}" preview-update-target-css="#khwybd-preview-image-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-image-1-960-left]" type="text" value="{{khwybd-image-1-960-left}}" preview-update-target-css="#khwybd-preview-image-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-image-1-960-width]" type="text" value="{{khwybd-image-1-960-width}}" preview-update-target-css="#khwybd-preview-image-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-image-1-960-height]" type="text" value="{{khwybd-image-1-960-height}}" preview-update-target-css="#khwybd-preview-image-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-image-2-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-image-2-960-top]" type="text" value="{{khwybd-image-2-960-top}}" preview-update-target-css="#khwybd-preview-image-2-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-image-2-960-left]" type="text" value="{{khwybd-image-2-960-left}}" preview-update-target-css="#khwybd-preview-image-2-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-image-2-960-width]" type="text" value="{{khwybd-image-2-960-width}}" preview-update-target-css="#khwybd-preview-image-2-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-image-2-960-height]" type="text" value="{{khwybd-image-2-960-height}}" preview-update-target-css="#khwybd-preview-image-2-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-headline-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-headline-960-top]" type="text" value="{{khwybd-headline-960-top}}" preview-update-target-css="#khwybd-preview-headline-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-headline-960-left]" type="text" value="{{khwybd-headline-960-left}}" preview-update-target-css="#khwybd-preview-headline-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-headline-960-width]" type="text" value="{{khwybd-headline-960-width}}" preview-update-target-css="#khwybd-preview-headline-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-headline-960-height]" type="text" value="{{khwybd-headline-960-height}}" preview-update-target-css="#khwybd-preview-headline-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{khwybd-headline-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-textbox-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-textbox-1-960-top]" type="text" value="{{khwybd-textbox-1-960-top}}" preview-update-target-css="#khwybd-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-textbox-1-960-left]" type="text" value="{{khwybd-textbox-1-960-left}}" preview-update-target-css="#khwybd-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-textbox-1-960-width]" type="text" value="{{khwybd-textbox-1-960-width}}" preview-update-target-css="#khwybd-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-textbox-1-960-height]" type="text" value="{{khwybd-textbox-1-960-height}}" preview-update-target-css="#khwybd-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{khwybd-textbox-1-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-textbox-2-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-textbox-2-960-top]" type="text" value="{{khwybd-textbox-2-960-top}}" preview-update-target-css="#khwybd-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-textbox-2-960-left]" type="text" value="{{khwybd-textbox-2-960-left}}" preview-update-target-css="#khwybd-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-textbox-2-960-width]" type="text" value="{{khwybd-textbox-2-960-width}}" preview-update-target-css="#khwybd-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-textbox-2-960-height]" type="text" value="{{khwybd-textbox-2-960-height}}" preview-update-target-css="#khwybd-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{khwybd-textbox-2-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-name-input-960-{{id}}" hide-toggle="khwybd-hide-name-field" data-dependency="khwybd-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-name-field-960-top]" type="text" value="{{khwybd-name-field-960-top}}" preview-update-target-css="#khwybd-preview-name-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-name-field-960-left]" type="text" value="{{khwybd-name-field-960-left}}" preview-update-target-css="#khwybd-preview-name-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Style</div>
				{{khwybd-name-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-lname-input-960-{{id}}" hide-toggle="khwybd-hide-lname-field" data-dependency="khwybd-hide-lname-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-lname-field-960-top]" type="text" value="{{khwybd-lname-field-960-top}}" preview-update-target-css="#khwybd-preview-lname-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-lname-field-960-left]" type="text" value="{{khwybd-lname-field-960-left}}" preview-update-target-css="#khwybd-preview-lname-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Style</div>
				{{khwybd-lname-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-email-input-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-email-field-960-top]" type="text" value="{{khwybd-email-field-960-top}}" preview-update-target-css="#khwybd-preview-email-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-email-field-960-left]" type="text" value="{{khwybd-email-field-960-left}}" preview-update-target-css="#khwybd-preview-email-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{khwybd-email-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-subscribe-button-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical Offset
							<input size="4" name="[{{id}}][khwybd-subscribe-button-960-top]" type="text" value="{{khwybd-subscribe-button-960-top}}" preview-update-target-css="#khwybd-subscribe-button-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Horizontal Offset
							<input size="4" name="[{{id}}][khwybd-subscribe-button-960-left]" type="text" value="{{khwybd-subscribe-button-960-left}}" preview-update-target-css="#khwybd-subscribe-button-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{khwybd-subscribe-button-text-960-advanced}}
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-khwybd="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="khwybd" level="1" margin-before="#khwybd-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="khwybd-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="khwybd-popup-location" data-dependency="khwybd-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="khwybd-popup-vertical-selection" data-dependency="khwybd-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-640-top]" type="text" value="{{khwybd-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="khwybd-popup-vertical-selection" data-dependency="khwybd-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-640-bottom]" type="text" value="{{khwybd-popup-640-bottom}}">
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
							<tr hide-toggle="khwybd-popup-horizontal-selection" data-dependency="khwybd-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-640-left]" type="text" value="{{khwybd-popup-640-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="khwybd-popup-horizontal-selection" data-dependency="khwybd-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][khwybd-popup-640-right]" type="text" value="{{khwybd-popup-640-right}}">
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
						<input size="4" name="[{{id}}][khwybd-width-640]" type="text" value="{{khwybd-width-640}}" preview-update-target-css="#khwybd-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-height-640]" type="text" value="{{khwybd-height-640}}" preview-update-target-css="#khwybd-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-image-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-image-1-640-top]" type="text" value="{{khwybd-image-1-640-top}}" preview-update-target-css="#khwybd-preview-image-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-image-1-640-left]" type="text" value="{{khwybd-image-1-640-left}}" preview-update-target-css="#khwybd-preview-image-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-image-1-640-width]" type="text" value="{{khwybd-image-1-640-width}}" preview-update-target-css="#khwybd-preview-image-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-image-1-640-height]" type="text" value="{{khwybd-image-1-640-height}}" preview-update-target-css="#khwybd-preview-image-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-image-2-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-image-2-640-top]" type="text" value="{{khwybd-image-2-640-top}}" preview-update-target-css="#khwybd-preview-image-2-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-image-2-640-left]" type="text" value="{{khwybd-image-2-640-left}}" preview-update-target-css="#khwybd-preview-image-2-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-image-2-640-width]" type="text" value="{{khwybd-image-2-640-width}}" preview-update-target-css="#khwybd-preview-image-2-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-image-2-640-height]" type="text" value="{{khwybd-image-2-640-height}}" preview-update-target-css="#khwybd-preview-image-2-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-headline-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-headline-640-top]" type="text" value="{{khwybd-headline-640-top}}" preview-update-target-css="#khwybd-preview-headline-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-headline-640-left]" type="text" value="{{khwybd-headline-640-left}}" preview-update-target-css="#khwybd-preview-headline-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-headline-640-width]" type="text" value="{{khwybd-headline-640-width}}" preview-update-target-css="#khwybd-preview-headline-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-headline-640-height]" type="text" value="{{khwybd-headline-640-height}}" preview-update-target-css="#khwybd-preview-headline-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{khwybd-headline-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-textbox-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-textbox-1-640-top]" type="text" value="{{khwybd-textbox-1-640-top}}" preview-update-target-css="#khwybd-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-textbox-1-640-left]" type="text" value="{{khwybd-textbox-1-640-left}}" preview-update-target-css="#khwybd-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-textbox-1-640-width]" type="text" value="{{khwybd-textbox-1-640-width}}" preview-update-target-css="#khwybd-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-textbox-1-640-height]" type="text" value="{{khwybd-textbox-1-640-height}}" preview-update-target-css="#khwybd-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{khwybd-textbox-1-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-textbox-2-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][khwybd-textbox-2-640-top]" type="text" value="{{khwybd-textbox-2-640-top}}" preview-update-target-css="#khwybd-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][khwybd-textbox-2-640-left]" type="text" value="{{khwybd-textbox-2-640-left}}" preview-update-target-css="#khwybd-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][khwybd-textbox-2-640-width]" type="text" value="{{khwybd-textbox-2-640-width}}" preview-update-target-css="#khwybd-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][khwybd-textbox-2-640-height]" type="text" value="{{khwybd-textbox-2-640-height}}" preview-update-target-css="#khwybd-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{khwybd-textbox-2-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-name-input-640-{{id}}" hide-toggle="khwybd-hide-name-field" data-dependency="khwybd-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-name-field-640-top]" type="text" value="{{khwybd-name-field-640-top}}" preview-update-target-css="#khwybd-preview-name-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-name-field-640-left]" type="text" value="{{khwybd-name-field-640-left}}" preview-update-target-css="#khwybd-preview-name-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Style</div>
				{{khwybd-name-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-lname-input-640-{{id}}" hide-toggle="khwybd-hide-lname-field" data-dependency="khwybd-hide-lname-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-lname-field-640-top]" type="text" value="{{khwybd-lname-field-640-top}}" preview-update-target-css="#khwybd-preview-lname-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-lname-field-640-left]" type="text" value="{{khwybd-lname-field-640-left}}" preview-update-target-css="#khwybd-preview-lname-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Style</div>
				{{khwybd-lname-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-email-input-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][khwybd-email-field-640-top]" type="text" value="{{khwybd-email-field-640-top}}" preview-update-target-css="#khwybd-preview-email-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][khwybd-email-field-640-left]" type="text" value="{{khwybd-email-field-640-left}}" preview-update-target-css="#khwybd-preview-email-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{khwybd-email-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="khwybd-config-subscribe-button-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical Offset
							<input size="4" name="[{{id}}][khwybd-subscribe-button-640-top]" type="text" value="{{khwybd-subscribe-button-640-top}}" preview-update-target-css="#khwybd-subscribe-button-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Horizontal Offset
							<input size="4" name="[{{id}}][khwybd-subscribe-button-640-left]" type="text" value="{{khwybd-subscribe-button-640-left}}" preview-update-target-css="#khwybd-subscribe-button-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{khwybd-subscribe-button-text-640-advanced}}
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>