<script type="text/javascript" src="./libs/jquery-1.4.js"></script>
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>
<?php
$q=mysql_query("select * from t_kota order by id");
if($ARSESS[0]=='1'){
$strXML = "<graph caption='Data Coverage Area' subCaption='Auto 2000 Cabang Waru Sidoarjo' pieSliceDepth='30' showBorder='1' formatNumberScale='.' numberSuffix=' Customer'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));
}else{
$strXML = "<graph caption='Data Coverage Area' subCaption='Supervisor :$ARSESS[3]' pieSliceDepth='30' showBorder='1' formatNumberScale='.' numberSuffix=' Customer'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
											   left join t_salesman b on b.kode=a.salesman
											   where b.spv='$ARSESS[1]'"));


}

$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");

while($dtq=mysql_fetch_array($q)){	
//if($ARSESS[0]=='1'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
									left join t_kecamatan b on b.id=a.kecamatan
									left join t_kota c on c.id=b.kota where c.id='$dtq[id]'"));
//}else{
//$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
			//						left join t_kecamatan b on b.id=a.kecamatan
				//					left join t_kota c on c.id=b.kota where c.id='$dtq[id]'"));

//}
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