<?php
	include('config.php');
	
	$cfg->set("blinds", "up_time", str_replace("g", "+", $_POST['txtAuf']));
	$cfg->set("blinds", "down_time", str_replace("g", "+", $_POST['txtZu']));
	$cfg->set("blinds", "auto_time", $_POST['chkAuto']);
	$cfg->set("blinds", "jal_2_open", $_POST['chkTuer']);
	$cfg->set("blinds", "close_to_sun", $_POST['chkLuecke']);
	$cfg->set("blinds", "weather", $_POST['chkWeather']);
	$cfg->set("blinds", "wind_protection", $_POST['chkWind']);
	$cfg->set("blinds", "open_on_rain", $_POST['chkRain']);
	
	if($platform == 'windows')
	{
		$cfg->save();
	}
	else
	{
		sem_acquire($conf_sem_ID);
		$ret = $cfg->save();
		sem_release($conf_sem_ID);
	}
  	//echo "Daten gesichert.";
        header('Content-Type: text/xml');
        if($ret){
		echo "<?xml version=\"1.0\" ?><message>Daten gesichert.</message>";
	}else{
		echo "<?xml version=\"1.0\" ?><message>Einstellungen konnten nicht gesichert werden.</message>";
	}
?>
