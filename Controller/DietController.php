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

            case "/UpdateDietPlanPage":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/updateDietPlan.php");
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

            case "/DeleteDietPlanApi":
                $DietModalObj = new DietModal();
                $DietModalObj->deleteDietPlanApi($this->DbCon->connection, "diet", $this->request);
                break;

            case "/GetAllDietFeedsApi":
                $DietModalObj = new DietModal();
                $data = $DietModalObj->getAllDietPlans($this->DbCon->connection, "feed", $this->request['id']);
                if ($data == null) {
                    $data = [];
                }
                echo json_encode($data);
                break;

            case "/updateDietPlanApi":
                // echo $_REQUEST['cd_id'];
                // echo $_REQUEST['cowId'];

                $done2 = true;
                $DietModelObj2 = new DietModal();

                if ($_REQUEST['cd_id'] == "noId") {
                    if ($DietModelObj2->AddCowDietApi($this->DbCon->connection, "cow_diet", $this->request, $_REQUEST['cowId']) == false) {
                        echo "Error:" . $_REQUEST['cowId'] . " not Inserted.";
                        $done2 = false;
                        //Do something
                    }
                } else {
                    $cowD = $DietModelObj2->getCowDietByCowId($this->DbCon->connection, "cow_diet", $_REQUEST['cowId']);
                    // var_dump($cowD);
                    if ($DietModelObj2->UpdateCowDietApi($this->DbCon->connection, "cow_diet", $this->request, $_REQUEST['cowId'], $cowD[0]['id']) == false) {
                        echo "Error:" . $cowD[0]['id'] . " not Updated.";
                        $done2 = false;
                        //Do something
                    }
                }
                if ($done2) {
                    echo json_encode("updated");
                }
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

            case "/AssignDietPlanApi":
                $done = true;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Check if the checkboxes were submitted
                    if (isset($_POST['checkboxes']) && is_array($_POST['checkboxes'])) {
                        $selectedCheckboxes = $_POST['checkboxes'];
                        $DietModelObj2 = new DietModal();

                        // Process the selected checkboxes as needed
                        foreach ($selectedCheckboxes as $checkbox) {
                            // Do something with each selected checkbox
                            // echo $checkbox . '<br>';

                            $cowD = $DietModelObj2->getCowDietByCowId($this->DbCon->connection, "cow_diet", $checkbox);

                            if ($cowD) {
                                if ($cowD[0]['dietId'] != $_REQUEST['id']) {
                                    if ($DietModelObj2->UpdateCowDietApi($this->DbCon->connection, "cow_diet", $this->request, $checkbox, $cowD[0]['id']) == false) {
                                        echo "Error:" . $checkbox . " not Updated.";
                                        $done = false;
                                        //Do something
                                    }
                                }
                            } else {
                                if ($DietModelObj2->AddCowDietApi($this->DbCon->connection, "cow_diet", $this->request, $checkbox) == false) {
                                    echo "Error:" . $checkbox . " not Inserted.";
                                    $done = false;
                                    //Do something
                                }
                            }
                        }
                    }
                }
                if ($done) {
                    echo json_encode("added");
                }
                break;


            case "/GetAllFeedsApi":
                $DietModalObj = new DietModal();
                $data = $DietModalObj->getAllFeeds($this->DbCon->connection, "feed");
                if ($data == null) {
                    $data = [];
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