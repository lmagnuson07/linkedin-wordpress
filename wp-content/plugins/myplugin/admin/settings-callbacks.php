<?php // MyPlugin - Settings Callback Functions

// No direct access snippet.
if ( !defined( 'ABSPATH') ) {
    exit;
}

////////////// Section Callbacks /////////////////////////////////
// callback: login section
function myplugin_callback_section_login() {

    echo '<p>These settings enable you to customize the WP Login screen.</p>';

}

// callback: admin section
function myplugin_callback_section_admin() {

    echo '<p>These settings enable you to customize the WP Admin Area.</p>';

}

////////////// Field callbacks /////////////////////////////////////
// callback: text field
function myplugin_callback_field_text( $args ) {
    // Args is passed from the register settings function (id and label)

    // the first parameter informs wp where to pull the options from the database
    // the second parameter specifies the default options to use if they are not found in the database
    $options = get_option( 'myplugin_options', myplugin_options_default() );

    $id    = $args['id'] ?? ''; // if the id is set
    $label = $args['label'] ?? '';

    $value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    echo '<input id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
    echo '<label for="myplugin_options_'. $id .'">'. $label .'</label>';

}

// callback: radio field
function myplugin_callback_field_radio( $args ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    $id    = $args['id'] ?? '';
    $label = $args['label'] ?? '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    $radio_options = array(

        'enable'  => 'Enable custom styles',
        'disable' => 'Disable custom styles'

    );

    foreach ( $radio_options as $value => $label ) {

        $checked = checked( $selected_option === $value, true, false );

        echo '<label><input name="myplugin_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
        echo '<span>'. $label .'</span></label><br />';

    }

}

// callback: textarea field
function myplugin_callback_field_textarea( $args ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    $id    = $args['id'] ?? '';
    $label = $args['label'] ?? '';

    // Allows user to enter basic markup to the textarea section. Returns an array of 88 allowed tags.
    $allowed_tags = wp_kses_allowed_html( 'post' );

    // wp_kses will remove disallowed tags from the string we pass it, but ignores the allowed tags we specify.
    $value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';

    echo '<textarea id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
    echo '<label for="myplugin_options_'. $id .'">'. $label .'</label>';

}

// callback: checkbox field
function myplugin_callback_field_checkbox( $args ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    $id    = $args['id'] ?? '';
    $label = $args['label'] ?? '';

    $checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';

    echo '<input id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
    echo '<label for="myplugin_options_'. $id .'">'. $label .'</label>';

}

// callback: select field
function myplugin_callback_field_select( $args ) {

    $options = get_option( 'myplugin_options', myplugin_options_default() );

    $id    = $args['id'] ?? '';
    $label = $args['label'] ?? '';

    $selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';

    // The last part of the id for admin color scheme. (admin_color_ocean).
    // Get a list of all of the available admin color schemes in personal user settings.
    global $_wp_admin_css_colors;

    $colors = $_wp_admin_css_colors;
    $select_options = array();

    foreach($colors as $k=>$v) {
        $select_options[$k] = $v->name;
    }

    echo '<select id="myplugin_options_'. $id .'" name="myplugin_options['. $id .']">';

    foreach ( $select_options as $value => $option ) {

        $selected = selected( $selected_option === $value, true, false );

        echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';

    }

    echo '</select> <label for="myplugin_options_'. $id .'">'. $label .'</label>';

}
