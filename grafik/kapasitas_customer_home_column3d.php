<!--<script type="text/javascript" src="./libs/jquery-1.4.js"></script>-->
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>
<?php
include ("./libs/fusionCharts.php");
$nama=str_replace("'","",$ARSESS[3]);
myConn();
if($ARSESS[0]=='1'){
$q=mysql_query("select * from t_customer order by salesman");
$strXML = "<graph caption='Data Kapasitas Customer' subCaption='Auto 2000 Cabang Waru : $nama' xAxisName='Score' yAxisName='Persentasi'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));
}else{
$q=mysql_query("select * from t_customer a
				left join t_salesman b on b.kode=a.salesman
				where b.spv='$ARSESS[1]' order by a.salesman");
$strXML = "<graph caption='Data Kapasitas Customer' subCaption='Supervisor : $nama' xAxisName='Score' yAxisName='Persentasi'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where c.kode='$ARSESS[1]'"));
}

//$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");
$array=array("FF0000" , "FFFF00", "008E00");
$warna=array("Red","Yellow","Green");
$x=count($warna);
$view="";
$view.="<table>";
$view.="<tr>";
$view.="<th>No</th>";
$view.="<th>Salesman</th>";
$view.="<th>Customer</th>";
$view.="<th>Contact</th>";
$view.="<th>Alamat</th>";
$view.="<th>Score</th>";
$no=0;
for($i=0;$i<=$x-1;$i++){
$dtq=mysql_fetch_array($q);	
$no++;
if($ARSESS[0]=='1'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer where score='$warna[$i]'"));
}else{
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where a.score='$warna[$i]' and c.kode='$ARSESS[1]'"));
}
if($jum['jumlah']>=0){
$jumpersen=($jum['jumlah']/$total_customer['jum'])*100;
//$strXML .= "<set name='".$warna[$i]."'  value='".$jumpersen."' color='".$array[array_rand($array)]."'/>";
if($i==0){
$strXML .= "<set name='".$warna[$i]."'  value='".$jumpersen."' color='".$array[0]."'/>";
}elseif($i==1){
$strXML .= "<set name='".$warna[$i]."'  value='".$jumpersen."' color='".$array[1]."'/>";
}else{
$strXML .= "<set name='".$warna[$i]."'  value='".$jumpersen."' color='".$array[2]."'/>";
}
}

$salesman_nama=mysql_fetch_array(mysql_query("select * from t_salesman where kode='$dtq[salesman]'"));

$view.="<tr>";
$view.="<td>$no</td>";
$view.="<td>$salesman_nama[nama]</td>";
$view.="<td>$dtq[nama]</td>";
$view.="<td>$dtq[contact]</td>";
$view.="<td>$dtq[alamat]</td>";
$view.="<td>$dtq[score]</td>";
$view.="</tr>";

}
$view.="</tr>";
$view.="</table>";

$strXML .= "</graph>";
//echo "Jumlah Data :".$persen['jum1'];
echo "<center>";
echo renderChartHTML("./Charts/Column3D.swf", "", $strXML, "Testing", 500, 400,false,true);
echo "</center>";
//echo $view;
//echo $_GET['salesman'];


?>