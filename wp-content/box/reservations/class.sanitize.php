<?php

class rvSanitize {

	public function speak() {
		
		echo "I am going to delete everything! Be careful with me. ";

	}

	public function clear_dates( $password ) {
	
		if ( $password != '1X97ohsG1t' ) return;

		$date_ids = rvRetrieve::date_ids();		
	
		print_r( $date_ids );

		foreach( $date_ids as $date_id ) {

			wp_delete_post( $date_id );

		}
		
		echo "The dates have been cleared.";

	}

	public function clear_date_registry() {

		$data = new rvData();
		echo $data->ID;

	}

	public function clear_reservations( $password ) {

		if ( $password != 'tiercom!1(9)0' ) return;

		$reservation_ids = rvRetrieve::reservation_ids();

		print_r( $reservation_ids );

		foreach( $reservation_ids as $reservation_id ) {

			wp_delete_post( $reservation_id );

		}

		rvHTML::belk( "The reservations have been cleared...." );
	}

	public function clear_trash( $password ) {

		if ( $password != 'SERIOUS' ) return;

		global $wpdb;
		$wpdb->query( "DELETE FROM $wpdb->posts WHERE post_status='trash'" );
		rvHTML::belk( "The trash has been emptied..." );

	}

}
