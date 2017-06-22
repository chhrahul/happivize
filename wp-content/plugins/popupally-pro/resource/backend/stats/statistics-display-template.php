<div class="popupally-setting-div {{selected_item_opened}}" id="popupally-stats-div-{{id}}">
	<div class="popupally-header popupally-header-icon" toggle-target="#stats-toggle-{{id}}" id="popupally-stats-header-{{id}}">
		<div class="view-toggle-block">
			<input name="[{{id}}][is-open]" {{selected_item_checked}} type="checkbox" value="true"
				   toggle-class="popupally-item-opened" toggle-element="#popupally-stats-div-{{id}}" min-height="40" min-height-element="#popupally-stats-header-{{id}}"
				   popupally-change-source="stats-toggle-{{id}}" id="stats-toggle-{{id}}" popup-id="{{id}}">
			<label>Conversion Rate: {{overall-percentage}}</label>
		</div>
		<div class="popupally-name-display-block">
			<div class="popupally-name-display" hide-toggle data-dependency="edit-name-stats-{{id}}" data-dependency-value="display">
				<table class="popupally-header-table">
					<tbody>
						<tr>
							<td class="popupally-number-col">{{id}}. </td>
							<td class="popupally-name-label-col"><div class="popupally-name-label" name-sync-text="{{id}}">{{name}}</div></td>
							<td class="popupally-name-edit-col"><div class="pencil-icon" click-value="edit" click-target="#edit-name-stats-{{id}}"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="hidden" id="edit-name-stats-{{id}}" popupally-change-source="edit-name-stats-{{id}}" value="display" />
			<input class="popupally-name-edit full-width" name-sync-val="{{id}}" style="display:none;"
				   hide-toggle data-dependency="edit-name-stats-{{id}}" data-dependency-value="edit" size="12" value="{{name}}" />
		</div>
	</div>
	<div hide-toggle="{{id}},is-open" data-dependency="stats-toggle-{{id}}" data-dependency-value="true">
		<div class="popupally-stats-section">
			{{detailed-stats}}
		</div>
	</div>
</div>