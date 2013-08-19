jQuery(function($)
{
	//register for ID
	$(document.body).on('click', '#submit-registerid', function () {
		$(this).button('loading');
		$('#registerShare .alert').attr('class', 'alert alert-info');
		$('#registerShare .alert i').attr('class', 'appz-clock-3');
		$('#registerShare .alert span').html('loading...');
		var email = $('#cunjo_email').val();
		var firstname = $('#cunjo_firstname').val();
		var lastname = $('#cunjo_lastname').val();
		if (!validateEmail(email)) {
			$(this).button('reset');
			$('#registerShare .alert').attr('class', 'alert alert-error');
			$('#registerShare .alert i').attr('class', 'appz-warning-2');
			$('#registerShare .alert span').html('Please input a valid email address');
		}
		else if(!$('#registerid-terms span span').hasClass('checked')) {
			$(this).button('reset');
			$('#registerShare .alert').attr('class', 'alert alert-error');
			$('#registerShare .alert i').attr('class', 'appz-warning-2');
			$('#registerShare .alert span').html('You must agree with our Terms & Conditions');
		}
		else {
			var data = 'ajaxcall=share&step=sendid&email='+email+'&firstname='+firstname+'&lastname='+lastname;
			$.ajax({
				type: "POST",
				url: 'http://share.cunjo.com/wp-content/themes/share/inc/ajaxify.php',
				data: data,
				success: function(data) {
					if(data == 'emailexists') {
						$('#submit-registerid').button('reset');
						$('#registerShare .alert').attr('class', 'alert alert-error');
						$('#registerShare .alert i').attr('class', 'appz-warning-2');
						$('#registerShare .alert span').html('You already have a !Share ID!');
					}
					else if(data == 'goodtogo'){
						$('#submit-registerid').button('reset');
						$('#registerShare .alert').attr('class', 'alert alert-success');
						$('#registerShare .alert i').attr('class', 'appz-checkmark-circle-2');
						$('#registerShare .alert span').html('!Share ID successfully registered. Please check your inbox.');
					}
				}
			});
		}
	});
	//save general settings
	$(document.body).on('click', '#general_settings-submit', function(){
		$(this).button('loading');
		var has_analytics = 'no';
		 
        if($('#has_analytics-wrap :checkbox:checked').length > 0) {
			has_analytics = 'yes';
		}
		if($('#cunjo_shareid').val() == '') {
			new Messi('You need a !Share ID to save these settings. Please input your !Share ID.', {title: 'Error', titleClass: 'anim warning', buttons: [{id: 0, label: 'OK', val: 'X'}]});
			$('#general_settings-submit').button('reset');
		}
		else if(checkID($('#cunjo_shareid').val()) == 'no') {
			new Messi('<strong>This ID is not in our database!</strong><br /><small style="margin-bottom: 10px">*If you do not have a !Share ID please register for one, FREE.</small>', {title: 'Error', titleClass: 'anim warning', buttons: [{id: 0, label: 'OK', val: 'X'}]});
			$('#general_settings-submit').button('reset');
		}
		else {
			var action = "SaveGeneralSetting";
			var controller = "Settings/SaveGeneralSetting";
			Messi.ask('Are you sure that you want to update the general settings?', function(val) { 
			   if (val == "Y") {
						if($('#require_analytics_account').prop('checked')) {
            			console.log("Registering analytics account");
                        
                        $.ajax({
							  url: "http://cunjo.com/socialanalytics/user.php?action=ajax_register",
							  data: "email=" + $("#cunjo_analyticsregister-email").val() + "&pass=" + $("#cunjo_analyticsregister-password").val() + "&cpass="+ $("#cunjo_analyticsregister-password").val() +"&terms=1",
							  type: "POST", 
							  dataType: "json",
							  async: true,
							  success:
								function(response){
									new Messi(''+response.message+'', {title: '!Share Analytics Registration:', titleClass: ''+response.status+'', buttons: [{id: 0, label: 'Close', val: 'X'}]});
								}
							});
						}
						
						$.ajax({
						  url: ajaxurl,
						  data: "action=" + action + "&controller=" + controller + "&has_analytics="+has_analytics+"&" + $('#general_settings-form').serialize(),
						  type: "POST", 
						  dataType: "json",
						  async: true,
						  success:
							function(response){
								new Messi(''+response.message+'', {title: 'Status', titleClass: ''+response.status+'', buttons: [{id: 0, label: 'Close', val: 'X'}]});
							}
						});
						$('#general_settings-submit').button('reset');
					}
					else {
						$('#general_settings-submit').button('reset');
					}
		   });
			
		}
	});
	//activate widgets
	$(document.body).on('click', '.activate-widget', function(e) {
		$(this).button('loading');
		var layout = $(this).attr('layout');
		var action = layout+"_activate";
		   var controller = "Settings/ActivateWidget";
		   Messi.ask('Are you sure that you want to activate this widget?', function(val) { 
			   if (val == "Y") {
						$.ajax({
						   url: ajaxurl,
						   data: "action=" + action + "&controller=" + controller + "&layout=" + layout,
						   type: "POST", 
						   dataType: "json",
						   async: true,
						   success:
							  function(response){
									new Messi(''+response.message+'', {title: 'Status', titleClass: ''+response.status+'', buttons: [{id: 0, label: 'Close', val: 'X'}]});
							   
								   $('.widget-status-label[layout="'+layout+'"]').html('<span class="badge badge-success"></span> Active Widget');
								   $('.cunjo_widget-footer[layout="'+layout+'"]').html('<button class="btn btn-block btn-info btn-small deactivate-widget" layout="bottom_tab" data-loading-text="loading...">Deactivate</button>');
							  }
						 });
					}
					else {
						$('.activate-widget').button('reset');
					}
		   });

	});
	//deactivate widgets
	$(document.body).on('click', '.deactivate-widget', function(e) {
		$(this).button('loading');
		var layout = $(this).attr('layout');
		var action = layout+"_deactivate";
		   var controller = "Settings/DeactivateWidget";
		   Messi.ask('Are you sure that you want to deactivate this widget?', function(val) { 
			   if (val == "Y") {
						$.ajax({
						   url: ajaxurl,
						   data: "action=" + action + "&controller=" + controller + "&layout=" + layout,
						   type: "POST", 
						   dataType: "json",
						   async: true,
						   success:
							  function(response){
									new Messi(''+response.message+'', {title: 'Status', titleClass: ''+response.status+'', buttons: [{id: 0, label: 'Close', val: 'X'}]});
							   
								   $('.widget-status-label[layout="'+layout+'"]').html('<span class="badge"></span> Installed Widget');
								   $('.cunjo_widget-footer[layout="'+layout+'"]').html('<button class="btn btn-block btn-primary btn-small activate-widget" layout="bottom_tab" data-loading-text="loading...">Activate</button>');
							  }
						 });
					}
					else {
						$('.activate-widget').button('reset');
					}
		   });
	});
	//save dynamic settings
	$(document.body).on('click', '.save-widget-settings', function(){
		var form_id = $(this).attr('settings');
		var action = "SaveWidgetSettings";
        var controller = "Settings/SaveWidgetSettings";
		var layout = $(this).attr('layout');

        var category = $(form_id).attr('title');
		Messi.ask("Are you sure that you want to update the "+category+"?", function(val) { 
			   if (val == "Y") {
						$.ajax({
						  url: ajaxurl,
						  data: "action=" + action + "&controller=" + controller + "&layout="+layout+"&category="+category + "&data=" + encodeURIComponent(($(form_id).serialize())),
						  type: "POST",
						  dataType: "json",
						  async: true,
						  traditional: true,
								  success:
										function(response){
												new Messi(''+response.message+'', {title: 'Status', titleClass: ''+response.status+'', buttons: [{id: 0, label: 'Close', val: 'X'}]});
										}
						});
					}
		   });
	});

	//general actions
	$(document.body).on('change', '#has_analytics-wrap :checkbox', function(e) {
		if($('#has_analytics-wrap :checkbox:checked').length > 0) {
			$('#analytics-group').slideDown(300);
		}
		else {
			$('#analytics-group').slideUp(300);
		}
	});
	$(document.body).on('click', '#register-analytics-check span span', function(e) {
		if($(this).hasClass('checked')) {
			$('.analytics-register').slideDown(300);
		}
		else {
			$('.analytics-register').slideUp(300);
		}
	});
	$(document.body).on('click', '.undo-color', function(e) {
		e.preventDefault();
		var target = $(this).attr('target');
		var original = $(this).attr('original');
		$(target).val(original);
		$.farbtastic('.palette[target="'+target+'"]').setColor(original);
	});
	
	function validateEmail(email) { 
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		return pattern.test(email);
	} 
	function checkID(share_id) {
		var data = 'ajaxcall=share&step=getshare&idz='+share_id;
		var is_valid = 'no'
		$.ajax({
			type: "POST",
			url: 'http://share.cunjo.com/wp-content/themes/share/inc/ajaxify.php',
			data: data,
			async: false,
			success: function(data) {
				if(data == 'noid') {
					is_valid = 'no';
				}
				else {
					is_valid = 'yes';
				}
			}
		});
		return is_valid;
	}
	var active_checkbox_handler = function() {
        var target_name = $(this).attr('target_name');
        var target_id = $(this).attr('target_id');
   
		console.log("Got checkbox target name:" + target_name);
		console.log("Got checkbox target id:" + target_id);
	   
		if(!$('#'+target_id).length) {
			console.log("Hidden input created");
			$('*[target_id="'+target_id+'"]').after('<input type="hidden" name="'+target_name+'" id="'+target_id+'" />');
			}
			if($(this).is(':checked')) {
					console.log("Checkbox checked");
			$('#'+target_id).val('1');
			}
			else {
			   console.log("Checkbox unchecked");
					$('#'+target_id).val('0');
			}
	}
	
	$(document.body).on('change', '*[data-toggle="value"]', active_checkbox_handler);
});

function icon_dropdowns(to_show) {
	to_show = to_show.split(',');
	if(to_show[0] == 1) {
		//select icons
		function icons_style(icons) {
			if (!icons.id) return icons.text; // optgroup
			return "<img class='icon-styles' src='http://cunjo.com/!Share_test/layouts/"+to_show[2]+"/images/icons-" + icons.id.toLowerCase() + "-demo.png'/>" + icons.text;
		}
		jQuery(".select-icons").select2("destroy");
		jQuery(".select-icons").select2({
			formatResult: icons_style,
			formatSelection: icons_style,
			escapeMarkup: function(m) { return m; }
		});
	}
	if(to_show[1] == 1) {
		//select message icons
		function message_icons_style(icons) {
			if (!icons.id) return icons.text; // optgroup
			return "<img class='icon-styles' src='http://cunjo.com/!Share_test/layouts/"+to_show[2]+"/images/message-" + icons.id + "-demo.png'/>" + icons.text;
		}
		jQuery(".select-message-icons").select2("destroy");
		jQuery(".select-message-icons").select2({
			formatResult: message_icons_style,
			formatSelection: message_icons_style,
			escapeMarkup: function(m) { return m; }
		});
	}
}

function preview_modal(modal) {
	//preview modals ajust
		var previewmodalH = jQuery(window).height() - 50;
		var previewmodalW = jQuery(window).width() - 50;
		var halfpreviewmodalH = previewmodalH / 2;
		var halfpreviewmodalW = previewmodalW / 2;
		var modalbodyH = previewmodalH - 140;
		var iframeH = modalbodyH - 20;
		jQuery(modal).css({'height': previewmodalH+'px', 'margin-top': '-'+halfpreviewmodalH+'px', 'width': previewmodalW+'px', 'margin-left': '-'+halfpreviewmodalW+'px'});
		jQuery(modal+' .modal-body').css({'max-height': modalbodyH+'px', 'padding': '0px', 'overflow': 'hidden'});
		jQuery(modal+' .modal-body iframe').css('height', iframeH+'px');
}

function onload_checkbox_handler() {
	// loop through all checkboxes
	jQuery('input[type="checkbox"][target_name][target_id]').each(function(i, val){
		var target_name = jQuery(this).attr('target_name');
		var target_id = jQuery(this).attr('target_id');    
   
		console.log("Got checkbox target name:" + target_name);
		console.log("Got checkbox target id:" + target_id);
   
		if(!jQuery('#'+target_id).length) {
			console.log("Hidden input created");
			jQuery('*[target_id="'+target_id+'"]').after('<input type="hidden" name="'+target_name+'" id="'+target_id+'" />');
		}
		if(jQuery(this).is(':checked')) {
				console.log("Checkbox checked");
			jQuery('#'+target_id).val('1');
		}
		else {
		   console.log("Checkbox unchecked");
				jQuery('#'+target_id).val('0');
		}
	});
}