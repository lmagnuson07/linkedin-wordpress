<?php // MyPlugin - Admin Menu

// No direct access snippet.
if ( !defined( 'ABSPATH') ) {
    exit;
}

// Add sub-level administrative menu
function myplugin_add_sublevel_menu() {

    // adds to the settings menu
    // options-general.php is the page that opens when you click the settings page in admin area.
    add_submenu_page(
        'options-general.php',
        'MyPlugin Settings',
        'MyPlugin',
        'manage_options',
        'myplugin',
        'myplugin_display_settings_page'
    );

}
//add_action( 'admin_menu', 'myplugin_add_sublevel_menu' );

// Add top level menu
function myplugin_add_toplevel_menu() {

    add_menu_page(
        'MyPlugin Settings',
        'MyPlugin',
        'manage_options',
        'myplugin',
        'myplugin_display_settings_page',
        'dashicons-admin-generic',
        null
    );

}
add_action( 'admin_menu', 'myplugin_add_toplevel_menu' );