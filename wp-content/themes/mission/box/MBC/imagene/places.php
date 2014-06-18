<?php require_once("functions.php"); ?>
<?php $pagename='places'; ?>
<div class='big-container'>
<?php
	if (isset($_GET) && !empty($_GET)) {
		print_r($_GET);
		print_r($_POST);
		$Place = $_GET['Place'];
		$Region = $_GET['Region'];
		$PID = get_set_id($Place);
		$RID = get_set_id($Region);
		echo $Place.' goes to '.$Region;
		echo $PID.' goes to '.$RID;
		register_region_inclusion($RID, $PID);
	}
	if (isset($_POST)) {
		foreach ($_POST as $Type=>$Set) {
			if ($Type=='Add_Place') {
				register_place($Set);
			}
			if ($Type=='Add_Region') {
				register_region($Set);
			}
			if ($Type=='Clear_Place') {
				$Place_ID=mysql_fetch_array(mysql_query("SELECT id as ID FROM places WHERE name='$Set'"));
				$PID=$Place_ID['ID'];
				mysql_query("DELETE FROM links WHERE place='$PID'") or die(mysql_error());
			}
			if ($Type=='Clear_Region') {
				$SID=get_set_id($Set);
				mysql_query("DELETE FROM inclusions WHERE set_id='$SID'") or die(mysql_error().' on clearing the region');
			}
			if ($Type=='Delete_Place') {
				unregister_place($Set);
				unregister_set($Set);
			}
			if ($Type=='Delete_Region') {
				echo 'You can"t delete a region yet';
			}
		}
	}
?>
<?php require_once("links.php"); ?>
<?php 
	$locations=mysql_query("select name from places"); 
	while ($location=mysql_fetch_array($locations)) { ?>
		<div class="block"><?php echo $location['name']; ?><br><?php print_image($location['name'], 'uploads', 100, 100); ?></div> 
<?php	} 
?>
</div>
<div class='big-container'>
<?php 
	$Region_Query=mysql_query("SELECT name FROM regions");
	$Regions=array();
	while ($Region=mysql_fetch_array($Region_Query)) {
		$Regions[]=$Region['name'];
	}
?>
<?php foreach ($Regions as $Region) { ?>
<div class="block">
<?php echo $Region ?>
<div class="block">
<?php 
	foreach ((get_set_ids(get_set_id($Region))) as $child) { ?>
		<div class="block">
<?php		echo(execute_set_function($child)); ?>
		</div>
<?php	}
?>
</div>
</div>
<br>
<?php } ?>

<form action='' method='post'>Add place<input type='text' name='Add_Place'></form>
<form action='' method='post'>Add region<input type='text' name='Add_Region'></form>
<form action='' method='post'>Clear place<input type='text' name='Clear_Place'></form>
<form action='' method='post'>Clear region<input type='text' name='Clear_Region'></form>
<form action='' method='post'>Delete place<input type='text' name='Delete_Place'></form>
<form action='' method='post'>Delete region<input type='text' name='Delete_Region'></form>
<form action='' method='get'>Add place to region
Place
<select name='Place'>
<?php 
	$Places=mysql_query("SELECT name FROM places");
	while ($Place=mysql_fetch_array($Places)) { ?>
	<option value='<?php echo $Place['name']; ?>'><?php echo $Place['name']; ?></option>
<?php	}
?>
</select>
Region
<select name='Region'>
<?php 
	$Regions=mysql_query("SELECT name FROM regions");
	while ($Region=mysql_fetch_array($Regions)) { ?>
	<option value='<?php echo $Region['name']; ?>'><?php echo $Region['name']; ?></option>
<?php	}
?>
</select>
<input type='submit' value'Submit'>
</form>
</div>

