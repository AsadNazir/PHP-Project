<?php ?>
<div class="MainPage">
    <form class="InputForms" id="addNewUser" enctype="multipart/form-data">
        <h1>Add New Users !</h1>
        <div class="mb-3 form-input">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required />
            <div id="nameHelp" class="form-text">
                Enter the name of the new user.
            </div>
        </div>
        <div class="mb-3 form-input">
            <label for="breed" class="form-label">User Email</label>
            <input type="email" class="form-control" id="text" name="email" aria-describedby="breedHelp" required />
        </div>
        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Password</label>
            <input type="text" class="form-control" id="text" name="password" aria-describedby="breedHelp" required />
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" aria-describedby="imageHelp" accept="image/*" required />
            <div id="imageHelp" class="form-text">
                Optional If you want to upload the image of the User.
            </div>
        </div>
        <div class="mb-3 form-check" style="margin-top:10px">
            <input type="checkbox" class="form-check-input" id="dairy" name="adminRights" />
            <label class="form-check-label" for="dairy">Admin Privleges.</label>
        </div>

        <div>
            <h4>
                Some Optional Details
            </h4>
        </div>
        <div class="mb-3 form-input">
            <label for="job" class="form-label">Job Title</label>
            <input type="text" class="form-control" id="job" name="job"/>
        </div>
        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn submit">Add User</button>
            <a href="./MainDashBoard" class="btn submit btn-danger">Cancel</a>
        </div>
    </form>
</div>
</div>

</body>

</html>

<script type="text/javascript">
//    Do'nt add Script here
//    Do it in a separate file in JS Folder and add the scripts in the footer
// ------------------------------------
</script>