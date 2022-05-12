<?php

// Host IP Address
$hostname='http://localhost:81/Aqib Work/';
// Database Connection 
try{
    $db_name = 'mysql:host=localhost;dbname=student-record;';
    $username = 'root';
    $passowrd = '';
    $conn = new PDO($db_name, $username, $passowrd);
   
} catch (PDOException $exception) {
    $error = $exception->getMessage();
    echo '<script>alert("' . $error . '")</script>';
}

?>