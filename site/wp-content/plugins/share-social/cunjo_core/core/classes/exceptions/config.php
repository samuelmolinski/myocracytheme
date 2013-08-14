<?PHP
class expConfig extends Exception 
{
    //__construct ([ string $message = "" [, int $code = 0 [, Exception $previous = NULL ]]] )
    public function __construct($message,$code=E_ERROR,Exception $previous = NULL)
    {
        if(is_object($previous))
        {
            parent::__construct($message,$code,$previous);  
        }
        else
        {
            parent::__construct($message,$code);  
        }
    }
}
?>