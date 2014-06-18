<!DOCTYPE HTML>
<html>
<head>
<script src="js/jquery.min.js"></script>
<?php require_once("imagene/functions.php"); ?>
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
function cycle() { if (imgCounter==count) { return; }
		   imgCounter++;
		   timer=stimer[imgCounter];  
		   setTimeout('$("#background").animate({ opacity: "1" }, <?php echo $background_fadein; ?>);', <?php echo $background_delay; ?>);
		   if (sfadein[imgCounter]>0) { document.getElementById("picture").style.opacity='0'; }
		   document.getElementById("picture").src='imagene/uploads/' + simages[imgCounter]; 
		   if (sfadein[imgCounter]==0) { setTimeout(function () { document.getElementById("picture").style.opacity='1'; }, 50); }
		   if (sfadein[imgCounter]!=0) { setTimeout(function () { $("#picture").animate({ opacity: "1" }, sfadein[imgCounter]); }, 0); }
		   if (sfadeout[imgCounter]>0) { setTimeout(function () { $("#picture").animate({ opacity: "0" }, sfadeout[imgCounter]); }, timer-sfadeout[imgCounter]-sfadein[imgCounter]); }
		   setTimeout("cycle();", timer); 
			}
</script>
</head>
<body onload="cycle();">
<?php $src=get_image_name('background'); ?>
<?php require_once("H.php"); ?>
<div id="photo-gallery">
<img id="left-arrow" class="photo-nav-arrow beginHide fadeIn fadeInThree" src="css/left-arrow-clean.png">
<div id="right-arrow" class="photo-nav-arrow beginHide fadeIn fadeInThree"></div>
<img id="background" src="imagene/uploads/<?php echo $src; ?>" style="display:block; position: absolute; width: 100%; height: 100%; opacity: 0;"> 
<img id="picture" src="" style="display:block; position: relative; margin: auto auto; margin-top: 100px; opacity: 0;"> 
</div>
<?php include("F.php"); ?>
</body>
</html>
