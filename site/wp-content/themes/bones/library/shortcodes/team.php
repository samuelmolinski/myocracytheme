<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//team
add_shortcode('team', 'mb_team');

function mb_team ($atts, $content= null){
	extract(shortcode_atts( array(
		'photo' => '',
		'photo_width' => '350',
		'photo_height' => '220',		
		'name' => '',
		'position' => '',
		'phone' => '',
		'mail' => '',
		'facebook' => '',
		'twitter' => '',
		'skype' => '',
		'youtube' => '',
		'vimeo' => '',
	), $atts));
	


$url = $photo;
$width = $photo_width;
$height = $photo_height;

//thumbnail resize script
$mb2_image=matthewruddy_image_resize($url,$width,$height,true,false); 


//check if is phone
if($phone !='') {	
$is_phone = '<div class="team-phone"><span>'.$phone.'</span></div>';
}
else {
$is_phone = '';	
}



//check if is mail
if($mail !='') {	
$is_mail = '<div class="team-mail"><a href="mailto:'.$mail.'">'.$mail.'</a></div>';
}
else {
$is_mail = '';	
}


//check if social icon are in use
if($facebook !='') {
	$is_facebook = '<a class="icon facebook" href="'.$facebook.'" target="_blank">facebook</a>';
}
else {
	$is_facebook = '';		
}

if($twitter !='') {
	$is_twitter = '<a class="icon twitter" href="'.$twitter.'" target="_blank">twitter</a>';
}
else {
	$is_twitter = '';		
}

if($skype !='') {
	$is_skype = '<a class="icon skype" href="'.$skype.'" target="_blank">skype</a>';
}
else {
	$is_skype = '';		
}

if($youtube !='') {
	$is_youtube = '<a class="icon youtube" href="'.$youtube.'" target="_blank">youtube</a>';
}
else {
	$is_youtube = '';		
}

if($vimeo !='') {
	$is_vimeo = '<a class="icon vimeo" href="'.$vimeo.'" target="_blank">vimeo</a>';
}
else {
	$is_vimeo = '';		
}




if($url !=''){
		
return '<div class="team"><img class="team-image" src="'.$mb2_image['url'].'" alt="'.$name.'" /><div class="team-info"><span class="name">'.$name.'</span> <span class="position">'.$position.'</span><div class="team-social">'.$is_facebook.''.$is_twitter.''.$is_skype.''.$is_vimeo.''.$is_youtube.'</div></div><div class="team-desc">'.do_shortcode($content).'</div>'.$is_phone.''.$is_mail.'</div>';

}

else {
	
return '<div class="team"><div class="team-info"><span class="name">'.$name.'</span> <span class="position">'.$position.'</span><div class="team-social">'.$is_facebook.''.$is_twitter.''.$is_skype.''.$is_vimeo.''.$is_youtube.'</div></div><div class="team-desc">'.do_shortcode($content).'</div>'.$is_phone.''.$is_mail.'</div>';

	
}
	
}
?>