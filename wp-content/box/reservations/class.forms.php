<?php

class rvForms {

	public function reservation() {
		
		$settings = new rvSettings();

		echo "<form class='reservations' action=''>";
		self::lanes_dropdown( $settings );
		self::text_field( 'Name', 'name', 'name', 'Name' );
		self::text_field( 'Company', 'company', 'company', 'Company' );
		self::text_field( 'Phone', 'phone', 'phone', 'Phone' );
		self::text_field( 'Email', 'email', 'email', 'Email' );
		self::text_field( 'Notes', 'notes', 'notes', 'Notes' );
		self::text_field( 'Paid', 'paid', 'paid', 'Paid' );
		self::text_field( 'Date', 'date', 'date', 'Date' );
		self::text_field( 'Lanes', 'lanes', 'lanes', 'Lanes' );
		self::text_field( 'Bowlers', 'bowlers', 'bowlers', 'Bowlers' );
		self::text_field( 'Action', 'action', 'action', 'add_reservation' );
		echo "<input class='submit' type='submit'>";
		echo "</form>";
		echo "<div id='jQuery'>jQuery</div>";
		echo "<script> var ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "'; </script>";
		echo "<script type='text/javascript' src='" . plugins_url() . "/reservations/assets/reservations.js?ver=1.01'></script>";

	}
	
	public function lanes_dropdown( $settings ) {

		echo "Lanes: ";
		echo "<select>";

		for ( $i=0; $i<$settings->lanes; $i++ ) {
				
			echo "<option value='$i'>$i</option>";

		}	

		echo "</select>";
		echo "<br>";

	}

	public function text_field( $label, $name, $id, $value = NULL ) {

		$value = ( $value ) ? "value='$value'" : "";

		echo "$label: <input type='text' id='$id' name='$name' $value><br>\n";

	}

}
