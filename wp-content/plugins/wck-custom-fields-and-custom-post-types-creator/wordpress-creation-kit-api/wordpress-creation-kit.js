/* Add width to elements at startup */
jQuery(function(){
	jQuery('.mb-table-container tbody td').css('width', function(){ return jQuery(this).width() });	
});

/* Add width to labels if the post box is closed at load */
jQuery(function(){

	/* Callback version  */
	/* postboxes.pbshow = function(box){		
		jQuery('strong, .field-label',  jQuery('#'+box)).css( 'width', 'auto' );		
	} */
	
	jQuery( '.wck-post-box .hndle' ).click( function(){		
		jQuery('strong, .field-label',  jQuery(this).parent() ).css( 'width', 'auto' );		
	})
	
});




/* add reccord to the meta */
function addMeta(value, id, nonce){

	/* if tinyMCE then trigger save. save puts the content in the hidden textarea */
	if( tinyMCE !== undefined )
		tinyMCE.triggerSave();

	jQuery('#'+value).parent().css({'opacity':'0.4', 'position':'relative'}).append('<div id="mb-ajax-loading"></div>');
	/*object to hold the values */
	var values = {};
	
	jQuery('#'+value+' .mb-field').each(function(){
	
		var key = jQuery(this).attr('name');
		
		if(jQuery(this).attr('type') == 'checkbox' || jQuery(this).attr('type') == 'radio' ) {
			
			if( typeof values[key.toString()] === "undefined" )
				values[key.toString()] = '';
			
			if(jQuery(this).is(':checked')){
				if( values[key.toString()] == '' )
					values[key.toString()] += jQuery(this).val().toString();
				else
					values[key.toString()] += ', ' + jQuery(this).val().toString();
			}			
		}
		
		else		
			values[key.toString()] = jQuery(this).val().toString();
	});
	
	meta = value;
	
	if( value.indexOf("-wcknested-") != -1 ){
		metaDetails = value.split("-wcknested-");
		meta = metaDetails[0];
	}
		
	jQuery.post( wckAjaxurl ,  { action:"wck_add_meta"+meta, meta:value, id:id, values:values, _ajax_nonce:nonce}, function(response) {

			jQuery( '#'+value+' .field-label').removeClass('error');
		
			if( response.error ){
				jQuery('#'+value).parent().css('opacity','1');
				jQuery('#mb-ajax-loading').remove();
				
				jQuery.each( response.errorfields, function (index, field) {
					jQuery( '#'+value+' .field-label[for="' + field + '"]' ).addClass('error');
				});				

				alert( response.error );
			}
			else{		
				/* refresh the list */
				jQuery.post( wckAjaxurl ,  { action:"wck_refresh_list"+meta, meta:value, id:id}, function(response) {					
					
					jQuery('#container_'+value).replaceWith(response);
					
					/* set width of strong label */
					wck_set_to_widest('strong', '#container_'+value );
					
					jQuery('.mb-table-container tbody td').css('width', function(){ return jQuery(this).width() });
					
					if( !jQuery( '#'+value ).hasClass('single') )
						mb_sortable_elements();
						
					/* restore the add form to the original values */					
					if( !jQuery( '#'+value ).hasClass('single') ){
						jQuery.post( wckAjaxurl ,  { action:"wck_add_form"+meta, meta:value, id:id }, function(response) {			
							jQuery( '#'+value ).replaceWith( response );							
							wck_set_to_widest( '.field-label', '#'+value );
						});
					}
						
					/* jQuery('#'+value+' .mb-field').each(function(){
						if(jQuery(this).attr('type') == 'checkbox' || jQuery(this).attr('type') == 'radio' ) 
							jQuery(this).removeAttr( 'checked' );	
						else
							jQuery(this).val('');					
					});	

					jQuery('#'+value+' .upload-field-details').each(function(){
						jQuery(this).html('<p><span class="file-name"></span><span class="file-type"></span></p>');	
					}); */	
					
					jQuery('#'+value).parent().css('opacity','1');	
					
					/* Remove form if is single */
					if( jQuery( '#'+value ).hasClass('single') )
						jQuery( '#'+value ).remove();
					
					
					jQuery('body').trigger('wck-added-element');
					
					jQuery('#mb-ajax-loading').remove();
				});
			}
		});	
	
}

/* remove reccord from the meta */
function removeMeta(value, id, element_id, nonce){
	
	var response = confirm( "Delete this item ?" );
	
	if( response == true ){
	
		meta = value;
	
		if( value.indexOf("-wcknested-") != -1 ){
			metaDetails = value.split("-wcknested-");
			meta = metaDetails[0];
		}
	
		jQuery('#'+value).parent().css({'opacity':'0.4', 'position':'relative'}).append('<div id="mb-ajax-loading"></div>');
		jQuery.post( wckAjaxurl ,  { action:"wck_remove_meta"+meta, meta:value, id:id, element_id:element_id, _ajax_nonce:nonce}, function(response) {
		
				/* If single add the form */
				if( jQuery( '#container_'+value ).hasClass('single') ){
					jQuery.post( wckAjaxurl ,  { action:"wck_add_form"+meta, meta:value, id:id }, function(response) {			
						jQuery( '#container_'+value ).before( response );
						jQuery( '#'+value ).addClass('single');	
					});
				}
				
				/* refresh the list */
				jQuery.post( wckAjaxurl ,  { action:"wck_refresh_list"+meta, meta:value, id:id}, function(response) {	
					jQuery('#container_'+value).replaceWith(response);
					
					/* set width of strong label */
					wck_set_to_widest('strong', '#container_'+value );
					
					jQuery('.mb-table-container tbody td').css('width', function(){ return jQuery(this).width() });
					
					mb_sortable_elements();
					jQuery('#'+value).parent().css('opacity','1');
					jQuery('#mb-ajax-loading').remove();
				});
				
			});	
	}
}

/* swap two reccords */
/*function swapMetaMb(value, id, element_id, swap_with){
	jQuery('#'+value).parent().css({'opacity':'0.4', 'position':'relative'}).append('<div id="mb-ajax-loading"></div>');
	jQuery.post( wckAjaxurl ,  { action:"swap_meta_mb", meta:value, id:id, element_id:element_id, swap_with:swap_with}, function(response) {	
			
			jQuery.post( wckAjaxurl ,  { action:"refresh_list", meta:value, id:id}, function(response) {	
				jQuery('#container_'+value).replaceWith(response);				jQuery('#'+value).parent().css('opacity','1');				jQuery('#mb-ajax-loading').remove();				
			});
			
		});	
}
*/

/* reorder elements through drag and drop */
function mb_sortable_elements() {				
		jQuery( ".mb-table-container tbody" ).not( jQuery( ".mb-table-container.single tbody, .mb-table-container.not-sortable tbody" ) ).sortable({
			update: function(event, ui){
				
				var value = jQuery(this).parent().prev().attr('id');
				var id = jQuery(this).parent().attr('post');
				
				var result = jQuery(this).sortable('toArray');
				
				var values = {};
				for(var i in result)
				{
					values[i] = result[i].replace('element_','');
				}
				
				jQuery('#'+value).parent().css({'opacity':'0.4', 'position':'relative'}).append('<div id="mb-ajax-loading"></div>');
				
				meta = value;
	
				if( value.indexOf("-wcknested-") != -1 ){
					metaDetails = value.split("-wcknested-");
					meta = metaDetails[0];
				}
	
				
				jQuery.post( wckAjaxurl ,  { action:"wck_reorder_meta"+meta, meta:value, id:id, values:values}, function(response) {			
					jQuery.post( wckAjaxurl ,  { action:"wck_refresh_list"+meta, meta:value, id:id}, function(response) {
							jQuery('#container_'+value).replaceWith(response);
							
							/* set width of strong label */
							wck_set_to_widest('strong', '#container_'+value );
							
							jQuery('.mb-table-container tbody td').css('width', function(){ return jQuery(this).width() });
							
							mb_sortable_elements();
							jQuery('#'+value).parent().css('opacity','1');
							jQuery('#mb-ajax-loading').remove();				
					});
					
				});
			}
		});
		/*I don't know if this is necessary. Remove when I have more time for tests */
		jQuery( "#sortable:not(select)" ).disableSelection();


		jQuery('.mb-table-container ul').mousedown( function(e){		
			e.stopPropagation();
		});	
}
jQuery(mb_sortable_elements);



/* show the update form */
function showUpdateFormMeta(value, id, element_id, nonce){	
	if( jQuery( '#update_container_' + value + '_' + element_id ).length == 0 ){
		jQuery('#container_'+value).parent().css({'opacity':'0.4', 'position':'relative'}).append('<div id="mb-ajax-loading"></div>');
		
		if( jQuery( '#container_' + value + " tbody" ).hasClass('ui-sortable') )
			jQuery( '#container_' + value + " tbody" ).sortable("disable");
		
		
		meta = value;
	
		if( value.indexOf("-wcknested-") != -1 ){
			metaDetails = value.split("-wcknested-");
			meta = metaDetails[0];
		}
		
		
		jQuery.post( wckAjaxurl ,  { action:"wck_show_update"+meta, meta:value, id:id, element_id:element_id, _ajax_nonce:nonce}, function(response) {	
				//jQuery('#container_'+value+' #element_'+element_id).append(response);
				jQuery(response).insertAfter('#container_'+value+' > tbody > #element_'+element_id);
				
				/* set width of field-label */
				wck_set_to_widest('.field-label', '#update_container_' + value + '_' + element_id );				
				
				jQuery('#container_'+value).parent().css('opacity','1');
				jQuery('#mb-ajax-loading').remove();
				wckGoToByScroll('update_container_' + value + '_' + element_id);
		});
	}
}

/* remove the update form */
function removeUpdateForm( id ){
	jQuery('html, body').animate({
		scrollTop: jQuery( '#'+id).prev().offset().top - 40	}, 700);
	
	jQuery( '#'+id).prev().animate({
		backgroundColor: '#FFFF9C'
	}, 700);
	jQuery( '#'+id).prev().animate({
		backgroundColor: 'none'
	}, 700);
	
	jQuery( '#'+id ).remove();
}

/* update reccord */
function updateMeta(value, id, element_id, nonce){
	
	/* if tinyMCE then trigger save. save puts the content in the hidden textarea */
	if( tinyMCE !== undefined )
		tinyMCE.triggerSave();

	jQuery('#container_'+value).parent().css({'opacity':'0.4', 'position':'relative'}).append('<div id="mb-ajax-loading"></div>');
	var values = {};	
	jQuery('#update_container_'+value+'_'+element_id+' .mb-field').each(function(){
		var key = jQuery(this).attr('name');		
		
		if(jQuery(this).attr('type') == 'checkbox' || jQuery(this).attr('type') == 'radio' ) {
			
			if( typeof values[key.toString()] === "undefined" )
				values[key.toString()] = '';
			
			if(jQuery(this).is(':checked')){
				if( values[key.toString()] == '' )
					values[key.toString()] += jQuery(this).val().toString();
				else
					values[key.toString()] += ', ' + jQuery(this).val().toString();
			}			
		}
		
		else		
			values[key.toString()] = jQuery(this).val().toString();
		
	});
	
	
	meta = value;
	
	if( value.indexOf("-wcknested-") != -1 ){
		metaDetails = value.split("-wcknested-");
		meta = metaDetails[0];
	}
	
	
	jQuery.post( wckAjaxurl ,  { action:"wck_update_meta"+meta, meta:value, id:id, element_id:element_id, values:values, _ajax_nonce:nonce}, function(response) {

			jQuery( '#update_container_'+value+'_'+element_id + ' .field-label').removeClass('error');
		
			if( response.error ){
				jQuery('#container_'+value).parent().css('opacity','1');
				jQuery('#mb-ajax-loading').remove();
				
				jQuery.each( response.errorfields, function (index, field) {
					jQuery( '#update_container_'+value+'_'+element_id + ' .field-label[for="' + field + '"]' ).addClass('error');
				});				

				alert( response.error );
			}
			else{
				jQuery('html, body').animate({
					scrollTop: jQuery('#container_'+value+' #element_' + element_id).offset().top - 40 }, 700);
	
				jQuery('#container_'+value+' #element_' + element_id).animate({
					backgroundColor: '#FFFF9C'
				}, 700);
				jQuery('#container_'+value+' #element_' + element_id).animate({
					backgroundColor: 'none'
				}, 700);
				
				jQuery('#update_container_'+value+'_'+element_id).remove();
				
				/* refresh the list */
				jQuery.post( wckAjaxurl ,  { action:"wck_refresh_entry"+meta, meta:value, id:id, element_id:element_id}, function(response) {	
					jQuery('#container_'+value+' #element_'+element_id).replaceWith(response);
					
					/* set width of strong label */
					wck_set_to_widest('strong', '#container_'+value+' #element_'+element_id );
					
					jQuery('.mb-table-container tbody td').css('width', function(){ return jQuery(this).width() });
					
					if( jQuery( '#container_' + value + " tbody" ).hasClass('ui-sortable') )
						jQuery( '#container_' + value + " tbody" ).sortable("enable");
					
					jQuery('#container_'+value).parent().css('opacity','1');
					jQuery('#mb-ajax-loading').remove();
				});
			}
		});	
}

/* function syncs the translation */
function wckSyncTranslation(id){
	jQuery.post( wckAjaxurl ,  { action:"wck_sync_translation", id:id}, function(response) {			
			if( response == 'syncsuccess' )
				window.location.reload();			
		});	
}

function wckGoToByScroll(id){
     	jQuery('html,body').animate({scrollTop: jQuery("#"+id).offset().top - 28},'slow');
}

/* Remove uploaded file */
jQuery(function(){
	jQuery('.wck-remove-upload').live('click', function(e){		
		jQuery(this).parent().parent().parent().children('.mb-field').val("");
		jQuery(this).parent().parent('.upload-field-details').html('<p><span class="file-name"></span><span class="file-type"></span></p>');
	});	
});

/* Set width for listing "label" equal to the widest */
jQuery( function(){	
	jQuery('.mb-table-container').each(function(){
		wck_set_to_widest( 'strong', jQuery(this) );		
	});	
	
	jQuery('.mb-list-entry-fields').each(function(){
		wck_set_to_widest( '.field-label', jQuery(this) );		
	});	
	
	jQuery('.wck-post-box').css( {visibility: 'visible', height: 'auto'} );
});

function wck_set_to_widest( element, parent ){
	if( jQuery( element, parent).length != 0 ){		
		var widest = null;
		jQuery( element, parent).each(function() {
		  if (widest == null)
			widest = jQuery(this);
		  else
		  if ( jQuery(this).width() > widest.width() )
			widest = jQuery(this);
		});
		
		jQuery(element, parent).css( {display: 'inline-block', width: widest.width(), paddingRight: '5px'} );
	}
	else return;
}