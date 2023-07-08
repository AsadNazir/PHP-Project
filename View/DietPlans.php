<?php
$isAdmin = $_SESSION["isAdmin"];

$DietPlan = new DietModal();
$result = $DietPlan->getAllDietPlans($DietPlan->conn->connection, "diet");
// echo "<pre>";
// print_r($result);
?>

<div class="MainPage">

    <form class="d-flex SearchBar">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>


    <!-- Only Admins have edit priveleges -->
    <div class="d-flex btnDivs">
        <?php

        if ($isAdmin == 'yes') {
            echo '<a href="./AddNewDietPlan" class="btn btn-success" type="submit">Add New</a>
            <a class="btn btn-danger" type="submit">Delet All</a>;
            <a href="./AssignAllDietPlan" class="btn btn-primary" type="submit">Assign All</a>';
        }
        ?>

    </div>

    <div class="DietPlanCards">

        <?php

        for ($i = 0; $i < count($result); $i++) {

            echo "<div class='card-body card'>
    <h5 class='card-title'>" . $result[$i]["name"] . "</h5>
    <p class='card-text'>" . $result[$i]["description"] . "</p>
    <div id='nameHelp' class='btnDivs innerBtn'>


        <a href='#'  class='btn btn-primary'>&nbsp;View&nbsp;</a>

        <!-- Only Admins have edit priveleges -->";

            if ($isAdmin == 'yes') {
                echo '<a href="#" class="btn btn-secondary">Update</a>
                     <a href="#" class="btn btn-secondary">Delete</a>';


            }
            echo "</div>
            </div>";
        }
        ?>
    </div>
</div>

</div>
<!-- All Scripts Will be added inside the footer or Navbar -->