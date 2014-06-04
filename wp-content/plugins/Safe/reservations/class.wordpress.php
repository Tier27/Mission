<?php

class rvWordPress {

	public function speak() {
		echo "Speaking WordPress...";
	}

	public function get_all_posts( ) {

		return get_posts();

	}

	public function get_post( $ID, $type = 'post' ) {

		global $wpdb;
		$post = $wpdb->get_row( "SELECT * FROM $wpdb->posts WHERE ID = $ID AND post_type='$type' " );
        	if ( $post ) return $post;
		rvHTML::trace();
		return null;

	}

	public function get_post_by_slug( $slug ) {

		global $wpdb;
		$post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type='post' ", $slug ));
        	if ( $post ) return get_post($post);
		return null;

	}

	public function update_post_parameter( $id, $key, $value ) {

		$args = array(
			'ID'	=> $id,
			$key	=> $value
		);

		wp_update_post( $args );

	}

}
