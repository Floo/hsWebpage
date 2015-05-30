<?php
	include('config.php');
	
	//$tmp = $_POST['txtUpTime'];
	$cfg->set("floor_lightning", "off_time", str_replace("g", "+", $_POST['txtAuf']));
	$cfg->set("floor_lightning", "on_time", str_replace("g", "+", $_POST['txtZu']));
	$cfg->set("floor_lightning", "auto_time", $_POST['chkAuto']);
	
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
