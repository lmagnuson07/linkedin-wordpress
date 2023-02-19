<?php
/*
Plugin Name: Custom Post Type Example
Description: Example demonstrating how to add a Custom Post Type via plugin.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

// add custom post type
function myplugin_add_custom_post_type() {

    /*

        For a list of $args, check out:
        https://developer.wordpress.org/reference/functions/register_post_type/

    */

    $args = array(
        'labels'             => array( 'name' => 'Movies' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'movie' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'movie', $args );

}
add_action( 'init', 'myplugin_add_custom_post_type' );

// add custom taxonomy
function myplugin_add_custom_taxonomy() {

    /*

        For a list of $args, check out:
        https://developer.wordpress.org/reference/functions/register_taxonomy/

    */

    $args = array(
        'labels'            => array( 'name' => 'Art' ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
    );

    register_taxonomy( 'art', 'post', $args );

}
add_action( 'init', 'myplugin_add_custom_taxonomy' );
