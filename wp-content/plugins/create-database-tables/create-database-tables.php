<?php
/*
Plugin Name: Database Tables
Description: Testing database tables
Plugin URI:
Author:      Logan Magnuson
Version:     1.0
*/

class wpdbx extends wpdb {
    public function __construct() {
        parent::__construct(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
    }

    public function insert_multiple ($table, $data, $format = null) {
        $this->insert_id = 0;

        $formats = array();
        $values = array();

        foreach($data as $index=>$row) {
            $row = $this->process_fields($table, $row, $format);
            $row_formats = array();

            if ($row === false || array_keys($data[$index]) !== array_keys($data[0])) {
                continue;
            }
            foreach ($row as $col=>$value) {
                if (is_null($value['value'])) {
                    $row_formats[] = 'NULL';
                } else {
                    $row_formats[$index] = $value['format'];
                }

                $values[] = $value['value'];
            }

            $formats[] = '(' . implode(', ', $row_formats) . ')';
        }

        $fields = '`' . implode('`, `', array_keys($data[0])) . '`';
        $formats = implode(', ', $formats);
        $sql = "INSERT INTO `$table` ($fields) VALUES $formats";

        $this->check_current_query = false;
        return $this->query($this->prepare($sql, $values));
    }
}

function initialize_database () {
    create_rethink_fasd_tables();
    populate_rethink_fasd_tables();
}
function create_rethink_fasd_tables () {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $charset_collate = $wpdb->get_charset_collate();

    ////////// Stories Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_stories';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        description text NOT NULL,
        sharing_permission tinyint(1) NOT NULL DEFAULT 1,
        pseudonym varchar(255) NOT NULL,
        country_id int(11) NOT NULL, 
        category_id int(11) NOT NULL,
        age_group_id int(11) NOT NULL,
        relationship_id int(11) NOT NULL,
        PRIMARY KEY  (id),
        KEY pseudonym (pseudonym)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Country of Residency Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_country_of_residence';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        PRIMARY KEY  (id),
        KEY title (title)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Category Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_category';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        description text NOT NULL,
        PRIMARY KEY  (id),
        KEY title (title)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Age Group Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_age_group';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        age_range varchar(255) NOT NULL,
        active tinyint NOT NULL DEFAULT 1,
        PRIMARY KEY  (id),
        KEY title (title)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Relationship To Story Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_relationship_to_story';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        active tinyint NOT NULL DEFAULT 1,
        PRIMARY KEY  (id),
        KEY title (title)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Story File Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_story_file';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        type varchar(100) NOT NULL,
        name varchar(255) NOT NULL,
        size int(11) NOT NULL,
        story_id int(11) NOT NULL,
        PRIMARY KEY  (id),
        KEY story_id (story_id)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Story File Detail Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_story_file_detail';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        story_id int(11) NOT NULL,
        file_id int(11) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Story Keyword Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_story_keyword';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        PRIMARY KEY  (id),
        KEY title (title)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Story Keyword Detail Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_story_keyword_detail';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        story_id int(11) NOT NULL,
        keyword_id int(11) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    dbDelta($sql);

    ////////// Story Rating Table //////////////////////////////////////
    $table_name = $wpdb->prefix . 'fasd_story_rating';

    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        story_id int(11) NOT NULL,
        rating_value tinyint NOT NULL,
        PRIMARY KEY  (id),
        KEY story_id (story_id)
    ) $charset_collate;";

    dbDelta($sql);

}
function populate_rethink_fasd_tables () {
    global $wpdbx;

    $wpdbx = new wpdbx();

    // Returns the number of rows.
    $results = $wpdbx->insert_multiple(
        'wp_fasd_stories',
        array(
            array(
                'description'=>'A description',
                'sharing_permission'=>1,
                'pseudonym'=>'Robbie, A single Mom of 5',
                'country_id'=>2,
                'category_id'=>1,
                'age_group_id'=>4,
                'relationship_id'=>2
            ),
            array(
                'description'=>'A new description',
                'sharing_permission'=>0,
                'pseudonym'=>'Institute of something',
                'country_id'=>1,
                'category_id'=>2,
                'age_group_id'=>1,
                'relationship_id'=>1
            ),
        ),
        '%s, %d, %s, %d, %d, %d, %d'
    );
}
// register_activation_hook ensures the callback code only runs on plugin activation.
register_activation_hook(__FILE__, 'initialize_database');
