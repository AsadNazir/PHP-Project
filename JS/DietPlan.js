// Add event listener to the form's submit event for validating the selection
const form = document.querySelector("#AddNewDietPlan");
form.addEventListener("submit", function (event) {
  const feedError = document.querySelector(".feedError");
  // console.log(feedError);

  if (!isAnyChecked()) {
    event.preventDefault(); // Prevent form submission
    feedError.innerHTML = "Please select at least one feed";
    dropdownContent.classList.add("required-error");
    return false;
  }

  feedError.innerHTML = "";
  return false;
});

// Get the dropdown button and dropdown content elements
const dropdownButton = document.querySelector(".dropdown-button-custom");
const dropdownContent = document.querySelector(".dropdown-content-custom");

// Get the checkboxes inside the dropdown content
const checkboxes = dropdownContent.querySelectorAll('input[type="checkbox"]');

// Add event listener to the dropdown button for toggling the dropdown content
dropdownButton.addEventListener("click", function () {
  dropdownContent.classList.toggle("show");
});

// Add event listener to each checkbox for updating the selected items list and validating the selection
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener("change", function () {
    updateSelectedItems();
  });
});

// Function to update the selected items list
function updateSelectedItems() {
  const selectedItemsDiv = document.getElementById("selected-items");
  selectedItemsDiv.innerHTML = "";

  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      const label = checkbox.parentNode.textContent.trim();
      // const listItem = document.createElement('li');
      // listItem.textContent = label;
      // selectedItemsDiv.appendChild(listItem);

      selectedItemsDiv.innerHTML += `<div class="mb-3 form-input">
            <label for="description" class="form-label">${label}</label>
            <input type="number" class="form-control" min="0" id="text" name=${label} aria-describedby="breedHelp"
                required />
        </div>`;
    }
  });

  if (selectedItemsDiv.innerHTML == "") {
    selectedItemsDiv.innerHTML = "Nothing is selected";
  }
  validateSelection();
}

// Function to validate the selection
function validateSelection() {
  const isAnyChecked = Array.from(checkboxes).some(function (checkbox) {
    return checkbox.checked;
  });

  if (isAnyChecked) {
    dropdownContent.classList.remove("required-error");
  } else {
    dropdownContent.classList.add("required-error");
  }
}

// Function to check if any checkbox is checked
function isAnyChecked() {
  return Array.from(checkboxes).some(function (checkbox) {
    return checkbox.checked;
  });
}

//--------------------------------------------------------------

//Ajax call for the Add New Diet Plan

$(document).on('submit', '#AddNewDietPlan', async function (e) {
  e.preventDefault();

  var data = new FormData(this);

  //AJAX Request for saving the data --------------------------

  $.ajax({
    data: data,
    type: "POST",
    url: "./AddNewDietPlanApi",
    contentType: false,
    processData: false,
    success: function (data) {
      console.log(data);
      if (JSON.parse(data) == "added") {
        alert('success');
        window.location.href = './DietPlans';
      } else {
        alert('error');

      }
    },
    error: function (xhr, textStatus, responseText) { }
  });

});
