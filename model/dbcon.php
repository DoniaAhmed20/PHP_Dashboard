<?php

require_once __DIR__ . '/../config/config.php';

class dbConnect {
    public $conn;

    public function __construct() {
        // Create a new MySQLi connection
        try {
            $this->conn = new mysqli(__HOST__, __USER__, __PASS__, __DB__, __PORT__);
            if ($this->conn->connect_error) {
                die('Connection failed: ' . $this->conn->connect_error);
            }
            //echo 'Connection Successfully ';
        } catch (Exception $e) {
            // Handle any potential connection errors
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}

// $ob = new dbConnect();
 
?>  