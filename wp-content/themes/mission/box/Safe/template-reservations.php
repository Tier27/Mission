<?php /* Template Name: Reservations */ ?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
  <meta charset="UTF-8" />
  <title>MBC Reservation System</title>
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/custom-style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/bootstrap.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/font-awesome.css">
  <link type='text/css' rel="stylesheet" href="http://192.168.2.21/wordpress/mbc/wp-content/plugins/reservations/assets/reservations.css?ver=1.01";
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/daterangepicker-bs3.css" />
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/bootstrap.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/moment.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/daterangepicker.js"></script>
</head>
<body>

<?php $date = new rvDate( date( 'Y-m-d' ) ); ?>

<br>
  <div class="container">
    <ul class="nav nav-tabs">
      <li><a href="#" id="reservation-trigger">Create Booking</a></li>
      <li><a href="#" id="calendar-trigger">Calendar</a></li>
    </ul>
<br><br>
    <div class="row">
      <div class="tab col-sm-7 sidebar" id="reservation">
        <div class="well" id="reservation-target">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="reservationtime">Reservation Date:</label>
                <div class="controls">
                  <div class="input-prepend">
                    <input type="text" style="width: 300px" name="date" id="date" value="<?php echo date('m/d/Y'); ?>"  class="span4"/>
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
                  <select type="text" class="input-sm" id="bowlers" name="bowlers" data-original-title="Bowlers">
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
		</div>
		<div class="inline">
                <div class="controls">
		<div class="dropdown">
		  <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
   		    Hours 
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" id="hours-menu" aria-labelledby="dropdownMenu1">
		  <?php foreach ( $date->hours as $hour ) { ?>
		  <li><a><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="hours hide" value="<?php echo $hour; ?>"></a></li>
		  <?php } ?>
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
                  <input type="checkbox"> *Late Start
                </div>    
              </div>
              
              <br>

              <form role="form" class="reservations">
                <div class="row">
                  <label class="col-xs-4" for="name">Name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="name" placeholder="Name">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="company">Company:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="company" placeholder="Company">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="phone">Phone:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Email:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="email" placeholder="Email">
                  </div>
                </div>
                <div class="btn-group" style="margin-bottom: 1em;">
                  <button type="button" class="btn btn-default">Reserve</button>
                  <button type="button" class="btn btn-default">Walk Up</button>
                  <button type="button" class="btn btn-default">Hold</button>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="notes">Notes:</label>
                  <div class="col-xs-12">
                    <textarea class="form-control" id="notes" placeholder="Notes"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <input type="checkbox"> *Override Lane Maximum
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="amount-paid">Amount Paid</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control money" id="paid" placeholder="Amount Paid">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <input class="form-control hide" id="action" placeholder="Action" value="add_reservation">
                  </div>
                </div>
                <button type="submit" class="submit btn btn-danger pull-right" id="cnb">Create New Booking</button>
              </form>
              <div id="cnb-result">Result</div>



            </fieldset>
          </form>
          <script type="text/javascript">
	  $(function() {
          	$('#date').datepicker().change( function() {
			$(this).val($(this).val().replace( '/', '/' ));
		});
	  });
/*
          $(document).ready(function() {
            $('#reservationtime').daterangepicker({
              timePicker: true,
              timePickerIncrement: 30,
              format: 'MM/DD/YYYY h:mm A'
              });
            });
*/
          </script>
        </div> 
      </div>
      <div class="tab col-md-12 calendar" id="calendar">
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
		</div>
		<div class="inline">
                <div class="controls">
		<div class="dropdown">
		  <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
   		    Hours 
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" id="hours-menu" aria-labelledby="dropdownMenu2">
		  <?php foreach ( $date->hours as $hour ) { ?>
		  <li><a><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="manage-reservation-hours hide" value="<?php echo $hour; ?>"></a></li>
		  <?php } ?>
		  </ul>
		</div>
                </div> 
                </div>
                <div class="inline">  
                <div class="controls">
                  <input type="text" class="input-sm hide" id="manage-reservation-hours" name="hours" data-original-title="Bowlers">
                </div>  
                </div>
                <div class="inline">
                  <input type="checkbox"> *Late Start
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
                  </div>
                </div>
                <div class="btn-group" style="margin-bottom: 1em;">
                  <button type="button" class="btn btn-default">Reserve</button>
                  <button type="button" class="btn btn-default">Walk Up</button>
                  <button type="button" class="btn btn-default">Hold</button>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="notes">Notes:</label>
                  <div class="col-xs-12">
                    <textarea class="form-control" id="manage-reservation-notes" placeholder="Notes"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <input type="checkbox"> *Override Lane Maximum
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="amount-paid">Amount Paid</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control money" id="manage-reservation-paid" placeholder="Amount Paid">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <input class="form-control " id="manage-reservation-id" placeholder="ID" value="">
                    <input class="form-control hide" id="manage-reservation-action" placeholder="Action" value="update_reservation">
                  </div>
                </div>
              </form>
              <div id="manage-reservation-result">Result</div>



            </fieldset>
          </form>
        </div> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close-modal">Close</button>
        <button type="button" class="btn btn-primary update" data-dismiss="modal">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--
            <div class="well" style="overflow: auto">
                  <i class="glyphicon glyphicon-calendar icon-calendar icon-large"></i>
                  <span></span> <b class="caret"></b>
               </div>
                <h6>You can remove this date range picker if you find no use for it.</h6>
               <script type="text/javascript">
               $(function() {
/*
			daterangepicker(
                     {
                        startDate: moment().subtract('days', 29),
                        endDate: moment(),
                        minDate: '01/01/2012',
                        maxDate: '12/31/2014',
                        dateLimit: { days: 60 },
                        showDropdowns: true,
                        showWeekNumbers: true,
                        timePicker: false,
                        timePickerIncrement: 1,
                        timePicker12Hour: true,
                        ranges: {
                           'Today': [moment(), moment()],
                           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                           'Last 7 Days': [moment().subtract('days', 6), moment()],
                           'Last 30 Days': [moment().subtract('days', 29), moment()],
                           'This Month': [moment().startOf('month'), moment().endOf('month')],
                           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                        },
                        opens: 'left',
                        buttonClasses: ['btn btn-default'],
                        applyClass: 'btn-small btn-primary',
                        cancelClass: 'btn-small',
                        format: 'MM/DD/YYYY',
                        separator: ' to ',
                        locale: {
                            applyLabel: 'Submit',
                            fromLabel: 'From',
                            toLabel: 'To',
                            customRangeLabel: 'Custom Range',
                            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            firstDay: 1
                        }
                     },
                     function(start, end) {
                      console.log("Callback has been called!");
                      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                     }
                  );
                  //Set the initial state of the picker label
                  $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
*/
               });
               </script>
            </div>
-->

            <div class="row">
              <input id="reportrange" class="pull-right" value="<?php echo date('m/d/Y'); ?>" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
              <div class="col-md-12 well" id="calendar-target">
                
	<?php rvAjax::print_calendar_contents( date('m/d/Y') ); ?>
                </div>
              </div>
            </div>

      </div>
    </div>
  </div>          
</body>
</html>
<?php

                echo "<script> var ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "'; </script>";
                echo "<script type='text/javascript' src='http://development.tier27.com/Mission/wp-content/plugins/reservations/assets/reservations.js?ver=1.01'></script>";

?>
