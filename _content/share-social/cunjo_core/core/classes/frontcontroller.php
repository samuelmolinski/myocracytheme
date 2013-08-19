<?PHP defined('_WP_FUEL_MVC') or die('No direct script access.');
/**
 * WordPress Fuel - Front Controller 
 * 
 * Executes the request by calling the Router class that maps the router parameters (controller, action etc) into the request object. 
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
class clsFrontController
{
    
    /**
     *
     * @var clsFilterManager 
     */
    private $_filter_manager = null;
    
     /**
     * Base URL
     * @var string
     */
    protected $_baseUrl = null;
    
    /**
     * Instance of absRequest
     * @var absRequest
     */
    protected $_request = null;
    
    /**
     * Instance of absRouter
     * @var absRouter
     */
    protected $_router = null;
    
     /**
     * Singleton instance
     * @var clsFrontController
     */
    protected static $_instance = null;
    
    /**
     * Instance of absDispatcher
     * @var absDispatcher
     */
    private $_dispatcher = null;
    
    /**
     * Instance of absMVC_Plugin
     * @var absMVC_Plugin
     */
    private $_plugin = null;
    
    /**
     * Array of invocation parameters to use when instantiating action
     * controllers
     * @var array
     */
    protected $_invokeParams = array();
    
     /**
     *
     * @var output 
     */
    private $_output = null;
    
     /**
     * Instance of Exception
     * @var last_exception
     */
    protected $_last_exception = null;
    
    public function setLastException(Exception $ex)
    {
        $this->_last_exception = $ex;
        
        return $this;
    }
    
    public function getLastException()
    {
        return $this->_last_exception ;
    }
    
     /**
     * Instance of Exception
     * @var last_exception
     */
    protected $_outputParams = array('headers');
    
    public function setOutputParams(array $params)
    {
        $this->_outputParams = $params;
        
        return $this;
    }
    
    public function getOutputParams()
    {
        return $this->_outputParams ;
    }
    
    /**
     * Enforce singleton; disallow cloning
     *
     * @return void
     */
    private function __clone(){}
    
    private $_initial_request = array();
    private $_initial_router = array();
    
    private function __construct() 
    {
        $this->_filter_manager = clsMVC_Filter_Manager::getInstance();
        $this->_initial_request = clsRequest::instance();
        
        $this->_initial_router = new clsRouter_Core();
        $this->_initial_router->setRequest($this->_initial_request);
    }
    
    public function getInitialRequest()
    {
        return $this->_initial_request;
    }
    
    public function getInitialRouter()
    {
        return $this->_initial_router;
    }

     /**
     * Singleton instance
     *
     * @return clsFrontController
     */
    public static function getInstance($plugin_slug = '')
    {
        if(isset(self::$_instance["".$plugin_slug.""]) == false)
        {
            self::$_instance["".$plugin_slug.""] = new self();
        }

        return self::$_instance["".$plugin_slug.""];
    }
    
    /**
     * Helper method to set Core Url
     * @param type $core_url
     * @return clsFrontController 
     */
    public function setCoreUri($core_url)
    {
        $this->getRequest()->setParam('core_url', $core_url);
        return $this;
    }
    
    
    /**
     * Add or modify a parameter to use when instantiating an action controller
     *
     * @param string $name
     * @param mixed $value
     * @return clsFrontController
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
     * @return clsFrontController
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
     * Clear the controller parameter stack
     *
     * By default, clears all parameters. If a parameter name is given, clears
     * only that parameter; if an array of parameter names is provided, clears
     * each.
     *
     * @param null|string|array single key or array of keys for params to clear
     * @return clsFrontController
     */
    public function clearParams($name = null)
    {
        if (null === $name) {
            $this->_invokeParams = array();
        } elseif (is_string($name) && isset($this->_invokeParams[$name])) {
            unset($this->_invokeParams[$name]);
        } elseif (is_array($name)) {
            foreach ($name as $key) {
                if (is_string($key) && isset($this->_invokeParams[$key])) {
                    unset($this->_invokeParams[$key]);
                }
            }
        }

        return $this;
    }

    
     /**
     * Add a controller directory to the controller directory stack
     *
     * If $args is presented and is a string, uses it for the array key mapping
     * to the directory specified.
     *
     * @param string $directory
     * @return clsFrontController
     */
    public function setControllerDirectory($directory)
    {
        $this->getDispatcher()->setControllerDirectory($directory);
        return $this;
    }

    public function setViewDirectory($directory)
    {
        $this->getDispatcher()->setViewDirectory($directory);
        return $this;
    }

    public function setDefaultController($controller)
    {
        $this->getDispatcher()->setDefaultController($controller);
        return $this;
    }
    
    public function getDispatcher()
    {
        /**
        * Instantiate the default dispatcher if one was not set.
        */
        if ($this->_dispatcher == null) {
            $this->_dispatcher = new clsDispatcher_Core($this);
        }
        
        return $this->_dispatcher;
    }
    
    /**
     * Set request class/object
     *
     * Set the request object.  The request holds the request environment.
     * @return clsFrontController
     */
    public function setRequest($request)
    {
        $this->_request = $request;

        return $this;
    }
    
     /**
     * Return the request object.
     *
     * @return null|absRequest
     */
    public function getRequest()
    {
        if($this->_request == null)
        { 
            $this->_request = $this->_initial_request;
        }
        
        return $this->_request;
    }
    
    /**
     * Set absMVC_Plugin object
     *
     * Set the plugin object. 
     * @return clsFrontController
     */
    public function setPlugin(absMVC_Plugin $plugin)
    {
        $this->_plugin = $plugin;

        return $this;
    }
    
     /**
     * Return the plugin object.
     *
     * @return absMVC_Plugin
     */
    public function getPlugin()
    {
        return $this->_plugin;
    }
    
    /**
     * Set the base URL used for requests
     *
     * Use to set the base URL segment of the REQUEST_URI to use when
     * determining PATH_INFO, etc. Examples:
     * - /admin
     * - /myapp
     * - /subdir/index.php
     *
     * Note that the URL should not include the full URI. Do not use:
     * - http://example.com/admin
     * - http://example.com/myapp
     * - http://example.com/subdir/index.php
     *
     * If a null value is passed, this can be used as well for autodiscovery (default).
     *
     * @param string $base
     * @return clsFrontController
     */
    public function setBaseUrl($base = null)
    {
        $this->_baseUrl = $base;

        if ((null !== ($request = $this->getRequest())) && (method_exists($request, 'setBaseUrl'))) {
            $request->setBaseUrl($base);
        }

        return $this;
    }

    
    /**
     * Retrieve the currently set base URL
     *
     * @return string
     */
    public function getBaseUrl()
    {
        $request = $this->getRequest();
     
        if ((null !== $request) && method_exists($request, 'getBaseUrl')) {

            return $request->getBaseUrl();
        }

        return $this->_baseUrl;
    }
    
     /**
     * Set router class/object
     *
     * Set the router object.  The router is responsible for mapping
     * the request to a controller and action.
     *
     * @param string|absRequest $router
     * @throws expCore if invalid router class
     * @return clsFrontController
     */
    public function setRouter($router)
    {
        if (!$router instanceof absRouter) {
            throw new expCore('Invalid router class');
        }

        $router->setRequest($this->getRequest());
        $this->_router = $router;

        return $this;
    }

    /**
     * Return the router object.
     *
     * Instantiates a clsCoreUrlRouter object if no router currently set.
     *
     * @return absRouter
     */
    public function getRouter(absRequest $request = null)
    {
        if (null == $this->_router) {
            $this->_router = $this->_initial_router;
        }
        
        if($request == null)
            $request = $this->getRequest();
        
  
        $this->_router->setRequest($request);
        

        return $this->_router;
    }
    
     /**
     *
     * @param absFilter $filter
     * @param type $stackIndex
     * @return clsFrontController 
     */
    public function AddFilter(absFilter $filter, $stackIndex = null)
    {
        $this->_filter_manager->registerFilter($filter,$stackIndex);
        
         return $this;
    }
    
    /**
     * Reset Filters
     * 
     * @return clsFrontController 
     */
    public function resetFilters()
    {
        $this->_filter_manager->resetFilters();
        
        return $this;
    }
    
    /**
     * Unregister a plugin.
     *
     * @param  string|absFilter $filter Filter class or object to unregister
     * @return clsFrontController
     */
    public function removeFilter($filter)
    {
        $this->_filter_manager->unregisterFilter($filter);
        return $this;
    }
    
    /**
     * Is a particular filter registered?
     *
     * @param  string $class
     * @return bool
     */
    public function hasFilter($class)
    {
        return $this->_filter_manager->hasFilter($class);
    }
    
    /**
     * Retrieve a filter or filters by class
     *
     * @param  string $class
     * @return false|absFilter|array
     */
    public function getFilter($class)
    {
        return $this->_filter_manager->getFilter($class);
    }

    /**
     * Retrieve all plugins
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->_filter_manager->getFilters();
    }
    
    public function Response(absRequest $request)
    {
        return $request->getResponse();
    }
    
    /**
     *
     * @return clsHTTP_Response 
     */
    public function HttpResponse()
    {
        return $this->_request->getHttpResponse();
    }
    
    public function execute(absRequest $request = null)
    {
        /**
         * Instantiate default request object if none provided
         */
        if (null !== $request) {
            $this->setRequest($request);
        }
        
        $this->_request = $this->getRequest();
    
        /**
         * Set base URL of request object, if available
         */
        if (is_callable(array($this->_request, 'setBaseUrl'))) {
            if (null !== $this->_baseUrl) {
                $this->_request->setBaseUrl($this->_baseUrl);
            }
        }

        /**
        * Register request  object with filter manager
        */
        $this->_filter_manager->setRequest($this->_request);
        
        
        
        $this->_filter_manager->BeforeExecution($this->_request); 
   
        
            $router = $this->getRouter($this->_request);

            /**
            * Notify filter - Routing Starts
            */
            $this->_filter_manager->onRoutingStart($this->_request);
            
                //Map the routes
                $router->map();
                /**
            * Notify filter - Routing Ends
            */
            $this->_filter_manager->onRoutingEnds($this->_request);
        
            
            /**
            * Notify filter  - Dispatch Starts
            */
            $this->_filter_manager->preDispatch($this->_request);
            
        
                //Dispatch Request
                $this->getDispatcher()->setParams($this->getParams())
                        ->dispatch($this->_request);
        
            /**
            * Notify filter  - Dispatch ends
            */
            $this->_filter_manager->postDispatch($this->_request);
        
        $this->_filter_manager->AfterExecution($this->_request); 

        
        return $this;
    }
    
    function getCurrentController()
    {
        return $this->getInitialRequest()->getController();
    }
    
    function getCurrentAction()
    {
        return $this->getInitialRequest()->getAction();
    }
    
    function getOutput()
    {
        echo $this->_initial_request->getHttpResponse();
    }
    
    function show_WP_404() 
    {
        status_header(404);
        nocache_headers();
        include( get_404_template() );
        
        exit;
    }
}