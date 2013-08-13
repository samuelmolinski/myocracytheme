<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//video
add_shortcode('youtube', 'mb_youtube');
add_shortcode('vimeo', 'mb_vimeo');
add_shortcode('video_lightbox', 'mb_video_lightbox');


//youtube video	
function mb_youtube($atts, $content=null){
extract(shortcode_atts( array(
	'id' => 'UX7GycmeQVo',
	'width' => '',
	'height' => '',
	'flexible' => '1'	
), $atts));	

if($flexible !='0'){
	$is_flexible = 'flexible-';	
}
else	{
	$is_flexible = '';		
}

	

	return '<div class="'.$is_flexible.'video-wrapper"><iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/' .$id. '?wmode=transparent" frameborder="0" allowfullscreen></iframe></div>';
}	



//vimeo video	
function mb_vimeo($atts, $content=null){
extract(shortcode_atts( array(
	'id' => '23534361',
	'width' => '',
	'height' => '',
	'flexible' => '1'
), $atts));


if($flexible !='0'){
	$is_flexible = 'flexible-';	
}
else	{
	$is_flexible = '';		
}

	return '<div class="'.$is_flexible.'video-wrapper"><iframe src="http://player.vimeo.com/video/'.$id.'?" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}





//video in lightbox
function mb_video_lightbox ($atts, $content= null){
	extract(shortcode_atts( array(
		'video_url' => '',
		'thumbnail_url'=>'',
		'align'=> '',
		'title' => '',
		'width' => '',
		'height' => '',
		'gallery_id' =>''	
	), $atts));
	
	
	$url = $thumbnail_url;	
	$mb2_image=matthewruddy_image_resize($url,$width,$height,true,false);
	
	
	if($url !=''){		
		
		if ($gallery_id !='') {
			$rel = 'data-rel="prettyPhoto['.$gallery_id.']"';
			$align = ''.$align.' gallery-item';
		}
		else {
			$rel= 'data-rel="prettyPhoto"';
			$align = $align;	
		}		
		
		
		return '<div class="post-thumb align-'.$align.'" style="width:'.$width.'px;max-width:100%;height:auto;"><div class="zoom-video"><a href="'.$video_url.'" '.$rel.' title="'.$title.'"><img class="img img-opacity" src="'.$mb2_image['url'].'" alt="'.$title.'"/></a></div></div>';
	
	}
	
		
	
}