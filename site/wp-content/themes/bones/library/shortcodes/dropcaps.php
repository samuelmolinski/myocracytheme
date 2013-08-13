<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//searchform
add_shortcode('dropcap', 'mb_dropcap');

function mb_dropcap($atts, $content= null){
	extract(shortcode_atts( array(
		'value' => 'L',
		'style' => 'style1'
	), $atts));	
	return '<span class="dropcap-'.$style.'">'.$value.'</span>';
}


