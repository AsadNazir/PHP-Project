<?php

require_once("db.php");

class UserModal
{
    public $conn;

    function __construct()
    {
        $this->conn = new Db();
    }

    public function addNewUser($conn, $table, $data)
    {
        $columns = implode(",", array_keys($data));

        $name = $data['name'];
        $email = $data['email'];
        $password = md5($data['password']);
        $adminRights = $data['adminRights'];
        $job = $data['job'];
        $image = $data['image'];

        $sql = "INSERT INTO $table($columns) VALUES ('$name', '$email', '$password', '$adminRights', '$job', '$image')";

        if (mysqli_query($conn, $sql)) {

            return "updated";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

    public function deleteUser($conn, $table, $id)
    {
        $sql = "DELETE FROM $table WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            return "deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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

    public function getUserById($conn, $table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if (($result)) {
            $row = mysqli_fetch_array($result);

            // var_dump($row);
            return $row;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function updateUser($conn, $table, $data, $id)
    {
        // echo "id:".$id;
        $name = $data['name'];
        $email = $data['email'];
        $job = $data['job'];
        
        $image = $data['image'];

        if ($image == "NoImage") {
            $sql = "UPDATE $table SET `name`='$name', `email`='$email', `job`='$job' WHERE id='$id'";
        } else {
            $sql = "UPDATE $table SET `name`='$name', `email`='$email', `job`='$job', `image`='$image' WHERE id='$id'";
        }

        if (mysqli_query($conn, $sql)) {
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
        
        $RandomNum = time();
        $ImageName = str_replace(' ', '-', strtolower($file['image']['name']));

        if ($ImageName != "") {
            $output_dir = "Images/upload";

            $ImageName = str_replace(' ', '-', strtolower($file['image']['name']));
            $ImageType = $file['image']['type'];

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
            $ret[$NewImageName] = $output_dir . $NewImageName;
            //IF folder does not exist it will create the folder 
            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }
            //Move the file to the folder
            move_uploaded_file($file["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

            $data = [
                'name' => $name,
                'email' => $email,
                'job' => $job,
                'adminRights' => $adminRights,
                'image' => $NewImageName
            ];
        } else {
            $data = [
                'name' => $name,
                'email' => $email,
                'job' => $job,
                'adminRights' => $adminRights,
                'image' => "NoImage"
            ];
        }
        $updation = $this->updateUser($conn, 'users', $data, $id);
        $output["status"] = $updation;
        echo json_encode($output["status"]);

    }








}



?>