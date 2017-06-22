/* global popupally_pro_default_code, popupally_pro_data_object, wp, popupallypro_jscolor */

jQuery(document).ready(function($) {
	// <editor-fold defaultstate="collapsed" desc="adjust ajax url protocol if needed">
	function verify_ajax_url() {
		if ('https:' === window.location.protocol) {
			if ('http:' === popupally_pro_data_object.ajax_url.substr(0, 5).toLowerCase()) {
				popupally_pro_data_object.ajax_url = 'https:' + popupally_pro_data_object.ajax_url.substr(5);
			}
		}
	}
	verify_ajax_url();
	// </editor-fold>
	var popupally_pro_selected_tab = $('#selected-tab'),
		popupally_pro_follow_scroll = $(),
		popupally_pro_wait_overlay = $('#popupally-import-wait-overlay');

	function serialize_form_values($parent_form) {
		$('.popupally-pro-option-setting-form[serialize-target]').each(function() {
			var $this = $(this),
				target = $this.attr('serialize-target'),
				new_form = $("<form></form>");
			$this.children().clone().appendTo(new_form);
			$('.' + target).val(JSON.stringify(new_form.serializeArray()));
		});
	}
	function remove_hidden_templates(){
		$('.template-customization-block:not(.template-customization-block-active)').remove();
	}
	$('.popupally-setting-submit-button').on('click', function(e) {
		if ($('.delete-popup-checkbox:checked').length > 0) {
			var conf = confirm("Deleted popups cannot be restored. Do you want to continue?");
			if(conf !== true){
				return false;
			}
		}
		var error_elements = $('.template-customization-block.template-customization-block-active').find('[html-code-source]:not(:empty)');
		if (error_elements.length > 0) {
			var key = 0, popup_id = null, element_name = null,
				error_text = "Potential HTML error detected in the following elements:\n",
				max_error = Math.min(3, error_elements.length);
			for (key = 0; key < max_error; ++key) {
				popup_id = error_elements[key].getAttribute('popup-id');
				element_name = error_elements[key].getAttribute('html-code-source');
				error_text += '- Popup #' + popup_id + ' [' + element_name + "]\n";
			}
			if (max_error < error_elements.length) {
				error_text += 'and ' + (error_elements.length - max_error) + " more\n";
			}
			error_text += "\nMalformed HTML code might affect the entire page layout. Do you want to continue?";
			var conf = confirm(error_text);
			if(conf !== true){
				return false;
			}
		}
		popupally_pro_wait_overlay.show();
		remove_hidden_templates();
		serialize_form_values($(this).parents('form'));
		return true;
	});
	function resize_follow_scroll() {
		popupally_pro_follow_scroll.resize();
	}
	$(document).on('change propertychange', '[input-all-false-check]', function(e) {
		var selector = $(this).attr('input-all-false-check'),
		is_checked = $('[input-all-false-check=' + selector + ']:checked').length > 0;
		if (is_checked) {
			$('.' + selector).show();
		} else {
			$('.' + selector).hide();
		}
		resize_follow_scroll();
	});
	function process_input_field($parent, input, checkbox_inputs, hidden_inputs, text_inputs, current_count, prefix) {
		var $input = $(input),
		input_name = $input.attr('name'),
		input_type = $input.attr('type'),
		input_value = check_for_non_ascii_characters($input.val()),
		variable_name = '';

		if (input_name) {
			input_name = check_for_non_ascii_characters($input.attr('name'));
			current_count += 1;
			if (input_type === 'checkbox') {
				variable_name = 'checkbox-form-fields';
				checkbox_inputs.push(input_name);
			} else if (input_type === 'hidden') {
				variable_name = 'hidden-form-fields';
				hidden_inputs.push(input_name);
			} else {
				variable_name = 'other-form-fields';
				text_inputs.push(input_name);
			}
			$parent.before($(prefix + variable_name + '-name][' + current_count + ']"/>').val(input_name));
			$parent.before($(prefix + variable_name + '-value][' + current_count + ']"/>').val(input_value));
		}
		return current_count;
	}
	function process_select_field($parent, input, result_array, current_count, prefix, id, variable_name) {
		var $input = $(input),
		input_name =$input.attr('name'),
		input_value = $input.html();

		if (input_name) {
			current_count += 1;
			$parent.before($(prefix + variable_name + '-name][' + current_count + ']"/>').val(input_name));
			$parent.before($(prefix + variable_name + '-value][' + current_count + ']"/>').val(input_value).attr('id', variable_name + '-' + id + '-' + input_name));
			result_array.push(input_name);
		}
		return current_count;
	}
	function process_included_scripts($parent, input, current_count, prefix, id, variable_name) {
		var $input = $(input),
		script_path = $input.attr('src');

		if (script_path) {
			current_count += 1;
			$parent.before($(prefix + variable_name + '][' + current_count + ']"/>').val(script_path));
		}
		return current_count;
	}
	function search_field_array_for_string(source, target_string) {
		var i = 0, lowercase = '', len = source.length;
		for (; i<len; ++i) {
			lowercase = source[i].toLowerCase();

			if(-1 < lowercase.indexOf(target_string)) {
				return source[i];
			}
		}
		return '';
	}
	function generate_field_array_option_list(source) {
		var i = 0, len = source.length, result = $('<select></select>'), val;
		for (; i<len; ++i) {
			result.append($('<option></option>').attr('value', source[i]).text(source[i]));
		}
		return result.html();
	}
	function select_option_value($select, value) {
		var sel = $select.find('option[value="' + value + '"]');
		$select.children().not(sel).removeAttr("selected");
		sel.attr("selected", "selected");
		return $select;
	}
	function fluid_template_select_input_field(field_list, field_name, is_email_field) {
		var i = 0, count = field_list.length, $elem, $is_email, element_name;
		for (; i < count; ++i) {
			$elem = $(field_list[i]);
			element_name = $elem.attr('name');
			$is_email = $('[name="' + element_name.replace(/form-select-single-field/g, 'checked-is-email') + '"]');
			if ($is_email.prop('checked')) {
				if (is_email_field) {
					select_option_value($elem, field_name).change();
					return;
				}
			} else {
				if (!is_email_field) {
					select_option_value($elem, field_name).change();
					return;
				}
			}
		}
	}
	function populate_input_selection_list(selection_elements, option_list, email_input_name, name_input_name) {
		var i = 0, len = selection_elements.length, $elem = null, previous_value = null, splash_field = null, element_name, fluid_template, is_fluid,
			fluid_input_field_map = {}, fluid_input_field_selected_values = {},
			options = generate_field_array_option_list(option_list);
		for (; i<len; ++i) {
			$elem = $(selection_elements[i]);
			previous_value = $elem.val();
			$elem.empty().append(options);
			
			element_name = $elem.attr('name');
			if (element_name.indexOf('][fluid_') > 0) {
				is_fluid = true;
				fluid_template = element_name.substr(0, element_name.indexOf('[elements]'));
				if (!(fluid_template in fluid_input_field_map)) {
					fluid_input_field_map[fluid_template] = [];
					fluid_input_field_selected_values[fluid_template] = {};
				}
			} else {
				is_fluid = false;
			}

			if('' !== previous_value && -1 < $.inArray(previous_value, option_list)) {
				select_option_value($elem, previous_value).change();
				if (is_fluid) {
					if (previous_value === email_input_name) {
						fluid_input_field_selected_values[fluid_template]['email'] = $elem;
					}
					if (previous_value === name_input_name) {
						fluid_input_field_selected_values[fluid_template]['name'] = $elem;
					}
				}
			} else if (is_fluid) {	// process fluid template input fields
				if (element_name.indexOf('][form-select-single-field]') > 0) {
					fluid_input_field_map[fluid_template].push($elem);
				}
			} else {
				splash_field = $elem.attr('sign-up-form-field');
				if('email' === splash_field && '' !== email_input_name) {
					$elem.val(email_input_name).change();
				} else if('name' === splash_field && '' !== name_input_name) {
					$elem.val(name_input_name).change();
				}
			}
		}
		// assign email and name to unassigned fluid template fields
		for (fluid_template in fluid_input_field_map) {
			if ('' !== email_input_name && !('email' in fluid_input_field_selected_values[fluid_template])) {
				fluid_template_select_input_field(fluid_input_field_map[fluid_template], email_input_name, true);
			}
			if ('' !== name_input_name && !('name' in fluid_input_field_selected_values[fluid_template])) {
				fluid_template_select_input_field(fluid_input_field_map[fluid_template], name_input_name, false);
			}
		}
	}
	function reset_sign_up_form_related_fields(form_action_element, form_method_element, text_select_element, checkbox_select_element, dropdown_select_element, form_valid_element) {
		form_action_element.val('');
		form_method_element.val('get');
		text_select_element.empty().append('<option value=""></option>');
		checkbox_select_element.empty().append('<option value=""></option>');
		dropdown_select_element.empty().append('<option value=""></option>');
		form_valid_element.val('false').change();
	}
	$(document).on('change', '.sign-up-form-raw-html', function(e) {
		var $this = $(this),
		id = $this.attr('popup-id'),
		$error = $('#sign-form-error-' + id),
		$parent = $this.parent(),
		form_code = $.trim($this.val()),
		form_method_element = $('#sign-up-form-method-' + id),
		form_action_element = $('#sign-up-form-action-' + id),
		form_valid_element = $('#sign-up-form-valid-' + id),
		text_select_element = $('.sign-up-form-select-' + id),
		checkbox_select_element = $('.sign-up-form-checkbox-select-' + id),
		dropdown_select_element = $('.sign-up-form-dropdown-select-' + id),
		$parsed_form = null;

		var cleaned_form_code = check_for_non_ascii_characters(form_code);
		if (cleaned_form_code !== form_code) {
			form_code = cleaned_form_code;
			$this.val(form_code);
		}
		$error.hide();
		$('.sign-up-form-generated-' + id).remove();
		if('' === form_code) {
			reset_sign_up_form_related_fields(form_action_element, form_method_element, text_select_element, checkbox_select_element, dropdown_select_element, form_valid_element)
			return;
		}
		try{
			$parsed_form = $(form_code);
		}catch(e){
			$error.show().text('Invalide form code. Please copy the entire HTML code block from your mailing list provider into the Sign-up form HTML field.');

			reset_sign_up_form_related_fields(form_action_element, form_method_element, text_select_element, checkbox_select_element, dropdown_select_element, form_valid_element)
			return;
		}

		var $form = $parsed_form.find('form');
		if(0 === $form.length) {
			$form = $parsed_form.filter('form');
		}
		if(0 === $form.length) {
			$error.show().text('A <form> element could not be found in the Sign-up form HTML Code you entered. Please copy the entire HTML code block from your mailing list provider into the Sign-up form HTML field.');

			reset_sign_up_form_related_fields(form_action_element, form_method_element, text_select_element, checkbox_select_element, dropdown_select_element, form_valid_element)
			return;
		}
		if($form.length > 1) {
			$error.show().text('More than one form section is found. Only the first one will be used.');
			$form = $($form[0]);
		}
		form_valid_element.val('true').change();
		var form_method = $form.attr('method');
		if (typeof form_method === typeof undefined || form_method === false) {
			form_method = 'get';
		}
		form_method_element.val(form_method);
		form_action_element.val($form.attr('action'));

		var text_inputs = [''], hidden_inputs = [''], checkbox_inputs = [''], select_inputs = [''],
		email_input_name = '', name_input_name = '',
		count = 0,
		prefix = '<input class="sign-up-form-generated-' + id + '" type="hidden" name="[' + id + '][';

		$form.find('input[type!="submit"]').each(function(index, input) {
			count = process_input_field($parent, input, checkbox_inputs, hidden_inputs, text_inputs, count, prefix);
		});
		$form.find('textarea').each(function(index, input) {
			count = process_input_field($parent, input, checkbox_inputs, hidden_inputs, text_inputs, count, prefix);
		});
		$form.find('select').each(function(index, input) {
			count = process_select_field($parent, input, select_inputs, count, prefix, id, 'dropdown-form-fields');
		});
		$parsed_form.filter('script[type="text/javascript"]').each(function(index, input) {
			count = process_included_scripts($parent, input, count, prefix, id, 'javascript-links');
		});
		$parsed_form.find('script[type="text/javascript"]').each(function(index, input) {
			count = process_included_scripts($parent, input, count, prefix, id, 'javascript-links');
		});
		email_input_name = search_field_array_for_string(text_inputs, 'email');
		name_input_name = search_field_array_for_string(text_inputs, 'name');
		populate_input_selection_list(text_select_element, text_inputs, email_input_name, name_input_name);
		populate_input_selection_list(checkbox_select_element, checkbox_inputs, '', '');
		populate_input_selection_list(dropdown_select_element, select_inputs, '', '');
	});
	function adjust_follow_scroll_window_location($elem, window_view_top, window_view_bottom) {
		var $parent = $elem.parent(),
			parent_top = $parent.offset().top,
			parent_height = $parent.height(),
			parent_width = $parent.width(),
			parent_bottom = parent_top + parent_height,
			elem_height = $elem.height() + 30,
			offset = 0,
			step_aside = $elem.hasClass('step-aside');
		if (!(parent_top > window_view_bottom || parent_bottom < window_view_top)) {
			parent_top = parent_top - 30;
			offset = Math.min(Math.max(0, window_view_top - parent_top), parent_height - elem_height);
			$elem.css('margin-top', offset);
			if (step_aside) {
				if (offset > 0) {
					$elem.css('margin-left', parent_width+50);
				} else {
					$elem.css('margin-left', 0);
				}
			} else {
				$elem.css('margin-left', 0);
			}
		}
	}
	$(window).on('scroll', function(e) {
		var window_view_top = $(window).scrollTop(),
			window_view_bottom = window_view_top + $(window).height();
		if (popupally_pro_follow_scroll){
			popupally_pro_follow_scroll.each(function(index, elem){
				adjust_follow_scroll_window_location($(elem), window_view_top, window_view_bottom);
			});
		}
	});
	function collapse_all_popups(group, except){
		var index = 0,
			elem = null,
			elems = $('[toggle-group="' + group + '"]'),
			selector = '',
			is_checked = false;
		for (index = 0;index<elems.length;++index) {
			elem = $(elems[index]);
			selector = elem.attr('toggle-element');
			if (selector !== except) {
				is_checked = elem.prop('checked');
				if (is_checked) {
					elem.prop('checked', false).change();
				}
			}
		}
	}
	var check_toggle_group = true,
		animation_depth = 0;
	function scroll_element_info_view(target) {
		$('html,body').animate({ scrollTop: target.offset().top - 40}, 200);
		update_follow_scroll();
	}
	function insert_detailed_customization_section(popup_id, response) {
		var result = JSON.parse(response);
		try {
			if ('error' in result) {
				throw(result['error']);
			} else {
				var source = result['style'],
				target = $('#popupally-style-loading-wait-' + popup_id);
				source = $(source);
				target.before(source);
				target.remove();
				bind_incremental_dependencies(source);

				source = result['display'],
				target = $('#popupally-display-loading-wait-' + popup_id);
				source = $(source);
				target.before(source);
				target.remove();
				bind_incremental_dependencies(source);

				update_follow_scroll();
			}
		} catch (e) {
			alert("Cannot display the styling details due to error:\n[" + e + "]\nPlease refresh the page and try again.");
		}
	}
	function ensure_detailed_customization_section_is_loaded(popup_id) {
		if ($('#popupally-setting-display-customization-section-' + popup_id).length <= 0 || $('#popupally-setting-style-customization-section-' + popup_id).length <= 0) {
			try{
				var data = {
						action: 'popupally_pro_generate_detail_code',
						nonce: popupally_pro_data_object.update_nonce,
						id: popup_id
					};

				$.ajax({
					type: "POST",
					url: popupally_pro_data_object.ajax_url,
					data: data,
					success: function(response) {
						insert_detailed_customization_section(popup_id, response);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert("Cannot show customization details due to error:\n[" + thrownError + "]\nPlease refresh the page and try again.");
					}
				});
			}catch(e){
				alert("Cannot show customization details due to error:\n[" + e + "]\nPlease refresh the page and try again.");
			}
		}
	}
	$(document).on('change propertychange keyup input paste', "[toggle-element]", function(e) {
		var $this = $(this),
			selector = $this.attr('toggle-element'),
			target = $(selector),
			group = $this.attr('toggle-group'),
			toggle_class = $this.attr('toggle-class'),
			is_checked = $this.prop('checked'),
			orig_height = target.outerHeight(true),
			min_height = $this.attr('min-height'),
			min_height_element = $this.attr('min-height-element'),
			popup_id = $this.attr('popup-id');
		++animation_depth;
		if (typeof min_height_element !== typeof undefined && min_height_element !== false) {
			min_height_element = $(min_height_element).outerHeight(true);
			min_height = Math.max(min_height, min_height_element);
		}
		if (check_toggle_group) {
			// duplicate action between display and style settings
			if (group === 'display') {
				check_toggle_group = false;
				$('#style-toggle-' + popup_id).prop('checked', is_checked).change();
				check_toggle_group = true;
			} else if (group === 'style') {
				check_toggle_group = false;
				$('#display-toggle-' + popup_id).prop('checked', is_checked).change();
				check_toggle_group = true;
			}
		}
		if (is_checked) {
			if (group) {
				collapse_all_popups(group, selector);
			}
			if (animation_depth > 1) {
				target.css('overflow', 'visible').css('height', 'auto').addClass(toggle_class);
			} else {
				target.animate({height:orig_height + 'px'}, 200,
					function() {
						target.css('overflow', 'visible').css('height', 'auto');
					}
				).addClass(toggle_class);
			}
			if (check_toggle_group) {
				if ('style' === group || 'display' === group) {
					ensure_detailed_customization_section_is_loaded(popup_id);
				}
			}
		} else {
			if (animation_depth > 1) {
				target.css('overflow', 'hidden').removeClass(toggle_class);
			} else {
				target.animate({height:min_height + 'px'}, 200,
					function() {
						target.css('overflow', 'hidden');
					}
				).removeClass(toggle_class);
			}
		}
		$(".popupally-name-edit").filter(":focus").focusout();
		--animation_depth;
	});
	function update_follow_scroll() {
		if (popupally_pro_selected_tab.val() === 'style') {
			var opened_section = $('.popupally-setting-div').filter('.popupally-item-opened');
			if (opened_section.length > 0) {
				popupally_pro_follow_scroll = opened_section.find('.template-customization-block-active').find('.follow-scroll').filter(":visible");
				resize_follow_scroll();
				return;
			}
		}
		popupally_pro_follow_scroll = $();
	}
	function update_signup_field_hide_status(popup_id, selected_template) {
		var index = 0,
			target = '',
			active = $('[signup-form-hide][popup-id="' + popup_id + '"][template-id="' + selected_template + '"]');
		for (index = 0;index < active.length; ++index){
			target = active[index].attributes['signup-form-hide'].value;
			if (active[index].checked) {
				$('[popup-id="' + popup_id + '"][signup-html-template="' + target + '"]').hide();
			}else{
				$('[popup-id="' + popup_id + '"][signup-html-template="' + target + '"]').show();
			}
		}
	}
	function update_selected_template(id, selected) {
		var target_customization_block = null,
			customization_section = $('#template-customization-section-' + id),
			input_element = $('#template-selection-value-' + id);
		input_element.val(selected);

		/* add customization section if not there */
		customization_section.find('.template-customization-block').removeClass("template-customization-block-active");
		target_customization_block = $("#template-customization-block-" + id + '-' + selected);
		if (target_customization_block.length === 0) {
			var code = popupally_pro_default_code['html'][selected],
				css = popupally_pro_default_code['css'][selected];

			code = code.replace(/--id--/g, id).replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url);
			css = css.replace(/--id--/g, id).replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url);
			target_customization_block = $(code);
			customization_section.append(target_customization_block);
			bind_incremental_dependencies(target_customization_block);
			 $("head").append('<style type="text/css">' + css + '</style>'); 
		}
		target_customization_block.addClass("template-customization-block-active");
		update_signup_field_hide_status(id, selected);
		update_follow_scroll();
		$('.sign-up-form-raw-html[popup-id="' + id + '"]').change();
		$('#information-destination-' + id).change();
	}
	$('html').on('change', '.popupally-setting-style-template-select', function(e) {
		var $this = $(this),
			id = $this.attr('popup-id'),
			selected = $this.val();

		if (selected === 'iwjdhs') {	// fluid template
			selected = $('#fluid-template-selector-' + id).val()
		}
		update_selected_template(id, selected);
	});
	$('html').on('change', '.popupally-setting-style-fluid-template-select', function(e) {
		var $this = $(this),
			id = $this.attr('popup-id'),
			selected = $this.val();
		update_selected_template(id, selected);
	});
	$('html').on('click', ".popupally-header", function(e) {
		var selector = $(this).attr('toggle-target');
		$(selector).prop('checked', !$(selector).prop('checked'));
		$(selector).change();
	});
	$('html').on('click', ".popupally-style-header-name", function(e) {
		e.stopPropagation();
	});
	/* -------------------- start import and export -------------------- */
	$("[export-link][export-selection]").on('click', function(e) {
		var selector = $(this).attr('export-selection'),
		link = $(this).attr('export-link');
		link = link + '&id=' + $(selector).val();
		window.open(link, '_blank');
		return false;
	});
	function process_import_result(id, response, file_name) {
		var result = JSON.parse(response);
		try {
			if ('error' in result) {
				throw(result['error']);
			} else {
				var source = result['display'],
					target = $('#popupally-display-div-' + id);
				source = $(source);
				target.before(source);
				target.remove();
				bind_incremental_dependencies(source);

				source = result['style'];
				target = $('#popupally-style-div-' + id);
				source = $(source);
				target.before(source);
				target.remove();
				bind_incremental_dependencies(source);

				source = result['css'];
				target = $('#popupally-preview-css-' + id);
				target.before(source);
				target.remove();
				update_follow_scroll();
			}
			alert("Import successful:\n[" + file_name + "] => Popup #" + id);
		} catch (e) {
			alert("Cannot import settings due to error:\n[" + e + "]\nPlease refresh the page and try again.");
		}finally{
			popupally_pro_wait_overlay.hide();
		}
	}
	$('#popupally-import-file').change(function(e){
		if (e.target.files[0]) {
			$('#import-button').show();
			var index = e.target.files[0].name.indexOf(' - '),
				num = e.target.files[0].name.substring(0, index);
			if ($('#popupally-import-selection option[value="' + num + '"]').length !== 0) {
				$('#popupally-import-selection').val(num);
			}
		} else {
			$('#import-button').hide();
		}
	});
	$('[import-selection]').click(function(e) {
		var selector = $(this).attr('import-selection'),
		id = $(selector).val(),
		file = document.getElementById('popupally-import-file').files[0],
		file_name = document.getElementById('popupally-import-file').files[0].name;
		if (file) {
			var conf = confirm("Import operation will overwrite the current settings for Popup #" + id + ".\nThis operation cannot be undone. Do you want to continue?");
			if(conf !== true){
				return false;
			}
			popupally_pro_wait_overlay.show();
			var reader = new FileReader();
			reader.onload = function(e) {
				try{
					var all_lines = e.target.result,
						data = {
							action: 'popupally_pro_generate_import_code',
							nonce: popupally_pro_data_object.update_nonce,
							setting: encodeURI(all_lines),
							id: id
						};

					$.ajax({
						type: "POST",
						url: popupally_pro_data_object.ajax_url,
						data: data,
						success: function(response) {
							process_import_result(id, response, file_name);
						},
						error: function(xhr, ajaxOptions, thrownError) {
							alert("Import failed due to error:\n[" + thrownError + "]\nPlease send the error message to AmbitionAlly support along with the .popupally file");
						}
					});
				}catch(e){
					alert("Import failed due to error:\n[" + e + "]\nPlease send the error message to AmbitionAlly support along with the .popupally file");
					popupally_pro_wait_overlay.hide();
				}
			}
			reader.readAsText(file);
		}
		e.stopPropagation();
		return false;
	});
	/* -------------------- end import and export -------------------- */
	function update_selected_status(elem, dependent) {
		$(elem).val(dependent.filter(':checked').length);
	}
	$('[update-num-trigger]').each(function(index, elem) {
		var selector = $(elem).attr('update-num-trigger'),
			dependent = $(selector);
		dependent.on('change propertychange', function(e) {
			update_selected_status(elem, dependent);
		});
		update_selected_status(elem, dependent);
	});
	$('html').on('click touchend', '[tab-group]', function(e) {
		var $this = $(this),
			selector = $this.attr('tab-group'),
			target = $this.attr('target'),
			active = $this.attr('active-class'),
			$tabs = $('[' + selector + ']');
		$('[tab-group=' + selector + ']').removeClass(active);
		$this.addClass(active);
		$tabs.filter('[' + selector + '!=' + target + ']').hide();
		$tabs.filter('[' + selector + '=' + target + ']').show();
		if (active === 'popupally-style-responsive-tab-active') {
			update_follow_scroll();
		}
	});
	$('html').on('change', '[name-sync-master]', function(e){
		var id = $(this).attr('name-sync-master'),
			val = $(this).val();
		$("[name-sync-text="+id+"]").text(val);
		$("[name-sync-val="+id+"]").val(val);
	});
	$('html').on('change', '[name-sync-val]', function(e){
		var id = $(this).attr('name-sync-val'),
			val = $(this).val();
		$("[name-sync-master="+id+"]").val(val).change();
	});
	$('html').on('click', ".popupally-name-edit", function(e){
		e.stopPropagation();
		return false;
	});
	$('html').on('focusout', ".popupally-name-edit", function(e){
		var id = $(this).attr('data-dependency');
		$("#" + id).val('display').change();
	});
	$('html').on('keypress', ".popupally-name-edit", function(e){
		var code = e.keyCode || e.which;
		if(code == 13) { //Enter keycode
			var id = $(this).attr('data-dependency');
			$("#" + id).val('display').change();
		}
	});
	function prompt_delete_warning($this) {
		var warning = $this.attr('popupally-delete-warning');
		if (warning){
			var conf = confirm(warning);
			if(conf !== true){
				return false;
			}
		}
		return true;
	}
	$(document).on('touchend click', '.popupally-fluid-element-delete', function(e){
		e.preventDefault();
		var $this = $(this);
		if (prompt_delete_warning($this)) {
			remove_fluid_element($this);
		}
		return false;
	});
	$(document).on('touchend click', '.popupally-fluid-responsive-delete', function(e){
		e.preventDefault();
		var $this = $(this);
		if (prompt_delete_warning($this)) {
			remove_responsive_panel($this);
		}
		return false;
	});
	$(document).on('touchend click', '[popupally-delete-element]', function(e){
		e.preventDefault();
		var $this = $(this),
			target = $($this.attr('popupally-delete-element'));
		if (prompt_delete_warning($this)) {
			target.remove();
		}
		return false;
	});
	$(document).on('touchend click', '[popupally-delete-split-test-row]', function(e){
		e.preventDefault();
		var $this = $(this),
			target = $($this.attr('popupally-delete-split-test-row')),
			parent_container = null;
		if (prompt_delete_warning($this)) {
			parent_container = $this.parents('.popupally-split-test-definition-table');
			target.remove();
			normalize_split_test_weights(parent_container, false);
		}
		return false;
	});
	$(document).on('touchend click', '[popupally-css-delete-element]', function(e){
		e.preventDefault();
		var $this = $(this),
			warning = $this.attr('popupally-delete-warning'),
			target = $($this.attr('popupally-css-delete-element'));
		if (warning){
			var conf = confirm(warning);
			if(conf !== true){
				return false;
			}
		}
		target.find('input').each(function(index, elem) {
			var $elem = $(elem),
				selector = $elem.attr('preview-update-target-css'),
				css = $elem.attr('preview-update-target-css-property');
			if (typeof selector !== typeof undefined && selector !== false) {
				if (typeof css === typeof undefined || css === false) {
					css = $elem.attr('preview-update-target-css-property-px');
				}
				
				if (css.indexOf('hover--') >= 0) {
					remove_hover_inline_css_styling(selector, css.replace('hover--', ''));
				} else {
					$(selector).css(css, '');
				}
				return;
			}
			selector = $elem.attr('preview-update-target-css-background-img');
			if (typeof selector !== typeof undefined && selector !== false) {
				$(selector).css('background-image', '');
				return;
			}
			selector = $elem.attr('preview-update-target-css-placeholder-color');
			if (typeof selector !== typeof undefined && selector !== false) {
				remove_placeholder_color(selector);
				return;
			}
			selector = $elem.attr('preview-update-target-css-background-img-hover');
			if (typeof selector !== typeof undefined && selector !== false) {
				remove_hover_inline_css_styling(selector, 'background-image');
				return;
			}
		});
		target.remove();
		return false;
	});
	$(".popupally-pro-tab-label").mouseenter(function() {
		$(this).css('border-width', '1px').animate({width:"160px"}, 500);
	});
	$(".popupally-pro-tab-label").mouseleave(function() {
		$(this).animate({width:"30px"}, 500).css('border-width', '0');
	});
	/*--------------------------- start preview functions ------------------------- */
	function popupally_pro_get_image_size(url, width_element, height_element){
		var tmp_image = new Image();
		tmp_image.src=url;
		$(tmp_image).on('load',function(){
		  width_element.val(tmp_image.width).change();
		  height_element.val(tmp_image.height).change();
		});
	}
	/*--------------------------- inline CSS for placeholder and hover ------------------------- */
	var placeholder_style = null,
	current_rules = {},
	placeholder_rule_tempalte = '{{target}}::-webkit-input-placeholder{color:{{val}} !important;}{{target}}:-moz-placeholder{color:{{val}} !important;}{{target}}::-moz-placeholder{color:{{val}} !important;}';
	function create_inline_css_style() {
		if (null === placeholder_style){
			var style = document.createElement('style');
			placeholder_style = $(style);
			placeholder_style.attr('type', "text/css");
			placeholder_style.attr('id', "inlinestyle");

			$('head').append(style);
		}
	}
	function update_non_ie_inline_css_style() {
		var rule_string = '', key;
		for(key in current_rules) {
			rule_string += current_rules[key];
		}
		placeholder_style.text(rule_string);
	}
	function add_placeholder_color(element_name, color){
		var rule_string = '';
		create_inline_css_style();

		var unique_identifier = element_name + ':placeholder-text-color';
		if (jQuery.browser.msie == true){
			if (unique_identifier in current_rules) {
				document.styleSheets.inlinestyle.deleteRule(current_rules[unique_identifier]);

				rule_string = element_name + ':-ms-input-placeholder{color:'+color+' !important;}';
				document.styleSheets.inlinestyle.insertRule(rule_string, current_rules[unique_identifier]);
			} else {
				document.styleSheets.inlinestyle.addRule(element_name + ':-ms-input-placeholder', 'color:'+color+' !important;');
				current_rules[unique_identifier] = document.styleSheets.inlinestyle.rules.length - 1;
			}
		} else {
			current_rules[unique_identifier] = placeholder_rule_tempalte.replace(/{{target}}/g, element_name).replace(/{{val}}/g, color);
			update_non_ie_inline_css_style();
		}
	}
	function remove_placeholder_color(element_name){
		create_inline_css_style();

		var unique_identifier = element_name + ':placeholder-text-color';
		if (jQuery.browser.msie == true){
			if (unique_identifier in current_rules) {
				document.styleSheets.inlinestyle.deleteRule(current_rules[unique_identifier]);
			}
		} else {
			if (unique_identifier in current_rules) {
				delete current_rules[unique_identifier];
				update_non_ie_inline_css_style();
			}
		}
	}
	function add_inline_css_styling(element_name, unique_identifier, css_styling){
		var rule_string;
		create_inline_css_style();

		if (jQuery.browser.msie == true){
			if (unique_identifier in current_rules) {
				document.styleSheets.inlinestyle.deleteRule(current_rules[unique_identifier]);

				rule_string = element_name + '{' + css_styling + '}';
				document.styleSheets.inlinestyle.insertRule(rule_string, current_rules[unique_identifier]);
			} else {
				document.styleSheets.inlinestyle.addRule(element_name, css_styling);
				current_rules[unique_identifier] = document.styleSheets.inlinestyle.rules.length - 1;
			}
		} else {
			current_rules[unique_identifier] = element_name + '{' + css_styling + '}';
			update_non_ie_inline_css_style();
		}
	}
	function remove_inline_css_styling(unique_identifier){
		create_inline_css_style();

		if (jQuery.browser.msie == true){
			if (unique_identifier in current_rules) {
				document.styleSheets.inlinestyle.deleteRule(current_rules[unique_identifier]);
			}
		} else {
			if (unique_identifier in current_rules) {
				delete current_rules[unique_identifier];
				update_non_ie_inline_css_style();
			}
		}
	}
	function add_hover_inline_css_styling(element, attribute, value) {
		var element_name = element + ':hover',
			unique_identifier = element_name + '--' + attribute,
			css_styling = attribute + ':' + value + ' !important;';
		add_inline_css_styling(element_name, unique_identifier, css_styling);
	}
	function remove_hover_inline_css_styling(element, attribute) {
		var element_name = element + ':hover',
			unique_identifier = element_name + '--' + attribute;
		remove_inline_css_styling(unique_identifier);
	}
	/*--------------------------- end inline CSS for placeholder and hover ------------------------- */
	function validate_html_code(input_html) {
		input_html = input_html.replace(/=""/g, '').replace(/=''/g, '').replace(/\s+>/g, '>').replace(/<br\s*>/g, '').replace(/<br\s*\/>/g, '');
		input_html = input_html.replace(/&#\d+;/g, '').replace(/&#x[0-9a-f]+;/g, '').replace(/&\w+;/g, '');	// remove all special characters

		var live_html = $('<div>').html(input_html).html();
		if (live_html.length === input_html.length) {	/* compare by length to avoid quote issue in attribute value (jQuery replaces ' with ") */
			return '';
		}
		live_html = live_html.replace(/ /g, "");	// compare ignoring space
		input_html = input_html.replace(/ /g, "")

		input_html = input_html.replace(/\/>/, ">");	// In case <img> <input> etc are closed with />
		if (live_html.length === input_html.length) {	/* compare by length to avoid quote issue in attribute value (jQuery replaces ' with ") */
			return '';
		}
		return 'Invalid HTML code. Please make sure all open tags have the corresponding close tag';
	}
	function check_for_non_ascii_characters(input) {
		var result = '', i = 0, char_code;
		if (input) {
			for (; i < input.length; ++i) {
				char_code = input.charCodeAt(i);
				if (char_code > 127) {
					result += '&#' + char_code + ';';
				} else {
					result += input.charAt(i);
				}
			}
		}
		return result;
	}

	// <editor-fold desc="live preview change handler">
	$(document).on('click', '.no-click-through', function(e) {
		return false;
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target]', function(e) {
		try {
			var $this = $(this),
				target_selector = $this.attr('preview-update-target'),
				html_code = $this.val(),
				$target = $(target_selector),
				cleaned_code;
			if (e.type === 'change') {
				cleaned_code = check_for_non_ascii_characters(html_code);
				if (cleaned_code !== html_code) {
					html_code = cleaned_code;
					$this.val(html_code);
				}
				var error_display_selector = $this.attr('html-error-check');
				if (typeof error_display_selector !== typeof undefined && error_display_selector !== false) {
					$(error_display_selector).text(validate_html_code(html_code));
				}
			}
			$target.html(html_code).resize();
		} catch (e) {
		}
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-value]', function(e) {
		var target_selector = $(this).attr('preview-update-target-value');
		$(target_selector).val($(this).val()).resize();
	});
	$(document).on('change paste', '[preview-update-target-img]', function(e) {
		var target_selector = $(this).attr('preview-update-target-img');
		$(target_selector).attr('src', $(this).val()).resize();
	});
	$(document).on('change paste', '[preview-update-target-css-background-img]', function(e) {
		var elem = $(this),
		target_selector = elem.attr('preview-update-target-css-background-img'),
		val = elem.val(),
		dimension_selector = elem.attr('image-dimension-attribute');
		if (val) {
			$(target_selector).css('background-image', 'url(' + val + ')').resize();
			if (dimension_selector) {
				popupally_pro_get_image_size(val, $('#' + dimension_selector + '-width'), $('#' + dimension_selector + '-height'));
			}
		} else {
			$(target_selector).css('background-image', 'none').resize();
			if (dimension_selector) {
				$('#' + dimension_selector + '-width').val('0').change();
				$('#' + dimension_selector + '-height').val('0').change();
			}
		}
	});
	$(document).on('change paste', '[preview-update-target-css-background-img-hover]', function(e) {
		var elem = $(this),
		target_selector = elem.attr('preview-update-target-css-background-img-hover'),
		val = elem.val();
		if (val) {
			add_hover_inline_css_styling(target_selector, 'background-image', 'url(' + val + ')');
		} else {
			add_hover_inline_css_styling(target_selector, 'background-image', 'none');
		}
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-css][preview-update-target-css-property]', function(e) {
		var elem = $(this),
		is_color_picker = elem.hasClass('nqpc-picker-input-iyxm'),
		target_selector = elem.attr('preview-update-target-css'),
		css_property = elem.attr('preview-update-target-css-property'),
		val = elem.val();
		if (is_color_picker) {
			if (val) {
				if ('#' !== val[0]) {
					val = '#' + val;
				}
				val += '000000';
				val = val.substring(0, 7);
			} else {
				val = 'transparent';
			}
			if (css_property.indexOf('hover--') >= 0) {
				add_hover_inline_css_styling(target_selector, css_property.replace('hover--', ''), val);
			} else {
				$(target_selector).css(css_property, val);
			}
		} else if (elem.val() !== 'other') {
			if (css_property === 'box-shadow') {
				$(target_selector).css('-webkit-box-shadow', val);
				$(target_selector).css('-moz-box-shadow', val);
			}
			if (css_property.indexOf('hover--') >= 0) {
				add_hover_inline_css_styling(target_selector, css_property.replace('hover--', ''), val);
			} else {
				$(target_selector).css(css_property, val).resize();
			}
		}
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-css][preview-update-target-css-property-px]', function(e) {
		var target_selector = $(this).attr('preview-update-target-css'),
		css_property = $(this).attr('preview-update-target-css-property-px');
		$(target_selector).css(css_property, $(this).val() + 'px').resize();
		if ('border-radius' === css_property) {
			$(target_selector).css('-moz-border-radius', $(this).val() + 'px').css('-webkit-border-radius', $(this).val() + 'px').resize();
		}
	});
	$(document).on('change', '[preview-update-target-css-hide]', function(e) {
		var target_selector = $(this).attr('preview-update-target-css-hide');
		$(target_selector).css('display', $(this).val()).resize();
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-hide-checked]', function(e) {
		var selector = $(this).attr('preview-update-target-hide-checked');
		if ($(this).prop('checked')) {
			$(selector).hide().resize();
		} else {
			$(selector).show().resize();
		}
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-placeholder]', function(e) {
		var target_selector = $(this).attr('preview-update-target-placeholder');
		$(target_selector).attr('placeholder', $(this).val()).resize();
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-input-color]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-input-color'),
		val = $this.val();
		$(target_selector).css('color', val).resize();
		add_placeholder_color(target_selector, val);
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-css-placeholder-color]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-css-placeholder-color'),
		val = $this.val();
		add_placeholder_color(target_selector, val);
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-type]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-type'),
		popup_id = $this.attr('popup-id'),
		form_refresh_selector = $this.attr('form-dropdown-selection'),
		email_refresh_selector = $this.attr('email-dropdown-selection'),
		val = $this.val();
		$(target_selector).each(function(index, elem) {
			var $elem = $(elem),
				id = $elem.attr('id'),
				cl = $elem.attr('class'),
				style = $elem.attr('style'),
				placeholder = $elem.attr('placeholder'),
				new_elem = null;
			if (val === 'multi') {
				new_elem = $('<textarea></textarea>');
			} else if (val === 'checkbox') {
				new_elem = $('<input type="checkbox"/>');
			} else if (val === 'dropdown') {
				new_elem = $('<select></select>');
			} else {
				new_elem = $('<input type="text"/>');
			}
			new_elem.attr({'id' : id, 'class' : cl, 'style' : style , 'placeholder' : placeholder });
			$elem.before(new_elem);
			$elem.remove();
		});
		if (val === 'dropdown') {
			if ($('#information-destination-' + popup_id).val() === 'form') {
				if (form_refresh_selector) {
					$(form_refresh_selector).change();
				}
			} else {
				if (email_refresh_selector) {
					$(email_refresh_selector).change();
				}
			}
		}
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-input-type]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-input-type');
		if ($this.is(":checked")) {
			$(target_selector).attr('type', 'email');
		} else {
			$(target_selector).attr('type', 'text');
		}
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-checkbox-status]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-checkbox-status'),
		val = $this.val();
		$(target_selector).prop('checked', val === 'checked');
	});
	$(document).on('change propertychange keyup input paste', '[preview-update-target-dropdown-selection]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-dropdown-selection'),
		id = $this.attr('popup-id'),
		input_name = $this.val(),
		option_selector = $('#dropdown-form-fields-' + id + '-' + input_name);
		if (option_selector.length > 0) {
			$(target_selector).empty().append(option_selector.val());
		}
	});
	$(document).on('change', '[preview-update-target-select-options]', function(e) {
		var $this = $(this),
		target_selector = $this.attr('preview-update-target-select-options'),
		option_text = $this.val(),
		i = 0;
		$(target_selector).empty();
		option_text = option_text.split(',');
		for (;i<option_text.length;++i) {
			$(target_selector).append($('<option></option>').text(option_text[i]));
		}
	});
	$(document).on('mouseenter', '.popupally-preview-element', function(e) {
		var $this = $(this);
		if ($this.is('div')) {
			$this.append('<div class="popupally-preview-hover-box"></div>');
		}
	});
	$(document).on('mouseleave', '.popupally-preview-element', function(e) {
		var $this = $(this);
		if ($this.is('div')) {
			$this.find('.popupally-preview-hover-box').remove();
		}
	});
	$(document).on('click touchend', '.popupally-preview-element', function(e) {
		var $this = $(this),
		id = $this.attr('id'),
		customization_element_id = '#' + id.replace(/popupally-preview-/g, 'popup-fluid-element-customization-'),
		toggle_element_id = id.replace(/popupally-preview-/g, 'popup-fluid-element-customization-toggle-'),
		$customization_element = $(customization_element_id),
		$toggle_element = $('#' + toggle_element_id);
		++animation_depth;
		if (!$toggle_element.prop('checked')) {
			$toggle_element.prop('checked', true).change();
		}
		scroll_element_info_view($customization_element);
		--animation_depth;
	});
	$(document).on('mouseenter', '[popupally-preview-linked]', function(e) {
		var $this = $(this);
		if ($this.is('div')) {
			$this.append('<div class="popupally-preview-hover-box"></div>');
		}
	});
	$(document).on('mouseleave', '[popupally-preview-linked]', function(e) {
		var $this = $(this);
		if ($this.is('div')) {
			$this.find('.popupally-preview-hover-box').remove();
		}
	});
	$(document).on('click touchend', '[popupally-preview-linked]', function(e) {
		var $this = $(this),
		id = $this.attr('popupally-preview-linked'),
		$customization_element = $('#' + id);
		scroll_element_info_view($customization_element);
	});
	function auto_adjust_quantity($this, adjust_dimension) {
		var identifier = $this.attr('auto-adjust-' + adjust_dimension + '-source'),
		trigger_selector = $this.attr('auto-adjust-trigger'),
		responsive_id = $this.attr('responsive-id'),
		val = parseInt($this.val()),
		base_val = 0;
		if (typeof trigger_selector === typeof undefined || trigger_selector === false) {
			return true;
		}
		if (!$('[auto-adjust-trigger-source="' + trigger_selector + '"]').is(':checked')) {
			return true;
		}
		base_val = parseInt($('[auto-adjust-' + adjust_dimension + '-source="' + identifier + '"][responsive-id="0"]').val());
		if (base_val <= 0) {
			return true;
		}
		val = val / base_val;
		$('[auto-adjust-' + adjust_dimension + '="' + identifier + '"][responsive-id="' + responsive_id + '"]').each(function(index, elem) {
			var $elem = $(elem),
			element_id = $elem.attr('element-id'),
			css_type = $elem.attr("auto-adjust-type"),
			responsive_val = $elem.val(),
			base_val = null,
			base_element = $('[auto-adjust-' + adjust_dimension + '="' + identifier + '"][element-id="' + element_id + '"][auto-adjust-type="' + css_type + '"][responsive-id="0"]');
			if (base_element.length !== 1) {
				return;
			}
			base_val = base_element.val();
			if (base_val === 'auto' || (base_val.length > 1 && base_val.indexOf('%') === base_val.length - 1)) {
				if (base_val !== responsive_val) {
					$elem.val(base_val).change();
				}
				return;
			} else if (base_val.length > 2 && base_val.indexOf('px') === base_val.length - 2) {
				base_val = parseInt(base_val.substring(0, base_val.length - 2));
				$elem.val(Math.round(base_val * val) + 'px').change();
			} else {
				base_val = parseInt(base_val);
				$elem.val(Math.round(base_val * val)).change();
			}
		});
	}
	$(document).on('change', '[auto-adjust-width-source]', function(e) {
		auto_adjust_quantity($(this), 'width');
	});
	$(document).on('change', '[auto-adjust-height-source]', function(e) {
		auto_adjust_quantity($(this), 'height');
	});
	$(document).on('change', '[auto-adjust-trigger-source]', function(e) {
		var $this = $(this),
			selector = $this.attr('auto-adjust-trigger-source');
		$('[auto-adjust-trigger="' + selector + '"]').change();
	});
	// </editor-fold>

	function bind_incremental_dependencies(preview_element) {
		preview_element.find('.nqpc-picker-input-iyxm').each(function(index, elem) {
			popupallypro_jscolor.bind_element(elem);
		});
		preview_element.find('[update-num-trigger]').each(function(index, elem) {
			var selector = $(elem).attr('update-num-trigger'),
				dependent = $(selector);
			dependent.on('change propertychange', function(e) {
				update_selected_status(elem, dependent);
			});
			update_selected_status(elem, dependent);
		});
		/* trigger the change event for HTML code text input */
		preview_element.find('[preview-update-target]').change();
		/* trigger customizations that require inline css */
		preview_element.find('[preview-update-target-css-background-img-hover]').change();
		preview_element.find('[preview-update-target-css-placeholder-color]').change();
		preview_element.find('[preview-update-target-css][preview-update-target-css-property^="hover--"]').change();
	}
	function flash_red(element) {
		var initial_color = element.css('background-color');
		element.css('background-color', '#ff0000')
		setTimeout(function(){
			element.css('background-color', initial_color);
		}, 200);
	}
	// <editor-fold desc="Fluid Template - Add responsive panel">
	function add_responsive_panel(e) {
		var $this = $(this),
		popup_id = $this.attr('popup-id'),
		template_id = $this.attr('template-id'),
		id_string = popup_id + '-' + template_id,
		max_id_element = $('#popupally-max-responsive-' + id_string),
		new_responsive_id = parseInt(max_id_element.val()) + 1,
		source = popupally_pro_default_code['fluid-responsive-header'].replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url),
		target = $('#popupally-responsive-customization-filler-header-' + id_string);
		/* add header block */
		max_id_element.val(new_responsive_id);
		source = customize_template_code(source, popup_id, template_id, new_responsive_id, false, false);
		target.before(source);

		target = $('#popupally-responsive-customization-' + id_string);
		target.attr('colspan', parseInt(target.attr('colspan')) + 1);

		var data = null,
			new_form = $("<form></form>");
		target.children().clone().appendTo(new_form);
		data = {
			action: 'popupally_pro_generate_fluid_customization_code',
			nonce: popupally_pro_data_object.update_nonce,
			setting: encodeURI(JSON.stringify(new_form.serializeArray())),
			id: popup_id,
			uid: template_id,
			new_rid: new_responsive_id
		};

		popupally_pro_wait_overlay.show();
		$.ajax({
			type: "POST",
			url: popupally_pro_data_object.ajax_url,
			data: data,
			success: function(response) {
				process_append_responsive_panel_result(response, target);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert("Cannot add responsive panel due to error:\n[" + thrownError + "]\nPlease refresh the page and try again.");
			}
		});
	}
	function process_append_responsive_panel_result(response, target) {
		var result = JSON.parse(response);
		try {
			if ('error' in result) {
				alert("Cannot add responsive panel due to error:\n[" + result['error'] + "]\nPlease refresh the page and try again.");
			} else {
				var source = $(result['html']);
				target.append(source);
				bind_incremental_dependencies(source);

				/* trigger the change event for HTML code text input */
				target.find('[preview-update-target]').change();
			}
		} catch (e) {
			alert("Cannot add responsive panel due to error:\n[" + e + "]\nPlease refresh the page and try again.");
		}finally{
			popupally_pro_wait_overlay.hide();
		}
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Remove responsive panel">
	function remove_responsive_panel($this) {
		var popup_id = $this.attr('popup-id'),
		template_id = $this.attr('template-id'),
		responsive_id = $this.attr('responsive-id'),
		id_string = popup_id + '-' + template_id + '-' + responsive_id,
		target = $('#popupally-fluid-responsive-header-' + id_string);
		target.remove();

		target = $('#popupally-style-responsive-' + id_string);
		target.remove();

		target = $('#popupally-responsive-customization-' + popup_id + '-' + template_id);
		target.attr('colspan', parseInt(target.attr('colspan')) - 1);

		/* make the desktop tab active */
		target = $('#popupally-fluid-responsive-header-' + popup_id + '-' + template_id + '-0');
		target.click();
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Add element">
	function add_fluid_element(e) {
		var $this = $(this),
		popup_id = $this.attr('popup-id'),
		template_id = $this.attr('template-id'),
		id_string = popup_id + '-' + template_id,
		max_id_element = $('#popupally-max-element-' + id_string),
		element_id = parseInt(max_id_element.val()) + 1,
		type_to_add = $('#popupally-style-add-element-' + id_string).val();
		if (!type_to_add) {
			return false;
		}
		max_id_element.val(element_id);

		/* add preview block */
		var source_responsive,
			source = popupally_pro_default_code['fluid-element-preview'][type_to_add].replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url),
		target = $('.popupally-pro-inner-' + id_string);
		source = customize_template_code(source, popup_id, template_id, false, element_id, false);
		target.each(function(index, elem) {
			var $elem = $(elem),
				rid = $elem.attr('responsive-id');
			$elem.append(source.replace(/--rid--/g, rid));
		});

		source = popupally_pro_default_code['fluid-element-customization'][type_to_add].replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url);
		source_responsive = popupally_pro_default_code['fluid-element-customization']['responsive-' + type_to_add].replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url);
		target = $('.customization-section-' + id_string);
		source = customize_template_code(source, popup_id, template_id, false, element_id, false);
		source_responsive = customize_template_code(source_responsive, popup_id, template_id, false, element_id, false);

		/* add customization block */
		target.each(function(index, elem) {
			var $elem = $(elem),
				rid = $elem.attr('responsive-id');
			if (rid === '0') {
				$elem.append(source.replace(/--rid--/g, rid));
			} else {
				$elem.append(source_responsive.replace(/--rid--/g, rid));
			}
		});

		if (type_to_add === 'input') {
			$('.sign-up-form-raw-html[popup-id="' + popup_id + '"]').change();
			$('#information-destination-' + popup_id).change();
		}
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Copy element">
	function copy_fluid_element(e) {
		var $this = $(this),
		popup_id = $this.attr('popup-id'),
		template_id = $this.attr('template-id'),
		element_id = $this.attr('element-id'),
		id_string = popup_id + '-' + template_id,
		max_id_element = $('#popupally-max-element-' + id_string),
		new_element_id = parseInt(max_id_element.val()) + 1,
		new_id_string = popup_id + '-' + template_id + '-' + new_element_id,
		form_element_name = 'name="\\[' + popup_id + '\\]\\[' + template_id + '\\]\\[elements\\]\\[' + element_id + '\\]',
		new_form_element_name = 'name="[' + popup_id + '][' + template_id + '][elements][' + new_element_id + ']',
		target;

		id_string = id_string + '-' + element_id;
		max_id_element.val(new_element_id);
		form_element_name = new RegExp(form_element_name, 'g');

		/* add preview block */
		target = $('.popupally-pro-inner-' + popup_id + '-' + template_id);
		target.each(function(index, target_elem) {
			var $target_elem = $(target_elem),
				$elem = $target_elem.find('.popupally-preview-' + id_string),
				rid = $target_elem.attr('responsive-id'),
				source = $('<div>').append($elem.clone()).html();
			source = source.replace(new RegExp(id_string + '-' + rid, 'g'), new_id_string + '-' + rid);
			source = source.replace(new RegExp(id_string, 'g'), new_id_string);
			$target_elem.append(source);
		});

		/* add customization block */
		target = $('.customization-section-' + popup_id + '-' + template_id);
		target.each(function(index, target_elem) {
			var $target_elem = $(target_elem),
				$elem = $target_elem.find('.popup-fluid-element-customization-' + id_string),
				rid = $target_elem.attr('responsive-id'),
				source = $('<div>').append($elem.clone()).html(),
				form_element_responsive_name = 'name="\\[' + popup_id + '\\]\\[' + template_id + '\\]\\[responsive\\]\\[' + rid + '\\]\\[elements\\]\\[' + element_id + '\\]',
				new_form_element_responsive_name = 'name="[' + popup_id + '][' + template_id + '][responsive][' + rid + '][elements][' + new_element_id + ']';
			source = source.replace(new RegExp(id_string + '-' + rid, 'g'), new_id_string + '-' + rid);
			source = source.replace(new RegExp(id_string, 'g'), new_id_string);
			source = source.replace(form_element_name, new_form_element_name);
			form_element_responsive_name = form_element_responsive_name.replace(/\-/g, '\\-');
			source = source.replace(new RegExp(form_element_responsive_name, 'g'), new_form_element_responsive_name);
			source = source.replace(new RegExp('element-id="' + element_id + '"', 'g'), 'element-id="' + new_element_id + '"');
			source = source.replace(new RegExp('element-order="identifier" value="' + element_id + '"', 'g'), 'element-order="identifier" value="' + new_element_id + '"');
			source = $(source);
			$target_elem.append(source);
			bind_incremental_dependencies(source);
			$('#popup-fluid-element-customization-toggle-' + new_id_string + '-' + rid).prop('checked', false).change();
		});
		$('.sign-up-form-raw-html[popup-id="' + popup_id + '"]').change();
		alert("The element has been copied (added as a new element)!");
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Delete element">
	function remove_fluid_element($this) {
		var popup_id = $this.attr('popup-id'),
		template_id = $this.attr('template-id'),
		element_id = $this.attr('element-id'),
		id_string = popup_id + '-' + template_id + '-' + element_id,
		customization_sections = $('.popup-fluid-element-customization-' + id_string),
		preview_elements = $('.popupally-preview-' + id_string);
		customization_sections.remove();
		preview_elements.remove();
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - tempalte code customization">
	function customize_template_code(source, popup_id, template_id, responsive_id, element_id, label) {
		if (popup_id) {
			source = source.replace(/--id--/g, popup_id);
		}
		if (template_id) {
			source = source.replace(/--uid--/g, template_id);
		}
		if (responsive_id) {
			source = source.replace(/--rid--/g, responsive_id);
		}
		if (element_id) {
			source = source.replace(/--eid--/g, element_id);
		}
		if (label) {
			source = source.replace(/--label--/g, label);
		}
		return source;
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Add element CSS clause">
	function add_fluid_css_clause(e) {
		var $this = $(this),
		popup_id = $this.attr('popup-id'),
		template_id = $this.attr('template-id'),
		element_id = $this.attr('element-id'),
		id_string = popup_id + '-' + template_id + '-' + element_id,
		selector = $('#popupally-style-add-css-' + id_string),
		type_to_add = selector.val(),
		existing_item = $('.css-item-' + id_string + '-' + type_to_add);
		if (!type_to_add) {
			return false;
		}
		if (existing_item.length > 0) {
			flash_red(existing_item);
			return false;
		}
		var selected_option = selector.children("option").filter(":selected"),
		label = selected_option.text().trim(),
		desktop_source = popupally_pro_default_code['fluid-css-desktop-customization'][type_to_add].replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url),
		responsive_source = popupally_pro_default_code['fluid-css-responsive-customization'][type_to_add].replace(/--plugin-url--/g, popupally_pro_data_object.plugin_url),
		target = $('.customization-element-' + id_string);

		/* add customization block */
		desktop_source = customize_template_code(desktop_source, popup_id, template_id, false, element_id, label);
		responsive_source = customize_template_code(responsive_source, popup_id, template_id, false, element_id, label);
		target.each(function(index, elem) {
			var $elem = $(elem),
				rid = $elem.attr('responsive-id'),
				to_add = null;
			if (rid === '0') {
				to_add = $(desktop_source.replace(/--rid--/g, rid));
			} else {
				to_add = $(responsive_source.replace(/--rid--/g, rid));
			}
			$elem.append(to_add);
			bind_incremental_dependencies(to_add);
		});
		/* update readonly status for the css customization options */
		$('[auto-adjust-trigger-source|="auto-adjust-enabled-' + popup_id + '-' + template_id + '"]').change();
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Responsive view inheriting CSS from desktop view">
	function sync_inherit_css() {
		var $this = $(this),
			type = null,	/* only match by element type to take care of the "other" selection */
			val = null,
			iden_str = $this.attr('inherit-css-source'),
			target = null;
		if ($this.is('input')) {
			if ($this.attr('type') === 'checkbox') {
				type = 'input[type="checkbox"]';
				val = $this.is(':checked');
			} else {
				type = 'input';
				val = $this.val();
			}
		} else {
			type = 'select';
			val = $this.val();
		}
		target = $(type + '[inherit-css-target="' + iden_str + '"]');
		target.each(function(index, elem) {
			var $elem = $(elem),
				responsive_id = $elem.attr('responsive-id'),
				$inherit_checkbox =  $('[inherit-css-switch="' + iden_str + '"][responsive-id="' + responsive_id + '"]');
			if ($inherit_checkbox.prop('checked')){
				if (type === 'input[type="checkbox"]') {
					$elem.prop('checked', val).change();
				} else {
					$elem.val(val).change();
					if ($elem.hasClass('nqpc-picker-input-iyxm')) {
						elem.color.importColor();
					}
				}
			}
		});
	}
	function match_desktop_css() {
		var $this = $(this),
			iden_str = null;
		if ($this.prop('checked')) {
			iden_str = $this.attr('inherit-css-switch');
			$('[inherit-css-source="' + iden_str + '"]').change();
		}
	}
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Change element order">
	function insert_fluid_element_before(popup_id, template_id, element_id_to_move, reference_element_id) {
		var all_responsive_views = $('.customization-section-' + popup_id + '-' + template_id),
			i, responsive_id, $responsive_view, $element_to_move, $reference_element;
		for (i = 0; i < all_responsive_views.length; ++i) {
			$responsive_view = $(all_responsive_views[i]);
			responsive_id = $responsive_view.attr('responsive-id');

			// move customization blocks
			$element_to_move = $('#popup-fluid-element-customization-' + popup_id + '-' + template_id + '-' + element_id_to_move + '-' + responsive_id);
			$reference_element = $('#popup-fluid-element-customization-' + popup_id + '-' + template_id + '-' + reference_element_id + '-' + responsive_id);
			if ($element_to_move.length > 0 && $reference_element.length > 0) {
				$reference_element.before($element_to_move);
			} else {
				alert('Invalid move operation');
			}

			// move preview elements
			$element_to_move = $('#popupally-preview-' + popup_id + '-' + template_id + '-' + element_id_to_move + '-' + responsive_id);
			$reference_element = $('#popupally-preview-' + popup_id + '-' + template_id + '-' + reference_element_id + '-' + responsive_id);
			if ($element_to_move.length > 0 && $reference_element.length > 0) {
				$reference_element.before($element_to_move);
			} else {
				alert('Invalid move operation');
			}
		}
	}
	function insert_fluid_element_after(popup_id, template_id, element_id_to_move, reference_element_id) {
		var all_responsive_views = $('.customization-section-' + popup_id + '-' + template_id),
			i, responsive_id, $responsive_view, $element_to_move, $reference_element;
		for (i = 0; i < all_responsive_views.length; ++i) {
			$responsive_view = $(all_responsive_views[i]);
			responsive_id = $responsive_view.attr('responsive-id');

			// move customization blocks
			$element_to_move = $('#popup-fluid-element-customization-' + popup_id + '-' + template_id + '-' + element_id_to_move + '-' + responsive_id);
			$reference_element = $('#popup-fluid-element-customization-' + popup_id + '-' + template_id + '-' + reference_element_id + '-' + responsive_id);
			if ($element_to_move.length > 0 && $reference_element.length > 0) {
				$reference_element.after($element_to_move);
			} else {
				alert('Invalid move operation');
			}

			// move preview elements
			$element_to_move = $('#popupally-preview-' + popup_id + '-' + template_id + '-' + element_id_to_move + '-' + responsive_id);
			$reference_element = $('#popupally-preview-' + popup_id + '-' + template_id + '-' + reference_element_id + '-' + responsive_id);
			if ($element_to_move.length > 0 && $reference_element.length > 0) {
				$reference_element.after($element_to_move);
			} else {
				alert('Invalid move operation');
			}
		}
	}
	$(document).on('click', '.popupally-setting-fluid-order-up', function() {
		var $this = $(this),
			popup_id = $this.attr('popup-id'),
			template_id = $this.attr('template-id'),
			element_id = $this.attr('element-id'),
			all_order_elements = $('.popup-fluid-element-order-' + popup_id + '-' + template_id),
			i;
		for (i = 1; i < all_order_elements.length; ++i) {
			if (element_id == all_order_elements[i].value) {
				insert_fluid_element_before(popup_id, template_id, element_id, all_order_elements[i-1].value);
			}
		}
	});
	$(document).on('click', '.popupally-setting-fluid-order-down', function() {
		var $this = $(this),
			popup_id = $this.attr('popup-id'),
			template_id = $this.attr('template-id'),
			element_id = $this.attr('element-id'),
			all_order_elements = $('.popup-fluid-element-order-' + popup_id + '-' + template_id),
			i;
		for (i = 0; i < all_order_elements.length - 1; ++i) {
			if (element_id == all_order_elements[i].value) {
				insert_fluid_element_after(popup_id, template_id, element_id, all_order_elements[i+1].value);
			}
		}
	});
	// </editor-fold>

	// <editor-fold desc="Fluid Template - Handler binding">
	$(document).on('click touchend', '.popupally-customization-element-add-button', add_fluid_element);
	$(document).on('click touchend', '.popupally-customization-css-add-button', add_fluid_css_clause);
	$(document).on('change', '.popupally-customization-css-add-selection', add_fluid_css_clause);
	$(document).on('click touchend', '.popupally-customization-responsive-add-button', add_responsive_panel);
	$(document).on('click touchend', '.popupally-fluid-element-copy', copy_fluid_element);
	$(document).on('change', '[inherit-css-source]', sync_inherit_css);
	$(document).on('change', '[inherit-css-switch]', match_desktop_css);
	// </editor-fold>

	// <editor-fold desc="use WordPress media editor to add / upload images">
	var original_media_insert_button_text = false;
	function replace_media_insert_button_text(new_text) {
		window.send_to_editor = function(html) {};
		original_media_insert_button_text = {};
		for (var key in wp.media.view) {
			if ('insertIntoPost' in wp.media.view[key]) {
				original_media_insert_button_text[key] = wp.media.view[key].insertIntoPost;
				wp.media.view[key].insertIntoPost = new_text;
			}
		}
	}
	function restore_media_insert_button_text() {
		for (var key in wp.media.view) {
			if ('insertIntoPost' in wp.media.view[key]) {
				wp.media.view[key].insertIntoPost = original_media_insert_button_text[key];
			}
		}
		original_media_insert_button_text = false;
	}
	function upload_image_file() {
		var $this = $(this),
			upload_image_target_selector = $this.attr('upload-image');
		replace_media_insert_button_text('Add to popup');

		wp.media.editor.send.attachment = function(props, attachment){
			$(upload_image_target_selector).val(attachment.url).change();
			restore_media_insert_button_text();
		}

		wp.media.editor.open(upload_image_target_selector, {multiple: false});
		$('div.media-frame-menu').hide();
		return false;
	}
	$(document).on('click touchend', '[upload-image]', upload_image_file);
	// </editor-fold>

	function evaluate_dependency(collection, value, match_function, mismatch_function) {
		collection.each(function(index, elem){
			var $elem = $(elem),
				dependency_value = $elem.attr('data-dependency-value'),
				dependency_value_not = $elem.attr('data-dependency-value-not');
			if (typeof dependency_value !== typeof undefined && dependency_value !== false) {
				if (dependency_value === value) {
					match_function($elem);
				} else {
					mismatch_function($elem);
				}
			}
			if (typeof dependency_value_not !== typeof undefined && dependency_value_not !== false) {
				if (dependency_value_not !== value) {
					match_function($elem);
				} else {
					mismatch_function($elem);
				}
			}
		});
	}
	function add_split_test(e) {
		var $this = $(this),
			count_elem = $('#popupally-split-test-max-test'),
			max_id = parseInt(count_elem.val()) + 1,
			new_html = $('#popupally-split-test-template').html();
		new_html = new_html.replace(new RegExp('--id--', 'g'), max_id);
		count_elem.val(max_id);
		$this.before(new_html);
	}
	function normalize_split_test_weights(parent_container, is_add_new) {
		var weight_inputs = parent_container.find('.popupally-split-test-weight'),
			weights = [],
			control_weight = 0,
			temp_weight = 0,
			total_weight = 0,
			normalize_target = 100,
			i = 0,
			count = weight_inputs.length;
		if (is_add_new) {
			temp_weight = Math.floor(100 / count);
			normalize_target = Math.max(1, 100 - temp_weight);
			weight_inputs[count-1].value = temp_weight;
			--count;
		}
		for (i = 0; i<count; ++i) {
			temp_weight = Math.max(0, parseInt(weight_inputs[i].value));
			temp_weight = Math.min(100, temp_weight);
			weights.push(temp_weight);
			total_weight += temp_weight;
		}
		if (total_weight <= 0) {
			if (is_add_new) {
				weight_inputs[count].value = 100;
			}
		} else {
			control_weight = normalize_target;
			for (i = 1; i<count; ++i) {
				temp_weight = Math.floor(weights[i] / total_weight * normalize_target);
				weight_inputs[i].value = temp_weight;
				control_weight -= temp_weight;
			}
			weight_inputs[0].value = control_weight;
		}
	}
	function add_split_test_row(e) {
		var $this = $(this),
			id = $this.attr('popupally-add-split-test-variate'),
			target = $('#popupally-split-test-definition-' + id),
			count_elem = $('#popupally-split-test-max-variate-' + id),
			max_id = parseInt(count_elem.val()) + 1,
			new_html = $('#popupally-split-test-row-template').html();
		new_html = new_html.replace(new RegExp('--id--', 'g'), id);
		new_html = new_html.replace(new RegExp('--row-id--', 'g'), max_id);
		count_elem.val(max_id);
		target.append(new_html);
		normalize_split_test_weights(target, true);
	}
	function add_regex_filter() {
		var $this = $(this),
			popup_id = $this.attr('popup-id'),
			count_elem = $('#display-regex-filter-count-' + popup_id),
			max_id = parseInt(count_elem.val()) + 1,
			target = $('#regex-filter-' + popup_id),
			new_html = popupally_pro_default_code['display-regex-filter-row'].replace(/--rid--/g, max_id).replace(/--id--/g, popup_id);
		count_elem.val(max_id);
		target.append(new_html);
	}
	function bind_all_dependencies() {
		/* always toggle visibility first, otherwise ".popupally-update-follow-scroll" will not work properly  */
		$(document).on('change', '[popupally-change-source]', function() {
			var $element = $(this),
				value = 'false',
				dependency_name = $element.attr('popupally-change-source'),
				dependencies = $('[data-dependency="' + dependency_name + '"]');
			if($element.attr('type') === 'checkbox') {
				if ($element.is(':checked')){
					value = 'true';
				}
			} else {
				value = $element.val();
			}

			if (value){
				value = value.replace(/\"/g, '\\"');
			}
			evaluate_dependency(dependencies.filter('[hide-toggle]'), value, function(elem) {
				elem.show();
				if (elem.hasClass("popupally-name-edit")) {
					elem.focus();
				}
			}, function(elem) {
				elem.hide();
				if (elem.is('option:selected')) {
					elem.prop('selected', false);
					elem.parent('select').change();
				}
			});
			evaluate_dependency(dependencies.filter('[readonly-toggle]'), value, function(elem) { elem.prop('readonly', false); }, function(elem) { elem.prop('readonly', true); });
		});
		$(document).on('resize', '.follow-scroll', function(){
			var height = $(this).height() + 30,
			follow_selector = $(this).attr('margin-before');
			$(follow_selector).css('margin-top', height+'px');
		});
		$(document).on('click change', ".popupally-update-follow-scroll", function() {
			update_follow_scroll();
		});
		$(document).on('change', 'textarea', function() {
			$(this).text($(this).val());
		});
		$(document).on('change', 'select', function() {
			var sel = $(this).children(":selected");
			$(this).children().not(sel).removeAttr("selected");
			sel.attr("selected", "selected");
		});
		$(document).on('change', 'input[type="text"]', function() {
			$(this).attr('value', $(this).val());
		});
		$(document).on('change', "[verify-px-pct-input]", function() {
			var $this = $(this),
				error = $this.attr('verify-px-pct-input'),
				code = $this.val(),
				error_text = '';
			if (code) {
				code = code.toLowerCase();
				if (code.indexOf(' ') >= 0) {
					error_text = 'This value must not container space.';
				} else if (code.indexOf('px') !== code.length - 2 && code.indexOf('%') !== code.length - 1) {
					error_text = 'This value must end with "px" or "%".';
				}
			} else {
				error_text = 'This value must not be empty.';
			}
			$(error).text(error_text);
		});
		$(document).on('change', "[verify-auto-px-pct-input]", function() {
			var $this = $(this),
				error = $this.attr('verify-auto-px-pct-input'),
				code = $this.val(),
				error_text = '';
			if (code) {
				code = code.toLowerCase();
				if (code.indexOf(' ') >= 0) {
					error_text = 'This value must not container space.';
				} else if (code !== 'auto' && code.indexOf('px') !== code.length - 2 && code.indexOf('%') !== code.length - 1) {
					error_text = 'This value must be "auto" or ends with "px" / "%".';
				}
			} else {
				error_text = 'This value must not be empty.';
			}
			$(error).text(error_text);
		});
		$(document).on('click', "[click-target][click-value]", function(e) {
			var $this = $(this),
				selector = $this.attr('click-target'),
				value = $this.attr('click-value');
			$(selector).val(value).change();
			resize_follow_scroll();
			return false;
		});
		$(document).on('dblclick', "[double-click-target][click-value]", function(e) {
			var $this = $(this),
				selector = $this.attr('double-click-target'),
				value = $this.attr('click-value');
			$(selector).val(value).change();
			resize_follow_scroll();
			return false;
		});
		$(document).on('click touchend', '.popupally-add-split-test', add_split_test);
		$(document).on('click touchend', '[popupally-add-split-test-variate]', add_split_test_row);
		$(document).on('click touchend', '.popupally-customization-regex-add-button', add_regex_filter);

		$(document).on('change', "[signup-form-hide]", function() {
			var $this = $(this),
				is_checked = $this.prop('checked'),
				hide_target = $this.attr("signup-form-hide"),
				id = $this.attr('popup-id'),
				$target = $('[popup-id="'+id+'"][signup-html-template="'+hide_target+'"]');
			if (is_checked) {
				$target.hide();
			} else {
				$target.show();
			}
		});
		$(document).on('change', '[popupally-remove-step-aside]', function() {
			var $this = $(this),
				is_checked = $this.prop('checked'),
				$target = $($this.attr('popupally-remove-step-aside'));
			if (is_checked) {
				$target.removeClass('step-aside');
			} else {
				$target.addClass('step-aside');
			}
			var window_view_top = $(window).scrollTop(),
				window_view_bottom = window_view_top + $(window).height();
			adjust_follow_scroll_window_location($target, window_view_top, window_view_bottom);
		});
		update_follow_scroll();
	}
	
	// <editor-fold defaultstate="collapsed" desc="click to select all text">
	function select_all_text_in_element(elem) {
		var range, selection;

		if (document.body.createTextRange) {
			range = document.body.createTextRange();
			range.moveToElementText(elem);
			range.select();
		} else if (window.getSelection) {
			selection = window.getSelection();
			range = document.createRange();
			range.selectNodeContents(elem);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	}
	$(document).on('touchend click', '.popupally-code-to-copy', function(e) {
		select_all_text_in_element(this);
	});
	// </editor-fold>

	bind_all_dependencies();
	/* trigger the change event for HTML code text input */
	$('[preview-update-target]').change();
	$('#popupally-loading-overlay').remove();
});
