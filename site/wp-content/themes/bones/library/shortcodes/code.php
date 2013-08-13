<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//code
add_shortcode('code', 'mb_code');
	
function mb_code ($atts, $content= null){	
	return '<pre class="code">'. $content .'</pre>';
}