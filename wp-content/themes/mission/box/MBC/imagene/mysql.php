<?php
$db_host     = "localhost";
$db_username = "tiercom_wizard";
$db_password = "wizard_sticks1!1";
$db_name     = "tiercom_mbc";
$conn = mysql_connect($db_host,$db_username,$db_password) or die("Could not connect to Server" .mysql_error());
mysql_select_db($db_name) or die("Could not connect to Database" .mysql_error());
?>
