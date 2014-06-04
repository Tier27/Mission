<?php

class moAjax {

	function trash_gallery_image() {
		$post = get_post( $_POST['imageID'] );
		if ( $post->post_type == 'attachment' ) wp_trash_post( $_POST['imageID'] );
		die();
	}

	function update_modal_image() {

		echo update_post_meta( get_option( 'modals_images_post' ), $_POST['imageID'], $_POST['attachmentID'] );
		die();

	}

	public function modal_update_block() {

		update_post_meta( get_option( 'modals_blocks_post' ), $_POST['blockID'], $_POST['blockContent'] );
		echo get_post_meta( get_option( 'modals_blocks_post' ), $_POST['blockID'], true );
		die();

	}

	public function modal_update_set() {

		$setContent = explode(':::', $_POST['setContent']);
		$array = array();
		foreach ( $setContent as $content ) {
			$array[] = explode('|||', $content);
		}
		$setContent = $array;
//		print_r( $setContent );
		update_post_meta( get_option( 'modals_sets_post' ), $_POST['setID'], $setContent );
		print_r( get_post_meta( get_option( 'modals_sets_post' ), $_POST['setID'], true ) );
		die();

	}

}

add_action('wp_ajax_trash_gallery_image', array( 'moAjax', 'trash_gallery_image' ) );
add_action('wp_ajax_update_modal_image', array( 'moAjax', 'update_modal_image' ) );
add_action('wp_ajax_modal_update_block', array( 'moAjax', 'modal_update_block' ) );
add_action('wp_ajax_modal_update_set', array( 'moAjax', 'modal_update_set' ) );
?>
