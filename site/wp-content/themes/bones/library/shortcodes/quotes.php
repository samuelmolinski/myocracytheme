<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
//quotes		
add_shortcode('quote', 'mb_quote');

function mb_quote($atts, $content= null){
	extract(shortcode_atts( array(
		'align' => '',
		'author' => '',
		'author_link' => ''	
	), $atts));		
	if ($author != '' && $author_link == ''){
		return '<div class="quote-'.$align.'"><blockquote>'.do_shortcode($content).'</blockquote><span class="quote-author">'.$author.'</span></div>'; 
	}
	elseif ($author != '' && $author_link != '') {
		return '<div class="quote-'.$align.'"><blockquote>'.do_shortcode($content).'</blockquote><span class="quote-author"><a href="'.$author_link.'">'.$author.'</a></span></div>';		
	}
	else {		
		return '<div class="quote-'.$align.'"><blockquote>'.do_shortcode($content).'</blockquote></div>';
	}		
		
}
?>