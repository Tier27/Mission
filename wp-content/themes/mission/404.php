<? /** Template Name: 404 **/ ?>
<?php 
	preg_match('/\/Mission\/(.*)/', $_SERVER['REDIRECT_URL'], $matches);
	if( $matches && is_array( $matches ) && !empty( $matches ) ) wp_redirect( home_url( $matches[1] ) );
?>
<?php get_header(); ?>
<?php $tdu = get_template_directory_uri(); ?>
<?php $pagename='event'; ?>
<link type="text/css" rel="stylesheet" href="<?php echo $tdu; ?>/css/404.css">
<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
<body>
<div class="clear"></div>

<div class="container">
    <div class="error-template">
        <h1>Oops!</h1>
        <h2>404 Not Found</h2>
        
        <div class="error-details">
            Sorry, an error has occured, Requested page not found!
        </div>
        
        <div class="error-actions">
            <a href="<?php echo bloginfo('wpurl'); ?>" class="btn btn-danger btn-lg">Go Home </a>
        </div>
    </div> <!--/.error-template-->
</div>

<script>
jQuery(function($) {
    $('#submit-contact').click(function() {
        name = $('input[name="name"]').val();
                var ajaxdata = {
                        action:         'submit_contact_form',
            name:        $('input[name="name"]').val(),
            email:       $('input[name="email"]').val(),
            phone:       $('input[name="phone"]').val(),
            company:     $('input[name="company"]').val(),
            count:       $('input[name="count"]').val(),
            datefield:   $('input[name="date"]').val(),
            time:        $('input[name="time"]').val(),
            eventfield:  $('input[name="event"]').val(),
            description:     $('textarea[name="description"]').val(),
                };

                $.post( ajaxurl, ajaxdata, function(res){
            $('#response-text').html(res);
            $('#submit-contact').unbind('click');
        });

    });
});
</script>

</div>
<?php include ('F.php'); ?>
</body>
</html>
<?php get_footer(); ?>
