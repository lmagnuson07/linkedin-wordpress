<?php
/*
Plugin Name:  MyPlugin
Description:  Example plugin for the video tutorial series, "WordPress: Plugin Development", available at LinkedIn.
Plugin URI:   https://profiles.wordpress.org/specialk
Author:       Logan Magnuson
Version:      1.0
Text Domain:  myplugin
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/
// In the header, the Text Domain must match the folder name and main plugin file.
// Domain Path must point to the language's folder.

// If the abspath is defined, that means the file is being called directly, outside of wordpress. Protects the contents of the file.
if ( !defined( 'ABSPATH') ) {
    exit;
}

// load text domain
function myplugin_load_textdomain() {

    // Domain should match the text domain in the header.
    load_plugin_textdomain( 'myplugin', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
// plugins_loaded: fires once activated plugins have loaded. Pluggable functions are available at this point in the loading order
// Generally used for immediate filter setup, or plugin overrides
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );

// If admin area
if ( is_admin() ) {

    // Include dependencies
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-callbacks.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-validate.php';

}

// Include dependencies: admin and public
require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';

// default plugin options
function myplugin_options_default() {

    return array(
        'custom_url'     => 'https://wordpress.org/',
        'custom_title'   => esc_html__('Powered by WordPress', 'myplugin'),
        'custom_style'   => 'disable',
        'custom_message' => '<p class="custom-message">' . esc_html__('My custom message', 'myplugin') . '</p>',
        'custom_footer'  => esc_html__('Special message for users', 'myplugin'),
        'custom_toolbar' => false,
        'custom_scheme'  => 'fresh',
    );

}

// remove options on uninstall
//function myplugin_on_uninstall() {
//
//    if ( ! current_user_can( 'activate_plugins' ) ) return;
//
//    delete_option( 'myplugin_options' );
//
//}
//register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );
