<?PHP defined('_WP_FUEL_MVC') or die('No direct script access.');
/**
 * Array Helper Class
 *
 * @author      Muneeb <m4munib@hotmail.com>
 * @copyright   Muneeb <m4munib@hotmail.com>
 * @twitter     http://twitter.com/#!/muhammadmunib
 */
class clsArray
{

    static function arrayToComboOptions($array,$current_value='',$ignore_values='',$use_value_as_key=false)
    {

        if($ignore_values == '')
            $ignore_values = array(); //init :P
            
        $str = '';
        foreach ($array as $key => $value){
            if($use_value_as_key)
                $key  = $value;
                        
            if($key == $current_value){
                $selected = " selected";
            }else{
                 $selected = "";
            }
            
            if(!in_array($key,$ignore_values)){
                 $str .= '<option value="'.$key.'"'.$selected.'>'.ucFirst($value).'</option>';
            }
            
           
        } 
        return $str;
        
    }
    
     static function arrayToRadioOptions($array,$name,$current_value='',$class='check_radio',$js_event_str='')
     {
         $str = '';

        foreach ($array as $key => $value){
            if($key == $current_value){
                $selected = "checked";
            }else{
                 $selected = "";
            }
            $str .= '<input type="radio" name="'.$name.'" value="'.$key.'" '.$selected.' class="'.$class.'"'.$js_event_str.'> '.$value.'  ';
        } 
        return $str;
    }
    
    function arrayTocheckboxes($array,$name,$data_array=array(),$class='check_radio'
    ){
        $str = '';
        foreach ($array as $key => $value){
            if(in_array($key,$data_array)){
                $selected = "checked";
            }else{
                 $selected = "";
            }
            $str .= '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="'.$key.'"'.$selected.' class="'.$class.'">'.$value;
        } 
        return $str;
    }
    
    static function getValidKeysArray(array $array, array $valid_keys)
    {
        $_array = $array;
        
   
        foreach($_array as $k => $v)
        {
            if(in_array($k,$valid_keys) == false || $v == '')
            {
                unset($_array[$k]);
            }
        }
        
        ksort($_array);
        
        return $_array;
        
    }
    
    static function datasetToCombo(array $dataset,$id_col,$display_col,$current_id='')
    {
       $slct_str = "";
       foreach($dataset as $k => $r)
       {
           $selected = '';
           if($r[$id_col] == $current_id && $current_id != '' && $current_id > 0)
           {
               $selected = ' selected="selected"';
           }
           else if(is_array($current_id) && in_array($r[$id_col], $current_id))
           {
               $selected = ' selected="selected"';
           }
            $slct_str .= "<option value='".$r[$id_col]."'".$selected.">".$r[$display_col]."</option>";
       }
       
       return $slct_str;
    }
    
    static function build_query(array $data)
    {
       $ignore_keys = array('core_url','page');
       
       $keys = array_keys($data);
       
       foreach($keys as $k => $_key)
       {
           if(in_array($_key, $ignore_keys))
           {
               unset($data[$_key]);
           }
       }

       return http_build_query($data);
    }
    
    /**
     * Fill an array with a range of numbers.
     *
     *     // Fill an array with values 5, 10, 15, 20
     *     $values = clsArray::range(5, 20);
     *
     * @param   integer  stepping
     * @param   integer  ending number
     * @return  array
     */
    public static function range($step = 10, $max = 100)
    {
            if ($step < 1)
                    return array();

            $array = array();
            for ($i = $step; $i <= $max; $i += $step)
            {
                    $array[$i] = $i;
            }

            return $array;
    }
    
    /**
     * Retrieve a single key from an array. If the key does not exist in the
     * array, the default value will be returned instead.
     *
     *     // Get the value "username" from $_POST, if it exists
     *     $username = clsArray::get($_POST, 'username');
     *
     *     // Get the value "sorting" from $_GET, if it exists
     *     $sorting = clsArray::get($_GET, 'sorting');
     *
     * @param   array   array to extract from
     * @param   string  key name
     * @param   mixed   default value
     * @return  mixed
     */
    public static function get($array, $key, $default = NULL)
    {
            return isset($array[$key]) ? $array[$key] : $default;
    }
    
    /**
     * Retrieves multiple keys from an array. If the key does not exist in the
     * array, the default value will be added instead.
     *
     *     // Get the values "username", "password" from $_POST
     *     $auth = clsArray::extract($_POST, array('username', 'password'));
     *
     * @param   array   array to extract keys from
     * @param   array   list of key names
     * @param   mixed   default value
     * @return  array
     */
    public static function extract($array, array $keys, $default = NULL)
    {
            $found = array();
            foreach ($keys as $key)
            {
                    $found[$key] = isset($array[$key]) ? $array[$key] : $default;
            }

            return $found;
    }
    
    /**
	 * Retrieves muliple single-key values from a list of arrays.
	 *
	 *     // Get all of the "id" values from a result
	 *     $ids = clsArray::pluck($result, 'id');
	 *
	 * [!!] A list of arrays is an array that contains arrays, eg: array(array $a, array $b, array $c, ...)
	 *
	 * @param   array   list of arrays to check
	 * @param   string  key to pluck
	 * @return  array
	 */
	public static function pluck($array, $key)
	{
		$values = array();

		foreach ($array as $row)
		{
			if (isset($row[$key]))
			{
				// Found a value in this row
				$values[] = $row[$key];
			}
		}

		return $values;
	}

	/**
	 * Adds a value to the beginning of an associative array.
	 *
	 *     // Add an empty value to the start of a select list
	 *     clsArray::unshift($array, 'none', 'Select a value');
	 *
	 * @param   array   array to modify
	 * @param   string  array key name
	 * @param   mixed   array value
	 * @return  array
	 */
	public static function unshift( array & $array, $key, $val)
	{
		$array = array_reverse($array, TRUE);
		$array[$key] = $val;
		$array = array_reverse($array, TRUE);

		return $array;
	}

	/**
	 * Recursive version of [array_map](http://php.net/array_map), applies the
	 * same callback to all elements in an array, including sub-arrays.
	 *
	 *     // Apply "strip_tags" to every element in the array
	 *     $array = clsArray::map('strip_tags', $array);
	 *
	 * [!!] Unlike `array_map`, this method requires a callback and will only map
	 * a single array.
	 *
	 * @param   mixed   callback applied to every element in the array
	 * @param   array   array to map
	 * @param   array   array of keys to apply to
	 * @return  array
	 */
	public static function map($callback, $array, $keys = NULL)
	{
		foreach ($array as $key => $val)
		{
			if (is_array($val))
			{
				$array[$key] = clsArray::map($callback, $array[$key]);
			}
			elseif ( ! is_array($keys) or in_array($key, $keys))
			{
				if (is_array($callback))
				{
					foreach ($callback as $cb)
					{
						$array[$key] = call_user_func($cb, $array[$key]);
					}
				}
				else
				{
					$array[$key] = call_user_func($callback, $array[$key]);
				}
			}
		}

		return $array;
	}

	/**
	 * Merges one or more arrays recursively and preserves all keys.
	 * Note that this does not work the same as [array_merge_recursive](http://php.net/array_merge_recursive)!
	 *
	 *     $john = array('name' => 'john', 'children' => array('fred', 'paul', 'sally', 'jane'));
	 *     $mary = array('name' => 'mary', 'children' => array('jane'));
	 *
	 *     // John and Mary are married, merge them together
	 *     $john = clsArray::merge($john, $mary);
	 *
	 *     // The output of $john will now be:
	 *     array('name' => 'mary', 'children' => array('fred', 'paul', 'sally', 'jane'))
	 *
	 * @param   array  initial array
	 * @param   array  array to merge
	 * @param   array  ...
	 * @return  array
	 */
	public static function merge(array $a1, array $a2)
	{
		$result = array();
		for ($i = 0, $total = func_num_args(); $i < $total; $i++)
		{
			// Get the next array
			$arr = func_get_arg($i);

			// Is the array associative?
			$assoc = clsArray::is_assoc($arr);

			foreach ($arr as $key => $val)
			{
				if (isset($result[$key]))
				{
					if (is_array($val) AND is_array($result[$key]))
					{
						if (clsArray::is_assoc($val))
						{
							// Associative arrays are merged recursively
							$result[$key] = clsArray::merge($result[$key], $val);
						}
						else
						{
							// Find the values that are not already present
							$diff = array_diff($val, $result[$key]);

							// Indexed arrays are merged to prevent duplicates
							$result[$key] = array_merge($result[$key], $diff);
						}
					}
					else
					{
						if ($assoc)
						{
							// Associative values are replaced
							$result[$key] = $val;
						}
						elseif ( ! in_array($val, $result, TRUE))
						{
							// Indexed values are added only if they do not yet exist
							$result[] = $val;
						}
					}
				}
				else
				{
					// New values are added
					$result[$key] = $val;
				}
			}
		}

		return $result;
	}

	/**
	 * Overwrites an array with values from input arrays.
	 * Keys that do not exist in the first array will not be added!
	 *
	 *     $a1 = array('name' => 'john', 'mood' => 'happy', 'food' => 'bacon');
	 *     $a2 = array('name' => 'jack', 'food' => 'tacos', 'drink' => 'beer');
	 *
	 *     // Overwrite the values of $a1 with $a2
	 *     $array = clsArray::overwrite($a1, $a2);
	 *
	 *     // The output of $array will now be:
	 *     array('name' => 'jack', 'mood' => 'happy', 'food' => 'tacos')
	 *
	 * @param   array   master array
	 * @param   array   input arrays that will overwrite existing values
	 * @return  array
	 */
	public static function overwrite($array1, $array2)
	{
		foreach (array_intersect_key($array2, $array1) as $key => $value)
		{
			$array1[$key] = $value;
		}

		if (func_num_args() > 2)
		{
			foreach (array_slice(func_get_args(), 2) as $array2)
			{
				foreach (array_intersect_key($array2, $array1) as $key => $value)
				{
					$array1[$key] = $value;
				}
			}
		}

		return $array1;
	}
        
        
	/**
	 * Creates a callable function and parameter list from a string representation.
	 * Note that this function does not validate the callback string.
	 *
	 *     // Get the callback function and parameters
	 *     list($func, $params) = clsArray::callback('Foo::bar(apple,orange)');
	 *
	 *     // Get the result of the callback
	 *     $result = call_user_func_array($func, $params);
	 *
	 * @param   string  callback string
	 * @return  array   function, params
	 */
	public static function callback($str)
	{
		// Overloaded as parts are found
		$command = $params = NULL;

		// command[param,param]
		if (preg_match('/^([^\(]*+)\((.*)\)$/', $str, $match))
		{
			// command
			$command = $match[1];

			if ($match[2] !== '')
			{
				// param,param
				$params = preg_split('/(?<!\\\\),/', $match[2]);
				$params = str_replace('\,', ',', $params);
			}
		}
		else
		{
			// command
			$command = $str;
		}

		if (strpos($command, '::') !== FALSE)
		{
			// Create a static method callable command
			$command = explode('::', $command, 2);
		}

		return array($command, $params);
	}

	/**
	 * Convert a multi-dimensional array into a single-dimensional array.
	 *
	 *     $array = array('set' => array('one' => 'something'), 'two' => 'other');
	 *
	 *     // Flatten the array
	 *     $array = clsArray::flatten($array);
	 *
	 *     // The array will now be
	 *     array('one' => 'something', 'two' => 'other');
	 *
	 * [!!] The keys of array values will be discarded.
	 *
	 * @param   array   array to flatten
	 * @return  array
	 * @since   3.0.6
	 */
	public static function flatten($array)
	{
		$flat = array();
		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				$flat += clsArray::flatten($value);
			}
			else
			{
				$flat[$key] = $value;
			}
		}
		return $flat;
	}




}
?>