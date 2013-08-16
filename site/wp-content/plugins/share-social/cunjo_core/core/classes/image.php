<?PHP
/**
 * WordPress Fuel - GD Image Class
 * 
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
class clsImage extends clsUpload 
{
    private $imgSrc;

    function __construct($path='')
    {
        $this->path = $path;
    }
    
    function getDimensions($filename){
  
        $extension =  strtolower($this->getExtension($filename,false)); // false - to get "jpg" NOT ".jpg" GOT IT :P
        
        $img = $this->getImage($extension,$filename);
 
        $array = '';
        if ($img) {
                $array['w'] = imagesx($img);
                $array['h'] = imagesy($img);
                @imagedestroy($img);
        }
        return $array;
    }

    private function getSizeByFixedWidth($newWidth,$h,$w)
    {
        $ratio = $h / $w;
        $newHeight = $newWidth * $ratio;

        return $newHeight;
    }

    private function getSizeByFixedWidthDimension($newWidth,$w,$h)
    {
        $optimalWidth = $newWidth;
        $optimalHeight = $this->getSizeByFixedWidth($newWidth,$h,$w);

        return array('w' => $optimalWidth, 'h' => $optimalHeight);
    }

    private function getSizeByFixedHeight($newHeight,$h,$w)
    {
        $ratio = $w / $h;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }

    private function getSizeByAuto($newWidth, $newHeight,$w,$h)
    {
            if ($h < $w)
            // *** Image to be resized is wider (landscape)
            {
                    $optimalWidth = $newWidth;
                    $optimalHeight= $this->getSizeByFixedWidth($newWidth,$h,$w);
            }
            elseif ($h > $w)
            // *** Image to be resized is taller (portrait)
            {
                    $optimalWidth = $this->getSizeByFixedHeight($newHeight,$h,$w);
                    $optimalHeight = $newHeight;
            }
            else
            // *** Image to be resizerd is a square
            {
                    if ($newHeight < $newWidth) {
                            $optimalWidth = $newWidth;
                            $optimalHeight= $this->getSizeByFixedWidth($newWidth,$h,$w);
                    } else if ($newHeight > $newWidth) {
                            $optimalWidth = $this->getSizeByFixedHeight($newHeight,$h,$w);
                            $optimalHeight= $newHeight;
                    } else {
                            // *** Sqaure being resized to a square
                            $optimalWidth = $newWidth;
                            $optimalHeight= $newHeight;
                    }
            }

            return array('w' => $optimalWidth, 'h' => $optimalHeight);
    }

    function getImage($extension,$filename)
    {
        $img = null;
        if($extension=="jpg" ){
                $img = imagecreatefromjpeg($this->path.$filename);
        }elseif($extension=="gif" ){
                $img = imagecreatefromgif($this->path.$filename);
        }elseif($extension=="png" ){
                $img = imagecreatefrompng($this->path.$filename);
        }

        return $img;
    }

    function resizeByWidth($filename,$newWidth=100,$output=false,$quality=100,$file_prefix=''){		

            $new_filename = $file_prefix.$filename;

            $thumb_created = false;
            $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            $img = $this->getImage($extension,$filename);

            if ($img) {

                    //get the dimension of source image 
                    $width = imagesx($img); //450
                    $height = imagesy($img); //450
                    
                    if($width > $newWidth)
                    {
                        $new_height = $this->getSizeByFixedWidth($newWidth, $height, $width);
                        $new_width = $newWidth;
                    }
                    else
                    {
                        $new_height = $this->getSizeByFixedWidth($width, $height, $width);
                        $new_width = $width;
                    }
                    
          
                    # Create a new temporary image
                    $_img = imagecreatetruecolor($new_width, $new_height);
                    if($extension=="png" ){ //transparent fix
                            imagealphablending($_img, false);
                            imagesavealpha($_img,true);

                            $transparent = imagecolorallocatealpha($_img, 255, 255, 255, 127);
                            imagefilledrectangle($_img, 0, 0, $new_width, $new_height, $transparent);
                    }

                     imagecopyresampled($_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    @imagedestroy($img);                 
            }// if ($img) {

            if($output == false)
            {
                            if($extension=="jpg" ){
                                            imagejpeg($_img,$this->path.$new_filename,$quality);
                                            $thumb_created = true;
                            }elseif($extension=="gif" ){
                                            imagegif($_img,$this->path.$new_filename,$quality);
                                            $thumb_created = true;
                            }elseif($extension=="png" ){
                                            imagepng($_img,$this->path.$new_filename,9);
                                            $thumb_created = true;
                            }
                                   ;
                @imagedestroy($_img);
            }
            else
            {
                if($extension=="jpg" ){
                        header('Content-type: image/jpeg');
                        imagejpeg($img);
                }elseif($extension=="gif" ){
                        header('Content-type: image/gif');
                        imagegif($img);
                }elseif($extension=="png" ){
                        header('Content-type: image/png');
                        imagepng($img);
                }
            }

            if($thumb_created == false ){
                    return false;
            }else{
                    return true;
            }

    }// resize() ends
    
    function resizeByHeight($filename,$newHeight,$output=false,$quality=100,$file_prefix=''){		

            $new_filename = $file_prefix.$filename;

            $thumb_created = false;
            $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            $img = $this->getImage($extension,$filename);

            if ($img) {

                    //get the dimension of source image 
                    $width = imagesx($img);
                    $height = imagesy($img);

                    $new_width = $this->getSizeByFixedHeight($newHeight, $height, $width);
                    $new_height = $newHeight;

                    # Create a new temporary image
                    $_img = imagecreatetruecolor($new_width, $new_height);
                    if($extension=="png" ){ //transparent fix
                            imagealphablending($_img, false);
                            imagesavealpha($_img,true);

                            $transparent = imagecolorallocatealpha($_img, 255, 255, 255, 127);
                            imagefilledrectangle($_img, 0, 0, $new_width, $new_height, $transparent);
                    }

                     imagecopyresampled($_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    @imagedestroy($img);                 
            }// if ($img) {

            if($output == false)
            {
                            if($extension=="jpg" ){
                                            imagejpeg($_img,$this->path.$new_filename,$quality);
                                            $thumb_created = true;
                            }elseif($extension=="gif" ){
                                            imagegif($_img,$this->path.$new_filename,$quality);
                                            $thumb_created = true;
                            }elseif($extension=="png" ){
                                            imagepng($_img,$this->path.$new_filename,9);
                                            $thumb_created = true;
                            }
                                   ;
                @imagedestroy($_img);
            }
            else
            {
                if($extension=="jpg" ){
                        header('Content-type: image/jpeg');
                        imagejpeg($img);
                }elseif($extension=="gif" ){
                        header('Content-type: image/gif');
                        imagegif($img);
                }elseif($extension=="png" ){
                        header('Content-type: image/png');
                        imagepng($img);
                }
            }

            if($thumb_created == false ){
                    return false;
            }else{
                    return true;
            }

    }// resize() ends

    function resize($filename,$newWidth=100,$newHeight=100,$output=false,$quality=100,$file_prefix=''){		

            $new_filename = $file_prefix.$filename;

            $thumb_created = false;
            $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            $img = $this->getImage($extension,$filename);

            if ($img) {

                    //get the dimension of source image 
                    $width = imagesx($img);
                    $height = imagesy($img);
                    
            
                    
                    if($width <= $newWidth && $height <= $newHeight)
                    {
                        $new_width = $width;
                        $new_height = $height;
                    }
                    else
                    {
                        $optimalDimension = $this->getSizeByAuto($newWidth, $newHeight, $width, $height);

                        $new_height = $optimalDimension['h'];
                        $new_width = $optimalDimension['w'];
                    }
                    
                    # Create a new temporary image
                    $_img = imagecreatetruecolor($new_width, $new_height);
                    if($extension == 'png' ){ //transparent fix
                      
                            imagealphablending($_img, false);
                            imagesavealpha($_img,true);

                            $transparent = imagecolorallocatealpha($_img, 255, 255, 255, 127);
                            imagefilledrectangle($_img, 0, 0, $new_width, $new_height, $transparent);
                    }
               
                            
                    imagecopyresampled($_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    @imagedestroy($img);                 
            }// if ($img) {

            if($output == false)
            {
                            if($extension=="jpg" ){
                                            imagejpeg($_img,$this->path.$new_filename,$quality);
                                            $thumb_created = true;
                            }elseif($extension=="gif" ){
                                            imagegif($_img,$this->path.$new_filename,$quality);
                                            $thumb_created = true;
                            }elseif($extension=="png" ){
                                            imagepng($_img,$this->path.$new_filename,9);
                                            $thumb_created = true;
                            }
                                   ;
                @imagedestroy($_img);
                    }
            else
            {
                if($extension=="jpg" ){
                        header('Content-type: image/jpeg');
                        imagejpeg($img);
                }elseif($extension=="gif" ){
                        header('Content-type: image/gif');
                        imagegif($img);
                }elseif($extension=="png" ){
                        header('Content-type: image/png');
                        imagepng($img);
                }
            }

            if($thumb_created == false )
            {
                    return false;
            }
            else
            {
                    return true;
            }

    }// resize() ends
    
    function getResizedResource($filename,$newWidth,$newHeight)
    {		
            $new_filename = $file_prefix.$filename;

            $thumb_created = false;
            $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            $img = $this->getImage($extension,$filename);

            if ($img) {

                    //get the dimension of source image 
                    $width = imagesx($img);
                    $height = imagesy($img);
                    
            
                    
                    if($width <= $newWidth && $height <= $newHeight)
                    {
                        $new_width = $width;
                        $new_height = $height;
                    }
                    else
                    {
                        $optimalDimension = $this->getSizeByAuto($newWidth, $newHeight, $width, $height);

                        $new_height = $optimalDimension['h'];
                        $new_width = $optimalDimension['w'];
                    }
                    
                    # Create a new temporary image
                    $_img = imagecreatetruecolor($new_width, $new_height);
                    if($extension == 'png' ){ //transparent fix
                      
                            imagealphablending($_img, false);
                            imagesavealpha($_img,true);

                            $transparent = imagecolorallocatealpha($_img, 255, 255, 255, 127);
                            imagefilledrectangle($_img, 0, 0, $new_width, $new_height, $transparent);
                    }
               
                            
                    imagecopyresampled($_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    @imagedestroy($img);                 
            }// if ($img) {

           return $_img;

    }
    
    function getImageResource($filename)
    {		
        $thumb_created = false;
        $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

        $img = $this->getImage($extension,$filename);

        return $img;
    }

    function getImageDimensions($filename){
            $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            if($extension=="jpg" ){
                    $img = imagecreatefromjpeg($this->path.$filename);
            }elseif($extension=="gif" ){
                    $img = imagecreatefromgif($this->path.$filename);
            }elseif($extension=="png" ){
                    $img = imagecreatefrompng($this->path.$filename);
            }

            $arr['w'] = imagesx($img);
            $arr['h'] = imagesy($img);
            return $arr;
    }

    function resizeTo($filename,$newfilename,$newWidth=100,$newHeight=100,$output=false){		
            $thumb_created = false;
            $extension =  strtolower($this->getExtension($filename,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            if($extension=="jpg" ){
                    $img = imagecreatefromjpeg($this->path.$filename);
            }elseif($extension=="gif" ){
                    $img = imagecreatefromgif($this->path.$filename);
            }elseif($extension=="png" ){
                    $img = imagecreatefrompng($this->path.$filename);
            }

            if ($img) {
                    //get the dimension of source image 
                    $width = imagesx($img);
                    $height = imagesy($img);

                    //aspect ratio to be maintained
                    if ($width > $height) { 
                            $scale = ($newWidth / $width); 
                    } else { 
                            $scale = ($newHeight / $height); 
                    } 

                    //thumbnail dimensions
                    $new_width = round($width * $scale); 
                    $new_height = round($height * $scale); 

                    # Create a new temporary image
                    $tmp_img = imagecreatetruecolor($new_width, $new_height);

                    # Copy and resize old image into new image
                    imagecopyresized($tmp_img, $img, 0, 0, 0, 0,
                                                     $new_width, $new_height, $width, $height);
                    imagedestroy($img);
                    $img = $tmp_img;
            }// if ($img) {

            if($output == false){
                    if($extension=="jpg" ){
                                    imagejpeg($img,$this->path.$newfilename);
                                    $thumb_created = true;
                    }elseif($extension=="gif" ){
                                    imagegif($img,$this->path.$newfilename);
                                    $thumb_created = true;
                    }elseif($extension=="png" ){
                                    imagepng($img,$this->path.$newfilename);
                                    $thumb_created = true;
                    }
            }else{
                    if($extension=="jpg" ){
                            header('Content-type: image/jpeg');
                            imagejpeg($img);
                    }elseif($extension=="gif" ){
                            header('Content-type: image/gif');
                            imagegif($img);
                    }elseif($extension=="png" ){
                            header('Content-type: image/png');
                            imagepng($img);
                    }
            }

            if($thumb_created == false ){
                    return false;
            }else{
                    return true;
            }

    }// resize() ends

   

    function ResizeSemiAbstractTop($resource, $w = 100, $h = 100,$extension=''){
            $sw = imagesx($resource);
            $sh = imagesy($resource);
            $ar = $sw/$sh;
            $tar = $w/$h;
            if($ar >= $tar){
                    $x1 = round(($sw - ($sw * ($tar/$ar)))/2);
                    $x2 = round($sw * ($tar/$ar));
                    $y1 = 0;
                    $y2 = $sh;
            }else{
                    $x1 = 0;
                    $y1 = 0;
                    $x2 = $sw;
                    $y2 = round($sw/$tar);
            }

            # Create a new temporary image
            $slate = imagecreatetruecolor($w, $h);
            if($extension=="png" && $extension != '')
            {
                    imagealphablending($slate, false);
                    imagesavealpha($slate,true);

                    $transparent = imagecolorallocatealpha($slate, 255, 255, 255, 127);
                    imagefilledrectangle($slate, 0, 0, $w, $h, $transparent);
            }


            imagecopyresampled($slate, $resource, 0, 0, $x1, $y1, $w, $h, $x2, $y2);
            return $slate;
    }

    function zoomCrop($imgSrc,$newfilename,$new_width=100,$new_height=100,$zoom_crop=1,$quality=100,$output=false)
    {

            $extension =  strtolower($this->getExtension($imgSrc,false)); // false - tells to get "jpg" NOT ".jpg" GOT IT :P

            $image = null;
            
            //saving the image into memory (for manipulation with GD Library)
            switch($extension) {
                    case 'gif':
                    $image = imagecreatefromgif($this->path.$imgSrc);
                    break;
                    case 'jpg':
                    $image = imagecreatefromjpeg($this->path.$imgSrc);
                    break;
                    case 'png':
                    $image = imagecreatefrompng($this->path.$imgSrc);
                    break;
            }

            if($image == null)
                return false;
            
            list($width, $height) = getimagesize($this->path.$imgSrc); 
            //$width = imagesx( $this->path.$imgSrc);
            //$height = imagesy( $this->path.$imgSrc );

            // don't allow new width or height to be greater than the original
            if( $new_width > $width ) { $new_width = $width; }
            if( $new_height > $height ) { $new_height = $height; }

            // generate new w/h if not provided
            if( $new_width && !$new_height ) {
                    $new_height = $height * ( $new_width / $width );
            }
            elseif($new_height && !$new_width) {
                    $new_width = $width * ( $new_height / $height );
            }
            elseif(!$new_width && !$new_height) {
                    $new_width = $width;
                    $new_height = $height;
            }


            // create a new true color image
            $canvas = imagecreatetruecolor( $new_width, $new_height );

            if($extension == 'png'){
                imagealphablending( $canvas, false );
                imagesavealpha( $canvas, true );
            }


            if( $zoom_crop ) {

            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            $cmp_x = $width  / $new_width;
            $cmp_y = $height / $new_height;

            // calculate x or y coordinate and width or height of source

            if ( $cmp_x > $cmp_y ) {

                    $src_w = round( ( $width / $cmp_x * $cmp_y ) );
                    $src_x = round( ( $width - ( $width / $cmp_x * $cmp_y ) ) / 2 );

            }elseif ( $cmp_y > $cmp_x ) {

                            $src_h = round( ( $height / $cmp_y * $cmp_x ) );
                            $src_y = round( ( $height - ( $height / $cmp_y * $cmp_x ) ) / 2 );

                    }

                    imagecopyresampled( $canvas, $image, 0, 0, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h );

            }else {
                    // copy and resize part of an image with resampling
                    imagecopyresampled( $canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
            }


            if($output == false){
                    if($extension=="jpg" ){
                            imagejpeg( $canvas,$this->path.$newfilename, $quality );
                    }elseif($extension=="gif" ){
                            imagegif( $canvas, $this->path.$newfilename );
                    }elseif($extension=="png" ){
                            imagepng( $canvas, $this->path.$newfilename,  9 );
                    }
            }else{
                    //final output  
                    //imagejpeg($thumb);
                    if($extension=="jpg" ){
                            header('Content-type: image/jpeg');
                            imagejpeg($canvas);
                    }elseif($extension=="gif" ){
                            header('Content-type: image/gif');
                            imagegif($canvas);
                    }elseif($extension=="png" ){
                            header('Content-type: image/png');
                            imagepng($canvas);
                    }
            } 
            imagedestroy($canvas); 
    }
}