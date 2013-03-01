<?php

require_once 'login.php';

session_start();

if(isset($_SESSION['username']))
{	

	$username   = $_SESSION['username'];
	$password   = $_SESSION['password'];
	$last_name  = $_SESSION['last_name'];
	$first_name = $_SESSION['first_name'];
	
	echo <<<_END

	<html>
		<head>
			<title>PHP-MySQL Form</title>
		</head>
		<body>
			<p>Hello $last_name $first_name! <br />Your user name is $username and your password is $password</p>
_END;

	if(
		isset($_POST['last_name'])  && isset($_POST['first_name']) &&
		isset($_POST['phone'])      && isset($_POST['email'])      && 
		isset($_POST['gender'])     && isset($_POST['birthday'])   && 
		isset($_POST['profession']) && isset($_POST['seeking'])    && 
		isset($_POST['interest'])   && isset($_POST['status'])     && 
		isset($_POST['zip_code'])   && isset($_POST['city'])       && 
		isset($_POST['state'])
	  )
	{
		$last_name = sanitizeMySQL($_POST['last_name']);  
		$first_name = sanitizeMySQL($_POST['first_name']);
		$phone = sanitizeMySQL($_POST['phone']); 
		$email = sanitizeMySQL($_POST['email']);
		$gender = sanitizeMySQL($_POST['gender']);
		$birthday = sanitizeMySQL($_POST['birthday']); 
		$profession = sanitizeMySQL($_POST['profession']);
		$seeking = sanitizeMySQL($_POST['seeking']); 
		$interest = sanitizeMySQL($_POST['interest']);
		$status = sanitizeMySQL($_POST['status']); 
		$zip_code = sanitizeMySQL($_POST['zip_code']);
		$city = sanitizeMySQL($_POST['city']);
		$state = sanitizeMySQL($_POST['state']);
	
		require_once 'insert.php';
	}

	// used in select.php team_contacts table
	if(isset($_POST['delete']) && isset($_POST['contact_id']))
	{
		$contact_id = sanitizeMySQL($_POST['contact_id']);
		$query = mysql_query("DELETE FROM team_contacts WHERE contact_id='$contact_id'");
		if(!$query)
			die("Unable to access database: " . mysql_error());
	}

	echo <<<_END
	<p>Click here to <a href="logout.php">logout</a></p>
		<form action="testphpmysql1.php" method="post">
	<pre>
		     Last Name  <input type="text" name="last_name" value="Smith" />
		    First Name  <input type="text" name="first_name" value="John" />
		         Phone  <input type="text" name="phone" value="(123) 456-7891" />
		        E-mail  <input type="text" name="email" value="email@mail.com" />
		        Gender  <input type="text" name="gender" value="F" />
		      Birthday  <input type="text" name="birthday" value="1999-07-21" />
		    Profession  <input type="text" name="profession" value="Manager" />
		       Seeking  <input type="text" name="seeking" value="Relationship" />
		     Interests  <input type="text" name="interest" value="Dancing" />
		        Status  <input type="text" name="status" value="Single" />
		      Zip Code  <input type="text" name="zip_code" value="12345" />
		          City  <input type="text" name="city" value="Brooklyn" />
		         State  <input type="text" name="state" value="NY" />
		                <input type="submit" value="Submit!" />
	</pre>
		</form><br />
_END;

	require_once 'select.php';

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
}
else
	echo '<p>Please <a href="index.php">login</a> or <a href="register.php">sign up</a>!</p>';

?>

