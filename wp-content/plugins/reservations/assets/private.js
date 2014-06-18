

                $('#reportrange').datepicker().change(function() {

			$('#date').val($(this).val());

			var ajaxdata = {
				action: 	'print_calendar_contents',
				date:		$(this).val()
			};
		
			$.post( ajaxurl, ajaxdata, function(res){
				$('#calendar-target').html(res);
				$.getScript( subscript )
			});

			var ajaxdata = {
				action:		'update_hours',
				all:		true,
				datefield:      $(this).val()
			};

			$.post( ajaxurl, ajaxdata, function(res){
				$('#hours-menu').html(res);


				var ajaxdata = {
					action:		'update_hours_buttons',
					buttons:	true,
					datefield:      $('#date').val()
				};

				$.post( ajaxurl, ajaxdata, function(res){
					$('#hours-buttons').html(res);
					$.getScript( pluginsurl + "/reservations/assets/hours.js" );

				});

			});
			var ajaxdata = {
				action:		'get_notes',
				date:      $(this).val()
			};
			$.post( ajaxurl, ajaxdata, function(res){
					$('#day-notes').val(res);
			});

                });

