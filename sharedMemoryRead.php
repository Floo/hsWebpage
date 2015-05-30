<?php
	//Shared Memory auslesen und Inhalt als $my_new_string zurückgeben
	include('config.php');
	
	$MEMKEY = $cfg->get("system", "mem_key");
	$mem_sem = $cfg->get("system", "mem_sem");
	
	$mem_sem_ID = sem_get($mem_sem);
	
	sem_acquire($mem_sem_ID);
	
	// Uebernehme den gemeinsamen Speicherblock
	$shm_id = shmop_open($MEMKEY, "w", 0666, 200);
	if (!$shm_id) {
	   exit();
	}
	// Hole die Groesse des gemeinsamen Speicherblocks
	$shm_size = shmop_size($shm_id);
	// Den String auslesen
	$my_string = shmop_read($shm_id, 0, $shm_size);
	if (!$my_string) {
	   exit();
	}
	$ende = strripos($my_string, "</hsinfo>");
	$my_new_string = substr($my_string, 0, $ende + 9);
	
	shmop_close($shm_id);
	
	sem_release($mem_sem_ID);
?>
