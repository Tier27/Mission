jQuery( function( $ ) {

	$('#price-display').html('$0');
	$('#hours-menu li a').click( function() {

		$(this).toggleClass('dropdown-active').find('input').trigger('click');
		var price = 0;
		$('#lanes option').show();	
		$.each( $('.hours:checked'), function( index, value ) {
			price += parseInt($(value).next().find('.pricetag').html());
			if ( $(value).parent().find('.count').html() < 2 ) {
				$('#lanes option[value=2]').removeAttr('selected').hide();	
			}
		});
		price *= $('#lanes').val();
		$('#price').val('$' + price);

	});

	$('#lanes').change( function() {
		var price = 0;
		$.each( $('.hours:checked'), function( index, value ) {
			price += parseInt($(value).next().find('.pricetag').html());
		});
		price *= $('#lanes').val();
		$('#price').val('$' + price);
	});


	$('.dropdown-menu, .dropdown-menu input, .dropdown-menu label').click(function(e) {
	    e.stopPropagation();
	});

	$('.btn-group .hours').removeClass('dark');
	$('.btn-group .hours').click( function() {

		$('#anchor-' + $(this).find('input').val()).trigger('click');

	});

	$('#hours-menu a').click( function() {
		$('#button-'+($(this).attr('id').substr( 7, $(this).attr('id').length))).toggleClass('dark');
	});

	$('.hours').click( function() {

		$('#hours').val('test');

		var arr =  new Array();

		$.each( $('.hours:checked'), function( index, value ) {
	
			arr[index] = $(value).val();

		});

		var str = arr.join();

	});
/*
	$('.dropdown-menu, .dropdown-menu input, .dropdown-menu label').click(function(e) {
	    e.stopPropagation();
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
*/

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
		$('#price-display').html('$'+price);

	});


});
