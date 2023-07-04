<?php

include_once("./Model/UserModal.php");

$UserModelObj = new UserModal();
$result = $UserModelObj->getAllUsers($UserModelObj->conn->connection, "users");

for ($i = 0; $i < count($result); $i++) {
  $row = $result[$i];
  # code...
  ?>

  <div class="MainPage">


    <?php

    // PHP For loops for displaying the users
  
    ?>
    <div class="card CowCard" id="">
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


  <!-- No Ajax Here -->
  <!-- Add the scripts to the Ajax in the footer or navbar -->