<?php
/**
 * WordPress Fuel
 *
 * @author Muneeb <m4munib@hotmail.com>
 * @copyright WordPress Fuel <wordpressfuel@gmail.com>
 * @twitter     http://twitter.com/#!/wordpressfuel
 */
if(!defined('DS'))
{
    define ('DS', DIRECTORY_SEPARATOR);
}
define('EXT','.php');

define ('CORE_SITE_URL', get_bloginfo('url').'/');
define ('CORE_URL_DOMAIN',  get_option('siteurl').'/');
define ('CORE_ADMIN_URL', CORE_SITE_URL.'wp-admin/admin.php');

define('CORE_WP_CONTENT_PATH',ABSPATH . 'wp-content' . DS);
define('CORE_WP_UPLOAD_PATH',CORE_WP_CONTENT_PATH . 'uploads' . DS);
define('CORE_WP_UPLOAD_URL',CORE_SITE_URL . 'wp-content/uploads/');

define('CORE_MVC_PATH', dirname(__FILE__) . DS);
define('CORE_PATH', CORE_MVC_PATH . 'core' . DS);
define('CORE_VIEWS_PATH', CORE_PATH . 'views' . DS);
define('CORE_CLASSES_PATH', CORE_PATH . 'classes' . DS); 
define('CORE_CONFIG_PATH', CORE_PATH . 'config' . DS);

require_once"wpfuelcore.php";   

WPFuel::init();
?>