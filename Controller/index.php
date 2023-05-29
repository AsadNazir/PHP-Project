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

        if (isset($_REQUEST["email"]) || $_SESSION["user"] == "admin") {
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

    //Write Add Cow Business Logic here
    case "/AddCow":
<<<<<<< HEAD
        
=======
        // echo "Succesfull";
        include("View/navbar.php");
        include("View/dashBoard.php");
        // include("View/addNewCow.php");
>>>>>>> b8752c7158aa474ccc059df9bcfee1bba9e2d891

        $name = $_REQUEST['name'];
        $breed = $_REQUEST['breed'];
        $gender = $_REQUEST['gender'];
        $age = $_REQUEST['age'];
        if (isset($_REQUEST['dairy'])) {
            $dairy = "yes";
        } else {
            $dairy = "no";
        }
        $weight = $_REQUEST['weight'];
        $height = $_REQUEST['height'];
        $color = $_REQUEST['color'];

<<<<<<< HEAD
        //Upload Files 
=======
>>>>>>> b8752c7158aa474ccc059df9bcfee1bba9e2d891
        $output_dir = "Images/upload";
        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name']));
        $ImageType = $_FILES['image']['type'];

        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);
        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
        $ret[$NewImageName] = $output_dir . $NewImageName;

<<<<<<< HEAD

        //IF file exists if iy will i do'nt know what it will do
=======
>>>>>>> b8752c7158aa474ccc059df9bcfee1bba9e2d891
        if (!file_exists($output_dir)) {
            @mkdir($output_dir, 0777);
        }

<<<<<<< HEAD
        //Uploadding file to thre directory
=======
>>>>>>> b8752c7158aa474ccc059df9bcfee1bba9e2d891
        move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

        $data = [
            'name' => $name,
<<<<<<< HEAD
            'breed' => $breed,
            'gender' => $gender,
            'age' => $age,
            'dairy' => $dairy,
            'weight' => $weight,
            'height' => $height,
            'color' => $color,
=======
            'breed'=> $breed, 
            'gender' => $gender, 
            'age' => $age, 
            'dairy' => $dairy, 
            'weight' => $weight, 
            'height' => $height, 
            'color' => $color, 
>>>>>>> b8752c7158aa474ccc059df9bcfee1bba9e2d891
            'image' => $NewImageName
        ];

        $insertion = $Con->DbCon->addNewCow($Con->DbCon->connection, 'cows', $data);
<<<<<<< HEAD
        $output["status"] = $insertion;
        echo json_encode($output);
        
        break;

    case "/logout":
        session_destroy();
        header("Location: ./login");
=======
        echo "<script>console.log(" . $insertion . ")</script> ";

>>>>>>> b8752c7158aa474ccc059df9bcfee1bba9e2d891
        break;

    default:
        echo "<h1>ERROR 404 NOT FOUND</h1>";
        break;
}



?>