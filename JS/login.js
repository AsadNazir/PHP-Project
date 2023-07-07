// jQuery
// Submit button Validation
let formSubmit = function (event) {
  const data = new FormData(document.querySelector("form"));

  var settings = {
    data: data,
    contentType: false,
    processData: false,
  
    type: "POST",
    url: "./ValidateUserAPI",
    success: function (response) {
      // Handle the response from the server
      debugger;
      res = JSON.parse(response);

      //alert(res["valid"]);
      if (res["valid"] === true) {
        location.href = "./MainDashBoard";
        return true;
      } 
      
      else {
        //Reappearing the Alert
        $(".liveAlertPlaceHolder").css("top", `2%`);

        //Disappearing the Alert after 4 secs
        setTimeout(() => {
          $(".liveAlertPlaceHolder").css("top", `-100%`);
        }, 4000);
      }
      return false;
    },
    error: function (err, type, httpStatus) {
      // Handle the error response
      alert("An error has occurred");
      console.log(err, type, httpStatus);
      return false;
    },
  };

  $.ajax(settings);

  return false;
};
