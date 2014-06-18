<?php $pages = get_set_children_names(get_set_id('pages')); ?>
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/footer.css">
<div class="clear"></div>
<div id="footer">
	<div id="footer-content">
		<div id="footer-copyright">
			<p>© Copyright 2013 Mission Bowling Club</p>
		</div>
		<div id="footer-navbar">
			<style> <?php echo '#'.$pagename.'-fn a'; ?> { color: #b5121b; } </style>
			<ul>
			<?php foreach ($pages as $id => $name) { echo "<li id='$name-fn'><a href='"; bloginfo('wpurl'); echo "/$name'>".get_set_title($id)."</a></li>"; } ?>
			</ul>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
