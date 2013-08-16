jQuery(function($)
{
	$('body[class*="cunjoshare"]').addClass('share-by-cunjo');
	$.noConflict();
	// main menu -> submenus
	$('#menu .collapse').on('show', function()
	{
		$(this).parents('.hasSubmenu:first').addClass('active');
	})
	.on('hidden', function()
	{
		$(this).parents('.hasSubmenu:first').removeClass('active');
	});
	
	// main menu visibility toggle
	$('.navbar.main .btn-navbar').click(function()
	{
		$('.container-fluid:first').toggleClass('menu-hidden');
		$('#menu').toggleClass('hidden-phone');
		
		if (typeof masonryGallery != 'undefined') 
			masonryGallery();
	});
	
	// tooltips
	$('[data-toggle="tooltip"]').tooltip();
	$('[plus-toggle="tooltip"]').tooltip();
	
	if ($('.widget-activity').length)
		$('.widget-activity .filters .glyphicons').click(function()
		{
			$('.widget-activity .filters .active').toggleClass('active');
			$(this).toggleClass('active');
		});
	
	$(window).resize(function()
	{
		if (!$('#menu').is(':visible') && !$('.container-fluid:first').is('menu-hidden'))
			$('.container-fluid:first').addClass('menu-hidden');
	});
	
	$(window).resize();
	
	/* wysihtml5 */
	if ($('textarea.wysihtml5').size() > 0)
		$('textarea.wysihtml5').wysihtml5();
	
	/* DataTables */
	if ($('.dynamicTable').size() > 0)
	{
		$('.dynamicTable').dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			}
		});
	}
	if ($('.dynamicTable2').size() > 0)
	{
		$('.dynamicTable2').dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row-fluid'<'span12'l><'span12'f>r>t<'row-fluid'<'span12'i><'span12'p>>",
			"bRetrieve": true,
		});
	}
		/*
	 * Helper function for JQueryUI Sliders Create event
	 */
	function JQSliderCreate()
	{
		$(this)
			.removeClass('ui-corner-all ui-widget-content')
			.wrap('<span class="ui-slider-wrap"></span>')
			.find('.ui-slider-handle')
			.removeClass('ui-corner-all ui-state-default');
	}
		
	/*
	 * JQueryUI Slider: Bar width
	 */
		
	/*
	 * Boostrap Extended
	 */
	// custom select for Boostrap using dropdowns
	$('.selectpicker').selectpicker();
	
	// bootstrap-toggle-buttons
	$('.toggle-button').toggleButtons();
	
	/*
	 * UniformJS: Sexy form elements
	 */
	$('.uniformjs').find("select, input, button, textarea").uniform();
	
	// colorpicker
	if ($('#colorpicker').size() > 0)
	{
		$('#colorpicker').farbtastic('#colorpickerColor');
	}
	// datepicker
	if ($('#datepicker').length) 
	{
		$("#datepicker").datepicker({
			showOtherMonths:true,
			dateFormat: 'yy/mm/dd',
			altFormat: "yy-mm-dd"
		});
	}
	if ($('#datepicker-inline').length)
	{
		$('#datepicker-inline').datepicker({
	        inline: true,
			showOtherMonths:true,
			dateFormat: 'yy/mm/dd',
			altFormat: "yy-mm-dd"
	    });
	}
	
	// bookings daterange
	if ($('#dateRangeFrom').length && $('#dateRangeTo').length)
	{
		$( "#dateRangeFrom" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#dateRangeTo" ).datepicker( "option", "minDate", selectedDate );
			}
		}).datepicker( "option", "maxDate", $('#dateRangeTo').val() );

		$( "#dateRangeTo" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$( "#dateRangeFrom" ).datepicker( "option", "maxDate", selectedDate );
			}
		}).datepicker( "option", "minDate", $('#dateRangeFrom').val() );
	}
	
	$('.checkboxs thead :checkbox').change(function(){
		if ($(this).is(':checked'))
		{
			$('.checkboxs tbody :checkbox').prop('checked', true).parent().addClass('checked');
			$('.checkboxs tbody tr.selectable').addClass('selected');
			$('.checkboxs_actions').show();
		}
		else
		{
			$('.checkboxs tbody :checkbox').prop('checked', false).parent().removeClass('checked');
			$('.checkboxs tbody tr.selectable').removeClass('selected');
			$('.checkboxs_actions').hide();
		}
	});
	
	$('.checkboxs tbody').on('click', 'tr.selectable', function(e){
		var c = $(this).find(':checkbox');
		var s = $(e.srcElement);
		
		if (e.srcElement.nodeName == 'INPUT')
		{
			if (c.is(':checked'))
				$(this).addClass('selected');
			else
				$(this).removeClass('selected');
		}
		else if (e.srcElement.nodeName != 'TD' && e.srcElement.nodeName != 'TR' && e.srcElement.nodeName != 'DIV')
		{
			return true;
		}
		else
		{
			if (c.is(':checked'))
			{
				c.prop('checked', false).parent().removeClass('checked');
				$(this).removeClass('selected');
			}
			else
			{
				c.prop('checked', true).parent().addClass('checked');
				$(this).addClass('selected');
			}
		}
		if ($('.checkboxs tr.selectable :checked').size() == $('.checkboxs tr.selectable :checkbox').size())
			$('.checkboxs thead :checkbox').prop('checked', true).parent().addClass('checked');
		else
			$('.checkboxs thead :checkbox').prop('checked', false).parent().removeClass('checked');

		if ($('.checkboxs tr.selectable :checked').size() >= 1)
			$('.checkboxs_actions').show();
		else
			$('.checkboxs_actions').hide();
	});
	
	if ($('.checkboxs tbody :checked').size() == $('.checkboxs tbody :checkbox').size() && $('.checkboxs tbody :checked').length)
		$('.checkboxs thead :checkbox').prop('checked', true).parent().addClass('checked');
	
	if ($('.checkboxs tbody :checked').length)
		$('.checkboxs_actions').show();
	
	$('.radioboxs tbody tr.selectable').click(function(e){
		var c = $(this).find(':radio');
		if (e.srcElement.nodeName == 'INPUT')
		{
			if (c.is(':checked'))
				$(this).addClass('selected');
			else
				$(this).removeClass('selected');
		}
		else if (e.srcElement.nodeName != 'TD' && e.srcElement.nodeName != 'TR')
		{
			return true;
		}
		else
		{
			if (c.is(':checked'))
			{
				c.attr('checked', false);
				$(this).removeClass('selected');				
			}
			else
			{
				c.attr('checked', true);
				$('.radioboxs tbody tr.selectable').removeClass('selected');
				$(this).addClass('selected');
			}
		}
	});
	
	// sortable tables
	if ($( ".js-table-sortable" ).length)
	{	
		$( ".js-table-sortable" ).sortable(
		{
			placeholder: "ui-state-highlight",
			items: "tbody tr",
			handle: ".js-sortable-handle",
			forcePlaceholderSize: true,
			helper: function(e, ui) 
			{
				ui.children().each(function() {
					$(this).width($(this).width());
				});
				return ui;
			},
			start: function(event, ui) 
			{
				if (typeof mainYScroller != 'undefined') mainYScroller.disable();
				ui.placeholder.html('<td colspan="' + $(this).find('tbody tr:first td').size() + '">&nbsp;</td>');
			},
		    stop: function() { if (typeof mainYScroller != 'undefined') mainYScroller.enable(); }
		});
	}
	//drag social channels
	function drag_socials() {
		if ($( ".connected" ).length)
		{
			$(".connected").sortable({
				placeholder: "ui-state-highlight",
				connectWith: ".connected"
			}).bind("sortupdate", function() {});
		}
	}
	//init colorpickers
	function init_palette() {
		$( ".palette" ).each(function( index ) {
		 	var opt_id = $(this).attr('target');
			$(this).farbtastic(opt_id);
		});
	}
	$(document).ready(function() {
	  drag_socials();
	  init_palette();
	  $("*[ui_select]").select2();
	  
	});
});