<?PHP
/**
 * abstract Form Handler
 */
abstract class absFormHandler extends absActionHandler
{   
    protected $_validator = null;
    
    public function __construct($form_data,absValidator $validator)
    {   
        $this->_validator = $validator; 
        
        parent::__construct($form_data);
    }

    public function getValidator()
    {
        return $this->_validator;
    }  

    protected function isValidated()
    {
       return $this->getValidator()->isValidated();
    }
}//class ends