<?php 
class clsTemplate extends absTemplate 
{    
    static function factory($view_path)
    {
        return new clsTemplate($view_path);
    }
}