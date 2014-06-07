<?php
function kekata($x) {
$x = abs($x);
$angka = array("", "Satu", "Dua", "Tiga", "Empat", "Lima",
"Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
$temp = "";
if ($x <12) {
$temp = " ". $angka[$x];
} else if ($x <20) {
$temp = kekata($x - 10). " Belas";
} else if ($x <100) {
$temp = kekata($x/10)." Puluh". kekata($x % 10);
} else if ($x <200) {
$temp = " seratus" . kekata($x - 100);
} else if ($x <1000) {
$temp = kekata($x/100) . " Ratus" . kekata($x % 100);
} else if ($x <2000) {
$temp = " seribu" . kekata($x - 1000);
} else if ($x <1000000) {
$temp = kekata($x/1000) . " Ribu" . kekata($x % 1000);
} else if ($x <1000000000) {
$temp = kekata($x/1000000) . " Juta" . kekata($x % 1000000);
} else if ($x <1000000000000) {
$temp = kekata($x/1000000000) . " Milyar" . kekata(fmod($x,1000000000));
} else if ($x <1000000000000000) {
$temp = kekata($x/1000000000000) . " Trilyun" . kekata(fmod($x,1000000000000));
}
return $temp;
}

function tkoma($x){
$x=stristr($x,'.');
$angka=array("Nol","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan");

$temp="";
$pjg=strlen($x);
$pos=1;

while($pos<$pjg){
$char=substr($x,$pos,1);
$pos++;
$temp.=" ".$angka[$char];
}
return $temp;
}

function terbilang($x){
if($x<0){
$hasil="minus".trim(kekata($x));
}else{
$point =trim(tkoma($x));
$hasil=trim(kekata($x));
}
if($point){
$hasil=ucfirst($hasil).'&nbsp;Koma&nbsp;'.$point;
}else{
$hasil=ucfirst($hasil);
}
return $hasil;
}
?>
