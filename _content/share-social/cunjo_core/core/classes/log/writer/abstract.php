<?PHP
abstract class clsLog_Writer_Abstract extends absBase
{
    
    /**
     * Write an array of messages.
     *
     *     $writer->write($messages);
     *
     * @param   array  messages
     * @return  void
     */
    abstract public function write(array $messages);
    
    
    /**
     * Allows the writer to have a unique key when stored.
     *
     *     echo $writer;
     *
     * @return  string
     */
    final public function __toString()
    {
        return spl_object_hash($this);
    }
    
    
    protected function _format($message)
    {
        $body = $message['body'];
        if(!(is_string($body))) {
            $body = str_replace("\n", '', var_export($body, true));
        }
        
        $body .= 'IP: '.WPFuel::get_ip().' ';
        $body .= 'uri: '.$_SERVER['REQUEST_URI']." ";
        $body .= 'referrer: "'.  clsRequest::instance()->getReferrer().'" ';
        $body .= 'agent: "'.  clsRequest::instance()->getUserAgent().'" ';
        $body .= 'cookie: "'.str_replace("\n", '', var_export($_COOKIE, true)).'" ';

        $message['body'] = $body;
        
        return $message;
    }
}
?>