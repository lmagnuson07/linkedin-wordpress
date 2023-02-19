<?php
/*
Plugin Name: Enqueue Inline L
Description: Examples showing how to enqueue inline JavaScript and CSS.
Plugin URI:  https://example.com/
Author:      Jeff Starr
Version:     2.0
*/

// enqueue public inline style
function myplugin_inline_style_public() {

    // enqueue CSS file

    $src = plugin_dir_url( __FILE__ ) .'public/css/example-public.css';

    // handle (id): myplugin-public must match wp_add_inline_style handle
    wp_enqueue_style( 'myplugin-public', $src, array(), null, 'all' );

    // add inline CSS

//    $css = 'body { color: red !important; }';
    $css = '';

    // handle (id): myplugin-public must match wp_enqueue_style
    wp_add_inline_style( 'myplugin-public', $css );

}
add_action( 'wp_enqueue_scripts', 'myplugin_inline_style_public' );

// enqueue public inline script
function myplugin_inline_script_public() {

    // enqueue JS file

    $src = plugin_dir_url( __FILE__ ) .'public/js/example-public.js';

    // handle (id): myplugin-public must match wp_add_inline_script handle
    wp_enqueue_script( 'myplugin-public', $src, array(), null, false );

    // add inline JavaScript

//    $js = 'alert("Hello world!");';
    $js = '';

    // handle (id): myplugin-public must match wp_enqueue_script
    wp_add_inline_script( 'myplugin-public', $js );

}
add_action( 'wp_enqueue_scripts', 'myplugin_inline_script_public' );

