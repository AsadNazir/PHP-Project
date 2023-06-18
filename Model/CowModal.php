<?php

require_once("db.php");
class CowModal
{
    public $conn;

    function __construct()
    {
        $this->conn = new Db();
    }
    public function addNewCow($conn, $table, $data)
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

        $sql = "INSERT INTO $table($columns) VALUES ('$name', '$breed', '$gender', '$age', '$dairy', '$weight', '$height', '$color', '$image')";

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


        //IF file exists if iy will i do'nt know what it will do
        if (!file_exists($output_dir)) {
            @mkdir($output_dir, 0777);
        }

        //Uploadding file to thre directory
        move_uploaded_file($file["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

        return $NewImageName;
    }

    public function deleteCow($conn, $table, $id)
    {
        $sql = "DELETE FROM $table WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            return "deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function getAllCows($conn, $table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql);
        $arr =[];
        
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

    public function getCowById($conn, $table, $id)
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

    public function updateCow($conn, $table, $data, $id)
    {
        // echo "id:".$id;
        $name = $data['name'];
        $breed = $data['breed'];
        $gender = $data['gender'];
        $age = $data['age'];
        $dairy = $data['dairy'];
        $weight = $data['weight'];
        $height = $data['height'];
        $color = $data['color'];
        $image = $data['image'];

        if ($image == "NoImage") {
            $sql = "UPDATE $table SET `name`='$name', `breed`='$breed', `gender`='$gender', `age`='$age', `dairy`='$dairy', `weight`='$weight', `height`='$height', `color`='$color' WHERE id='$id'";
        } else {
            $sql = "UPDATE $table SET `name`='$name', `breed`='$breed', `gender`='$gender', `age`='$age', `dairy`='$dairy', `weight`='$weight', `height`='$height', `color`='$color', `image`='$image' WHERE id='$id'";
        }


        if (mysqli_query($conn, $sql)) {
            return "updated";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function UpadteCowAPI($conn, $table, $req, $file)
    {


        $id = $req['id'];
        $name = $req['name'];
        $breed = $req['breed'];
        $gender = $req['gender'];
        $age = $req['age'];
        if (isset($req['dairy'])) {
            $dairy = "yes";
        } else {
            $dairy = "no";
        }
        $weight = $req['weight'];
        $height = $req['height'];
        $color = $req['color'];


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
            //IF file exists if iy will i do'nt know what it will do
            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }
            move_uploaded_file($file["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

            $data = [
                'name' => $name,
                'breed' => $breed,
                'gender' => $gender,
                'age' => $age,
                'dairy' => $dairy,
                'weight' => $weight,
                'height' => $height,
                'color' => $color,
                'image' => $NewImageName
            ];
        } else {
            $data = [
                'name' => $name,
                'breed' => $breed,
                'gender' => $gender,
                'age' => $age,
                'dairy' => $dairy,
                'weight' => $weight,
                'height' => $height,
                'color' => $color,
                'image' => "NoImage"
            ];
        }
        $updation = $this->updateCow($conn, 'cows', $data, $id);
        $output["status"] = $updation;
        echo json_encode($output);

    }
}


?>