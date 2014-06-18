<?php $pagename='thumbs'; ?>
<?php require_once("functions.php"); ?>
<style>
	.big-container {
		overflow: auto;
	}
</style>
<div class="big-container">
<?php include ("links.php"); ?>
<div id="container">
  <div class="pageheader">
    <h4>thumbnails</h4>
    <p>The thumbnails section allows you to choose which area you want your image to appear.</p>
  </div>
<div class="col-alpha">
<img id="main-thumb" width=200 height=200>
<form action="" type="post">
<input type="checkbox" name="identification" id="selected-image" value="none" checked><br>
<?php $image_list = mysql_query("select id, name from images"); $i=0; 

$places = mysql_query("select id, name from places"); 
while($place = mysql_fetch_array($places)) { $this_place=$place['name']; $i++; ?>
<input type="checkbox" id="c<?php echo $i; ?>" name="<?php echo $i; ?>" value="<?php echo $place['id']; ?>"><label for="c<?php echo $i; ?>"><span></span><?php echo $place['name']; ?></label><br>
<?php } ?>
<input type="checkbox" id="c<?php $i++; echo $i; ?>" name="slideshow" value="on"><label for="c<?php echo $i; ?>"><span></span>add <div class="lowercase">to</div> slider</label><br>
<br>
<input type="submit" id="submit">
</form>
</div>

<div class="col-beta">
<?php
while($image = mysql_fetch_array($image_list)) { ?>
<div class="block"><img onclick="this.style.border='solid 1px blue'; document.getElementById('selected-image').value=this.id; document.getElementById('main-thumb').src=this.src; " id="<?php echo $image['id']; ?>" src="uploads/<?php echo $image['name']; ?>" height=100 width=100><br><div id="thumb-title"><?php echo $image['name']; ?></div><br></div>
<?php } ?>
<?php $count=mysql_fetch_array(mysql_query("select count(*) as total from slider")); ?>

<?php $i = $count['total']; ?>
<?php 
	$id = $_GET['identification'];
	foreach ($_GET as $key=>$place) 
		{ 
			if ($key!='identification' && $key !='slideshow') {
				mysql_query("replace into links set place=$place, object=$id") or die(mysql_error()); 
				$EID=get_element_id_from_place_id($place);
				$VID=get_value_id_from_image_id($id);
				echo 'The place ID is '.$place;
				echo 'The value ID is '.$VID;
				echo 'The element ID is '.$EID;
				mysql_query("replace into element_value_pairs set element_id=$EID, value_id=$VID") or die(mysql_error());
			}
			if ($key=='slideshow') 
				{ 
				$image = mysql_fetch_array(mysql_query("select name from images where id=$id")); 
				$image_name=$image['name'];
				$i++;
				mysql_query("insert into slider set name='$image_name', placement=$i") or die(mysql_error());
				}
		}
?>
<?php foreach ($_GET as $key=>$status) { 	$key = str_replace('|','.',$key); 
						if ($status=='slideshow') { $i++; mysql_query("replace into slider set name='$key', placement=$i") or die(mysql_error()); } 
						} ?>
<?php clean_order(); ?>
</div>
</div>
</div>
