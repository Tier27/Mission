<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
  <meta charset="UTF-8" />
  <title>MBC Reservation System</title>
  <link type="text/css" rel="stylesheet" href="css/custom-style.css">
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/daterangepicker-bs3.css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/moment.js"></script>
  <script type="text/javascript" src="js/daterangepicker.js"></script>-->
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<br>
  <div class="container">
    <div class="row">
      <div class="col-sm-7 sidebar">
        <legend>
          <h4 style="color: #d9534f;">Create a New Booking</h4>
        </legend>
        <div class="well">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="reservationtime">Reservation Dates:</label>
                <div class="controls">
                  <div class="input-prepend">
                    <span class="add-on"><i class="glyphicon glyphicon-calendar icon-calendar"></i></span>
                    <input type="text" style="width: 300px" name="reservation" id="reservationtime" value="08/01/2013 1:00 PM - 08/01/2013 1:30 PM"  class="span4"/>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <div class="inline">
                <label class="control-label">Lanes</label>
                <div class="controls">
                  <select type="text" class="input-sm" id="lanes" name="lanes" data-original-title="Lanes">
                    <option value="one">1</option>
                    <option value="two">2</option>
                    <option value="three">3</option>
                    <option value="four">4</option>
                    <option value="five">5</option>
                    <option value="six">6</option>
                  </select>
                </div> 
                </div>
                <div class="inline">  
                <label class="control-label">Bowlers</label>
                <div class="controls">
                  <input type="text" class="input-sm" id="lanes" name="lanes" data-original-title="Lanes">
                </div>  
                </div>
                <div class="inline">
                  <input type="checkbox"> *Late Start
                </div>    
              </div>
              
              <br>

              <form role="form" class="reservation">
                <div class="row">
                  <label class="col-xs-4" for="name">Name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="name" placeholder="Name">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="company">Company:</label>
                  <div class="col-xs-8">
                    <input type="password" class="form-control" id="company" placeholder="Company">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="phone">Phone:</label>
                  <div class="col-xs-8">
                    <input type="password" class="form-control" id="phone" placeholder="Phone">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Email:</label>
                  <div class="col-xs-8">
                    <input type="password" class="form-control" id="email" placeholder="Email">
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
                    <textarea class="form-control" id="TextArea" placeholder="Notes"></textarea>
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
                    <input type="password" class="form-control" id="amount-paid" placeholder="Amount Paid">
                  </div>
                </div>
                <button type="submit" class="btn btn-danger pull-right">Create New Booking</button>
              </form>



            </fieldset>
          </form>
          <script type="text/javascript">
          $(document).ready(function() {
            $('#reservationtime').daterangepicker({
              timePicker: true,
              timePickerIncrement: 30,
              format: 'MM/DD/YYYY h:mm A'
              });
            });
          </script>
        </div> 
      </div>
      <div class="col-md-12 calendar">
      <legend>
        <h4 style="color: #eee">Calendar</h4>
      </legend>
            <div class="well" style="overflow: auto">
               <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                  <i class="glyphicon glyphicon-calendar icon-calendar icon-large"></i>
                  <span></span> <b class="caret"></b>
               </div>
                <h6>You can remove this date range picker if you find no use for it.</h6>
               <script type="text/javascript">
               $(document).ready(function() {
                  $('#reportrange').daterangepicker(
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
               });
               </script>
            </div>

            <div class="row">
              <div class="col-md-12 well">
                
                <div class="row">
                  <div class="col-md-2">
                    <span class="label label-default center-block">1</span>
                  </div>
                  <div class="col-md-2">
                    <span class="label label-danger center-block">2</span>
                  </div>
                  <div class="col-md-2">
                    <span class="label label-default center-block">3</span>
                  </div>
                  <div class="col-md-2">
                    <span class="label label-danger center-block">4</span>
                  </div>
                  <div class="col-md-2">
                    <span class="label label-default center-block">5</span>
                  </div>
                  <div class="col-md-2">
                    <span class="label label-danger center-block">6</span>
                  </div>
                </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>3:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-danger closed">closed</span></h5>
                      <h5>$35</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event filled">
                      <span class="badge">1</span>
                      <span class="amount">$0.00</span>
                      <p class="dimension"><small>2x5</small></p>
                      <h5 class="name"><strong>Evan Gross</strong></h5>
                      <h6 class="position">BA LEFT VM</h6>
                    </div>
                    <div class="col-md-2 center-block event filled">
                      <span class="badge">2</span>
                      <span class="amount">$0.00</span>
                      <p class="dimension"><small>2x5</small></p>
                      <h5 class="name"><strong>Jon Stewart</strong></h5>
                      <h6 class="position">BA LEFT VM</h6>
                    </div>
                    <div class="col-md-2 center-block event filled">
                      <span class="badge">3</span>
                      <span class="amount">$0.00</span>
                      <p class="dimension"><small>2x5</small></p>
                      <h5 class="name"><strong>Eric Fischer</strong></h5>
                      <h6 class="position">BA LEFT VM</h6>
                    </div>
                    <div class="col-md-2 center-block event filled">
                      <span class="badge">4</span>
                      <span class="amount">$0.00</span>
                      <p class="dimension"><small>2x5</small></p>
                      <h5 class="name"><strong>Victor Wooten</strong></h5>
                      <h6 class="position">BA LEFT VM</h6>
                    </div>
                    <div class="col-md-2 center-block event filled">
                      <span class="badge">5</span>
                      <span class="amount">$0.00</span>
                      <p class="dimension"><small>2x5</small></p>
                      <h5 class="name"><strong>Andrew Smithers</strong></h5>
                      <h6 class="position">BA LEFT VM</h6>
                    </div>
                    <div class="col-md-2 center-block event filled">
                      <span class="badge">6</span>
                      <span class="amount">$0.00</span>
                      <p class="dimension"><small>2x5</small></p>
                      <h5 class="name"><strong>Willy Parker</strong></h5>
                      <h6 class="position">BA LEFT VM</h6>
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>4:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$35</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>5:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$35</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>6:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$45</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>7:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$45</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>8:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$55</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>9:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$55</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>10:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$55</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                  <div class="row cal-heading">
                    <div class="col-md-4">
                      <h5><strong>11:00 pm</strong></h5>
                    </div>
                    <div class="col-md-8">
                      <h5>Status: <span class="btn-success open">open</span></h5>
                      <h5>$35</h5>
                      <h5>3 max web lanes</h5>
                      <h5><a href="#">change</a></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                    <div class="col-md-2 center-block event">
                      
                    </div>
                  </div>

                </div>
              </div>
            </div>

      </div>
    </div>
  </div>          
</body>
</html>
