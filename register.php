<?php

require 'login.php';

echo <<<_END

<html>
<head>
	<title>Registration Form</title></head>
<body>
_END;

if(

	isset($_POST['last_name']) && isset($_POST['first_name']) &&
	isset($_POST['username'])  && isset($_POST['password'])
  )
{
	$last_name = sanitizeMySQL($_POST['last_name']);
	$first_name = sanitizeMySQL($_POST['first_name']);
	$username = sanitizeMySQL($_POST['username']);
	$password = sanitizeMySQL($_POST['password']);
	
	$salt1 = "qm&h*";
	$salt2 = "pg!@";
	$token = sha1("$salt1$password$salt2");
	
	add_user($last_name, $first_name, $username, $token);
}

echo <<<_END

<h3>Registration Form</h3>

<form action="register.php" method="post">
<pre>
        Last Name <input type="text" name="last_name" />
       First Name <input type="text" name="first_name" />
         Username <input type="text" name="username" />
         Password <input type="text" name="password" /> 
                  <input type="submit" value="Register!">
</pre>
</form>

_END;

echo <<<_END

</body></html>

_END;

	function add_user($ln, $fn, $un, $pass)
	{
		$query = mysql_query("INSERT INTO users VALUES(null, '$ln', '$fn', '$un', '$pass')");
		if(!$query)
			die("Unalbe to connect to database" . mysql_error());
			
		header('Location: testphpmysql1.php');
	}

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
