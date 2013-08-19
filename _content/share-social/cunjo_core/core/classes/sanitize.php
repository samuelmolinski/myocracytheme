<?PHP   
class clsSanitize
{
    /**
     * @var array An array of regex patterns regulary cleansed from content.
     */
    public static $sanitizePatterns = array(
        'scripts'   => '@<script[^>]*?>.*?</script>@si',
        'entities'  => '@&#(\d+);@e',
        'tags'      => '@\[\[(.[^\[\[]*?)\]\]@si',
    );
    
    /**
     * Sanitize values of an array using regular expression patterns.
     *
     * @static
     * @param array $target The target array to sanitize.
     * @param array|string $patterns A regular expression pattern, or array of
     * regular expression patterns to apply to all values of the target.
     * @param integer $depth The maximum recursive depth to sanitize if the
     * target contains values that are arrays.
     * @return array The sanitized array.
     */
    public static function sanitize(array $target, $patterns= array(), $depth= 3, $nesting= 10) {
        
        while (list($key, $value)= each($target)) {
            if (is_array($value) && $depth > 0) {
                clsSanitize :: sanitize($value, $patterns, $depth-1);
            } elseif (is_string($value)) {
                if (!empty($patterns)) {
                    foreach ($patterns as $pattern) {
                        $nesting = ((integer) $nesting ? (integer) $nesting : 10);
                        $iteration = 1;
                        while ($iteration <= $nesting && preg_match($pattern, $value)) {
                            $value= preg_replace($pattern, '', $value);
                            $iteration++;
                        }
                    }
                }
                if (get_magic_quotes_gpc()) {
                    $target[$key]= stripslashes($value);
                } else {
                    $target[$key]= $value;
                }
            }
        }
        return $target;
    }
    
    /**
     * Sanitizes a string
     * 
     * @param string $str The string to sanitize
     * @param array $chars An array of chars to remove
     * @param string $allowedTags A list of tags to allow.
     * @return string The sanitized string.
     */
    public static function sanitizeString($str,$chars = array('/',"'",'"','(',')',';','>','<'),$allowedTags = '') {
        $str = str_replace($chars,'',strip_tags(stripslashes($str),$allowedTags));
        return preg_replace("/[^A-Za-z0-9_\-\.\/]/",'',$str);
    }
    
     /**
     * Strip unwanted HTML and PHP tags and supplied patterns from content.
     */
    public static function stripTags($html, $allowed= '', $patterns= array(), $depth= 10) {
        $stripped= strip_tags($html, $allowed);
        if (is_array($patterns)) {
            if (empty($patterns)) {
                $patterns = self::$sanitizePatterns;
            }
            foreach ($patterns as $pattern) {
                $depth = ((integer) $depth ? (integer) $depth : 10);
                $iteration = 1;
                while ($iteration <= $depth && preg_match($pattern, $stripped)) {
                    $stripped = preg_replace($pattern, '', $stripped);
                    $iteration++;
                }
            }
        }
        return $stripped;
    }
    
    /**
     * Strips extra whitespace from output
     *
     * @param string $str String to sanitize
     * @return string whitespace sanitized string
     * @access public
     * @static
     */
    public static function stripWhitespace($str) {
            $r = preg_replace('/[\n\r\t]+/', '', $str);
            return preg_replace('/\s{2,}/', ' ', $r);
    }
    
    static function removeEmptytags($html_replace)
    {
        $pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
        return preg_replace($pattern, '', $html_replace);
    } 
    
    function removeEmptyLines($s)
    {
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $s);
    }
    
    
    /**
     * Remove XSS from user input.
     *
     *     $str = clsSanitize::xss_clean($str);
     *
     * @author     Christian Stocker <chregu@bitflux.ch>
     * @copyright  (c) 2001-2006 Bitflux GmbH
     * @param   mixed  string or array to sanitize
     * @return  string
     * @deprecated  since v3.0.5
     */
    public static function xss_clean($str)
    {
            // http://svn.bitflux.ch/repos/public/popoon/trunk/classes/externalinput.php
            // +----------------------------------------------------------------------+
            // | Copyright (c) 2001-2006 Bitflux GmbH                                 |
            // +----------------------------------------------------------------------+
            // | Licensed under the Apache License, Version 2.0 (the "License");      |
            // | you may not use this file except in compliance with the License.     |
            // | You may obtain a copy of the License at                              |
            // | http://www.apache.org/licenses/LICENSE-2.0                           |
            // | Unless required by applicable law or agreed to in writing, software  |
            // | distributed under the License is distributed on an "AS IS" BASIS,    |
            // | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |
            // | implied. See the License for the specific language governing         |
            // | permissions and limitations under the License.                       |
            // +----------------------------------------------------------------------+
            // | Author: Christian Stocker <chregu@bitflux.ch>                        |
            // +----------------------------------------------------------------------+


            if (is_array($str) OR is_object($str))
            {
                    foreach ($str as $k => $s)
                    {
                        $str[$k] = clsSanitize::xss_clean($s);
                    }

                    return $str;
            }

            $str = rawurldecode($str);
            
            // Remove all NULL bytes
            $str = str_replace("\0", '', $str);
            
            // Fix &entity\n;
            $str = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $str);
            $str = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $str);
            $str = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $str);
            $str = html_entity_decode($str, ENT_COMPAT, WPFuel::$charset);

            // Remove any attribute starting with "on" or xmlns
            $str = preg_replace('#(?:on[a-z]+|xmlns)\s*=\s*[\'"\x00-\x20]?[^\'>"]*[\'"\x00-\x20]?\s?#iu', '', $str);

            // Remove javascript: and vbscript: protocols
            $str = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $str);
            $str = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $str);
            $str = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $str);

            // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
            $str = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#is', '$1>', $str);
            $str = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#is', '$1>', $str);
            $str = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#ius', '$1>', $str);

            // Remove namespaced elements (we do not need them)
            $str = preg_replace('#</*\w+:\w[^>]*+>#i', '', $str);

            do
            {
                // Remove really unwanted tags
                $old = $str;
                $str = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $str);
            }
            while ($old !== $str);

            return $str;
    }
    
    // --------------------------------------------------------------------
    /**
     * Filename Security
     *
     * @param	string
     * @return	string
     */
    public function sanitize_filename($str, $relative_path = FALSE)
    {
            $bad = array(
                                            "../",
                                            "<!--",
                                            "-->",
                                            "<",
                                            ">",
                                            "'",
                                            '"',
                                            '&',
                                            '$',
                                            '#',
                                            '{',
                                            '}',
                                            '[',
                                            ']',
                                            '=',
                                            ';',
                                            '?',
                                            "%20",
                                            "%22",
                                            "%3c",		// <
                                            "%253c",	// <
                                            "%3e",		// >
                                            "%0e",		// >
                                            "%28",		// (
                                            "%29",		// )
                                            "%2528",	// (
                                            "%26",		// &
                                            "%24",		// $
                                            "%3f",		// ?
                                            "%3b",		// ;
                                            "%3d"		// =
                                    );

            if ( ! $relative_path)
            {
                    $bad[] = './';
                    $bad[] = '/';
            }

            $str = self::remove_invisible_characters($str, FALSE);
            return stripslashes(str_replace($bad, '', $str));
    }
    
    // --------------------------------------------------------------------

    /**
     * Remove Invisible Characters
     *
     * This prevents sandwiching null characters
     * between ascii characters, like Java\0script.
     *
     * @access	public
     * @param	string
     * @return	string
     */
    function remove_invisible_characters($str, $url_encoded = TRUE)
    {
            $non_displayables = array();

            // every control character except newline (dec 10)
            // carriage return (dec 13), and horizontal tab (dec 09)

            if ($url_encoded)
            {
                    $non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
                    $non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
            }

            $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

            do
            {
                    $str = preg_replace($non_displayables, '', $str, -1, $count);
            }
            while ($count);

            return $str;
    }
    
    static function escape($v)
    {
        if(is_array($v))
        {
            foreach($v as $k => $val)
            {
                 $v[$k] = clsHTML::entities(self::sqlEscape($val));
            }
            
            return $v;
        }
        else
        {
            return clsHTML::entities(self::sqlEscape($v));
        }
    }
    
    static function sqlEscape($v)
    {
        return clsDatabase::factory()->escape($v);
    }
    
    static function safe($data,$sanitize = false)
    {
        if(is_numeric($data))
        {
            return $data;
        }
        
        if(get_magic_quotes_gpc())
        {
            if(is_string($data))
            {
                $data = stripslashes($data);
            }
            else if(is_array($data))
            {
                foreach($data as $k => $v)
                {
                    $data[$k] = stripslashes($v);
                }
            }
        }
        
        return self::escape($data);
    }
   
}
?>