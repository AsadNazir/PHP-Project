<?php
include_once("./index.php");
require_once("./Model/CowModal.php");
class CowController extends Controllers
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

            case "/UpdateCowPage":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/update.php");
                include("View/Footer.php");
                break;

            case "/Milk":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/Milk.php");
                include("View/Footer.php");
                break;

            case "/MilkEntry":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/MilkEntry.php");
                include("View/Footer.php");
                break;

            case "/CowProfile":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/CowProfile.php");
                include("View/Footer.php");
                break;

            case '/AddCow':
                $CowModalObj = new CowModal();
                $CowModalObj->addCowApi($this->DbCon->connection, "cows", $this->request, $this->file);
                break;

            case "/updateCowApi":
                $CowModalObj = new CowModal();
                $CowModalObj->UpadteCowAPI($this->DbCon->connection, "cows", $this->request, $this->file);
                break;

            case "/DeleteCow":
                $CowModalObj = new CowModal();
                $CowModalObj->deleteCowApi($this->DbCon->connection, "cows", $this->request);
                break;

            case "/AddMilkApi":
                $CowModalObj = new CowModal();
                $CowModalObj->AddMilkEntryApi($this->DbCon->connection, "milk", $this->request);
                break;

            // API to get all milk records
            case "/GetMilkRecordsApi":
                $CowModalObj = new CowModal();
                //getting the records from the database
                $data = $CowModalObj->getAllMilkRecordsAPI($this->DbCon->connection, 'milk');

                //checking if the data is null
                if ($data == null) {
                    $data = [];
                }
                //sending the data to the view
                echo json_encode($data);
                break;

            case "/GetCowBreedsApi":
                $CowModalObj = new CowModal();
                $data = $CowModalObj->GetCowBreedsAPI($this->DbCon->connection, 'cows');

                if ($data == null) {
                    $data = [];
                }
                echo json_encode($data);
                break;

            //Returning Annual, weekly and monthly, Daily milk records
            case "/GetACowMilkRecordsApi":
                $CowModalObj = new CowModal();
                $data = $CowModalObj->getACowMilkRecord($this->DbCon->connection, 'milk', $this->request['id']);
                if ($data == null) {
                    $data = [];
                }
                echo json_encode($data);
                break;

            case "/GetAllMilkRecordsByDays":
                $CowModalObj = new CowModal();

                //getting the records from the database
                $data = $CowModalObj->getAllMilkRecordsByDaysAPI($this->DbCon->connection, 'milk', $this->request['id'], $this->request["month"]);

                if ($data == null) {
                    $data = [];
                }
                echo json_encode($data);
                break;

            // API to get all milk records by month
            case "/GetAllMilkRecordsByMonth":
                $CowModalObj = new CowModal();
                //getting the records from the database
                $data = $CowModalObj->getAllMilkRecordsByMonthAPI($this->DbCon->connection, 'milk', $this->request['id']);

                //checking if the data is null
                if ($data == null) {
                    $data = [];
                }
                //sending the data to the view
                echo json_encode($data);
                break;

            case "/GetAvgHighestRankOfCowApi":
                $CowModalObj = new CowModal();
                $data = $CowModalObj->GetAvgHighestRankOfCowApi($this->DbCon->connection, 'milk', $this->request['id']);
                if ($data == null) {
                    $data = [];
                }
                echo json_encode($data);
                break;

            case "/MedicalEntryApi":
                $CowModalObj = new CowModal();
                // $res = 
                $CowModalObj->EnterMedicalApi($this->DbCon->connection, "medical", $this->request);
                
                // echo json_encode($res);
                break;
                
            case "/Medical":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/MedicalEntry.php");
                include("View/Footer.php");
                break;
            default:
                echo "404 Not Found !";
                break;
        }
    }

}


?>