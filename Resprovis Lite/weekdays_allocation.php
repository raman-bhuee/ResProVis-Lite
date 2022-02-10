<?php
function Resprovis_CustomSlots_Input_Fields()
{
    // Declaring all the global and local vriables
    global $post;
    $product_id = $post->ID;
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $weekdays = $wpdb->prefix . 'asp_weekdays';
        $weekdays_alloc = $wpdb->prefix . 'asp_weekdays_alloc';

        // Code below this section for creating the week slot
   // Labeling the WeekSlot slot....!!
   echo "
   <hr>
   <br>

   &nbsp; &nbsp; <b>Choose Product Week Slot :</b>
   ";
   $query = $wpdb->get_results("SELECT `Wd_Id`, `Week_Description` FROM $weekdays");
   foreach ($query as $output) {
       $query_alloc = $wpdb->get_results("SELECT  `Wp_Post_Id`, `Wd_Id`  FROM $weekdays_alloc WHERE `wp_post_Id` = " . $product_id . " AND `Wd_Id` =  $output->Wd_Id ");
       $selected = '';
       if (count($query_alloc) > 0) {
           $selected = 'yes';
       }
       //  Creating the custom check boxes using woocommerce_wp_checkbox()
       woocommerce_wp_checkbox(
           array(
               'id' => 'chk_weekslot_' . $output->Wd_Id,
               'wrapper_class' => 'checkbox_class',
               'label' => __('', 'woocommerce'),
               'value'  => $selected,
               'description' => __($output->Week_Description, 'woocommerce')
           )
       );
   }
}
// Code under this section perform the insertion of the slot allocation in the database !!
// code for inserting the value of timeslot !!

add_action('woocommerce_process_product_meta', 'woocommerce_process_product_meta_fields_save');
function woocommerce_process_product_meta_fields_save($post_id)
{
    $product_id = $post_id;
    global $post;
    $product_id = $post->ID;
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $weekdays = $wpdb->prefix . 'asp_weekdays';
 $weekdays_alloc = $wpdb->prefix . 'asp_weekdays_alloc';

 // Code For Allocating The week Slot
    $query = $wpdb->get_results("SELECT `Wd_Id`, `Week_Description` FROM `$weekdays` ");
    if (count($query) > 0) {
        foreach ($query as $result) {
            $Wd_Id = $result->Wd_Id;
            if (isset($_POST['chk_weekslot_' . $Wd_Id])) {
                $query1 = $wpdb->get_results(" SELECT *  FROM  `$weekdays_alloc`  WHERE `wp_post_Id`= " . $post_id . " AND `Wd_Id` = " . $Wd_Id . " ");
                if (count($query1) > 0) {
                } else {
                    $data = array(
                        'wp_post_Id' => $post_id,
                        'Wd_Id' => $Wd_Id,
                    );
                    $weekdays_alloc = $wpdb->prefix . 'asp_weekdays_alloc';
                    $query2 = $wpdb->insert($weekdays_alloc, $data, $format = null);
                }
            } else {
                $query4 = $wpdb->get_results("SELECT  `Wp_Post_Id`, `Wd_Id` FROM $weekdays_alloc");
                foreach ($query4 as $output) {
                    $where = array(
                        'wp_post_Id' => $post_id,
                        'Wd_Id' => $Wd_Id,
                    );
                    $run = $wpdb->delete($weekdays_alloc, $where, $where_format = null);
                }
            }
        }
    }
}

 ?>
