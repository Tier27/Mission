    <div class="clear"></div>
    <div id="header-container">
    <div id="header-nav">
	<style> <?php echo '#header-nav a#'.$pagename.'-hn'; ?> { color: #b5121b; } </style>
        <ul>
	    	<?php foreach ($pages as $page) { $title = 'something'; //get_set_title(get_set_id($page)); ?>
		<a id="nav-tri-<?php echo $page; ?>" href="<?php echo $page; ?>.php"><img src="<?php echo get_template_directory_uri();  ?>/img/lane-arrow.png"></a>
		<li><a class="header-link" id="<?php echo $page; ?>-hn" href="<?php echo $page; ?>.php"><?php echo $title; ?></a></li>
		<?php } ?>
        </ul>
    </div>
    <div id="header-logo">
        <a href="index.php"><img src="<?php echo get_template_directory_uri();  ?>/MBC/imagene/uploads/logo_t.png"></a>
    </div>
    <div id="logistical-information" class="header-banner">
	<?php //execute_set_function(get_set_id('logistical-information')); ?>
    </div>
    <?php //print_breaks(3); ?>
    <div id='hours'>
	<?php //execute_set_function(get_set_id('hours')); ?>
    </div>
</div>
<div class="clear"></div>
<div class="red-tape" style="display: inline-block; margin-top: -10px; margin-left: auto; margin-right: auto; width: 100%;">
<style> #left-tape { width: 53%; height: 37px; } </style>
<style> #right-tape { width: 37%; height: 37px; } </style>
<style> #club { width: 10%; height: 37px; } </style>
<img id="left-tape" src='<?php echo get_template_directory_uri();  ?>/img/crop_r.png'><img id="club" src='<?php echo get_template_directory_uri();  ?>/img/crop_c.png'><img id="right-tape" src='<?php echo get_template_directory_uri();  ?>/img/crop_r.png'>
</div>







</div>

</body>
</html>
