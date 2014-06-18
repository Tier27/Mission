jQuery( function($) {
	var activeImage = '';
/*
	$('.editable').dblclick( function() {
		if( ! $(this).children().first().is('textarea') )  {
			$('#update-contents').removeClass('hide').removeClass('btn-success').addClass('btn-warning').attr( 'data-id', $(this).attr('id') ).insertAfter($(this));
			$(this).wrapInner("<textarea style='width: " + parseInt($(this).width()+10) + "px; height: " + parseInt($(this).height()+10) + "px'></textarea>");
		}
		else {
			$(this).html( $(this).find('textarea').html() );
		}
	}).hover(function() {
	});
*/
	$('#update-contents').click( function() {
		var ID = $(this).attr( 'data-id' );
		var contents = $('#' + ID ).find('textarea').val();
		var ajaxdata = {
			action:		'update_frontend_contents',
			ID:		ID,
			contents:	contents
		};
		$.post( ajaxurl, ajaxdata, function(res){
			$('#' + ID).trigger('dblclick').html(res);
			$('#update-contents').removeClass('btn-warning').addClass('btn-success').addClass('hide');
		});

	});
	$('#update-image-contents').click( function() {
		var ID = $(this).attr( 'data-id' );
		var contents = $('#' + ID ).attr('source-id');
		var ajaxdata = {
			action:		'update_frontend_contents',
			ID:		ID,
			contents:	contents
		};
		$.post( ajaxurl, ajaxdata, function(res){
			$('#' + ID).trigger('dblclick').html(res);
			$('#update-image-contents').removeClass('btn-warning').addClass('btn-success');
		});

	});
	$('.gallery-image').click( function() {
		activeImage = $(this);

//------//
		$('.gallery-selectable').click( function() {
			var selectedImageSRC = $(this).attr('src');
			var selectedImageID = $(this).attr('data-id');
			activeImage.attr('src', selectedImageSRC).attr('source-id', selectedImageID);
			$('#gallery-save').trigger('click');
		});
//------//

		$('#update-image-contents').removeClass('hide').removeClass('btn-success').addClass('btn-warning').attr( 'data-id', $(this).attr('id') ).insertAfter($(this)).css('z-index', '10').css('position', 'absolute');
		$('#gallery-button').trigger('click');
	});

	$('.contents').dblclick(function(e) {
		$('#set-button').trigger('click').insertAfter($(this));
		$('#setModal .modal-body').html('<div class="setname" data-id="' + $(this).attr('data-id') + '"></div>');
		$('#setModal .modal-title').html($(this).attr('data-id').toUpperCase());
		$.each( $(this).find('.q'), function( index, value) {
                        $('#setModal .modal-body').append('<div class="form-group element"><input type="email" class="form-control key" value="' + $(value).find('.qhead').text() + '"><br><textarea class="form-control value" rows="3">' + $(value).find('.answer').text() + '</textarea></div>');

		}); 
	});

	

});
