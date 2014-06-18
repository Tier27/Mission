function gallery_alt() {
	$('#image-set-button').trigger('click');
	$('#imageSetModal .modal-body').html('<div class="setname" data-id="' + $('.image-contents').attr('data-id') + '"></div>');
	$('#imageSetModal .modal-title').html($('.image-contents').attr('data-id').toUpperCase().replace('-',' '));
	$('.image-contents').clone().removeClass('menu').addClass('gallery').sortable().disableSelection().appendTo('#imageSetModal .modal-body');
}

function deleteImage() {
	var imageID = $(this).attr('data-id')
	var ajaxdata = {
		action:		'trash_gallery_image',
		imageID:		imageID,
	};

	$.post( ajaxurl, ajaxdata, function(res){
		$('.gallery-selectable').filter( function() { return $(this).attr('data-id') == imageID } ).parent().hide();
	});
	$(this).unbind('click', deleteImage).html('Delete Image');
}

function markForDeletion() {
	$(this).addClass('deletable');
	$('#gallery-delete').html('Confirm').attr('data-id', $(this).attr('data-id')).bind('click', deleteImage);
	$('.gallery-selectable').unbind('click', markForDeletion);
}

