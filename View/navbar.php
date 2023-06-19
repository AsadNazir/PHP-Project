<!-- navbar php is fine here as it a stand alone component -->
<!-- Session Handling in PHP -->
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

  <!-- External CSS Over Here -->
  <link rel="stylesheet" href="./CSS/index.css" />
  <link rel="stylesheet" href="./CSS/navbar.css" />
  <link rel="stylesheet" href="./CSS/DashBoard.css" />

  <!-- Fonts Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Dynamic adding of CSS Files -->
  <?php
  if ($_SERVER["PATH_INFO"] == "/register" || $_SERVER["PATH_INFO"]=="/AddUsers")
    echo "<link rel=\"stylesheet\" href=\"./CSS/AddForms.css\"/>"

      ?>
  <?php
  if ($_SERVER["PATH_INFO"] == "/Notification")
    echo "<link rel=\"stylesheet\" href=\"./CSS/Notification.css\"/>"

      ?>
  <?php
  if ($_SERVER["PATH_INFO"] == "/Chart")
    echo "<link rel=\"stylesheet\" href=\"./CSS/Chart.css\"/>"

      ?>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- External JS -->
    <!-- Include This is everywhere index.js in every php and html file -->
    <script src="JS/index.js"></script>
  </head>

  <body class="ltheme_body">
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <div class="logoText">
          <a class="navbar-brand" href="#">
            <img src="Images/Asset 2.svg" alt="Logo" class="d-inline-block align-text-top" />
            <span>Cow Automation</span>
          </a>
        </div>
        <button class="navbar-toggler menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span> Menu </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./MainDashBoard">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout">Logout</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                More
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./AddUsers">Add User</a></li>
                <li><a class="dropdown-item" href="./ManageUsers">Manage Users</a></li>
                <li><a class="dropdown-item" href="#">View Profile</a></li>
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

    <!-- Here all of our websites can be loaded all the pages after this tag -->
    <div class="dashBoardBody">