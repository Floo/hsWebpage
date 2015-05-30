	//Funktionen für Lichtsteuerung
	function init_my_slider(){
       var A_TPL = {
			'b_vertical' : false,
			'b_watch': true,
			'n_controlWidth': 120,
			'n_controlHeight': 18,
			'n_sliderWidth': 15,
			'n_sliderHeight': 18,
			'n_pathLeft' : 1,
			'n_pathTop' : 0,
			'n_pathLength' : 103,
			's_imgControl': 'slider_bkgnd.png',
			's_imgSlider': 'slider_btn.png',
			's_imgSlider_disabled' : 'slider_dis_btn.png',
			'n_zIndex': 1,
			's_divid' : 'MyDiv'
       }
       var A_INIT = {
			's_form' : 'sliderForm',
			's_name': 'sliderValue',
			'n_minValue' : 0,
			'n_maxValue' : 16,
			'n_value' : 8,
			'n_step' : 1
       }
		var sliderID = new slider(A_INIT, A_TPL);
		//die ID des Sliders global merken
		window.LichtSlider = sliderID.n_id;
    }
	
	function toggleOrient(){
		if(document.getElementsByName("OrientButton")[0].src.search(/_An/) != -1){
			document.getElementsByName("OrientButton")[0].src = "Button_Licht_Aus.gif";
			sendOrient("AUS");
		}else{
			document.getElementsByName("OrientButton")[0].src = "Button_Licht_An.gif";	
			sendOrient("AN");		
		}
		
	}
	
	function changeLicht(){
		if(document.getElementsByName("Lampe")[0].selectedIndex > 0){
			sliderEnabled(true,window.LichtSlider);
			sliderSetValue(8,window.LichtSlider)
		}else{
			sliderEnabled(false,window.LichtSlider);
		}
	}
	
	function setLicht(){
		with(document.getElementsByName("Lampe")[0]){
			if(selectedIndex > 0){
				sendLicht(options[selectedIndex].value, document.getElementsByName("sliderValue")[0].value);
			}
		}
	}
	
	function setLichtAus(){
		with(document.getElementsByName("Lampe")[0]){
			if(selectedIndex > 0){
				sliderSetValue(0,window.LichtSlider);
				sendLicht(options[selectedIndex].value, 0);
			}
		}
	}
	
	function setSzene(){
		with(document.getElementsByName("Szene")[0]){
			if(selectedIndex > 0){
				sendSzene(options[selectedIndex].value);
			}
		}
	}
	
