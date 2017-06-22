<table class="popupally-style-responsive-container">
	<tbody>
		<tr class="popupally-style-responsive-top-row">
			<td id="popupally-fluid-responsive-header-{{id}}-iejsye-0" class="popupally-style-responsive-tab-label-col popupally-style-responsive-tab-active"
				tab-group="popupally-responsive-tab-group-{{id}}-iejsye" target="0" active-class="popupally-style-responsive-tab-active">
				Desktop
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-iejsye-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-iejsye" target="1" active-class="popupally-style-responsive-tab-active">
				Tablets
			</td>
			<td id="popupally-fluid-responsive-header-{{id}}-iejsye-0" class="popupally-style-responsive-tab-label-col"
				tab-group="popupally-responsive-tab-group-{{id}}-iejsye" target="2" active-class="popupally-style-responsive-tab-active">
				Mobile Phones
			</td>
		</tr>
		<tr>
			<td colspan="3" class="popupally-style-responsive-content-cell">
<div class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-iejsye="0">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="iejsye" level="0" margin-before="#iejsye-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Preview</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-2}}</div>
	</div>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="iejsye" signup-form-hide="form" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="iejsye" signup-form-hide="name" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="iejsye" signup-form-hide="lname" value="true"/>
	<input style="display:none;" type="checkbox" checked popup-id="{{id}}" template-id="iejsye" signup-form-hide="email" value="true"/>
	<div class="popupally-setting-section" id="iejsye-customization-section-{{id}}">
		<div class="popupally-setting-section-header">Customization</div>

		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:40%;">
									<select popupally-change-source="iejsye-location-selection-{{id}}" name="[{{id}}][iejsye-popup-location]">
									{{iejsye-location-selection}}
									</select>
								</td>
								<td><div class="popupally-inline-help-text">This setting only applies to popups. It does NOT affect embedded opt-ins.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="iejsye-popup-location" data-dependency="iejsye-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<div>
						Define vertical position by distance to the
						<select popupally-change-source="iejsye-location-vertical-selection-{{id}}" name="[{{id}}][iejsye-popup-vertical-selection]">
							{{iejsye-location-vertical-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="iejsye-popup-vertical-selection" data-dependency="iejsye-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-top]" type="text" value="{{iejsye-popup-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="iejsye-popup-vertical-selection" data-dependency="iejsye-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-bottom]" type="text" value="{{iejsye-popup-bottom}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="popupally-setting-configure-block" hide-toggle="iejsye-popup-location" data-dependency="iejsye-location-selection-{{id}}" data-dependency-value="other">
				<div class="popupally-setting-section-sub-header">Horizontal Position</div>
				<div>
					<div>
						Define horizontal position by distance to the
						<select popupally-change-source="iejsye-location-horizontal-selection-{{id}}" name="[{{id}}][iejsye-popup-horizontal-selection]">
							{{iejsye-location-horizontal-selection}}
						</select>
						of the page.
					</div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="iejsye-popup-horizontal-selection" data-dependency="iejsye-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-left]" type="text" value="{{iejsye-popup-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="iejsye-popup-horizontal-selection" data-dependency="iejsye-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-right]" type="text" value="{{iejsye-popup-right}}">
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
									<div><input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][iejsye-background-color]" type="text" value="{{iejsye-background-color}}" preview-update-target-css=".popupally-pro-outer-preview-background-iejsye-{{id}}" preview-update-target-css-property="background-color" data-default-color="#fefefe"></div>
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
									<input class="full-width" type="text" id="iejsye-background-image-url-{{id}}" name="[{{id}}][iejsye-background-image-url]" value="{{iejsye-background-image-url}}" preview-update-target-css-background-img=".popupally-pro-outer-preview-background-iejsye-{{id}}" />
									<div upload-image="#iejsye-background-image-url-{{id}}">Upload Image</div>
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
					<select name="[{{id}}][iejsye-background-image-size]" preview-update-target-css=".popupally-pro-outer-preview-background-iejsye-{{id}}" preview-update-target-css-property="background-size">
						{{iejsye-background-image-size}}
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
						<input size="4" name="[{{id}}][iejsye-width]" type="text" value="{{iejsye-width}}" preview-update-target-css="#iejsye-popup-box-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-height]" type="text" value="{{iejsye-height}}" preview-update-target-css="#iejsye-popup-box-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-image-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="iejsye-image-1-url-{{id}}" name="[{{id}}][iejsye-image-1-url]" value="{{iejsye-image-1-url}}" preview-update-target-css-background-img=".iejsye-preview-image-1-{{id}}" image-dimension-attribute="iejsye-image-1-{{id}}"/>
									<div upload-image="#iejsye-image-1-url-{{id}}">Upload Image</div>
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
						<input size="4" name="[{{id}}][iejsye-image-1-top]" type="text" value="{{iejsye-image-1-top}}" preview-update-target-css="#iejsye-preview-image-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-image-1-left]" type="text" value="{{iejsye-image-1-left}}" preview-update-target-css="#iejsye-preview-image-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="iejsye-image-1-{{id}}-width" name="[{{id}}][iejsye-image-1-width]" type="text" value="{{iejsye-image-1-width}}" preview-update-target-css="#iejsye-preview-image-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="iejsye-image-1-{{id}}-height" name="[{{id}}][iejsye-image-1-height]" type="text" value="{{iejsye-image-1-height}}" preview-update-target-css="#iejsye-preview-image-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-image-2-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="iejsye-image-2-url-{{id}}" name="[{{id}}][iejsye-image-2-url]" value="{{iejsye-image-2-url}}" preview-update-target-css-background-img=".iejsye-preview-image-2-{{id}}" image-dimension-attribute="iejsye-image-2-{{id}}" />
									<div upload-image="#iejsye-image-2-url-{{id}}">Upload Image</div>
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
						<input size="4" name="[{{id}}][iejsye-image-2-top]" type="text" value="{{iejsye-image-2-top}}" preview-update-target-css="#iejsye-preview-image-2-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-image-2-left]" type="text" value="{{iejsye-image-2-left}}" preview-update-target-css="#iejsye-preview-image-2-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" id="iejsye-image-2-{{id}}-width" name="[{{id}}][iejsye-image-2-width]" type="text" value="{{iejsye-image-2-width}}" preview-update-target-css="#iejsye-preview-image-2-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" id="iejsye-image-2-{{id}}-height" name="[{{id}}][iejsye-image-2-height]" type="text" value="{{iejsye-image-2-height}}" preview-update-target-css="#iejsye-preview-image-2-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-headline-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][iejsye-headline]" html-error-check="#iejsye-headline-error-{{id}}" preview-update-target=".iejsye-preview-headline-{{id}}">{{iejsye-headline}}</textarea>
					<small class="sign-up-error" id="iejsye-headline-error-{{id}}" popup-id="{{id}}" html-code-source="Headline"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-headline-top]" type="text" value="{{iejsye-headline-top}}" preview-update-target-css="#iejsye-preview-headline-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-headline-left]" type="text" value="{{iejsye-headline-left}}" preview-update-target-css="#iejsye-preview-headline-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-headline-width]" type="text" value="{{iejsye-headline-width}}" preview-update-target-css="#iejsye-preview-headline-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-headline-height]" type="text" value="{{iejsye-headline-height}}" preview-update-target-css="#iejsye-preview-headline-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{iejsye-headline-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-textbox-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][iejsye-textbox-1]" html-error-check="#iejsye-textbox-1-error-{{id}}" preview-update-target=".iejsye-preview-textbox-1-{{id}}">{{iejsye-textbox-1}}</textarea>
					<small class="sign-up-error" id="iejsye-textbox-1-error-{{id}}" popup-id="{{id}}" html-code-source="Text Box 1"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-textbox-1-top]" type="text" value="{{iejsye-textbox-1-top}}" preview-update-target-css="#iejsye-preview-textbox-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-textbox-1-left]" type="text" value="{{iejsye-textbox-1-left}}" preview-update-target-css="#iejsye-preview-textbox-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-textbox-1-width]" type="text" value="{{iejsye-textbox-1-width}}" preview-update-target-css="#iejsye-preview-textbox-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-textbox-1-height]" type="text" value="{{iejsye-textbox-1-height}}" preview-update-target-css="#iejsye-preview-textbox-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{iejsye-textbox-1-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-textbox-2-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][iejsye-textbox-2]" html-error-check="#iejsye-textbox-2-error-{{id}}" preview-update-target=".iejsye-preview-textbox-2-{{id}}">{{iejsye-textbox-2}}</textarea>
					<small class="sign-up-error" id="iejsye-textbox-2-error-{{id}}" popup-id="{{id}}" html-code-source="Text Box 2"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-textbox-2-top]" type="text" value="{{iejsye-textbox-2-top}}" preview-update-target-css="#iejsye-preview-textbox-2-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-textbox-2-left]" type="text" value="{{iejsye-textbox-2-left}}" preview-update-target-css="#iejsye-preview-textbox-2-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-textbox-2-width]" type="text" value="{{iejsye-textbox-2-width}}" preview-update-target-css="#iejsye-preview-textbox-2-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-textbox-2-height]" type="text" value="{{iejsye-textbox-2-height}}" preview-update-target-css="#iejsye-preview-textbox-2-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{iejsye-textbox-2-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-choice-1-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Text (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][iejsye-choice-1-text]" html-error-check="#iejsye-choice-1-text-error-{{id}}" preview-update-target=".iejsye-preview-choice-1-text-{{id}}">{{iejsye-choice-1-text}}</textarea>
					<small class="sign-up-error" id="iejsye-choice-1-text-error-{{id}}" popup-id="{{id}}" html-code-source="Choice 1 Box Text"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-choice-1-top]" type="text" value="{{iejsye-choice-1-top}}" preview-update-target-css="#iejsye-preview-choice-1-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-choice-1-left]" type="text" value="{{iejsye-choice-1-left}}" preview-update-target-css="#iejsye-preview-choice-1-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-1-width]" type="text" value="{{iejsye-choice-1-width}}" preview-update-target-css="#iejsye-preview-choice-1-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-1-height]" type="text" value="{{iejsye-choice-1-height}}" preview-update-target-css="#iejsye-preview-choice-1-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<input type="hidden" name="[{{id}}][iejsye-choice-1-target-type]" id="iejsye-choice-1-target-type-{{id}}" popupally-change-source="iejsye-choice-1-target-type-{{id}}" value="{{iejsye-choice-1-target-type}}" />
				<div class="popupally-setting-section-sub-header">Choice 1 Destination</div>
				<div hide-toggle="iejsye-choice-1-target-type" data-dependency="iejsye-choice-1-target-type-{{id}}" data-dependency-value="popup"><small><a click-value="url" click-target="#iejsye-choice-1-target-type-{{id}}" href="#">Go to a URL instead</a></small></div>
				<div hide-toggle="iejsye-choice-1-target-type" data-dependency="iejsye-choice-1-target-type-{{id}}" data-dependency-value="url"><small><a click-value="popup" click-target="#iejsye-choice-1-target-type-{{id}}" href="#">Show another popup instead</a></small></div>
				<div hide-toggle="iejsye-choice-1-target-type" data-dependency="iejsye-choice-1-target-type-{{id}}" data-dependency-value="popup">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									Popup id
								</td>
								<td style="width:20%;">
									<div><input size="4" name="[{{id}}][iejsye-choice-1-popup-id]" type="text" value="{{iejsye-choice-1-popup-id}}"></div>
								</td>
								<td><div class="popupally-inline-help-text">The popup id is the number before the popup name on the header. Set to an invalid popup id or -1 to close the popup when clicked.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div hide-toggle="iejsye-choice-1-target-type" data-dependency="iejsye-choice-1-target-type-{{id}}" data-dependency-value="url">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									URL
								</td>
								<td style="width:80%;">
									<input class="full-width" size="20" name="[{{id}}][iejsye-choice-1-url]" type="text" value="{{iejsye-choice-1-url}}">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Background Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][iejsye-choice-1-background-color]" type="text" value="{{iejsye-choice-1-background-color}}" preview-update-target-css=".iejsye-preview-choice-1-{{id}}" preview-update-target-css-property="background-color" data-default-color="#f6d31d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="iejsye-choice-1-image-url-{{id}}" name="[{{id}}][iejsye-choice-1-background-image-url]" value="{{iejsye-choice-1-background-image-url}}" preview-update-target-css-background-img=".iejsye-preview-choice-1-{{id}}" />
									<div upload-image="#iejsye-choice-1-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show a background image for choice #1.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Text Style</div>
				{{iejsye-choice-1-advanced}}
			</div>
		</div>
		<div class="popupally-configure-element" id="iejsye-config-choice-2-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Text (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][iejsye-choice-2-text]" html-error-check="#iejsye-choice-2-text-error-{{id}}" preview-update-target=".iejsye-preview-choice-2-text-{{id}}">{{iejsye-choice-2-text}}</textarea>
					<small class="sign-up-error" id="iejsye-choice-2-text-error-{{id}}" popup-id="{{id}}" html-code-source="Choice 2 Box Text"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-choice-2-top]" type="text" value="{{iejsye-choice-2-top}}" preview-update-target-css="#iejsye-preview-choice-2-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-choice-2-left]" type="text" value="{{iejsye-choice-2-left}}" preview-update-target-css="#iejsye-preview-choice-2-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-2-width]" type="text" value="{{iejsye-choice-2-width}}" preview-update-target-css="#iejsye-preview-choice-2-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-2-height]" type="text" value="{{iejsye-choice-2-height}}" preview-update-target-css="#iejsye-preview-choice-2-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<input type="hidden" name="[{{id}}][iejsye-choice-2-target-type]" id="iejsye-choice-2-target-type-{{id}}" popupally-change-source="iejsye-choice-2-target-type-{{id}}" value="{{iejsye-choice-2-target-type}}" />
				<div class="popupally-setting-section-sub-header">Choice 2 Destination</div>
				<div hide-toggle="iejsye-choice-2-target-type" data-dependency="iejsye-choice-2-target-type-{{id}}" data-dependency-value="popup"><small><a click-value="url" click-target="#iejsye-choice-2-target-type-{{id}}" href="#">Go to a URL instead</a></small></div>
				<div hide-toggle="iejsye-choice-2-target-type" data-dependency="iejsye-choice-2-target-type-{{id}}" data-dependency-value="url"><small><a click-value="popup" click-target="#iejsye-choice-2-target-type-{{id}}" href="#">Show another popup instead</a></small></div>
				<div hide-toggle="iejsye-choice-2-target-type" data-dependency="iejsye-choice-2-target-type-{{id}}" data-dependency-value="popup">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									Popup id
								</td>
								<td style="width:20%;">
									<div><input size="4" name="[{{id}}][iejsye-choice-2-popup-id]" type="text" value="{{iejsye-choice-2-popup-id}}"></div>
								</td>
								<td><div class="popupally-inline-help-text">The popup id is the number before the popup name on the header. Set to an invalid popup id or -1 to close the popup when clicked.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div hide-toggle="iejsye-choice-2-target-type" data-dependency="iejsye-choice-2-target-type-{{id}}" data-dependency-value="url">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									URL
								</td>
								<td style="width:80%;">
									<input class="full-width" size="20" name="[{{id}}][iejsye-choice-2-url]" type="text" value="{{iejsye-choice-2-url}}">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Background Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][iejsye-choice-2-background-color]" type="text" value="{{iejsye-choice-2-background-color}}" preview-update-target-css=".iejsye-preview-choice-2-{{id}}" preview-update-target-css-property="background-color" data-default-color="#f6d31d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="iejsye-choice-2-image-url-{{id}}" name="[{{id}}][iejsye-choice-2-background-image-url]" value="{{iejsye-choice-2-background-image-url}}" preview-update-target-css-background-img=".iejsye-preview-choice-2-{{id}}" />
									<div upload-image="#iejsye-choice-2-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show a background image for choice #2.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Text Style</div>
				{{iejsye-choice-2-advanced}}
			</div>
		</div>
		<div class="popupally-configure-element" id="iejsye-config-choice-3-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Text (HTML code allowed)</div>
				<div>
					<textarea rows="3" class="full-width" name="[{{id}}][iejsye-choice-3-text]" html-error-check="#iejsye-choice-3-text-error-{{id}}" preview-update-target=".iejsye-preview-choice-3-text-{{id}}">{{iejsye-choice-3-text}}</textarea>
					<small class="sign-up-error" id="iejsye-choice-3-text-error-{{id}}" popup-id="{{id}}" html-code-source="Choice 3 Box Text"></small>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-choice-3-top]" type="text" value="{{iejsye-choice-3-top}}" preview-update-target-css="#iejsye-preview-choice-3-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-choice-3-left]" type="text" value="{{iejsye-choice-3-left}}" preview-update-target-css="#iejsye-preview-choice-3-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-3-width]" type="text" value="{{iejsye-choice-3-width}}" preview-update-target-css="#iejsye-preview-choice-3-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-3-height]" type="text" value="{{iejsye-choice-3-height}}" preview-update-target-css="#iejsye-preview-choice-3-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<input type="hidden" name="[{{id}}][iejsye-choice-3-target-type]" id="iejsye-choice-3-target-type-{{id}}" popupally-change-source="iejsye-choice-3-target-type-{{id}}" value="{{iejsye-choice-3-target-type}}" />
				<div class="popupally-setting-section-sub-header">Choice 3 Destination</div>
				<div hide-toggle="iejsye-choice-3-target-type" data-dependency="iejsye-choice-3-target-type-{{id}}" data-dependency-value="popup"><small><a click-value="url" click-target="#iejsye-choice-3-target-type-{{id}}" href="#">Go to a URL instead</a></small></div>
				<div hide-toggle="iejsye-choice-3-target-type" data-dependency="iejsye-choice-3-target-type-{{id}}" data-dependency-value="url"><small><a click-value="popup" click-target="#iejsye-choice-3-target-type-{{id}}" href="#">Show another popup instead</a></small></div>
				<div hide-toggle="iejsye-choice-3-target-type" data-dependency="iejsye-choice-3-target-type-{{id}}" data-dependency-value="popup">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									Popup id
								</td>
								<td style="width:20%;">
									<div><input size="4" name="[{{id}}][iejsye-choice-3-popup-id]" type="text" value="{{iejsye-choice-3-popup-id}}"></div>
								</td>
								<td><div class="popupally-inline-help-text">The popup id is the number before the popup name on the header. Set to an invalid popup id or -1 to close the popup when clicked.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div hide-toggle="iejsye-choice-3-target-type" data-dependency="iejsye-choice-3-target-type-{{id}}" data-dependency-value="url">
					<table class="popupally-setting-configure-table full-width">
						<tbody>
							<tr>
								<td style="width:20%;">
									URL
								</td>
								<td style="width:80%;">
									<input class="full-width" size="20" name="[{{id}}][iejsye-choice-3-url]" type="text" value="{{iejsye-choice-3-url}}">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Background Color</div>
				<div>
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][iejsye-choice-3-background-color]" type="text" value="{{iejsye-choice-3-background-color}}" preview-update-target-css=".iejsye-preview-choice-3-{{id}}" preview-update-target-css-property="background-color" data-default-color="#f6d31d">
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Background Image</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr>
								<td style="width:60%;">
									<input class="full-width" type="text" id="iejsye-choice-3-image-url-{{id}}" name="[{{id}}][iejsye-choice-3-background-image-url]" value="{{iejsye-choice-3-background-image-url}}" preview-update-target-css-background-img=".iejsye-preview-choice-3-{{id}}" />
									<div upload-image="#iejsye-choice-3-image-url-{{id}}">Upload Image</div>
								</td>
								<td><div class="popupally-inline-help-text">Leave this field blank if you do not want to show a background image for Choice #3.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Text Style</div>
				{{iejsye-choice-3-advanced}}
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
										<input popupally-change-source="iejsye-hide-overlay-{{id}}" id="iejsye-hide-overlay-{{id}}" name="[{{id}}][iejsye-hide-overlay]" {{iejsye-hide-overlay}} type="checkbox" value="true">
										<label for="iejsye-hide-overlay-{{id}}">Yes</label>
									</div>
								</td>
								<td><div class="popupally-inline-help-text">By default, when the popup appears, the page is obscured by an overlay. Check this option will disable the overlay, and the popup will not interfere with clicks on the normal page content.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div hide-toggle="iejsye-hide-overlay" data-dependency="iejsye-hide-overlay-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-configure-block">
					<div class="popupally-setting-section-sub-header">Screen Background Overlay</div>
					<div>
						<table class="popupally-setting-configure-table">
							<tbody>
								<tr>
									<td style="width:60%;">
										<div>
											Color
											<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][iejsye-overlay-color]" type="text" value="{{iejsye-overlay-color}}" data-default-color="#505050">
											Opacity
											<input size="4" name="[{{id}}][iejsye-overlay-opacity]" type="text" value="{{iejsye-overlay-opacity}}">
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
											<input id="iejsye-disable-overlay-close-{{id}}" name="[{{id}}][iejsye-disable-overlay-close]" {{iejsye-disable-overlay-close}} type="checkbox" value="true">
											<label for="iejsye-disable-overlay-close-{{id}}">Yes</label>
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
										<input id="iejsye-show-embedded-border-{{id}}" name="[{{id}}][iejsye-show-embedded-border]" {{iejsye-show-embedded-border}} type="checkbox" value="true">
										<label for="iejsye-show-embedded-border-{{id}}">Yes</label>
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
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-iejsye="1">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="iejsye" level="1" margin-before="#iejsye-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Tablets</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-3}}</div>
	</div>
	<div class="popupally-setting-section" id="iejsye-customization-960-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Tablet display</div>
		<div class="popupally-setting-section-help-text">screen width between 640px - 960px</div>

		<div class="popupally-configure-element" hide-toggle="iejsye-popup-location" data-dependency="iejsye-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="iejsye-popup-vertical-selection" data-dependency="iejsye-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-960-top]" type="text" value="{{iejsye-popup-960-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="iejsye-popup-vertical-selection" data-dependency="iejsye-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-960-bottom]" type="text" value="{{iejsye-popup-960-bottom}}">
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
							<tr hide-toggle="iejsye-popup-horizontal-selection" data-dependency="iejsye-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-960-left]" type="text" value="{{iejsye-popup-960-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="iejsye-popup-horizontal-selection" data-dependency="iejsye-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-960-right]" type="text" value="{{iejsye-popup-960-right}}">
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
						<input size="4" name="[{{id}}][iejsye-width-960]" type="text" value="{{iejsye-width-960}}" preview-update-target-css="#iejsye-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-height-960]" type="text" value="{{iejsye-height-960}}" preview-update-target-css="#iejsye-popup-box-960-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-image-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-image-1-960-top]" type="text" value="{{iejsye-image-1-960-top}}" preview-update-target-css="#iejsye-preview-image-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-image-1-960-left]" type="text" value="{{iejsye-image-1-960-left}}" preview-update-target-css="#iejsye-preview-image-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-image-1-960-width]" type="text" value="{{iejsye-image-1-960-width}}" preview-update-target-css="#iejsye-preview-image-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-image-1-960-height]" type="text" value="{{iejsye-image-1-960-height}}" preview-update-target-css="#iejsye-preview-image-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-image-2-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-image-2-960-top]" type="text" value="{{iejsye-image-2-960-top}}" preview-update-target-css="#iejsye-preview-image-2-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-image-2-960-left]" type="text" value="{{iejsye-image-2-960-left}}" preview-update-target-css="#iejsye-preview-image-2-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-image-2-960-width]" type="text" value="{{iejsye-image-2-960-width}}" preview-update-target-css="#iejsye-preview-image-2-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-image-2-960-height]" type="text" value="{{iejsye-image-2-960-height}}" preview-update-target-css="#iejsye-preview-image-2-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-headline-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-headline-960-top]" type="text" value="{{iejsye-headline-960-top}}" preview-update-target-css="#iejsye-preview-headline-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-headline-960-left]" type="text" value="{{iejsye-headline-960-left}}" preview-update-target-css="#iejsye-preview-headline-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-headline-960-width]" type="text" value="{{iejsye-headline-960-width}}" preview-update-target-css="#iejsye-preview-headline-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-headline-960-height]" type="text" value="{{iejsye-headline-960-height}}" preview-update-target-css="#iejsye-preview-headline-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{iejsye-headline-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-textbox-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-textbox-1-960-top]" type="text" value="{{iejsye-textbox-1-960-top}}" preview-update-target-css="#iejsye-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-textbox-1-960-left]" type="text" value="{{iejsye-textbox-1-960-left}}" preview-update-target-css="#iejsye-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-textbox-1-960-width]" type="text" value="{{iejsye-textbox-1-960-width}}" preview-update-target-css="#iejsye-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-textbox-1-960-height]" type="text" value="{{iejsye-textbox-1-960-height}}" preview-update-target-css="#iejsye-preview-textbox-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{iejsye-textbox-1-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-textbox-2-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-textbox-2-960-top]" type="text" value="{{iejsye-textbox-2-960-top}}" preview-update-target-css="#iejsye-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-textbox-2-960-left]" type="text" value="{{iejsye-textbox-2-960-left}}" preview-update-target-css="#iejsye-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-textbox-2-960-width]" type="text" value="{{iejsye-textbox-2-960-width}}" preview-update-target-css="#iejsye-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-textbox-2-960-height]" type="text" value="{{iejsye-textbox-2-960-height}}" preview-update-target-css="#iejsye-preview-textbox-2-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{iejsye-textbox-2-960-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-choice-1-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-1-960-width]" type="text" value="{{iejsye-choice-1-960-width}}" preview-update-target-css="#iejsye-preview-choice-1-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-1-960-height]" type="text" value="{{iejsye-choice-1-960-height}}" preview-update-target-css="#iejsye-preview-choice-1-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][iejsye-choice-1-960-top]" type="text" value="{{iejsye-choice-1-960-top}}" preview-update-target-css="#iejsye-preview-choice-1-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][iejsye-choice-1-960-left]" type="text" value="{{iejsye-choice-1-960-left}}" preview-update-target-css="#iejsye-preview-choice-1-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Text Style</div>
				{{iejsye-choice-1-960-advanced}}
			</div>
		</div>
		<div class="popupally-configure-element" id="iejsye-config-choice-2-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-2-960-width]" type="text" value="{{iejsye-choice-2-960-width}}" preview-update-target-css="#iejsye-preview-choice-2-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-2-960-height]" type="text" value="{{iejsye-choice-2-960-height}}" preview-update-target-css="#iejsye-preview-choice-2-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][iejsye-choice-2-960-top]" type="text" value="{{iejsye-choice-2-960-top}}" preview-update-target-css="#iejsye-preview-choice-2-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][iejsye-choice-2-960-left]" type="text" value="{{iejsye-choice-2-960-left}}" preview-update-target-css="#iejsye-preview-choice-2-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Text Style</div>
				{{iejsye-choice-2-960-advanced}}
			</div>
		</div>
		<div class="popupally-configure-element" id="iejsye-config-choice-3-960-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-3-960-width]" type="text" value="{{iejsye-choice-3-960-width}}" preview-update-target-css="#iejsye-preview-choice-3-960-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-3-960-height]" type="text" value="{{iejsye-choice-3-960-height}}" preview-update-target-css="#iejsye-preview-choice-3-960-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][iejsye-choice-3-960-top]" type="text" value="{{iejsye-choice-3-960-top}}" preview-update-target-css="#iejsye-preview-choice-3-960-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][iejsye-choice-3-960-left]" type="text" value="{{iejsye-choice-3-960-left}}" preview-update-target-css="#iejsye-preview-choice-3-960-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Text Style</div>
				{{iejsye-choice-3-960-advanced}}
			</div>
		</div>
	</div>
</div>
<div style="display:none;" class="popupally-sub-setting-content-container" popupally-responsive-tab-group-{{id}}-iejsye="2">
	<div style="height:1px;"></div>
	<div class="popupally-setting-section follow-scroll step-aside" popup-id="{{id}}" template-id="iejsye" level="1" margin-before="#iejsye-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Preview for Mobile Phones</div>
		<div class="popupally-setting-section-help-text">preview your changes automatically here</div>
		<div class="popupally-style-full-size-scroll">{{preview-code-4}}</div>
	</div>
	<div class="popupally-setting-section" id="iejsye-customization-640-section-{{id}}">
		<div class="popupally-setting-section-header">Customization for Mobile Phone display</div>
		<div class="popupally-setting-section-help-text">screen width less than 640px</div>

		<div class="popupally-configure-element" hide-toggle="iejsye-popup-location" data-dependency="iejsye-location-selection-{{id}}" data-dependency-value="other">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Popup Location</div>
				<div class="popupally-setting-section-sub-header">Vertical Position</div>
				<div>
					<table class="popupally-setting-configure-table">
						<tbody>
							<tr hide-toggle="iejsye-popup-vertical-selection" data-dependency="iejsye-location-vertical-selection-{{id}}" data-dependency-value="top">
								<td style="width:20%;">
									Distance to the top of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-640-top]" type="text" value="{{iejsye-popup-640-top}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="iejsye-popup-vertical-selection" data-dependency="iejsye-location-vertical-selection-{{id}}" data-dependency-value="bottom">
								<td style="width:20%;">
									Distance to the bottom of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-640-bottom]" type="text" value="{{iejsye-popup-640-bottom}}">
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
							<tr hide-toggle="iejsye-popup-horizontal-selection" data-dependency="iejsye-location-horizontal-selection-{{id}}" data-dependency-value="left">
								<td style="width:20%;">
									Distance to the left of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-640-left]" type="text" value="{{iejsye-popup-640-left}}">
								</td>
								<td><div class="popupally-inline-help-text">Please specify either &quot;%&quot; or &quot;px&quot;.</div></td>
							</tr>
							<tr hide-toggle="iejsye-popup-horizontal-selection" data-dependency="iejsye-location-horizontal-selection-{{id}}" data-dependency-value="right">
								<td style="width:20%;">
									Distance to the right of the page
								</td>
								<td style="width:30%;">
									<input style="margin-left:10px;" size="8" name="[{{id}}][iejsye-popup-640-right]" type="text" value="{{iejsye-popup-640-right}}">
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
						<input size="4" name="[{{id}}][iejsye-width-640]" type="text" value="{{iejsye-width-640}}" preview-update-target-css="#iejsye-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-height-640]" type="text" value="{{iejsye-height-640}}" preview-update-target-css="#iejsye-popup-box-640-preview-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-image-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-image-1-640-top]" type="text" value="{{iejsye-image-1-640-top}}" preview-update-target-css="#iejsye-preview-image-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-image-1-640-left]" type="text" value="{{iejsye-image-1-640-left}}" preview-update-target-css="#iejsye-preview-image-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 1 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-image-1-640-width]" type="text" value="{{iejsye-image-1-640-width}}" preview-update-target-css="#iejsye-preview-image-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-image-1-640-height]" type="text" value="{{iejsye-image-1-640-height}}" preview-update-target-css="#iejsye-preview-image-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-image-2-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-image-2-640-top]" type="text" value="{{iejsye-image-2-640-top}}" preview-update-target-css="#iejsye-preview-image-2-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-image-2-640-left]" type="text" value="{{iejsye-image-2-640-left}}" preview-update-target-css="#iejsye-preview-image-2-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Image 2 Size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-image-2-640-width]" type="text" value="{{iejsye-image-2-640-width}}" preview-update-target-css="#iejsye-preview-image-2-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-image-2-640-height]" type="text" value="{{iejsye-image-2-640-height}}" preview-update-target-css="#iejsye-preview-image-2-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-headline-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-headline-640-top]" type="text" value="{{iejsye-headline-640-top}}" preview-update-target-css="#iejsye-preview-headline-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-headline-640-left]" type="text" value="{{iejsye-headline-640-left}}" preview-update-target-css="#iejsye-preview-headline-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-headline-640-width]" type="text" value="{{iejsye-headline-640-width}}" preview-update-target-css="#iejsye-preview-headline-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-headline-640-height]" type="text" value="{{iejsye-headline-640-height}}" preview-update-target-css="#iejsye-preview-headline-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Headline Style</div>
				{{iejsye-headline-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-textbox-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-textbox-1-640-top]" type="text" value="{{iejsye-textbox-1-640-top}}" preview-update-target-css="#iejsye-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-textbox-1-640-left]" type="text" value="{{iejsye-textbox-1-640-left}}" preview-update-target-css="#iejsye-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-textbox-1-640-width]" type="text" value="{{iejsye-textbox-1-640-width}}" preview-update-target-css="#iejsye-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-textbox-1-640-height]" type="text" value="{{iejsye-textbox-1-640-height}}" preview-update-target-css="#iejsye-preview-textbox-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 1 Style</div>
				{{iejsye-textbox-1-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-textbox-2-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Position</div>
				<div>
					<span class="two-by-two-input">
						Vertical offset
						<input size="4" name="[{{id}}][iejsye-textbox-2-640-top]" type="text" value="{{iejsye-textbox-2-640-top}}" preview-update-target-css="#iejsye-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="top">px
					</span>
					<span class="two-by-two-input">
						Horizontal offset
						<input size="4" name="[{{id}}][iejsye-textbox-2-640-left]" type="text" value="{{iejsye-textbox-2-640-left}}" preview-update-target-css="#iejsye-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="left">px
					</span>
				</div>
			</div>
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 size</div>
				<div>
					<span class="two-by-two-input">
						Width
						<input size="4" name="[{{id}}][iejsye-textbox-2-640-width]" type="text" value="{{iejsye-textbox-2-640-width}}" preview-update-target-css="#iejsye-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						Height
						<input size="4" name="[{{id}}][iejsye-textbox-2-640-height]" type="text" value="{{iejsye-textbox-2-640-height}}" preview-update-target-css="#iejsye-preview-textbox-2-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Text Box 2 Style</div>
				{{iejsye-textbox-2-640-advanced}}
			</div>
		</div>

		<div class="popupally-configure-element" id="iejsye-config-choice-1-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-1-640-width]" type="text" value="{{iejsye-choice-1-640-width}}" preview-update-target-css="#iejsye-preview-choice-1-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-1-640-height]" type="text" value="{{iejsye-choice-1-640-height}}" preview-update-target-css="#iejsye-preview-choice-1-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][iejsye-choice-1-640-top]" type="text" value="{{iejsye-choice-1-640-top}}" preview-update-target-css="#iejsye-preview-choice-1-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][iejsye-choice-1-640-left]" type="text" value="{{iejsye-choice-1-640-left}}" preview-update-target-css="#iejsye-preview-choice-1-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 1 Box Text Style</div>
				{{iejsye-choice-1-640-advanced}}
			</div>
		</div>
		<div class="popupally-configure-element" id="iejsye-config-choice-2-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-2-640-width]" type="text" value="{{iejsye-choice-2-640-width}}" preview-update-target-css="#iejsye-preview-choice-2-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-2-640-height]" type="text" value="{{iejsye-choice-2-640-height}}" preview-update-target-css="#iejsye-preview-choice-2-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][iejsye-choice-2-640-top]" type="text" value="{{iejsye-choice-2-640-top}}" preview-update-target-css="#iejsye-preview-choice-2-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][iejsye-choice-2-640-left]" type="text" value="{{iejsye-choice-2-640-left}}" preview-update-target-css="#iejsye-preview-choice-2-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 2 Box Text Style</div>
				{{iejsye-choice-2-640-advanced}}
			</div>
		</div>
		<div class="popupally-configure-element" id="iejsye-config-choice-3-640-{{id}}">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Size</div>
				<div>
					<span class="two-by-two-input">
						<label>Width</label>
						<input size="4" name="[{{id}}][iejsye-choice-3-640-width]" type="text" value="{{iejsye-choice-3-640-width}}" preview-update-target-css="#iejsye-preview-choice-3-640-{{id}}" preview-update-target-css-property-px="width">px
					</span>
					<span class="two-by-two-input">
						<label>Height</label>
						<input size="4" name="[{{id}}][iejsye-choice-3-640-height]" type="text" value="{{iejsye-choice-3-640-height}}" preview-update-target-css="#iejsye-preview-choice-3-640-{{id}}" preview-update-target-css-property-px="height">px
					</span>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Position</div>
				<div>
					<div class="popupally-style-same-line-block">
						<span class="two-by-two-input">
							Vertical offset
							<input size="4" name="[{{id}}][iejsye-choice-3-640-top]" type="text" value="{{iejsye-choice-3-640-top}}" preview-update-target-css="#iejsye-preview-choice-3-640-{{id}}" preview-update-target-css-property-px="top">px
						</span>
						<span>
							Horizontal offset
							<input size="4" name="[{{id}}][iejsye-choice-3-640-left]" type="text" value="{{iejsye-choice-3-640-left}}" preview-update-target-css="#iejsye-preview-choice-3-640-{{id}}" preview-update-target-css-property-px="left">px
						</span>
					</div>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Choice 3 Box Text Style</div>
				{{iejsye-choice-3-640-advanced}}
			</div>
		</div>
	</div>
</div>
			</td>
		</tr>
	</tbody>
</table>