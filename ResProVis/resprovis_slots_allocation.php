<?php

/*
 * Defines a named
 */



include_once("resprovis_weekdays_allocation.php");

add_action('woocommerce_product_options_general_product_data', 'resprovis_CustomSlots_Input_Fields');
