<?php
	include('config.php');
	
	$cfg->set("hsgui", "display_wakeup", str_replace("g", "+", $_POST['txtStartGUI']));
	
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