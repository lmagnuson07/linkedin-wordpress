<?php // MyPlugin - Settings Page

// No direct access snippet.
if ( !defined( 'ABSPATH') ) {
    exit;
}

// display the plugin settings page
function myplugin_display_settings_page() {

    // check if user is allowed access
    if ( ! current_user_can( 'manage_options' ) ) return;

    ?>

    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<!--        --><?php //settings_errors(); ?>
        <?php // Form must always be action="options.php" method="post" for settings page ?>
        <form action="options.php" method="post">

            <?php

            // output security fields
            settings_fields( 'myplugin_options' );

            // output setting sections
            do_settings_sections( 'myplugin' );

            // submit button
            submit_button();

            ?>

        </form>
    </div>

    <?php

}

// display admin notices
function myplugin_admin_notices() {

    // get the current screen
    $screen = get_current_screen();

    // return if not myplugin settings page
    // ensures the notice is only displayed on the myplugin page.
    if ( $screen->id !== 'toplevel_page_myplugin' ) return;

    // check if settings updated
    if ( isset( $_GET[ 'settings-updated' ] ) ) {

        // if settings updated successfully
        if ( 'true' === $_GET[ 'settings-updated' ] ) :

            ?>

            <?php //recommended markup to display admin notices ?>
            <?php //the class names notice-success and notice-error are important ?>
            <div class="notice notice-success is-dismissible">
                <p><strong><?php _e( 'Congratulations, you are awesome!', 'myplugin' ); ?></strong></p>
            </div>

        <?php

        // if there is an error
        else :

            ?>

            <div class="notice notice-error is-dismissible">
                <p><strong><?php _e( 'Houston, we have a problem.', 'myplugin' ); ?></strong></p>
            </div>

        <?php

        endif;

    }

}
add_action( 'admin_notices', 'myplugin_admin_notices' );


