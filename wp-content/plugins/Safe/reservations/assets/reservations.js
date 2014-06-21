jQuery( function( $ ) {

	$('#action').val( 'add_reservation' );

	$('.reservations .submit, #cnb').click(function(e) { 
		e.preventDefault();

		$(this).html($('#name').val());
		var ajaxdata = {
			action: 	$('#action').val(),
			hours: 		$('#hours').val(),
			name: 		$('#name').val(),
			company: 	$('#company').val(),
			phone: 		$('#phone').val(),
			email: 		$('#email').val(),
			notes: 		$('#notes').val(),
			paid: 		$('#paid').val(),
			date: 		$('#date').val(),
			lanes: 		$('#lanes').val(),
			bowlers: 	$('#bowlers').val(),
		};
		
		$.post( ajaxurl, ajaxdata, function(res){
			$('#cnb-result').html(res);

			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$('#date').val()	
			};

			$('.tab').hide();

			$('#calendar').show();

			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
			});

		});
	});

//	$('#reservation-target').hide();

//	$('#calendar-target').hide();

	$('.tab').hide();

//	$('#calendar').show();

	$('#reservation').show();

	$('#reservation-trigger').click(function(e) { 

		$('.tab').hide();
		$('#reservation').show();
		$(this).addClass('active');

	});

	$('#calendar-trigger').click(function(e) { 

		$('.nav-tabs li a').removeClass('active');
		$('.tab').hide();
		$('#calendar').show();
		$(this).addClass('active');

	});

	$('#hours-menu li a').click( function() {

		$(this).toggleClass('dropdown-active').find('input').trigger('click');

	});

	$('.hours').click( function() {

		$('#hours').val('test');

		var arr =  new Array();

		$.each( $('.hours:checked'), function( index, value ) {
	
			arr[index] = $(value).val();

		});

		var str = arr.join();
		$('#hours').val(str);

	});

                $('#reportrange').datepicker().change(function() {

			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$(this).val()
			};
		
			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
			});

                });

	$('.dropdown-menu, .dropdown-menu input, .dropdown-menu label').click(function(e) {
	    e.stopPropagation();
	});

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

	$('.update').click( function() {

		var modal = $.modal;
		var ajaxdata = {
			action:		$('#manage-reservation-action').val(),
			ID: 		$('#manage-reservation-id').val(),
			name: 		$('#manage-reservation-name').val(),
			company: 		$('#manage-reservation-company').val(),
			phone: 		$('#manage-reservation-phone').val(),
			email: 		$('#manage-reservation-email').val(),
			notes: 		$('#manage-reservation-notes').val(),
			paid: 		$('#manage-reservation-paid').val(),
			date: 		$('#manage-reservation-date').val(),
			bowlers: 	$('#manage-reservation-bowlers option:selected').val()
		};
		
		$.post( ajaxurl, ajaxdata, function(res){
			$('#manage-reservation-result').html("The reservation has been updated.");
			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$('#date').val()	
			};


			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
				$.getScript( "http://192.168.2.21/wordpress/mbc/wp-content/plugins/reservations/assets/subscript.js?ver=1.01" )
				  .done(function( script, textStatus ) {
				    console.log( textStatus );
				  })
				  .fail(function( jqxhr, settings, exception ) {
				    $( "div.log" ).text( "Triggered ajaxError handler." );
				});
			modal.close();
			});
		});

	});

	$('#calendar-target').click( function() {
		$.getScript( "http://192.168.2.21/wordpress/mbc/wp-content/plugins/reservations/assets/subscript.js?ver=1.01" )
		  .done(function( script, textStatus ) {
		    console.log( textStatus );
		  })
		  .fail(function( jqxhr, settings, exception ) {
		    $( "div.log" ).text( "Triggered ajaxError handler." );
		});
	});

	$('#close-modal').click( function() {
		$.getScript( "http://192.168.2.21/wordpress/mbc/wp-content/plugins/reservations/assets/subscript.js?ver=1.01" )
		  .done(function( script, textStatus ) {
		    console.log( textStatus );
		  })
		  .fail(function( jqxhr, settings, exception ) {
		    $( "div.log" ).text( "Triggered ajaxError handler." );
		});
		$('.filled').removeClass('opaque');
	});

	$('.money').blur( function() {
		if ( $(this).val().substr(0, 1) != '$' ) {
			$(this).val( '$' + $(this).val() );
		}
		var length = $(this).val().length;
		if ( $(this).val().substr( length-3, 1 ) != '1' ) {
			$(this).val( $(this).val() + '.00' );
		}
	});

});
