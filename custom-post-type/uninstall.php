<?php

/**
* Triggered when the plugin is uninstalled
*
* @package CustomPostType
*/

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  die;
}

// There are two ways to delete the posts. Choose the way you like!

// First Way
// Clear Database stored data

/*
$examples = get_posts( array ('post_type' => 'example', 'numberposts' => -1 ) );

foreach( $examples as $example ) {
  wp_delete_post( $example->ID, true ); 
}
*/

// Second Way
// Access the database via SQL

global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type='example'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
