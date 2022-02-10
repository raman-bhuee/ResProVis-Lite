<?php

/*
 * Defines a named
 */



include_once("weekdays_filtaration.php");

add_action('pre_get_posts', 'custom_pre_get_posts_query');
