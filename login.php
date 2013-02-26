<?php
	
$db_hostname = 'localhost';
$db_database = 'team_contacts';
$db_username = 'root';
$db_password = 'password';
	
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) 
	die("Unable to Connect to MySQL: " . mysql_error());
	
mysql_select_db($db_database) or die("Unable to Select Database: " . mysql_error());
	
?>
