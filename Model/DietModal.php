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

    //Crud operations for feed

    //get All Diet Plans

    public function getAllDietPlans($conn, $table)
    {
        $query = "SELECT * FROM $table";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }
    //Adding New Feed into feed table
    public function addNewFeed($conn, $table, $data)
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
                echo "Error inserting user: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

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


        $insertion = $this->addNewFeed($conn, 'feed', $data);
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

        $sql = "UPDATE $table SET `name`='$name', `quantity`='$quantity', `price`='$price' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            return "updated";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

    //Getting a feed from table using its id
    public function getFeedById($conn, $table, $id)
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

    //Crud operations for diet plan

    //Adding new diet plan
    public function addNewDietPlan($conn, $table, $data)
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
                echo "Error inserting dietplan: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    //API for adding diet plan
    public function AddDietPlanApi($conn, $table, $req)
    {
        $name = $req['planName'];
        $description = $req['description'];

        $data = [
            'name' => $name,
            'description' => $description
        ];

        $insertion = $this->addNewDietPlan($conn, 'diet', $data);
        $output["status"] = $insertion;

        echo json_encode($output["status"]);
    }

    //Getting last record from diet table to get the diet id
    //for diet_feed table
    public function getDietId($conn, $table)
    {
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_array($result);
            return $row['id'];
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

}



?>