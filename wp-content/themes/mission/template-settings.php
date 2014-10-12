<?php /* Template Name: Settings */ ?>
<?php //get_header(); ?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
  <meta charset="UTF-8" />
  <title>MBC Reservation System</title>
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reservations/css/custom-style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reservations/css/bootstrap.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/reservations/css/font-awesome.css">
  <link type='text/css' rel="stylesheet" href="<?php echo plugins_url(); ?>/reservations/assets/reservations.css?ver=1.01";
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/reservations/css/daterangepicker-bs3.css" />
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/reservations/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/reservations/js/bootstrap.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/reservations/js/moment.js"></script>
</head>
<body>
<br>
<?php 
	$settings = new rvSettings();
?>
<form>
  <div class="full-container" style="margin: 0px 25px;">
    <div class="row well">
      <div class="col-lg-12">
        <div class="form-group hide">
          <label for="inputEmail3" class="col-sm-2 control-label">Input Display</label>
          <div class="col-sm-10">
            <input type="radio" class="" name="reservation-input-display">
            <input type="radio" class="" name="reservation-input-display">
          </div>
        </div>
        <div class="form-group hide">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
          </div>
        </div>
        <div class="form-group hide">
          <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
          </div>
        </div>
	<?php foreach( array( 'SU', 'M', 'TU', 'W', 'TH', 'F', 'SA' ) as $i => $d ) : ?>
        <div class="form-group">
          <label for "hours" class="col-sm-2 control-label">Hours - <?php echo $d; ?></label>
          <div class="col-sm-10">
	    <?php for( $j = 8; $j<=24; $j++ ) : ?>
            <div class="twentieth">
	    <?php echo rvFormat::short_military_hour( $j ); ?>
            <input type="checkbox" name="hours[<?php echo $i; ?>][<?php echo $j; ?>]" value="1" class="form-control" <?php if( $settings->hours[$i][$j] ) echo "checked=\"checked\""; ?>>
	    </div>
	    <?php endfor; ?>
          </div>
        </div>
	<?php endforeach; ?>
      </div>
      <input type="text" class="hide" name="action" value="settings_update_settings">
      <button type="button" class="btn btn-primary" id="settings-update-settings">Update</button>
    </div>
</form>
<script> var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>'; </script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/reservations.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/private.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/subscript.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/search.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/settings.js?ver=1.01'></script>
