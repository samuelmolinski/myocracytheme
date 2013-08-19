<?php
/**
 * Generate textual time differences that are easily understandable by humans.
 *
 * The class supports minutes, hours, days, weeks, months and years.
 *
 * Examples:
 * - 5 seconds ago -> "just now"
 * - 65 seconds ago -> "a minute ago"
 * - 120 seconds ago -> "2 minutes ago"
 *
 * @category Date
 * @package  Date_HumanDiff
 * @author   Christian Weiske <cweiske@php.net>
 * @license  http://www.gnu.org/copyleft/lesser.html LGPL
 * @version  Release: @package_version@
 * @link     http://pear.php.net/package/Date_HumanDiff
 */
class clsDate_Human
{
    static $MINUTE = 60;
    static $HOUR = 3600;//self::$MINUTE * 60
    static $DAY = 86400;//self::$HOUR * 24
    static $WEEK = 604800;//self::$DAY * 7
    static $MONTH = 2628000;//self::$YEAR / 12
    static $YEAR = 31536000;//self::$DAY * 365

    /**
     * Array of possible time difference display formats.
     * Each value is an array with the following values:
     * - max. time difference
     * - textual description
     * - number to divide the time difference by
     *
     * @var    array
     * @usedby get()
     */
    protected $formats;

    /**
     * Translation object.
     * Provides translations for time strings
     *
     * @var Date_HumanDiff_Lang
     */
    protected $translator;

    private static $instance = null;
    
    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    /**
     * Create new instance, initialize $formats array
     */
    private function __construct()
    {
        $this->formats = array(
            array(0.7 * self::$MINUTE, 'few moments ago',       1),
            array(1.5 * self::$MINUTE, 'a minute ago',   1),
            array( 60 * self::$MINUTE, '%d minutes ago', self::$MINUTE),
            array(1.5 * self::$HOUR,   'an hour ago',    1),
            array(      self::$DAY,    '%d hours ago',   self::$HOUR),
            array(  2 * self::$DAY,    'yesterday',      1),
            array(  7 * self::$DAY,    '%d days ago',    self::$DAY),
            array(1.5 * self::$WEEK,   'a week ago',     1),
            array(      self::$MONTH,  '%d weeks ago',   self::$WEEK),
            array(1.5 * self::$MONTH,  'a month ago',    1),
            array(      self::$YEAR,   '%d months ago',  self::$MONTH),
            array(1.5 * self::$YEAR,   'a year ago',     1),
            array(PHP_INT_MAX,          '%d years ago',   self::$YEAR)
        );
    }
    
    private function __clone()
    {}

    /**
     * Generate a human readable time difference.
     *
     * @param int|DateTime $timestamp Timestamp to get difference to
     * @param int|DateTime $reference Reference timestamp to get difference from.
     *                       If omitted, it's set to the current time.
     *
     * @return string Human readable time difference ("a week ago")
     */
    public function get($timestamp, $reference = null)
    {
        if ($reference === null) {
            $reference = time();
        }

        $timestamp = $this->makeTimestamp($timestamp);
        $reference = $this->makeTimestamp($reference);

        $delta = $reference - $timestamp;

        foreach ($this->formats as $format) {
            if ($delta < $format[0]) {
                return $this->getTranslation(
                    $format[1],
                    round($delta / $format[2])
                );
            }
        };
    }
    
    /**
     * Adds a new format to the list of time formats.
     *
     * @param integer $timeDiff Maximum time difference between reference time
     *                          and given time in seconds.
     * @param string  $text     Text to show when the format is used
     * @param integer $divider  Number to divide time difference by
     * @param boolean $sort     Sort formats. Don't use this if you add many formats
     *                          but call sortFormats() manually afterwards.
     *
     * @return void
     */
    public function addFormat($timeDiff, $text, $divider, $sort = true)
    {
        $this->formats[] = array($timeDiff, $text, $divider);
        if ($sort) {
            $this->sortFormats();
        }
    }

    /**
     * Delete all existing formats.
     *
     * @return void
     */
    public function clearFormats()
    {
        $this->formats = array();
    }

    /**
     * Sort all formats by their time difference
     *
     * @return void
     */
    public function sortFormats()
    {
        usort($this->formats, array($this, 'sortFormatCompare'));
    }

    /**
     * Comparision function for usort()
     *
     * @param array $a First comparator
     * @param array $b Second comparator
     *
     * @return integer  <, = or > 0 - when $a is less, equal or greater than $b
     */
    public function sortFormatCompare($a, $b)
    {
        return $a[0] - $b[0];
    }


    /**
     * Convert given variable to a unix timestamp.
     *
     * Supported formats:
     * - DateTime object
     * - unix timestamps
     * - Strings that can be converted with strtotime
     *
     * @param mixed $something Some variable
     *
     * @return integer Unix timestamp
     */
    protected function makeTimestamp($something)
    {
        if ($something instanceof DateTime) {
            return $something->getTimestamp();
        }
        if (is_numeric($something)) {
            return (int)$something;
        }

        return strtotime($something);
    }

    /**
     * Get the translation for the given string.
     *
     * @param string  $string String to translate
     * @param integer $number Number to render into the string
     *
     * @return string Translated string. Original string when no translation
     *                exists.
     */
    protected function getTranslation($string, $number)
    {
        if ($this->translator === null) {
            return sprintf($string, $number);
        }

        return $this->translator->get($string, $number);
    }

    /**
     * Set the object that's used to translate time strings
     *
     * @param object $translator Language translation object
     *
     * @return void
     */
    public function setTranslator(clsDate_Human_Locale_Locale $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Set the locale to use.
     *
     * Supported formats:
     * - 2-letter ISO code ("de", "fr")
     * - locale name with and without encoding ("de_AT", "fr_FR.utf8")
     *
     * @param string $lang Language name
     *
     * @return boolean True if the translations could be loaded, false if not.
     */
    public function setLocale($lang)
    {
        if (strlen($lang) > 2) {
            //split off encoding
            list($locale,) = explode('.', $lang);
            if (!preg_match('#^[a-z_]+$#i', $locale)) {
                return false;
            }
            $lang = $locale;
        }

        $class = 'clsDate_Human_Locale_' . $lang;
        $file  = str_replace('_', '/', $class) . '.php';
        if ($this->isIncludable($file)) {
            include_once $file;
        }
        if (!class_exists($class)) {
            if (strlen($lang) > 2) {
                //try main language without country
                return $this->setLocale(substr($lang, 0, 2));
            }
            return false;
        }

        $translator = new $class();
        $this->setTranslator($translator);
        return true;
    }

    /**
     * Check if the given file is includable
     *
     * @param string $file Path to file (relative to include path)
     *
     * @return boolean True if one can include() it
     */
    protected function isIncludable($file)
    {
        $hdl = @fopen($file, 'r', true);
        if ($hdl === false) {
            return false;
        }
        fclose($hdl);
        return true;
    }
}

?>