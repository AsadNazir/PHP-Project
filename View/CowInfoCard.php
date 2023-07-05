<?php



?>
<div class="d-flex CowInfoCard CowProfileCard">
    <div class="CowInfoCardImg">
        <img src="Images/cool_image.jfif" alt="">
    </div>
    <div class="CowInfoCardDetails">
        <p>
            <span>Name:</span>
            <?php echo "Daisy"; ?>
            <span>RFID Tag:</span>
            <?php echo "123"; ?>
        </p>
        <p>
            <span>Breed:</span>
            <?php echo "Daisy"; ?>
            <span>Weight:</span>
            <?php echo "Daisy"; ?>
            <span>Age:</span>
            <?php echo "Daisy"; ?>
        </p>
        <p>
            <span>Insemination:</span>
            <?php echo "False"; ?>
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