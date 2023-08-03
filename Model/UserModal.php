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
    public function isAdmin($data)
    {
        if (isset($data["user"]) && $data["user"] == "admin")
            return true;

        return false;
    }

    // New Function to check/ Validate the user
    public function validateUser($conn, $table, $data)
    {
        $email = mysqli_real_escape_string($conn, $data["email"]);
        $password = md5($data["password"]);

        // Use prepared statement
        $query = "SELECT * FROM $table WHERE email=? AND password=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $arr = mysqli_fetch_array($result);
            return $arr;
        } else {
            return null; // User does not exist or password is incorrect
        }
    }


    //Modified the function using chatGPT to prevent SQL Injections
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

    //Api for adding user
    public function addUserApi($conn, $table, $req, $file)
    {
        // $id = $req['id'];
        $name = $req['name'];
        $email = $req['email'];
        $password = $req['password'];
        $job = $req['job'];
        if (isset($req['adminRights'])) {
            $adminRights = "yes";
        } else {
            $adminRights = "no";
        }

        $output_dir = "Images/upload";

        $ImageName = $this->UploadImage($output_dir, $file);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'job' => $job,
            'adminRights' => $adminRights,
            'image' => $ImageName
        ];

        $insertion = $this->addNewUser($conn, $table, $data);
        $output["status"] = $insertion;
        echo json_encode($output["status"]);
    }

    public function updateUser($conn, $table, $data, $id)
    {
        // echo "id:".$id;
        $name = $data['name'];
        $email = $data['email'];
        $job = $data['job'];
        $image = $data['image'];

        if ($image == "NoImage") {
            $sql = "UPDATE $table SET `name`=?, `email`=?, `job`=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $job, $id);
        } else {
            $sql = "UPDATE $table SET `name`=?, `email`=?, `job`=?, `image`=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $job, $image, $id);
        }

        if (mysqli_stmt_execute($stmt)) {
            return "updated";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    public function UpadteUserAPI($conn, $table, $req, $file)
    {
        $id = $req['id'];
        $name = $req['name'];
        $email = $req['email'];
        $job = $req['job'];
        if (isset($req['adminRights'])) {
            $adminRights = "yes";
        } else {
            $adminRights = "no";
        }

        $ImageName = str_replace(' ', '-', strtolower($file['image']['name']));

        if ($ImageName != "") {
            $output_dir = "Images/upload";

            $ImageName = $this->UploadImage($output_dir, $file);
        } else {
            $ImageName = "NoImage";
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'job' => $job,
            'adminRights' => $adminRights,
            'image' => $ImageName
        ];

        $updation = $this->updateUser($conn, 'users', $data, $id);
        $output["status"] = $updation;
        echo json_encode($output["status"]);

    }

    //Function to delete user entry from users table using id
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

    //API for deleting user
    public function deleteUserApi($conn, $table, $req)
    {
        $id = $req['id'];

        $deletion = $this->deleteUser($conn, 'users', $id);
        $output["status"] = $deletion;

        echo json_encode($output["status"]);
    }

    //Function to upload image and move it to Images/upload folder
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

        //Uploadding file to the directory
        move_uploaded_file($file["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

        return $NewImageName;
    }

    //Get all users from users table
    public function getAllUsers($conn, $table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $arr = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }

            return $arr;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    //Get user by its id
    public function getUserById($conn, $table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_array($result);

            // var_dump($row);
            return $row;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function getUserByEmail($conn, $table, $email)
    {
        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_array($result);

            // var_dump($row);
            return $row;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

}

?>