<script type="text/javascript">
    $(document).on('submit', '#addNewUser', async function (e) {
        //e.preventDefault();

        var data = new FormData(this);

        //AJAX Request for saving the data --------------------------

        $.ajax({
            data: data,
            type: "POST",
            url: "./AddUserApi",
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (JSON.parse(data).status == "updated") {
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