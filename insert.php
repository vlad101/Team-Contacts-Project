<?php

/////// insert profession ///////

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

// if professiopn is not in the table, insert profession into the table
if(!$prof_found)
{
	$query = mysql_query("INSERT INTO profession VALUES(null, '$profession')");
	if(!$query)
		die("Unable to access database: " . mysql_error());

	$insertID_prof = mysql_insert_id();     // get an id of the inseted profession	
}

/////// insert zip code, city state ///////

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

/////// insert status ///////

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
	
/////// insert seeking ///////

$insertID_seeking = 0;
$seeking_found = FALSE;

$query = mysql_query('SELECT * FROM seeking');
if(!$query)
	die("Unable to access database: " . mysql_error());

// check if the seeking is in the table
$rows = mysql_num_rows($query);

for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);

	// if status is found
	if($row[1] == $seeking)
	{
		$insertID_seeking = $row[0];
		$seeking_found = TRUE;
	}
}

// if seeking is not in the table, insert seeking into the table
if(!$seeking_found)
{
	$query = mysql_query("INSERT INTO seeking VALUES(null, '$seeking')");
	if(!$query)
		die("Unable to access database: " . mysql_error());
	
	$insertID_seeking = mysql_insert_id();     // get an id of the inseted seeking
}

/////// insert interest ///////

$insertID_interest = 0;
$interest_found = FALSE;

$query = mysql_query('SELECT * FROM interests');
if(!$query)
	die("Unable to access database: " . mysql_error());

// check if the interest is in the table
$rows = mysql_num_rows($query);

for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	
	// if status is found
	if($row[1] == $interest)
	{
		$insertID_interest = $row[0];
		$interest_found = TRUE;
	}
}

// if status is not in the table, insert seeking into the table
if(!$interest_found)
{
	$query = mysql_query("INSERT INTO interests VALUES(null, '$interest')");
	if(!$query)
		die("Unable to access database: " . mysql_error());
	
	$insertID_interest = mysql_insert_id();     // get an id of the inseted seeking
}

/////// insert contacts info ///////
$query = mysql_query(
						"INSERT INTO team_contacts VALUES
						 (
							null, '$last_name', '$first_name', '$phone', '$email', '$gender', 
							'$birthday', '$insertID_prof', '$insertID_zip_code', '$insertID_status' 
						 )"
					);
if(!$query)
	die("Unable to access database: " . mysql_error());
$insertID_contact_id = mysql_insert_id();     // get an id of the inseted contact id

/////// insert contacts seeking info ///////
$query = mysql_query("INSERT INTO contact_seeking VALUES('$insertID_contact_id', '$insertID_seeking')");
if(!$query)
	die("Unable to access database: " . mysql_error());

/////// insert contacts interests info ///////
$query = mysql_query("INSERT INTO contact_interest VALUES('$insertID_contact_id', '$insertID_interest')");
if(!$query)
	die("Unable to access database: " . mysql_error());
	
?>
