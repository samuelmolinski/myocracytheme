<?PHP
class clsFlashMessages 
{
    public static $prefix_key = 'wp-coremvc-flash-message';
    
    private static $_instance = null;

    public static function Instance()
    {
        if(self::$_instance === null)
            self::$_instance = new clsFlashMessages();
        
        return self::$_instance;
    }
 
    private function _construct(){}
    private function _clone(){}

    protected function _setSession($k,$value)
    {
        $key = self::$prefix_key.'_'.$k;
        clsSession::instance()->set($key,$value);
        
        return $this;
    }
    
    protected function _getSession($k)
    {
        $key = self::$prefix_key.'_'.$k;
        return clsSession::instance()->get_once($key);
    }


    function _set_string($m,$type)
    {
         $this->_setSession($type,$m);
    }
    
    function attention($m){  
        $this->_set_string($m,  WPFuel::ATTENTION); 
    }
    
    function error($m){  
        $this->_set_string($m,WPFuel::ERROR); 
    }
    
    function success($m){
       $this->_set_string($m,WPFuel::SUCCESS);    
    }
    
    function info($m){
        $this->_set_string($m,WPFuel::INFO);
    }
    
    function information($m){
        $this->info($m);
    }

    function setMessage($key,$value)
    {
        $this->_setSession($key,$value);
        
        return $this;
    }
    
    function getMessage($key)
    {
        return $this->_getSession($key);
    }

    function getMessages()
    {
        $dataset = array();
        
        $errors = $this->_getSession('error');
        $succ = $this->_getSession('success');
        $info = $this->_getSession('information');
        $attention = $this->_getSession('attention');
        
        if($attention){
            $dataset['attention'] = $attention;
        }
        
        if($errors){
            $dataset['error'] = $errors;
        }
        
        if($info){
            $dataset['information'] = $info;
        } 
        
        if($succ){
            $dataset['success'] = $succ;
        }
        
        return $dataset;
    }
    
     /**
     *
     * @param array $response
     */
    public function setFlashMessagebyArray(array $response)
    {
        $func = $response['type'];
        
        if($func == '')
            return $this;
        
        $this->$func($response['message']);
        
        return $this;
    }

}//class ends


?>