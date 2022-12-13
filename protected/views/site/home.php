<?php
 $this->pageTitle=Yii::app()->name . ' - About';
 $this->breadcrumbs=array(
	'About',
 );
?>
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
	
	//echo Yii::app()->user->getId();
	//echo Yii::app()->user->firstname." ".Yii::app()->user->lastname;
?>


  <div class="main_title_container d-flex flex-column align-items-start justify-content-end">
      <div class="main_subtitle fontcolor1">ENTREPRENEUR ● DATA CENTER </div>
      <div class="main_title">WPD</div>
  </div>
  
	<div class="main_content_scroll mCustomScrollbar" data-mcs-theme="minimal-dark">
    
	<!-- Services-->
    <div class="about_content">
    	<div class="about_title">Description</div>
        <div class="about_text thfont4">
            <p class="thfont4">ระบบ WPD คือ ระบบรวบรวมฐานข้อมูลผู้ประกอบการมาไว้เป็นศูนย์กลาง เพื่อใช้สำหรับให้บริการข้อมูลในรุปแบบของ Web Service ซึ่งจะเชื่อมโยงข้อมูลกับ หน่วยงานภาครัฐอื่นๆ เช่น กรมธุรกิจการค้า, (DBD) เพื่อตอบสนอง แผนการขับเคลื่อนการอำนวยความสะดวกในการประกอบธุรกิจ (Doing Business) และ สามารถดำเนินการรวมขั้นตอนการจดทะเบียนธุรกิจ การจดทะเบียนภาษีมูลค่าเพิ่ม การขึ้นทะเบียนลูกจ้าง ให้สะดวกรวดเร็ว ลดขั้นตอนการดำเนินการของผู้ประกอบการให้ได้รับความสะดวกมากขึ้น.
            </p>
        </div>
        
         <div class="skills">
        	<div class="skills_text">
                <div class="container-fluid">
                    <div class="row" style="padding-top:20px; padding-bottom:20px;">
                        <div class="col-xl-6">
                            
                         <div id="chart_container" style="min-width:310px; height:400px; margin: 0 auto;"></div>   
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
							  }]
						  });
					  });
				  </script>
                        </div>
                        <div class="col-xl-6">
                            <div id="container2" style="min-width: auto; max-width: auto; height: 400px; margin: 0 auto"></div>
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
								  ]
							  }
						  });	
					}); //function
				</script>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--skills-->
        
        <div class="services">
           <div class="services_container d-flex flex-row flex-wrap align-items-start justify-content-start">
        	<!-- Service1 -->
            	<div class="service">
					<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
						<div>
                        	<div class="service_icon">
                        		<!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_10.png" alt="">-->
                                <div style="font-size:50px; color:#666;"><i class="fa fa-bar-chart"></i></div>
                            </div>
                        </div>
						<div class="service_title">Fast coding service</div>
					</div>
					<div class="service_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
					</div>
				</div>
				
            <!-- Service2 -->
            <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div>
                    	<div class="service_icon">
                        	<!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_11.png" alt="">-->
                            <div style="font-size:50px; color:#666;"><i class="fa fa-pie-chart"></i></div>
                        </div>
                    </div>
                    <div class="service_title">Documentations</div>
                </div>
                <div class="service_text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
                </div>
            </div>
            
           </div>
        </div><!--service-->
        					
            <!-- Milestone -->
            <div class="milestone text-center">
                <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_6.png" alt=""></div>
                <div class="milestone_counter" data-end-value="14">0</div>
                <div class="milestone_text">Years of Experience</div>
            </div>

            <!-- Milestone -->
            <div class="milestone text-center">
                <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_7.png" alt=""></div>
                <div class="milestone_counter" data-end-value="1000" data-sign-before="+">0</div>
                <div class="milestone_text">Happy Clients</div>
            </div>

            <!-- Milestone -->
            <div class="milestone text-center">
                <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_8.png" alt=""></div>
                <div class="milestone_counter" data-end-value="14" data-sign-after="k">0</div>
                <div class="milestone_text">Followers on FB</div>
            </div>

            <!-- Milestone -->
            <div class="milestone text-center">
                <div class="milestone_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_9.png" alt=""></div>
                <div class="milestone_counter" data-end-value="732">0</div>
                <div class="milestone_text">Finished Projects</div>
            </div>
            

        </div>
        
        <div class="loaders clearfix" style="padding-bottom:20px;"></div>
        
        
        
       
        
        

    
	<!--	<div class="services"> -->
        
			<!--<div class="services_container d-flex flex-row flex-wrap align-items-start justify-content-start">-->
			<!-- Service1 -->
            	<!--<div class="service">
					<div class="service_title_container d-flex flex-row align-items-center justify-content-start">
						<div><div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_10.png" alt=""></div></div>
						<div class="service_title">Fast coding service</div>
					</div>
					<div class="service_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
					</div>
				</div>-->
				
            <!-- Service2 -->
            <!--<div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div><div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_11.png" alt=""></div></div>
                    <div class="service_title">Documentations</div>
                </div>
                <div class="service_text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
                </div>
            </div>-->

            <!-- Service3 -->
           <!-- <div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div><div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_12.png" alt=""></div></div>
                    <div class="service_title">Online presentations</div>
                </div>
                <div class="service_text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
                </div>
            </div>-->

            <!-- Service4 -->
            <!--<div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div><div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_13.png" alt=""></div></div>
                    <div class="service_title">Online shops</div>
                </div>
                <div class="service_text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
                </div>
            </div>-->

            <!-- Service5 -->
            <!--<div class="service">
                <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                    <div><div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_14.png" alt=""></div></div>
                    <div class="service_title">Video footages</div>
                </div>
                <div class="service_text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
                </div>
            </div>-->

          <!-- Service6 -->
          <!--<div class="service">
              <div class="service_title_container d-flex flex-row align-items-center justify-content-start">
                  <div><div class="service_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/vcard/images/icon_15.png" alt=""></div></div>
                  <div class="service_title">Stock photos</div>
              </div>
              <div class="service_text">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit ame.</p>
              </div>
          </div>-->

		<!--</div><!--services_container-->
						
		<!-- Quote Button -->
		<!--<div class="services_button"><a href="#">Ask for a Quote</a></div>-->

	 <!--  </div><!--services-->
                    
    <!-- End Service -->
    
  </div><!--main_content_scroll-->