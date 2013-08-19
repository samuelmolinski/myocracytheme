<?php

class modCunjoShare_Settings extends absModel
{
    protected $db;
    protected $_primary_key;
    protected $_table;
    
    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;
        $this->_primary_key = "id";
        $this->_table = $wpdb->prefix . "cunjoshare"; 
        
        parent::__construct();
    }
    
    public function delete_setting($layout, $category, $option_name)
    {
        $this->db->delete($this->_table, array('category' => $category, 'layout' => $layout, 'option_name' => $option_name), array('%s', '%s', '%s'));
    }
    
    public function get_internal_options($layout = NULL)
    {
        if($layout)
            $sql = " WHERE layout = '$layout' LIMIT 1";
        else
            $sql = "";
        
        // get layouts
        $layouts = $this->db->get_results("SELECT DISTINCT layout FROM $this->_table $sql", ARRAY_A, 0);
        foreach($layouts as $layout){
            // instantiate aray
            $settings["{$layout['layout']}"] = array();
            //$i = 0;
            
            // get categories of each layout
            $categories = $this->db->get_results("SELECT DISTINCT category FROM $this->_table WHERE layout = '{$layout['layout']}'", ARRAY_A, 0);
            
            // get settings of each category
            foreach($categories as $category){
                $cat_key = strtolower(str_replace(" ", "_", $category['category']));
                $settings["{$layout['layout']}"]["$cat_key"]['settings_category'] = $category['category']; 
                
                // get options of each category
                $options = $this->db->get_results("SELECT option_name, option_value FROM $this->_table WHERE category = '{$category['category']}' AND layout = '{$layout['layout']}'", ARRAY_A, 0);
                foreach($options as $option){
                    $settings["{$layout['layout']}"]["$cat_key"]["{$option['option_name']}"] = $option['option_value'];
                }
                //$i++;  
            }
        }
        
        return $settings;
    }
    
    /**
     * modCunjoShare_Settings::get_wp_options()
     * 
     * @param mixed $options an optional array of options to retrieve, if ommitted, all options will be retrieved
     * @return
     */
    public function get_wp_options($options = array(), $option_prefix = "cunjoshare")
    {
        if(empty($options)){
            $data = $this->db->get_results("SELECT option_name, option_value FROM {$this->db->prefix}options WHERE option_name LIKE '%{$option_prefix}_%'", ARRAY_A, 0);
            foreach($data as $option){
                $output["{$option['option_name']}"] = $option['option_value'];
            }
        }else{
            foreach($options as $option){
                $output[$option] = get_option("cunjo_" . $option);
            }
        }
        
        return $output;
    }
    
    public function save_widget_setting($data = array())
    {
        if(empty($data) OR !isset($data['layout']) OR !isset($data['option_name']))
            return FALSE;
        
        // does this option already exist, if so, overwrite, else save
        $option = $this->db->get_row($this->db->prepare("SELECT id FROM $this->_table WHERE layout = %s AND option_name = %s", $data['layout'], $data['option_name']), ARRAY_A, 0);
        if(!empty($option)){
            // setting exists, update it
            $data['id'] = $option['id'];
            $this->update($data);
            $result = TRUE; // update
        }else{
            // option doesn't exist, insert it
            $result = $this->Save(array(
                'layout'            => isset($data['layout']) ? $data['layout'] : NULL,
                'category'          => isset($data['category']) ? $data['category'] : NULL,
                'option_name'       => isset($data['option_name']) ? $data['option_name'] : NULL,
                'option_value'      => isset($data['option_value']) ? $data['option_value'] : NULL,
                'date_added'        => date("Y-m-d"),
            ));
        }
        
        return $result;
    }
}
?>