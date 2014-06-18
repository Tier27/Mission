<?php

class rvRetrieve {
	
	public $reservation_date;

	public function speak() {
		echo "Speaking.";
	}

	public function reservations( ) {

		$args = array(
			'post_type'     => 'reservation',
			'posts_per_page'    => -1,
			'post_status'   => 'private',
		);

		return get_posts( $args );
	
	}

	public function dates( ) {

		$args = array(
			'category'	=>  self::get_reservation_date_category(),
			'posts_per_page'    => -1,
			'post_status'   => 'private',
		);

		return get_posts( $args );
	
	}

	public function reservation_ids() {

		$reservation_ids = array();
		$reservations = self::reservations();
		foreach ( $reservations as $reservation ) {
			$reservation_ids[] = $reservation->ID;
		}

		return $reservation_ids;

	}

	public function date_ids() {

		$date_ids = array();
		$dates = self::dates();
		foreach ( $dates as $date ) {
			$date_ids[] = $date->ID;
		}

		return $date_ids;

	}

	public function get_reservation_date_category() {

		$category = get_category_by_slug( 'reservation-date' );
		rvHTML::breaks(3);
		return $category->term_id;

	}

}
