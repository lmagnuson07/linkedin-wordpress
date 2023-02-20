<?php
/*
Plugin Name: Meta Box Example
Description: Example demonstrating how to add Meta Boxes.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

// register meta box
///////////////////////////////////////////////////
/// Meta boxes use the same meta data that are use by custom fields. So you can use any
/// of the default wordpress meta functions to add/delete/update.
function myplugin_add_meta_box() {

    $post_types = array( 'post', 'page' );

    foreach ( $post_types as $post_type ) {

        add_meta_box(
            'myplugin_meta_box',         // Unique ID of meta box
            'MyPlugin Meta Box',         // Title of meta box
            'myplugin_display_meta_box', // Callback function
            $post_type                   // Post type
        );

    }

}
// add_meta_boxes allows meta box registration to target a specific post type. Fires after all built-in meta boxes have been added (every refresh)
// can do add_meta_boxes_posts to target just posts.
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

// display meta box
function myplugin_display_meta_box( $post ) {

    // value is whatever value is saved (in this case option-3 for example)
    // key must be the same as the key in update_post_meta
    $value = get_post_meta( $post->ID, '_myplugin_meta_key', true );

    wp_nonce_field( basename( __FILE__ ), 'myplugin_meta_box_nonce' );

    ?>

    <label for="myplugin-meta-box">Field Description</label>
    <select id="myplugin-meta-box" name="myplugin-meta-box">
        <option value="">Select option...</option>
        <option value="option-1" <?php selected( $value, 'option-1' ); ?>>Option 1</option>
        <option value="option-2" <?php selected( $value, 'option-2' ); ?>>Option 2</option>
        <option value="option-3" <?php selected( $value, 'option-3' ); ?>>Option 3</option>
    </select>

    <?php

}

// save meta box. Process changes
// updates the meta box when the user submits/updates the post
function myplugin_save_meta_box( $post_id ) {

    // Variables to ensure the post is only updated when the update or save post button are pressed.
    // Function gets pass the (int)post_id
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );

    $is_valid_nonce = false;

    if ( isset( $_POST[ 'myplugin_meta_box_nonce' ] ) ) {

        if ( wp_verify_nonce( $_POST[ 'myplugin_meta_box_nonce' ], basename( __FILE__ ) ) ) {

            $is_valid_nonce = true;

        }

    }

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;

    if ( array_key_exists( 'myplugin-meta-box', $_POST ) ) {

        update_post_meta(
            $post_id,                                            // Post ID
            '_myplugin_meta_key',                                // Meta key
            sanitize_text_field( $_POST[ 'myplugin-meta-box' ] ) // Meta value
        );

    }

}
add_action( 'save_post', 'myplugin_save_meta_box' );


