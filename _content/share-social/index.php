<?PHP
/* 
Plugin Name: !Share
Plugin URI: http://share.cunjo.com
Description: Cunjo's !Share Social Plugin is a free, pretty, flexible and mobile ready Social Share Plugin. Way Better than most famous similar providers.
Version: 2.0.3
Author: Biro Florin, Josh Foote
Author URI: http://cunjo.com/
License: GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; 

License URI: http://www.gnu.org/licenses/gpl.html
*/

ini_set('memory_limit', '-1');
require_once "mvc/init.php";
include_once(WP_PLUGIN_DIR . "/share-social/mvc/controls/cunjoshare/inline_bar.php");

if(class_exists('WPFuel_CunjoShare_Plugin') == false){
    class WPFuel_CunjoShare_Plugin extends absMVC_Plugin
    {
        protected $_plugin_slug = 'cunjoshare';
        private $tab_control;
        // installation related
        protected $db;
        protected $_table;
         
         /**
         * WPFuel_CunjoShare_Plugin::_init()
         * Installs and initalizes plugin essentials
         * @return
         */
        protected function _init()
        {
            global $wpdb;
            
            // handles all generic functionality, such as outputting a bar,
            // activating, deactivating, loading modals etc.
            // DispatchRequest is used to handle all bar specific functionality
            $this->tab_control = new inline_bar_outputter();
            
            $this->db = $wpdb;
            $this->_table = $wpdb->prefix . "cunjoshare";
            add_action('init', array($this, 'create_share_tax'), 0);
            
            $this->add_action("wp_head", 'SetBarLoadedSessions', 10);
			$this->add_action("wp_footer", 'SetCunjoFooterScripts', 10);
            $this->init_tabs();
        }
         
         /**
         * WPFuel_CunjoShare_Plugin::init_tabs()
         * Installs all initial hooks related to displaying tabs
         * 
         * @return void
         */
        protected function init_tabs()
        {
            $this->add_action("cunjo_widgets_settings", "HandleSettingModals");
            $this->add_action("cunjo_display_credits", "HandleCredits");
            $this->add_action("wp_footer", 'DisplayBar');
            $this->add_filter('the_content', 'DisplayInlineBar');
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::_initAjax()
         * Installs plugin related AJAX hooks
         * 
         * @return void
         */
        protected function _initAjax()
        {
           $this->add_ajax_action("SaveGeneralSetting", "handleAjaxRequest");
           $this->add_ajax_action("SaveWidgetSetting", "handleAjaxRequest");
           $this->add_ajax_action("SaveWidgetSettings", "handleAjaxRequest");
           $this->init_tabs_ajax();
        }
        
         /**
         * WPFuel_CunjoShare_Plugin::init_tabs_ajax()
         * Installs all ajax hooks related to tabs
         * 
         * @return void
         */
        protected function init_tabs_ajax()
        {
            // bottom bar ajax
            $this->add_ajax_action("bottom_tab_activate", "handleAjaxRequest");
            $this->add_ajax_action("bottom_tab_deactivate", "handleAjaxRequest");
        
            // left bar ajax
            $this->add_ajax_action("left_tab_activate", "handleAjaxRequest");
            $this->add_ajax_action("left_tab_deactivate", "handleAjaxRequest");
        
            // right tab ajax
            $this->add_ajax_action("right_tab_activate", "handleAjaxRequest");
            $this->add_ajax_action("right_tab_deactivate", "handleAjaxRequest");
        
            // top tab ajax
            $this->add_ajax_action("top_tab_activate", "handleAjaxRequest");
            $this->add_ajax_action("top_tab_deactivate", "handleAjaxRequest");
            
            // bottom elegant tab ajax
            $this->add_ajax_action("bottom_elegant_tab_activate", "handleAjaxRequest");
            $this->add_ajax_action("bottom_elegant_tab_deactivate", "handleAjaxRequest");
            
            // inline buttons tab ajax
            $this->add_ajax_action("inline_buttons_activate", "handleAjaxRequest");
            $this->add_ajax_action("inline_buttons_deactivate", "handleAjaxRequest");
        
            // left elegant tab
            $this->add_ajax_action("left_elegant_tab_activate", "handleAjaxRequest");
            $this->add_ajax_action("left_elegant_tab_deactivate", "handleAjaxRequest");
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::HandleCredits()
         * Retrieves credits for each tab
         * 
         * @return void
         */
        public function HandleCredits()
        {
            $this->dispatchRequest("BottomTab/HandleCredits", array());
            $this->dispatchRequest("LeftTab/HandleCredits", array());
            $this->dispatchRequest("RightTab/HandleCredits", array());
            $this->dispatchRequest("TopTap/HandleCredits", array());
            $this->dispatchRequest("BottomElegantTab/HandleCredits", array());
            $this->dispatchRequest("InlineButtons/HandleCredits", array());
            $this->dispatchRequest("LeftElegantTab/HandleCredits", array());
        }
        
         /**
         * WPFuel_CunjoShare_Plugin::HandleSettingModals()
         * Retrives setting modals for each tab
         * 
         * @param mixed $data
         * @return
         */
        public function HandleSettingModals($data = array())
        {    
            $response = $this->dispatchRequest("BottomTab/GetSettingModals", array($data));
            $response .= $this->dispatchRequest("LeftTab/GetSettingModals", array($data));
            $response .= $this->dispatchRequest("RightTab/GetSettingModals", array($data));
            $response .= $this->dispatchRequest("TopTab/GetSettingModals", array($data));
            $response .= $this->dispatchRequest("BottomElegantTab/GetSettingModals", array());
            $response .= $this->dispatchRequest("InlineButtons/GetSettingModals", array());
            $response .= $this->dispatchRequest("LeftElegantTab/GetSettingModals", array());
            
            echo $response;
            return;
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::activate_default_tabs()
         * Installs DB settings for each tab
         * 
         * @return void
         */
        protected function activate_default_tabs()
        {
            $this->dispatchRequest("BottomTab/install", array());
            $this->dispatchRequest("LeftTab/install", array());
            $this->dispatchRequest("RightTab/install", array());
            $this->dispatchRequest("TopTab/install", array());
            $this->dispatchRequest("BottomElegantTab/install", array());
            $this->dispatchRequest("InlineButtons/install", array());
            $this->dispatchRequest("LeftElegantTab/install", array());
        }
        
         /**
          * WPFuel_CunjoShare_Plugin::deactivate_default_tabs()
          * Uninstalls DB settings for each tab
          * 
          * @return void
          */
        protected function deactivate_default_tabs()
        {
            // bottom bar uninstall
            $this->dispatchRequest("BottomTab/uninstall", array());
            $this->dispatchRequest("LeftTab/uninstall", array());
            $this->dispatchRequest("RightTab/uninstall", array());
            $this->dispatchRequest("TopTap/uninstall", array());
            $this->dispatchRequest("BottomElegantTab/uninstall", array());
            $this->dispatchRequest("InlineButtons/uninstall", array());
            $this->dispatchRequest("LeftElegantTab/uninstall", array());
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::DisplayBar()
         * Displays page related tabs
         * 
         * @param mixed $data
         * @return
         */
        public function DisplayBar($data = array())
        {    
            echo $this->tab_control->set_display_layout("bottom_tab")->display_bar();
            echo $this->tab_control->set_display_layout("left_tab")->display_bar($data);
            echo $this->tab_control->set_display_layout("right_tab")->display_bar();
            echo $this->tab_control->set_display_layout("bottom_tab")->display_bar();
            echo $this->tab_control->set_display_layout("top_tab")->display_bar();
            echo $this->tab_control->set_display_layout("bottom_elegant_tab")->display_bar();
            return;
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::DisplayInlineBar()
         * Displays inline post related tabs
         * 
         * @param mixed $data
         * @return void
         */
        public function DisplayInlineBar($data = array())
        {
            $inline_buttons     = $this->tab_control->set_display_layout("inline_buttons")->display_bar($data);
            $left_elegant_bar   = $this->tab_control->set_display_layout("left_elegant_tab")->display_bar();
            return $left_elegant_bar . $inline_buttons;
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::default_tabs_assets()
         * Installs all default tab assets
         * 
         * @return void
         */
        protected function default_tabs_assets()
        {
            // bottom tab assets
            wp_enqueue_script( 'cunjo-bottom_tab-admin', plugins_url( '/assets/js/tabs/bottom_tab.actions.admin.js', __FILE__ ), true, '2.0.0' );   
            // left tab assets
            wp_enqueue_script( 'cunjo-left_tab-admin', plugins_url( '/assets/js/tabs/left_tab.actions.admin.js', __FILE__ ), true, '2.0.0' );
            // right tab assets
            wp_enqueue_script( 'cunjo-right_tab-admin', plugins_url( '/assets/js/tabs/right_tab.actions.admin.js', __FILE__ ), true, '2.0.0' );
            // top tab assets
            wp_enqueue_script( 'cunjo-top_tab-admin', plugins_url( '/assets/js/tabs/top_tab.actions.admin.js', __FILE__ ), true, '2.0.0' );
            // bottom elegant tab assets
            wp_enqueue_script( 'cunjo-bottom_elegant_tab-admin', plugins_url( '/assets/js/tabs/bottom_elegant_tab.actions.admin.js', __FILE__ ), true, '2.0.0' );
            // inline buttoms assets
            wp_enqueue_script( 'cunjo-inline_buttons-admin', plugins_url( '/assets/js/tabs/inline_buttons.actions.admin.js', __FILE__ ), true, '2.0.0' );
            // left elegant tab
            wp_enqueue_script( 'cunjo-left_elegant_tab-admin', plugins_url( '/assets/js/tabs/left_elegant_tab.actions.admin.js', __FILE__ ), true, '2.0.0' );
        }
        
         
        /**
         * WPFuel_CunjoShare_Plugin::SetBarLoadedSessions()
         * Ensures certain bars dont display their anchors more than once
         * 
         * @param mixed $data
         * @return
         */
        public function SetBarLoadedSessions($data = array())
        {    
			global $post;
            if(isset($_SESSION['left_elegant_bar']))
                unset($_SESSION['left_elegant_bar']);
                
            //$post_thumbnail_id = get_post_thumbnail_id();
			
            $headfixes = '<meta property="og:image" content="'.wp_get_attachment_thumb_url( get_post_thumbnail_id(), 'thumbnail' ).'"/>';
			
			echo $headfixes;
            return;
        }
        
        /**
         * WPFuel_CunjoShare_Plugin::SetCunjoFooterScripts()
         * 
         * @return
         */
        public function SetCunjoFooterScripts()
		{
			$footerfixes = '<script type="text/javascript">
				jQuery(document).ready(function() {
					if (typeof cunjo_get_share == "function") {
					  //do nothing cause itworks
					}
					else {
						cunjo_check_library();
					}
				});
			</script>';
			
			echo $footerfixes;
            return;
		}
        
        /**
         * WPFuel_CunjoShare_Plugin::handleAjaxRequest()
         * Handles activate, deactiave and other AJAX calls
         * 
         * @return
         */
        public function handleAjaxRequest()
        {
            $response = "No POST data";
            if(WPFuel::isPost() && isset($_POST['action']) && isset($_POST['controller'])) 
            {
                $data = clsSanitize::safe($_POST);
                $_POST = $data;
                
                // if we're trying to activate a widget, make sure we have a share ID
                if(strstr($_POST['action'], "activate")){
                    $share_id = get_option('cunjoshare_shareid');
                    if(!$share_id OR strlen($share_id) <= 0){
                        echo json_encode(array("status" => "error", 'message' => "You must have a share ID in order to activate widgets!"));
                        exit;
                    }   
                }
                
                unset($_POST['action']);
                unset($_POST['controller']);
                $response = $this->dispatchRequest($data['controller'], $_POST);     
            }

            echo $response;
            exit;
        }


        /**
         * WPFuel_CunjoShare_Plugin::_activate()
         * Called on plugin activation, installs tables and tabs
         * 
         * @return void
         */
        protected function _activate()
        {
             $sql = "CREATE TABLE IF NOT EXISTS $this->_table (
                      id INT NOT NULL AUTO_INCREMENT ,
                      layout VARCHAR(255) NULL ,
                      category VARCHAR(45) NULL ,
                      option_name VARCHAR(45) NULL ,
                      option_value TEXT NULL ,
                      date_added DATE NULL ,
                      PRIMARY KEY  (id) ,
                      UNIQUE KEY fk_option (option_name ASC, layout ASC) )
                    ENGINE = InnoDB";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($sql);
            add_option("cunjoshare_db_version", "1.0");
            
            $this->activate_default_tabs();
        }

        /**
         * WPFuel_CunjoShare_Plugin::_deactivate()
         * Called on plugin deactivation, removes all default tab settings
         * 
         * @return void
         */
        protected function _deactivate()
        {
            $this->deactivate_default_tabs();
            //$this->db->query("DROP TABLE $this->_table");
            delete_option("cunjoshare_db_version");
        }

        /**
         * WPFuel_CunjoShare_Plugin::registerAdminMenu()
         * 
         * @return
         */
        public function registerAdminMenu()
        {
            $role = 'administrator';
            
            $page_hook_suffixs[] = add_menu_page("!Share by Cunjo", "!Share by Cunjo", $role, $this->_getAdminPageSlug('Settings/Introduction'), array($this, 'handleAdminMenu'), plugins_url('share-social/assets/images/cunjo_logo-16.png')); 
            
            $page_hook_suffixs[] = add_submenu_page($this->_getAdminPageSlug('Settings/Introduction'), 'General settings', 'General settings', $role, 
                $this->_getAdminPageSlug('Settings/SetSettings'), array($this, 'handleAdminMenu')
            );

            $page_hook_suffixs[] = add_submenu_page($this->_getAdminPageSlug('Settings/Introduction'), 'Social Analytics', 'Social Analytics', $role, 
                $this->_getAdminPageSlug('SocialAnalytics/LoadAnalytics'), array($this, 'handleAdminMenu')
            );

            $page_hook_suffixs[] = add_submenu_page($this->_getAdminPageSlug('Settings/Introduction'), 'Available widgets', 'Available widgets', $role, 
                $this->_getAdminPageSlug('Settings/ShowWidgets'), array($this, 'handleAdminMenu')
            );
            
            $page_hook_suffixs[] = add_submenu_page($this->_getAdminPageSlug('Settings/ShowWidgets'), 'Credits', 'Credits', $role, 
                $this->_getAdminPageSlug('Settings/Credits'), array($this, 'handleAdminMenu')
            );
            
            foreach($page_hook_suffixs as $page_hook_suffix)
                add_action('admin_print_scripts-' . $page_hook_suffix, array($this, 'my_admin_assets'));
        }

        /**
         * WPFuel_CunjoShare_Plugin::front_assets()
         * 
         * @return void
         */
        public function front_assets()
        {
            wp_enqueue_script('cunjo_share', 'http://cunjo.com/!Share_test/js/!Share.js'); 
        }

        /**
         * WPFuel_CunjoShare_Plugin::admin_assets()
         * 
         * @return
         */
        public function my_admin_assets()
        {
			//CSS Libraries
			wp_enqueue_style('cunjo-bootstrap-min', plugins_url('/assets/bootstrap/css/bootstrap.css', __FILE__), false, '2.3.0','all');
			wp_enqueue_style('cunjo-bootstrap-responsive-min', plugins_url('/assets/bootstrap/css/bootstrap-responsive.min.css', __FILE__), false, '2.3.0','all');
			wp_enqueue_style('cunjo-bootstrap-jasny-min', plugins_url('/assets/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-bootstrap-jasny-responsive-min', plugins_url('/assets/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-bootstrap-wysihtml5', plugins_url('/assets/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css', __FILE__), false, '0.0.2','all');
			wp_enqueue_style('cunjo-scripts-select2', plugins_url('/assets/scripts/select2/select2.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-scripts-notify', plugins_url('/assets/scripts/notyfy/jquery.notyfy.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-scripts-notify-default', plugins_url('/assets/scripts/notyfy/themes/default.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-scripts-jqueryui-smoothness', plugins_url('/assets/scripts/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.min.css', __FILE__), false, '1.9.2','all');
			wp_enqueue_style('cunjo-app-icons', 'http://cunjo.com/assetz/css/app_icons/style.css', false, '1.0.0','all');
			wp_enqueue_style('cunjo-bootstrap-select', plugins_url('/assets/bootstrap/extend/bootstrap-select/bootstrap-select.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-bootstrap-toggle-buttons-css', plugins_url('/assets/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css', __FILE__), false, '1.0.0','all');
			wp_enqueue_style('cunjo-scripts-uniform-default', plugins_url('/assets/scripts/pixelmatrix-uniform/css/uniform.default.css', __FILE__), false, '1.7.5','all');
			wp_enqueue_style('cunjo-scripts-miniColors', plugins_url('/assets/scripts/jquery-miniColors/jquery.miniColors.css', __FILE__), false, '2.0.0','all');
			wp_enqueue_style('cunjo-scripts-msgbox', plugins_url('/assets/scripts/msgbox/jquery.msgbox.css', __FILE__), false, '1.3.5','all');
			wp_enqueue_style('farbtastic', plugins_url('/assets/scripts/farbtastic/farbtastic.css', __FILE__), false, '1.2.0','all');

			//CSS Admin
            wp_enqueue_style('plugin-css-admin', plugins_url('/assets/css/admin.css', __FILE__), false, '2.0.0','all');

			//JS Libraries
			wp_enqueue_script( 'jquery' );

			wp_enqueue_script( 'jquery-ui-widget' );
			wp_enqueue_script( 'jquery-ui-position' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script( 'jquery-ui-menu' );

			wp_enqueue_script('sortable', plugins_url( '/assets/js/jquery.sortable.js', __FILE__), false, '1.1.1');
			wp_enqueue_script( 'cunjo-zclip', plugins_url( '/assets/js/zclip.js', __FILE__ ), false, '1.1.1' );
			wp_enqueue_script( 'cunjo-scripts-modernizr-custom', plugins_url( '/assets/scripts/modernizr.custom.76094.js', __FILE__ ), false, '2.6.2' );
			wp_enqueue_script( 'cunjo-scripts-less', plugins_url( '/assets/scripts/less-1.3.3.min.js', __FILE__ ), false, '1.3.3' );
			wp_enqueue_script( 'cunjo-scripts-ui-touch-punch', plugins_url( '/assets/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js', __FILE__ ), false, '0.2.2' );
			wp_enqueue_script( 'cunjo-scripts-miniColors', plugins_url( '/assets/scripts/jquery-miniColors/jquery.miniColors.js', __FILE__ ), false, '2.0.0' );
			wp_enqueue_script( 'cunjo-scripts-select2', plugins_url( '/assets/scripts/select2/select2.js', __FILE__ ), false, '1.0.0' );
			wp_enqueue_script( 'cunjo-scripts-cookie', plugins_url( '/assets/scripts/jquery.cookie.js', __FILE__ ), false, '1.3.0' );
			wp_enqueue_script( 'cunjo-scripts-notify', plugins_url( '/assets/scripts/notyfy/jquery.notyfy.js', __FILE__ ), false, '1.0.0' );
			wp_enqueue_script( 'cunjo-scripts-ba-resize', plugins_url( '/assets/scripts/jquery.ba-resize.js', __FILE__ ), false, '1.1.0' );
			wp_enqueue_script( 'cunjo-scripts-uniform', plugins_url( '/assets/scripts/pixelmatrix-uniform/jquery.uniform.min.js', __FILE__ ), false, '1.7.5' );
			wp_enqueue_script( 'cunjo-bootstrap-min', plugins_url( '/assets/bootstrap/js/bootstrap.js', __FILE__ ), false, '2.3.0' );
			wp_enqueue_script( 'cunjo-bootstrap-select', plugins_url( '/assets/bootstrap/extend/bootstrap-select/bootstrap-select.js', __FILE__ ), false, '2.3.0' );
			wp_enqueue_script( 'cunjo-bootstrap-toggle-buttons', plugins_url( '/assets/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js', __FILE__ ), false, '1.0.0' );
			wp_enqueue_script( 'cunjo-bootstrap-hover-dropdown', plugins_url( '/assets/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js', __FILE__ ), false, '2.3.0' );
			wp_enqueue_script( 'cunjo-bootstrap-jasny-min', plugins_url( '/assets/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js', __FILE__ ), false, '1.0.0' );
			wp_enqueue_script( 'cunjo-bootstrap-jasny-fileupload', plugins_url( '/assets/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js', __FILE__ ), false, '1.0.0' );
			wp_enqueue_script( 'cunjo-bootstrap-bootbox', plugins_url( '/assets/bootstrap/extend/bootbox.js', __FILE__ ), false, '2.5.0' );
			wp_enqueue_script( 'cunjo-bootstrap-wysihtml5-rc', plugins_url( '/assets/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js', __FILE__ ), false, '0.0.2' );
			wp_enqueue_script( 'cunjo-bootstrap-wysihtml5', plugins_url( '/assets/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js', __FILE__ ), false, '0.0.2' );
			wp_enqueue_script( 'cunjo-scripts-msgbox', plugins_url( '/assets/scripts/msgbox/jquery.msgbox.js', __FILE__ ), false, '1.3.5' );
			wp_enqueue_script( 'farbtastic', plugins_url( '/assets/scripts/farbtastic/farbtastic.js', __FILE__ ), false, '1.2.0' );

			//JS Admin
			wp_enqueue_script( 'cunjo-load-admin', plugins_url( '/assets/js/load.admin.js', __FILE__ ), false, '2.0.0' );
			wp_enqueue_script( 'cunjo-layout-admin', plugins_url( '/assets/js/layout.admin.js', __FILE__ ), false, '2.0.0' );
			wp_enqueue_script( 'cunjo-actions-admin', plugins_url( '/assets/js/actions.admin.js', __FILE__ ), false, '2.0.0' );
        
            $this->default_tabs_assets();
        }

        /**
         * WPFuel_CunjoShare_Plugin::create_share_tax()
         * 
         * @return void
         */
        public function create_share_tax() 
        {
            $taxonomy_exist = taxonomy_exists('cunjo-share-cat');
            if(!$taxonomy_exist) {
                $labels = array(
                    'name'                => _x( '!Share categories', 'taxonomy general name' ),
                    'singular_name'       => _x( '!Share category', 'taxonomy singular name' ),
                    'search_items'        => __( 'Search !Share categories' ),
                    'all_items'           => __( 'All !Share categories' ),
                    'parent_item'         => __( 'Parent !Share category' ),
                    'parent_item_colon'   => __( 'Parent !Share category:' ),
                    'edit_item'           => __( 'Edit !Share category' ), 
                    'update_item'         => __( 'Update !Share category' ),
                    'add_new_item'        => __( 'Add New !Share category' ),
                    'new_item_name'       => __( 'New !Share category Name' ),
                    'menu_name'           => __( '!Share category' )
                ); 	

                $args_taxonomy = array(
                    'hierarchical'        => true,
                    'labels'              => $labels,
                    'show_ui'             => true,
                    'show_admin_column'   => true,
                    'query_var'           => true,
                    'rewrite'             => array( 'slug' => 'cunjo-share-cat' )
                );

                $args_post_types =array(
                  'public'   => true,
                  '_builtin' => false
                ); 

                $output = 'names'; // names or objects, note names is the default
                $operator = 'and'; // 'and' or 'or'
                $post_types = get_post_types($args_post_types, $output); 
        		$builtin = array('post', 'page');        
        		$post_types = array_merge($post_types, $builtin);

               //$post_types = implode(',', $post_types);
                register_taxonomy( 'cunjo-share-cat', $post_types, $args_taxonomy);

                wp_insert_term( 'Health', 'cunjo-share-cat');
                wp_insert_term( 'Arts & Entertainment', 'cunjo-share-cat');
                wp_insert_term( 'Beauty', 'cunjo-share-cat');
                wp_insert_term( 'Business', 'cunjo-share-cat');
                wp_insert_term( 'Clothing', 'cunjo-share-cat');
                wp_insert_term( 'Consumer Electronics', 'cunjo-share-cat');
                wp_insert_term( 'Education', 'cunjo-share-cat');
                wp_insert_term( 'Family & Parenting', 'cunjo-share-cat');
                wp_insert_term( 'Finance', 'cunjo-share-cat');
                wp_insert_term( 'Fitness', 'cunjo-share-cat');
                wp_insert_term( 'Food & Drinks', 'cunjo-share-cat');
                wp_insert_term( 'Games', 'cunjo-share-cat');
                wp_insert_term( 'Government', 'cunjo-share-cat');
                wp_insert_term( 'Automotive', 'cunjo-share-cat');
                wp_insert_term( 'Home Gardening', 'cunjo-share-cat');
                wp_insert_term( 'Investments', 'cunjo-share-cat');
                wp_insert_term( 'Jewelry', 'cunjo-share-cat');
                wp_insert_term( 'Jobs', 'cunjo-share-cat');
                wp_insert_term( 'Legal', 'cunjo-share-cat');
                wp_insert_term( 'Music', 'cunjo-share-cat');
                wp_insert_term( 'Pets', 'cunjo-share-cat');
                wp_insert_term( 'Real Estate', 'cunjo-share-cat');
                wp_insert_term( 'Religion', 'cunjo-share-cat');
                wp_insert_term( 'Science', 'cunjo-share-cat');
                wp_insert_term( 'Sports', 'cunjo-share-cat');
                wp_insert_term( 'Technology', 'cunjo-share-cat');
                wp_insert_term( 'Travel', 'cunjo-share-cat');
            }
        }
    }
}

new WPFuel_CunjoShare_Plugin(__FILE__);

?>