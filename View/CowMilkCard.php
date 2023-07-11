<?php

include_once("Model/CowModal.php");
$CowModelObj = new CowModal();
$data = $CowModelObj->getACowMilkRecord($CowModelObj->conn->connection, 'milk', $_REQUEST['id'])

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
                <label for="month_select">Month</label>
                <select class="form-select months" aria-label="Default select example">
                    <option value="1">1 January</option>
                    <option value="2">2 February</option>
                    <option value="3">3 March</option>
                    <option value="4">4 April</option>
                    <option value="5">5 May</option>
                    <option value="6">6 June</option>
                    <option selected value="7">7 July</option>
                    <option value="8">8 August</option>
                    <option value="9">9 September</option>
                    <option value="10">10 October</option>
                    <option value="11">11 November</option>
                    <option value="12">12 December</option>
                </select>
            </div>

        </div>
        <div class="graphAndStats">
            <div class="graph"><canvas id="myChart"></canvas></div>
            <div class="stats">
                <p>
                <h1>Avg</h1>
                <span class="avg">0 ltr</span>
                </p>
                <p>
                <h1>Highest</h1>
                <span class="highest">0 ltr</span>
                </p>
                <p>
                <h1>Rank</h1>
                <span class="rank">0 ltr</span>
                </p>
                <div class="CowCardbtn btnDivs innerBtn">

                    <a href="./Admin" class="btn btn-secondary" data-toggle="modal">More details</a>

                </div>
            </div>
        </div>


    </div>
</div>

<script>


    const monthSelector = document.querySelector(".months");
    monthSelector.addEventListener("change", () => {

        dataOfMilkProduction = [];
        date = [];
        let d = "<?php echo $_REQUEST['id'] ?>" + "&month=" + monthSelector.value;
        const milkSettings =
        {
            contentType: false,
            processData: false,
            type: "POST",
            url: "./GetAllMilkRecordsByDays?id=" + d,
            success: function (response) {
                console.log(JSON.parse(response));
                let data = JSON.parse(response);

                //Iterating through the response and adding the milk production to the array
                for (let i = 0; i < JSON.parse(response).length; i++) {
                    {
                        date.push(data[i]["date"]);
                        dataOfMilkProduction[i] = parseInt(
                            data[i]["total_milk_production"],
                            10
                        );
                    }
                }

                printChart();
            },
            error: function (err,) {
                console.log(err);
            },

        };
        $.ajax(milkSettings);

    }
    )
    const milkStatsSettings =
    {
        contentType: false,
        processData: false,
        type: "POST",
        url: "./GetAvgHighestRankOfCowApi?id=" + "<?php echo $_REQUEST["id"] ?>",
        success: function (response) {

            let data = JSON.parse(response);
            //console.log(JSON.parse(response));
            const avg = document.querySelector(".avg");
            const highest = document.querySelector(".highest");
            const rank = document.querySelector(".rank");
            avg.innerHTML = data[0][0] + " ltr";
            highest.innerHTML = data[1][0] + " ltr";

            for (let i = 2; i < data.length; i++) {
                if (data[i]["cowId"] == "<?php echo $_REQUEST["id"] ?>") {
                    rank.innerHTML = data[i]["cow_rank"];
                    break;
                }
            }

        },
        error: function (err,) {
            console.log(err);
        },

    };
    $.ajax(milkStatsSettings);


    let dataOfMilkProduction = [];
    let date = [];
    let d = "<?php echo $_REQUEST['id'] . "&month=7" ?>";
    const milkSettings =
    {
        contentType: false,
        processData: false,
        type: "POST",
        url: "./GetAllMilkRecordsByDays?id=" + d,
        success: function (response) {
            //console.log(JSON.parse(response));
            let data = JSON.parse(response);

            //console.log(dataOfMilkProduction);
            //Iterating through the response and adding the milk production to the array
            for (let i = 0; i < JSON.parse(response).length; i++) {
                {
                    date.push(data[i]["date"]);
                    dataOfMilkProduction[i] = parseInt(
                        data[i]["total_milk_production"],
                        10
                    );
                }
            }

            printChart();
        },
        error: function (err,) {
            console.log(err);
        },

    };

    let myChart;
    $.ajax(milkSettings);

    function printChart() {
        if (myChart != null)
            myChart.destroy();


        var ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'line',

            data: {
                labels: date,
                datasets: [{
                    label: 'Milk Production',
                    data: dataOfMilkProduction,
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
    }



    $('#date').datepicker({
        changeMonth: false,
        changeYear: false,
        stepMonths: false,
        dateFormat: 'dd MM'
    });
</script>