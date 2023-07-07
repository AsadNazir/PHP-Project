<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Page Title Here</title>
  <!-- JQuery -->
  <script src="./jquery.js"></script>
  <!-- Bootstrap over here -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
  <!-- External CSS Over Here -->
  <link rel="stylesheet" href="./CSS/index.css" />
  <link rel="stylesheet" href="./css/login.css" />
  <!-- External JS -->
  <!-- Include This is everywhere index.js in every php and html file -->
  <script src="./JS/index.js"></script>
</head>

<body class="dtheme_body">
  <div class="liveAlertPlaceHolder">
    <div class="alert alert-warning" role="alert">
      Ohh My Cow !. Please Enter Correct Crednetials !
    </div>
  </div>

  <div class="left_login">
    <img class="login_logo" src="./Images/Asset 2.svg" alt="" />
  </div>
  <div class="right_login">
    <button class="mode btn">
      <span class="icon"><i class="lni lni-sun"></i></span> Light Mode
    </button>
    <form method="POST" action="./MainDashBoard" onsubmit="return formSubmit()">
      <div class="left_login Login_form_logo">
        <img class="login_logo" src="./Images/Asset 2.svg" alt="" />
      </div>
      <div class="mb-3 form-input">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>
      <div class="mb-3 form-input">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" name="password" />
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Remember me</label>
      </div>
      <div class="submit_cont">
        <button type="submit" class="btn btn-primary submit">Submit</button>
      </div>
    </form>
  </div>
  <script>
    // jQuery
    // Submit button Validation
    let formSubmit = function (event) {

      const data = new FormData(document.querySelector('form'));

      var settings = {
        data: data,
        contentType: false,
        processData: false,

        type: "POST",
        url: "./ValidateUserAPI",
        success: function (response) {

          // Handle the response from the server
          res = JSON.parse(response);
          //alert(res["valid"]);
          if (res["valid"] === true) {
            location.href = './MainDashBoard';
          }
          else {//Reappearing the Alert
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
          alert('An error has occurred');
          console.log(err, type, httpStatus);
          return false
        }
      };


      $.ajax(settings);

      return false;
    };

  </script>
</body>

</html>