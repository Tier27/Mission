<?php

class rvOutput {

	public function speak() {

		echo "This is output.";

	}

	public function table( $reservation ) {

		return rvData::get_atts( 'reservation' );
	
	}

	public function print_reservation( $reservation, $date, $i, $hour, $type = 'active', $class ) {
		switch( $type ) {
			case 'active':
				$store = $date->lanes;
				break;
			case 'pending':
				$store = $date->pending;
				break;
			case 'canceled':
				$store = $date->canceled;
				break;
		}
		//$date->set_lanes( array('type' => 'canceled') );
                ?>
		<div class="reservation-wrap <?php echo $class; ?>">
		<span class="badge hide"><?php echo $prevID = $reservation->ID; ?></span>
                <span class="id hide"><?php echo $reservation->ID; ?></span>
		<span class="price hide"><?php echo $reservation->price; ?></span>
                <h5 class="lanes hide"><?php echo count( $reservation->lanes ); ?></h5>
                <h5 class="bowlers hide"><?php echo $reservation->bowlers; ?></h5>
                <h5 class="hours hide"><?php echo implode( ',', $reservation->hours ); ?></h5>
                <h5 class="name"><strong><?php echo $reservation->name; ?></strong></h5>
                <h5 class="company"><?php echo $reservation->company; ?></h5>
                <h5 class="phone"><?php echo $reservation->phone; ?></h5>
                <span class="balanced hide"><?php echo isset( $reservation->paid ) ? 'Due: ' : ''; ?>
		</span>
		<span class="badge balance"><?php echo isset( $reservation->paid ) ? '$'.( $reservation->price - (int)substr($reservation->paid,1) ) : ''; ?></span>
		<span class="balance-paid hide"><?php echo $reservation->paid; ?></span>
                <h5 class="email hide"><?php echo $reservation->email; ?></h5>
                <h5 class="status hide"><?php echo $reservation->status; ?></h5>
                <h6 class="notes"><?php echo $reservation->notes; ?></h6>
		<?php if ( $reservation != '' ) { ?>
		<div class="creator">Created by <?php echo ( $reservation->post->post_author == 0 ) ? "a user" : get_user_meta( $reservation->post->post_author, 'first_name', true );  ?>
		</div>
		<?php } 
		?></div><?php
	}

}
