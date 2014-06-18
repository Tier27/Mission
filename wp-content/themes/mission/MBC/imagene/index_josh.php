<!DOCTYPE HTML>
<html>
<head>
<?php require_once("functions.php");  ?>
<?php include("links.php");  ?>
<?php $images=mysql_query("select * from slider") or die(mysql_error()); ?>
<script src="jquery.min.js"></script>
<script>
var simages = new Array();
var stimer = new Array();
var sfadein = new Array();
var sfadeout = new Array();
<?php
$background_fadein = mysql_fetch_array(mysql_query("select value from globals where variable='slider background fadein'"));
$background_fadein_time = $background_fadein['value'];
echo "background_fadein='$background_fadein_time'; "; 
$image_names=array();
while ($image=mysql_fetch_array($images)) { 
array_push($image_names, str_replace("_",".",$image['name'])); 
$index=$image['placement'];
$name=str_replace("_",".",$image['name']);
$time=$image['period'];
$fadein=$image['fadein'];
$fadeout=$image['fadeout'];
echo "simages[$index]='$name'; stimer[$index]='$time'; sfadein[$index]='$fadein'; sfadeout[$index]='$fadeout'; "; } ?>
<?php echo "var count=".count($image_names)."; "; ?>
imgCounter=0;
function cycle() { if (imgCounter==count) { return; }
		   imgCounter++;
		   timer=stimer[imgCounter];  
		   setTimeout('$("#background").animate({ opacity: "1" }, 1000);', background_fadein);
		   if (sfadein[imgCounter]>0) { document.getElementById("picture").style.opacity='0'; }
		   if (sfadein[imgCounter]==0) { document.getElementById("picture").style.opacity='1'; }
		   document.getElementById("picture").src='uploads/' + simages[imgCounter]; 
		   if (sfadein[imgCounter]!=0) { setTimeout('$("#picture").animate({ opacity: "1" }, sfadein[imgCounter]);', 0); }
		   if (sfadeout[imgCounter]!=0) { setTimeout('$("#picture").animate({ opacity: "0" }, sfadeout[imgCounter]);', timer-sfadeout[imgCounter]); }
		   setTimeout("cycle();", timer); 
			}
</script>
</head>
<body onload="cycle();">
<?php $src=get_image_name('background'); ?>
<img id="background" src="uploads/<?php echo $src; ?>" style="display:block; position: absolute; width: 100%; height: 100%; opacity: 0;"> 
<img id="picture" src="" style="display:block; position: relative; margin: auto auto; margin-top: 100px; opacity: 1;"> 
<?php $locations=array('logo', 'dinner', 'brunch', 'drinks'); ?>
<?php foreach ($locations as $location) {
echo $location.':: '; print_image($location, 'uploads', 100, 100); echo '<br>'; echo '<br>'; } ?>
</body>
</html>
