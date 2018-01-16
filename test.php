<?php

include('panasonic_viera/RemoteControl.php');

$rc = new RemoteControl('192.168.178.149');

try {
    // $volume = $rc->getVolume();
    // $rc->setVolume($volume + 1);
    // $rc->setMute(false);
    // $mute = $rc->getMute();
    // echo $mute;
    // $key = NUM_1;
    // $rc->sendKey($key);
    $key = NUM_3;
    $rc->sendKey($key);
} catch(Exception $e) {
    echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
}


?>