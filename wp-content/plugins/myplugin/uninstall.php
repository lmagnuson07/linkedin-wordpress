<?php
/*

	uninstall.php

	- fires when plugin is uninstalled via the Plugins screen

*/

// exit if uninstall constant is not defined. Protects against direct access.
// will be defined during the uninstall.php invocation
// is not defined when register_uninstall_hook is used.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {

    exit;

}
// delete the plugin options
delete_option( 'myplugin_options' );

// for site options in Multisite
//      delete_site_option( $option_name );

// drop a custom database table
//      global $wpdb;
//      $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );