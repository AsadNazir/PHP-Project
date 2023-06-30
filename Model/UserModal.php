<?php

require_once("db.php");

class UserModal
{
    public $conn;

    function __construct()
    {
        $this->conn = new Db();
    }


    //Checking if it is the true admin or not
    public function isAdmin($_SESSION)
    {
        if(isset($_SESSION["user"]) && $_SESSION["user"]=="admin")
        return true;

        return false;
    }

    // New Function to check/ Validate the user
    public function validateUser($conn, $table, $data)
    {
        $email = mysqli_real_escape_string($conn, $data["email"]);
        $password = md5($data["password"]);
        $query = "SELECT * FROM $table WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return true; // User exists and password is correct
        } else {
            return false; // User does not exist or password is incorrect
        }
    }

    //Modifiied the function using chatGPT to prevent SQL Injections
    public function addNewUser($conn, $table, $data)
    {
        $columns = implode(",", array_keys($data));
        $placeholders = implode(",", array_fill(0, count($data), "?"));

        $values = array_values($data);
        $hashedPassword = md5($data['password']);
        $values[2] = $hashedPassword;

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($values)), ...$values);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                return "updated";
            } else {
                echo "Error inserting user: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    public function UploadImage($directory, $file)
    {
        //Upload Files 
        $output_dir = $directory;
        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($file['image']['name']));
        $ImageType = $file['image']['type'];

        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);
        $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
        $ret[$NewImageName] = $output_dir . $NewImageName;


        if (!file_exists($output_dir)) {
            @mkdir($output_dir, 0777);
        }

        //Uploadding file to thre directory
        move_uploaded_file($file["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

        return $NewImageName;
    }

    //Modifiied the function using chatGPT to prevent SQL Injections
    public function deleteUser($conn, $table, $id)
    {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return "deleted";
        } else {
            echo "Error deleting user: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    }

    public function getAllUsers($conn, $table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql);
        $arr = [];

        if (($result)) {
            $x = 0;
            while ($row = mysqli_fetch_array($result)) {
                $arr[$x] = $row;
                $x++;
            }

            return $arr;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }








}



?>