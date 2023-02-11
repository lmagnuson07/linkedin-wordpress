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