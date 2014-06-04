<?php
/**
 * Welcome Page Class
 *
 * Shows a feature overview for the new version (major).
 *
 * Adapted from code in EDD (Copyright (c) 2012, Pippin Williamson) and WP.
 * 
 * @version     2.0.0
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * WPBC_Welcome Class
 */
class WPBC_Welcome {

	/**
	 * @var string The capability users should have to view the page
	 */
	public $minimum_capability = 'read';    //'manage_options';
        private $asset_path = 'http://wpbookingcalendar.com/assets/5.0/';
	/**
	 * Get things started
	 *
	 * @access  public
	 * @since 1.4
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus') );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_init', array( $this, 'welcome'    ) );
	}

	/**
	 * Register the Dashboard Pages which are later hidden but these pages
	 * are used to render the Welcome and Credits pages.
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function admin_menus() {
		// About Page
		add_dashboard_page(
			__( 'Welcome to WP Booking Calendar', 'wpdev-booking' ),
			__( 'Welcome to WP Booking Calendar', 'wpdev-booking' ),
			$this->minimum_capability,
			'wpbc-about',
			array( $this, 'about_screen' )
		);

		// Credits Page
		add_dashboard_page(
			__( 'Welcome to WP Booking Calendar', 'wpdev-booking' ),
			__( 'Welcome to WP Booking Calendar', 'wpdev-booking' ),
			$this->minimum_capability,
			'wpbc-about-premium',
			array( $this, 'about_premium_screen' )
		);
	}

	/**
	 * Hide Individual Dashboard Pages
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function admin_head() {
		remove_submenu_page( 'index.php', 'wpbc-about' );
		remove_submenu_page( 'index.php', 'wpbc-about-premium' );
		?>
		<style type="text/css" media="screen">
		/*<![CDATA[*/
		.wpbc-badge {
                    display:none;
/*                      padding-top: 150px;
                        height: 52px;
                        width: 185px;
                        color: #666;
                        font-weight: bold;
                        font-size: 14px;
                        text-align: center;
                        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
                        margin: 0 -5px;
                        background: url('<?php $badge_url = WPDEV_BK_PLUGIN_URL . '/assets/images/wpbc-badge.png'; echo $badge_url; ?>') no-repeat;*/
		}

/*		.wpbc-welcome-page .about-wrap .wpbc-badge {
                    position: absolute;
                    top: 0;
                    right: 0;
		}*/

                .wpbc-welcome-page .about-text {
                    margin-right:0px;
                }
                .wpbc-welcome-page .versions {
                    color: #999999;
                    font-size: 12px;
                    font-style: normal;
                    margin: 0;
                    text-align: right;
                    text-shadow: 0 -1px 0 #EEEEEE;
                    float:left;
                }
                .wpbc-welcome-page .versions a,
                .wpbc-welcome-page .versions a:hover{
                   color: #999;
                   text-decoration:none;
                }
                .wpbc-welcome-page .update-nag {
                    border-color: #E3C58E;
                    border-radius: 5px;
                    -moz-border-radius: 5px;
                    -webkit-border-radius: 5px;
                    box-shadow: 0 1px 3px #EEEEEE;
                    color: #998877;
                    font-size: 12px;
                    font-weight: bold;
                    margin: 15px 0 0;                    
                }

		/*]]>*/
		</style>
		<?php
	}
        
        /** Show Title Section and Menu of Welcome page 
         * 
         */
        public function title_section() {
                list( $display_version ) = explode( '-', WPDEV_BK_VERSION );
                ?>
                <h1><?php printf( __( 'Welcome to WP Booking Calendar %s', 'wpdev-booking' ), $display_version ); ?></h1>
                <div class="about-text"><?php 
                    _e('Thank you for updating to the latest version!', 'wpdev-booking'); 
                    printf( __( '%s is more polished, powerful and easy to use than ever before.', 'wpdev-booking' ), ' WP Booking Calendar ' . $display_version ); ?></div>
                <!--div class="wpbc-badge"><?php printf( __( 'Version %s', 'wpdev-booking' ), $display_version ); ?></div-->

                <h2 class="nav-tab-wrapper">
                    <?php 
                        $is_about_tab_active = $is_about_premium_tab_active = '';
                        if ( ( isset($_GET['page']) ) && ( $_GET['page'] == 'wpbc-about' ) )            $is_about_tab_active = ' nav-tab-active ';
                        if ( ( isset($_GET['page']) ) && ( $_GET['page'] == 'wpbc-about-premium' ) )    $is_about_premium_tab_active = ' nav-tab-active ';
                    ?>
                        <a class="nav-tab<?php echo $is_about_tab_active; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wpbc-about' ), 'index.php' ) ) ); ?>">
                                <?php _e( "What's New", 'wpdev-booking' ); ?>
                        </a><a class="nav-tab<?php echo $is_about_premium_tab_active; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wpbc-about-premium' ), 'index.php' ) ) ); ?>">
                                <?php _e( "Even more Premium Features", 'wpdev-booking' ); ?>
                        </a>
                </h2>                
                <?php
        }

        /** Show Maintence section  for the MINOR Updates
         * 
         */
        public function maintence_section(){
                
                if ( ! ( ( defined('WP_BK_MINOR_UPDATE')) && (WP_BK_MINOR_UPDATE) ) )
                    return;
                
                list( $display_version ) = explode( '-', WPDEV_BK_VERSION );    
                ?>
                <div class="changelog point-releases">
                        <h3><?php _e( "Maintenance and Security Release", 'wpdev-booking' ); ?></h3>
                        <p><strong><?php printf( __( 'Version %s', 'wpdev-booking' ), $display_version ); ?></strong> <?php printf( __( 'addressed some security issues and fixed %s bugs', 'wpdev-booking' ), '' ); ?>. 
                            <?php printf( __( 'For more information, see %sthe release notes%s', 'wpdev-booking' ),'<a href="http://wpbookingcalendar.com/changelog/" target="_blank">','</a>') ?>.
                        </p>
                </div>                        
                <?php              
        }
        
        
	/**
	 * Render About Screen
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function about_screen() {		
		?>
		<div class="wrap about-wrap wpbc-welcome-page">
			
                    <?php 
                    $this->title_section();                                     // Show Title of Welcome page
                    ?>
                        
                    <?php 
                    $this->maintence_section();                                 // Template for the Minor updates
                    ?>

                    
                        <div class="changelog">                            
                            <h3><?php _e('Responsive, stylish and easy to customize design','wpdev-booking');?></h3>
                            <div class="feature-section col three-col">
                                <div>                                    
                                    <img src="<?php echo $this->asset_path; ?>responsive-design.png" style="border: medium none;box-shadow: 0 0 0;margin: 0 0 0.5em 20px;width: 80%;" >
                                    <h4><?php _e( "Responsive front end design", 'wpdev-booking' ); ?></h4>
                                    <p><?php  _e( "We have completely rewritten the CSS of calendar skins and booking form. Booking form and calendar support fully responsive design that looks great on any device.", 'wpdev-booking' ); ?>
                                    </p>
                                </div>

                                <div>
                                    <img src="<?php echo $this->asset_path; ?>insert.png" style="border:none;box-shadow: 0 1px 3px #777777;margin: 3px 0 1em 3px;width: 99%;" >
                                    <h4><?php _e( "Easy to customize", 'wpdev-booking' ); ?></h4>
                                    <p><?php printf(__( "Much  more easy to configure for fitting to your site design. Configure calendar width, height or even structure %s(number of months in a row)%s from settings in a minute.", 'wpdev-booking' ),'<em>','</em>'); ?></p>                                        
                                </div>
                                
                                <div class="last-feature">
                                    <img src="<?php echo $this->asset_path; ?>sleek-design.png" style="border:none;box-shadow: 0 1px 3px #777777;margin: 3px 3px 1em 0px;width: 95%;" >
                                    <h4><?php _e( "Smoother Booking Experience", 'wpdev-booking' ); ?></h4>
                                    <p><?php  _e( "Booking form has new attractive calendar skins and sleek form fields with nice warning messages.", 'wpdev-booking' ); ?></p>
                                </div>

                            </div>
                        </div>

                        <?php if ( (  $_SERVER['HTTP_HOST'] === 'dev'  ) || ! class_exists('wpdev_bk_personal')) { ?>                    
                        <div class="changelog"> 
                            <h3><?php _e('Configure your predefined set of form fields','wpdev-booking');?></h3>
                            <div class="feature-section images-stagger-right">
                                
                               <img src="<?php echo $this->asset_path; ?>settings-fields-free.png" style="width:40%; border:none;box-shadow: 0 1px 3px #777777;margin-top: 1px;">
                               <h4><?php _e( "Write Labels for your fields", 'wpdev-booking' ); ?></h4>
                               <p><?php  printf(__( "Now %s(at Booking %s Settings %s Fields page)%s is possible to change the form fields labels.", 'wpdev-booking' ),'<em>','&gt;','&gt;','</em>'); ?></p> 
                               
                               <h4><?php _e( "Activate or Deactivate fields", 'wpdev-booking' ); ?></h4>
                               <p><?php  _e( "You can activate or deactivate the fields from the predefined fields set.", 'wpdev-booking' ); ?></p>
                               
                               <h4><?php _e( "Set as required specific fields", 'wpdev-booking' ); ?></h4>
                               <p><?php  _e( "You can set as required specific fields in your booking form from the predefined fields set.", 'wpdev-booking' ); ?></p>
                               
                            </div>
                        </div>
                        <?php } ?>
                    
                    
                        <div class="changelog">
                            <div class="feature-section">  
                                <h3><?php _e( "Nice and Easy to Understand Interface with Buttons for Fast Actions", 'wpdev-booking' ); ?></h3> 
                                <img src="<?php echo $this->asset_path; ?>interface.png" style="border: medium none;box-shadow: 0 1px 3px #777777;width: 98%;margin:0px 3px;">
                                <div class="last-feature">           
                                    <h4><?php _e( "Approve or Reject Booking in 1 Click on Calendar Overview page", 'wpdev-booking' ); ?></h4> 
                                    <p><?php _e( "Make common actions, like Approve, Decline or Delete of the booking in One Click on the Calendar Overview panel", 'wpdev-booking' ); ?>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="changelog"> 
                            
                            <h3><?php _e('Under the Hood','wpdev-booking');?></h3>
                            <div class="feature-section col two-col">
                                
                                <div>
                                    <!--img src="<?php echo $this->asset_path; ?>code-css-black10.png" style="border:none;box-shadow: 0 1px 3px #777777;margin: 3px 0 1em 3px;width: 99%;" -->
                                    <h4><?php _e( "Customize the Calendar Skins", 'wpdev-booking' ); ?></h4>                            
                                    <p><?php  printf(__( "The calendar skins %s are located separately from the calendar structure file %s and very well commented. So you do not need to worry about the structure, sizes or responsive design of the calendar and concentrate only on design.", 'wpdev-booking' ),'<code>../css/skins/</code>','<code>../css/calendar.css</code>'); ?></p> 
                                    </p>
                                </div>     

                                <div class="last-feature">
                                    <h4><?php _e( "Improved Performance", 'wpdev-booking' ); ?></h4>
                                    <p><?php  echo "WP Booking Calendar"; _e( "%s has been dramatically improved in terms of performance to make your site run better and faster.", 'wpdev-booking' ); ?></p>
                                </div>
                                
                            </div>
                            
                            <p><?php _e( "Many other improvements and small issues fixing.", 'wpdev-booking' ); ?> <?php 
                               printf( __( 'For more information, see %sthe release notes%s', 'wpdev-booking' ),'<a href="http://wpbookingcalendar.com/changelog/" target="_blank">','</a>') ?>.</p>                            
                    
                        </div>
                        
			<!--div class="return-to-dashboard">
				<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' =>  WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-option' ), 'admin.php' ) ) ); ?>"><?php _e( 'Go to WP Booking Calendar Settings', 'wpdev-booking' ); ?></a>
			</div-->
                        <?php wpbc_welcome_panel(); ?>
                        <?php if (false) {                                      // Get Remote News or some other info

                            $response = wp_remote_post( OBC_CHECK_URL . 'info/', array() );

                            if (! ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) ) {

                                $body_to_show = json_decode( wp_remote_retrieve_body( $response ) );

                                ?><style type="text/css" media="screen">#bk_news_loaded{display:block !important;}</style><?php

                                echo $body_to_show ;
                            }
                        } ?>                                              
		</div>
		<?php
	}

        
	/**
	 * Render Credits Screen
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function about_premium_screen() {
		list( $display_version ) = explode( '-', WPDEV_BK_VERSION );
		?>
		<div class="wrap about-wrap wpbc-welcome-page">
			
                    <?php 
                    $this->title_section();                                     // Show Title of Welcome page
                    ?>
                    <p class="update-nag"><?php _e( "New Features in the Paid versions of", 'wpdev-booking' ); ?> <?php echo ' WP Booking Calendar '.$display_version ; ?></p>
                    
                    
                    <div class="changelog">
                        <h3><?php _e( "New Calendar Overview panel for Multiple Booking Resources ('Matrix')", 'wpdev-booking' ); ?></h3>
                        <div class="feature-section col three-col">
                            <img src="<?php echo $this->asset_path; ?>calendar-overview-for-several-resources.png" style="width: 99%;border:none;box-shadow: 0 1px 3px #777777;margin-top: 1px;">
                            <div>
                                <h4><?php _e( "Beautiful Easy to Understand Interface", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Resources at the first column and booking dates are in right rows.", 'wpdev-booking' ); ?></p>
                            </div>
                            <div>
                                <h4><?php _e( "Day, Week, Month or 2 Months View Mode", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Possibility to set a Day, Week, Month or 2 Months view mode for the 'Matrix' Calendar Overview panel.", 'wpdev-booking' ); ?> </p>
                            </div>
                            <div class="last-feature">
                                <h4><?php _e( "Select Several Specific or All Resources", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Possibility to select several specific or all booking resources at 'Filter tab' of Booking Listing or Calendar Overview panel.", 'wpdev-booking' ); ?></p>
                            </div>
                            <span class="versions">{ <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Personal, Business Small / Medium / Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                        </div>        
                    </div>                    
               
                    
                    <div class="changelog">
                        <div class="feature-section images-stagger-right">
                           <h3><?php _e( "Show Pending Days as Available", 'wpdev-booking' ); ?></h3> 
                           <img src="<?php echo $this->asset_path; ?>pending-days-available.png" style="width: 50%;border:none;box-shadow: 0 1px 3px #777777;margin-top: 1px;">
                           <div>
                                <h4><?php _e( "Possibility to book Pending Days", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Set Pending booked dates as available in calendar, until you'll Approve some booking. Do not lose any bookings, if some bookings were made by mistake or it was spam.", 'wpdev-booking' ); ?> 
                                   </p>
                           </div>
                           <div class="last-feature">
                                <h4><?php _e( "Auto Decline", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Activate the Auto decline (delete) all pending bookings in your booking resource for the specific date(s), if you've approved other booking for these date(s).", 'wpdev-booking' ); ?>
                                   </p>
                           </div>
                           <span class="versions">{ <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Business Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                        </div>
                    </div>                    
      
                    
                    <div class="changelog">
                        <div class="feature-section images-stagger-left">  
                            <h3><?php _e( "Different Time Slots (or other content) for the Different Selected Days.", 'wpdev-booking' ); ?></h3> 
                            <img src="<?php echo $this->asset_path; ?>different-times-selection.png" style="border: medium none;box-shadow: 0 1px 3px #777777;width: 45%;">
                            <div>
                                <br><h4><?php _e( "Set Different Time Slots for the Different Days.", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "You can configure different Time Slots availability for the different days (weekday or date from season filter). Each week day (day of specific season filter) can have different time slots list.", 'wpdev-booking' ); ?>               
                                   <?php printf( __( "Check  more %shere%s.", 'wpdev-booking' ),"<a href='http://wpbookingcalendar.com/help/different-time-slots-selections-for-different-days/' target='_blank'>",'</a>') ?>.</p>
                            </div>
                            <div class="last-feature">
                                <h4><?php _e( "Show Specific Form Content, if Desire Date is Selected", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "You need to show specific field(s), form section or just text, if specific date is selected (weekday or date from season filter) - it's also possible.", 'wpdev-booking' ); ?>
                                   <?php printf( __( "Check  more %shere%s.", 'wpdev-booking' ),"<a href='http://wpbookingcalendar.com/help/different-content-for-different-days-selection/' target='_blank'>",'</a>') ?>.</p>
                            </div>
                            <span class="versions"> { <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Business Medium/Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                        </div>
                    </div>
                    
                    
                    <div class="changelog">
                        <div class="feature-section images-stagger-right">
                            <h3><?php _e( "Configure Days Selection as You Need.", 'wpdev-booking' ); ?></h3> 
                            
                                <img src="<?php echo $this->asset_path; ?>days-selection-configuration.png" style="border: medium none;box-shadow: 0 1px 3px #777777;width: 45%;">
                                
                                <h4><?php _e( "Configure Number of Days selection", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Specify that during certain seasons (or week days), the specific minimum (or fixed) number of days must be booked.", 'wpdev-booking' ); ?>
                                   <?php printf( __( "Check  more about 'options' %shere%s.", 'wpdev-booking' ),"<a href='http://wpbookingcalendar.com/help/booking-calendar-shortcodes/' target='_blank'>",'</a>') ?>                                   
                                   <br><span class="versions" style="clear:both;float:none;"> { <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Business Medium/Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                                </p>
                                
                                <h4><?php _e( "Set several Start Days", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Specify several weekdays as possible start day for the range days selection.", 'wpdev-booking' ); ?></p>
                            
                            
                                <h4><?php _e( "Easy configuration of range days selection", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Configure 'specific days selections', for the 'range days selection' mode, in more comfortable way.", 'wpdev-booking' ); ?>  
                                   <?php _e( "Separate days by dash or comma.", 'wpdev-booking' ); ?>
                                   <br><em><?php printf( __( "Example: '%s'. It's mean possibility to select: %s days.", 'wpdev-booking' ),'3-5,7,14','3, 4, 5, 7, 14'); ?></em>
                                   <br><span class="versions"> { <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Business Small/Medium/Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                                </p>
                            
                            
                        </div>
                    </div>

                    
                    <div class="changelog">
                        <div class="feature-section images-stagger-left">  
                            <h3><?php _e( "Easily configure your booking form fields.", 'wpdev-booking' ); ?></h3> 
                            <img src="<?php echo $this->asset_path; ?>form-fields.png" style="border: medium none;box-shadow: 0 1px 3px #777777;width: 20%;">
                            <div>
                                <h4><?php _e( "New help system for booking form fields configuration.", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "You can configure different form field’s shortcodes easily using smart configuration panel.", 'wpdev-booking' ); ?>               
                            </div>
                            <div class="last-feature">
                                <h4><?php _e( "New form Fields and parameters", 'wpdev-booking' ); ?></h4>
                                <p><?php _e( "Booking Calendar support many new additional parameters for exist shortcodes, and some new fields, like radio buttons.", 'wpdev-booking' ); ?>
                            </div>
                            <span class="versions"> { <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Personal, Business Small/Medium/Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                        </div>
                    </div>
                    
                    
                    <div class="changelog">
                        <div class="feature-section images-stagger-right">
                            <h3><?php _e( "Payments and Costs.", 'wpdev-booking' ); ?></h3> 
                                <img src="<?php echo $this->asset_path; ?>payment-forms.png" style="border: medium none;box-shadow: 0 1px 3px #777777;margin-top: -20px;width: auto;">
                            <h4>Authorize.Net</h4>
                            <p><?php printf( __( "Integration %s Payment Gateway - Server Integration Method (SIM).", 'wpdev-booking' ),'Authorize.Net'); ?> 
                               <?php _e( "Integration of this gateway was one of the most our common user requests.", 'wpdev-booking' ); ?> 
                               <?php _e( "Now it's existing.", 'wpdev-booking' ); ?>
                            </p>

                            <h4><?php _e( "Currency Format", 'wpdev-booking' ); ?></h4>
                            <p><?php _e( "Configure format of showing the cost in the payment form.", 'wpdev-booking' ); ?>
                                <br><span class="versions">{ <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Business Small / Medium / Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                            </p><br>
                            
                            <h4><?php _e( "Do More with  Less Actions", 'wpdev-booking' ); ?></h4>     
                            <p><?php _e( "Assign  Availability, Rates, Valuations days or Deposit amount to the several booking resources in 1 step.", 'wpdev-booking' ); ?> 
                               <?php _e( "Select several booking resources. Click on Availability, Rates, Valuations days or Deposit button.", 'wpdev-booking' ); ?> 
                               <?php _e( "Configure and Update settings.  That's it", 'wpdev-booking' ); ?>              
                               <br><span class="versions">{ <?php _e( "Available in", 'wpdev-booking' ); ?> <a href="http://wpbookingcalendar.com" target="_blank">Business Medium / Large, MultiUser</a> <?php _e( "versions", 'wpdev-booking' ); ?> }</span>
                            </p>
                            
                        </div>
                    </div>
                    
                    
                    

<div class="changelog"> 

    <h3><?php _e('Under the Hood','wpdev-booking');?></h3>
    <div class="feature-section col three-col">
        <div>                            
            <h4><?php echo "[denyreason] "; _e( "shortcode for 'Approve' email", 'wpdev-booking' ); ?></h4>                            
            <p><?php _e( "It means that we can write some text into the 'Reason of cancelation' field for having this custom text in the Approve email template.", 'wpdev-booking' ); ?> 
               <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Personal, Business Small / Medium / Large, MultiUser</a> }</span>
            </p>            
        </div>     
        <div>
            <h4><?php printf( __( "%s Support", 'wpdev-booking' ),'qTranslate'); ?></h4>
            <p><?php printf( __( "Full support of the %s plugin. ", 'wpdev-booking' ),'qTranslate'); ?> 
                <?php _e( "Including the search results content and links to the post with booking forms in correct language.", 'wpdev-booking' ); ?>
               <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Personal, Business Small / Medium / Large, MultiUser</a> }</span>
            </p>            
            
        </div>
        <div class="last-feature">
            <h4><?php _e( "Edit Past Bookings", 'wpdev-booking' ); ?></h4>
            <p><?php _e( "Edit your bookings, where the time or dates have been already in the past.", 'wpdev-booking' ); ?> 
            <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Personal, Business Small / Medium / Large, MultiUser</a> }</span>
            </p>

            <?php /** ?><h4><?php _e( "Delete your Saved Filter", 'wpdev-booking' ); ?></h4>
            <p><?php _e( "Delete your Default saved filter template on the Booking Listing page at Filter tab", 'wpdev-booking' ); ?> 
                <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Personal, Business Small / Medium / Large, MultiUser</a> }</span>
            </p><?php /**/ ?>
            
        </div>
    </div>

    
    <div class="feature-section col three-col">
        <div>
            <h4><?php _e( "Checking End Time only", 'wpdev-booking' ); ?></h4>
            <p><?php _e( "Set checking is only for end time of bookings for Today.", 'wpdev-booking' ); ?>  
               <?php _e( "So start time could be already in a past.", 'wpdev-booking' ); ?> 
               <?php _e( "Reactivate old checking using", 'wpdev-booking' ); ?> JavaScript <code>is_check_start_time_gone=true;</code>
            <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Small / Medium / Large, MultiUser</a> }</span>
            </p>
        </div>        
        <div>
            <h4><?php _e( "Set cost for the 'Check Out' date", 'wpdev-booking' ); ?></h4>                            
            <p><?php printf( __( "Possibility to use new reserved word %s (Check Out date) in the Valuation days cost settings page for the field 'For'. So you can define the cost of the last selected date.", 'wpdev-booking' ),'<strong><code>LAST</code></strong>'); ?>
               <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Medium / Large, MultiUser</a> }</span>
            </p>

        </div>    
        <div class="last-feature">            
            <h4><?php _e( "Advanced Additional Cost", 'wpdev-booking' ); ?></h4>
            <p><?php printf( __( "Set additional cost of the booking as percentage of the original booking cost. This original booking cost doesn't have impact from any other additional cost settings. Usage: just write %s sign before percentage number. Example: %s.", 'wpdev-booking' ),"'+'", "+50%"); ?>
            <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Medium / Large, MultiUser</a> }</span>   
            </p>                        
        </div>
    </div>
    
    

    
    <div class="feature-section col three-col">
        <div>
            <h4><?php _e( "Set 'Check In/Out' dates as Available", 'wpdev-booking' ); ?></h4>
            <p><?php _e( "Set 'check in/out' dates as available for resources with capacity higher than one. It's useful, if check in date of booking have to be the same as check out date of other booking.", 'wpdev-booking' ); ?>
            <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Large, MultiUser</a> }</span>
            </p>
        </div>
        <div>
            <h4><?php _e( "Visitors Selection in Search Result", 'wpdev-booking' ); ?></h4>
            <p><?php _e( "Auto selection of the correct visitor number in the booking form, when the user redirected from the search form.", 'wpdev-booking' ); ?> 
            <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Large, MultiUser</a> }</span>    
            </p>
            
        </div>
        <div class="last-feature">
            <h4><?php _e( "Use 'Unavailable days from today' settings in Search Form", 'wpdev-booking' ); ?></h4>
            <p><?php _e( "Using the settings of 'Unavailable days from today' for the calendars in the search form.", 'wpdev-booking' ); ?>
            <br><span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Large, MultiUser</a> }</span>    
            </p>
            
        </div>
    </div>
    

    
    
    <div class="feature-section col two-col">
        <div>
            <h4><?php _e( "Shortcodes for Emails and Content Form", 'wpdev-booking' ); ?></h4>                            
            <p><?php _e( "Long list of useful shortcodes for the Email Templates and the 'Content of Booking Fields' form", 'wpdev-booking' ); ?>:  
                <code>[cost_hint]</code>, 
                <code>[original_cost_hint]</code>, 
                <code>[additional_cost_hint]</code>, 
                <code>[deposit_hint]</code>, 
                <code>[balance_hint]</code>, 
                <code>[check_in_date_hint]</code>, 
                <code>[check_out_date_hint]</code>, 
                <code>[start_time_hint]</code>, 
                <code>[end_time_hint]</code>, 
                <code>[selected_dates_hint]</code>, 
                <code>[selected_timedates_hint]</code>, 
                <code>[selected_short_dates_hint]</code>, 
                <code>[selected_short_timedates_hint]</code>, 
                <code>[days_number_hint]</code>, 
                <code>[nights_number_hint]</code> 
             
             </p>
             <span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Medium / Large, MultiUser</a> }</span>
        </div>    
        <div class="last-feature">            
            <h4><?php _e( "New Shortcodes for Hints in booking form.", 'wpdev-booking' ); ?></h4>                            
            <p><?php printf(__( "New shortcodes for showing real-time hints (like %s) inside of the booking form", 'wpdev-booking' ),'[cost_hint]'); ?>:
                <code>[deposit_hint]</code>, 
                <code>[balance_hint]</code>, 
                <code>[check_in_date_hint]</code>, 
                <code>[check_out_date_hint]</code>, 
                <code>[start_time_hint]</code>, 
                <code>[end_time_hint]</code>, 
                <code>[selected_dates_hint]</code>, 
                <code>[selected_timedates_hint]</code>, 
                <code>[selected_short_dates_hint]</code>, 
                <code>[selected_short_timedates_hint]</code>, 
                <code>[days_number_hint]</code>, 
                <code>[nights_number_hint]</code> 
            
            </p>
            <span class="versions">{ <a href="http://wpbookingcalendar.com" target="_blank">Business Medium / Large, MultiUser</a> }</span>
        </div>
    </div>
    
    
    
    <p><?php _e( "Many other improvements and small issue fixing.", 'wpdev-booking' ); ?> <?php 
       printf( __( 'For more information, see %sthe release notes%s', 'wpdev-booking' ),'<a href="http://wpbookingcalendar.com/changelog/" target="_blank">','</a>') ?>.</p>                            

</div>

                                
                    <div class="return-to-dashboard">
                            <a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' =>  WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-option' ), 'admin.php' ) ) ); ?>"><?php _e( 'Go to WP Booking Calendar Settings', 'wpdev-booking' ); ?></a>
                    </div>

		</div>
		<?php
	}

	/**
	 * Sends user to the Welcome page on first activation of plugin as well as each
	 * time plugin is upgraded to a new version
	 */
	public function welcome() {
            // Bail if no activation redirect transient is set
            if ( ! get_transient( '_wpbc_activation_redirect' ) )
                    return;

                // Delete the redirect transient
                delete_transient( '_wpbc_activation_redirect' );

                // Bail if DEMO or activating from network, or bulk, or within an iFrame
                if ( wpdev_bk_is_this_demo() || is_network_admin() || isset( $_GET['activate-multi'] ) || defined( 'IFRAME_REQUEST' ) )
                        return;

                wp_safe_redirect( admin_url( 'index.php?page=wpbc-about' ) );
                exit;                
	}
}
new WPBC_Welcome();

function wpbc_welcome_panel() {
    ?>
<style type="text/css" media="screen">
/*<![CDATA[*/
    /* WPBC Welcome Panel */                
    .wpbc-panel .welcome-panel {
        background: linear-gradient(to top, #F5F5F5, #FAFAFA) repeat scroll 0 0 #F5F5F5;
        border-color: #DFDFDF;
    }
    .wpbc-panel .welcome-panel {
            position: relative;
            overflow: auto;
            margin: 20px 0;
            padding: 23px 10px 12px;
            border-width: 1px;
            border-style: solid;
            border-radius: 3px;
            font-size: 13px;
            line-height: 2.1em;
    }
    .wpbc-panel .welcome-panel h3 {
            margin: 0;
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", sans-serif;
            font-size: 21px;
            font-weight: normal;
            line-height: 1.2;
    }
    .wpbc-panel .welcome-panel h4 {
            margin: 1.33em 0 0;
            font-size: 13px;
    }
    .wpbc-panel .welcome-panel a{
        color:#21759B;
    }
    .wpbc-panel .welcome-panel .about-description {
            font-size: 16px;
            margin: 0;
    }
    .wpbc-panel .welcome-panel .welcome-panel-close {
            position: absolute;
            top: 5px;
            right: 10px;
            padding: 8px 3px;
            font-size: 13px;
            text-decoration: none;
            line-height: 1;
    }
    .wpbc-panel .welcome-panel .welcome-panel-close:before {
            content: ' ';
            position: absolute;
            left: -12px;
            width: 10px;
            height: 100%;
            background: url('../wp-admin/images/xit.gif') 0 7% no-repeat;
    }
    .wpbc-panel .welcome-panel .welcome-panel-close:hover:before {
            background-position: 100% 7%;
    }
    .wpbc-panel .welcome-panel .button.button-hero {
        margin: 15px 0 3px;
    }
    .wpbc-panel .welcome-panel-content {
            margin-left: 13px;
            max-width: 1500px;
    }
    .wpbc-panel .welcome-panel .welcome-panel-column-container {
            clear: both;
            overflow: hidden;
            position: relative;
    }
    .wpbc-panel .welcome-panel .welcome-panel-column {
            width: 32%;
            min-width: 200px;
            float: left;
    }
    .ie8 .wpbc-panel .welcome-panel .welcome-panel-column {
            min-width: 230px;
    }
    .wpbc-panel .welcome-panel .welcome-panel-column:first-child {
            width: 36%;
    }
    .wpbc-panel .welcome-panel-column p {
            margin-top: 7px;
    }
    .wpbc-panel .welcome-panel .welcome-icon {
        background: none;    
        display: block;
        padding: 2px 0 8px 2px;    
    }
    .wpbc-panel .welcome-panel .welcome-add-page {
            background-position: 0 2px;
    }
    .wpbc-panel .welcome-panel .welcome-edit-page {
            background-position: 0 -90px;
    }
    .wpbc-panel .welcome-panel .welcome-learn-more {
            background-position: 0 -136px;
    }
    .wpbc-panel .welcome-panel .welcome-comments {
            background-position: 0 -182px;
    }
    .wpbc-panel .welcome-panel .welcome-view-site {
            background-position: 0 -274px;
    }
    .wpbc-panel .welcome-panel .welcome-widgets-menus {
            background-position: 1px -229px;
            line-height: 14px;
    }
    .wpbc-panel .welcome-panel .welcome-write-blog {
            background-position: 0 -44px;
    }
    .wpbc-panel .welcome-panel .welcome-panel-column ul {
            margin: 0.8em 1em 1em 0;
    }
    .wpbc-panel .welcome-panel .welcome-panel-column li {
        line-height: 16px;
        list-style-type: none;
    }
    @media screen and (max-width: 870px) {
            .wpbc-panel .welcome-panel .welcome-panel-column,
            .wpbc-panel .welcome-panel .welcome-panel-column:first-child {
                    display: block;
                    float: none;
                    width: 100%;
            }
            .wpbc-panel .welcome-panel .welcome-panel-column li {
                    display: inline-block;
                    margin-right: 13px;
            }
            .wpbc-panel .welcome-panel .welcome-panel-column ul {
                    margin: 0.4em 0 0;
            }
            .wpbc-panel .welcome-panel .welcome-icon {
                    padding-left: 25px;
            }
    }
/*]]>*/
</style>                
<div id="wpbc-panel-get-started" class="wpbc-panel" style="display:none;"> <div class="welcome-panel"> 
<?php 
    $is_panel_visible = false;
    if ( (class_exists('WPBC_Dismiss')) && (! wpdev_bk_is_this_demo() ) ){
        global $wpbc_Dismiss;
        $is_panel_visible = $wpbc_Dismiss->render(array( 'id'    =>  'wpbc-panel-get-started',
                                     'title' =>  __( 'Dismiss' , 'wpdev-booking' )
                              ));
    }
    if ($is_panel_visible)
        wpbc_welcome_panel_content(); 
?> 
</div> </div>
<?php
}

function wpbc_welcome_panel_content() {
?>
    <div class="welcome-panel-content">
    <p class="about-description"><?php _e( 'We&#8217;ve assembled some links to get you started:' ); ?></p>
    <div class="welcome-panel-column-container">
        <div class="welcome-panel-column">
            <h4><?php _e( 'Get Started' ,'wpdev-booking'); ?></h4>
            <ul>
                <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'Insert booking form %sshortcode%s into your %sPost%s or %sPage%s' , 'wpdev-booking' ) .
                        '</div>',
                        '<strong>','</strong>', 
                        '<a href="'.admin_url( 'edit.php' ).'">', '</a>', 
                        '<a href="'.admin_url( 'edit.php?post_type=page' ).'">', '</a>'); ?></li>                            

                <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'or add booking calendar %sWidget%s to your sidebar.'  , 'wpdev-booking' ) .
                        '</div>',
                        '<a href="'.admin_url( 'widgets.php' ).'">', '</a>'); ?></li>                            

                <li><?php printf( '<div class="welcome-icon">' .                             
                        __( 'Check %show todo%s that and what %sshortcodes%s are available.' , 'wpdev-booking' ).
                        '</div>', 
                        '<a href="http://wpbookingcalendar.com/help/inserting-booking-form/" target="_blank">', '</a>', 
                        '<a href="http://wpbookingcalendar.com/help/booking-calendar-shortcodes/" target="_blank">', '</a>' ); ?></li>
                <li><?php printf( '<div class="welcome-icon">' .                             
                        __( 'Add new booking from your post/page or from %sAdmin Panel%s.' , 'wpdev-booking'  ).
                        '</div>', 
                        '<a href="'. esc_url( admin_url( add_query_arg( array( 'page' =>  WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-reservation' ), 'admin.php' ) ) ) .'">', '</a>' ); ?></li>                    
            </ul>
        </div>
        <div class="welcome-panel-column">
                <h4><?php _e( 'Next Steps' ,'wpdev-booking'); ?></h4>
                <ul>
                    <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'Check %sBooking Listing%s page for new bookings.' , 'wpdev-booking'   ) .
                        '</div>',                            
                        '<a href="'. esc_url( admin_url( add_query_arg( array( 'page' =>  WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking' ), 'admin.php' ) ) ) .'">', 
                        '</a>' ); ?></li>                                                    
                    <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'Configure booking %sSettings%s.' , 'wpdev-booking'   ) .
                        '</div>',                            
                        '<a href="'. esc_url( admin_url( add_query_arg( array( 'page' =>  WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-option' ), 'admin.php' ) ) ) .'">', 
                        '</a>' ); ?></li>                            
                    <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'Configure predefined set of your %sForm Fields%s.' , 'wpdev-booking'   ) .
                        '</div>',                            
                        '<a href="'. esc_url( admin_url( add_query_arg( array( 'page' =>  WPDEV_BK_PLUGIN_DIRNAME . '/'. WPDEV_BK_PLUGIN_FILENAME . 'wpdev-booking-option&tab=form' ), 'admin.php' ) ) ) .'">', 
                        '</a>' ); ?></li>                            
                </ul>
        </div>
        <div class="welcome-panel-column welcome-panel-last">
                <h4><?php _e( 'Have a questions?' ,'wpdev-booking'); ?></h4>
                <ul>
                    <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'Check out our %sHelp%s' , 'wpdev-booking'   ) .
                        '</div>',                            
                        '<a href="http://wpbookingcalendar.com/help/" target="_blank">', 
                        '</a>' ); ?></li>                            
                    <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'See %sFAQ%s.' , 'wpdev-booking'   ) .
                        '</div>',                            
                        '<a href="http://wpbookingcalendar.com/faq/" target="_blank">', 
                        '</a>' ); ?></li>                            
                    <li><?php printf( '<div class="welcome-icon">' . 
                        __( 'Still having questions? Contact %sSupport%s.' , 'wpdev-booking'   ) .
                        '</div>',                            
                        '<a href="http://wpbookingcalendar.com/support/" target="_blank">', 
                        '</a>' ); ?></li>                            
                </ul>
        </div>
    </div>
    <?php printf( '<div class="welcome-icon welcome-widgets-menus" style="text-align:right;font-style:italic;">' . __( 'Need even more functionality? Check <a href="%1$s" target="_blank">higher versions</a>' ) . '.</div>', 'http://wpbookingcalendar.com/features/' ); ?>
    </div> 
    <?php
}

?>