<? /** Template Name: Bowling **/ ?>
<?php wp_enqueue_script('jquery'); ?>
<?php get_header(); ?>
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bowling.css">
<body>
<?php $pagename='bowling'; ?>
<?php 
	$bowling_details_children=get_set_ids(get_set_id('bowling-details')); 
	$bowling_details_children_titles=get_set_children_titles(get_set_id('bowling-details')); 
	$new_array=array("advertisement");
	$new_array['apple']='fruit';
	$return_image='return_image';
	$new_array['image']=$return_image($new_array[0], 100, 100);
?>
<div class="clear"></div>
<div id="bowling">
<div class="container">
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/S1.css">
<div class="S1">
<?php function sidebar_calendar() { ?>
<head>
<style>
#cal-tab { color: grey; font: arial; font-size: 8px; margin: auto auto; outline: solid 1px #b6b6b4; }
.hundred-space { height: 100px; font-size: 75px; color: blue; }
.cal-row { }
.cal-block { height: 35px; width: 13%; display: inline-block; outline: solid 1px #b6b6b4; text-align: right; padding-right: 1.2857%; background: white; }
.cal-top { height: 15px; text-align: center; line-height: 12px; font-weight: bold; background: #e5e4e2; }
.historic { color: #c8b560; color: #ada96e;  background: #e5e4e2; }
.today { background: #B5121B; }
#month { background: white; font-size: 15px; text-align: center; height: 30px; padding-top: 15px; }
</style>
</head>
<body>
<?php $shift = (int)date("d")%7-(int)date("N"); ?>
<?php $caldays = array('S', 'M', 'T', 'W', 'T', 'F', 'S'); ?>
<div id="cal-tab">
<?php $today = (int)date("j"); ?>
<div class="cal-row" id="month"><?php echo date("F"); ?></div>
<div class="cal-row"><?php for ($i=0;$i<7;$i++) { echo '<div class="cal-block cal-top">'.$caldays[$i].'</div>'; } ?></div>
<?php for ($i=0;$i<5;$i++) { echo '<div class="cal-row">'; ?>
<?php for ($j=0;$j<7;$j++) { 
$date= 7*$i+$j+$shift; 
$date_class='current'; 
	if ($date <= 0) { 
	$date+=31; 
	$date_class='historic'; } 
	if ($date > (int)date('t')) {
	$date-=(int)date('t');
	$date_class='historic'; }
	$diff=$date-$today;
	if ($date==$today && $date_class != 'historic') {
	$date_class='today'; }
echo '<div class="cal-block '.$date_class.'">'.$date.'</div>'; 
} ?>
<?php echo '</div>'; } ?>
</div>
</body>
</html>
<?php } ?>
<div class="bowling-col-beta">	
	<style> 
	.side li img {
		width: 110px;
		height: 110px;
	}
	</style>
	<ul class="gallery side">
		<li><?php simple_thumbnail_image( 51 ); ?></li>
		<li><?php simple_thumbnail_image( 52 ); ?></li>
		<li><?php simple_thumbnail_image( 56 ); ?></li>
		<li><?php simple_thumbnail_image( 57 ); ?></li>
		<li><?php simple_thumbnail_image( 58 ); ?></li>
		<li><?php simple_thumbnail_image( 59 ); ?></li>
		<li><?php simple_thumbnail_image( 60 ); ?></li>
		<li><?php simple_thumbnail_image( 61 ); ?></li>
	</ul>
	<div id="sidebar-plan-event-calendar">
		<?php// echo execute_set_function(44); ?>
	</div>
	<style> #advertisement img { width: 230px; height: 200px; } </style>
		<div id="advertisement"><?php //simple_thumbnail_image( 55 ); ?></div>
</div>
</div>


	<div class="bowling-col-alpha">	
  <div id="tabbed_box_1" class="tabbed_box">  
    <h2><?php simple_block( 53, 'Bowling Details' ); ?> <small><?php simple_block( 54, "Select a Tab" ); ?></small></h2>  
  <div class="tabbed_area">  
      
        <!--<script src="<?php echo get_template_directory_uri(); ?>/js/functions.js" type="text/javascript"></script>-->   
<ul class="tabs">  
    <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active"><?php simple_block( 151, 'Information' ); ?></a></li>  
    <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2"><?php simple_block( 152, 'Pricing' ); ?></a></li>  
    <li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3"><?php simple_block( 153, 'Bowling Reservations' ); ?></a></li>  
    <li><a href="javascript:tabSwitch('tab_4', 'content_4');" id="tab_4"><?php simple_block( 154, 'FAQs'); ?></a></li>  
</ul>  
          
        <div id="content_1" class="content">  
        <h2><?php simple_block( '12', 'Information' ); ?></h2>
        <p><?php simple_block( '13', 'MBC has six regulation size bowling lanes, outfitted with automatic scoring and ball speed technology. We base our pricing on 6 people per lane and charge by the hour.' ); ?></h2>
        <h2><?php simple_block( '14', 'Family Bowl' ); ?></h2>
        <p><?php simple_block( '15', 'Our family bowling hours are on Saturdays and Sundays from 11am to 7pm. During these times, we welcome bowlers of all ages to come enjoy both bowling and dining. These are the only times we are able to allow guests who are under 21 in the venue...' ); ?></h2>
        <h2><?php simple_block( '16', 'Walk-in Guests' ); ?></h2>
        <p><?php simple_block( '17', 'We keep two to three lanes open everyday for walk-in guests. These walk-in lanes can be reserved using a first come, first serve wait list. Guests must in the venue to place their names on the wait list.' ); ?></h2>
        </div>  
        <div id="content_2" class="content">  
            
        <h2><?php simple_block( '18', 'Pricing' ); ?></h2>
        <div class="pricing-col">
        <h3><?php simple_block( '19', 'Weekday Pricing' ); ?></h2>
                <table class="table-striped">  
                <tbody> 
                 <tr>
		    <td><?php simple_block( '20', '3PM - 6PM' ); ?></td>
		    <td><?php simple_block( '21', '$35/lane/hour' ); ?></td>
                  </tr>
                  <tr>
		    <td><?php simple_block( '22', '6PM - 8PM' ); ?></td>
		    <td><?php simple_block( '23', '$45/lane/hour' ); ?></td>
                  </tr>
                  <tr>
		    <td><?php simple_block( '24', '8PM - CLOSE' ); ?></td>
		    <td><?php simple_block( '25', '$55/lane/hour' ); ?></td>
                  </tr>
                </tbody> 
                </table> 
                 </div>

                 <div class="pricing-col">
		      <h3><?php simple_block( '26', 'Weekend Pricing' ); ?></h3>
                <table class="table-striped">   
                <tbody> 
                 <tr>
		    <td><?php simple_block( '27', '11AM - 2PM' ); ?></td>
		    <td><?php simple_block( '28', '$35/lane/hour' ); ?></td>
                  </tr>
                  <tr>
		    <td><?php simple_block( '29', '2PM - 8PM' ); ?></td>
		    <td><?php simple_block( '30', '$45/lane/hour' ); ?></td>
                  </tr>
                  <tr>
		    <td><?php simple_block( '31', '8PM - CLOSE' ); ?></td>
		    <td><?php simple_block( '32', '$55/lane/hour' ); ?></td>
                  </tr>

                </tbody> 
                </table>
                 </div>
                 <span class="stretch"></span>
             </div>


 
        <div id="content_3" class="content">              
        	<h2><?php simple_block( '33', 'Select your group size' ); ?></h2>
		<div class="contents" data-id="groups">
		<?php frontend_get_questions( 'groups' ); ?>
		</div>
        </div> 

        <div id="content_4" class="content">              
		<h2 class="dots"><span class="dots"><?php simple_block( 46, "Bowling FAQs" ); ?></span><div class="stripe-line"> </div></h2>
		<div class="contents" data-id="faqs">
		<?php frontend_get_questions( 'faqs' ); ?>
		</div>
	</div>
      </div>
</div>



	</div>
</div>
</div>
</body>
</html>
<?php get_footer(); ?>

