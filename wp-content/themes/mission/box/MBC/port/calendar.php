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
<?php include('call.php'); ?>
<?php include('components/calendar_.php'); ?>
</div><!--container-->

<?php include('F.php'); ?>
</body>
</html>
