<?PHP
/**
 * abstract Action Handler
 */
abstract class absActionHandler
{   
    protected $_data = array();
    protected $_model = null;
    protected $_response = array();
    
    protected $_objData = array();
    
    protected $_id = null;
    protected $_code = null;
    
    public function getObjecData($key = null)
    {
        if($key == null)
            return $this->_objData;
        
        return $this->_objData[$key];
    }  

    protected function setObjecData($data)
    {
        $this->_objData = $data;
    }  
    
    public function __construct($form_data)
    {
        $this->_data = $form_data;        
    }


    public function getData($key = null)
    {
        if($key == null)
            return $this->_data;
        
        return $this->_data[$key];
    }  
    
    public function getResponse()
    {
        return $this->_response;
    }  
    
    public function setModel(absModel $model)
    {
        $this->_model = $model;
        return $this;
    }
    
    public function getModel()
    {
        return $this->_model;
    }

    abstract function _handle();
    
    function Handle()
    {
        $this->_handle();
        
        return $this; 
    }
    
    public function SaveAndGetResponse(array $data, $table = '', $pk_column= '')
    {
        $_pk_column = $this->getModel()->getPrimaryKey($pk_column);

        $this->_id = $this->_model->Save($data, $table, $_pk_column);
        $this->_code = ($this->_id > 0) ? WPFuel::SUCCESS : WPFuel::ERROR;

        return clsMessages::setResponse($this->_code, $this->_model->getMessage());  
    }
    
    public function getCode()
    {
        return $this->_code;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
}//class ends