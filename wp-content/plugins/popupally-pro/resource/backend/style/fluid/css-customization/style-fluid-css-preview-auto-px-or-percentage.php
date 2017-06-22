<tr class="css-customization-element css-item-{{identifier}}-{{variable-name}}">
	<td class="popupally-customization-table-label">
		{{label}}
	</td>
	<td class="popupally-customization-table-content">
		{{start-inherit-code}}
		<div><input size="8" name="{{base-setting-name}}[css][{{variable-name}}]" {{auto-adjust}} verify-auto-px-pct-input="#px-pct-input-error-{{preview-element}}-{{variable-name}}" type="text" value="{{value}}" preview-update-target-css="#popupally-preview-{{preview-element}}" preview-update-target-css-property="{{variable-name}}"> Please enter 'auto', 'px' or '%'</div>
		<small class="sign-up-error" id="px-pct-input-error-{{preview-element}}-{{variable-name}}"></small>
		{{end-inherit-code}}
	</td>
	<td class="popupally-customization-table-delete">
		<div class="popupally-fluid-css-delete" popupally-css-delete-element=".css-item-{{identifier}}-{{variable-name}}"
			 popupally-delete-warning="Deleting the styling will affect all responsive views and it cannot be undone. Continue?">x</div>
	</td>
</tr>