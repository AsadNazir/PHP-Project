<div class="d-flex CowProfileCard CowDietCard">
    <div class="DietPlans DietPlanAndFeed">
        <h1>
            Current Diet Plan
        </h1>
        <div class="mb-3 form-input">
            <select class="form-select" aria-label="Default select example">
                <option selected>Select the Cow</option>
            </select>
            <a href="#" class="btn btn-success submit"><span><svg style="fill: white;"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25" height="16">
                        <path
                            d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                        </path>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                        </path>
                    </svg></span>Update Plan</a>
        </div>


        <div>
            <h1>Feed</h1>
            <!-- All the Feed will come here dynamically -->
            <p  class="FeedsName">
                <!-- PHP se aye aye ge ye dynamically -->
                <span>Feed 1</span>
                <span>Feed 2</span>
                <span>Feed 3</span>
            </p>

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