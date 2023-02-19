<?php
/*
Plugin Name: Users and Roles: Create User
Description: Example demonstrating how to manage users and roles.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

// wp_insert_user is a more robust way to add a user.

// add top-level administrative menu
function create_user_add_toplevel_menu() {

    add_menu_page(
        esc_html__('Users and Roles: Create User', 'myplugin'),
        esc_html__('Create User', 'myplugin'),
        'manage_options',
        'myplugin',
        'create_user_display_settings_page',
        'dashicons-admin-generic',
        null
    );

}
add_action( 'admin_menu', 'create_user_add_toplevel_menu' );



// display the plugin settings page
function create_user_display_settings_page() {

    // check if user is allowed access
    if ( ! current_user_can( 'manage_options' ) ) return;

    ?>

    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="post">
            <h3><?php esc_html_e( 'Add New User', 'myplugin' ); ?></h3>
            <p>
                <label for="username"><?php esc_html_e( 'Username', 'myplugin' ); ?></label><br />
                <input class="regular-text" type="text" size="40" name="username" id="username">
            </p>
            <p>
                <label for="email"><?php esc_html_e( 'Email', 'myplugin' ); ?></label><br />
                <input class="regular-text" type="text" size="40" name="email" id="email">
            </p>
            <p>
                <label for="password"><?php esc_html_e( 'Password', 'myplugin' ); ?></label><br />
                <input class="regular-text" type="text" size="40" name="password" id="password">
            </p>

            <p><?php esc_html_e( 'The user will receive this information via email.', 'myplugin' ); ?></p>

            <input type="hidden" name="myplugin-nonce" value="<?php echo wp_create_nonce( 'myplugin-nonce' ); ?>">
            <input type="submit" class="button button-primary" value="<?php esc_html_e( 'Add User', 'myplugin' ); ?>">
        </form>
    </div>

    <?php

}



// add new user
function create_user_add_user() {

    // check if nonce is valid
    if ( isset( $_POST['myplugin-nonce'] ) && wp_verify_nonce( $_POST['myplugin-nonce'], 'myplugin-nonce' ) ) {

        // check if user is allowed
        if ( ! current_user_can( 'manage_options' ) ) wp_die();

        // get submitted username
        if ( isset( $_POST['username'] ) && ! empty( $_POST['username'] ) ) {

            $username = sanitize_user( $_POST['username'] );

        } else {

            $username = '';

        }

        // get submitted email
        if ( isset( $_POST['email'] ) && ! empty( $_POST['email'] ) ) {

            $email = sanitize_email( $_POST['email'] );

        } else {

            $email = '';

        }

        // get submitted password
        if ( isset( $_POST['password'] ) && ! empty( $_POST['password'] ) ) {

            $password = $_POST['password']; // sanitized by wp_create_user()

        } else {

            $password = wp_generate_password();

        }

        // set user_id variable
        $user_id = '';

        // check if user exists
        $username_exists = username_exists( $username );
        $email_exists = email_exists( $email );

        if ( $username_exists || $email_exists ) {

            $user_id = esc_html__( 'The user already exists.', 'myplugin' );

        }

        // check non-empty values
        if ( empty( $username ) || empty( $email ) ) {

            $user_id = esc_html__( 'Required: username and email.', 'myplugin' );

        }

        // create the user
        if ( empty( $user_id ) ) {

            $user_id = wp_create_user( $username, $password, $email );

            if ( is_wp_error( $user_id ) ) {

                $user_id = $user_id->get_error_message();

            } else {

                // email password
                $subject = __( 'Welcome to WordPress!', 'myplugin' );
                $message = __( 'You can log in using your chosen username and this password: ', 'myplugin' ) . $password;

                wp_mail( $email, $subject, $message );

            }

        }

        $location = admin_url( 'admin.php?page=myplugin&result='. urlencode( $user_id ) );

        wp_redirect( $location );

        // exit after redirecting as a security precaution
        exit;

    }

}
// for the admin area, the admin_init hook is the best hook when processing submitted form data.
add_action( 'admin_init', 'create_user_add_user' );


// update user
function update_user_update_user() {

    // check if nonce is valid
    if ( isset( $_POST['myplugin-nonce'] ) && wp_verify_nonce( $_POST['myplugin-nonce'], 'myplugin-nonce' ) ) {

        // check if user is allowed
        if ( ! current_user_can( 'manage_options' ) ) wp_die();

        // get user email
        if ( isset( $_POST['email'] ) && ! empty( $_POST['email'] ) ) {

            $email = sanitize_email( $_POST['email'] );

        } else {

            $email = '';

        }

        // get new display name
        if ( isset( $_POST['display-name'] ) && ! empty( $_POST['display-name'] ) ) {

            $display_name = sanitize_user( $_POST['display-name'] );

        } else {

            $display_name = '';

        }

        // get new website url
        if ( isset( $_POST['user-url'] ) && ! empty( $_POST['user-url'] ) ) {

            $user_url = esc_url( $_POST['user-url'] );

        } else {

            $user_url = '';

        }

        // get the user id
        $user_id = email_exists( $email );

        // user id exists
        if ( is_numeric( $user_id ) ) {

            // define the parameters
            $userdata = array( 'ID' => $user_id, 'display_name' => $display_name, 'user_url' => $user_url );

            // update the user
            // use update_user_meta if you only want to update one piece of data.
            $user_id = wp_update_user( $userdata );

            // check for errors
            if ( is_wp_error( $user_id ) ) {

                // get the error message
                $user_id = $user_id->get_error_message();

            }

        } else {

            // user not found
            $user_id = __( 'User not found.', 'myplugin' );

        }

        // set the redirect url
        $location = admin_url( 'admin.php?page=myplugin&result='. urlencode( $user_id ) );

        // redirect
        wp_redirect( $location );

        exit;

    }

}
add_action( 'admin_init', 'update_user_update_user' );

// delete user
function delete_user_delete_user() {

    // check if nonce is valid
    if ( isset( $_POST['myplugin-nonce'] ) && wp_verify_nonce( $_POST['myplugin-nonce'], 'myplugin-nonce' ) ) {

        // check if user is allowed
        if ( ! current_user_can( 'manage_options' ) ) wp_die();

        // get user email
        if ( isset( $_POST['email'] ) && ! empty( $_POST['email'] ) ) {

            $email = sanitize_email( $_POST['email'] );

        } else {

            $email = '';

        }

        // get the user id
        $user_id = email_exists( $email );

        // user id exists
        if ( is_numeric( $user_id ) ) {

            // delete the user
            $result = wp_delete_user( $user_id );

            if ( $result ) {

                $result = __( 'The user has been deleted.', 'myplugin' );

            } else {

                $result = __( 'Error: user not deleted.', 'myplugin' );

            }

        } else {

            // user not found
            $result = __( 'Error: user not found.', 'myplugin' );

        }

        // set the redirect url
        $location = admin_url( 'admin.php?page=myplugin&result='. urlencode( $result ) );

        // redirect
        wp_redirect( $location );

        exit;

    }

}
add_action( 'admin_init', 'delete_user_delete_user' );

// create the admin notice
function update_user_admin_notices() {

    $screen = get_current_screen();

    if ( 'toplevel_page_myplugin' === $screen->id ) {

        if ( isset( $_GET['result'] ) ) {

            if ( is_numeric( $_GET['result'] ) ) : ?>

                <div class="notice notice-success is-dismissible">
                    <p><strong><?php esc_html_e('User updated successfully.', 'myplugin'); ?></strong></p>
                </div>

            <?php else : ?>

                <div class="notice notice-warning is-dismissible">
                    <p><strong><?php echo esc_html( $_GET['result'] ); ?></strong></p>
                </div>

            <?php endif;

        }

    }

}
add_action( 'admin_notices', 'update_user_admin_notices' );

///////////// Roles /////////////////////////////////////////
// get all roles
function get_roles_get_roles() {

    global $wp_roles;

    return $wp_roles->roles;

}



// display results
function get_roles_display_results() {

    $roles = get_roles_get_roles();

    $roles = array_reverse( $roles );

    foreach ( $roles as $key => $value ) {

        if ( isset( $value['capabilities'] ) ) {

            echo '<h3>'. esc_html__( 'Capabilities for ', 'myplugin' ) . $key .'</h3>';

            echo '<pre>';

            foreach ( $value['capabilities'] as $k => $v ) {

                if ( $v == 1 ) echo $k . "\n";

            }

            echo '</pre>';

        }

    }

}

// get all roles
function users_roles_examples_get_roles() {

    global $wp_roles;

    return $wp_roles->roles;

}



// display results
function users_roles_examples_display_results() {

    $roles = users_roles_examples_get_roles();

    $roles = array_reverse( $roles );

    foreach ( $roles as $role ) {

        if ( isset( $role['name'] ) ) {

            $role_name = strtolower( $role['name'] );

            $all_caps = users_roles_examples_get_role( $role_name );

        }

        if ( $all_caps ) {

            echo '<h3>'. $role_name .' '. esc_html__( 'capabilities', 'myplugin' ) .'</h3>';

            $caps = $all_caps->capabilities;

            foreach ( $caps as $key => $value ) {

                echo '<pre>';

                if ( $value == 1 ) echo $key . "\n";

                echo '</pre>';

            }

        }

    }

}



// get user role
function users_roles_examples_get_role( $role_name ) {

    return get_role( $role_name );

}



// add user role ( see note below )
function users_roles_examples_add_role() {

    add_role(

        'reviewer',
        __( 'Reviewer' ),
        array(
            'read'         => true,
            'edit_posts'   => true,
            'upload_files' => true,

        )

    );

}
add_action( 'init', 'users_roles_examples_add_role' );



// remove user role ( see note below )
function users_roles_examples_remove_role() {

    remove_role( 'reviewer' );

}
add_action( 'init', 'users_roles_examples_remove_role' );










/*

	NOTE:

	The plugin functions myplugin_add_role() and myplugin_remove_role()
	are registered with the "init" hook, which fires on every page load.

	The WP add_role() and remove_role() functions write to the database,
	which is resource intensive.

	So it is better for performance to run myplugin_add_role() and
	myplugin_remove_role() only on plugin activation, using the hook
	"register_activation_hook".

	The function below shows an example of how to do this.

	USAGE:

		Add a role on plugin activation

			1. Remove the two slashes from myplugin_add_role()
			2. Remove the add_action() for myplugin_add_role()

		Remove a role on plugin activation

			1. Remove the two slashes from myplugin_remove_role()
			2. Remove the add_action() for myplugin_remove_role()


	More info @ https://developer.wordpress.org/reference/functions/add_role/

*/

// modify roles on plugin activation
function users_roles_examples_modify_roles_on_plugin_activation() {

    // myplugin_add_role();
    // myplugin_remove_role()

}
register_activation_hook( __FILE__, 'users_roles_examples_modify_roles_on_plugin_activation' );
