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

$query1 = mysql_query("SELECT * FROM team_contacts");
if(!$query1) die("Unable to access database: " . mysql_error());
		
echo <<<_END
	<form action="PHP-MySQL-test.php" method="post">
		<pre>

		</pre>
	</form><br />
_END;

echo '<table border="1"><tr><th>Last Name</th><th>First Name</th><th>Phone</th>' .
	 '<th>E-mail</th><th>Gender</th><th>Birthday</th><th>Zip Code</th></tr>';
$rows_tc = mysql_num_rows($query1);
for($i = 0; $i < $rows_tc; $i++)
{
	$row_tc = mysql_fetch_row($query1);
	echo "<tr><td>$row_tc[1]</td><td>$row_tc[2]</td><td>$row_tc[3]</td><td>$row_tc[4]</td>" .
	     "<td>$row_tc[5]</td><td>$row_tc[6]</td><td>$row_tc[8]</td></tr>";
}
echo '</table><br /><br /></body></html>';

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

