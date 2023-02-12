<?php // MyPlugin - register settings

// No direct access snippet.
if ( !defined( 'ABSPATH') ) {
    exit;
}

// Contains all the settings functionality (kind of like a controller).
// Registered with an admin-init hook.
// register plugin settings
function myplugin_register_settings() {

    ////////////// Register our options ///////////////////////////////
    // must match a settings fields option_group
    $registerArgs = array(
        'sanitize_callback' => 'myplugin_callback_validate_options'
    );
    register_setting(
        'myplugin_options',
        'myplugin_options',
        $registerArgs
    );

    ////////////// Setting sections ////////////////////////////////////
    // "page" must match the menu slug from add_submenu_page
    add_settings_section(
        'myplugin_section_login',
        'Customize Login Page',
        'myplugin_callback_section_login',
        'myplugin'
    );

    add_settings_section(
        'myplugin_section_admin',
        'Customize Admin Area',
        'myplugin_callback_section_admin',
        'myplugin'
    );

    ///////////// Settings fields ///////////////////////////////////////
    // "page" must match the menu slug from add_submenu_page
    // "section" must match the settings section id
    // "title" is the label that appears to the left of the input
    add_settings_field(
        'custom_url',
        'Custom URL',
        'myplugin_callback_field_text',
        'myplugin',
        'myplugin_section_login',
        [ 'id' => 'custom_url', 'label' => 'Custom URL for the login logo link' ]
    );

    add_settings_field(
        'custom_title',
        'Custom Title',
        'myplugin_callback_field_text',
        'myplugin',
        'myplugin_section_login',
        [ 'id' => 'custom_title', 'label' => 'Custom title attribute for the logo link' ]
    );

    add_settings_field(
        'custom_style',
        'Custom Style',
        'myplugin_callback_field_radio',
        'myplugin',
        'myplugin_section_login',
        [ 'id' => 'custom_style', 'label' => 'Custom CSS for the Login screen' ]
    );

    add_settings_field(
        'custom_message',
        'Custom Message',
        'myplugin_callback_field_textarea',
        'myplugin',
        'myplugin_section_login',
        [ 'id' => 'custom_message', 'label' => 'Custom text and/or markup' ]
    );

    add_settings_field(
        'custom_footer',
        'Custom Footer',
        'myplugin_callback_field_text',
        'myplugin',
        'myplugin_section_admin',
        [ 'id' => 'custom_footer', 'label' => 'Custom footer text' ]
    );

    add_settings_field(
        'custom_toolbar',
        'Custom Toolbar',
        'myplugin_callback_field_checkbox',
        'myplugin',
        'myplugin_section_admin',
        [ 'id' => 'custom_toolbar', 'label' => 'Remove new post and comment links from the Toolbar' ]
    );

    add_settings_field(
        'custom_scheme',
        'Custom Scheme',
        'myplugin_callback_field_select',
        'myplugin',
        'myplugin_section_admin',
        [ 'id' => 'custom_scheme', 'label' => 'Default color scheme for new users' ]
    );

}
add_action( 'admin_init', 'myplugin_register_settings' );