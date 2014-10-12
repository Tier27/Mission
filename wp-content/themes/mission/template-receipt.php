<? /** Template Name: Receipt **/ ?>
<?php get_header(); ?>
<?php $tdu = get_template_directory_uri(); ?>
<?php $pagename='receipt'; ?>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/event.css">
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/receipt.css">

<body>
<div class="clear"></div>

<div id="plan-event">

<div class="container new-page">

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
</div>
<?php include ('F.php'); ?>
</body>
</html>
<?php get_footer(); ?>
