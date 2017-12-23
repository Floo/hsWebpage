<?php
	$post = $_POST;
	$post = [
		"endpoint" => "pm8000",
		"cmd" => "set pm8000 mute",
		"repeat" => "",
	];

	if ($post['endpoint'] != 'tv') {
		if (!isset($_SESSION['raspip']) || !isset($_SESSION['raspport'])) {
			// �ber UDP-Broadcast die IP und den Port des RaspiDAC ermitteln
			// TODO: Port und IP des RaspiDAC �ber Session-Variable merken
			$ip = "255.255.255.255";
			$sendport = 8002;
			$recvport = 8001;
			$str = "[RendererBitteMelden!]";

			$udpsock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); 
			socket_set_option($udpsock, SOL_SOCKET, SO_BROADCAST, 1);
			socket_set_option($udpsock, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>5, "usec"=>0));
			socket_bind($udpsock, "0.0.0.0", $recvport);
			socket_sendto($udpsock, $str, strlen($str), 0, $ip, $sendport);

			while(true) {
				$ret = @socket_recvfrom($udpsock, $buf, 1024, MSG_WAITALL, $raspip, $senderport);
				if ($ret === false) break;
				if (strpos($buf, '[RaspiDAC]') !== false) {
					$buf = str_replace('[RaspiDAC]', '', $buf);
					$strlist = explode(';', $buf);
					$raspport = $strlist[5];
					$_SESSION['raspport'] = $raspport;
					$_SESSION['raspip'] = $raspip;
					break;
				}
				echo "Messagge : < $buf > , $ip : $port <br>";
			}
			socket_close($udpsock);
		}
		
		if (!isset($raspport)) {
			echo "ERROR";
			return;
		} 
		//Kommando senden
		$tcpsock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_connect($tcpsock, $raspip, $raspport);
		socket_write($tcpsock, $post['cmd'], strlen($post['cmd']));
		// ggf. mehrmals senden (z.B. f�r Lautst�rke)
		$count = 1;
		if ($post['repeat'] > 1) $count = $post['repeat'];
		for ($i = 0; $i < $count; $i++) {
			socket_write($tcpsock, $post['cmd'], strlen($post['cmd']));
		}
		
		//Antwort empfangen
		socket_set_option($tcpsock,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>2, "usec"=>0)); //Timeout setzen
		$ret = socket_read($tcpsock, 64000);
		echo $ret;
		socket_shutdown($tcpsock, 2);
		socket_close($tcpsock);
	}
?>