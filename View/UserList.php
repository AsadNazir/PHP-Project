<?php

include_once("./Model/UserModal.php");

$UserModelObj = new UserModal();
$result = $UserModelObj->getAllUsers($UserModelObj->conn->connection, "users");


# code...
?>

<div class="MainPage">
  <form class="d-flex SearchBar">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <div class="d-flex btnDivs">
    <?php

    if ($isAdmin == 'yes') {
      echo '<a href="./AddUsers" class="btn btn-success" type="submit">Add New</a>';
    }
    ?>

  </div>

  <?php
  for ($i = 0; $i < count($result); $i++) {
    $row = $result[$i];
    // PHP For loops for displaying the users
  
    ?>
    <div class="card CowCard cardCont" id="">
      <div class="card-body CowCardBody">
        <div class="cowImage"><img src="Images/upload/<?php echo $row["image"]; ?>" alt="Image"></div>
        <div class="cowDetails">
          <h5 class="card-title">
            <?php echo $row["name"]; ?>
          </h5>
          <p class="card-text CowDetails">
            <span><strong>Email</strong>
              <?php echo $row['email']; ?>

            </span>
            <!-- <span><strong>Password</strong>
              <?php echo $row['password']; ?>
            </span> -->
            <span><strong>Job</strong>
              <?php echo $row['job']; ?>
            </span>

          </p>
        </div>
      </div>
      <div class="CowCardbtn btnDivs card-body">

        <a href="./UpdateUserPage?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
        <a href="#deleteUserModal" class="btn btn-danger" data-toggle="modal"
          onclick="setDeleteId(<?php echo $row['id']; ?>)">Delete</a>

      </div>

      <div id="deleteUserModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this Record?</p>
              <p class="text-warning"><small>This action cannot be undone.</small></p>
            </div>
            <input type="hidden" id="delete_id">
            <div class="modal-footer">
              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
              <input type="submit" class="btn btn-danger" onclick="deleteUser()" value="Delete">
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php

  }
  ?>

  <script>
    // Get the search input element
    const searchInput = document.querySelector('.SearchBar input');

    // Add event listener to the search input for keyup event
    searchInput.addEventListener('keyup', function () {
      const searchValue = searchInput.value.toLowerCase();
      const dietCards = document.querySelectorAll('.cardCont');


      dietCards.forEach(function (card) {
        const title = card.querySelector('.card-title').innerText.toLowerCase();
        const text = card.querySelector('.card-text').innerText.toLowerCase();

        console.log(title, text);
        if (title.includes(searchValue) || text.includes(searchValue)) {
          card.style.display = 'block'; // Display the card if the search text is found
        } else {
          card.style.display = 'none'; // Hide the card if the search text is not found
        }
      });
    })
  </script>
  <!-- No Ajax Here -->
  <!-- Add the scripts to the Ajax in the footer or navbar -->