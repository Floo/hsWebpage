<html>
<?php
/******************************************************
* Â©2006 copyrights by RE-Desgin (cms.re-design.de)   *
* Author: Enrico Reinsdorf (enrico@cms.re-design.de) *
* Modified: 2006-01-16                               *
******************************************************/

include('config.php');
//print_r($cfg);

$strUpTime = "\"".$cfg->get("floor_lightning", "off_time")."\"";
$strTemp = "\"".$cfg->get("hwr", "threshold")."\"";
$strHWRpermanent = $cfg->get("hwr","permanent");
$strHWRauto = $cfg->get("hwr","auto");
$strAClow = $cfg->get("a/c","low");


?> 



<form name="frmOldValue">
	<input type="hidden" name="old_txtTemp" value=<?php echo $strTemp ?> />
	<input type="hidden" name="old_chkHWRpermanent" value=<?php echo $strHWRpermanent ?> />
	<input type="hidden" name="old_chkHWRauto" value=<?php echo $strHWRauto ?> />
	<input type="hidden" name="old_chkAClow" value=<?php echo $strAClow ?> />
</form>


<form name="frmNewValue">
	<input type="hidden" name="new_txtTemp" value="" />
	<input type="hidden" name="new_chkHWRpermanent" value="" />
	<input type="hidden" name="new_chkHWRauto" value="" />
	<input type="hidden" name="new_chkAClow" value="" />
</form>

<form name="frmWorkspaceName">
	<input type="hidden" name="inputWorkspaceName" value="LUEFTUNG" />
</form>

<!-- Zentrale Abluft -->
<table border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr height="100"></tr>
	<tr valign="top">
		<td width="140"></td>
		<td height="30" colspan="2"><div class="beschr_1"><i>Zentrale Abluft</i></div></td>
		<td></td>
	</tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input name="optZentr" type="radio" onClick="">Aus</td>
		<td align="left" width="150"><input name="optZentr" type="radio" onClick="">An</td>
		<td></td>
	</tr>
	<tr height="70"></tr>
</table> 

<!-- HWR -->
<table  border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr valign="top">
		<td width="140"></td>
		<td height="30" colspan="5"><div class="beschr_1"><i>Abluft Hauswirtschaftsraum</i></div></td>
	</tr>
	<tr valign="top">
		<td height="30"></td>
		<td width="20"></td>
		<td align="left" width="150"><input name="optHWR" type="radio" onClick="HWRchanged()">Aus</td>
		<td align="left" width="150" colspan="2"><input name="optHWR" type="radio" onClick="HWRchanged()">Temperatursteuerung</td>
		<td align="left" width="150"><input name="optHWR" type="radio" onClick="HWRchanged()">Dauerbetrieb</td>
	</tr>
	<tr valign="top">
		<td></td>
		<td></td>
        <td></td>
        <td width="22"></td>
		<td align="left">Schaltschwelle: <input style="text-align:center" class="eingabe" maxlength="2" name="txtTemp" size="2"> &deg;C</td>
        <td></td>
	</tr>
	<tr height="100"></tr>
</table>

<!-- Uebernehmen + Abbrechen -->
<table align="center" border="0" cellspacing="0" cellpadding="1">
	<tr valign="top">
		<td width="450" height="20"></td>
		<td width="100"><input type="image" src="btn_Uebernehmen_1.png" name="b_Submit"  height="25" width="116" onmouseover="this.src='btn_Uebernehmen_2.png'"
						onmouseout="this.src='btn_Uebernehmen_1.png'" onclick="SubmitValuesLueft()"></td>
		<td width="10"></td>
		<td width="100"><input type="image" src="btn_Abbrechen_1.png" name="b_Cancel" height="25" width="116" onmouseover="this.src='btn_Abbrechen_2.png'"
						onmouseout="this.src='btn_Abbrechen_1.png'" onclick="LoadOldValuesLueft()"></td>
		<!-- Das Laden dieser kleinen Datei wird benötigt, um mit dem Event 'onload' die JS-Funktion für Voreinstellungen aktiviert wird -->
		<td width="1"><img src="blind.png" onload="LoadOldValuesLueft()"></td>
	</tr>
</table>
</html>
