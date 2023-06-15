
<?php

include_once("./Model/CowModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getAllCows($CowModelObj->conn->connection, "cows");


for ($i = 0; $i < count($result); $i++) {
  $row = $result[$i];
  # code...
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
    <div class="CowCardbtn card-body">
      <a href="" class="btn btn-primary">More Details</a>
      <a href="DeleteCow?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Delete</a>
      <a href="UpdateCowPage?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Update</a>

    </div>
  </div>

  <?php

}
?>