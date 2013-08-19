<?php
abstract class absController_Widget extends absController 
{    
    protected $_current_controller = '';
    protected $_current_action = '';
    
    /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
        if($this->is_hmvc_request() == false)
        {
            die('Silence is golden');
        }

        $this->_current_controller = $this->_dispatcher->getFrontController()->getCurrentController();
        $this->_current_action = $this->_dispatcher->getFrontController()->getCurrentAction();
        
        $this->ViewData('current_controller',  $this->_current_controller);
        $this->ViewData('current_action',  $this->_current_action);
        
        $this->ViewData('invoke_args',$this->_invokeArgs);
        parent::init();
    }
    
    public function index(){}
    
    public function View($view,$view_params =  array())
    {
        $this->setResponse($this->Template()->View($view,$view_params));
        
        return $this;
    }
  
}
?>
