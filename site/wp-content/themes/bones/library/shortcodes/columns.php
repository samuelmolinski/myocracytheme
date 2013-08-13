<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
//columns 
add_shortcode('one_two_first', 'mb_one_two_first');
add_shortcode('one_two_last', 'mb_one_two_last');
add_shortcode('one_three_first', 'mb_one_three_first');
add_shortcode('one_three_last', 'mb_one_three_last');
add_shortcode('one_three', 'mb_one_three');
add_shortcode('two_three_first', 'mb_two_three_first');
add_shortcode('two_three_last', 'mb_two_three_last');
add_shortcode('one_three', 'mb_one_three');
add_shortcode('one_four_first', 'mb_one_four_first');
add_shortcode('one_four_last', 'mb_one_four_last');
add_shortcode('one_four', 'mb_one_four');
add_shortcode('three_four_first', 'mb_three_four_first');
add_shortcode('three_four_last', 'mb_three_four_last');

add_shortcode('one_one', 'mb_one_one');

add_shortcode('one_five_first', 'mb_one_five_first');
add_shortcode('one_five', 'mb_one_five');
add_shortcode('one_five_last', 'mb_one_five_last');


function mb_one_one ($atts, $content= null){				
	return '<div class="one-one first">'. do_shortcode($content) .'</div>';
}

function mb_one_two_first ($atts, $content= null){				
	return '<div class="one-two first">'. do_shortcode($content) .'</div>';
}
	
function mb_one_two_last ($atts, $content= null){	
	return '<div class="one-two last">'. do_shortcode($content) .'</div>'; 
}
	
function mb_one_three_first ($atts, $content= null){	
	return '<div class="one-three first">'. do_shortcode($content) .'</div>'; 
}
	
function mb_one_three_last ($atts, $content= null){	
	return '<div class="one-three last">'. do_shortcode($content) .'</div>';
}
	
function mb_one_three ($atts, $content= null){	
	return '<div class="one-three">'. do_shortcode($content) .'</div>';
}
	
function mb_two_three_first ($atts, $content= null){	
	return '<div class="two-three first">'. do_shortcode($content) .'</div>';
}

function mb_two_three_last ($atts, $content= null){	
	return '<div class="two-three last">'. do_shortcode($content) .'</div>'; 
}
	
function mb_one_four ($atts, $content= null){	
	return '<div class="one-four">'. do_shortcode($content) .'</div>'
;}
	
function mb_one_four_first ($atts, $content= null){	
	return '<div class="one-four first">'. do_shortcode($content) .'</div>';
}
	
function mb_one_four_last ($atts, $content= null){	
	return '<div class="one-four last">'. do_shortcode($content) .'</div>';
}
	
function mb_three_four_first ($atts, $content= null){	
	return '<div class="three-four first">'. do_shortcode($content) .'</div>';
}
	
function mb_three_four_last ($atts, $content= null){	
	return'<div class="three-four last">'. do_shortcode($content) .'</div>';
}
	
function mb_one_five ($atts, $content= null){	
	return '<div class="one-five">'. do_shortcode($content) .'</div>';
}
	
function mb_one_five_first ($atts, $content= null){	
	return '<div class="one-five first">'. do_shortcode($content) .'</div>';
}
	
function mb_one_five_last ($atts, $content= null){	
	return '<div class="one-five last">'. do_shortcode($content) .'</div>';
}