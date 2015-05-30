
<html>

<?php

function trim_value(&$value)
{
    $value = trim($value);
}

/******************************************************
* Â©2006 copyrights by RE-Desgin (cms.re-design.de)   *
* Author: Enrico Reinsdorf (enrico@cms.re-design.de) *
* Modified: 2006-01-16                               *
******************************************************/

//include('config.php'); ist in sharedMemoryRead.php mit eingeschlossen
include('sharedMemoryRead.php'); 

//print_r($cfg);
$strAuf = "\"".$cfg->get("floor_lightning", "off_time")."\"";
$strZu = "\"".$cfg->get("floor_lightning", "on_time")."\"";
$strAuto = $cfg->get("floor_lightning","auto_time");

$cfg_li = new iniParser($workPath.$hslightFile);

$strDevices = $cfg_li->get("system","devices");
$strSzenen = $cfg_li->get("system","scenes");
$Devices = explode(",", $strDevices);
$Szenen = explode(",", $strSzenen);

array_walk($Devices, create_function('&$val', '$val = trim($val);'));
array_walk($Szenen, create_function('&$val', '$val = trim($val);'));
//array_walk($Devices, 'trim_value');
//array_walk($Szenen, 'trim_value');

//Voreinstellung für Orientierunslichtschalter erzeugen
$anfang = strripos($my_string, "<Orient>");
$ende = strripos($my_string, "</Orient>");
$schaltOrient = substr($my_string, $anfang + 8, $ende - $anfang - 8);
if($schaltOrient == "Aus"){
	$imgOrient = "Button_Licht_Aus.gif";
}else{
	$imgOrient = "Button_Licht_An.gif";
}

?> 

<form name="frmWorkspaceName">
	<input type="hidden" name="inputWorkspaceName" value="LICHT" />
</form>

<form name="frmOldValue">
	<input type="hidden" name="old_txtAuf" value=<?php echo $strAuf ?> />
	<input type="hidden" name="old_txtZu" value=<?php echo $strZu ?> />
	<input type="hidden" name="old_txtAufZeit" value="" />
	<input type="hidden" name="old_txtZuZeit" value="" />
	<input type="hidden" name="old_txtAufOffset" value="" />
	<input type="hidden" name="old_txtZuOffset" value="" />
	<input type="hidden" name="old_chkAuto" value=<?php echo $strAuto ?> />
</form>

<form name="frmNewValue">
	<input type="hidden" name="new_txtAuf" value="" />
	<input type="hidden" name="new_txtZu" value="" />
	<input type="hidden" name="new_txtAufZeit" value="" />
	<input type="hidden" name="new_txtZuZeit" value="" />
	<input type="hidden" name="new_txtAufOffset" value="" />
	<input type="hidden" name="new_txtZuOffset" value="" />
	<input type="hidden" name="new_chkAuto" value="" />
</form>



<!-- Einzelne Lampen -->
<table border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr height="25"></tr>
	<tr valign="middle">
		<td width="140"></td>
		<td height="30" colspan="2"><div class="beschr_1"><i>Lampe</i></div></td>
		<td></td>
	</tr>
	<tr valign="middle">
		<td height="30"></td>
        <td>
			<select name="Lampe" size="1" class="Lampenauswahl" onchange="changeLicht();">
				<option value="nothing" selected>--ausw&auml;hlen--</option>
				<?php
                    foreach($Devices as $Device){
                        echo "<option value='$Device'>$Device</option>\n";
                    }
                ?>
			</select>
        </td>
		<td width="30"></td>
		<td>
			<button class="btn_licht" name="Licht_Aus" type="button" onclick="setLichtAus();"><img src="Button_Licht_Aus.gif" border="0"></button>
		</td>
		<td width="8"></td>
		<td>
			<div style="width:120px;height:16px;" id="MyDiv"></div>
			<form action="" method="get" name="sliderForm">
				<input name="sliderValue" id="sliderValue" type="hidden">
			</form>
		</td>
		<td width="8"></td>
		<td>
			<button class="btn_licht" name="Licht_An" type="button" onclick="setLicht();"><img src="Button_Licht_An.gif" border="0"></button>
		</td>
		<td width="20"></td>
		<!-- Das Laden dieser kleinen Datei wird benötigt, um mit dem Event 'onload' die JS-Funktion für Voreinstellungen aktiviert wird -->
		<td width="1"><img src="blind.png" onload="init_my_slider();"></td>
    </tr>
</table>


<!-- Lichtszenen -->
<table border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr height="20"></tr>
	<tr valign="middle">
		<td width="140"></td>
		<td height="30" colspan="2"><div class="beschr_1"><i>Szene</i></div></td>
		<td></td>
	</tr valign="middle">
	<tr height="20">
		<td height="30"></td>
        <td>
			<select name="Szene" size="1" class="Lampenauswahl" onchange="">
				<option value="nothing" selected>--ausw&auml;hlen--</option>
                <?php
                    foreach($Szenen as $Szene){
                        echo "<option value='$Szene'>$Szene</option>\n";
                    }
                ?>
			</select>
        </td>
		<td width="30"></td>
		<td>
			<button  class="btn_licht" name="Set_Szene" type="button" onclick="setSzene();"><img src="Button_Licht_An.gif" border="0"></button>
		</td>
		<td width="8"></td>
	</tr>
    
</table>

<!-- Orientierungslicht -->
<table border="0" cellspacing="0" cellpadding="0" class="eingabe">
	<tr height="30"></tr>
	<tr height="1">
		<td></td>
		<td bgcolor="#5d7e7e" colspan="3"></td>
	</tr>
	<tr height="10"></tr>
	<tr valign="middle">
		<td width="140"></td>
		<td height="30" width="150"><div class="beschr_1"><i>Orientierungslicht</i></div></td>
		<td>
			<button class="btn_licht" name="Schalt_Orient" type="button" onclick="toggleOrient();"><img src="<?php echo $imgOrient ?>" border="0" name="OrientButton"></button>
		</td>
		<td width="180"></td>
	</tr>
	<tr height="20"></tr>
	<tr>
</table>


<!-- Einstellungen fuer Orientierungslicht -->
	<table align="center" valign="top" border="0" cellspacing="0" cellpadding="0" class="eingabe">
		<tr>
		
			<td width="150" valign="top">
				<table align="center" valign="top" border="0" cellspacing="0" cellpadding="0" class="eingabe">
					<tr><th height="20"><u>Optionen:</u></th></tr>
					<tr><td height="0"></td></tr>
					<tr>
						<td>
							<input name="chkAuto" type="checkbox" onClick="AutoChanged()">Zeitautomatik<br>
						</td>
					</tr>
				</table>
			</td>
			
			<td width="1" valign="top" bgcolor="#5d7e7e"></td>
			<td width="20"></td>

			<td valign="top">
				<table align="center" border="0" cellspacing="0" cellpadding="0" class="eingabe">
					<colgroup>
						<col width="150" align="left">
						<col width="1">
						<col width= "20">
						<col width="120" align="center">
						<col width="120" align="center">
					</colgroup>
					<tr valign="middle">
						<th colspan="3" height="20" align="center"><u>Einschalten</u></th>
					</tr>
					<tr valign="middle">
						<td height="30">
							<table border="0" cellspacing="0" cellpadding="2">
								<tr valign="middle">
									<td height="25" width="10%"></td>
									<td width="90%">
										<input name="optZu" type="radio" onClick="ZeitZuChanged()">Uhrzeit 
										<input style="text-align:center" class="eingabe" maxlength="5"	name="txtZuZeit" size="3">
									</td>
								</tr>
							</table>
						</td>
						<td bgcolor="#5d7e7e"></td>
						<td></td>
						<td>
							<input name="optZu" type="radio" onClick="ZeitZuChanged()">Sonnenaufgang<br>
							<input name="optZu" type="radio" onClick="ZeitZuChanged()">Sonnenuntergang
						</td>
						<td>Offset: <input style="text-align:center" maxlength="5" class="eingabe" name="txtZuOffset" size="3" value=""> min</td>
					</tr>
					<tr>
						<td height="15"></td>
					</tr>
					<tr valign="middle">
						<th colspan="3" height="20" align="center"><u>Ausschalten</u></th>
					</tr>
					<tr valign="middle">
						<td height="30">
							<table border="0" cellspacing="0" cellpadding="2">
								<tr valign="middle">
									<td height="25" width="10%"></td>
									<td width="90%">
										<input name="optAuf" type="radio" onClick="ZeitAufChanged()">Uhrzeit 
										<input style="text-align:center" class="eingabe" maxlength="5"	name="txtAufZeit" size="3">
									</td>
								</tr>
							</table>
						</td>
						<td bgcolor="#5d7e7e"></td>
						<td></td>
						<td>
							<input name="optAuf" type="radio" onClick="ZeitAufChanged()">Sonnenaufgang<br>
							<input name="optAuf" type="radio" onClick="ZeitAufChanged()">Sonnenuntergang
						</td>
						<td>Offset: <input style="text-align:center" maxlength="5" class="eingabe" name="txtAufOffset" size="3" value=""> min<br></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr height="20"></tr>
	</table>
<!-- Ende: Einstellungen fuer Orientierungslicht -->



<!-- Uebernehmen + Abbrechen -->
<table border="0" cellspacing="0" cellpadding="1">
	<tr valign="top">
		<td width="450" height="20"></td>
		<td width="100"><input type="image" src="btn_Uebernehmen_1.png" name="b_Submit"  height="25" width="116" onmouseover="this.src='btn_Uebernehmen_2.png'"
			onmouseout="this.src='btn_Uebernehmen_1.png'" onclick="SubmitValues()"></td>
		<td width="10"></td>
		<td width="100"><input type="image" src="btn_Abbrechen_1.png" name="b_Cancel" height="25" width="116" onmouseover="this.src='btn_Abbrechen_2.png'"
			onmouseout="this.src='btn_Abbrechen_1.png'" onclick="LoadOldValues()"></td>
        <!-- Das Laden dieser kleinen Datei wird benötigt, um mit dem Event 'onload' die JS-Funktion für Voreinstellungen aktiviert wird -->
		<td width="1"><img src="blind.png" onload="LoadOldValues()"></td>
	</tr>
</table>

</html>

    
