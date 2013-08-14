<?PHP
if(defined('_WP_FUEL_MVC') == false)
{
    if(class_exists('absMVC_Plugin') == false)
    {
         $wpfuel_loader = WP_PLUGIN_DIR . "/share-social/cunjo_core/load.php";

        if ( file_exists($wpfuel_loader) ) 
        {
             require_once $wpfuel_loader;
        }
        else
        {
            wp_die( __('Cunjo Core Missing.'));
        }

    }
}
?>