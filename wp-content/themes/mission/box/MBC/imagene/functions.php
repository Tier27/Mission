<?php 
require_once("mysql.php");
function clean_order() 	{ 
			$list=mysql_query("select placement from slider order by placement desc") or die(mysql_error()); 
			while ($row=mysql_fetch_array($list)) { $p=$row['placement']; $j=$p+1; mysql_query("update slider set placement=$j where placement=$p") or die(mysql_error()); }
			$list=mysql_query("select placement from slider order by placement"); $i=1;
			while ($row=mysql_fetch_array($list)) { $p=$row['placement']; mysql_query("update slider set placement=$i where placement=$p"); $i++; }
				} 

function get_image_name($place)	{ $place = mysql_fetch_array(mysql_query("select id from places where name='$place'")); $id=$place['id'];
				  $link = mysql_fetch_array(mysql_query("select object from links where place='$id'")); $src_id=$link['object'];
				  $image = mysql_fetch_array(mysql_query("select name from images where id='$src_id'")); $src=$image['name'];
				  return $src; }

function return_image($place)	{ $src=get_image_name($place); if (!empty($src)) { $src_path="imagene/uploads/$src"; } return "<img id='$place' src='$src_path'>"; }

function return_image_by_src($src)	{ 
	$server=$_SERVER['SERVER_ADDR'];
	$src_path="http://$server/MBC/imagene/uploads/$src"; 
	return "<img src='$src_path'>"; }

function return_fadein_image($place)	{ 
	$src=get_image_name($place); if (!empty($src)) { 
		$server=$_SERVER['SERVER_ADDR'];
		$src_path="http://$server/MBC/imagene/uploads/$src"; 
	} 
	return "<img class='fadein' width=50 height=50 id='$place' src='$src_path'>"; 
}

function fadein_image($src) {
	$server=$_SERVER['SERVER_ADDR'];
	$src_path="http://$server/MBC/imagene/uploads/$src"; 
	return "<img class='fadein' width=50 height=50 src='$src_path'>"; 
}
	
function print_image($place, $path, $height, $width)	{ $src=get_image_name($place); if (!empty($src)) { $src_path="$path/$src"; } print "<img height=$height width=$width src='$src_path'>"; }
function get_variable($variable) { $globe=mysql_fetch_array(mysql_query("select value from globals where variable='$variable'")); return $globe['value']; } 
function get_post($title) { $post=mysql_fetch_array(mysql_query("select content from posts where title='$title'")); return $post['content']; } 

function print_table($table) {
	$query=mysql_query("select * from $table"); 
	while ($row=mysql_fetch_row($query)) {
		foreach ($row as $element) {
			echo $element.': ';
		}
		echo '<br>';
	}
}

function map_tree_to_table($tree) { ?>
	<table>
	<tr>
	<?php foreach ($tree as $key=>$branch) { ?>
		<td><table><tr><td><?php echo $key; ?></td></tr>
		<?php if (count($branch)!=0) { ?>
		<tr><td>
<?php			foreach ($branch as $leaf) {
				map_tree_to_table($leaf);
			} ?>
		</td></tr>
<?php		}
		else {
//			echo 'empty';
		} ?>
		</table></td>
	<?php } ?>
	</tr>
	</table>
<?php }

function map_tree_to_dropdown($tree) { ?>
	<select>
		<option></option>
	</select>
<?php }

function set_element_containment($set, $element) {
	echo hi;
}
	
function update_set_name($set_identification, $new_set_name) {
	return mysql_query("
		UPDATE sets
		SET set_name='$new_set_name'
		WHERE set_id=$set_identification
	") or die(mysql_error());
}

function get_element_id_from_place_id($place_id) {
	$Set=mysql_fetch_array(mysql_query("
		SELECT sets.set_name as name 
		FROM sets 
		JOIN places
		ON sets.set_name=places.name
		WHERE places.id=$place_id")) or die(mysql_error());
	return get_element_id($Set['name']);
}

function get_value_id_from_image_id($image_id) {
	$Value = mysql_fetch_array(mysql_query("
		SELECT element_values.value_id as ID
		FROM element_values
		JOIN images
		ON element_values.value_contents=images.name
		WHERE images.id=$image_id
	"));
	return $Value['ID'];
}

function title_set($set_name, $title) {
	$SID=get_set_id($set_name);
	mysql_query("INSERT INTO set_titles set set_id=$SID, set_title=$title");
}

function wrap_array($wrap, $array) {
	$wrapped=array();
	foreach($array as $element) {
		$wrapped[]="<$wrap>$element</$wrap>";
	}
	return $wrapped;
}

function p_wrap_array($array) {
	return wrap_array('p', $array);
}

function depipe_string($string) {
	return explode('|',$string);
}

function p_wrap_contents($contents) {
	return p_wrap_array(depipe_string($contents));
}

function p_print_contents($contents) {
	foreach (p_wrap_contents($contents) as $content) {
		print $content;
	}
}

function print_entry_form($table) {
	$id = get_set_id($table);
	if (in_array($id, get_set_ids(get_set_id('index-tables')))) {
		print_index_entry_form($table);
		print_breaks(1);
	}
	if (in_array($id, get_set_ids(get_set_id('pair-tables')))) {
		print_pair_entry_form($table);
		print_breaks(1);
	}
}

function print_index_entry_form($table) { ?>
	<form action='' type='post'>Add to <?php echo get_set_title(get_set_id($table)); ?>: <input type='text' name='<?php echo get_set_id($table); ?>' value='test'></form>
<?php }

function print_pair_entry_form($table) { ?>
	<form action='' type='post'>Add <?php echo get_set_title(get_set_id($table)); ?>:  <input type='text' name='<?php echo get_set_id($table); ?>' value='test'></form>
<?php }

function the_loop($set_identification, $i) {
	print_character(':::', $i);
	print_title($set_identification);
	if (set_type($set_identification)!=0) {
		$the_contents=get_contents($set_identification);	
		if (!empty($the_contents)) {
			print_character('-', 3);
			echo $the_contents;
			print_breaks(1);
		}
	}
	print_breaks(1);
	if (set_type($set_identification)==0) {
		foreach (get_set_contents($set_identification) as $set_identification=>$title) {
			the_loop($set_identification, $i+1);
		}
	}
}

function print_character($char, $int) {
	for ($i=0;$i<$int;$i++) {
		echo $char;
	}
}

function get_sets() {
	$sets=array();
	$set_ids=mysql_query("select set_id from sets") or die(mysql_error());
	while($set_id=mysql_fetch_array($set_ids)) {
		$sets[]=$set_id['set_id'];
	}
	return $sets;
}

function set_type($set_identification) {
	$set_type=mysql_fetch_array(mysql_query("select set_type from set_types where set_id=$set_identification"));
	return $set_type['set_type'];
}

function type_sets() {
	$sets=mysql_query("select set_id from sets");
	while ($set=mysql_fetch_array($sets)) {
		$set_identification=$set['set_id'];	
		$query=mysql_query("select set_element_id from inclusions where set_id=$set_identification") or die(mysql_error());
		if (mysql_num_rows($query)!=0) {
			mysql_query("replace into set_types set set_id=$set_identification, set_type=0") or die(mysql_error());
		}
		else {
			mysql_query("replace into set_types set set_id=$set_identification, set_type=1") or die(mysql_error());
		}
	}
}

function print_breaks($int) {
	for ($i=0;$i<$int;$i++) {
		echo '<br>';
	}
}

function get_set_id($set_name) {
	$array=mysql_fetch_array(mysql_query("select set_id from sets where set_name='$set_name'"));
	return $array['set_id'];
}
	
function get_element_id($set_name) {
	$array=mysql_fetch_array(mysql_query("
		SELECT element_id
		FROM elements 
		JOIN sets
		ON elements.set_element_id=sets.set_id 
		WHERE sets.set_name='$set_name'"));
	return $array['element_id'];
}

function element_id($set_element_id) {
	$array=mysql_fetch_array(mysql_query("SELECT element_id FROM elements WHERE set_element_id=$set_element_id"));
	return $array['element_id'];
}
		
function register_place($place) {
	mysql_query("INSERT INTO places SET name='$place'") or die(mysql_error());
	register_set($place);
	register_element($place);
	$element_id=get_element_id($place);
	register_element_function_pair($element_id, '7');	
}

function register_region($region) {
	mysql_query("INSERT INTO regions SET name='$region'") or die(mysql_error());
	register_set($region);
}

function register_set($set_name) {
	mysql_query("INSERT INTO sets SET set_name='$set_name'") or die(mysql_error());
}

function register_element($set_name) {
	$SID=get_set_id($set_name);
	mysql_query("INSERT INTO elements SET set_element_id=$SID");
	}

function register_inclusion($set_id, $set_element_id) {
	if (!exists_inclusion($set_id, $set_element_id)) {
		mysql_query("INSERT INTO inclusions SET set_id=$set_id, set_element_id=$set_element_id") or die(mysql_error());
	}
}

function register_region_inclusion($set_id, $set_element_id) {
	if (!exists_inclusion($set_id, $set_element_id)) {
		mysql_query("INSERT INTO inclusions SET set_id=$set_id, set_element_id=$set_element_id") or die(mysql_error());
	}
	if (exists_function($set_id)) {
		$function_id=get_superset_function_id($set_id);
		echo 'The function id is returning as '.$function_id;
		print_breaks(1);
		$element_id=element_id($set_element_id);
		echo 'The element id is returning as '.$element_id;
		print_breaks(1);
		mysql_query("REPLACE INTO element_function_pairs SET element_id=$element_id, function_id=$function_id") or die(mysql_error().' on element function updating');
	}
}
		
function exists_inclusion($set_id, $set_element_id) {
	return (mysql_num_rows(mysql_query("SELECT * FROM inclusions WHERE set_id=$set_id AND set_element_id=$set_element_id"))>0);
}


function exists_function($set_id) {
	return (mysql_num_rows(mysql_query("SELECT * FROM set_function_pairs WHERE set_id=$set_id"))>0);
}

function register_element_value_pair($element_id, $value_id) {
	mysql_query("INSERT INTO element_value_pairs SET element_id=$element_id, value_id=$value_id");
}

function register_element_function_pair($element_id, $function_id) {
	mysql_query("INSERT INTO element_function_pairs SET element_id=$element_id, function_id=$function_id") or die(mysql_error());
}
		
function unregister_element_function_pair($element_id) {
	mysql_query("DELETE FROM element_function_pairs WHERE element_id=$element_id") or die(mysql_error().'on functions');
}
			
function unregister_element_value_pair($element_id) {
	mysql_query("DELETE FROM element_value_pairs WHERE element_id=$element_id") or die(mysql_error().'on values');
}
	
function unregister_set($set_name) {
	mysql_query("DELETE FROM sets WHERE set_name='$set_name'") or die(mysql_error().'on sets');
	}


function unregister_element($set_name) {
	$SID=get_set_id($set_name);
	$EID=get_element_id($set_name);
	mysql_query("DELETE FROM inclusions WHERE set_element_id=$SID") or die(mysql_error().'on inclusions');
	unregister_element_value_pair($EID);
	unregister_element_function_pair($EID);
	mysql_query("DELETE FROM elements WHERE element_id=$EID") or die(mysql_error().'on elements');
	}

function unregister_place($place) {
	mysql_query("DELETE FROM places WHERE name='$place'");
	unregister_element($place);
}

function set_name_wrapping_paper($set_identification, $object) {
	$name = get_set_name($set_identification);
	return "<div id='$name'>$object</div>";
	
}

function get_set_name($set_identification) {
	$array=mysql_fetch_array(mysql_query("select set_name from sets where set_id='$set_identification'"));
	return $array['set_name'];
}

function get_element_name($element_identification) {
	$array=mysql_fetch_array(mysql_query("select set_element_id from elements where element_id=$element_identification"));
	$set_identification=$array['set_element_id'];
	return get_set_name($set_identification); 
}

function get_set_children_names($set_identification) {
	$query=mysql_query("select sets.set_id as id, sets.set_name as name from sets join inclusions on sets.set_id=inclusions.set_element_id where inclusions.set_id=$set_identification");
	$chilren_names=array();
	while($child=mysql_fetch_array($query)) {
		$children_names[$child['id']]=$child['name'];
	}
	return $children_names;
}

function get_parent_id($set_element_identification) {
	$array=mysql_fetch_array(
		mysql_query("
			SELECT set_id 
			FROM inclusions 
			WHERE set_element_id=$set_element_identification
		")
	);
	if (!empty($array)) {
		return $array['set_id'];
	}
}	

function get_set_title($set_identification) {
	$array=mysql_fetch_array(mysql_query("select set_title from set_titles where set_id=$set_identification"));
	return $array['set_title'];
}

function print_title($set_identification) {
	print get_set_title($set_identification);
}
 
function print_name($set_identification) {
	echo get_set_name($set_identification);
}

function get_set_ids($set_identification) {
	$set_element_identifications=array();
	$set_elements=mysql_query("select set_element_id from inclusions where set_id=$set_identification") or die(mysql_error());
	while ($set_element=mysql_fetch_array($set_elements)) {
		$set_identification=$set_element['set_element_id'];
		$set_element_identifications[]=$set_identification;
	}
	return $set_element_identifications;
}

function get_set_ids_recursively($set_identification, $set_array) {
	$children = get_set_ids($set_identification);
	$Children = array();
	foreach ($children as $child) {
		$Children=get_set_ids_recursively($child, $Children);
	}
	if (count($Children)==0) {
		echo get_set_name($set_identification);
		print_breaks(1);
	}
	$set_array[get_set_name($set_identification)]=$Children;
	return $set_array;
}

function get_set_contents($set_identification) {
	$set_element_identifications=array();
	$set_elements=mysql_query("select set_element_id from inclusions where set_id=$set_identification") or die(mysql_error());
	while ($set_element=mysql_fetch_array($set_elements)) {
		$set_identification=$set_element['set_element_id'];
		$set_title=get_set_title($set_identification);
		$set_element_identifications[$set_identification]=$set_title;
	}
	return $set_element_identifications;
}

function get_set_children_titles($set_identification) {
	$set_element_identifications=array();
	$set_elements=mysql_query("select set_element_id from inclusions where set_id=$set_identification") or die(mysql_error());
	while ($set_element=mysql_fetch_array($set_elements)) {
		$set_title=get_set_title($set_element['set_element_id']);
		$set_element_titles[]=$set_title;
	}
	return $set_element_titles;
}


function print_set_children_names($set_id, $delimiter) {
	foreach (get_set_contents($set_id) as $set_id => $set_title) {
		print get_set_name($set_id);
		print $delimiter;
	}
}
		
function execute_set_function($set_identification) {
	return return_set_function($set_identification, get_contents($set_identification));
}

function return_set_function($set_identification, $args) {
	$set_function=get_set_function($set_identification);
	return $set_function($args);
}

function run_set_function($set_identification) {
	$set_function=get_set_function($set_identification);
}

function set_include($set_identification) {
	$contents=get_contents($set_identification);
	echo hi;
	echo $contents;
	include($contents);
}

function get_superset_function_id($superset_identification) {
	$array=mysql_fetch_array(mysql_query("SELECT function_id FROM set_function_pairs WHERE set_id=$superset_identification")) or die(mysql_error().' on superset function fetch');
	return $array['function_id'];
}

function get_set_function($set_identification) {
	$element_mapping=mysql_query("select element_id from elements where set_element_id=$set_identification") or die(mysql_error());
	$rows=mysql_num_rows($element_mapping);
	if ($rows!=0) {
		$array=mysql_fetch_array(mysql_query("select element_id from elements where set_element_id=$set_identification")) or die(mysql_error());
		$element_identification=$array['element_id'];
		$array=mysql_fetch_array(mysql_query("select function_id from element_function_pairs where element_id=$element_identification")) or die(mysql_error().'here');
		$function_identification=$array['function_id'];
		$array=mysql_fetch_array(mysql_query("select function_name from element_functions where function_id=$function_identification")) or die(mysql_error());
		$function_name=$array['function_name'];
		return $function_name;
	}
}


function get_contents($set_identification) {
	$element_mapping=mysql_query("select element_id from elements where set_element_id=$set_identification") or die(mysql_error().' with set ID '.$set_identification);
	$rows=mysql_num_rows($element_mapping);
	if ($rows!=0) {
		$array=mysql_fetch_array(mysql_query("select element_id from elements where set_element_id=$set_identification")) or die(mysql_error());
		$element_identification=$array['element_id'];
		$array=mysql_fetch_array(mysql_query("select value_id from element_value_pairs where element_id=$element_identification")) or die(mysql_error());
		$value_identification=$array['value_id'];
		$array=mysql_fetch_array(mysql_query("select value_contents from element_values where value_id=$value_identification")) or die(mysql_error());
		$contents=$array['value_contents'];
		return $contents;
	}
}

function print_contents($set_identification) {
	print get_contents($set_identification);
	}

function get_children_contents($set_identification) {
	$element_identifications=mysql_query("select set_element_id from inclusions where set_id=$set_identification") or die(mysql_error());
	$elements=array();
	while ($element_identification=mysql_fetch_array($element_identifications)) {
		$sid=$element_identification['set_element_id'];
		$tuple=array("title"=>get_set_title($sid), "contents"=>get_contents($sid));
		$elements[$sid]=$tuple;
	}
	return $elements;
}


?>

