<?php	/* *	The template for displaying events calendar on "/events" url slug * *	Override this tempalte by coping it to yourtheme/eventon/archive-ajde_events.php * *	@Author: AJDE *	@EventON *	@version: 0.1 */				get_header();			$archive_page_id = get_option('eventon_events_page_id');			$archive_page  = get_page($archive_page_id);		echo apply_filters('the_content', $archive_page->post_content);		get_footer();?>