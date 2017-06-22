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
						<div class="popupally-info-icon popupally-info-bubble"><div info="Can be used to control the height of the subscribe button"></div></div>
					</td>
				</tr>
				<tr>
					<td class="popupally-customization-table-label">
						Padding Top
					</td>
					<td class="popupally-customization-table-content">
						<input size="4" name="[{{id}}][{{element_name}}-padding-top]" type="text" value="{{{{element_name}}-padding-top}}" preview-update-target-css="{{preview_element_name_specific}}-{{id}}" preview-update-target-css-property-px="padding-top">
						<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the blank space above the subscribe button text. Can be used to control the height of the subscribe button"></div></div>
					</td>
				</tr>
				<tr>
					<td class="popupally-customization-table-label">
						Padding Bottom
					</td>
					<td class="popupally-customization-table-content">
						<input size="4" name="[{{id}}][{{element_name}}-padding-bottom]" type="text" value="{{{{element_name}}-padding-bottom}}" preview-update-target-css="{{preview_element_name_specific}}-{{id}}" preview-update-target-css-property-px="padding-bottom">
						<div class="popupally-info-icon popupally-info-bubble"><div info="Controls the blank space below the subscribe button text. Can be used to control the height of the subscribe button"></div></div>
					</td>
				</tr>
				<tr>
					<td class="popupally-customization-table-label">
						Width
					</td>
					<td class="popupally-customization-table-content">
						<input size="4" name="[{{id}}][{{element_name}}-width]" type="text" value="{{{{element_name}}-width}}" preview-update-target-css="{{preview_element_name_specific}}-{{id}}" preview-update-target-css-property="width">
						<small>Enter either % or px</small>
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
				<tr>
					<td class="popupally-customization-table-label">
						Border Radius
					</td>
					<td class="popupally-customization-table-content">
						<input size="4" name="[{{id}}][{{element_name}}-border-radius]" type="text" value="{{{{element_name}}-border-radius}}" preview-update-target-css="{{preview_element_name_specific}}-{{id}}" preview-update-target-css-property-px="border-radius">px
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>