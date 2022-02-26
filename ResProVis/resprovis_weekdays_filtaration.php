<?php
// Sql query for fetching the post id for filtering the woocommerce products.......!!
function resprovis_custom_pre_get_posts_query($q)
{
   $varDate = date('Y-m-d', current_time('timestamp', 0));
   $varTime = date('H:i:s', current_time('timestamp', 0));
   global $wpdb;
   if (!$q->is_main_query()) return;
   if (!$q->is_post_type_archive()) return;
   if (!is_admin() && is_shop()) {
      $table_name = $wpdb->prefix . 'asp_weekdays_alloc';
      $arr_pids = array(0);


      $query = $wpdb->get_results("
         SELECT DISTINCT wa.wp_post_id as ID FROM  `$table_name` wa WHERE wa.wd_id != ( SELECT DAYOFWEEK('$varDate'))
         AND wa.Wp_Post_Id NOT IN
            (
            SELECT wp_post_id as ID FROM `$table_name` where wd_id = ( SELECT DAYOFWEEK(CURDATE()) )
            )
         ");

      foreach ($query as $array) {
         array_push($arr_pids, $array->ID);
      }


      //print_r( $arr_pids);
      $q->set('post__not_in', $arr_pids);

      // SELECT DISTINCT ta.wp_post_id as ID FROM asp_asp_timeslot_alloc ta INNER JOIN asp_asp_timeslot ts ON ta.Ts_Id = ts.Ts_Id WHERE CURTIME() NOT BETWEEN ts.Start_Time AND ts.End_Time AND ta.Wp_Post_Id NOT IN ( SELECT DISTINCT tai.wp_post_id as ID FROM asp_asp_timeslot_alloc tai INNER JOIN asp_asp_timeslot tsi ON tai.Ts_Id = tsi.Ts_Id WHERE CURTIME() BETWEEN tsi.Start_Time AND tsi.End_Time )

   }
}

 ?>
