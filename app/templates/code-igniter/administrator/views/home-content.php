
<div class="content-main">

	<div class="row-fluid">
		<div class="span9 visible-desktop">
			<h4>Registrants</h4>
			<div id="registrantsChart"></div>

			<br><br><br>

			<h4>Entries</h4>
			<div id="entriesChart"></div>
		</div>

		<div class="span3">

			<h4>Summary</h4>

			<b>Registrants</b>
			<table class="table table-hover table-bordered table-heading">
				<? if($registrants['weekly'] ): $i=0; foreach($registrants['weekly'] as $v ) : ?>
				<tr><td><?=date("M d, Y",strtotime($v[0]))?> </td><td><?=$v[1]?></tr>
				<? endforeach; endif; ?>
			</table>

			<b>Entries</b>
			<table class="table table-hover table-bordered table-heading">
				<? if($entries['weekly'] ): $i=0; foreach($entries['weekly'] as $v ) : ?>
				<tr><td><?=date("M d, Y",strtotime($v[0]))?> </td><td><?=$v[1]?></tr>
				<? endforeach; endif; ?>
			</table>


		</div>
	</div>

</div>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
  
  	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Week', 'Registrants'],
			<? if($registrants['weekly'] ): $i=0; foreach($registrants['weekly'] as $v ) : ?>
			['<?=date("M d, Y",strtotime($v[0]))?>',  <?=$v[1]?>],
			<? endforeach; endif; ?>
		]);

		var options = {
		  fontSize:11,
		  chartArea:{width:'90%'},
		  legend:{position:'none'},
		  vAxis:{minValue:0,maxValue:<?=max($registrants['weekly'])?>,format:'#'}
		};

		var data2 = google.visualization.arrayToDataTable([
			['Week', 'Entries'],
			<? if($entries['weekly'] ): $i=0; foreach($entries['weekly'] as $v ) : ?>
			['<?=date("M d, Y",strtotime($v[0]))?>',  <?=$v[1]?>],
			<? endforeach; endif; ?>
		]);

		var options2 = {
		  fontSize:11,
		  chartArea:{width:'90%'},
		  legend:{position:'none'},
		  vAxis:{minValue:0,maxValue:<?=max($entries['weekly'])?>,format:'#'}
		};


		var chart = new google.visualization.AreaChart(document.getElementById('registrantsChart'));
		chart.draw(data, options);

		var chart2 = new google.visualization.AreaChart(document.getElementById('entriesChart'));
		chart2.draw(data2, options2);
  	}

	$(function(){
		$(window).resize(function(){
			drawChart();			
		})
	})
</script>