<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Methfesselstr. 9</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<script language="JavaScript" src="slider.js"></script>
<script language="JavaScript" src="licht_body.js"></script>
<script language="JavaScript" src="ajax_funktionen.js"></script>
<script language="JavaScript" src="wetter_body.js"></script>
<script language="JavaScript" src="terrasse_body.js"></script>

<script type="text/javascript" language="JavaScript" src="main.js"></script>

<script type="text/javascript" language="JavaScript">
	function btnWorkspace(button){
		initButtons();
		if (button.name == "btn_jal"){
			button.onmouseout= new Function("this.src='btn_jalousie_3.png'");
			button.onclick="";
			button.onmouseover= new Function("this.src='btn_jalousie_3.png'");
			button.src='btn_jalousie_3.png';
			macheRequest('jalousie_body.php', '', 'changeWorkspace');
		}
		if (button.name == "btn_licht"){
			button.onmouseout= new Function("this.src='btn_licht_3.png'");
			button.onclick="";
			button.onmouseover= new Function("this.src='btn_licht_3.png'");
			button.src='btn_licht_3.png';
			macheRequest('licht_body.php', '', 'changeWorkspace');
		}	
		if (button.name == "btn_lueftung"){
			button.onmouseout= new Function("this.src='btn_lueftung_3.png'");
			button.onclick="";
			button.onmouseover= new Function("this.src='btn_lueftung_3.png'");
			button.src='btn_lueftung_3.png';
			macheRequest('lueftung_body.php', '', 'changeWorkspace');
		}	
		if (button.name == "btn_terrasse"){
			button.onmouseout= new Function("this.src='btn_terrasse_3.png'");
			button.onclick="";
			button.onmouseover= new Function("this.src='btn_terrasse_3.png'");
			button.src='btn_terrasse_3.png';
			macheRequest('terrasse_body.php', '', 'changeWorkspace');
		}	
		if (button.name == "btn_wetter"){
			button.onmouseout= new Function("this.src='btn_wetter_3.png'");
			button.onclick="";
			button.onmouseover= new Function("this.src='btn_wetter_3.png'");
			button.src='btn_wetter_3.png';
			macheRequest('wetter_body.php', '', 'changeWorkspace');
		}	
		if (button.name == "btn_system"){
			button.onmouseout= new Function("this.src='btn_system_3.png'");
			button.onclick="";
			button.onmouseover= new Function("this.src='btn_system_3.png'");
			button.src='btn_system_3.png';
			macheRequest('system_body.php', '', 'changeWorkspace');
		}	
	}

	function initButtons(){
		document.getElementsByName("btn_jal")[0].onmouseover= new Function("this.src='btn_jalousie_2.png'");
		document.getElementsByName("btn_jal")[0].onmouseout= new Function("this.src='btn_jalousie_1.png'");
		document.getElementsByName("btn_jal")[0].onclick= new Function('btnWorkspace(this)');
		document.getElementsByName("btn_jal")[0].src = 'btn_jalousie_1.png';
		document.getElementsByName("btn_licht")[0].onmouseover= new Function("this.src='btn_licht_2.png'");
		document.getElementsByName("btn_licht")[0].onmouseout= new Function("this.src='btn_licht_1.png'");
		document.getElementsByName("btn_licht")[0].onclick= new Function('btnWorkspace(this)');
		document.getElementsByName("btn_licht")[0].src = 'btn_licht_1.png';
		document.getElementsByName("btn_lueftung")[0].onmouseover= new Function("this.src='btn_lueftung_2.png'");
		document.getElementsByName("btn_lueftung")[0].onmouseout= new Function("this.src='btn_lueftung_1.png'");
		document.getElementsByName("btn_lueftung")[0].onclick= new Function('btnWorkspace(this)');
		document.getElementsByName("btn_lueftung")[0].src = 'btn_lueftung_1.png';
		document.getElementsByName("btn_terrasse")[0].onmouseover= new Function("this.src='btn_terrasse_2.png'");
		document.getElementsByName("btn_terrasse")[0].onmouseout= new Function("this.src='btn_terrasse_1.png'");
		document.getElementsByName("btn_terrasse")[0].onclick= new Function('btnWorkspace(this)');
		document.getElementsByName("btn_terrasse")[0].src = 'btn_terrasse_1.png';
		document.getElementsByName("btn_wetter")[0].onmouseover= new Function("this.src='btn_wetter_2.png'");
		document.getElementsByName("btn_wetter")[0].onmouseout= new Function("this.src='btn_wetter_1.png'");
		document.getElementsByName("btn_wetter")[0].onclick= new Function('btnWorkspace(this)');
		document.getElementsByName("btn_wetter")[0].src = 'btn_wetter_1.png';
		document.getElementsByName("btn_system")[0].onmouseover= new Function("this.src='btn_system_2.png'");
		document.getElementsByName("btn_system")[0].onmouseout= new Function("this.src='btn_system_1.png'");
		document.getElementsByName("btn_system")[0].onclick= new Function('btnWorkspace(this)');
		document.getElementsByName("btn_system")[0].src = 'btn_system_1.png';
	}
</script>

<style>
    body{font-size: small;color: #333;margin: 0 20px 2em 20px;line-height: 100%;
	background: #fff url(homepage_background.png) repeat-x}
    div.wetter { font-family:Tahoma;color:#008080;font-size:8pt; }
    div.wetter i { font-family:Tahoma;color:#008080;font-size:10pt;font-style:normal; }
    div.button { font-family:Tahoma;color:#000000;font-size:7pt; }
    div.beschr_1 { font-family:Tahoma;color:#5d7e7e;font-size:12pt; }
    div.beschr_2 { font-family:Tahoma;color:#5d7e7e;font-size:10pt; }
    div.beschr_3 { font-family:Tahoma;color:#5d7e7e;font-size:8pt; }
    table.eingabe { font-family:Tahoma;color:#5d7e7e;font-size:8pt; }
    select.Lampenauswahl { font-family:Tahoma;color:#5d7e7e;font-size:10pt;width:120px; }
    input.eingabe { font-family:Tahoma;color:#5d7e7e;font-size:10pt; }
	input.button_1 { font-family:Tahoma;font-style:italic;color:#5d7e7e;font-size:10pt;height:24px;width:100px }
	input.button_2 { font-family:Tahoma;font-style:italic;color:#5d7e7e;font-size:10pt;height:24px;width:140px }
	button.btn_licht { height:24px; width:42px; }
	button.btn_wetter { height:24px; width:42px;font-family:Tahoma;color:#5d7e7e;font-size:10pt }
	button.btn_jal { height:22px; width:40px; }
	button.btn_terrasse { height:24px; width:200px; }
</style>

<meta name="generator" content="SuperHTML Web Studio">
</head>


<body><center><br>

<form name="frmActiveWorkspace">
	<input type="hidden" name="inputActiveWorkspace" value="JALOUSIE" />
</form>

<table width="1023" border="0" cellspacing="0" cellpadding="0">
  <colgroup>
    <col width="43">
    <col width="937">
    <col width="43">
  </colgroup>
  <tr valign="top">
    <td></td>
    <td><img src="hp_3.png" height="185" width="937" border="0"></td>
    <td><img src="hp_4.png" height="185" width="43" border="0"></td>
  </tr>
  <tr valign="top">
    <td></td>
    <td><table style="color:#008080;" width="937" height="450"  border="0" cellspacing="0" cellpadding="0">
    	 <colgroup>
    	    <col width="135">
    	    <col width="10">
    	    <col width="792">
    	 </colgroup>
          <tr valign="top">
            <td background="hp_6.png">
            
              <center>
              <input type="image" src="btn_jalousie_3.png" height="25" width="85"
              	name="btn_jal"
		onmouseover="this.src='btn_jalousie_3.png'"
		onmouseout="this.src='btn_jalousie_3.png'"
		onclick="">
              <br>
  		<input type="image" src="btn_licht_1.png" height="25" width="85"
              	name="btn_licht"
		onmouseover="this.src='btn_licht_2.png'"
		onmouseout="this.src='btn_licht_1.png'"
		onclick="btnWorkspace(this)">
              <br>
              	<input type="image" src="btn_lueftung_1.png" height="25" width="85"
              	name="btn_lueftung"
		onmouseover="this.src='btn_lueftung_2.png'"
		onmouseout="this.src='btn_lueftung_1.png'"
		onclick="btnWorkspace(this)">
              <br>
              	<input type="image" src="btn_terrasse_1.png" height="25" width="85"
              	name="btn_terrasse"
		onmouseover="this.src='btn_terrasse_2.png'"
		onmouseout="this.src='btn_terrasse_1.png'"
		onclick="btnWorkspace(this)">
              <br>
              	<input type="image" src="btn_wetter_1.png" height="25" width="85"
              	name="btn_wetter"
		onmouseover="this.src='btn_wetter_2.png'"
		onmouseout="this.src='btn_wetter_1.png'"
		onclick="btnWorkspace(this)">
              <br>
              	<input type="image" src="btn_system_1.png" height="25" width="85"
              	name="btn_system"
		onmouseover="this.src='btn_system_2.png'"
		onmouseout="this.src='btn_system_1.png'"
		onclick="btnWorkspace(this)">
              <br><br><br><br>
              <div class="wetter">aktuelles Wetter:</div><br>
              <img id="WetterSymbol" src="Sonne.png" height="30" width="36" border="0"><br><br>
              <div class="wetter">Temperatur:</div>
              <div class="wetter" id="TempInnen">innen: <i>0,0&deg;C</i></div>
              <div class="wetter" id="TempAussen">au&szlig;en: <i>0,0&deg;C</i></div><br>
              <div class="wetter">Luftfeuchtigkeit:</div>
              <div class="wetter" id="Feuchte"><i>0 %</i></div><br>
              <div class="wetter">Wind:</div>
              <div class="wetter" id="Wind"><i>0,0 km/h</i></div><br>
              <div class="wetter">Regen:</div>
              <div class="wetter" id="Regen_1h">1 h: <i>0,0 l</i></div>
              <div class="wetter" id="Regen_24h">24 h: <i>0,0 l</i></div>
              <div class="wetter" id="Regen_7d">7 d: <i>0,0 l</i></div>
            </center>
    	
    	    </td>
            <td></td>
            <td id="Workspace" background="hp_7.png" align="left">
            
            <?php include("jalousie_body.php") ?>


            </td>
          </tr>
        </table>
			</td>
    <td></td>
  </tr>
  <tr valign="top">
    <td></td>
    <td><img src="hp_8.png" height="16" width="937" border="0"></td>
    <td></td>
  </tr>
</table>
</center></body>

<script language="JavaScript">
	//btnWorkspace(document.getElementsByName("btn_licht")[0]);
	WeatherTimer();
</script>

</html>
