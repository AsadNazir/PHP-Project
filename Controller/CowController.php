<?php
include_once("./index.php");

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

                $NewImageName= $this->UploadImage("Images/Upload");

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

                $insertion = $this->DbCon->addNewCow($this->DbCon->connection, 'cows', $data);
                $output["status"] = $insertion;

                echo json_encode($output);

                break;

            case "/UpdateCow":
                include("View/navbar.php");
                include("View/dashBoard.php");
                include("View/update.php");
                break;

            default:
                echo "Default";
                break;
        }
    }

    function UploadImage($directory)
    {
         //Upload Files 
         $output_dir = "Images/upload";
         $RandomNum = time();
         $ImageName = str_replace(' ', '-', strtolower($this->file['image']['name']));
         $ImageType = $this->file['image']['type'];

         $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
         $ImageExt = str_replace('.', '', $ImageExt);
         $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
         $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
         $ret[$NewImageName] = $output_dir . $NewImageName;


         //IF file exists if iy will i do'nt know what it will do
         if (!file_exists($output_dir)) {
             @mkdir($output_dir, 0777);
         }

         //Uploadding file to thre directory
         move_uploaded_file($this->file["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

         return $NewImageName;
    }
}























?>