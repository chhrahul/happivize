<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-zewges-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-zewges" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-zewges-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-zewges" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-zewges-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-zewges" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-zewges="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="zewges" level="0" margin-before="#zewges-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="zewges" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" popup-id="{{id}}" template-id="zewges" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="zewges-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="zewges-location-selection-{{id}}" name="[{{id}}][zewges-popup-location]">
									{{zewges-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="zewges-popup-location" data-dependency="zewges-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="zewges-location-vertical-selection-{{id}}" name="[{{id}}][zewges-popup-vertical-selection]">
							{{zewges-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="zewges-popup-vertical-selection" data-dependency="zewges-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-top]" type="text" value="{{zewges-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="zewges-popup-vertical-selection" data-dependency="zewges-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-bottom]" type="text" value="{{zewges-popup-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="zewges-popup-location" data-dependency="zewges-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<div>
						Define horizontal position by distance to the
						<select popupally-change-source="zewges-location-horizontal-selection-{{id}}" name="[{{id}}][zewges-popup-horizontal-selection]">
							{{zewges-location-horizontal-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="zewges-popup-horizontal-selection" data-dependency="zewges-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-left]" type="text" value="{{zewges-popup-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="zewges-popup-horizontal-selection" data-dependency="zewges-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-right]" type="text" value="{{zewges-popup-right}}">
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
									<div><input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][zewges-background-color]" type="text" value="{{zewges-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-background-zewges-{{id}}" preview-update-target-css-property="background-color" data-default-color="#fefefe"></div>
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
									<input class="full-width" type="text" id="zewges-background-image-url-{{id}}" name="[{{id}}][zewges-background-image-url]" value="{{zewges-background-image-url}}" preview-update-target-css-background-img=".popupally-pro-outer-preview-background-zewges-{{id}}" />
									<div upload-image="#zewges-background-image-url-{{id}}">Upload Image</div>
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
					<select name="[{{id}}][zewges-background-image-size]" preview-update-target-css=".popupally-pro-outer-preview-background-zewges-{{id}}" preview-update-target-css-property="background-size">
						{{zewges-background-image-size}}
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
						<input size="4" name="[{{id}}][zewges-width]" type="text" value="{{zewges-width}}" preview-update-target-css="#zewges-popup-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-height]" type="text" value="{{zewges-height}}" preview-update-target-css="#zewges-popup-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-image-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="zewges-image-1-url-{{id}}" name="[{{id}}][zewges-image-1-url]" value="{{zewges-image-1-url}}" preview-update-target-css-background-img=".zewges-preview-image-1-{{id}}" image-dimension-attribute="zewges-image-1-{{id}}"/>
									<div upload-image="#zewges-image-1-url-{{id}}">Upload Image</div>
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
						<input size="4" name="[{{id}}][zewges-image-1-top]" type="text" value="{{zewges-image-1-top}}" preview-update-target-css="#zewges-preview-image-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-image-1-left]" type="text" value="{{zewges-image-1-left}}" preview-update-target-css="#zewges-preview-image-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="zewges-image-1-{{id}}-width" name="[{{id}}][zewges-image-1-width]" type="text" value="{{zewges-image-1-width}}" preview-update-target-css="#zewges-preview-image-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="zewges-image-1-{{id}}-height" name="[{{id}}][zewges-image-1-height]" type="text" value="{{zewges-image-1-height}}" preview-update-target-css="#zewges-preview-image-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-video-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 iFrame Code<div class="popupally-info-icon popupally-info-bubble"><div info="The embed code from Youtube/Vimeo/Wistia"></div></div></div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][zewges-video-1-iframe-code]" html-error-check="#zewges-video-1-iframe-code-error-{{id}}" preview-update-target=".zewges-preview-video-1-{{id}}">{{zewges-video-1-iframe-code}}</textarea>
					<small class="sign-up-error" id="zewges-video-1-iframe-code-error-{{id}}" popup-id="{{id}}" html-code-source="Video 1 iFrame Code"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-video-1-top]" type="text" value="{{zewges-video-1-top}}" preview-update-target-css="#zewges-preview-video-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-video-1-left]" type="text" value="{{zewges-video-1-left}}" preview-update-target-css="#zewges-preview-video-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-video-1-width]" type="text" value="{{zewges-video-1-width}}" preview-update-target-css="#zewges-preview-video-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-video-1-height]" type="text" value="{{zewges-video-1-height}}" preview-update-target-css="#zewges-preview-video-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-headline-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][zewges-headline]" html-error-check="#zewges-headline-error-{{id}}" preview-update-target=".zewges-preview-headline-{{id}}">{{zewges-headline}}</textarea>
					<small class="sign-up-error" id="zewges-headline-error-{{id}}" popup-id="{{id}}" html-code-source="Headline"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-headline-top]" type="text" value="{{zewges-headline-top}}" preview-update-target-css="#zewges-preview-headline-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-headline-left]" type="text" value="{{zewges-headline-left}}" preview-update-target-css="#zewges-preview-headline-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-headline-width]" type="text" value="{{zewges-headline-width}}" preview-update-target-css="#zewges-preview-headline-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-headline-height]" type="text" value="{{zewges-headline-height}}" preview-update-target-css="#zewges-preview-headline-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{zewges-headline-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-textbox-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][zewges-textbox-1]" html-error-check="#zewges-textbox-1-error-{{id}}" preview-update-target=".zewges-preview-textbox-1-{{id}}">{{zewges-textbox-1}}</textarea>
					<small class="sign-up-error" id="zewges-textbox-1-error-{{id}}" popup-id="{{id}}" html-code-source="Text Box 1"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-textbox-1-top]" type="text" value="{{zewges-textbox-1-top}}" preview-update-target-css="#zewges-preview-textbox-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-textbox-1-left]" type="text" value="{{zewges-textbox-1-left}}" preview-update-target-css="#zewges-preview-textbox-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-textbox-1-width]" type="text" value="{{zewges-textbox-1-width}}" preview-update-target-css="#zewges-preview-textbox-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-textbox-1-height]" type="text" value="{{zewges-textbox-1-height}}" preview-update-target-css="#zewges-preview-textbox-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{zewges-textbox-1-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-textbox-2-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][zewges-textbox-2]" html-error-check="#zewges-textbox-2-error-{{id}}" preview-update-target=".zewges-preview-textbox-2-{{id}}">{{zewges-textbox-2}}</textarea>
					<small class="sign-up-error" id="zewges-textbox-2-error-{{id}}" popup-id="{{id}}" html-code-source="Text Box 2"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-textbox-2-top]" type="text" value="{{zewges-textbox-2-top}}" preview-update-target-css="#zewges-preview-textbox-2-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-textbox-2-left]" type="text" value="{{zewges-textbox-2-left}}" preview-update-target-css="#zewges-preview-textbox-2-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-textbox-2-width]" type="text" value="{{zewges-textbox-2-width}}" preview-update-target-css="#zewges-preview-textbox-2-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-textbox-2-height]" type="text" value="{{zewges-textbox-2-height}}" preview-update-target-css="#zewges-preview-textbox-2-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{zewges-textbox-2-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-name-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide First Name Input Field</div>
				<div>
					<input popupally-change-source="zewges-hide-name-field-{{id}}" id="zewges-hide-name-field-{{id}}" name="[{{id}}][zewges-hide-name-field]" {{zewges-hide-name-field}} signup-form-hide="name" popup-id="{{id}}" template-id="zewges" type="checkbox" value="true" preview-update-target-hide-checked=".zewges-preview-name-{{id}}">
					<label for="zewges-hide-name-field-{{id}}">Yes</label>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="zewges-hide-name-field" data-dependency="zewges-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">First Name Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][zewges-name-placeholder]" type="text" value="{{zewges-name-placeholder}}" preview-update-target-placeholder=".zewges-preview-name-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-name-field-top]" type="text" value="{{zewges-name-field-top}}" preview-update-target-css="#zewges-preview-name-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-name-field-left]" type="text" value="{{zewges-name-field-left}}" preview-update-target-css="#zewges-preview-name-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="zewges-hide-name-field" data-dependency="zewges-hide-name-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">First Name Input Style</div>
				{{zewges-name-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-lname-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Hide Last Name Input Field</div>
				<div>
					<input popupally-change-source="zewges-hide-lname-field-{{id}}"id="zewges-hide-lname-field-{{id}}" name="[{{id}}][zewges-hide-lname-field]" {{zewges-hide-lname-field}} signup-form-hide="lname" popup-id="{{id}}" template-id="zewges" type="checkbox" value="true" preview-update-target-hide-checked=".zewges-preview-lname-{{id}}">
					<label for="zewges-hide-lname-field-{{id}}">Yes</label>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="zewges-hide-lname-field" data-dependency="zewges-hide-lname-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Last Name Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][zewges-lname-placeholder]" type="text" value="{{zewges-lname-placeholder}}" preview-update-target-placeholder=".zewges-preview-lname-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-lname-field-top]" type="text" value="{{zewges-lname-field-top}}" preview-update-target-css="#zewges-preview-lname-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-lname-field-left]" type="text" value="{{zewges-lname-field-left}}" preview-update-target-css="#zewges-preview-lname-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="zewges-hide-lname-field" data-dependency="zewges-hide-lname-field-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-sub-header">Last Name Input Style</div>
				{{zewges-lname-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-email-input-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Placeholder</div>
				<div>
					<input size="10" name="[{{id}}][zewges-email-placeholder]" type="text" value="{{zewges-email-placeholder}}" preview-update-target-placeholder=".zewges-preview-email-{{id}}">
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-email-field-top]" type="text" value="{{zewges-email-field-top}}" preview-update-target-css="#zewges-preview-email-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-email-field-left]" type="text" value="{{zewges-email-field-left}}" preview-update-target-css="#zewges-preview-email-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{zewges-email-field-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-subscribe-button-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text</div>
				<div>
					<input size="20" name="[{{id}}][zewges-subscribe-button-text]" type="text" value="{{zewges-subscribe-button-text}}" preview-update-target-value=".zewges-subscribe-button-{{id}}">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical Offset
							<input size="4" name="[{{id}}][zewges-subscribe-button-top]" type="text" value="{{zewges-subscribe-button-top}}" preview-update-target-css="#zewges-subscribe-button-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Horizontal Offset
							<input size="4" name="[{{id}}][zewges-subscribe-button-left]" type="text" value="{{zewges-subscribe-button-left}}" preview-update-target-css="#zewges-subscribe-button-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][zewges-subscribe-button-color]" type="text" value="{{zewges-subscribe-button-color}}" preview-update-target-css=".zewges-subscribe-button-{{id}}" preview-update-target-css-property="background-color" data-default-color="#00c98d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{zewges-subscribe-button-text-advanced}}
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
										<input popupally-change-source="zewges-hide-overlay-{{id}}" id="zewges-hide-overlay-{{id}}" name="[{{id}}][zewges-hide-overlay]" {{zewges-hide-overlay}} type="checkbox" value="true">
										<label for="zewges-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="zewges-hide-overlay" data-dependency="zewges-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][zewges-overlay-color]" type="text" value="{{zewges-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][zewges-overlay-opacity]" type="text" value="{{zewges-overlay-opacity}}">
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
											<input id="zewges-disable-overlay-close-{{id}}" name="[{{id}}][zewges-disable-overlay-close]" {{zewges-disable-overlay-close}} type="checkbox" value="true">
											<label for="zewges-disable-overlay-close-{{id}}">Yes</label>
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
										<input id="zewges-show-embedded-border-{{id}}" name="[{{id}}][zewges-show-embedded-border]" {{zewges-show-embedded-border}} type="checkbox" value="true">
										<label for="zewges-show-embedded-border-{{id}}">Yes</label>
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
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-zewges="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="zewges" level="1" margin-before="#zewges-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="zewges-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="zewges-popup-location" data-dependency="zewges-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="zewges-popup-vertical-selection" data-dependency="zewges-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-960-top]" type="text" value="{{zewges-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="zewges-popup-vertical-selection" data-dependency="zewges-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-960-bottom]" type="text" value="{{zewges-popup-960-bottom}}">
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
							<tr hide-toggle="zewges-popup-horizontal-selection" data-dependency="zewges-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-960-left]" type="text" value="{{zewges-popup-960-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="zewges-popup-horizontal-selection" data-dependency="zewges-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-960-right]" type="text" value="{{zewges-popup-960-right}}">
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
						<input size="4" name="[{{id}}][zewges-width-960]" type="text" value="{{zewges-width-960}}" preview-update-target-css="#zewges-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-height-960]" type="text" value="{{zewges-height-960}}" preview-update-target-css="#zewges-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-image-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-image-1-960-top]" type="text" value="{{zewges-image-1-960-top}}" preview-update-target-css="#zewges-preview-image-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-image-1-960-left]" type="text" value="{{zewges-image-1-960-left}}" preview-update-target-css="#zewges-preview-image-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-image-1-960-width]" type="text" value="{{zewges-image-1-960-width}}" preview-update-target-css="#zewges-preview-image-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-image-1-960-height]" type="text" value="{{zewges-image-1-960-height}}" preview-update-target-css="#zewges-preview-image-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-video-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-video-1-960-top]" type="text" value="{{zewges-video-1-960-top}}" preview-update-target-css="#zewges-preview-video-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-video-1-960-left]" type="text" value="{{zewges-video-1-960-left}}" preview-update-target-css="#zewges-preview-video-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-video-1-960-width]" type="text" value="{{zewges-video-1-960-width}}" preview-update-target-css="#zewges-preview-video-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-video-1-960-height]" type="text" value="{{zewges-video-1-960-height}}" preview-update-target-css="#zewges-preview-video-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-headline-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-headline-960-top]" type="text" value="{{zewges-headline-960-top}}" preview-update-target-css="#zewges-preview-headline-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-headline-960-left]" type="text" value="{{zewges-headline-960-left}}" preview-update-target-css="#zewges-preview-headline-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-headline-960-width]" type="text" value="{{zewges-headline-960-width}}" preview-update-target-css="#zewges-preview-headline-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-headline-960-height]" type="text" value="{{zewges-headline-960-height}}" preview-update-target-css="#zewges-preview-headline-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{zewges-headline-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-textbox-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-textbox-1-960-top]" type="text" value="{{zewges-textbox-1-960-top}}" preview-update-target-css="#zewges-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-textbox-1-960-left]" type="text" value="{{zewges-textbox-1-960-left}}" preview-update-target-css="#zewges-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-textbox-1-960-width]" type="text" value="{{zewges-textbox-1-960-width}}" preview-update-target-css="#zewges-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-textbox-1-960-height]" type="text" value="{{zewges-textbox-1-960-height}}" preview-update-target-css="#zewges-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{zewges-textbox-1-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-textbox-2-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-textbox-2-960-top]" type="text" value="{{zewges-textbox-2-960-top}}" preview-update-target-css="#zewges-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-textbox-2-960-left]" type="text" value="{{zewges-textbox-2-960-left}}" preview-update-target-css="#zewges-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-textbox-2-960-width]" type="text" value="{{zewges-textbox-2-960-width}}" preview-update-target-css="#zewges-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-textbox-2-960-height]" type="text" value="{{zewges-textbox-2-960-height}}" preview-update-target-css="#zewges-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{zewges-textbox-2-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-name-input-960-{{id}}" hide-toggle="zewges-hide-name-field" data-dependency="zewges-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-name-field-960-top]" type="text" value="{{zewges-name-field-960-top}}" preview-update-target-css="#zewges-preview-name-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-name-field-960-left]" type="text" value="{{zewges-name-field-960-left}}" preview-update-target-css="#zewges-preview-name-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Style</div>
				{{zewges-name-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-lname-input-960-{{id}}" hide-toggle="zewges-hide-lname-field" data-dependency="zewges-hide-lname-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-lname-field-960-top]" type="text" value="{{zewges-lname-field-960-top}}" preview-update-target-css="#zewges-preview-lname-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-lname-field-960-left]" type="text" value="{{zewges-lname-field-960-left}}" preview-update-target-css="#zewges-preview-lname-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Style</div>
				{{zewges-lname-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-email-input-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-email-field-960-top]" type="text" value="{{zewges-email-field-960-top}}" preview-update-target-css="#zewges-preview-email-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-email-field-960-left]" type="text" value="{{zewges-email-field-960-left}}" preview-update-target-css="#zewges-preview-email-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{zewges-email-field-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-subscribe-button-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical Offset
							<input size="4" name="[{{id}}][zewges-subscribe-button-960-top]" type="text" value="{{zewges-subscribe-button-960-top}}" preview-update-target-css="#zewges-subscribe-button-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Horizontal Offset
							<input size="4" name="[{{id}}][zewges-subscribe-button-960-left]" type="text" value="{{zewges-subscribe-button-960-left}}" preview-update-target-css="#zewges-subscribe-button-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{zewges-subscribe-button-text-960-advanced}}
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-zewges="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="zewges" level="1" margin-before="#zewges-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="zewges-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="zewges-popup-location" data-dependency="zewges-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="zewges-popup-vertical-selection" data-dependency="zewges-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-640-top]" type="text" value="{{zewges-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="zewges-popup-vertical-selection" data-dependency="zewges-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-640-bottom]" type="text" value="{{zewges-popup-640-bottom}}">
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
							<tr hide-toggle="zewges-popup-horizontal-selection" data-dependency="zewges-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-640-left]" type="text" value="{{zewges-popup-640-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="zewges-popup-horizontal-selection" data-dependency="zewges-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][zewges-popup-640-right]" type="text" value="{{zewges-popup-640-right}}">
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
						<input size="4" name="[{{id}}][zewges-width-640]" type="text" value="{{zewges-width-640}}" preview-update-target-css="#zewges-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-height-640]" type="text" value="{{zewges-height-640}}" preview-update-target-css="#zewges-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-image-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-image-1-640-top]" type="text" value="{{zewges-image-1-640-top}}" preview-update-target-css="#zewges-preview-image-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-image-1-640-left]" type="text" value="{{zewges-image-1-640-left}}" preview-update-target-css="#zewges-preview-image-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-image-1-640-width]" type="text" value="{{zewges-image-1-640-width}}" preview-update-target-css="#zewges-preview-image-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-image-1-640-height]" type="text" value="{{zewges-image-1-640-height}}" preview-update-target-css="#zewges-preview-image-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-video-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-video-1-640-top]" type="text" value="{{zewges-video-1-640-top}}" preview-update-target-css="#zewges-preview-video-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-video-1-640-left]" type="text" value="{{zewges-video-1-640-left}}" preview-update-target-css="#zewges-preview-video-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Video 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-video-1-640-width]" type="text" value="{{zewges-video-1-640-width}}" preview-update-target-css="#zewges-preview-video-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-video-1-640-height]" type="text" value="{{zewges-video-1-640-height}}" preview-update-target-css="#zewges-preview-video-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-headline-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-headline-640-top]" type="text" value="{{zewges-headline-640-top}}" preview-update-target-css="#zewges-preview-headline-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-headline-640-left]" type="text" value="{{zewges-headline-640-left}}" preview-update-target-css="#zewges-preview-headline-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-headline-640-width]" type="text" value="{{zewges-headline-640-width}}" preview-update-target-css="#zewges-preview-headline-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-headline-640-height]" type="text" value="{{zewges-headline-640-height}}" preview-update-target-css="#zewges-preview-headline-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{zewges-headline-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-textbox-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-textbox-1-640-top]" type="text" value="{{zewges-textbox-1-640-top}}" preview-update-target-css="#zewges-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-textbox-1-640-left]" type="text" value="{{zewges-textbox-1-640-left}}" preview-update-target-css="#zewges-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-textbox-1-640-width]" type="text" value="{{zewges-textbox-1-640-width}}" preview-update-target-css="#zewges-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-textbox-1-640-height]" type="text" value="{{zewges-textbox-1-640-height}}" preview-update-target-css="#zewges-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{zewges-textbox-1-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-textbox-2-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][zewges-textbox-2-640-top]" type="text" value="{{zewges-textbox-2-640-top}}" preview-update-target-css="#zewges-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][zewges-textbox-2-640-left]" type="text" value="{{zewges-textbox-2-640-left}}" preview-update-target-css="#zewges-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][zewges-textbox-2-640-width]" type="text" value="{{zewges-textbox-2-640-width}}" preview-update-target-css="#zewges-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][zewges-textbox-2-640-height]" type="text" value="{{zewges-textbox-2-640-height}}" preview-update-target-css="#zewges-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{zewges-textbox-2-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-name-input-640-{{id}}" hide-toggle="zewges-hide-name-field" data-dependency="zewges-hide-name-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-name-field-640-top]" type="text" value="{{zewges-name-field-640-top}}" preview-update-target-css="#zewges-preview-name-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-name-field-640-left]" type="text" value="{{zewges-name-field-640-left}}" preview-update-target-css="#zewges-preview-name-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">First Name Input Style</div>
				{{zewges-name-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-lname-input-640-{{id}}" hide-toggle="zewges-hide-lname-field" data-dependency="zewges-hide-lname-field-{{id}}" data-dependency-value="false">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-lname-field-640-top]" type="text" value="{{zewges-lname-field-640-top}}" preview-update-target-css="#zewges-preview-lname-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-lname-field-640-left]" type="text" value="{{zewges-lname-field-640-left}}" preview-update-target-css="#zewges-preview-lname-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Last Name Input Style</div>
				{{zewges-lname-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-email-input-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][zewges-email-field-640-top]" type="text" value="{{zewges-email-field-640-top}}" preview-update-target-css="#zewges-preview-email-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][zewges-email-field-640-left]" type="text" value="{{zewges-email-field-640-left}}" preview-update-target-css="#zewges-preview-email-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email Input Style</div>
				{{zewges-email-field-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="zewges-config-subscribe-button-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical Offset
							<input size="4" name="[{{id}}][zewges-subscribe-button-640-top]" type="text" value="{{zewges-subscribe-button-640-top}}" preview-update-target-css="#zewges-subscribe-button-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span class="two-by-two-input">
							Horizontal Offset
							<input size="4" name="[{{id}}][zewges-subscribe-button-640-left]" type="text" value="{{zewges-subscribe-button-640-left}}" preview-update-target-css="#zewges-subscribe-button-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Subscribe Button Text Style</div>
				{{zewges-subscribe-button-text-640-advanced}}
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>