<?php
/*
Plugin Name: Custom Fields Example
Description: Example demonstrating how to work with Custom Fields (Post Metadata).
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

// delete custom field for each post
function myplugin_delete_custom_field( $content ) {

    return delete_post_meta( get_the_ID(), 'weekday' );

}
// add_filter( 'the_content', 'myplugin_delete_custom_field' );

// update custom field for each post
function myplugin_update_custom_field( $content ) {

    return update_post_meta( get_the_ID(), 'mood', 'full of joy', 'happy' );

}
// add_filter( 'the_content', 'myplugin_update_custom_field' );

// add custom field for each post
function myplugin_add_custom_field( $content ) {

    $calendar = cal_to_jd( CAL_GREGORIAN, date( 'm' ), date( 'd' ), date( 'Y' ) );
    $weekday = jddayofweek( $calendar, 1 );

    return add_post_meta( get_the_ID(), 'weekday', $weekday, true );

}
// the-content hook fires for every post
 add_filter( 'the_content', 'myplugin_add_custom_field' );

// display specific custom field for each post
function myplugin_display_specific_custom_field( $content ) {

    // get_the_ID works great if using the the_content hook.
    $current_mood = get_post_meta( get_the_ID(), 'mood', true );

    $append_output  = '<div>';
    $append_output .= esc_html__( 'Feeling ' );
    $append_output .= sanitize_text_field( $current_mood );
    $append_output .= '</div>';

    return $content . $append_output;

}
// add_filter( 'the_content', 'myplugin_display_specific_custom_field' );

// display all custom fields for each post
function myplugin_display_all_custom_fields( $content ) {

    $custom_fields = '<h3>Custom Fields</h3>';

    // returns an array of all custom fields attached to the post
    $all_custom_fields = get_post_custom();

    foreach ( $all_custom_fields as $key => $array ) {

        foreach ( $array as $value ) {

            // if ( '_' !== substr( $key, 0, 1 ) )

            $custom_fields .= '<div>'. $key .' => '. $value .'</div>';

        }

    }

    return $content . $custom_fields;

}
//add_filter( 'the_content', 'myplugin_display_all_custom_fields' );


