<?php defined('_WP_FUEL_MVC') or die('Silence is golden.');



define(_DEBUG, TRUE);



class cunjoshare_LeftTab_controller extends absController

{

    protected $view_data;

    private $setting_manager;

    private $layout = "left_tab";

    

    public function before()

    {

        $this->setting_manager = new modCunjoShare_Settings();

        $this->view_data['layout']  = $this->layout;

        $this->view_data['settings'] = $this->setting_manager->get_internal_options($this->layout);

        $this->view_data['wp_options'] = $this->setting_manager->get_wp_options(); 

    }

    

    public function index()

    {

        return;

    }

    

    public function action_HandleCredits()

    {

        echo "";

    }

    

    public function action_install()

    {

        $layout = $this->layout;

        

        // if settings already exist we dont update

        if(!empty($this->view_data['settings']))

            return;

        

        //***Social channels settings category

        $settings['settings_category'] = 'Social channels';

        $settings['socials'] = 'Facebook,Twitter,Google,Linkedin,Email';

		$settings['socials_target'] = 'window';

        

        foreach($settings as $setting_name => $setting_value){

            if($setting_name == "settings_category")

                continue;

            

            $success = $this->setting_manager->save_widget_setting(array(

                    'layout'            => $layout,

                    'category'          => $settings['settings_category'],

                    'option_name'       => $setting_name,

                    'option_value'      => (is_array($setting_value) ? json_encode($setting_value) : $setting_value),

                    'date_added'        => date("Y-m-d"),

            ));

            

            unset($settings["$setting_name"]);

        }

         

        //***Bar layout design settings category

        $settings['settings_category'] = 'Bar layout design';

        $settings['position'] = 'center';

        $settings['icons'] = 'white';

        $settings['textcolor'] = '#fff';

        $settings['toolstyle'] = 'darkminimal';

        $settings['bgcolor'] = '#444';

        

        foreach($settings as $setting_name => $setting_value){

            if($setting_name == "settings_category")

                continue;

            

            $success = $this->setting_manager->save_widget_setting(array(

                    'layout'            => $layout,

                    'category'          => $settings['settings_category'],

                    'option_name'       => $setting_name,

                    'option_value'      => (is_array($setting_value) ? json_encode($setting_value) : $setting_value),

                    'date_added'        => date("Y-m-d"),

            ));

            

            unset($settings["$setting_name"]);

        }

                

        //***Visibility settings category

        $settings['settings_category'] = 'Visibility settings';

		$settings['display_icons'] = 1;

        $settings['on_home'] = 1;

        $settings['on_pages'] = 1;

        $settings['on_posts'] = 1;

        $settings['on_custom'] = "";

        $settings['exclude_pages'] = "";

        $settings['exclude_posts'] = "";

        $settings['is_active'] = 0;

        

        foreach($settings as $setting_name => $setting_value){

            if($setting_name == "settings_category")

                continue;

            

            $success = $this->setting_manager->save_widget_setting(array(

                    'layout'            => $layout,

                    'category'          => $settings['settings_category'],

                    'option_name'       => $setting_name,

                    'option_value'      => (is_array($setting_value) ? json_encode($setting_value) : $setting_value),

                    'date_added'        => date("Y-m-d"),

            ));

            

            unset($settings["$setting_name"]);

        }

    }

    

     public function action_activate()

    {

        $success = $this->setting_manager->save_widget_setting(array(

                'layout'            => $this->layout,

                'category'          => "Visibility settings",

                'option_name'       => "is_active",

                'option_value'      => "1",

                'date_added'        => date("Y-m-d"),

        ));

        

        echo json_encode(array("status" => "success", 'message' => "Widget activated!"));

        return;

    }

    

    public function action_DisplayBar()

    {

        /*

        The following is available to use:

        $this->view_data['layout']  = $this->layout;

        $this->view_data['settings'] = $this->setting_manager->get_internal_options($this->layout);

        $this->view_data['wp_options'] = $this->setting_manager->get_wp_options(); 

        */

        

        if(_DEBUG){

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

            if(_DEBUG){

                echo "$this->layout active!";

           }

            

           if(is_home() OR is_front_page()){

                // do we want to show this widget on the home page

                if($settings['visibility_settings']['on_home'] == TRUE){

                    // is this the homepage

                   echo $this->output_bar();

                }else{

                   if(_DEBUG){

                        echo "Home page is excluded!<br />";

                   }

                    

                   return;

                }

            }

            else if(is_category() OR is_archive() OR is_tax()){
                echo $this->output_bar();
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

                                if(_DEBUG){

                                    echo "This page is excluded!<br />";

                                }

                                

                                return;

                            }

                        }

                    }

                    

                    // page is not excluded

                    echo $this->output_bar();

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

                                            if(_DEBUG){

                                                echo "This post has custom post type allowance but is hidden due to exclude_posts!<br />";

                                            }

                                            

                                            break 2; // exit exlcusion loop and display bar

                                        }

                                    }

                                }

                                */

                                

                                // don't display the bar on this page

                                if(_DEBUG){

                                    echo "This post is excluded!<br />";

                                }

                                

                                return;

                            }

                        }

                    }

                    

                    // page is not excluded

                    echo $this->output_bar();

                }

            }else{

                if(_DEBUG){

                    echo "Unknown post/page type!<br />";

                }

                

                // is this a custom post type?

                if(isset( $settings['visibility_settings']['on_custom'])){

                    foreach(explode(",", $settings['visibility_settings']['on_custom']) as $custom_post_type){

                        if(get_post_type() == $custom_post_type){

                             echo $this->output_bar();

                             return;

                        }

                    }

                }

            }

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

    private function output_bar()

    {

        global $post;

        

        if(_DEBUG){

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


        $anchor = '<a oneimage="'. $oneimage . '" id="cunjo_widget_'.$this->layout.'" cunjo="share" style="font-size:0px; text-decoration:none;display: inherit;" href="http://share.cunjo.com" layout="'. $this->layout .'"';

        

        if($widget_settings['visibility_settings']['display_icons'] == 0)

            unset($widget_settings['social_channels']['socials']);

        

        if($widget_settings['visibility_settings']['display_message'] == 0)

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

        

        $anchor .= ">!Share by Cunjo</a>";

        $anchor .= "</div>";

        

        return $anchor;

    }

    

    public function action_deactivate()

    {

        $success = $this->setting_manager->save_widget_setting(array(

                'layout'            => $this->layout,

                'category'          => "Visibility settings",

                'option_name'       => "is_active",

                'option_value'      => "0",

                'date_added'        => date("Y-m-d"),

        ));

        

        

        echo json_encode(array("status" => "success", 'message' => "Widget deactivated!"));

        return;

    }

    

    public function action_uninstall()

    {

        //$this->setting_manager->delete(array('layout' => $this->layout));

        return;

    }

    

    public function action_GetSettingModals()

    {

        $this->ViewData('view_data', $this->view_data)->View("tab_modals/" . $this->layout . '_modals');

    }

}

?>