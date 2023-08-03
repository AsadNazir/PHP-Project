<?php

require_once("db.php");
require_once("NotificationModal.php");
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

    //Crud operations for cow

    //Adding Cow into cows table    
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
            $sql = "UPDATE $table SET `name`=?, `breed`=?, `gender`=?, `age`=?, `dairy`=?, `weight`=?, `height`=?, `color`=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssisiisi", $name, $breed, $gender, $age, $dairy, $weight, $height, $color, $id);
        } else {
            $sql = "UPDATE $table SET `name`=?, `breed`=?, `gender`=?, `age`=?, `dairy`=?, `weight`=?, `height`=?, `color`=?, `image`=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssisiissi", $name, $breed, $gender, $age, $dairy, $weight, $height, $color, $image, $id);
        }

        if (mysqli_stmt_execute($stmt)) {
            return "updated";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    //API for Getting data from form and updating cow
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

    //API for deleting cow
    public function deleteCowApi($conn, $table, $req)
    {
        $id = $req['id'];

        $deletion = $this->deleteCow($conn, 'cows', $id);
        $output["status"] = $deletion;

        echo json_encode($output["status"]);
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

        if ($quantity < 5) {
            $NC = new NotificationModal();
            $NC->addNotification($conn, 'alert', $cow, 'Milk', 'Milk quantity is less than 5Liters for cow with id ' . $cow, $date);
        }
        $NC = new NotificationModal();


        echo json_encode($output);
    }

    //Function to get all milk records by days
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

    //Returns Annual, Monthly, Weekly and Daily Milk Records of a Cow with ID
    public function getACowMilkRecord($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql2 = "SELECT
            (SELECT SUM(`quantity`) FROM $table WHERE  YEAR(`date`) = YEAR(CURRENT_DATE()) AND MONTH(`date`) = MONTH(CURRENT_DATE())) AS total_month,
            (SELECT SUM(`quantity`) FROM $table WHERE YEAR(`date`) = YEAR(CURRENT_DATE()) AND WEEK(`date`) = WEEK(CURRENT_DATE())) AS total_week,
            (SELECT SUM(`quantity`) FROM $table WHERE DATE(`date`) = CURRENT_DATE()) AS total_day,
            (SELECT SUM(`quantity`) FROM $table WHERE YEAR(`date`) = YEAR(CURRENT_DATE())) AS total_year";

            $stmt2 = mysqli_prepare($conn, $sql2);


            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            $row2 = mysqli_fetch_array($result2);
            return $row2;

        }
        $sql = "SELECT
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND MONTH(`date`) = MONTH(CURRENT_DATE())) AS total_month,
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE()) AND WEEK(`date`) = WEEK(CURRENT_DATE())) AS total_week,
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND DATE(`date`) = CURRENT_DATE()) AS total_day,
            (SELECT SUM(`quantity`) FROM $table WHERE cowId = ? AND YEAR(`date`) = YEAR(CURRENT_DATE())) AS total_year";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiii", $id, $id, $id, $id);

        var_dump($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        return $row;
    }

    //Returns Milk records from date1 to date2
    public function getMikRecordsBetweenDates($conn, $table, $id, $from = -99, $to = -99)
    {
        $stmt = mysqli_prepare($conn, "SELECT * FROM $table WHERE cowId = ? AND date BETWEEN ? AND ?");
        mysqli_stmt_bind_param($stmt, "iss", $id, $from, $to);
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

    //Gett All Milk Records API will return all the mils records from DB
    public function getAllMilkRecordsAPI($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT * FROM $table";
            $stmt = mysqli_prepare($conn, $sql);
        } else {
            $sql = "SELECT * FROM $table WHERE cowId = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
        }

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

    //Returns for a Month Milk Records of a Cow with ID
    public function getAllMilkRecordsByMonthAPI($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT SUM(quantity) AS total_milk_production, MONTH(date) AS month FROM $table WHERE YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
            $stmt = mysqli_prepare($conn, $sql);
        } else {
            $sql = "SELECT SUM(quantity) AS total_milk_production, MONTH(date) AS month FROM $table WHERE cowId = ? AND YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
        }

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

    //Returns highest average rank of a cow's milk quantity
    public function GetAvgHighestRankOfCowApi($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $sql = "SELECT AVG(quantity) AS avg_milk_production FROM milk";
            $sql2 = "SELECT MAX(quantity) AS highest_milk_production FROM milk";
        } else {
            $sql = "SELECT AVG(quantity) AS avg_milk_production FROM milk WHERE cowId = ?";
            $sql2 = "SELECT MAX(quantity) AS highest_milk_production FROM milk WHERE cowId = ?";
        }

        $sql3 = "SELECT cowId, total_milk_production, RANK() OVER (ORDER BY total_milk_production DESC) AS cow_rank
        FROM (
            SELECT cowId, SUM(quantity) AS total_milk_production
            FROM milk
            WHERE YEAR(date) = YEAR(CURRENT_DATE)
            GROUP BY cowId
        ) AS subquery
        ORDER BY total_milk_production DESC";

        $stmt1 = mysqli_prepare($conn, $sql);
        $stmt2 = mysqli_prepare($conn, $sql2);
        $stmt3 = mysqli_prepare($conn, $sql3);

        $arr = [];

        if ($stmt1 && $stmt2 && $stmt3) {
            if ($id != -99) {
                mysqli_stmt_bind_param($stmt1, "i", $id);
                mysqli_stmt_bind_param($stmt2, "i", $id);
            }

            mysqli_stmt_execute($stmt1);
            $result1 = mysqli_stmt_get_result($stmt1);

            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);

            mysqli_stmt_execute($stmt3);
            $result3 = mysqli_stmt_get_result($stmt3);

            $x = 0;

            $row1 = mysqli_fetch_array($result1);
            $arr[$x] = $row1;
            $x++;

            $row2 = mysqli_fetch_array($result2);
            $arr[$x] = $row2;
            $x++;

            while ($row3 = mysqli_fetch_array($result3)) {
                $arr[$x] = $row3;
                $x++;
            }

            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            mysqli_stmt_close($stmt3);
            mysqli_free_result($result1);
            mysqli_free_result($result2);
            mysqli_free_result($result3);

            return $arr;
        } else {
            return null;
        }
    }

    public function getYesterdayMilkProduction($conn, $table, $id = -99)
    {
        // Get yesterday's date
        $yesterday = date("Y-m-d", strtotime("-1 day"));

        if ($id == -99) {
            // Retrieve milk production for all cows
            $sql = "SELECT SUM(quantity) AS total_milk_production FROM $table WHERE date = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $yesterday);
        } else {
            // Retrieve milk production for a specific cow
            $sql = "SELECT SUM(quantity) AS total_milk_production FROM $table WHERE cowId = ? AND date = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $id, $yesterday);
        }

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Fetch the result
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        // Close the statement
        mysqli_stmt_close($stmt);

        // Return the total milk production
        return $row['total_milk_production'];
    }

    public function addNewMedical($conn, $table, $data)
    {
        $cow_id = $data['cow_id'];
        $description = $data['description'];
        $date = $data['date'];
        $condition = $data['condition'];
        $temperature = $data['temperature'];

        $sql = "INSERT INTO $table ( `description`, `date`, `cow_id`, `condition`, `temperature`) VALUES ('$description', '$date', '$cow_id', '$condition', '$temperature')";

        if (mysqli_query($conn, $sql)) {
            return "added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    public function EnterMedicalApi($conn, $table, $req)
    {
        // $cow = $req['cow'];
        // echo $cow;
        $description = $req['description'];
        $date = $req['date'];
        $cow_id = $req['cow'];
        $condition = $req['condition'];
        $temperature = $req['temperature'];

        $data = [
            'description' => $description,
            'date' => $date,
            'cow_id' => $cow_id,
            'condition' => $condition,
            'temperature' => $temperature
        ];

        $insertion = $this->addNewMedical($conn, $table, $data);
        $output["status"] = $insertion;

        if ($insertion == "added") {
            if ($condition == "sick" || $condition == "dead" || $condition == "pregnant") {
                $NC = new NotificationModal();
                $NC->addNotification($conn, 'alert', $cow_id, 'Health', 'Cow with Id ' . $cow_id . " is " . $condition, $date);
            }
            $NC = new NotificationModal();
        }
        echo json_encode($output);
    }

}

?>