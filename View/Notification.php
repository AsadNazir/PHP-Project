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
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="NotificationCard cardCont">

        <?php
        for ($i = 0; $i < count($res); $i++) {
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
<!-- All Scripts Will be added inside the footer or Navbar -->