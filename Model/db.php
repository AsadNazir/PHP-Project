<?php
class Db
{
    public $connection;
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "automatedfarm";
        // $servername = "http://185.27.134.10/index.php";
        // $username = "if0_34726373";
        // $password = "0SdcsxdotSZUy";
        // $dbname = "if0_34726373_dairyfarmautomation";

        try {
            $this->connection = mysqli_connect($servername, $username, $password, $dbname);
            // Set the connection encoding to UTF-8
            mysqli_set_charset($this->connection, "utf8mb4");
        } catch (Exception $th) {
            echo $th->getMessage();
            exit;
        }
    }

}


?>