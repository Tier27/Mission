<?php /* Template Name: Blank Reservations*/ ?>
<?php

	if( !is_admin() ) wp_redirect( home_url() );
	echo "START";
	$date = new rvDate();
	print_r( $date->canceled );
	$date->sanitize_cancelations( 1762 );
	echo 'DONE';
	die;
	//rvSettings::speak();
	$posts = rvWordPress::get_all_posts();
	//print_r( $posts );
//	$reservation = rvReservation::retrieve( 77 );
	//print_r ($reservation );
	//rvWordPress::update_post_parameter( 81, 'post_name', 'reservations-settings' );
	//$reservation_settings = rvSettings::get_settings();
	print_r( $reservation_settings );
	$settings = new rvSettings();	
	//print_r( $settings );
	//echo $settings->ID;

	$hours = array();

	$hours[3] = array( 15, 16, 17, 18, 19, 20, 21, 22 );
	$hours[4] = array( 15, 16, 17, 18, 19, 20, 21, 22, 23 );
	$hours[5] = array( 15, 16, 17, 18, 19, 20, 21, 22, 23 );
	$hours[6] = array( 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23 );
	$hours[7] = array( 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22 );
	$hours[1] = array( 15, 16, 17, 18, 19, 20, 21, 22 );
	$hours[2] = array( 15, 16, 17, 18, 19, 20, 21, 22 );
	
	foreach( $hours as $day => $ours ) {

	//	$settings->set_hours( $day, $ours );
	//	print_r( $settings->get_hours( $day ) );
	//	echo "<br>";

	}

//	$settings->set_lanes( 6 );
//	echo $settings->lanes;

	$args = array();
	$args['name'] = 'Jaime Lannister';
	$args['company'] = 'House Lannister';
	$args['phone'] = '243-243-2434';
	$args['email'] = 'jaime.lannister@gmail.com';
	$args['notes'] = 'He is the Kingslayer';
	$args['paid'] = 0;
	$args['hours'] = array( 19, 21 );
	$args['date'] = '2014-01-15';
	$args['lanes'] = 2;
	$args['bowlers'] = 1;
	//rvSanitize::clear_reservations( 'tiercom!1(9)0' );
	//rvSanitize::clear_dates( '1X97ohsG1t' );
	//rvSanitize::clear_trash( 'SERIOUS' );
	//print_r( $reservation );
	//echo "This ID is " . $reservation->ID;
	//print_r( $reservations );
//	$rvDate = new rvDate( '2014-01-16' );
//	$rvDate->speak();
	//print_r( $rvDate );
	//$rvDate->sanitize_reservations();
	//print_r( $reservations );
	//print_r( get_category_by_slug( 'reservation-date') );
	//echo $rvDate->date;
	//rvRetrieve::speak();
	//print_r( $dates );
	//echo $rvDate->day;
	//$data = new rvData();
	//$data::speak();	
	//$data->register_date( '2014-01-15' );
	//$data->sanitize_registered_dates();
	//$registered_dates = $data->get_dates();
	//print_r( $registered_dates );
	//$dates = rvRetrieve::dates();
	rvHTML::breaks(3);
	//print_r( rvRetrieve::date_ids() );
//	print_r( $dates );
	$dates = rvRetrieve::dates();
	//$sanitize = new rvSanitize();
//	$sanitize->clear_date_registry();
//	echo $data->get_data();
	//$settings = new rvSettings();
//	print_r( rvWordPress::get_post_by_slug( 'reservations-settings' ) );
//	rvForms::reservation();
//	rvOutput::speak();
	//print_r( $reservations );
	//$reservation = new rvReservation( $args );
	$reservations = rvRetrieve::reservations();
	rvHTML::belk( "Reservation count: " . count( $reservations ) ); 
	rvHTML::belk( "Date count: " . count( $dates ) ); 
	//$id = rvQuery::reservation_id_by_single_meta( 'name', 'Name-boy3' );
	//rvHTML::belk( 'ID retrieved: ' . $id );
	$reservation = new rvReservation( );
	//print_r( $reservation->hours );
	//$reservation->update( 'email', 'samwell.tarly@gmail.com' );
	//print_r( $reservation );
	//print_r( rvWordPress::get_post( 449, 'post' ) );
	//print_r( rvOutput::table() );
	//rvHTML::belk( "The reservations hours: " );
	//print_r( $reservation->hours );
	//$date = new rvDate ( $reservation->date->date );
	//$date = new rvDate ( $args['date'] );
	//$date->check_hours( $reservation->hours );	
	//$date->book_hours( $reservation->hours, '43' );
	//$date->clear_lane_hour( 1, 21 );
	//$date->clear_hour( 20 );
	//$date->clear_lane( 2 );
	//$date->clear_lanes(); 
	//echo $date->available_lanes( array( 20, 21, 22) );
	//rvHTML::breaks(1);
	//foreach ( $date->lanes  as $lane ) {
	//	print_r( $lane );
	//	rvHTML::breaks(1);
	//}
	//$date->book_lane_hour( 1, 20, 43 );
	//echo $date->get_lane_hour( 1, 22 );
	//$date->swap_lane_hours( 1, 21, 2, 22 );
	//echo $date->book_lane_hour( 2, 22, 41 );
	//$reservation->delete();
	//print_r( $settings );
	$date = new rvDate();
//	print_r( $date );
//	$settings->set_pricing();
	echo $settings->get_pricing( 5, 18 );


?>
