<?php 

session_start();
session_unset();
session_destroy();
header('Location:http://localhost:81/Aqib Work/Login.php');

?>