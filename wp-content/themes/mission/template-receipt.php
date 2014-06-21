<? /** Template Name: Receipt **/ ?>
<?php get_header(); ?>
<?php $tdu = get_template_directory_uri(); ?>
<?php $pagename='event'; ?>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/event.css">
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/receipt.css">

<body>
<div class="clear"></div>

<div id="plan-event">

<div class="container new-page">

<p>Dear {person},</p><br>

<p>This page confirms that you have sent Mission Bowling Club a payment of {$35.00USD}.</p>

<h2 class="dots"><span class="dots">Payment Details</span><div class="stripe-line"> </div></h2>

		<table>
			<tr>
				<td>Transaction ID:</td>
				<td>8523323532523</td>
			</tr>

			<tr>
				<td>Item Price:</td>
				<td>$35.00</td>
			</tr>

			<tr>
				<td>Total:</td>
				<td>$35.00</td>
			</tr>
		</table>
	
<h2 class="dots"><span class="dots">Bowling Information</span><div class="stripe-line"> </div></h2>
	<!--Bowlers-->
	<div class="plan-event-contact-title">
		<p>Bowlers:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		1
	</div>
	<div class="clear"></div>

	<!--Lanes-->
	<div class="plan-event-contact-title">
		<p>Lanes:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		1
	</div>
	<div class="clear"></div>

	<!--Start-->
	<div class="plan-event-contact-title">
		<p>Start Time:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		3:00 pm
	</div>
	<div class="clear"></div>

	<!--Hours-->
	<div class="plan-event-contact-title">
		<p>Hours:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		1
	</div>
	<div class="clear"></div>

	<!--Price-->
	<div class="plan-event-contact-title">
		<p>Price:</p>
	</div>
	<div class="plan-event-contact-input bowling-output">
		$35.00
	</div>
	<div class="clear"></div>

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
