<?PHP
abstract class absBase
{
    /**
     * 
     * Default configuration values.
     * 
     * @config string adapter The adapter class for the factory to generate.
     * 
     * @var array
     * 
     */
    protected $_config = array();
    
    /**
     * 
     * Constructor.
     * 
     * @param array $config Configuration value overrides, if any.
     * 
     */
    public function __construct($config = null)
    {
        $this->_preConstruct();
        
             // build configuration
        $this->_config = array_merge(
            $this->_buildConfig(get_class($this)),
            (array) $config
        );
        
         
        $this->_postConstruct();
    }
    
     /**
     * 
     * Builds and returns the default config for a class, including all
     * configs inherited from its parents.
     * 
     * @param string $class The class to get the config build for.
     * 
     * @return array The config build for the class.
     * 
     */
    protected function _buildConfig($class)
    {
        if (! $class) {
            return array();
        }
        
        $config = clsConfig::getBuild($class);
        
        if ($config === null) {
        
            $var    = "_$class";
            $prop   = empty($this->$var)  ? array() : (array) $this->$var;
                    
            $parent = get_parent_class($class);
            
            $config = array_merge(
                // parent values
                $this->_buildConfig($parent),
                // override with class property config
                $prop
            );
            
            // cache for future reference
            clsConfig::setBuild($class, $config);
        }
        
        return $config;
    }
    
    
    
    public function _preConstruct()
    {
        
    }    
    
    public function _postConstruct()
    {
        
    }
    
}