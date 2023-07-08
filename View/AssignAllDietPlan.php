<?php

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, 'cows');

?>

<div class="MainPage">
    <h1>Assign Diet plans</h1>

    <form class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Cow ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date Assigned</th>
                    <th scope="col">Diet Plan</th>
                </tr>
            </thead>
            <tbody>

                <?php

                for ($i = 0; $i < count($result); $i++) {

                    echo "<tr>";
                    echo '<td>' . $result[$i]["id"] . '</td>
                <td>' . $result[$i]["name"] . '</td>
                <td>1/1/2021</td>
                <td>
                    <div class="mb-3 form-input">
                        <select class="form-select months" name="cowId" aria-label="Default select example">
                            <option value="1">Diet Plan one</option>
                        </select>
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