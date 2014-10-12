<? /** Template Name: Event **/ ?>
<?php get_header(); ?>
<?php $tdu = get_template_directory_uri(); ?>
<?php $pagename='event'; ?>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/event.css">
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
<body>
<div class="clear"></div>

<div id="plan-event">

<div class="container">
<div id="page-subheader">
	<div class="event-subheader-image">
		<?php simple_image( 107 ); ?>
	</div>
	<div class="event-subheader-image">
		<?php simple_image( 108 ); ?>
	</div>
<!--
	<div class="event-subheader-image">
		<?php simple_image( 109 ); ?>
	</div>
-->
	<div class="event-subheader-image">
		<?php simple_image( 110 ); ?>
	</div>
	<div class="clear"></div>
	<div class="event-subheader-title">
		<p><?php simple_block( 111, 'Full and partial buyouts' ); ?></p>
	</div>
	<div class="event-subheader-title">
		<p><?php simple_block( 112, 'Happy hour and birthdays' ); ?></p>
	</div>
<!--
	<div class="event-subheader-title">
		<p><?php simple_block( 113, 'Large format dining and prix fixe dinners' ); ?></p>
	</div>
-->
	<div class="event-subheader-title" style="margin-right:0px">
		<p><?php simple_block( 114, 'Bowling with drinks and snacks' ); ?></p>
	</div>
</div>
<div class="clear"></div>
<?php //get_template_part("components/S1"); ?>
<div id="plan-event-alpha">
	<h2 class="dots"><span class="dots"><?php simple_block( 115, 'Plan Your Event at MBC' ); ?></span><div class="stripe-line"> </div></h2>
	<p><?php simple_block( 116, 'MBC offers a wide variety of event planning, from smaller birthday parties and company outings, to large scale venue buyouts and weddings. Our Events Staff can assist in the planning, budgeting, and execution, et cetera.' ); ?></p>
</div>

<div id="plan-event-contact">
	<h2 class="dots"><span class="dots"><?php simple_block( 117, 'Contact Form' ); ?></span><div class="stripe-line"> </div></h2>
	<?php echo do_shortcode('[contact-form-7 id="2218" title="Untitled"]'); ?>
	<div class="form hide">
	<div class="plan-event-contact-title">
		<p>Your Name:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="name" placeholder="Andrew Smith">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Email:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="email" name="email" placeholder="example@gmail.com">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Phone:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="phone" name="phone" placeholder="+1 (123) 456-7890">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Company:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="company" placeholder="Company XYZ">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>How Many People:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="count" placeholder="#">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Date:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="date" placeholder="<?php echo date('m/d/Y'); ?>">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Time:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="time" placeholder="3:00 pm">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Type of Event:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="event" placeholder="Birthday Party">
	</div>
	<div class="clear"></div>
	<p id="describe-event">(holiday party, birthday party, corporate event, etc.)</p>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Describe the Event:</p>
	</div>
	<div class="plan-event-contact-input">
		<textarea class="form-control" name="description"></textarea>
	</div>
	<br>
	<div class="clear"></div>
	<button type="button" class="btn btn-default" id='submit-contact'>Submit</button>
	<br>
	<br>
	<div id="response-text" style="color: #b5121b;"></div>
	</div>

</div>
</div>
<script>
jQuery(function($) {
	$('#submit-contact').click(function() {
		name = $('input[name="name"]').val();
                var ajaxdata = {
                        action:         'submit_contact_form',
			name:		 $('input[name="name"]').val(),
			email:		 $('input[name="email"]').val(),
			phone:		 $('input[name="phone"]').val(),
			company:	 $('input[name="company"]').val(),
			count:		 $('input[name="count"]').val(),
			datefield:	 $('input[name="date"]').val(),
			time:		 $('input[name="time"]').val(),
			eventfield:	 $('input[name="event"]').val(),
			description:	 $('textarea[name="description"]').val(),
                };

                $.post( ajaxurl, ajaxdata, function(res){
			$('#response-text').html(res);
			$('#submit-contact').unbind('click');
		});

	});
});
</script>

</div>
<?php include ('F.php'); ?>
</body>
</html>
<?php get_footer(); ?>
