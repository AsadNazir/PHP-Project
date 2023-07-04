<?php

require_once("db.php");

class DietModal
{
    public $conn;

    function __construct()
    {
        $this->conn = new Db();
    }


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

    public function deleteFeedApi($conn, $table, $req)
    {
        $id = $req['id'];
      
        $deletion = $this->deleteFeed($conn, 'feed', $id);
        $output["status"] = $deletion;
      
        echo json_encode($output["status"]); 
    }
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

    public function updateFeed($conn, $table, $data, $id)
    {
        // $sql = "UPDATE $table SET `name`='$name', `email`='$email', `job`='$job' WHERE id='$id'";
        // if (mysqli_query($conn, $sql)) {
        //     return "updated";
        // } else {
        //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // }
    }

    public function UpdateFeedAPI($conn, $table, $req, $file)
    {
        // $id = $req['id'];
        // $name = $req['name'];
        // $email = $req['email'];
        // $job = $req['job'];
        //     $data = [
        //         'name' => $name,
        //         'email' => $email,
        //         'job' => $job,
        //         'adminRights' => $adminRights,
        //         'image' => $NewImageName
        //     ];


        // $updation = $this->updateFeed($conn, 'users', $data, $id);
        // $output["status"] = $updation;
        // echo json_encode($output["status"]);

    }








}



?>