<div class="popupally-customization-div {{accordion-open-class}} popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}"
	 id="popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}">
	<input type="hidden" name="[{{id}}][{{uid}}][element-order][]" class="popup-fluid-element-order-{{id}}-{{uid}}"
		   popup-id="{{id}}" template-id="{{uid}}" element-order="identifier" value="{{element-id}}" />

	<div class="popupally-header popupally-fluid-submit-icon" toggle-target="#popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}">
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
		<input type="hidden" name="[{{id}}][{{uid}}][elements][{{element-id}}][type]" value="submit" />
		<div class="popupally-setting-configure-block">
			<div class="popupally-setting-section-sub-header">Submit Button Text (HTML code NOT allowed)</div>
			<div>
				<textarea rows="3" class="full-width" name="[{{id}}][{{uid}}][elements][{{element-id}}][text]" preview-update-target-value=".popupally-preview-{{preview-element}}">{{text}}</textarea>
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