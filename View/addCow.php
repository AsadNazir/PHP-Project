<div class="MainPage">
    <form id="addNewCow" enctype="multipart/form-data">
        <h1>Add your Animal to the Farm !</h1>
        <div class="mb-3 form-input">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required />
            <div id="nameHelp" class="form-text">
                Give your cow a unique name.
            </div>
        </div>
        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Race / Breed</label>
            <input type="text" class="form-control" id="text" name="breed" aria-describedby="breedHelp" required />
        </div>
        <label for="gender" class="form-label">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="female" checked>
            <label class="form-check-label" for="gender">
                Female
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
            <label class="form-check-label" for="gender">
                Male
            </label>
        </div>
        <div class="mb-3 form-input">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" max="25" min="0" required />
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" aria-describedby="imageHelp" accept="image/*" required />
            <div id="imageHelp" class="form-text">
                Add beautiful image of your cow.
            </div>
        </div>
        <div class="form-group specialFormGroup">
            <div class="mb-3 form-check" style="margin-top:10px">
                <input type="checkbox" class="form-check-input" id="dairy" name="dairy" />
                <label class="form-check-label" for="dairy">Is your cow a dairy cow?</label>
            </div>
            <div class="mb-3 form-check" style="margin-top:10px">
                <input type="checkbox" class="form-check-input" id="insemination" name="insemination" />
                <label class="form-check-label" for="dairy">Insemination ?</label>
            </div>
        </div>
        <div>
            <h4>
                Add some more details about your cow
            </h4>
        </div>
        <div class="form-group specialFormGroup">
            <div class="mb-3 form-input">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight" min="0" />
            </div>
            <div class="mb-3 form-input">
                <label for="height" class="form-label">Height</label>
                <input type="number" class="form-control" id="height" name="height" min="0" />
            </div>
        </div>
        <div class="form-group specialFormGroup">
            <div class="mb-3 form-input">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" id="color" name="color" />
            </div>
            <div class="mb-3 form-input">
                <label for="color" class="form-label">Price in Rs</label>
                <input type="number" min="0" class="form-control" id="price" name="price" />
            </div>
        </div>
        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn submit">Add Animal</button>
            <a href="./MainDashBoard" class="btn submit btn-danger">Cancel</a>
        </div>

    </form>
</div>
</div>

</body>

</html>

<script type="text/javascript">
    $(document).on('submit', '#addNewCow', async function (e) {
        e.preventDefault();

        var data = new FormData(this);

        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./AddCow",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (JSON.parse(data) == "added") {
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