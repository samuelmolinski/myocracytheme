<?PHP   
/**
 * WordPress Fuel - Core Class
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */

define('_WP_FUEL_MVC',1);
class WPFuel
{
    const INFO = "information";
    const SUCCESS = "success";
    const ERROR = "error";
    const ATTENTION = "attention";
    
    //app modes
    const DEVELOPMENT = 'development';
    const STAGING     = 'staging';
    const TESTING     = 'testing';
    const PRODUCTION  = 'production';
    
    public static $php_errors = array(
        E_ERROR              => 'Fatal Error',
        E_USER_ERROR         => 'User Error',
        E_PARSE              => 'Parse Error',
        E_WARNING            => 'Warning',
        E_USER_WARNING       => 'User Warning',
        E_USER_NOTICE        => 'User Notice',
        E_STRICT             => 'Strict',
        E_NOTICE             => 'Notice',
        E_RECOVERABLE_ERROR  => 'Recoverable Error',
    );
   
    public static $mode = 'development';
    
    const FILE_SECURITY = '<?php defined(\'CORE_MVC_PATH\') or die(\'No direct script access.\');';
    
    
    public static function setMode($mode)
    {
        self::$mode = $mode;
    }
    
    public static function getMode()
    {
        return self::$mode;
    }
    
    public static $base_url = '/';
    public static $url_rewrite = true;
    public static $client_ip = '';
    public static $domain = '';
    
    
    public static $content_type = "text/html";
    
    /**
    * default charset
    * 
    * @var mixed
    */
    public static $charset = "UTF-8";

    
    static function isPost(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            return true;    
        }
        return false;
    }
    
    static function isGet(){
        if($_SERVER['REQUEST_METHOD'] == "GET"){
            return true;    
        }
        return false;
    }
    
    static function isAjax() {
      return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
    
    static function redirect($url, $code = 302)
    {
        if($code == 0)
            $code = 302;
        
        $request = clsRequest::initial();
        
        $referrer = clsUri::currentURL();

        $response = $request->getHttpResponse();
        
        echo $response->status($code)
                ->headers('Location', $url)
                ->headers('Referer', $referrer)
                ->send_headers()
                ->body();

        // Stop execution
        exit;
                
    }
    
    static function toUTF8($param) {
        if (function_exists("mb_convert_encoding")) {
            return mb_convert_encoding($param, 'UTF-8');
        } else {
            return $param;
        }
    }
    
    private static $_class_path = null;
    
    private static function setPath()
    {
        if(self::$_class_path == null)
        {
            self::$_class_path = array();
            self::$_class_path['cls'] = CORE_CLASSES_PATH;
            self::$_class_path['abs'] = CORE_CLASSES_PATH . 'abstract' . DIRECTORY_SEPARATOR;
            self::$_class_path['exp'] = CORE_CLASSES_PATH . 'exceptions' . DIRECTORY_SEPARATOR;
            self::$_class_path['int'] = CORE_CLASSES_PATH . 'interfaces' . DIRECTORY_SEPARATOR;
        }
    }
    
    private static function getClassPath($prefix,$classname = '')
    {
        self::setPath();
        
        return isset(self::$_class_path[$prefix]) ? self::$_class_path[$prefix] : '';
    }
    
    public static function CleanedPrefixFileName($class_name)
    {
        return strtolower(substr($class_name, 3)) . '.php';
    }
    
    static function getFileNameByClass($class_name)
    {
        $filename = self::CleanedPrefixFileName($class_name);
        $filename = str_replace('_', DS, $filename);
        
        return $filename;
    }
    

    /**
    * autoload classes ( Library ) :)
    * includes desired file
    */
    public static function AutoLoad($class_name) 
    { 
        $prefix = strtolower(substr($class_name,0,3));
        $path = self::getClassPath($prefix,$class_name);

        if($path == '')
            return false;
        
        $filename = self::getFileNameByClass($class_name);

        $file = $path . $filename;

        if (file_exists($file) == false)
        {
             return false;
        }

        require_once $file;
    }
    
    /**
     * Loads a file within a totally empty scope and returns the output:
     *
     *     $foo = WPFuel::load('foo.php');
     *
     * @param   string
     * @return  mixed
     */
    public static function load($file)
    {
        return include $file;
    }
    
    public static function undoMagicQuotes()
    {
        if (get_magic_quotes_gpc ()) {

            function undoMagicQuotes($array, $topLevel=true) {
                $newArray = array();
                foreach ($array as $key => $value) {
                    if (!$topLevel) {
                        $key = stripslashes($key);
                    }
                    if (is_array($value)) {
                        $newArray[$key] = undoMagicQuotes($value, false);
                    } else {
                        $newArray[$key] = stripslashes($value);
                    }
                }
                return $newArray;
            }

            $_GET = undoMagicQuotes($_GET);
            $_POST = undoMagicQuotes($_POST);
            $_COOKIE = undoMagicQuotes($_COOKIE);
            $_REQUEST = undoMagicQuotes($_REQUEST);
        }
    }
    

    static function set_ip()
    {
        if(WPFuel::$client_ip != '')
        {
            return;
        }
        
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            // Use the forwarded IP address, typically set when the
            // client is using a proxy server.
            WPFuel::$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            // Use the forwarded IP address, typically set when the
            // client is using a proxy server.
            WPFuel::$client_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (isset($_SERVER['REMOTE_ADDR']))
        {
            // The remote IP address
            WPFuel::$client_ip = $_SERVER['REMOTE_ADDR'];
        }
    }
    
    
    static function get_ip()
    {
        return WPFuel::$client_ip;
    }
    
    public static function url($url_params, $qsData = array(), $isSecure = false, $_base_url = null)
    {

    }

    /**
     * Generate URL from given params
     *
     * @param array $params Named URL parts
     * @param array $qsData Named querystring URL parts (optional)
     * @return string
     */
    public static function admin_url($core_url, $qsData = array(), $isSecure = false)
    {
        $url = CORE_ADMIN_URL;
 
        // HTTPS Secure URL?
        if($isSecure == true) {
            $url = str_replace('http:', 'https:', $base_url);
        }
        
        $core_url_parts = explode('/', $core_url);
        $controller = $core_url_parts[0];
        
        $url = $url . '?page='. $controller;
        
        if(isset($core_url_parts[1]) && $core_url_parts[1] != '')
        {
            $url = $url . '&method='.$core_url_parts[1];
        }
        
        if(isset($core_url_parts[2]) && $core_url_parts[2] != '')
        {
            $url = $url . '&slug='.$core_url_parts[2];
        }
        
 
        // Is there query string data?
        $queryString = '';
        if(count($qsData) > 0 && is_array($qsData)) {
            // Build query string from array $qsData
            $queryString .= http_build_query($qsData, '', '&');
            
            $url = $url . '&' . $queryString;
        }
        
        // Return fully assembled URL
        $url = str_replace('///', '/', $url);
        
        return rtrim($url,'/');
    }
    
    
    private static $_config = array();
    public static function LoadConfig($config_name, $allowModifications = false, $path = null)
    {
        $key = md5($path.$config_name);
        if(isset(self::$_config[$key]))
        {
            return self::$_config[$key];
        }

        $oConfig = new clsConfig($config_name, $allowModifications,$path);
        self::$_config[$key] = $oConfig->toArray();
        
        return self::$_config[$key];
    }
    
    public static function getConfig($config_name,$key, $allowModifications = false, $path = null)
    {
        $config = self::LoadConfig($config_name);
        if(is_array($config) == false)
        {
            throw new expConfig("Unable to fetch config data for ".$config_name."");
        }
        
        $keySegments = explode('.',$key);
        $count = count($keySegments);
        if($count == 1)
        {
            return $config[$keySegments[0]];
        }
        else if($count == 2)
        {
            $configSection = $config[$keySegments[0]];
            return $configSection[$keySegments[1]];
        } 
        else if($count == 3)
        {
            $configSection = $config[$keySegments[0]][$keySegments[1]];
            return $configSection[$keySegments[2]];
        }
    }
    
    public static function isWindows()
    {
        // Determine if we are running in a Windows environment
        return (DIRECTORY_SEPARATOR === '\\');
    }
   
    public static function debug($obj, $exit = true) 
    {
        echo "<pre>";
            print_r($obj);
        echo "</pre>";

        if ($exit) 
        {
           exit;
        }
    }  
    
    /**
     * 
     * Convenience method to instantiate and configure an object.
     * 
     * @param string $class The class name.
     * 
     * @param array $config Configuration value overrides, if any.
     * 
     * @return object A new instance of the requested class.
     * 
     */
    public static function factory($class, $config = null)
    {
        $obj = new $class($config);
        
        // is it an object factory?
        if ($obj instanceof absFactory) {
            // return an instance from the object factory
            return $obj->factory();
        }
        
        // return the object itself
        return $obj;
    }
    
    /**
     * 
     * Combination dependency-injection and service-locator method; returns
     * a dependency object as passed, or an object from the registry, or a 
     * new factory instance.
     * 
     * @param string $class The dependency object should be an instance of
     * this class. Technically, this is more a hint than a requirement, 
     * although it will be used as the class name if [[ice::factory()]] 
     * gets called.
     * 
     * @param mixed $spec If an object, check to make sure it's an instance 
     * of $class. If a string, treat as a [[ice::get()]] key. 
     * Otherwise, use this as a config param to [[ice::factory()]] to 
     * create a $class object.
     * 
     * @return object The dependency object.
     * 
     */
    public static function dependency($class, $spec)
    {
        // is it an object already?
        if (is_object($spec)) {
            return $spec;
        }
        
        // check for registry objects
        if (is_string($spec) && is_object(clsRegistry::get($spec))) 
        {
            return clsRegistry::get($spec);  
        }

        // not an object, not in registry.
        // try to create an object with $spec as the config
        return self::factory($class, $spec);
    }

    public static function init()
    {
        WPFuel::set_ip();
        
        spl_autoload_register(array('WPFuel', 'AutoLoad'));

        clsRegistry::set('route_indexes',array('controller','method','slug','code'));
        
        if ( get_magic_quotes_gpc() ) {
            $_POST      = array_map( 'stripslashes_deep', $_POST );
            $_GET       = array_map( 'stripslashes_deep', $_GET );
            $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
            $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
        }
        
        //clsMVC_Error_Handler::getInstance()->register();
    }
    
    static function get_exception_trace($ex)
    {
        return clsTemplate::factory(CORE_VIEWS_PATH)->View('trace',array('exception' => $ex));
    }
    
    static function isFlash()
    {
        if(strtoupper($_SERVER['HTTP_USER_AGENT']) == "SHOCKWAVE FLASH"){
            return true;    
        }
        return false;
    }
    
     /**
     * 
     * @param type $core_url
     * @param absRequest $oRequest
     * @return type 
     */
    static function getCoreUrlRequest($core_url, absRequest $oRequest = null)
    {
        $core_url = str_replace(CORE_SITE_URL, '', $core_url);
        
        $uri = ltrim($core_url, '/');
        $uri = preg_replace('#//+#', '/', $core_url);
        $explode_uri = explode('/',$uri);
        
        $indexer = new clsStorage_Keys(clsRegistry::get('route_indexes'));
   
        
        if($oRequest == null)
        {
            $oRequest = clsRequest::factory();
        }
        
        $params = array();
        foreach($explode_uri as $key=>$param)
        {            
            if(($keyname = $indexer->get($key)))
            {
                $key = $keyname;
  
                $oRequest->setParam($key,$param);
                $params[$key] = $param;
            }
        }
        

        $oRequest->setParam('route_params', $params);
        
        return $oRequest;
        
    }
    
}

?>