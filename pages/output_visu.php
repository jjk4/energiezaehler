<div class="content-lg">
    <iframe id="chart" src="index.php?a=output_chart_monthly" frameborder="0" style="border:0; width: 100%; height:82vh;" allowfullscreen></iframe>
    <!-- Zähler auswählen -->
    <div class="form-group">
        <label for="zaehler">Zähler</label>
        <select class="form-control" id="zaehler">
            <?php
                foreach($data["zaehler"] as $zaehler_id=>$zaehler){
                    echo "<option value='".$zaehler["id"]."'>".$zaehler["name"]."</option>";
                }
            ?>
        </select>
    </div>
    <!-- Checkboxen für jedes Jahr -->
    <div class="form-group">
        <label for="years">Jahre</label>
        <div class="checkbox">
            <?php
                foreach($data["years"] as $year){
                    echo "<label style=\"margin-right: 2em;\"><input class=\"year-checkbox\" type='checkbox' value='".$year."'> ".$year."</label>";
                }
            ?>
        </div>
    </div>
</div>
<script>
    // Funktion zum Laden des Charts
    function loadChart(){
        var years = [];
        var zaehler_id = document.getElementById('zaehler').value;
        var years = document.getElementsByClassName('year-checkbox');
        var years_selected = [];
        for(var i = 0; i < years.length; i++){
            if(years[i].checked){
                years_selected.push(years[i].value);
            }
        }
        document.getElementById('chart').src = "index.php?a=output_chart_monthly&y=" + years_selected.join(",") + "&z=" + zaehler_id;
    }
    $( "#zaehler, .year-checkbox" ).change(function() {
        loadChart();
    });
</script>