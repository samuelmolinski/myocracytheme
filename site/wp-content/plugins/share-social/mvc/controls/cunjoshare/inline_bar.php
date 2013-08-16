<?php

define('_DEBUG_INLINE_BAR', FALSE);

class inline_bar_outputter
{
    protected $view_data;
    private $setting_manager;
    private $layout;

    public function __construct($layout = NULL)
    {
        if(!$layout)
            throw new Exception("A layout is required");
        
        $this->layout = $layout;
        $this->setting_manager = new modCunjoShare_Settings();
        $this->view_data['layout']  = $this->layout;
        $this->view_data['settings'] = $this->setting_manager->get_internal_options($this->layout);
        $this->view_data['wp_options'] = $this->setting_manager->get_wp_options(); 
    }
    
    public function action_DisplayBar($post_content = "")
    {
        /*
        The following is available to use:
        $this->view_data['layout']  = $this->layout;
        $this->view_data['settings'] = $this->setting_manager->get_internal_options($this->layout);
        $this->view_data['wp_options'] = $this->setting_manager->get_wp_options(); 
        */
        
        // this session variable is set in the plugin core 
        // to make sure the bar is only displayed once per page.
        // only left_elegant_bar loads with post content of "" as bottom bar (loaded before this bar) takes care of displaying it
        
        // if left layout and we haven't loaded yet, set a session so we don't load again
        if(!isset($_SESSION['left_elegant_bar']) && $this->layout == "left_elegant_tab"){
            $_SESSION['left_elegant_bar'] = 1;
        }else if($this->layout == "left_elegant_tab"){
            return $post_content;
        }
        
        if(_DEBUG_INLINE_BAR){
            error_reporting(E_ALL);
            echo "DEBUG MODE!<br />";
            echo "We have the following settings available to us:<br />";
            echo "<pre>" . print_r($this->view_data['settings'], TRUE) . "</pre><br /><br />";
            echo "<pre>" . print_r($this->view_data['wp_options'], TRUE) . "</pre>";
        }

        if(!isset($this->view_data['settings']["$this->layout"]) OR empty($this->view_data['settings']["$this->layout"]))
            return;

        $settings = $this->view_data['settings']["$this->layout"];

        // if bar is active
        if($settings['visibility_settings']['is_active'] == TRUE OR (isset($_GET['cunjo']) && $_GET['cunjo'] == $this->layout))
        {
            if(_DEBUG_INLINE_BAR){
                echo "$this->layout active!";
           }

           if(is_home() OR is_front_page()){
                // do we want to show this widget on the home page
                if($settings['visibility_settings']['on_home'] == TRUE){
                    // is this the homepage
                   return $this->output_bar($post_content);
                }else{
                   if(_DEBUG_INLINE_BAR){
                        echo "Home page is excluded!<br />";
                   }
                   
                   return $post_content;
                }
            }
            
            else if(is_category() OR is_archive() OR is_tax()){
                return $this->output_bar($post_content);
            }
            
            else if(is_page()){
                // do we want to show the bar on pages?
                if($settings['visibility_settings']['on_pages'] == TRUE)
                {
                    // is this page excluded, if not, display the bar!
                    if(isset($settings['visibility_settings']['exclude_pages']) && strlen($settings['visibility_settings']['exclude_pages']) > 0){
                        foreach(explode(",", $settings['visibility_settings']['exclude_pages']) as $excluded_page){
                            if(is_page($excluded_page)){
                                // don't display the bar on this page
                                if(_DEBUG_INLINE_BAR){
                                    echo "This page is excluded!<br />";
                                }

                                return $post_content;
                            }
                        }
                    }

                    // page is not excluded
                    return $this->output_bar($post_content);
                }
            }

            // is this a post
            else if(is_single()){
                // do we want to show the bar on posts?
                if($settings['visibility_settings']['on_posts'] == TRUE){
                    // is this post excluded, if not, display the bar!
                    if(isset($settings['visibility_settings']['exclude_posts']) && strlen($settings['visibility_settings']['exclude_posts']) > 0){
                        foreach(explode(",", $settings['visibility_settings']['exclude_posts']) as $excluded_post){
                            if(is_single($excluded_post)){
                                /*
                                // this post is excluded, but this is a custom post type that takes precedence over exclusion
                                if(isset( $settings['visibility_settings']['on_custom'])){
                                    foreach(explode(",", $settings['visibility_settings']['on_custom']) as $custom_post_type){
                                        if(get_post_type() == $custom_post_type){
                                            if(_DEBUG_INLINE_BAR){
                                                echo "This post has custom post type allowance but is hidden due to exclude_posts!<br />";
                                            }
                                            
                                            break 2; // exit exlcusion loop and display bar
                                        }
                                    }
                                }
                                */

                                // don't display the bar on this page
                                if(_DEBUG_INLINE_BAR){
                                    echo "This post is excluded!<br />";
                                }

                                return $post_content;
                            }

                        }
                    }
                    

                    // page is not excluded
                    return $this->output_bar($post_content);

                }
            }else{
                if(_DEBUG_INLINE_BAR){
                    echo "Unknown post/page type!<br />";
                }

                // is this a custom post type?
                if(isset( $settings['visibility_settings']['on_custom'])){
                    foreach(explode(",", $settings['visibility_settings']['on_custom']) as $custom_post_type){
                        if(get_post_type() == $custom_post_type){
                             return $this->output_bar($post_content);
                        }
                    }
                }
                
                return $post_content;
            }
        }else{
            // this bar is not active, so just output the post
            return $post_content;
        }

        return;
    }

    function cunjito_image() {
        $files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
        if($files){
            $keys = array_reverse(array_keys($files));
            //$j = 0;
            $num = $keys[0];
            //$image          = wp_get_attachment_image($num, 'large', true);
            //$imagepieces    = explode('"', $image);
            ///$imagepath      = $imagepieces[1];
            $main           = wp_get_attachment_url($num);
            
            //$template         = get_template_directory();
            //$the_title        = get_the_title();
            return $main;
        }
    }
        

    private function output_bar($post_content)
    {
        global $post;   

        if(_DEBUG_INLINE_BAR){
            echo "Outputting $this->layout bar:<br />";
        }

        // loop through availabe bar settings, exclude visability settings and create an anchor for them
        $widget_settings = $this->view_data['settings']["$this->layout"];
        if(empty($widget_settings))
            return;
        
        if((function_exists('has_post_thumbnail')) && (has_post_thumbnail()))
            $oneimage = wp_get_attachment_thumb_url(get_post_thumbnail_id(), 'thumbnail');
        else
            $oneimage = $this->cunjito_image();

        //$anchor  = '<!-- ' . $this->layout . ' anchor -->';
        $anchor = '<div style="display: inline-block;">';
        $anchor .= '<a oneimage="'. $oneimage . '" post_url="' . get_permalink() . '" id="cunjo_widget_'.$this->layout.'" cunjo="share" style="font-size:0px; text-decoration:none;" href="http://share.cunjo.com" layout="'. $this->layout .'"';

        if(isset($widget_settings['visibility_settings']['display_icons']) && $widget_settings['visibility_settings']['display_icons'] == 0)
            unset($widget_settings['social_channels']['socials']);

        if(isset($widget_settings['visibility_settings']['display_message']) &&  $widget_settings['visibility_settings']['display_message'] == 0)
            unset($widget_settings['call_to_action']['message']);

		if(empty($widget_settings['call_to_action']['messagelink']) || $widget_settings['call_to_action']['messagelink'] == '')
            unset($widget_settings['call_to_action']['messagelink']);

        //echo "CURRENT WIDGET SETTINGS: " . "<pre> " . print_r($widget_settings, TRUE) . "</pre>";        

        foreach($widget_settings as $widget_category => $widget_category_settings){
            // we dont display any visibility related settings in our anchor
            if($widget_category == "visibility_settings"){   
                continue;
            }

            foreach($widget_category_settings as $setting_name => $setting_value){
                $anchor .= " " . $setting_name . '="' . $setting_value . '" ';              
            }
        }

        

        // add category to anchor
    	$term_list = wp_get_post_terms($post->ID, 'cunjo-share-cat', array("fields" => "names"));
    	if(!empty($term_list))
    		$category = $term_list[0];
    	else
    		$category = $this->view_data['wp_options']['cunjoshare_category']; 

        if($this->view_data['wp_options']['cunjoshare_has_analytics'] == "yes")
             $anchor .= ' has_analytics="yes"';
        else
            $anchor .= ' has_analytics="no"';

        $anchor .= ' category="' . $category . '"';

		// add lang to anchor
		 $anchor .= ' lang="' . $this->view_data['wp_options']['cunjoshare_lang'] . '" tooltip="yes"';

        // add share id
        $anchor .= ' shareid="' . $this->view_data['wp_options']['cunjoshare_shareid'] . '"';
        $anchor .= ">$this->layout</a>";
        $anchor .= "</div>";

        if($widget_settings['visibility_settings']['placement'] == 'above')
            return str_replace('id="cunjo_widget_'.$this->layout.'"', 'id="cunjo_widget_'.$this->layout.'_1_' . uniqid() . '"', $anchor) . "<div style='clear:both'></div><br />" . $post_content;
        else if($widget_settings['visibility_settings']['placement'] == 'below')
            return $post_content . "<br />" . str_replace('id="cunjo_widget_'.$this->layout.'"', 'id="cunjo_widget_'.$this->layout.'_1_' . uniqid() . '"', $anchor);
        else if($widget_settings['visibility_settings']['placement'] == 'both')
            return str_replace('id="cunjo_widget_'.$this->layout.'"', 'id="cunjo_widget_'.$this->layout.'_1_' . uniqid() . '"', $anchor) . "<br />" . $post_content . str_replace('id="cunjo_widget_'.$this->layout.'"', 'id="cunjo_widget_'.$this->layout.'_2_' . uniqid() . '"', $anchor);
        
        // fallback for left elegant bar
        else return $anchor . $post_content;
    }
}

?>