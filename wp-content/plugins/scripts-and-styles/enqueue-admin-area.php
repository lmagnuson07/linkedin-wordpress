<?php
/*
Plugin Name: Enqueue in Admin Area L
Description: Examples showing how to enqueue JavaScript and CSS in the Admin Area.
Plugin URI:  https://example.com/
Author:      Jeff Starr
Version:     2.0
*/

// enqueue admin style
function myplugin_enqueue_style_admin() {

    $src = plugin_dir_url( __FILE__ ) .'admin/css/example-admin.css';

    // wp_register_style() registers the stylesheet for use in other functions in your plugin
    wp_enqueue_style( 'myplugin-admin', $src, array(), null, 'all' );

}
// key to including css files for the admin area.
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_style_admin' );

// enqueue admin script
function myplugin_enqueue_script_admin() {

    $src = plugin_dir_url( __FILE__ ) .'admin/js/example-admin.js';

    // wp_register_script() registers the script for use in other functions in your plugin
    wp_enqueue_script( 'myplugin-admin', $src, array(), null, false );

}
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_script_admin' );
