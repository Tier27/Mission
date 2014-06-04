<?php require_once('imagene/functions.php'); ?>
test
<?php print_entry_form('sets'); ?>
<?php
	$query = mysql_query("SELECT name FROM places");
	while ($place=mysql_fetch_array($query)) {
		echo $place['name'].'<br>';
	}
?>
