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

            case '/AddCow':

                $name = $this->request['name'];
                $breed = $this->request['breed'];
                $gender = $this->request['gender'];
                $age = $this->request['age'];
                if (isset($this->request['dairy'])) {
                    $dairy = "yes";
                } else {
                    $dairy = "no";
                }
                $weight = $this->request['weight'];
                $height = $this->request['height'];
                $color = $this->request['color'];


                $CowModal = new CowModal();


                $NewImageName = $CowModal->UploadImage("Images/upload", $this->file);

                $data = [
                    'name' => $name,
                    'breed' => $breed,
                    'gender' => $gender,
                    'age' => $age,
                    'dairy' => $dairy,
                    'weight' => $weight,
                    'height' => $height,
                    'color' => $color,
                    'image' => $NewImageName
                ];

                $CowModalObj = new CowModal();

                $insertion = $CowModalObj->addNewCow($this->DbCon->connection, 'cows', $data);
                $output["status"] = $insertion;

                echo json_encode($output);

                break;

            case "/UpdateCowPage":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/update.php");
                include("View/Footer.php");
                break;

            case "/DeleteCow":

                $id = $this->request['id'];

                $CowModalObj = new CowModal();

                $CowModalObj->deleteCow($this->DbCon->connection, 'cows', $id);
                $deletion = $CowModalObj->deleteCow($this->DbCon->connection, 'cows', $id);
                $output["status"] = $deletion;

                if ($output['status'] == "deleted") {

                    echo json_encode($output['status']);
                }

                break;

            //API are named API's
            case "/updateCowApi":
                $CowModalObj = new CowModal();
                $CowModalObj->UpadteCowAPI($this->DbCon->connection, "cows", $this->request, $this->file);

                break;

            case "/MilkEntry":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/MilkEntry.php");
                include("View/Footer.php");

                break;

            case "/AddMilkApi":

                $cow = $this->request['id'];
                $date = $this->request['date'];
                $milk = $this->request['milk'];
                $ph = $this->request['ph'];

                $data = [
                    'cow' => $cow,
                    'date' => $date,
                    'milk' => $milk,
                    'ph' => $ph
                ];

                $CowModalObj = new CowModal();

                $insertion = $CowModalObj->AddMilkEntry($this->DbCon->connection, 'milk', $data);
                $output["status"] = $insertion;

                echo json_encode($output);
                break;

            // API to get all milk records
            case "/GetMilkRecordsApi":
                $CowModalObj = new CowModal();
                //getting the records from the database
                $data = $CowModalObj->getAllMilkRecordsAPI($this->DbCon->connection, 'milk');

                //checking if the data is null
                if($data == null){
                    $data = [];
                }
                //sending the data to the view
                echo json_encode($data);
                break;

            case "/GetCowBreedsApi":
                $CowModalObj = new CowModal();
                $data=$CowModalObj->GetCowBreedsAPI($this->DbCon->connection, 'cows');

                if($data == null){
                    $data = [];
                }
                echo json_encode($data);
                break;

            default:
                echo "Default";
                break;
        }
    }

}


?>