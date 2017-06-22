<div class="popupally-customization-div {{accordion-open-class}} popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}"
	 id="popup-fluid-element-customization-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}">
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
	</div>
	<div {{checked-customization-opened-true-show}} class="popup-fluid-element-customization-block" hide-toggle data-dependency="popup-fluid-element-customization-toggle-{{id}}-{{uid}}-{{element-id}}-{{responsive-id}}" data-dependency-value="true">
		<input type="hidden" name="[{{id}}][{{uid}}][elements][{{element-id}}][type]" value="submit" />
		<table class="popupally-customization-table">
			<tbody class="customization-element-{{id}}-{{uid}}-{{element-id}}" responsive-id="{{responsive-id}}">
				{{css-customizations}}
			</tbody>
		</table>
	</div>
</div>