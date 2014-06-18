jQuery( function( $ ) {


	//$('.filled').css( 'padding-left', '10px' );
	$('.filled').unbind('mouseenter').unbind('mouseleave').unbind('click').hover( function() {
		var ID = $(this).find('.id').html();
		$.each( $('.filled'), function( index, value ) {
			if ( $(value).find('.id').html() == ID ) {
				$(value).toggleClass('opaque');
			}
		});
	}).click( function() {
		$('#modal-button').hide().trigger( 'click' );
		$('#manage-reservation-date').val($('#reportrange').val());
		$('#manage-reservation-name').val($(this).find('.name').contents().html());
		$('#manage-reservation-company').val($(this).find('.company').html());
		$('#manage-reservation-phone').val($(this).find('.phone').html());
		$('#manage-reservation-email').val($(this).find('.email').html());
		$('#manage-reservation-status').val($(this).find('.status').html());
		if( $('#manage-reservation-status').val() == 'paid' ) {
			$('#delete-reservation').hide();
		}
		else {
			$('#delete-reservation').show();
		}
		$('#manage-reservation-notes').val($(this).find('.notes').html());
		$('#manage-reservation-id').val($(this).find('.id').html());
		$('#manage-reservation-price').val($(this).find('.price').html());
		$('#manage-reservation-paid').val($(this).find('.balance-paid').html());
		var lanes = $(this).find('.lanes').html();
		$('#manage-reservation-lanes option[value="' + lanes + '"]').prop('selected', true);
		var bowlers = $(this).find('.bowlers').html();
		$('#manage-reservation-bowlers option[value="' + bowlers + '"]').prop('selected', true);
		var hours = $(this).find('.hours').html();
		hours = hours.split( ',' );
		$('#manage-reservation-hours').val( hours );
		$('.manage-reservation-hours:checked').parent().trigger('click');
		$.each( hours, function( index, value ) {
			$('.manage-reservation-hours[value="' + value + '"]').parent().trigger('click');
		});
		bool = $.inArray( '14', hours );
		$('#dropdownMenu2').html(bool);
	});

});

