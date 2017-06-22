<div class="popupally-setting-div {{selected_item_opened}}" id="popupally-style-div-{{id}}">
	<input type="hidden" name-sync-master="{{id}}" name="[{{id}}][name]" value="{{name}}"/>
	<div class="popupally-header popupally-header-icon" toggle-target="#style-toggle-{{id}}" id="popupally-style-header-{{id}}">
		<div class="view-toggle-block">
			<input class="popupally-update-follow-scroll" name="[{{id}}][is-open]" {{selected_item_checked}} type="checkbox" value="true"
				   toggle-group="style" toggle-class="popupally-item-opened" toggle-element="#popupally-style-div-{{id}}" min-height="40" min-height-element="#popupally-style-header-{{id}}"
				   popupally-change-source="style-toggle-{{id}}" id="style-toggle-{{id}}" popup-id="{{id}}">
			<label hide-toggle="is-open" data-dependency="style-toggle-{{id}}" data-dependency-value="false">&#x25BC;</label>
			<label hide-toggle="is-open" data-dependency="style-toggle-{{id}}" data-dependency-value="true">&#x25B2;</label>
		</div>
		<div class="popupally-name-display-block">
			<div class="popupally-name-display" hide-toggle data-dependency="edit-name-style-{{id}}" data-dependency-value="display">
				<table class="popupally-header-table">
					<tbody>
						<tr>
							<td class="popupally-number-col">{{id}}. </td>
							<td class="popupally-name-label-col"><div class="popupally-name-label" name-sync-text="{{id}}">{{name}}</div></td>
							<td class="popupally-name-edit-col"><div class="pencil-icon" click-value="edit" click-target="#edit-name-style-{{id}}"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="hidden" id="edit-name-style-{{id}}" popupally-change-source="edit-name-style-{{id}}" value="display" />
			<input class="popupally-name-edit full-width" name-sync-val="{{id}}" style="display:none;"
				   hide-toggle data-dependency="edit-name-style-{{id}}" data-dependency-value="edit" size="12" value="{{name}}" />
		</div>
	</div>
	{{style-details}}
</div>