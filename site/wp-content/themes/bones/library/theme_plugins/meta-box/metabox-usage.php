<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign

global $meta_boxes;
$meta_boxes = array();











/*-----------------------------------------------------------------------------------*/
/*	Page Heading
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'page_heading_page_options',							
	'title' => __('General', 'aquilo'),			
	'pages' => array('page','post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'high',									

	'fields' => array(											
		
		array(
			'name' => __('Title', 'aquilo'),
			'id' => 'meta_page_heading_title',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => ''
		),
		array(
			'name' => __('Breadcrumb', 'aquilo'),
			'id' => 'meta_page_heading_breadcrumb',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => ''
		),
		array(
			'name' => __('Search Form', 'aquilo'),
			'id' => 'meta_page_heading_search',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => ''
		)
	)
);










/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'slider_page_options',							
	'title' => __('Slider', 'aquilo'),			
	'pages' => array('page'),								
	'context' => 'normal',									
	'priority' => 'high',									

	'fields' => array(
		array(
			'name' => __('Slider', 'aquilo'),
			'id' => 'meta_slider_enabler',
			'type' => 'radio',						
			'options' => array(						
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')),
			'std' => '0',
			'desc' => ''
		),
		array(
			'name'		=> __('Slider &rarr; Type','aquilo'),
			'id'		=> "meta_slider",
			'type'		=> 'select',
			'options' => array(
				'flexslider' => 'Flexslider'
			),
			'multiple'	=> false,
			'std'		=> 'flexslider',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Slider &rarr; Layout','aquilo'),
			'id'		=> "meta_slider_layout",
			'type'		=> 'select',
			'options' => array(
				'default' => __('Default', 'aquilo'),
				'thumbnail-control' => __('Thumbnail Control', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> 'default',
			'desc'		=> ''
		),
		array(
			'name' => __('Slides Count', 'aquilo'),
			'id' => 'meta_slider_count',
			'type' => 'text',
			'std' => '3',
			'desc' => ''			
		),			
		array(
			'name' => __('Slides Category ID', 'aquilo'),
			'id' => 'meta_slider_taxonomy',
			'type' => 'text',
			'std' => '',
			'desc' => __('(Optional)','aquilo')			
		),		
	)
);








/*-----------------------------------------------------------------------------------*/
/*	Sidebar
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'sidebar_page_options',							
	'title' => __('Sidebar', 'aquilo'),			
	'pages' => array('page','post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Sidebar', 'aquilo'),
			'id' => 'meta_sidebar',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => __('This option does not work with portfolio page template.', 'aquilo')
		),
		array(
			'name' => __('Sidebar &rarr; Name', 'aquilo'),
			'id' => 'meta_sidebar_name',
			'type' => 'select',						
			'options' => array(	
				'' => __('&#8211; Select &#8211;', 'aquilo'),					
				'blog-sidebar' => __('Blog Sidebar', 'aquilo'),
				'home-sidebar' => __('Home Sidebar', 'aquilo'),
				'portfolio-sidebar' => __('Portfolio Sidebar', 'aquilo'),
				'page1-sidebar' => __('Page 1 Sidebar', 'aquilo'),
				'page2-sidebar' => __('Page 2 Sidebar', 'aquilo'),
				'page3-sidebar' => __('Page 3 Sidebar', 'aquilo'),
				'contact-sidebar' => __('Contact Sidebar', 'aquilo'),
				'search-sidebar' => __('Search Sidebar', 'aquilo')				
			),
			'std' => '',
			'desc' => ''
		),
		array(
			'name' => __('Sidebar &rarr; Position', 'aquilo'),
			'id' => 'meta_sidebar_position',
			'type' => 'select',						
			'options' => array(
				'left' => __('Left', 'aquilo'),
				'right' => __('Right', 'aquilo')
			),
			'std' => 'right',
			'desc' => ''
		)		
	)
);





/*-----------------------------------------------------------------------------------*/
/*	Post Thumbnail
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'meta_post_thumbnail',							
	'title' => __('Thumbnail', 'aquilo'),			
	'pages' => array('post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'high',
	'fields' => array(	
		array(
			'name' => __('Thumbnail', 'aquilo'),
			'id' => 'meta_post_thumbnail',
			'type' => 'radio',
			'std' => '1',
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
				),
			'desc' => __('Show thumbnail or slider or video on single post / project page.', 'aquilo'),
			),				
		array(
			'name' => __('Thumbnail &rarr; Width', 'aquilo'),
			'id' => 'meta_post_thumbnail_width',
			'type' => 'text',
			'std' => '690',
			'desc' => ''
			),
		array(
			'name' => __('Thumbnail &rarr; Height', 'aquilo'),
			'id' => 'meta_post_thumbnail_height',
			'type' => 'text',
			'std' => '280',
			'desc' => ''
			),
		array(
			'name' => __('Thumbnail &rarr; Align', 'aquilo'),
			'id' => 'meta_post_thumbnail_align',
			'type' => 'select',						
			'options' => array(
				'left' => __('Left', 'aquilo'),
				'right' => __('Right', 'aquilo'),
				'center' => __('Center', 'aquilo'),
				'none' => __('None', 'aquilo')
			),
			'std' => 'left',
			'desc' => ''
		),
		array(
			'name' => __('Thumbnail Link to Post', 'aquilo'),
			'id' => 'meta_post_thumbnail_link',
			'type' => 'radio',						
			'options' => array(
				'0' => __('No', 'aquilo'),
				'1' => __('Yes', 'aquilo')
			),
			'std' => '0',
			'desc' => 'If \'No\' thumbnail is a link to orginal size image / video opened in lightbox.'
		)
			
			
));  








/*-----------------------------------------------------------------------------------*/
/*	Thumbnail Slider
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'meta_post_thumbnail_slider',							
	'title' => __('Thumbnail &rarr; Slider', 'aquilo'),			
	'pages' => array('post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'high',
	'fields' => array(		
		array(
			'name' => __('Thumbnail Slider', 'aquilo'),
			'id' => 'meta_post_thumbnail_slider',
			'type' => 'radio',
			'std' => '0',
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
				),
			'desc' => ''
			),
		array(
			'name' => __('Thumbnail Slider &rarr; Slide Count', 'aquilo'),
			'id' => 'meta_post_thumbnail_slider_count',
			'type' => 'text',
			'std' => '3',
			'desc' => ''
			)			
));






/*-----------------------------------------------------------------------------------*/
/*	Thumbnail video
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'meta_post_thumbnail_video',							
	'title' => __('Thumbnail &rarr; Video', 'aquilo'),			
	'pages' => array('post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'high',
	'fields' => array(	
		array(
			'name' => __('Video / Flash &rarr; URL', 'aquilo'),
			'id' => 'meta_post_video_url',
			'type' => 'text',
			'std' => '',
			'desc' => __('Will be display in lightbox.', 'aquilo')
			),
		array(
			'name' => __('Video / Flash &rarr; Width', 'aquilo'),
			'id' => 'meta_post_video_width',
			'type' => 'text',
			'std' => '',
			'desc' => __('Require for flash file.', 'aquilo')
			),
		array(
			'name' => __('Video / Flash &rarr; Height', 'aquilo'),
			'id' => 'meta_post_video_height',
			'type' => 'text',
			'std' => '',
			'desc' => __('Require for flash file.', 'aquilo')
			),
		array(
			'name' => __('Viedo Embed Code', 'aquilo'),
			'id' => 'meta_post_video_embed_code',
			'type' => 'textarea',
			'std' => '',
			'desc' => __('Use shortcode [youtube id=\'\'] or [vimeo id=\'\'] or paste video emebed code.', 'aquilo')
		),
			
			
));









/*-----------------------------------------------------------------------------------*/
/*	Portfolio porst
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'meta_portfolio_post_options',							
	'title' => __('Portfolio Post', 'aquilo'),			
	'pages' => array('portfolio'),								
	'context' => 'normal',									
	'priority' => 'high',	
	'fields' => array(	
		array(
			'name' => __('Title Link', 'aquilo'),
			'id' => 'meta_portfolio_post_title_link',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '0',
			'desc' => ''
		),
		// array(
			// 'name' => __('Description', 'aquilo'),
			// 'id' => 'meta_portfolio_post_description',
			// 'type' => 'textarea',
			// 'std' => '',
			// 'desc' => __('Will be display only on portfolio page.', 'aquilo')
		// ),
		array(
			'name' => __('Layout', 'aquilo'),
			'id' => 'meta_portfolio_post_layout',
			'type' => 'select',						
			'options' => array(
				'media-desc' => __('Media and Right Description', 'aquilo'),
				'desc-media' => __('Left Description and Media', 'aquilo'),
				'desc-below-media' => __('Media and Description Below', 'aquilo')
			),
			'std' => 'media-desc',
			'desc' => __('Layout of single project page (\'Media\' means thumbnail or video or slider).', 'aquilo')
		),
		array(
			'name' => __('Project Types and Skills', 'aquilo'),
			'id' => 'meta_portfolio_post_project_info',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => ''
		),
		array(
			'name' => __('Navigation', 'aquilo'),
			'id' => 'meta_portfolio_post_navigation',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => ''
		)		
));







/*-----------------------------------------------------------------------------------*/
/*	Portfolio page
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'portfolio_page_settings',							
	'title' => __('Portfolio Page', 'aquilo'),			
	'pages' => array('page'),								
	'context' => 'normal',									
	'priority' => 'low',
	'fields' => array(		
		array(
			'name' => __('Portfolio Filterable', 'aquilo'),
			'id' => 'meta_portfolio_page_filter',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '1',
			'desc' => ''
		),
		array(
			'name' => __('Gallery Style', 'aquilo'),
			'id' => 'meta_portfolio_page_post_gallery',
			'type' => 'radio',						
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'std' => '0',
			'desc' => ''
		), 
		array(
			'name' => __('Columns', 'aquilo'),
			'id' => 'meta_portfolio_page_post_column',
			'type' => 'select',						
			'options' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4'
				),
			'std' => '3',
			'desc' => ''
			),		
		array(
			'name' => __('Project &rarr; Count', 'aquilo'),
			'id' => 'meta_portfolio_page_post_count',
			'type' => 'text',
			'std' => '6',
			'desc' => ''
			),
		array(
			'name' => __('Project &rarr; Description Word Count', 'aquilo'),
			'id' => 'meta_portfolio_page_post_description_word_count',
			'type' => 'text',
			'std' => '35',
			'desc' => __('Only for portfolio 1 column.', 'aquilo')
		),
		array(
			'name' => __('Thumbnail &rarr; Width', 'aquilo'),
			'id' => 'meta_portfolio_page_thumbnail_width',
			'type' => 'text',
			'std' => '',
			'desc' => __('<em>(optional)</em>','aquilo')
			),
		array(
			'name' => __('Thumbnail &rarr; Height', 'aquilo'),
			'id' => 'meta_portfolio_page_thumbnail_height',
			'type' => 'text',
			'std' => '',
			'desc' => __('<em>(optional)</em>','aquilo')
			),
		/*array(
			'name' => __('Thumbnail &rarr; Align', 'aquilo'),
			'id' => 'meta_portfolio_page_thumbnail_align',
			'type' => 'select',						
			'options' => array(
				'left' => __('Left', 'aquilo'),
				'right' => __('Right', 'aquilo'),
				'center' => __('Center', 'aquilo'),
				'none' => __('None', 'aquilo')
			),
			'std' => 'none',
			'desc' => ''
		)*/	
		
	)
);








/*-----------------------------------------------------------------------------------*/
/*	Page Heading Style
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'page_heading_page_style',							
	'title' => __('Page Heading Style', 'aquilo'),			
	'pages' => array('page','post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'low',									

	'fields' => array(
		array(
			'name'		=> __('Text Color', 'aquilo'),
			'id'		=> "meta_page_heading_text_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Headings Color', 'aquilo'),
			'id'		=> "meta_page_heading_headings_color",
			'type'		=> 'color'
		),	
		array(
			'name'		=> __('Links Color', 'aquilo'),
			'id'		=> "meta_page_heading_links_color",
			'type'		=> 'color'
		),	
		array(
			'name'		=> __('Hover Links Color', 'aquilo'),
			'id'		=> "meta_page_heading_hover_links_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Background &rarr; Color', 'aquilo'),
			'id'		=> "meta_page_heading_background_color",
			'type'		=> 'color'
		),
		array(
			'name'	=> __('Background &rarr; Image', 'aquilo'),
			'desc'	=> __('Full url: http://website.com/image.jpg', 'aquilo'),
			'id'	=> "meta_page_heading_background_image",
			'type'	=> 'text'
		),
		array(
			'name' => __('Background &rarr; Repeat', 'aquilo'),
			'id' => 'meta_page_heading_background_image_repeat',
			'type' => 'select',						
			'options' => array(						
				'repeat' => __('Repeat', 'aquilo'),		
				'repeat-x' => __('Repeat X', 'aquilo'),
				'repeat-y' => __('Repeat Y', 'aquilo'),
				'no-repeat' => __('No Repeat', 'aquilo')),
			'std' => 'no-repeat',
			'desc' => ''
		),
		array(
			'name' => __('Background &rarr; Position', 'aquilo'),
			'id' => 'meta_page_heading_background_image_position',
			'type' => 'select',						
			'options' => array(						
				'left top' => __('Left Top', 'aquilo'),
				'left center' => __('Left Center', 'aquilo'),
				'left bottom' => __('Left Bottom', 'aquilo'),
				'right top' => __('Right Top', 'aquilo'),
				'right center' => __('Right Center', 'aquilo'),
				'right bottom' => __('Right Bottom', 'aquilo'),
				'center top' => __('Center Top', 'aquilo'),
				'center bottom' => __('Center Bottom', 'aquilo'),
				'center center' => __('Center', 'aquilo')),
			'std' => 'no-repeat',
			'desc' => ''
		)
	)
);









/*-----------------------------------------------------------------------------------*/
/*	Page Style
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'page_style_page_options',							
	'title' => __('Page Style', 'aquilo'),			
	'pages' => array('page','post','portfolio'),								
	'context' => 'normal',									
	'priority' => 'low',									

	'fields' => array(		
		
		array(
			'name' => __('Predefined Style', 'aquilo'),
			'id' => 'meta_general_predefined_style',
			'type' => 'select',						
			'options' => array(						
				'' => __('&#8211; Select &#8211;', 'aquilo'),		
				'blue' => __('Blue','aquilo'),
				'brown' => __('Brown','aquilo'),
				'dark-blue' => __('Dark Blue','aquilo'),
				'gold' => __('Gold','aquilo'),
				'gray' => __('Gray','aquilo'),
				'green' => __('Green','aquilo'),
				'orange' => __('Orange','aquilo'),
				'red' => __('Red','aquilo'),
				'violet' => __('Violet','aquilo')
				),
			'std' => '',
			'desc' => ''
		),
		array(
			'name'		=> __('Custom Color', 'aquilo'),
			'id'		=> "meta_general_custom_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Text Color', 'aquilo'),
			'id'		=> "meta_general_text_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Headings Color', 'aquilo'),
			'id'		=> "meta_general_headings_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Links Color', 'aquilo'),
			'id'		=> "meta_general_links_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Hover Links Color', 'aquilo'),
			'id'		=> "meta_general_hover_links_color",
			'type'		=> 'color'
		),
		array(
			'name'		=> __('Background &rarr; Color', 'aquilo'),
			'id'		=> "meta_general_background_color",
			'type'		=> 'color'
		),
		array(
			'name'	=> __('Background &rarr; Image', 'aquilo'),
			'desc'	=> __('Full url: http://website.com/image.jpg', 'aquilo'),
			'id'	=> "meta_general_background_image",
			'type'	=> 'text'
		),
		array(
			'name' => __('Background &rarr; Repeat', 'aquilo'),
			'id' => 'meta_general_background_image_repeat',
			'type' => 'select',						
			'options' => array(						
				'repeat' => __('Repeat', 'aquilo'),		
				'repeat-x' => __('Repeat X', 'aquilo'),
				'repeat-y' => __('Repeat Y', 'aquilo'),
				'no-repeat' => __('No Repeat', 'aquilo')),
			'std' => 'no-repeat',
			'desc' => ''
		),
		array(
			'name' => __('Background &rarr; Position', 'aquilo'),
			'id' => 'meta_general_background_image_position',
			'type' => 'select',						
			'options' => array(						
				'left top' => __('Left Top', 'aquilo'),
				'left center' => __('Left Center', 'aquilo'),
				'left bottom' => __('Left Bottom', 'aquilo'),
				'right top' => __('Right Top', 'aquilo'),
				'right center' => __('Right Center', 'aquilo'),
				'right bottom' => __('Right Bottom', 'aquilo'),
				'center top' => __('Center Top', 'aquilo'),
				'center bottom' => __('Center Bottom', 'aquilo'),
				'center center' => __('Center', 'aquilo')),
			'std' => 'no-repeat',
			'desc' => ''
		),
		array(
			'name' => __('Background &rarr; Attachment', 'aquilo'),
			'id' => 'meta_general_background_image_attachment',
			'type' => 'select',						
			'options' => array(						
				'scroll' => __('Scroll', 'aquilo'),
				'fixed' => __('Fixed', 'aquilo')),
			'std' => 'scroll',
			'desc' => ''
		)
	)
);











/*-----------------------------------------------------------------------------------*/
/*	Slides posts
/*-----------------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'meta_slides_post_general',							
	'title' => __('General', 'aquilo'),			
	'pages' => array('slides'),								
	'context' => 'normal',									
	'priority' => 'high',	
	'fields' => array(		
		array(
			'name' => __('Slide Link', 'aquilo'),
			'id' => 'meta_slides_post_link',
			'type' => 'text',
			'std' => '',
			'desc' => __('Paste link for slide image.', 'aquilo')
		),
		array(
			'name'		=> 'Open Link',
			'id'		=> "meta_slides_post_link_target",
			'type'		=> 'select',
			'options' => array(
				'_self' => __('In the same window', 'aquilo'),
				'_blank' => __('In a new window', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> array( '_self' ),
			'desc'		=> ''
		),
			
));


$meta_boxes[] = array(
	'id' => 'meta_slides_post_caption',							
	'title' => __('Caption', 'aquilo'),			
	'pages' => array('slides'),								
	'context' => 'normal',									
	'priority' => 'high',	
	'fields' => array(		
		array(
			'name'		=> __('Use caption','aquilo'),
			'id'		=> "meta_slides_post_caption_enabler",
			'type'		=> 'radio',
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> '1',
			'desc'		=> ''
		),			 	
		array(
			'name' => __('Top Position', 'aquilo'),
			'id' => 'meta_slides_post_caption_top_position',
			'type' => 'text',
			'std' => '20%',
			'desc' => __('Set top position of slide caption in %.', 'aquilo')
		),
		array(
			'name' => __('Width', 'aquilo'),
			'id' => 'meta_slides_post_caption_width',
			'type' => 'text',
			'std' => '50%',
			'desc' => __('Set width of slide caption.', 'aquilo')
		),
		array(
			'name'		=> __('Align','aquilo'),
			'id'		=> "meta_slides_post_caption_align",
			'type'		=> 'select',
			'options' => array(
				'left' => __('Left', 'aquilo'),
				'right' => __('Right', 'aquilo'),
				'center' => __('Center', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> 'left',
			'desc'		=> __('Set align of slide caption.', 'aquilo')
		),
		array(
			'name'		=> __('Background','aquilo'),
			'id'		=> "meta_slides_post_caption_bg",
			'type'		=> 'radio',
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> '1',
			'desc'		=> __('Use caption background (default is a dark transparent background image).', 'aquilo')
		)
			
));



$meta_boxes[] = array(
	'id' => 'meta_slides_post_title',							
	'title' => __('Title', 'aquilo'),			
	'pages' => array('slides'),								
	'context' => 'normal',									
	'priority' => 'high',	
	'fields' => array(			 	
		array(
			'name'		=> __('Title','aquilo'),
			'id'		=> "meta_slides_post_title_enabler",
			'type'		=> 'radio',
			'options' => array(
				'1' => __('Yes', 'aquilo'),
				'0' => __('No', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> '1',
			'desc'		=> ''
		),
		array(
			'name' => __('Font Size', 'aquilo'),
			'id' => 'meta_slides_post_title_font_size',
			'type' => 'text',
			'std' => '52px',
			'desc' => ''
		),		
		array(
			'name'		=> __('Font Weight', 'aquilo'), 
			'id'		=> "meta_slides_post_title_font_weight",
			'type'		=> 'select',
			'options' => array(
				'normal' => __('Normal', 'aquilo'),
				'bold' => __('Bold', 'aquilo'),
				'bolder' => __('Bolder', 'aquilo'),
				'lighter' => __('Lighter', 'aquilo'),
				'100' => '100',
				'200' => '200',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
				'800' => '800',
				'900' => '900'
			),
			'multiple'	=> false,
			'std'		=> 'normal',
			'desc'		=> ''
		),		
		array(
			'name'		=> __('Text Transform', 'aquilo'),
			'id'		=> "meta_slides_post_title_text_transform",
			'type'		=> 'select',
			'options' => array(
				'none' => __('None','aquilo'),
				'uppercase' => __('Uppercase', 'aquilo'),
				'lowercase' => __('Lowercase', 'aquilo'),
				'capitalize' => __('Capitalize', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> 'none',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Font Style', 'aquilo'), 
			'id'		=> "meta_slides_post_title_font_style",
			'type'		=> 'select',
			'options' => array(
				'normal' => __('Normal', 'aquilo'),
				'italic' => __('Italic', 'aquilo'),
				'oblique' => __('Oblique', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> 'normal',
			'desc'		=> ''
		),		
		array(
			'name'		=> __('Color', 'aquilo'),
			'id'		=> "meta_slides_post_title_color",
			'type'		=> 'color',
			'desc' => __('<em>(optional)</em>','aquilo')
		),
		array(
			'name'		=> __('Background', 'aquilo'),
			'id'		=> "meta_slides_post_title_bg",
			'type'		=> 'color',
			'desc' => __('<em>(optional)</em>','aquilo')
		),
			
));





$meta_boxes[] = array(
	'id' => 'meta_slides_post_subtitle_section',							
	'title' => __('Sub-Title', 'aquilo'),			
	'pages' => array('slides'),								
	'context' => 'normal',									
	'priority' => 'high',	
	'fields' => array(			 	
		array(
			'name'		=> 'Sub-Title',
			'id'		=> "meta_slides_post_subtitle",
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> ''
		),
		array(
			'name' => __('Font Size', 'aquilo'),
			'id' => 'meta_slides_post_subtitle_font_size',
			'type' => 'text',
			'std' => '37px',
			'desc' => ''
		),		
		array(
			'name'		=> __('Font Weight', 'aquilo'), 
			'id'		=> "meta_slides_post_subtitle_font_weight",
			'type'		=> 'select',
			'options' => array(
				'normal' => __('Normal', 'aquilo'),
				'bold' => __('Bold', 'aquilo'),
				'bolder' => __('Bolder', 'aquilo'),
				'lighter' => __('Lighter', 'aquilo'),
				'100' => '100',
				'200' => '200',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
				'800' => '800',
				'900' => '900'
			),
			'multiple'	=> false,
			'std'		=> 'normal',
			'desc'		=> ''
		),		
		array(
			'name'		=> __('Text Transform', 'aquilo'),
			'id'		=> "meta_slides_post_subtitle_text_transform",
			'type'		=> 'select',
			'options' => array(
				'none' => __('None','quilo'),
				'uppercase' => __('Uppercase', 'aquilo'),
				'lowercase' => __('Lowercase', 'aquilo'),
				'capitalize' => __('Capitalize', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> 'none',
			'desc'		=> ''
		),
		array(
			'name'		=> __('Font Style', 'aquilo'), 
			'id'		=> "meta_slides_post_subtitle_font_style",
			'type'		=> 'select',
			'options' => array(
				'normal' => __('Normal', 'aquilo'),
				'italic' => __('Italic', 'aquilo'),
				'oblique' => __('Oblique', 'aquilo')
			),
			'multiple'	=> false,
			'std'		=> 'normal',
			'desc'		=> ''
		),		
		array(
			'name'		=> __('Color', 'aquilo'),
			'id'		=> "meta_slides_post_subtitle_color",
			'type'		=> 'color',
			'desc' => __('<em>(optional)</em>','aquilo')
		),
		array(
			'name'		=> __('Background', 'aquilo'),
			'id'		=> "meta_slides_post_subtitle_bg",
			'type'		=> 'color',
			'desc' => __('<em>(optional)</em>','aquilo')
		),
			
));


$meta_boxes[] = array(
	'id' => 'meta_slides_post_description_section',							
	'title' => __('Description', 'aquilo'),			
	'pages' => array('slides'),								
	'context' => 'normal',									
	'priority' => 'high',	
	'fields' => array(	
		array(
			'name'		=> __('Description', 'aquilo'),
			'desc'		=> __('Paste slide description. You may use shortcodes.', 'aquilo'),
			'id'		=> "meta_slides_post_description",
			'type'		=> 'textarea',
			'std'		=> "",
			'cols'		=> "40",
			'rows'		=> "8"
		),
		array(
			'name'		=> __('Color', 'aquilo'),
			'id'		=> "meta_slides_post_description_color",
			'type'		=> 'color',
			'desc' => __('<em>(optional)</em>','aquilo')
		),
		array(
			'name'		=> __('Background', 'aquilo'),
			'id'		=> "meta_slides_post_description_bg",
			'type'		=> 'color',
			'desc' => __('<em>(optional)</em>','aquilo')
		),
			
));



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function mb2_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'mb2_register_meta_boxes' );