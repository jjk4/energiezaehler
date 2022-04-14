<canvas id="myChart"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
        datasets: [
            <?php
                $i = 0;
                foreach($data["data"] as $key=>$value){
                    echo "{
                        label: '".$key."',
                        data: [".implode(",", $value)."],
                        backgroundColor: '".$data["colors"][$i][1]."',
                        borderColor: '".$data["colors"][$i][0]."',
                        borderWidth: 1
                    },";
                    $i++;
                }
            ?>
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>