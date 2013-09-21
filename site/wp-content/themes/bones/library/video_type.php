<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a video post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the video type
function video_post_example() { 
	// creating (registering) the video type 
	register_post_type( 'video_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Current Video', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Current Video', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Current Video', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Current Video', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Current Video', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Current Video', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Current Video', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Current Video', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No Current Video found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No Current Video found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Current Video - important video to the constituents', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/video-post-icon.png', /* the icon for the video post type menu */
			'rewrite'	=> array( 'slug' => 'current_video', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'video', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'revisions', 'author')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your video post type */
	register_taxonomy_for_object_type('current_video_cat', 'video_type');
	/* this adds your post tags to your video post type */
	register_taxonomy_for_object_type('current_video_tag', 'video_type');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'video_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add video categories (these act like categories)
    register_taxonomy( 'current_video_cat', 
    	array('video_type'), /* if you change the name of register_post_type( 'video_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Current Video Categories', 'bonestheme' ), /* name of the video taxonomy */
    			'singular_name' => __( 'Current Video Category', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Current Video Categories', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Current Video Categories', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Current Video Category', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Current Video Category:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Current Video Category', 'bonestheme' ), /* edit video taxonomy title */
    			'update_item' => __( 'Update Current Video Category', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Current Video Category', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Current Video Category Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'current-video-cat' ),
    	)
    );   
    
	// now let's add video tags (these act like categories)
    register_taxonomy( 'current_video_tag', 
    	array('video_type'), /* if you change the name of register_post_type( 'video_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Current Video Tags', 'bonestheme' ), /* name of the video taxonomy */
    			'singular_name' => __( 'Current Video Tag', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Current Video Tags', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Current Video Tags', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Current Video Tag', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Current Video Tag:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Current Video Tag', 'bonestheme' ), /* edit video taxonomy title */
    			'update_item' => __( 'Update Current Video Tag', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Current Video Tag', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Current Video Tag Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
    
    /*
    	looking for video meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */