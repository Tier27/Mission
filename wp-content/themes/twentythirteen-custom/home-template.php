<?php /** Template Name: Home **/ ?>
<?php get_header(); ?>
<?php $tdu = get_template_directory_uri(); ?>
<?php $images=mysql_query("select * from slider") or die(mysql_error()); ?>
<?php $se = get_post_meta( 175, 'home_slideshow', true ); ?>
<script src="jquery.min.js"></script>
<script>
var simages = new Array();
var stimer = new Array();
var sfadein = new Array();
var sfadeout = new Array();
<?php
foreach ( $se as $e ) {
	$e = explode(':',$e);
	$src = wp_get_attachment_url( $e[0] );
	echo "simages.push('$src');\n";
	echo "sfadein.push(" . $e[1]*1000 . ");\n";
	echo "stimer.push(" . $e[2]*1000 . ");\n";
	echo "sfadeout.push(" . $e[3]*1000 . ");\n";
}
$background_delay=get_variable('slider_background_delay'); 
$background_fadein=get_variable('slider_background_fadein'); 
$image_names=array();
while ($image=mysql_fetch_array($images)) { 
array_push($image_names, str_replace("_",".",$image['name'])); 
$index=$image['placement'];
$name=str_replace("_",".",$image['name']);
$time=$image['period'];
$fadein=$image['fadein'];
$fadeout=$image['fadeout'];
} ?>
<?php echo "var count=".count($image_names)."; "; ?>
imgCounter=0;
function cycle() { if (imgCounter==count) { return; }
		   var contentURL = "<?php echo get_template_directory_uri()."/MBC/"; ?>";
		   imgCounter++;
		   timer=stimer[imgCounter];  
		   setTimeout('$("#background").animate({ opacity: "1" }, <?php echo $background_fadein; ?>);', <?php echo $background_delay; ?>);
		   if (sfadein[imgCounter]>0) { document.getElementById("picture").style.opacity='0'; }
		   document.getElementById("picture").src=simages[imgCounter]; 
		   if (sfadein[imgCounter]==0) { setTimeout(function () { document.getElementById("picture").style.opacity='1'; }, 50); }
		   if (sfadein[imgCounter]!=0) { setTimeout(function () { $("#picture").animate({ opacity: "1" }, sfadein[imgCounter]); }, 0); }
		   if (sfadeout[imgCounter]>0) { setTimeout(function () { $("#picture").animate({ opacity: "0" }, sfadeout[imgCounter]); }, timer-sfadeout[imgCounter]-sfadein[imgCounter]); }
		   setTimeout("cycle();", timer); 
			}

</script>
<body onload="//cycle();">
<?php //do_action('slideshow_deploy', '23'); ?>
<?php $src=get_image_name('background'); ?>
<div id="photo-gallery">
<img id="left-arrow" class="photo-nav-arrow beginHide fadeIn fadeInThree" src="css/left-arrow-clean.png">
<div id="right-arrow" class="photo-nav-arrow beginHide fadeIn fadeInThree"></div>
<img id="background" src="<?php echo get_template_directory_uri(); ?>/MBC/imagene/uploads/<?php echo $src; ?>" style="display:block; position: absolute; width: 100%; height: 100%; "> 
<img id="picture" src="" style="display:block; position: relative; margin: auto auto; margin-top: 100px; opacity: 1;"> 
</div>
</body>
</html>
<script>
jQuery(function($) {
	function helpCycle(i) {
		if ( i >= simages.length ) i = 0;
		$('#picture').hide().attr('src', simages[i]).fadeIn(sfadein[i], function() {
			if ( i + 1 == simages.length ) return; 
			$('#picture').delay(stimer[i]).fadeOut(sfadeout[i], function() {
				i++;
				helpCycle(i);
			});
		});
	}
	function jCycle() {
		$('#background').fadeOut(0).delay(<?php echo $background_delay; ?>).fadeIn(2000);
		helpCycle(0);
	}
	$(window).ready(jCycle);
});
</script>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg hide" id="slideshow-button" data-toggle="modal" data-target="#slideshowModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="slideshowModal" tabindex="-1" role="dialog" aria-labelledby="slideshowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="slideshowModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	<ul class="slideshow ui-sortable">
	<div class="source">
	<li class="form-inline hide slideshow-attributes" role="form">
	  <div class="form-group">
	    <input class="form-control small fadein" placeholder="Fade in">
	  </div>
	  <div class="form-group">
	    <input class="form-control small time" placeholder="Time">
	  </div>
	  <div class="form-group">
	    <input class="form-control small fadeout" placeholder="Fade out">
	  </div>
	  <div class="form-group">
		<button class="btn btn-danger slideshow-remove">Remove</button>
	  </div>
	  <div class="clear"></div>
	  <br>
	</li>
	</div>
	<?php
	$slideshow_elements = get_post_meta( 175, 'home_slideshow', true );
	foreach ( $slideshow_elements as $element ) { if ( $element == '' ) continue;
	$element = explode(':', $element);
	$src = wp_get_attachment_url( $element[0] );
	if ( ! $src ) continue;
	?>
	<li class="form-inline slideshow-attributes" role="form">
	<img class="gallery-selectable" src="<?php echo $src; ?>" data-id="<?php echo $element[0]; ?>" width="100" height="100"	>
	  <div class="form-group">
	    <input class="form-control small fadein" placeholder="Fade in" value="<?php echo $element[1]; ?>">
	  </div>
	  <div class="form-group">
	    <input class="form-control small time" placeholder="Time" value="<?php echo $element[2]; ?>">
	  </div>
	  <div class="form-group">
	    <input class="form-control small fadeout" placeholder="Fade out" value="<?php echo $element[3]; ?>">
	  </div>
	  <div class="form-group">
		<button class="btn btn-danger slideshow-remove">Remove</button>
	  </div>
	  <div class="clear"></div>
	  <br>
	</li>
	<?php } ?>
	</ul>
      </div>
	<div class="clear"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="slideshow-dismiss" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id="slideshow-add">Add image</button>
        <button type="button" class="btn btn-primary" id="slideshow-save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
<?php if ( isSiteAdmin() ) { ?>
<script>
jQuery( function($) {
	jQuery('body').dblclick( function() {
		jQuery('#slideshow-button').trigger('click');
		jQuery('#slideshowModal .modal-title').html('Slideshow');
	});
        function addListImageToSlideshow() {
                //$('#slideshowModal .modal-body ul').append($(this).parent().clone().append($('.slideshow-attributes').clone()));
                $('#slideshowModal .modal-body ul').append($('.source .slideshow-attributes').clone().removeClass('hide').prepend($(this).clone()));
                $('#gallery-dismiss').trigger( 'click' );
                $('#slideshow-button').trigger( 'click' );
                $('img').unbind( 'click', addListImageToSlideshow );
        }
        jQuery('#slideshow-add').click( function() {
                $('#slideshow-dismiss').trigger( 'click' );
                $('#gallery-button').trigger( 'click' );
                $('img').bind( 'click', addListImageToSlideshow );
                $('#galleryModal').on('hidden.bs.modal', function() {
                        $('img').unbind('click', addListImageToSlideshow);
                });
        });

	$('.ui-sortable').sortable().disableSelection();

	$('#slideshow-save').click( function() {
		images = new Array;
		$.each($('.slideshow-attributes'), function(index, value) {
			if ( $(value).parent().hasClass('source') ) return true;
			data = new Array();
			data.push($(this).find('img').attr('data-id'));
			data.push($(this).find('.fadein').val());
			data.push($(this).find('.time').val());
			data.push($(this).find('.fadeout').val());
			data = data.join(':');
			images.push(data);
		});
		images = images.join(':::');

		var ajaxdata = {
			action:		'update_slideshow',
			images:		images
		}

		$.post( ajaxurl, ajaxdata, function(res) {
			$('#slideshow-dismiss').trigger('click');
		});
	});

	$('.slideshow-remove').click( function() {
		$(this).parent().parent().remove();
	});
});

</script>
<?php } ?>
<style>
.small {
	width: 100px;
}
.white {
	background: white;
}
</style>
