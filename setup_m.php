
<?php
include('config.php');

	$strAuf = $cfg->get("blinds", "up_time");
	$strZu = $cfg->get("blinds", "down_time");
	$strAuto = $cfg->get("blinds","auto_time");
	$strTuer = $cfg->get("blinds","jal_2_open");
	$strWeather = $cfg->get("blinds","weather");
	$strWind = $cfg->get("blinds","wind_protection");
	$strRain = $cfg->get("blinds","open_on_rain");
	$strLuecke = $cfg->get("blinds","close_to_sun");
	$blinds = array('up_time'=>$strAuf, 'down_time'=>$strZu, 'auto_time'=>$strAuto, 'jal_2_open'=>$strTuer, 'weather'=>$strWeather, 'wind_protection'=>$strWind, 'open_on_rain'=>$strRain, 'close_to_sun'=>$strLuecke);
	
	$strV1Start = $cfg->get("irrigation", "ventil_1_start");
	$strV2Start = $cfg->get("irrigation", "ventil_2_start");
	$strV1Dauer = $cfg->get("irrigation", "ventil_1_duration");
	$strV2Dauer = $cfg->get("irrigation", "ventil_2_duration");
	$strV1Auto = $cfg->get("irrigation", "ventil_1_auto");
	$strV2Auto = $cfg->get("irrigation", "ventil_2_auto");
	$strV1Rain = $cfg->get("irrigation", "ventil_1_rain");
	$strV2Rain = $cfg->get("irrigation", "ventil_2_rain");
	$irrigation = array( 'ventil_1_start'=>$strV1Start, 'ventil_2_start'=>$strV2Start, 'ventil_1_duration'=>$strV1Dauer, 'ventil_2_duration'=>$strV2Dauer, 'ventil_1_auto'=>$strV1Auto, 'ventil_2_auto'=>$strV2Auto, 'ventil_1_rain'=>$strV1Rain, 'ventil_2_rain'=>$strV2Rain);
	
	$HWRthreshold = $cfg->get("hwr", "threshold");
	$HWRpermanent = $cfg->get("hwr", "permanent");
	$HWRauto = $cfg->get("hwr", "auto");	
	$AClow = $cfg->get("a/c", "low");
	$abluft = array( 'HWRthreshold'=>$HWRthreshold, 'HWRpermanent'=>$HWRpermanent, 'HWRauto'=>$HWRauto, 'AClow'=>$AClow);
	
	$display_wakeup = $cfg->get("hsgui", "display_wakeup");
	$hsgui = array( 'display_wakeup'=>$display_wakeup);
	
	$json = json_encode(array('blinds'=>$blinds, 'irrigation'=>$irrigation, 'abluft'=>$abluft, 'hsgui'=>$hsgui));
	echo($json);
?>