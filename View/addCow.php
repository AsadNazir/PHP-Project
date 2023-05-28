<div class="MainPage">
    <form method="POST" action="./AddCow" onsubmit="return formSubmit()">
        <div class="mb-3 form-input">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" id="email" name="text" aria-describedby="emailHelp" />
            <div id="emailHelp" class="form-text">
                Give your cow a unique name.
            </div>
        </div>
        <div class="mb-3 form-input">
            <label for="exampleInputEmail1" class="form-label">Race / Breed</label>
            <input type="text" class="form-control" id="text" name="email" aria-describedby="emailHelp" />

        </div>
        <div class="mb-3 form-input">
            <label for="exampleInputPassword1" class="form-label">Age</label>
            <input type="number" class="form-control" id="pass" name="password" max="100" min="0" />
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" />
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Male
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Female
            </label>
        </div>

        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile04">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
            </div>
        </div>
        <div class="submit_cont">
            <button type="submit" class="btn btn-primary submit">Submit</button>
        </div>
    </form>
</div>
</div>

</body>

</html>