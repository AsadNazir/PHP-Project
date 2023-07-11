<?php ?>
<?php
$id = $_GET['id'];

$obj = new DietModal();
$row = $obj->getFeedById($obj->conn->connection, "feed", $id);
// var_dump($row);
?>
<div class="MainPage">
    <form class="InputForms" id="updateFeed">
        <h1>Update Animal Feed!</h1>

        <div class="mb-3 form-input">
            <label for="feed" class="form-label">Enter Feed</label>
            <input type="text" class="form-control" id="feedName" name="feedName" aria-describedby="breedHelp"
                value="<?php echo $row['name']; ?>" required />
        </div>
        <div class="mb-3 form-input">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" min="2" max="12" id="quantity" name="quantity"
                value="<?php echo $row['quantity']; ?>" aria-describedby="breedHelp" required />

        </div>
        <div class="mb-3 form-input">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" min="0" id="price" name="price" aria-describedby="breedHelp"
                value="<?php echo $row['price']; ?>" required />
        </div>

        <div>
            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $row['id'] ?>" required>
        </div>

        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn btn-success submit"><span><svg style="fill: white;"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25" height="16">
                        <path
                            d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                        </path>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                        </path>
                    </svg></span>Update Feed</button>
            <a href="./Feed" class=" btn-danger btn submit">Cancel</a>
        </div>

    </form>
</div>
</div>

</body>

</html>


<script type="text/javascript">
    $(document).on('submit', '#updateFeed', async function (e) {
        e.preventDefault();

        var data = new FormData(this);
        data.set("id", id.value);
        // console.log (id.value);

        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./updateFeedApi",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var response = JSON.parse(data);
                if (response == "updated") {
                    alert('success');
                    window.location.href = './Feed';
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