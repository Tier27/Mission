<? /** Template Name: Calendar **/ ?>
<?php get_header(); ?>
<style>
td { 
	width: 100px !important;
	background: white;
}
</style>
<body>
<?php $pagename='calendar'; ?>
<?php $caldays = array('Sun', 'Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat'); ?>
<div class="clear"></div>
<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
			<?php endwhile; ?>
<?php //get_template_part('components/calendar_'); ?>
<?php //get_template_part('components/call'); ?>
</div><!--container-->
<style>
.calendar-table td {
	background: none;
}
.calendar-table td .event a {
	color: white;
}
</style>
<?php get_footer(); ?>

