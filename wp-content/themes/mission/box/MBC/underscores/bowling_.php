<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="author" content="Tier 27, LLC">
  	<link type="text/css" rel="stylesheet" href="MBC/MBC/bowling.css">
    <script type="text/javascript"src="MBC/MBC/jquery.js"></script>
</head>
<body>
<?php include('MBC/MBC/header.php'); ?>
<div class="clear"></div>
<div id="bowling">
<div class="container">
	<div class="bowling-col-alpha">	
  <div id="tabbed_box_1" class="tabbed_box">  
    <h2>Bowling Details <small>Select a Tab</small></h2>  
  <div class="tabbed_area">  
      
        <script src="functions.js" type="text/javascript"></script>   
<ul class="tabs">  
    <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Information</a></li>  
    <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Pricing</a></li>  
    <li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">FAQ</a></li>  
</ul>  
          
        <div id="content_1" class="content">  
            
                    <h2>Information</h2>
                     <h3>Reservations</h3>
                     <p>With six available lanes, reservations are highly recommended. With the exception of our 
                      Private Events, MBC will always allow advanced reservations for up to three lanes, as well as 
                      keep three lanes open for walk-in guests. Lanes can be booked 24 hours to 7 days in advance 
                      through our online reservation system, and up to three weeks in advance through our Events & 
                      Parties submissions.</p><br>
                     <h3>Family Bowl</h3>
                     <p>MBC welcomes guests of all ages to bowl with us on Saturday and Sundays from 11am-7pm. 
                      We are 21+ during all other times. We require children fit into a size 12 shoe or higher and 
                      have the ability to carry a 6 lb. ball to be on the lanes. Our children’s bowling shoes start at 
                      size 12/1. All children under the age of 16 need to be accompanied by a responsible adult.</p> 
        </div>  
        <div id="content_2" class="content">  
            
        <h2>Pricing</h2>
                 <div class="pricing-col">
                      <h3>Weekday Bowling Rates</h3>
                <table class="table-striped">  
                <tbody> 
                  <tr> 
                    <td>Before 6pm</td> 
                    <td>$35/lane/hour</td> 
                  </tr> 
                  <tr> 
                    <td>After 6pm</td> 
                    <td>$45/lane/hour</td>  
                  </tr> 
                  <tr> 
                    <td>After 8pm</td> 
                    <td>$55/lane/hour</td>   
                  </tr>
                  <tr> 
                    <td>Shoe Rental</td> 
                    <td>$4 per person</td>   
                  </tr> 
                  <tr> 
                    <td>Socks</td> 
                    <td>$4 per pair</td>   
                  </tr> 
                </tbody> 
                </table> 
                 </div>
                 <div class="pricing-col">
                      <h3>Weekend Bowling Rates</h3>
                <table class="table table-striped">   
                <tbody> 
                  <tr> 
                    <td>Before 2pm</td> 
                    <td>$35/lane/hour</td> 
                  </tr> 
                  <tr> 
                    <td>Between 2pm - 8pm</td> 
                    <td>$45/lane/hour</td>  
                  </tr> 
                  <tr> 
                    <td>After 8pm</td> 
                    <td>$55/lane/hour</td>   
                  </tr>
                  <tr> 
                    <td>Shoe Rental</td> 
                    <td>$4 per person</td>   
                  </tr> 
                  <tr> 
                    <td>Socks</td> 
                    <td>$4 per pair</td>   
                  </tr> 
                </tbody> 
                </table>
                 </div>
                 <span class="stretch"></span>
             </div> 
        <div id="content_3" class="content">  
            
<h2>Bowling FAQ</h2>
                    <div class="q">
                           <h3 class="qhead"><a href="#q01">This is where Question 1 goes</a></h3>
                           <div class="answer" id="q01"><p>And here is the answer</p></div>
                    </div>
                    <div class="q">
                           <h3 class="qhead"><a href="#q02">This is where Question 2 goes</a></h3>
                           <div class="answer" id="q02"><p>And here is the answer</p></div>
                    </div>
                    <div class="q">
                           <h3 class="qhead"><a href="#q03">This is where Question 3 goes</a></h3>
                           <div class="answer" id="q03"><p>And here is the answer</p></div>
                    </div>
                    <div class="q">
                           <h3 class="qhead"><a href="#q04">This is where Question 4 goes</a></h3>
                           <div class="answer" id="q04"><p>And here is the answer</p></div>
                    </div>
                    <div class="q">
                           <h3 class="qhead"><a href="#q05">This is where Question 5 goes</a></h3>
                           <div class="answer" id="q05"><p>And here is the answer</p></div>
        </div> 
      </div>
</div>












	</div>
</div>
</div>
<?php include('MBC/MBC/footer.php'); ?>
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
