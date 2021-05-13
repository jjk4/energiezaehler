<?php
$config = include('../config.php');
$database = $config['database'];
$host = $config['host'];
$port = $config['port'];
$year1 = $_GET["year1"];
$year2 = $_GET["year2"];
$year3 = $_GET["year3"];
$zaehler = $_GET["database"];
$command1 = escapeshellcmd('python3 3months.py ' . " " . $host . " " . $port . " " . $database . " " . $year1 . " " . $zaehler);
$command2 = escapeshellcmd('python3 3months.py ' . " " . $host . " " . $port . " " . $database . " " . $year2 . " " . $zaehler);
$command3 = escapeshellcmd('python3 3months.py ' . " " . $host . " " . $port . " " . $database . " " . $year3 . " " . $zaehler);
//echo($command1);
$output1 = shell_exec($command1);
$output2 = shell_exec($command2);
$output3 = shell_exec($command3);
$arr1 = json_decode($output1, true);
$arr2 = json_decode($output2, true);
$arr3 = json_decode($output3, true);

//echo($command1);

?>
<a href="index.php">Zurück</a>
<div id="chart" style="width: 100%; height: 100%;">
</div>
<script src="apexcharts"></script>
<script>
	var options = {
	  series: [ {
	  name: '<?php echo($year1);?>',
	  data: [<?php foreach ($arr1[0] as $key => $value) {echo $value . ", ";};?>]
	}, {
	  name: '<?php echo($year2);?>',
	  data: [<?php foreach ($arr2[0] as $key => $value) {echo $value . ", ";};?>]
	}, {
	  name: '<?php echo($year3);?>',
	  data: [<?php foreach ($arr3[0] as $key => $value) {echo $value . ", ";};?>]
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
	  categories: [<?php foreach ($arr1[1] as $key => $value) {echo "\"" . $value . "\", ";};?>],
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

