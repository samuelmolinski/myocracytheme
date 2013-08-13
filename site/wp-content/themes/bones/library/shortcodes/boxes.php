<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 


/*-----------------------------------------------------------------------------------*/
/*	Default boxes
/*-----------------------------------------------------------------------------------*/
add_shortcode('box', 'mb2_box');

function mb2_box ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => '',
		'title' => '',
		'text_align' => ''	
	), $atts));
		
	
	if($text_align !=''){
		$align_class = ' text-align-'.$text_align.'';	
	}	
	else {
		$align_class = '';
	}
		
		
	return '<div class="box-'.$style.''.$align_class.'"><div class="box"><h4 class="box-title">'.$title.'</h4>'.do_shortcode($content).'</div></div>';	
		
}





/*-----------------------------------------------------------------------------------*/
/*	Messages
/*-----------------------------------------------------------------------------------*/
add_shortcode('message', 'mb2_message');

function mb2_message ($atts, $content= null){
	extract(shortcode_atts( array(
		'type' => ''	
	), $atts));	
	return '<div class="message-'.$type.'"><div class="box">'.do_shortcode($content).'</div></div>';	
}