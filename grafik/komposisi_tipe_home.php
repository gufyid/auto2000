
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<script type="text/javascript">
$(function () {
    $('#container4').highcharts({
        chart: {
            type: 'column',
            options3d: {
				enabled: true,
                alpha: 45,
                beta: 0
            }
        },
//						colors :['#ff0000','#ffff00','#009900'],

        title: {
            text: 'Grafik Komposisi Tipe Produk'
        },
				   xAxis: {
						     categories: []
			},
		yAxis: {
	        title: {
	            text: 'Percentage'
	        }
			},
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        plotOptions: {
				scatter: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
						dashStyle: 'square',
						depth: 35,
	                    dataLabels: {
	                        enabled: true,
	                        color: '#ff0000',
	                        connectorColor: '#000000',
	                        formatter: function() {
						return '<b>'+ this.point.y +'</b> %';										}
	                    },
						 tooltip: {
                    pointFormat: 'Per Tipe {point.y} %'
                },
	                },

            column: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false,
                    format: '{point.y}'
                }
            }
        },
        series: [{
            type: 'column',
            name: 'Komposisi Tipe',
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

$produk=mysql_query("select * from t_produk");
$rows = array();
while($dtq=mysql_fetch_array($produk)){

if($ARSESS[0]=='1'){
$jum=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer where tipe='$dtq[id]'"));
}else{
$jum=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
left join t_salesman b on b.kode=a.salesman 
where b.spv='$ARSESS[1]' and a.tipe='$dtq[id]'"));

}
$persen=number_format(($jum[0]/$total_cust['jum'])* 100,2);						  
	$row[0] = $dtq['nama'];
	$row[1] = $persen;
	array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);
mysql_close($con);
?> 

        },
				{
	                type: 'scatter',
	                name: 'Target',
	                data: [18.4,3.0,5.9,2.2,21.2,49.2],
					marker: {
					radius: 4,
					lineWidth: 2,
					lineColor: Highcharts.getOptions().colors[4],
					fillColor: 'red'
            
			}
	            }]
    });
});
		</script>
	
<div id="container4" style="width: 500px;height: 400px"></div>
	