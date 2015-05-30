<?php
	//hier wird eine Message ans Programm geschickt, um die Jalousien zu bewegen, Licht oder Orientierungslicht
	//zu schalten oder Lichtszene zu aktivieren
	include('config.php');
	
	$SOCK_PORT = $cfg->get("hsgui", "port_gui_tcp");
	$MSGTYP_JAL = 1;
	$MSGTYP_CMD = 2;
	$MSGTYP_FLOOR = 3;
	$MSGTYP_ABLUFT = 4;
	$MSGTYP_HWR = 5;
	$MSGTYP_LICHT = 6;
	$MSGTYP_SZENE = 7;
	$MSGTYP_WETT = 8;
	$MSGTYP_HELL = 9;
	$MSGTYP_HSINFO = 10;
	$MSGTYP_GET_CONFIG = 11;
	$MSGTYP_SEND_HSINFO = 12;
	$MSGTYP_SET_CONFIG = 13; //einen Wert in die haussteuerung.conf schreiben
	$MSGTYP_DIMM = 14; //Dimm-Befehl fuer eine Lampe Format: value=essen:DIMM_UP_START
	$MSGTYP_LICHT_RESET_TIMER = 15; //loescht alle Timer im Dimmer
	$MSGTYP_E6_INIT = 16; //E6-Device muss neu initialisiert werden
	$MSGTYP_WATER = 17; //value=VENTIL_1_START; value=VENTIL_2_STOP; value=VENTIL_1_TIMER; value=VENTIL_2_TIMER:10 (Dauer in min)
	$MSGTYP_STECKDOSE_TERRASSE = 18; //Schaltbefehl fuer Steckdose Terrasse: value=AN; value=AUS
	
	$DIMM_UP_START = 1;
	$DIMM_UP_STOP = 2;
	$DIMM_DOWN_START = 3;
	$DIMM_DOWN_STOP = 4;

	$CONFIG_HS = 1;
	$CONFIG_LIGHT = 2;
	$LOGFILE = 3;
	$LOGFILE_INVERS = 4;

	//echo($_POST[txtSzene]);
	//echo($SOCK_PORT);

	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_connect($socket, '127.0.0.1', $SOCK_PORT);
	$foo = "chr(0)";
	$read = FALSE; //wenn vom Socket eine Antwort gelesen werden soll
	switch($_POST['device']){
	case "JAL":
		$foo = "cmd=".$MSGTYP_JAL." value=".$_POST['txtButtonName'].chr(0); //chr(0) liefert das String-Endzeichen fuer C/C++
		break;
	case "VENTIL":
		$foo = "cmd=".$MSGTYP_WATER." value=".$_POST['txtButtonName'].chr(0); //chr(0) liefert das String-Endzeichen fuer C/C++
		break;
	case "ORIENT":
		$foo = "cmd=".$MSGTYP_FLOOR." value=".$_POST['txtWert'].chr(0);
		break;
	case "LICHT":
		$foo = "cmd=".$MSGTYP_LICHT." value=".$_POST['txtLampe'].":".$_POST['txtWert'].chr(0);
		break;
	case "SZENE":
		$foo = "cmd=".$MSGTYP_SZENE." value=".$_POST['txtSzene'].chr(0);	
		break;
	case "DIMM":
		$foo = "cmd=".$MSGTYP_DIMM." value=".$_POST['txtLampe'].":".$_POST['txtWert'].chr(0);
		break;
	case "LOGFILE_INVERS":
		$foo = "cmd=".$MSGTYP_GET_CONFIG." value=".$LOGFILE_INVERS.chr(0); //chr(0) liefert das String-Endzeichen fuer C/C++
		$read = TRUE;
		break;
	}
	socket_write($socket, $foo, strlen($foo));
	
	if($read == TRUE){
		socket_set_option($socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>2, "usec"=>0)); //Timeout setzen
		$ret = socket_read($socket, 64000);
		echo $ret;
	}
	
	socket_shutdown($socket, 2);
	socket_close($socket);
?>
