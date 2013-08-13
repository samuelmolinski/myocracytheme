<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//accordion
add_shortcode('scroll_top', 'mb_scroll_top');

function mb_scroll_top ($atts, $content= null){	
	return '<a class="scroll-to-top-link" href="#top">'. do_shortcode($content) .'</a>'; 
}


?>