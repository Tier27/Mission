<?php

class rvHTML {

	public function breaks( $int ) {

		for ( $I = 0; $I < $int; $I++ ) {

			echo "<br>";

		}

	}
	
	public function belk( $string ) {

		echo $string;
		self::breaks(1);

	}

	public function maybe( $string ) {

		if ( FALSE ) self::belk( $string );

	}

	public function trace() {

		self::belk('Trace');

	}

}
