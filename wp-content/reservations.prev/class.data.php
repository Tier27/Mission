<?php

class rvData {

	public $data;
	public $ID;
	public $registered;

	public function __construct () {

		$this->data = self::get_data();
		//print_r( $this->data );
		$this->ID = $this->data->ID;
		$this->registered = self::get_dates();
		
	}

	public function speak() {

		echo "Speaking!";

	}

	public function get_data() {

		return rvWordPress::get_post_by_slug( 'reservations-settings' );

	}

	public function get_data_id() {

		return $this->ID;

	}

	public function register_date( $date ) {

		if ( ! in_array( $date, $this->registered ) ) add_post_meta( $this->ID, 'dates', $date );

	}

	public function deregister_date( $date ) {

		rvHTML::maybe( "Attempting deregister..." );
		if ( in_array( $date, $this->registered ) ) delete_post_meta( $this->ID, 'dates', $date );
		return;

	}

	public function register_dates( $dates ) {

		foreach ( $dates as $date ) {
			register_date( $date );
		}

	}

	public function get_dates() {

		return get_post_meta( $this->ID, 'dates' );

	}

	public function sanitize_registered_dates() {

		if ( $this->registered != self::get_dates() ) return;

		$this->registered = array_unique( $this->registered );	

		delete_post_meta( $this->ID, 'dates' );

		self::register_dates( $this->registered );


	}

	public function get_atts ( $type ) {

		$atts = array();

		if ( $type == 'reservation' ) {

			$atts[]	= 'name';
			$atts[]	= 'company';
			$atts[]	= 'phone';
			$atts[]	= 'email';
			$atts[]	= 'notes';
			$atts[]	= 'paid';
			$atts[]	= 'hours';
			$atts[]	= 'date';
			$atts[]	= 'lanes';
			$atts[]	= 'bowlers';

		}

		return $atts;

	}
}
