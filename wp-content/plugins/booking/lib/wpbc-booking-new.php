<?php
/**
 * @version 1.0
 * @package Booking Calendar 
 * @subpackage Create new bookings functions
 * @category Bookings
 * 
 * @author wpdevelop
 * @link http://wpbookingcalendar.com/
 * @email info@wpbookingcalendar.com
 *
 * @modified 2014.04.23
 */

if ( ! defined( 'ABSPATH' ) ) exit;                                             // Exit if accessed directly



function wpdev_bk_insert_new_booking(){  global $wpdb;

    make_bk_action('check_multiuser_params_for_client_side', $_POST[  "bktype" ] );

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Define init variables
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $dates          = $_POST[ "dates" ];
    $bktype         = intval( $_POST[ "bktype" ] );
    if ( $bktype == 0 ) {
        // Error
        ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php bk_error('Error od saving data into DB. Unknown booking resource.',__FILE__,__LINE__); ?></div>'; </script> <?php
        die();
        
    }
    $formdata       = $_POST[ "form" ];
    $formdata       = escape_any_xss( $formdata );
    
    $is_send_emeils = 1;        if (isset($_POST["is_send_emeils"])) $is_send_emeils = $_POST["is_send_emeils"];

    $my_booking_id  = 0;
    $my_booking_hash= '';


    if (function_exists ('get_booking_title')) $bk_title = get_booking_title( $bktype );
    else $bk_title = '';

    if (isset($_POST['my_booking_hash'])) {
        $my_booking_hash = $_POST['my_booking_hash'];
        if ($my_booking_hash!='') {
            $my_booking_id_type = false;
            $my_booking_id_type = apply_bk_filter('wpdev_booking_get_hash_to_id',false, $my_booking_hash);
            if ($my_booking_id_type !== false) {
                $my_booking_id = $my_booking_id_type[0];
                $bktype        = $my_booking_id_type[1];
            }
        }
    }



    if (strpos($dates,' - ')!== FALSE) {
        $dates =explode(' - ', $dates );
        $dates = createDateRangeArray($dates[0],$dates[1]);
    }

    //  CAPTCHA CHECKING  
    if (! wpbc_check_CAPTCHA( $_POST['captcha_user_input'], $_POST['captcha_chalange'], $bktype ) ) die;


    $my_modification_date = "'" . date_i18n( 'Y-m-d H:i:s'  ) ."'" ;    // Localize booking modification date
    // $my_modification_date = 'NOW()';                                 // Server value modification date

    if ( $my_booking_id > 0 ) {                  // Edit exist booking

        if ( strpos($_SERVER['HTTP_REFERER'],'wp-admin/admin.php?') !==false ) {
            ?> <script type="text/javascript">
                document.getElementById('ajax_working').innerHTML =
                    '<div class="updated ajax_message" id="ajax_message">\n\
                        <div style="float:left;"><?php echo __('Updating...', 'wpdev-booking'); ?></div> \n\
                        <div class="wpbc_spin_loader">\n\
                               <img src="'+wpdev_bk_plugin_url+'/img/ajax-loader.gif">\n\
                        </div>\n\
                    </div>';
            </script> <?php
        }
        $update_sql = "UPDATE {$wpdb->prefix}booking AS bk SET bk.form='{$formdata}', bk.booking_type={$bktype} , bk.modification_date={$my_modification_date} WHERE bk.booking_id={$my_booking_id};";
        if ( false === $wpdb->query( $update_sql  ) ){
            ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php bk_error('Error during updating exist booking in DB',__FILE__,__LINE__); ?></div>'; </script> <?php
            die();
        }

        // Check if dates already aproved or no
        $slct_sql = "SELECT approved FROM {$wpdb->prefix}bookingdates WHERE booking_id IN ({$my_booking_id}) LIMIT 0,1";
        $slct_sql_results  = $wpdb->get_results( $slct_sql );
        if ( count($slct_sql_results) > 0 ) {
            $is_approved_dates = $slct_sql_results[0]->approved;
        }

        $delete_sql = "DELETE FROM {$wpdb->prefix}bookingdates WHERE booking_id IN ({$my_booking_id})";
        if ( false === $wpdb->query( $delete_sql  ) ){
            ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php bk_error('Error during updating exist booking for deleting dates in DB' ,__FILE__,__LINE__); ?></div>'; </script> <?php
            die();
        }
        $booking_id = (int) $my_booking_id;       //Get ID  of reservation

    } else {                                // Add new booking

        $sql_insertion = "INSERT INTO {$wpdb->prefix}booking (form, booking_type, modification_date) VALUES ('{$formdata}',  {$bktype}, {$my_modification_date} )" ;

        if ( false === $wpdb->query( $sql_insertion ) ){
            ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php bk_error('Error during inserting into DB',__FILE__,__LINE__); ?></div>'; </script> <?php
            die();
        }
        // Make insertion into BOOKINGDATES
        $booking_id = (int) $wpdb->insert_id;       //Get ID  of reservation


        $is_approved_dates = '0';
        $auto_approve_new_bookings_is_active       =  get_bk_option( 'booking_auto_approve_new_bookings_is_active' );
        if ( trim($auto_approve_new_bookings_is_active) == 'On')
            $is_approved_dates = '1';

    }


    $my_dates = explode(",",$dates);
    $i=0; foreach ($my_dates as $md) {$my_dates[$i] = trim($my_dates[$i]) ; $i++; }

    $start_end_time = get_times_from_bk_form($formdata, $my_dates, $bktype);
    $start_time = $start_end_time[0];
    $end_time = $start_end_time[1];
    $my_dates = $start_end_time[2];

    make_bk_action('wpdev_booking_post_inserted', $booking_id, $bktype, str_replace('|',',',$dates),  array($start_time, $end_time ) );
    $my_cost = apply_bk_filter('get_booking_cost_from_db', '', $booking_id);


    $i=0;
    foreach ($my_dates as $md) { // Set in dates in such format: yyyy.mm.dd
        if ($md != '') {
            $md = explode('.',$md);
            $my_dates[$i] = $md[2] . '.' . ( (intval($md[1])<10) ? ('0'.intval($md[1])) : $md[1] ) . '.' . ( (intval($md[0])<10) ? ('0'.intval($md[0])) : $md[0] ) ;
        } else { unset($my_dates[$i]) ; } // If some dates is empty so remove it   // This situation can be if using several bk calendars and some calendars is not checked
        $i++;

    }  
    sort($my_dates); // Sort dates

    
    $i=0;
    $insert = '';
    $my_date_previos = '';
    $my_dates4emeil = '';
    foreach ($my_dates as $my_date) {
        $i++;          // Loop through all dates
        if (strpos($my_date,'.')!==false) {

            if ( get_bk_option( 'booking_recurrent_time' ) !== 'On') {
                    $my_date = explode('.',$my_date);
                    if ($i == 1) {
                        if ( (! isset($start_time[0])) || (empty($start_time[0])) ) $start_time[0] = '00';
                        if ( (! isset($start_time[1])) || (empty($start_time[1])) ) $start_time[1] = '00';                        
                        if ( ($start_time[0] == '00') && ($start_time[1] == '00') ) $start_time[2] = '00';

                        $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], $start_time[0], $start_time[1], $start_time[2] );
                    }elseif ($i == count($my_dates)) {

                        if ( (! isset($end_time[0])) || (empty($end_time[0])) ) $end_time[0] = '00';
                        if ( (! isset($end_time[1])) || (empty($end_time[1])) ) $end_time[1] = '00';                        
                        if ( ($end_time[0] == '00') && ($end_time[1] == '00') ) $end_time[2] = '00';

                        $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], $end_time[0], $end_time[1], $end_time[2] );
                    }else {
                        $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], '00', '00', '00' );
                    }
                    $my_dates4emeil .= $date . ',';
                    if ( !empty($insert) ) $insert .= ', ';
                    $insert .= "('$booking_id', '$date', '$is_approved_dates' )";
            } else {
                    if ($my_date_previos  == $my_date) continue; // escape for single day selections.

                    $my_date_previos  = $my_date;
                    $my_date = explode('.',$my_date);
                    $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], $start_time[0], $start_time[1], $start_time[2] );
                    $my_dates4emeil .= $date . ',';
                    if ( !empty($insert) ) $insert .= ', ';
                    $insert .= "('$booking_id', '$date', '$is_approved_dates' )";

                    $date = sprintf( "%04d-%02d-%02d %02d:%02d:%02d", $my_date[0], $my_date[1], $my_date[2], $end_time[0], $end_time[1], $end_time[2] );
                    $my_dates4emeil .= $date . ',';
                    if ( !empty($insert) ) $insert .= ', ';
                    $insert .= "('$booking_id', '$date', '$is_approved_dates' )";

            }

        }
    }
    $my_dates4emeil = substr($my_dates4emeil,0,-1);

    $my_dates4emeil_check_in_out = explode(',',$my_dates4emeil);
    $my_check_in_date  = change_date_format($my_dates4emeil_check_in_out[0] );
    $my_check_out_date = change_date_format($my_dates4emeil_check_in_out[ count($my_dates4emeil_check_in_out)-1 ] );

    // Save the sort date
    $sql_sort_date  = "UPDATE {$wpdb->prefix}booking SET sort_date = '{$my_dates4emeil_check_in_out[0]}' WHERE booking_id  = {$booking_id} ";
    $wpdb->query( $sql_sort_date );

    if ( !empty($insert) )
        if ( false === $wpdb->query( "INSERT INTO {$wpdb->prefix}bookingdates (booking_id, booking_date, approved) VALUES " . $insert ) ){
            ?> <script type="text/javascript"> document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php bk_error('Error during inserting into BD - Dates',__FILE__,__LINE__); ?></div>'; </script> <?php
            die();
        }

    if ($my_booking_id>0) { // For editing exist booking

        if ($is_send_emeils != 0 )
            sendModificationEmails($booking_id, $bktype, $formdata  );

        if ( strpos($_SERVER['HTTP_REFERER'],'wp-admin/admin.php?') ===false ) {
            do_action('wpdev_new_booking',$booking_id, $bktype, str_replace('|',',',$dates), array($start_time, $end_time ) ,$formdata );
        }

        ?> <script type="text/javascript">
        <?php
        if ( strpos($_SERVER['HTTP_REFERER'],'wp-admin/admin.php?') ===false ) { ?>
                    setReservedSelectedDates('<?php echo $bktype; ?>');
            <?php }  else { ?>
                    document.getElementById('ajax_message').innerHTML = '<?php echo __('Updated successfully', 'wpdev-booking'); ?>';
                    jQuery('#ajax_message').fadeOut(1000);
                    document.getElementById('submiting<?php echo $bktype; ?>').innerHTML = '<div style=&quot;height:20px;width:100%;text-align:center;margin:15px auto;&quot;><?php echo __('Updated successfully', 'wpdev-booking'); ?></div>';
                    if ( jQuery('#wpdev_http_referer').length > 0 ) {
                           location.href=jQuery('#wpdev_http_referer').val();
                    } else location.href='admin.php?page=<?php echo WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME ;?>wpdev-booking&view_mode=vm_listing&tab=actions&wh_booking_id=<?php echo  $my_booking_id;?>';
            <?php } ?>
            </script> <?php

    } else {

        // For inserting NEW booking
        if ( count($my_dates) > 0 )                    
            if ($is_send_emeils != 0 )
                sendNewBookingEmails($booking_id, $bktype, $formdata) ;

        do_action('wpdev_new_booking',$booking_id, $bktype, str_replace('|',',',$dates), array($start_time, $end_time ) ,$formdata );
        
        // wpbc_integrate_MailChimp($formdata, $bktype);

        $auto_approve_new_bookings_is_active       =  get_bk_option( 'booking_auto_approve_new_bookings_is_active' );
        if ( trim($auto_approve_new_bookings_is_active) == 'On') {
            sendApproveEmails($booking_id, 1);
        }
        ?> <script type="text/javascript"> setReservedSelectedDates('<?php echo $bktype; ?>'); </script>  <?php
    }

    // ReUpdate booking resource TYPE if its needed here
    if (! empty($dates) ) // check to have dates not empty
        make_bk_action('wpdev_booking_reupdate_bk_type_to_childs', $booking_id, $bktype, str_replace('|',',',$dates),  array($start_time, $end_time ) , $formdata );

}


//  CAPTCHA CHECKING   //////////////////////////////////////////////////////////////////////////////////////
function wpbc_check_CAPTCHA( $the_answer_from_respondent, $prefix, $bktype ) {
        
    if (! ( ($the_answer_from_respondent == '') && ($prefix == '') ) ) {
        $captcha_instance = new wpdevReallySimpleCaptcha();
        $correct = $captcha_instance->check($prefix, $the_answer_from_respondent);

        if (! $correct) {
            $word = $captcha_instance->generate_random_word();
            $prefix = mt_rand();
            $captcha_instance->generate_image($prefix, $word);

            $filename = $prefix . '.png';
            $captcha_url = WPDEV_BK_PLUGIN_URL . '/js/captcha/tmp/' .$filename;
            $ref = substr($filename, 0, strrpos($filename, '.'));
            ?> <script type="text/javascript">
                document.getElementById('captcha_input<?php echo $bktype; ?>').value = '';
                document.getElementById('captcha_img<?php echo $bktype; ?>').src = '<?php echo $captcha_url; ?>';
                document.getElementById('wpdev_captcha_challenge_<?php echo $bktype; ?>').value = '<?php echo $ref; ?>';
                document.getElementById('captcha_msg<?php echo $bktype; ?>').innerHTML = '<span class="alert" style="padding: 5px 5px 4px;vertical-align: middle;text-align:center;margin:5px;"><?php echo __('The code you entered is incorrect', 'wpdev-booking'); ?></span>';
                document.getElementById('submiting<?php echo $bktype; ?>').innerHTML ='';
                jQuery('#captcha_input<?php echo $bktype; ?>')
                  .fadeOut( 350 ).fadeIn( 300 )
                  .fadeOut( 350 ).fadeIn( 400 )
                  .animate( {opacity: 1}, 4000 );  
                jQuery("span.wpdev-help-message span.alert")
                  .fadeIn( 1 )
                  //.css( {'color' : 'red'} )
                  .animate( {opacity: 1}, 10000 )
                  .fadeOut( 2000 );   // hide message
                document.getElementById('captcha_input<?php echo $bktype; ?>').focus();    // make focus to elemnt
                jQuery('#booking_form_div<?php echo $bktype; ?> input[type=button]').prop("disabled", false);
            </script> <?php
            return false;
        }
    }//////////////////////////////////////////////////////////////////////////////////////////////////////////
    return true;
}


// Customization  for the integration  of Mail Chimp Subscription.
function wpbc_integrate_MailChimp($formdata , $bktype) {
            /*
        // Start Mail Chimp Customization
        $booking_form_show = get_form_content ($formdata , $bktype );
        if ( ( isset ($booking_form_show['subscribe_me'] )) && ( $booking_form_show['subscribe_me'] == 'yes') ) {

            if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/MailChimp.class.php')) { // Include MailChimp class (You can download it from  here https://github.com/drewm/mailchimp-api/ )
                require_once(WPDEV_BK_PLUGIN_DIR. '/lib/MailChimp.class.php' ); 

                $MailChimp = new MailChimp('key-my');                          // You are need to specify here YOUR KEY !!!!

                $result = $MailChimp->call('lists/subscribe', array(
                                'id'                => 'id' . $booking_id ,          
                                'email'             => array('email'=>$booking_form_show['email']),
                                'merge_vars'        => array('FNAME'=>$booking_form_show['name'], 'LNAME'=>$booking_form_show['secondname']),
                                'double_optin'      => false,
                                'update_existing'   => true,
                                'replace_interests' => false,
                                'send_welcome'      => false,
                            ));
                // print_r($result);
            }
        } // End Mail Chimp Customization
        /**/

}
?>