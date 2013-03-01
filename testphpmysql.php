<?php
	
	// Login info
	require_once 'login.php';
	
	// Connect to database
	$db_server = mysql_connect($db_localhost, $db_username, $db_password);
	if(!$db_server)
		die("Unable to connect to MySQL: " . mysql_error());
	
	// Select database
	mysql_select_db($db_database)
		or die("Unable to select Database: " . mysql_error());
	
	// Delete data from the table
	if(isset($_POST['delete']) && isset($_POST['book_id']))
	{
		$book_id = sanitizeMySQL($_POST['book_id']);
		$result = mysql_query("DELETE FROM books WHERE book_id = '$book_id'");
		if(!result)
			die("Unable to delete from the database: " . mysql_error());
	}
	
	// Insert data into the table
	if(isset($_POST['author']) && isset($_POST['title']) && isset($_POST['type']) && isset($_POST['year']))
	{
		$author = sanitizeMySQL($_POST['author']);
		$title = sanitizeMySQL($_POST['title']);
		$type = sanitizeMySQL($_POST['type']);
		$year = sanitizeMySQL($_POST['year']);
		
		$result = mysql_query("INSERT INTO books VALUES(null, '$author', '$title', '$type', '$year')");
		if(!result)
			die("Unable to insert into the into the table" . mysql_error());
	}	
	
	// Sanitize String
	function sanitizeString($var)
	{
		if(get_magic_quotes_gpc())
			$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}
	
	// Sanitizer MySQL
	function sanitizeMySQL($var)
	{
		$var = mysql_real_escape_string($var);
		$var = sanitizeString($var);
		return $var;
	}
	
	// form for the insert into database
echo <<< _END

		<form action="testphpmysql.php" method="post"><pre>
			Author  <input type="text" name = "author"/>
			 Title  <input type="text" name="title">
			  Type  <input type="text" name="type"> 
			  Year  <input type="text" name="year">
			  		<input type="submit" value="Add Record">
		</pre></form>
_END;
		
	// Retrieve data from mysql
	$result = mysql_query("SELECT * FROM books");
	if(!$result)
		die("Database access failed: " . mysql_error());
	$rows = mysql_num_rows($result);
	
	// Display all results with the delete 
	echo '<table border="1"><tr><th>Book ID</th><th>Author</th><th>Book Title</th><th>Type</th><th>Year</th><th>Action</th></tr>';
	for($i = 0; $i < $rows; $i++)
	{
		$row = mysql_fetch_row($result);
		
		echo <<<_END
		<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
		<td><form action="testphpmysql.php" method="post">
		<input type="hidden" name="delete" value="yes" />
		<input type="hidden" name="book_id" value="$row[0]" />
		<input type="submit" value="Delete Record" /></form></td></tr>
_END;
	}
	echo '</table>';
	
	// Close database
	mysql_close($db_server);
?>
