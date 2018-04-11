<?php
/**
* @package CustomPostType
*/
/*
Plugin Name: Custom Post Type
Plugin URI: https://github.com/Dimitrispant/WordPress-Plugins
Description: A simple custom post type plugin
Version: 1.0
Author: Dimitris Pantazatos
Author URI: https://dpant.xyz
License: GPLv2 or later
Text Domain: custom-post-type
*/

defined( 'ABSPATH' ) or die( 'You do not have the right to do it!' );

if ( !class_exists( 'CustomPostType' ) ){

class CustomPostType
{
  
    public $pluginName;
  
    function __construct() {
      $this->pluginName = plugin_basename( __FILE__ );
    }
  
    function register() {
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
      
      add_action( 'admin_menu', array ( $this, 'add_admin_pages') );
      
      add_filter( "plugin_action_links_$this->pluginName", array( $this, 'settings_link') );
    }
    
    public function settings_link( $links ){
      // custom settings link
      $settings_link='<a href="admin.php?page=cpt_plugin">Settings</a>';
      array_push( $links, $settings_link );
      return $links;
    }
    public function add_admin_pages() {
      add_menu_page ('Custom Post Type Plugin','CPT Plugin', 'manage_options', 'cpt_plugin',  array( $this, 'admin_index' ),
      'dashicons-store',100);
    }
    
    public function admin_index() {
     // template
     require_once plugin_dir_path( __FILE__) . 'templates/admin.php';
    }
  
    protected function create_post_type() {
      add_action( 'init', array ( $this, 'custom_post_type' ) );
    }
  
    function activate() {
      require_once plugin_dir_path( __FILE__) . 'inc/custom-post-type-plugin-activate.php';
      CustomPostTypePluginActivate::activate();
    }
  
    function deactivate() {
      require_once plugin_dir_path( __FILE__) . 'inc/custom-post-type-plugin-deactivate.php';
      CustomPostTypePluginDeactivate::deactivate();
    }
  
    function custom_post_type() {
      register_post_type( 'example', ['public' => true, 'label' => 'Example'] );
    }
    
    function enqueue() {
       // enqueue all our scripts
       wp_enqueue_style ( 'pluginstyle', plugins_url( '/assets/style.css', __FILE__) );
       wp_enqueue_style ( 'pluginscript', plugins_url( '/assets/scripts.js', __FILE__) );
    }
  
}

  $customPostType = new CustomPostType();
  $customPostType->register();

// Activation
register_deactivation_hook( __FILE__, array( '$customPostType', 'activate' ) );

// Deactivation
register_deactivation_hook( __FILE__, array( '$customPostType', 'deactivate' ) );

// Uninstall
  
}
