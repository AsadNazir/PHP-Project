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

            case "/AddNewFeed":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AddNewFeed.php");
                include("View/Footer.php");
                break;

            case "/AssignAllDietPlan":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AssignAllDietPlan.php");
                include("View/Footer.php");
                break;

            case "/Feed":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/Feed.php");
                include("View/Footer.php");
                break;

            case "/UpdateFeedPage":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/updateFeed.php");
                include("View/Footer.php");
                break;

            case "/AddNewDietPlanApi":
                $DietModelObj = new DietModal();
                $DietModelObj->AddDietPlanApi($this->DbCon->connection, "diet", $this->request);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Check if the checkboxes were submitted
                    if (isset($_POST['checkboxes']) && is_array($_POST['checkboxes'])) {
                        $selectedCheckboxes = $_POST['checkboxes'];
                        $DietModelObj2 = new DietModal();

                        // Process the selected checkboxes as needed
                        foreach ($selectedCheckboxes as $checkbox) {
                            // Do something with each selected checkbox
                            // echo $checkbox . '<br>';

                            if ($DietModelObj2->AddDietFeedApi($this->DbCon->connection, "diet_feed", $this->request, $checkbox) == false) {
                                echo "Error:" . $checkbox . " not Inserted.";
                                //Do something
                            }
                        }
                    }
                }
                break;

            case "/AddFeedApi":
                $DietModalObj = new DietModal();
                $DietModalObj->AddFeedApi($this->DbCon->connection, "feed", $this->request);
                break;

            case "/DeleteFeedApi":
                $DietModalObj = new DietModal();
                $DietModalObj->deleteFeedApi($this->DbCon->connection, "feed", $this->request);
                break;

            case "/updateFeedApi":
                $DietModalObj = new DietModal();
                $DietModalObj->UpdateFeedAPI($this->DbCon->connection, "users", $this->request, $this->file);
                break;
            case "/GetAllDietFeedsApi":
                $DietModalObj = new DietModal();
                $data= $DietModalObj->getAllDietPlans($this->DbCon->connection, "feed", $this->request['id']);
                if($data==null)
                {
                    $data=[];
                }
                echo json_encode($data);
                break;
            case "/GetAllDietFeedsApi":
                $DietModalObj = new DietModal();
                $data= $DietModalObj->getAllDietPlans($this->DbCon->connection, "feed", $this->request['id']);
                if($data==null)
                {
                    $data=[];
                }
                echo json_encode($data);
                break;

            default:
                echo "<h1>404 Not Found. Check Your Code User:)</h1>";
                break;
        }
    }

}


?>