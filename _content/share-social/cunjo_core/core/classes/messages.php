<?PHP    
class clsMessages
{
    static function setResponse($type,$message)
    {
        $response = array();
        $response['type'] = $type;
        $response['message'] = $message;
        
        return $response;
    }                       
}//class ends