<?php
	include('class.iniparser.php');
    $platform = 'Unknown';
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    //Get the platform?
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	{
		$platform = 'windows';
	} elseif (preg_match('/Tasker/i', $u_agent)) {
		$platform = 'tasker'; //Tasker vom Android
	} else {
		$platform = 'linux';
	}

	//echo($platform);
	//echo($u_agent);
	//echo(getenv("SERVER_NAME"));
	
	//Pfad zum Arbeitsverzeichnis wo alle Config-Dateien stehen
	if($platform == 'windows')
	{
		$workPath = getcwd() . "/temp/";
	}else{
		if(getenv("SERVER_NAME") == 'localhost' or getenv("SERVER_NAME") == '192.168.178.22')
		{
			$workPath = "/home/florian/Entwicklung/haussteuerung/build/temp/";
		
		}else{
			$workPath = "/home/haussteuerung/";
		}
	}
	//Config-Dateien
	$configFile = "haussteuerung.conf";
	$hslightFile = "hslight.conf";
	
	if($platform == 'windows')
	{
		$cfg = new iniParser($workPath.$configFile);
	}else{
		//echo($conf_sem = fileinode($workPath.$configFile));
		$conf_sem = fileinode($workPath.$configFile);
		$conf_sem_ID = sem_get($conf_sem);
		
		sem_acquire($conf_sem_ID);
		$cfg = new iniParser($workPath.$configFile);
		sem_release($conf_sem_ID);
	}
	
	//Abfrage aus LAN(192.168.178.*) oder WAN
	if(isset($_SERVER["REMOTE_ADDR"]) ) {
        	$ip = $_SERVER["REMOTE_ADDR"];
        }
	else if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ) {
        	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
    	else if(isset($_SERVER["HTTP_CLIENT_IP"]) ) {
        	$ip = $_SERVER["HTTP_CLIENT_IP"];
    	}
    	else $ip = "10.0.0.1";
	
 	$ip_array = explode(".",$ip);
	$intern = ($ip_array[0] == 192) && ($ip_array[1] == 168) && ($ip_array[2] == 178);

?>
