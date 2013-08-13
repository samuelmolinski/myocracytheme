<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//accordion
add_shortcode('accordion', 'mb2_accordion');
add_shortcode('toggle', 'mb2_toggle');




function mb2_accordion ($atts, $content= null){
	return '<div class="accordion">'.do_shortcode($content).'</div>'; 
}

function mb2_toggle ($atts, $content= null){
	extract(shortcode_atts( array(
		'title' => ''	
	), $atts));	
		return '<h3 class="accordion-title">'.$title.'</h3><div>'.do_shortcode($content).'</div>';			
}








/*
function mb_accordion ($atts, $content= null){	
	return '<div id="accordion-wrapper">'.do_shortcode($content).'</div>'; 
}

function mb_toggle ($atts, $content= null){
	extract(shortcode_atts( array(
		'title' => '',
		'active' => '',	
	), $atts));
	
	if ($active == '1'){	
		return '<div class="accordion-heading" id="active"><h2>'.$title.'</h2></div><div class="accordion-content">'.do_shortcode($content).'</div>';
	}
	else {
		return '<div class="accordion-heading"><h2>'.$title.'</h2></div><div class="accordion-content">'.do_shortcode($content).'</div>';
	}
}
*/

?>