<?php 
	$structure_links=get_set_contents(get_set_id('information-tab')); 
?>
<body>
<div id="container">
	<div id="header">
	<ul id="links">
	<div id="structure">
		<?php foreach ($structure_links as $link) { echo "<li><a id='$link' href='#'>$link</a></li> "; } echo '<br>'; ?>
	</div>
	</ul>
	<style> #links a#<?php echo $pagename; ?> { opacity: 1; } </style>
	</div>
</div>
<div class="clear">
</body>
