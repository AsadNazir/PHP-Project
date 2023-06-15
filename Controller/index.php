<?php
session_start();
require_once("./Model/db.php");
include_once("CowController.php");

class Controllers
{
    public $DbCon;
    public function __construct()
    {
        $this->DbCon = new Db();
    }

    public function validateSession()
    {
        if (isset($_REQUEST["email"]) || $_SESSION["user"] == "admin")
            return true;
        else
            return false;
    }
}

$Con = new Controllers();


switch ($_SERVER["PATH_INFO"]) {
    case '/login':
        include("View/login.php");
        break;

    case '/MainDashBoard':

        if ($Con->validateSession()) {
            $_SESSION["user"] = "admin";
            include("View/navbar.php");
            include("View/Sidebar.php");
            include("View/MainPageDashboard.php");
            //Footer view also includes the ending html tags and div tags so always include it our pages
            include("View/Footer.php");
        } else {
            header("Location: ./login");
        }
        break;

    case "/register":
        if ($Con->validateSession()) {
            include("View/navbar.php");
            include("View/Sidebar.php");
            include("View/addCow.php");
            include("View/Footer.php");
        } else {
            header("Location: ./login");
        }
        break;

    // Write Add Cow Business Logic here
    // Cow Related all Request will be sent to Cow Controller
    // Add More Cow related bussiness Logic here
    case "/AddCow":
    case "/UpdateCow":
    case "/DeleteCow":
        if ($Con->validateSession()) {
            $CowCont = new CowController($_SERVER["PATH_INFO"], $_REQUEST, $_FILES);
            $CowCont->handleRequest();
        } else {
            header("Location: ./login");
        }
        break;

    case "/logout":
        session_destroy();
        header("Location: ./login");
        break;

    case "/Notification":
        include("View/navbar.php");
        include("View/Sidebar.php");
        include("View/Notification.php");
        include("View/Footer.php");
        break;

    case "/Chart":
        include("View/navbar.php");
        include("View/Sidebar.php");
        include("View/Chart.php");
        include("View/Footer.php");
        break;

    default:
    header("Location: ./View/Error.php");
    break;
}



?>