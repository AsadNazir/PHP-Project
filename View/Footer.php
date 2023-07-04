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
if ($_SERVER["PATH_INFO"] == "/AddNewDietPlan") {
  echo '<script src="./JS/DietPlan.js"></script>';
}

?>

<script>

  //Function for setting id for deleting any record

  function setDeleteId(id) {
    $('#delete_id').val(id);
  }

  //Function for deleting user using ajax

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

  //Function for deleting feed using ajax

  function deleteFeed() {
    var id = $('#delete_id').val();
    $('#deleteFeedModal').modal('hide');
    $.ajax({
      type: 'get',
      data: {
        id: id,
      },
      url: "./DeleteFeedApi",
      success: function (data) {
        console.log(data);
        // console.log(data);
        var response = JSON.parse(data);

        if (response == "deleted") {
          location.reload();
        }
      }
    })
  }


  //Function for deleting cow using ajax

  function deleteCow() {
    var id = $('#delete_id').val();
    $('#deleteCowModal').modal('hide');
    $.ajax({
      type: 'get',
      data: {
        id: id,
      },
      url: "./DeleteCow",
      success: function (data) {
        var response = JSON.parse(data);

        if (response == "deleted") {
          location.reload();
        }
      }
    })
  }


  //AJAX for adding a new user

  $(document).on('submit', '#addNewUser', async function (e) {
    e.preventDefault();

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

   //AJAX for adding new feed

   $(document).on('submit', '#AddFeed', async function (e) {
    e.preventDefault();

    var data = new FormData(this);

    //AJAX Request for saving the data --------------------------

    $.ajax({
      data: data,
      type: "POST",
      url: "./AddFeedApi",
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (JSON.parse(data) == "added") {
          alert('success');
          window.location.href = './Feed';
        } else {
          alert('error');

        }
      },
      error: function (xhr, textStatus, responseText) { }
    });

  });

 


</script>
</body>

</html>