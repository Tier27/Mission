var availability = {};
var current_date_index;
var current_hour_index;
var lanes_last_changed = false;
var hours_last_changed = false;
var $bowlers = $('#book-reservation-bowlers');
var $bowlers_two_lanes = $bowlers.find('.two-lanes')
var $bowlers_seven_to_twelve = $bowlers_two_lanes.clone();
$bowlers_two_lanes.remove();

jQuery(function($){
	$date_select = $('#book-reservation-date').html('');
	$pre_book_date = $('#pre-book-date').html('');
	$start = $('select[name="start_hour"]').html('');
	$hours = $('select[name="number_of_hours"]');
	$lanes = $('#book-reservation-lanes, #pre-book-lanes');
	$price = $('#book-reservation-price-display');
	$two_lanes_option = $lanes.find('option[value="2"]');
	$two_hours_option = $hours.find('option[value="2"]');
	$.post(RESERVATION_SYSTEM_URL + '/upcoming/availability', {}, function(res){
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
			if( hour.availability != 0 )
				$start.append($('<option></option>').val(hour.id).html(hour.display).attr('data-index', index));
		});
		$start.trigger('change');
	});

	$start.change(function(){
		if ( !lanes_last_changed ) {
			$two_lanes_option.prop('disabled', true);
			$bowlers.find('.two-lanes').remove();
		}
		if ( !hours_last_changed ) $two_hours_option.prop('disabled', true);
		lanes_last_changed = false;
		hours_last_changed = false;
		current_hours = availability[current_date_index].hours;
		index = parseInt($(this).find(':selected').attr('data-index'));
		current_hour_index = index;
		is_second_to_last = ( index == current_hours.length - 2 )
		if( index < current_hours.length - 2 && current_hours[index+1].availability >= $lanes.val() ){
			$two_hours_option.prop('disabled', false);
		} else {
			$hours.val('1');
		}
		lane_availability = availability[current_date_index].hours[current_hour_index].availability;
		if( lane_availability > 1 ){
			if( $hours.val() == 1 ){
				$two_lanes_option.prop('disabled', false);
			} else if ( current_hours[index+1].availability >= 2 ){
				$two_lanes_option.prop('disabled', false);
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
		console.log($(this).val());
		console.log('...');
		lanes_last_changed = true;
                $start.trigger('change');
                if( $(this).val() == 1 ){
                        $bowlers.find('.two-lanes').remove();
                } else {
                        $bowlers.append($bowlers_seven_to_twelve.clone());
                }
	});
        $bowlers.find('.two-lanes').hide();

	$hours.change(function(){
		hours_last_changed = true;
		$start.trigger('change');
	});
});
