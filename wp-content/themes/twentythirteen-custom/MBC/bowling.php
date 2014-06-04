<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="author" content="Tier 27, LLC">
  	<link type="text/css" rel="stylesheet" href="css/bowling.css">
    <script type="text/javascript"src="js/jquery.js"></script>
</head>
<body>
<?php $pagename='bowling'; ?>
<?php include("H.php"); ?>
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
	<?php include("S1.php"); ?>
	<div class="bowling-col-alpha">	
  <div id="tabbed_box_1" class="tabbed_box">  
    <h2>Bowling Details <small>Select a Tab</small></h2>  
  <div class="tabbed_area">  
      
        <script src="functions.js" type="text/javascript"></script>   
<ul class="tabs">  
    <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active"><?php echo $bowling_details_children_titles[0]; ?></a></li>  
    <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2"><?php echo $bowling_details_children_titles[1]; ?></a></li>  
    <li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">Bowling Reservations<?php //echo $bowling_details_children_titles[2]; ?></a></li>  
    <li><a href="javascript:tabSwitch('tab_4', 'content_4');" id="tab_4">FAQs<?php //echo $bowling_details_children_titles[2]; ?></a></li>  
</ul>  
          
        <div id="content_1" class="content">  
                    <h2><?php echo $bowling_details_children_titles[0]; ?></h2>
                    <p>MBC has six regulation size bowling lanes, outfitted with automatic scoring and ball speed technology. 
                      We base our pricing on 6 people per lane and charge by the hour.</p>
                     <h3><?php //echo get_set_title(get_set_id('information-tab-reservations')); ?></h3>
		     <p><?php //echo get_contents(get_set_id('information-tab-reservations')); ?></p><br>
                     <h3><?php echo get_set_title(get_set_id('information-tab-family-bowl')); ?></h3>
		     <p><?php //echo get_contents(get_set_id('information-tab-family-bowl')); ?></p>
         <p>Our family bowling hours are on Saturdays and Sundays from 11am to 7pm. During these times, we welcome bowlers of all ages to come enjoy 
          both bowling and dining. These are the only times we are able to allow guests who are under 21 in the venue.</p><br>
         <h3>Walk-in Guests</h3>
         <p>We keep two to three lanes open everyday for walk-in guests. These walk-in lanes can be reserved using a first come, first serve wait list. 
          Guests must in the venue to place their names on the wait list.</p>
        </div>  
        <div id="content_2" class="content">  
            
        	<h2><?php echo $bowling_details_children_titles[1]; ?></h2>
		<?php $pricing_children=get_set_ids($bowling_details_children[1]); ?>
                 <div class="pricing-col">
                      <h3><?php //echo get_set_title($pricing_children[0]); ?></h3>
                      <h3>Weekday Pricing</h3>
		<?php //$weekday_bowling_rates_contents=get_children_contents($pricing_children[0]); ?>
    <?php $weekday_bowling_rates_contents=array(); ?>
                <table class="table-striped">  
                <tbody> 
		<?php foreach ($weekday_bowling_rates_contents as $child) { ?>
                 <tr><?php //foreach ($child as $identifier=>$contents) { ?>
                  <td><?php //echo $contents; ?></td><?php //} ?>
                 </tr><?php } ?>
                 <tr>
                    <td>3pm - 6pm</td>
                    <td>$35/lane/hour</td>
                  </tr>
                  <tr>
                    <td>6pm - 8pm</td>
                    <td>$45/lane/hour</td>
                  </tr>
                  <tr>
                    <td>8pm - close</td>
                    <td>$55/lane/hour</td>
                  </tr>
                </tbody> 
                </table> 
                 </div>

                 <div class="pricing-col">
                      <h3><?php //echo get_set_title($pricing_children[1]); ?></h3>
                      <h3>Weekend Pricing</h3>
		<?php //$weekend_bowling_rates_contents=get_children_contents($pricing_children[1]); ?>
                <table class="table-striped">   
                <tbody> 
		<?php //foreach ($weekend_bowling_rates_contents as $child) { ?>
                 <!--<tr><?php //foreach ($child as $identifier=>$contents) { ?>
                  <td><?php //echo $contents; ?></td><?php //} ?>
                 </tr><?php //} ?>-->
                 <tr>
                    <td>11am - 2pm</td>
                    <td>$35/lane/hour</td>
                  </tr>
                  <tr>
                    <td>2pm - 8pm</td>
                    <td>$45/lane/hour</td>
                  </tr>
                  <tr>
                    <td>8pm - lose</td>
                    <td>$55/lane/hour</td>
                  </tr>

                </tbody> 
                </table>
                 </div>
                 <span class="stretch"></span>
             </div>


 
        <div id="content_3" class="content">              
        	<h2>Select your group size<?php //echo $bowling_details_children_titles[2]; ?></h2>
		<?php $bowling_faq_contents=get_children_contents($bowling_details_children[2]); ?>
		<?php $i=0; ?>
		<?php foreach ($bowling_faq_contents as $child) { $i++; ?>
                    <!--<div class="q">
                           <h3 class="qhead"><a href="#q0<?php echo $i; ?>"><?php echo $child['title']; ?></a></h3>
                           <div class="answer" id="q0<?php echo $i; ?>"><p><?php echo $child['contents']; ?></p></div>
                    </div>-->

		<?php } ?>
                        <div class="q">
                           <h3 class="qhead"><a href="#q0">Groups of 1-6 Bowlers</a></h3>
                           <div class="answer" id="q0"><p>Groups of 1 to 6 people, you can book a single lane online, up to one week in advance. Online reservations will become available through our online system at midnight, 7 days to 24 hours in advance. Once you select a date, <i>only the times that are available will appear.</i> Same day reservations are not permitted as our first come, first serve wait list is in effect upon opening. </p></div>
                           <h3 class="qhead"><a href="#q1">Groups of 7-12 Bowlers</a></h3>
                           <div class="answer" id="q1"><p>Groups of 7-12 people can reserve a two lane bowling reservation two ways: Use our online reservation system for reservations that are less than a week away (only the dates/times available will appear in the drop down menu) OR You can fill out the <a href="#">Special Event Inquiry Form</a> and a member of our Events Staff will contact you within 48 hours to set up the reservation. </p></div>
                           <h3 class="qhead"><a href="#q2">Groups of 13-18 Bowlers</a></h3>
                           <div class="answer" id="q2"><p>
Groups of 13-18 people will require three lanes, and can be booked up to one month in advance through our Events Department. To submit a request, fill out the Special Events Inquiry Form [link to form] and a member of our Events Staff will contact you within 48 hours to set up the reservation. 
</p></div>
                           <h3 class="qhead"><a href="#q3">
				Groups of 18-45 // 3pm - 7pm
				</a></h3>
                           <div class="answer" id="q3"><p>
		Perfect for Happy Hour or Team Building events! Reserving as a Large Party at the Lanes offers priority bowling reservations as well as a pre-arranged Banquet Menu [attach Large Party Menu] to enjoy while at the lanes. A Food & Beverage Minimum will be applied, in addition to bowling charges. Please fill out the Special Events Inquiry Form [link to form] and our Events Director will contact you to set up the reservation. 	
				</p></div>
                           <h3 class="qhead"><a href="#q4">
				Groups of 18-45 // Weeknights, 7pm - 12am: Partial Buyout
				</a></h3>
                           <div class="answer" id="q4"><p>
			Whether you're celebrating a birthday or a company milestone, the Partial Buyout is a great match! This option provides exclusive use of the Mezzanine for private buffet dining and drinks, followed by bowling on multiple, priority lanes. Based on the event date, a custom Rental Fee will be calculated to include: a Large Party Menu [attach Large Party Menus], alcoholic beverages, and a facility fee. Please fill out the Special Events Inquiry Form [link to form] and our Events Director will contact you to set up the reservation. 	
				</p></div>
                           <h3 class="qhead"><a href="#q5">
				Groups of 45-180: Full Buyout
				</a></h3>
                           <div class="answer" id="q5"><p>
MBC is catered to groups of 45+ people who are interested in reserving our entire venue. Our dedicated Events Staff will work diligently to tailor your experience and create a one-of-a-kind event. 

Based on the event date and time, a custom Rental Fee will be calculated to include: a Large Party Menu [attached Large Party Menus], alcoholic beverages, unlimited bowling and shoe rentals. 
				</p>
<p>We offer in-house AV equipment (projector with a 10 ft. x 12 ft. screen, microphones, and music system). And our bowling staff will provide quality assistance to structure the bowling games to match your groups' needs. To learn more about a Full Buyout, please fill out the Special Events Inquiry Form [link to form] and our Events Director will contact you to set up the reservation.</p> </div>
                    </div>
        </div> 

        <div id="content_4" class="content">              
		<h2 class="dots"><span class="dots">Bowling FAQs</span><div class="stripe-line"> </div></h2>
		<div class="q">
  			<h3 class="qhead"><a href="#q01">Can I make a same day reservation for bowling?</a></h3>
  			<div class="answer" id="q01"><p>Maybe</p></div>
		</div>
		<div class="q">
  			<h3 class="qhead"><a href="#q02">Can I make a same day reservation for dining?</a></h3>
  			<div class="answer" id="q02"><p>Maybe</p></div>
		</div>
	</div>
      </div>
</div>



	</div>
</div>
</div>
<?php include("F.php"); ?>
<script>
	$(document).ready(function(){
  $(".qhead a").on("click", function(e){
    e.preventDefault();
    var href = $(this).attr("href");
    
    $(href).fadeToggle(450);
  });
});
</script>
</body>
</html>
