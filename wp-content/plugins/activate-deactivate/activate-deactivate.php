<?php
/*
Plugin Name: Deactivation & Activation
Description: Example demonstrating activation, deactivation, and uninstall hooks.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

// do stuff on activation
function myplugin_on_activation() {

    if ( ! current_user_can( 'activate_plugins' ) ) return;

    // Adds record to the option table in wp database
    add_option( 'myplugin_posts_per_page', 10 );
    add_option( 'myplugin_show_welcome_page', true );

}
// triggers when the plugin is activated
register_activation_hook( __FILE__, 'myplugin_on_activation' );

// do stuff on deactivation
function myplugin_on_deactivation() {
//    wp_die('The plugin has been deactivated');
    if ( ! current_user_can( 'activate_plugins' ) ) return;

    flush_rewrite_rules();

}
// triggers then the plugin is deactivated
register_deactivation_hook( __FILE__, 'myplugin_on_deactivation' );

// do stuff on uninstall
function myplugin_on_uninstall() {

    if ( ! current_user_can( 'activate_plugins' ) ) return;

    // Delete record from the option table in wp database
    delete_option( 'myplugin_posts_per_page', 10 );
    delete_option( 'myplugin_show_welcome_page', true );

}
// triggers when the plugin is uninstalled
register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );
