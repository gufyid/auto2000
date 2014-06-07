<script type="text/javascript" src="./libs/jquery-1.4.js"></script>
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>
<?php
mysql_connect("localhost","root","amanda");
mysql_select_db("auto2000");
include ("/../../libs/fusionCharts.php");
$admin=$_GET['admin'];
$status=$_GET['status'];
//	$nama=str_replace("'","",$ARSESS[3]);
if($admin=='1'){
$q=mysql_query("select * from t_salesman order by id");
$cust=mysql_query("select * from t_customer order by salesman");
$total_pencapaian=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));
$strXML = "<graph caption='Monitoring Pencapaian Networking Per Salesman' subCaption='Auto 2000 Cabang Waru' xAxisName='Salesman' yAxisName='Persentasi'>";
}else{
$q=mysql_query("select * from t_salesman where spv='$status' order by id");
$cust=mysql_query("select * from t_customer a
				   left join t_salesman b on b.kode=a.salesman 
				   where b.spv='$status' order by a.salesman");
$total_pencapaian=mysql_fetch_array(mysql_query("select salesman,count(*) as jum from t_customer a
left join t_salesman b on b.kode=a.salesman where b.spv='$status'
"));
$strXML = "<graph caption='Monitoring Pencapaian Networking Per Salesman' subCaption='Supervisor : $status' xAxisName='Salesman' yAxisName='Persentasi'>";
}
$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");

$view="";
$view.="<table>";
$view.="<tr>";
$view.="<th>No</th>";
$view.="<th>Kode Salesman</th>";
$view.="<th>Salesman</th>";
$view.="<th>Customer</th>";
$view.="<th>Alamat</th>";
$view.="<th>Networking</th>";
$view.="</tr>";
while($dtq=mysql_fetch_array($q)){	
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
left join t_salesman b on b.kode=a.salesman 
where a.networking>=3 and b.kode='$dtq[kode]'"));
if($jum['jumlah']>0){
$jumpersen=($jum['jumlah']/$total_pencapaian['jum'])*100;
$strXML .= "<set name='".str_replace("'","",$dtq['kode'])."'  value='".$jumpersen."' color='".$array[array_rand($array)]."'/>";
}
}
$no=0;
while($dtcust=mysql_fetch_array($cust)){
$no++;
$salesman=mysql_fetch_array(mysql_query("select * from t_salesman where kode='$dtcust[salesman]'"));
$view.="<tr>";
$view.="<td>$no</td>";
$view.="<td>$dtcust[salesman]</td>";
$view.="<td>$salesman[nama]</td>";
$view.="<td>$dtcust[nama]</td>";
$view.="<td>$dtcust[alamat]</td>";
$view.="<td>$dtcust[networking]</td>";
$view.="</tr>";

}
$view.="</tr>";
$view.="</table>";
$strXML .= "</graph>";
//echo "Jumlah Data :".$persen['jum1'];
echo "<center>";
echo renderChartHTML("./Charts/Column3D.swf", "", $strXML, "Testing",800, 400,false,true);
echo "</center>";
//echo $view;


?>	