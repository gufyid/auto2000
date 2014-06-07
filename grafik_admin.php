		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Pie Chart</title>
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
	<!--<script type="text/javascript" src="./libs/jquery-1.8.2.js"></script>-->
	
		<script type="text/javascript">
//		$(document).ready(function() {
	(function(){	
	var options = {
				chart: {
	                renderTo: 'container1',
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
			yAxis: {
	        title: {
	            text: 'Percentage'
	        }
			},
			
	            title: {
	                text: '7Step Vs Target',
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
                    pointFormat: 'Per Step {point.y} %'
                },
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
	                            return '<b>'+ this.point.y +'</b> %';
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
	                type: 'scatter',
	                name: 'Target',
	                data: [43.3,43.3,16.7,5.6,1.1,1.1],
					marker: {
					radius: 4,
					lineWidth: 2,
					lineColor: Highcharts.getOptions().colors[4],
					fillColor: 'red'
            
			}
	            }

				]
	        }
	        
	        $.getJSON("data_grafik.php", function(json) {
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
	        
	        
      	})();   
		</script>
		<div id="container1" style="min-width: 600px; height: 400px; margin: 0 auto"></div>
