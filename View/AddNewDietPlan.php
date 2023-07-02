<?php

include_once("./Model/CowModal.php");
require_once("./Model/DietModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, "cows");
?>

<div class="MainPage">
    <form class="InputForms" id="AddNewDietPlan">
        <h1>Add Diet Plan</h1>

        <div class="mb-3 form-input">
            <label for="planName" class="form-label">Diet Plane Name</label>
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
                    <label><input type="checkbox" name="options[]">Bhoosa 2</label><br>
                    <label><input type="checkbox" name="options[]">Bhoosa 3</label><br>
                    <label><input type="checkbox" name="options[]">Bhoosa 3</label><br>
                    <label><input type="checkbox" name="options[]">Bhoosa 2</label><br>
                    <label><input type="checkbox" name="options[]">Bhoosa 3</label><br>
                </div>
            </div>
            <!-- Or Add New Feed -->
            <div class="mb-3 form-input">
                <a href="./DietPlans" class="btn btn-primary submit">Add New Feed</a>
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
<script>

    // Add event listener to the form's submit event for validating the selection
    const form = document.querySelector('#AddNewDietPlan');
    form.addEventListener('submit', function (event) {

        const feedError = document.querySelector('.feedError');
        console.log(feedError);

        if (!isAnyChecked()) {
            event.preventDefault(); // Prevent form submission
            feedError.innerHTML = 'Please select at least one feed';
            dropdownContent.classList.add('required-error');
            return false;
        }

        feedError.innerHTML = '';
        return false;
    });

    // Get the dropdown button and dropdown content elements
    const dropdownButton = document.querySelector('.dropdown-button-custom');
    const dropdownContent = document.querySelector('.dropdown-content-custom');

    // Get the checkboxes inside the dropdown content
    const checkboxes = dropdownContent.querySelectorAll('input[type="checkbox"]');

    // Add event listener to the dropdown button for toggling the dropdown content
    dropdownButton.addEventListener('click', function () {
        dropdownContent.classList.toggle('show');
    });

    // Add event listener to each checkbox for updating the selected items list and validating the selection
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateSelectedItems();
        });
    });

    // Function to update the selected items list
    function updateSelectedItems() {
        const selectedItemsDiv = document.getElementById('selected-items');
        selectedItemsDiv.innerHTML = '';

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                const label = checkbox.parentNode.textContent.trim();
                // const listItem = document.createElement('li');
                // listItem.textContent = label;
                // selectedItemsDiv.appendChild(listItem);
                selectedItemsDiv.innerHTML += `<div class="mb-3 form-input">
            <label for="description" class="form-label">${label}</label>
            <input type="number" class="form-control" min="0" id="text" name="feedQty" aria-describedby="breedHelp"
                required />
        </div>`
            }
        });

        if (selectedItemsDiv.innerHTML == '') {
            selectedItemsDiv.innerHTML = 'Nothing is selected';
        }
        validateSelection();
    }

    // Function to validate the selection
    function validateSelection() {
        const isAnyChecked = Array.from(checkboxes).some(function (checkbox) {
            return checkbox.checked;
        });

        if (isAnyChecked) {
            dropdownContent.classList.remove('required-error');
        } else {
            dropdownContent.classList.add('required-error');
        }
    }

    // Function to check if any checkbox is checked
    function isAnyChecked() {
        return Array.from(checkboxes).some(function (checkbox) {
            return checkbox.checked;
        });
    }
</script>