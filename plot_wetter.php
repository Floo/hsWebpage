<?php

include('config.php');

$rnd = rand();

$gnufile = "gnuphp.plt";
$imagefile = "wetter$rnd.png";

$plot1 = $_POST['intKurve1']; //0-nix, 1-TempInnen, 2-TempAussen, 3-Feuchte, 4-Wind, 5-Regen, 6-Hell, 7-Empfang
$plot2 = $_POST['intKurve2'];
$period = $_POST['intZeitraum']; //1-Tag, 2-drei Tage, 3-Woche, 4-Monat

if (array_key_exists('boolGUI', $_POST)){
	$gui = $_POST['boolGUI']; //0-fuer Webseite ausgeben, 1-fuer GUI ausgeben, 2-fuer Smartphone ausgeben 
}else{
	$gui = 0;
}

//$plot1 = 1;
//$plot2 = 2;
//$period = 3;
if ($plot1 == 0){
	$plot1 = $plot2;
}
if ($plot1 == 7){ //Empfang Wetter
	$plot2 = 8;   //Empfang Licht
}
if ($plot1 == 5){
	//$plot2 = 0;
}
if ($plot1 == $plot2){
	$plot2 = 0;
}
if ($plot2 == 5){
	//$plot2 = 0;
}
if ($plot2 == 7){
	$plot2 = 0;
}
	
$label = array("", "Temperatur innen [°C]", "Temperatur außen [°C]", "Luftfeuchtigkeit [%]", "Windgeschwindigkeit [km/h]",
	"Regenmenge [l/m²]", "Helligkeit", "Empfang Wetter", "Empfang Helligkeit");
$anzahlTage = array(1, 3, 7, 31);

$zeit = gettimeofday();
$offset = -60 * $zeit["minuteswest"];
$endzeit = $zeit["sec"] + $offset;
//$endzeit = time(); // - 2*86400;
$anfangszeit = $endzeit - ($anzahlTage[$period - 1] * 24 * 60 * 60);

if ($platform == "windows"){
	$font = "Times,10";
	$gfh = fopen($workPath.$gnufile, "w");
}else{
	$font = "Helvetica,10";
	$gfh = fopen($gnufile, "w");
}
if ($gui == 1)
{
	fwrite($gfh, " set terminal png transparent enhanced size 600, 288\n");
}else{
	fwrite($gfh, " set terminal png enhanced size 600, 288\n");
}
fwrite($gfh, " set grid ytics y2tics\n");
fwrite($gfh, " set autoscale\n");
fwrite($gfh, " set xdata time\n");
fwrite($gfh, " set timefmt \"%s\"\n"); 
//fwrite($gfh, " set style data boxes\n");
fwrite($gfh, " set style data lines\n");
fwrite($gfh, " set boxwidth 0.5 relative\n");
fwrite($gfh, " set xlabel 'Zeit' font \"$font\" \n");
fwrite($gfh, " set xrange [\"$anfangszeit\" : \"$endzeit\"]\n");
fwrite($gfh, " set ytics  font \"$font\"\n");
fwrite($gfh, " set title \"\"\n");
fwrite($gfh, " set output \"$imagefile\"\n");
fwrite($gfh, " set ylabel \"$label[$plot1]\" font \"$font\" textcolor rgbcolor \"#5D7E7E\"\n");
if ($period == 1){
	fwrite($gfh, " set xtics format \"%H:%M\" font \"$font\" \n");
}elseif ($period == 4){
	fwrite($gfh, " set xtics format \"%a\" font \"$font\" \n");
}else{
	fwrite($gfh, " set xtics format \"%a\\n%H:%M\" font \"$font\" \n");
}
if ($plot2 > 0)
{
	fwrite($gfh, " set y2tics border font \"$font\" \n");
	fwrite($gfh, " set y2label \"$label[$plot2]\" font \"$font\" textcolor rgbcolor \"#F1A66C\"\n");
}

if ($plot1 == 1 or $plot1 == 2){
	//fwrite($gfh, " set ytics 1\n");
}
if ($plot2 == 1 or $plot2 == 2){
	//fwrite($gfh, " set y2tics 1\n");
}
$style1 = "";
$style2 = "";
if ($plot1 == 5){
	fwrite($gfh, " set yrange [0:*]\n");
	$style1 = "with boxes fill solid";
}
if ($plot2 == 5){
	fwrite($gfh, " set y2range [0:*]\n");
	$style2 = "with boxes fill solid";
}

if(in_array($plot1, array(1, 2, 3, 4, 6, 7))){
	$file1 = "wetter.dbk";
}elseif($plot1 == 5 and $period < 3){
	$file1 = "regen_1h.dbk";
	//$file1 = "wetter.dbk";
}elseif($plot1 == 5 and $period > 2){
	$file1 = "regen_1d.dbk";
	//$file1 = "wetter.dbk";
}

if(in_array($plot2, array(1, 2, 3, 4, 6, 8))){
	$file2 = "wetter.dbk";
}elseif($plot2 == 5 and $period < 3){
	$file2 = "regen_1h.dbk";
	//$file2 = "wetter.dbk";
}elseif($plot2 == 5 and $period > 2){
	$file2 = "regen_1d.dbk";
	//$file2 = "wetter.dbk";
}

$spalten = array("", "(\$1+$offset):(\$9)", "(\$1+$offset):(\$2)", "(\$1+$offset):(\$3)", "(\$1+$offset):(\$4)", "(\$1+$offset):(\$2)", "(\$1+$offset):(\$7)", "(\$1+$offset):(\$6)", "(\$1+$offset):(\$8)"); 

$file1 = $workPath.$file1;
fwrite($gfh, " plot \"$file1\" using $spalten[$plot1] lc rgbcolor \"#5D7E7E\" $style1 title \"\"");
if ($plot2 > 0){
	$file2 = $workPath.$file2;
	fwrite($gfh, ", \"$file2\" using $spalten[$plot2] axis x1y2 lc rgbcolor \"#F1A66C\" $style2 title \"\"\n");
}else{
	fwrite($gfh, "\n");
}
fclose($gfh);

if ($platform == "windows"){
	exec("del wetter*.png");
	exec("del rot*wetter*.png");
	exec("C:\\\"Program Files (x86)\"\\gnuplot\\bin\\gnuplot $workPath$gnufile");
}else{
	exec("rm wetter*.png");
	exec("rm rot*wetter*.png");
	exec("gnuplot $gnufile");
}

if ($gui == 1){
	$img_data = file_get_contents($imagefile);
	header("Content-type: image/png");
	echo $img_data;
}else{
	if ($gui == 2) {
		$image = imagecreatefrompng($imagefile);
		$rotatedImageCW = imagerotate($image, -90, 0);
		$rotatedImageCCW = imagerotate($image, 90, 0);
		imagepng($rotatedImageCW, "rotCW_".$imagefile);
		imagepng($rotatedImageCCW, "rotCCW_".$imagefile);
	}
	//echo "$workPath$gnufile\n";
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?><gnuplot><![CDATA[$imagefile]]></gnuplot>";
}

?>
