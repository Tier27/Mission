<?php
/*
Plugin Name: Booking Calendar
Plugin URI: http://wpbookingcalendar.com/demo/
Description: Online reservation and availability checking service for your site.
Version: 5.0.4
Author: wpdevelop
Author URI: http://wpbookingcalendar.com/
Tested WordPress Versions: 3.3 - 3.8
*/

/*  Copyright 2009 - 2013  www.wpbookingcalendar.com  (email: info@wpbookingcalendar.com),

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

// <editor-fold defaultstate="collapsed" desc=" T O D O : & Changelog lists ">
/*
-----------------------------------------------
Change Log and Features for Future Releases :
-----------------------------------------------
 * New Files:
 * =====================================
 * lib\
 * ====================================
 *
 *
 *  
= 5.0.4 =
* Fix CSS headers issue in admin panel for the WordPress 3.8

= 5.0.3 =
* Set position of the version number to the absolute bottom on the Booking Listing page.
* Fixed issue. Sometimes the "number of unavailbale days from today" was working incorrectly.
* Added new transaltion  to Swedish by Mattias Aslund [51% complete]

= 5.0.2 =
* Personal / Business Small / Business Medium / Business Large / MultiUser versions features:
 * Set **day titles** in Calendar Overview mode as **links for setting start date** of booking listing. (Personal, Business Small/Medium/Large, MultiUser)
 * **Edit booking link** in mouse over tooltip at Calendar Overview admin page. (Personal, Business Small/Medium/Large, MultiUser)
 * Redirect to the exact previous page, after booking editing, where user was before. (Personal, Business Small/Medium/Large, MultiUser)   
 * Fix issue of submitting booking form  for the several calendars of different booking resources. (Business Medium/Large, MultiUser)   
 * Fix issue of showing sometimes Warning: Invalid argument supplied for foreach() in ../biz_m.php on line 638
 * Fix issue of not showing the booking dates in calendar, if booking shortcode is contain empty "agregate" parameter, like this: agregate=''
* Features and issue fixings in All versions: 
 * Fix issue of possible JavaScript error "SyntaxError: symbol is not a legal ECMA-262 octal constant", when selecting the start month of availability calendar for the booking shortcode lower then 10.
 * Fix CSS reseting padding and maring in calendar.css file for the calendar table to prevent conflicts with some WP themes.
 
= 5.0.1 =
* Fixed of incorrect saving checkbox data.
* Customization of **setting specific week day(s)** as the **start day of selection in calendar**, for the specific **season filter**. (Business Medium/Large, MultiUser) 
 
= 5.0 =
* Personal / Business Small / Business Medium / Business Large / MultiUser versions features:
 * 
 * New Calendar Overview panel for Multiple Booking Resources ("Matrix"). Beautiful Easy to Understand Interface. Resources at the first column and booking dates in right rows. (Personal, Business Small/Medium/Large, MultiUser) 
 * Day, Week, Month or 2 Months View Mode. Possibility to set a Day, Week, Month or 2 Months view mode for the "Matrix" Calendar Overview panel. (Personal, Business Small/Medium/Large, MultiUser) 
 * Select Several Specific or All Resources. Possibility to select several specific or all booking resources at "Filter tab" of Booking Listing or Calendar Overview panel. (Personal, Business Small/Medium/Large, MultiUser) 
 * 
 * Show Pending Days as Available. Possibility to book Pending Days, until you Approve some booking. Do not lose any bookings, if some bookings were made by mistake or it was spam. (Business Large, MultiUser)
 * Auto Decline. Activate the Auto decline (delete) all pending bookings in your booking resource for the specific date(s), if you approved other booking for these date(s). (Business Large, MultiUser)
 *
 * Set Different Time Slots for the Different Days. You can configure different Time Slots availability for the different days (weekday or date from season filter). Each week day (day of specific season filter) can have different time slots list. Check more here: http://wpbookingcalendar.com/help/different-time-slots-selections-for-different-days/ (Business Medium/Large, MultiUser)
 * Show Specific Form Content, if Desire Date is Selected. You are need to show specific field(s), form section or just text, if specific date is selected (weekday or date from season filter) - it's also possible. Check more here: http://wpbookingcalendar.com/help/different-content-for-different-days-selection/ (Business Medium/Large, MultiUser)
 * 
 * Configure Number of Days selection. Specify that during certain seasons (or day of week), the specific minimum (or fixed) number of days must be booked. Check more about this "options" parameter here. Example: visitor can select only 3 days starting at Friday and Saturday, 4 days – Friday, 5 days – Monday, 7 days – Saturday, etc… (Business Medium/Large, MultiUser)
 * Set several Start Days. Specify several weekdays as possible start day for the range days selection. For exmaple visitor can make range days selection only from Sat, Mon and Fri. (Business Small/Medium/Large, MultiUser)
 * Easy configuration of range days selection. Configure "specific days selections", for the "range days selection" mode, in more comfortable way. Separate days by dash or comma. Example: "3-5,7,14". It's mean possibility to select: 3, 4, 5, 7 or 14 days. (Business Small/Medium/Large, MultiUser)
 * 
 * Integration Authorize.Net Payment Gateway - Server Integration Method (SIM). (Business Small/Medium/Large, MultiUser)
 * Currency Format. Configure format of showing the cost in the payment form. (Business Small/Medium/Large, MultiUser)
 * Do More with Less Actions. Assign "Availability", "Rates", "Valuations days" or "Deposit amount" to the several booking resources in 1 step. Select several booking resources. Click on "Rate", "Availability", "Valuations days" or "Deposit" button. Configure and Update settings. That's it. (Business Medium/Large, MultiUser)
 * 
 * qTranslate Support. Full support of the qTranslate plugin. Including the search results content and links to the the post with booking forms in correct language. (Personal, Business Small/Medium/Large, MultiUser)
 * Edit Past Bookings. Edit your bookings, where the time or dates are already in the past. (Personal, Business Small/Medium/Large, MultiUser)
 * Trick: [denyreason] shortcode for "Approve" email. Its mean that we can write some text into the "Reason of cancelation" field for having this custom text in the "Approve" email template. (Personal, Business Small/Medium/Large, MultiUser)
 * Checking End Time only. Set checking only end time of bookings for Today. So start time can be already in a past. Reactivate old checking using JavaScript code: is_check_start_time_gone=true; (Business Small/Medium/Large, MultiUser)   
 * Delete your Saved Filter. Delete your Default saved filter template on the Booking Listing page at "Filter" tab. (Personal, Business Small/Medium/Large, MultiUser)
 * Set cost for the "Check Out" date. Possibility to use new reserved word LAST ("Check Out" date) in the "Valuation days" cost settings page for the field "For". So you can define the cost of last selected date. Example of configuration: { "For" "LAST" day = "0" "USD per 1 day" "Any days" } (Business Medium/Large, MultiUser) 
 * Advanced Additional Cost. Set additional cost of the booking as percentage of the original booking cost. This original booking cost doesn't have impact from any other additional cost settings. Usage: just write "+" sign before percentage number. Example: "+50%". (Business Medium/Large, MultiUser)
 * Set "Check In/Out" dates as Available. Set "check in/out" dates as available for resources with capacity higher then one. Its useful, if the check in date of booking have to be the same as check out date of other booking. (Business Large, MultiUser)
 * Visitors Selection in Search Result. Auto selection of the correct visitor number in the booking form, when the user redirected from the search form. (Business Large, MultiUser)
 * Use "Unavailable days from today" settings in Search Form. Using the settings of "Unavailable days from today" for the calendars in the search form. (Business Large, MultiUser)
 * Shortcodes for Emails and Content Form. Long list of useful shortcodes for the Email Templates and the "Content of Booking Fields" form: [cost_hint], [original_cost_hint], [additional_cost_hint], [deposit_hint], [balance_hint], [check_in_date_hint], [check_out_date_hint], [start_time_hint], [end_time_hint], [selected_dates_hint], [selected_timedates_hint], [selected_short_dates_hint], [selected_short_timedates_hint], [days_number_hint], [nights_number_hint] (Business Medium/Large, MultiUser)
 * New Shortcodes for Hints in booking form. New shortcodes for showing real-time hints (like [cost_hint]) inside of the booking form: [deposit_hint], [balance_hint], [check_in_date_hint], [check_out_date_hint], [start_time_hint], [end_time_hint], [selected_dates_hint], [selected_timedates_hint], [selected_short_dates_hint], [selected_short_timedates_hint], [days_number_hint], [nights_number_hint] (Business Medium/Large, MultiUser)
 * Change titles of payment buttons. Possibility to chnage the titles of the buttons in the payment forms. (Business Small/Medium/Large, MultiUser)   
 * 
 * Support Radio Button fields.
 * New help system for booking form fields configuration. You can configure different form field’s shortcodes easily using smart configuration panel. 
 * Help Fields Panel. Text Fields - possibility to set CSS Class, ID, Size and Maxlength parameters.
 * Help Fields Panel. Email Fields - possibility to set CSS Class, ID, Size and Maxlength parameters.
 * Help Fields Panel. Textarea Fields - possibility to set CSS Class, ID, number of Rows and Columns parameters.
 * Help Fields Panel. Drop Down Fields - possibility to set field as Required, Allow multile selections, Set default selected Option, Set Titles for the Options.
 * Help Fields Panel. Checkbox Fields - set different parameters: Name, Default Selected option, Required state, Exclusive state, Set Options and Titles for the options, Set CSS Class and ID of element, Set using Labels.
 * Help Fields Panel. Radio Button Fields - set different parameters: Name, Default Selected option, Set Options and Titles for the options, Set CSS Class and ID of element, Set using Labels.
 * Help Fields Panel. Drop Down Fields - possibility to set field as Required, Allow multile selections, Set default selected Option, Set Titles for the Options.
 * Help Fields Panel. Submit button - possibility to set CSS Class and ID parameters.
 * Help Fields Panel. Time Slot List. Set options and titles of the times selection, possibility to set ID, CSS Class Required state and "Long selection" view mode.
 * Help Fields Panel. Start Time Drop Down List. Set options and titles of the times selection, possibility to set ID, CSS Class Required state.
 * Help Fields Panel. End Time Drop Down List. Set options and titles of the times selection, possibility to set ID, CSS Class Required state.
 * Help Fields Panel. Duration Time Drop Down List. Set options and titles of the times selection, possibility to set ID, CSS Class Required state.
 * Help Fields Panel. Conditional sections for possibility to set Different time slots, for the different week days or days from different seasons.
 * Help Fields Panel. Time Field. Set options and titles of the times selection, possibility to set ID, CSS Class Required state.
 * Help Fields Panel. Description about languge sections.
 * Help Fields Panel. Conditional sections for activating specific fields, depending from the different week days or days of different seasons.
 * Help Fields Panel. Coupon disciunt Fields - possibility to set CSS Class, ID, Size and Maxlength parameters.
 * Help Fields Panel. Cost Hints: [cost_hint], [original_cost_hint], [additional_cost_hint], [deposit_hint], [balance_hint]
 * Help Fields Panel. Dates Hints: [check_in_date_hint], [check_out_date_hint], [start_time_hint], [end_time_hint], [selected_dates_hint], [selected_timedates_hint], [selected_short_dates_hint], [selected_short_timedates_hint], [days_number_hint], [nights_number_hint] 
 * 
 * Fix issue of showing available dates in search results, if these dates was set as unavailable in the season filter. (Business Large, MultiUser)
 * Fix issue of incorrect links in the email templates shortcodes, if was used the "url" parmeter and this URL was contain this symbol '=' (Business Small/Medium/Large, MultiUser)
 * Fix of incorrect booking cost saving, if booking was add using "Add booking" admin menu page and in the booking form was used the [cost_correction] shortcode for the entering cost manually. Its issue was exist only for the cost, what is higher than 1000. (Business Small/Medium/Large, MultiUser)
 * Fix of showing incorrect booking resource selections, when switching from the calendar overview mode to the booking listing mode.  (Personal, Business Small/Medium/Large, MultiUser)
 * Fix of not showing bookings, when was switching from the Booking Listing (on page higher than 1) to Calendar Overview mode, then  selecting other booking resource and switching back to the Booking Listing page. (Personal, Business Small/Medium/Large, MultiUser)
 * Fix issue of not showing the calendar if using the "agregate" parameter in the booking shortcode. (Personal, Business Small/Medium/Large, MultiUser)
 * Fix issue in Calendar Overview mode for bookings by the hour, the calendar was displays an extra hour booked.  So, if we have a booking at 10:00 for 1 hour, the calendar was display that booking from 10:00 to 12:00, now its show from the 10:00 to 11:00 (Business Small/Medium/Large, MultiUser)
 * Fix several issues relative to the bookings editing (including issues during editing of the bookings for the "child" booking resources). (Personal, Business Small/Medium/Large, MultiUser)
 * Fix issue of not showing the "booking data" of the specific booking for the Super booking admin user, if this booking was done by the other Super booking admin user. (MultiUser)
 * 
* Features and issue fixings in All versions: 
 * Responsive front end design. We have completely rewritten the CSS of calendar skins and booking form. Booking form and calendar support fully responsive design that looks great on any device.
 * Smoother Booking Experience. Booking form now has new nice calendar skins and sleek form fields with nice warning messages.
 * Easy to customize. Much more easy to configure for fitting to your site design. Configure calendar width, height or even structure (number of months in a row) from settings in a minute.
 * 
 * Configure your predefined form fields set. Write Labels for your fields. Now (at Booking > Settings > Fields page) is possible to change the form fields labels.
 * Activate or Deactivate fields. You can activate or deactivate the fields from the predefined fields set. 
 * Set as required specific fields. You can set as required specific fields in your booking form from the predefined fields set
 * 
 * Approve or Reject Booking in 1 Click on Calendar Overview page. Make common actions, like Approve, Decline or Delete of the booking in One Click on the Calendar Overview panel.
 * 
 * Improved Performance. WP Booking Calendar has been dramatically improved in terms of performance to make your site run better and faster.
 * Customize the Calendar Skins. The calendar skins ../css/skins/ are located separately from the calendar structure file ../css/calendar.css and very well commented. So you do not need to worry about the structure, sizes or responsive design of the calendar and concentrate only on design.
 * 
 * Possibility to define any custom "Start date" of bookings listing in Calendar Overview mode at Navigation toolbar instead of only Current date/month. 
 * New Welcome page.
 * New "Get Started" panel.
 * Change the "New bookings" parameter selection from the button to selectbox in the Extended Filter tab at Booking Listing page.
 * Automatically set specific "Radio button" as checked in the "Booking dates" and the "Creation dates" parameters at the Filters tab if specific dates or other option is selected.
 * Using the Bootstrap CSS for the booking form.
 * 
 * Prevent of submitting the booking form with the same CAPCTCHA after refreshing the page with old data.
 * Fix issue of possibility several times submit booking form (at the same date/time will be several same bookings), by clicking several times on the Submit button, until the booking form is not hided. 
 * Fix issue of showing the dates in correct language (locale) for the payment requests or some other actions, what are sending in ajax requests.
 * Fix compatibility with "Advanced Custom Fields" plugin (Version 4.1.5.1) Posibility to insert  the booking shortcode into the posts or pages.
 * Fix issue of showing /n instead of the new line in the emails templates, if in the text area was type enter(s).
 * Fix issue of not translted the "Month titles" at the left collumn on the Booking Calendar Overview page in admin panel.
 * Fix issue of possibility to filter the booking listing for the same check  in/out date, if the booking was done at specific timeslot at single date.
 * Fix setting of state of Read / Unread button at the "Filter tab" on the Booking Listing page.
 * Fix issue with the filter results in the admin area. If choose a particular date and use the same date for check-in and check-out, we got no results even there are bookings. 
 * Fix. Change the declaration of the wp_register_script from jquerymigrate to jquery-migrate (if we are in the WordPress 3.6, so load the default script then)
 * Many other small issue fixing and improvements...
*/
// </editor-fold>


    // Die if direct access to file
    if (   (! isset( $_GET['wpdev_bkpaypal_ipn'] ) ) && 
           (! isset( $_GET['merchant_return_link'] ) ) && 
           (! isset( $_GET['payed_booking'] ) ) && 
           ( (! isset($_GET['pay_sys']) ) || ($_GET['pay_sys'] != 'authorizenet') ) &&
           (! function_exists ('get_option') )  && 
           (! isset( $_POST['ajax_action'] ) ) 
       ) { die('You do not have permission to direct access to this file !!!'); }

    // A J A X /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if ( 
         ( isset( $_GET['wpdev_bkpaypal_ipn'] ) )  || 
         ( isset( $_GET['payed_booking'] ) )  || 
         (  isset( $_GET['merchant_return_link']))  || 
         ( (isset($_GET['pay_sys']) ) && ($_GET['pay_sys'] == 'authorizenet') ) ||    
         ( isset( $_POST['ajax_action'] ) ) ) {
        require_once( dirname(__FILE__) . '/../../../wp-load.php' );
        @header('Content-Type: text/html; charset=' . get_option('blog_charset'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //   D e f i n e     S T A T I C              //////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if (!defined('WP_BK_VERSION_NUM'))   define('WP_BK_VERSION_NUM',  '5.0.3' );
    if (!defined('WP_BK_SSL'))           define('WP_BK_SSL',  false );
    if (!defined('WP_BK_MINOR_UPDATE'))  define('WP_BK_MINOR_UPDATE',  true );    
    if (!defined('IS_USE_WPDEV_BK_CACHE'))           define('IS_USE_WPDEV_BK_CACHE',  true );    
    if (!defined('WP_BK_DEBUG_MODE'))    define('WP_BK_DEBUG_MODE',  false );
    if (!defined('WP_BK_SHOW_INFO_IN_FORM'))    define('WP_BK_SHOW_INFO_IN_FORM',  false );                 // This feature can impact to the performace
    if (!defined('WPDEV_BK_FILE'))       define('WPDEV_BK_FILE',  __FILE__ );
    if (WP_BK_SSL)   $wpdev_bk_my_site_url = site_url('','https');
    else             $wpdev_bk_my_site_url = site_url();
    if (!defined('WP_CONTENT_DIR'))      define('WP_CONTENT_DIR', ABSPATH . 'wp-content');                   // Z:\home\test.wpdevelop.com\www/wp-content
    if (!defined('WP_CONTENT_URL'))      define('WP_CONTENT_URL', $wpdev_bk_my_site_url . '/wp-content');    // http://test.wpdevelop.com/wp-content
    if (!defined('WP_PLUGIN_DIR'))       define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');               // Z:\home\test.wpdevelop.com\www/wp-content/plugins
    if (!defined('WP_PLUGIN_URL'))       define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');               // http://test.wpdevelop.com/wp-content/plugins
    if (!defined('WPDEV_BK_PLUGIN_FILENAME'))  define('WPDEV_BK_PLUGIN_FILENAME',  basename( __FILE__ ) );              // menu-compouser.php
    if (!defined('WPDEV_BK_PLUGIN_DIRNAME'))   define('WPDEV_BK_PLUGIN_DIRNAME',  plugin_basename(dirname(__FILE__)) ); // menu-compouser
    if (!defined('WPDEV_BK_PLUGIN_DIR')) define('WPDEV_BK_PLUGIN_DIR', WP_PLUGIN_DIR.'/'.WPDEV_BK_PLUGIN_DIRNAME ); // Z:\home\test.wpdevelop.com\www/wp-content/plugins/menu-compouser
    if (!defined('WPDEV_BK_PLUGIN_URL')) define('WPDEV_BK_PLUGIN_URL', $wpdev_bk_my_site_url.'/wp-content/plugins/'.WPDEV_BK_PLUGIN_DIRNAME ); // http://test.wpdevelop.com/wp-content/plugins/menu-compouser


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //   L O A D   F I L E S                      //////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-functions.php')) {     // S u p p o r t    f u n c t i o n s
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-functions.php' ); }
        
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpbc-class-dismiss.php')) {          // C L A S S  -  Dismiss
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpbc-class-dismiss.php' ); 
        global $wpbc_Dismiss;
        $wpbc_Dismiss = new WPBC_Dismiss();
    }

    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-settings-general.php')) {     // S e t t i n g s
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-settings-general.php' ); }
        
        
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-widget.php')) {        // W i d g e t s
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-widget.php' ); }

    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/js/captcha/captcha.php'))  {             // C A P T C H A
        require_once(WPDEV_BK_PLUGIN_DIR. '/js/captcha/captcha.php' );}

    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/inc/personal.php'))   {                  // O t h e r
        require_once(WPDEV_BK_PLUGIN_DIR. '/inc/personal.php' ); }
        
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-bk-lib.php')) {                // S u p p o r t    l i b
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-bk-lib.php' ); }
                
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-bk-timeline.php')) {           // T i m e l i ne    l i b
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-bk-timeline.php' ); }
        
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-bk-edit-toolbar-buttons.php')) { // B o o k i n g    B u t t o n s   in   E d i t   t o o l b a r
        require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-bk-edit-toolbar-buttons.php' ); }

    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-class.php'))           // C L A S S    B o o k i n g
        { require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-class.php' ); }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // GET VERSION NUMBER
    $plugin_data = get_file_data_wpdev(  __FILE__ , array( 'Name' => 'Plugin Name', 'PluginURI' => 'Plugin URI', 'Version' => 'Version', 'Description' => 'Description', 'Author' => 'Author', 'AuthorURI' => 'Author URI', 'TextDomain' => 'Text Domain', 'DomainPath' => 'Domain Path' ) , 'plugin' );
    if (!defined('WPDEV_BK_VERSION'))    define('WPDEV_BK_VERSION',   $plugin_data['Version'] );                             // 0.1
            

    //    A J A X     R e s p o n d e r     // RUN if Ajax //
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-ajax.php'))  { require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpdev-booking-ajax.php' ); }

    //Wellcome page
    if (file_exists(WPDEV_BK_PLUGIN_DIR. '/lib/wpbc-welcome.php'))                 // W E L C O M E
        { require_once(WPDEV_BK_PLUGIN_DIR. '/lib/wpbc-welcome.php' ); }
    
    // RUN //
    $wpdev_bk = new wpdev_booking();
?>