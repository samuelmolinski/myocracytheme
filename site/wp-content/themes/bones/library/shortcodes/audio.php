<?php
 
//audio
add_shortcode('audio', 'mb2_audio');


function mb2_audio ($atts, $content= null){
	extract(shortcode_atts( array(
		'url' => '',
		'preload' => 'none',
		'align' => '',
		'width' => ''
		//'autoplay' => 'none',
		//'loop' => 'none'
	), $atts));
	
	
	
	if($align=='left'){
		$style = 'float:left;margin-right:25px;';	
	}
	elseif($align=='right'){
		$style = 'float:right;margin-left:25px;';	
	}
	elseif($align=='none'){
		$style = 'float:none;';	
	}
	else{
		$style = 'margin-left:auto;margin-right:auto;';
	}
	
	if($width !=''){
		$is_width = 'width:'.$width.'px;';	 
	}
	else{
		$is_width = '';	
	}	
	
	
		
		return '<div class="audio-player" style="'.$style.''.$is_width.'max-width:100%;"><audio src="'.$url.'" preload="'.$preload.'"></audio></div>';
}