<?php 
/**
 * WordPress Fuel - Global Error and Exception Handler
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
class clsMVC_Error_Handler
{
    private static $_instance = null;
    public static function getInstance()
    {
        if(self::$_instance == null)
        {
            self::$_instance = new clsMVC_Error_Handler();
        }
        
        return self::$_instance;
    }
    
    private function __construct() {}
    private function __clone() {}
    
    /**
     * (array) types of errors to handle on shutdown 
     */
    public static $shutdown_errors = array(E_PARSE, E_ERROR, E_USER_ERROR, E_COMPILE_ERROR, E_WARNING);
    
    public static $error_codes = array(E_PARSE => 500, E_ERROR => 500, E_USER_ERROR => 500, E_COMPILE_ERROR => 500, E_WARNING => 500);
    
    public function register()
    {
        set_error_handler(array($this,'error'));
        set_exception_handler(array($this,'exception'));
        register_shutdown_function(array($this,'shutdown'));
    }
    
    
    /**
     * Catches errors that are not caught by the error handler, such as E_PARSE.
     *
     * @uses    exception_handler
     * @return  void
     */
    public function shutdown()
    {
        $error = error_get_last();
  
        if($error['type'] != '')
        {
            // Fake an exception for nice debugging
            $this->exception(new ErrorException($error['message'], $error['type'], 0, $error['file'], $error['line']));

            // Shutdown now to avoid a "death loop"
            exit(1);
        }
    }

    public function error($code, $error, $file = NULL, $line = NULL)
    {
        if (in_array($code, self::$shutdown_errors) && $code && error_reporting())
        {
            $this->exception(new ErrorException($error, $code, 0, $file, $line));   
        }
        // Do not execute the PHP error handler
        return TRUE;
    }

    public function exception(Exception $e) 
    {    
        ob_clean();
        
        try 
        {
            $code = $e->getCode();
            $status_code = isset(self::$error_codes[$code]) ? self::$error_codes[$code]: 503;
     
            if(($e instanceof exp404))
            {
                $status_code = 404;
                clsFrontController::getInstance()->show_WP_404();
            }
            
             status_header($status_code);
             
            if(isset($code))
            {
                if (in_array($code, self::$shutdown_errors))
                {
                    $this->_showCustomErrorPage($e,$status_code);
                }
            }
        }
        catch(Exception $ex)
        {
            $this->_showCustomErrorPage($ex,$status_code);
        }
        
    }
    
    private function _showCustomErrorPage($ex,$status_code)
    {
        status_header($status_code);
         
        echo clsTemplate::factory(CORE_VIEWS_PATH)->View('error_template',array('exception' => $ex));
        exit;
    }

}
