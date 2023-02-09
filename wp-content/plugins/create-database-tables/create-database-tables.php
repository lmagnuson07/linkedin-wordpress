<?php
/*
Plugin Name: Database Tables
Description: Testing database tables
Plugin URI:
Author:      Logan Magnuson
Version:     1.0
*/

function jal_install () {
    global $wpdb;

    $table_name = $wpdb->prefix . "liveshoutbox";
}