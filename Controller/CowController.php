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

            case "/UpdateCow":
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

            default:
                echo "Default";
                break;
        }
    }

}


?>