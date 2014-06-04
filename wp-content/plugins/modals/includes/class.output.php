<?php 

class moOutput {

	public function image( $atts ) {

		$width = ( isset( $atts['width'] ) ) ? $atts['width'] : 100;
		$height = ( isset( $atts['height'] ) ) ? $atts['height'] : 100;
		$alt = ( isset( $atts['alt'] ) ) ? $atts['alt'] : 'Image';
		$class = ( isset( $atts['class'] ) ) ? $atts['class'] : '';
		$id = ( isset( $atts['id'] ) ) ? $atts['id'] : 'default';

		$widthField = ( is_array( $width ) ) ? '' : "width=$width";
		$heightField = ( is_array( $height ) ) ? '' : "height=$height";

		$post = get_option( 'modals_images_post' );
		$srcID = ( $meta = get_post_meta( $post, $id, true ) ) ? $meta : get_post_meta( $post, 'default', true );
		$src = wp_get_attachment_url( $srcID );
		if ( moLibrary::isSiteAdmin() ) $class .= ' gallery-image';

		echo "<img class='$class' id='$id' data-id='$srcID' $widthField $heightfield src='$src' alt='$alt'>";

	}

	public function content( $atts ) {

		$content = ( isset( $atts['content'] ) ) ? $atts['content'] : 'Default content';
		$id = ( isset( $atts['id'] ) ) ? $atts['id'] : 'default';
		$content = ( $self = get_post_meta( get_option( 'modals_blocks_post' ), $id, true ) ) ? $self : $content;
		$tag = ( isset( $atts['tag'] ) ) ? $atts['tag'] : 'div';

		$class = ( isset( $atts['class'] ) ) ? $atts['class'] : '';
		if ( moLibrary::isSiteAdmin() ) $class .= ' editable';

		$str =  "<$tag class='$class' id='$id'>";
		$str .= $content;
		$str .= "</$tag>\n";
		echo $str;

	}

}
