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
            echo '<a href="./AddNewFeed" class="btn btn-success" type="submit">Add New</a>
            <a href="./DeleteAllFeed" class="btn btn-danger" type="submit">Delet All</a>';
        }
        ?>

    </div>

    <div class="table-responsive">
        <table  class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Feed</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td> <!-- Only Admins have edit priveleges -->
                        <div class="d-flex btnDivs btnDivsFeed">
                            <?php

                            if ($isAdmin == 'yes') {
                                echo '<a href="./UpdateFeed" class="btn btn-success" type="submit">Update</a>
            <a class="btn btn-danger" type="submit">Delete</a>';
                            }
                            ?>

                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- All Scripts Will be added inside the footer or Navbar -->