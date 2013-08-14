<?PHP
class clsUpload
{
	
    protected $path;

    private $errors = array();
	
    public function doUpload($field,$newname = '',$file_data = null)
    {
        if($file_data == null)
            $file_data = $_FILES;
        
 
        if ( !isset($file_data[$field])){
                $this->setError('No file selected to upload');
                return FALSE;
        }

        // Was the file able to be uploaded? If not, determine the reason why.
        if ( !is_uploaded_file($file_data[$field]['tmp_name']) ){

            $error = ( ! isset($file_data[$field]['error'])) ? 4 : $file_data[$field]['error'];
            $error_message = $this->getUploadError($error);

            $this->setError($error_message);
            return FALSE;
        }
        
        if($newname == '')
        {
            $newname = $this->CleanFileName($file_data[$field]['name']); 
        }
     
        return move_uploaded_file($file_data[$field]['tmp_name'],$this->path.$newname);
    }
    
    function getUploadError($errno){
        $str = '';
        switch($errno){
            case 1:    // UPLOAD_ERR_INI_SIZE
                $str = 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.';
                break;
            case 2: // UPLOAD_ERR_FORM_SIZE
                $str = 'The uploaded file exceeds the maximum size allowed by the submission form.';
                break;
            case 3: // UPLOAD_ERR_PARTIAL
               $str = 'The file was only partially uploaded.';
                break;
            case 4: // UPLOAD_ERR_NO_FILE
               $str = 'The temporary folder is missing.';
                break;
            case 6: // UPLOAD_ERR_NO_TMP_DIR
                $str = 'upload_no_temp_directory';
                break;
            case 7: // UPLOAD_ERR_CANT_WRITE
                $str = 'The file could not be written to disk.';
                break;
            case 8: // UPLOAD_ERR_EXTENSION
                $str = 'The file upload was stopped by extension.';
                break;
            default :  
               $str = 'You did not select a file to upload.';
               break;
        }
        return $str;
    }
	

    public function getError($index = null)
    {		
        if($index == null)
        {
            return $this->errors;
        }
        else if ($index > 0)
        {
            return $this->errors[$index];
        }
    }
    
    public function setError($errormessage){		
        if (is_array($errormessage)){
                foreach ($errormessage as $value){
                        $this->errors[] = $msg;
                }		
        }else{
                $this->errors[] = $errormessage;
        }
    }// setError() ends


    public function displayErrors($open='<p>',$close='</p>'){
        $str = '';
        foreach($this->errors as $value){
                $str .= $open.$value.$close;
        }

        return $str;
    }
	
    public function isValidResumeFile($type)
    {
        $allowed[] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $allowed[] = "application/msword";
        $allowed[] = "application/pdf";
        $allowed[] = "application/x-pdf";
        $allowed[] = "application/rtf";
        $allowed[] = "text/richtext";

        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function isValidDocFile($type){
            $allowed[] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            $allowed[] = "application/msword";

            if(!in_array($type,$allowed)) {
                    return false;
            }else{
                    return true;
            }
    }
	
    public function isValidPdfFile($type){
        $allowed[] = "application/pdf";
        $allowed[] = "application/x-pdf";

        if(!in_array($type,$allowed)) {
                return false;
        }else{
                return true;
        }
    }
	
    public function isValidXlsFile($type){
            $allowed[] = "application/vnd.ms-excel";
            $allowed[] = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

            if(!in_array($type,$allowed)) {
                    return false;
            }else{
                    return true;
            }
    }
	
	
    public function CheckImageType($type,$additional_mime=array())
    {
        $allowed = array('image/gif','image/x-png','image/png','image/jpeg', 'image/pjpeg');
        if(count($additional_mime) > 0 && is_array($additional_mime))
        {
            $allowed = array_merge($allowed,$additional_mime);
        }
        
        if(!in_array($type,$allowed)) {
                return false;
        }else{
                return true;
        }
    }
    
    public function CheckCompressedType($type){
        $allowed[] = "application/zip"; 
        $allowed[] = "application/x-rar-compressed"; 
		$allowed[] = "application/octet-stream";
		 
        if(!in_array($type,$allowed)) {
            return false;
        }else{
            return true;
        }
    }
    
    

    public function CheckCsvType($type){
            $allowed[] = "application/vnd.ms-excel";

            if(!in_array($type,$allowed)) {
                    return false;
            }else{
                    return true;
            }
    }
	
    public function CheckAudioType($type){
            $allowed[] = "audio/x-mp3";
            $allowed[] = "audio/mpeg";

            if(!in_array($type,$allowed)) {
                    return false;
            }else{
                    return true;
            }
    }
	


    public function CheckBannerType($type){
            $allowed[] = "image/gif";
            $allowed[] = "image/jpeg";
            $allowed[] = "image/pjpeg"; 
            //$allowed[] = "image/x-png"; 
            $allowed[] = "application/x-shockwave-flash";

            if(!in_array($type,$allowed)) {
                    return false;
            }else{
                    return true;
            }
    }
	
    public function getExtensionByMime($mime){
            $allowed['image/gif'] = "gif";
            $allowed['image/jpeg'] = "jpg";
            $allowed['image/pjpeg'] = "jpg"; 
            $allowed['image/x-png'] = "png"; 
            $allowed['application/x-shockwave-flash'] = "swf";

            return $allowed[$mime];
    }
	

	
	
    public function CleanFileName($filename){
            $bad = array(
                    "<!--",
                    "-->",
                    "'",
                    "<",
                    ">",
                    '"',
                    '&',
                    '$',
                    '=',
                    ';',
                    '?',
                    '/',
                    "%20",
                    "%22",
                    "%3c",		// <
                    "%253c", 	// <
                    "%3e", 		// >
                    "%0e", 		// >
                    "%28", 		// (
                    "%29", 		// )
                    "%2528", 	// (
                    "%26", 		// &
                    "%24", 		// $
                    "%3f", 		// ?
                    "%3b", 		// ;
                    "%3d"		// =
            );

            foreach ($bad as $val){
                    $filename = str_replace($val, '', $filename);
            }

            $filename = preg_replace("/\s+/", "_", $filename);

            return stripslashes($filename);
    }
	
    function getFileName($filename){
        $data = explode('.', $filename);
        $ext = '.'.end($data);
        
        return $this->CleanFileName(str_replace($ext, '', $filename));
    }	
    
    function getExtension($filename,$returnStandardExtension=true){
            $data = explode('.', $filename);
            if($returnStandardExtension)
                    return '.'.end($data);
            else
                    return end($data);
    }	


    function encryptedFileName($extension){
            mt_srand();
            return md5(uniqid(mt_rand())).$extension; 	
    }

    function uniqueFileName(){
        mt_srand();
        return md5(uniqid(mt_rand().time()));
    }
	
    /*
    @file_size = file size bytes
    @limit = 1,2,3,4,5 MB
    */
    function check_size($file_size,$limit){
        if($this->bytes_to_mb($file_size) > $limit){
                return false;
        }else{
                return true;
        }
    }

    function bytes_to_mb($bytes){
        return intval(($bytes/1024)/1024);
    }

    function setPath($path){
        $this->path = $path;
        
        return $this;
    }
}