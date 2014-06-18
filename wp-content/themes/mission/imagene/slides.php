<?php $pagename='slideshow'; ?>
<div class="big-container">
<?php
require_once("functions.php"); 
include("links.php"); 
?>
<div id="container">
  <div class="pageheader">
    <h4>the slideshow</h4>
    <p>This page allows you to edit the properties of the slideshow, setting image hold times, ordering, and fades.</p> 
  </div>

<?php foreach($_POST as $key => $post) { 
if ($key!='delay' && $key!='fadein' && $key!='remove') {
$key_pairs = explode('|', $key);  
$column = $key_pairs[0]; $value = $key_pairs[1]; 
$query="update slider set $column='$post' where id='$value'";
mysql_query($query) or die(mysql_error()); } 
else if ($key!='remove') { mysql_query("update globals set value=$post where variable='slider_background_$key'") or die(mysql_error()); } 
else if ($key=='remove') { mysql_query("delete from slider where name='$post'") or die(mysqL_error()); }
}
?>

<?php clean_order(); ?>
<?php 	$link=mysql_fetch_array(mysql_query("select id from places where name='background'")); $link_id=$link['id']; 
	$linked=mysql_fetch_array(mysql_query("select object from links where place='$link_id'")); $linked_id=$linked['object'];
	$image=mysql_fetch_array(mysql_query("select name from images where id='$linked_id'")); $image_name=$image['name'];
	$background_fadein = get_variable('slider background fadein'); 
	$background_delay = get_variable('slider background delay'); 
?>
<div class="component">
	<h5>Background</h5>
<div class="blocks">
<td><img src='uploads/<?php echo $image_name;?>' height=100 width=100></td>
</div>
<div class="blocks">
</div>
<div class="blocks">
<table>
<tr><td>delay</td></tr>
<tr><td><form action='' method='post'><input placeholder='<?php echo $background_delay; ?>' name='delay'></form></td></tr>
<tr><td>fade in</td></tr>
<tr><td><form action='' method='post'><input placeholder='<?php echo $background_fadein; ?>' name='fadein'></form></td></tr>
</table>
</div>
</div>
<br>
<div class="component">
<h5>Slideshow Settings</h5>
<?php $columns_query=mysql_query("select column_name from information_schema.columns where table_schema='mbc' and table_name='slider'") or die(mysql_error()); $columns = array();
while ($columns_array=mysql_fetch_array($columns_query)) { $columns[]=$columns_array['column_name']; } ?>
<table>
<tr><td>thumbnail</td><?php foreach ($columns as $column) { if ($column!='id'&&$column!='name') { echo "<td>$column</td>"; } } ?><td>Remove</td></tr>
<?php
$columns_list = implode(', ', $columns);
$images=mysql_query("select $columns_list from slider order by placement") or die(mysql_error());
$image_names=array();
while ($image=mysql_fetch_array($images)) 
		{ 	
			echo '<tr>'; 
		 	echo "<td><img src='uploads/".$image['name']."' height='100' width='100' ></td>";   
		 	foreach ($columns as $column) { $mark=$image['id']; 
	       			if ($column=='id'||$column=='name') { } 
	      			else { echo '<td><form action="" method="post"><input id="my-input" style="width: 100px;" placeholder="'.$image[$column].'" name="'.$column.'|'.$mark.'"></form></td>'; } 
			} ?>
			<td><form method="post"><input type="checkbox" name="remove" value="<?php echo $image['name']; ?>" checked><input type="submit" value='Remove'></form></td></tr>
<?php		} ?>
</table>
</div>
</div>
</div>
