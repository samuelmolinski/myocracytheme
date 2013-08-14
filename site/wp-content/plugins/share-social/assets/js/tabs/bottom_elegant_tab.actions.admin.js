jQuery(function($)
{
	//get preview of wp
	$('#preview_bottom_elegant_tab').on('show', function () {
		var wp_address = $(this).attr('wp_address');
	  	$('#preview_bottom_elegant_tab .modal-body').html('<iframe src="'+wp_address+'" frameborder="0" style="width: 100%;"></iframe>');
		preview_modal('#preview_bottom_elegant_tab');
		$(document.body).css('overflow', 'hidden');
		$('#wpadminbar').css('display', 'none');
	});
	$('#preview_bottom_elegant_tab').on('hide', function () {
		$(document.body).css('overflow', 'initial');
		$('#wpadminbar').css('display', 'initial');
	});
		
	/*extra actions*/
	//init social icon styles dropdown
	$('#bottom_elegant_tab_bar_layout_design').on('show', function () {
	  	icon_dropdowns('1,0,bottom_elegant_tab');
	});
	//init message icon styles dropdown
	$('#bottom_elegant_tab_call_to_action').on('show', function () {
	  	icon_dropdowns('0,1,bottom_elegant_tab');
	});
	$('#bottom_elegant_tab_visibility_settings').on('show', function() {
		onload_checkbox_handler();
	});
	function JQSliderCreate()
	{
		$(this)
			.removeClass('ui-corner-all ui-widget-content')
			.wrap('<span class="ui-slider-wrap"></span>')
			.find('.ui-slider-handle')
			.removeClass('ui-corner-all ui-state-default');
	}
	//slider
	if ($('.slider-bar-width-bottom_elegant_tab').size() > 0)
	{
		var has_value = $('.slider-bar-width-bottom_elegant_tab .slider').attr('has_value');
		$( ".slider-bar-width-bottom_elegant_tab .slider" ).slider({
			create: JQSliderCreate,
            range: "min",
            value: has_value,
            min: 20,
            max: 100,
            slide: function( event, ui ) {
                $( ".slider-bar-width-bottom_elegant_tab .amount" ).val( ui.value );
            },
            start: function() { if (typeof mainYScroller != 'undefined') mainYScroller.disable(); },
	        stop: function() { if (typeof mainYScroller != 'undefined') mainYScroller.enable(); }
        });
        $( ".slider-bar-width-bottom_elegant_tab .amount" ).val( $( ".slider-bar-width-bottom_elegant_tab .slider" ).slider( "value" ) );
	}
	//show-hide call to action link settings
	$(document.body).on('change', '#message-has-link-bottom_elegant_tab', function(e) {
		if($('#activatelink-group-bottom_elegant_tab:visible :checkbox:checked').length > 0) {
			$('#messagebtncolor-group-bottom_elegant_tab').fadeIn(300);
			$('#messagebtn-group-bottom_elegant_tab').fadeIn(300);
			$('#messagebtntext-group-bottom_elegant_tab').fadeIn(300);
			$('#messagelink-group-bottom_elegant_tab').fadeIn(300);
		}
		else {
			$('#messagebtncolor-group-bottom_elegant_tab').fadeOut(300);
			$('#messagebtn-group-bottom_elegant_tab').fadeOut(300);
			$('#messagebtntext-group-bottom_elegant_tab').fadeOut(300);
			$('#messagelink-group-bottom_elegant_tab').fadeOut(300);
			$('#messagelink-bottom_elegant_tab').attr('value', '');
		}
	});
});