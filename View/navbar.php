<!-- navbar php is fine here as it a stand alone component -->
<!-- Session Handling in PHP -->

<!-- Getting if the current user has Admin rights ir not -->
<?php
$isAdmin = $_SESSION["isAdmin"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="./Images/Asset 2.svg">
  <title>
    <?php

    switch ($_SERVER["PATH_INFO"]) {
      case '/register':
        echo "Register | Add Cow | Dairy Farm Management System";
        break;
      case '/Medical':
        echo "Medical | Dairy Farm Management System";
        break;
      case '/Milk':
        echo "Milk | Dairy Farm Management System";
        break;
      case '/CowProfile':
        echo "Cow Profile | Dairy Farm Management System";
        break;
      case '/MainDashBoard':
        echo "Dashboard | Dairy Farm Management System";
        break;
      case "/Chart":
        echo "Charts | Dairy Farm Management System";
        break;
      case "/Feed":
        echo "Feed | Dairy Farm Management System";
        break;
      case "/DietPlans":
        echo "Diet Plans | Dairy Farm Management System";
        break;
      case "/AddNewDietPlan":
        echo "Add Diet Plan | Dairy Farm Management System";
        break;
      case "/UpdateDietPlan":
        echo "Update Diet Plan | Dairy Farm Management System";
        break;
      case "/Notification":
        echo "Notification | Dairy Farm Management System";
        break;
      case "/MilkEntry":
        echo "Milk Entry | Dairy Farm Management System";
        break;
      default:
        echo "Dairy Farm Management System";
        break;
    }

    ?>





  </title>

  <!-- JQuery -->

  <!-- ✅ load jquery ✅ -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- ✅ Load CSS file for jQuery UI and JQuery UI -->
  <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  <!-- I don'nt know what is this -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
    integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap over here -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

  <!-- External CSS Over Here -->
  <link rel="stylesheet" href="CSS/index.css" />
  <link rel="stylesheet" href="CSS/navbar.css" />
  <link rel="stylesheet" href="CSS/DashBoard.css" />
  <link rel="stylesheet" href="CSS/AddForms.css">

  <!-- Fonts Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- JS Pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Dynamic adding of CSS Files -->
  <?php
  if ($_SERVER["PATH_INFO"] == "/AddNewDietPlan" || $_SERVER["PATH_INFO"] == "/Feed" || $_SERVER["PATH_INFO"] == "/DietPlans")
    echo "<link rel=\"stylesheet\" href=\"CSS/DietPlan.css\"/>"

      ?>
    <?php
  if ($_SERVER["PATH_INFO"] == "/register" || $_SERVER["PATH_INFO"] == "/AddUsers")
    echo "<link rel=\"stylesheet\" href=\"CSS/AddForms.css\"/>"

      ?>
    <?php
  if ($_SERVER["PATH_INFO"] == "/Notification")
    echo "<link rel=\"stylesheet\" href=\"CSS/Notification.css\"/>"

      ?>
    <?php
  if ($_SERVER["PATH_INFO"] == "/Chart")
    echo "<link rel=\"stylesheet\" href=\"CSS/Chart.css\"/>"

      ?>
    <?php
  if ($_SERVER["PATH_INFO"] == "/CowProfile")
    echo "<link rel=\"stylesheet\" href=\"CSS/Profile.css\"/>"

      ?>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- This is JSPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
      integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>

  <body class="ltheme_body">
    <nav class="navbar-expand-lg navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <a class="navbar-brand logoText" href="./MainDashBoard">
          <img src="Images/Asset 2.svg" width="65" height="65" alt="Logo" class="d-inline-block align-text-top" />
          Milkesters
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./MainDashBoard">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout">Logout</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                More Options
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li class="profilePic dropdown-item">
                  <div>
                    <?php
  $UserModalObj = new UserModal();
  $result = $UserModalObj->getUserByEmail($UserModalObj->conn->connection, "users", $_SESSION['email']);
  ?>
                  <img src="Images/upload/<?php echo $result['image']; ?>" alt="">
                  <span>
                    <?php
                    if ($isAdmin == 'yes') {
                      echo "Admin";
                    } else {
                      echo "Not Admin";
                    } ?>
                  </span>

                </div>
                <h2>
                  <?php echo $_SESSION["name"]; ?>
                </h2>
              </li>
              <?php

              if ($isAdmin == 'yes') {
                echo '<li><a class="dropdown-item" href="./AddUsers">Add User</a></li>
                    <li><a class="dropdown-item" href="./ManageUsers">Manage Users</a></li>';
              }

              ?>

              <li><a class="dropdown-item" href="#">View Profile</a></li>
            </ul>
          </li>
          <button class="mode btn">
            <span class="icon"><i class="lni lni-sun"></i></span>
          </button>
        </ul>
      </div>
    </div>
  </nav>

  <!-- <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <div class="logoText">
          <a class="navbar-brand" href="./MainDashBoard">
            <img src="Images/Asset 2.svg" alt="Logo" class="d-inline-block align-text-top" />
            <span>Milkesters</span>
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
              <a class="nav-link" href="./logout">Logout</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                More
              </a>
              <ul class="dropdown-menu">
                <li class="profilePic dropdown-item">
                  <div>
                    <img src="Images/cool_image.jfif" alt="">
                    <span>Not Admin</span>
                  </div>
                  <h2>
                  <?php //echo $_SESSION["name"]; ?>
                </h2>
              </li>

              
              <?php

              // if ($isAdmin == 'yes') {
              //   echo '<li><a class="dropdown-item" href="./AddUsers">Add User</a></li>
              //       <li><a class="dropdown-item" href="./ManageUsers">Manage Users</a></li>';
              // }
              

              ?>


              <li><a class="dropdown-item" href="#">View Profile</a></li>
              <li>
                <a class="dropdown-item" href="#"></a>
              </li>
            </ul>
          </li>
          <button class="mode btn">
            <span class="icon"><i class="lni lni-sun"></i></span>
          </button>
        </ul>
      </div>
    </div>
  </nav> -->

  <!-- Here all of our websites can be loaded all the pages after this tag -->
  <div class="dashBoardBody">