
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<script type="text/javascript">
$(function () {
    $('#container3').highcharts({
        chart: {
            type: 'pie',
            options3d: {
				enabled: true,
                alpha: 45,
                beta: 0
            }
        },
			colors :['#ff0000','#ffff00','#009900'],
        title: {
            text: 'Grafik Kapasitas Customer (Score)'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Score Customer',
            data: <?php
$con = mysql_connect("localhost","root","amanda");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("auto2000", $con);

if($ARSESS[0]=='1'){
$total_cust=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));
}else{
$total_cust=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
									left join t_salesman b on b.kode=a.salesman
									where b.spv='$ARSESS[1]'"));
}

$warna=array("Red","Yellow","Green");
$x=count($warna);
$rows = array();
for($i=0;$i<=$x-1;$i++){
//$r = mysql_fetch_array($result);
if($ARSESS[0]=='1'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer where score='$warna[$i]'"));
}else{
$jum=mysql_fetch_array(mysql_query("select count(*) as jumlah from t_customer a
									left join t_salesman b on b.kode=a.salesman 
									where a.score='$warna[$i]' and b.spv='$ARSESS[1]'"));
}
$persen=number_format(($jum[0]/$total_cust['jum'])* 100,2);						  

	$row[0] = $warna[$i];
	$row[1] = $persen;
	array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
mysql_close($con);
?> 

        }]
    });
});
		</script>
	
<div id="container3" style="height: 400px"></div>
	