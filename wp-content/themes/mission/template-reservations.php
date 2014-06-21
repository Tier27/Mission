<?php /* Template Name: Reservations */ ?>
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
<?php $date = new rvDate( date( 'Y-m-d' ) ); ?>
<br>
  <div class="full-container" style="margin: 0px 25px;">
    <ul class="nav nav-tabs" hidden>
      <li><a href="#" id="reservation-trigger">Create Booking</a></li>
      <li><a href="#" id="calendar-trigger">Calendar</a></li>
      <li class="hide"><a href="#" id="settings-trigger">Settings</a></li>
    </ul>
    <div class="row">
      <div class="col-lg-12">
        <div class="well">
	      <button class="btn btn-default" id="todays-date">Today</button>
    	      <span class="glyphicon glyphicon-chevron-left"></span>
              <input id="reportrange" class="" value="<?php echo date('m/d/Y'); ?>" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
    	      <span class="glyphicon glyphicon-chevron-right"></span>
              <input id="search" class="" placeholder="Search..." style="background: #fff; padding: 5px 10px; border: 1px solid #ccc">
    	      <button class="btn btn-default" id="search-trigger"><span class="glyphicon glyphicon-search" ></span><span style="padding-left: 10px;">Search</span></button>
              <textarea id="day-notes" class="" style="width: 400px; background: #fff; padding: 5px 10px; border: 1px solid #ccc"><?php echo $date->notes; ?></textarea>
	      <button class="btn btn-default" id="notes-update">Update Comment</button>
	      <button class="btn btn-default" id="all-toggle">Show All</button>
	</div>	
      </div>
    </div>
    <div class="row">
      <div class="tab col-sm-7 sidebar" id="settings" hidden>
	Settings
      </div>
      <div class="tab col-sm-4 " id="reservation" hidden>
<!--
        <div class="well" style="height: 225px; margin-top: 20px;">
          <div class="row">
            <label class="col-xs-2" for="name">Date:</label>
            <div class="col-xs-8">
              <input id="reportrange" class="pull-right form-control" value="<?php echo date('m/d/Y'); ?>" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            </div>
          </div>
          <div class="row">
            <label class="col-xs-2" for="name">Search:</label>
            <div class="col-xs-8">
              <input id="search" class="pull-right form-control" placeholder="Search for a reservation" style="background: #fff; padding: 5px 10px; border: 1px solid #ccc">
            </div>
          </div>
          <div class="row">
            <label class="col-xs-2" for="name">Comments:</label>
            <div class="col-xs-8">
              <textarea id="day-notes" class="pull-right form-control" style="background: #fff; padding: 5px 10px; border: 1px solid #ccc"><?php echo $date->notes; ?></textarea>
            </div>
          </div>
	  <button class="btn dropdown-toggle " id="print" type="button" id="dropdownMenu1" data-toggle="dropdown">Print</button>
	</div>
-->
        <div class="well" id="reservation-target">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="reservationtime">Reservation Date:</label>
                <div class="controls">
                  <div class="input-prepend">
                    <input type="text" style="" name="date" id="date" value="<?php echo date('m/d/Y'); ?>"  class="span4"/>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <div class="inline">
                <label class="control-label">Lanes</label>
                <div class="controls">
                  <select type="text" class="input-sm" id="lanes" name="lanes" data-original-title="Lanes">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                  </select>
                </div> 
		</div>
                <div class="inline">
                <label class="control-label">Bowlers</label>
                <div class="controls">
                    <input type="text" class="form-control input-sm" id="bowlers" name="bowlers" value=1 style="width: 125px">
                </div> 
		</div>
		<div class="inline">
                <div class="controls">
		<div class="dropdown">
		  <button class="btn dropdown-toggle hide" type="button" id="dropdownMenu1" data-toggle="dropdown">
   		    Hours 
		    <span class="caret"></span>
		  </button>
		<div class="btn-group" id="hours-buttons">
		  <?php foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { ?>
		  <button type="button" class="btn hours btn-trimmed" id="button-<?php echo $hour; ?>"><span class="count'#date' hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::short_military_hour( $hour ); ?><input type="checkbox" name="hour" class="hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"></button>
		  <?php } } ?>
		</div>
		  <ul class="dropdown-menu hide" role="menu" id="hours-menu" aria-labelledby="dropdownMenu1">
		  <?php foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { ?>
		  <li><a id="anchor-<?php echo $hour; ?>"><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"></a></li>
		  <?php } } ?>
		  </ul>
		</div>
                </div> 
                </div>
                <div class="inline">  
                <div class="controls">
                  <input type="text" class="input-sm hide" id="hours" name="hours" data-original-title="Bowlers">
                </div>  
                </div>
                <div class="inline">  
                <div class="controls">
                <button class="btn btn-danger pull-right hide" id="sample-data">Sample Data</button>
                </div>    
                </div>    
                <div class="inline">  
                <div class="controls">
                  Price: <span class="inline" id="price-display">$0</span>
                    <input type="text" class="form-control hide" id="price" value=0>
                </div>  
                </div>
              </div>
              
              <br>

              <form role="form" class="reservations">
                <div class="row">
                  <label class="col-xs-2" for="name">Name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="name" placeholder="Name">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-2" for="company">Company:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="company" placeholder="Company">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-2" for="phone">Phone:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-2" for="email">Email:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="email" placeholder="Email">
                    <input type="text" class="form-control hide" id="status" value="hold" placeholder="Status">
                  </div>
                </div>
                <div class="btn-group" style="margin-bottom: 1em; width 100%;">
                  <button type="button" data-value="paid" class="btn status btn-success">Paid</button>
                  <button type="button" data-value="reserve" class="btn status btn-warning">Reserve</button>
                  <button type="button" data-value="hold" class="btn status btn-danger">Hold</button>
                  <button type="button" data-value="credit" class="btn status btn-info">Credit</button>
                </div>
                <div class="row">
                  <label class="col-xs-2" for="notes">Notes:</label>
                  <div class="col-xs-8">
                    <textarea class="form-control" id="notes" placeholder="Notes"></textarea>
                  </div>
                </div>
                <div class="row">
                </div>
		<br>
                <div class="row">
                  <label class="col-xs-2" for="amount-paid">Paid</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control money" id="paid" placeholder="Amount Paid">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <input class="form-control hide" id="action" placeholder="Action" value="add_reservation">
                  </div>
                </div>
                <button type="button" class="submit btn btn-default pull-left" id="clear-booking">Clear Form</button>
                <button type="submit" class="submit btn btn-default pull-right" id="cnb">Create New Booking</button>
              </form>
              <div id="cnb-result" hidden>Result</div>



            </fieldset>
          </form>
        </div> 
      </div>
<?php $myDate = new rvDate(); ?>
<table class="hide" id="future" style="background: white; position: absolute; z-index: 10; top: 0px; left: 0px;">
<?php foreach ( $myDate->lanes as $lane ) { ?>
<tr>
<?php foreach ( $lane as $hour ) { ?>
<td style="width: 25px; height: 25px; <?php echo ( $hour == '' ) ? '' : 'background: red;'; ?>"></td>
<?php } ?>
</tr>
<?php } ?>
</table>
      <div class="tab col-md-8 calendar pull-right" id="calendar">
              <div class="well" id="calendar-target">
                
	<?php rvAjax::print_calendar_contents( date('m/d/Y') ); ?>
              </div>
            </div>

	<?php get_template_part( 'part-reservation-closeup' ); ?>
      </div>
    </div>
  </div>          

<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg hide" id="modal-button" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Manage Reservation</h4>
      </div>
      <div class="modal-body">
        <div class="well" id="manage-reservation-target">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="reservationtime">Reservation Date:</label>
                <div class="controls">
                  <div class="input-prepend">
                    <input type="text" style="width: 300px" name="date" id="manage-reservation-date" value="<?php echo date('m/d/Y'); ?>"  class="span4"/>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <div class="inline">
                <label class="control-label">Lanes</label>
                <div class="controls">
                  <select type="text" class="input-sm" id="manage-reservation-lanes" name="lanes" data-original-title="Lanes">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                  </select>
                </div> 
		</div>
                <div class="inline">
                <label class="control-label">Bowlers</label>
                <div class="controls">
                    <input type="text" class="form-control input-sm" id="manage-reservation-bowlers" name="bowlers" value=1 style="width: 125px">
                </div> 
<!--
                <div class="controls">
                  <select type="text" class="input-sm" id="manage-reservation-bowlers" name="bowlers" data-original-title="Bowlers">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                    <option value=7>7</option>
                    <option value=8>8</option>
                  </select>
                </div> 
-->
		</div>
		<div class="inline">
                <div class="controls">
		<div class="dropdown">
		  <button class="btn dropdown-toggle hide" type="button" id="dropdownMenu1" data-toggle="dropdown">
   		    Hours 
		    <span class="caret"></span>
		  </button>
		<div class="btn-group" id="manage-reservation-hours-buttons">
		  <?php foreach ( $date->hours as $hour ) { 
		  $hide = ( $date->check_hour( $hour ) ) ? '' : 'hide'; ?>
		  <button type="button" class="btn manage-reservation-hours <?php echo $hide; ?>" id="manage-reservation-button-<?php echo $hour; ?>"><span class="count'#date' hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::short_military_hour( $hour ); ?><input type="checkbox" name="hour" class="hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"></button>
		  <?php } ?>
		</div>
		  <ul class="dropdown-menu hide" role="menu" id="manage-reservation-hours-menu" aria-labelledby="dropdownMenu1">
		  <?php foreach ( $date->hours as $hour ) { 
		  $hide = ( $date->check_hour( $hour ) ) ? '' : 'hide'; ?>
		  <li><a id="manage-reservation-anchor-<?php echo $hour; ?>"><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="manage-reservation-hours hide" data-price="<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>" value="<?php echo $hour; ?>"></a></li>
		  <?php } ?>
		  </ul>
		</div>
<!--
		<div class="dropdown">
		  <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
		  Hours 
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" id="manage-reservation-hours-menu" aria-labelledby="dropdownMenu2">
		  <?php foreach ( $date->hours as $hour ) { ?>
		  <li><a><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="manage-reservation-hours hide" value="<?php echo $hour; ?>"></a></li>
		  <?php } ?>
		  </ul>
		</div>
-->
                </div> 
                </div>
                <div class="inline">  
                <div class="controls">
                  <input type="text" class="input-sm hide" id="manage-reservation-hours" name="hours" data-original-title="Bowlers">
                </div>  
                </div>
              </div>
              
              <br>

              <form role="form" class="reservations">
                <div class="row">
                  <label class="col-xs-4" for="name">Name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="manage-reservation-name" placeholder="Name">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="company">Company:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="manage-reservation-company" placeholder="Company">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="phone">Phone:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="manage-reservation-phone" placeholder="Phone">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Email:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="manage-reservation-email" placeholder="Email">
                    <input type="text" class="form-control hide" id="manage-reservation-status" placeholder="Status">
                  </div>
                </div>
                <div class="btn-group" style="margin-bottom: 1em;">
                  <button type="button" data-value="paid" class="btn status paid">Paid</button>
                  <button type="button" data-value="reserve" class="btn status reserve">Reserve</button>
                  <button type="button" data-value="hold" class="btn status hold">Hold</button>
                  <button type="button" data-value="credit" class="btn status credit">Credit</button>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="notes">Notes:</label>
                  <div class="col-xs-12">
                    <textarea class="form-control" id="manage-reservation-notes" placeholder="Notes"></textarea>
                  </div>
                </div>
                <div class="row">
                </div>
		<br>
                <div class="row">
                  <label class="col-xs-4" for="amount-paid">Paid</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control money" id="manage-reservation-paid" placeholder="Amount Paid">
                    <input type="text" class="form-control hide" id="manage-reservation-price">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <input class="form-control hide" id="manage-reservation-id" placeholder="ID" value="">
                    <input class="form-control hide" id="manage-reservation-action" placeholder="Action" value="update_reservation">
                  </div>
                </div>
              </form>
              <div id="manage-reservation-result" hidden>Result</div>



            </fieldset>
          </form>
        </div> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close-modal">Close</button>
        <button type="button" class="btn btn-primary update" data-dismiss="modal">Save changes</button>
        <button type="button" class="btn btn-warning cancel" data-dismiss="modal" id="cancel-reservation">Cancel reservation</button>
        <button type="button" class="btn btn-warning pend" data-dismiss="modal" id="pend-reservation">Set pending</button>
        <button type="button" class="btn btn-danger delete" data-dismiss="modal" id="delete-reservation">Delete reservation</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
<?php

                echo "<script> var ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "'; </script>";

?>
          <script type="text/javascript">
	  $(function() {
          	$('#date, #manage-reservation-date').datepicker().change( function() {
			$('#reportrange').val( $(this).val() ).trigger( 'change' );
		});
	  });
	  var pluginsurl = "<?php echo plugins_url(); ?>";
          </script>
<script>
var subscript = "<?php echo plugins_url() . "/reservations/assets/subscript.js?ver=1.01"; ?>";
var hourscript = "<?php echo plugins_url() . "/reservations/assets/hours.js"; ?>";
</script>
<script>
jQuery(function($) {
	$('.glyphicon').hover( function() {
	});
	$('.glyphicon-chevron-left').click(function() {
		chosen = new Date($('#reportrange').val());
		chosen.setDate(chosen.getDate()-1);
		$('#reportrange').val(($.datepicker.formatDate('mm/dd/yy', chosen))).trigger("change");
	});
	$('.glyphicon-chevron-right').click(function() {
		chosen = new Date($('#reportrange').val());
		chosen.setDate(chosen.getDate()+1);
		$('#reportrange').val(($.datepicker.formatDate('mm/dd/yy', chosen))).trigger("change");
	});
	$('#todays-date').click(function() {
		chosen = new Date();
		$('#reportrange').val(($.datepicker.formatDate('mm/dd/yy', chosen))).trigger("change");
	});
});
</script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/reservations.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/private.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/subscript.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/search.js?ver=1.01'></script>
