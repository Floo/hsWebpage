<?php
	include('config.php');
	//$tmp = $_POST['chkHWRpermanent'];
	$cfg->set("hwr", "threshold", $_POST['txtTemp']);
	$cfg->set("hwr", "permanent", $_POST['chkHWRpermanent']);
	$cfg->set("hwr", "auto", $_POST['chkHWRauto']);	
	$cfg->set("a/c", "low", $_POST['chkAClow']);
	
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
        header('Content-Type: text/xml');
        if($ret){
		//Nachricht ans Programm senden, dass Einstellungen geändert wurden -> sofortige Wirkung sicherstellen
		$MSGKEY = $cfg->get("system", "msg_key");
		$MSGTYP_JAL = 1;
		$MSGTYP_CMD = 2;
		$MSGTYP_FLOOR = 3;
		$MSGTYP_ABLUFT = 4;
		$MSGTYP_HWR = 5;
		$MSGTYP_LICHT = 6;
		$MSGTYP_SZENE = 7;
		//hier muss noch sichergestellt werden, dass keine neue Message-Queue aufgemacht wird
		//Ergänzung: ist nicht notwendig, wenn kein Programm läuft, schreibt er halt ins Leere
		$msg_id = msg_get_queue($MSGKEY, 0600);
		$foo = "value=UPDATE";
		msg_send($msg_id, $MSGTYP_ABLUFT, $foo, TRUE, TRUE, $msg_err);
		msg_send($msg_id, $MSGTYP_HWR, $foo, TRUE, TRUE, $msg_err);
		echo "<?xml version=\"1.0\" ?><message>Daten gesichert und Einstellungen übernommen.</message>";
	}else{
		echo "<?xml version=\"1.0\" ?><message>Einstellungen konnten nicht gesichert werden.</message>";
	}
?>
