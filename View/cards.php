<?php
include_once("./Model/CowModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, "cows");


// Getting the admin rigths of user 
$isAdmin = $_SESSION["isAdmin"];


for ($i = 0; $i < count($result); $i++) {
  $row = $result[$i];
  ?>
  <div class="card CowCard" id="<?php echo "GR-" . $row['id']; ?>">
    <h5 class="card-header">GR-
      <?php echo $row['id']; ?>
    </h5>
    <div class="card-body CowCardBody">
      <div class="cowImage"><img src="Images/upload/<?php echo $row["image"]; ?>" alt="Image"></div>
      <div class="cowDetails">
        <h5 class="card-title">
          <?php echo $row['name']; ?>
        </h5>
        <p class="card-text CowDetails">
          <span><strong>Age</strong>
            <?php echo $row['age']; ?> years
          </span>
          <span><strong>Weight</strong>
            <?php echo $row['weight']; ?> kg
          </span>
          <span><strong>Height</strong>
            <?php echo $row['height']; ?> ft
          </span>

        </p>
      </div>
    </div>
    <div class="CowCardbtn btnDivs card-body">
      <a href="./CowProfile" class="btn btn-primary">More Details</a>
      <?php

      if ($isAdmin == 'yes') {
        echo ('<a href="#deleteCowModal" class="btn btn-secondary" data-toggle="modal"
      onclick="setDeleteId(' . $row["id"] . ')">Delete</a>');

        echo ('<a href="./UpdateCowPage?id=' . $row["id"] . '"' . ' class="btn btn-secondary">Update</a>');
      }
      ?>
    </div>

    <div id="deleteCowModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Delete Animal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this Record?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <input type="hidden" id="delete_id">
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" onclick="deleteCow()" value="Delete">
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
}
?>