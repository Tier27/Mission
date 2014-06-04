jQuery( function( $ ) {

	$('#action').val( 'add_reservation' );

	$('.reservations .submit, #cnb').click(function(e) { 
		e.preventDefault();

		var ajaxdata = {
			action: 	$('#action').val(),
			hours: 		$('#hours').val(),
			name: 		$('#name').val(),
			company: 	$('#company').val(),
			phone: 		$('#phone').val(),
			email: 		$('#email').val(),
			status: 	$('#status').val(),
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

/*
			$('.tab').hide();

			$('#calendar').show();
*/

			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
				//$('#hours').val('');
				$('#hours-buttons button').filter( function() { return $(this).hasClass('dark'); } ).trigger('click');
				$('#name').val('');
				$('#company').val('');
				$('#phone').val('');
				$('#email').val('');
				$('#status').val('hold');
				$('.status').removeClass('bordered');
				$('.hold').addClass('bordered');
				$('#notes').val('');
				$('#paid').val('');
				$('#lanes').val('1');
				$('#bowlers').val('1');
				$.getScript( subscript )
				  .done(function( script, textStatus ) {
				    console.log( textStatus );
				  })
				  .fail(function( jqxhr, settings, exception ) {
				    $( "div.log" ).text( "Triggered ajaxError handler." );
				});
				//$.getScript( hourscript );

			});

		});
	});

//	$('#reservation-target').hide();

//	$('#calendar-target').hide();

	$('.tab').hide();

	$('#calendar').show();

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

	$('#manage-reservation-hours-menu li a').click( function() {

		$(this).toggleClass('dropdown-active').find('input').trigger('click');

	});

	$('.btn-group .hours').click( function() {

		$('#anchor-' + $(this).find('input').val()).trigger('click');

	});

	$('.btn-group .manage-reservation-hours').click( function() {

		$('#manage-reservation-anchor-' + $(this).find('input').val()).trigger('click');

	});

	$('.hours, #lanes').click( function() {

		$('#lanes option').show();
		$('#hours').val('test');

		var arr =  new Array();
		var price = 0;

		$.each( $('.hours:checked'), function( index, value ) {
	
			price += parseInt($(value).attr('data-price'));
			arr[index] = $(value).val();

			$.each( $('#lanes option'), function( index, umSecondValue ) {

				if ( $(umSecondValue).val() > $(value).parent().find('.count').html() ) {
					$(umSecondValue).hide();
				}

			});


		});

		var str = arr.join();
		$('#hours').val(str);
		price *= $('#lanes').val();
		$('#price').val(price);
		if( paid == true ) $('#paid').val('$'+$('#price').val() + '.00');
		$('#price-display').html('$'+price);

	});

	$('#manage-reservation-hours-menu a').click( function() {
		$('#manage-reservation-button-'+($(this).attr('id').substr( 26, $(this).attr('id').length))).toggleClass('dark');
	});

	$('#hours-menu a').click( function() {
		$('#button-'+($(this).attr('id').substr( 7, $(this).attr('id').length))).toggleClass('dark');
	});

	$('.book-reservation-hours').click( function() {

		$('#book-reservation-lanes option').show();
		$('#hours').val('test');

		var arr =  new Array();

		$.each( $('.hours:checked'), function( index, value ) {
	
			arr[index] = $(value).val();

			$.each( $('#lanes option'), function( index, umSecondValue ) {

				if ( $(umSecondValue).val() > $(value).parent().find('.count').html() ) {
					$(umSecondValue).hide();
				}

			});


		});

		var str = arr.join();
		$('#hours').val(str);

	});


	$('.manage-reservation-hours').click( function() {

		$('#manage-reservation-hours').val('test');

		var arr =  new Array();

		$.each( $('.manage-reservation-hours:checked'), function( index, value ) {
	
			arr[index] = $(value).val();

		});

		var str = arr.join();

		$('#manage-reservation-hours').val(str);

	});
/*
                $('#reportrange').datepicker().change(function() {

			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$(this).val()
			};
		
			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
				$.getScript( subscript )
			});

                });
*/
	$('.dropdown-menu, .dropdown-menu input, .dropdown-menu label').click(function(e) {
	    e.stopPropagation();
	});
/*
	$('.filled').hover( function() {
		$(this).toggleClass('opaque');
	}).click( function() {
		$('#modal-button').hide().trigger( 'click' );
		$('#manage-reservation-name').val($(this).find('.name').contents().html());
		$('#manage-reservation-company').val($(this).find('.company').html());
		$('#manage-reservation-phone').val($(this).find('.phone').html());
		$('#manage-reservation-email').val($(this).find('.email').html());
		$('#manage-reservation-status').val($(this).find('.status').html());
		$('#manage-reservation-notes').val($(this).find('.notes').html());
		$('#manage-reservation-id').val($(this).find('.id').html());
		$('#manage-reservation-paid').val($(this).find('.balance-paid').html());
		//$('#manage-reservation-bowlers').($(this).find('.bowlers').html());
		var lanes = $(this).find('.lanes').html();
		$('#manage-reservation-lanes option[value="' + lanes + '"]').prop('selected', true);
		var bowlers = $(this).find('.bowlers').html();
		$('#manage-reservation-bowlers option[value="' + bowlers + '"]').prop('selected', true);
		var hours = $(this).find('.hours').html();
		hours = hours.split( ',' );
		$('#manage-reservation-hours').val( hours );
		$('.manage-reservation-hours').prop("checked", false).parent().removeClass( 'dropdown-active' );
		$.each( hours, function( index, value ) {
			$('.manage-reservation-hours[value="' + value + '"]').prop("checked", true).parent().toggleClass( 'dropdown-active' );
		});
		bool = $.inArray( '14', hours.split( ',' ) );
		$('#dropdownMenu2').html(bool);
	});
*/

	$('.update').click( function() {

		var modal = $.modal;
		var ajaxdata = {
			action:		$('#manage-reservation-action').val(),
			ID: 		$('#manage-reservation-id').val(),
			name: 		$('#manage-reservation-name').val(),
			company: 		$('#manage-reservation-company').val(),
			phone: 		$('#manage-reservation-phone').val(),
			email: 		$('#manage-reservation-email').val(),
			status:		$('#manage-reservation-status').val(),
			notes: 		$('#manage-reservation-notes').val(),
			paid: 		$('#manage-reservation-paid').val(),
			date: 		$('#manage-reservation-date').val(),
			lanes: 		$('#manage-reservation-lanes').val(),
			bowlers: 	$('#manage-reservation-bowlers option:selected').val(),
			hours: 		$('#manage-reservation-hours').val()
		};
		
		$.post( ajaxurl, ajaxdata, function(res){
			$('#manage-reservation-result').html("The reservation has been updated.").html(res);
			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$('#manage-reservation-date').val()	
			};


			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
				$.getScript( subscript )
			modal.close();
			});
		});

	});

	$('#cancel-reservation').unbind("click").click( function() {
		var ajaxdata = {
			action:		'cancel_reservation',
			id:		$('#manage-reservation-id').val()
		};
		$.post( ajaxurl, ajaxdata, function(res) {
	//		$.post( ajaxurl, ajaxdata, function(res){
				$('#manage-reservation-result').html("The reservation has been updated.").html(res);
				var ajaxdata = {
					action: 	'print_calendar_contents',
					date:		$('#date').val()	
				};

				$.post( ajaxurl, ajaxdata, function(res){
					$('#calendar-target').html(res);
					$.getScript( subscript )
					modal.close();
	//			});
			});
		});
	});
	$('#delete-reservation').click( function() {
		var ajaxdata = {
			action:		'delete_reservation',
			id:		$('#manage-reservation-id').val()
		};
		$.post( ajaxurl, ajaxdata, function(res) {
			$.post( ajaxurl, ajaxdata, function(res){
				$('#manage-reservation-result').html("The reservation has been updated.").html(res);
				var ajaxdata = {
					action: 	'print_calendar_contents',
					date:		$('#date').val()	
				};

				$.post( ajaxurl, ajaxdata, function(res){
					$('#calendar-target').html(res);
					$.getScript( subscript )
					modal.close();
				});
			});
		});
	});

	$('#calendar-target').click( function() {
		$.getScript( subscript )
		  .done(function( script, textStatus ) {
		    console.log( textStatus );
		  })
		  .fail(function( jqxhr, settings, exception ) {
		    $( "div.log" ).text( "Triggered ajaxError handler." );
		});
	});

	$('#myModal').on('hidden.bs.modal', function() {
		$.getScript( subscript )
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
		if ( $(this).val().substr( length-3, 1 ) != '.' ) {
			$(this).val( $(this).val() + '.00' );
		}
	});

	$('#manage-reservation-paid').blur( function() {
		if ( $('#manage-reservation-status').val() == 'reserve' ) return;
		var paid = $(this).val();
		if ( paid.substr( 0, 1 ) == '$' ) {

			paid = paid.substr( 1, paid.length );

		}
		var price = $('#manage-reservation-price').val();
		if ( price - paid == 0 ) {
			$('#manage-reservation-status').val('paid');
			$('#myModal').find('.hold').hide();
		}
		else { 
			$('#myModal').find('.hold').show();
			$('#manage-reservation-status').val('hold');
		}
	});

	$('#sample-data').click( function(e) {
		e.preventDefault();
		$('#hours-menu').find('.hours[value=15]').parent().trigger('click');
		$('#hours-menu').find('.hours[value=16]').parent().trigger('click');
		$('#name').val('Joshua');
		$('#company').val('Tier 27');
		$('#phone').val('954 882 3115');
		$('#email').val('joshua.kornreich@gmail.com');
		$('#notes').val('Some notes.');
		$('#paid').val('$10.00');
		$('#lanes').val('1');
		$('#bowlers').val('1');
	});

	$('.status').click( function() {
		$('.status').removeClass('bordered');
		//$(this).addClass('bordered');
		$('#status, #manage-reservation-status').val($(this).attr('data-value'));
		if( $(this).attr('data-value') == 'paid' ) $('#manage-reservation-paid').val('$'+$('#manage-reservation-price').val() + '.00');
	});

	var paid = false;
	$('#reservation .paid').click( function() {
		paid = true;
		$('#paid').val('$'+$('#price').val() + '.00');
	});

	$('body').click( function() {
	$('.ui-datepicker-calendar td').hover( function(e) {
		if ( ! e.ctrlKey ) { return; }
		$('#future').removeClass('hide');
		month = $(this).attr('data-month');
		month = parseInt(month)+1;
		if ( month < 10 ) month = '0' + month;
		day = $(this).find('a').html();
		if ( parseInt(day) < 10 ) day = '0' + day;
		var datefield = month + '/' + day + '/' + $(this).attr('data-year');

		var ajaxdata = {
			action: 	'update_future',
			datefield:	datefield	
		};
		$.post( ajaxurl, ajaxdata, function(res){
			$('#future').html(res);
		});

	});
	});
	$('#future').click( function() {
		$(this).addClass('hide');
	});

	$('#reportrange').hover( function() {
		var datefield = $(this).val();
		var ajaxdata = {
			action: 	'update_future',
			datefield:	datefield	
		};

		$.post( ajaxurl, ajaxdata, function(res){
			$('#future').html(res);
		});
	});

	function calRefresh() { 
			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$('#reportrange').val()	
			};


			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
				$.getScript( subscript )
				  .done(function( script, textStatus ) {
				    console.log( textStatus );
				  })
				  .fail(function( jqxhr, settings, exception ) {
				    $( "div.log" ).text( "Triggered ajaxError handler." );
				});

			});
	 }
//	var refrest = setInterval(calRefresh, 2000);

	$('#clear-booking').click(function() {
		//$('#hours').val('');
		$('#hours-buttons button').filter( function() { return $(this).hasClass('dark'); } ).trigger('click');
		$('#name').val('');
		$('#company').val('');
		$('#phone').val('');
		$('#email').val('');
		$('#status').val('hold');
		$('.status').removeClass('bordered');
		$('.hold').addClass('bordered');
		$('#notes').val('');
		$('#paid').val('');
		$('#lanes').val('1');
		$('#bowlers').val('1');
		//$.getScript( hourscript )
	});

	$('#day-notes').blur(function() {

		var ajaxdata = { 
			action:	'update_notes',
			notes:	$(this).val(),
			date:	$('#reportrange').val()
		};

		$.post( ajaxurl, ajaxdata, function(res) {
		});

	});

	$('#notes-update').click( function() {
		$('#day-notes').trigger("click");
	});

	$('#print').click( function() {
		window.open('print?date=' + $('#reportrange').val(), "print", "width=800, height=800");
	});

	$('#all-toggle').click(function() {
		$('.canceled, .pending').toggleClass('hide');
		if( $(this).html() = 'View All' ) $(this).html( 'Hide All' );
		if( $(this).html() = 'Hide All' ) $(this).html( 'View All' );
	});

	$('.canceled-reservation').hover( function(e) {
		e.stopPropagation();
		$(this).toggleClass('opaque');
	});
	$('.modal .status').click(function() {
		$('.modal .status').removeClass('dark');
		$(this).addClass('dark');
	})

});
