<?php
/**
 * WordPress Fuel - Abstract Dispatcher Class
 * 
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
abstract class absDispatcher 
{
    protected $_request = null; 
    
    protected $_controller = null;
    protected $_action = null; 

    /**
     * Front Controller instance
     * @var clsFrontController
     */
    protected $_frontController;
    

    /**
     * Default action
     * @var string
     */
    protected $_defaultAction = 'index';

    /**
     * Default controller
     * @var string
     */
    protected $_defaultController = 'home';
    
    /**
     * Array of invocation parameters to use when instantiating action
     * controllers
     * @var array
     */
    protected $_invokeParams = array();
    
    
    /**
     * Controller Object
     * controllers
     * @var array
     */
    protected $oController = null;
    
    function getControllerObject()
    {
       return $this->oController;
    }
  
    protected $_oFrontController = null;
    
     /**
     * Constructor
     *
     * @return void
     */
    public function __construct(clsFrontController $oFrontController)
    {
        $this->_frontController = $oFrontController;
        $params = $this->_frontController->getParams();
        
        $this->setParams($params);
    }
    
    /**
     * Add or modify a parameter to use when instantiating an action controller
     *
     * @param string $name
     * @param mixed $value
     * @return absDispatcher
     */
    public function setParam($name, $value)
    {
        $name = (string) $name;
        $this->_invokeParams[$name] = $value;
        return $this;
    }

    /**
     * Set parameters to pass to action controller constructors
     *
     * @param array $params
     * @return absDispatcher
     */
    public function setParams(array $params)
    {
        $this->_invokeParams = array_merge($this->_invokeParams, $params);
        return $this;
    }

    /**
     * Retrieve a single parameter from the controller parameter stack
     *
     * @param string $name
     * @return mixed
     */
    public function getParam($name)
    {
        if(isset($this->_invokeParams[$name])) {
            return $this->_invokeParams[$name];
        }

        return null;
    }

    /**
     * Retrieve action controller instantiation parameters
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_invokeParams;
    }
    
    /**
     * Retrieve front controller instance
     *
     * @return clsFrontController
     */
    public function getFrontController()
    {
        return $this->_frontController;
    }

    /**
     * Set front controller instance
     *
     * @param clsFrontController $controller
     * @return absDispatcher
     */
    public function setFrontController(clsFrontController $controller)
    {
        $this->_frontController = $controller;
        return $this;
    }

    protected $_controller_directory = null;
    
    protected $_views_directory = null;
    
    public function setStatus($status)
    {
        $this->_status = $status;
        return $this;
    }
    
    /**
     * Retrieve the status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }
   
    
    /**
     * Set controller directory
     *
     * @param array|string $directory
     * @return absDispatcher
     */
    public function setControllerDirectory($directory)
    {
        $this->_controller_directory = $directory;

        return $this;
    }
    
  
    /**
     * Return the currently set directory for ice_controller class
     */
    public function getControllerDirectory()
    {
        if($this->_controller_directory == null){
            $this->_controller_directory = $this->getDefaultControllerDirectory();
        }
        
        return $this->_controller_directory;
    }

     /**
     * Retrieve the default controller directory
     *
     * @return string
     */
    public function getDefaultControllerDirectory()
    {
        return realpath('.') . DS . 'controls' .DS;
    }
    
    

    /**
     * Set the default controller (minus any formatting)
     *
     * @param string $controller
     * @return absDispatcher_abstract
     */
    public function setDefaultController($controller)
    {
        $this->_defaultController = (string) $controller;
        return $this;
    }

    /**
     * Retrieve the default controller name (minus formatting)
     *
     * @return string
     */
    public function getDefaultController()
    {
        return $this->_defaultController;
    }

    /**
     * Set the default action (minus any formatting)
     *
     * @param string $action
     * @return absDispatcher_abstract
     */
    public function setDefaultAction($action)
    {
        $this->_defaultAction = (string) $action;
        return $this;
    }

    /**
     * Retrieve the default action name (minus formatting)
     *
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->_defaultAction;
    }
    
    
    /**
     * Retrieve the default views directory
     *
     * @return string
     */
    public function getDefaultViewDirectory()
    {
        return realpath('.') . DS . 'views' .DS;
    }
    
    
    public function setViewDirectory($dir)
    {
        $this->_views_directory = $dir;
        return $this;
    }
    
    public function getViewDirectory()
    {
        if($this->_views_directory == null) 
                $this->_views_directory = $this->getDefaultViewDirectory();
        
        return $this->_views_directory;
    }
    
    public function getDefaultView()
    {
        return $this->getController() . DS . $this->getAction();
    }
    
   
    public function getController()
    {
        $this->_controller = $this->_request->getController();

  
        if( $this->_controller == null || $this->_controller == '')
        {
            $this->_controller = $this->getDefaultController();
        }

        return $this->_controller;
    }
 
    public function getAction()
    {
        $this->_action = $this->_request->getAction();
        
        if($this->_action == null || $this->_action == '')
        {
            $this->_action = $this->getDefaultAction();
        }
        
        return $this->_action;
    }
    
    public function getRequest()
    {
        return $this->_request;
    }

    public function dispatch(absRequest $request)
    {

        if (is_dir($this->getControllerDirectory()) == false) 
        {
            throw new expCore ('Invalid controller path: `' . $this->getControllerDirectory() . '`');
        }
        
        if (is_dir($this->getViewDirectory()) == false) {
            throw new expCore ('Invalid view path: `' . $this->getViewDirectory() . '`');
        }
        
        
        $this->_request = $request;
        
        $this->_controller = $this->getController();
        $this->_action = $this->getAction();

        $this->_request->setController($this->_controller)->setAction($this->_action);
        
        if($this->isDispatchable() == false)
        {
           $this->_request->setException(new expControl404('Invalid controller specified (' . $this->_controller . ')'));
        }
        else
        {
             $this->_dispatch();
        }
    }
    
    protected $_oControllerFile = '';
     /**
     * Returns TRUE if controller found

     * @return boolean
     */
    public function isDispatchable($controller = '')
    {
        if($controller == '')
        {
            $controller = $this->_controller;
        }
        

        if (!$controller) {
            return false;
        }

        $this->_oControllerFile = $this->getControllerDirectory() . DS . $controller . '.php';
        
        if(file_exists($this->_oControllerFile) == false)
            $this->_oControllerFile = $this->getControllerDirectory() . str_replace('_', DS, $controller) . '.php'; // Class Name to Directory Mapping
       
        $this->_oControllerFile = str_replace(DS.DS,DS,$this->_oControllerFile);
 
        if(file_exists($this->_oControllerFile) == false)
        {
           return false;
        }

        if(is_readable($this->_oControllerFile) == false)
        {
             return false;
        }
        
        require_once $this->_oControllerFile;
        
   
        return true;
    }
    
    protected abstract function _dispatch();
    
    /**
     * Determine the action name
     *
     * First attempt to retrieve from request; then from request params
     * using action key; default to default action
     *
     * Returns formatted action name
     *
     * @return string
     */
    public function getActionMethod()
    {
        $action = $this->_action;
        if($action != $this->getDefaultAction())
        {
            $action = $this->formatAction($action);
        }
        
        return $action;
    }
    
    
    /**
     * Formats a string from a URI into a PHP-friendly name.
     *
     * @param string $unformatted
     * @return string
     */
    protected function _formatName($unformatted)
    {
      return preg_replace('/[^a-z0-9 ] _/', '', $unformatted);
    }
    
    /**
     * Formats a string into an action name.  This is used to take a raw
     * action name, such as one that would be stored inside a absRequest
     * object, and reformat into a proper method name that would be found
     * inside a class extending absController.
     *
     * @param string $unformatted
     * @return string
     */
    public function formatAction($unformatted)
    {
        $formatted = $this->_formatName($unformatted, true);
        return  'action_'.$formatted;
    }
    
    public function formatController($unformatted)
    {
        $formatted = $this->_formatName($unformatted, true);
        return  $formatted.'_controller';
    }

}
