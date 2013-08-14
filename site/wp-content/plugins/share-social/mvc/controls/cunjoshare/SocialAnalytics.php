<?php defined('_WP_FUEL_MVC') or die('Silence is golden.');

class cunjoshare_SocialAnalytics_controller extends absController
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
    
     public function action_LoadAnalytics()
    {
        $this->ViewData('view_data', $this->view_data)->View('social_analytics');
    }
}
?>