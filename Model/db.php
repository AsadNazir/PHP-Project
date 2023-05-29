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

    function addNewCow($conn, $table, $data)
    {
        $columns = implode(",", array_keys($data));

        $name = $data['name'];
        $breed = $data['breed'];
        $gender = $data['gender'];
        $age = $data['age'];
        $dairy = $data['dairy'];
        $weight = $data['weight'];
        $height = $data['height'];
        $color = $data['color'];
        $image = $data['image'];
        $sql = "INSERT INTO cows($columns) VALUES ('$name', '$breed', '$gender', '$age', '$dairy', '$weight', '$height', '$color', '$image')";
        
        if (mysqli_query($conn, $sql)) {
            
            return "updated";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


    }
}


?>