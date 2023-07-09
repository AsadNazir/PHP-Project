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
if ($_SERVER["PATH_INFO"] == "/AddNewFeed" || $_SERVER["PATH_INFO"] == "/Feed") {
  echo '<script src="./JS/Feed.js"></script>';
}
if ($_SERVER["PATH_INFO"] == "/Notifications" || $_SERVER["PATH_INFO"] == "/DietPlans" || $_SERVER["PATH_INFO"] == "/Milk" || $_SERVER["PATH_INFO"] == "/Feed") {
  echo '<script src="./JS/search.js"></script>';
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


  //AJAX for adding milk entry

  $(document).on('submit', '#AddMilk', async function (e) {
    e.preventDefault();

    var data = new FormData(this);
    selectElement = document.querySelector('#cow');
    var x = selectElement.value;
    console.log(x);
    data.set("id", x);

    //AJAX Request for saving the data --------------------------

    $.ajax({
      data: data,
      type: "POST",
      url: "./AddMilkApi",
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (JSON.parse(data).status == "added") {
          alert('success');
          window.location.href = './Milk';
        } else {
          alert('error');

        }
      },
      error: function (xhr, textStatus, responseText) { }
    });

  });

//Function for deleting dietplan using ajax

function deleteDietPlan() {
    var id = $('#delete_id').val();
    $('#deleteDietPlanModal').modal('hide');
    $.ajax({
      type: 'get',
      data: {
        id: id,
      },
      url: "./DeleteDietPlanApi",
      success: function (data) {
        var response = JSON.parse(data);

        if (response == "deleted") {
          location.reload();
        }
      }
    })
  }

</script>
</body>

</html>