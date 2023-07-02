<?php
// Write php code for footer here if neccessary
// Always include footer in every page

?>
<!-- Footer will come somwhere over here -->
</div>
<?php

if ($_SERVER["PATH_INFO"] == "/Chart") {
  echo '<script src="./JS/Charts.js"></script>';
}

?>

<script>
  function setDeleteId(id) {
    $('#delete_id').val(id);
  }

  function deleteUser() {
    var id = $('#delete_id').val();
    $('#deleteUserModal').modal('hide');
    $.ajax({
      type: 'get',
      data: {
        id: id,
      },
      url: "./DeleteUsersApi",
      success: function (data) {
        // console.log(data);
        // console.log(data);
        var response = JSON.parse(data);

        if (response == "deleted") {
          location.reload();
        }
      }
    })
  }
</script>
<script>

</script>
</body>

</html>