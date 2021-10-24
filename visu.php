<?php 
	$site_name = "Visualisierung";
	include ("header.php"); 
?>
<script>
    // Inhalt über gesamte Breite
    $(".content").removeClass("content");
</script>
<div class="visunav">
    <a href="?v=year">Jahresansicht</a>
    <select name="meter" id="meter">
        <?php
            $result = $db->query("SELECT `id`, `displayname` FROM `meter`");
            while($row = $result->fetch_assoc()) {
                echo "<option value=" . $row["id"] . ">" . $row['displayname'] . "</option>", PHP_EOL;
            };
        ?>
    </select>
    <?php 
    switch($_GET["v"]){
        // case "year-day":
        //     for ($j=1; $j < 4; $j++) { 
        //         echo "<select id=\"year" . $j . "\"><option value=\"none\">----</option>";
        //         for ($i=date("Y"); $i > date("Y")-15; $i--) { 
        //             echo "<option value=\"" . $i . "\">" . $i . "</option>";
        //         }
        //         echo "</select> ";
        //     }
        //     break;
        case "year":
            for ($j=1; $j < 4; $j++) { 
                echo "<select id=\"year" . $j . "\"><option value=\"none\">----</option>";
                for ($i=date("Y"); $i > date("Y")-15; $i--) { 
                    echo "<option value=\"" . $i . "\">" . $i . "</option>";
                }
                echo "</select> ";
            }
            break;
        // case "month":
        //     for ($j=1; $j < 4; $j++) { 
        //         echo "<select id=\"month" . $j . "\"><option value=\"none\">-------</option>";
        //         for ($i=date("Y"); $i > date("Y")-15; $i--) {
        //             for ($m=0; $m < 13; $m++) {
        //                 if($m<10){
        //                     $m = "0" . strval($m);
        //                 }
        //                 echo "<option value=\"" . $i . "-" . $m . "\">" . $i . "-" . $m . "</option>";
        //             }
        //         }
        //         echo "</select> ";
        //     }
        //     break;
    }
    ?>
</div>
<div class="visuchart">
    <script>
        var options = {
          series: [],
          chart: {
          type: 'bar',
          height: 500
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
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
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: ''
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

        var chart = new ApexCharts(document.querySelector(".visuchart"), options);
        chart.render();
    </script>
    <?php
        switch($_GET["v"]){
            case "year":
                ?>
                    <script>
                        chart.updateOptions({
                            xaxis: {
                                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                },
                        });
                        $("select").change(UpdateData);
                        function UpdateData(){
                            chart.updateOptions({
                                // Chart leeren
                                series: [],
                            });
                            if($("#year1").val() != "none"){
                                var daten1 = [];
                                var date = "";
                                for (let index = 1; index < 13; index++) {
                                    if(index<10){
                                        index = "0" + index.toString();
                                    }
                                    date = $("#year1").val() + "-" + index.toString()
                                    $.get( "visu-backend.php", { v: "month", m: $("#meter").val(), d: date} )
                                        .done(function( data ) {
                                        //alert( "Data Loaded: " + data );
                                        daten1.push(data);

                                    });
                                    
                                }
                                
                                chart.appendSeries({
                                    name: $("#year1").val(),
                                    data: daten1
                                })
                            }
                            if($("#year2").val() != "none"){
                                var daten2 = [];
                                var date = "";
                                for (let index = 1; index < 13; index++) {
                                    if(index<10){
                                        index = "0" + index.toString();
                                    }
                                    date = $("#year2").val() + "-" + index.toString()
                                    $.get( "visu-backend.php", { v: "month", m: $("#meter").val(), d: date} )
                                        .done(function( data ) {
                                        //alert( "Data Loaded: " + data );
                                        daten2.push(data);

                                    });
                                    
                                }
                                
                                chart.appendSeries({
                                    name: $("#year2").val(),
                                    data: daten2
                                })
                            }
                            if($("#year3").val() != "none"){
                                var daten3 = [];
                                var date = "";
                                for (let index = 1; index < 13; index++) {
                                    if(index<10){
                                        index = "0" + index.toString();
                                    }
                                    date = $("#year3").val() + "-" + index.toString()
                                    $.get( "visu-backend.php", { v: "month", m: $("#meter").val(), d: date} )
                                        .done(function( data ) {
                                        //alert( "Data Loaded: " + data );
                                        daten3.push(data);

                                    });
                                    
                                }
                                
                                chart.appendSeries({
                                    name: $("#year3").val(),
                                    data: daten3
                                })
                            }
                            chart.render();
                        };
                    </script>
                <?php
                break;
        }
    ?>
</div>
<?php include("footer.php");?>