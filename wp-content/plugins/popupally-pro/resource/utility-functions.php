<?php
function popupally_pro_add_embedded_popup($id) {
	echo PopupAllyPro::shortcode_embed_popupally_pro(array('popup_id' => $id));
}