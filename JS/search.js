//Milk Table search function
// -------------------------------------------
// Get the search input element
const searchInput = document.querySelector(".SearchBar input");
const tableRowsMilk = document.querySelectorAll(".milkTableBody tr");
const tableRowsFeed = document.querySelectorAll(".feedRowTable tr");

// Add event listener to the search input for keyup event

if (tableRowsMilk != null) {
  searchInput.addEventListener("keyup", function () {
    const searchValue = searchInput.value.toLowerCase();

    //   tableRows Not found

    tableRowsMilk.forEach(function (row) {
      const id = row.querySelector("td:nth-child(1)").innerText.toLowerCase();
      const group = row
        .querySelector("td:nth-child(2)")
        .innerText.toLowerCase();
      const quantity = row
        .querySelector("td:nth-child(4)")
        .innerText.toLowerCase();

      if (
        id.includes(searchValue) ||
        group.includes(searchValue) ||
        quantity.includes(searchValue)
      ) {
        row.style.display = "table-row"; // Display the row if the search text is found
      } else {
        row.style.display = "none"; // Hide the row if the search text is not found
      }
    });
  });
}

if (tableRowsFeed != null) {
  searchInput.addEventListener("keyup", function () {
    const searchValue = searchInput.value.toLowerCase();

    //   tableRows Not found

    tableRowsFeed.forEach(function (row) {
      const id = row.querySelector("td:nth-child(1)").innerText.toLowerCase();
      const group = row
        .querySelector("td:nth-child(2)")
        .innerText.toLowerCase();
      const price = row
        .querySelector("td:nth-child(3)")
        .innerText.toLowerCase();

      if (
        id.includes(searchValue) ||
        group.includes(searchValue) ||
        price.includes(searchValue)
      ) {
        row.style.display = "table-row"; // Display the row if the search text is found
      } else {
        row.style.display = "none"; // Hide the row if the search text is not found
      }
    });
  });
}
