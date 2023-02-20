<?php /*

  This file is part of a child theme called twentynineteen-child.
  Functions in this file will be loaded before the parent theme's functions.
  For more information, please read
  https://developer.wordpress.org/themes/advanced-topics/child-themes/

*/

// this code loads the parent's stylesheet (leave it in place unless you know what you're doing)

function your_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, 
      get_template_directory_uri() . '/style.css'); 

    wp_enqueue_style( 'child-style', 
      get_stylesheet_directory_uri() . '/style.css', 
      array($parent_style), 
      wp_get_theme()->get('Version') 
    );
}

add_action('wp_enqueue_scripts', 'your_theme_enqueue_styles');

/*  Add your own functions below this line.
    ======================================== */ 

// allows you to modify the query that gets the posts
function lil_add_business_to_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'business' ) );
    }
}
add_action( 'pre_get_posts', 'lil_add_business_to_query' );

function lil_show_events() {
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => 3,
    );

    $events = new WP_Query( $args );

    if ( $events->have_posts() ) {
        echo '<ul class="events-list">';
        $format = '<li class="event"><a href="%1$s" title="%2$s">%2$s</a>: %3$s</li>';

        while( $events->have_posts() ) {
            $events->the_post();
            printf( $format,
                get_permalink(),
                get_the_title(),
                apply_filters( 'the_content', get_the_content() ) // pass the data through apply_filters so that it can print with the formatting.
            );
        }
        echo '</ul>';
    }

    wp_reset_query(); // can end up with posts colliding
}