<?php require_once("functions.php"); ?>
<?php $pagename='content'; ?>
<?php if (isset($_POST) && !empty($_POST)) {
	if (isset($_POST['title']) && isset($_POST['content'])) { 
		$title=$_POST['title']; 
		$content=$_POST['content'];
		mysql_query("insert into posts set title='$title', content='$content'") or die(mysql_error()); 
	}
	else { 
		foreach ($_POST as $key=>$post) {	
			echo $key.': '.$post;
			$key = str_replace('_', ' ', $key);
			mysql_query("update posts set content='$post' where title='$key'") or die(mysql_error()); 
		}
	}
}
?>



<div class='big-container'>
<?php require_once("links.php"); ?>
<table>
<tr><td>Title</td><td>Content</td></tr>
<?php
$posts_list=mysql_query("select * from posts");
while ($post=mysql_fetch_array($posts_list)) { ?>
<tr>
<td><?php echo str_replace('_', ' ', $post['title']); ?></td>
<td><form method="post">
<textarea name="<?php echo $post['title']; ?>" rows=5 cols=81><?php echo $post['content'];?></textarea>
<input type="submit">
</form></td>
<?php } ?>
</table>
<table>
<tr><td>Add new post<td></tr>
<form method="post">
<tr><td>Title</td><td><input type='text' name='title'></td></tr>
<tr><td>Content</td><td><textarea name="content" rows=5 cols=81></textarea></td></tr>
<tr><td><input type="submit"></td></tr>
</form>
</table>
</div>

