<head>
<style>
#cal-tab { color: grey; font: arial; margin: auto auto; }
.hundred-space { height: 100px; font-size: 75px; color: blue; }
.cal-row { }
.cal-block { height: 70px; width: 125px; display: inline-block; outline: solid 1px #b6b6b4; text-align: right; padding-right: 10px; background: white; }
.cal-top { height: 25px; text-align: center; line-height: 25px; font-weight: bold; background: #e5e4e2; }
.historic { color: #c8b560; color: #ada96e;  background: #e5e4e2; }
.today { height: 70px; width: 125px; background: #B5121B; }
</style>
</head>
<body>
<?php $shift = (int)date("d")%7-(int)date("N"); ?>
<?php $caldays = array('Sun', 'Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat'); ?>
<div id="cal-tab">
<?php $today = (int)date("j"); ?>
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
