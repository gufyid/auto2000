		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Pie Chart</title>
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
		<script type="text/javascript" src="./libs/jquery-1.8.2.js"></script>
		
		<script type="text/javascript">
		$(document).ready(function() {
			var options = {
				chart: {
	                renderTo: 'containerreport',
	                plotBackgroundColor: null,
	                plotBorderWidth: null,
	                plotShadow: false
					
	            },
			
				/*
				        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
			},
			*/
			
				        xAxis: {
            categories: []
			},
			
	            title: {
	                text: '7Step Vs Target',
	            },


	            plotOptions: {
	                spline: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: false,
	                        color: '#000000',
	                        connectorColor: '#000000',
	                        formatter: function() {
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
	                        }
	                    }
	                },
					column: {
	                    allowPointSelect: true,
	                    cursor: 'pointer',
	                    dataLabels: {
	                        enabled: false,
	                        color: '#000000',
//							color: (Highcharts.theme && Highcharts.theme.textColor) || 'black',
							connectorColor: '#000000',
	                        formatter: function() {
	                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
	                        }
	                    }
	                }
	            },
	            series: [{
	                type: 'column',
	                name: 'Jumlah 7Step',
	                data: [],
			},
				{
	                type: 'spline',
	                name: 'Patern Per 7Step',
	                data: [2,5,2,5,2,3,1],
					marker: {
					lineWidth: 2,
					lineColor: Highcharts.getOptions().colors[4],
					fillColor: 'white'
            
			}
	            }

				]
	        }
	        
	        $.getJSON("data_grafik_spv.php",
				{
				 X:'<?php echo $ARSESS[1]?>'
				},
			function(json) {
				options.series[0].data = json;
	        	chart = new Highcharts.Chart(options);
	        })
			/*
			,
	        $.getJSON("data.php", function(json) {
				options.series[1].data = json;
	        	chart = new Highcharts.Chart(options);
	        });
	        */
	        
	        
      	});   
		</script>
<script src="./libs/highcharts.js"></script>
<script src="./libs/exporting.js"></script>
		<div id="containerreport" style="min-width: 500px; height: 400px; margin: 0 auto"></div>
<?php

?>