<?php

class rvReservation {
	
	public $ID;

	public $name;
	public $company;
	public $phone;
	public $email;
	public $notes;
	public $paid;
	public $hours;
	public $date;
	public $datefield;
	public $lanes;
	public $bowlers;

	public $post;
	public $slots;
	public $args;

	public function retrieve( $id ) {
		
		rvHTML::maybe("Calling retrieve on $id...");
		$args = array(
			'post_type'     => 'reservation',
			'posts_per_page'    => -1,
			'post_status'   => 'private',
		);

		return rvWordPress::get_post( $id, 'reservation' );
	
	}

	public function __construct ( $args = NULL ) {

		$this->args = $args;
		rvHTML::maybe( "Constructing reservation with $this->args" );
		if ( ! is_array ( $this->args ) ) { 

			self::build( $args );
			return;

		}

		$this->datefield = $args['date'];

		$this->date = new rvDate( $args['date'] );
	
		rvHTML::belk( "Calm." );
		rvHTML::belk( count( $AL ) );
		rvHTML::belk( $args['lanes'] );

		if ( count( $this->date->available_lanes( $args['hours'] ) ) < $args['lanes'] ) return 0;

		rvHTML::belk( "Going." );

		$this->sanitize_args();

		//$this->lanes 	= $args['lanes'];
		
		$this->hours 	= $args['hours'];
		
		$this->name 	= $args['name'];

		$this->company 	= $args['company'];

		$this->phone 	= $args['phone'];

		$this->email 	= $args['email'];

		$this->notes 	= $args['notes'];

		$this->paid 	= $args['paid'];

		$this->hours 	= $args['hours'];

		//print_r( $args );
		//return;

		$postargs = array();
		$postargs['post_name'] = str_replace( ' ', '-', $args['name'] ) . '-' . $args['date'];
		rvHTML::belk( $postargs['post_name'] );
		$this->post = rvWordPress::get_post_by_slug( $postargs['post_name'] ); 
		//print_r( $this->post );

		if ( empty( $this->post ) ) {

			$postargs['post_title'] = $args['name'] . ' - ' . $args['date'];
			$postargs['post_status'] = 'private';
			$postargs['post_type'] = 'reservation';

			$this->ID = wp_insert_post( $postargs );
			$this->post = self::retrieve( $this->ID );

		} else {

			$this->ID = $this->post->ID;

		}

		$this->lanes = $this->date->book_lanes_hours( array_slice( $this->date->available_lanes( $args['hours'] ), 0, $args['lanes'] ), $this->hours, $this->ID );

		$this->register_meta();

		self::init();

	}

	public function init() {

		$this->date->register_reservation( $this->ID );

	}

	public function build( $id ) {

		$this->ID = $id;
		$this->post = $this->retrieve( $this->ID );	
		$this->extract_meta();
		$this->date = new rvDate( $this->datefield );
	
	}

	public function update( $att, $value ) {

		update_post_meta( $this->ID, $att, $value  );

		$this->$att = $value;

	}

	public function register_meta() {

		print_r( $this->lanes );
		rvHTML::belk( "That was the lanes..." );
		//rvHTML::belk( "Beginning meta registration..." );
		
		foreach ( $this->args as $argk => $argv ) {

			if ( $argk == 'date' ) $argk = 'datefield';

			rvHTML::belk( $argk . ", " . $argv );
			update_post_meta( $this->ID, $argk, $argv );		

			if ( $argk == 'lanes' ) {
				rvHTML::belk("About to do lane meta...");
				print_r( $this->lanes );
				rvHTML::belk("That should have been the lanes array...");
				delete_post_meta( $this->ID, $argk );
				foreach ( $this->lanes as $lane ) {

					rvHTML::belk("Lane $lane");
					add_post_meta( $this->ID, $argk, $lane );

				}
	
			}

		}

	}

	public function extract_meta( $att, $key ) {
		
		$this->name 	= get_post_meta( $this->ID, "name", TRUE );		
		$this->company 	= get_post_meta( $this->ID, "company", TRUE );		
		$this->phone 	= get_post_meta( $this->ID, "phone", TRUE );		
		$this->email 	= get_post_meta( $this->ID, "email", TRUE );		
		$this->notes 	= get_post_meta( $this->ID, "notes", TRUE );		
		$this->paid 	= get_post_meta( $this->ID, "paid", TRUE );		
		$this->hours 	= get_post_meta( $this->ID, "hours", TRUE );		
		$this->lanes 	= get_post_meta( $this->ID, "lanes" );		

		$this->bowlers 	= get_post_meta( $this->ID, "bowlers", TRUE );		
		$this->datefield = get_post_meta( $this->ID, "datefield", TRUE );		
	}

	public function sanitize_args() {

		if ( preg_match( "/^[0-9]{4}-[0-9]{2}-[0-9]{2}/", $this->args['date'] ) ) return;

		$this->args['date'] = date( 'Y' ) . '-' . date( 'm' ) . '-' . date( 'd' );

	}

	public function delete( ) {

		$this->clear_lanes();
		$this->date->deregister_reservation( $this->ID );
		wp_delete_post( $this->ID );

	}	

	public function clear_lanes( ) {

		foreach ( $this->lanes as $i ) {

			foreach ( $this->hours as $hour ) {

				echo $this->date->clear_lane_hour( $i, $hour );
			}

		}

	}

}
