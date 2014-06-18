<?php require_once("functions.php"); ?>
<?php $pagename='variables'; ?>
<?php if (isset($_POST) && !empty($_POST)) {
	foreach ($_POST as $key=>$post) {	
		mysql_query("update globals set value='$post' where variable='$key'") or die(mysql_error()); 
		}
	}
?>



<div class='big-container'>
<?php require_once("links.php"); ?>
<table>
<tr><td>Variable</td><td>Value</td></tr>
<?php
$globals_list=mysql_query("select * from globals");
while ($globe=mysql_fetch_array($globals_list)) { ?>
<tr>
<td><?php echo str_replace('_', ' ', $globe['variable']); ?></td>
<td><form method="post"><input type="text" name="<?php echo $globe['variable']; ?>" placeholder="<?php echo $globe['value'];?>"></form></td>
<?php } ?>
</table>
</div>

