jQuery( function( $ ) {

	$('.filled').hover( function() {
		$(this).toggleClass('opaque');
	}).click( function() {
		$('#modal-button').hide().trigger( 'click' );
		$('#manage-reservation-name').val($(this).find('.name').contents().html());
		$('#manage-reservation-company').val($(this).find('.company').html());
		$('#manage-reservation-phone').val($(this).find('.phone').html());
		$('#manage-reservation-email').val($(this).find('.email').html());
		$('#manage-reservation-notes').val($(this).find('.notes').html());
		$('#manage-reservation-id').val($(this).find('.id').html());
		$('#manage-reservation-paid').val($(this).find('.paid').html());
		//$('#manage-reservation-bowlers').($(this).find('.bowlers').html());
		var bowlers = $(this).find('.bowlers').html();
		$('#manage-reservation-bowlers option[value="' + bowlers + '"]').prop('selected', true);
	});



});

