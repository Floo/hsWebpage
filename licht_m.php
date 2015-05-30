
<?php
include('config.php');

	$cfg_li = new iniParser($workPath.$hslightFile);

	$FS20_AUS = 0;
	$FS20_AN = 17;
	$FS20_DIMM_UP = 19;
	$FS20_DIMM_DOWN = 20;
	$DIMM_UP_START = 1;
	$DIMM_UP_STOP = 2;
	$DIMM_DOWN_START = 3;
	$DIMM_DOWN_STOP = 4;

	switch ($_GET["id"]) {
		case "licht":
			$strDevices = $cfg_li->get("system","devices");
			$Devices = explode(",", $strDevices);

			array_walk($Devices, create_function('&$val', '$val = trim($val);'));
			$sendString = "{\"name\":\"Licht\",\"items\":[";
			foreach($Devices as $Device){
				$DeviceName = $cfg_li->get("deviceName",$Device);
				$sendString = $sendString."{\"id\":\"".$Device."\",\"name\":\"".$DeviceName."\"},";
			}
			$sendString = rtrim($sendString, ",");
			$sendString = $sendString."]}";
			echo($sendString);
			break;
		case "szene":
			$strSzenen = $cfg_li->get("system","scenes");
			$Szenen = explode(",", $strSzenen);
			array_walk($Szenen, create_function('&$val', '$val = trim($val);'));
			$sendString = "{\"name\":\"Lichtszenen\",\"items\":[";
			foreach($Szenen as $Szene){
				$sendString = $sendString."{\"name\":\"".$Szene."\"},";
			}
			$sendString = rtrim($sendString, ",");
			$sendString = $sendString."]}";
			echo($sendString);
			break;
	}
?>

