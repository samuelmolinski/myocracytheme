<?PHP
/**
 * abstract Validator
 *
 */
abstract class absValidator
{   
    protected $message = array(); 
    
    protected $isEdit = false;   
    
    protected $_data = false;   
    
    public function __construct($data)
    {
        $this->_data = $data;  
        
        $this->Validate();
        
    }
      
    abstract function Validate();
    
    function setMessage($message_string)
    { 
        $this->message[] = $message_string;
    }  
    
    function setMessages($message_array)
    { 
        $this->message = $message_array;
    }  
    
    function getEditMode()
    {
        return $this->isEdit;
    }  
     
    function setEditMode($isEdit=false)
    {
        $this->isEdit = $isEdit;
    }  
    
    function getMessage()
    {
        return $this->message;
    }   
    
    function isValidated()
    {        
        if(count($this->message) > 0)
            return false;
        return true;
    }
    
    private $_validation = null;
    
    function Validation()
    {
        if($this->_validation == null )
        {
            $this->_validation = new clsValidate((array)$this->_data);
        }
        
        return $this->_validation;
    }
}//class ends