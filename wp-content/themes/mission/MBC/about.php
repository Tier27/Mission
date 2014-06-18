<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="author" content="Tier 27, LLC">
  	<link type="text/css" rel="stylesheet" href="css/about.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="gmaps.js"></script>
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
<?php $pagename='about'; ?>
<?php include("H.php"); ?>
<div class="clear"></div>
<div id="about">

<div class="container">
	<div id="about-col-alpha">
		<div id="about-col-alpha-mailing-list">
			<h2 class="dots"><span class="dots">About MBC</span><div class="stripe-line"> </div></h2>
			<p>Mission Bowling Club is a boutique bowling alley that departs from tradition by serving award-winning food and extraordinary specialty cocktails, along with a rotating craft beer and wine list. Our six regulation bowling lanes offer automatic scoring and leather sofas for you to relax in between rolls. MBC is a destination for celebrations of all types, including birthdays, corporate outings, holiday parties, and weddings.</p><br>
 			<p>Owners Molly Bradshaw and Sommer Peterson are proud to bring their eclectic style and experience to add the many other flourishing small businesses in the Mission.</p><br>
			<p>Our kitchen offers a versatile menu that features locally sourced, seasonal ingredients transformed into elevated comfort food at its best. MBC serves brunch on the weekends, as well as dinner and bar snacks nightly.</p><br>
			<p>Reservations are highly recommended for both bowling and dining.</p>
			<p>To make a bowling reservation, <a href="bowling.php">click here</a></p>
			<p>To make a dining reservation, <a href="dinner.php">click here</a></p>
		</div>
		<div id="about-col-alpha-requests">
			<h2 class="dots"><span class="dots">Contact</span><div class="stripe-line"> </div></h2>
			<p>General Information: <a href="mailto:info@missionbowlingclub.com">info@missionbowlingclub</a></p>
 			<p>Media/Marketing/Press: <a href="mailto:sommer@missionbowlingclub.com">sommer@missionbowlingclub</a></p>
			<p>Special Events: <a href="mailto:events@missionbowlingclub.com">events@missionbowlingclub</a></p>
			<p>OR, fill out the <a href="bowling.php">Special Events Form</a></p>
			<p>Phone: <a href="tel:4156832895">415.683.2895 (BOWL)</a></p>
		</div>
		<div id="about-col-alpha-links">
			<h2 class="dots"><span class="dots">Hours</span><div class="stripe-line"> </div></h2>
			<p style="font-size: 16px; margin-bottom: 5px;">MBC is a 21+ venue Monday through Friday</p>
			<p>Monday – Wednesday: 3pm to 11pm</p>
			<p>Thursday & Friday: 3pm to Midnight</p>
			<p>Saturday: 11am to Midnight (21+ after 7pm)</p>
			<p>Sunday: 11am to 11pm (21+ after 7pm)</p><br>
		</div>
	</div>

	<div id="about-col-beta">
		<h2 class="dots"><span class="dots">Location</span><div class="stripe-line"> </div></h2>
		<div id="map_canvas"></div>
		<br>
			<p>3176 17th St (@ S. Van Ness)</p>
			<p>San Francisco, CA 94110</p>
			<p><a href="tel:4158632695">415.863.BOWL (2695)</a></p>
		<div class="clear"></div>
		<div id="about-col-alpha-faq">
			<h2 class="dots"><span class="dots">FAQs</span><div class="stripe-line"> </div></h2>
			<div class="q">
  				<h3 class="qhead"><a href="#q01">Are you 21 and over?</a></h3>
  				<div class="answer" id="q01"><p>Yes. Family bowl…</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q02">Can we eat/drink at the lanes?</a></h3>
  				<div class="answer" id="q02"><p>Answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q03">Can extra people hang out at the lanes that aren’t bowling?</a></h3>
  				<div class="answer" id="q03"><p>Answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q04">What are the hours of the outdoor patio?</a></h3>
  				<div class="answer" id="q04"><p>Answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q05">What is your policy on outside food?</a></h3>
  				<div class="answer" id="q05"><p>Answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q06">What is your corkage fee?</a></h3>
  				<div class="answer" id="q06"><p>Answer</p></div>
			</div>
			<div class="q">
  				<h3 class="qhead"><a href="#q07">What if I’m not a hipster - Am I allowed?</a></h3>
  				<div class="answer" id="q07"><p>Answer</p></div>
			</div>
			<br>
		</div>
		</div>
</div>
</div>
</div>
<?php include 'F.php'; ?>
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
</html>
