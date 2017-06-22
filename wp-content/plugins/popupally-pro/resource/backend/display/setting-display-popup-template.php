<div class="popupally-setting-div {{selected_item_opened}}" id="popupally-display-div-{{id}}">
	<div class="popupally-header popupally-header-icon" toggle-target="#display-toggle-{{id}}" id="popupally-display-header-{{id}}">
		<div class="view-toggle-block">
			<input name="[{{id}}][is-open]" {{selected_item_checked}} type="checkbox" value="true" toggle-group="display"
				   toggle-class="popupally-item-opened" toggle-element="#popupally-display-div-{{id}}" min-height="40" min-height-element="#popupally-display-header-{{id}}"
				   popupally-change-source="display-toggle-{{id}}" id="display-toggle-{{id}}" popup-id="{{id}}">
			<label hide-toggle="is-open" data-dependency="display-toggle-{{id}}" data-dependency-value="false">&#x25BC;</label>
			<label hide-toggle="is-open" data-dependency="display-toggle-{{id}}" data-dependency-value="true">&#x25B2;</label>
		</div>
		<div class="popupally-name-display-block">
			<div class="popupally-name-display" hide-toggle data-dependency="edit-name-display-{{id}}" data-dependency-value="display">
				<table class="popupally-header-table">
					<tbody>
						<tr>
							<td class="popupally-number-col">{{id}}. </td>
							<td class="popupally-name-label-col"><div class="popupally-name-label" name-sync-text="{{id}}">{{name}}</div></td>
							<td class="popupally-name-edit-col"><div class="pencil-icon" click-value="edit" click-target="#edit-name-display-{{id}}"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="hidden" id="edit-name-display-{{id}}" popupally-change-source="edit-name-display-{{id}}" value="display" />
			<input class="popupally-name-edit full-width" name-sync-val="{{id}}" style="display:none;"
				   hide-toggle data-dependency="edit-name-display-{{id}}" data-dependency-value="edit" value="{{name}}" />
		</div>
	</div>
	{{display-details}}
</div>
