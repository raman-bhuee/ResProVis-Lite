<?php
// Code for creating the custom tables in the database.
//  Weekdays slot
global $jal_db_version;
$jal_db_version = '1.0';

function weekdays()
{
    global $wpdb;
    global $jal_db_version;
    $table_name = $wpdb->prefix . 'asp_weekdays';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
		Wd_Id mediumint(9) NOT NULL AUTO_INCREMENT,
		Week_Description varchar(200) NOT NULL,
		PRIMARY KEY  (Wd_Id)
	) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    add_option('jal_db_version', $jal_db_version);
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
//  Code under this section for inserting weeday data on plugin installation in weekdays table
function weekdays_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'asp_weekdays';
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "1",
            'Week_Description' => "Sunday",
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "2",
            'Week_Description' => "Monday",
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "3",
            'Week_Description' => "Tuesday",
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "4",
            'Week_Description' => "Wednesday",
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "5",
            'Week_Description' => "Thursday",
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "6",
            'Week_Description' => "Friday",
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'Wd_Id' => "7",
            'Week_Description' => "Saturday",
        )
    );
}
//  Weekdays Allocation
function weekdays_alloc()
{
    global $wpdb;
    global $jal_db_version;
    $table_name = $wpdb->prefix . 'asp_weekdays_alloc';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
		Wda_Id mediumint(9) NOT NULL AUTO_INCREMENT,
		Wp_Post_Id integer NOT NULL,
		Wd_Id integer NOT NULL,
		PRIMARY KEY  (Wda_Id)
	) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    add_option(
        'jal_db_version',
        $jal_db_version
    );
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
 ?>
