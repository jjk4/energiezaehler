<?php
$site_name = "";
include ("header.php");
$config = include('../../config.php');
$database = $config['database'];
$host = $config['host'];
$port = $config['port'];
$zaehler = $_GET["database"];
$command = escapeshellcmd('python3 months1year.py ' . $host . " " . $port . " " . $database . " " . $_GET["year"] . " " . $zaehler);
//echo($command);
$output = shell_exec($command);
$arr = json_decode($output, true);
//echo($command)
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
	    text: '<?php echo($config['zaehler'][$zaehler]['unit']);?>'
	  }
	},
	fill: {
	  opacity: 1
	},
	tooltip: {
	  y: {
	    formatter: function (val) {
	      return val + " <?php echo($config['zaehler'][$zaehler]['unit']);?>"
	    }
	  }
	}
	};

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
</script>

