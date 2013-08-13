<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//accordion
add_shortcode('terms', 'mb2_terms');


function mb2_terms ($atts, $content= null){	
	extract(shortcode_atts( array(
		'taxonomy' => 'project_types',
		'link' => true	
	), $atts));	
	return ''.mb2_term_list(''.$taxonomy.'',$link,false).'';
	}
?>