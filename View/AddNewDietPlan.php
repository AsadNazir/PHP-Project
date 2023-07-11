<?php
$isAdmin = $_SESSION["isAdmin"];

include_once("./Model/DietModal.php");

$DietModelObj = new DietModal();
$result = $DietModelObj->getAllFeeds($DietModelObj->conn->connection, "feed");

?>

<!--  Purpose: Add new diet plan to the database -->
<div class="MainPage">
    <form class="InputForms" id="AddNewDietPlan">
        <h1>Add Diet Plan</h1>

        <div class="mb-3 form-input">
            <label for="planName" class="form-label">Diet Plan Name</label>
            <input type="text" class="form-control" id="text" name="planName" aria-describedby="breedHelp" required />
        </div>

        <div class="mb-3 form-input">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" min="0" id="text" name="description" aria-describedby="breedHelp"
                required />
        </div>

        <div class="specialFormGroup">
            <!-- DropDown CheckBox -->
            <div class="dropdown-custom form-input">
                <button class="dropdown-button-custom btn">Select Feed</button>

                <div class="dropdown-content-custom">
                    <?php

                    for ($i = 0; $i < count($result); $i++) {
                        $row = $result[$i];
                        ?>
                        <label><input type="checkbox" name="checkboxes[]"
                            value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?>
                        </label><br>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div>
            <!-- <input type="hidden" id="id" name="arr_ids" class="form-control" value="<?php //echo $arr_id; ?>" required>
            <input type="hidden" id="id" name="arr_names" class="form-control" value="<?php //echo $arr_names; ?>" required> -->
        </div>
            <!-- Or Add New Feed -->
            <div class="mb-3 form-input">
                <a href="./AddNewFeed" class="btn btn-primary submit">Add New Feed</a>
            </div>

        </div>

        <div class="form-input">
            <h1>Selected Feed</h1>
            <div class="specialFormGroup" id="selected-items">
                Nothing is selected
            </div>
            <span class="feedError"></span>
        </div>

        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn submit"><span><svg style="fill: white;" xmlns="http://www.w3.org/2000/svg"
                        width="20" height="16">
                        <path
                            d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                        </path>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                        </path>
                    </svg></span>Add the entry</button>

            <a href="./DietPlans" class="btn btn-danger submit">Cancel</a>
        </div>
    </form>
</div>
</div>
<!-- If you see this it means the script has already been dynamically included in the footer -->
<!-- JS is in DietPlan.Js you should also put AJAX over there -->