<?php

class rvAjax {

	public function speak() {

		rvHTML:: belk( "This is Reservations Ajax." );

	}

	public function print_calendar_contents( $datefield ) {

		if ( isset( $_POST ) && ! empty( $_POST['date'] ) )
			$datefield = $_POST['date'];

		$datefield = preg_replace( '/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/', '$3-$1-$2', $datefield );
		$date = new rvDate( $datefield ); 
		foreach ( $date->settings->get_hours( $date->day ) as $hour ) { ?>

                  <div class="row cal-heading">
                    <div class="col-md-4" style="opacity: .6;">
                      <h5><strong><?php echo ( $hour % 12 == 0 ) ? '12:00 ' : ( $hour % 12 ) . ':00 '; echo ( ( ( int )( $hour / 12) ) == 1 ) ? 'pm' : 'am'; ?></strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$35</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <?php for ( $i = 1; $i <= $date->settings->lanes; $i++ ) { ?>
                    <?php $reservation = ( $date->lanes[$i][$hour] > 0 ) ? new rvReservation( $date->lanes[$i][$hour] ) : ''; ?>
                    <div class="col-md-2 center-block event <?php echo ( $reservation == '' ) ? '' : 'filled'; ?>">
                        <span class="badge"><?php echo $date->lanes[$i][$hour]; ?></span>
                        <span class="id" hidden><?php echo $date->lanes[$i][$hour]; ?></span>
                        <span class="paid"><?php echo ( isset( $reservation->paid ) ) ? $reservation->paid : ''; ?></span>
                        <h5 class="bowlers" hidden><?php echo $reservation->bowlers; ?></h5>
                        <h5 class="name"><strong><?php echo $reservation->name; ?></strong></h5>
                        <h5 class="company"><?php echo $reservation->company; ?></h5>
                        <h5 class="phone hide"><?php echo $reservation->phone; ?></h5>
                        <h5 class="email hide"><?php echo $reservation->email; ?></h5>
                        <h6 class="notes"><?php echo $reservation->notes; ?></h6>
                    </div>
                    <?php } ?>
                  </div>

        <?php } 

		if ( isset( $_POST ) && ! empty( $_POST['date'] ) ) die();

	}

	public function update_reservation( ) {

		$reservation = new rvReservation( $_POST['ID'] );
		unset( $_POST['ID']);
		unset( $_POST['date']);
		unset( $_POST['lanes']);
		foreach ( $_POST as $att => $value ) {

			rvHTML::maybe( "Updating $att: $value" );
			$reservation->update( $att, $value );

		}
		die();

	}

}

add_action('wp_ajax_print_calendar_contents', array( 'rvAjax' , 'print_calendar_contents' ) );
add_action('wp_ajax_nopriv_print_calendar_contents', array( 'rvAjax' , 'print_calendar_contents' ) );


add_action('wp_ajax_update_reservation', array( 'rvAjax' , 'update_reservation' ) );
add_action('wp_ajax_nopriv_update_reservation', array( 'rvAjax' , 'update_reservation' ) );
add_action('wp_ajax_nopriv_print_calendar_contents', array( 'rvAjax' , 'print_calendar_contents' ) );
	
