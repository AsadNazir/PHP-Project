<?php

$NM = new NotificationModal();

$res = $NM->getAllNotification($NM->conn->connection, "alert");

if ($res == null) {
    $res = [];
}

?>

<div class="MainPage">

    <form class="d-flex SearchBar">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success">Search</button>
    </form>

    <div class="NotificationCard cardCont">

        <?php
        for ($i = count($res) - 1; $i >= 0; $i--) {
            $row = $res[$i];

            echo '<div class="card-body card">';
            echo '<h5 class="card-title">' . $row['description'] . ' &nbsp;<span class="badge rounded-pill bg-primary text-light">' . $row['type'] . '</span></h5>';
            echo '<p class="card-text">' . $row['date'] . '</p>';
            echo '<div class="btnDivs innerBtn">';
            echo '<a href="./CowProfile?id=' . $row["cowId"] . '" class="btn btn-primary">&nbsp;View&nbsp;</a>';
            echo '<a href="#" class="btn btn-secondary">Dismiss</a>';
            echo '</div>';
            echo '</div>';

        }
        ?>
    </div>
</div>


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
<!-- All Scripts Will be added inside the footer or Navbar -->