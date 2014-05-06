<!DOCTYPE html>
<!-- saved from url=(0040)http://www.jacklmoore.com/demo/tabs.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bently Systems</title>
		<link rel="stylesheet" type="text/css" href="style.css">		

		<link rel="stylesheet" type="text/css" href="dist/jquery.jqplot.css" />
		
		<script src="./project_files/jquery.min.js"></script>
		<script>
			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){			
				//ETHAN:change these dummy variables to take the results of the PHP queries
				//ideally we'll be able to alter the number of variables that we read in, but I realize that that may not be possible
			    var s1 = [30,50,43,14, 26,76];
			    //ETHAN: ideally these values will also be read in, and can also be file names
			    var ticks = ['Jan','Feb','Mar','Apr','May','June'];
			    var plot1 = $.jqplot('plot1', [s1], {
						height: 400,
						width: 600,
						seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#17BDB8'],
				        seriesDefaults:{
			            renderer:$.jqplot.BarRenderer,
			            rendererOptions: {fillToZero: true, varyBarColor: true},
						pointLabels: { show:true } 
			        },
			
			        series:[
			            {label:'Frequency'},
			        ],
			 
			        legend: {
			            show: false
			        },
			        axes: {
			
			            xaxis: {
			                renderer: $.jqplot.CategoryAxisRenderer,
			                ticks: ticks,
							label: 'audit_type_id'
			            },
			 
			            yaxis: {
			                pad: 1.05,
							min: 0,
							max: 100,
			                tickOptions: {formatString: '%d'},
							label: 'num'
			            }
			        }
			    });
			    
			    
			    //ETHAN: ideally these values will also be read in, and can also be file names
				
				//input php scripts here and do everything in line in the same file.
				<?php
				$arrayX=array();
				$arrayY=array();
				$serverName = "2CE12909L0\ANALYTICS";
				$connectionOptions = array("Database"=>"GCC_ANALYTICS");

				/* Connect using Windows Authentication. */
				$conn = sqlsrv_connect( $serverName, $connectionOptions);
				if( $conn ) {
					// echo "Connection established.<br />";
				}else{
					 //echo "Connection could not be established.<br />";
					 die( print_r( sqlsrv_errors(), true));
				}
				$sql = "select top 10 as_id, count(*) as 'num' from tblAuditLog where as_id is not null group by as_id order by num desc";
				$stmt = sqlsrv_query($conn, $sql);
				if($stmt == false)
				{
					die(print_r(sqlsrv_errors(),true));
				}
				//echo "<table border='1'> <tr> <th> as_id </th> <th>num</th> </tr>";
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
				{
				  //$arrayX['as_id'] = $row['as_id'];
				  //$arrayY['num'] = $row['num'];
				  //echo "<tr>";
				  //echo "<td>" . $row['as_id']. "</td>";
				  //echo "<td>".$row['num']."</td>";
				  array_push($arrayX,$row['as_id']);
				  array_push($arrayY,$row['num']);
				}
				
				?>
				
				
			    var ticks2 = <?php echo "[".implode(",",$arrayX)."];"; ?>
				var s2 = <?php echo "[".implode(",",$arrayY)."];"; ?>

				var plot2 = $.jqplot('plot2', [s2], {
						height: 400,
						width: 600,
						seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#17BDB8'],
					    seriesDefaults:{
			            renderer:$.jqplot.BarRenderer,
			            rendererOptions: {fillToZero: true, varyBarColor: true},
						pointLabels: { show:true } 
			        },
			
			        series:[
			            {label:'Frequency'},
			        ],
			 
			        legend: { 
						show:false
					},
			        axes: {
			
			            xaxis: {
			                renderer: $.jqplot.CategoryAxisRenderer,
			                ticks: ticks2,
							label: 'as_id'
			            },
			 
			            yaxis: {
			                pad: 1.05,
							min: 0,
							max: 6000,
			                tickOptions: {formatString: '%d'},
							label: 'num'
			            }
			        }
			    });
				<?php
				$arrayX1 = array();
				$arrayY1 = array();
				$sql = "select top 10  audit_type_id, count(*) as 'num' from tblAuditLog group by audit_type_id order by num desc";
				$stmt = sqlsrv_query($conn, $sql);
				if($stmt == false)
				{
					die(print_r(sqlsrv_errors(),true));
				}
				//echo "<table border='1'> <tr> <th> as_id </th> <th>num</th> </tr>";
				while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
				{
				  //$arrayX['as_id'] = $row['as_id'];
				  //$arrayY['num'] = $row['num'];
				  //echo "<tr>";
				  //echo "<td>" . $row['as_id']. "</td>";
				  //echo "<td>".$row['num']."</td>";
				  array_push($arrayX1,$row['audit_type_id']);
				  array_push($arrayY1,$row['num']);
				}
				?>

				var ticks3 = <?php echo "[".implode(",",$arrayX1)."];"; ?>
				var s3 = <?php echo "[".implode(",",$arrayY1)."];"; ?>

			
				var plot3 = $.jqplot('plot3', [s3], {
						height: 400,
						width: 600,
						seriesColors:['#85802b', '#00749F', '#73C774', '#C7754C', '#17BDB8'],
					    seriesDefaults:{
			            renderer:$.jqplot.BarRenderer,
			            rendererOptions: {fillToZero: true, varyBarColor: true},
						pointLabels: { show:true } 
			        },
			
			        series:[
			            {label:'Frequency'},
			        ],
			 
			        legend: {
			            show: false
			        },
			        axes: {
			
			            xaxis: {
			                renderer: $.jqplot.CategoryAxisRenderer,
			                ticks: ticks3,
							label: 'audit_type_id'
			            },
			 
			            yaxis: {
			                pad: 1.05,
							min: 0,
							max: 175000,
			                tickOptions: {formatString: '%d'},
							label: 'num'
			            }
			        }
			    });
				
								$('ul.tabrow').each(function(){
					// For each set of tabs, we want to keep track of
					// which tab is active and it's associated content
					var $active, $content, $links = $(this).find('a');

					// If the location.hash matches one of the links, use that as the active tab.
					// If no match is found, use the first link as the initial active tab.
					$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					$active.addClass('active');

					$content = $($active[0].hash);

					// Hide the remaining content
					$links.not($active).each(function () {
						$(this.hash).hide();
					});

					// Bind the click event handler
					$(this).on('click', 'a', function(e){
						// Make the old tab inactive.
						$active.removeClass('active');
						$content.hide();

						// Update the variables with the new link and content
						$active = $(this);
						$content = $(this.hash);

						// Make the tab active.
						$active.addClass('active');
						$content.show();
						
						if($active[0].hash === '#tab1')
						{
							plot1.replot();
						}
						else if($active[0].hash === '#tab2')
						{
							plot2.replot();
						}
						else if($active[0].hash === '#tab3')
						{
							plot3.replot();
						}
						
						// Prevent the anchor's default click action
						e.preventDefault();
					});
				});

				
			});
		</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>
			$(function() {
				$("li").click(function(e) {
				  e.preventDefault();
				  $("li").removeClass("selected");
				  $(this).addClass("selected");
				});
			});
		</script>
	<style type="text/css">
	</style></head>
	<body>
	
	
	<script src="dist/jquery.jqplot.js"></script>
	
	
	<script type="text/javascript" src="dist/plugins/jqplot.barRenderer.min.js"></script>
	<script type="text/javascript" src="dist/plugins/jqplot.categoryAxisRenderer.min.js"></script>
	<script type="text/javascript" src="dist/plugins/jqplot.pointLabels.min.js"></script>
	<script type="text/javascript" src="dist/plugins/jqplot.json2.min.js"></script>
	
	
	<a href="project.htm">
		<img src="http://www.bentley.com/BentleyWebSite/Images/common/bentley-logo.gif" alt="Bentley" style ="width:210px; height:65px; border:0;" id="topLogo">
	</a>
	<ul class="tabrow">
			<li class="selected"><a href="#tab1" class="active">Features of User</a></li>
			<li><a href="#tab2">Most Used Features</a></li>
			<li><a href="#tab3">Specific Feature</a></li>
		</ul>
		<div id="tab1" class="main">
			<h3>Features of User</h3>
			<div id="plot1" class="plot"></div>
		</div>
		<div id="tab2" class="main" style="display: none;">
			<h3>Most Used Features</h3>
			<div id="plot2" class="plot"></div>
			</div>
		<div id="tab3" class="main" style="display: none;">
			<h3>Specific Feature</h3>
			<div id="plot3" class="plot"></div>
		</div>
	
</body></html>