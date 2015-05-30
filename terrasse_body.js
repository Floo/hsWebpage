	function toggleVentil(Button){
		var strCmd;
		if(Button.name.search(/_1/) != -1){
			strCmd = "VENTIL_1";
		}else{
			strCmd = "VENTIL_2";
		}
		if (Button.value.search(/Schlie/) != -1){
			Button.value = "Öffnen";
			strCmd = strCmd + "_STOP";
		}else{
			Button.value = "Schließen";
			strCmd = strCmd + "_START";		
		}
		//alert(strCmd);
		sendVentil(strCmd);
		updateSystem();
	}
	
	function startVentil(Button){
		var Dauer;
		with(document){	
			if(Button.name.search(/_1/) != -1){
				if(PruefeDauer(getElementsByName("txtV1Timer")[0])){
					Dauer = getElementsByName("txtV1Timer")[0].value;
					getElementsByName("Toggle_Ventil_1")[0].value = "Schließen";
				}else{
					return;
				}	
			}else{
				if(PruefeDauer(getElementsByName("txtV2Timer")[0])){
					Dauer = getElementsByName("txtV2Timer")[0].value;
					getElementsByName("Toggle_Ventil_2")[0].value = "Schließen";
				}else{
					return;
				}	
			}
			//alert(Button.name + ":" + Dauer);
			sendVentil(Button.name + ":" + Dauer);
			updateSystem();
		}
	}
