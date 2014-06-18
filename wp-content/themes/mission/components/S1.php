<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC/css/S1.css">
<div class="S1">
	<?php get_template_part('components/sidebar-calendar'); ?>
	<style> #left-mini-menu { height: 100%; width: 100%; } </style>
	<div id="sidebar-plan-event-menu">
		<?php echo(execute_set_function(41)); ?>
	</div>
	<style> #right-mini-menu { height: 100%; width: 100%; } </style>
	<div id="sidebar-plan-event-menu" style="float:right;">
		<?php echo(execute_set_function(43)); ?>
	</div>
	<div class="clear"></div>
	<div class="ten-block"></div>
	<div class="ten-block"></div>
	<div class="ten-block"></div>
	<div id="sidebar-plan-event-calendar">
		<?php echo execute_set_function(44); ?>
	</div>
	<div class="ten-block"></div>
	<div class="ten-block"></div>
	<div class="ten-block"></div>
	<div class="ten-block"></div>
	<style> #advertisement { width: 100%; } </style>
	<?php echo(execute_set_function(42)); ?>
</div>


