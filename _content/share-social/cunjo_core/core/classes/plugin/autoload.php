<?php
class clsPlugin_Autoload
{   
    private $_plugin_mvc_directory = '';
    public function __construct($plugin_mvc_directory) 
    {
        $this->_plugin_mvc_directory = $plugin_mvc_directory;
        
        $this->_setPathTokens();
    }
    
    private $_resources_path = null;
    
    private function _setPathTokens()
    {
        $this->_resources_path = array();
        $this->_resources_path['mod'] = $this->_plugin_mvc_directory . 'models' . DIRECTORY_SEPARATOR;
        $this->_resources_path['hlp'] = $this->_plugin_mvc_directory . 'helpers' . DIRECTORY_SEPARATOR;
        $this->_resources_path['sco'] = $this->_plugin_mvc_directory . 'shortcodes' . DIRECTORY_SEPARATOR;
    }
    
    private function getClassPath($prefix,$classname = '')
    {
        return isset($this->_resources_path[$prefix]) ? $this->_resources_path[$prefix] : '';
    }
    
    public function registerAutoLoad() 
    {
        spl_autoload_register(array($this, 'AutoLoad'));
    }
    
    /**
    * autoloads Plugin resources ( Library ) :)
    * includes desired file
    */
    public function AutoLoad($class_name) 
    { 
        $prefix = strtolower(substr($class_name,0,3));
        $path = $this->getClassPath($prefix,$class_name);

        if($path == '')
            return false;
        
        $filename = WPFuel::getFileNameByClass($class_name);

        $file = $path . $filename;

        if (file_exists($file) == false)
        {
             return false;
        }

        require_once $file;
    }
}
?>