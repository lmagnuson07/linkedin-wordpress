<?php
/*
Plugin Name: Enqueue on Login Page L
Description: Examples showing how to enqueue JavaScript and CSS on the Login Page.
Plugin URI:  https://example.com/
Author:      Jeff Starr
Version:     2.0
*/

// enqueue login style
function myplugin_enqueue_style_login() {

    $src = plugin_dir_url( __FILE__ ) .'admin/css/example-admin.css';

    wp_enqueue_style( 'myplugin-login', $src, array(), null, 'all' );

}
// login_enqueue_scripts is used to include css and js on the login pages
add_action( 'login_enqueue_scripts', 'myplugin_enqueue_style_login' );

// enqueue login script
function myplugin_enqueue_script_login() {

    $src = plugin_dir_url( __FILE__ ) .'admin/js/example-admin.js';

    wp_enqueue_script( 'myplugin-login', $src, array(), null, false );

}
add_action( 'login_enqueue_scripts', 'myplugin_enqueue_script_login' );


