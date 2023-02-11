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

// If the abspath is defined, that means the file is being called directly, outside of wordpress. Protects the contents of the file.
if ( !defined( 'ABSPATH') ) {
    exit;
}

// If admin area
if ( is_admin() ) {

    // Include dependencies
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-register.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings-callbacks.php';

}



