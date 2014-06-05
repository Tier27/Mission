/*
	Javascript: Eventon Full Calendar
	version: 0.12
*/
jQuery(document).ready(function($){
	
	init();	
	
	
	// INITIATE script
		function init(){		
			$('.eventon_fullcal').each(function(){
				
				var strip = $(this).find('.evofc_months_strip');
				var width = parseInt(strip.width());
				
				strip.width(width*3);
				
				$(this).find('.evofc_month').width(width);

				evofc_add_dots($(this));
				
			});

			// fix ratios for resizing the calendar size
			$( window ).resize(function() {
				$('.eventon_fullcal').each(function(){
					var cal_width = $(this).width();
					var strip = $(this).find('.evofc_months_strip');
					var multiplier = strip.attr('multiplier');
					
					if(multiplier<0){
						strip.width(cal_width*3).css({'margin-left':(multiplier*cal_width)+'px'});					
					}
					$(this).find('.evofc_month').width(cal_width);
				});
			});
		}
	

	// click on a day
		$('.evofc_months_strip').on( 'click','.eventon_fc_days .evo_fc_day',function(){
			
			if( !$(this).hasClass('evo_fc_empty')){
				var new_day = $(this).attr('data-day');
				var nest = $(this).parent();
						
				var cal_id = $(this).closest('.ajde_evcal_calendar').attr('id');
				
				nest.find('.evo_fc_day').removeClass('on_focus');
				
				nest.find('.evo_fc_day[data-day='+new_day+']').addClass('on_focus');
				
				//$(this).addClass('on_focus');
				
				// update the calendar according to the new date selection
				ajax_update_month_events(cal_id, new_day);
			}
		});
	// click on a day of the week 
		$('.evofc_months_strip').on('click', '.eventon_fc_daynames .evo_fc_day',function(){
			var dow = $(this).data('dow');
			$('.evo_fc_day').removeClass('highl');
			
			$(this).addClass('highl').closest('.evofc_month ').find('.eventon_fc_days').find('p[data-dow='+dow+']')
				.addClass('highl');
			
		});
	
	// AJAX when changing date
		function ajax_update_month_events(cal_id, new_day){
			var ev_cal = $('#'+cal_id);

			// new dates
			var new_date_el = ev_cal.find('#evcal_head .evoFC_val');
			var new_day_ =1;
			if(!new_date_el.hasClass('mo1st')){
				new_day_ = new_day;	
			}	
			

			var cal_head = ev_cal.find('.calendar_header');
			var evodata = ev_cal.find('.evo-data');

			var evcal_sort = cal_head.siblings('div.evcal_sort');
					
			var sort_by=evcal_sort.attr('sort_by');
			var cat=evcal_sort.attr('cat');
			
			var ev_type = evodata.attr('data-ev_type'); 
			var ev_type_2 = evodata.attr('data-ev_type_2');
			
			// change values to new in ATTRs
			evodata.attr({'data-cday':new_day});
			
			
			var shortcode_array = get_shortcode_array(cal_id);
			var filter_array = get_filters_array(cal_id);
			
			var data_arg = {
				action: 		'the_ajax_hook',
				current_month: 	evodata.attr('data-cmonth'),	
				current_year: 	evodata.attr('data-cyear'),	
				sort_by: 		sort_by, 			
				event_count: 	evodata.attr('data-ev_cnt'),
				fc_focus_day: 	new_day,
				filters: 		filter_array,
				direction: 		'none',
				shortcode: 		shortcode_array
			};
			
			
			$.ajax({
				beforeSend: function(){
					ev_cal.find('.eventon_events_list').slideUp('fast');
					ev_cal.find('#eventon_loadbar').show().css({width:'0%'}).animate({width:'100%'});
				},
				type: 'POST',
				url:the_ajax_script.ajaxurl,
				data: data_arg,
				dataType:'json',
				success:function(data){
					//alert(data);
					ev_cal.find('.eventon_events_list').html(data.content);
					ev_cal.find('.eventon_other_vals').val(new_day_);
				},complete:function(){
					ev_cal.find('#eventon_loadbar').css({width:'100%'}).fadeOut();
					ev_cal.find('.eventon_events_list').delay(300).slideDown();
					ev_cal.evoGenmaps({'delay':400});
				}
			});
			
		}
	
	// click on filter sorting
		$('.eventon_filter_dropdown').on( 'click','p',function(){
			var cal_head = $(this).closest('.eventon_sorting_section').siblings('.calendar_header');
			eventon_fc_get_new_days(cal_head,'','');
		});

	// MONTH JUMPER
		$('.evo_j_dates').on('click','a',function(){
			var container = $(this).closest('.evo_j_container');
			if(container.attr('m')!==undefined && container.attr('y')!==undefined){
				
				var cal_head = $(this).closest('.calendar_header');
				var evo_dv = cal_head.find('.eventon_other_vals').length;

				if(evo_dv>0)
					eventon_fc_get_new_days(cal_head,'','','jumper');
			}
		});

	// MONTH switching
		$('.evcal_btn_prev').click(function(){
			var cal_head = $(this).parents('.calendar_header');
			var evo_dv = cal_head.find('.eventon_other_vals').length;		
			if(evo_dv>0)
				eventon_fc_get_new_days(cal_head,'prev','');
		});
		
		$('.evcal_btn_next').click(function(){	
			var cal_head = $(this).parents('.calendar_header');
			var evo_dv = cal_head.find('.eventon_other_vals').length;	
			//alert(evo_dv);	
			if(evo_dv>0)
				eventon_fc_get_new_days(cal_head,'next','');

			
		});
		
	// update the days list for new month
		function eventon_fc_get_new_days(cal_header, change, cday, type){
			
			var cal_id = cal_header.closest('.ajde_evcal_calendar').attr('id');
			var cal = $('#'+cal_id);

			// run this script only on calendars with Fullcal
			if(cal.hasClass('evoFC')){

				var cal_head = cal.find('.calendar_header');
				var evodata = cal.find('.evo-data');

				// get object values
				var cur_m = parseInt(evodata.attr('data-cmonth'));
				var cur_y = parseInt(evodata.attr('data-cyear'));
				
				
				// new dates
				var new_date_el = cal_header.find('.eventon_other_vals');
				var new_d =1;
				if(!new_date_el.hasClass('mo1st')){
					new_d = (cday=='')? new_date_el.val(): cday;	
				}
				
				
				// direction based values
				if(change=='next'){
					var new_m = (cur_m==12)?1: cur_m+ 1 ;
					var new_y = (cur_m==12)? cur_y+1 : cur_y;
				}else if(change=='prev'){
					var new_m = (cur_m==1)?12:cur_m-1;
					var new_y = (cur_m==1)?cur_y-1:cur_y;
				}else{
					var new_m =cur_m;
					var new_y = cur_y;
				}
				
				var shortcode_array = get_shortcode_array(cal_id);
				var filter_array = get_filters_array(cal_id);
				
				// AJAX data array
				var data_arg = {
					action: 	'the_ajax_fc',
					next_m: 	new_m,	
					next_y: 	new_y,
					next_d: 	new_d,
					change: 	change,
					filters: 	filter_array,
					cal_id: 	cal_id,
					send_unix: 	evodata.data('send_unix'),
					shortcode: 	shortcode_array
				};
				
				var this_section = cal_header.parent().find('.eventon_fc_days');
				var strip = cal_header.parent().find('.evofc_months_strip');
				
				// animation
				var cur_margin = parseInt(strip.css('marginLeft'));
				var month_width = parseInt(strip.parent().width());
				var months = strip.find('.evofc_month').length;
				var super_margin;
				var pre_elems = strip.find('.focus').prevAll().length;
				var next_elems = strip.find('.focus').nextAll().length;
				
				$.ajax({
					beforeSend: function(){
						//this_section.slideUp('fast');
					},
					type: 'POST',
					url:the_ajax_script.ajaxurl,
					data: data_arg,
					dataType:'json',
					success:function(data){
						
						
						// build out month grid animation

						if(change=='next' || type=='jumper'){
							if( months ==2 && next_elems==0){
								strip.find('.evofc_month:first-child').remove();
								strip.css({'margin-left':(cur_margin+month_width)+'px'});						
								super_margin = cur_margin;
								strip.append(data.month_grid);
								
							}else if(months== 2 && next_elems==1){
								super_margin = cur_margin-month_width;
							}else{
								strip.append(data.month_grid);
								super_margin = cur_margin-month_width;
							}					
							
							strip.attr({'multiplier':'-1'}).find('.evofc_month').removeClass('focus');
							strip.find('.evofc_month:last-child').addClass('focus');
							
						}else if(change=='prev'){
							
							if(months==2 && pre_elems==0){		

								strip.prepend(data.month_grid);
								strip.css({'margin-left':(cur_margin-month_width)+'px'});
								
								strip.find('.evofc_month:last-child').remove();
								super_margin =0;
								
								
							}else if(months== 2 && pre_elems==1){
								super_margin =0;
							}else{
								
								strip.prepend(data.month_grid);
								strip.css({'margin-left':(cur_margin-month_width)+'px'});
								//strip.find('.evofc_month:last-child').remove();
								super_margin = 0;
								
							}
							
							strip.attr({'multiplier':'+1'}).find('.evofc_month').removeClass('focus');
							strip.find('.evofc_month:first-child').addClass('focus');
							
						}else{
						// no month change filter change
							
							strip.find('.focus').replaceWith(data.month_grid);
							strip.find('.evofc_month[month='+new_m+']').addClass('focus');
						}

						strip.find('.evofc_month').width(month_width);
						
						// animate the month grid
						strip.delay(200).animate({'margin-left':super_margin+'px'}, 1300, 'easeOutQuint',function(){
							strip.find('.focus').siblings().remove();
							strip.css({'margin-left':'0'});
							strip.attr({'multiplier':'0'})
						});	
						
					},complete:function(){
						var cal = cal_header.parent().find('.eventon_fullcal')
						evofc_add_dots(cal);
					}
				});

			}
		}
	
	/**	Return filters array if exist for the active calendar	 */
		function get_filters_array(cal_id){
			var ev_cal = $('#'+cal_id); 
			//var cal_head = ev_cal.find('.calendar_header');
			var evodata = ev_cal.find('.evo-data');
			
			var filters_on = ( evodata.attr('data-filters_on')=='true')?'true':'false';
			
			// creat the filtering data array if exist
			if(filters_on =='true'){
				var filter_section = ev_cal.find('.eventon_filter_line');
				var filter_array = [];
				
				filter_section.find('.eventon_filter').each(function(index){
					var filter_val = $(this).attr('filter_val');
					
					if(filter_val !='all'){
						var filter_ar = {};
						filter_ar['filter_type'] = $(this).attr('filter_type');
						filter_ar['filter_name'] = $(this).attr('filter_field');
						filter_ar['filter_val'] = filter_val;
						filter_array.push(filter_ar);
					}
				});			
			}else{
				var filter_array ='';
			}
			
			return filter_array;
		}
	
	/*	RETURN: shortcode array	*/
		function get_shortcode_array(cal_id){
			var ev_cal = $('#'+cal_id); 
			
			var el = ev_cal.find('.cal_arguments');
			var shortcode_array ={};
					

			$(el[0].attributes).each(function() {
				if(this.nodeName!='class' && this.nodeName!='style' ){
					shortcode_array[this.nodeName] = this.nodeValue;
					
				}
			});
			
			return shortcode_array;
		}
	
	
	// tool tips on calendar dates
		$('.evofc_months_strip').on('mouseover' , '.has_events', function(){
			var obj = $(this);

			if(obj.data('events')!=''){
				

				var popup = obj.closest('.eventon_fullcal').find('.evoFC_tip');
				var offs = obj.position();
				var leftOff ='';

				var dayh = obj.closest('.evofc_month').find('.eventon_fc_daynames')
					.height();

				if(obj.data('cnt') %7 ==0){
					popup.addClass('leftyy');
					leftOff = offs.left - 17;
				}else{
					leftOff = offs.left + obj.width()+2;
				}
				
				popup.css({top: (offs.top+dayh), left:leftOff});
				popup.html( obj.data('events') ).stop(true, false).fadeIn('fast');
			}
			
		}).mouseout(function(){
			var popup = $(this).closest('.eventon_fullcal').find('.evoFC_tip');
			popup.removeClass('leftyy');
			
			popup.stop(true, false).hide();
		});
	
	
	// add dots for events
		function evofc_add_dots(cal){
			cal.find('.has_events').each(function(){
				var event_count = $(this).data('events');
				var elements ='';

				var ed = $.parseJSON($(this).attr('data-ed'));

				if(event_count>5){
					elements = "<i></i><b>+ more</b>";
				}else{
					for(x=0; x<event_count; x++){
						elements += "<i data-et='"+ed.et[x]+"' title='"+ed.et[x]+"'></i>";
					}
				}

				$(this).append('<span>'+elements+'</span>');
			});
		}
	
	// hover over day dot
		/*
		$('.evofc_months_strip .has_events').on('mouseover' , 'i', function(){

			var obj = $(this);
			var title = obj.attr('data-et');
			var box = obj.parent().parent();
			var offs = box.position();

			var dayh = obj.closest('.evofc_month').find('.eventon_fc_daynames')
					.height();

			obj.closest('.eventon_fullcal').find('.evofc_title_tip').stop()
				.css({top: (offs.top + box.height()+60+dayh), left:offs.left})
				.html(title).show();
			console.log(offs.top);

		}).mouseout(function(){
			$('.evofc_title_tip').hide();
		});
*/
});