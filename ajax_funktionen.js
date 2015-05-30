	var http_request = false;

    function macheRequest(url, parameters, answer) {
        http_request = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                http_request.overrideMimeType('text/xml');
                // zu dieser Zeile siehe weiter unten
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
        if (!http_request) {
            alert('Ende :( Kann keine XMLHTTP-Instanz erzeugen');
            return false;
        }
        switch(answer){
        	case "alertInhalt":
        		http_request.onreadystatechange = alertInhalt;
        		break;
        	case "updateWeather":
        		http_request.onreadystatechange = updateWeather;
        		break;
        	case "doNothing":
        		http_request.onreadystatechange = doNothing;
        		break;
        	case "changeWorkspace":
        		http_request.onreadystatechange = changeWorkspace;
        		break;
                case "updateWetterKurve":
                        http_request.onreadystatechange = updateWetterkurve;
        		break;
        	default:
        		http_request.onreadystatechange = doNothing;
        }
      	http_request.open('POST', url, true);
      	http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      	http_request.setRequestHeader("Content-length", parameters.length);
      	http_request.setRequestHeader("Connection", "close");
      	http_request.send(parameters);
    }
	
	function updateWeather(){
    	if (http_request.readyState == 4) {
            if (http_request.status == 200) {
                var xmldoc = http_request.responseXML;
                with(document){
					//alert(document.frmActiveWorkspace.inputActiveWorkspace.value);
                	//alert(http_request.responseText);
	                getElementById("TempInnen").innerHTML = "innen: <i>" + xmldoc.getElementsByTagName('TempInnen')[0].firstChild.data + "&deg;C</i>";
	                getElementById("TempAussen").innerHTML = "au&szlig;en: <i>" + xmldoc.getElementsByTagName('TempAussen')[0].firstChild.data + "&deg;C</i>";
	                getElementById("Feuchte").innerHTML = "<i>" + xmldoc.getElementsByTagName('Feuchte')[0].firstChild.data + " %</i>";
	                getElementById("Wind").innerHTML = "<i>" + xmldoc.getElementsByTagName('Wind')[0].firstChild.data + " km/h</i>";
	                getElementById("Regen_1h").innerHTML = "1 h: <i>" + xmldoc.getElementsByTagName('Regen_1h')[0].firstChild.data + " l</i>";
	                getElementById("Regen_24h").innerHTML = "24 h: <i>" + xmldoc.getElementsByTagName('Regen_24h')[0].firstChild.data + " l</i>";
	                getElementById("Regen_7d").innerHTML = "7 d: <i>" + xmldoc.getElementsByTagName('Regen_7d')[0].firstChild.data + " l</i>";
					getElementById("WetterSymbol").src = xmldoc.getElementsByTagName('Symbol')[0].firstChild.data;
					//if(document.frmSystem){ //nur wenn System aktiv
					if(document.frmActiveWorkspace.inputActiveWorkspace.value == "SYSTEM"){
						//alert("Update System");
						getElementById("sysOrient").innerHTML = xmldoc.getElementsByTagName('Orient')[0].firstChild.data;
						getElementById("sysHWR").innerHTML = xmldoc.getElementsByTagName('HWR')[0].firstChild.data;
						getElementById("sysAbluft").innerHTML = xmldoc.getElementsByTagName('Abluft')[0].firstChild.data;
						getElementById("sysJal_1").innerHTML = xmldoc.getElementsByTagName('posJal_0')[0].firstChild.data + "/" + xmldoc.getElementsByTagName('drvJal_0')[0].firstChild.data;
						getElementById("sysJal_2").innerHTML = xmldoc.getElementsByTagName('posJal_1')[0].firstChild.data + "/" + xmldoc.getElementsByTagName('drvJal_1')[0].firstChild.data;
						getElementById("sysJal_3").innerHTML = xmldoc.getElementsByTagName('posJal_2')[0].firstChild.data + "/" + xmldoc.getElementsByTagName('drvJal_2')[0].firstChild.data;
						getElementById("sysJal_4").innerHTML = xmldoc.getElementsByTagName('posJal_3')[0].firstChild.data + "/" + xmldoc.getElementsByTagName('drvJal_3')[0].firstChild.data;
						getElementById("sysStampWetter").innerHTML = xmldoc.getElementsByTagName('EmpfangWetter')[0].firstChild.data;
						getElementById("sysStampHell").innerHTML = xmldoc.getElementsByTagName('EmpfangHell')[0].firstChild.data;
						getElementById("sysTempHWR").innerHTML = xmldoc.getElementsByTagName('TempHWR')[0].firstChild.data + "&deg;C";
						getElementById("sysTempWohnen").innerHTML = xmldoc.getElementsByTagName('TempInnen')[0].firstChild.data + "&deg;C";
						getElementById("sysSA").innerHTML = xmldoc.getElementsByTagName('SA')[0].firstChild.data + " Uhr";
						getElementById("sysSU").innerHTML = xmldoc.getElementsByTagName('SU')[0].firstChild.data + " Uhr";
					}
					if(document.frmActiveWorkspace.inputActiveWorkspace.value == "TERRASSE"){
						//alert("Update Terrasse");
						getElementById("sysV1").innerHTML = "Status: " + xmldoc.getElementsByTagName('Ventil_1')[0].firstChild.data;
						getElementById("sysV2").innerHTML = "Status: " + xmldoc.getElementsByTagName('Ventil_2')[0].firstChild.data;
						if(xmldoc.getElementsByTagName('Ventil_1')[0].firstChild.data == "Aus"){
							getElementsByName("Toggle_Ventil_1").innerHTML = "&Ouml;ffnen";
						}else{
							getElementsByName("Toggle_Ventil_1").innerHTML = "Schlie&szlig;en";
						}
						if(xmldoc.getElementsByTagName('Ventil_2')[0].firstChild.data == "Aus"){
							getElementsByName("Toggle_Ventil_2").innerHTML = "&Ouml;ffnen";
						}else{
							getElementsByName("Toggle_Ventil_2").innerHTML = "Schlie&szlig;en";
						}
					}
				}
            } else {
                alert('Bei dem Request ist ein Problem aufgetreten.');
            }
        }
    }
     
    function doNothing(){
        if (http_request.readyState == 4) {
            if (http_request.status != 200) {
                alert('Bei dem Request ist ein Problem aufgetreten.');
            }
        }
    } 

    function alertInhalt() {
        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
            	var xmldoc = http_request.responseXML;
				var root_node = xmldoc.getElementsByTagName('message').item(0);
				alert(root_node.firstChild.data);
            } else {
                alert('Bei dem Request ist ein Problem aufgetreten.');
            }
        }
    }

	function changeWorkspace(){
		if (http_request.readyState == 4) {
            if (http_request.status == 200) {
            	document.getElementById("Workspace").innerHTML = http_request.responseText;
            	document.frmActiveWorkspace.inputActiveWorkspace.value=document.frmWorkspaceName.inputWorkspaceName.value;
            	//alert(document.frmActiveWorkspace.inputActiveWorkspace.value);
            } else {
                alert('Bei dem Request ist ein Problem aufgetreten.');
            }
        }
    }
    
    function updateWetterkurve(){
        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
                var xmldoc = http_request.responseXML;
                var root_node = xmldoc.getElementsByTagName('gnuplot').item(0);
                document.getElementById("GnuplotKurve").src = root_node.firstChild.data;
            } else {
                alert('Bei dem Request ist ein Problem aufgetreten.');
            }
        }
    }
