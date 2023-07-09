<?php

include_once("./Model/CowModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getCowById($CowModelObj->conn->connection, "cows", $_REQUEST['id']);

?>
<div class="d-flex CowInfoCard CowProfileCard">
    <div class="CowInfoCardImg">
        <img src="Images/cool_image.jfif" alt="">
    </div>
    <div class="CowInfoCardDetails">
        <p>
            <span>Name:</span>
            <?php echo $result['name']; ?>
            <span>RFID Tag:</span>
            <?php echo $result['id']; ?>
        </p>
        <p>
            <span>Breed:</span>
            <?php echo $result['breed']; ?>
            <span>Weight:</span>
            <?php echo $result['weight'] . " kg"; ?>
            <span>Height:</span>
            <?php echo $result['height'] . " ft"; ?>
            <span>Age:</span>
            <?php echo $result['age'] . " years"; ?>
        </p>
        <p>
            <span>Dairy:</span>
            <?php echo $result['dairy']; ?>
            <span>Insemination:</span>
            <?php echo "N/A"; ?>
            <span>Pregnant:</span>
            <?php echo "N/A"; ?>
            <span>Sick:</span>
            <?php echo "N/A"; ?>
        </p>

        <div class="CowCardbtn btnDivs innerBtn card-body">
            <?php

            if ($isAdmin == 'yes') {
                echo ('<a href="#deleteCowModal" class="btn btn-secondary" data-toggle="modal"
      onclick="setDeleteId(' . $result['id'] . ')">Delete</a>');

                echo ('<a href="./UpdateCowPage?id=' . $result["id"] . '"' . ' class="btn btn-secondary">Update</a>');
            }
            ?>
        </div>
    </div>
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
