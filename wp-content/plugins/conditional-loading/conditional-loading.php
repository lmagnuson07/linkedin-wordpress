<?php

if ( is_admin() ) {

    require_once( dir_name( __FILE__ ) . '/admin/do-stuff.php' );

}

if ( function_exists( 'myplugin_customize_something' ) ) {

    function myplugin_customize_something() {

        // do stuff

    }

}

if ( ! class_exists( 'Example_Plugin' ) ) {

    class Example_Plugin {

        public static function init() {
            // do stuff..
        }
        public static function register() {
            // do stuff..
        }
        public static function modify() {
            // do stuff..
        }

    }

    Example_Plugin::init();
    Example_Plugin::register();
    Example_Plugin::modify();

}