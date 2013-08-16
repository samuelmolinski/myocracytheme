<?PHP
class clsUri
{
    static function currentURL()
    {
         $current_url = 'http';
         if ($_SERVER["HTTPS"] == "on") {$current_url .= "s";}

         $current_url .= "://";
         if ($_SERVER["SERVER_PORT"] != "80") 
         {
            $current_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } 
         else 
         {
            $current_url .= $_SERVER["SERVER_NAME"]."".$_SERVER["REQUEST_URI"];
         }

         return self::clean($current_url);
    }
    
    public static function clean($uri)
    {
        $uri = str_replace('http://', 'HTTP##', $uri);
        $uri = str_replace('https://', 'HTTPS##', $uri);
        
        // Reduce multiple slashes to a single slash
        $uri = preg_replace('#//+#', '/', $uri);

        // Remove all dot-paths from the URI, they are not valid
        $uri = preg_replace('#\.[\s./]*/#', '', $uri);
        
        $uri = str_replace('HTTP##','http://', $uri);
        $uri = str_replace('HTTPS##','https://', $uri);
        
        return $uri;
    }
    
    public static function partsToUrl($urlParts)
    {
        if($urlParts['host'] == '')
            return false;
        
        $current_url = $urlParts['host'];
        if(isset($urlParts['port']) && $urlParts['port'] != 80)
        {
            $current_url = $current_url . ':'.$urlParts['port'].'/';
        }

        $current_url = $urlParts['scheme'] . '://' . $current_url . '/'. $urlParts['path'];

        return self::clean($current_url);
    }
    
    public static function getHost($url)
    {
        $urlParts = parse_url($url);
        
        return $urlParts['host'] ;
    }
    
    public static function getMergedUri($current_url,array $query_params = array())
    {
            $urlParts = parse_url($current_url);
            $current_url = clsUri::partsToUrl($urlParts);

            $urlQparams = array();
            parse_str($urlParts['query'],$urlQparams);

            $query_params = array_merge($query_params,$urlQparams);
            $query_string = http_build_query($query_params);
            if($query_string == '')
            {
                return $current_url;
            }
            else
            {
                 $current_url = $current_url . '?' . http_build_query($query_params);;
            }
            
            return $current_url;
    }
    
}