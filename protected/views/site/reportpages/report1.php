<?php
	$data = array('1' => 8468193,
		'2' => 8196690,
		'3' => 8389832,
		'4' => 9755049,
		'5' => 9503702,
		'6' => 9281599,
		'7' => 7988226,
		'8' => 8757747,
		'9' => 8875358,
		'10' => 9087173,
		'11' => 10196143,
		'12' => 9598499);
	$mymonth = "";
	$mydata = "";
	$i = 1;
	$j = count($data);
	foreach ($data as $k => $v){
		if($i < $j){
			$c = ",";	
		}else{
			$c = "";	
		}
		$mymonth .= $k . $c;
		$mydata .= $v . $c;
		$i++;
	}
	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>DashBoard Report</title>
<style>

</style>
<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
       		reload: false,
    		close: false,
    		editTitle: false
			//minimize: false
		});

	});
	

	
</script>
</head>

<body>

	<div class="row" style="padding-top:20px; padding-bottom:20px;">
        <div class="col-xl-6">
            <div class="panel panel-info">
        		<div class="panel-heading"><i class="fa fa-bar-chart"></i> Bar Chart</div>
        			<div class="panel-body">
        				<div id="chart_container" style="width:100%; height:auto; margin: 0 auto;"></div>
                    </div>
             </div>          
        
      <script>
      $(function() {
          $('#chart_container').highcharts({
              chart:{
                  type: 'column'
              },
              title: {
                  text: 'กราฟแสดงปริมาณข้อมูล'
              },
              subtitle: {
                  text: 'แบ่งตามเดือน'
              },
              xAxis: {
                  categories: [<?php echo $mymonth; ?>]
                  
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'ปริมาณข้อมูล (หน่วย)'
                  }
              },
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"<b>{point.y:.1f} หน่วย</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              series: [{
                  name: 'ปริมาณข้อมูล',
                  data: [<?php echo $mydata; ?>]
              }],
			  responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							align: 'center',
							verticalAlign: 'bottom',
							layout: 'horizontal'
						},
						yAxis: {
							labels: {
								align: 'left',
								x: 0,
								y: -5
							},
							title: {
								text: null
							}
						},
						subtitle: {
							text: null
						},
						credits: {
							enabled: false
						}
					}
				}]
				}
          });
      });
  </script>
        </div>
        <div class="col-xl-6">
        	<div class="panel panel-info">
        		<div class="panel-heading"><i class="fa fa-pie-chart"></i> Pie Chart</div>
        			<div class="panel-body">
            			<div id="container2" style="min-width: auto; max-width: auto; width:100%; height: auto; margin: 0 auto"></div>
                    </div>
             </div>
             <!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->
            <pre id="tsv" style="display:none">
            Browser Version    Total Market Share
            Microsoft Internet Explorer 8.0    26.61%
            Microsoft Internet Explorer 9.0    16.96%
            Chrome 18.0    8.01%
            Chrome 19.0    7.73%
            Firefox 12    6.72%
            Microsoft Internet Explorer 6.0    6.40%
            Firefox 11    4.72%
            Microsoft Internet Explorer 7.0    3.55%
            Safari 5.1    3.53%
            Firefox 13    2.16%
            Firefox 3.6    1.87%
            Opera 11.x    1.30%
            Chrome 17.0    1.13%
            Firefox 10    0.90%
            Safari 5.0    0.85%
            Firefox 9.0    0.65%
            Firefox 8.0    0.55%
            Firefox 4.0    0.50%
            Chrome 16.0    0.45%
            Firefox 3.0    0.36%
            Firefox 3.5    0.36%
            Firefox 6.0    0.32%
            Firefox 5.0    0.31%
            Firefox 7.0    0.29%
            Proprietary or Undetectable    0.29%
            Chrome 18.0 - Maxthon Edition    0.26%
            Chrome 14.0    0.25%
            Chrome 20.0    0.24%
            Chrome 15.0    0.18%
            Chrome 12.0    0.16%
            Opera 12.x    0.15%
            Safari 4.0    0.14%
            Chrome 13.0    0.13%
            Safari 4.1    0.12%
            Chrome 11.0    0.10%
            Firefox 14    0.10%
            Firefox 2.0    0.09%
            Chrome 10.0    0.09%
            Opera 10.x    0.09%
            Microsoft Internet Explorer 8.0 - Tencent Traveler Edition    0.09%
            </pre>
             <script>
    $(function() {
        // Create the chart
          Highcharts.chart('container2', {
              chart: {
                  type: 'pie'
              },
              title: {
                  text: 'Browser market shares. January, 2018'
              },
              subtitle: {
                  text: 'Click the slices to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
              },
              plotOptions: {
                  series: {
                      dataLabels: {
                          enabled: true,
                          format: '{point.name}: {point.y:.1f}%'
                      }
                  }
              },
          
              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
              },
          
              "series": [
                  {
                      "name": "Browsers",
                      "colorByPoint": true,
                      "data": [
                          {
                              "name": "Chrome",
                              "y": 62.74,
                              "drilldown": "Chrome"
                          },
                          {
                              "name": "Firefox",
                              "y": 10.57,
                              "drilldown": "Firefox"
                          },
                          {
                              "name": "Internet Explorer",
                              "y": 7.23,
                              "drilldown": "Internet Explorer"
                          },
                          {
                              "name": "Safari",
                              "y": 5.58,
                              "drilldown": "Safari"
                          },
                          {
                              "name": "Edge",
                              "y": 4.02,
                              "drilldown": "Edge"
                          },
                          {
                              "name": "Opera",
                              "y": 1.92,
                              "drilldown": "Opera"
                          },
                          {
                              "name": "Other",
                              "y": 7.62,
                              "drilldown": null
                          }
                      ]
                  }
              ],
              "drilldown": {
                  "series": [
                      {
                          "name": "Chrome",
                          "id": "Chrome",
                          "data": [
                              [
                                  "v65.0",
                                  0.1
                              ],
                              [
                                  "v64.0",
                                  1.3
                              ],
                              [
                                  "v63.0",
                                  53.02
                              ],
                              [
                                  "v62.0",
                                  1.4
                              ],
                              [
                                  "v61.0",
                                  0.88
                              ],
                              [
                                  "v60.0",
                                  0.56
                              ],
                              [
                                  "v59.0",
                                  0.45
                              ],
                              [
                                  "v58.0",
                                  0.49
                              ],
                              [
                                  "v57.0",
                                  0.32
                              ],
                              [
                                  "v56.0",
                                  0.29
                              ],
                              [
                                  "v55.0",
                                  0.79
                              ],
                              [
                                  "v54.0",
                                  0.18
                              ],
                              [
                                  "v51.0",
                                  0.13
                              ],
                              [
                                  "v49.0",
                                  2.16
                              ],
                              [
                                  "v48.0",
                                  0.13
                              ],
                              [
                                  "v47.0",
                                  0.11
                              ],
                              [
                                  "v43.0",
                                  0.17
                              ],
                              [
                                  "v29.0",
                                  0.26
                              ]
                          ]
                      },
                      {
                          "name": "Firefox",
                          "id": "Firefox",
                          "data": [
                              [
                                  "v58.0",
                                  1.02
                              ],
                              [
                                  "v57.0",
                                  7.36
                              ],
                              [
                                  "v56.0",
                                  0.35
                              ],
                              [
                                  "v55.0",
                                  0.11
                              ],
                              [
                                  "v54.0",
                                  0.1
                              ],
                              [
                                  "v52.0",
                                  0.95
                              ],
                              [
                                  "v51.0",
                                  0.15
                              ],
                              [
                                  "v50.0",
                                  0.1
                              ],
                              [
                                  "v48.0",
                                  0.31
                              ],
                              [
                                  "v47.0",
                                  0.12
                              ]
                          ]
                      },
                      {
                          "name": "Internet Explorer",
                          "id": "Internet Explorer",
                          "data": [
                              [
                                  "v11.0",
                                  6.2
                              ],
                              [
                                  "v10.0",
                                  0.29
                              ],
                              [
                                  "v9.0",
                                  0.27
                              ],
                              [
                                  "v8.0",
                                  0.47
                              ]
                          ]
                      },
                      {
                          "name": "Safari",
                          "id": "Safari",
                          "data": [
                              [
                                  "v11.0",
                                  3.39
                              ],
                              [
                                  "v10.1",
                                  0.96
                              ],
                              [
                                  "v10.0",
                                  0.36
                              ],
                              [
                                  "v9.1",
                                  0.54
                              ],
                              [
                                  "v9.0",
                                  0.13
                              ],
                              [
                                  "v5.1",
                                  0.2
                              ]
                          ]
                      },
                      {
                          "name": "Edge",
                          "id": "Edge",
                          "data": [
                              [
                                  "v16",
                                  2.6
                              ],
                              [
                                  "v15",
                                  0.92
                              ],
                              [
                                  "v14",
                                  0.4
                              ],
                              [
                                  "v13",
                                  0.1
                              ]
                          ]
                      },
                      {
                          "name": "Opera",
                          "id": "Opera",
                          "data": [
                              [
                                  "v50.0",
                                  0.96
                              ],
                              [
                                  "v49.0",
                                  0.82
                              ],
                              [
                                  "v12.1",
                                  0.14
                              ]
                          ]
                      }
                  ],
				  responsive: {
					rules: [{
						condition: {
							maxWidth: 500
						},
						chartOptions: {
							legend: {
								align: 'center',
								verticalAlign: 'bottom',
								layout: 'horizontal'
							},
							yAxis: {
								labels: {
									align: 'left',
									x: 0,
									y: -5
								},
								title: {
									text: null
								}
							},
							subtitle: {
								text: null
							},
							credits: {
								enabled: false
							}
						}
					}]
					}
              }
          });	
    }); //function
	

</script>
        </div>
    </div>
                
</body>
</html>