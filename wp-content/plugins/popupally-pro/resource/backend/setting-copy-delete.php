<h3>Copy/Delete Popup</h3>
<?php foreach ($style as $id => $setting) { ?>
<div class="popupally-setting-div" id="popupally-copy-div-<?php echo $id; ?>">
	<div class="popupally-header popupally-header-icon" toggle-target="#copy-toggle-<?php echo $id;?>" id="popupally-copy-header-<?php echo $id; ?>">
		<div class="view-toggle-block">
			<input id="copy-toggle-<?php echo $id;?>" popupally-change-source="copy-toggle-<?php echo $id;?>" type="checkbox" value="true" toggle-group="copy"
				   toggle-class="popupally-item-opened" toggle-element="#popupally-copy-div-<?php echo $id; ?>" min-height="40" min-height-element="#popupally-copy-header-<?php echo $id; ?>"  popup-id="<?php echo $id;?>">
			<label hide-toggle data-dependency="copy-toggle-<?php echo $id; ?>" data-dependency-value="false">&#x25BC;</label>
			<label style="display:none;" hide-toggle data-dependency="copy-toggle-<?php echo $id; ?>" data-dependency-value="true">&#x25B2;</label>
		</div>
		<div class="popupally-name-display-block">
			<div class="popupally-name-display" hide-toggle data-dependency="edit-name-copy-<?php echo $id; ?>" data-dependency-value="display">
				<table class="popupally-header-table">
					<tbody>
						<tr>
							<td class="popupally-number-col"><?php echo $id; ?>. </td>
							<td class="popupally-name-label-col"><div class="popupally-name-label" name-sync-text="<?php echo $id; ?>"><?php echo esc_attr($style[$id]['name']); ?></div></td>
							<td class="popupally-name-edit-col"><div class="pencil-icon" click-value="edit" click-target="#edit-name-copy-<?php echo $id; ?>"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<input type="hidden" id="edit-name-copy-<?php echo $id; ?>" popupally-change-source="edit-name-copy-<?php echo $id; ?>" value="display" />
			<input class="popupally-name-edit full-width" name-sync-val="<?php echo $id; ?>" style="display:none;"
				   hide-toggle data-dependency="edit-name-copy-<?php echo $id; ?>" data-dependency-value="edit" value="<?php echo esc_attr($style[$id]['name']); ?>" />
		</div>
	</div>
	<div class="popupally-setting-section" style="display:none;" hide-toggle data-dependency="copy-toggle-<?php echo $id; ?>" data-dependency-value="true">
		<div class="popupally-setting-configure-block">
			<div>
				<input name="<?php echo '[' . $id . ']'; ?>[delete]" popupally-change-source="delete-<?php echo $id; ?>" id="delete-<?php echo $id; ?>" class="delete-popup-checkbox" type="checkbox" value="true"/>
				<label for="delete-<?php echo $id; ?>"><strong>Delete</strong> your popup on save</label>
			</div>
		</div>
		<div class="popupally-setting-configure-block" hide-toggle data-dependency="delete-<?php echo $id; ?>" data-dependency-value="false">
			<div>
				<input name="<?php echo '[' . $id . ']'; ?>[copy]" popupally-change-source="copy-<?php echo $id; ?>" id="copy-<?php echo $id; ?>" type="checkbox" value="true"/>
				<label for="copy-<?php echo $id; ?>"><strong>Copy</strong> on Save as</label>
				<input readonly readonly-toggle data-dependency="copy-<?php echo $id; ?>" data-dependency-value="true" name="<?php echo '[' . $id . ']'; ?>[copy-name]" id="copy-name-<?php echo $id; ?>" type="text" size="20" value="<?php echo $setting['name']; ?> Copy"/>
			</div>
		</div>
	</div>
</div>
<?php } ?>