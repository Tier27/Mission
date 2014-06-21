jQuery(function($) {
	$('#search').keypress(function(e) {
		if( e.keyCode != 13 ) return;
		$('#search-trigger').trigger("click");
	});
	$('#search-trigger').click( function() {
		var ajaxdata = { 
			action:		'search_reservations',
			query:		$('#search').val()
		}
		$.post( ajaxurl, ajaxdata, function(res) {
			$('#calendar-target').html(res);
		});
	});
});
