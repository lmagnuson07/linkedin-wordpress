<?php // MyPlugin - Core Functionality

// No direct access snippet.
if ( !defined( 'ABSPATH') ) {
    exit;
}

// custom login logo url
function myplugin_custom_login_url( $url ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_url'] ) && ! empty( $options['custom_url'] ) ) {

        $url = trim(esc_url( $options['custom_url'] ));

    }

    return $url;

}
// login-headerurl: applied to the login header URL printed on the login screen (when clicking logo)
add_filter( 'login_headerurl', 'myplugin_custom_login_url' );

// custom login logo title
function myplugin_custom_login_title( $title ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_title'] ) && ! empty( $options['custom_title'] ) ) {

        $title = esc_attr( $options['custom_title'] );

    }

    return $title;

}
// login_headertitle: applied to the title for the login header URL printed on the login screen
add_filter( 'login_headertitle', 'myplugin_custom_login_title' );

// custom login styles
function myplugin_custom_login_styles() {

    $styles = false;

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {

        $styles = sanitize_text_field( $options['custom_style'] );

    }

    if ( 'enable' === $styles ) {

        // enqueue basically means include
        // the handle is added as an id to the link file (myplugin-css)
        // the dependencies allow you to load another stylesheet before (makes it dependent on it).
        // ver is the query string on the url. Good for version control. Valse will append the wordpress version as a query string.
        wp_enqueue_style( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/myplugin-login.css', array(), null, 'screen' );

        // in_footer: wordpress will include the fill via the wp_footer hook.
        wp_enqueue_script( 'myplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/myplugin-login.js', array(), null, true );

    }

}
// login_enqueue_scripts: proper hook to use when enqueuing items that are meant to appear on the login page. On all login and registration related screens.
add_action( 'login_enqueue_scripts', 'myplugin_custom_login_styles' );

// custom login message
function myplugin_custom_login_message( $message ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_message'] ) && ! empty( $options['custom_message'] ) ) {

        $message = wp_kses_post( $options['custom_message'] ) . $message;

    }

    return $message;

}
// login_message: used to filter the message displayed on the WordPress login page above the login form. Can contain markup
add_filter( 'login_message', 'myplugin_custom_login_message' );

// custom admin footer
function myplugin_custom_admin_footer( $message ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_footer'] ) && ! empty( $options['custom_footer'] ) ) {

        $message = sanitize_text_field( $options['custom_footer'] );

    }

    return $message;

}
// admin_footer_text: filters/changes the "Thank you" text displayed in the admin footer area of the plugin
add_filter( 'admin_footer_text', 'myplugin_custom_admin_footer' );

// custom toolbar items
function myplugin_custom_admin_toolbar() {

    $toolbar = false;

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_toolbar'] ) && ! empty( $options['custom_toolbar'] ) ) {

        $toolbar = (bool) $options['custom_toolbar'];

    }

    if ( $toolbar ) {

        global $wp_admin_bar;

        // assuming "comments" refers to the id of the html element (wp-admin-bar-comments). everything after wp-admin-bar-
        // wp_admin_bar contains properties that represent all of the elements in the admin bar.
        $wp_admin_bar->remove_menu( 'comments' );
        $wp_admin_bar->remove_menu( 'new-content' );

    }

}
// wp_before_admin_bar_render: modify the wp_admin_bar object before it is rendered to the screen.
// the global $wp_admin_bar must be declared as this hook is intended to give direct access to the object before it is rendered to screen.
add_action( 'wp_before_admin_bar_render', 'myplugin_custom_admin_toolbar', 999 );

// custom admin color scheme
function myplugin_custom_admin_scheme( $user_id ) {
    // user_id is the user that was just created. Probably set from the user_register hook.
    $scheme = 'default';

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    if ( isset( $options['custom_scheme'] ) && ! empty( $options['custom_scheme'] ) ) {

        $scheme = sanitize_text_field( $options['custom_scheme'] );

    }

    $args = array( 'ID' => $user_id, 'admin_color' => $scheme );

    // updates a user in the database.
    wp_update_user( $args );

}
// the user_register hook only applies to (fires when) newly registered users.
add_action( 'user_register', 'myplugin_custom_admin_scheme' );
