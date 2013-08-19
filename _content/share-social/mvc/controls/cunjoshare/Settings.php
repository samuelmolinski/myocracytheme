<?php defined('_WP_FUEL_MVC') or die('Silence is golden.');

class cunjoshare_Settings_controller extends absController
{
    protected $view_data;
    private $setting_manager;
    
    public function before()
    {
        $this->setting_manager = new modCunjoShare_Settings();
        $this->view_data['settings'] = $this->setting_manager->get_internal_options();
        $this->view_data['wp_options'] = $this->setting_manager->get_wp_options(); 
    }
    
    public function index()
    {
        return;
    }
    
    public function action_Introduction()
    {   
        $this->ViewData('view_data', $this->view_data)->View('GeneralSettings/introduction');
    }
    
    public function action_Credits()
    {
        $this->ViewData('view_data', $this->view_data)->View('show_credits');
    }
    
    public function action_ShowWidgets()
    {
        // make a CURL request to widget array
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://cunjo.com/!Share_test/layouts/list_layouts.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = curl_exec($ch);
        curl_close($ch);
        
        $this->view_data['layouts'] = json_decode($output);
        $this->ViewData('view_data', $this->view_data)->View('GeneralSettings/show_widgets');
    }
    
    public function action_SetSettings()
    {
        $this->ViewData('view_data', $this->view_data)->View('GeneralSettings/set_settings');
    }
    
    public function action_SaveWidgetSettings()
    {
        $success = FALSE;
        $options = array();
         
        if(WPFuel::isPost()) 
        {
            if(!isset($_POST['data'])){    
                $status = array("status" => "error", "message" => "Missing options!");
                $this->setResponse(json_encode($status));
                return;
            }
        
            $_POST['data'] = str_replace("&amp;", "&", urldecode($_POST['data']));
            parse_str($_POST['data'], $options);
            
            //echo "Options:" . print_r($options, TRUE);
            //return;
            
            $data = clsSanitize::safe($_POST);
            if(!isset($data['layout']) OR !isset($data['category'])){
                $status = array("status" => "error", "message" => "Missing category or layout options!");
                $this->setResponse(json_encode($status));
                return;
            }
            
            if($data['category'] == "Visibility settings"){
                $success = $this->setting_manager->delete_setting($data['layout'], $data['category'], "exclude_posts");
                $success = $this->setting_manager->delete_setting($data['layout'], $data['category'], "exclude_pages");
                $success = $this->setting_manager->delete_setting($data['layout'], $data['category'], "on_custom");  
            }

            if(is_array($options['options']) && !empty($options['options'])){
                $options = $options['options'];
                foreach($options as $option_name => $option_value){
                    if(is_array($option_value)){
                        $value = implode(",", $option_value);
                        $value = clsSanitize::safe($value);
                    }
                    else{
                        $value = clsSanitize::safe($option_value);
                    }
                
                    $success = $this->setting_manager->save_widget_setting(array(
                        'layout'            => $data['layout'],
                        'category'          => $data['category'],
                        'option_name'       => $option_name,
                        'option_value'      => $value,
                        'date_added'        => date("Y-m-d"),
                    ));
                }
            }
            
            if($success)
                $status = array("status" => "success", "message" => "Settings saved successfully");
            else
                $status = array("status" => "error", "message" => "Unable to save the given setting!");
        }else{
            $status = array("status" => "error", "message" => "Missing required POST data!");
        }
        
        $this->setResponse(json_encode($status));
        return;
    }
    
    public function action_ActivateWidget()
    {
         $data = clsSanitize::safe($_POST);
         $success = $this->setting_manager->save_widget_setting(array(
                'layout'            => $data['layout'],
                'category'          => "Visibility settings",
                'option_name'       => "is_active",
                'option_value'      => "1",
                'date_added'        => date("Y-m-d"),
        ));
        
        
        echo json_encode(array("status" => "success", 'message' => "Widget activated!"));
    }
    
    public function action_DeactivateWidget()
    {
         $data = clsSanitize::safe($_POST);
         $success = $this->setting_manager->save_widget_setting(array(
                'layout'            => $data['layout'],
                'category'          => "Visibility settings",
                'option_name'       => "is_active",
                'option_value'      => "0",
                'date_added'        => date("Y-m-d"),
        ));
        
        
        echo json_encode(array("status" => "success", 'message' => "Widget deactivated!"));
    }
    
    public function action_SaveWidgetSetting()
    {
        $success = FALSE;
        
        if(WPFuel::isPost()) 
        {
            $data = clsSanitize::safe($_POST);
            $success = $this->setting_manager->save_widget_setting(array(
                'layout'            => isset($data['layout']) ? $data['layout'] : NULL,
                'category'          => isset($data['category']) ? $data['category'] : NULL,
                'option_name'       => isset($data['option_name']) ? $data['option_name'] : NULL,
                'option_value'      => isset($data['option_value']) ? $data['option_value'] : NULL,
                'date_added'        => date("Y-m-d"),
            ));
            
            if($success)
                $status = array("status" => "success", "message" => "Setting saved successfully");
            else
                $status = array("status" => "error", "message" => "Unable to save the given setting!");
        }else{
            $status = array("status" => "error", "message" => "Missing required POST data!");
        }
        
        $this->setResponse(json_encode($status));
    }
    
    public function action_AJAXTest()
    {
        $this->ViewData('view_data', $this->view_data)->View('GeneralSettings/ajax_test');
    }
    
    public function action_SaveGeneralSetting()
    {
        $success = FALSE;
         
        if(WPFuel::isPost()) 
        {
            $data = clsSanitize::safe($_POST);
            
            // does this user already have a social analytics account, if not, create one
            
            
            if(isset($_POST['_cunjo_analyticsregister-email']) && isset($_POST['_cunjo_analyticsregister-password'])){
                unset($_POST['_cunjo_analyticsregister-email']);
                unset($_POST['_cunjo_analyticsregister-password']);
            }
            
            /*      
                if(strlen($_POST['_cunjo_analyticsregister-password']) < 6)
                    $status = array("status" => "success", "message" => "Your password must be at least 6 characters in length");
                
                
                $post['email']  = $_POST['_cunjo_analyticsregister-email'];
                $post['pass']   = $_POST['_cunjo_analyticsregister-password'];
                $post['cpass']  = $post['pass'];
                $post['terms']  = "1";
                
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://cunjo.com/socialanalytics/user.php?action=ajax_register");
                
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
                
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                $output = curl_exec($ch);
                curl_close($ch);
                
                //unset($_POST['_cunjo_analyticsregister-email']);
                //unset($_POST['_cunjo_analyticsregister-password']);
                
                throw new Exception("<strong>OUTPUT:</strong> $output");
            }
            */
            
            foreach($data as $key => $value){
                update_option("cunjoshare_" . $key, $value);
            }
            
           
           $status = array("status" => "success", "message" => "Setting saved successfully");
        }else{
            $status = array("status" => "error", "message" => "Missing required POST data!");
        }
        
        $this->setResponse(json_encode($status));
    }
}
?>