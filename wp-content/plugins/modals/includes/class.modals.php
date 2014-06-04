<?php

class Modal {

	public $ID;
	public $class;
	public $name;
	public $title;
	public $script;
	public function __construct( $args ) {

		$this->class = ( isset( $args['class'] ) ) ? $args['class'] : $this->class;
		$this->ID = ( isset( $args['class'] ) ) ? $args['class'] : $this->class;
		$this->name = ( isset( $args['name'] ) ) ? $args['name'] : ucwords( $this->class );
		$this->title = ( isset( $args['title'] ) ) ? $args['title'] : ucwords( $this->class );
		$this->buttons = ( isset( $args['buttons'] ) ) ? $args['buttons'] : "";
		$this->generateModal();
		$this->wrapScript();
		$this->outputScript();

	}

	public function generateModal( ) { 

	echo "\n<button class=\"btn btn-primary btn-lg hide\" data-toggle=\"modal\" id=\"$this->ID-button\" data-target=\"#$this->ID-modal\">$this->name</button>\n";
	echo "<div class=\"modal fade\" id=\"$this->ID-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"$this->ID" . "-label\" aria-hidden=\"true\">\n";
	echo "  <div class=\"modal-dialog\">\n";
	echo "    <div class=\"modal-content\">\n";
	echo "      <div class=\"modal-header\">\n";
	echo $this->generateHeader(); 
	echo "      </div>\n";
	echo "      <div class=\"modal-body\">\n";
	echo $this->body(); 
	echo "      </div>\n";
	echo "      <div class=\"modal-footer\">\n";
	echo $this->footer(); 
	echo "      </div>\n";
	echo "    </div>\n";
	echo "  </div>\n";
	echo "</div>\n";
	
	}

	public function generateHeader() { 

		$header = '';
		$header .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		$header .= '<h4 class="modal-title" id="' . $this->ID . '-label">' . $this->title . '</h4>';
		return $header;

	}

	public function body( ) {

		switch ($this->class) {
		
			case "gallery":
				return $this->gallery_body();
				break;
		}

	}

	public function gallery_body() {

		$content = '';
		$content .= '<form method="post" action="#" enctype="multipart/form-data" >';
		$content .= '<input type="file" name="featured_image" class="hide" id="uploaded-image">';
		$content .= '<input type="submit" id="upload-image-submit" class="hide">';
		$content .= '</form>';
		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
		if ( isset( $_FILES['featured_image'] ) ) {
		$file_return = wp_handle_upload($_FILES['featured_image'], array('test_form' => FALSE));
			if( ! isset($file_return['error']) ) {
				$filename = $file_return['file'];
				$attachment = array(
					'post_mime_type' => $file_return['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
					'post_content' => '',
					'post_status' => 'inherit',
					'guid' => $file_return['url']
				);
				$attach_id = wp_insert_attachment( $attachment, $file_return['url'] );
			}
		}
                $images = self::get_gallery_images();
                $content .= "<ul class='gallery'>";
                foreach( $images as $image ) {
                        $content .= "<li><img class='gallery-selectable' src='$image->guid' data-id='$image->ID' width=100 height=100 alt='gallery-$image->id'></li>";
                }
                $content .= "</ul>";
		$this->appendScript( "$('#$this->ID-add').click( function() {\n
			$('#uploaded-image').trigger('click');\n
		});\n" );
		return $content;

	}

	public function footer( ) {

		switch ($this->class) {
		
			case "gallery":
				return $this->gallery_footer();
				break;

			case "block":
				return $this->block_footer();
				break;

			case "set":
				return $this->set_footer();
				break;
		
			case "dom":
				return $this->dom_footer();
				break;

		}

	}

	public function gallery_footer() {

		echo "<button type=\"button\" class=\"btn btn-default\" id=\"$this->ID-dismiss\" data-dismiss=\"modal\">Close</button>\n";
		echo "<button type=\"button\" class=\"btn btn-warning\" id=\"$this->ID-delete\">Delete from $this->ID</button>\n";
		echo "<button type=\"button\" class=\"btn btn-primary\" id=\"$this->ID-add\">Add to $this->ID</button>";
		echo "<button type=\"button\" class=\"btn btn-success hide\" id=\"$this->ID-confirm\">Confirm addition</button>";
		$this->appendScript( "$('#uploaded-image').change( function() {\n
			$('#$this->ID-confirm').removeClass('hide');\n
		});\n" );
		$this->appendScript( "$('#$this->ID-confirm').click( function() {\n
			$('#upload-image-submit').trigger('click');\n
		});\n" );
		$this->appendScript( "$('#$this->ID-delete').click( function() {\n
			$(this).removeClass('btn-warning').addClass('btn-danger');\n
			$('.gallery-selectable').bind('click', markForDeletion);\n
		});\n" );

	}

	public function block_footer() {

		echo "<button type=\"button\" class=\"btn btn-default\" id=\"$this->ID-dismiss\" data-dismiss=\"modal\">Close</button>\n";
		echo "<button type=\"button\" class=\"btn btn-success\" id=\"$this->ID-save\" data-dismiss=\"modal\">Save</button>";

	}

	public function set_footer() {

		echo "<button type=\"button\" class=\"btn btn-default\" id=\"$this->ID-dismiss\" data-dismiss=\"modal\">Close</button>\n";
		echo "<button type=\"button\" class=\"btn btn-primary\" id=\"$this->ID-add\">Add</button>";
		echo "<button type=\"button\" class=\"btn btn-success\" id=\"$this->ID-save\" data-dismiss=\"modal\">Save</button>";

	}

	public function dom_footer() {

		echo "<button type=\"button\" class=\"btn btn-default\" id=\"$this->ID-dismiss\" data-dismiss=\"modal\">Close</button>\n";
		echo "<button type=\"button\" class=\"btn btn-success\" id=\"$this->ID-save\" data-dismiss=\"odal\">Save</button>";

	}

	public static function get_gallery_images() {

		$args = array(
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'posts_per_page' => -1,
		);

		return get_posts( $args );

	}

	public function appendScript( $script ) {

		$this->script .= $script;

	}


	public function wrapScript() {

		$this->script = "<script>\njQuery(function($){\n" . $this->script . "});\n</script>";

	}

	public function outputScript() {

		echo $this->script;

	}
}

?>
