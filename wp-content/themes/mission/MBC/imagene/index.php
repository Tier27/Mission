<!DOCTYPE HTML>
<html>
<head>
<link type="text/css" rel="stylesheet" href="style.css">
<?php $pagename='index'; ?>
<?php require_once("functions.php"); ?>
<?php //style_the_active($pagename); ?>
<?php $images=mysql_query("select * from slider") or die(mysql_error()); ?>
<script src="jquery.min.js"></script>
<script>
var simages = new Array();
var stimer = new Array();
var sfadein = new Array();
var sfadeout = new Array();
<?php
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
echo "simages[$index]='$name'; stimer[$index]='$time'; sfadein[$index]=$fadein; sfadeout[$index]=$fadeout; "; } ?>
<?php echo "var count=".count($image_names)."; "; ?>
imgCounter=0;
function cycle() { if (imgCounter==count) { imgCounter=0; }
		   imgCounter++;
		   timer=stimer[imgCounter];  
		   setTimeout('$("#background").animate({ opacity: "1" }, <?php echo $background_fadein; ?>);', <?php echo $background_delay; ?>);
		   if (sfadein[imgCounter]>0) { document.getElementById("picture").style.opacity='0'; }
		   if (sfadein[imgCounter]==0) { document.getElementById("picture").style.opacity='1'; }
		   document.getElementById("picture").src='uploads/' + simages[imgCounter]; 
		   if (sfadein[imgCounter]!=0) { setTimeout('$("#picture").animate({ opacity: "1" }, sfadein[imgCounter]);', 0); }
		   if (sfadeout[imgCounter]!=0) { setTimeout('$("#picture").animate({ opacity: "0" }, sfadeout[imgCounter]);', 1000-sfadeout[imgCounter]+sfadein[imgCounter]); }
		   setTimeout("cycle();", timer); 
			}
</script>
</head>
<body onload="cycle();">
<div class="big-container">
<?php require_once("links.php"); ?>
<div id="container">
	<div class="pageheader">
		<h4>using the index</h4>
		<p>The index shows you what your slider looks like.  Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
			sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
	</div>



<?php 
	$locations=mysql_query("select name from places"); 
	while ($location=mysql_fetch_array($locations)) {
		echo '<div class="block">'.$location['name'].'<br> '; print_image($location['name'], 'uploads', 100, 100); echo '</div>'; } ?>

<?php $src=get_image_name('background'); ?>
<div id="slideshow" style="height: 600px; width: 100%; position: relative;">
<img id="background" src="uploads/<?php echo $src; ?>" style="display:block; width: 100%; height: 100%; position: absolute; opacity: 0; top: 0px"> 
<img id="picture" src="uploads/MBH-1.jpg" style="display:block; position: relative; margin: auto auto; margin-top: 150px; opacity: 1; width: 500px; "> 
</div>
</div>
</div><!--big-container-->
</body>
</html>
