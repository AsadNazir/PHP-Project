<?php
$isAdmin = $_SESSION["isAdmin"];
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
            <button class="btn btn-danger" type="submit">Delet All</button>';
        }
        ?>

    </div>

    <div class="DietPlanCards card">

        <div class="card-body">
            <h5 class="card-title">Weight Gain Diet Plan for Malnourished</h5>
            <p class="card-text">This is a customised Diet plan for cows</p>
            <div id="nameHelp" class="btnDivs innerBtn">


                <a href="#" class="btn btn-primary">&nbsp;View&nbsp;</a>

                <!-- Only Admins have edit priveleges -->
                <?php
                if ($isAdmin == 'yes') {
                    echo '<a href="#" class="btn btn-secondary">Update</a>
            <a href="#" class="btn btn-secondary">Delete</a>';
                }

                ?>
            </div>
        </div>
    </div>

</div>
<!-- All Scripts Will be added inside the footer or Navbar -->