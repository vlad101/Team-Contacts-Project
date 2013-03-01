<?php

/////// insert profession ///////

$query = mysql_query("SELECT * from PROFESSION");
if(!$query)
	die("Unable to access database: " . mysql_error());

$query = mysql_query("INSERT INTO profession VALUES(null, '$profession')");
if(!$query)
	die("Unable to access database: " . mysql_error());

/////// insert zip code, city state ///////

$query = mysql_query("INSERT INTO zip_code VALUES('$zip_code', '$city', '$state')");
	if(!$query)
		die("Unable to access database: " . mysql_error());

/////// insert status ///////

$query = mysql_query("INSERT INTO status VALUES(null, '$status')");
if(!$query)
	die("Unable to access database: " . mysql_error());
	
/////// insert seeking ///////

$query = mysql_query("INSERT INTO seeking VALUES(null, '$seeking')");
if(!$query)
	die("Unable to access database: " . mysql_error());

/////// insert interest ///////

$query = mysql_query("INSERT INTO interests VALUES(null, '$interest')");
if(!$query)
	die("Unable to access database: " . mysql_error());

/////// insert contacts info ///////
$query = mysql_query("INSERT INTO team_contacts VALUES(null, '$last_name', '$first_name', '$phone', '$email', '$gender', '$birthday')");
if(!$query) 
	die("Unable to access database: " . mysql_error());
		
?>
