<?php 

require_once 'login.php';

echo <<<_END
<html><head><title>Log-In Page</title></head><body>
<h1>Log-In</h1>
_END;

if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = sanitizeMySQL($_POST['username']);
	$password = sanitizeMySQL($_POST['password']);
		
	$query = $mysql_query("SELECT * FROM users WHERE username='$username'");
	if(!$query)
		die("Unable to connect to database " . mysql_error());
	
	if(mysql_num_rows($query))
	{
		header('Location: google.com');
		$row = mysql_fetch_row($query);
		
		$salt1 = "qm&h*";
		$salt2 = "pg!@";
		$token = sha1("$salt1$password$salt2");
	
		if($token == $row[4])
			header('Location: testphpmysql1.php');
		else
			echo 'You entered wrong e-mail or password! <a href="log_in.php">Try Again!</a>';
	}
}

echo <<<_END
<form action="log_in.php" method="post">
<pre>
      Username <input type="text"  name="username" />
      Password <input type="text"  name="password" />
               <input type="submit" value="Log In!">
</pre>
</form>

</body></html>
_END;

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
