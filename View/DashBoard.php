
<!-- Session Handling in PHP -->

<?php

    if(!isset($_SESSION["user"]))
    {
        header("Location : /login");
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DashBoard | Page Title here</title>

    <!-- JQuery -->
    <script src="./jquery.js"></script>
    <!-- Bootstrap over here -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

    <!-- External CSS Over Here -->
    <link rel="stylesheet" href="./CSS/index.css" />
    <link rel="stylesheet" href="./CSS/navbar.css" />
    <link rel="stylesheet" href="./CSS/DashBoard.css" />
    <!-- External JS -->
    <!-- Include This is everywhere index.js in every php and html file -->
    <script src="JS/index.js"></script>
  </head>

  <body class="ltheme_body">
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <div class="logoText">
          <a class="navbar-brand" href="#">
            <img
              src="Images/Asset 2.svg"
              alt="Logo"
              class="d-inline-block align-text-top"
            />
            <span>Cow Automation</span>
          </a>
        </div>
        <button
          class="navbar-toggler menu"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span> Menu </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Logout</a>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                More
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Notifications</a></li>
                <li><a class="dropdown-item" href="#">Download Reports</a></li>
                <li>
                  <a class="dropdown-item" href="#"></a>
                </li>
              </ul>
            </li>
            <button class="mode btn">
              <span class="icon"><i class="lni lni-sun"></i></span> Light Mode
            </button>
          </ul>
        </div>
      </div>
    </nav>

    <!-- <div class="offcanvas offcanvas-bottom show" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body small">
        ...
      </div>
    </div> -->

    <!-- NavBar Ends Here -->

    <div class="dashBoardBody">
      <div class="sideBar">Side Bar</div>
      <div class="MainPage">
        <div class="MilkProduction">
          <div>
            <h1>Annual</h1>
            <h3>0 ltr</h3>
          </div>
          <div>
            <h1>Annual</h1>
             <!-- Upadate the Production here in PHP  -->
            <h3>0 ltr</h3>
            <a href="#">more</a>
          </div>
          <div>
            <h1>Annual</h1>
             <!-- Upadate the Production here in PHP  -->
            <h3>0 ltr</h3>
            <a href="#">more</a>
          </div>
          <div>
            <h1>Annual</h1>
             <!-- Upadate the Production here in PHP  -->
            <h3>0 ltr</h3>
            <a href="#"
              >More
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-caret-right-fill"
                viewBox="0 0 16 16"
              >
                <path
                  d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"
                /></svg
            ></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
