<?php
	$f = $c = '';

	if(isset($_POST['f']))
		$f = sanitizeString($_POST['f']);
		
	if(isset($_POST['c']))
		$c = sanitizeString($_POST['c']);
		
	if($f != '' && $c == '')
		$output = "$f Degress Fahrehneit is " . (($f - 32) * 5/9) . " Degrees Celcius";
	else if($c != '' && $f == '')
		$output = "$c Degress CeLcius is " . ($c * 9/5 + 32) . " Degrees Fahrenheit";
	else
		$output = '';
	
	echo <<<_END
	<html>
		<head>
			<title>Temperature Converter</title>
		</head>
		<body>
			<p>Enter either Fehrenheit or Celcius and click on convert</p>
			<b>$output</b>
			<form action="testConverter.php" method="post">
				<pre>
					Fahrenheit <input type="text" name="f" size="7" /> 
					   Celcius <input type="text" name="c" size="7"  />
					   		   <input type="submit" value="Convert!">
				</pre>
			</form>
		</body>
	</html>
_END;
	// Sanitize String
	function sanitizeString($var)
	{
		if(get_magic_quotes_gpc())
			$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}
?>
