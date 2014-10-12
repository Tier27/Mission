/*
jQuery(document).ready(function($){	
	$('#myTest').html('testtest');
	$(".qhead a").on("click", function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		$(href).fadeToggle(450);
	});
});
*/

( function( $ ) {
	$(".qhead a").on("click", function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		//$('.q .answer').not(href).fadeOut(450);
		$(href).fadeToggle(450);
	});
})(jQuery);
