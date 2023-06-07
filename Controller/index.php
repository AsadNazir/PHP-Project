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

// This is Master Branch COde3

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
            // include("View/cards.php");
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

        //Upload Files 
        $output_dir = "Images/upload";
        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name']));
        $ImageType = $_FILES['image']['type'];

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
        move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

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

        $insertion = $Con->DbCon->addNewCow($Con->DbCon->connection, 'cows', $data);
        $output["status"] = $insertion;
        echo json_encode($output);

        break;

    case "/Update":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/update.php");
        break;

    case "/updateCow":
        $id = $_REQUEST['id'];
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


        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name']));

        if ($ImageName != "") {
            $output_dir = "Images/upload";

            $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name']));
            $ImageType = $_FILES['image']['type'];

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
            $ret[$NewImageName] = $output_dir . $NewImageName;
            //IF file exists if iy will i do'nt know what it will do
            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }
            move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

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
        } else {
            $data = [
                'name' => $name,
                'breed' => $breed,
                'gender' => $gender,
                'age' => $age,
                'dairy' => $dairy,
                'weight' => $weight,
                'height' => $height,
                'color' => $color,
                'image' => "NoImage"
            ];
        }
        $updation = $Con->DbCon->updateCow($Con->DbCon->connection, 'cows', $data, $id);
        $output["status"] = $updation;
        echo json_encode($output);
        break;

    case "/Delete":
        $id = $_GET['id'];

        $deletion = $Con->DbCon->deleteCow($Con->DbCon->connection, 'cows', $id);
        $output["status"] = $deletion;

        if ($output['status'] == "updated") {
            include("View/navbar.php");
            include("View/dashBoard.php");
            include("View/MainPageDashBoard.php");
        }
        


        break;

    case "/logout":
        session_destroy();
        header("Location: ./login");
        break;

    case "/Notification":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/Notification.php");
        break;

    case "/Chart":
        include("View/navbar.php");
        include("View/dashBoard.php");
        include("View/Chart.php");
        break;

    default:
        header("Location: ./View/Error.php");
        break;
}



?>