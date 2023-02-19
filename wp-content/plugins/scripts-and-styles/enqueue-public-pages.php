<?php
/*
Plugin Name: Enqueue on Public Pages L
Description: Examples showing how to enqueue JavaScript and CSS on public-facing pages.
Plugin URI:  https://example.com/
Author:      Jeff Starr
Version:     2.0
*/

// enqueue public style
function myplugin_enqueue_style_public() {

    $src = plugin_dir_url( __FILE__ ) .'public/css/example-public.css';

    wp_enqueue_style( 'myplugin-public', $src, array(), null, 'all' );

}
// wp_enqueue_scripts is used to include css and js on public pages
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_style_public' );

// enqueue public script
function myplugin_enqueue_script_public() {

    $src = plugin_dir_url( __FILE__ ) .'public/js/example-public.js';

    wp_enqueue_script( 'myplugin-public', $src, array(), null, false );

}
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_script_public' );
