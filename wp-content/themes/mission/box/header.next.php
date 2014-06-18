<!DOCTYPE HTML>
<head <?php language_attributes('html'); ?>>
<head>
  <?php wp_head(); ?>
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC/css/partial-bootstrap.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/custom-style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC/css/header.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC/css/style.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/daterangepicker-bs3.css" />
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/jquery.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/bootstrap.js"></script>
  <meta charset='utf-8'> 
  <title>Mission Bowling Club</title>
</head>
<?php $pages = get_set_children_names(get_set_id('pages')); ?>
<body>
    <div id="header-reservation">
    <div id="header-reservation-contents">
    <script>
	var template_path = "<?php echo get_template_directory_uri(); ?>";
	function TSI($obj, $index, $path) { var AI = parseInt($obj.src.substr($obj.src.length-5)); if (AI == $index) { NI = AI + 3; $obj.src=template_path+"/MBC/"+$path+"/SMI-"+NI+".png"; } else { $obj.src=template_path+"/MBC/"+$path+"/SMI-"+$index+".png"; } }
    </script>
	<div id="newid"></div>
        <div id="social-media">
            <ul>
		<?php for ($i=1;$i<4;$i++) { 
		$links = array('https://twitter.com/MissionBowling','https://www.facebook.com/missionbowlingclub', '#'); 
		echo "<li><a href=".$links[$i-1]."><img src='".get_template_directory_uri()."/MBC/img/SMI-$i.png' onmouseover='TSI(this, $i,\"img\");'></a></li>"; } ?>
            </ul>
        </div>
        <div id="header-reservation-lane">
            <p>Reserve a Lane</p>        
<?php
$datetime = new DateTime(date('Y-m-d'));
?>
        <div class="select-box-beta">
            <select name="date">
		<?php for ( $i=0; $i<7; $i++ ) { $datetime->modify('+1 day'); echo "<option value='" . $datetime->format('m/d/Y') . "'>" . $datetime->format('D M j') . "</option>"; } ?>
            </select>
        </div>
	<div class="select-box-beta">
		<select name="lanes">
			<option value=1>1</option>
			<option value=2>2</option>
		</select>
	</div>
	<button class="btn" id="modal-button" data-toggle="modal" data-target="#myModal"> Go </button>
        </div>
         <div id="header-reservation-table">
            <p>Reserve a Table</p>

        <div class="select-box-beta">
            <select>
                <option>Sat Sep 7</option>
                <option>Sun Sep 8</option>
                <option>Mon Sep 9</option>
                <option>Tue Sep 10</option>
                <option>Wed Sep 11</option>
                <option>Thu Sep 12</option>
                <option>Fri Sep 13</option>
                <option>Sat Sep 14</option> 
            </select>
        </div>
	<div class="select-box-beta">
            <select>
                <option>6:00 pm</option>
                <option>6:15 pm</option>
                <option>6:45 pm</option>
                <option>7:00 pm</option>
                <option>7:15 pm</option>
                <option>7:45 pm</option>
            </select>
        </div>
        <input id="gobutton" type="submit" value="Go";>
        </div>
    </div>
    </div>
    <div class="clear"></div>
<div id="headere">
    <div class="clear"></div>
    <div id="header-containere">
    <div id="header-nave">
	<style> <?php echo '#header-nave a#'.$pagename.'-hn'; ?> { color: #b5121b; } </style>
        <ul>
	    	<?php foreach ($pages as $page) { $title = get_set_title(get_set_id($page)); ?>
		<a id="nav-tri-<?php echo $page; ?>" href="<?php echo bloginfo('wpurl').'/'.$page; ?>"><img src="<?php echo get_template_directory_uri(); ?>/MBC/img/lane-arrow.png"></a>
		<li><a class="header-linke" id="<?php echo $page; ?>-hn" href="<?php echo bloginfo('wpurl').'/'.$page; ?>"><?php echo $title; ?></a></li>
		<?php } ?>
        </ul>
    </div>
    <div id="header-logo">
        <a href="<?php bloginfo('wpurl'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/MBC/imagene/uploads/<?php echo get_image_name('logo'); ?>"></a>
    </div>
    <div id="logistical-information" class="header-banner">
	<?php execute_set_function(get_set_id('logistical-information')); ?>
    </div>
    <?php print_breaks(3); ?>
    <div id='hours'>
	<?php execute_set_function(get_set_id('hours')); ?>
    </div>
</div>
<div class="clear"></div>
<div class="red-tape" style="display: inline-block; margin-top: -10px; margin-left: auto; margin-right: auto; width: 100%;">
<style> #left-tape { width: 53%; height: 37px; } </style>
<style> #right-tape { width: 37%; height: 37px; } </style>
<style> #club { width: 10%; height: 37px; } </style>
<img id="left-tape" src='<?php echo get_template_directory_uri(); ?>/MBC/img/crop_r.png'><img id="club" src='<?php echo get_template_directory_uri(); ?>/MBC/img/crop_c.png'><img id="right-tape" src='<?php echo get_template_directory_uri(); ?>/MBC/img/crop_r.png'>
</div>
</div>
</body>
</html>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Book Reservation</h4>
      </div>
      <div class="modal-body">
        <div class="well" id="manage-reservation-target">
          <form class="form-horizontal">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="reservationtime">Reservation Date:</label>
                <div class="controls">
                  <div class="input-prepend">
                    <input type="text" style="width: 300px" name="date" id="book-reservation-date" value="<?php echo date('m/d/Y'); ?>"  class="span4"/>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <div class="inline">
                <label class="control-label">Lanes</label>
                <div class="controls">
                  <select type="text" class="input-sm" id="book-reservation-lanes" name="lanes" data-original-title="Lanes">
                    <option value=1>1</option>
                    <option value=2>2</option>
                  </select>
                </div> 
		</div>
                <div class="inline">
                <label class="control-label">Bowlers</label>
                <div class="controls">
                  <select type="text" class="input-sm" id="book-reservation-bowlers" name="bowlers" data-original-title="Bowlers">
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
		  <?php $date = new rvDate( date('Y-m-d') ); ?>

		  <ul class="dropdown-menu" role="menu" id="book-reservation-hours-menu" aria-labelledby="dropdownMenu2">
		  <?php foreach ( $date->hours as $hour ) { ?>
		  <li><a><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="book-reservation-hours hide" value="<?php echo $hour; ?>"><span  style="float: right;">$<span class="pricetag"><?php echo $date->settings->get_pricing( $date->day, $hour ); ?></span></span></a></li>
		  <?php } ?>
		  </ul>
		</div>
                </div> 
                </div>
                <div class="inline">  
                <div class="controls">
                  <input type="text" class="input-sm hide" id="book-reservation-hours" name="hours" data-original-title="Bowlers">
                </div>  
                </div>
              </div>
              
              <br>

              <form role="form" class="reservations">
                <div class="row">
                  <label class="col-xs-4" for="name">Name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="book-reservation-name" placeholder="Name">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="company">Company:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="book-reservation-company" placeholder="Company">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="phone">Phone:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="book-reservation-phone" placeholder="Phone">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Email:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="book-reservation-email" placeholder="Email">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="notes">Notes:</label>
                  <div class="col-xs-12">
                    <textarea class="form-control" id="book-reservation-notes" placeholder="Notes"></textarea>
                  </div>
                </div>
                <div class="row">
		<br>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="notes">Price:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="book-reservation-price" value=0>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <input class="form-control hide" id="book-reservation-action" placeholder="Action" value="add_reservation">
                  </div>
                </div>
              </form>
              <div id="book-reservation-result" hidden>Result</div>



            </fieldset>
          </form>
        </div> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="close-modal">Close</button>
        <button type="button" class="btn btn-primary" id="book-reservation-submit" data-dismiss="modal">Book</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/reservations.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/subscript.js?ver=1.01'></script>
-->
<?php echo "<script> var ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "'; </script>"; ?>
<script>
          	$('#book-reservation-date').datepicker().change( function() {
			var ajaxdata = {
				action:		'update_hours',
				append:		'book-reservation-',
				date:           $(this).val()
			};

			$.post( ajaxurl, ajaxdata, function(res){
				$('#book-reservation-hours-menu').html(res);
                                $.getScript( "<?php echo plugins_url(); ?>/reservations/assets/modal.js" );

			});

		});
</script>
