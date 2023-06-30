<?php
include_once("./index.php");
require_once("./Model/UserModal.php");
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


            case "ValidateUserAPI":
                $UModal = new UserModal();
                $res= $UModal->validateUser($this->DbCon->connection,"users",$_REQUEST);

                //User Exists
                if(!is_null($res))
                {
                    
                }
                else{

                }

                break;

            //This will display the Add user Form
            case "/AddUsers":
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/AddUsers.php");
                include("View/Footer.php");
                break;

            //Api based Insertions into the database
            case "/AddUserApi":

                $name = $this->request['name'];
                $email = $this->request['email'];
                $password = $this->request['password'];

                // echo $name;
               
                if (isset($this->request['adminRights'])) {
                    $adminRights = "yes";
                } else {
                    $adminRights = "no";
                }
                $job = $this->request['job'];

                $UserModal = new UserModal();


                $NewImageName = $UserModal->UploadImage("Images/upload", $this->file);

                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'adminRights' => $adminRights,
                    'job' => $job,
                    'image' => $NewImageName
                ];

                $UserModalObj = new UserModal();

                $insertion = $UserModalObj->addNewUser($this->DbCon->connection, 'users', $data);
                $output["status"] = $insertion;

                echo json_encode($output);
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
            case "/DeleteUsersApi":
                $id = $this->request['id'];

                $UserModalObj = new UserModal();

                //$UserModalObj->deleteUser($this->DbCon->connection, 'users', $id);
                $deletion = $UserModalObj->deleteUser($this->DbCon->connection, 'users', $id);
                $output["status"] = $deletion;

                if ($output['status'] == "deleted") {

                    echo json_encode($output['status']);
                }


                break;
            default:
                echo "<h1>404 Not Found. Check Your Code User:)</h1>";
                break;
        }
    }

}


?>