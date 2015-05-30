<html>

<?php

//include('config.php'); //ist in sharedMemoryRead.php mit eingeschlossen
include('sharedMemoryRead.php'); 

//print_r($cfg);

$strV1Start = "\"".$cfg->get("irrigation", "ventil_1_start")."\"";
$strV2Start = "\"".$cfg->get("irrigation", "ventil_2_start")."\"";
$strV1Dauer = "\"".$cfg->get("irrigation", "ventil_1_duration")."\"";
$strV2Dauer = "\"".$cfg->get("irrigation", "ventil_2_duration")."\"";
$strV1Auto = $cfg->get("irrigation", "ventil_1_auto");
$strV2Auto = $cfg->get("irrigation", "ventil_2_auto");
$strV1Rain = $cfg->get("irrigation", "ventil_1_rain");
$strV2Rain = $cfg->get("irrigation", "ventil_2_rain");

//Voreinstellung für Oeffnen-Button erzeugen
$anfang = strripos($my_string, "<Ventil_1>");
$ende = strripos($my_string, "</Ventil_1>");
$schaltVentil1 = substr($my_string, $anfang + 10, $ende - $anfang - 10);
if($schaltVentil1 == "Aus"){
	$strVentil_1 = "&Ouml;ffnen";
}else{
	$strVentil_1 = "Schlie&szlig;en";
}
$anfang = strripos($my_string, "<Ventil_2>");
$ende = strripos($my_string, "</Ventil_2>");
$schaltVentil2 = substr($my_string, $anfang + 10, $ende - $anfang - 10);
if($schaltVentil2 == "Aus"){
	$strVentil_2 = "&Ouml;ffnen";
}else{
	$strVentil_2 = "Schlie&szlig;en";
}

?>

<form name="frmOldValue">
	<input type="hidden" name="old_txtV1Start" value=<?php echo $strV1Start ?> />
	<input type="hidden" name="old_txtV2Start" value=<?php echo $strV2Start ?> />
	<input type="hidden" name="old_txtV1Dauer" value=<?php echo $strV1Dauer ?> />
	<input type="hidden" name="old_txtV2Dauer" value=<?php echo $strV2Dauer ?> />
	<input type="hidden" name="old_chkV1Auto" value=<?php echo $strV1Auto ?> />
	<input type="hidden" name="old_chkV2Auto" value=<?php echo $strV2Auto ?> />
	<input type="hidden" name="old_chkV1Rain" value=<?php echo $strV1Rain ?> />
	<input type="hidden" name="old_chkV2Rain" value=<?php echo $strV2Rain ?> />
</form>


<form name="frmNewValue">
	<input type="hidden" name="new_txtV1Start" value="" />
	<input type="hidden" name="new_txtV2Start" value="" />
	<input type="hidden" name="new_txtV1Dauer" value="" />
	<input type="hidden" name="new_txtV2Dauer" value="" />
	<input type="hidden" name="new_chkV1Auto" value="" />
	<input type="hidden" name="new_chkV2Auto" value="" />
	<input type="hidden" name="new_chkV1Rain" value="" />
	<input type="hidden" name="new_chkV2Rain" value="" />
</form>


<form name="frmWorkspaceName">
	<input type="hidden" name="inputWorkspaceName" value="TERRASSE" />
</form>

<!-- Beete -->
<table border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr height="70"></tr>
	<tr valign="top">
		<td width="140"></td>
		<td height="30" colspan="2"><div class="beschr_1"><i>Beete</i></div>
		<div class="beschr_3" id="sysV1">Geschlossen</div></td>
		<td></td>
	</tr>
	<tr height="5"></tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input class="button_1" name="Toggle_Ventil_1" type="button" onclick="toggleVentil(this);" value="<?php echo $strVentil_1 ?>"></td>
		<td align="left" width="150"><input class="button_1" name="VENTIL_1_TIMER" type="button" onclick="startVentil(this);" value="Start Timer" ></td>
		<td align="left" width="150">Dauer:<input style="text-align:center" class="eingabe" maxlength="2"	name="txtV1Timer" size="3" value="10">min</td>
	</tr>
	<tr height="15"></tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input name="chkV1Auto" type="checkbox">Automatik</td>
		<td align="left" width="150">Startzeit:<input style="text-align:center" class="eingabe" maxlength="5"	name="txtV1Start" size="3"></td>
		<td align="left" width="150">Dauer:<input style="text-align:center" class="eingabe" maxlength="2"	name="txtV1Dauer" size="3">min</td>
		<td></td>
	</tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input name="chkV1Rain" type="checkbox">regenabh&auml;ngig</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table> 

<!-- Kuebel -->
<table border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr height="40"></tr>
	<tr valign="top">
		<td width="140"></td>
		<td height="30" colspan="2"><div class="beschr_1"><i>K&uuml;bel</i></div>
		<div class="beschr_3" id="sysV2">Geschlossen</div></td>
		<td></td>
	</tr>
	<tr height="5"></tr>
	<tr valign="top" >
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input class="button_1" name="Toggle_Ventil_2" type="button" onclick="toggleVentil(this);" value="<?php echo $strVentil_2 ?>"></td>
		<td align="left" width="150"><input class="button_1" name="VENTIL_2_TIMER" type="button" onclick="startVentil(this);" value="Start Timer" ></td>
		<td align="left" width="150">Dauer:<input style="text-align:center" class="eingabe" maxlength="2"	name="txtV2Timer" size="3" value="10">min</td>
	</tr>
	<tr height="15"></tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input name="chkV2Auto" type="checkbox">Automatik</td>
		<td align="left" width="150">Startzeit:<input style="text-align:center" class="eingabe" maxlength="5"	name="txtV2Start" size="3"></td>
		<td align="left" width="150">Dauer:<input style="text-align:center" class="eingabe" maxlength="2"	name="txtV2Dauer" size="3">min</td>
		<td></td>
	</tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input name="chkV2Rain" type="checkbox">regenabh&auml;ngig</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr height="20"></tr>
</table> 


<!-- Uebernehmen + Abbrechen -->
<table align="center" border="0" cellspacing="0" cellpadding="1">
	<tr valign="top">
		<td width="450" height="20"></td>
		<td width="100"><input type="image" src="btn_Uebernehmen_1.png" name="b_Submit"  height="25" width="116" onmouseover="this.src='btn_Uebernehmen_2.png'"
						onmouseout="this.src='btn_Uebernehmen_1.png'" onclick="SubmitValuesTerr()"></td>
		<td width="10"></td>
		<td width="100"><input type="image" src="btn_Abbrechen_1.png" name="b_Cancel" height="25" width="116" onmouseover="this.src='btn_Abbrechen_2.png'"
						onmouseout="this.src='btn_Abbrechen_1.png'" onclick="LoadOldValuesTerr()"></td>
		<!-- Das Laden dieser kleinen Datei wird benötigt, um mit dem Event 'onload' die JS-Funktion für Voreinstellungen aktiviert wird -->
		<td width="1"><img src="blind.png" onload="LoadOldValuesTerr()"></td>
	</tr>
</table>
</html>
