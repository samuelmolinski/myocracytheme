<?php
/**
 * @package WordPress
 * @subpackage Aquilo Theme
 */





/*-----------------------------------------------------------------------------------*/
/*	Recent posts
/*-----------------------------------------------------------------------------------*/
add_shortcode('recent_posts', 'mb2_recent_posts');


function mb2_recent_posts($atts, $content= null){
 	global $post;	
	
	extract(shortcode_atts( array(
		'column' => '3',
		'thumbnail_width' => '480',
		'thumbnail_height' => '280',
		'word_count' => '20',
		'category_id' => '',
		'readmore' => 'Read More',
		'readmore_button' => 'true'
	), $atts));
		
	
	
	$output ='';
	
	
	$post_count = $column;	
	$post_meta_date_format = mb2_theme_option('aquilo_blog_post_date_format');
	
	
	
	
	
	$mb2_recent_posts_query = new WP_Query('posts_per_page='.$post_count.'&cat='.$category_id.'&post_type=post');	
	
	
	
	
	$output .= '<div class="recent-posts-wrap">';
	
		
	
		
	$post_counter = 0;
	
		
	while($mb2_recent_posts_query->have_posts()) : $mb2_recent_posts_query->the_post();
	
		
	++$post_counter;
		
		
			
	//class for first column
	if($post_counter == 1){
		$column_class_first= ' first';
	}
	else {
		$column_class_first= '';
	}	
	
	//css class for 2 columns post
	if($column==2){
		$column_class= 'one-two';
	}
	elseif($column==3){
		$column_class= 'one-three';
	}
	elseif($column==4){
		$column_class= 'one-four';
	}
	else { 
		$column_class= 'recent-post-item';	
	}	
	
	//css class for last columns post
	if($column == $post_counter){
		$column_class_last= ' last';
	}
	else {
		$column_class_last= '';
	}
	
	
	
	
	//thumbnail parameters
	$video_embed_code = get_post_meta ($post->ID, 'meta_post_video_embed_code', true);
	$width = $thumbnail_width;
	$height = $thumbnail_height;
	$align = get_post_meta ($post->ID, 'meta_post_thumbnail_align', true);
	$slider_count = get_post_meta ($post->ID, 'meta_post_thumbnail_slider_count', true);
	$slider = get_post_meta ($post->ID, 'meta_post_thumbnail_slider', true);
	$link_to_post = get_post_meta ($post->ID, 'meta_post_thumbnail_link', true);	
	
	
		
	
		
 	$output .= '<div class="'.$column_class.''.$column_class_first.''.$column_class_last.'">';	
	
	$output .= ''.mb2_post_thumbnail($width,$height,'none',$link_to_post,$slider,$slider_count,false,false,false).'';	
	
	$output .= '<h4 class="recent-posts-title"><a href="'.get_permalink().'">'.get_the_title() .'</a></h4>';
	
	$output .= '<div class="recent-posts-meta"><span>'.get_the_time(''.$post_meta_date_format.'').'</span></div>';	
	
	if($word_count > 0){		
		$output .= '<div class="recent-posts-desc">'.mb2_string_length_by_words(get_the_excerpt(),$word_count).'</div>';
	}
	
	
	
	if($readmore !=''){		
		
		if($readmore_button == 'true'){
			$output .= '<a class="readmore" href="'.get_permalink().'"><span>'.$readmore.'</span></a>';
		}
		else {
			$output .= ' <a class="arrow-link" href="'.get_permalink().'"><span>'.$readmore.'</span></a>';	
		}		
			
	}
	
	
	
	$output .= '<div class="clear"></div></div>';
			

	endwhile;

	wp_reset_query();
		
	
	return $output . '</div>';
}













/*-----------------------------------------------------------------------------------*/
/*	Recent projects
/*-----------------------------------------------------------------------------------*/
add_shortcode('recent_projects', 'mb2_recent_projects');


function mb2_recent_projects($atts, $content= null){
 	global $post;	
	
	extract(shortcode_atts( array(
		'column' => '4',
		'thumbnail_width' => '690',
		'thumbnail_height' => '380',
		'gallery_style' => 'false'
	), $atts));
		
		
		
		
	$post_count = $column;		
	
	$mb2_recent_posts_query = new WP_Query('posts_per_page='.$post_count.'&post_type=portfolio');	
	
	
	$output ='';
	
	$output .= '<div class="recent-projects-wrap">';	
	
		
	$post_counter = 0;
	
		
	while($mb2_recent_posts_query->have_posts()) : $mb2_recent_posts_query->the_post();
	
		
	++$post_counter;
		
		
			
	//class for first column
	if($post_counter == 1){
		$column_class_first= ' first';
	}
	else {
		$column_class_first= '';
	}	
	
	//css class for 2 columns post
	if($column==2){
		$column_class= 'one-two';
	}
	elseif($column==3){
		$column_class= 'one-three';
	}
	elseif($column==4){
		$column_class= 'one-four';
	}
	else { 
		$column_class= 'recent-post-item';	
	}	
	
	//css class for last columns post
	if($column == $post_counter){
		$column_class_last= ' last';
	}
	else {
		$column_class_last= '';
	}
	
	
	
	
	//thumbnail parameters
	$width = $thumbnail_width;
	$height = $thumbnail_height;
	$slider = get_post_meta ($post->ID, 'meta_post_thumbnail_slider', true);
	$slider_count = get_post_meta ($post->ID, 'meta_post_thumbnail_slider_count', true);
	$link_to_post = get_post_meta ($post->ID, 'meta_post_thumbnail_link', true);
	$post_title_link = get_post_meta ($post->ID, 'meta_portfolio_post_title_link', true);
	
			
	
	
	
	
	if($gallery_style !='true'){
		
		$output .= '<div class="portfolio-item '.$column_class.''.$column_class_first.''.$column_class_last.'">';
		$output .= '<div class="portfolio-item-bg">';	
		$output .= ''.mb2_post_thumbnail($width,$height,'none',$link_to_post,$slider,$slider_count,false,true,false).'';	
		
		
		$output .='<div class="portfolio-item-details">';
		
		
		if($post_title_link == 1){
			$output .= '<h4 class="recent-posts-title title"><a href="'.get_permalink().'">'.get_the_title() .'</a></h4>';	
		}
		else {
			$output .= '<h4 class="recent-posts-title title">'.get_the_title().'</h4>';	
		}
		
		
		
		//portfolio project terms
		$output .= ''.mb2_term_list('project_types',false,false,false).'';
		
			
		$output .= '</div><div class="clear"></div></div></div>';
			
	
	}
	else {	
		
		
		$output .= '<div class="portfolio-item-gallery '.$column_class.''.$column_class_first.''.$column_class_last.'">';
			
		$output .= ''.mb2_post_thumbnail($width,$height,'none',false,false,0,false,true,false).'';	
			
		$output .= '</div>';	
		
	
	}
	
	
	
	
	
	endwhile;

	wp_reset_query();		
	
	return $output . '</div>';
}