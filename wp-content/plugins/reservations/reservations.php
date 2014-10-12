<?php
/**
 * Plugin Name: Reservations
 * Plugin URI: http://tier27.com/
 * Description: A reservation system.
 * Version: 0.0.0.1
 * Author: Joshua Kornreich
 * Author URI: http://joshua-kornreich.com/
 * Text Domain: reservations 
 * Domain Path: languages
 *
 * Copyright 2014  Joshua Kornreich  ( email : joshua.kornreich@gmail.com )
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Connections; if not, see <http://www.gnu.org/licenses/>.
 *
 * @package Reservations
 * @category Core
 * @author Joshua Kornreich
 * @version 0.0.0.1
 */


/**
 * Main Reservations Class.
 *
 * @since now 
 */

require_once plugin_dir_path( __FILE__ ) . 'class.reservation.php';
require_once plugin_dir_path( __FILE__ ) . 'class.retrieve.php';
require_once plugin_dir_path( __FILE__ ) . 'class.settings.php';
require_once plugin_dir_path( __FILE__ ) . 'class.format.php';
require_once plugin_dir_path( __FILE__ ) . 'class.ajax.php';
require_once plugin_dir_path( __FILE__ ) . 'class.api.php';
require_once plugin_dir_path( __FILE__ ) . 'class.query.php';
require_once plugin_dir_path( __FILE__ ) . 'class.html.php';
require_once plugin_dir_path( __FILE__ ) . 'class.output.php';
require_once plugin_dir_path( __FILE__ ) . 'class.process.php';
require_once plugin_dir_path( __FILE__ ) . 'class.forms.php';
require_once plugin_dir_path( __FILE__ ) . 'class.sanitize.php';
require_once plugin_dir_path( __FILE__ ) . 'class.data.php';
require_once plugin_dir_path( __FILE__ ) . 'class.wordpress.php';
require_once plugin_dir_path( __FILE__ ) . 'class.date.php';

reservationsLoad::init();

class reservationsLoad {


	public function init() {

		self::initReservationsType();
//		new rvProcess();
		wp_enqueue_script( 'modal-js' , plugins_url() . "/reservations/assets/modal.js", array( 'jquery' ), '1.01', TRUE );
//		wp_enqueue_script( 'subscript-js' , plugins_url() . "/reservations/assets/subscript.js", array( 'jquery' ), '1.01', TRUE );
		wp_enqueue_script( 'reservations-js' , plugins_url() . "/reservations/assets/reservations.js", array( 'jquery' ), '1.01', TRUE );
		wp_enqueue_style( 'reservations-css' , plugins_url() . "/reservations/assets/reservations.css", '1.01' );


	}


	public function initReservationsType() {

	
		

		function initReservations() {
		  $labels = array(
		    'name'               => 'Reservations',
		    'singular_name'      => 'Reservation',
		    'add_new'            => 'Add New',
		    'add_new_item'       => 'Add New Reservation',
		    'edit_item'          => 'Edit Reservation',
		    'new_item'           => 'New Reservation',
		    'all_items'          => 'All Reservations',
		    'view_item'          => 'View Reservation',
		    'search_items'       => 'Search Reservations',
		    'not_found'          => 'No reservations found',
		    'not_found_in_trash' => 'No reservations found in Trash',
		    'parent_item_colon'  => '',
		    'menu_name'          => 'Reservations'
		  );

		  $args = array(
		    'labels'             => $labels,
		    'public'             => true,
		    'publicly_queryable' => true,
		    'show_ui'            => true,
		    'show_in_menu'       => false,
		    'query_var'          => true,
		    'rewrite'            => array( 'slug' => 'review' ),
		    'capability_type'    => 'post',
		    'has_archive'        => true,
		    'hierarchical'       => false,
		    'menu_position'      => null,
		    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		  );

		  register_post_type( 'reservation', $args );
		}

		add_action( 'init', 'initReservations' );

	}
	
}
