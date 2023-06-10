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
}

$Con = new Controllers();


switch ($_SERVER["PATH_INFO"]) {
    case '/login':
        include("View/login.php");
        break;

    case '/MainDashBoard':

        if (isset($_REQUEST["email"]) || $_SESSION["user"] == "admin") {
            $_SESSION["user"] = "admin";
            include("View/navbar.php");
            include("View/dashBoard.php");
            include("View/MainPageDashBoard.php");
            // include("View/cards.php");
        } else {
            header("Location: ./login");
        }
        break;

    case "/register":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/addCow.php");
        break;

    //Write Add Cow Business Logic here
    case "/AddCow" || "/UpdateCow" || "/DeleteCow":
        $CowCont = new CowController($_SERVER["PATH_INFO"],$_REQUEST, $_FILES);
        $CowCont->handleRequest();
        break;

    case "/updateCowApi":
       
        break;

    case "/Delete":
        
        


        break;

    case "/logout":
        session_destroy();
        header("Location: ./login");
        break;

    case "/Notification":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/Notification.php");
        break;

    case "/Chart":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/Chart.php");
        break;

    default:
        header("Location: ./View/Error.php");
        break;
}



?>