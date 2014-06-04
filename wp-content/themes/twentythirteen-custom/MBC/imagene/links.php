<link type="text/css" rel="stylesheet" href="style.css">
<?php //style_the_active($pagename); ?>
<?php $links=array('uploader', 'thumbs', 'places', 'slides',  'structure', 'sets', 'Sets'); ?>

<body>
<div id="container">
	<div id="header">
	<ul id="links">
		<?php foreach ($links as $link) { echo "<li><a id='$link' href='$link.php'>$link</a></li> "; } echo '<br>'; ?>
	</ul>
	<style> #links a#<?php echo $pagename; ?> { opacity: 1; } </style>
	<div id="logo">
		<a href="../index.php"><img src="../img/mbc-logo.png" alt="MBC"></a>
	</div>
	</div>
</div>
<div class="clear">
</body>
