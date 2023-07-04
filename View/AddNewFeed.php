<div class="MainPage">
    <form class="InputForms" id="AddFeed">
        <h1>Add Feed</h1>

        <div class="mb-3 form-input">
            <label for="feed" class="form-label">Enter Feed</label>
            <input type="text" class="form-control" id="feedName" name="feedName" aria-describedby="breedHelp"
                required />
        </div>
        <div class="mb-3 form-input">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" min="2" max="12" id="quantity" name="quantity"
                aria-describedby="breedHelp" required />

        </div>
        <div class="mb-3 form-input">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" min="0" id="price" name="price" aria-describedby="breedHelp"
                required />

        </div>

        <div class="submit_cont" style="margin-top:10px">
            <button type="submit" class="btn btn-success submit"><span><svg style="fill: white;"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="25" height="16">
                        <path
                            d="M11.28 6.78a.75.75 0 0 0-1.06-1.06L7.25 8.69 5.78 7.22a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l3.5-3.5Z">
                        </path>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1.5 0a6.5 6.5 0 1 0-13 0 6.5 6.5 0 0 0 13 0Z">
                        </path>
                    </svg></span>Add Feed</button>
            <a href="./Feed" class=" btn-danger btn submit">Cancel</a>
        </div>
    </form>
</div>
</div>

<script>


</script>