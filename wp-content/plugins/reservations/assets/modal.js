jQuery( function( $ ) {

	$('#book-reservation-hours-menu li a').click( function() {

		$(this).toggleClass('dropdown-active').find('input').trigger('click');
		var price = 0;
		$('#book-reservation-lanes option').show();	
		$.each( $('.book-reservation-hours:checked'), function( index, value ) {
			price += parseInt($(value).next().find('.pricetag').html());
			if ( $(value).parent().find('.count').html() < 2 ) {
				$('#book-reservation-lanes option[value=2]').removeAttr('selected').hide();	
			}
		});
		price *= $('#book-reservation-lanes').val();
		$('#book-reservation-price').val('$' + price);
		$('#book-reservation-price-display').html('$' + price);
		//$('input[name=x_amount]').val(price);

	});

	$('#book-reservation-lanes').change( function() {
		return;
		var price = 0;
		$.each( $('.book-reservation-hours:checked'), function( index, value ) {
			price += parseInt($(value).next().find('.pricetag').html());
		});
		price *= $('#book-reservation-lanes').val();
		$('#book-reservation-price').val('$' + price);
		$('#book-reservation-price-display').html('$' + price);
		//$('input[name=x_amount]').val(price);
	});

	$('#book-reservation-price').change( function() {
	});

	$('.dropdown-menu, .dropdown-menu input, .dropdown-menu label').click(function(e) {
	    e.stopPropagation();
	});

	$('.book-reservation-hours').click( function() {

		$('#book-reservation-hours').val('test');

		var arr =  new Array();

		$.each( $('.book-reservation-hours:checked'), function( index, value ) {
	
			arr[index] = $(value).val();

		});

		var str = arr.join();

	});

	$('.dropdown-menu, .dropdown-menu input, .dropdown-menu label').click(function(e) {
	    e.stopPropagation();
	});

	$('.book-reservation-hours').click( function() {

		$('#book-reservation-hours').val('test');

		var arr =  new Array();

		$.each( $('.book-reservation-hours:checked'), function( index, value ) {
	
			arr[index] = $(value).val();

		});

		var str = arr.join();

		$('#book-reservation-hours').val(str);

	});

	var last_submission = 0;
	var active_submission = 0;
	$('#book-reservation-submit').unbind("click").click( function() {
		active_submission = 1;
		d = new Date();
		var this_submission = d.getTime();
		if( this_submission - last_submission < 10000 ) return;
		last_submission = this_submission;
		action	=	$('#book-reservation-action').val();
		name	= 	$('#book-reservation-name').val();
		company	= 	$('#book-reservation-company').val();
		phone	= 	$('#book-reservation-phone').val();
		email	= 	$('#book-reservation-email').val();
		notes	= 	$('#book-reservation-notes').val();
		date	= 	$('#book-reservation-date').val();
		lanes	= 	$('#book-reservation-lanes').val();
		bowlers	= 	$('#book-reservation-bowlers option:selected').val();
		hours	= 	$('#book-reservation-hours').val();

		error_field = $('#book-reservation-required-message');
		if ( name == '' ) { error_field.show().html('A name is required'); return; }
		else { error_field.hide(); }
		if ( email == '' ) { error_field.show().html('An email is required'); return; }
		else { error_field.hide(); }
		if ( phone == '' ) { error_field.show().html('A phone number is required'); return; }
		else { error_field.hide(); }
		if ( phone.replace(/ /g, '').replace(/-/g, '').length != 10 ) { error_field.show().html('The phone number appears invalid'); return; }
		else { error_field.hide(); }

		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(email)) { error_field.show().html('Please provide a valid email address'); email.focus; return false; }
		else { error_field.hide(); }

		var ajaxdata = {
			action:		$('#book-reservation-action').val(),
			name: 		$('#book-reservation-name').val(),
			company: 	$('#book-reservation-company').val(),
			phone: 		$('#book-reservation-phone').val(),
			email: 		$('#book-reservation-email').val(),
			notes: 		$('#book-reservation-notes').val(),
			date: 		$('#book-reservation-date').val(),
			lanes: 		$('#book-reservation-lanes').val(),
			bowlers: 	$('#book-reservation-bowlers option:selected').val(),
			hours: 		$('#book-reservation-hours').val(),
			web:		true
		};
		$.post( ajaxurl, ajaxdata, function(res){
			$('#book-reservation-result').html("The reservation has been updated.").html(res);
			var name = $('#book-reservation-name').val().split(' ');
			$('#book-reservation-close').trigger('click');
			$('#payment-button').trigger('click');
			$('#payment-first-name').val(name[0]);	
			$('#payment-last-name').val(name[1]);	
			$('#payment-company').val($('#book-reservation-company').val());	
			$('#payment-phone').val($('#book-reservation-phone').val());	
			$('#payment-email').val($('#book-reservation-email').val());	
			$('#payment-price').val($('#book-reservation-price').val());	
			//$('#RID').val(res);
			//$('#anf').trigger('click');
		});
	});

	$('#book-reservation-name, #book-reservation-phone, #book-reservation-email').blur( function() {
		if ($(this).val() == '') $(this).parent().addClass('has-error has-feedback');
		if ($(this).val() != '') $(this).parent().removeClass('has-error');
	});


});
