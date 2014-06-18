<?php

class rvSettings {

	public $settings;
	public $ID;
	public $lanes;
	public $dining;

	public function __construct () {

		$this->settings = self::get_settings();
		$this->ID = $this->settings->ID;
		$this->lanes = $this->get_lanes();
		$this->get_dining_hours();
		
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

	public function set_pricing() {

		update_post_meta( $this->ID, 'weekday_pricing_15', 35 );
		update_post_meta( $this->ID, 'weekday_pricing_16', 35 );
		update_post_meta( $this->ID, 'weekday_pricing_17', 35 );
		update_post_meta( $this->ID, 'weekday_pricing_18', 45 );
		update_post_meta( $this->ID, 'weekday_pricing_19', 45 );
		update_post_meta( $this->ID, 'weekday_pricing_20', 55 );
		update_post_meta( $this->ID, 'weekday_pricing_21', 55 );
		update_post_meta( $this->ID, 'weekday_pricing_22', 55 );
		update_post_meta( $this->ID, 'weekday_pricing_23', 55 );

		update_post_meta( $this->ID, 'weekend_pricing_11', 35 );
		update_post_meta( $this->ID, 'weekend_pricing_12', 35 );
		update_post_meta( $this->ID, 'weekend_pricing_13', 35 );
		update_post_meta( $this->ID, 'weekend_pricing_14', 45 );
		update_post_meta( $this->ID, 'weekend_pricing_15', 45 );
		update_post_meta( $this->ID, 'weekend_pricing_16', 45 );
		update_post_meta( $this->ID, 'weekend_pricing_17', 45 );
		update_post_meta( $this->ID, 'weekend_pricing_18', 45 );
		update_post_meta( $this->ID, 'weekend_pricing_19', 45 );
		update_post_meta( $this->ID, 'weekend_pricing_20', 55 );
		update_post_meta( $this->ID, 'weekend_pricing_21', 55 );
		update_post_meta( $this->ID, 'weekend_pricing_22', 55 );
		update_post_meta( $this->ID, 'weekend_pricing_23', 55 );

	}

	public function get_pricing( $day, $hour ) {

		if ( $day <= 5 ) return get_post_meta( $this->ID, 'weekday_pricing_' . $hour, true );
		if ( $day > 5 ) return get_post_meta( $this->ID, 'weekend_pricing_' . $hour, true );

	}

	public function get_dining_hours() {

		$this->dining = array();
		$this->dining[0] = array( 675, 705, 735, 765, 780, 795, 810, 825, 840, 855, 870, 885, 900, 915, 930, 945, 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290 );
		$this->dining[1] = array( 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290 );
		$this->dining[2] = array( 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290 );
		$this->dining[3] = array( 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290 );
		$this->dining[4] = array( 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350 );
		$this->dining[5] = array( 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350 );
		$this->dining[6] = array( 675, 705, 735, 765, 780, 795, 810, 825, 840, 855, 870, 885, 900, 915, 930, 945, 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350 );

	}

}
