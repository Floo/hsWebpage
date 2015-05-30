<html>
<?php

include('config.php');

//print_r($cfg);
$strAuf = "\"".$cfg->get("blinds", "up_time")."\"";
$strZu = "\"".$cfg->get("blinds", "down_time")."\"";
$strAuto = $cfg->get("blinds","auto_time");
$strTuer = $cfg->get("blinds","jal_2_open");
$strWeather = $cfg->get("blinds","weather");
$strWind = $cfg->get("blinds","wind_protection");
$strRain = $cfg->get("blinds","open_on_rain");
$strRain = $cfg->get("blinds","open_on_rain");
$strLuecke = $cfg->get("blinds","close_to_sun");
?> 

<form name="frmWorkspaceName">
	<input type="hidden" name="inputWorkspaceName" value="JALOUSIE" />
</form>

<form name="frmOldValue">
	<input type="hidden" name="old_txtAuf" value=<?php echo $strAuf ?> />
	<input type="hidden" name="old_txtZu" value=<?php echo $strZu ?> />
	<input type="hidden" name="old_txtAufZeit" value="" />
	<input type="hidden" name="old_txtZuZeit" value="" />
	<input type="hidden" name="old_txtAufOffset" value="" />
	<input type="hidden" name="old_txtZuOffset" value="" />
	<input type="hidden" name="old_chkAuto" value=<?php echo $strAuto ?> />
	<input type="hidden" name="old_chkLuecke" value=<?php echo $strLuecke ?> />
	<input type="hidden" name="old_chkWeather" value=<?php echo $strWeather ?> />
	<input type="hidden" name="old_chkRain" value=<?php echo $strRain ?> />
	<input type="hidden" name="old_chkWind" value=<?php echo $strWind ?> />
	<input type="hidden" name="old_chkTuer" value=<?php echo $strTuer ?> />
</form>

<form name="frmNewValue">
	<input type="hidden" name="new_txtAuf" value="" />
	<input type="hidden" name="new_txtZu" value="" />
	<input type="hidden" name="new_txtAufZeit" value="" />
	<input type="hidden" name="new_txtZuZeit" value="" />
	<input type="hidden" name="new_txtAufOffset" value="" />
	<input type="hidden" name="new_txtZuOffset" value="" />
	<input type="hidden" name="new_chkAuto" value="" />
	<input type="hidden" name="new_chkLuecke" value="" />
	<input type="hidden" name="new_chkWeather" value="" />
	<input type="hidden" name="new_chkRain" value="" />
	<input type="hidden" name="new_chkWind" value="" />
	<input type="hidden" name="new_chkTuer" value="" />
</form>



<!-- Ueberschriften ueber den Knoepfen -->
<table border="0" cellpadding="0" cellspacing="0" align="center">
	<tr align="center" valign="top">
		<td width="454"><div class="beschr_1"><i>S&uuml;dfassade</i></div></td>
		<td width="206"><div class="beschr_1"><i>Westfassade</i></div></td>
		<td width ="60"><div class="beschr_1"><i>alle</i></div></td>
	</tr>
	<tr height="20"></tr>
</table>

            
<!-- Knoepfe fuer Fahrbefehle -->
<table align="center" border="0" cellpadding="0" cellspacing="0" height="150">
	<tr align="left" valign="top">
	  
		<td width="60">
			<button class="btn_jal" name="IMPAUF_0" type="button" onClick="JalButton(this)">
				<img border="0" src="btn_ImpAuf.png">
			</button> <br><br>
			<button class="btn_jal" name="AUF_0" type="button" onClick="JalButton(this)">
				<img src="btn_Auf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="STP_0" type="button" onClick="JalButton(this)">
				<img src="btn_Stop.png" border="0">
			</button><br><br>
			<button class="btn_jal" name="AB_0" type="button" onClick="JalButton(this)">
				<img src="btn_Zu.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="IMPAB_0" type="button" onClick="JalButton(this)">
				<img src="btn_ImpZu.png">
			</button> <br><br>
			<button class="btn_jal" name="SUN_0" type="button" onClick="JalButton(this)">
				<img src="btn_Sonne.png" border="0">
			</button>
		</td>

		<td width="125"><br>
			<div class="beschr_3">Jalousie 1</div><br><img src="jal_breit.png" border="0">
		</td>
		
		<td width="60">
			<button class="btn_jal" name="IMPAUF_1" type="button" onClick="JalButton(this)">
				<img src="btn_ImpAuf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="AUF_1" type="button" onClick="JalButton(this)">
				<img src="btn_Auf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="STP_1" type="button" onClick="JalButton(this)">
				<img src="btn_Stop.png" border="0">
			</button><br><br>
			<button class="btn_jal" name="AB_1" type="button" onClick="JalButton(this)">
				<img src="btn_Zu.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="IMPAB_1" type="button" onClick="JalButton(this)">
				<img src="btn_ImpZu.png">
			</button> <br><br>
			<button class="btn_jal" name="SUN_1" type="button" onClick="JalButton(this)">
				<img src="btn_Sonne.png" border="0">
			</button>
		</td>

		<td width="56"><br>
			<div class="beschr_3">Jalousie 2</div><br><img src="jal_schmal.png" border="0">
		</td>
		
		<td width="60">
			<button class="btn_jal" name="IMPAUF_2" type="button" onClick="JalButton(this)">
				<img src="btn_ImpAuf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="AUF_2" type="button" onClick="JalButton(this)">
				<img src="btn_Auf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="STP_2" type="button" onClick="JalButton(this)">
				<img src="btn_Stop.png" border="0">
			</button><br><br>
			<button class="btn_jal" name="AB_2" type="button" onClick="JalButton(this)">
				<img src="btn_Zu.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="IMPAB_2" type="button" onClick="JalButton(this)">
				<img src="btn_ImpZu.png">
			</button> <br><br>
			<button class="btn_jal" name="SUN_2" type="button" onClick="JalButton(this)">
				<img src="btn_Sonne.png" border="0">
			</button>
		</td>
		
		<td width="92"><br>
			<div class="beschr_3">Jalousie 3</div><br><img src="jal_mittel.png" border="0">
		</td>
		
		<td bgcolor="#5d7e7e" width="1"></td>
		<td width="20"></td>
		
		<td width="60">
			<button class="btn_jal" name="IMPAUF_3" type="button" onClick="JalButton(this)">
				<img src="btn_ImpAuf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="AUF_3" type="button" onClick="JalButton(this)">
				<img src="btn_Auf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="STP_3" type="button" onClick="JalButton(this)">
				<img src="btn_Stop.png" border="0">
			</button><br><br>
			<button class="btn_jal" name="AB_3" type="button" onClick="JalButton(this)">
				<img src="btn_Zu.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="IMPAB_3" type="button" onClick="JalButton(this)">
				<img src="btn_ImpZu.png">
			</button> <br><br>
			<button class="btn_jal" name="SUN_3" type="button" onClick="JalButton(this)">
				<img src="btn_Sonne.png" border="0">
			</button>
		</td>
		
		<td width="125"><br>
			<div class="beschr_3">Jalousie 4</div><br><img src="jal_breit.png" border="0">
		</td>
		
		<td bgcolor="#5d7e7e" width="1"></td>
		<td width="20"></td>
		
		<td width="44">
			<button class="btn_jal" name="IMPAUF_ALL" type="button" onClick="JalButton(this)">
				<img src="btn_ImpAuf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="AUF_ALL" type="button" onClick="JalButton(this)">
				<img src="btn_Auf.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="STP_ALL" type="button" onClick="JalButton(this)">
				<img src="btn_Stop.png" border="0">
			</button><br><br>
			<button class="btn_jal" name="AB_ALL" type="button" onClick="JalButton(this)">
				<img src="btn_Zu.png" border="0">
			</button> <br><br>
			<button class="btn_jal" name="IMPAB_ALL" type="button" onClick="JalButton(this)">
				<img src="btn_ImpZu.png">
			</button> <br><br>
			<button class="btn_jal" name="SUN_ALL" type="button" onClick="JalButton(this)">
				<img src="btn_Sonne.png" border="0">
			</button>
		</td>
	</tr>
	<tr height="20"></tr>
	
	<tr>
		<td colspan="13">
			<!--Einstellungen-->
			<form style="display:inline" name="frmJalZeit">
				<table align="center" valign="top" border="0" cellspacing="0" cellpadding="0" class="eingabe">
					<tr>

						<td width="150" valign="top">
							<table align="center" valign="top" border="0" cellspacing="0" cellpadding="0" class="eingabe">
								<tr><th height="20"><u>Optionen:</u></th></tr>
								<tr><td height="0"></td></tr>
								<tr>
									<td>
										<input name="chkAuto" type="checkbox" onClick="AutoChanged()">Zeitautomatik<br>
										<input name="chkWeather" type="checkbox">Wettersteuerung<br>
										<input name="chkWind" type="checkbox">&Ouml;ffnen bei Wind<br>
										<input name="chkRain" type="checkbox">&Ouml;ffnen bei Regen<br>
										<input name="chkTuer" type="checkbox">T&uuml;r bleibt offen<br>
										<input name="chkLuecke" type="checkbox">Auf L&uuml;cke<br>
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
									<th colspan="3" height="20" align="center"><u>Schlie&szlig;en</u></th>
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
									<th colspan="3" height="20" align="center"><u>&Ouml;ffnen</u></th>
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
			</form>
		</td>
	</tr>


	<tr>
		<!-- Uebernehmen + Abbrechen -->
		<table align="center" border="0" cellspacing="0" cellpadding="1">
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
	</tr>
</table>
            
</html>
