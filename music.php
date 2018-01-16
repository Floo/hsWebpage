<?php
	require __DIR__ . '/panasonic_viera/RemoteControl.php';
	require __DIR__ . '/vendor/autoload.php';
	use Clue\QDataStream\Writer;

	$post = $_POST;
	$post = [
		"endpoint" => "tv",
		"cmd" => "set mute",
		//"repeat" => "2",
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
		$foo = socket_connect($tcpsock, $raspip, $raspport);
		//socket_write($tcpsock, $post['cmd'], strlen($post['cmd']));
		// ggf. mehrmals senden (z.B. f�r Lautst�rke)
		
		$writer = new Writer();
		$writer->writeQString($post['cmd']);

		$data = chr(0).chr(34).(string)$writer;

		$count = 1;
		if (isset($post['repeat']) && $post['repeat'] > 1) $count = $post['repeat'];
		for ($i = 0; $i < $count; $i++) {
			$foo1 = socket_write($tcpsock, $data, strlen($data));
		}
		
		//Antwort empfangen
		socket_set_option($tcpsock,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>2, "usec"=>0)); //Timeout setzen
		$ret = socket_read($tcpsock, 64000);
		echo $ret;
		socket_shutdown($tcpsock, 2);
		socket_close($tcpsock);
	} else {
		$rc = new RemoteControl('192.168.178.149');

		try {
			if (strpos ($post['cmd'], 'unmute') !== false) {
				$rc->setMute(false);
			} else if (strpos ($post['cmd'], 'mute') !== false) {
				$rc->setMute(true);
			} else if ((($volpos = strpos ($post['cmd'], 'vol+')) !== false) || (($volpos = strpos ($post['cmd'], 'vol-')) !== false)) {
				$deltaVolume = substr($post['cmd'], $volpos + 3);
				$volume = $rc->getVolume();
				$newVolume = $volume + $deltaVolume;
				if ($newVolume > 30) $newVolume = 30;
				if ($newVolume < 0) $newVolume = 0;
				$rc->setVolume($newVolume);				
			} else if (($volpos = strpos ($post['cmd'], 'vol')) !== false) {
				$newVolume = substr($post['cmd'], $volpos + 3);
				if ($newVolume <= 30) {
					$rc->setVolume($newVolume);
				}
			} else if (strpos ($post['cmd'], 'standby') !== false) {
				$rc->sendKey(POWER);
			} else if ((($chanpos = strpos ($post['cmd'], 'channel+')) !== false) || (($chanpos = strpos ($post['cmd'], 'channel-')) !== false)) {
				$deltaChan = substr($post['cmd'], $chanpos + 7);
				if ($deltaChan > 0) {
					$key = CHANNEL_UP;
				} else {
					$key = CHANNEL_DOWN;
				}
				if (abs($deltaChan) > 20) $deltaChan = 20;
				for ($i = 0; $i < abs($deltaChan); $i++) {
					$rc->sendKey($key);
				}
			} else if (($chanpos = strpos ($post['cmd'], 'channel')) !== false) {
				$newChan = substr($post['cmd'], $chanpos + 7);
				if ($newChan > 99) {
					$key = constant("NUM_".intval($newChan / 100));
					$rc->sendKey($key);
					$newChan = $newChan % 100;
					if ($newChan < 10) $rc->sendKey("NUM_0");
				} else if ($newChan > 9) {
					$key = constant("NUM_".intval($newChan / 10));
					$rc->sendKey($key);
					$newChan = $newChan % 10;
				}
				$key = constant("NUM_".$newChan);
				$rc->sendKey($key);
			}
		} catch(Exception $e) {
			echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
		}
	
	}
?>