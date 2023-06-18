<?php

require_once("db.php");

class UserModal
{
    public $conn;

    function __construct()
    {
        $this->conn = new Db();
    }

    
}

?>