<tr class="css-customization-element css-item-{{identifier}}-{{variable-name}}">
	<td class="popupally-customization-table-label">
		{{label}}
	</td>
	<td class="popupally-customization-table-content">
		{{start-inherit-code}}
		<select class="full-width" name="{{base-setting-name}}[css][{{variable-name}}]" {{auto-adjust}} preview-update-target-css="#popupally-preview-{{preview-element}}" preview-update-target-css-property="{{variable-name}}">
			{{options}}
		</select>
		{{end-inherit-code}}
	</td>
	<td class="popupally-customization-table-delete">
		<div class="popupally-fluid-css-delete" popupally-css-delete-element=".css-item-{{identifier}}-{{variable-name}}"
			 popupally-delete-warning="Deleting the styling will affect all responsive views and it cannot be undone. Continue?">x</div>
	</td>
</tr>