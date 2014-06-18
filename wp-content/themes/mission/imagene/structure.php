<?php require_once("functions.php"); ?>
<?php $pagename='structure'; ?>
<div class='big-container'>
<?php require_once("links.php"); ?>
<?php require_once("links.structure.php"); ?>
<?php
type_sets();
the_loop(1, 0); 
print_breaks(12);
$set_element_id = get_set_id('pricing-tab');
echo get_set_title(get_set_id('information-tab-reservations'));
print_r(get_contents(get_set_id('information-tab-reservations')));
print_title($set_element_id); 
print_breaks(2);
$set_contents = get_set_contents($set_element_id);
foreach ($set_contents as $set_element_identification=>$set_element_name) {
		echo $set_element_name.'<br>';
		print_breaks(2);
		$elements = get_children_contents($set_element_identification);
		foreach($elements as $element) {
			echo $element['title'].': '.$element['contents'].'<br>';
		}
		print_breaks(2);
	}
	
print_breaks(15);
$set_elements=mysql_query("select set_element_id from inclusions where set_id=$set_element_id");
while ($set_element=mysql_fetch_array($set_elements)) {
	$set_element_id=$set_element['set_element_id'];
	print_title($set_element_id);
	print_breaks(2);
	$elements = get_children_contents($set_element_id);
	foreach($elements as $element) {
		echo $element['title'].': '.$element['contents'].'<br>';
	}
	print_breaks(2);
}

$sets=get_sets();
print_r($sets);
foreach ($sets as $set) {
		echo get_contents($set);
		print_breaks(1);
	}
?>
</div>

