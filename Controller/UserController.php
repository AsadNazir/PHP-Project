<?php
include_once("./index.php");
require_once("./Model/CowModal.php");
class UserController extends Controllers
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

            //This will display the Add user Form
            case "/AddUsers":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AddUsers.php");
                include("View/Footer.php");
                break;

            //Api based Insertions into the database
            case "/AddUserApi":
                break;

            //This will basically dispaly the list of all the users
            case "/ManageUsers":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/UserList.php");
                include("View/Footer.php");
                break;

            //Deleter User Api here 
            //Name All the Apis so that we may know where we are calling the ajax funcions
            case "DeleteUserApi":

                break;
            default:
                echo "<h1>404 Not Found. Check Your Code :)</h1>";
                break;
        }
    }

}


?>