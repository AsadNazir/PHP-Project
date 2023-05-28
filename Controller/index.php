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

// var_dump($_SERVER);
// echo $_SERVER["PATH_INFO"];

switch ($_SERVER["PATH_INFO"]) {
    case '/login':
        include("View/login.php");
        break;

    case '/MainDashBoard':

        if (isset($_REQUEST["email"]) && $_REQUEST["password"] == "admin") {
            $_SESSION["user"]="admin";
            include("View/dashBoard.php");
        }

        else
        {
            header("Location: ./login");
        }
        break;

    default:
        echo "<h1?>ERROR 404 NOT FOUND</h1>";
        break;
}



?>