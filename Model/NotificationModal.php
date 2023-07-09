<?php

require_once("db.php");

class NotificationModal
{
    public $conn;

    function __construct()
    {
        $this->conn = new Db();
    }


    public function AddNotification($conn, $table, $cowId, $type, $description, $date)
    {
        $action = 'new'; // Default value for the "action" column

        // Prepare the SQL statement
        $sql = "INSERT INTO $table (cowId, type, action, description, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "issss", $cowId, $type, $action, $description, $date);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if ($result) {
            // Notification entry added successfully
            return true;
        } else {
            // Error occurred during the insertion
            return false;
        }
    }

    //get All Notification with type
    public function getAllNotificationWithType($conn, $table, $type, $cowId = -99)
    {
        $sql = "SELECT * FROM $table WHERE type = '$type' AND cowId =$cowId ";
        $result = mysqli_query($conn, $sql);
        $rows = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return null;
        }
    }

    //get all notification
    public function getAllNotification($conn, $table, $cowId = -99)
    {
        if ($cowId == -99) {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT * FROM $table WHERE cowId = $cowId";
        }

        $sql = "SELECT * FROM $table";
        $result = mysqli_query($conn, $sql);
        $rows = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return null;
        }
    }



    // generate notification on login of milk production
    public function AvgMilkProductionNotification($conn, $table)
    {
        $CM = new CowModal();

        $AllCows = $CM->getAllCows($conn, "cows");


        for ($i = 0; $i < count($AllCows); $i++) {
            $cowId = $AllCows[$i]["id"];
            $avgProduction = $CM->GetAvgHighestRankOfCowApi($conn, $table, $cowId);
            $yesterdayProduction = $CM->getYesterdayMilkProduction($conn, "milk", $cowId);
            $AllNotfication = $this->getAllNotificationWithType($conn, "alert", "Low Milk Production", $cowId);

            if ($avgProduction[0]["avg_milk_production"] == null || $yesterdayProduction == null) {
                continue;
            }

           // var_dump($AllNotfication);

            if ($AllNotfication != null) {
                $found = false;
                for ($j = 0; $j < count($AllNotfication); $j++) {
                    if ($AllNotfication[$j]["date"] == date("Y-m-d")) {
                        $found = true;
                        break;
                    }
                }

                if ($found) {
                    continue;
                }
            }


            if ($avgProduction[0][0] > $yesterdayProduction) {
                $type = "Low Milk Production";
                $description = "Your cow " . $AllCows[$i]["name"] . " is not producing milk as expected";
                $date = date("Y-m-d");
                $this->AddNotification($conn, "alert", $cowId, $type, $description, $date);
            }
        }
    }



}




?>