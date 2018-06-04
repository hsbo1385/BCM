<?php

$servername = "localhost";
$username = "bcmTest";
$password = "8k1w9I_e";
$dbname = "bcm";

try {
        global $conn;
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error); 
    }
catch(Exception $e)
    {
        echo 
            "<script>
                alert('Connection failed: " . $e->getMessage() . "');
            </script>";
    }

?>