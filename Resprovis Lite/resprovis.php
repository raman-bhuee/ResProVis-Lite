<?php

/**
 * Plugin Name:       ResProVis Lite
 * Plugin URI:
 * Description:       ResProVis Lite  is a best plugin for additional functionality in Woocommerce Shop page. You can restrict  the visibility of items from the shop page according the Weekdays slots.
 * Version:           1.0.0
 * Requires at least: 5.3
 * Author:            (@Sewa Developer Team)
 * Author URI:        https://www.atsewa.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       resprovis
 * Domain Path:       /languages
 **/
/*
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}
/*
 * Defines a named
 */
define('RESPROVIS_TEXTDOMAIN', 'resprovis');
define('RESPROVIS_DIR', plugin_dir_url(__FILE__));
// Including all dependent files of the resprovis.php
include("resprovis-database.php");
include_once("weekdays_filtaration.php");
include_once("weekdays_allocation.php");
include_once("resprovis-shoppage_productfiltration.php");
include_once("resprovis-slots_allocation.php");


// Calling wordpress activation hook for creating plugin tables in database when the plugin get installed.

register_activation_hook(__FILE__, 'weekdays_alloc');
register_activation_hook(__FILE__, 'weekdays');
register_activation_hook(__FILE__, 'weekdays_data');
