<?PHP
/**
 * WordPress Fuel - Abstract Plugin Class
 * 
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
abstract class absMVC_Plugin
{
    private function __clone(){}
    
    /**
     * Must be a word without any special characters
     * Unique Slug
     * @var (string)
     */
    protected $_plugin_slug = '';
    
    /**
     * Plugin File
     * @var (string) 
     */
    protected $_plugin_file = null;
    
    /**
     * Plugin Directory
     * @var (string) 
     */
    protected $_plugin_path = null;
    
     /**
     * Plugin URL
     * @var (string) 
     */
    protected $_plugin_url = null;
    
    /**
     * Path to MVC components
     * Controllers, Views, Models, Helpers etc
     * @var (string) 
     */
    protected $_mvc_path = null;
    
    /**
     * Collection of Shortcodes registered using WP Fuel Plugin
     * @var (array) 
     */
    private $_short_codes = array();
    
    /**
     * Collection of Reqrite ruels registered using WP Fuel Plugin
     * @var (array) 
     */
    private $_rewrite_rules = array();
    
    public function __construct($plugin_file, $mvc_folder = null) 
    { 
        $this->_plugin_file = $plugin_file;
        $this->_plugin_path = plugin_dir_path($plugin_file);
        $this->_plugin_url = plugin_dir_url($plugin_file);
        
        
        $this->_mvc_path = $this->_plugin_path . "mvc" . DIRECTORY_SEPARATOR;
        if($mvc_folder != null && $mvc_folder != '')
        {
            if(is_dir($this->_plugin_path . $mvc_folder))
            {
                $this->_mvc_path = $this->_plugin_path . $mvc_folder . DIRECTORY_SEPARATOR;
            }
        }
        
        if(is_dir($this->_mvc_path) == false)
        {
            throw new expCore("".get_class($this)." MVC directory not found.");
        }
        
        if(empty($this->_plugin_slug))
        {
            throw new expCore("".get_class($this)." - Plugin slug not set.");
        }
        
        $controllerPath =  $this->_mvc_path . "controls" . DIRECTORY_SEPARATOR;
        $viewsPath =  $this->_mvc_path . "views" . DIRECTORY_SEPARATOR;
            
        clsFrontController::getInstance($this->_plugin_slug)
            ->setPlugin($this)
                ->setControllerDirectory($controllerPath)
                     ->setViewDirectory($viewsPath);
        
        $this->init();
    }
    
    /**
     * Load config file within a plugin.
     * @param (string) $config_file_name
     * @return (array) 
     */
    function LoadConfig($config_name)
    {
        $path = $this->_mvc_path . 'config' . DIRECTORY_SEPARATOR;
        return WPFuel::LoadConfig($config_name, false, $path);
    }

    /**
     * Disptaches the requests and return the response from dispatcher (absDispatcher)
     * Helper method to dispatch request
     * @param string $core_url
     * @param array $invokeParams
     * @return clsHTTP_Response
     */
    function dispatchRequest($core_url,array $invokeParams = array())
    {
        /* Automatically appends plugin slug */
        if($core_url != '')
        {
            $core_url = $this->_plugin_slug . '_' . $core_url;
        }

        // to verify if the request was internal or direct
        $invokeParams['internal'] = true; 

        $request = clsRequest::factory($core_url);
        $request->setParam('core_url',$core_url);
        $request->setParam('invoke_args',$invokeParams);
        $request->setParam('internal',true);
        
        try
        {
            return $this->getFrontController()
            ->resetFilters()
            ->setParams($invokeParams)
            ->execute($request)->HttpResponse();
        }
        catch(Exception $ex)
        {
            ob_clean();
            echo json_encode(array('code' => 0, 'status' => 0, 'message' => $ex->getMessage()));
            exit;
        }

    }
   
    private function init()
    {
        $oLoader = new clsPlugin_Autoload($this->_mvc_path);
        $oLoader->registerAutoLoad();
        
        register_activation_hook( $this->_plugin_file, array($this, 'activate'));
        register_deactivation_hook( $this->_plugin_file, array($this, 'deactivate'));
        
        $this->add_ajax_action("CoreMVCAjaxRequest", "handleAjaxRequest");
        
        $this->_initAjax();
        $this->_init();
        
        
        if(is_admin())
        {
            $this->add_action('admin_menu', 'registerAdminMenu');
            $this->add_action('admin_init', 'initAdmin');
            $this->add_action('admin_init', 'admin_assets');
        }
        else
        {
            
            $this->add_action('wp_head', 'init_js');
            $this->add_action('wp_enqueue_scripts', 'front_assets');
            $this->add_action('init', 'rewrite_rules');
            $this->initFront();
        }
    }
    
    
    /**
     * Wrapper method to add actions using WordPress. 
     * Returns 'absMVC_Plugin' for method chaining.
     * 
     * @param type $action
     * @param type $function
     * @param type $priority
     * @param type $accepted_args
     * @return absMVC_Plugin 
     */
    protected function add_action( $action, $function = '', $priority = 10, $accepted_args = 1 ) 
    {
        add_action( $action, array($this, $function ), $priority, $accepted_args );
        
        return $this;
    }
    
     /**
     * Wrapper method to add actions using WordPress. 
     * Returns 'absMVC_Plugin' for method chaining.
     *
     * @param type $action
     * @param type $function
     * @param type $priority
     * @param type $accepted_args
     * @return absMVC_Plugin 
     */
    protected function add_ajax_action( $action, $function = '', $priority = 10, $accepted_args = 1 ) 
    {
        $this->add_action( 'wp_ajax_' . $action,  $function, $priority, $accepted_args );
        $this->add_action( 'wp_ajax_nopriv_' . $action, $function , $priority, $accepted_args );
        return $this;
    }

    
    /**
     * Wrapper method to add filters using WordPress. 
     * Returns 'absMVC_Plugin' for method chaining.
     *
     * @param type $filter
     * @param type $function
     * @param type $priority
     * @param type $accepted_args
     * @return absMVC_Plugin 
     */
    protected function add_filter( $filter, $function, $priority = 10, $accepted_args = 1 ) 
    {
        add_filter( $filter, array($this, $function ), $priority, $accepted_args );
        
        return $this;
    }
    
     /**
     * Wrapper method to add short code using WordPress. 
     * Instantiate absMVC_Shortcode class and registers short code
     * Returns 'absMVC_Plugin' for method chaining.
     *
     * @param type $shortcode
     * @param type $function
     * @return absMVC_Plugin 
     */
    protected function add_shortcode($shortcode,  $shortCodeHandlerClass , $method) 
    {
        $this->_short_codes[] = array('code' => $shortcode,'class' => $shortCodeHandlerClass , 'func' => $method);
        
        $oShortCodeHandler = new $shortCodeHandlerClass($this);
        add_shortcode($shortcode, array($oShortCodeHandler,$method));

 
        return $this;
    }
    
    public function getShortCodes()
    {
        $this->_short_codes;
    }
    
    function init_js()
    {
        if(defined('CORE_AJAX_INIT'))
        {
            return;
        }
        ?>	
        <script>
            var core_ajx_url = '<?php echo get_option('siteurl') . '/wp-admin/admin-ajax.php' ?>';
        </script>
        <?php
        define('CORE_AJAX_INIT',1);
    }
    
    /**
    * Method register admin assets
    * JS, CSS assets etc
    */
    public function admin_assets()
    {
        
    }
    
   /**
    * Method register front assets
    * 'wp_enqueue_scripts' action invokes this method 
    * Available at front-end only
    * JS, CSS assets etc
    */
    public function front_assets()
    {
        
    }

    /** 
    * Method to execute any code to initialize the plugin functionality
    */
    protected abstract function _init();

    /**
    * Method to execute global intilialize code.
    * Place any AJAX initialization code here
    */
    protected function _initAjax(){}
    
    /**
    * Initialize any back-end related code for this plugin
    */
    public function initAdmin(){}
    

    /**
     * Registers admin 
     */
    public function registerAdminMenu(){}
    
    /**
    * Initialize any front-end related code for this plugin
    * Example: You can register shortcodes etc
    */
    public function initFront(){}
   
    /**
     * Place your plugin's activation logic here
     */
    protected function _activate(){}
    
     /**
     * Place your plugin's deactivation logic here
     */
    protected function _deactivate(){}
    
    /**
     * Method to add reqrite rules
     */
    protected function _init_rewrite_rules(){}
    
    /**
     * Generic implementation to execute admin MVC workflow.
     * Handles Admin Request
     * @uses clsFrontController
     */
    public function handleAdminMenu()
    {
        $core_url = WPFuelCoreHelper::assembleAdminMenuUri($this->_plugin_file);
        
        try
        {
            $this->getFrontController()->setCoreUri($core_url)
                ->execute()->getOutput();  
            
            if($this->getFrontController()->getInitialRequest()->isException())
            {
                $exception = $this->getFrontController()->getInitialRequest()->getException();
               
                echo WPFuel::get_exception_trace($exception);
                exit;
            }
        }
        catch(Exception $ex)
        {
            echo WPFuel::get_exception_trace($ex);
            exit;
        }
        
        
    }

    /**
     * Generic implementation to execute AJAX requests.
     * Handles AJAX Request
     * @uses clsFrontController
     */
    public function handleAjaxRequest()
    {
        $this->dispatchRequest(WPFuelCoreHelper::assembleAjaxUri());
    }
    
   
    /**
     * WP Action to register rewrite rules
     */
    function rewrite_rules() 
    {
        add_rewrite_tag('%wpfuelmvc_uri%','([^/]+)');
        add_rewrite_tag('%wpfuelmvc_plugin_slug%','([[^/]]+)');

        $this->_init_rewrite_rules();
        
        if(count($this->_rewrite_rules))
        {
            $this->add_action( 'template_redirect', 'handleRewriteRequest');
            
            $rewrite_rules_key = $this->getRewriteRulesOptionsKey();
            $rewrite_rules = get_option($rewrite_rules_key);

            if(is_array($rewrite_rules))
            {
                $rewrite_option_keys = array_keys($rewrite_rules);
                $current_rewrite_rules_keys = array_keys($this->_rewrite_rules);
                $result_rewrite_diff = array_diff($rewrite_option_keys, $current_rewrite_rules_keys);

                if(count($result_rewrite_diff))
                {
                    update_option($rewrite_rules_key,$this->_rewrite_rules);
                    flush_rewrite_rules();
                }
            }
        }
        
        
    }
    
    /**
     * Registers a rewrite rule
     * @param type $regex
     * @param type $pagename
     * @return absMVC_Plugin 
     */
    protected function register_rewrite_rule($regex,$pagename)
    {
        $rewrite_pointer = 'index.php?pagename='.$pagename.'&wpfuelmvc_plugin_slug='.$this->_plugin_slug.'&wpfuelmvc_uri=$matches[1]';
        
        $this->_rewrite_rules[md5($regex)] = array('pointer' => $rewrite_pointer, 'pattern' => $regex);
        
        add_rewrite_rule($regex, $rewrite_pointer,'top');
        
        return $this;
    }

    /**
     * Generic implementation to WordPress rewrite requests
     * Handles rewrite request
     * @uses clsFrontController
     */
    public function handleRewriteRequest()
    {
        $plugin_slug = get_query_var('wpfuelmvc_plugin_slug');

        if($plugin_slug == $this->_plugin_slug)
        {
            $wpfuelmvc_uri = get_query_var('wpfuelmvc_uri');
            
            if($wpfuelmvc_uri != '')
            {
                $wpfuelmvc_uri = $this->_plugin_slug.'_'.$wpfuelmvc_uri;
                
                status_header(200);
                
                try
                {
                    $this->getFrontController()
                        ->setCoreUri($wpfuelmvc_uri)
                        ->execute()->getOutput();  
                    
                    if($this->getFrontController()->getRequest()->isException())
                    {
                        $this->_handleExceptionGracefully($this->getFrontController()->getRequest()->getException());
                    }

                }
                catch(Exception $ex)
                {
                     $this->_handleExceptionGracefully($ex);
                }
                

                exit;
            }
        }
        
        return;
    }
    
    protected function _handleExceptionGracefully(Exception $exception)
    {
        if($exception instanceof exp404)
        {
             status_header(404);
             $this->getFrontController()->show_WP_404();
             exit;
        }
        else
        {
            status_header(500);
            nocache_headers();
            echo WPFuel::get_exception_trace($exception);
            exit;
        }
    }
    
    private function _checkMVCBootstrap()
    {
        $wpfuel_loader = WP_PLUGIN_DIR . "/share-social/cunjo_core/load.php";
        
        if ( ! file_exists( $wpfuel_loader ) ) {
            deactivate_plugins( $this->_plugin_file);
            wp_die( __('WPFuelBootstrapCheck: '.  get_class($this).' requires Cunjo Core. Seems like Cunjo Core is either missing or not yet installed.'));
        }
    }
    
    protected function getRewriteRulesOptionsKey()
    {
         return md5($this->_plugin_file).'_rewrite_rules';
    }
    
    public function activate()
    {
        $this->_checkMVCBootstrap();

        require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

        //if ( is_plugin_active( 'wpfuel/wpfuel.php' ) )
        //{
            require_once ( WP_PLUGIN_DIR . '/share-social/cunjo_core/wpfuel.php' );
            
            $this->_activate();
            
            if(count($this->_rewrite_rules) > 0)
            {
                $rewrite_rules_key = $this->getRewriteRulesOptionsKey();
                $rewrite_rules = get_option($rewrite_rules_key);
                
                if(is_array($rewrite_rules) == false)
                {
                    $response = update_option($rewrite_rules_key,$this->_rewrite_rules);
                }
            }
        //}
        //else
        //{   
        //    deactivate_plugins( $this->_plugin_file);
        //    exit ( __('Activation error: '.  get_class($this).' requires WordPress Fuel framework.'));
        //}
       
    }
    
    public function deactivate()
    {
        $this->_deactivate();
        
        if(count($this->_rewrite_rules) > 0)
        {
            delete_option($this->getRewriteRulesOptionsKey());
        }
    }
    
    /**
     * Prepares full wp-admin link keeping the base link intact.
     * 
     * @param string $core_url
     * @param array $qsData
     * @param type $isSecure
     * @return (string)
     */
    function getAdminUrl($core_url,array $qsData = array(), $isSecure = false)
    {
        /* Automatically append plugin slug */
        if($core_url != '')
        {
            $core_url = $this->_plugin_slug . '_' . $core_url;
        }
        
        return WPFuel::admin_url($core_url, $qsData, $isSecure);
    }
    
     
     
    /**
     * Plugin Slug
     * @return (string) 
     */
    function getSlug()
    {
        return $this->_plugin_slug;
    }
    
    /**
     * Plugin MVC Directiry Path
     * @return (string) 
     */
    function getMVCPath()
    {
        return $this->_mvc_path;
    }
    /**
     * Plugin Directory
     * @return (string) 
     */
    function getPluginPath()
    {
        return $this->_plugin_path;
    }
    
    /**
     * Plugin URL
     * @return (string) 
     */
    function getPluginUrl()
    {
        return $this->_plugin_url;
    }
    
    
    /**
     * Plugin File
     * @return (string) 
     */
    function getPluginFile()
    {
        return $this->_plugin_file;
    }
    
    
    /**
     * Get Front conroller Object
     * @return (clsFrontController)
     */
    function getFrontController()
    {
        return clsFrontController::getInstance($this->_plugin_slug);
    }
    
    /**
    * Prepares Admin Menu Slug. Plugin slug will be automatically prepended to maintain plugin uniqueness
    * @param type $slug
    * @return string 
    * @outputs: [plugin_slug]_$slug
    */
    protected function _getAdminPageSlug($slug)
    {
        $_slug = '';
        if($slug != "")
        {
            $_slug = $this->_plugin_slug . '_' . $slug;
        }
        
        return $_slug;
    }
}
?>