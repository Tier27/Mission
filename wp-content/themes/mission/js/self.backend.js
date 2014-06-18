( function( $ ) {
	$(document).keydown(function(e) {
		$('#myTest').html(e.keyCode);
		if( e.keyCode == '37' ) {
			selected.parent().after(selected.parent().prev());
		}
		if( e.keyCode == '39' ) {
			selected.parent().before(selected.parent().next());
		}
	});
	$('#myTest').html('html');
	//----//
	var selected = $('#myTest');
	$('.gallery-selectable').click(function() {
		$('#sampleDiv').append(this);
		var imageID = $(this).attr('image-id');
/*
		$('#gallery-images-input').val(
			$('#gallery-images-input').val() + imageID 
		);
*/
		selected = $(this);
		selected.toggleClass('selected');
		$(this).prev().toggleClass('selected');
		var thisBox = $('input[name=include-' + imageID + ']');
		thisBox.prop('checked', !thisBox.prop('checked'));
	});
})(jQuery);
