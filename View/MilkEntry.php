<?php ?>
<div class="MainPage">
    <form class="InputForms" id="addNewUser" enctype="multipart/form-data">
        <h1>Manual Milk Entry</h1>
        <div class="mb-3 form-input">
            <select class="form-select" aria-label="Default select example">
                <option selected>Select the Cow</option>
                <?php

                ?>
                <!-- PHP se backend se cows ki ids along with names chye hoge idhr -->
                <option value="1">Cow 1</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>



        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Select date</label>
            <input type="date" class="form-control" id="text" name="email" aria-describedby="breedHelp" required />
        </div>


        <div class="mb-3 form-input">
            <label for="quantity" class="form-label">Milk Quantity</label>
            <input type="number" class="form-control" min="0" id="text" name="password" aria-describedby="breedHelp"
                required />
        </div>
        <div class="mb-3 form-input">
            <label for="breed" class="form-label">Ph Level</label>
            <input type="number" class="form-control" min="2" max="12" id="text" name="email"
                aria-describedby="breedHelp" required />
        </div>
        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="mode btn submit">Add the entry</button>
            <a href="./MainDashBoard" class="mode btn submit">Cancel</a>
        </div>
    </form>
</div>
</div>

</body>

</html>