<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="author" content="Tier 27, LLC">
  	<link type="text/css" rel="stylesheet" href="css/about.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="js/gmaps.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  	<title>Mission Bowling Club</title>
  	<script>
	$(document).ready(function(){
 		var map = new GMaps({
    	el: '#map_canvas',
    	lat: 37.767456,
    	lng: -122.416749,
    	zoom: 14,
  		});
  		map.addMarker({
    	lat: 37.764456,
    	lng: -122.416749,
 		title: 'Mission Bowling Club',
 		click: function(e) {
   		alert('You clicked in this marker');
 	}
	});
	});
	</script>
</head>
<body>
<?php include("H.php"); ?>
<div class="clear"></div>
<div id="about">
<div class="container">
	<div id="about-col-alpha">
		<div id="about-col-alpha-mailing-list">
			<h2 class="dots"><span class="dots">Mailing List</span></h2>
			<p>Sign up for our mailing list and save <strong>$5 off</strong> your next in-store purchase; whether it be drinks, food, or bowling:</p><br>
			<div class="contact-title">
				<p>Email:</p>
			</div>
			<div class="contact-input">
				<input type="email" name="email" placeholder="example@gmail.com">
			</div>
			<div class="clear"></div>
			<div class="contact-title">
				<p>Re-enter Email:</p>
			</div>
			<div class="contact-input">
				<input type="email" name="email" placeholder="example@gmail.com">
			</div>
			<div class="clear"></div>
			<a class="button" href="#">Add to List</a>
			<div class="clear"></div>
			<p>We'll send you a quick email to confirm your email address. You'll receive an offer for $5 off within seven business days of that confirmation.</p>
		</div>
		<div id="about-col-alpha-requests">
			<h2 class="dots"><span class="dots">Requests</span></h2>
			<p>For general inquiries, <a href="#">click here</a></p>
			<p>For press inquiries, <a href="#">click here</a></p>
			<p>To apply for food concessions, <a href="#"> please download and fill out this form</a></p>
			<p>For vendor inquires, <a href="#">click here</a></p>
			<p>For sponsor inquiries, <a href="#">click here</a></p>
			<p>For volunteer inquiries, <a href="#">click here</a></p>
		</div>
		<div id="about-col-alpha-links">
			<h2 class="dots"><span class="dots">Links</span></h2>
			<p><a href="#">Press Link 1</a></p>
			<p><a href="#">Press Link 3</a></p>
			<p><a href="#">Press Link 3</a></p>
			<p><a href="#">Press Link 4</a></p>
			<p><a href="#">Press Link 5</a></p><br>
		</div>
	</div>

	<div id="about-col-beta">
		<div id="map_canvas"></div>
		<div class="clear"></div>
		<div id="about-col-alpha-faq">
			<h2 class="dots"><span class="dots">FAQs</span></h2>
			<div class="q">
  				<h3 class="qhead"><a href="#q01">This is where Question 1 goes</a></h3>
  				<div class="answer" id="q01"><p>And here is the answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q02">This is where Question 2 goes</a></h3>
  				<div class="answer" id="q02"><p>And here is the answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q03">This is where Question 3 goes</a></h3>
  				<div class="answer" id="q03"><p>And here is the answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q04">This is where Question 4 goes</a></h3>
  				<div class="answer" id="q04"><p>And here is the answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q05">This is where Question 5 goes</a></h3>
  				<div class="answer" id="q05"><p>And here is the answer</p></div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
	$(document).ready(function(){
  $(".qhead a").on("click", function(e){
    e.preventDefault();
    var href = $(this).attr("href");
    
    $(href).fadeToggle(450);
  });
});
</script>
</body>
<?php include("F.php"); ?>
</html>
