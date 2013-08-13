<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//tabs

add_shortcode('tabs', 'mb_tabs');
add_shortcode('tab', 'mb_tab');

function mb_tabs($atts, $content = null) {		
		global $x;
		extract(shortcode_atts(array(), $atts));
		$output = '';
		$output .= '<div class="tabs">';
		$output .= '<ul>';
		foreach ($atts as $tab) {
		$tabID = "tab-" . $x++;
		$output .= '<li><a href="#' . $tabID . '" class="tab"><span>' .$tab. '</span></a></li>';
		}
		$output .= '</ul>';
		$output .= do_shortcode($content) .'</div>';
		return $output;
	}	
	
function mb_tab ($atts, $content = null) {		
		global $i;
		extract(shortcode_atts(array(), $atts));
		$output = '';
		$tabID = "tab-" . $i++;
		$output .= '<div id="' . $tabID . '" class="tab-box">' . do_shortcode($content) .'</div>';	
		return $output;	
	}








/*
global $tabs_array, $tabs_count;
$tabs_count = 0;
function mb_tabs( $atts, $content = null )
{
	global $tabs_array, $tabs_count;	
	do_shortcode( $content );	
	$output = '';	
	if( is_array( $tabs_array ) ){
		$i = 1;
		$x = 1;		
		$output .= '<div class="tabs">';
		$output .= '<ul>';		
		foreach( $tabs_array as $tab ){			
			$output .= '<li><a href="#tabs-' . $i++ . '">' . $tab['title'] . '</a></li>';
		}		
		$output .= '</ul>';
				
		foreach( $tabs_array as $tab )	{			
			$output .= '<div class="tab" id="tabs-' . $x++ . '">' . do_shortcode( $tab['content'] ) .'</div>';
		}		
		$output .= '</div>';		
		return $output;
	}
}
add_shortcode('tabs', 'mb_tabs');


function mb_tab( $atts, $content = null ){
	global $tabs_array, $tabs_count;	
	extract(shortcode_atts(array(
		'title' => 'Title here...'
	), $atts));	
	$tabs_array[] = array(
		'title' => $title,
		'content' => do_shortcode( $content )
	);	
	$tabs_count++;
}

add_shortcode('tab', 'mb_tab');
?>
*/