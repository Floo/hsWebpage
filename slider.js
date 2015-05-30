// Title: tigra slider control
// Description: See the demo at url
// URL: http://www.softcomplex.com/products/tigra_slider_control/
// Version: 1.0 (commented source)
// Date: 02/15/2006
// Tech. Support: http://www.softcomplex.com/forum/
// Notes: This script is free. Visit official site for further details.

function slider (a_init, a_tpl) {

	this.f_setValue  = f_sliderSetValue;
	this.f_getPos    = f_sliderGetPos;
	//this.my_zeit = new Date();
	//this.my_value = 0;
	
	// register in the global collection	
	if (!window.A_SLIDERS)
		window.A_SLIDERS = [];
	this.n_id = window.A_SLIDERS.length;
	window.A_SLIDERS[this.n_id] = this;

	// save config parameters in the slider object
	var s_key;
	if (a_tpl)
		for (s_key in a_tpl)
			this[s_key] = a_tpl[s_key];
	for (s_key in a_init)
		this[s_key] = a_init[s_key];

	this.n_pix2value = this.n_pathLength / (this.n_maxValue - this.n_minValue);
	if (this.n_value == null)
		this.n_value = this.n_minValue;


	 /* Take over the div */
	this.e_sourcediv = get_element(this.s_divid);
	if(!this.n_controlWidth)
	this.n_controlWidth=parseInt(this.e_sourcediv.style.width,10);
	if(!this.n_controlHeight)
	this.n_controlHeight=parseInt(this.e_sourcediv.style.height,10);
	var workingdiv=document.createElement("div");
	workingdiv.style.width=this.n_controlWidth+'px';
	workingdiv.style.height=this.n_controlHeight+'px';
	workingdiv.style.border=0;
	workingdiv.style.backgroundImage="url("+this.s_imgControl+")";
	workingdiv.id="sl"+this.n_id+"base";

	var workingimg=document.createElement("img");
	workingimg.src=this.s_imgSlider;
	workingimg.width=this.n_sliderWidth;
	workingimg.height=this.n_sliderHeight;
	workingimg.border=0;
	workingimg.style.position="relative";
	workingimg.style.left=this.n_pathLeft + "px";
	workingimg.style.top=this.n_pathTop + "px";
	workingimg.style.zIndex=this.n_zIndex;
	// workingimg.style.cursor="pointer"; // didn't like the hand
	workingimg.style.visibility="hidden";
	workingimg.name="sl" + this.n_id + "slider";
	workingimg.id="sl" + this.n_id + "slider";
	workingimg.setAttribute("n_id",this.n_id);
	workingimg.onmousedown=function(){return f_sliderMouseDown(this.getAttribute("n_id"))};
	
	var disabledimg=document.createElement("img");
	disabledimg.src=this.s_imgSlider_disabled;
	disabledimg.width=this.n_sliderWidth;
	disabledimg.height=this.n_sliderHeight;
	disabledimg.border=0;
	disabledimg.style.position="relative";
	disabledimg.style.left=this.n_pathLeft + "px";
	disabledimg.style.top=this.n_pathTop + "px";
	disabledimg.style.zIndex=this.n_zIndex;
	// disabledimg.style.cursor="pointer"; // didn't like the hand
	disabledimg.style.visibility="hidden";
	disabledimg.name="sl" + this.n_id + "slider_disabled";
	disabledimg.id="sl" + this.n_id + "slider_disabled";
	disabledimg.setAttribute("n_id",this.n_id);
	//disabledimg.onmousedown=function(){return f_sliderMouseDown(this.getAttribute("n_id"))};

	workingdiv.appendChild(workingimg);
	workingdiv.appendChild(disabledimg);
	this.e_sourcediv.appendChild(workingdiv);


	this.e_base   = get_element('sl' + this.n_id + 'base');
	this.e_slider = get_element('sl' + this.n_id + 'slider');
	this.d_slider = get_element('sl' + this.n_id + 'slider_disabled');
	
	// safely hook document/window events
	if (document.onmousemove != f_sliderMouseMove) {
		window.f_savedMouseMove = document.onmousemove;
		document.onmousemove = f_sliderMouseMove;
	}
	if (document.onmouseup != f_sliderMouseUp) {
		window.f_savedMouseUp = document.onmouseup;
		document.onmouseup = f_sliderMouseUp;
	}
	// preset to the value in the input box if available
	var e_input = this.s_form == null
		? get_element(this.s_name)
		: document.forms[this.s_form]
			? document.forms[this.s_form].elements[this.s_name]
			: null;
	this.f_setValue(e_input && e_input.value != '' ? e_input.value : null, 1);
	this.e_slider.style.visibility = 'hidden';
	this.d_slider.style.visibility = 'visible';
}



function f_sliderSetValue (n_value, b_noInputCheck) {
	if (n_value == null)
		n_value = this.n_value == null ? this.n_minValue : this.n_value;
	if (isNaN(n_value))
		return false;
	// round to closest multiple if step is specified
	if (this.n_step)
		n_value = Math.round((n_value - this.n_minValue) / this.n_step) * this.n_step + this.n_minValue;
	// smooth out the result
	if (n_value % 1)
		n_value = Math.round(n_value * 1e5) / 1e5;

	if (n_value < this.n_minValue)
		n_value = this.n_minValue;
	if (n_value > this.n_maxValue)
		n_value = this.n_maxValue;

	this.n_value = n_value;

	// move the slider
	if (this.b_vertical)
		this.e_slider.style.top  = (this.n_pathTop + this.n_pathLength - Math.round((n_value - this.n_minValue) * this.n_pix2value)) + 'px';
	else
		this.e_slider.style.left = (this.n_pathLeft + Math.round((n_value - this.n_minValue) * this.n_pix2value)) + 'px';

	// save new value
	var e_input;
	if (this.s_form == null) {
		e_input = get_element(this.s_name);
		if (!e_input)
			return b_noInputCheck ? null : f_sliderError(this.n_id, "Can not find the input with ID='" + this.s_name + "'.");
	}
	else {
		var e_form = document.forms[this.s_form];
		if (!e_form)
			return b_noInputCheck ? null : f_sliderError(this.n_id, "Can not find the form with NAME='" + this.s_form + "'.");
		e_input = e_form.elements[this.s_name];
		if (!e_input)
			return b_noInputCheck ? null : f_sliderError(this.n_id, "Can not find the input with NAME='" + this.s_name + "'.");
	}
	e_input.value = n_value;
	
	//Aenderungen ueberwachen
	
}

// get absolute position of the element in the document
function f_sliderGetPos (b_vertical, b_base) {
	var n_pos = 0,
		s_coord = (b_vertical ? 'Top' : 'Left');
	var o_elem = o_elem2 = b_base ? this.e_base : this.e_slider;
	
	while (o_elem) {
		n_pos += o_elem["offset" + s_coord];
		o_elem = o_elem.offsetParent;
	}
	o_elem = o_elem2;

	var n_offset;
	while (o_elem.tagName != "BODY") {
		n_offset = o_elem["scroll" + s_coord];
		if (n_offset)
			n_pos -= o_elem["scroll" + s_coord];
		o_elem = o_elem.parentNode;
	}
	return n_pos;
}

function f_sliderMouseDown (n_id) {
	window.n_activeSliderId = n_id;
	return false;
}



function f_sliderMouseUp (e_event, b_watching) {
	if (window.n_activeSliderId != null) {
		var o_slider = window.A_SLIDERS[window.n_activeSliderId];
		o_slider.f_setValue(o_slider.n_minValue + (o_slider.b_vertical
			? (o_slider.n_pathLength - parseInt(o_slider.e_slider.style.top) + o_slider.n_pathTop)
			: (parseInt(o_slider.e_slider.style.left) - o_slider.n_pathLeft)) / o_slider.n_pix2value);
		if (b_watching)	return;
		window.n_activeSliderId = null;
	}
	if (window.f_savedMouseUp)
		return window.f_savedMouseUp(e_event);
}

function f_sliderMouseMove (e_event) {

	if (!e_event && window.event) e_event = window.event;

	// save mouse coordinates
	if (e_event) {
		window.n_mouseX = e_event.clientX + f_scrollLeft();
		window.n_mouseY = e_event.clientY + f_scrollTop();
	}

	// check if in drag mode
	if (window.n_activeSliderId != null) {
		var o_slider = window.A_SLIDERS[window.n_activeSliderId];

		var n_pxOffset;
		if (o_slider.b_vertical) {
			var n_sliderTop = window.n_mouseY - o_slider.n_sliderHeight / 2 - o_slider.f_getPos(1, 1) - 3;
			// limit the slider movement
			if (n_sliderTop < o_slider.n_pathTop)
				n_sliderTop = o_slider.n_pathTop;
			var n_pxMax = o_slider.n_pathTop + o_slider.n_pathLength;
			if (n_sliderTop > n_pxMax)
				n_sliderTop = n_pxMax;
			o_slider.e_slider.style.top = n_sliderTop + 'px';
			n_pxOffset = o_slider.n_pathLength - n_sliderTop + o_slider.n_pathTop;
		}
		else {
			var n_sliderLeft = window.n_mouseX - o_slider.n_sliderWidth / 2 - o_slider.f_getPos(0, 1) - 3;
			// limit the slider movement
			if (n_sliderLeft < o_slider.n_pathLeft)
				n_sliderLeft = o_slider.n_pathLeft;
			var n_pxMax = o_slider.n_pathLeft + o_slider.n_pathLength;
			if (n_sliderLeft > n_pxMax)
				n_sliderLeft = n_pxMax;
			o_slider.e_slider.style.left = n_sliderLeft + 'px';
			n_pxOffset = n_sliderLeft - o_slider.n_pathLeft;
		}
		if (o_slider.b_watch)
			 f_sliderMouseUp(e_event, 1);

		return false;
	}
	
	if (window.f_savedMouseMove)
		return window.f_savedMouseMove(e_event);
}

// get the scroller positions of the page
function f_scrollLeft() {
	return f_filterResults (
		window.pageXOffset ? window.pageXOffset : 0,
		document.documentElement ? document.documentElement.scrollLeft : 0,
		document.body ? document.body.scrollLeft : 0
	);
}
function f_scrollTop() {
	return f_filterResults (
		window.pageYOffset ? window.pageYOffset : 0,
		document.documentElement ? document.documentElement.scrollTop : 0,
		document.body ? document.body.scrollTop : 0
	);
}
function f_filterResults(n_win, n_docel, n_body) {
	var n_result = n_win ? n_win : 0;
	if (n_docel && (!n_result || (n_result > n_docel)))
		n_result = n_docel;
	return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}

function f_sliderError (n_id, s_message) {
	alert("Slider #" + n_id + " Error:\n" + s_message);
	window.n_activeSliderId = null;
}

get_element = document.all ?
	function (s_id) { return document.all[s_id] } :
	function (s_id) { return document.getElementById(s_id) };

//eigene Funktionen

function sliderSetValue(value, id){
	window.n_activeSliderId = id;
	var o_slider = window.A_SLIDERS[window.n_activeSliderId];
	o_slider.f_setValue(value,1);
    window.n_activeSliderId = null;
}


function sliderEnabled(value, id){
	window.n_activeSliderId = id;
	var o_slider = window.A_SLIDERS[window.n_activeSliderId];
	if(value){
		o_slider.e_slider.style.visibility = 'visible';
		o_slider.d_slider.style.visibility = 'hidden';
	}else{
		o_slider.e_slider.style.visibility = 'hidden';
		o_slider.d_slider.style.visibility = 'visible';
	}
    window.n_activeSliderId = null;
}
