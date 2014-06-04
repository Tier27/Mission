<?php

class rvFormat {

	public function military_hour( $int ) {

		return self::military_time( $int * 60 );

	}

	public function military_time( $int ) {

		if( ! is_numeric( $int ) ) return;

		$hour =  (int)($int / 60);

		$minute = $int % 60;

		if( $minute == 0 ) $minute = '00';

		if( $hour < 0 || $hour >= 24 ) return;

		if( $hour < 12 ) return "$hour:$minute am";
	
		if( $hour == 12 ) return "12:$minute pm";

		if( $hour > 12 ) return ( $hour % 12 ) . ":$minute pm";

	}

	public function short_military_hour( $int ) {

		if( ! is_numeric( $int ) ) return;

		if( $int < 0 || $int >= 24 ) return;

		if( $int < 12 ) return "$int" . "am";
	
		if( $int == 12 ) return "12pm";

		if( $int > 12 ) return ( $int % 12 ) . "pm";

	}

}
