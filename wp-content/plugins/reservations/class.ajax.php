<?php

class rvAjax {

	public function print_calendar_contents( $datefield ) {
		if ( isset( $_POST ) && ! empty( $_POST['date'] ) )
			$datefield = $_POST['date'];

		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield ); 
		$prevID = 0;
		foreach ( $date->settings->get_hours( $date->day ) as $hour ) { $availability[$hour] = $date->count_hour( $hour ); ?>

                  <div class="row cal-heading hide" style="display: table-row">
                    <div class="col-md-2-table" style="opacity: .6;">
                      <h5><strong><?php echo ( $hour % 12 == 0 ) ? '12:00 ' : ( $hour % 12 ) . ':00 '; echo ( ( ( int )( $hour / 12) ) == 1 ) ? 'pm' : 'am'; ?></strong></h5>
                    </div>
                    <div class="col-md-2-table"></div>
                    <div class="col-md-2-table"></div>
                    <div class="col-md-2-table">
                      <h5><?php echo '$' . $price = $date->settings->get_pricing( $date->day, $hour ); ?></h5>
                    </div>
                    <div class="col-md-2-table"></div>
                    <div class="col-md-2-table"></div>
                  </div>
                  <div class="row" style="display: table-row">
		    <div class="info-tab" style="width: 45px;"><?php echo rvFormat::short_military_hour($hour); ?></div>
                    <?php for ( $i = 1; $i <= $date->settings->lanes; $i++ ) { ?>
                    <?php $reservation = ( $date->lanes[$i][$hour] > 0 ) ? new rvReservation( $date->lanes[$i][$hour] ) : ''; ?>
		    <?php if( $reservation && ! $reservation->status ) $reservation->status = 'pending'; ?>
                    <div class="col-md-2-table event <?php echo $reservation->status; ?>
<?php //echo ( $reservation == '' ) ? '' : $reservation->status . ' filled';?>" 
			<?php if ( $date->lanes[$i][$hour] != $prevID ) echo 'style="border-left: solid 1px black;"'; ?>
			<?php if ( $i == $date->settings->lanes && $reservation != '' ) echo 'style="border-right: solid 1px black;"'; ?>
			>
		    <?php if( $reservation != '' ) { ?>
		    <div class="<?php echo $reservation->status; ?> filled">
			<?php rvOutput::print_reservation( array( "previous" => $prevID ), $reservation, $date, $i, $hour, 'active' ); ?>
		    </div>
		    <?php } ?>
		    <div class="pending hide">
		    <?php 
		   foreach( $date->pending[$i][$hour] as $ID ) { 
			$reservation = new rvReservation( $ID ); 
			rvOutput::print_reservation( array( "previous" => $prevID ), $reservation, $date, $i, $hour, 'pending', 'pending-reservation' ); 
		   } ?>
		    </div>
		    <div class="canceled hide">
		    <?php 
		   foreach( $date->canceled[$i][$hour] as $ID ) { 
			$reservation = new rvReservation( $ID ); 
			rvOutput::print_reservation( array( "previous" => $prevID ), $reservation, $date, $i, $hour, 'canceled', 'canceled-reservation' ); 
		   } ?>
		    </div>
                    </div>
		   <?php if( $reservation != '' ) $prevID = $reservation->ID; ?>
                   <?php } ?>
                  </div>

        <?php } 

		if ( isset( $_POST ) && ! empty( $_POST['date'] ) ) die();

	}

	public function update_reservation( ) {

		$reservation = new rvReservation( $_POST['ID'] );
		$hours = explode( ',', $_POST['hours'] );
		$ID = $_POST['ID'];
		$lanes = $_POST['lanes'];


		$booked = true;
		
		//This is to handle the rebooking of cancelled and pending reservations
		$status = $reservation->status;
		print_r( $_POST );
		if( $_POST['status'] == 'canceled' || $_POST['status'] == 'pending' ) :
			$_POST['status'] = 'hold';
			$booked = false;
			//$reservation->lanes = $reservation->date->book_lanes_hours( array_slice( $reservation->date->available_lanes( $hours ), 0, $lanes ), $hours, $ID );
			
		endif;


		//This is the change the date of a reservation
		if( strtotime($_POST['date']) != strtotime($reservation->datefield) ) :

			$date = new rvDate($_POST['date']);
			echo $date->date;
			echo $_POST['date'];
			echo $date->ID;
			print_r( $date->available_lanes($hours) );
			$reservation->lanes = $date->book_lanes_hours( array_slice( $date->available_lanes( $hours ), 0, $lanes ), $hours, $ID );
			$reservation->almost_delete();
			$reservation->update( 'lanes', $reservation->lanes );
			$reservation->price = $reservation->set_price();
			$reservation->update( 'price', $reservation->price );
			$reservation->date = $date;
			$reservation->update( 'date', $reservation->date );
			$reservation->date->register_reservation( $reservation->ID );
			$reservation->update( 'datefield', $reservation->date->date );
			
			die;

		endif;

		//print_r( $reservation->date->available_lanes($hours) );
		unset( $_POST['ID']);
		unset( $_POST['hours']);
		unset( $_POST['date']);
		unset( $_POST['lanes']);
		echo 'hi there.';
		foreach ( $_POST as $att => $value ) {

			rvHTML::belk( "Updating $att: $value" );
			$reservation->update( $att, $value );

		}
		if( $booked == true ) :
			$reservation->clear_lanes();
		endif;
		$reservation->update( 'hours', $hours );
		$reservation->lanes = $reservation->date->book_lanes_hours( array_slice( $reservation->date->available_lanes( $hours ), 0, $lanes ), $hours, $ID );
		if( !$reservation->lanes ) :
			echo "its simply not available.";
			die;
		endif;
		$reservation->update( 'lanes', $reservation->lanes );
		$reservation->price = $reservation->set_price();
		$reservation->update( 'price', $reservation->price );
		if( $status == 'canceled' ) :
			$reservation->date->sanitize_cancelations($reservation->ID);
		endif;
		if( $status == 'pending' ) :
			$reservation->date->sanitize_pending_reservations($reservation->ID);
		endif;
		die();

	}

	public function delete_reservation() {

		$reservation = new rvReservation( $_POST['id'] );
		$reservation->delete();

	}

	public function cancel_reservation() {

		$reservation = new rvReservation( $_POST['id'] );
		$reservation->cancel();

	}

	public function pend_reservation() {

		if( $_POST['id'] == -1 ) die;
		$reservation = new rvReservation( $_POST['id'] );
		$reservation->set_pending();
		die;

	}

	public function update_hours_buttons() {

		$datefield = $_POST['datefield'];
		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield ); 
		foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { ?>
		<button type="button" class="btn btn-trimmed hours" id="button-<?php echo $hour; ?>"><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::short_military_hour( $hour ); ?><input type="checkbox" name="hour" class="hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"></button>
		<?php } } 
		die();

	}

	public function update_hours() {

		$prepend = $_POST['append'];
		$datefield = $_POST['datefield'];
		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield ); 
		if ( $_POST['buttons'] == true ) {

		  	foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { ?>
		  	<button type="button" class="btn hours" id="button-<?php echo $hour; ?>"><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::short_military_hour( $hour ); ?><input type="checkbox" name="hour" class="hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"></button>
		  	<?php } } 
			die();

		}
		if ( $_POST['all'] != true ) array_pop( $date->hours );
		foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { 
		if ( $_POST['simple'] == true ) { ?>
                <option value=<?php echo $hour; ?> data-lanes=<?php echo $lanes = $date->count_hour( $hour ); ?> data-price=<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>><?php echo rvFormat::military_hour( $hour ); ?> <?php //echo $lanes; ?></option>
                <!--<option value=<?php echo $hour; ?> data-price=<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>><?php echo rvFormat::military_hour( $hour ); ?></option>-->
		<?php } else { ?>

		<li><a id="anchor-<?php echo $hour; ?>"><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="<?php echo $prepend; ?>hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"><span style="float: right;"><span class="pricetag hide"><?php echo $date->settings->get_pricing( $date->day, $hour ); ?></span></span></a></li>
		<?php } } }

		die();

	}

	public function update_future() {
		
		$datefield = $_POST['datefield'];
		echo $datefield;
		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield );
		foreach ( $date->settings->get_hours( $date->day ) as $hour ) { ?>
		<tr>
		<?php for ( $i = 1; $i <= $date->settings->lanes; $i++ ) { ?>
		<td style="width: 25px; height: 25px; <?php echo ( $date->lanes[$i][$hour] == '' ) ? '' : 'background: red;'; ?>"></td>
		<?php } ?>
		</tr>
		<?php } 

	}

	public function search_reservations() {
	
		$query = $_POST['query'];
		global $wpdb;
		$results = $wpdb->get_col("SELECT post_id FROM wp_postmeta WHERE meta_value LIKE '%$query%'");
		echo "<table>";
		echo "<tr><th>Date</th><th>Name</th></tr>";
		foreach( $results as $result ) {

			$reservation = new rvReservation( $result );
			$datetime = new DateTime($reservation->date->date);
			echo "<tr><td><a href='#' class='date-selector' style='color: blue'>" . $datetime->format('m/d/Y') . "</a></td><td>$reservation->name</td></tr>";

		}
		echo "</table>"; 
		?>
		<script>
		jQuery(function($) {
			$('.date-selector').click( function(e) {
				e.preventDefault;
				$('#reportrange').val($(this).html()).trigger('change');
			});
		});
		</script>
		<?php
		die();

	}

	public function update_notes() {

		$notes = $_POST['notes'];
		$datefield = $_POST['date'];
		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield );
		$date->set_notes( $notes );
		die();

	}

	public function get_notes() {

		$datefield = $_POST['date'];
		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield );
		echo $date->notes;
		die();

	}

}

add_action('wp_ajax_update_future', array( 'rvAjax' , 'update_future' ) );

add_action('wp_ajax_print_calendar_contents', array( 'rvAjax' , 'print_calendar_contents' ) );
add_action('wp_ajax_nopriv_print_calendar_contents', array( 'rvAjax' , 'print_calendar_contents' ) );


add_action('wp_ajax_update_reservation', array( 'rvAjax' , 'update_reservation' ) );
add_action('wp_ajax_nopriv_update_reservation', array( 'rvAjax' , 'update_reservation' ) );
add_action('wp_ajax_nopriv_print_calendar_contents', array( 'rvAjax' , 'print_calendar_contents' ) );
	
add_action('wp_ajax_delete_reservation', array( 'rvAjax' , 'delete_reservation' ) );
add_action('wp_ajax_nopriv_delete_reservation', array( 'rvAjax' , 'delete_reservation' ) );

add_action('wp_ajax_cancel_reservation', array( 'rvAjax' , 'cancel_reservation' ) );
add_action('wp_ajax_nopriv_cancel_reservation', array( 'rvAjax' , 'cancel_reservation' ) );

add_action('wp_ajax_pend_reservation', array( 'rvAjax' , 'pend_reservation' ) );
add_action('wp_ajax_nopriv_pend_reservation', array( 'rvAjax' , 'pend_reservation' ) );

add_action('wp_ajax_update_hours', array( 'rvAjax' , 'update_hours' ) );
add_action('wp_ajax_nopriv_update_hours', array( 'rvAjax' , 'update_hours' ) );

add_action('wp_ajax_update_hours_buttons', array( 'rvAjax' , 'update_hours_buttons' ) );
add_action('wp_ajax_nopriv_update_hours_buttons', array( 'rvAjax' , 'update_hours_buttons' ) );

add_action('wp_ajax_search_reservations', array( 'rvAjax' , 'search_reservations' ) );
add_action('wp_ajax_nopriv_search_reservations', array( 'rvAjax' , 'search_reservations' ) );

add_action('wp_ajax_update_notes', array( 'rvAjax' , 'update_notes' ) );
add_action('wp_ajax_nopriv_update_notes', array( 'rvAjax' , 'update_notes' ) );

add_action('wp_ajax_get_notes', array( 'rvAjax' , 'get_notes' ) );
add_action('wp_ajax_nopriv_get_notes', array( 'rvAjax' , 'get_notes' ) );
