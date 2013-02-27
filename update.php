<?php

require 'login.php';

$contact_id = sanitizeMysql($_POST['contact_id']);

echo '<html><head><title>Update Form</title></head><body>';

$query=mysql_query(
					"
						SELECT tc.last_name, tc.first_name, tc.phone, tc.email, tc.gender, tc.birthday, 
						prof.profession, st.status, zc.zip_code, zc.city, zc.state, inter.interest, s.seeking 
						FROM team_contacts AS tc 
						INNER JOIN profession AS prof ON tc.prof_id=prof.prof_id 
						INNER JOIN zip_code AS zc ON tc.zip_code=zc.zip_code 
						INNER JOIN status AS st ON tc.status_id=st.status_id 
						INNER JOIN contact_interest AS ci ON tc.contact_id=ci.contact_id 
						INNER JOIN interests AS inter ON ci.interest_id=inter.interest_id 
						INNER JOIN contact_seeking AS cs ON tc.contact_id=cs.contact_id 
						INNER JOIN seeking AS s ON cs.seeking_id=s.seeking_id 
						WHERE tc.contact_id='$contact_id'
					"
				  );
if(!$query)
	die("Unable to access database: " . mysql_error());
         
$row = mysql_fetch_row($query);

echo <<<_END
	<form action="update.php" method="post">
<pre>
          Last Name  <input type="text"   name="last_name"    value="$row[0]" />
         First Name  <input type="text"   name="first_name"   value="$row[1]" />
              Phone  <input type="text"   name="phone"        value="$row[2]" />
             E-mail  <input type="text"   name="email"        value="$row[3]" />
             Gender  <input type="text"   name="gender"       value="$row[4]" />
           Birthday  <input type="text"   name="birthday"     value="$row[5]" />
         Profession  <input type="text"   name="profession"   value="$row[6]" />
            Seeking  <input type="text"   name="seeking"      value="$row[12]" />
          Interests  <input type="text"   name="interest"     value="$row[11]" />
             Status  <input type="text"   name="status"       value="$row[7]" />
           Zip Code  <input type="text"   name="zip_code"     value="$row[8]" />
               City  <input type="text"   name="city"         value="$row[9]" />
              State  <input type="text"   name="state"        value="$row[10]" />
         			 <input type="hidden" name="contact_id"   value="$contact_id" />
         			 <input type="submit" value="Update!" />
</pre>
	</form>
_END;

if(
	isset($_POST['last_name'])    &&   isset($_POST['first_name'])    &&
	isset($_POST['phone'])        &&   isset($_POST['email'])         && 
	isset($_POST['gender'])       &&   isset($_POST['birthday'])      &&
	isset($_POST['profession'])   &&   isset($_POST['seeking'])       && 
	isset($_POST['interest'])     &&   isset($_POST['status'])        && 
	isset($_POST['zip_code'])     &&   isset($_POST['city'])          &&  
	isset($_POST['state'])        &&   isset($_POST['contact_id'])
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
	
	/////// update profession ///////

	$insertID_prof = 0;
	$prof_found = FALSE;

	$query = mysql_query('SELECT * FROM profession');
	if(!$query)
		die("Unable to access database: " . mysql_error());

	// check if the profession is in the table
	$rows = mysql_num_rows($query);

	for($i = 0; $i < $rows; $i++)
	{
		$row = mysql_fetch_row($query);
	
		// if profession is found
		if($row[1] == $profession)
		{
			$insertID_prof = $row[0];
			$prof_found = TRUE;
		}
	}

	// if profession is not in the table, insert profession into the table
	if(!$prof_found)
	{
		$query = mysql_query("INSERT INTO profession VALUES(null, '$profession')");
		if(!$query)
			die("Unable to access database: " . mysql_error());

		$insertID_prof = mysql_insert_id();     // get an id of the inseted profession	
	}
	
	/////// update zip code, city state ///////

	$insertID_zip_code = 0;
	$zip_code_found = FALSE;

	$query = mysql_query('SELECT * FROM zip_code');
	if(!$query)
		die("Unable to access database: " . mysql_error());

	// check if the status is in the table
	$rows = mysql_num_rows($query);

	for($i = 0; $i < $rows; $i++)
	{
		$row = mysql_fetch_row($query);

		// if zip code is found
		if($row[0] == $zip_code)
		{
			$insertID_zip_code = $row[0];
			$zip_code_found = TRUE;
		}
	}

	// if status is not in the table, insert zip code into the table
	if(!$zip_code_found)
	{
		$query = mysql_query("INSERT INTO zip_code VALUES('$zip_code', '$city', '$state')");
		if(!$query)
			die("Unable to access database: " . mysql_error());
	
		$insertID_zip_code = mysql_insert_id();     // get an id of the inseted zip code
	}

	/////// update status ///////

	$insertID_status = 0;
	$status_found = FALSE;

	$query = mysql_query('SELECT * FROM status');
	if(!$query)
		die("Unable to access database: " . mysql_error());

	// check if the profession is in the table
	$rows = mysql_num_rows($query);

	for($i = 0; $i < $rows; $i++)
	{
		$row = mysql_fetch_row($query);

		// if profession is found
		if($row[1] == $status)
		{
			$insertID_status = $row[0];
			$status_found = TRUE;
		}
	}

	// if professiopn is not in the table, insert profession into the table
	if(!$status_found)
	{
		$query = mysql_query("INSERT INTO status VALUES(null, '$status')");
		if(!$query)
			die("Unable to access database: " . mysql_error());
	
		$insertID_status = mysql_insert_id();     // get an id of the inseted profession	
	}
	
	
	
	// update contact info
	$query = mysql_query(
						   "
						   	UPDATE team_contacts 
							SET 
							last_name   =  '$last_name', 
							first_name  =  '$first_name',
							phone       =  '$phone',
							email       =  '$email',
							gender      =  '$gender',
							birthday    =  '$birthday',
							prof_id     =  '$insertID_prof',
							status_id   =  '$insertID_status',
							zip_code    =  '$insertID_zip_code'				
							WHERE contact_id='$contact_id'
						   "
						);
	if(!$query)
		die("Unable to access database: " . mysql_error());
	
	header('Location: testphpmysql1.php');
}

// go back to home page
echo '<br /><br /><a href="testphpmysql1.php">Home Page</a>';
echo '</body></html>';

/*

	/////// update contacts seeking info ///////
	$query = mysql_query(
						"
						UPDATE contact_seeking 
						SET seeking_id='$insertID_seeking'
						where contact_id = '$contact_id'
						"
						);
	if(!$query)
		die("Unable to access database: " . mysql_error());

	/////// insert contacts interests info ///////
	$query = mysql_query(
						"
						UPDATE contact_interest 
						SET interest_id='$insertID_interest'
						where contact_id = '$contact_id'
						"
						);
	if(!$query)
		die("Unable to access database: " . mysql_error());

}

*/

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
