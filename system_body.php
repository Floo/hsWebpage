<html>

<form name="frmWorkspaceName">
	<input type="hidden" name="inputWorkspaceName" value="SYSTEM" />
</form>

<table border="0" cellspacing="0" cellpadding="0" class="eingabe" align="center" valign="top">
	<tr height="450">
		<td width="360" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" class="eingabe" align="center" valign="top">
			<tr height="30"></tr>
				<tr>
					<td colspan="4" align="center">
						<div class="beschr_1"><i>Systeminformationen</i></div>
					</td>
				</tr>
				<tr height="30"></tr>
				<tr>
					<td colspan="4">
						<div class="beschr_2"><i>Schaltzust&#x00E4;nde</i></div>
					</td>
				</tr>
				<tr height="10"></tr>
				<tr height="22" valign="middle">
					<td width="18"></td>
					<td align="right">
						<div class="beschr_3"><i>Orientierungslicht:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysOrient">Aus</div>
					</td>
				</tr>	
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Abluft HWR:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysHWR">Aus</div>
					</td>
				</tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Zentrale Abluft:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysAbluft">Aus</div>
					</td>
				</tr>
				<tr height="10"></tr>
				<tr>
					<td colspan="4">
						<div class="beschr_2"><i>Jalousien</i></div>
					</td>
				</tr>
				<tr height="10"></tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Jalousie 1:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysJal_1">Undefiniert/Aufwaerts</div>
					</td>
				</tr>				
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Jalousie 2:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysJal_2">Undefiniert/Aufwaerts</div>
					</td>
				</tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Jalousie 3:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysJal_3">Undefiniert/Aufwaerts</div>
					</td>
				</tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Jalousie 4:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysJal_4">Undefiniert/Aufwaerts</div>
					</td>
				</tr>
				
				
				<tr height="10"></tr>
				<tr>
					<td colspan="4">
						<div class="beschr_2"><i>Letzter Funkempfang</i></div>
					</td>
				</tr>
				<tr height="10"></tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Wetter:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysStampWetter">Fri Aug 3 14:19:00 2007</div>
					</td>
				</tr>	
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Helligkeit:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysStampHell">Fri Aug 3 14:19:00 2007</div>
					</td>
				</tr>
				
				<tr height="10"></tr>
				<tr>
					<td colspan="4">
						<div class="beschr_2"><i>Temperaturen</i></div>
					</td>
				</tr>
				<tr height="10"></tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>HWR:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysTempHWR">23,4&#x00B0;C</div>
					</td>
				</tr>	
				<tr height="22" valign="middle">
					<td></td>
					<td align="right">
						<div class="beschr_3"><i>Wohnraum:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysTempWohnen">22,2&#x00B0;C</div>
					</td>
					<!-- Das Laden dieser kleinen Datei wird benötigt, um mit dem Event 'onload' die JS-Funktion für Voreinstellungen aktiviert wird -->
					<td width="1"><img src="blind.png" onload="updateSystem()" /></td>
				</tr>
						
			</table>
		</td>
		<td width="20"></td>
		<td width="360" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" class="eingabe" align="center" valign="top">
			
				<tr height="30"></tr>
				<tr>
					<td colspan="4" align="center">
						<div class="beschr_1"><i>Systeminformationen</i></div>
					</td>
				</tr>
				<tr height="30"></tr>
				<tr>
					<td colspan="4">
						<div class="beschr_2"><i>Sonnenzeiten</i></div>
					</td>
				</tr>
				<tr height="10"></tr>
				<tr height="22" valign="middle">
					<td width="18"></td>
					<td align="left" width="20">
						<div class="beschr_3"><i>Sonnenaufgang:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysSA">00:00</div>
					</td>
				</tr>
				<tr height="22" valign="middle">
					<td></td>
					<td align="left">
						<div class="beschr_3"><i>Sonnenuntergang:</i></div>
					</td>
					<td width="3"></td>
					<td>
						<div class="beschr_3" id="sysSU">00:00</div>
					</td>
				</tr>
				
				
				<tr height="30"></tr>
				<tr>
					<td colspan="4" align="center" width="280">
						<div class="beschr_1"><i>Wartung</i></div>
					</td>
				</tr>
				<tr height="30"></tr>
				<tr>
					<td width="18"></td>
					<td colspan="4">
						<input type="button" class="button_2" onclick="window.open('logfile.php', 'Zweitfenster')" value="Logfile anzeigen" name="btnLogfile" />
					</td>
				</tr>
				<tr height="30"></tr>
				<tr>
					<td colspan="4">
						<div class="beschr_2"><i>App downloaden:</i></div>
					</td>
				</tr>
				<tr height="140">
					<td width="18"></td>
					<td colspan="4">
						<!-- QR-Code erzeugen mit: http://goqr.me/de/ color: "5D7E7E"-->
						<img id="QRDownload" width="140" height="140" border="0" src="qrcode.png"></img>
					</td>
				</tr>
			</table>		
		</td>
	</tr>

</table>

</html>
