<?php
include_once("./index.php");
require_once("./Model/UserModal.php");
require_once("./Model/CowModal.php");

class NotificationController extends Controllers
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


            case "/Notification":

                $NM = new NotificationModal();
                $NM->AvgMilkProductionNotification($this->DbCon->connection, "alert");
                include("View/navbar.php");
                include("View/Sidebar.php");
                include("View/Notification.php");
                include("View/Footer.php");
                break;


            default:
                echo "<h1>404 Not Found. Check Your Code User:)</h1>";
                break;
        }
    }

    public function getAllNotification($conn, $table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql);
        $rows = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return null;
        }
    }

}


?>