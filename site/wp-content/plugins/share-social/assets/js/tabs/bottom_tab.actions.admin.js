jQuery(function($)
{
	//get preview of wp
	$('#preview_bottom_tab').on('show', function () {
		var wp_address = $(this).attr('wp_address');
	  	$('#preview_bottom_tab .modal-body').html('<iframe src="'+wp_address+'" frameborder="0" style="width: 100%;"></iframe>');
		preview_modal('#preview_bottom_tab');
		$(document.body).css('overflow', 'hidden');
		$('#wpadminbar').css('display', 'none');
	});
	$('#preview_bottom_tab').on('hide', function () {
		$(document.body).css('overflow', 'initial');
		$('#wpadminbar').css('display', 'initial');
	});
		
	/*extra actions*/
	//init social icon styles dropdown
	$('#bottom_tab_bar_layout_design').on('show', function () {
	  	icon_dropdowns('1,0,bottom_tab');
	});
	//init message icon styles dropdown
	$('#bottom_tab_call_to_action').on('show', function () {
	  	icon_dropdowns('0,1,bottom_tab');
	});
	$('#bottom_tab_visibility_settings').on('show', function() {
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
	if ($('.slider-bar-width-bottom_tab').size() > 0)
	{
		var has_value = $('.slider-bar-width-bottom_tab .slider').attr('has_value');
		$( ".slider-bar-width-bottom_tab .slider" ).slider({
			create: JQSliderCreate,
            range: "min",
            value: has_value,
            min: 20,
            max: 100,
            slide: function( event, ui ) {
                $( ".slider-bar-width-bottom_tab .amount" ).val( ui.value );
            },
            start: function() { if (typeof mainYScroller != 'undefined') mainYScroller.disable(); },
	        stop: function() { if (typeof mainYScroller != 'undefined') mainYScroller.enable(); }
        });
        $( ".slider-bar-width-bottom_tab .amount" ).val( $( ".slider-bar-width-bottom_tab .slider" ).slider( "value" ) );
	}
	//show-hide call to action link settings
	$(document.body).on('change', '#message-has-link-bottom_tab', function(e) {
		if($('#activatelink-group-bottom_tab:visible :checkbox:checked').length > 0) {
			$('#messagebtncolor-group-bottom_tab').fadeIn(300);
			$('#messagebtn-group-bottom_tab').fadeIn(300);
			$('#messagebtntext-group-bottom_tab').fadeIn(300);
			$('#messagelink-group-bottom_tab').fadeIn(300);
		}
		else {
			$('#messagebtncolor-group-bottom_tab').fadeOut(300);
			$('#messagebtn-group-bottom_tab').fadeOut(300);
			$('#messagebtntext-group-bottom_tab').fadeOut(300);
			$('#messagelink-group-bottom_tab').fadeOut(300);
			$('#messagelink-bottom_tab').attr('value', '');
		}
	});
});