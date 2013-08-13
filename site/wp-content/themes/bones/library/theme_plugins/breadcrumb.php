<?php
/*
Plugin Name: Simple Breadcrumb Navigation
Plugin URI: http://www.kriesi.at/archives/wordpress-plugin-simple-breadcrumb-navigation
Description: A simple and very lightweight breadcrumb navigation that covers nested pages and categories
Version: 1
Author: Christian "Kriesi" Budschedl
Author URI: http://www.kriesi.at/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
 
 

function mb2_breadcrumb() { 

global $post;


$portfolio_page_id = mb2_theme_option('aquilo_portfolio_breadcrumb_link');

$showOnHome 		= 1; 										// show (1) breadcrumb on homepage or not (0)
$delimiter 			= '</span><span>'; 										// delimiter between crumbs
$home 				= __('Home', 'aquilo');						// home link text
$showCurrent 		= 1; 										// 1 - show current post/page title in breadcrumbs, 0 - don't show
$before 			= ''; 				// tag before the current crumb $after = '</span>'; // tag after the current crumb 
$after				= '</span>';
$homeLink 			= home_url(); 
if (is_home() || is_front_page()) { 
	if ($showOnHome == 1) echo '<div id="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a></div>'; 
  } else { 
    	echo '<div id="breadcrumbs"><span class="first"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' '; 



if ( is_category() ) {
	$thisCat = get_category(get_query_var('cat'), false);
		if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo $before . '' . single_cat_title('', false) . '' . $after; 
	} elseif ( is_search() ) {
		echo $before . '' . get_search_query() . '' . $after; 
    } elseif ( is_day() ) {
     	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      	echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      	echo $before . get_the_time('d') . $after; 
    } elseif ( is_month() ) {
      	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
     	 echo $before . get_the_time('F') . $after; 
    } elseif ( is_year() ) {
      	echo $before . get_the_time('Y') . $after; 
    } 
	
	
	
	elseif ( is_single() && !is_attachment() ) {
      	if ( get_post_type() != 'post' ) {
        	$post_type = get_post_type_object(get_post_type());
        	$slug = $post_type->rewrite;
        	//below is my own code but this is the original code:   echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			echo '<a href="'.get_permalink($portfolio_page_id).'">' . $post_type->labels->name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      	} else {			
        	$cat = get_the_category(); $cat = $cat[0];
        	$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
       		if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        		echo $cats;
        	if ($showCurrent == 1) echo $before . get_the_title() . $after;
     	} 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after; 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after; 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after; 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
    }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after; 
    } elseif ( is_tag() ) {
      echo $before . '' . single_tag_title('', false) . '' . $after; 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . '' . $userdata->display_name . $after; 
    } elseif ( is_404() ) {
      echo $before. __('Error 404', 'aquilo') .$after; 
    } 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('&nbsp;Page', 'aquilo') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    } 
    echo '</div>'; 
  }
}