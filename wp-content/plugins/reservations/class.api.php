<?php 

class rvAPI {

	public function get_reservations( $post ) {

		extract( $post );
		if( !isset($start) ) $start = date('Y-m-d');
		if( !isset($end) ) $end = $start;
		global $wpdb;
		$reservationIDs = $wpdb->get_col("SELECT post_id FROM wp_postmeta WHERE meta_key='datefield' AND meta_value='$start'");
		$reservations = array();
		foreach( $reservationIDs as $reservationID ) $reservations[] = new rvReservation( $reservationID, array( 'post' => false, 'date' => false ) );
		echo json_encode( $reservations );
		die();

	}


}
