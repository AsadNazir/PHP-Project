<div class="d-flex CowProfileCard CowDietCard">
    <div class="DietPlans">
        <h1>
            Current Diet Plan
        </h1>
        <div>
            <h1>Feed</h1><span>
                <!-- All the Feed will come here dynamically -->
                <p>
                    <?php
                    echo "Feed 1<br>";
                    echo "Feed 2<br>";
                    echo "Feed 3<br>";
                    ?>
                </p>
            </span>
        </div>
    </div>
    <div class="DietGraph">
        <canvas class="DietPlanChart"></canvas>
    </div>


</div>

<script>
    // Data for the pie chart
    var data = {
        labels: ['Red', 'Blue', 'Yellow', 'Green'],
        datasets: [{
            data: [12, 19, 3, 5],
            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']
        }]
    };

    // Configuration options
    var options = {
        responsive: true,
        maintainAspectRatio: false
    };

    // Create the pie chart
    var ctx = document.querySelector('.DietPlanChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });

</script>