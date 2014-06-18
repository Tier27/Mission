<!DOCTYPE HTML>
<?php $pagename='event'; ?>
<?php include("H.php"); ?>
<html>
<head>
  <link type="text/css" rel="stylesheet" href="css/event.css">
  <link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
  <title>Mission Bowling Club</title>
</head>
<body>
<?php //include ('header.php'); ?>
<div class="clear"></div>

<div id="plan-event">

<div class="container">
<div id="page-subheader">
	<div class="event-subheader-image">
		<img src="imagene/uploads/<?php echo get_image_name('event-buyouts'); ?>">
	</div>
	<div class="event-subheader-image">
		<img src="imagene/uploads/<?php echo get_image_name('event-birthdays'); ?>">
	</div>
	<div class="event-subheader-image">
		<img src="imagene/uploads/<?php echo get_image_name('event-dining'); ?>">
	</div>
	<div class="event-subheader-image">
		<img src="imagene/uploads/<?php echo get_image_name('event-bowling'); ?>">
	</div>
	<div class="clear"></div>
	<div class="event-subheader-title">
		<p>Full and partial buyouts</p>
	</div>
	<div class="event-subheader-title">
		<p>Happy hour and birthdays</p>
	</div>
	<div class="event-subheader-title">
		<p>Large format dining and prix fixe dinners</p>
	</div>
	<div class="event-subheader-title" style="margin-right:0px">
		<p>Bowling with drinks and snacks</p>
	</div>
</div>
<div class="clear"></div>
<?php include("S1.php"); ?>
<div id="plan-event-alpha">
	<h2 class="dots"><span class="dots">Plan Your Event at MBC</span><div class="stripe-line"> </div></h2>
	<p>MBC offers a wide variety of event planning, from smaller birthday parties and company outings, to large scale venue buyouts and weddings. Our Events Staff can assist in the planning, budgeting, and execution, et cetera.</p>
</div>

<div id="plan-event-contact">
	<h2 class="dots"><span class="dots">Contact Form</span><div class="stripe-line"> </div></h2>
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
		<input type="text" name="number-of-people" placeholder="#">
	</div>
	<div class="clear"></div>
	<div class="plan-event-contact-title">
		<p>Date:</p>
	</div>
	<div class="plan-event-contact-input">
		<input type="text" name="date" placeholder="Click Here">
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
		<input class="box" type="text" name="description">
	</div>
	<div class="clear"></div>
	<a class="button" href="#">Submit</a>
</div>
</div>

</div>
<?php include ('F.php'); ?>
</body>
</html>
