<?php
class clsStorage_Keys
{
    /**
     * Array of Reserved keys to be used e.g router as params
     * @var array
     */
    protected $_keys = array();
    
    public function __construct($keys = null) 
    {       
        $this->_keys = $keys;
    }

     /**
     * get a key from key stack
     *
     * @param string $index
     * @return string|null
     */
    public function get($index)
    {
        if( isset($this->_keys[$index])){
            return $this->_keys[$index];	
        }
        return null;
    }
	
    /**
     * Retrieve keys
     *
     * @return array
     */
    public function getKeys()
    {
        return $this->_keys;
    }

}
