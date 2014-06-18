<?php require_once("functions.php"); ?>
<?php $pagename='sets'; ?>
<div class='big-container'>
<?php require_once("links.php"); ?>
<?php
	$Array = array();
	$tree = get_set_ids_recursively(1, $Array);
	print_r($tree);
	map_tree_to_dropdown($tree);
	map_tree_to_table($tree);
	print_breaks(5);
	print_r(get_set_contents(1));
		print_breaks(2);
	foreach (get_set_contents(1) as $child_id => $child) {
		echo $child.': ';
		print_r(get_set_contents($child_id));
		print_breaks(2);
		foreach (get_set_contents($child_id) as $grandchild_id => $grandchild) {
			echo $grandchild.': ';
			print_r(get_set_contents($grandchild_id));
			print_breaks(2);
		}
	}
?>
</div>

