<?php
include_once("./index.php");
require_once("./Model/UserModal.php");
session_start();

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


            case "/ValidateUserAPI":
                $UModal = new UserModal();
                $res = $UModal->validateUser($this->DbCon->connection, "users", $this->request);

                $output = array();
                $output['valid'] = false;
                //User Exists
                if (!is_null($res)) {
                    //var_dump($res);
                    $_SESSION["email"] = $res["email"];
                    $_SESSION["isAdmin"] = $res["adminRights"];
                    $_SESSION["name"] = $res["name"];
                    $output['valid'] = true;
                }

                echo json_encode($output);
                break;

            //This will display the Add user Form
            case "/AddUsers":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AddUsers.php");
                include("View/Footer.php");
                break;

            //This will basically dispaly the list of all the users
            case "/ManageUsers":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/UserList.php");
                include("View/Footer.php");
                break;

            case "/UpdateUserPage":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/updateUser.php");
                include("View/Footer.php");
                break;

            //Api based Insertions into the database
            case "/AddUserApi":
                $UserModalObj = new UserModal();
                $UserModalObj->addUserApi($this->DbCon->connection, "users", $this->request, $this->file);
                break;


            //Delete User Api here 
            case "/DeleteUsersApi":
                $UserModalObj = new UserModal();
                $UserModalObj->deleteUserApi($this->DbCon->connection, "users", $this->request);
                break;

            case "/updateUserApi":
                $UserModalObj = new UserModal();
                $UserModalObj->UpadteUserAPI($this->DbCon->connection, "users", $this->request, $this->file);
                break;

            default:
                echo "<h1>404 Not Found. Check Your Code User:)</h1>";
                break;
        }
    }

}


?>