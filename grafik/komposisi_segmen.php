<script type="text/javascript" src="./libs/jquery-1.4.js"></script>
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>
<?php
include ("../libs/fusionCharts.php");
$nama=str_replace("'","",$ARSESS[3]);
$salesman=$_GET['salesman'];
myConn();
if($user=='1'){
if($salesman=='all'){
$q=mysql_query("select * from t_customer order by salesman");
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));
$strXML = "<graph caption='Data Komposisi Segmen' subCaption='Auto 2000 Cabang Waru' xAxisName='Segmen' yAxisName='Persentasi'>";
}else{
$q=mysql_query("select * from t_customer where salesman ='$salesman' order by salesman");
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer where salesman ='$salesman'"));
$strXML = "<graph caption='Data Komposisi Segmen' subCaption='Salesman : $salesman' xAxisName='Segmen' yAxisName='Persentasi'>";
}

}else{
if($salesman=='all'){
$q=mysql_query("select * from t_customer a
				left join t_salesman b on b.kode=a.salesman
				where b.spv='$spv' order by a.salesman");
$strXML = "<graph caption='Data Komposisi Segmen' subCaption='Supervisor : $spv' xAxisName='Segmen' yAxisName='Persentasi'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where c.kode='$spv'"));
}else{
$q=mysql_query("select * from t_customer a
				left join t_salesman b on b.kode=a.salesman
				where b.spv='$spv' and a.salesman='$salesman' order by a.salesman");
$strXML = "<graph caption='Data Komposisi Segmen' subCaption='Salesman : $salesman' xAxisName='Segmen' yAxisName='Persentasi'>";
$total_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where c.kode='$spv' and b.kode='$salesman'"));

}
}

$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");
$segmen=array("1","2","3");
$x=count($segmen);
$view="";
$view.="<table>";
$view.="<tr>";
$view.="<th>No</th>";
$view.="<th>Salesman</th>";
$view.="<th>Customer</th>";
$view.="<th>Contact</th>";
$view.="<th>Alamat</th>";
$view.="<th>Segmen</th>";
$no=0;

for($i=0;$i<=$x-1;$i++){
$dtq=mysql_fetch_array($q);	
$no++;
if($user=='1'){
if($salesman=='all'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer where segmen='$segmen[$i]'"));
}else{
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer where segmen='$segmen[$i]' and salesman='$salesman'"));
}
}else{
if($salesman=='all'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where a.segmen='$segmen[$i]' and c.kode='$spv'"));
}else{
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where a.segmen='$segmen[$i]' and c.kode='$spv' and a.salesman='$salesman'"));

}
}
if($jum['jumlah']>=0){
$jumpersen=($jum['jumlah']/$total_customer['jum'])*100;
$strXML .= "<set name='Segmen ".$segmen[$i]."'  value='".$jumpersen."' color='".$array[array_rand($array)]."'/>";
}

$salesman_nama=mysql_fetch_array(mysql_query("select * from t_salesman where kode='$dtq[salesman]'"));

$view.="<tr>";
$view.="<td>$no</td>";
$view.="<td>$salesman_nama[nama]</td>";
$view.="<td>$dtq[nama]</td>";
$view.="<td>$dtq[contact]</td>";
$view.="<td>$dtq[alamat]</td>";
$view.="<td>$dtq[segmen]</td>";
$view.="</tr>";
}
$view.="</tr>";
$view.="</table>";

$strXML .= "</graph>";
//echo "Jumlah Data :".$persen['jum1'];
echo "<center>";
echo renderChartHTML("./Charts/Column3D.swf", "", $strXML, "Testing", 800, 400,false,true);
echo "</center>";

?>