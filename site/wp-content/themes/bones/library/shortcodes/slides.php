<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
//slides (flexslider)		
add_shortcode('slider', 'mb_slider');
add_shortcode('slide', 'mb_slide');

function mb_slider($atts, $content= null){
	extract(shortcode_atts( array(
		'width' => '',
		'align' => 'none'
	), $atts));
	
	if($width!=''){
		$is_width = 'width:'.$width.'px;';
	}
	else {
		$is_width = 'width:100%;';	
	}
	
	return '<div class="slider slider-align-'.$align.'" style="'.$is_width.'max-width:100%;"><div class="flexslider"><ul class="slides">'.do_shortcode($content).'</ul></div></div>';
}



function mb_slide($atts, $content= null){			
	return '<li>'.do_shortcode($content).'</li>';
}




?>