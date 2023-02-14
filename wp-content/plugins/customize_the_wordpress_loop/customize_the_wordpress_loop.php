<?php
/*
Plugin Name: Custom Loops: get_posts()
Description: Demonstrates how to customize the WordPress Loop using get_posts().
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

// custom loop shortcode: [get_posts_example]
// mostly just retrieves data to be displayed.
function custom_loop_shortcode_get_posts( $atts ) {

    // get global post variable
    global $post;

    // define shortcode variables
    extract( shortcode_atts( array(

        'posts_per_page' => 5,
        'orderby' => 'date',

    ), $atts ) );

    // define get_post parameters
    $args = array( 'posts_per_page' => $posts_per_page, 'orderby' => $orderby );

    // get the posts
    $posts = get_posts( $args );

    // begin output variable
    $output  = '<h3>Custom Loop Example: get_posts()</h3>';
    $output .= '<ul>';

    // loop thru posts
    foreach ( $posts as $post ) {

        // prepare post data
        setup_postdata( $post );

        // continue output variable
        $output .= '<li><a href="'. get_permalink() .'">'. get_the_title() .'</a></li>';

    }

    // reset post data
    wp_reset_postdata();

    // complete output variable
    $output .= '</ul>';

    // return output
    return $output;

}

// Custom Loops: pre_get_posts
// register shortcode function
// runs when the page is rendered (im assuming)
add_shortcode( 'get_posts_example', 'custom_loop_shortcode_get_posts' );

function custom_loop_pre_get_posts( $query ) {

    // is_main_query is most commonly used within hooks to distinguish wordpress' main query (for a post,page,archive) from a custom/secondary query.

    ////////// Setting the categories of some posts to demonstrate query->set('cat', args)
    // Sets a posts category id.
//    $category_ids = array( 1, 2, 3, 4, 5);
//
//    // Set the post ID
//    $post_ids = [16, 17, 18, 19, 20, 21, 22, 23, 24 , 25, 26];
//
//    // Assign the categories to the post
//    foreach($post_ids as $value) {
//        $category_array = [];
//        $randomNum = rand(1,5);
//
//        for ($i=0; $i < $randomNum; $i++) {
//            $key = array_rand($category_ids);
//            $category_array[] = $key;
//            // TODO: remove duplicates
//        }
//
//        wp_set_post_categories( $value, $category_array );
//
//    }

    if ( ! is_admin() && $query->is_main_query() ) {

//        $query->set( 'posts_per_page', 1 );
//        $query->set( 'order', 'ASC' );
//          $query->set('cat', '-1,-3');

    }

}
// runs when the page is rendered (im assuming)
add_action( 'pre_get_posts', 'custom_loop_pre_get_posts' );

// custom loop shortcode: [wp_query_example posts_per_page="3" orderby="rand"]
function custom_loop_shortcode_wp_query( $atts ) {

    // define shortcode variables
    extract( shortcode_atts( array(

        'posts_per_page' => 5,
        'orderby' => 'date',

    ), $atts ) );

    // define query parameters
    // it magically knows what $posts_per_page and $orderby are. Probably needs to match the extracted shortcode_atts or the $atts passed in.
    $args = array( 'posts_per_page' => $posts_per_page, 'orderby' => $orderby );

    // query the posts
    $posts = new WP_Query( $args );

    // begin output variable
    $output = '<h3>'. esc_html__( 'Custom Loop Example: WP_Query', 'myplugin' ) .'</h3>';

    // begin the loop
    if ( $posts->have_posts() ) {

        while ( $posts->have_posts() ) {

            $posts->the_post();

            $output .= '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
            $output .= get_the_content();

        }

        // add pagination here
        // add comments here

        // reset post data
        wp_reset_postdata();

    } else {

        // if no posts are found
        $output .= esc_html__( 'Sorry, no posts matched your criteria.', 'myplugin' );

    }

    // return output
    return $output;

}
// register shortcode function
add_shortcode( 'wp_query_example', 'custom_loop_shortcode_wp_query' );