<?php
/**
 * Plugin Name:       Business Directory Post Types and Taxonomies
 * Plugin URI:        http://github.com/jcasabona/lil-post-types/
 * Description:       A simple plugin for creating custom post types and taxonomies related to a business directory.
 * Version:           1.0.0
 * Author:            Joe Casabona
 * Author URI:        https:/casabona.org/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lil-post-types
 * Domain Path:       /languages
 */

// No direct access snippet
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'LIL_VERSION', '1.0.0' );
define( 'LILDOMAIN', 'lil-post-types' );
define( 'LILPATH', plugin_dir_path( __FILE__ ) );

require_once( LILPATH . '/post-types/register.php' );
require_once( LILPATH . '/taxonomies/register.php' );

add_action( 'init', 'lil_register_business_type' );
add_action( 'init', 'lil_register_event_type' );
add_action( 'init', 'lil_register_size_taxonomy' );
add_action( 'init', 'lil_register_location_taxonomy' );

// flushes the rewrite rules for all functions
// Do this on activation only. Too demanding to do on every page load.
function lil_register_everything() {
    lil_register_business_type();
    lil_register_event_type();
    lil_register_size_taxonomy();
    lil_register_location_taxonomy();
}
function lil_rewrite_flush() {
    lil_register_everything();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'lil_rewrite_flush' );