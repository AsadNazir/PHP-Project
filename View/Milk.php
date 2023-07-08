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
        <a href="./MilkEntry" class="btn btn-success" type="submit">Add Milk Entry</a>
        <a href="./DeleteAllMilk" class="btn btn-danger" type="submit">Delete All</a>

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
        <div class="mb-3 form-input">
            <label for="endDate" class="form-label">&nbsp;</label>
            <button class="btn filter btn-primary">Filter</button>
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
                    $row = $data[$i]; ?>
                    <tr>
                        <td>
                            <?php echo $row['cowId']; ?>
                        </td>
                        <td>
                            Group -A
                        </td>
                        <td>
                            <?php echo $row['date']; ?>
                        </td>
                        <td>
                            <?php echo $row['quantity']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
