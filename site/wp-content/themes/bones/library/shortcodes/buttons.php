<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
 
 
 
 
/*-----------------------------------------------------------------------------------*/
/*	Custom link with arrow
/*-----------------------------------------------------------------------------------*/
add_shortcode('arrow_link','mb2_arrow_link');

function mb2_arrow_link($atts, $content= null){
	extract(shortcode_atts( array(
		'value' => 'Read More',
		'target' => '_self',
		'permalink' => 'false',
		'link' =>'#'	 
	), $atts));	
	
	
	if($permalink == 'true'){
		$link = get_post_permalink();
	}
	else {
		$link = $link;	
	}
	
		
	return '<a class="arrow-link" href="'.$link.'" target="'. $target .'"><span>'. $value .'</span></a>';
}
 
 
 
 
 
 
 
 
 
/*-----------------------------------------------------------------------------------*/
/*	Default button
/*-----------------------------------------------------------------------------------*/
add_shortcode('button', 'mb_button');	

function mb_button ($atts, $content= null){
	extract(shortcode_atts( array(
		'link' => '#',
		'value' => 'Read more',
		'target' => '_self',
		'color' => '',
		'background' => ''	
	), $atts));	
	
	
	
	if ($color != '' || $background !=''){
		return '<a href="'.$link.'" class="button-small" style="background-color:'.$background.';color:'.$color.';" target="'.$target.'"><span>'.$value.'</span></a>';			
	}
	else{
		return '<a href="'.$link.'" class="button-small" target="'.$target.'"><span>'.$value.'</span></a>'; 
	}
}






/*-----------------------------------------------------------------------------------*/
/*	Big button
/*-----------------------------------------------------------------------------------*/
add_shortcode('button_big', 'mb_button_big');
	
function mb_button_big ($atts, $content= null){
	extract(shortcode_atts( array(
		'link' => '#',
		'value' => 'Read More',
		'target' => '_self',
		'color' => '',
		'background' => '',
		'style'=> '',
		'lightbox_link' => ''	
	), $atts));	
	
	
	
	
	if($style != ''){
		$button_style = ' button-'.$style.'';	
	}
	else {
		$button_style = '';	
	}
	
	
	
	if($lightbox_link !='') {
		$rel = ' data-rel="prettyPhoto"';
		$is_link = $lightbox_link;
	}
	else {
		$rel = '';	
		$is_link = $link;
	}
	
	
	
	if ($color != '' || $background !=''){
		return '<a href="'.$is_link.'" class="button-big'.$button_style.'" style="background-color:'.$background.';color:'.$color.';" target="'.$target.'"'.$rel.'><span>'.$value.'</span></a>'; 			
	}
	else{
		return '<a href="'.$is_link.'" class="button-big'.$button_style.'" target="'.$target.'"'.$rel.'><span>'.$value.'</span></a>'; 
	}
}