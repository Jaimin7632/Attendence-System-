<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password) or die($conn->connect_error);

$sql = "CREATE DATABASE IF NOT EXISTS Attendence1";
$conn->query($sql) or die("databease not created");
mysqli_select_db($conn,"Attendence1");

?>