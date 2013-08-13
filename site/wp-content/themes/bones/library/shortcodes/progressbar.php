<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//highlights
add_shortcode('progressbar', 'mb_progressbar');

function mb_progressbar ($atts, $content= null){
	extract(shortcode_atts( array(
		'name' => 'Skil',
		'value' => '32'
	), $atts));
	
	
	return '<div class="progressbar-name">'.$name.'<span>'.$value.'%</span></div><div class="progressbar-wrapper"><div class="progressbar" style="width:'.$value.'%;"></div></div>';		
	
	
}

