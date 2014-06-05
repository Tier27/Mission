<?php

/*
*	Addon Details
*	Version: 0.4
*	Last Updated: 2014-5-28
*/


// Pull user agent  
$user_agent = $_SERVER['HTTP_USER_AGENT'];

//Kill magic quotes.  Can't unserialize POST variable otherwise
if ( get_magic_quotes_gpc() ) {
    $process = array( &$_GET, &$_POST, &$_COOKIE, &$_REQUEST );
    while ( list($key, $val) = each( $process ) ) {
        foreach ( $val as $k => $v ) {
            unset( $process[$key][$k] );
            if ( is_array( $v ) ) {
                $process[$key][stripslashes( $k )] = $v;
                $process[] = &$process[$key][stripslashes( $k )];
            } else {
                $process[$key][stripslashes( $k )] = stripslashes( $v );
            }
        }
    }
    unset( $process );
}
	

// CHECK: for incoming from wordpress site
if ( stristr( $user_agent, 'WordPress' ) == TRUE ) {

	$action = $_POST['action'];

	if($action == 'evo_get_addons'){

		$addons = array(
			'eventon-action-user' => array(
				'name'=>'Action User',
				'link'=>'http://www.myeventon.com/addons/action-user/',
				'download'=>'http://www.myeventon.com/addons/action-user/',
				'icon'=>'assets/images/icons/icon_au.jpg',
				'iconty'=>'local',
				'desc'=>'Wanna get event contributors involved in your EventON calendar with better permission control? You can do that plus lot more with Action User addon.',
			),'eventon-daily-view' => array(
				'name'=>'Daily View Addon',
				'link'=>'http://www.myeventon.com/addons/daily-view/',
				'download'=>'http://www.myeventon.com/addons/daily-view/',
				'icon'=>'assets/images/icons/icon_dv.jpg',
				'iconty'=>'local',
				'desc'=>'Do you have too many events to fit in one month and you want to organize them into days? This addon will allow you to showcase events for one day of the month at a time.',
			),'eventon-full-cal'=>array(
				'name'=>'Full Cal',
				'link'=>'http://www.myeventon.com/addons/full-cal/',
				'download'=>'http://www.myeventon.com/addons/full-cal/',
				'icon'=>'assets/images/icons/icon_fc.jpg',
				'iconty'=>'local',
				'desc'=>'The list style calendar works for you but you would really like a full grid calendar? Here is the addon that will convert EventON to a full grid calendar view.'
			)
			,'eventon-events-map'=>array(
				'name'=>'Events Map',
				'link'=>'http://www.myeventon.com/addons/events-map/',
				'download'=>'http://www.myeventon.com/addons/events-map/',
				'icon'=>'assets/images/icons/icon_em.jpg',
				'iconty'=>'local',
				'desc'=>'What is an event calendar without a map of all events? EventsMap is just the tool that adds a big google map with all the events for visitors to easily find events by location.'
			),'eventon-event-lists'=>array(
				'name'=>'Event Lists Ext.',
				'link'=>'http://www.myeventon.com/addons/event-lists-extended/',
				'download'=>'http://www.myeventon.com/addons/event-lists-extended/',
				'icon'=>'assets/images/icons/icon_el.jpg',
				'iconty'=>'local',
				'desc'=>'Do you need to show events list regardless of what month the events are on? With this adodn you can create various event lists including past events, next 5 events, upcoming events and etc.'
			)
			/*'eventon-geo-calendar'=>array(
				'name'=>'Geo Calendar',
				'link'=>'http://www.myeventon.com/addons/geo-calendar/',
				'download'=>'http://www.myeventon.com/addons/geo-calendar/',
				'icon'=>'assets/images/icons/icon_geo.jpg',
				'iconty'=>'local',
				'desc'=>'If location of an event is more important to you than time, this is what you want. Convert your EventON calendar to a location-based event type calendar where location of an event comes before date.'
			)
			*/
			,'eventon-single-event'=>array(
				'name'=>'Single Events',
				'link'=>'http://www.myeventon.com/addons/single-events/',
				'download'=>'http://www.myeventon.com/addons/single-events/',
				'icon'=>'assets/images/icons/icon_sin.jpg',
				'iconty'=>'local',
				'desc'=>'Looking to promote single events in EventON via social media? Use this addon to share individual event pages that matches the awesome EventON layout design.'
			),'eventon-daily-repeats'=>array(
				'name'=>'Daily Repeats',
				'link'=>'http://www.myeventon.com/addons/daily-repeats/',
				'download'=>'http://www.myeventon.com/addons/daily-repeats/',
				'icon'=>'assets/images/icons/icon_dr.jpg',
				'iconty'=>'local',
				'desc'=>'Daily Repeats will allow you to create events that can repeat on a daily basis - a feature that extends the repeating events capabilities of the calendar.'
			),'eventon-csv-importer'=>array(
				'name'=>'CSV Importer',
				'link'=>'http://www.myeventon.com/addons/csv-event-importer/',
				'download'=>'http://www.myeventon.com/addons/csv-event-importer/',
				'icon'=>'assets/images/icons/icon_csv.jpg',
				'iconty'=>'local',
				'desc'=>'Are you looking to import events from another program to EventON? CSV Import addon is the tool for you. It will import any number of events from a properly build CSV file into your EventON Calendar in few steps.'
			),'eventon-rsvp'=>array(
				'name'=>'RSVP Events',
				'link'=>'http://www.myeventon.com/addons/rsvp-events/',
				'download'=>'http://www.myeventon.com/addons/rsvp-events/',
				'icon'=>'assets/images/icons/icon_rsvp.jpg',
				'iconty'=>'local',
				'desc'=>'Do you want to allow your attendees RSVP to event so you know who is coming and who is not? and be able to check people in at the event? RSVP event can do that for you seamlessly.'
			)
		);

		print serialize($addons);



	}

}	



?>