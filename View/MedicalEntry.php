<?php

include_once("./Model/CowModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, "cows");
?>

<div class="MainPage">
    <form class="MedicalForm InputForms" id="MedicalForm">
        <h1>Add Medical Record</h1>
        <div class="mb-3 form-input">
            <label for="cow">Select the cow</label>
            <select class="form-select" aria-label="Default select example" name="cow" id="cow">
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $row = $result[$i];
                    # code...
                    ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['name']; ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Select date</label>
            <input type="date" class="form-control" id="date" name="date" aria-describedby="breedHelp" required />
        </div>


        <div class="mb-3 form-input">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" min="0" id="description" name="description"
                aria-describedby="description" required />
        </div>
        <div class="mb-3 form-input">
            <label for="description" class="form-label">Temperature</label>
            <input type="number" class="form-control" min="0" id="temperature" name="temperature"
                aria-describedby="description" required />
        </div>
        <div class="mb-3 form-input">
            <label for="condition">Condition</label>
            <select class="form-select" aria-label="Default select example" name="condition" id="condition">
                <option value="healthy" selected required>Healthy</option>
                <option value="pregnant" selected required>Pregnant</option>
                <option value="sick" selected required>Sick</option>
                <option value="dead" selected required>Dead</option>
            </select>
        </div>

        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn btn-success submit"><span><svg style="fill: white;"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25" height="16">
                        <path
                            d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                        </path>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                        </path>
                    </svg></span>Add the entry</button>
            <a href="./MainDashBoard" class=" btn-danger btn submit">Cancel</a>
        </div>
    </form>
</div>
</div>

<script type="text/javascript">

    //
// ------------------------------------
</script>