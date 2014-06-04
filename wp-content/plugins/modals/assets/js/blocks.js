jQuery(function($) {
	var activeImage = ''
	var activeBlock = '';
	var activeSet = '';
	function gallerySelect() {
		activeImage.attr('src', $(this).attr('src'));
		$('#gallery-dismiss').click();
		$(this).unbind('click', gallerySelect);
		var ajaxdata = {
			action:		'update_modal_image',
			imageID:	activeImage.attr('id'),
			attachmentID:	$(this).attr('data-id')
		};
		$.post( ajaxurl, ajaxdata, function(res) {
		});
	}
	$('.gallery-image').click(function(e) {
		//if ( ! e.ctrlKey ) return;
		activeImage = $(this);
		$('#gallery-button').trigger( "click" );
		$('.gallery-selectable').bind('click', gallerySelect);
	});
	$('.editable').dblclick( function() {
		activeBlock = $(this)	
		$('#block-button').trigger( "click" );
		$('#block-modal .modal-body').html( '<textarea class="form-control">' + $(this).html() + '</textarea>' ).css('color', 'black');
		$('#block-modal textarea').css('height', ($(this).height() + 20) + 'px');
	});
	$('#block-save').bind('click', function() {
		var ajaxdata = {
			action:		'modal_update_block',
			blockID:	activeBlock.attr('id'),
			blockContent:	$('#block-modal .modal-body textarea').val()
		};
		$.post( ajaxurl, ajaxdata, function(res) {
			activeBlock.html(res);
		});
	});

	$('.set').click(function() {
		activeSet = $(this);
		$('#set-button').trigger( "click" );
		$('#set-modal .modal-body').html('');
		$.each( $(this).find('.element'), function( index, value ) {
			image = $(this).find('.element-image').html();
			title = $(this).find('.element-title').html();
			content = $(this).find('.element-content').html();
			$('#set-modal .modal-body').append( "<div class='element'><span class='image'>" + image + "</span><input class='form-control title' value='" + title + "'><textarea class='form-control element-content'>" + content + "</textarea></div>" );
			$('#set-modal .modal-body .element-content').css('height', $(this).find('.element-content').css('height'));
		});
	});
	$('#set-save').bind('click', function() {
		setContent = new Array();
		$.each( $('#set-modal .element'), function( index, value ) {
			elementContent = new Array();
			elementContent.push( $(this).find('.image img').attr('data-id') );
			elementContent.push( $(this).find('.title').val() );
			elementContent.push( $(this).find('.element-content').val() );
			elementContent = elementContent.join('|||');
			setContent.push( elementContent );
		});
		setContent = setContent.join(':::');
		var ajaxdata = {
			action:		'modal_update_set',
			setID:		activeSet.attr('id'),
			setContent:	setContent
		};
		$.post( ajaxurl, ajaxdata, function(res) {
			alert(res);
		});
	});
	$.each( $('.element-content'), function( index, value ) {
		//$(this).html("<textarea class='form-control'>" + $(this).html() + "</textarea>");
	});
	
	$('.dom').click( function() {
		activeDom = $(this);
		$('#dom-button').trigger( "click" );
		$('#dom-modal .modal-body').html( $(this).contents().clone() );
	});
});
