<?PHP
class clsRegistry
{
    private static $instance = null;
    
    private $_vars = array();
   
    public static function getInstance()
    {
        if(is_object(self::$instance)) 
        {
            return self::$instance;
        }

        self::$instance = new self();
        
        return self::$instance; 
    }

    public function vars()
    {
        return $this->_vars;
    }  

    private function __clone(){}
	

    /**
    * @set undefined vars
    * @param string $index
    * @param mixed $value
    * @return void
    */
    public function __set($index, $value){
        $this->_vars[$index] = $value;
    }
    /**
    * @get variables
    * @param mixed $index
    * @return mixed
    */
    public function __get($index){
        if(isset($this->_vars[$index]))
        {
            return $this->_vars[$index];
        }
    }
    
    /*
    @set The registry Item
    */
    public static function set($k,$v){
        clsRegistry::getInstance()->$k = $v;
    }
    
    /*
    @get The registry Item
    */
    public static function get($k){
        return clsRegistry::getInstance()->$k;
    }
}
?>