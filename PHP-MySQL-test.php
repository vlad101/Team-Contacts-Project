<?php

require_once 'login.php';

$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("Unable to Connect to MySQL: " . mysql_error());
	
mysql_select_db($db_database) or die("Unable to Select Database: " . mysql_error());
	
echo <<<_END

<html>
	<head>
		<title>PHP-MySQL Form</title>
	</head>
	<body>
	
_END;
		
echo <<<_END
	<form action="testphpmysql1.php" method="post">
		<pre>

		</pre>
	</form><br />
_END;

// retrieving contacts data

$query = mysql_query("SELECT * FROM team_contacts");
if(!$query) die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>First Name</th><th>Phone</th>' .
	 '<th>E-mail</th><th>Gender</th><th>Birthday</th><th>Zip Code</th></tr>';
$rows_tc = mysql_num_rows($query);
for($i = 0; $i < $rows_tc; $i++)
{
	$row_tc = mysql_fetch_row($query);
	echo "<tr><td>$row_tc[1]</td><td>$row_tc[2]</td><td>$row_tc[3]</td><td>$row_tc[4]</td>" .
	     "<td>$row_tc[5]</td><td>$row_tc[6]</td><td>$row_tc[8]</td></tr>";
}
echo '</table><br /><br />';

// retrieving contacts interests
$query = mysql_query(
						  'SELECT tc.last_name, inter.interest FROM team_contacts AS tc ' . 
						  'INNER JOIN contact_interest AS ci ' . 
						  'ON tc.contact_id=ci.contact_id ' . 
						  'INNER JOIN interests AS inter ' . 
						  'ON inter.interest_id=ci.interest_id ' . 
						  'ORDER BY last_name'
					 );
if(!$query) die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Interests</th></tr>';
$rows_tc_int = mysql_num_rows($query);
for($j = 0; $j < $rows_tc_int; $j++)
{
	$row_tc_int = mysql_fetch_row($query);
	echo "<tr><td>$row_tc_int[0]</td><td>$row_tc_int[1]</td></tr>";
}
echo '</table><br /><br />';

// retrieving contacts seeking
$query = mysql_query(
						  'SELECT tc.last_name, s.seeking FROM team_contacts AS tc ' . 
						  'INNER JOIN contact_seeking AS cs ' . 
						  'ON tc.contact_id=cs.contact_id ' . 
						  'INNER JOIN seeking AS s ' . 
						  'ON s.seeking_id=cs.seeking_id ' . 
						  'ORDER BY last_name'
					 );
if(!$query) die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Seeking</th></tr>';
$rows_tc_int = mysql_num_rows($query);
for($j = 0; $j < $rows_tc_int; $j++)
{
	$row_tc_int = mysql_fetch_row($query);
	echo "<tr><td>$row_tc_int[0]</td><td>$row_tc_int[1]</td></tr>";
}
echo '</table><br /><br />';

echo '</body></html>';

function sanitizeString($var)
{
	if(get_magic_quotes_gpc())
		$var = strpslashes($var);
	$var = htmlentities($var);
	$var = strip_tags($var);
	return $var; 
}

function sanitizeMySQL($var)
{
	$var = mysql_real_escape_string($var);
	$var = sanitizeString($var);
	return $var;
}
	
?>
