<?php
$id = $_GET['id'];

$obj= new CowModal();
$row = $obj->getCowById($obj->conn->connection, "cows", $id);
// var_dump($row);
?>
<div class="MainPage">
    <form id="updateCow" enctype="multipart/form-data">
        <h1>Update your Animal's data!</h1>
        <div class="mb-3 form-input">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                value="<?php echo $row['name'] ?>" required />
            <div id="nameHelp" class="form-text">
                Give your cow a unique name.
            </div>
        </div>
        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Race / Breed</label>
            <input type="text" class="form-control" id="text" name="breed" aria-describedby="breedHelp"
                value="<?php echo $row['breed'] ?>" required />
        </div>
        <label for="gender" class="form-label">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="female" <?php if($row['gender'] == "female"){ ?>checked <?php }?>>
            <label class="form-check-label" for="gender">
                Female
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="male" <?php if($row['gender'] == "male"){ ?>checked <?php }?>>
            <label class="form-check-label" for="gender">
                Male
            </label>
        </div>
        <div class="mb-3 form-input">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" max="25" min="0"
                value="<?php echo $row['age'] ?>" required />
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <img src="Images/upload/<?php echo $row['image']; ?>" sir chashme door alt="Image" style="height:50px">
            <input type="file" name="image" class="form-control" aria-describedby="imageHelp" />
            <div id="imageHelp" class="form-text">
                Add beautiful image of your cow.
            </div>
        </div>
        <div class="mb-3 form-check" style="margin-top:10px">
            <input type="checkbox" class="form-check-input" id="dairy" name="dairy"  <?php if($row['dairy'] == "yes"){ ?>checked <?php }?>/>
            <label class="form-check-label" for="dairy">Is your cow a dairy cow?</label>
        </div>

        <div>
            <h4>
                Add some more details about your cow
            </h4>
        </div>
        <div class="mb-3 form-input">
            <label for="weight" class="form-label">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $row['weight'] ?>" min="0" />
        </div>
        <div class="mb-3 form-input">
            <label for="height" class="form-label">Height</label>
            <input type="number" class="form-control" id="height" name="height" value="<?php echo $row['height'] ?>" min="0" />
        </div>
        <div class="mb-3 form-input">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="<?php echo $row['color'] ?>" />
        </div>
        <div>
            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $row['id'] ?>" required>
        </div>
        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="mode btn submit">Update Animal</button>
            <a href="./MainDashBoard" class="mode btn submit">Cancel</a>
        </div>
    </form>
</div>
</div>

</body>

</html>

<script type="text/javascript">
    $(document).on('submit', '#updateCow', async function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set("id", id.value);
        // console.log (id.value);

        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./updateCowApi",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response == "updated") {
                    alert('success');
                    window.location.href = './MainDashBoard';
                } else {
                    alert('error');

                }
            },
            error: function (xhr, textStatus, responseText) { }
        });

    });

// ------------------------------------
</script>