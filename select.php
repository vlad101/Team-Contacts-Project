<?php

/////// retrieving contacts data ///////
$query = mysql_query("SELECT * FROM team_contacts");
if(!$query)
	die("Unable to access database: " . mysql_error());

echo '<table border="1"><tr><th>Last Name</th><th>First Name</th><th>Phone</th>' .
	 '<th>E-mail</th><th>Update Record</th><th>Delete Record</th></tr>';
$rows = mysql_num_rows($query);
for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	echo <<<_END
	<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
	<td>
		<form action="update.php" method="post">
			<button type="submit" name="contact_id" value="$row[0]">Update Record!</button>
		</form>
	</td>
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

// retrieving all contact info
$query = mysql_query(
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
						INNER JOIN seeking AS s ON cs.seeking_id=s.seeking_id ORDER BY last_name;
						"
					);
if(!$query) 
	die("Unable to access database: " . mysql_error());

echo <<<_END
	<table border="1"><tr><th>Last Name</th><th>First name</th><th>Phone</th><th>E-mail</th>
	<th>Gender</th><th>Birthday</th><th>Profession</th><th>Status</th><th>Interests</th><th>Seeking</th>
	<th>Zip Code</th><th>City</th><th>State</th></tr>
_END;
$rows = mysql_num_rows($query);
for($i = 0; $i < $rows; $i++)
{
	$row = mysql_fetch_row($query);
	echo <<<_END
		<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
		<td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[11]</td><td>$row[12]</td>
		<td>$row[8]</td><td>$row[9]</td><td>$row[10]</td></tr>
_END;

}
echo '</table><br /><br />';

?>
