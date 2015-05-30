//Funktionen zur Darstellung der Kurven
function setKurve(){
      var intKurve1 = document.getElementsByName("Kurve1")[0].selectedIndex;
      var intKurve2 = document.getElementsByName("Kurve2")[0].selectedIndex;
      var intZeitraum = document.getElementsByName("Zeitraum")[0].selectedIndex;
      if((intKurve1 > 0) & (intZeitraum > 0)){
	  sendKurve(intKurve1, intKurve2, intZeitraum);
      }
}