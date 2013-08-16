<?PHP
class clsFiling
{
    static function makeDirectory($ffullPath,$permissions=0777)
    {
        return mkdir($ffullPath, $permissions,true);
    }

    static function removeDir($dir, $DeleteMe) 
    {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($obj = readdir($dh))) {
                if($obj=='.' || $obj=='..') continue;
                if (!@unlink($dir.'/'.$obj)) $this->removeDir($dir.'/'.$obj, true);
        }
        closedir($dh);
        if ($DeleteMe) @rmdir($dir);
    }

    static function getFiles($start_dir) 
    {
        $files = array();
          if (is_dir($start_dir)) {
            $fh = opendir($start_dir);
            while (($file = readdir($fh)) !== false) {
              # loop through the files, skipping . and .., and recursing if necessary
              if (strcmp($file, '.')==0 || strcmp($file, '..')==0) continue;
              $filepath = $start_dir . DIRECTORY_SEPARATOR . $file;
              if ( is_dir($filepath) )
                $files = array_merge($files, self::getFiles($filepath));
              else
                array_push($files, $filepath);
            }
            closedir($fh);
          } else {
            # false if the function was called with an invalid non-directory argument
            $files = false;
          }

      return $files;

    }

    static function dirList($directory)
    {

            // create an array to hold directory list
            $results = array();

            // create a handler for the directory
            $handler = opendir($directory);

            // keep going until all files in directory have been read
            while ($file = readdir($handler)) {

                    // if $file isn't this directory or its parent, 
                    // add it to the results array
                    if ($file != '.' && $file != '..')
                            $results[] = $file;
            }

            // tidy up: close the handler
            closedir($handler);

            // done!
            return $results;

    }
   
}