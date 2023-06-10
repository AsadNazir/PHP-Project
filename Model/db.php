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
        $dbname = "web";

        try {
            $this->connection = mysqli_connect($servername, $username, $password, $dbname);
        } catch (Exception $th) {
            echo $th->getMessage();
            exit;
        }
    }

}


?>