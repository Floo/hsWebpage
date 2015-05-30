<?php
	//Wetterdaten aus dem Shared-Memory-Segment abholen und ausgeben
	include('sharedMemoryRead.php');
	header('Content-Type: text/xml'); 
	echo $my_new_string;
?>
