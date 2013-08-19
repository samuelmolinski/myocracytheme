<?php
class clsException
{
    /**
     * Get a single line of text representing the exception:
     *
     * Error [ Code ]: Message ~ File [ Line ]
     *
     * @param   object  Exception
     * @return  string
     */
    public static function toText(Exception $e)
    {
        return sprintf('%s [ %s ]: %s ~ %s [ %d ] ',
            get_class($e), $e->getCode(), strip_tags($e->getMessage()), $e->getFile(), $e->getLine());
    }
    
    public static function getBackTrace(Exception $e)
    {
        $code  = $e->getCode();
        $trace = $e->getTrace();
         
         if ($e instanceof ErrorException)
         {
                if (isset(WPFuel::$php_errors[$code]))
                {
                    // Use the human-readable error name
                    $code = WPFuel::$php_errors[$code];
                }                           

                if (version_compare(PHP_VERSION, '5.3', '<'))
                {
                    // Workaround for a bug in ErrorException::getTrace() that exists in
                    // all PHP 5.2 versions. @see http://bugs.php.net/bug.php?id=45895
                    for ($i = count($trace) - 1; $i > 0; --$i)
                    {
                        if (isset($trace[$i - 1]['args']))
                        {
                            // Re-position the args
                            $trace[$i]['args'] = $trace[$i - 1]['args'];

                            // Remove the args
                            unset($trace[$i - 1]['args']);
                        }
                    }
                }   
         }
        
        return $trace;
    }
}

?>