<?php

/**
 * Plugin Name:       ResProVis
 * Description:       ResProVis   is a best plugin for additional functionality in Woocommerce Shop page. You can restrict  the visibility of items from the shop page according the Weekdays slots.
 * Version:           1.0.0
 * Requires at least: 5.3
 * Author:            (@Sewa Developer Team)
 * Author URI:        https://www.atsewa.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
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
include("resprovis_database.php");
include_once("resprovis_weekdays_filtaration.php");
include_once("resprovis_weekdays_allocation.php");
include_once("resprovis_shoppage_productfiltration.php");
include_once("resprovis_slots_allocation.php");


// Calling wordpress activation hook for creating plugin tables in database when the plugin get installed.

register_activation_hook(__FILE__, 'resprovis_weekdays_alloc');
register_activation_hook(__FILE__, 'resprovis_weekdays');
register_activation_hook(__FILE__, 'resprovis_weekdays_data');
