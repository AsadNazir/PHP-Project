<?php

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, 'cows');
$Dc = new DietModal();
$res2 = $Dc->getAllDietPlans($Dc->conn->connection, 'diet', $_REQUEST['id']);

?>

<div class="MainPage">
    <h1>
        Assigning
        <?php echo $res2[0]["name"] ?>
    </h1>

    <h1></h1>
    <form class="table-responsive" id="assignDietPlan">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Cow ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Current Plan</th>
                    <th scope="col">Diet Plan</th>
                </tr>
            </thead>
            <tbody>
                <?php

                for ($i = 0; $i < count($result); $i++) {
                    ?>

                    <tr>
                        <td>
                            <?php echo $result[$i]["id"]; ?>
                        </td>
                        <td>
                            <?php echo $result[$i]["name"]; ?>
                        </td>
                        <td>N/A</td>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" id="flexCheckDefault" name="checkboxes[]" value="<?php echo $result[$i]["id"]; ?>">
                            </div>
                        </td>
                    </tr>
                <?php }

                ?>

            </tbody>
        </table>
        <div>
            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_REQUEST['id']; ?>" required>
        </div>
        <div class="d-flex btnDivs">
            <button class="btn btn-success" type="submit" >Assign</button>
            <a href="./DietPlans" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>
<!-- All Scripts Will be added inside the footer or Navbar -->

<script>
    $(document).on('submit', '#assignDietPlan', async function (e) {
        e.preventDefault();

        console.log("sabhjfsa")
        var data = new FormData(this);

        data.set("id", id.value);
        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./AssignDietPlanApi",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (JSON.parse(data) == "added") {
                    alert('success');
                    window.location.href = './DietPlans';
                } else {
                    alert('error');

                }
            },
            error: function (xhr, textStatus, responseText) { }
        });

    });
</script>