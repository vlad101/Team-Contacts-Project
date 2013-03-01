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
		
	$query = mysql_query("SELECT * FROM users WHERE username='$username'");
	if(!$query)
		die("Unable to connect to database " . mysql_error());
	elseif(mysql_num_rows($query))
	{
		$row = mysql_fetch_row($query);
		
		$salt1 = "qm&h*";
		$salt2 = "pg!@";
		$token = sha1("$salt1$password$salt2");
	
		if($token == $row[4])
		{
			session_start();
			$_SESSION['username']   = $username;
			$_SESSION['password']   = $password;
			$_SESSION['last_name']  = $row[1];
			$_SESSION['first_name'] = $row[2];
			
			echo "Account for $row[1] $row[2]:<br /> Hi $row[1], you are now logged in as <b>$row[3]</b>";
			die('<p>Click <a href="testphpmysql1.php">here</a> to continue</p>');
		}
		else
			die('You entered wrong e-mail or password! <a href="index.php">Try Again!</a>');
	}
	else
		die('You entered wrong e-mail or password! <a href="index.php">Try Again!</a>');
}

echo <<<_END
<form action="index.php" method="post">
<pre>
      Username <input type="text"  name="username" />
      Password <input type="text"  name="password" />
               <input type="submit" value="Log In!">
</pre>
</form>
</body>
_END;

die("<p>Click here to <a href='register.php'>Sign-up!</a></p>");
echo '</html>';
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
