<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
/*-----------------------------------------------------------------------------------*/
/*	Clear div
/*-----------------------------------------------------------------------------------*/
add_shortcode('clear', 'mb2_clear');

function mb2_clear($atts, $content= null){
	return '<div class="clear"></div>'; 
}



	
/*-----------------------------------------------------------------------------------*/
/* Break line
/*-----------------------------------------------------------------------------------*/	
add_shortcode('br', 'mb2_br');
	
function mb2_br($atts, $content= null){
	return '<br/>'; 
}





/*-----------------------------------------------------------------------------------*/
/*	Seoarator div
/*-----------------------------------------------------------------------------------*/
add_shortcode('separator', 'mb2_separator');

function mb2_separator($atts, $content= null){
	extract(shortcode_atts( array(
		'margin_top' => '0',
		'margin_bottom' => '0'	
	), $atts));
	
	return '<div style="margin-top:'.$margin_top.'px;margin-bottom:'.$margin_bottom.'px" class="clear separator"></div>'; 
}






/*-----------------------------------------------------------------------------------*/
/*	Gap div
/*-----------------------------------------------------------------------------------*/
add_shortcode('gap', 'mb2_gap');

function mb2_gap($atts, $content= null){
	extract(shortcode_atts( array(
		'height' => ''
	), $atts));
	
	return '<div style="height:'.$height.'px" class="gap"></div>'; 
}




	
/*-----------------------------------------------------------------------------------*/
/* Styled span
/*-----------------------------------------------------------------------------------*/	
add_shortcode('span', 'mb2_span');

function mb2_span($atts, $content= null){
	extract(shortcode_atts( array(
		'size' => '',
		'style' => '',
		'weight' => '',
		'transform' => '',
		'color' => ''		
	), $atts));
	
	$span_size = '';
	$span_style = '';
	$span_weight = '';
	$span_transform = '';
	$span_color = '';
	
	
	
	if($size !='' || $style !='' || $weight !='' || $transform !='' || $color !=''){
		
		if($size !=''){
			$span_size = 'font-size:'.$size.'px;';			
		}
		
		if($style !=''){
			$span_style = 'font-style:'.$style.';';
		}
		
		if($weight !=''){
			$span_weight = 'font-wight:'.$weight.';';
		}
		
		if($transform !=''){
			$span_transform = 'text-transform:'.$transform.';';
		}
		
		if($color !=''){
			$span_color = 'color:'.$color.';';
		}			
		
		$span_styles = 'style="'.$span_size.''.$span_style.''.$span_weight.''.$span_transform.''.$span_color.'"';		
		
		
	}
	
	
	
	return '<span '.$span_styles.'>'.$content.'</span>';
}







/*-----------------------------------------------------------------------------------*/
/* Div align center
/*-----------------------------------------------------------------------------------*/	
add_shortcode('center', 'mb2_center');

function mb2_center($atts, $content= null){

	return '<div class="text-align-center">'.do_shortcode($content).'</div>';	
	
}


