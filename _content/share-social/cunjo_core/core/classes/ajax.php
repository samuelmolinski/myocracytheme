<?PHP
defined('_WP_FUEL_MVC') or die('No direct script access.');

/**
 * Ajax Response Generator
 */
class clsAjax  
{
    private static $_instance = null;
    
    public static function Instance()
    {
        if(self::$_instance === null)
        {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
    private function __construct(){}
    
    const CONNECTION_FAILED = "CONNECTION_FAILED";
    const SUCCESS_CODE = "SUCCESS";
    const ERROR_CODE = "ERROR";
    
    private $_data = array();
    
    function setResponse($code,$responseTxt)
    {
        $this->_data['code'] = $code;
        $this->_data['ice_response'] = $responseTxt;
    
        return $this;
    }
    
    /**
    * Helper method
    * 
    * @param mixed $message
    */
    function setErrorResponse($message)
    {
        $this->setResponse(self::ERROR_CODE,$this->getFormattedArray($message,'error'));
    }
    
    /**
    * Helper method
    * 
    * @param mixed $message
    */
    function setSuccessResponse($message)
    {
        $this->setResponse(self::SUCCESS_CODE,$this->getFormattedArray($message,'success'));
    }
    
    private function getFormattedArray($data_str,$key)
    {
        $data = array();
        $data[$key] = (array)$data_str;
        return $data;
    }
    
    public function renderJSONResponse($response_code=0)
    {
        echo self::JSONResponse($this->_data,$response_code);
        exit;
    } 
    
    public static function JSONResponse($data,$response_code=0)
    {
        if($response_code > 0)
        {
            header('content-type: application/json',false,$response_code); 
        } 
        else
        {
            header('content-type: application/json');
        }
        
        echo json_encode($data);
        exit;
    } 
}