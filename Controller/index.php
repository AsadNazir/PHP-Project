<?php
session_start();
require_once("./Model/db.php");

class Controller
{
    public $DbCon;
    public function __construct()
    {
        $this->DbCon = new Db();
    }
}

$Con = new Controller();


switch ($_SERVER["PATH_INFO"]) {
    case '/login':
        include("View/login.php");
        break;

    case '/MainDashBoard':

        if (isset($_REQUEST["email"]) && $_REQUEST["password"] == "admin") {
            $_SESSION["user"] = "admin";
            include("View/navbar.php");
            include("View/dashBoard.php");
            include("View/MainPageDashBoard.php");
        } else {
            header("Location: ./login");
        }
        break;

    case "/register":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/addCow.php");
        break;

    //Write Add Cow Bussiness Logic here
    case "/AddCow":
        echo "Succesfull";
        break;

    default:
        echo "<h1>ERROR 404 NOT FOUND</h1>";
        break;
}



?>