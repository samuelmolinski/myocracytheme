<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//images
add_shortcode('image', 'mb2_image');



function mb2_image ($atts, $content= null){
	extract(shortcode_atts( array(
		'url' => '',
		'width' => '360',
		'height' => '150',
		'lightbox' => 'false',
		'align' => '',
		'link' => '',
		'target' => 'self',
		'title' => '',
		'gallery_id' => ''
	), $atts));
	
	
	//thumbnail resize script
	$mb2_image=matthewruddy_image_resize($url,$width,$height,true,false); 
	
	
	//check if url parameter isn't empty
	if($url !=''){
		
		//check if ligtbox parameter is true
		if($lightbox == 'true') {
			
			
			if ($gallery_id !='') {
				$rel = 'data-rel="prettyPhoto['.$gallery_id.']"';
				$align = ''.$align.' gallery-item';
			}
			else {
				$rel= 'data-rel="prettyPhoto"';
				$align = $align;	
			}		
			
			return '<div class="post-thumb align-'.$align.'" style="width:'.$width.'px;max-width:100%;height:auto;"><div class="zoom-img"><a href="'.$url.'" '.$rel.' title="'.$title.'"><img class="img img-opacity" src="'.$mb2_image['url'].'" alt="'.$title.'"/></a></div></div>'; 
		} 
		else {			
			if($link!=''){			
				return '<div class="post-thumb align-'.$align.'" style="width:'.$width.'px;max-width:100%;height:auto;"><div class="zoom-post"><a href="'.$link.'" target="_'.$target.'"><img class="img img-opacity" src="'.$mb2_image['url'].'" alt="'.$title.'"/></a></div></div>';			
			}
			else {				
				return '<img class="img align-'.$align.'" src="'.$mb2_image['url'].'" alt=""/>';
				}				
		}
		 	
	}
	
}









//gallery div
add_shortcode('gall_container', 'mb2_gall_container');
function mb2_gall_container ($atts, $content= null){
	extract(shortcode_atts( array(
		'id' => ''
	), $atts));
	
	
	if($id !=''){		
		$id = 'id="gallery-'.$id.'"';		
	}
	else{
		$id = '';	
	}
	
	
	return '<div class="gallery-wrap" '.$id.'>'.do_shortcode($content).'<div class="clear"></div></div>';	
	
}





