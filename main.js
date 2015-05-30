function JalButton(Button){
	var strPost = "device=JAL" +
	"&txtButtonName=" + Button.name;
	macheRequest('drv.php', encodeURI(strPost), 'doNothing');
}

function sendOrient(Wert){
	var strPost = "device=ORIENT" +
	"&txtWert=" + Wert;
	macheRequest('drv.php', encodeURI(strPost), 'doNothing');
}

function sendVentil(Wert){
	var strPost = "device=VENTIL" +
	"&txtButtonName=" + Wert;
	macheRequest('drv.php', encodeURI(strPost), 'doNothing');
}

function sendSzene(Szene){
	var strPost = "device=SZENE" +
	"&txtSzene=" + Szene;
	macheRequest('drv.php', encodeURI(strPost), 'doNothing');	
}

function sendLicht(Lampe, Wert){
	//with(document.getElementsByName("Lampe")[0]){
		var strPost = "device=LICHT" + "&txtLampe=" + Lampe + "&txtWert=" + Wert;
	//}
	macheRequest('drv.php', encodeURI(strPost), 'doNothing');	
}

function sendDimm(Lampe, Wert){
	var strPost = "device=DIMM" + "&txtLampe=" + Lampe + "&txtWert=" + Wert;
	macheRequest('drv.php', encodeURI(strPost), 'doNothing');
}

function sendKurve(intKurve1, intKurve2, intZeitraum){
     var strPost = "intKurve1=" + intKurve1 + "&intKurve2=" + intKurve2
          + "&intZeitraum=" + intZeitraum + "&boolGUI=0";
     macheRequest('plot_wetter.php', encodeURI(strPost), 'updateWetterKurve');
}

function LoadValues(){
	with(document){
		var strAuf = getElementsByName("old_txtAuf")[0].value;
		var strZu = getElementsByName("old_txtZu")[0].value;
		var offset;
		getElementsByName("txtAufZeit")[0].value = "00:00";
		getElementsByName("txtZuZeit")[0].value = "00:00";
		getElementsByName("txtAufOffset")[0].value = "0";
		getElementsByName("txtZuOffset")[0].value = "0";

		if(strAuf.search(/:/) > -1)
		{
			getElementsByName("txtAufZeit")[0].value=strAuf;
			getElementsByName("old_txtAufZeit")[0].value=strAuf;
			getElementsByName("optAuf")[0].checked=true;
		}
		else if(strAuf.search(/SA/) > -1)
		{
			offset = strAuf.substr(2);
			if(offset.length < 1) offset = 0;
			getElementsByName("txtAufOffset")[0].value=offset;
			getElementsByName("old_txtAufOffset")[0].value=offset;
			getElementsByName("optAuf")[1].checked=true;
		}
		else if(strAuf.search(/SU/) > -1)
		{
			offset = strAuf.substr(2);
			if(offset.length < 1) offset = 0;
			getElementsByName("txtAufOffset")[0].value=offset;
			getElementsByName("old_txtAufOffset")[0].value=offset;
			getElementsByName("optAuf")[2].checked=true;
		}
		if(strZu.search(/:/) > -1)
		{
			getElementsByName("txtZuZeit")[0].value=strZu;
			getElementsByName("old_txtZuZeit")[0].value=strZu;
			getElementsByName("optZu")[0].checked=true;
		}
		else if(strZu.search(/SA/) > -1)
		{
			offset = strZu.substr(2);
			if(offset.length < 1) offset = 0;
			getElementsByName("txtZuOffset")[0].value=offset;
			getElementsByName("old_txtZuOffset")[0].value=offset;
			getElementsByName("optZu")[1].checked=true;
		}
		else if(strZu.search(/SU/) > -1)
		{
			offset = strZu.substr(2);
			if(offset.length < 1) offset = 0;
			getElementsByName("txtZuOffset")[0].value=offset;
			getElementsByName("old_txtZuOffset")[0].value=offset;
			getElementsByName("optZu")[2].checked=true;
		}
		getElementsByName("chkAuto")[0].checked = toBool(getElementsByName("old_chkAuto")[0]);
		//nur für Jalousie
		if(document.frmOldValue.old_chkWind){
			getElementsByName("chkWind")[0].checked = toBool(getElementsByName("old_chkWind")[0]);
			getElementsByName("chkWeather")[0].checked = toBool(getElementsByName("old_chkWeather")[0]);
			getElementsByName("chkRain")[0].checked = toBool(getElementsByName("old_chkRain")[0]);
			getElementsByName("chkTuer")[0].checked = toBool(getElementsByName("old_chkTuer")[0]);
			getElementsByName("chkLuecke")[0].checked = toBool(getElementsByName("old_chkLuecke")[0]);
		}
	}
}

function LoadValuesLueft(){
	with(document){
		getElementsByName("txtTemp")[0].value = getElementsByName("old_txtTemp")[0].value;
		getElementsByName("optZentr")[0].checked = true;
		getElementsByName("optZentr")[1].checked = toBool(getElementsByName("old_chkAClow")[0]);
		getElementsByName("optHWR")[0].checked = true;
		getElementsByName("optHWR")[1].checked = toBool(getElementsByName("old_chkHWRauto")[0]);
		getElementsByName("optHWR")[2].checked = toBool(getElementsByName("old_chkHWRpermanent")[0]);
	}
}

function HWRchanged(){
	document.getElementsByName("txtTemp")[0].disabled = !document.getElementsByName("optHWR")[1].checked;
}

function LoadOldValuesLueft(){
	LoadValuesLueft();
	HWRchanged();
}

function LoadValuesTerr(){
	//alert("LoadValuesTerr");
	with(document){
		getElementsByName("txtV1Start")[0].value = getElementsByName("old_txtV1Start")[0].value;
		getElementsByName("txtV2Start")[0].value = getElementsByName("old_txtV2Start")[0].value;
		getElementsByName("txtV1Dauer")[0].value = getElementsByName("old_txtV1Dauer")[0].value;
		getElementsByName("txtV2Dauer")[0].value = getElementsByName("old_txtV2Dauer")[0].value;
		getElementsByName("chkV1Auto")[0].checked = toBool(getElementsByName("old_chkV1Auto")[0]);
		getElementsByName("chkV2Auto")[0].checked = toBool(getElementsByName("old_chkV2Auto")[0]);
		getElementsByName("chkV1Rain")[0].checked = toBool(getElementsByName("old_chkV1Rain")[0]);
		getElementsByName("chkV2Rain")[0].checked = toBool(getElementsByName("old_chkV2Rain")[0]);
	}
}

function LoadOldValuesTerr(){
	//alert("LoadOldValesTerr");
	LoadValuesTerr();
	updateSystem();
	//TerrChanged();
}

function LoadOldValues(){
	LoadValues();
	AutoChanged();
}

function ZeitAufChanged(){
	with(document){
		getElementsByName("txtAufOffset")[0].disabled = getElementsByName("optAuf")[0].checked;
		getElementsByName("txtAufZeit")[0].disabled = !getElementsByName("optAuf")[0].checked;
		getElementsByName("optZu")[1].disabled = getElementsByName("optAuf")[1].checked;
		if((getElementsByName("optZu")[1].diabled) && (getElementsByName("optZu")[1].checked))
			getElementsByName("optZu")[2].checked = true;
		getElementsByName("optZu")[2].disabled = getElementsByName("optAuf")[2].checked;
		if((getElementsByName("optZu")[2].diabled) && (getElementsByName("optZu")[2].checked))
			getElementsByName("optZu")[1].checked = true;
	}
}

function ZeitZuChanged(){
	with(document){
		getElementsByName("txtZuOffset")[0].disabled = getElementsByName("optZu")[0].checked;
		getElementsByName("txtZuZeit")[0].disabled = !getElementsByName("optZu")[0].checked;
		getElementsByName("optAuf")[1].disabled = getElementsByName("optZu")[1].checked;
		if((getElementsByName("optAuf")[1].diabled) && (getElementsByName("optAuf")[1].checked))
			getElementsByName("optAuf")[2].checked = true;
		getElementsByName("optAuf")[2].disabled = getElementsByName("optZu")[2].checked;
		if((getElementsByName("optAuf")[2].diabled) && (getElementsByName("optAuf")[2].checked))
			getElementsByName("optAuf")[1].checked = true;
	}
}

function AutoChanged(){
	with(document){
		var aktiviert = !getElementsByName("chkAuto")[0].checked;
		getElementsByName("txtAufZeit")[0].disabled = aktiviert;
		getElementsByName("txtZuZeit")[0].disabled = aktiviert;
		getElementsByName("txtAufOffset")[0].disabled = aktiviert;
		getElementsByName("txtZuOffset")[0].disabled = aktiviert;
		getElementsByName("optZu")[0].disabled = aktiviert;
		getElementsByName("optZu")[1].disabled = aktiviert;
		getElementsByName("optZu")[2].disabled = aktiviert;
		getElementsByName("optAuf")[0].disabled = aktiviert;
		getElementsByName("optAuf")[1].disabled = aktiviert;
		getElementsByName("optAuf")[2].disabled = aktiviert;
		if(!aktiviert)ZeitAufChanged();
		if(!aktiviert)ZeitZuChanged();
	}
}


function SubmitValues(){
	var strAuf = "";
	var strZu = "";
	var offset;
	with(document){
		if(PruefeUhrzeit(getElementsByName("txtAufZeit")[0]))
			getElementsByName("new_txtAufZeit")[0].value = getElementsByName("txtAufZeit")[0].value;
		else
			return;
		if(PruefeUhrzeit(getElementsByName("txtZuZeit")[0]))
			getElementsByName("new_txtZuZeit")[0].value = getElementsByName("txtZuZeit")[0].value;
		else
			return;
		if(PruefeOffset(getElementsByName("txtAufOffset")[0]))
			getElementsByName("new_txtAufOffset")[0].value = getElementsByName("txtAufOffset")[0].value;
		else
			return;
		if(PruefeOffset(getElementsByName("txtZuOffset")[0]))
			getElementsByName("new_txtZuOffset")[0].value = getElementsByName("txtZuOffset")[0].value;
		else
			return;
	
		if(document.frmOldValue.old_chkWind){ //nur fuer Jalousie
			getElementsByName("new_chkWind")[0].value = getElementsByName("chkWind")[0].checked;
			getElementsByName("new_chkRain")[0].value = getElementsByName("chkRain")[0].checked;
			getElementsByName("new_chkWeather")[0].value = getElementsByName("chkWeather")[0].checked;
			getElementsByName("new_chkLuecke")[0].value = getElementsByName("chkLuecke")[0].checked;
			getElementsByName("new_chkTuer")[0].value = getElementsByName("chkTuer")[0].checked;
		}
		getElementsByName("new_chkAuto")[0].value = getElementsByName("chkAuto")[0].checked
		
		if(getElementsByName("optAuf")[0].checked == true)
		{
			strAuf = getElementsByName("txtAufZeit")[0].value;
		}
		else
		{
			offset = parseInt(getElementsByName("txtAufOffset")[0].value);
			if(getElementsByName("optAuf")[1].checked == true)
				strAuf = "SA";
			else
				strAuf = "SU";
			if(offset < 0)
			{
				strAuf = strAuf + offset;
			}else{
				strAuf = strAuf + "g" + offset;
			}
		}
		
		if(getElementsByName("optZu")[0].checked == true)
		{
			strZu = getElementsByName("txtZuZeit")[0].value;
		}
		else
		{
			offset = parseInt(getElementsByName("txtZuOffset")[0].value);
			if(getElementsByName("optZu")[1].checked == true)
				strZu = "SA";
			else
				strZu = "SU";
			if(offset < 0)
			{
				strZu = strZu + offset;
			}else{
				strZu = strZu + "g" + offset;
			}
		}

		if(document.frmOldValue.old_chkWind){ //nur fuer Jalousie
			//alte und neue Werte vergleichen
			if(ungleich(getElementsByName("new_chkTuer")[0], getElementsByName("old_chkTuer")[0]) ||
				ungleich(getElementsByName("new_chkLuecke")[0], getElementsByName("old_chkLuecke")[0]) ||
				ungleich(getElementsByName("new_chkAuto")[0], getElementsByName("old_chkAuto")[0]) ||
				ungleich(getElementsByName("new_chkWind")[0], getElementsByName("old_chkWind")[0]) ||
				ungleich(getElementsByName("new_chkRain")[0], getElementsByName("old_chkRain")[0]) ||
				ungleich(getElementsByName("new_chkWeather")[0], getElementsByName("old_chkWeather")[0]) ||
				(getElementsByName("new_txtAufZeit")[0].value != getElementsByName("old_txtAufZeit")[0].value) ||
				(getElementsByName("new_txtZuZeit")[0].value != getElementsByName("old_txtZuZeit")[0].value) ||
				(getElementsByName("new_txtAufOffset")[0].value != getElementsByName("old_txtAufOffset")[0].value) ||
				(getElementsByName("new_txtZuOffset")[0].value != getElementsByName("old_txtZuOffset")[0].value))
			{
				var strPost = "&txtAuf=" + strAuf + "&txtZu=" + strZu +
					"&chkLuecke=" + getElementsByName("new_chkLuecke")[0].value +
					"&chkAuto=" + getElementsByName("new_chkAuto")[0].value +
					"&chkTuer=" + getElementsByName("new_chkTuer")[0].value +
					"&chkWeather=" + getElementsByName("new_chkWeather")[0].value +
					"&chkRain=" + getElementsByName("new_chkRain")[0].value +
					"&chkWind=" + getElementsByName("new_chkWind")[0].value;
				//alert("Daten stehen zum Senden bereit");
				macheRequest('setJalousie.php', encodeURI(strPost), 'alertInhalt');
				abgleichOldNew();
			}
			
		}else{
			//alte und neue Werte vergleichen
			if(ungleich(getElementsByName("new_chkAuto")[0], getElementsByName("old_chkAuto")[0]) ||
				(getElementsByName("new_txtAufZeit")[0].value != getElementsByName("old_txtAufZeit")[0].value) ||
				(getElementsByName("new_txtZuZeit")[0].value != getElementsByName("old_txtZuZeit")[0].value) ||
				(getElementsByName("new_txtAufOffset")[0].value != getElementsByName("old_txtAufOffset")[0].value) ||
				(getElementsByName("new_txtZuOffset")[0].value != getElementsByName("old_txtZuOffset")[0].value))
			{
				var strPost = "&txtAuf=" + strAuf + "&txtZu=" + strZu +
					"&chkAuto=" + getElementsByName("new_chkAuto")[0].value;
				//alert("Daten stehen zum Senden bereit");
				macheRequest('setLicht.php', encodeURI(strPost), 'alertInhalt');
				abgleichOldNew();
			}
		}
	}
}

function SubmitValuesLueft(){
	with(document){
		if(PruefeTemp(getElementsByName("txtTemp")[0]))
			getElementsByName("new_txtTemp")[0].value = getElementsByName("txtTemp")[0].value;
		else
			return;
		getElementsByName("new_chkHWRpermanent")[0].value = getElementsByName("optHWR")[2].checked;
		getElementsByName("new_chkHWRauto")[0].value = getElementsByName("optHWR")[1].checked;
		getElementsByName("new_chkAClow")[0].value = getElementsByName("optZentr")[1].checked;
		
		//alte und neue Werte vergleichen			
		if((getElementsByName("new_txtTemp")[0].value != getElementsByName("old_txtTemp")[0].value) ||
			ungleich(getElementsByName("new_chkHWRpermanent")[0], getElementsByName("old_chkHWRpermanent")[0]) ||
			ungleich(getElementsByName("new_chkHWRauto")[0], getElementsByName("old_chkHWRauto")[0]) ||
			ungleich(getElementsByName("new_chkAClow")[0], getElementsByName("old_chkAClow")[0]))
		{
			var strPost = "txtTemp=" + getElementsByName("new_txtTemp")[0].value +
				"&chkHWRpermanent=" + getElementsByName("new_chkHWRpermanent")[0].value +
				"&chkHWRauto=" + getElementsByName("new_chkHWRauto")[0].value +
				"&chkAClow=" + getElementsByName("new_chkAClow")[0].value;
			//alert("Daten stehen zum Senden bereit");
			macheRequest('setLueftung.php', encodeURI(strPost), 'alertInhalt');
			abgleichOldNew();
		}
		
	}
}

function SubmitValuesTerr(){
	with(document){
		if(PruefeUhrzeit(getElementsByName("txtV1Start")[0]))
			getElementsByName("new_txtV1Start")[0].value = getElementsByName("txtV1Start")[0].value;
		else
			return;
		if(PruefeUhrzeit(getElementsByName("txtV2Start")[0]))
			getElementsByName("new_txtV2Start")[0].value = getElementsByName("txtV2Start")[0].value;
		else
			return;
		if(PruefeDauer(getElementsByName("txtV1Dauer")[0]))
			getElementsByName("new_txtV1Dauer")[0].value = getElementsByName("txtV1Dauer")[0].value;
		else
			return;
		if(PruefeDauer(getElementsByName("txtV2Dauer")[0]))
			getElementsByName("new_txtV2Dauer")[0].value = getElementsByName("txtV2Dauer")[0].value;
		else
			return;
		getElementsByName("new_chkV1Auto")[0].value = getElementsByName("chkV1Auto")[0].checked;
		getElementsByName("new_chkV2Auto")[0].value = getElementsByName("chkV2Auto")[0].checked;
		getElementsByName("new_chkV1Rain")[0].value = getElementsByName("chkV1Rain")[0].checked;
		getElementsByName("new_chkV2Rain")[0].value = getElementsByName("chkV2Rain")[0].checked;
		//alte und neue Werte vergleichen			
		if((getElementsByName("new_txtV1Start")[0].value != getElementsByName("old_txtV1Start")[0].value) ||
			(getElementsByName("new_txtV2Start")[0].value != getElementsByName("old_txtV2Start")[0].value) ||
			(getElementsByName("new_txtV1Dauer")[0].value != getElementsByName("old_txtV1Dauer")[0].value) ||
			(getElementsByName("new_txtV2Dauer")[0].value != getElementsByName("old_txtV2Dauer")[0].value) ||
			ungleich(getElementsByName("new_chkV1Auto")[0], getElementsByName("old_chkV1Auto")[0]) ||
			ungleich(getElementsByName("new_chkV2Auto")[0], getElementsByName("old_chkV2Auto")[0]) ||
			ungleich(getElementsByName("new_chkV1Rain")[0], getElementsByName("old_chkV1Rain")[0]) ||
			ungleich(getElementsByName("new_chkV2Rain")[0], getElementsByName("old_chkV2Rain")[0]))
		{
			var strPost = "txtV1Start=" + getElementsByName("new_txtV1Start")[0].value +
				"&txtV2Start=" + getElementsByName("new_txtV2Start")[0].value +
				"&txtV1Dauer=" + getElementsByName("new_txtV1Dauer")[0].value +
				"&txtV2Dauer=" + getElementsByName("new_txtV2Dauer")[0].value +
				"&chkV1Auto=" + getElementsByName("new_chkV1Auto")[0].value +
				"&chkV2Auto=" + getElementsByName("new_chkV2Auto")[0].value +
				"&chkV1Rain=" + getElementsByName("new_chkV1Rain")[0].value +
				"&chkV2Rain=" + getElementsByName("new_chkV2Rain")[0].value;
			//alert("Daten stehen zum Senden bereit");
			macheRequest('setTerrasse.php', encodeURI(strPost), 'alertInhalt');
			abgleichOldNew();
		}
	}
}

function ungleich(Feld_1, Feld_2){
	(Feld_1.value == 1) || (Feld_1.value.toLowerCase() == "true")?bool_1 = true:bool_1=false;
	(Feld_2.value == 1) || (Feld_2.value.toLowerCase() == "true")?bool_2 = true:bool_2=false;
	//alert("Feld_1: " + Feld_1.value + " != Feld_2: " + Feld_2.value + ", Ergebnis: " + String(bool_1 != bool_2));
	return bool_1 != bool_2;
}


function abgleichOldNew(){
	var anz = document.frmOldValue.getElementsByTagName("input").length;
	for (var i=0; i < anz; i++) {
		old_name = document.frmOldValue.getElementsByTagName("input")[i].name;
		new_name = "new_" + old_name.substr(4);
		document.getElementsByName(old_name)[0].value = document.getElementsByName(new_name)[0].value;
	}
}

function toBool(Feld){
	var bool_1;
	(Feld.value == 1) || (Feld.value.toLowerCase() == "true")?bool_1 = true:bool_1=false;
	return bool_1;
}

//die ganzen Prüffunktionen
function PruefeTemp(Feld){
	var strMeldung = "Fehler bei der Eingabe!\n\nDer Wert: " + Feld.value + " ist fehlerhaft.\n"
	if(PruefeLaenge(Feld, 2, 2, strMeldung)){
		if(PruefeFeld(Feld, "0123456789", strMeldung)){
			if(PruefeZeichen(Feld.value.charAt(0), "123456789", strMeldung)){
				if(PruefeZeichen(Feld.value.charAt(1), "0123456789", strMeldung)){
					if(PruefeWert(Feld.value, 10, 39, strMeldung)){
						return true;
					}
				}
			}
		}
	}
}

function PruefeUhrzeit(Feld){
	var strMeldung = "Fehler bei der Eingabe!\n\nDer Wert: " + Feld.value + " ist fehlerhaft.\n"
	if(PruefeLaenge(Feld, 5, 5, strMeldung)){
		if(PruefeFeld(Feld, "0123456789:", strMeldung)){
			if(PruefeZeichen(Feld.value.charAt(0), "0123456789", strMeldung)){
				if(PruefeZeichen(Feld.value.charAt(1), "0123456789", strMeldung)){
					if(PruefeZeichen(Feld.value.charAt(2), ":", strMeldung)){
						if(PruefeZeichen(Feld.value.charAt(3), "012345", strMeldung)){
							if(PruefeZeichen(Feld.value.charAt(4), "01234567890", strMeldung)){
								var Zahl = parseInt(Feld.value.slice(0,2));
								if(PruefeWert(Zahl, 0, 23, strMeldung)){
									Zahl = parseInt(Feld.value.slice(3,5));
									if(PruefeWert(Zahl, 0, 59, strMeldung)){
										return true;
									}
								}
							}
						}
					}
				}
			}
		}
	}
	Feld.focus();
	return false;
}

function PruefeOffset(Feld){
	var strMeldung = "Fehler bei der Eingabe!\n\nDer Wert: " + Feld.value + " ist fehlerhaft.\n"
	var strZeichen;
	var intI;
	if(PruefeLaenge(Feld, 1, 4, strMeldung)){
		intI = 0;
		//document.getElementsByName("txtTemp")[0].value = Feld.value;
		if(PruefeFeld(Feld, "0123456789+-", strMeldung)){
			if(PruefeZeichen(Feld.value.charAt(intI), "+-0123456789", strMeldung)){
				intI++;	
				if(PruefeZeichen(Feld.value.charAt(intI), "0123456789", strMeldung)){
					intI++;
					if(PruefeZeichen(Feld.value.charAt(intI), "0123456789", strMeldung)){
						intI++;
						if(PruefeZeichen(Feld.value.charAt(intI), "0123456789", strMeldung)){
							var Zahl = parseInt(Feld.value);
							if(PruefeWert(Zahl, -180, 180, strMeldung)){
								return true;
							}
						}
					}
				}
			}
		}
	}
	Feld.focus();
	return false;
}

function PruefeDauer(Feld){
	var strMeldung = "Fehler bei der Eingabe!\n\nDer Wert: " + Feld.value + " ist fehlerhaft.\n"
	var strZeichen;
	var intI;
	if(PruefeLaenge(Feld, 1, 2, strMeldung)){
		intI = 0;
		//document.getElementsByName("txtTemp")[0].value = Feld.value;
		if(PruefeFeld(Feld, "0123456789", strMeldung)){
			if(PruefeZeichen(Feld.value.charAt(intI), "0123456789", strMeldung)){
				intI++;	
				if(PruefeZeichen(Feld.value.charAt(intI), "0123456789", strMeldung)){
					var Zahl = parseInt(Feld.value);
					if(PruefeWert(Zahl, 1, 59, strMeldung)){
						return true;
					}
				}
			}
		}
	}
	Feld.focus();
	return false;
}


function PruefeWert(Zahl, minWert, maxWert, Meldung){
	var ret = (Zahl >= minWert) && (Zahl <= maxWert);
	if(!ret) alert(Meldung);
	return ret;
}

function PruefeLaenge(Feld, minLaenge, maxLaenge, Meldung){
	var FeldLaenge = Feld.value.length;
	var ret = (FeldLaenge >= minLaenge) && (FeldLaenge <= maxLaenge);
	if (!ret) alert(Meldung);
	return ret;
}

function PruefeZeichen(Zeichen, ZugelasseneZeichen, Meldung){
	var ret = true;
	for (var Pos = 0; Pos < Zeichen.length; Pos++){
		if(ZugelasseneZeichen.indexOf(Zeichen.charAt(Pos)) == -1) ret = false;
	}
	if (!ret) alert(Meldung);
	return ret;
}

function PruefeFeld(Feld, ZugelasseneZeichen, Meldung){
	var ret = true;
	for (var Pos = 0; Pos < Feld.value.length; Pos++){
		if(ZugelasseneZeichen.indexOf(Feld.value.charAt(Pos)) == -1) ret = false;
	}
	if (!ret) alert(Meldung);
	return ret;		
}
    
//evtl kann das Folgende in die Fkt. updateWeather() eingefuegt werden
function WeatherTimer(){
	macheRequest('weather.php', '', 'updateWeather');
	setTimeout("WeatherTimer()", 60000);
}

function updateSystem(){
macheRequest('weather.php', '', 'updateWeather');
}
