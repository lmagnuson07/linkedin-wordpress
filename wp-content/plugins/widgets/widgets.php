<?php
/*
Plugin Name: Clean Markup Widget
Description: Add clean, well-formatted markup to any widgetized area.
Plugin URI:  https://perishablepress.com/clean-markup-widget/
Author:      Jeff Starr
Version:     1.1
*/

// widget example: clean markup
// construct, widget, update, and form are the main 4 functions when creating custom widgets
class Clean_Markup_Widget extends WP_Widget {

    public function __construct() {

        $id = 'clean_markup_widget';

        $title = esc_html__('Clean Markup Widget', 'custom-widget');

        $options = array(
            'classname' => 'clean-markup-widget',
            'description' => esc_html__('Adds clean markup that is not modified by WordPress.', 'custom-widget')
        );

        // sets up the widget with the widget id, title, and description
        parent::__construct( $id, $title, $options );

    }

    public function widget( $args, $instance ) {

        // extract( $args );
        // args contains - name, id, description, class, before_widget, after_widget, before_title, after_title, widget_id, widget_name

        // for this widget, the markup is whatever the user adds via the widget screen
        $markup = '';

        if ( isset( $instance['markup'] ) ) {

            echo wp_kses_post( $instance['markup'] );

        }

    }

    // updates the user options.
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        // check if the user option is set and not empty.
        if ( isset( $new_instance['markup'] ) && ! empty( $new_instance['markup'] ) ) {

            $instance['markup'] = $new_instance['markup'];

        }

        return $instance;

    }

    public function form( $instance ) {

        $id = $this->get_field_id( 'markup' );

        $for = $this->get_field_id( 'markup' );

        $name = $this->get_field_name( 'markup' );

        $label = __( 'Markup/text:', 'custom-widget' );

        $markup = '<p>'. __( 'Clean markup.', 'custom-widget' ) .'</p>';

        if ( isset( $instance['markup'] ) && ! empty( $instance['markup'] ) ) {

            $markup = $instance['markup'];

        }

        ?>

        <p>
            <label for="<?php echo esc_attr( $for ); ?>"><?php echo esc_html( $label ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $markup ); ?></textarea>
        </p>

    <?php }

}

// register widget
function myplugin_register_widgets() {

    register_widget( 'Clean_Markup_Widget' );

}
// fires after all default wordpress widgets have been registered
add_action( 'widgets_init', 'myplugin_register_widgets' );
