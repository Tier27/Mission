var availability = {};
var current_date_index;
var current_hour_index;
jQuery(function($){
	$date_select = $('#book-reservation-date').html('');
	$pre_book_date = $('#pre-book-date').html('');
	$start = $('select[name="start_hour"]').html('');
	$hours = $('select[name="number_of_hours"]');
	$lanes = $('#book-reservation-lanes');
	$price = $('#book-reservation-price-display');
	$two_lanes_option = $lanes.find('option[value="2"]');
	$two_hours_option = $hours.find('option[value="2"]');
	$.post('http://reservations.development.tier27.com/upcoming/availability', {}, function(res){
		availability = $.parseJSON(res);
		$.each(availability, function(index, date){
			if( date.totalSlots != 0 ){
				$pre_book_date.append($('<option></option>').val(date.value).html(date.display).attr('data-index', index));
				$date_select.append($('<option></option>').val(date.value).html(date.display).attr('data-index', index));
			}
		});
		if( $date_select.find('option').length == 0 ){
			$('.modal-body .well').html('There are no available slots this week. Please call us to book a reservation further in advance.');
		} else {
			$date_select.trigger('change');
		}
	});
	
	$date_select.change(function(){
		$start.html('');
		index = $(this).find(':selected').attr('data-index');
		current_date_index = index;
		$.each(availability[current_date_index].hours, function(index, hour){
			if( index == availability[current_date_index].hours.length - 1 ) return;
			if( hour.availability != 0 ){
				console.log(hour);
				$start.append($('<option></option>').val(hour.id).html(hour.display).attr('data-index', index));
			}
		});
		$start.trigger('change');
	});

	$start.change(function(){
		$two_lanes_option.hide();
		$two_hours_option.hide();
		current_hours = availability[current_date_index].hours;
		index = parseInt($(this).find(':selected').attr('data-index'));
		current_hour_index = index;
		is_second_to_last = ( index == current_hours.length - 2 )
		if( index < current_hours.length - 2 && current_hours[index+1].availability >= $lanes.val() ){
			$two_hours_option.show();
		} else {
			$hours.val('1');
		}
		lane_availability = availability[current_date_index].hours[current_hour_index].availability;
		if( lane_availability > 1 ){
			if( $hours.val() == 1 ){
				$two_lanes_option.show();
			} else if ( current_hours[index+1].availability >= 2 ){
				$two_lanes_option.show();
			}
		} else {
			$lanes.val('1');
		}
		if( is_second_to_last ){
		}
		price = current_hours[index].price * $lanes.val();
		if( $hours.val() == 2 ) price += current_hours[index+1].price * $lanes.val();
		$price.html('$' + price);
	});	

	$lanes.change(function(){
		$start.trigger('change');
	});

	$hours.change(function(){
		$start.trigger('change');
	});
});
