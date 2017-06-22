<tr class="css-customization-element css-item-{{identifier}}-{{variable-name}}">
	<td class="popupally-customization-table-label">
		{{label}}
	</td>
	<td class="popupally-customization-table-content">
		{{start-inherit-code}}
		<input class="full-width" id="image-input-{{preview-element}}-{{variable-name}}" {{auto-adjust}} name="{{base-setting-name}}[css][{{variable-name}}]" type="text" value="{{value}}" preview-update-target-css-background-img="#popupally-preview-{{preview-element}}" />
		<div upload-image="#image-input-{{preview-element}}-{{variable-name}}">Upload Image</div>
		{{end-inherit-code}}
	</td>
	<td class="popupally-customization-table-delete">
		<div class="popupally-fluid-css-delete" popupally-css-delete-element=".css-item-{{identifier}}-{{variable-name}}"
			 popupally-delete-warning="Deleting the styling will affect all responsive views and it cannot be undone. Continue?">x</div>
	</td>
</tr>