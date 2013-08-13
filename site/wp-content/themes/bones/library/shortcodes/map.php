<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
//google map
add_shortcode('map', 'mb_map');

function mb_map($atts, $content=null){
extract(shortcode_atts( array(
	'adress' => '',
	'height' => '300',
	'width' => '400',
	'zoom' => '14',
	'link' => '',
	'alt' => '',
	'align' => 'none'
), $atts));


	$map_url = 'http://maps.google.com/maps/api/staticmap?size='.$width.'x'.$height.'&zoom='.$zoom.'&maptype=roadmap&markers=color:green|'.$adress.'&sensor=false';

	

	if($link !=''){
		return '<div class="google-map google-map-align-'.$align.'" style="width:'.$width.'px;height:auto;max-width:100%;"><a href="'.$link.'" style="display:block;background:url('.$map_url.')no-repeat center center;"><img style="opacity:0;max-width:100%;" src="'.$map_url.'" alt="'.$alt.'" /></a></div>'; 
	}	
	else{			
		return '<div class="google-map google-map-align-'.$align.'"><img style="max-width:100%;" src="'.$map_url.'" alt="'.$alt.'" /></div>';
	}	
	
}