<?php 
class clsTemplate_Meta  
{
    private $_page_title = array();
    private $_page_keywords = '';
    private $_page_description = '';
    
    private $_title_separator = " - ";

    private static $_instance = null;
    
    public static function instance()
    {
        if(self::$_instance == null)
        {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    private function __construct($config=array())
    {
        if(isset($config['separator']))
        {
            $this->_title_separator = $config['separator'];
        }
    }
    
    private function __clone(){}
    
    function reset()
    {
        $this->_page_description = '';
        $this->_page_keywords = '';
        $this->_page_title = array();
        
        return $this;
    }
    
    function DisplayTitle()
    {
        $_title = '';
       
        for($i=count($this->_page_title); $i>=0; $i--)
        {
            $_title .= $this->_page_title[$i] . $this->_title_separator;
        }
        
        $_title = trim($_title,$this->_title_separator);
     
        return $_title;    
    }
    
    function setTitle($title,$reset_title=false)
    {
        if(trim($title) != '')
        {
            if($reset_title)
            {
                $this->_page_title = array();
            }
            
            if(in_array($title, $this->_page_title) == false)
                $this->_page_title[] = $title;
        }

        return $this;
    }
 
    
    function setKeywords($keywords)
    {
        if(trim($keywords) != '')
            $this->_page_keywords .= $keywords . ",";
        
        return $this;
    }
    
    function setDescription($description)
    {
        if(trim($description) != '')
            $this->_page_description .= $description;
        return $this;
    }  
      
    function getKeywords()
    {
        return rtrim($this->_page_keywords,',');
    }
    
    function getDescription()
    {
        return $this->_page_description;
    }
    
    public static function get_meta($meta_name,$meta_value)
    {
        if(trim($meta_value) != '')
        {
            return'<meta name="'.$meta_name.'"  content="'.$meta_value.'" />'.PHP_EOL;
        }
    }
    
    protected static $_optional_meta = array();
    
    public static function set_optional_meta($meta_name,$meta_value)
    {
        if($meta_name != '' && $meta_value != '')
        {
            self::$_optional_meta[$meta_name] = $meta_value;
        }
    }
    
    public static function get_optional_meta_tags()
    {
        $str = '';
            
        if(count(self::$_optional_meta))
        {
            foreach(self::$_optional_meta as $name => $content)
            {
                $str .= '<meta name="'.$name.'"  content="'.$content.'" />'.PHP_EOL;
            }
        }
        
        return $str;
    }
}