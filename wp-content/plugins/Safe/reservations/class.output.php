<?php

class rvOutput {

	public function speak() {

		echo "This is output.";

	}

	public function table( $reservation ) {

		return rvData::get_atts( 'reservation' );
	
	}

}
