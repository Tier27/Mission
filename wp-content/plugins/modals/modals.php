<?php
/**
 * @package Modals
 * @version 0.1
 */
/*
Plugin Name: Modals
Plugin URI: http://plugins.tier27.com/modals/
Description: A front end content manager using Bootstrap modals
Author: Joshua Kornreich
Version: 0.1
Author URI: http://plugins.tier27.com/
*/

define("MODALS_PATH", plugin_dir_path( __FILE__ ));
define("MODALS_ASSETS", plugins_url( 'assets', __FILE__ ));

require_once( MODALS_PATH . "includes/class.modals.php" ); 
require_once( MODALS_PATH . "includes/class.ajax.php" ); 
require_once( MODALS_PATH . "includes/class.output.php" ); 
require_once( MODALS_PATH . "includes/class.library.php" ); 
require_once( MODALS_PATH . "lib/simple_html_dom.php" );

wp_enqueue_script( 'bootstrap-js' , MODALS_ASSETS . "/js/bootstrap.js", array( 'jquery' ), '1.01', TRUE );
wp_enqueue_script( 'library-js' , MODALS_ASSETS . "/js/library.js", array( 'jquery' ), '1.01', TRUE );
wp_enqueue_script( 'blocks-js' , MODALS_ASSETS . "/js/blocks.js", array( 'jquery' ), '1.01', TRUE );
//wp_enqueue_style( 'bootstrap-css' , MODALS_ASSETS . "/css/bootstrap.css", '1.01' );
wp_enqueue_style( 'modals-css' , MODALS_ASSETS . "/css/modals.css", '1.01' );

class modalsLoad {

	public function instance() {

		register_activation_hook( dirname( __FILE__ ) . '/modals.php', array( __CLASS__, 'activate' ) );

	}

	public function activate() {

		self::allocate_images();
		self::allocate_blocks();
		self::allocate_sets();
		self::allocate_doms();
	
	}

	public function allocate( $type ) {

		if ( get_option( "modals_" . $type . "_post" ) ) return;

		$modals_type = array(
		  'post_title'    => 'Modal ' . ucfirst( $type ),
		  'post_content'  => '',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		);

		$modals_type_post = wp_insert_post( $modals_type );

		add_option( "modals_" . $type . "_post", $modals_type_post );


	}

	public function allocate_images() {

		self::allocate( 'images' );
		return;
		if ( get_option( "modals_images_post" ) ) return;

		$modals_images = array(
		  'post_title'    => 'Modal Images',
		  'post_content'  => '',
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		);

		$modals_images_post = wp_insert_post( $modals_images );

		add_option( "modals_images_post", $modals_images_post );


	}

	public function allocate_blocks() {

		self::allocate( 'blocks' );

	}

	public function allocate_sets() {

		self::allocate( 'sets' );

	}

	public function allocate_doms() {

		self::allocate( 'doms' );

	}

}

modalsLoad::instance();

?>
