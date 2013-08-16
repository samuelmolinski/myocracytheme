<?PHP
class expCore extends Exception 
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
    
    public function ShowError()
    {
        echo $this->getMessage(). "<br />";
        
        $parent_class = get_parent_class($this);
        $current_class = get_class($this);
        
        $current_file = WPFuel::CleanedPrefixFileName($current_class);
        $parent_file = WPFuel::CleanedPrefixFileName($parent_class);
        
        $views_path = dirname(realpath(__FILE__)) . DS . 'views' . DS;
        
        if(file_exists($views_path.$current_file))
        {
            include $views_path.$current_file;
        }
        else if(file_exists($views_path.$parent_file))
        {
            
            include $views_path.$parent_file;
        }
    }
}
?>