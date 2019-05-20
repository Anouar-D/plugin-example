<?php
    /**
    * @package plugin-example
    */

    /*
        Plugin Name: plugin-example
        Description: This plugin is a test plugin to learn how to code into wordpress using php.
        Author: Anouar Douiyeb
        Version: 0.1.0
    */


    defined('ABSPATH') or die('YOU SHALL NOT PASS!');
    if(!class_exists('Plugin-example')){
        class Plugin {

            public $plugin;

            public function __construct(){
                $this->$plugin = plugin_basename(__FILE__); 
            }

            public function register_admin_scripts(){
                add_action('admin_enqueue_scripts', array($this, 'enqueue'));

                add_action( 'admin_menu', array($this, 'add_admin_pages'));

                add_filter('plugin_action_links_'.$this->$plugin, array($this, 'setting_link'));
            }

            public function setting_link($links){
                // add custom settings link
                $settings_link = '<a href="admin?page=plugin">Settings</a>';
                array_push($links, $settings_link);
                return $links; 
            }

            public function add_admin_pages(){
                add_menu_page( 'Plugin', 'Plugin', 'manage_options', 'plugin', array($this, 'admin_index'), 'dashicons-admin-generic', 110);
            }

            public function admin_index(){
                require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
            }

            public function activate(){
                require_once plugin_dir_path(__FILE__) . 'config/plugin-example-activate.php';
                $this->custom_post_type();
                PluginExampleActivate::activate();
                
            }

            public function deactivate(){
                require_once plugin_dir_path(__FILE__) . 'config/plugin-example-deactivate.php';
                PluginExampleDeactivate::deactivate();
            }

            protected function create_post_type(){
                add_action('init', array($this, 'custom_post_type'));
            }

            function custom_post_type(){
                register_post_type('book', ['public' => true, 'label' => 'Manga']);
            }

            public function enqueue(){
                wp_enqueue_style( 'pluginStyle', plugins_url( '/assets/main.css', __FILE__ ));
                wp_enqueue_script( 'pluginScript', plugins_url( '/assets/main.js', __FILE__ ));

            }
        }
    }

    if(class_exists('Plugin')){
        $plugin = new Plugin();
        $plugin->register_admin_scripts();
    }
    else{
        echo "Class doesn't exist.";
        die;
    }

    // activation
    register_activation_hook(__FILE__, array($plugin, 'activate'));
    // deactivation
    register_deactivation_hook(__FILE__, array($plugin, 'deactivate'));

?>







