<div>
	<table class="popupally-customization-table">
		<tbody>
			<tr>
				<td class="popupally-customization-table-label">
					Color
				</td>
				<td class="popupally-customization-table-content">
					<input size="8" class="nqpc-picker-input-iyxm" name="[{{id}}][{{element_name}}-color]" type="text" value="{{{{element_name}}-color}}" preview-update-target-css="{{preview_element_name}}-{{id}}" preview-update-target-css-property="color" data-default-color="#444444">
				</td>
			</tr>
			<tr>
				<td class="popupally-customization-table-label">
					Font
				</td>
				<td class="popupally-customization-table-content">
					{{font}}
				</td>
			</tr>
		</tbody>
	</table>
	<div class="popupally-advanced-customization">
		<div class="popupally-customization-advanced-div">
			<input type="checkbox" popupally-change-source="{{element_name}}-advanced-{{id}}" id="{{element_name}}-advanced-{{id}}" class="popupally-customization-advanced-checkbox" value="true" /><label for="{{element_name}}-advanced-{{id}}">Show advanced customization options</label>
		</div>
		<table class="popupally-customization-table" style="display:none;" hide-toggle data-dependency="{{element_name}}-advanced-{{id}}" data-dependency-value="true">
			<tbody>
				<tr>
					<td class="popupally-customization-table-label">
						Font Size
					</td>
					<td class="popupally-customization-table-content">
						<input size="4" name="[{{id}}][{{element_name}}-font-size]" type="text" value="{{{{element_name}}-font-size}}" preview-update-target-css="{{preview_element_name_specific}}-{{id}}" preview-update-target-css-property-px="font-size">
					</td>
				</tr>
				<tr>
					<td class="popupally-customization-table-label">
						Font Weight
					</td>
					<td class="popupally-customization-table-content">
						{{font-weight}}
					</td>
				</tr>
				<tr>
					<td class="popupally-customization-table-label">
						Line Height
					</td>
					<td class="popupally-customization-table-content">
						<input size="4" name="[{{id}}][{{element_name}}-line-height]" type="text" value="{{{{element_name}}-line-height}}" preview-update-target-css="{{preview_element_name_specific}}-{{id}}" preview-update-target-css-property-px="line-height">
						<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the spacing between multi-line text"></div></div>
					</td>
				</tr>
				<tr>
					<td class="popupally-customization-table-label">
						Text Alignment
					</td>
					<td class="popupally-customization-table-content">
						{{align}}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>