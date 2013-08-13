<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
//lists
//unorder list
add_shortcode('list', 'mb_list');

//order list
add_shortcode('ol_list', 'mb_ol_list');

//list element
add_shortcode('li', 'mb_li');



function mb_list ($atts, $content= null){
	extract(shortcode_atts( array(
		'style' => 'unordered',
		'text_align' => '',
		'title' => ''			
	), $atts));	
	
	if($title !=''){		
		return '<h4 class="title list-title text-align-'.$text_align.'">'.$title.'</h4><ul class="list-'.$style.' text-align-'.$text_align.'">'.do_shortcode($content).'</ul>';
		}
		
		else {			
			return '<ul class="list-'.$style.' text-align-'.$text_align.'">'.do_shortcode($content).'</ul>';	
		}
			
}

function mb_ol_list ($atts, $content= null){	
	return '<ol class="ordered-list">'.do_shortcode($content).'</ol>';		
}
	
function mb_li ($atts, $content= null){	
		extract(shortcode_atts( array(
		'active' => ''		
		), $atts));	
		
		if($active == 'true'){			
			return '<li class="active">'.do_shortcode($content).'</li>';
		}
		else {			
			return '<li>'.do_shortcode($content).'</li>';
		}	
		
}
?>