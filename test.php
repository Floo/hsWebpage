<?php

include('panasonic_viera/RemoteControl.php');

$rc = new RemoteControl('192.168.178.149');

try {
    $volume = $rc->getVolume();
    $rc->setVolume($volume + 1);
} catch(Exception $e) {
    echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
}


?>