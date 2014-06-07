<!--<script type="text/javascript" src="./libs/jquery-1.4.js"></script>-->	
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>
<?php
include ("./libs/fusionCharts.php");
$nama=str_replace("'","",$ARSESS[3]);
$q=mysql_query("select * from t_sevenstep order by id");
$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");
$strXML = "<graph caption='Summary 7Step' subCaption='Supervisor : $nama' xAxisName='7Step' yAxisName='Persentasi'>";
$total_kunjungan=mysql_fetch_array(mysql_query("select count(*) as jum from t_kunjungan a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where c.kode='$ARSESS[1]'"));

while($dtq=mysql_fetch_array($q)){	

$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_kunjungan a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where a.sevenstep='$dtq[id]' and c.kode='$ARSESS[1]'"));

if($jum['jumlah']>=0){
$jumpersen=($jum['jumlah']/$total_kunjungan['jum'])*100;
$strXML .= "<set name='".$dtq['nama']."'  value='".$jumpersen."' color='".$array[array_rand($array)]."'/>";
}
}
$strXML .= "</graph>";
//echo "Jumlah Data :".$persen['jum1'];
echo "<center>";
echo renderChartHTML("./Charts/Column3D.swf", "", $strXML, "Testing", 600, 400,false,true);
echo "</center>";



?>