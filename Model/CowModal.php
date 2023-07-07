<?php

require_once("db.php");
class CowModal
{
    public $conn;

    //Constructor
    function __construct()
    {
        $this->conn = new Db();
    }

    //Function for adding a row into a table
    public function addNewRow($conn, $table, $data)
    {
        $columns = implode(",", array_keys($data));
        $placeholders = implode(",", array_fill(0, count($data), "?"));

        $values = array_values($data);

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($values)), ...$values);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                return "added";
            } else {
                echo "Error inserting: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    //Function for getting all records from a table
    public function getAllRecords($conn, $table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $arr = [];

        if ($result) {
            $x = 0;
            while ($row = mysqli_fetch_array($result)) {
                $arr[$x] = $row;
                $x++;
            }

            return $arr;
        } else {
            return null;
        }
    }

    //Crud operations for cow

    //API for Adding a cow
    public function addCowApi($conn, $table, $req, $file)
    {
        $name = $req['name'];
        $breed = $req['breed'];
        $gender = $req['gender'];
        $age = $req['age'];
        if (isset($req['dairy'])) {
            $dairy = "yes";
        } else {
            $dairy = "no";
        }
        if (isset($req['insemination'])) {
            $insemination = "yes";
        } else {
            $insemination = "no";
        }
        $weight = $req['weight'];
        $height = $req['height'];
        $color = $req['color'];
        $price = $req['price'];

        $output_dir = "Images/upload";

        $ImageName = $this->UploadImage($output_dir, $file);

        $data = [
            'name' => $name,
            'breed' => $breed,
            'gender' => $gender,
            'age' => $age,
            'dairy' => $dairy,
            'insemination' => $insemination,
            'weight' => $weight,
            'height' => $height,
            'color' => $color,
            'price' => $price,
            'image' => $ImageName
        ];

        $insertion = $this->addNewRow($conn, $table, $data);
        $output["status"] = $insertion;
        echo json_encode($output["status"]);

    }

    //Updating a cow's data in table
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

    //Getting data from form and updating cow
    public function UpdateCowAPI($conn, $table, $req, $file)
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
        if (isset($req['insemination'])) {
            $insemination = "yes";
        } else {
            $insemination = "no";
        }
        $weight = $req['weight'];
        $height = $req['height'];
        $color = $req['color'];
        $price = $req['price'];

        $ImageName = str_replace(' ', '-', strtolower($file['image']['name']));

        if ($ImageName != "") {
            $output_dir = "Images/upload";

            $ImageName = $this->UploadImage($output_dir, $file);
        } else {
            $ImageName = "NoImage";
        }

        $data = [
            'name' => $name,
            'breed' => $breed,
            'gender' => $gender,
            'age' => $age,
            'dairy' => $dairy,
            'insemination' => $insemination,
            'weight' => $weight,
            'height' => $height,
            'color' => $color,
            'price' => $price,
            'image' => $ImageName
        ];

        $updation = $this->updateCow($conn, 'cows', $data, $id);
        $output["status"] = $updation;
        echo json_encode($output["status"]);

    }

    //Deleting cow entry from cows table
    public function deleteCow($conn, $table, $id)
    {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return "deleted";
        } else {
            echo "Error deleting cow: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);

    }

    //Uploading image into Images/upload folder
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

    //Getting all cow entries from cows table
    public function getAllCows($conn, $table)
    {
        return $this->getAllRecords($conn, $table);
    }

    //Getting a cow from its id
    public function getCowById($conn, $table, $id)
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

    //For milk

    //API for adding milk
    public function AddMilkEntryApi($conn, $table, $req)
    {
        $cow = $req['id'];
        // echo $cow;
        $date = $req['date'];
        $quantity = $req['quantity'];
        $ph = $req['ph'];

        $data = [
            'cowId' => $cow,
            'date' => $date,
            'quantity' => $quantity,
            'ph' => $ph
        ];

        $insertion = $this->addNewRow($conn, $table, $data);
        $output["status"] = $insertion;

        echo json_encode($output);
    }
    //Returns all the cow breeds with their respective count
    public function GetCowBreedsApi($conn, $table)
    {
        $query = "SELECT breed, COUNT(*) AS breed_count FROM {$table} GROUP BY breed";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $breeds = [];
            while ($row = $result->fetch_assoc()) {
                $breeds[] = $row;
            }
            return $breeds;
        } else {
            return null;
        }
    }

    //Returns Annual, Monthly, Weekly and Daily Milk Records of a Cow with ID
    public function getACowMilkRecord($conn, $table, $id)
    {
        $sql = "SELECT
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND MONTH(`date`) = MONTH(CURRENT_DATE())) AS total_month,
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND WEEK(`date`) = WEEK(CURRENT_DATE())) AS total_week,
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND DATE(`date`) = CURRENT_DATE()) AS total_day,
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE())) AS total_year";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $id, $id, $id, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        return $row;
    }

    // Gett All Milk Records API will return all the milk records from DB
    public function getAllMilkRecordsAPI($conn, $table)
    {
        return $this->getAllRecords($conn, $table);
    }

}

?>