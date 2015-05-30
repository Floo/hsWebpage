<?php
	include('config.php');
	//$tmp = $_POST['chkHWRpermanent'];
	$cfg->set("irrigation", "ventil_1_start", $_POST['txtV1Start']);
	$cfg->set("irrigation", "ventil_2_start", $_POST['txtV2Start']);
	$cfg->set("irrigation", "ventil_1_duration", $_POST['txtV1Dauer']);
	$cfg->set("irrigation", "ventil_2_duration", $_POST['txtV2Dauer']);
	$cfg->set("irrigation", "ventil_1_auto", $_POST['chkV1Auto']);
	$cfg->set("irrigation", "ventil_2_auto", $_POST['chkV2Auto']);
	$cfg->set("irrigation", "ventil_1_rain", $_POST['chkV1Rain']);
	$cfg->set("irrigation", "ventil_2_rain", $_POST['chkV2Rain']);
	
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
