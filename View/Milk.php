<?php
$isAdmin = $_SESSION["isAdmin"];

require_once("./Model/CowModal.php");

$CowModalObj2 = new CowModal();


$data = $CowModalObj2->getAllMilkRecordsAPI($CowModalObj2->conn->connection, "milk");

//var_dump($data);
if ($data == null) {
    $data = [];
}

?>

<div class="MainPage">

    <form class="d-flex SearchBar">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>


    <!-- Only Admins have edit priveleges -->
    <div class="d-flex btnDivs">
        <a href="./AddNewFeed" class="btn btn-success" type="submit">Add Milk Entry</a>
        <a href="./DeleteAllFeed" class="btn btn-danger" type="submit"> Print Data</a>';
    </div>
    <div class="d-flex btnDivs">
        <div class="mb-3 form-input">
            <label for="startDate" class="form-label">From</label>
            <input type="date" class="form-control" min="0" id="startDate" name="startDate" aria-describedby="startDate"
                required />
        </div>
        <div class="mb-3 form-input">
            <label for="endDate" class="form-label">to</label>
            <input type="date" class="form-control" min="0" id="endDate" name="endDate" aria-describedby="endDate"
                required />
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Cow ID</th>
                    <th scope="col">Group</th>
                    <th scope="col">Date</th>
                    <th scope="col">Milk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($data); $i++) {

                    echo "<tr>" .
                        "<td>" . $data[$i]["id"] . "</td>";
                    echo "<td>" . "Group -A" . "</td>";
                    echo "<td>" . $data[$i]["date"] . "</td>";
                    echo "<td>" . $data[$i]["milk"] . "</td>";
                    echo "</tr>";
                }




                ?>




            </tbody>
        </table>
    </div>
</div>
<!-- All Scripts Will be added inside the footer or Navbar -->