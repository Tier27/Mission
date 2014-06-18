<!DOCTYPE HTML>
<html>
<head>
  <link type="text/css" rel="stylesheet" href="css/footer.css">
  <title>Mission Bowling Club</title>
</head>
<div class="clear"></div>
<div id="footer">
	<div id="footer-content">
		<div id="footer-copyright">
			<p>© Copyright 2013 Mission Bowling Club</p>
		</div>
		<div id="footer-navbar">
			<style> <?php echo '#'.$pagename.'-fn a'; ?> { color: #b5121b; } </style>
			<ul>
			<?php foreach ($pages as $id => $name) { echo "<li id='$name-fn'><a href='$name.php'>".get_set_title($id)."</a></li>"; } ?>
			</ul>
		</div>
	</div>
</div>
