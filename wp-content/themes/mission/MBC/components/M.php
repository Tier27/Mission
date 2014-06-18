<!DOCTYPE HTML>
<html>
<?php include("H.php"); ?>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="author" content="Tier 27, LLC">
  	<link type="text/css" rel="stylesheet" href="css/dinner.css">
  	
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
<?php //include ('header.php'); ?>
<div class="clear"></div>
<div id="dinner">
<div class="container">
<style> #preload { height: 700px; } #menu { height: 650px; }</style>
	<div class="menu-col-alpha">
                        <img name="main" id="preload" onload="fadeIn(this)" src="img/DBD-1.jpg" width="470">
	<div id="thumbnails">
	<ul style="list-style: none;">
        <?php for ($i=1;$i<4;$i++) { echo
        "<li><img class='fadein' src='img/DBD-$i.jpg' width='50' height='50' id='imgs'></li> ";
        } ?>
	</ul>
	</div>
	</div>

	<div class="menu-col-beta">
		<h2 class="dots"><span class="dots"><?php echo $tagline; ?></span><div class="stripe-line"> </div></h2>
		<div class="menu-pdf">
			<img id="menu" src="img/menu.jpg">
		</div>
	</div>
</div>
</div>
<?php include("F.php"); ?>
</body>
</html>
