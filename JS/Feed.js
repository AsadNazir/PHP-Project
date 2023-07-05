//Function for deleting feed using ajax

function deleteFeed() {
  var id = $("#delete_id").val();
  $("#deleteFeedModal").modal("hide");
  $.ajax({
    type: "get",
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
    },
  });
}

//AJAX for adding new feed

$(document).on("submit", "#AddFeed", async function (e) {
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
        alert("success");
        window.location.href = "./Feed";
      } else {
        alert("error");
      }
    },
    error: function (xhr, textStatus, responseText) {
        console.log(xhr.responseText, textStatus, responseText)
    },
  });
});
