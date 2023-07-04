<?php
$isAdmin = $_SESSION["isAdmin"];

include_once("./Model/DietModal.php");

$DietModelObj = new DietModal();
$result = $DietModelObj->getAllFeeds($DietModelObj->conn->connection, "feed");

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
            <a href="./DeleteAllFeed" class="btn btn-danger" type="submit">Delete All</a>';
        }
        ?>

    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Feed</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                for ($i = 0; $i < count($result); $i++) {
                    $row = $result[$i];
                    ?>

                    <tr>

                        <td>
                            <?php echo $row['name']; ?>
                        </td>
                        <td>
                            <?php echo $row['quantity']; ?>
                        </td>
                        <td>
                            <?php echo $row['price']; ?>
                        </td>
                        <td> <!-- Only Admins have edit priveleges -->
                            <div class="d-flex btnDivs btnDivsFeed">
                                <?php

                                if ($isAdmin == 'yes') {
                                    echo ('<a href="./UpdateFeedPage?id=' . $row["id"] . '"' . ' class="btn btn-success" type="submit">Update</a>');

                                    echo ('<a href="#deleteFeedModal" class="btn btn-danger" data-toggle="modal"
                                    onclick="setDeleteId(' . $row["id"] . ')">Delete</a>');
                                }
                                ?>

                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <div id="deleteFeedModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Feed</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <input type="hidden" id="delete_id">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" onclick="deleteFeed()" value="Delete">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- All Scripts Will be added inside the footer or Navbar -->