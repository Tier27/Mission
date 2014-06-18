<?php

class rvQuery {


	public function speak() {

		rvHTML::belk( "This is rvQuery." );

	}

	public function reservations_by_single_meta( $key, $value, $count = -1 ) {

		$args = array(
			'post_type'     => 'reservation',
			'posts_per_page'    => $count,
			'post_status'   => 'private',
			'meta_key'	=> $key,
			'meta_value'	=> $value
		);

		return get_posts( $args );
		

	}

	public function reservation_ids_by_single_meta( $key, $value, $count = -1 ) {

		return array_map( function( $x ) { return $x->ID; }, self::reservations_by_single_meta( $key, $value, $count ) );

	}

	public function reservation_id_by_single_meta( $key, $value ) {

		$post = self::reservation_ids_by_single_meta( $key, $value, 1 );

		return $post[0];
	
	}	
}
