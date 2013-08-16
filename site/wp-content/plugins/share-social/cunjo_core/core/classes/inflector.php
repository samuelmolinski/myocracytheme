<?php
class clsInflector
{   
   /**
	 * @var  array  cached inflections
	 */
	protected static $cache = array();

	/**
	 * @var  array  uncountable words
	 */
	protected static $uncountable;

	/**
	 * @var  array  irregular words
	 */
	protected static $irregular;

	/**
	 * Checks if a word is defined as uncountable. An uncountable word has a
	 * single form. For instance, one "fish" and many "fish", not "fishes".
	 *
	 *     clsInflector::uncountable('fish'); // TRUE
	 *     clsInflector::uncountable('cat');  // FALSE
	 *
	 *
	 * @param   string   word to check
	 * @return  boolean
	 */
	public static function uncountable($str)
	{
		if (clsInflector::$uncountable === NULL)
		{
			// Cache uncountables
			clsInflector::$uncountable = WPFuel::getConfig('inflector', 'uncountable',FALSE,CORE_CONFIG_PATH);

			// Make uncountables mirrored
			clsInflector::$uncountable = array_combine(clsInflector::$uncountable, clsInflector::$uncountable);
		}

		return isset(clsInflector::$uncountable[strtolower($str)]);
	}

	/**
	 * Makes a plural word singular.
	 *
	 *     echo clsInflector::singular('cats'); // "cat"
	 *     echo clsInflector::singular('fish'); // "fish", uncountable
	 *
	 * You can also provide the count to make inflection more intelligent.
	 * In this case, it will only return the singular value if the count is
	 * greater than one and not zero.
	 *
	 *     echo clsInflector::singular('cats', 2); // "cats"
	 *
	 * [!!] Special inflections are defined in `config/inflector.php`.
	 *
	 * @param   string   word to singularize
	 * @param   integer  count of thing
	 * @return  string
	 * @uses    clsInflector::uncountable
	 */
	public static function singular($str, $count = NULL)
	{
		// $count should always be a float
		$count = ($count === NULL) ? 1.0 : (float) $count;

		// Do nothing when $count is not 1
		if ($count != 1)
			return $str;

		// Remove garbage
		$str = strtolower(trim($str));

		// Cache key name
		$key = 'singular_'.$str.$count;

		if (isset(clsInflector::$cache[$key]))
			return clsInflector::$cache[$key];

		if (clsInflector::uncountable($str))
			return clsInflector::$cache[$key] = $str;

		if (empty(clsInflector::$irregular))
		{
			// Cache irregular words
			clsInflector::$irregular =  WPFuel::getConfig('inflector','irregular');
		}

		if ($irregular = array_search($str, clsInflector::$irregular))
		{
			$str = $irregular;
		}
		elseif (preg_match('/us$/', $str))
		{
			// http://en.wikipedia.org/wiki/Plural_form_of_words_ending_in_-us
			// Already singular, do nothing
		}
		elseif (preg_match('/[sxz]es$/', $str) OR preg_match('/[^aeioudgkprt]hes$/', $str))
		{
			// Remove "es"
			$str = substr($str, 0, -2);
		}
		elseif (preg_match('/[^aeiou]ies$/', $str))
		{
			// Replace "ies" with "y"
			$str = substr($str, 0, -3).'y';
		}
		elseif (substr($str, -1) === 's' AND substr($str, -2) !== 'ss')
		{
			// Remove singular "s"
			$str = substr($str, 0, -1);
		}

		return clsInflector::$cache[$key] = $str;
	}

	/**
	 * Makes a singular word plural.
	 *
	 *     echo clsInflector::plural('fish'); // "fish", uncountable
	 *     echo clsInflector::plural('cat');  // "cats"
	 *
	 * You can also provide the count to make inflection more intelligent.
	 * In this case, it will only return the plural value if the count is
	 * not one.
	 *
	 *     echo clsInflector::singular('cats', 3); // "cats"
	 *
	 * [!!] Special inflections are defined in `config/inflector.php`.
	 *
	 * @param   string   word to pluralize
	 * @param   integer  count of thing
	 * @return  string
	 * @uses    clsInflector::uncountable
	 */
	public static function plural($str, $count = NULL)
	{
		// $count should always be a float
		$count = ($count === NULL) ? 0.0 : (float) $count;

		// Do nothing with singular
		if ($count == 1)
			return $str;

		// Remove garbage
		$str = trim($str);

		// Cache key name
		$key = 'plural_'.$str.$count;

		// Check uppercase
		$is_uppercase = ctype_upper($str);

		if (isset(clsInflector::$cache[$key]))
			return clsInflector::$cache[$key];

		if (clsInflector::uncountable($str))
			return clsInflector::$cache[$key] = $str;

		if (empty(clsInflector::$irregular))
		{
			// Cache irregular words
			clsInflector::$irregular = WPFuel::getConfig('inflector', 'irregular',FALSE,CORE_CONFIG_PATH);
		}

		if (isset(clsInflector::$irregular[$str]))
		{
			$str = clsInflector::$irregular[$str];
		}
		elseif (preg_match('/[sxz]$/', $str) OR preg_match('/[^aeioudgkprt]h$/', $str))
		{
			$str .= 'es';
		}
		elseif (preg_match('/[^aeiou]y$/', $str))
		{
			// Change "y" to "ies"
			$str = substr_replace($str, 'ies', -1);
		}
		else
		{
			$str .= 's';
		}

		// Convert to uppsecase if nessasary
		if ($is_uppercase)
		{
			$str = strtoupper($str);
		}

		// Set the cache and return
		return clsInflector::$cache[$key] = $str;
	}

	/**
	 * Makes a phrase camel case. Spaces and underscores will be removed.
	 *
	 *     $str = clsInflector::camelize('mother cat');     // "motherCat"
	 *     $str = clsInflector::camelize('kittens in bed'); // "kittensInBed"
	 *
	 * @param   string  phrase to camelize
	 * @return  string
	 */
	public static function camelize($str)
	{
		$str = 'x'.strtolower(trim($str));
		$str = ucwords(preg_replace('/[\s_]+/', ' ', $str));

		return substr(str_replace(' ', '', $str), 1);
	}

	/**
	 * Converts a camel case phrase into a spaced phrase.
	 *
	 *     $str = clsInflector::decamelize('houseCat');    // "house cat"
	 *     $str = clsInflector::decamelize('kingAllyCat'); // "king ally cat"
	 *
	 * @param   string   phrase to camelize
	 * @param   string   word separator
	 * @return  string
	 */
	public static function decamelize($str, $sep = ' ')
	{
		return strtolower(preg_replace('/([a-z])([A-Z])/', '$1'.$sep.'$2', trim($str)));
	}

	/**
	 * Makes a phrase underscored instead of spaced.
	 *
	 *     $str = clsInflector::underscore('five cats'); // "five_cats";
	 *
	 * @param   string  phrase to underscore
	 * @return  string
	 */
	public static function underscore($str)
	{
		return preg_replace('/\s+/', '_', trim($str));
	}

	/**
	 * Makes an underscored or dashed phrase human-readable.
	 *
	 *     $str = clsInflector::humanize('kittens-are-cats'); // "kittens are cats"
	 *     $str = clsInflector::humanize('dogs_as_well');     // "dogs as well"
	 *
	 * @param   string  phrase to make human-readable
	 * @return  string
	 */
	public static function humanize($str)
	{
		return preg_replace('/[_-]+/', ' ', trim($str));
	}
        
        /**
        * Converts number to its ordinal English form.
        *
        * This method converts 13 to 13th, 2 to 2nd ...
        *
        * @access public
        * @static
        * @param    integer    $number    Number to get its ordinal value
        * @return string Ordinal representation of given string.
        */
        function ordinalize($number)
        {
            if (in_array(($number % 100),range(11,13))){
                return $number.'th';
            }else{
                switch (($number % 10)) {
                    case 1:
                    return $number.'st';
                    break;
                    case 2:
                    return $number.'nd';
                    break;
                    case 3:
                    return $number.'rd';
                    default:
                    return $number.'th';
                    break;
                }
            }
        }
        
        /**
	 * Translate string to 7-bit ASCII
	 * Only works with UTF-8.
	 *
	 * @param   string
	 * @return  string
	 */
	public static function ascii($str)
	{
		$foreign_characters = WPFuel::getConfig('ascii',null,FALSE,CORE_CONFIG_PATH);

		$str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

		// remove any left over non 7bit ASCII
		return preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $str);
	}
        
        /**
	 * Converts your text to a URL-friendly title so it can be used in the URL.
	 * Only works with UTF8 input and and only outputs 7 bit ASCII characters.
	 *
	 * @param   string  the text
	 * @param   string  the separator (either - or _)
	 * @return  string  the new title
	 */
	public static function friendly_title($str, $sep = '-', $lowercase = false)
	{
		// Allow underscore, otherwise default to dash
		$sep = $sep === '_' ? '_' : '-';

		// Remove tags
		$str = filter_var($str, FILTER_SANITIZE_STRING);

		// Decode all entities to their simpler forms
		$str = clsHTML::hed($str);

		// Remove all quotes.
		$str = preg_replace("#[\"\']#", '', $str);

		// Only allow 7bit characters
		$str = self::ascii($str);

		// Strip unwanted characters
		$str = preg_replace("#[^a-z0-9]#i", $sep, $str);
		$str = preg_replace("#[/_|+ -]+#", $sep, $str);
		$str = trim($str, $sep);

                return $str;
	}
}
?>