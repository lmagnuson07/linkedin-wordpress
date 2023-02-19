<?php

function mytheme_register_custom_templates() {
    // Register the custom template directory
    if ( have_posts() ) : while ( have_posts() ) : the_post();

    endwhile; endif;
    register_theme_directory( get_stylesheet_directory() . '/templates' );
}
add_action( 'after_setup_theme', 'mytheme_register_custom_templates' );