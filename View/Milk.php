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
            <tbody class="milkTableBody">
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

<script>

    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    let startDate; // Replace with your start date
    let endDate; // Replace with your end date
    const jsonData = <?php echo json_encode($data); ?>;
    const filterBtn = document.querySelector('.filter');
    const tableBody = document.querySelector('tbody');


    function filterData(startDate, endDate) {
        const filteredData = jsonData.filter(obj => {
            const objDate = new Date(obj.date);
            return objDate >= new Date(startDate) && objDate <= new Date(endDate);
        });

        return (filteredData);
    }


    filterBtn.addEventListener('click', () => {
        endDate = endDateInput.value;
        startDate = startDateInput.value;

        let filteredData = filterData(startDate, endDate);
        tableBody.innerHTML = '';
        filteredData.forEach(obj => {
            tableBody.innerHTML += `
            <tr>
                <td>
                    ${obj.cowId}
                </td>
                <td>
                    Group -A
                </td>
                <td>
                    ${obj.date}
                </td>
                <td>
                    ${obj.quantity}
                </td>
            </tr>
            `;
        });
    });


    document.addEventListener('DOMContentLoaded', function () {

        startDateInput.addEventListener('change', () => {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (startDate > endDate && endDateInput.value !== '') {
                startDateInput.value = '';
                alert('Please select a valid date range.');
            }
        });

        endDateInput.addEventListener('change', () => {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (startDate > endDate) {
                endDateInput.value = '';
                alert('Please select a valid date range.');
            }
        });
    });




</script>