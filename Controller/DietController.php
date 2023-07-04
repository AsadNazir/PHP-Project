<?php
include_once("./index.php");
require_once("./Model/DietModal.php");
class DietController extends Controllers
{
    public $pathInfo;
    public $request;
    public $file;
    public function __construct($path, $req, $file)
    {
        parent::__construct();
        $this->pathInfo = $path;
        $this->request = $req;
        $this->file = $file;
    }

    public function handleRequest()
    {
        switch ($this->pathInfo) {

            case "/DietPlans":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/DietPlans.php");
                include("View/Footer.php");
                break;

            case "/AddNewDietPlan":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AddNewDietPlan.php");
                include("View/Footer.php");
                break;

            case "/AddNewDietPlanApi":

                break;

            case "/AddFeedApi":
                $DietModalObj = new DietModal();
                $DietModalObj->AddFeedApi($this->DbCon->connection, "feed", $this->request);

                break;

            case "/AddNewFeed":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AddNewFeed.php");
                include("View/Footer.php");
                break;

            case "/Feed":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/Feed.php");
                include("View/Footer.php");
                break;


            case "/DeleteFeedApi":

                $DietModalObj = new DietModal();
                $DietModalObj->deleteFeedApi($this->DbCon->connection, "feed", $this->request);
               
                break;

            default:
                echo "<h1>404 Not Found. Check Your Code User:)</h1>";
                break;
        }
    }

}


?>