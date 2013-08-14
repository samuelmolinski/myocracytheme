<?php 
class clsAssets 
{
    private static $_static_js_array = array();
    
    private static $_css_array = array();
    
    private static $_footer_js_array = array();
    private static $_footer_js_string = '';
    
    public static function setFooterJS($js_array)
    {
        if(is_string($js_array))
        {
            self::$_footer_js_array[] = $js_array;
        }
        else  if(is_array($js_array))
        {
            self::$_footer_js_array = array_merge(self::$_footer_js_array,$js_array);
            
            self::$_footer_js_array = array_unique(self::$_footer_js_array);
        }
    }  
    
    public static function setJS($js_array,$reset = false)
    {
        if($reset)
        {
             self::$_static_js_array = array();
        }
        
        if(is_string($js_array))
        {
            self::$_static_js_array[] = $js_array;
        }
        else  if(is_array($js_array))
        {
            self::$_static_js_array = array_merge($js_array,self::$_static_js_array);
            
            self::$_static_js_array = array_unique(self::$_static_js_array);
        }
    }  
    
   
    
    public static function JS()
    {
       return self::$_static_js_array; 
    }    
    
    public static function setCSS($css_array,$remove_previous_includes = false)
    {
        if($remove_previous_includes)
        {
            self::$_css_array = array();
        }
        
        if(is_string($css_array))
        {
            self::$_css_array[] = $css_array;
        }
        else  if(is_array($css_array))
        {
            self::$_css_array = array_merge(self::$_css_array,$css_array);
        }
    }    
    
    public static function CSS()
    {
       return self::$_css_array; 
    }
  
    static function loadCSS()
    {
   
        if(is_array(self::$_css_array) && count(self::$_css_array) > 0)
        {
            $str = "";
            foreach(self::$_css_array as $k=>$css_file)
            {
                $str .= '<link rel="stylesheet" media="screen" href="'.$css_file.self::get_file_time($css_file).'" />
';
            }  
            
            return $str;  
        }
    }    
    
    static function loadJS()
    {
        
        $str = '';
        if(is_array(self::$_static_js_array) && count(self::$_static_js_array) > 0)
        {
            foreach(self::$_static_js_array as $k=>$js_file)
            {
                $str .= '<script src="'.$js_file.self::get_file_time($js_file).'"></script>';
            }
        }

        return $str;
        
    }
    
    static function loadFooterJS()
    {
        
        $str = '';
        if(is_array(self::$_footer_js_array) && count(self::$_footer_js_array) > 0)
        {
            foreach(self::$_footer_js_array as $k=>$js_file)
            {
                $str .= '<script src="'.$js_file.self::get_file_time($js_file).'"></script>
';
            }
        }
        
        $str .= self::$_footer_js_string;
       
        return $str;
        
    }
    
    protected static function get_file_time($asset_file_url)
    {
        if($asset_file_url == '')
            return;
        
        $file_path = str_replace("/", DS , str_replace(SITE_URL, '', $asset_file_url));
        
        $file_path = DOC_ROOT . $file_path;
        
  
        $str = '';
        if(@file_exists($file_path))
        {
            $str = "?v=".filemtime($file_path);
        }
        
        return $str;
    }
    
    public static function registerFooterJsString($js_string,$reset= false)
    {
        if($reset)
        {
            self::$_footer_js_string = '';
        }
        
        self::$_footer_js_string .= $js_string;
    }
    

} 