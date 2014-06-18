<!DOCTYPE HTML>
<head <?php language_attributes('html'); ?>>
<head>
  <?php wp_head(); ?>
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/partial-bootstrap.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/custom-style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/header.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/css/daterangepicker-bs3.css" />
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/jquery.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/MBC-Reservation/js/bootstrap.js"></script>
  <meta charset='utf-8'> 
  <title>Mission Bowling Club</title>
</head>
<?php $pages = get_set_children_names(get_set_id('pages')); ?>
<?php $blockModal = new Modal( array( 'class' => 'block' ) ); ?>
<body>
    <div id="header-reservation">
    <div id="header-reservation-contents">
    <script>
	var template_path = "<?php echo get_template_directory_uri(); ?>";
	function TSI($obj, $index, $path) { var AI = parseInt($obj.src.substr($obj.src.length-5)); if (AI == $index) { NI = AI + 3; $obj.src=template_path+"/"+$path+"/SMI-"+NI+".png"; } else { $obj.src=template_path+"/"+$path+"/SMI-"+$index+".png"; } }
    </script>
	<div id="newid"></div>
        <div id="social-media">
            <ul>
		<?php for ($i=1;$i<4;$i++) { 
		$links = array('https://twitter.com/MissionBowling','https://www.facebook.com/missionbowlingclub', '#'); 
		echo "<li><a href=".$links[$i-1]."><img src='".get_template_directory_uri()."/img/SMI-$i.png' onmouseover='TSI(this, $i,\"img\");'></a></li>"; } ?>
            </ul>
        </div>
        <div id="header-reservation-lane">
            <p>Reserve a Lane</p>
<?php
$datetime = new DateTime(date('Y-m-d'));
?>
	<div class="select-box-beta">
		<select name="lanes" id="pre-book-lanes">
			
			<option value=1>1 lane</option>
			<option value=2>2 lanes</option>
		</select>
	</div>
        <div class="select-box-beta">
            <select name="date" id="pre-book-date">
		<?php for ( $i=0; $i<7; $i++ ) { $datetime->modify('+1 day'); echo "<option value='" . $datetime->format('m/d/Y') . "'>" . $datetime->format('D M j') . "</option>"; } ?>
            </select>
        </div>
	<button class="btn" id="modal-button" data-toggle="modal" data-target="#myModal"> Go </button>
        </div>
         <div id="header-reservation-table">
            <p>Reserve a Table</p>
	<form action="http://rez.opentable.com/reservation/start/2902" method="get">
        <div class="select-box-beta">
            <select class="dining" name="day" value=<?php echo date('Ymd'); ?>>
                <option class="dining-date" data-day=<?php echo date('w'); ?> value=<?php echo date('Ymd'); ?>>Today</option>
                <option class="dining-date" data-day=<?php echo date('w', strtotime(' +1 day')); ?> value=<?php echo date('Ymd', strtotime(' +1 day')); ?>>Tomorrow</option>
		<?php for( $i = 2; $i <= 14; $i++ ) echo '<option class="dining-date" data-day=' . date('w', strtotime(" +$i day") ) . ' value=' . date('Ymd', strtotime(" +$i day")) . '>' . date('D M j', strtotime(" +$i day")) . '</option>'; ?>
            </select>
        </div>
	<div class="select-box-beta">
	<?php $settings = new rvSettings(); ?>
            <select class="dining-time" name="seating_time" value=1080 hidden>
		<?php for( $i = 6; $i < 11; $i++ ) for( $j = 0; $j < 60; $j += 15 ) if( $i != 10 || $j != 45 ) { 
			//echo "<option value=" . (string)(60*12 + 60*$i + $j) . ">$i:$j"; echo ($j == 0) ? '0' : ''; echo " pm</option>"; 
		} ?>
		<?php foreach( $settings->dining[6] as $time ) { 
			$class = '';
			$hidden = ( in_array( $time, $settings->dining[date('w')] ) ) ? '' : "hidden";
			foreach( $settings->dining as $index => $day ) if( in_array( $time, $day ) ) $class .= " $index";
			echo "<option class='$class' value=$time $hidden>" . rvFormat::military_time( $time ) . "</option>";
		} ?>
		<?php for( $k = 11; $k < 24; $k += .25 ) { 
			//echo "<option value=" . (string)(60*$k) . ">" . rvFormat::military_time( 60*$k ) . "</option>"; 
		} ?>
            </select>
	<?php foreach( $settings->dining as $day => $date ) { $hidden = ( date('w') == $day ) ? '' : 'hidden'; ?>
	    <select class="dining-times day-<?php echo $day; ?>" <?php echo $hidden; ?>>
		<?php foreach( $date as $day => $time ) { ?>
		<option value=<?php echo $time; ?>><?php echo rvFormat::military_time( $time ); ?></option>	
		<?php } ?>
	    </select>
	<?php } ?>
        </div>
	<button class="btn" id="dining-reservation-button" style="display: inline-block;">Go</button>
	<script> jQuery("#dining-reservation-button").click( function($) { $("#dining-reservation-submit").trigger( "click" ); }); </script>
	<input type="submit" id="dining-reservation-submit" value='' hidden>
	</form>
        </div>
    </div>
    </div>
    <div class="clear"></div>
<div id="header">
    <div class="clear"></div>
    <div id="header-container">
    <div id="header-nav">
	<style> <?php echo '#header-nave a#'.$pagename.'-hn'; ?> { color: #b5121b; } </style>
        <ul>
	    	<?php foreach ($pages as $page) { $title = get_set_title(get_set_id($page)); ?>
		<a id="nav-tri-<?php echo $page; ?>" href="<?php echo bloginfo('wpurl').'/'.$page; ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/lane-arrow.png"></a>
		<li><a class="header-linke" id="<?php echo $page; ?>-hn" href="<?php echo bloginfo('wpurl').'/'.$page; ?>"><?php echo $title; ?></a></li>
		<?php } ?>
        </ul>
    </div>
    <div id="header-logo">
        <a href="<?php bloginfo('wpurl'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/imagene/uploads/<?php echo get_image_name('logo'); ?>"></a>
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
<img id="left-tape" src='<?php echo get_template_directory_uri(); ?>/img/crop_r.png'><img id="club" src='<?php echo get_template_directory_uri(); ?>/img/crop_c.png'><img id="right-tape" src='<?php echo get_template_directory_uri(); ?>/img/crop_r.png'>
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
                  <div class="controls">
		    <select name="date" class="input-sm" id="book-reservation-date">
			<?php $datetime = new DateTime(date('Y-m-d')); ?>
			<?php for ( $i=0; $i<7; $i++ ) { $datetime->modify('+1 day'); echo "<option value='" . $datetime->format('m/d/Y') . "'>" . $datetime->format('D M j') . "</option>"; } ?>
		    </select>
                  </div>
<!--
                    <input type="text" style="width: 300px" name="date" id="book-reservation-date" value="<?php echo date('m/d/Y'); ?>"  class="span4"/>
-->
                </div>
              </div>
              <div class="control-group">

                <div class="inline">
                <label class="control-label" for="book-reservation-bowlers">Bowlers</label>
                <div class="controls">
                    <input type="text" class="form-control input-sm" id="book-reservation-bowlers" name="bowlers" value=1 style="width: 125px">
                </div> 
		</div>
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
                <label class="control-label">Start</label>
                <div class="controls">
		  <?php $date = new rvDate( date('Y-m-d', strtotime(' + 1 day ')) ); ?>
		<div class="dropdown">
                  <select type="text" class="input-sm" id="book-reservation-start" name="start">
		<?php array_pop( $date->hours ); foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { 
			$max = ( $hour == 15 || $hour == 16 ) ? 4 : 3;	
		?>
                    <option value=<?php echo $hour; ?> data-lanes=<?php echo $lanes = min( $max-$date->weblanes[$hour], $date->count_hour( $hour ) ); ?> data-price=<?php echo $date->settings->get_pricing( $date->day, $hour ); ?>><?php echo rvFormat::military_hour( $hour ); ?> <?php //echo $lanes; ?></option>
		<?php } } ?>
                  </select>
<!--
		  <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
		  Start
		    <span class="caret"></span>
		  </button>

		  <ul class="dropdown-menu" role="menu" id="book-reservation-hours-menu" aria-labelledby="dropdownMenu2">
		  <?php foreach ( $date->hours as $hour ) { if ( $date->check_hour( $hour ) ) { ?>
		  <li><a><span class="count hide"><?php echo $date->count_hour( $hour ); ?></span><?php echo rvFormat::military_hour( $hour ); ?><input type="checkbox" name="hour" class="book-reservation-hours hide" value="<?php echo $hour; ?>"><span  style="float: right;">$<span class="pricetag"><?php echo $date->settings->get_pricing( $date->day, $hour ); ?></span></span></a></li>
		  <?php } } ?>
		  </ul>
-->
		</div>
                </div> 
                </div>

                <div class="inline">
                <label class="control-label">Hours</label>
                <div class="controls">
                  <select type="text" class="input-sm" id="book-reservation-hours-count" name="lanes" data-original-title="Lanes">
                    <option value=1>1</option>
                    <option value=2>2</option>
                  </select>
                </div> 
		</div>
                <div class="inline">  
                <div class="controls">
                  Price: <span class="inline" id="book-reservation-price-display">$0</span>
                    <input type="text" class="form-control hide" id="book-reservation-price" value=0>
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
                  <label class="col-xs-4" for="phone">Phone:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="book-reservation-phone" placeholder="Phone">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Email:*</label>
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
                  <div class="col-xs-8">
                    <input type="text" class="input-sm hide" id="book-reservation-hours" name="hours" data-original-title="Bowlers">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-8">
                    <input class="form-control hide" id="book-reservation-action" placeholder="Action" value="add_reservation">
                  </div>
                </div>
              </form>
	      <div id="book-reservation-information">
Please read before booking:
<br>
- MBC is a 21+ venue everyday, except for 11am-7pm on Saturdays & Sundays.
<br>
- Be sure to let us know if you will require bumpers, as only 2 of our 6 lanes have them and they're booked by families' on a first come, first serve basis.
<br>
<span style="font-weight: bold">- Reservation payment is monetarily <span style="color: red">non-refundable</span>. If a guest cancels a reservation <span style="text-decoration: underline">within 48 hours of reserved date</span>, a credit will be issued for a future reservation valid for up to one calendar year. If a guest cancels <span style="text-decoration: underline">within 48 hours of reserved date</span>, no credit will be offered.</span> 
	      </div>
              <div id="book-reservation-result" hidden>Result</div>


<?php


?>

            </fieldset>
          </form>
        </div> 

      </div>
      <div class="modal-footer">
        <p class="label label-warning pull-left" id="book-reservation-required-message" hidden>Some Fields are Blank</p>
        <button type="button" class="btn btn-default" id="book-reservation-close" data-dismiss="modal" id="close-modal">Close</button>
        <button type="button" class="btn btn-primary" id="book-reservation-submit">Book and pay</button>
	<input type="hidden" id="RID">
	<div class="hide" id="anf"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<button type="button" class="btn btn-success hide" id="update-contents" data-id="null">&nbsp;&nbsp;&nbsp;</button>
<button type="button" class="btn btn-default hide" id="update-image-contents" data-id="null">&nbsp;&nbsp;&nbsp;</button>


<!-- Button trigger modal -->
<button class="btn btn-default btn-lg hide" id="payment-button" data-toggle="modal" data-target="#paymentModal">
Payment
</button>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Payment</h4>
      </div>
      <div class="modal-body">
                <div class="row">
                  <label class="col-xs-4" for="name">First name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="payment-first-name" value="Joshua">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="name">Last name:*</label>
                  <div class="col-xs-8">
                    <input type="email" class="form-control" id="payment-last-name" value="Kornreich">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="company">Company:</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-company"value="Tier 27">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="phone">Phone:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-phone" value="9548823115">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Email:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-email" value="joshua.kornreich@gmail.com">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Address:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-address" value="1021 Pennsylvania Ave E">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">City:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-city" value="Warren">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">State:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-state" value="PA">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Zip:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-zip" value="16365">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Price:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-price">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Card number:*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-card-number" value="4007000000027">
                  </div>
                </div>
                <div class="row">
                  <label class="col-xs-4" for="email">Expiration date (mm/yy):*</label>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="payment-expiration" value="10/16">
                  </div>
                </div>
	<div id="payment-response"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="payment-submit">Submit payment</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg hide" id='gallery-button' data-toggle="modal" data-target="#galleryModal">
</button>

<!-- Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Gallery Images</h4>
      </div>
      <div class="modal-body">

 <form method="post" action="#" enctype="multipart/form-data" >
      <input type="file" name="featured_image" class="hide" id="uploaded-image">
      <input type="submit" id="upload-image-submit" class="hide">
 </form>
<?php
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once( ABSPATH . 'wp-admin/includes/image.php' );

	if ( isset( $_FILES['featured_image'] ) ) {
  	    $file_return = wp_handle_upload($_FILES['featured_image'], array('test_form' => FALSE));
	    if( ! isset($file_return['error']) ) {
		    $filename = $file_return['file'];

		    $attachment = array(
			'post_mime_type' => $file_return['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
			'post_content' => '',
			'post_status' => 'inherit',
			'guid' => $file_return['url']
		    );
		    $attach_id = wp_insert_attachment( $attachment, $file_return['url'] );

		    if( $attach_data = wp_generate_attachment_metadata($attach_id, $file_return['file']) ) {
			wp_update_attachment_metadata($attach_id, $attach_data);
		    }
	    }
	}
?>
	<?php
		    $uploads = wp_upload_dir();
		$images = get_gallery_images(); 
		echo "<ul class='gallery'>";
		$i = 0;
		foreach( $images as $image ) {
/*
			continue;
			$i++;
			$path = str_replace($uploads['baseurl'], $uploads['basedir'], $image->guid);
		echo "File Return:::::".$file_return['file'];
		echo ":::::Path:::::".$path.":::::";
		echo "Equal::: " . ( $file_return['file'] == $path );
			wp_update_attachment_metadata($image->ID, wp_generate_attachment_metadata($image->ID, $path));
			echo $image->ID;
			echo "B Partial Success. $path";
			echo "-----------------------$path--------------------";
*/
			$src = wp_get_attachment_image_src( $image->ID, 'thumbnail' ); $image_src = $src[0];
			echo "<li><img class='gallery-selectable' src='$image_src' data-id='$image->ID' width=100 height=100></li>";
		}
		echo "</ul>";
	?>
      </div>

      <div class="clear"></div>
      <div class="modal-footer">
      <div class="clear"></div>
        <button type="button" class="btn btn-default" id="gallery-dismiss" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id="gallery-delete" >Delete Image</button>
        <button type="button" class="btn btn-primary" id="gallery-upload" >Upload Image</button>
        <button type="button" class="btn btn-success hide" id="gallery-upload-confirm" >Confirm Upload</button>
        <button type="button" class="btn btn-primary hide" id="gallery-save" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg hide" id='set-button' data-toggle="modal" data-target="#setModal">
</button>
<button class="btn btn-primary btn-lg hide" id='image-set-button' data-toggle="modal" data-target="#imageSetModal">
</button>

<!-- Modal -->
<div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">FAQs</h4>
      </div>
      <div class="modal-body">

	<?php 
		$faqs = get_post_meta( 175, 'faqs', true );
		foreach ( $faqs as $q => $a ) { continue; ?>
			<div class="form-group faq">
			  <input type="email" class="form-control question" value="<?php echo $q; ?>">
			  <br>
			  <textarea class="form-control answer" rows="3"><?php echo $a; ?></textarea>
			</div>
			<?php
		}
	?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="set-dismiss" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id="set-add" >Add</button>
        <button type="button" class="btn btn-primary" id="set-save" data-dismiss="modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageSetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Images</h4>
      </div>
      <div class="modal-body">

      </div>

      <div class="clear"></div>
      <div class="modal-footer">
      <div class="clear"></div>
        <button type="button" class="btn btn-default" id="image-set-dismiss" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id="image-set-remove" data-id="null">Remove Image</button>
        <button type="button" class="btn btn-success" id="image-set-add" >Add Image</button>
        <button type="button" class="btn btn-primary" id="image-set-save" data-dismiss="modal">Save Changes</button>
      </div>
    </div>
  </div>
</div>
<!--
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/reservations.js?ver=1.01'></script>
<script type='text/javascript' src='<?php echo plugins_url(); ?>/reservations/assets/subscript.js?ver=1.01'></script>
-->
<?php echo "<script> var ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "'; </script>"; ?>
	<script>
	jQuery( function($) {
		$('#anf').click( function() {
		var names = $('#book-reservation-name').val().split(' ');
                var ajaxdata = {
                        action:         'authorize_net_form',
			ID:		$('#RID').val(),
			price:		$('#book-reservation-price').val(),
			first:		names[0],
			last:		names[1],
			company:	$('#book-reservation-company').val(),
			email:		$('#book-reservation-email').val(),
			phone:		$('#book-reservation-phone').val()
                };

                $.post( ajaxurl, ajaxdata, function(res){
                        $('#anf').html(res);
			$('#submit-pay').trigger('click');
		});

		});
		$('#gallery-upload').click( function() {
			$("#uploaded-image").trigger('click');
		});
		$('#gallery-delete').click( function() {
			$(this).toggleClass('btn-warning').toggleClass('btn-danger');
			$('.gallery-selectable').bind('click', markForDeletion)
		});

          	$('#set-save').click( function() {
			var set = new Array();
			var setname = $('#setModal .setname').attr('data-id');
			$.each( $('#setModal .element'), function( index, value ) { 
				set.push($(value).find('.key').val() + '::' + $(value).find('.value').val());;
			});
			set = set.join('||');
			var ajaxdata = {
				action:		'update_frontend_set_contents',
				set:		set,
				setname:	setname
			};

			$.post( ajaxurl, ajaxdata, function(res){
				$('.contents').filter( function() { return $(this).attr('data-id') == $('#setModal .setname').attr('data-id'); } ).html(res);
                                $.getScript( "<?php echo get_template_directory_uri() . '/js/bowling.js'; ?>" );
			});

		});
		
		$('#set-add').click( function() {
			$('#setModal .modal-body').append('<div class="form-group element"><input type="email" class="form-control key"><br><textarea class="form-control value" rows="3"></textarea></div>');
		});
		function addListImageToSet() {
			$('#imageSetModal .modal-body ul').append($(this).parent().clone());
			$('#gallery-dismiss').trigger( 'click' );
			$('#image-set-button').trigger( 'click' );
			$('img').unbind( 'click', addListImageToSet );
		}
		$('#image-set-add').click( function() {
			$('#image-set-dismiss').trigger( 'click' );
			$('#gallery-button').trigger( 'click' );
			$('img').bind( 'click', addListImageToSet );
			$('#galleryModal').on('hidden.bs.modal', function() {
				$('img').unbind('click', addListImageToSet);
			});
		});
		$('#image-set-save').click( function() {
			var images = new Array();
			var setname = $('#imageSetModal .setname').attr('data-id');
			$.each( $('#imageSetModal img').not('.hide'), function( index, value ) {
				images.push( $(value).attr( 'data-id' ) );
			});
			images = images.join('||');
			var ajaxdata = {
				action:		'update_frontend_image_contents',
				images:		images,
				setname:	setname
			};

			$.post( ajaxurl, ajaxdata, function(res){
				$('.image-contents').filter( function() { return $(this).attr('data-id') == $('#imageSetModal .setname').attr('data-id'); } ).html(res);
				$('.image-contents img').bind( "click", gallery_alt );
			});
		});
		$('#image-set-remove').click( function() {
			$(this).toggleClass('btn-warning').toggleClass('btn-danger');
			$('#imageSetModal img').hover( function() {
				$(this).toggleClass('opaque');
			}).click( function() {
				$(this).addClass('hide').parent().hide();
				$('#image-set-remove').toggleClass('btn-warning').toggleClass('btn-danger');
				$('#imageSetModal img').unbind('mouseenter').unbind('mouseleave').unbind('click');
			});
		});
	
		$('#uploaded-image').change( function() {
			$('#gallery-upload-confirm').removeClass('hide');
		});
		$('#gallery-upload-confirm').click( function() {
			$('#upload-image-submit').trigger('click');
		});

		$('#b-r-s').change( function() {
			return;
			var start = $(this).find(':selected').val();
			var price = $(this).find(':selected').attr('data-price');
			if ($('#book-reservation-hours-count').val()==2) {
				price = parseInt(price) + parseInt($(this).find(':selected').next().attr('data-price'));
			}
			$('#book-reservation-price').val('$'+price);
			$('#book-reservation-price-display').html('$'+price);
			hours = start;
			if ($('#book-reservation-hours-count').val()==2) hours += ',' + (parseInt(start)+1);
			$('#book-reservation-hours').val(hours);
		});

		if ( $('#book-reservation-start option').first().attr('data-lanes')  == 1 ) $('#book-reservation-lanes option').last().hide();
		$('#book-reservation-start, #book-reservation-hours-count, #book-reservation-lanes').change( function() {
			count = $('#book-reservation-hours-count').val();
			if ( $('#book-reservation-start option:selected').attr('data-lanes')  == 1 ) $('#book-reservation-lanes option').first().attr('selected', true);
			if ( count == 2 && $('#book-reservation-start option:selected').next().attr('data-lanes')  == 1 ) $('#book-reservation-lanes option').first().attr('selected', true);
			if ( $('#book-reservation-start option:selected').next().val() - $('#book-reservation-start option:selected').val() != 1 ) {

				$('#book-reservation-hours-count option').first().attr('selected', true);
				$('#book-reservation-hours-count option').last().hide();

			}
			lanes = $('#book-reservation-lanes').val();
			var start = $('#book-reservation-start').find(':selected').val();
			var price = parseInt($('#book-reservation-start').find(':selected').attr('data-price'));
			if ( count == 2 ) price += parseInt($('#book-reservation-start').find(':selected').next().attr('data-price'));
			if ( count == 2 ) $('#book-reservation-start option').last().hide();
			if ( count == 1 ) $('#book-reservation-start option').last().show();
			if ( $('#book-reservation-start').val() == $('#book-reservation-start option').last().val() ) $('#book-reservation-hours-count option').last().hide();
			if ( $('#book-reservation-start').val() != $('#book-reservation-start option').last().val() ) $('#book-reservation-hours-count option').last().show();
			if ( $('#book-reservation-start option:selected').attr('data-lanes')  != 1 ) $('#book-reservation-lanes option').last().show();
			if ( $('#book-reservation-start option:selected').attr('data-lanes')  == 1 ) $('#book-reservation-lanes option').last().hide();
			if ( count == 2 && $('#book-reservation-start option:selected').next().attr('data-lanes')  == 1 ) $('#book-reservation-lanes option').last().hide();
			price = parseInt(price) * lanes;
			$('#book-reservation-price').val('$'+price);
			$('#book-reservation-price-display').html('$'+price);

			hours = start;
			if ($('#book-reservation-hours-count').val()==2) hours += ',' + (parseInt(start)+1);
			$('#book-reservation-hours').val(hours);
		});

		$('#pre-book-date').change( function() {
			$('#book-reservation-date').val($(this).val()).trigger("change");
		});

		$('#pre-book-lanes').change( function() {
			$('#book-reservation-lanes').val($(this).val());
		});

		$('#modal-button').click( function() {
			$('#pre-book-date').trigger("change");
			$('#pre-book-lanes').trigger("change");
			$('#book-reservation-start').trigger('change');
		});

		$('#payment-submit').click( function() {

			var ajaxdata = {
				action:		'process_authorize_transaction',
				first_name:	$('#payment-first-name').val(),
				last_name:	$('#payment-last-name').val(),
				company:	$('#payment-company').val(),
				phone:		$('#payment-phone').val(),
				email:		$('#payment-email').val(),
				address:	$('#payment-address').val(),
				city:		$('#payment-city').val(),
				state:		$('#payment-state').val(),
				zip:		$('#payment-zip').val(),
			};

			$.post( ajaxurl, ajaxdata, function(res){
				$('#payment-response').hide().html(res);
			});
		});
		$('#book-reservation-required-message').hide();

	});
	</script>
<script>
		// I had datepicker called previously
          	$('#book-reservation-date').change( function() {
			var ajaxdata = {
				action:		'update_hours',
				append:		'book-reservation-',
				simple:		true,
				datefield:           $(this).val()
			};

			$.post( ajaxurl, ajaxdata, function(res){
				$('#book-reservation-start').html(res);
                                $.getScript( "<?php echo plugins_url(); ?>/reservations/assets/modal.js" );

			});

		});
</script>
	<script>
		jQuery('.dining').change( function() {
			$('.dining-times').hide();
			day = $(this).find(':selected').attr('data-day');
			$('.day-' + day).show();
			$.each( $('.dining-time option'), function( index, value ) {
				
				if( index == 0 ) { 

					$(value).prop( 'selected', true );
	
				}

				if( $(value).hasClass( day ) )  {

					$(value).show();

				} else {$(value).hide();}

			});
		});
		jQuery('.dining-times').change( function() {
			$('.dining-time').val($(this).val());
		});
	</script>
