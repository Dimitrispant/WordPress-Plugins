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

class CustomPostType
{
    
    function __construct() {
      add_action( 'init', array ( $this, 'custom_post_type' ) );
    }
  
    function activate() {
      // generated a CPT - If init fails
      $this->custom_post_type();
      // flush rewrite rules
      flush_rewrite_rules();
    }
  
    function deactivate() {
      // flush rewrite rules
      flush_rewrite_rules();
    }
  
    function custom_post_type() {
      register_post_type( 'example', ['public' => true, 'label' => 'Example'] );
      
    }
  
}

if ( class_exists( 'CustomPostType' ) ){
  $customPostType = new CustomPostType();
}

// Activation
register_activation_hook( __FILE__, array( $customPostType, 'activate' ) );

// Deactivation
register_deactivation_hook( __FILE__, array( $customPostType, 'deactivate' ) );

// Uninstall
