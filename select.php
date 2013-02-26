<?php

/////// retrieving contacts data ///////
$query = mysql_query("SELECT * FROM team_contacts");
if(!$query)
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>First Name</th><th>Phone</th>' .
	 '<th>E-mail</th><th>Gender</th><th>Birthday</th><th>Zip Code</th><th>Delete Record</th></tr>';
$rows = mysql_num_rows($query);
for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	echo <<<_END
	<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
	<td>$row[5]</td><td>$row[6]</td><td>$row[8]</td>
	<td>
		<form action="testphpmysql1.php" method="post">
			<input type="hidden" name="delete" value="yes" />
			<input type="hidden" name="contact_id" value="$row[0]" />
			<input type="submit" value="Delete Record!" />
		</form>
	</td>
	</tr>
_END;
}
echo '</table><br /><br />';

/////// retrieving contacts interests ///////
$query = mysql_query(
						  'SELECT tc.last_name, inter.interest FROM team_contacts AS tc ' . 
						  'INNER JOIN contact_interest AS ci ' . 
						  'ON tc.contact_id=ci.contact_id ' . 
						  'INNER JOIN interests AS inter ' . 
						  'ON inter.interest_id=ci.interest_id ' . 
						  'ORDER BY last_name'
					 );
if(!$query) 
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Interests</th></tr>';
$rows = mysql_num_rows($query);
for($j = 0; $j < $rows; $j++)
{
	$row = mysql_fetch_row($query);
	echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
}
echo '</table><br /><br />';

/////// retrieving contacts seeking
$query = mysql_query(
						  'SELECT tc.last_name, s.seeking FROM team_contacts AS tc ' . 
						  'INNER JOIN contact_seeking AS cs ' . 
						  'ON tc.contact_id=cs.contact_id ' . 
						  'INNER JOIN seeking AS s ' . 
						  'ON s.seeking_id=cs.seeking_id ' . 
						  'ORDER BY last_name'
					 );
if(!$query) 
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Seeking</th></tr>';
$rows = mysql_num_rows($query);
for($j = 0; $j < $rows; $j++)
{
	$row = mysql_fetch_row($query);
	echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
}
echo '</table><br /><br />';

// retrieving contacts status
$query = mysql_query(
					"SELECT tc.last_name, st.status FROM team_contacts " . 
					"AS tc INNER JOIN status AS st ON tc.status_id=st.status_id"
					);
if(!$query) 
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Status</th></tr>';
$rows = mysql_num_rows($query);
for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
}
echo '</table><br /><br />';

// retrieving contacts profession
$query = mysql_query(
					"SELECT tc.last_name, prof.profession FROM team_contacts AS tc " .
					"INNER JOIN profession AS prof ON tc.prof_id=prof.prof_id;"
					);
if(!$query) 
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Profession</th></tr>';
$rows = mysql_num_rows($query);
for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
}
echo '</table><br /><br />';

// retrieving contacts zip_code
$query = mysql_query(
					"SELECT tc.last_name, zc.zip_code, zc.city, zc.state FROM team_contacts " . 
					"AS tc INNER JOIN zip_code AS zc ON tc.zip_code=zc.zip_code"
					);
if(!$query) 
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>Zip Code</th><th>City</th><th>State</th></tr>';
$rows = mysql_num_rows($query);
for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
}
echo '</table><br /><br />';

?>
