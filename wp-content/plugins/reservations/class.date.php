<?php

class rvDate {

	public $date;
	public $category;
	public $post;
	public $day;
	public $ID;
	public $settings;
	public $lanes;
	public $reservations;
	public $hours;
	public $weblanes;
	public $notes;
	public $pending;
	public $canceled;

	public function __construct( $date = NULL ) {
		
		$this->date = ( $date != NULL ) ? $date : date( 'Y' ) . '-' . date( 'm' ) . '-' . date( 'd' );
		$this->day = date( 'N', strtotime( $this->date ) );		
		$this->category = self::get_date_category();	
		$this->ID = self::post_reservation_date( );
		//rvHTML::breaks(1);
		rvHTML::maybe( "The date instance ID: $this->ID" );
		//rvHTML::breaks(1);
		$this->settings = new rvSettings();
		$this->hours = $this->settings->get_hours( $this->day );
		$this->lanes = $this->get_lanes();
		$this->pending = $this->get_lanes( array( 'pending' => true ) );
		$this->canceled = $this->get_lanes( array( 'canceled' => true ) );
		$this->weblanes = $this->get_web_lanes();
		//print_r( $this->lanes );
		$this->reservations = $this->get_reservations();

		$this->notes = get_post_meta( $this->ID, 'notes', true );

	}

	public function speak() {
		echo "This is date.";
	}

	public function post_reservation_date( ) {

		$data = new rvData();
		$this->post = rvWordPress::get_post_by_slug( 'reservations-' . $this->date ); 

		//print_r( $this->post );

		if ( ! in_array( $this->date, $data->registered ) ) $data->register_date( $this->date );

		if ( $this->post->ID != NULL ) return $this->post->ID;

		$data->deregister_date( $this->date );

		rvHTML::maybe( "About to create a new date..." );

		$defaults = array( 
			'post_name'	=>	'reservations-' . $this->date,
			'post_title'	=>	'Reservations - ' . $this->date,
			'post_status'	=>	'private',
			'post_category'	=>	array( $this->category )
		);

		$data->register_date( $this->date );

		return wp_insert_post( $defaults );


	}
	
	public function get_date_category() {

		$the_category = get_category_by_slug( 'reservation-date' );
		return $the_category->term_id;

	}

	public function deregister_reservation( $id ) {
		
		rvHTML::belk( $id );
		if ( in_array( $id, $this->reservations ) ) unset($this->reservation[array_search($id,$this->reservation)]);
		if ( in_array( $id, $this->reservations ) ) return delete_post_meta( $this->ID, 'reservations', $id );
		return false;

	}

	public function register_reservation( $id ) {
		if ( ! in_array( $id, $this->reservations ) ) return add_post_meta( $this->ID, 'reservations', $id );
		return false;

	}

	public function register_reservations( $RVreservations ) {

		foreach ( $RVreservations as $RVreservation ) {
			register_reservation( $RVreservation );
		}

	}

	public function get_reservations() {

		return get_post_meta( $this->ID, 'reservations' );

	}

	public function get_pending() {

		return get_post_meta( $this->ID, 'pending' );

	}
	
	public function book_lane_hour( $i, $hour, $id, $pending = FALSE ) {

		rvHTML::maybe( "This Date ID within book_lane_hour: " . $this->ID );

		if( $pending == 'true' ) return ( ! self::get_lane_hour( $i, $hour ) ) ? add_post_meta( $this->ID, 'pending_lane_' . $i . '_' . $hour, $id ) : FALSE;

		return ( ! self::get_lane_hour( $i, $hour ) ) ? update_post_meta( $this->ID, 'lane_' . $i . '_' . $hour, $id ) : FALSE;

		return ( $hour ) ? update_post_meta( $this->ID, 'lane_' . $i . '_' . $hour, $id ) : FALSE;

	}

	public function clear_lane_hour( $i, $hour, $args ) {

		$reservation = $this->get_lane_hour( $i, $hour );

//Revisoin...
		if( $args['cancel'] ) add_post_meta( $this->ID, 'canceled_lane_' . $i . '_' . $hour, $reservation );
		delete_post_meta( $this->ID, 'lane_' . $i . '_' . $hour );
		$reservation = $this->get_lane_hour( $i, $hour );
//Revision...

		return $reservation;

	}

	public function clear_hour( $hour ) {

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			self::clear_lane_hour( $i, $hour );

		}

	}

	public function clear_lane( $i ) {

		foreach ( $this->hours as $hour ) delete_post_meta( $this->ID, 'lane_' . $i . '_' . $hour ); 
		return;

	}

	public function clear_lanes( $args = array() ) {

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			self::clear_lane( $i );

		}

	}

	public function get_lane_hour( $i, $hour, $args = array() ) {
	
		if( $args['pending'] == true ) return get_post_meta( $this->ID, 'pending_lane_' . $i . '_' . $hour );
		
		if( $args['canceled'] == true ) return get_post_meta( $this->ID, 'canceled_lane_' . $i . '_' . $hour );

		return get_post_meta( $this->ID, 'lane_' . $i . '_' . $hour, true );

	}

	public function get_lane( $i, $pending = FALSE ) {
		
		$lane = array();

		foreach( $this->settings->get_hours( $this->day ) as $hour ) {

			$lane[$hour] = self::get_lane_hour( $i, $hour, $pending );

		}

		return $lane;

	}

	public function get_lanes( $args = array() ) {

		$lanes = array();

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			$lanes[$i] = self::get_lane( $i, $args );

		}

		return $lanes;

	}

	public function set_lanes( $args = array() ) {
		echo 'here';
		if( $args['type'] == 'canceled' ) :

			foreach( $this->canceled as $lane => $hours ) :

				foreach( $hours as $hour => $reservations ) :

					foreach( $reservations as $reservation ) :

						//update_post_meta('canceled_lane_' . $lane . '_' . $hour, $reservation); 

					endforeach;

				endforeach;

			endforeach;

		endif;	

	}

	//Occupancy

	public function swap_lane_hours( $i, $ihour, $j, $jhour ) {

		$first 	=  self::clear_lane_hour( $i, $ihour );	
		$second =  self::clear_lane_hour( $j, $jhour );	

		self::book_lane_hour( $j, $jhour, $first );
		self::book_lane_hour( $i, $ihour, $second );

	}

	public function register_lane_hour( $i, $hour ) {

		update_post_meta( $this->ID, 'lane_' . $i . '_' . $hour, 0 );
		return 0;

	}

	public function register_lane( $i ) {

		foreach( $this->settings->get_hours( $this->day ) as $hour ) {

			self::register_lane_hour( $i, $hour );

		}

	}

	public function register_lanes() {

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			self::register_lane( $i );

		}

	}

	public function available_lanes( $hours ) {
		
		$lanes = array();

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			$lanes = self::available_lane( $i, $hours, $lanes );


		}

		return $lanes;

	}

	public function available_lane( $i, $hours, $lanes = array() ) {

		foreach( $hours as $hour ) {

			if ( self::get_lane_hour( $i, $hour ) ) return $lanes;	

		}

		$lanes[] = $i;
		return $lanes;

	}

	public function count_hour( $hour ) {

		$count = 0;

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			if ( ! self::get_lane_hour( $i, $hour ) ) { 

				$count++;

			}

		}

		return $count;

	}

	public function check_hour( $hour ) {

		for ( $i = 1; $i <= $this->settings->lanes; $i++ ) {

			if ( ! self::get_lane_hour( $i, $hour ) ) { 

				return $i;	

			}

		}
	
		return FALSE;

	}

	public function check_hours( $hours ) {
		
		foreach( $hours as $hour ) {

			if ( ! $i = self::check_hour( $hour ) ) return FALSE;	

		}

		echo "It's going to be true.";
		return $i;
	}

	public function book_hour( $hour, $id, $i = FALSE ) {

//		rvHTML::belk( "ID within book_hour: $id " );
//		rvHTML::belk( "Hour within book_hour: $hour " );
//		rvHTML::belk( "Lane within book_hour: " . self::check_hour( $hour ) );
		return self::book_lane_hour( ( $i ) ? $i : self::check_hour( $hour ), $hour, $id );	

	}

	public function book_hours( $hours, $id ) {

		if ( ! $i = self::check_hours( $hours ) ) return FALSE;


		foreach ( $hours as $hour ) self::book_hour( $hour, $id, $i );


		return TRUE;
	
	}

	public function book_lane_hours( $i, $hours, $id ) {
		foreach ( $hours as $hour ) self::book_hour( $hour, $id, $i );

		return TRUE;

	}

	public function book_lanes_hours( $lanes, $hours, $id ) {

		rvHTML::maybe("Lanes in book_lanes:hours: ");
		//To verify that this is possible
		foreach( $lanes as $i ) {

			if ( ! in_array( $i, self::available_lanes( $hours ) ) ) return FALSE;

		}

		foreach( $lanes as $i ) {

			self::book_lane_hours( $i, $hours, $id );

		}

		return $lanes;

	}

	public function sanitize_reservations() {

		if ( $this->reservations != self::get_reservations() ) return;

		$this->reservations = array_unique( $this->reservations );	

		delete_post_meta( $this->ID, 'reservations' );

		self::register_reservations( $this->reservations );


	}

	public function set_notes( $notes ) {

		return update_post_meta( $this->ID, 'notes', $notes );		

	}

	public function get_web_lanes() {
	
		$weblanes = get_post_meta( $this->ID, 'weblanes', true );
		if( ! $weblanes ) {
			foreach( $this->hours as $hour ) {
				$weblanes[$hour] = 0;
			}
			$this->set_web_lanes( $weblanes );
		}
		return $weblanes;

	}

	public function set_web_lanes( $weblanes ) {

		return update_post_meta( $this->ID, 'weblanes', $weblanes );

	}

	public function reset_web_lanes() {

		foreach( $this->hours as $hour ) {
			$weblanes[$hour] = 0;
		}
		$this->set_web_lanes( $weblanes );


	}

	public function increment_web_lane( $hour ) {

		$this->weblanes[$hour]+=1;
		$this->set_web_lanes( $this->weblanes );

	}

	public function decrement_web_lane( $hour ) {

		$this->weblanes[$hour]-=1;
		$this->set_web_lanes( $this->weblanes );

	}

	public function sanitize_cancelations( $ID ) {

		global $wpdb;
		$wpdb->query("DELETE FROM wp_postmeta WHERE meta_key LIKE 'canceled_lane%' AND meta_value='$ID'");
		return true;

	}

}
