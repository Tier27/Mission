<?php

class rvProcess {

	public function front_add_reservation ( ) {

		$args = array();
		$args['hours'] = explode( ',', $_POST['hours'] );
		$args['name'] = $_POST['name'];
		$args['company'] = $_POST['company'];
		$args['phone'] = $_POST['phone'];
		$args['email'] = $_POST['email'];
		$args['notes'] = $_POST['notes'];
		$args['paid'] = $_POST['paid'];
//		$args['Hours'] = array( 20, 21, 22 );
		$args['date'] = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $_POST['date'] );
		$args['lanes'] = $_POST['lanes'];
		$args['bowlers'] = $_POST['bowlers'];
		print_r( $args['hours'] );
		print_r( $args );

		$reservation = new rvReservation( $args );
		print_r( $reservation );
		echo "Hi!";

	}

}

add_action('wp_ajax_add_reservation', array( 'rvProcess' , 'front_add_reservation' ) );
add_action('wp_ajax_nopriv_add_reservation', array( 'rvProcess', 'front_add_reservation' ));
