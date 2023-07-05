<?php

include_once("Model/CowModal.php");
$CowModelObj = new CowModal();
$data = $CowModelObj->getACowMilkRecord($CowModelObj->conn->connection, 'milk', 14)

    ?>
<div class="d-flex CowProfileCard CowMilkCard">
    <div class="CowMilkCardProduction">

        <div>
            <h1>This Year</h1><span>
                <?php
                if ($data['total_year'] == null)
                    echo "0";
                else
                    echo $data['total_year'];
                ?>&nbsp;ltr
            </span>
        </div>
        <div>
            <h1>This Month</h1><span>
                <?php
                if ($data['total_month'] == null)
                    echo "0";
                else
                    echo $data['total_month'];
                ?>&nbsp;ltr
            </span>
        </div>
        <div>
            <h1>This Week</h1><span>
                <?php
                if ($data['total_week'] == null)
                    echo "0";
                else
                    echo $data['total_week'] . " ";
                ?>&nbsp;ltr
            </span>
        </div>
        <div>
            <h1>Today</h1><span>
                <?php
                if ($data['total_day'] == null)
                    echo "0";
                else
                    echo $data['total_day'];
                ?>&nbsp;ltr
            </span>
        </div>
    </div>
    <div class="statsAndGraph">

        <div class="d-flex btnDivs">
            <div class="mb-3 form-input">
                <label for="startDate" class="form-label">From</label>
                <input type="date" class="form-control" min="0" id="startDate" name="startDate"
                    aria-describedby="startDate" required />
            </div>
            <div class="mb-3 form-input">
                <label for="endDate" class="form-label">to</label>
                <input type="date" class="form-control" min="0" id="endDate" name="endDate" aria-describedby="endDate"
                    required />
            </div>
        </div>
        <div class="graphAndStats">
            <div  class="graph" ><canvas id="myChart"></canvas></div>
            <div class="stats">
                <p>
                <h1>Avg</h1>
                <span>0 ltr</span>
                </p>
                <p>
                <h1>Highest</h1>
                <span>0 ltr</span>
                </p>
                <p>
                <h1>Rank</h1>
                <span>0 ltr</span>
                </p>
                <div class="CowCardbtn btnDivs innerBtn">

                    <a href="./Admin" class="btn btn-secondary" data-toggle="modal">More details</a>

                </div>
            </div>
        </div>


    </div>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',

        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [{
                label: 'Milk Production',
                data: [0, 10, 5, 2, 20, 30, 45, 50, 60],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: false
                }
            }
        }
    });
</script>