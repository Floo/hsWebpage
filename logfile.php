<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Methfesselstr. 9 - Logfile</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

</head>

<body>

<?php

include('config.php');
$logfile = "haussteuerung.log";

$hlf = @fopen($workPath.$logfile, "r");
if($hlf){
	echo "<p>";
	while(($buffer = fgets($hlf)) !== false) {
		echo $buffer;
		echo "<br>";
	}
	echo "</p>";
}else{
	echo "<p>Logfile nicht gefunden!</p>";
}
fclose($hlf);
?>

</body>
</html>