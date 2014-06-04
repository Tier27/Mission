function gallery_alt() {
	jQuery('#image-set-button').trigger('click');
	jQuery('#imageSetModal .modal-body').html('<div class="setname" data-id="' + jQuery('.image-contents').attr('data-id') + '"></div>');
	jQuery('#imageSetModal .modal-title').html(jQuery('.image-contents').attr('data-id').toUpperCase().replace('-',' '));
	jQuery('.image-contents').clone().removeClass('menu').addClass('gallery').sortable().disableSelection().appendTo('#imageSetModal .modal-body');
}

function deleteImage() {
	var imageID = jQuery(this).attr('data-id')
	var ajaxdata = {
		action:		'trash_gallery_image',
		imageID:		imageID,
	};

	jQuery.post( ajaxurl, ajaxdata, function(res){
		jQuery('.gallery-selectable').filter( function() { return jQuery(this).attr('data-id') == imageID } ).parent().hide();
	});
	jQuery(this).unbind('click', deleteImage).html('Delete from gallery').removeClass('btn-danger').addClass('btn-warning');
}

function markForDeletion() {
	jQuery(this).addClass('deletable');
	jQuery('#gallery-delete').html('Confirm').attr('data-id', jQuery(this).attr('data-id')).bind('click', deleteImage);
	jQuery('.gallery-selectable').unbind('click', markForDeletion);
}

