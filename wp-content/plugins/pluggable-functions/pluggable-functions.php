<?php

/*
Plugin Name: Pluggable Functions
Description: Basic example demonstrating pluggable functions.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/


// For more customization (function will also only be executed once)
// pluggable function
function wp_logout() {
    $user_id = get_current_user_id();

    wp_destroy_current_session();
    wp_clear_auth_cookie();
    wp_set_current_user( 0 );

    myplugin_custom_logout();
    /**
     * Fires after a user is logged out.
     *
     * @since 1.5.0
     * @since 5.5.0 Added the `$user_id` parameter.
     *
     * @param int $user_id ID of the user that was logged out.
     */
    do_action( 'wp_logout', $user_id );
}

//////////////////////////////////////////////////////////
/// Using a hook (how you would normally implement a pluggable function
/// Using a hook is usually sufficient enough, unless you want more customization
// customize logout function
function myplugin_custom_logout() {

    // do something when the user logs out..

}
// add_action( 'wp_logout', 'myplugin_custom_logout' );
/////////////////////////////////////////////////////////