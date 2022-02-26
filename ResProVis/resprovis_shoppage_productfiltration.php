<?php

/*
 * Defines a named
 */



include_once("resprovis_weekdays_filtaration.php");

add_action('pre_get_posts', 'resprovis_custom_pre_get_posts_query');
