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

    //Crud operations for cow

    //Adding Cow into cows table
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

    public function getAllMilkRecordsByDaysAPI($conn, $table, $id, $month)
    {
        $sql = "SELECT SUM(quantity) AS total_milk_production, date FROM $table WHERE cowId = $id AND MONTH(date) = $month AND YEAR(date) = YEAR(CURDATE()) GROUP BY date";

        $result = mysqli_query($conn, $sql);
        $arr = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }

            return $arr;
        } else {
            return null;
        }

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


    public function AddMilkEntry($conn, $table, $data)
    {
        $columns = implode(",", array_keys($data));

        $cowId = $data['cowId'];
        $date = $data['date'];
        $quantity = $data['quantity'];
        $ph = $data['ph'];

        $sql = "INSERT INTO $table($columns) VALUES ('$cowId', '$date', '$quantity', '$ph')";

        if (mysqli_query($conn, $sql)) {

            return "added";
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



    public function getAllCows($conn, $table)
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

    //Getting data from form and updating cow
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
            //IF folder does not exist it will create the folder 
            if (!file_exists($output_dir)) {
                @mkdir($output_dir, 0777);
            }
            //Move the file to the folder
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
        echo json_encode($output["status"]);

    }



    //Crud operations for milk

    //Gett All Milk Records API will return all the mils records from DB
    public function getAllMilkRecordsAPI($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT * FROM $table WHERE cowId = $id";
        }

        if ($id == -99) {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT * FROM $table WHERE cowId = $id";
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

    public function GetAvgHighestRankOfCowApi($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT 
            AVG(quantity) AS avg_milk_production
        FROM 
            milk";
            $sql2 = "SELECT 
            MAX(quantity) AS highest_milk_production
        FROM 
            milk";
        } else {
            $sql = "SELECT 
            AVG(quantity) AS avg_milk_production
        FROM 
            milk
        WHERE 
            cowId = $id"
        ;
            $sql2 = "SELECT 
            MAX(quantity) AS highest_milk_production
        FROM 
            milk
        WHERE 
            cowId = $id";
        }

        $sql3 = "SELECT
        cowId,
        total_milk_production,
        RANK() OVER (ORDER BY total_milk_production DESC) AS cow_rank
    FROM
        (SELECT
            cowId,
            SUM(quantity) AS total_milk_production
        FROM
            milk
        WHERE
            YEAR(date) = YEAR(CURRENT_DATE)
        GROUP BY
            cowId) AS subquery
    ORDER BY
        total_milk_production DESC";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);
        $result3 = mysqli_query($conn, $sql3);

        $arr = [];

        if ($result) {
            $x = 0;
            $row = mysqli_fetch_array($result);
            $arr[$x] = $row;
            $x++;

            $row2 = mysqli_fetch_array($result2);
            $arr[$x] = $row2;
            $x++;

            while($row3 = mysqli_fetch_array($result3)){
                $arr[$x] = $row3;
                $x++;
            }

            return $arr;
        } else {
            return null;
        }
    }

}




?>