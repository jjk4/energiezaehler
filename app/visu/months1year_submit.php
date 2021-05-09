<?php
$command = escapeshellcmd('python3 months1year.py ' . $_GET["year"] . " " . $_GET["database"]);
//echo($command);
$output = shell_exec($command);
$arr = json_decode($output, true);
//echo($output)

?>
<a href="index.php">Zurück</a>
<div id="chart" style="width: 100%; height: 100%;">
</div>
<script src="apexcharts"></script>
<script>
	var options = {
	  series: [ {
	  name: '',
	  data: [<?php foreach ($arr[0] as $key => $value) {echo $value . ", ";};?>]
	}],
	  chart: {
	  type: 'bar',
	  height: 600
	},
	plotOptions: {
	  bar: {
	    horizontal: false,
	    columnWidth: '55%',
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  categories: [<?php foreach ($arr[1] as $key => $value) {echo "\"" . $value . "\", ";};?>],
	},
	yaxis: {
	  title: {
	    text: 'kWh'
	  }
	},
	fill: {
	  opacity: 1
	},
	tooltip: {
	  y: {
	    formatter: function (val) {
	      return val
	    }
	  }
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
</script>

