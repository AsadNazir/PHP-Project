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



    //Crud operations for milk





    //Returns Annual, Monthly, Weekly and Daily Milk Records of a Cow with ID
    // public function getACowMilkRecord($conn, $table, $id)
    // {
    //     $sql = "SELECT
    //         (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND MONTH(`date`) = MONTH(CURRENT_DATE())) AS total_month,
    //         (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND WEEK(`date`) = WEEK(CURRENT_DATE())) AS total_week,
    //         (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND DATE(`date`) = CURRENT_DATE()) AS total_day,
    //         (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE())) AS total_year";

    //     $stmt = mysqli_prepare($conn, $sql);
    //     mysqli_stmt_bind_param($stmt, "iiii", $id, $id, $id, $id);
    //     mysqli_stmt_execute($stmt);
    //     $result = mysqli_stmt_get_result($stmt);
    //     $row = mysqli_fetch_assoc($result);

    //     return $row;
    // }

    //Gett All Milk Records API will return all the mils records from DB
    public function getAllMilkRecordsAPI($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT * FROM $table WHERE cowId = $id";
        }
    }

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
            return null;
        }
    }
  

    public function getAllMilkRecordsByMonthAPI($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT SUM(quantity) AS total_milk_production, MONTH(date) AS month FROM $table WHERE YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
        } else {
            $sql = "SELECT SUM(quantity) AS total_milk_production, MONTH(date) AS month FROM $table WHERE cowId = $id AND YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
        }

        $result = mysqli_query($conn, $sql);
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

}




?>