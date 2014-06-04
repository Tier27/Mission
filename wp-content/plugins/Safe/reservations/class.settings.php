<?php

class rvSettings {

	public $settings;
	public $ID;
	public $lanes;

	public function __construct () {

		$this->settings = self::get_settings();
		$this->ID = $this->settings->ID;
		$this->lanes = $this->get_lanes();
		
	}

	public function speak() {

		echo "Speaking!";

	}

	public function get_settings() {

		return rvWordPress::get_post_by_slug( 'reservations-settings' );

	}

	public function get_settings_id() {

		return $this->ID;

	}

	public function set_hours( $day, $hours ) {

		delete_post_meta( $this->ID, 'hours_' . $day );
		
		foreach ( $hours as $hour ) {
			add_post_meta( $this->ID, 'hours_' . $day , $hour );
		}

		return true;

	}

	public function get_hours( $day ) {

		return get_post_meta( $this->ID, 'hours_' . $day );

	}

	public function set_lanes( $int ) {

		update_post_meta( $this->ID, 'lanes', $int );

	}

	public function get_lanes() {

		return get_post_meta( $this->ID, 'lanes', true );

	}
}
