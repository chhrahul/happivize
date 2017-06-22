<div class="popupally-customization-div {{accordion-open-class}} popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}"
	 id="popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}">
	<input type="hidden" name="[{{id}}][{{uid}}][element-order][]" class="popup-fluid-element-order-{{id}}-{{uid}}"
		   popup-id="{{id}}" template-id="{{uid}}" element-order="identifier" value="{{element-id}}" />

	<div class="popupally-header popupally-fluid-input-icon" toggle-target="#popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}">
		<div class="view-toggle-block">
			<input name="[{{id}}][{{uid}}][responsive][{{responsive-id}}][elements][{{element-id}}][checked-customization-opened]" {{checked-customization-opened}}
				   type="checkbox" value="true" toggle-group="popup-fluid-element-customization-{{id}}-{{uid}}-{{responsive-id}}" toggle-class="popupally-item-opened"
				   toggle-element="#popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" min-height="40"
				   popupally-change-source="popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" id="popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}">
			<label {{checked-customization-opened-false-show}} hide-toggle data-dependency="popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" data-dependency-value="false">&#x25BC;</label>
			<label {{checked-customization-opened-true-show}} hide-toggle data-dependency="popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" data-dependency-value="true">&#x25B2;</label>
		</div>
		<div class="popupally-name-display-block">
			<div class="popupally-name-display" hide-toggle data-dependency="edit-name-element-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" data-dependency-value="display">
				<div class="popupally-name-label" name-sync-text="element-{{id}}-{{uid}}-{{element-id}}">{{title}}</div>
				<div class="pencil-icon" click-value="edit" click-target="#edit-name-element-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}"></div>
			</div>
			<input type="hidden" popupally-change-source="edit-name-element-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}"
				   id="edit-name-element-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" value="display" />
			<input class="popupally-name-edit full-width" name-sync-val="element-{{id}}-{{uid}}-{{element-id}}" style="display:none;"
				   hide-toggle data-dependency="edit-name-element-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" data-dependency-value="edit" value="{{title}}" />
		</div>
		<input type="hidden" name-sync-master="element-{{id}}-{{uid}}-{{element-id}}" name="[{{id}}][{{uid}}][elements][{{element-id}}][title]" value="{{title}}"/>
	</div>
	<div {{checked-customization-opened-true-show}} class="popup-fluid-element-customization-block" hide-toggle data-dependency="popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" data-dependency-value="true">
		<input type="hidden" name="[{{id}}][{{uid}}][elements][{{element-id}}][type]" value="input" />
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Input box type</div>
			<div>
				<select class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][select-input-type]" popupally-change-source="popupally-select-input-type-{{id}}-{{uid}}-{{element-id}}"
						preview-update-target-type=".popupally-preview-{{preview-element}}" form-dropdown-selection="#dropdown-form-field-{{id}}-{{uid}}-{{element-id}}"
						email-dropdown-selection="#dropdown-email-field-{{id}}-{{uid}}-{{element-id}}" popup-id="{{id}}">
					{{select-input-type}}
				</select>
			</div>

			<div class="popupally-setting-configure-block" hide-toggle="select-input-type" data-dependency="popupally-select-input-type-{{id}}-{{uid}}-{{element-id}}" data-dependency-value="single">
				<input type="checkbox" value="true" name="[{{id}}][{{uid}}][elements][{{element-id}}][checked-is-email]" {{checked-is-email}}
					   preview-update-target-input-type=".popupally-preview-{{preview-element}}"
					   id="popupally-checked-is-email-{{id}}-{{uid}}-{{element-id}}" />
				<label for="popupally-checked-is-email-{{id}}-{{uid}}-{{element-id}}">Check if this is an email input</label>
				<div class="popupally-info-icon popupally-info-bubble"><div info="When checked, this popup can only be submitted if a valid email address is entered for this input."></div></div>
			</div>
		</div>
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Input Field Integration</div>
			<div>
				<table class="popupally-setting-configure-table">
					<tbody hide-toggle="select-input-type" data-dependency="popupally-select-input-type-{{id}}-{{uid}}-{{element-id}}" data-dependency-value="single">
						<tr {{information-destination-form-show}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="form">
							<td class="popupally-setting-configure-table-header-col">
								Form field
							</td>
							<td>
								<select {{valid-form-field-show}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="true" class="full-width sign-up-form-select-{{id}}" name="[{{id}}][{{uid}}][elements][{{element-id}}][form-select-single-field]">
									{{form-select-single-field}}
								</select>
								<label {{valid-form-field-hide}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="false">No Sign Up HTML</label>
							</td>
						</tr>
						<tr {{information-destination-form-hide}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="email">
							<td class="popupally-setting-configure-table-header-col">
								Field label in email
							</td>
							<td>
								<input class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][single-field-label]" value="{{single-field-label}}" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input id="single-checked-required-{{id}}-{{uid}}-{{element-id}}" type="checkbox" name="[{{id}}][{{uid}}][elements][{{element-id}}][checked-single-required]" {{checked-single-required}} value="true"/>
								<label for="single-checked-required-{{id}}-{{uid}}-{{element-id}}">Required input</label>
								<div class="popupally-info-icon popupally-info-bubble"><div info="When checked, this popup cannot be submitted if this input is empty."></div></div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="popupally-setting-section-sub-header">Placeholder Text</div>
								<input class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][placeholder]" value="{{placeholder}}" preview-update-target-placeholder=".popupally-preview-{{preview-element}}" />
							</td>
						</tr>
					</tbody>
					<tbody hide-toggle="select-input-type" data-dependency="popupally-select-input-type-{{id}}-{{uid}}-{{element-id}}" data-dependency-value="multi">
						<tr {{information-destination-form-show}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="form">
							<td class="popupally-setting-configure-table-header-col">
								Form field
							</td>
							<td>
								<select {{valid-form-field-show}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="true" class="full-width sign-up-form-select-{{id}}" name="[{{id}}][{{uid}}][elements][{{element-id}}][form-select-multi-field]">
									{{form-select-multi-field}}
								</select>
								<label {{valid-form-field-hide}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="false">No Sign Up HTML</label>
							</td>
						</tr>
						<tr {{information-destination-form-hide}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="email">
							<td class="popupally-setting-configure-table-header-col">
								Field label in email
							</td>
							<td>
								<input class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][multi-field-label]" value="{{multi-field-label}}" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input id="multi-checked-required-{{id}}-{{uid}}-{{element-id}}" type="checkbox" name="[{{id}}][{{uid}}][elements][{{element-id}}][checked-multi-required]" {{checked-multi-required}} value="true"/>
								<label for="multi-checked-required-{{id}}-{{uid}}-{{element-id}}">Required input</label>
								<div class="popupally-info-icon popupally-info-bubble"><div info="When checked, this popup cannot be submitted if this input is empty."></div></div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="popupally-setting-section-sub-header">Placeholder Text</div>
								<input class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][multi-placeholder]" value="{{multi-placeholder}}" preview-update-target-placeholder=".popupally-preview-{{preview-element}}" />
							</td>
						</tr>
					</tbody>
					<tbody hide-toggle="select-input-type" data-dependency="popupally-select-input-type-{{id}}-{{uid}}-{{element-id}}" data-dependency-value="dropdown">
						<tr {{information-destination-form-show}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="form">
							<td class="popupally-setting-configure-table-header-col">
								Form field
							</td>
							<td>
								<select {{valid-form-field-show}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="true"
									class="full-width sign-up-form-dropdown-select-{{id}}" name="[{{id}}][{{uid}}][elements][{{element-id}}][form-select-dropdown-field]"
									preview-update-target-dropdown-selection=".popupally-preview-{{preview-element}}" popup-id="{{id}}"
									id="dropdown-form-field-{{id}}-{{uid}}-{{element-id}}">
									{{form-select-dropdown-field}}
								</select>
								<label {{valid-form-field-hide}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="false">No Sign Up HTML</label>
							</td>
						</tr>
						<tr {{information-destination-form-hide}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="email">
							<td class="popupally-setting-configure-table-header-col">
								Dropdown options
							</td>
							<td>
								<div class="popupally-setting-section-help-text">use comma to separate options</div>
								<textarea id="dropdown-email-field-{{id}}-{{uid}}-{{element-id}}" rows="3" class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][dropdown-options]"
										  preview-update-target-select-options=".popupally-preview-{{preview-element}}">{{dropdown-options}}</textarea>
							</td>
						</tr>
						<tr {{information-destination-form-hide}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="email">
							<td  class="popupally-setting-configure-table-header-col">
								Field label in email
							</td>
							<td>
								<input class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][dropdown-field-label]" value="{{dropdown-field-label}}" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input id="dropdown-checked-required-{{id}}-{{uid}}-{{element-id}}" type="checkbox" name="[{{id}}][{{uid}}][elements][{{element-id}}][checked-dropdown-required]" {{checked-dropdown-required}} value="true"/>
								<label for="dropdown-checked-required-{{id}}-{{uid}}-{{element-id}}">Required dropdown</label>
							</td>
						</tr>
					</tbody>
					<tbody hide-toggle="select-input-type" data-dependency="popupally-select-input-type-{{id}}-{{uid}}-{{element-id}}" data-dependency-value="checkbox">
						<tr {{information-destination-form-show}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="form">
							<td class="popupally-setting-configure-table-header-col">
								Form field
							</td>
							<td>
								<select {{valid-form-field-show}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="true"
									class="full-width sign-up-form-checkbox-select-{{id}}" name="[{{id}}][{{uid}}][elements][{{element-id}}][form-select-checkbox-field]">
									{{form-select-checkbox-field}}
								</select>
								<label {{valid-form-field-hide}} hide-toggle data-dependency="sign-up-form-valid-{{id}}" data-dependency-value="false">No Sign Up HTML</label>
							</td>
						</tr>
						<tr {{information-destination-form-hide}} hide-toggle data-dependency="information-destination-{{id}}" data-dependency-value="email">
							<td class="popupally-setting-configure-table-header-col">
								Field label in email
							</td>
							<td>
								<input class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][checkbox-field-label]" value="{{checkbox-field-label}}" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								Default checkbox state
								<select name="[{{id}}][{{uid}}][elements][{{element-id}}][select-checkbox-default-value]" preview-update-target-checkbox-status=".popupally-preview-{{preview-element}}">
									{{select-checkbox-default-value}}
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input id="checkbox-checked-required-{{id}}-{{uid}}-{{element-id}}" type="checkbox" name="[{{id}}][{{uid}}][elements][{{element-id}}][checked-checkbox-required]" {{checked-checkbox-required}} value="true"/>
								<label for="checkbox-checked-required-{{id}}-{{uid}}-{{element-id}}">Required checkbox</label>
								<div class="popupally-info-icon popupally-info-bubble"><div info="When checked, this popup cannot be submitted if this checkbox is unchecked."></div></div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Add styling</div>
			<div>
				<table class="popupally-setting-configure-table">
					<tbody>
						<tr>
							<td style="width:40%;">
								<select class="popupally-customization-css-add-selection" id="popupally-style-add-css-{{id}}-{{uid}}-{{element-id}}"
										popup-id="{{id}}" template-id="{{uid}}" element-id="{{element-id}}">
									{{css-options}}
								</select>
								<input type="hidden" id="popupally-style-add-css-{{id}}-{{uid}}-{{element-id}}" value="{{max-css}}" />
							</td>
							<td><div class="popupally-setting-small-button popupally-customization-css-add-button" popup-id="{{id}}" template-id="{{uid}}" element-id="{{element-id}}">Add</div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<table class="popupally-customization-table">
			<tbody class="customization-element-{{id}}-{{uid}}-{{element-id}}" responsive-id="{{responsive-id}}">
				{{css-customizations}}
			</tbody>
		</table>
		<div class="popupally-configure-element">
			<div class="popupally-setting-configure-block">
				<div class="popupally-setting-section-sub-header">
					Element Order
					<div class="popupally-setting-order-button popupally-setting-fluid-order-up" popup-id="{{id}}" template-id="{{uid}}" element-id="{{element-id}}">Move Up</div>
					<div class="popupally-setting-order-button popupally-setting-fluid-order-down" popup-id="{{id}}" template-id="{{uid}}" element-id="{{element-id}}">Move Down</div>
					<div style="clear:both;"></div>
				</div>
				<div class="popupally-setting-section-help-text">element order controls what happens when the visitors press the TAB key</div>
			</div>
		</div>
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-delete-button popupally-fluid-element-delete" popup-id="{{id}}" template-id="{{uid}}" element-id="{{element-id}}"
				 popupally-delete-warning="Deleting this element will affect all responsive views and it cannot be undone. Continue?">Delete Element</div>
			<div class="popupally-setting-regular-button popupally-fluid-element-copy" popup-id="{{id}}" template-id="{{uid}}" element-id="{{element-id}}">Copy Element</div>
		</div>
	</div>
</div>