jQuery(function($)
{
	//get preview of wp
	$('#preview_right_tab').on('show', function () {
		var wp_address = $(this).attr('wp_address');
	  	$('#preview_right_tab .modal-body').html('<iframe src="'+wp_address+'" frameborder="0" style="width: 100%;"></iframe>');
		preview_modal('#preview_right_tab');
		$(document.body).css('overflow', 'hidden');
		$('#wpadminbar').css('display', 'none');
	});
	$('#preview_right_tab').on('hide', function () {
		$(document.body).css('overflow', 'initial');
		$('#wpadminbar').css('display', 'initial');
	});
		
	/*extra actions*/
	//init social icon styles dropdown
	$('#right_tab_bar_layout_design').on('show', function () {
	  	icon_dropdowns('1,0,right_tab');
	});
	//init message icon styles dropdown
	$('#right_tab_call_to_action').on('show', function () {
	  	icon_dropdowns('0,1,right_tab');
	});
	$('#right_tab_visibility_settings').on('show', function() {
		onload_checkbox_handler();
	});
	//show-hide call to action link settings
	$(document.body).on('change', '#message-has-link', function(e) {
		if($('#activatelink-group:visible :checkbox:checked').length > 0) {
			$('#messagebtncolor-group').fadeIn(300);
			$('#messagebtn-group').fadeIn(300);
			$('#messagebtntext-group').fadeIn(300);
			$('#messagelink-group').fadeIn(300);
		}
		else {
			$('#messagebtncolor-group').fadeOut(300);
			$('#messagebtn-group').fadeOut(300);
			$('#messagebtntext-group').fadeOut(300);
			$('#messagelink-group').fadeOut(300);
			$('#messagelink').attr('value', '');
		}
	});
});