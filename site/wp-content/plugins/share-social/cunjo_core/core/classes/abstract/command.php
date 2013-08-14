<?php 
abstract class absCommand 
{
    /**
     *
     * @var Array 
     */
    protected $_data;
    protected $_message = null;
    protected $_method = '';
    
    public function getMessage()
    {
        if($this->_message == null)
        {
           if($this->isExecuted())
           {
               $this->_message = clsMessages::setResponse(WPFuel::SUCCESS, 'Action "'.$this->_method.'" executed successfully.');
           }
           else
           {
               $this->_message = clsMessages::setResponse(WPFuel::ERROR, 'Action "'.$this->_method.'" couldn\'t be executed.');
           }
        }
        
        return $this->_message;
    }
    
    
    protected $_run_post_execution = true;
    
     public function setRunPostExecution($bool)
    {
        $this->_run_post_execution = (bool)$bool;

        return $this;
    }
    
    /**
     *
     * @param (Array) $data
     * @param (Object) $model 
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }

    /**
     *
     * @var bool
     */
    protected $_isExecuted = false;
    
    /**
     *
     * @var mixed
     */
    protected $_response = null;

    /**
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->_response;
    }
 
    /**
     *
     * @return bool
     */
    public function isExecuted()
    {
        return $this->_isExecuted;
    }
       
    /**
     *
     * @param mixed $key
     * @return array | mixed
     */
    public function getData($key='')
    {
        if($key === '')
            return $this->_data;
        else 
            return $this->_data[$key];
    }                  
    
    /**
     * This method will be invoked before Actual Command's execution
     */
    public function preExecution()
    {
        
    }
    
    /**
    * Abstract Method
    * Execute a Command
    *  @return mixed | $response
    */
    abstract protected function _Execute();
    
    
     /**
     * This method will be invoked after Actual Command's execution
     */
    public function postExecution()
    {
        
    }
    
    /**
    * Execute Command 
    * @uses: _Execute(true)
    * 
    * @param void
    * @return mixed | $response
    */
    public function Execute()
    {
        $this->preExecution();
        
        $this->_response = $this->_Execute();
        
        if($this->_response)
        {
            $this->_isExecuted = true;
        }
        
        $this->postExecution();
        
        return $this;
    }

} 