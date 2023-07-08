<?php
require_once("./Model/db.php");
include_once("CowController.php");
include_once("UserController.php");
include_once("DietController.php");

class Controllers
{
    public $DbCon;
    public function __construct()
    {
        $this->DbCon = new Db();
    }

    public function validateSession()
    {
        if (isset($_SESSION["name"])) {
            return true;
        }
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
    case "/UpdateCowPage":
    case "/updateCowApi":
    case "/DeleteCow":
    case "/MilkEntry":
    case "/Milk":
    case "/AddMilkApi":
    case "/GetMilkRecordsApi":
    case "/GetCowBreedsApi":
    case "/CowProfile":
    case "/GetACowMilkRecordsApi":
    case "/GetAllMilkRecordsByMonth":
    case "/GetAllMilkRecordsByDays":
    case "/GetAvgHighestRankOfCowApi":
        $CowCont = new CowController($_SERVER["PATH_INFO"], $_REQUEST, $_FILES);
        $CowCont->handleRequest();
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


    // Added User Controller Added
    //Admin and non admin Users
    case "/AddUsers":
    case "/AddUserApi":
    case "/ManageUsers":
    case "/DeleteUsersApi":
    case "/ValidateUserAPI":
    case "/UpdateUserPage":
    case "/updateUserApi":
        $Uc = new UserController($_SERVER["PATH_INFO"], $_REQUEST, $_FILES);
        $Uc->handleRequest();
        break;

    case "/AddNewDietPlan":
    case "/AddNewDietPlanApi":
    case "/AddFeedApi":
    case "/AddNewFeed":
    case "/DietPlans":
    case "/Feed":
    case "/DeleteFeedApi":
    case "/UpdateFeedPage":
    case "/updateFeedApi":
    case "/AssignAllDietPlan":
    case "/GetAllDietFeedsApi":
        $Dc = new DietController($_SERVER["PATH_INFO"], $_REQUEST, $_FILES);
        $Dc->handleRequest();
        break;
    default:
        header("Location: ./View/Error.php");
        break;
}

?>