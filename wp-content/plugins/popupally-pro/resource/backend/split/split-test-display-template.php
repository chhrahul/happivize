<div class="popupally-setting-div {{selected_item_opened}}" id="popupally-split-test-div-{{id}}">
	<div class="popupally-header popupally-header-icon" toggle-target="#split-test-toggle-{{id}}" id="popupally-split-test-header-{{id}}">
		<div class="view-toggle-block">
			<input name="[tests][{{id}}][is-open]" {{selected_item_checked}} type="checkbox" value="true"
				   toggle-class="popupally-item-opened" toggle-element="#popupally-split-test-div-{{id}}" min-height="40" min-height-element="#popupally-split-test-header-{{id}}"
				   popupally-change-source="split-test-toggle-{{id}}" id="split-test-toggle-{{id}}" popup-id="{{id}}">
			{{test-state}}
		</div>
		<div class="popupally-name-display-block">
			<div class="popupally-name-display" hide-toggle data-dependency="edit-name-split-test-{{id}}" data-dependency-value="display">
				<table class="popupally-header-table">
					<tbody>
						<tr>
							<td class="popupally-number-col">{{id}}. </td>
							<td class="popupally-name-label-col"><div class="popupally-name-label" name-sync-text="split-test-{{id}}">{{name}}</div></td>
							<td class="popupally-name-edit-col"><div class="pencil-icon" click-value="edit" click-target="#edit-name-split-test-{{id}}"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="hidden" id="edit-name-split-test-{{id}}" popupally-change-source="edit-name-split-test-{{id}}" value="display" />
			<input class="popupally-name-edit full-width" name-sync-val="split-test-{{id}}" style="display:none;"
				   hide-toggle data-dependency="edit-name-split-test-{{id}}" data-dependency-value="edit" size="12" value="{{name}}" />
		</div>
		<input type="hidden" name-sync-master="split-test-{{id}}" name="[tests][{{id}}][name]" value="{{name}}"/>
	</div>
	<div hide-toggle="is-open" data-dependency="split-test-toggle-{{id}}" data-dependency-value="true">
		<input type="hidden" id="popupally-split-test-max-variate-{{id}}" value="{{max-variate}}"/>
		<div class="popupally-setting-section" style="clear:both;">
			<div class="popupally-setting-section-header"><label for="split-test-{{id}}-state">Test status</label></div>
			<select name="[tests][{{id}}][select-state]" id="split-test-{{id}}-state">
				<option value="stopped" {{select-state-stopped-selected}}>Stopped</option>
				<option value="running" {{select-state-running-selected}}>Running</option>
			</select>
		</div>
		<div class="popupally-setting-section">
			<div class="popupally-setting-section-header">Design and Test Weight</div>
			<table class="popupally-split-test-definition-table">
				<tbody id="popupally-split-test-definition-{{id}}">
					<tr>
						<th class="popupally-split-test-header-col"></th>
						<th class="popupally-split-test-popup-col">Popup</th>
						<th class="popupally-split-test-weight-col">Weight</th>
						<th class="popupally-split-test-delete-col"></th>
					</tr>
{{detailed-split-test}}
				</tbody>
			</table>
		</div>
		<div class="popupally-setting-section">
			<div class="popupally-setting-section-header">Overall Result</div>
			<div {{results-not-available-show}}>No result is available yet.</div>
			<div {{results-available-show}}>
				<table class="popupally-split-test-definition-table">
					<tbody id="popupally-split-test-definition-{{id}}">
						<tr>
							<th class="popupally-split-test-result-header-col"></th>
							<th class="popupally-split-test-result-views-col"># of views</th>
							<th class="popupally-split-test-result-target-col">Target</th>
							<th class="popupally-split-test-result-rates-col">Result</th>
						</tr>
{{overall-result}}
					</tbody>
				</table>
			</div>
		</div>
		<div class="popupally-setting-section">
			<div class="popupally-setting-section-header">Detailed Results</div>
			<div {{results-not-available-show}}>No result is available yet.</div>
			<div {{results-available-show}}>
				<div>
					<div class="full-width">
						<label for="split-test-{{id}}-select-design-to-show" class="popupally-stats-filter-header">Design</label>
						<select name="[tests][{{id}}][select-design-to-show]" id="split-test-{{id}}-select-design-to-show" popupally-change-source="split-test-{{id}}-select-design-to-show">{{select-design-to-show}}</select>
					</div>
					<div class="full-width">
						<label for="split-test-{{id}}-select-category-to-show" class="popupally-stats-filter-header">Stats to show</label>
						<select name="[tests][{{id}}][select-category-to-show]" id="split-test-{{id}}-select-category-to-show" popupally-change-source="split-test-{{id}}-select-category-to-show">{{select-category-to-show}}</select>
					</div>
					<div class="full-width">
						<label for="split-test-{{id}}-select-filter-to-show" class="popupally-stats-filter-header">Desktop and/or mobile</label>
						<select name="[tests][{{id}}][select-filter-to-show]" id="split-test-{{id}}-select-filter-to-show" popupally-change-source="split-test-{{id}}-select-filter-to-show">{{select-filter-to-show}}</select>
					</div>
				</div>
{{detailed-stats}}
			</div>
		</div>
		<div class="popupally-setting-section" style="clear:both;">
			<div class="popupally-setting-delete-button" popupally-delete-element="#popupally-split-test-div-{{id}}"
				 popupally-delete-warning="Deleting this split test will remove all the test data and it cannot be undone. Continue?">Delete Test</div>
			<div class="popupally-setting-regular-button" style="float:right;" popupally-add-split-test-variate="{{id}}">Add Variate</div>
		</div>
	</div>
</div>