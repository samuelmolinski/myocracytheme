<?PHP
/**
 * WordPress Fuel - Abstract Shortcode Class
 * 
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
abstract class absMVC_Shortcode
{
    /**
     * Plugin that invokes the short code
     * 
     * @var (absMVC_Plugin)
     */
    protected $_plugin = '';

    public function __construct(absMVC_Plugin $plugin) 
    { 
        $this->_plugin = $plugin;
    }
    
    /**
     *
     * @return absMVC_Plugin 
     */
    protected function getPlugin()
    {
        return $this->_plugin;
    }
}
?>