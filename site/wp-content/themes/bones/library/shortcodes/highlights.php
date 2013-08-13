<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//highlights
add_shortcode('highlight', 'mb_highlight');




function mb_highlight ($atts, $content= null){
	extract(shortcode_atts( array(
		'color' => '',
		'background' => '',
		'style' => ''
	), $atts));
	
	if ($color != '' || $background != '') {
		return '<span class="highlight" style="color:'.$color.';background:'.$background.'">'.$content.'</span>'; 
	}
	else {
		
		
		if($style == 'style1'){
			$highlight_class = 1;
		}
		elseif($style == 'style2'){
			$highlight_class = 2;
		}
		elseif($style == 'style3'){
			$highlight_class = 3;
		}
		else{
			$highlight_class = '1';	
		}		
		
		return '<span class="highlight'.$highlight_class.'">'.$content.'</span>'; 
	}
}

