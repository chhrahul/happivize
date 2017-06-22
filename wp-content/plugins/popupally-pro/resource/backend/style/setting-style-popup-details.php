<div id="popupally-setting-style-customization-section-{{id}}" hide-toggle="is-open" data-dependency="style-toggle-{{id}}" data-dependency-value="true">
	<div class="popupally-setting-section" style="display:none;">
		<input type="hidden" popupally-change-source="advanced-{{id}}" name="[{{id}}][advanced]" value="{{advanced}}"/>
		<div class="popupally-setting-section-header">Admin Options</div>
		<div class="popupally-setting-section-help-text">these options are for you as an admin, not behavior for your site visitors</div>
		<div class="popupally-setting-configure-block">
			<table class="popupally-setting-configure-table">
				<tbody>
					<tr>
						<td class="popupally-setting-configure-table-left-col">
							<input name="[{{id}}][convert-advanced]" id="convert-{{id}}" type="checkbox" value="true"/>
						</td>
						<td>
							<div>
								<label for="convert-{{id}}"><strong>Convert</strong> to advanced mode on submit.</label>
							</div>
							<div class="popupally-setting-section-help-text">
								(Warning: For developers ONLY! You will no longer be able to edit the popup appearance in visual mode.)
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="popupally-setting-section" hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="true">
		<div class="popupally-setting-section-header">Advanced style configurations</div>
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">HTML</div>
			<div>
				<textarea class="full-width" name="[{{id}}][html]" rows="6">{{html}}</textarea>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Embedded HTML</div>
			<div class="popupally-setting-section-help-text">
				Use for embedded opt-in form
			</div>
			<div>
				<textarea class="full-width" name="[{{id}}][html-embedded]" rows="6">{{html-embedded}}</textarea>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">CSS</div>
			<div>
				<textarea class="full-width" name="[{{id}}][css]" rows="6">{{css}}</textarea>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Additional CSS for top of page embedded opt-in</div>
			<div class="popupally-setting-section-help-text">
				Use for inserting extra space at the top of the page to accommodate embedded opt-in form
			</div>
			<div>
				<textarea class="full-width" name="[{{id}}][css-top-margin]" rows="6">{{css-top-margin}}</textarea>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Popup selector</div>
			<div>
				<input type="text" class="full-width" name="[{{id}}][popup-selector]" value="{{popup-selector}}"/>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">CSS class to add when open</div>
			<div>
				<input type="text" class="full-width" name="[{{id}}][popup-class]" value="{{popup-class}}"/>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Close-trigger selector</div>
			<div>
				<input type="text" class="full-width" name="[{{id}}][close-trigger]" value="{{close-trigger}}"/>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Cookie name</div>
			<div>
				<input type="text" class="full-width" name="[{{id}}][cookie-name]" value="{{cookie-name}}"/>
			</div>
		</div>
	</div>
	<div class="popupally-setting-section" {{signup-html-template-form-initial-hide}} popup-id="{{id}}" signup-html-template="form">
		<div class="popupally-setting-section-header">Information Destination</div>
		<div class="popupally-setting-section-help-text">this section control where to send the information submitted through the popup/opt-in.</div>
		<div class="popupally-setting-configure-block">
			Send information to
			<select id="information-destination-{{id}}" popupally-change-source="information-destination-{{id}}" name="[{{id}}][select-information-destination]">
				{{select-information-destination}}
			</select>
		</div>
		<div hide-toggle="select-information-destination" data-dependency="information-destination-{{id}}" data-dependency-value="email">
			<div class="popupally-setting-section-header">Send information to email(s)</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email address(es)</div>
				<div class="popupally-setting-section-help-text">use comma to separate multiple email addresses</div>
				<div>
					<input type="text" class="full-width" name="[{{id}}][information-destination-email-address]" value="{{information-destination-email-address}}"/>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Email subject</div>
				<div>
					<input type="text" class="full-width" name="[{{id}}][information-destination-email-subject]" value="{{information-destination-email-subject}}"/>
				</div>
			</div>

			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">Thank-you page URL</div>
				<div class="popupally-setting-section-help-text">visitors will be sent to this URL after submitting the form.</div>
				<div>
					<input type="text" class="full-width" name="[{{id}}][information-destination-email-thank-you-url]" value="{{information-destination-email-thank-you-url}}"/>
				</div>
			</div>

			<div class="popupally-setting-section" hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="false">
				<div {{signup-html-template-name-initial-hide}} class="sign-up-form-section" popup-id="{{id}}" signup-html-template="name">
					<div class="popupally-setting-section-sub-header">Name field</div>
					<div>
						<label>Label (used in the email message)</label>
						<input type="text" class="full-width" name="[{{id}}][information-destination-email-name-label]" value="{{information-destination-email-name-label}}"/>
					</div>
					<div>
						<input id="information-destination-email-name-is-required-{{id}}" type="checkbox" name="[{{id}}][information-destination-email-name-is-required]" {{information-destination-email-name-is-required}} value="true" />
						<label for="information-destination-email-name-is-required-{{id}}">Required</label>
					</div>
				</div>
				<div {{signup-html-template-lname-initial-hide}} class="sign-up-form-section" popup-id="{{id}}" signup-html-template="lname">
					<div class="popupally-setting-section-sub-header">Last name field</div>
					<div>
						<label>Label (used in the email message)</label>
						<input type="text" class="full-width" name="[{{id}}][information-destination-email-lname-label]" value="{{information-destination-email-lname-label}}"/>
					</div>
					<div>
						<input id="information-destination-email-lname-is-required-{{id}}" type="checkbox" name="[{{id}}][information-destination-email-lname-is-required]" {{information-destination-email-lname-is-required}} value="true" />
						<label for="information-destination-email-lname-is-required-{{id}}">Required</label>
					</div>
				</div>
				<div {{signup-html-template-email-initial-hide}} class="sign-up-form-section" popup-id="{{id}}" signup-html-template="email">
					<div class="popupally-setting-section-sub-header">Email field</div>
					<div>
						<label>Label (used in the email message)</label>
						<input type="text" class="full-width" name="[{{id}}][information-destination-email-email-label]" value="{{information-destination-email-email-label}}"/>
					</div>
					<div>
						<input id="information-destination-email-email-is-required-{{id}}" type="checkbox" name="[{{id}}][information-destination-email-email-is-required]" {{information-destination-email-name-is-required}} value="true" />
						<label for="information-destination-email-email-is-required-{{id}}">Required</label>
					</div>
				</div>
				<div {{hide-fluid-template-selection}} class="sign-up-form-section" hide-toggle data-dependency="template-selector-{{id}}" data-dependency-value="iwjdhs">
					<div class="popupally-setting-section-sub-header">Fluid template field labels</div>
					For fluid templates, field labels are configured in each input element. Please open each input element under the Desktop view and configure the <strong>Input Field Integration</strong> setting.
				</div>
			</div>
			<div class="popupally-setting-section" hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="true">
				The email field information is hard-coded in the popup code.
			</div>
		</div>
		<div hide-toggle="select-information-destination" data-dependency="information-destination-{{id}}" data-dependency-value="form">
			<div hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="false">
				<div class="popupally-setting-section-header">Sign Up HTML</div>
				<div class="popupally-setting-section-help-text">place the embed code from your email provider below</div>
				<div class="popupally-setting-section-help-text">need help getting the Sign Up HTML code for your email platform? See the <a href="http://ambitionally.com/popupally/tutorials/#configure-style-integration" target="_blank">tutorial</a> for detail!</div>
				<div class="popupally-setting-configure-block">
					<input type="hidden" name="[{{id}}][sign-up-form-method]" id="sign-up-form-method-{{id}}" value="{{sign-up-form-method}}" />
					<input type="hidden" name="[{{id}}][sign-up-form-action]" id="sign-up-form-action-{{id}}" value="{{sign-up-form-action}}" />
					<input type="hidden" name="[{{id}}][sign-up-form-valid]" popupally-change-source="sign-up-form-valid-{{id}}" id="sign-up-form-valid-{{id}}" value="{{sign-up-form-valid}}" />
					<div>
						{{generated_fields}}
						<textarea class="full-width sign-up-form-raw-html" popup-id="{{id}}" name="[{{id}}][signup-form]" rows="6">{{signup-form}}</textarea>
						<small class="sign-up-error" id="sign-form-error-{{id}}"></small>
					</div>

					<div {{form-valid-false-hide}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="true">
						<div {{signup-html-template-name-initial-hide}} class="sign-up-form-section" popup-id="{{id}}" signup-html-template="name">
							<div class="popupally-setting-section-sub-header">Name field</div>
							<div>
								<span class="sign-up-form-span">
									<label for="sign-up-form-name-{{id}}">Form field</label>
									<select id="sign-up-form-name-{{id}}" class="sign-up-form-select-{{id}}" sign-up-form-field="name" name="[{{id}}][sign-up-form-name-field]">
										{{signup_name_field_selection}}
									</select>
								</span>
								<span class="sign-up-form-span">
									<input id="sign-up-form-name-is-required-{{id}}" type="checkbox" name="[{{id}}][sign-up-form-name-is-required]" {{sign-up-form-name-is-required}} value="true" />
									<label for="sign-up-form-name-is-required-{{id}}">Required</label>
								</span>
							</div>
						</div>
						<div {{signup-html-template-lname-initial-hide}} class="sign-up-form-section" popup-id="{{id}}" signup-html-template="lname">
							<div class="popupally-setting-section-sub-header">Last Name field</div>
							<div>
								<span class="sign-up-form-span">
									<label for="sign-up-form-lname-{{id}}">Form field</label>
									<select id="sign-up-form-lname-{{id}}" class="sign-up-form-select-{{id}}" sign-up-form-field="lname" name="[{{id}}][sign-up-form-lname-field]">
										{{signup_lname_field_selection}}
									</select>
								</span>
								<span class="sign-up-form-span">
									<input id="sign-up-form-lname-is-required-{{id}}" type="checkbox" name="[{{id}}][sign-up-form-lname-is-required]" {{sign-up-form-lname-is-required}} value="true" />
									<label for="sign-up-form-lname-is-required-{{id}}">Required</label>
								</span>
							</div>
						</div>
						<div {{signup-html-template-email-initial-hide}} class="sign-up-form-section" popup-id="{{id}}" signup-html-template="email">
							<div class="popupally-setting-section-sub-header">Email field</div>
							<div>
								<span class="sign-up-form-span">
									<label for="sign-up-form-email-{{id}}">Form field</label>
									<select id="sign-up-form-email-{{id}}" class="sign-up-form-select-{{id}}" sign-up-form-field="email" name="[{{id}}][sign-up-form-email-field]">
										{{signup_email_field_selection}}
									</select>
								</span>
								<span class="sign-up-form-span">
									<input id="sign-up-form-email-is-required-{{id}}" type="checkbox" name="[{{id}}][sign-up-form-email-is-required]" {{sign-up-form-email-is-required}} value="true" />
									<label for="sign-up-form-email-is-required-{{id}}">Required</label>
								</span>
							</div>
						</div>
						<div {{hide-fluid-template-selection}} class="sign-up-form-section" hide-toggle data-dependency="template-selector-{{id}}" data-dependency-value="iwjdhs">
							<div class="popupally-setting-section-sub-header">Fluid template form integration</div>
							For fluid templates, form fields are configured in each input element. Please open each input element under the Desktop view and configure the <strong>Input Field Integration</strong> setting.
						</div>
					</div>
				</div>
			</div>
			<div class="popupally-setting-section" hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="true">
				The sign up form information is hard-coded in the popup code.
			</div>
		</div>
	</div>

	<div class="popupally-setting-section" hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="false">
		<div class="popupally-setting-section-header">Popup Template</div>
		<div class="popupally-setting-section-help-text">choose a template with custom sizing and other options</div>
		<div class="popupally-setting-configure-block">
			<input type="hidden" name="[{{id}}][selected-template]" id="template-selection-value-{{id}}" value="{{selected-template}}" />
			<select class="popupally-setting-style-template-select" popup-id="{{id}}" popupally-change-source="template-selector-{{id}}">
				{{template_selection}}
			</select>
			<select class="popupally-setting-style-fluid-template-select" {{hide-fluid-template-selection}} hide-toggle data-dependency="template-selector-{{id}}" data-dependency-value="iwjdhs" popup-id="{{id}}" id="fluid-template-selector-{{id}}">
				{{fluid_template_selection}}
			</select>
		</div>
	</div>
	<div id="template-customization-section-{{id}}" hide-toggle="advanced" data-dependency="advanced-{{id}}" data-dependency-value="false">
		{{template_customization}}
	</div>
</div>