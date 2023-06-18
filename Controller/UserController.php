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

            case "/AddUser":

                break;

            case "/EditUser":

                break;

            case "DeleteUser":

                break;

            default:
                echo "Default";
                break;
        }
    }

}


?>