<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<?php $pagename='calendar'; ?>
<?php include('H.php'); ?>
<?php $caldays = array('Sun', 'Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat'); ?>
<div class="clear"></div>
<div class="container">
<?php include('components/calendar_.php'); ?>
<?php include('call.php'); ?>
</div><!--container-->

<?php include('F.php'); ?>
</body>
</html>
