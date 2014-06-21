<?php

class rvFormat {

	public function military_hour( $int ) {

		if( ! is_numeric( $int ) ) return;

		if( $int < 0 || $int >= 24 ) return;

		if( $int < 12 ) return "$int:00 am";
	
		if( $int == 12 ) return "12:00 pm";

		if( $int > 12 ) return ( $int % 12 ) . ":00 pm";

	}

}
