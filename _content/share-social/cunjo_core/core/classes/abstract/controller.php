<?php
abstract class absController 
{           

    /**
     * absTemplate Instance
     * @var absTemplate 
     */
    protected $_template = null;
    
    /**
     * ClsMeta Instance
     * @var clsMeta 
     */
    protected $_meta = null;
    
    /**
     * Auth needed for this Action Controller
     * @var bool 
     */
    protected $_auth_needed = false;
    
    /**
     * Master Page directory
     * @var string 
     */
    protected $_master_page = 'default';

    /**
     * is View rendered
     * @var bool
     */
    protected $_view_rendered = false;
    
    /**
     * Is View renderable
     * By Default all actions end in calling $this->View()
     * To disable this set (@var) to false
     * @var bool 
     */
    protected $_view_renderedable = true;
    
     /**
     * Front controller instance
     * @var clsFrontController
     */
    protected $_frontController;
    
    /**
     * absDispatcher instance
     * @var absDispatcher 
     */
    protected $_dispatcher = null;
    
     /**
     * Array of arguments provided to the constructor, minus the
     * {@link $_request Request object}.
     * @var array
     */
    protected $_invokeArgs = array();
    
    /**
     * absRequest  instance
     * @var absRequest 
     */
    protected $_request = null;
    
     /**
     * absModel instance
     * @var model 
     */
    protected $_model = null;
    
    /**
     * Whether to run $this->index() by default if requested action doesnt exist.
     * @var (bool) 
     */
    protected $_run_default_method = false;
    
    /**
     *
     * @var clsRequest
     */
    protected $_initital_request = null;
    
    /**
     * Plugin that invokes the controller
     * @var absMVC_Plugin 
     */
    protected $_plugin = null;
    
    function __construct(absDispatcher $oDispatcher, array $args = array())
    {
        $this->_dispatcher = $oDispatcher; 

        $this->_plugin = $this->_dispatcher->getFrontController()->getPlugin();
        $this->ViewData('plugin',$this->_plugin);
        
        // Allows view to use Plugin API
        //$this->ViewData('plugin', $this->_plugin);
        
        $this->_initital_request = clsRequest::initial();
       
        $this->_setInvokeArgs($args)
              ->setRequest($this->_dispatcher->getRequest())
              ->init();
        
        $this->checkAuth();
    }
    
    /**
     *
     * @return absMVC_Plugin 
     */
    protected function _getCurrentPlugin()
    {
        return $this->_plugin;
    }
    
    function AdminUrl($core_url,array $qsData = array(), $isSecure = false)
    {
        return $this->_getCurrentPlugin()->getAdminUrl($core_url, $qsData, $isSecure);
    }
    
    /**
     * Set invocation arguments
     *
     * @param array $args
     * @return absController
     */
    protected function _setInvokeArgs(array $args = array())
    {
        $this->_invokeArgs = $args;
        return $this;
    }
    
     /**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
        // Nothing by default
    }
    


    protected function checkAuth()
    {
        if($this->_auth_needed == true)
        {
            $this->Authenticate();
        }
    }

    /**
     * Return the Request object
     *
     * @return absRequest
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Set the Request object
     *
     * @param absRequest $request
     * @return Action
     */
    public function setRequest(absRequest $request)
    {
        $this->_request = $request;
        return $this;
    }
    
    
    
    public function isAuthNeeded()
    {
        return $this->_auth_needed;
    }
    
    /**
     *
     * @return absDispatcher
     */
    public function Dispatcher()
    {
        return $this->_dispatcher;
    }
    
     /**
     * Set the front controller instance
     *
     * @param clsFrontController $front
     * @return absController
     */
    public function setFrontController(clsFrontController $front)
    {
        $this->_frontController = $front;
        return $this;
    }

   
    
    /**
     * Gets a parameter from the {@link $_request Request object}.  If the
     * parameter does not exist, NULL will be returned.
     *
     * If the parameter does not exist and $default is set, then
     * $default will be returned instead of NULL.
     *
     * @param string $paramName
     * @param mixed $default
     * @return mixed
     */
    protected function _getParam($paramName, $default = null)
    {
        $value = $this->getRequest()->getParam($paramName);
		 if ((null === $value || '' === $value) && (null !== $default)) {
            $value = $default;
        }

        return $value;
    }

    /**
     * Set a parameter in the {@link $_request Request object}.
     *
     * @param string $paramName
     * @param mixed $value
     * @return Action
     */
    protected function _setParam($paramName, $value)
    {
        $this->getRequest()->setParam($paramName, $value);

        return $this;
    }

    /**
     * Determine whether a given parameter exists in the
     * {@link $_request Request object}.
     *
     * @param string $paramName
     * @return boolean
     */
    protected function _hasParam($paramName)
    {
        return null !== $this->getRequest()->getParam($paramName);
    }

    /**
     * Return all parameters in the {@link $_request Request object}
     * as an associative array.
     *
     * @return array
     */
    protected function _getAllParams()
    {
        return $this->getRequest()->getParams();
    }

    public function Template()
    {
        if($this->_template == null)
        {
           $this->_template = new clsTemplate($this->_dispatcher->getViewDirectory());
        }
        
        return $this->_template;
    }

    function Meta()
    {
       return clsTemplate_Meta::instance();
    }
    
    function ViewData($key,$value)
    {
        $this->Template()->$key = $value;
        return $this;
    }
    
    function ViewPart($view_file,array $view_params = array())
    {
        return $this->Template()->View($view_file,$view_params);
    }
   
    /**
     * By Default Renders master view
     * 
     * @param type $view_file
     * @return absController 
     */
    function View($view_file)
    {
        $this->MasterView($view_file);
        return $this;
    }
    
    protected function setResponse($response,$code = null)
    {
        $this->getRequest()->setResponse($response,$code);
        
        return $this;
    }
    
    protected function getResponse()
    {
        return $this->getRequest()->getResponse();
    }
    
    function MasterView($view_file)
    {
        $this->Template()->view = $view_file;
        
        $master_page = '_masterpages' . DS . $this->_master_page;

        $this->setResponse($this->Template()->View($master_page));
        
        return $this;
    }

   
    /**
     * Automatically executed if auth_needed = true. Can be used to do authorization checks, and execute other custom code.
     *
     * @return  void
     */
    public function Authenticate()
    {
        // Nothing by default
    }
   
    /**
     * Automatically executed before the controller action. Can be used to set
     * class properties, do authorization checks, and execute other custom code.
     *
     * @return  void
     */
    public function before()
    {
        // Nothing by default
    }

    /**
     * Automatically executed after the controller action. Can be used to apply
     * transformation to the request response, add extra output, and execute
     * other custom code.
     *
     * @return  void
     */
    public function after()
    {
        // Nothing by default
    }
    
    //default method
    abstract function index();
     
    private $_interceptive_action = '';
    protected function setInterceptiveAction($action)
    {
        if(method_exists($this, $action) == false)
            throw new exp404("Action $action not found");
        
        $this->_interceptive_action = $action;
        return $this;
    }
    
    protected function getInterceptiveAction($current_action)
    {
        if($this->_interceptive_action != '')
                return $this->_interceptive_action;
        else
            return $current_action;
    }
    
    public final function dispatch($action)
    {       
        if ($this->getRequest()->isDispatched()) 
        {
            $this->before();
            
            $action = $this->getInterceptiveAction($action);
 
            if(method_exists($this, $action) == false)
            {
                $action = '';
                //run the action
                if($this->_run_default_method)
                {
                    $action = 'index';
                }
            }
            
            if($action == '')
            {
                throw new exp404("Requested action <strong>'".$this->getRequest()->getAction()."'</strong> doesn't exist.");
            }
              
            $this->$action();
                
            $this->after();
        }
    }
    /**
     * Redirect Helper
     * @param type $url
     */
    public function redirect($url,$code=302)
    {
        WPFuel::redirect($url,$code);
        exit;
    }
    
    /**
     *
     * @param type $message 
     */
    public function success($message)
    {
        clsFlashMessages::Instance()->success($message);
        return $this;
    }
    
    /**
     *
     * @param type $message 
     */
    public function error($message)
    {
        clsFlashMessages::Instance()->error($message);
        return $this;
    }
    
    /**
     *
     * @param type $message 
     */
    public function info($message)
    {
        clsFlashMessages::Instance()->info($message);
        return $this;
    }
    
    /**
     *
     * @param type $message 
     */
    public function attention($message)
    {
        clsFlashMessages::Instance()->attention($message);
        return $this;
    }
    
    /**
     *
     * @param array $response
     * @return absController 
     */
    public function setFlashMessageResponse(array $response)
    {
        clsFlashMessages::Instance()->setFlashMessagebyArray($response);
        
        return $this;
    }
    

    protected function setMasterPage($masterpage)
    {
        $this->_master_page = $masterpage;
        
        return $this;
    }
    
    protected function is_hmvc_request()
    {
        if(isset($this->_invokeArgs['internal']))
                return true;
        return false;
    }
  
    protected function get_hmvc_params($key = null, $default = null)
    {
        $hmvc_params = $this->getRequest()->getParam('invoke_args','');
        if(is_array($hmvc_params))
        {
            if($key != null)
            {
                if(isset($hmvc_params[$key]))
                        return $hmvc_params[$key];
                else
                    return $default;
            }
        }
        return $hmvc_params;
    }
  
    /**
     * Helper method to dispatch sub request by invoking controller
     * @param type $core_url
     * @param array $hmvcParams
     * @return clsHTTP_Response 
     */
    protected function forward($core_url,array $hmvcParams = array())
    {
        return $this->_getCurrentPlugin()->dispatchRequest($core_url,$hmvcParams);
    }
   
}
?>
