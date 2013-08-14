<?PHP
abstract class absFactory  extends absBase
{

    final public function __call($method, $params)
    {
        throw new expMethod("".$method." not implemented");
    }
    
    /**
     * 
     * Factory method for returning adapter objects.
     * 
     * @return object
     * 
     */
    public function factory()
    {
        // bring in the config and get the adapter class.
        $config = $this->_config;
        
        $class = $config['adapter'];
        unset($config['adapter']);
        
        if($class == null || $class == '' || !isset($class))
        {
            throw new expAdapter("".get_class($this)." Adapter not found");
        }
        
        // return the factoried adapter object
        return new $class($config);
    }
}
?>