<script type="text/javascript" src="./libs/jquery-1.4.js"></script>
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>
<?php
include ("./libs/fusionCharts.php");
$q=mysql_query("select * from t_kota order by id");
$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");
//$strXML = "<graph caption='Summary 7Step' subCaption='Auto 2000 Cabang Waru' xAxisName='7Step' yAxisName='Persentasi'>";
    $strXML = "<graph caption='' subCaption='' pieSliceDepth='30' showBorder='1' formatNumberScale='.' numberSuffix=' Customer'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));

while($dtq=mysql_fetch_array($q)){	

$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
									left join t_kecamatan b on b.id=a.kecamatan
									left join t_kota c on c.id=b.kota where c.id='$dtq[id]'"));

if($jum['jumlah']>0){
//$jumpersen=($jum['jumlah']/$total_kunjungan['jum'])*100;
$jumpersen=$jum['jumlah'];

$strXML .= "<set name='".$dtq['nama']."'  value='".$jumpersen."' color='".$array[array_rand($array)]."'/>";
}
}
$strXML .= "</graph>";
//echo "Jumlah Data :".$persen['jum1'];
echo "<center>";
echo renderChartHTML("./Charts/FCF_Pie3D.swf", "", $strXML, "", 800, 600,false,true);
echo "</center>";

?>