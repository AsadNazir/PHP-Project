<?php

include_once("./Model/CowModal.php");

$CowModelObj = new CowModal();
$result = $CowModelObj->getCowById($CowModelObj->conn->connection, "cows",$_REQUEST['id']);

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
            <?php echo $result['weight'] . "kg"; ?>
            <span>Height:</span>
            <?php echo $result['height'] . "ft"; ?>
            <span>Age:</span>
            <?php echo $result['age'] . "years"; ?>
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
      onclick="setDeleteId(' . "1" . ')">Delete</a>');

                echo ('<a href="./UpdateCowPage?id=' . "1" . '"' . ' class="btn btn-secondary">Update</a>');
            }
            ?>
        </div>
    </div>
</div>