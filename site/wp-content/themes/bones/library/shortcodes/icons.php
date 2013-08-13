<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
//quotes		
add_shortcode('icon', 'mb_icon');

function mb_icon($atts, $content= null){
	extract(shortcode_atts( array(
		'name' => 'facebook',
		'link' => '#',
		'target' => '_blank'	
	), $atts));		
	return '<a class="icon icon-'.$name.'" href="'.$link.'" target="'.$target.'">'.$name.'</a>';	
}
?>