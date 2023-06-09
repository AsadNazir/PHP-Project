<?php

require_once("db.php");

class DietModal
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

    //Function to get all records from a table
    public function getAllRecords($conn, $table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
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

    //Crud operations for feed

    //Adding New Feed into feed table
    //Add feed Api to get data from form and calling add function
    public function AddFeedApi($conn, $table, $req)
    {
        $name = $req['feedName'];
        $quantity = $req['quantity'];
        $price = $req['price'];
        $data = [
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price
        ];


        $insertion = $this->addNewRow($conn, 'feed', $data);
        $output["status"] = $insertion;
        echo json_encode($output["status"]);
    }

    //Deleting feed from feed table
    public function deleteFeed($conn, $table, $id)
    {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return "deleted";
        } else {
            echo "Error deleting feed: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    }

    //API for deleting feed
    public function deleteFeedApi($conn, $table, $req)
    {
        $id = $req['id'];

        $deletion = $this->deleteFeed($conn, 'feed', $id);
        $output["status"] = $deletion;

        echo json_encode($output["status"]);
    }

    //Updating feed's entry in feed table
    public function updateFeed($conn, $table, $data, $id)
    {
        $name = $data['name'];
        $quantity = $data['quantity'];
        $price = $data['price'];

        $sql = "UPDATE $table SET `name`=?, `quantity`=?, `price`=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "siii", $name, $quantity, $price, $id);

        if (mysqli_stmt_execute($stmt)) {
            return "updated";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    }

    //API for updating feed entry
    public function UpdateFeedAPI($conn, $table, $req, $file)
    {
        $id = $req['id'];
        $name = $req['feedName'];
        $quantity = $req['quantity'];
        $price = $req['price'];
        $data = [
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price
        ];

        $updation = $this->updateFeed($conn, 'feed', $data, $id);
        $output["status"] = $updation;
        echo json_encode($output["status"]);

    }

    //Getting all entries from feed table
    public function getAllFeeds($conn, $table)
    {
        return $this->getAllRecords($conn, $table);
    }

    //Getting a feed from table using its id
    public function getFeedById($conn, $table, $id)
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

    //Crud operations for diet plan

    //Adding new diet plan
    //API for adding diet plan
    public function AddDietPlanApi($conn, $table, $req)
    {
        $name = $req['planName'];
        $description = $req['description'];

        $data = [
            'name' => $name,
            'description' => $description
        ];

        $insertion = $this->addNewRow($conn, 'diet', $data);
        $output["status"] = $insertion;

        echo json_encode($output["status"]);
    }

    //Deleting cow entry from diet table
    public function deleteDietPlan($conn, $table, $id)
    {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return "deleted";
        } else {
            echo "Error deleting diet plan: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);

    }

    //API for deleting diet Plan
    public function deleteDietPlanApi($conn, $table, $req)
    {
        $id = $req['id'];

        $deletion = $this->deleteDietPlan($conn, 'diet', $id);
        $output["status"] = $deletion;

        echo json_encode($output["status"]);
    }

    //Getting last record from diet table to get the diet id
    //for diet_feed table
    public function getDietId($conn, $table)
    {
        $sql = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row['id'];
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    //Getting a diet from table using its id
    public function getDietById($conn, $table, $id)
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

    //Getting a diet from table using its id
    public function getDietFeedById($conn, $table, $id)
    {
        $sql = "SELECT * FROM $table WHERE dietId = ?";
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

    //Adding diet feed entry
    public function addNewDietFeed($conn, $table, $data)
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
                return true;
            } else {
                echo "Error inserting dietplan: " . mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
                return false;
            }

            // mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    }

    //API for adding diet and feed entry in diet_feed table to 
    //have a record for all the feeds in a diet
    public function AddDietFeedApi($conn, $table, $req, $checkbox)
    {
        $dietId = $this->getDietId($conn, "diet");
        $feedId = $checkbox;
        $feed = $this->getFeedById($conn, "feed", $checkbox);
        $quantity = $req[$feed['name']];

        $data = [
            'dietId' => $dietId,
            'feedId' => $feedId,
            'quantity' => $quantity
        ];

        $insertion = $this->addNewDietFeed($conn, "diet_feed", $data);
        if ($insertion) {
            return true;
        } else {
            return false;
        }
    }

    //Getting All DietPlans from diet table
    //get All Diet Plans
    public function getAllDietPlans($conn, $table, $id = -99)
    {
        if ($id == -99) {
            $query = "SELECT * FROM $table";
        } else {
            $query = "SELECT * FROM $table WHERE dietId = $id";
        }

        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function getAllDietFeedsByDietId($conn, $table, $id)
    {
        $query = "SELECT * FROM $table WHERE dietId = $id";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function addNewCowDiet($conn, $table, $data)
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
                return true;
            } else {
                echo "Error inserting: " . mysqli_stmt_error($stmt);
                mysqli_stmt_close($stmt);
                return false;
            }

            // mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    }


    public function AddCowDietApi($conn, $table, $req, $checkbox)
    {
        $dietId = $req['id'];
        $cowId = $checkbox;

        $data = [
            'dietId' => $dietId,
            'cowId' => $cowId
        ];

        $insertion = $this->addNewCowDiet($conn, "cow_diet", $data);
        if ($insertion) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCowDiet($conn, $table, $data, $id)
    {
        $dietId = $data['dietId'];
        // $cowId = $data['cowId'];

        $sql = "UPDATE $table SET `dietId`=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $dietId, $id);

        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            echo "Error: " . mysqli_error($conn);
            return false;
        }
    }

    public function UpdateCowDietApi($conn, $table, $req, $checkbox, $id)
    {
        $dietId = $req['id'];
        $cowId = $checkbox;

        $data = [
            'dietId' => $dietId,
            'cowId' => $cowId
        ];

        $insertion = $this->updateCowDiet($conn, "cow_diet", $data, $id);
        if ($insertion) {
            return true;
        } else {
            return false;
        }
    }

    //Getting all entries from feed table
    public function getAllCowDietByDietId($conn, $table, $dietId)
    {
        $query = "SELECT * FROM $table WHERE dietID = $dietId";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function getCowDietByCowId($conn, $table, $dietId)
    {
        $query = "SELECT * FROM $table WHERE cowID = $dietId";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }



    public function getAllCowDiet($conn, $table)
    {
        return $this->getAllRecords($conn, $table);
    }

}

?>