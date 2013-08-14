<?PHP
/**
 * Random String Class
 *
 */
class clsString_Random
{
    const ALPHA = 'alpha';
    const NUMERIC = 'numeric';
    const ALPHANUM = 'alphanum';
    const HEXIDEC = 'hexidec';
    
    /**
     * Generate and return a random string
     *
     * The default string returned is 8 alphanumeric characters.
     *
     * The type of string returned can be changed with the "seeds" parameter.
     * Four types are - by default - available: alpha, numeric, alphanum and hexidec. 
     *
     * If the "seeds" parameter does not match one of the above, then the string
     * supplied is used.
     *
     * @version     2.1.0
     * @param       int     $length  Length of string to be generated
     * @param       string  $seeds   Seeds string should be generated from
     */
    static function string($length = 8, $seeds = self::ALPHANUM)
    {
        // Possible seeds
        $seedings[self::ALPHA] = 'abcdefghijklmnopqrstuvwqyz';
        $seedings[self::NUMERIC] = '0123456789';
        $seedings[self::ALPHANUM] = 'abcdefghijklmnopqrstuvwqyz0123456789';
        $seedings[self::HEXIDEC] = '0123456789abcdef';

        // Choose seed
        if (isset($seedings[$seeds]))
        {
            $seeds = $seedings[$seeds];
        }

        // Seed generator
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        mt_srand($seed);

        // Generate
        $str = '';
        $seeds_count = strlen($seeds);

        for ($i = 0; $length > $i; $i++)
        {
            $str .= $seeds{mt_rand(0, $seeds_count - 1)};
        }

        return $str;
    }
    
}