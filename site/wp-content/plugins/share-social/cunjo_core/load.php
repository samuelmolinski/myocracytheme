<?PHP
/**
 * WordPress Fuel Loader
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
if(defined('_WP_FUEL_MVC') == false)
{
    require_once "bootstrap.php";
    
    class WPFuelCoreHelper
    {
        static function assembleAdminMenuUri($plugin_file)
        {
            $core_url = '';
            $page = $_GET['page'];
            if($page == $plugin_file)
            {
                $page = '';
            }
            
            if(is_admin())
            {
                $core_url = $page;
                if($core_url != '' && isset($_GET['method']))
                {
                    if($_GET['method'] != '')
                    {
                        $core_url = $core_url .'/'. urldecode($_GET['method']);
                    }
                }
            }

            return $core_url;
        }
        
        static function assembleAjaxUri()
        {
            $core_url = '';

            $controller = clsRequest::initial()->getParam('core_controller','');
            
            if($controller == '')
                return;
            
            $core_url = $controller;
            
            $core_action = clsRequest::initial()->getParam('core_action','');
            
            if($core_action != '')
            {
                $core_url = $core_url .'/'. urldecode($core_action);
            }
        

            return $core_url;
        }
        
        static function getBlogInfoData() 
        {
                return array(
                  'blog_title' => self::_getBlogTitle(),
                  'name' => get_bloginfo('name'),
                  'description' => get_bloginfo('description'),
                  'admin_email' => get_bloginfo('admin_email'),

                  'url' => get_bloginfo('url'),
                  'wpurl' => get_bloginfo('wpurl'),

                  'stylesheet_directory' => get_bloginfo('stylesheet_directory'),
                  'stylesheet_url' => get_bloginfo('stylesheet_url'),
                  'template_directory' => get_bloginfo('template_directory'),
                  'template_url' => get_bloginfo('template_url'),

                  'atom_url' => get_bloginfo('atom_url'),
                  'rss2_url' => get_bloginfo('rss2_url'),
                  'rss_url' => get_bloginfo('rss_url'),
                  'pingback_url' => get_bloginfo('pingback_url'),
                  'rdf_url' => get_bloginfo('rdf_url'),

                  'comments_atom_url' => get_bloginfo('comments_atom_url'),
                  'comments_rss2_url' => get_bloginfo('comments_rss2_url'),

                  'charset' => get_bloginfo('charset'),
                  'html_type' => get_bloginfo('html_type'),
                  'language' => get_bloginfo('language'),
                  'text_direction' => get_bloginfo('text_direction'),
                  'version' => get_bloginfo('version'),
                );
          }
          
          private static function _getBlogTitle() 
          {
                if (is_home()) 
                {
                    return get_bloginfo('name');
                } 
                else 
                {
                    return wp_title("-", false, "right");
                }
          }
    }
    
   
    if(function_exists('wpfuel_plugin_init') == false)
    {
        add_action('init', 'wpfuel_plugin_init');
        function wpfuel_plugin_init() 
        {
            clsSession::instance(); 
            ob_start();
        }
    }

}
?>