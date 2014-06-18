<!DOCTYPE HTML>
<html>
<?php include("H.php"); ?>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="author" content="Tier 27, LLC">
  	<link type="text/css" rel="stylesheet" href="css/menu.css">
<script>
$(document).ready(function(){ 
  $(".fadein").mouseover(function(){ 
    $("#preload").fadeOut()
  });
  $(".fadein").mouseover(function(){ 
    $("#preload").attr("src", this.src).stop(true,true).hide().fadeIn();
  }); 
}); 
</script>
<style>
#thumbnails ul li { display: inline-block; }
</style>
</head>
<body onLoad="javascript:preloader()">
<div class="clear"></div>
<div id="menu">
<div class="container">
		<!--<h2 class="dots"><span class="dots"><?php echo $tagline; ?></span><div class="stripe-line">&nbsp; </div></h2>-->
		<style> #<?php echo $pagename; ?>-menu { height: 100%; } </style>
<?php if ($pagename == 'dinner') { ?>
<!-- Start of Page Content for Dinner -->
	<div class="menu-image">
		<nav>
			<ul class="menu">
				<li><a href="#"><img src="mbc-1.jpg"></a></li>
				<li><a href="#"><img src="mbc-2.jpg"></a></li>
				<li><a href="#"><img src="mbc-3.jpg"></a></li>
			</ul>
		</nav>
		<div id="img-main">
			<img src="mbc-2-l.jpg">
		</div>
	</div>
	<div class="menu-content">
		<h2 class="dots"><span class="dots"><?php echo $tagline; ?></span><div class="stripe-line">&nbsp; </div></h2>
		<p>Mission Bowling Club is proud to serve award-winning, elevated comfort food by Executive Chef Frank. We offer 
			dinner service 7 days a week beginning at 6pm, as well as an extensive Happy Hour menu between 3pm-6pm everyday. 
			Come for the bowling, stay for the food.</p><br>
		<p>Parties of up to 8 can be made <a href="#">online.</a></p><br>
		<p>If your group will be larger than 8, please call to speak with a member of our Reservation Staff at <a href="tel:4158632695">415.863.2695</a></p><br>
		<p>Parties of 14-18 will require a Pre-Fix Dinner Menu</p>
	</div>
<!-- End of Page Content -->
<?php } ?>
<?php if ($pagename == 'brunch' || $pagename == 'drinks') { ?>
<!-- Start of Page Content for Brunch and Drinks -->
	<div class="menu-image">
		<nav>
			<ul class="menu">
				<li><a href="#"><img src="mbc-1.jpg"></a></li>
				<li><a href="#"><img src="mbc-2.jpg"></a></li>
				<li><a href="#"><img src="mbc-3.jpg"></a></li>
			</ul>
		</nav>
		<div id="img-main">
			<img src="mbc-2-l.jpg">
		</div>
	</div>
	<div class="menu-content">
		<h2 class="dots"><span class="dots"><?php echo $tagline; ?></span><div class="stripe-line">&nbsp; </div></h2>
		<p>Mission Bowling Club is proud to serve award-winning, elevated comfort food by Executive Chef Frank. We offer 
			dinner service 7 days a week beginning at 6pm, as well as an extensive Happy Hour menu between 3pm-6pm everyday. 
			Come for the bowling, stay for the food.</p><br>
		<p>Parties of up to 8 can be made <a href="#">online.</a></p><br>
		<p>If your group will be larger than 8, please call to speak with a member of our Reservation Staff at <a href="tel:4158632695">415.863.2695</a></p><br>
		<p>Parties of 14-18 will require a Pre-Fix Dinner Menu</p>
	</div>
<!-- End of Page Content -->








<?php } ?>
<style> #preload { height: 714px; } #menu { height: 600px; }</style>
	<div class="menu-col-alpha">
                       <!-- <img name="main" id="preload" onload="fadeIn(this)" src="img/DBD-1.jpg" width="470">-->
	<div id="thumbnails">
	<ul style="list-style: none;">
	<!--<?php foreach (get_set_ids(get_set_id($pagename.'-images')) as $child) { ?>
		<li><?php echo(execute_set_function($child)); ?></li>
<?php	} ?>-->
	</ul>
	</div>
	</div>

	
</div>
</div>
<?php include("F.php"); ?>
</body>
</html>








