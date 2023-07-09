<?php

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, 'cows');
$Dc = new DietModal();
$res2 = $Dc->getAllDietPlans($Dc->conn->connection, 'diet', $_REQUEST['id']);

?>

<div class="MainPage">
    <h1>
        Assing <?php echo $res2[0]["name"] ?>
    </h1>

    <h1></h1>
    <form class="table-responsive">
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

                    echo "<tr>";
                    echo '<td>' . $result[$i]["id"] . '</td>
                <td>' . $result[$i]["name"] . '</td>
                <td>N/A</td>
                <td>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              </div>
                </td>';
                    echo "</tr>";
                }

                ?>

            </tbody>
        </table>

        <div class="d-flex btnDivs">
            <a class="btn btn-success" type="submit">Assign All</a>
            <a href="./DietPlans" class="btn btn-danger" type="submit">Cancel</a>
        </div>
    </form>
</div>
<!-- All Scripts Will be added inside the footer or Navbar -->