<?php
class clsHTML
{   
    /**
     * @var  array  preferred order of attributes
     */
    public static $attribute_order = array
    (
            'action',
            'method',
            'type',
            'id',
            'name',
            'value',
            'href',
            'src',
            'width',
            'height',
            'cols',
            'rows',
            'size',
            'maxlength',
            'rel',
            'media',
            'accept-charset',
            'accept',
            'tabindex',
            'accesskey',
            'alt',
            'title',
            'class',
            'style',
            'selected',
            'checked',
            'readonly',
            'disabled',
    );
        
    public static function hed($value)
    {
        return html_entity_decode((string)$value, ENT_QUOTES, WPFuel::$charset);
    }
    
    /**
     * Convert special characters to HTML entities. All untrusted content
     * should be passed through this method to prevent XSS injections.
     *
     *     echo hlpHTML::chars($username);
     *
     * @param   string   string to convert
     * @param   boolean  encode existing entities
     * @return  string
     */
    public static function chars($value, $double_encode = TRUE)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, WPFuel::$charset, $double_encode);
    }

    /**
     * Convert all applicable characters to HTML entities. All characters
     * that cannot be represented in HTML with the current character set
     * will be converted to entities.
     *
     *     echo hlpHTML::entities($username);
     *
     * @param   string   string to convert
     * @param   boolean  encode existing entities
     * @return  string
     */
    public static function entities($value, $double_encode = TRUE)
    {
        return htmlentities((string) $value, ENT_QUOTES, WPFuel::$charset, $double_encode);
    }
    
    public static function attributes(array $attributes = NULL)
    {
            if (empty($attributes))
                    return '';

            $sorted = array();
            foreach (self::$attribute_order as $key)
            {
                if (isset($attributes[$key]))
                {
                        // Add the attribute to the sorted list
                        $sorted[$key] = $attributes[$key];
                }
            }

            // Combine the sorted attributes
            $attributes = $sorted + $attributes;

            $compiled = '';
            foreach ($attributes as $key => $value)
            {
                    if ($value === NULL)
                    {
                            // Skip attributes that have NULL values
                            continue;
                    }

                    if (is_int($key))
                    {
                            // Assume non-associative keys are mirrored attributes
                            $key = $value;
                    }

                    // Add the attribute value
                    $compiled .= ' '.$key.'="'.self::chars($value).'"';
            }

            return $compiled;
    }
}
?>