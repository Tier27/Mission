<?php /** Template Name: About **/ ?>
<?php get_header(); ?>
<?php $tdu = get_template_directory_uri(); ?>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/about.css">
<script src="<?php echo $tdu; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php echo $tdu; ?>/js/gmaps.js"></script>
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
<body>
<?php $pagename='about'; ?>
<div class="clear"></div>
<div id="about">

<div class="container">
	<div id="about-col-alpha">
		<div id="about-col-alpha-mailing-list">
			<h2 class="dots"><span class="dots"><?php simple_block( 124, 'About MBC' ); ?></span><div class="stripe-line"> </div></h2>
			<p><?php simple_block( 118, 'Mission Bowling Club is a boutique bowling alley that departs from tradition by serving award-winning food and extraordinary specialty cocktails, along with a rotating craft beer and wine list. Our six regulation bowling lanes offer automatic scoring and leather sofas for you to relax in between rolls. MBC is a destination for celebrations of all types, including birthdays, corporate outings, holiday parties, and weddings.' ); ?></p><br>
 			<p><?php simple_block( 119, 'Owners Molly Bradshaw and Sommer Peterson are proud to bring their eclectic style and experience to add the many other flourishing small businesses in the Mission.' ); ?></p><br>
			<p><?php simple_block( 120, 'Our kitchen offers a versatile menu that features locally sourced, seasonal ingredients transformed into elevated comfort food at its best. MBC serves brunch on the weekends, as well as dinner and bar snacks nightly.' ); ?></p><br>
			<p><?php simple_block( 121, 'Reservations are highly recommended for both bowling and dining.' ); ?></p>
			<p><?php simple_block( 122, 'To make a bowling reservation, '); ?><a class="bowling-reservation-pointer" href="#">click here</a></p>
			<p><?php simple_block( 123, 'To make a dining reservation, ' ); ?><a class="dining-reservation-pointer" href="#">click here</a></p>
		</div>
		<div id="about-col-alpha-requests">
			<h2 class="dots"><span class="dots"><?php simple_block( 126, 'Contact' ); ?></span><div class="stripe-line"> </div></h2>
			<p>General Information: <a href="mailto:info@missionbowlingclub.com">info@missionbowlingclub.com</a></p>
 			<p>Media/Marketing/Press: <a href="mailto:sommer@missionbowlingclub.com">sommer@missionbowlingclub.com</a></p>
			<p>Special Events: <a href="mailto:events@missionbowlingclub.com">events@missionbowlingclub.com</a></p>
			<p>OR, fill out the <a href="<?php bloginfo('wpurl'); ?>/event">Special Events Form</a></p>
			<p>Phone: <a>415.683.2895 (BOWL)</a></p>
		</div>
		<div id="about-col-alpha-links">
			<h2 class="dots"><span class="dots"><?php simple_block( 127, 'Hours' ); ?></span><div class="stripe-line"> </div></h2>
			<p style="font-size: 16px; margin-bottom: 5px;"><?php simple_block( 128, 'MBC is a 21+ venue Monday through Friday' ); ?></p>
			<p><?php simple_block( 129, 'Monday – Wednesday: 3pm to 11pm' ); ?></p>
			<p><?php simple_block( 130, 'Thursday & Friday: 3pm to Midnight' ); ?></p>
			<p><?php simple_block( 131, 'Saturday: 11am to Midnight (21+ after 7pm)' ); ?></p>
			<p><?php simple_block( 132, 'Sunday: 11am to 11pm (21+ after 7pm)' ); ?></p><br>
		</div>
	</div>

	<div id="about-col-beta">
		<h2 class="dots"><span class="dots"><?php simple_block( 125, 'Location' ); ?></span><div class="stripe-line"> </div></h2>
		<div id="map_canvas"></div>
		<br>
			<p>3176 17th St (@ S. Van Ness)</p>
			<p>San Francisco, CA 94110</p>
			<p><a>415.863.BOWL (2695)</a></p>
		<div class="clear"></div>
		<div id="about-col-alpha-faq">
			<h2 class="dots"><span class="dots"><?php simple_block( 133, 'FAQs' ); ?></span><div class="stripe-line"> </div></h2>
			<div class="contents" data-id="general-faqs">
			<?php frontend_get_questions('general-faqs'); ?>
			</div>
			<br>
		</div>
		</div>
</div>
</div>
</div>
<?php include 'F.php'; ?>
</body>
<script>
jQuery(function($) {
	$('.bowling-reservation-pointer').click( function(e) {
		e.preventDefault();
		$('#modal-button').trigger('click');
	});
	$('.dining-reservation-pointer').click( function(e) {
		e.preventDefault();
		$('#dining-reservation-button').trigger('click');
	});
});
</script>
</html>
<?php get_footer(); ?>
