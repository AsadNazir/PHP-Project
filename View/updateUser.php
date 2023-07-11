<?php ?>
<?php
$id = $_GET['id'];

$obj = new UserModal();
$row = $obj->getUserById($obj->conn->connection, "users", $id);
// var_dump($row);
?>
<div class="MainPage">
    <form class="InputForms" id="updateUser" enctype="multipart/form-data">
        <h1>Update User Details!</h1>
        <div class="mb-3 form-input">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp"
                value="<?php echo $row['name']; ?>" required />
            <div id="nameHelp" class="form-text">
                Enter the name of the new user.
            </div>
        </div>
        <div class="mb-3 form-input">
            <label for="breed" class="form-label">User Email</label>
            <input type="email" class="form-control" id="text" name="email" aria-describedby="breedHelp"
                value="<?php echo $row['email']; ?>" required />
        </div>
        <!-- <div class="mb-3 form-input">
            <label for="breed" class="form-label">Password</label>
            <input type="text" class="form-control" id="text" name="password" aria-describedby="breedHelp" required />
        </div> -->

        <div class="form-group">
            <label for="image">Image</label>
            <img src="Images/upload/<?php echo $row['image']; ?>" sir chashme door alt="Image" style="height:50px">
            <input type="file" name="image" class="form-control" aria-describedby="imageHelp" accept="image/*"/>
            <div id="imageHelp" class="form-text">
                Add an profile image for the user.
            </div>
        </div>
        <div class="mb-3 form-check" style="margin-top:10px">
            <input type="checkbox" class="form-check-input" id="dairy" name="adminRights" <?php if ($row['adminRights'] == "yes") { ?>checked <?php } ?> />
            <label class="form-check-label" for="dairy">Admin Privleges.</label>
        </div>

        <div>
            <h4>
                Some Optional Details
            </h4>
        </div>
        <div class="mb-3 form-input">
            <label for="job" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="job" name="job" value="<?php echo $row['job']; ?>" />
        </div>
        <div>
            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $row['id'] ?>" required>
        </div>
        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="mode btn submit">Update User</button>
            <a href="./MainDashBoard" class="mode btn submit">Cancel</a>
        </div>
    </form>
</div>
</div>

</body>

</html>


<script type="text/javascript">
    $(document).on('submit', '#updateUser', async function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set("id", id.value);
        // console.log (id.value);

        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./updateUserApi",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response == "updated") {
                    alert('success');
                    window.location.href = './ManageUsers';
                } else {
                    alert('error');

                }
            },
            error: function (xhr, textStatus, responseText) { }
        });

    });
// ------------------------------------
</script>
<script type="text/javascript">
//    Do'nt add Script here
//    Do it in a separate file in JS Folder and add the scripts in the footer
// ------------------------------------
</script>