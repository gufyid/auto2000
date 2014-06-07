<style type="text/css"/>
table, td{
	font:100% Arial, Helvetica, sans-serif; 
}
table{width:100%;border-collapse:collapse;margin:1em 0;}
td{text-align:left;padding:.5em;border:1px solid #fff;}
th{text-align:center;padding:.5em;border:1px solid #fff;}
th{background:#328aa4 url(../images/tr_back.gif) repeat-x;color:#fff;}
td{background:#e5f1f4;}

/* tablecloth styles */

tr.even td{background:#e5f1f4;}
tr.odd td{background:#f8fbfc;}

th.over, tr.even th.over, tr.odd th.over{background:#4a98af;}
th.down, tr.even th.down, tr.odd th.down{background:#bce774;}
th.selected, tr.even th.selected, tr.odd th.selected{}

td.over, tr.even td.over, tr.odd td.over{background:#ecfbd4;}
td.down, tr.even td.down, tr.odd td.down{background:#bce774;color:#fff;}
td.selected, tr.even td.selected, tr.odd td.selected{background:#bce774;color:#555;}

/* use this if you want to apply different styleing to empty table cells*/
td.empty, tr.odd td.empty, tr.even td.empty{background:#fff;}
</style>

<script type="text/javascript" src="./libs/jquery-1.4.js"></script>
<script type="text/javascript" src="./libs/jquery.fusioncharts.js"></script>
<script type="text/javascript" src="./libs/FusionCharts.js"></script>

<?php
include ("./libs/fusionCharts.php");

echo "<center><h1>STATISTIK SYSTEM</h1></center>";
myconn();
$salesman=mysql_fetch_array(mysql_query("select count(*) as jum from t_salesman"));
$supervisor=mysql_fetch_array(mysql_query("select count(*) as jum from t_supervisor"));
$customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));
echo "<ul>";
echo "<li><h3>Jumlah Salesman : $salesman[jum] Orang</h3></li>";
echo "<li><h3>Jumlah Supervisor : $supervisor[jum] Orang</h3></li>";
//echo "<li><h3>Jumlah Customer : $customer[jum] Customer</h3></li>";
echo "</ul>";
//$strXML = "<graph caption='Summary 7Step' subCaption='Supervisor : $ARSESS[3]' xAxisName='7Step' yAxisName='Persentasi'>";
$q=mysql_query("select * from t_sevenstep order by id");
$array=array("1941A5" , "AFD8F8", "F6BD0F", "8BBA00", "A66EDD", "F984A1", "CCCC00", "999999", "0099CC", "FF0000", "006F00", "0099FF", "FF66CC", "669966", "7C7CB4", "FF9933", "9900FF", "99FFCC", "CCCCFF", "669900");
if($ARSESS[8]=='2'){

}elseif($ARSESS[8]=='3'){
$strXML = "<graph caption='Summary 7Step' subCaption='Supervisor : $ARSESS[3]' xAxisName='7Step' yAxisName='Persentasi'>";
$total_kunjungan=mysql_fetch_array(mysql_query("select count(*) as jum from t_kunjungan a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where c.kode='$ARSESS[1]'"));
}elseif($ARSESS[8]=='4'){
$strXML = "<graph caption='Summary 7Step' subCaption='Salesman : $ARSESS[3]' xAxisName='7Step' yAxisName='Persentasi'>";
$total_kunjungan=mysql_fetch_array(mysql_query("select count(*) as jum from t_kunjungan where salesman='$ARSESS[1]'"));
}
while($dtq=mysql_fetch_array($q)){	
if($ARSESS[8]=='2'){

}elseif($ARSESS[8]=='3'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_kunjungan a
left join t_salesman b on b.kode=a.salesman 
left join t_supervisor c on c.kode=b.spv where a.sevenstep='$dtq[id]' and c.kode='$ARSESS[1]'"));
}elseif($ARSESS[8]=='4'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_kunjungan a
left join t_salesman b on b.kode=a.salesman 
where a.sevenstep='$dtq[id]' and b.kode='$ARSESS[1]'"));
}

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
