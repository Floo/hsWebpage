<html>

<form name="frmWorkspaceName">
	<input type="hidden" name="inputWorkspaceName" value="WETTER" />
</form>

<table border="0" cellspacing="0" cellpadding="0" class="eingabe" align="center">
	<tr height="40"></tr>
	<tr valign="middle" height="30">
		<td width="140"></td>
		<td><div class="beschr_1"><i>Kurve 1:</i></div></td>
		<td width="20"></td>
		<td><div class="beschr_1"><i>Kurve 2:</i></div></td>
		<td width="20"></td>
		<td><div class="beschr_1"><i>Zeitraum:</i></div></td>
		<td width="20"></td>
                <td width="140"></td>
	</tr>
	<tr valign="middle" height="30">
		<td></td>
		<td>
			<select name="Kurve1" size="1" class="Lampenauswahl" onchange="">
				<option value="nothing" selected >--ausw&#x00E4;hlen--</option>
				<option value="nothing">Temperatur innen</option>
				<option value="nothing">Temperatur au&#x00DF;en</option>
				<option value="nothing">Luftfeuchte</option>
				<option value="nothing">Windgeschwindigkeit</option>
				<option value="nothing">Regen</option>
                                <option value="nothing">Helligkeit</option>
                                <option value="nothing">Empfang</option>
			</select>
		</td>
		<td></td>
		<td>
			<select name="Kurve2" size="1" class="Lampenauswahl" onchange="">
				<option value="nothing" selected >--ausw&#x00E4;hlen--</option>
				<option value="nothing">Temperatur innen</option>
				<option value="nothing">Temperatur au&#x00DF;en</option>
				<option value="nothing">Luftfeuchte</option>
				<option value="nothing">Windgeschwindigkeit</option>
				<option value="nothing">Regen</option>
                                <option value="nothing">Helligkeit</option>
			</select>
		</td>
		<td></td>
		<td>
			<select name="Zeitraum" size="1" class="Lampenauswahl" onchange="">
				<option value="nothing" selected >--ausw&#x00E4;hlen--</option>
				<option value="nothing">Tag</option>
                                <option value="nothing">3 Tage</option>
				<option value="nothing">Woche</option>
				<option value="nothing">Monat</option>
			</select>
		</td>
		<td></td>
                <td>
                        <button  class="btn_wetter" name="Set_Kurve" type="button" onclick="setKurve();"><div class="Lampenauswahl"><i>Go!</i></div></button>
                </td>
	</tr>
	<tr height="50">
	</tr>
	<tr height="300">
		<td colspan="8" valign="middle" align="center">
                  <img id="GnuplotKurve" src="test2D.png" height="288" width="640" border="0"><br>
		</td>
	</tr>
        <tr height="30"></tr>
</table>

</html>
