<?php

$isAdmin = $_SESSION["isAdmin"];

include_once("./Model/DietModal.php");

$DietModelObj = new DietModal();
$result = $DietModelObj->getAllDietPlans($DietModelObj->conn->connection, "diet");
$result2 = $DietModelObj->getCowDietByCowId($DietModelObj->conn->connection, "cow_diet", $_REQUEST['id']);
//  var_dump($result2);
$result1 = 0;
if ($result2) {
    $result1 = $DietModelObj->getDietById($DietModelObj->conn->connection, "diet", $result2[0]['dietId']);

    if ($result1) {
        $result3 = $DietModelObj->getAllDietFeedsByDietId($DietModelObj->conn->connection, "diet_feed", $result1['id']);
    }
}

?>

<div class="d-flex CowProfileCard CowDietCard">
    <div class="DietPlans DietPlanAndFeed">
        <h1>
            Current Diet Plan
        </h1>
        <?php
        if ($result1) {
            ?>
            <h2>
                <?php echo $result1['name']; ?>
            </h2>
            <!-- <h3> -->
            <?php echo $result1['description']; ?>
            <!-- </h3> -->


            <?php
        } else {
            echo "No Diet Plan Assigned yet.";
        }
        if ($isAdmin == "yes") {
            ?>
            <div class="mb-3 form-input">

                <form id="updateDietPlan" style="margin-top:10px">
                    <select class="form-select" aria-label="Default select example" name="id">
                        <option selected disabled>
                            <?php if ($result1) {
                                echo $result1['name'];
                            } else {
                                echo "Select Diet Plan";
                            } ?>
                        </option>
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                            $row = $result[$i];
                            # code...
                            ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['name']; ?>
                            </option>
                        <?php } ?>

                    </select>
                    <div>
                        <input type="hidden" id="cd_id" name="cd_id" class="form-control" value="<?php if ($result2) {
                            echo $result2[0]['id'];
                        } else {
                            echo "noId";
                        } ?>" required>
                    </div>
                    <div>
                        <input type="hidden" id="cowId" name="cowId" class="form-control"
                            value="<?php echo $_REQUEST['id']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success submit" style="margin-top:10px"><span><svg
                                style="fill: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25"
                                height="16">
                                <path
                                    d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                                </path>
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                                </path>
                            </svg></span>Update Plan</a>
                </form>
            </div>
        <?php }
        ?>

        <div>
            <h1>Feed</h1>
            <?php
            if ($result1) {
                if ($result3) {


                    // var_dump($result3);
            
                    for ($x = 0; $x < count($result3); $x++) {
                        ?>
                        <p class="FeedsName">

                            <?php $row2 = $result3[$x];
                            // echo $row2['id'] . $row2['dietId'] . $row2['feedId'];
                            $feedres = $DietModelObj->getFeedById($DietModelObj->conn->connection, "feed", $row2['feedId']);

                            echo "Feed " . $x + 1 . ":";
                            ?><span>
                                <?php echo $feedres['name']; ?>
                            </span>
                            <?php echo "Quantity: " . $row2['quantity'];
                            ?>
                        </p>
                        <?php
                    }
                }
            } else {
                echo "No Diet Plan Assigned yet.";
            } ?>

        </div>
    </div>
    <div class="DietGraph graph">
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
    var myChart2 = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });

</script>

<script type="text/javascript">
    $(document).on('submit', '#updateDietPlan', async function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set("cd_id", cd_id.value);
        data.set("cowId", cowId.value);
        // console.log (id.value);

        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./updateDietPlanApi",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response == "updated") {
                    alert('success');
                    location.reload();
                } else {
                    alert('error');

                }
            },
            error: function (xhr, textStatus, responseText) { }
        });

    });

// ------------------------------------
</script>