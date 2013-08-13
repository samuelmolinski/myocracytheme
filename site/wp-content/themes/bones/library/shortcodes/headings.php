<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//headings		
add_shortcode('h1', 'mb_h1');
add_shortcode('h2', 'mb_h2');
add_shortcode('h3', 'mb_h3');
add_shortcode('h4', 'mb_h4');
add_shortcode('h5', 'mb_h5');
add_shortcode('h6', 'mb_h6');

function mb_h1 ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => ''
	), $atts));
	
	if($style !=''){
		$style = ' class="'.$style.'"';			
	}
	else {
		$style = '';	
	}
						
	return '<h1'.$style.'>'.do_shortcode($content).'</h1>';
}
	
function mb_h2 ($atts, $content= null){	
	extract(shortcode_atts( array(
		'style' => ''
	), $atts));
	
	if($style !=''){
		$style = ' class="'.$style.'"';			
	}
	else {
		$style = '';	
	}
				
	return '<h2'.$style.'>'.do_shortcode($content).'</h2>';
}
	
function mb_h3 ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => ''
	), $atts));
	
	if($style !=''){
		$style = ' class="'.$style.'"';			
	}
	else {
		$style = '';	
	}
					
	return '<h3'.$style.'>'.do_shortcode($content).'</h3>';
}
	
function mb_h4 ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => ''
	), $atts));
	
	if($style !=''){
		$style = ' class="'.$style.'"';			
	}
	else {
		$style = '';	
	}
					
	return '<h4'.$style.'>'.do_shortcode($content).'</h4>';
}
	
function mb_h5 ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => ''
	), $atts));
	
	if($style !=''){
		$style = ' class="'.$style.'"';			
	}
	else {
		$style = '';	
	}
					
	return '<h5'.$style.'>'.do_shortcode($content).'</h5>';
}
	
function mb_h6 ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => ''
	), $atts));
	
	if($style !=''){
		$style = ' class="'.$style.'"';			
	}
	else {
		$style = '';	
	}
					
	return '<h6'.$style.'>'.do_shortcode($content).'</h6>';		
}