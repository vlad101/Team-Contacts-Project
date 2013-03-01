<?php

session_start();

if(isset($_SESSION['username']))
{
	destroy_session_and_data();
	header('Location: index.php');
}
else
	echo 'You are not <a href="index.php">logged in</a>!';

function destroy_session_and_data()
{
	$_SESSION = array();
	
	if(session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 25920000, '/');
	session_destroy();
}


?>
