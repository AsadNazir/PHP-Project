<?php
$isAdmin = $_SESSION["isAdmin"];

$DietModelObj = new DietModal();
$result = $DietModelObj->getAllDietPlans($DietModelObj->conn->connection, "diet");

// echo "<pre>";
//  print_r($result);
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
            <a class="btn btn-danger" type="submit">Delete All</a>';
        }
        ?>

    </div>

    <div class="DietPlanCards cardCont">

        <?php
        for ($i = 0; $i < count($result); $i++) {
            $row = $result[$i];
            ?>
            <div class="DietPlanCards cardCont">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row['name']; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>
                    <div id="nameHelp" class="btnDivs innerBtn">
                        <a href="#" class="btn btn-primary">&nbsp;View&nbsp;</a>

                        <!-- Only Admins have edit priveleges -->
                        <?php
                        if ($isAdmin == 'yes') {
                            echo '<a href="./UpdateDietPlanPage?id=' . $row["id"] . '"' . ' class="btn btn-secondary">Update</a>
                            <a href="#" class="btn btn-secondary">Delete</a>
                            <a href="./AssignAllDietPlan?id=' . $row["id"] . '" class="btn btn-primary">Assign</a>';
                        }

                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

</div>
<!-- All Scripts Will be added inside the footer or Navbar -->
<script>
    // Get the search input element
    const searchInput = document.querySelector('.SearchBar input');

    // Add event listener to the search input for keyup event
    searchInput.addEventListener('keyup', function () {
        const searchValue = searchInput.value.toLowerCase();
        const dietCards = document.querySelectorAll('.cardCont >div');


        dietCards.forEach(function (card) {
            const title = card.querySelector('.card-title').innerText.toLowerCase();
            const text = card.querySelector('.card-text').innerText.toLowerCase();

            console.log(title, text);
            if (title.includes(searchValue) || text.includes(searchValue)) {
                card.style.display = 'block'; // Display the card if the search text is found
            } else {
                card.style.display = 'none'; // Hide the card if the search text is not found
            }
        });
    })
</script>