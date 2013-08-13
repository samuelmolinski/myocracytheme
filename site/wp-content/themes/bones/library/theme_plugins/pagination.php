<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */
 
 
//pagination
function mb2_pagination($pages = '', $range = 2, $class=''){	
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1; 
     if($pages == '')   {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)  {
             $pages = 1;
         }
     }	
		  
     if(1 != $pages) {
         echo "<nav class=\"pagination ".$class."\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>". __('Start', 'aquilo') . "</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>". __('Prev', 'aquilo') . "</a>"; 
         for ($i=1; $i <= $pages; $i++) {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"pagination-link inactive\">".$i."</a>";
             }
         } 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">". __('Next', 'aquilo') . "</a>"; 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>". __('End', 'aquilo') . "</a>";
         //echo "<span class=\"pagination-result\">" . __('Page', 'aquilo') ." ".$paged." " . __('of', 'aquilo') ." ".$pages."</span>";
		 echo "<div class=\"clear\"></div></nav><div class=\"clear\"></div>\n";
     }
}